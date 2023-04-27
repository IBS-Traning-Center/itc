<?php
define("NO_KEEP_STATISTIC", true); // Не собираем стату по действиям AJAX
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
//$ert= rand(5,90);
//echo "ert=$ert";
if (CModule::IncludeModule("sale") && CModule::IncludeModule("catalog"))
{?><?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small", "new-design", array(
	"PATH_TO_BASKET" => "/personal/cart/",
	"PATH_TO_PERSONAL" => "/personal/",
	"SHOW_PERSONAL_LINK" => "N",
	"PATH_TO_ORDER"	=>	"/personal/order/",
	),
	false
);?><?}
}
//if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); // можно не выполнять
?>