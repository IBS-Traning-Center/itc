<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

global $APPLICATION;
    $APPLICATION->AddChainItem("Catalogue of IT courses", "/catalogue/");
    $APPLICATION->AddChainItem($arResult["NAME"]);
	

	//print_r($arResult["PROPERTIES"]);
	if (strlen($arResult["PROPERTIES"]["TITLE"]["VALUE"])) {
		$APPLICATION->SetPageProperty("title", $arResult["PROPERTIES"]["TITLE"]["VALUE"]);
	}
	if (strlen($arResult["PROPERTIES"]["META_DESCR"]["VALUE"])) {
		$APPLICATION->SetPageProperty("description", $arResult["PROPERTIES"]["META_DESCR"]["VALUE"]);
	}
	if (strlen($arResult["PROPERTIES"]["META_KEYWORDS"]["VALUE"])) {
		$APPLICATION->SetPageProperty("keywords", $arResult["PROPERTIES"]["META_KEYWORDS"]["VALUE"]);
	}?>
	<?if (strlen($arResult["PROPERTIES"]["PIXEL_ID"]["VALUE"])>0 && $_REQUEST["addok"]=="Y") {?>
		<?$APPLICATION->AddHeadString($arResult["PROPERTIES"]["PIXEL_ID"]["VALUE"], true)?>
	<?}?>
