<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

// apply default param values
$arDefaultValues = array(
	"SHOW_FIELDS" => array(),
	"REQUIRED_FIELDS" => array(),
	"AUTH" => "Y",
	"USE_BACKURL" => "Y",
	"SUCCESS_PAGE" => "",
);

foreach ($arDefaultValues as $key => $value)
{
	if (!is_set($arParams, $key))
		$arParams[$key] = $value;
}
if(!is_array($arParams["SHOW_FIELDS"]))
	$arParams["SHOW_FIELDS"] = array();
if(!is_array($arParams["REQUIRED_FIELDS"]))
	$arParams["REQUIRED_FIELDS"] = array();

// if user registration blocked - return auth form
if (COption::GetOptionString("main", "new_user_registration", "N") == "N")
	$APPLICATION->AuthForm(array());

// apply core fields to user defined
$arDefaultFields = array(
	"LOGIN",
	"PASSWORD",
	"CONFIRM_PASSWORD",
	"EMAIL",
);

$arResult["USE_EMAIL_CONFIRMATION"] = COption::GetOptionString("main", "new_user_registration_email_confirmation", "N") == "Y" ? "Y" : "N";
$def_group = COption::GetOptionString("main", "new_user_registration_def_group", "");
if($def_group <> "")
	$arResult["GROUP_POLICY"] = CUser::GetGroupPolicy(explode(",", $def_group));
else
	$arResult["GROUP_POLICY"] = CUser::GetGroupPolicy(array());

$arResult["SHOW_FIELDS"] = array_merge($arDefaultFields, $arParams["SHOW_FIELDS"]);
$arResult["REQUIRED_FIELDS"] = array_merge($arDefaultFields, $arParams["REQUIRED_FIELDS"]);

// use captcha?
$arResult["USE_CAPTCHA"] = COption::GetOptionString("main", "captcha_registration", "N") == "Y" ? "Y" : "N";

// start values
$arResult["VALUES"] = array();
$arResult["ERRORS"] = array();
$register_done = false;

