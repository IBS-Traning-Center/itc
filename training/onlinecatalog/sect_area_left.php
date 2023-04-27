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