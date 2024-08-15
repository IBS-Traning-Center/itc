<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $startdateGlobal, $glFlagShowForm, $arEventInfo;

$glFlagShowForm = true;
$startdateGlobal = $arResult['START_DATE'];
if ($arResult["FLAG_CLOSE_REG"] == 101) {
    $glFlagShowForm = false;
}

$arEventInfo["NAME"] = $arResult["NAME"];
$arEventInfo["CODE"] = "";
$arEventInfo["DATE"] = $arResult['DATE_EVENT'];
$arEventInfo["TYPE_ID"] = 80;
$arEventInfo["EVENT_CITY"] = $arResult['CITY_EVENT'];
if ($arResult["TYPE_EVENT"] == 92) {
    $arEventInfo["EVENT_CITY"] = "Онлайн";
    $arEventInfo["WEBINAR"] = "TRUE";
}