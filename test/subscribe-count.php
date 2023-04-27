<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?$APPLICATION->IncludeComponent("bitrix:subscribe.index", ".default", array(
	"SHOW_COUNT" => "Y",
	"SHOW_HIDDEN" => "Y",
	"PAGE" => "#SITE_DIR#personal/subscribe/subscr_edit.php",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "",
	"SET_TITLE" => "Y"
	),
	false
);?>