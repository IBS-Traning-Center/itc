<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)die();?><?
if (CModule::IncludeModule("iblock")):
//iwrite($arResult);

 	//$APPLICATION->SetPageProperty("title",  $arResult["PROPERTIES"]["parent_section_name"]["VALUE"].". ".$arResult["NAME"]);
	//$APPLICATION->SetPageProperty("blue_title", $arResult["PROPERTIES"]["parent_section_name"]["VALUE"].". ".$arResult["NAME"]);
 	$APPLICATION->SetPageProperty("title",  $arResult["NAME"]);
	$APPLICATION->SetPageProperty("blue_title", $arResult["NAME"]);
endif;
?>