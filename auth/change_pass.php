<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Изменение пароля");

define("NOT_CHECK_PERMISSIONS", true);
define("NO_KEEP_STATISTIC", true);

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
    <div class="change-password-container">
        <?$APPLICATION->IncludeComponent(
            "bitrix:system.auth.changepasswd",
            ".default",  // или ваш кастомный шаблон, если есть
            Array(),
            false
        );?>
    </div>

    <script>
        // Сообщаем родительской странице, что смена прошла успешно
        window.addEventListener('message', function(e) {
            if (e.data === 'password_changed_success') {
                parent.postMessage('close_and_show_success', '*');
            }
        });
    </script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>