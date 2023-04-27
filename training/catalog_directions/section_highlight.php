<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->IncludeComponent(
    "luxoft:super.component",
    "info.courses.bysection",
    Array(
        "CACHE_TYPE" => "N",
        "CACHE_TIME" => "3600",
        "ID_IBLOCK"=> 94,
        "SECTION_CODE" => "{$_REQUEST['SECTION_CODE']}"
    )
);?>
 