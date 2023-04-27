<?
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>

<?$APPLICATION->IncludeComponent(
    "luxoft:adv.banners",
    "",
    Array(
        "TYPE" => "VINGRAD",
   )
);	
?>
<?/*$APPLICATION->IncludeComponent(
	"bitrix:advertising.banner",
	"",
	Array(
		"TYPE" => "VINGRAD",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "300"
	)
);*/?>

