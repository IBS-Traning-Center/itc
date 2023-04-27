<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><br /><br /> 
<?$APPLICATION->IncludeComponent(
	"bitrix:advertising.banner",
	"",
	Array(
		"TYPE" => "INT_EVENTS",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "0"
	),
false
);?>
<br/>
<?/*$APPLICATION->IncludeComponent("bitrix:form.result.new", "opinion", array(
	"WEB_FORM_ID" => "13",
	"IGNORE_CUSTOM_TEMPLATE" => "Y",
	"USE_EXTENDED_ERRORS" => "Y",
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "3600",
	"LIST_URL" => "",
	"EDIT_URL" => "",
	"SUCCESS_URL" => "",
	"CHAIN_ITEM_TEXT" => "",
	"CHAIN_ITEM_LINK" => ""
	),
	false
);?>
<br />
<?*/?>
<?$APPLICATION->IncludeComponent(
	"bitrix:advertising.banner",
	"",
	Array(
		"TYPE" => "INT_EVENTS_SEC",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "0"
	),
false
);?>