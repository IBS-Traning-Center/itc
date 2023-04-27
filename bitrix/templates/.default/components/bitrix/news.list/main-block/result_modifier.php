<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$flag="N";
$last_city="";
CModule::IncludeModule("catalog");
foreach($arResult["ITEMS"] as $key=>$arItem):
	$res = CIBlockElement::GetByID($arItem["PROPERTIES"]["city"]["VALUE"]);
	if($ar_res = $res->GetNext()) {
		$arResult["ITEMS"][$key]["PROPERTIES"]["city"]["TEXT"]=$ar_res["NAME"];
	}
	$arDiscounts = CCatalogDiscount::GetDiscountByProduct(
        $arItem["ID"],
        $USER->GetUserGroupArray(),
        "N",
        array(1,2,3),
        SITE_ID
    );
	/*if ($USER->isAdmin()) {
		//print_r($arDiscounts[0]["VALUE"]);
	}*/
	if (intval($arDiscounts[0]["VALUE"])>0) {
		$arResult["ITEMS"][$key]["DISCOUNT"]=intval($arDiscounts[0]["VALUE"]);
		$arResult["ITEMS"][$key]["DISCOUNT_TYPE"]=$arDiscounts[0]["VALUE_TYPE"];
		$arResult["ITEMS"][$key]["PRICE"]= CCatalogProduct::GetOptimalPrice($arItem["ID"], 1, $USER->GetUserGroupArray(), "N");
	}
	if ($USER->IsAdmin()) {
		//echo "<pre>";
		//print_r($arResult["ITEMS"][$key]["PRICE"]);
		//echo "</pre>";
	}
endforeach?>

<?
$arResult["MULTI_CITY"]="Y";

?>