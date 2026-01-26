<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $USER;
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
$arUserInfo["LOGIN"] = $USER->GetLogin();
$arUserInfo["EMAIL"] = $USER->GetParam("EMAIL");
$arUserInfo["FirstName"] = $USER->GetFirstName();
$arUserInfo["LastName"] = $USER->GetLastName();
$arUserInfo["PERSONAL_CITY"] = $arUser["PERSONAL_CITY"];
$arUserInfo["WORK_COMPANY"] = $arUser["WORK_COMPANY"];
$arUserInfo["PERSONAL_PHONE"] = $arUser["PERSONAL_PHONE"];

//iwrite($arUserInfo);

if (array_key_exists("FirstName", $arResult["arAnswers"])
 && $arResult["arAnswers"]["FirstName"][0]["VALUE"] == "#FIRSTNAME#"){
	$arResult["QUESTIONS"]["FirstName"]["HTML_CODE"] = str_replace("#FIRSTNAME#", $arUserInfo["FirstName"], $arResult["QUESTIONS"]["FirstName"]["HTML_CODE"]);
 }
if (array_key_exists("LastName", $arResult["arAnswers"])
 && $arResult["arAnswers"]["LastName"][0]["VALUE"] == "#LASTNAME#") {
	$arResult["QUESTIONS"]["LastName"]["HTML_CODE"] = str_replace("#LASTNAME#", $arUserInfo["LastName"], $arResult["QUESTIONS"]["LastName"]["HTML_CODE"]);
 }

if (array_key_exists("Email", $arResult["arAnswers"])
 && $arResult["arAnswers"]["Email"][0]["VALUE"] == "#EMAIL#") {
	$arResult["QUESTIONS"]["Email"]["HTML_CODE"] = str_replace("#EMAIL#", $arUserInfo["EMAIL"], $arResult["QUESTIONS"]["Email"]["HTML_CODE"]);
 }

if (array_key_exists("City", $arResult["arAnswers"])
 && $arResult["arAnswers"]["City"][0]["VALUE"] == "#CITY#") {
	$arResult["QUESTIONS"]["City"]["HTML_CODE"] = str_replace("#CITY#", $arUserInfo["PERSONAL_CITY"], $arResult["QUESTIONS"]["City"]["HTML_CODE"]);
 }

if (array_key_exists("Company", $arResult["arAnswers"])
 && $arResult["arAnswers"]["Company"][0]["VALUE"] == "#COMPANY#") {
	$arResult["QUESTIONS"]["Company"]["HTML_CODE"] = str_replace("#COMPANY#", $arUserInfo["WORK_COMPANY"], $arResult["QUESTIONS"]["Company"]["HTML_CODE"]);
 }

if (array_key_exists("Telephone", $arResult["arAnswers"])
 && $arResult["arAnswers"]["Telephone"][0]["VALUE"] == "#TELEPHONE#") {
	$arResult["QUESTIONS"]["Telephone"]["HTML_CODE"] = str_replace("#TELEPHONE#", $arUserInfo["PERSONAL_PHONE"], $arResult["QUESTIONS"]["Telephone"]["HTML_CODE"]);
 }


	//$arParams['CUR_ISSUE'] = intval($arParams['CUR_ISSUE']);
	//$arResult['CUR_ISSUE'] = $arParams['CUR_ISSUE'];


?>


