<?
if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!CModule::IncludeModule("subscribe"))
{
	ShowError(GetMessage("ASD_NOT_INSTALLED_L"));
	return;
}

$arParams["CONFIRM_UNSUBSCIBE"] = $_GET["confirm"]=="Y" ? "Y" : "N";
$arParams["CONFIRMED_URL"] = $APPLICATION->GetCurPageParam("confirm=Y", array("confirm"), false);

$arResult["ERROR"] = "";
$arResult["SUCCESS"] = "";

$rsSub = CSubscription::GetByID($arParams["ASD_MAIL_ID"]);
if ($arSub = $rsSub->Fetch())
{
	if (MyClass::GetMailHash($arSub["EMAIL"]) != $arParams["ASD_MAIL_MD5"])
	{
		$arResult["ERROR"] = GetMessage("ASD_INCORRECT_HASH_L");
	}
	else
	{
		$arResult["EMAIL"] = $arSub["EMAIL"];
	}
}
else
{
	$arResult["ERROR"] = GetMessage("ASD_SUBSCRIBE_NOT_FOUND_L");
}


if ($arResult["ERROR"]=="" && $arParams["CONFIRM_UNSUBSCIBE"]=="Y")
{
	$subscr = new CSubscription();
	if (!($subscr->Update($arParams["ASD_MAIL_ID"], array("ACTIVE" => "N", "SEND_CONFIRM" => "N"))))
	{
		$arResult["ERROR"] = $subscr->LAST_ERROR;
	} else {
		CStatEvent::AddCurrent("subscribe", "out", $arParams["ASD_MAIL_ID"]);
		$arEventFields["MAIL"]=$arResult["EMAIL"];
		if (strlen($_REQUEST["reason"])>0) {
			$arEventFields["REASON"]=$_REQUEST["reason"];
		} else {
			$arEventFields["REASON"]="Не указана";
		}
		$arEventFields["ANOTHER"]=$_REQUEST["another"];
		CEvent::Send("USER_UNSUBSCRIBE", SITE_ID, $arEventFields);
	}
}

$this->IncludeComponentTemplate();

?>