// register user
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_REQUEST["register_submit_button"]) && !$USER->IsAuthorized())
{	//print_r($_REQUEST);
	
	if(COption::GetOptionString('main', 'use_encrypted_auth', 'N') == 'Y')
	{
		//possible encrypted user password
		$sec = new CRsaSecurity();
		if(($arKeys = $sec->LoadKeys()))
		{
			$sec->SetKeys($arKeys);
			$errno = $sec->AcceptFromForm(array('REGISTER'));
			if($errno == CRsaSecurity::ERROR_SESS_CHECK)
				$arResult["ERRORS"][] = GetMessage("main_register_sess_expired");
			elseif($errno < 0)
				$arResult["ERRORS"][] = GetMessage("main_register_decode_err", array("#ERRCODE#"=>$errno));
		}
	}

	// check emptiness of required fields
	foreach ($arResult["SHOW_FIELDS"] as $key)
	{
		if ($key != "PERSONAL_PHOTO" && $key != "WORK_LOGO")
		{
			$arResult["VALUES"][$key] = $_REQUEST["REGISTER"][$key];
			if (in_array($key, $arResult["REQUIRED_FIELDS"]) && trim($arResult["VALUES"][$key]) == '')
				$arResult["ERRORS"][$key] = GetMessage("REGISTER_FIELD_REQUIRED");
		}
		else
		{
			$_FILES["REGISTER_FILES_".$key]["MODULE_ID"] = "main";
			$arResult["VALUES"][$key] = $_FILES["REGISTER_FILES_".$key];
			if (in_array($key, $arResult["REQUIRED_FIELDS"]) && !is_uploaded_file($_FILES["REGISTER_FILES_".$key]["tmp_name"]))
				$arResult["ERRORS"][$key] = GetMessage("REGISTER_FIELD_REQUIRED");
		}
	}

	if(isset($_REQUEST["REGISTER"]["TIME_ZONE"]))
		$arResult["VALUES"]["TIME_ZONE"] = $_REQUEST["REGISTER"]["TIME_ZONE"];

	// check captcha
	if ($arResult["USE_CAPTCHA"] == "Y")
	{
		if (!$APPLICATION->CaptchaCheckCode($_REQUEST["captcha_word"], $_REQUEST["captcha_sid"]))
			$arResult["ERRORS"][] = GetMessage("REGISTER_WRONG_CAPTCHA");
	}

	if(strlen($arResult["VALUES"]["EMAIL"]) > 0 && COption::GetOptionString("main", "new_user_email_uniq_check", "N") === "Y")
	{
		$res = CUser::GetList($b, $o, array("=EMAIL" => $arResult["VALUES"]["EMAIL"]));
		if($res->Fetch())
			$arResult["ERRORS"][] = GetMessage("REGISTER_USER_WITH_EMAIL_EXIST", array("#EMAIL#" => htmlspecialcharsbx($arResult["VALUES"]["EMAIL"])));
	}

	if(count($arResult["ERRORS"]) > 0)
	{
		if(COption::GetOptionString("main", "event_log_register_fail", "N") === "Y")
		{
			$arError = $arResult["ERRORS"];
			foreach($arError as $key => $error)
				if(intval($key) == 0 && $key !== 0) 
					$arError[$key] = str_replace("#FIELD_NAME#", '"'.$key.'"', $error);
			CEventLog::Log("SECURITY", "USER_REGISTER_FAIL", "main", false, implode("<br>", $arError));
		}
	}
	else // if there;s no any errors - create user
	{
		$bConfirmReq = COption::GetOptionString("main", "new_user_registration_email_confirmation", "N") == "Y";

		$arResult['VALUES']["CHECKWORD"] = randString(8);
		$arResult['VALUES']["~CHECKWORD_TIME"] = $DB->CurrentTimeFunction();
		$arResult['VALUES']["ACTIVE"] = $bConfirmReq? "N": "Y";
		$arResult['VALUES']["CONFIRM_CODE"] = $bConfirmReq? randString(8): "";
		$arResult['VALUES']["LID"] = SITE_ID;

		$arResult['VALUES']["USER_IP"] = $_SERVER["REMOTE_ADDR"];
		$arResult['VALUES']["USER_HOST"] = @gethostbyaddr($REMOTE_ADDR);
		
		if($arResult["VALUES"]["AUTO_TIME_ZONE"] <> "Y" && $arResult["VALUES"]["AUTO_TIME_ZONE"] <> "N")
			$arResult["VALUES"]["AUTO_TIME_ZONE"] = "";

		$def_group = COption::GetOptionString("main", "new_user_registration_def_group", "");
		if($def_group != "")
			$arResult['VALUES']["GROUP_ID"] = explode(",", $def_group);

		$bOk = true;

		$GLOBALS["USER_FIELD_MANAGER"]->EditFormAddFields("USER", $arResult["VALUES"]);

		$events = GetModuleEvents("main", "OnBeforeUserRegister");
		while($arEvent = $events->Fetch())
		{
			if(ExecuteModuleEventEx($arEvent, array(&$arResult['VALUES'])) === false)
			{
				if($err = $APPLICATION->GetException())
					$arResult['ERRORS'][] = $err->GetString();

				$bOk = false;
				break;
			}
		}

		if ($bOk)
		{
			$user = new CUser();
			$ID = $user->Add($arResult["VALUES"]);
		}

		if (intval($ID) > 0)
		{
			$register_done = true;
			if (strlen($_REQUEST["subscribe"])>0) {
				CModule::IncludeModule("subscribe");
				$EMAIL = $_REQUEST["REGISTER"]["EMAIL"];
				$CITY = $_REQUEST["REGISTER"]["PERSONAL_CITY"];
				if ($CITY =="Москва" || $CITY =="Moscow" || $CITY =="москва"  || $CITY =="Moscow"  || $CITY =="vjcrdf" ||$CITY =="vjcrdf" || $CITY=="Vjcrdf" || $CITY=="moskau" || $CITY=="Мытищи" || $CITY=="Мытищи" || $CITY=="Химки") {
					$RUB_ID = array("18", "31");
				} elseif ($CITY =="Спб" || $CITY =="Spb" || $CITY =="Санкт-Петербург"  || $CITY =="Saint-Petersburg"  || $CITY =="Санкт Петербург" ||$CITY =="Saint Petersburg" || $CITY=="Питер" || $CITY=="Piter") {
					$RUB_ID = array("21", "31");
				} elseif ($CITY =="Омск" || $CITY =="Omsk" || $CITY =="Jvcr") {
					$RUB_ID = array("10", "31");
				} elseif ($CITY =="Киев" || $CITY =="Rbtd" || $CITY =="Kiev"  || $CITY =="Kiyv" || $CITY=="Kyiv") {
					$RUB_ID = array("9", "31");
				} elseif ($CITY =="Одесса" || $CITY =="Одеса" || $CITY =="Odesa"  || $CITY =="Odessa" || $CITY =="Jltccf") {
					$RUB_ID = array("12", "31");
				} elseif ($CITY =="Днепр" || $CITY =="Dnepr" || $CITY =="Днепропетровск"  || $CITY =="Lytgh" || $CITY =="Dnepropetovsk" || $CITY =="Lytgh") {
					$RUB_ID = array("13", "31");
				} elseif ($CITY =="Львов" || $CITY =="Lviv" || $CITY =="Lvov"  || $CITY =="Kmdjd" || $CITY =="Charkiv" || $CITY =="Lytgh" || $CITY =="Charkov" || $CITY =="Harkoiv" || $CITY =="Харьков" || $CITY =="{fhmrjd" || $CITY =="Полтава" || $CITY =="Poltava" || $CITY =="Chernigov" || $CITY =="Чернигов" || $CITY =="Ternopil" || $CITY =="Nthyjgjkm" || $CITY =="Тернополь") {
					$RUB_ID = array("23", "31");
				} elseif ($CITY =="Минск" || $CITY =="Minsk" || $CITY =="Vbycr"  || $CITY =="Могилёв" || $CITY =="Mogilev") {
					$RUB_ID = array("11", "31");
				} elseif ($CITY =="Петропавловск" || $CITY =="Petropavlovsk" || $CITY =="Pavlodar"  || $CITY =="Астана" || $CITY =="Astana" || $CITY =="Fcnfyf" || $CITY =="Алматы" || $CITY =="Алмата" || $CITY =="Алма-Ата" || $CITY =="Алма-ата" || $CITY =="Almaty" || $CITY =="Alma-ata" || $CITY =="Almati" || $CITY =="Almata" || $CITY =="Alma-Ata") {
					$RUB_ID = array("17", "31");
				} else {
					$RUB_ID = array("3", "31");
				}
				$us = $ID;
				$subscr = new CSubscription;
				$arFields = Array(
					"USER_ID" => $us,
					"FORMAT" => "html/text",
					"EMAIL" => $EMAIL,
					"ACTIVE" => "Y",
					"CONFIRMED" => "Y",
					"RUB_ID" => $RUB_ID,
					"SEND_CONFIRM" => "N"
				);
				if (strlen($EMAIL)>0) {
					$idsubrscr = $subscr->Add($arFields);
				}
				if($idsubrscr) {
				  $popuptitle = array("success"=>'Y');
				  $arSend["EMAIL"]=$EMAIL;
				  $arSend["MAIL_ID"] = $idsubrscr;
				  $arSend["MAIL_MD5"] = MyClass::GetMailHash($EMAIL);
				  CEvent::Send('MAIN_SUBSCRIBE', SITE_ID, $arSend, 'N', 142);
				}
		
			}
			// authorize user
			if ($arParams["AUTH"] == "Y" && $arResult["VALUES"]["ACTIVE"] == "Y")
			{
				if (!$arAuthResult = $USER->Login($arResult["VALUES"]["LOGIN"], $arResult["VALUES"]["PASSWORD"]))
					$arResult["ERRORS"][] = $arAuthResult;
			}

			$arResult['VALUES']["USER_ID"] = $ID;

			$arEventFields = $arResult['VALUES'];
			unset($arEventFields["PASSWORD"]);
			unset($arEventFields["CONFIRM_PASSWORD"]);

			$event = new CEvent;
			$event->SendImmediate("NEW_USER", SITE_ID, $arEventFields);
			if($bConfirmReq)
				$event->SendImmediate("NEW_USER_CONFIRM", SITE_ID, $arEventFields);
			LocalRedirect('/training/testing/38/32/');
		}
		else
		{
			$arResult["ERRORS"][] = $user->LAST_ERROR;
		}

		if(count($arResult["ERRORS"]) <= 0)
		{
			if(COption::GetOptionString("main", "event_log_register", "N") === "Y")
				CEventLog::Log("SECURITY", "USER_REGISTER", "main", $ID);
		}
		else
		{
			if(COption::GetOptionString("main", "event_log_register_fail", "N") === "Y")
				CEventLog::Log("SECURITY", "USER_REGISTER_FAIL", "main", $ID, implode("<br>", $arResult["ERRORS"]));
		}

		$events = GetModuleEvents("main", "OnAfterUserRegister");
		while ($arEvent = $events->Fetch())
			ExecuteModuleEventEx($arEvent, array(&$arResult['VALUES']));
	}
}

