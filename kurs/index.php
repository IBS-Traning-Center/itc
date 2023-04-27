<?php
/**
 * @var CMain $APPLICATION
 */
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetPageProperty("IS_FULL_WIDTH", "Y");
$APPLICATION->SetPageProperty("DONT_SHOW_PAGE_TOP", "Y");
$APPLICATION->SetTitle("IBS Training Center");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_after.php");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->IncludeComponent(
    'luxoft:courses.detail',
    '',
    [
        'coursesPath' => '/kurs/',
        'trainersPath' => '/about/experts/',
    ]
);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");