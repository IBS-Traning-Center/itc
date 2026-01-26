<?php
use Bitrix\Main\Loader;
use Bitrix\Main\Type\DateTime;

class TransactNotifierAgent
{
    const MONTHS_TO_KEEP = 2;
    const DAYS_TO_KEEP = 60;

    public static function sendDeletionNotifications()
    {
        if (!Loader::includeModule('sale') || !Loader::includeModule('main')) {
            return __CLASS__ . "::sendDeletionNotifications();";
        }

        $usersToNotify = self::getUsersWithOldTransactions();
        $notificationsSent = 0;

        foreach ($usersToNotify as $userId => $userData) {
            $shouldNotify30 = self::shouldNotify($userData['oldest_date'], 30);

            if ($shouldNotify30) {
                if (self::sendBitrixNotification($userId, $userData, 30, '30 дней')) {
                    $notificationsSent++;
                }
            }

            $shouldNotify7 = self::shouldNotify($userData['oldest_date'], 7);

            if ($shouldNotify7) {
                if (self::sendBitrixNotification($userId, $userData, 7, '7 дней')) {
                    $notificationsSent++;
                }
            }
        }

        return __CLASS__ . "::sendDeletionNotifications();";
    }

    private static function getUsersWithOldTransactions()
    {
        $users = [];

        $dateLimit = new DateTime();
        $dateLimit->add("-1 month");
        $dateLimitStr = $dateLimit->format("d.m.Y H:i:s");

        $dbTransact = CSaleUserTransact::GetList(
            ["TRANSACT_DATE" => "ASC"],
            [],
            false,
            false,
            ["ID", "USER_ID", "TRANSACT_DATE", "DEBIT", "CREDIT", "CURRENCY", "NOTES", "AMOUNT", "DESCRIPTION", "TIMESTAMP_X", "CURRENT_BUDGET"]
        );

        while ($transact = $dbTransact->Fetch()) {
            if (empty($transact['TRANSACT_DATE'])) {
                continue;
            }

            $transactTimestamp = self::parseDateTime($transact['TRANSACT_DATE']);
            $limitTimestamp = self::parseDateTime($dateLimitStr);

            if ($transactTimestamp === false || $limitTimestamp === false) {
                continue;
            }

            if ($transactTimestamp < $limitTimestamp) {
                $userId = $transact["USER_ID"];

                if (!isset($users[$userId])) {
                    $dbUser = CUser::GetByID($userId);
                    if ($user = $dbUser->Fetch()) {
                        $currentBudget = self::getUserCurrentBudget($userId);

                        $users[$userId] = [
                            'user_id' => $userId,
                            'email' => $user['EMAIL'],
                            'name' => trim($user['NAME'] . ' ' . $user['LAST_NAME']) ?: $user['LOGIN'],
                            'first_name' => $user['NAME'] ?: $user['LOGIN'],
                            'last_name' => $user['LAST_NAME'],
                            'login' => $user['LOGIN'],
                            'oldest_date' => $transact['TRANSACT_DATE'],
                            'transaction_count' => 0,
                            'transactions' => [],
                            'current_budget' => $currentBudget,
                            'total_debit' => 0,
                            'total_credit' => 0
                        ];
                    } else {
                        continue;
                    }
                }

                if (isset($users[$userId])) {
                    $users[$userId]['transaction_count']++;
                    $users[$userId]['transactions'][] = $transact;

                    if (!empty($transact['DEBIT']) && $transact['DEBIT'] == 'Y') {
                        $users[$userId]['total_debit'] += $transact['AMOUNT'];
                    }
                    if (!empty($transact['CREDIT']) && $transact['CREDIT'] == 'Y') {
                        $users[$userId]['total_credit'] += $transact['AMOUNT'];
                    }

                    $currentOldest = self::parseDateTime($users[$userId]['oldest_date']);
                    if ($transactTimestamp < $currentOldest) {
                        $users[$userId]['oldest_date'] = $transact['TRANSACT_DATE'];
                    }

                    if (!empty($transact['CURRENT_BUDGET'])) {
                        $users[$userId]['current_budget'] = $transact['CURRENT_BUDGET'];
                    }
                }
            }
        }

        return $users;
    }

    private static function getUserCurrentBudget($userId)
    {
        $connection = \Bitrix\Main\Application::getConnection();
        $sql = "SELECT CURRENT_BUDGET 
                FROM b_sale_user_transact 
                WHERE USER_ID = " . intval($userId) . " 
                ORDER BY TRANSACT_DATE DESC 
                LIMIT 1";

        try {
            $result = $connection->query($sql);
            if ($row = $result->fetch()) {
                return !empty($row['CURRENT_BUDGET']) ? $row['CURRENT_BUDGET'] : 0;
            }
        } catch (\Exception $e) {
        }

        return 0;
    }