// if user is registered - redirect him to backurl or to success_page; currently added users too
if($register_done)
{
	if($arParams["USE_BACKURL"] == "Y" && $_REQUEST["backurl"] <> '')
		LocalRedirect($_REQUEST["backurl"]);
	elseif($arParams["SUCCESS_PAGE"] <> '')
		LocalRedirect($arParams["SUCCESS_PAGE"]);
}

$arResult["VALUES"] = htmlspecialcharsEx($arResult["VALUES"]);

// redefine required list - for better use in template
$arResult["REQUIRED_FIELDS_FLAGS"] = array();
foreach ($arResult["REQUIRED_FIELDS"] as $field)
	$arResult["REQUIRED_FIELDS_FLAGS"][$field] = "Y";

// check backurl existance
$arResult["BACKURL"] = htmlspecialcharsbx($_REQUEST["backurl"]);

// get countries list
if (in_array("PERSONAL_COUNTRY", $arResult["SHOW_FIELDS"]) || in_array("WORK_COUNTRY", $arResult["SHOW_FIELDS"])) 
	$arResult["COUNTRIES"] = GetCountryArray();

// get date format
if (in_array("PERSONAL_BIRTHDAY", $arResult["SHOW_FIELDS"])) 
	$arResult["DATE_FORMAT"] = CLang::GetDateFormat("SHORT");

