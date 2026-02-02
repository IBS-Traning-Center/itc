<?php
// /test_mail_agent.php

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

echo "<h1>Тест отправки уведомлений</h1>";

// Подключаем агент
require_once($_SERVER['DOCUMENT_ROOT'] . '/local/classes/transact_notifier.php');

// Кнопка для создания тестовых транзакций
?>
    <form method="post" style="margin: 20px 0; padding: 15px; background-color: #f8f9fa; border: 1px solid #dee2e6;">
        <h3>Создание тестовых транзакций для пользователя 41100:</h3>
        <button type="submit" name="create_test_transactions" class="btn btn-primary">Создать транзакции за 7 и 30 дней до сгорания</button>
    </form>

<?php
// Обработка создания тестовых транзакций
if (isset($_POST['create_test_transactions'])) {
    echo "<h3>Создание транзакций:</h3>";

    // Создаем транзакции для пользователя 41100
    $result = createTestTransactions();

    if ($result) {
        echo "<div style='color: green; padding: 10px; background-color: #d4edda;'>✅ Тестовые транзакции созданы успешно!</div>";
    } else {
        echo "<div style='color: red; padding: 10px; background-color: #f8d7da;'>❌ Ошибка при создании транзакций</div>";
    }
}

// Функция для создания тестовых транзакций
function createTestTransactions() {
    if (!CModule::IncludeModule("sale")) {
        return false;
    }

    $userId = 41100;
    $currency = "RUB";

    // Проверяем существование пользователя
    $user = CUser::GetByID($userId)->Fetch();
    if (!$user) {
        echo "<p style='color: red;'>Пользователь с ID 41100 не найден</p>";
        return false;
    }

    echo "<p>Создаем транзакции для пользователя: {$user['NAME']} {$user['LAST_NAME']} (ID: {$userId}, Email: {$user['EMAIL']})</p>";

    // Удаляем старые тестовые транзакции этого пользователя (опционально)
    // $connection = Bitrix\Main\Application::getConnection();
    // $connection->query("DELETE FROM b_sale_user_transact WHERE USER_ID = {$userId} AND NOTES LIKE '%Тест%'");

    // Текущая дата
    $currentDate = new DateTime();

    // 1. Транзакция, которая будет удалена через 7 дней (должна сгенерировать уведомление за 7 дней)
    $date7Days = new DateTime();
    $date7Days->modify('-' . (TransactNotifierAgent::DAYS_TO_KEEP - 7) . ' days'); // 60 - 7 = 53 дня назад

    $transactId1 = CSaleUserTransact::Add([
        'USER_ID' => $userId,
        'CURRENCY' => $currency,
        'AMOUNT' => 100.50,
        'DEBIT' => 'Y', // Начисление
        'CREDIT' => 'N',
        'NOTES' => 'Тестовая транзакция (уведомление за 7 дней)',
        'DESCRIPTION' => 'Тестовое начисление бонусов',
        'ORDER_ID' => null,
        'PAYMENT_ID' => null,
        'TRANSACT_DATE' => $date7Days->format('d.m.Y H:i:s'),
        'TIMESTAMP_X' => $date7Days->format('d.m.Y H:i:s'),
    ]);

    echo "<p>Транзакция за 7 дней до удаления: ";
    if ($transactId1) {
        echo "<span style='color: green;'>Успешно (ID: {$transactId1})</span>";
    } else {
        echo "<span style='color: red;'>Ошибка</span>";
    }
    echo " - Дата: " . $date7Days->format('d.m.Y H:i:s') . "</p>";

    // 2. Транзакция, которая будет удалена через 30 дней (должна сгенерировать уведомление за 30 дней)
    $date30Days = new DateTime();
    $date30Days->modify('-' . (TransactNotifierAgent::DAYS_TO_KEEP - 30) . ' days'); // 60 - 30 = 30 дней назад

    $transactId2 = CSaleUserTransact::Add([
        'USER_ID' => $userId,
        'CURRENCY' => $currency,
        'AMOUNT' => 200.75,
        'DEBIT' => 'Y', // Начисление
        'CREDIT' => 'N',
        'NOTES' => 'Тестовая транзакция (уведомление за 30 дней)',
        'DESCRIPTION' => 'Тестовое начисление бонусов',
        'ORDER_ID' => null,
        'PAYMENT_ID' => null,
        'TRANSACT_DATE' => $date30Days->format('d.m.Y H:i:s'),
        'TIMESTAMP_X' => $date30Days->format('d.m.Y H:i:s'),
    ]);

    echo "<p>Транзакция за 30 дней до удаления: ";
    if ($transactId2) {
        echo "<span style='color: green;'>Успешно (ID: {$transactId2})</span>";
    } else {
        echo "<span style='color: red;'>Ошибка</span>";
    }
    echo " - Дата: " . $date30Days->format('d.m.Y H:i:s') . "</p>";

    // 3. Дополнительная транзакция - уже старая, которая скоро удалится
    $date55Days = new DateTime();
    $date55Days->modify('-' . (TransactNotifierAgent::DAYS_TO_KEEP - 5) . ' days'); // 60 - 5 = 55 дней назад

    $transactId3 = CSaleUserTransact::Add([
        'USER_ID' => $userId,
        'CURRENCY' => $currency,
        'AMOUNT' => 50.00,
        'DEBIT' => 'N',
        'CREDIT' => 'Y', // Списание
        'NOTES' => 'Тестовая транзакция (почти сгорела)',
        'DESCRIPTION' => 'Тестовое списание бонусов',
        'ORDER_ID' => null,
        'PAYMENT_ID' => null,
        'TRANSACT_DATE' => $date55Days->format('d.m.Y H:i:s'),
        'TIMESTAMP_X' => $date55Days->format('d.m.Y H:i:s'),
    ]);

   
    if ($transactId3) {
        echo "<span style='color: green;'>Успешно (ID: {$transactId3})</span>";
    } else {
        echo "<span style='color: red;'>Ошибка</span>";
    }
    echo " - Дата: " . $date55Days->format('d.m.Y H:i:s') . "</p>";

    // Показываем общее количество транзакций пользователя
    $dbTransact = CSaleUserTransact::GetList(
        [],
        ["USER_ID" => $userId],
        false,
        false,
        ["ID"]
    );

    $transactionCount = 0;
    while ($dbTransact->Fetch()) {
        $transactionCount++;
    }

    echo "<p><strong>Всего транзакций у пользователя: {$transactionCount}</strong></p>";

    return $transactId1 && $transactId2;
}

