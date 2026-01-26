<?php
use Bitrix\Main\Loader;
use Bitrix\Main\IO\File;
use Bitrix\Main\IO\Directory;

class TransactCleanerAgent
{
    const DAYS_TO_KEEP = 30;
    const BATCH_SIZE = 1000;
    const ARCHIVE_DIR = '/upload/archive/transactions/';

    public static function cleanOldTransactions()
    {
        if (!Loader::includeModule('sale')) {
            return __CLASS__ . "::cleanOldTransactions();";
        }

        self::ensureArchiveDir();

        $dateLimit = date('d.m.Y H:i:s', strtotime('-' . self::DAYS_TO_KEEP . ' days'));

        try {
            $archiveFile = self::archiveOldTransactions($dateLimit);

            if ($archiveFile) {
                $deletedCount = self::deleteArchivedTransactions($dateLimit);
                self::logCleanup($deletedCount, $archiveFile);
            }

        } catch (\Exception $e) {
            error_log("TransactCleanerAgent error: " . $e->getMessage());
        }

        return __CLASS__ . "::cleanOldTransactions();";
    }

    private static function ensureArchiveDir()
    {
        $archivePath = $_SERVER['DOCUMENT_ROOT'] . self::ARCHIVE_DIR;
        if (!Directory::isDirectoryExists($archivePath)) {
            Directory::createDirectory($archivePath);
        }
    }

    private static function archiveOldTransactions($dateLimit)
    {
        $transactionsToArchive = [];
        $counter = 0;

        $dbTransact = CSaleUserTransact::GetList(
            ["TRANSACT_DATE" => "ASC"],
            ["<TRANSACT_DATE" => $dateLimit],
            false,
            false,
            ["*"]
        );

        while ($transact = $dbTransact->Fetch()) {
            $transactionsToArchive[] = $transact;
            $counter++;

            if ($counter >= self::BATCH_SIZE) {
                break;
            }
        }

        if (empty($transactionsToArchive)) {
            return null;
        }

        $filename = 'transactions_' . date('Y-m-d_H-i-s') . '_' . uniqid() . '.json';
        $filepath = $_SERVER['DOCUMENT_ROOT'] . self::ARCHIVE_DIR . $filename;

        $file = new File($filepath);
        $file->putContents(json_encode($transactionsToArchive, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return $filename;
    }

    private static function deleteArchivedTransactions($dateLimit)
    {
        $deletedCount = 0;
        $processed = 0;

        do {
            $dbTransact = CSaleUserTransact::GetList(
                ["ID" => "ASC"],
                ["<TRANSACT_DATE" => $dateLimit],
                false,
                ["nTopCount" => self::BATCH_SIZE],
                ["ID"]
            );

            $processed = 0;
            while ($transact = $dbTransact->Fetch()) {
                if (CSaleUserTransact::Delete($transact['ID'])) {
                    $deletedCount++;
                    $processed++;
                }
            }

        } while ($processed > 0 && $processed >= self::BATCH_SIZE);

        return $deletedCount;
    }

    private static function logCleanup($deletedCount, $archiveFile)
    {
        $logPath = $_SERVER['DOCUMENT_ROOT'] . self::ARCHIVE_DIR . 'cleanup.log';
        $logMessage = date('Y-m-d H:i:s') . " - Удалено: {$deletedCount} записей, архив: {$archiveFile}\n";

        $logFile = new File($logPath);
        if ($logFile->isExists()) {
            $logFile->putContents($logFile->getContents() . $logMessage);
        } else {
            $logFile->putContents($logMessage);
        }
    }
}