// ********************* User properties ***************************************************
$arResult["USER_PROPERTIES"] = array("SHOW" => "N");
$arUserFields = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("USER", 0, LANGUAGE_ID);
if (is_array($arUserFields) && count($arUserFields) > 0)
{
	if (!is_array($arParams["USER_PROPERTY"]))
		$arParams["USER_PROPERTY"] = array($arParams["USER_PROPERTY"]);

	foreach ($arUserFields as $FIELD_NAME => $arUserField)
	{
		if (!in_array($FIELD_NAME, $arParams["USER_PROPERTY"]) && $arUserField["MANDATORY"] != "Y")
			continue;

		$arUserField["EDIT_FORM_LABEL"] = strLen($arUserField["EDIT_FORM_LABEL"]) > 0 ? $arUserField["EDIT_FORM_LABEL"] : $arUserField["FIELD_NAME"];
		$arUserField["EDIT_FORM_LABEL"] = htmlspecialcharsEx($arUserField["EDIT_FORM_LABEL"]);
		$arUserField["~EDIT_FORM_LABEL"] = $arUserField["EDIT_FORM_LABEL"];
		$arResult["USER_PROPERTIES"]["DATA"][$FIELD_NAME] = $arUserField;
	}
}
if (!empty($arResult["USER_PROPERTIES"]["DATA"]))
{
	$arResult["USER_PROPERTIES"]["SHOW"] = "Y";
	$arResult["bVarsFromForm"] = (count($arResult['ERRORS']) <= 0) ? false : true;
}
// ******************** /User properties ***************************************************

// initialize captcha
if ($arResult["USE_CAPTCHA"] == "Y")
	$arResult["CAPTCHA_CODE"] = htmlspecialcharsbx($APPLICATION->CaptchaGetCode());

// set title
if ($arParams["SET_TITLE"] == "Y") 
	$APPLICATION->SetTitle(GetMessage("REGISTER_DEFAULT_TITLE"));

//time zones
$arResult["TIME_ZONE_ENABLED"] = CTimeZone::Enabled();
if($arResult["TIME_ZONE_ENABLED"])
	$arResult["TIME_ZONE_LIST"] = CTimeZone::GetZones();

$arResult["SECURE_AUTH"] = false;
if(!CMain::IsHTTPS() && COption::GetOptionString('main', 'use_encrypted_auth', 'N') == 'Y')
{
	$sec = new CRsaSecurity();
	if(($arKeys = $sec->LoadKeys()))
	{
		$sec->SetKeys($arKeys);
		$sec->AddToForm('regform', array('REGISTER[PASSWORD]', 'REGISTER[CONFIRM_PASSWORD]'));
		$arResult["SECURE_AUTH"] = true;
	}
}

// all done
$this->IncludeComponentTemplate();
?>