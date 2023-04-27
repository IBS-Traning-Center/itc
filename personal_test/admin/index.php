<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

define("NEED_AUTH", true);
global $APPLICATION, $USER;

$APPLICATION->SetTitle("Рассылка для администраторов");

$APPLICATION->IncludeComponent(
    "luxoft:admin.rassylka",
    "",
    array()
);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");