    private static function shouldNotify($transactionDate, $daysBeforeDeletion)
    {
        if (empty($transactionDate)) {
            return false;
        }

        $timestamp = self::parseDateTime($transactionDate);
        if ($timestamp === false) {
            return false;
        }

        $currentTimestamp = time();
        $secondsPassed = $currentTimestamp - $timestamp;
        $daysPassed = floor($secondsPassed / (60 * 60 * 24));
        $totalDaysToKeep = self::DAYS_TO_KEEP;
        $daysLeft = $totalDaysToKeep - $daysPassed;

        if ($daysPassed >= $totalDaysToKeep) {
            return false;
        }

        if ($daysPassed < 30) {
            return false;
        }

        $tolerance = 5;
        $minDays = $daysBeforeDeletion - $tolerance;
        $maxDays = $daysBeforeDeletion + $tolerance;

        return ($daysLeft <= $maxDays) && ($daysLeft >= $minDays);
    }

    private static function parseDateTime($dateString)
    {
        if (empty($dateString)) {
            return false;
        }

        if (preg_match('/^(\d{2})\.(\d{2})\.(\d{4})\s+(\d{2}):(\d{2}):(\d{2})$/', $dateString, $matches)) {
            return mktime($matches[4], $matches[5], $matches[6], $matches[2], $matches[1], $matches[3]);
        }

        $timestamp = strtotime($dateString);
        return $timestamp !== false ? $timestamp : false;
    }

    private static function sendBitrixNotification($userId, $userData, $daysLeft, $periodText)
    {
        if (empty($userData['email'])) {
            return false;
        }

        $timestamp = self::parseDateTime($userData['oldest_date']);
        if ($timestamp !== false) {
            $deleteDate = date('d.m.Y', strtotime("+60 days", $timestamp));
        } else {
            $deleteDate = date('d.m.Y', strtotime("+{$daysLeft} дней"));
        }

        $budgetFormatted = number_format($userData['current_budget'], 2, '.', ' ');

        $transactionsList = '';
        if (!empty($userData['transactions'])) {
            $counter = 1;
            foreach ($userData['transactions'] as $transact) {
                $dateFormatted = !empty($transact['TRANSACT_DATE']) ? $transact['TRANSACT_DATE'] : "дата не указана";
                $amount = !empty($transact['AMOUNT']) ? $transact['AMOUNT'] : 0;
                $type = (!empty($transact['DEBIT']) && $transact['DEBIT'] == 'Y') ? 'Начисление' : 'Списание';
                $currency = !empty($transact['CURRENCY']) ? $transact['CURRENCY'] : 'RUB';

                $transactionsList .= "{$counter}. {$dateFormatted} - {$type}: {$amount} {$currency}";
                if (!empty($transact['DESCRIPTION'])) {
                    $transactionsList .= " ({$transact['DESCRIPTION']})";
                }
                $transactionsList .= "\n";
                $counter++;
            }
        }

        $arFields = [
            "NAME" => $userData['name'],
            "BUDGET" => $budgetFormatted,
            "USER_ID" => $userId,
            "EMAIL" => $userData['email'],
            "FIRST_NAME" => $userData['first_name'],
            "LAST_NAME" => $userData['last_name'],
            "LOGIN" => $userData['login'],
            "DAYS_LEFT" => $daysLeft,
            "PERIOD_TEXT" => $periodText,
            "DELETE_DATE" => $deleteDate,
            "TRANSACTION_COUNT" => $userData['transaction_count'],
            "TOTAL_DEBIT" => number_format($userData['total_debit'], 2, '.', ' '),
            "TOTAL_CREDIT" => number_format($userData['total_credit'], 2, '.', ' '),
            "NET_BALANCE" => number_format($userData['total_debit'] - $userData['total_credit'], 2, '.', ' '),
            "TRANSACTIONS_LIST" => $transactionsList,
            "OLDEST_DATE" => $userData['oldest_date'],
            "CURRENT_DATE" => date('d.m.Y H:i:s'),
            "SCHEDULE_LINK" => "https://ibs-training.ru/timetable/",
            "BONUSES_LINK" => "https://ibs-training.ru/personal_test/bonuses/",
            "PERSONAL_LINK" => "https://ibs-training.ru/personal/",
        ];

        $eventName = "BONUS_EXPIRED";
        $siteId = SITE_ID;

        try {
            $eventType = CEventType::GetList(["EVENT_NAME" => $eventName])->Fetch();
            if (!$eventType) {
                return false;
            }

            $eventId = \CEvent::Send($eventName, $siteId, $arFields, "N", "", [], $userId);

            if ($eventId > 0) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}