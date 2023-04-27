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

$rsUser = CUser::GetByID($arParams["ASD_MAIL_ID"]);
if ($arUser = $rsUser->Fetch())
{
	if (MyClass::GetMailHash($arUser["EMAIL"]) != $arParams["ASD_MAIL_MD5"])
	{
		$arResult["ERROR"] = GetMessage("ASD_INCORRECT_HASH_L");
	}
	else
	{
		$arResult["EMAIL"] = $arUser["EMAIL"];
	}
}
else
{
	$arResult["ERROR"] = GetMessage("ASD_SUBSCRIBE_NOT_FOUND_L");
}

if ($arResult["ERROR"]=="" && $arParams["CONFIRM_UNSUBSCIBE"]=="Y")
{
	//if (CUser::Delete($arParams["ASD_MAIL_ID"]));
	$user = new CUser;
	$fields = Array(
	  "ACTIVE"            => "Y",
	  "GROUP_ID"          => array(13),
	  );
	$user->Update($arParams["ASD_MAIL_ID"], $fields);

	//{}else {		//$arResult["ERROR"] = ;	//};
	//$subscr = new CSubscription();
	//if (!($subscr->Update($arParams["ASD_MAIL_ID"], array("ACTIVE" => "N", "SEND_CONFIRM" => "N"))))
	//{
		//$arResult["ERROR"] = $subscr->LAST_ERROR;
	//}
}

$this->IncludeComponentTemplate();
?>