// Запускаем агент
echo "<h3>Запуск агента уведомлений:</h3>";
$result = TransactNotifierAgent::sendDeletionNotifications();
var_dump($result);
echo "<p>Результат: " . ($result ? "Успешно" : "Ошибка") . "</p>";

// Проверяем последние отправленные письма
echo "<h3>Проверка отправленных писем:</h3>";

// Последние записи в логе почты
$logFile = $_SERVER['DOCUMENT_ROOT'] . '/logs/mail.log';
if (file_exists($logFile)) {
    $lines = file($logFile);
    $lastLines = array_slice($lines, -10);
    echo "<pre>";
    foreach ($lastLines as $line) {
        echo htmlspecialchars($line);
    }
    echo "</pre>";
} else {
    echo "<p>Файл лога почты не найден</p>";
}

echo "<h3>Настройки почты в Битрикс:</h3>";
echo "<ul>";
echo "<li><a href='/bitrix/admin/settings.php?lang=ru&mid=main&mid_menu=1'>Настройки главного модуля</a></li>";
echo "<li><a href='/bitrix/admin/message_admin.php?lang=ru'>Почтовые события</a></li>";
echo "<li><a href='/bitrix/admin/message_template_admin.php?lang=ru&EVENT_NAME=BONUS_EXPIRED'>Шаблон BONUS_EXPIRED</a></li>";
echo "</ul>";

echo "<h3>Для немедленной отправки тестового письма:</h3>";
?>
    <form method="post">
        <input type="email" name="test_email" placeholder="Ваш email для теста" required>
        <button type="submit" name="send_test">Отправить тестовое письмо</button>
    </form>

<?php
if (isset($_POST['send_test'])) {
    $testEmail = $_POST['test_email'];

    $arFields = [
        "EMAIL" => $testEmail,
        "NAME" => "Тестовый Пользователь",
        "DAYS_LEFT" => 7,
        "PERIOD_TEXT" => "неделю",
        "DELETE_DATE" => date('d.m.Y', strtotime('+7 days')),
        "TRANSACTION_COUNT" => 3,
        "OLDEST_DATE" => date('d.m.Y'),
        "TRANSACTIONS_LIST" => "Тестовая транзакция 1\nТестовая транзакция 2",
    ];

    $result = CEvent::Send("BONUS_EXPIRED", SITE_ID, $arFields);

    echo "<div style='padding: 10px; background-color: " . ($result ? "#d4edda" : "#f8d7da") . ";'>";
    echo $result ? "✅ Письмо отправлено на $testEmail" : "❌ Ошибка отправки";
    echo "</div>";
}
?>

    <hr>
    <h3>Другие способы тестирования:</h3>
    <ol>
        <li><a href="/bitrix/admin/agent_list.php?lang=ru">Админка: Список агентов</a></li>
        <li><a href="/bitrix/admin/agent_check.php?lang=ru">Админка: Проверка агентов</a></li>
    </ol>

<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");