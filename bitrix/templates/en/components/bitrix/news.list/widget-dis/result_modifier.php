<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$flag="N";
$last_city="";
foreach($arResult["ITEMS"] as $key=>$arItem):
	$res = CIBlockElement::GetByID($arItem["PROPERTIES"]["city"]["VALUE"]);
	if($ar_res = $res->GetNext()) {
		$arResult["ITEMS"][$key]["PROPERTIES"]["city"]["TEXT"]=$ar_res["NAME"];
	}
	$res = CIBlockElement::GetByID($arItem["PROPERTIES"]["schedule_course"]["VALUE"]);
	if($ar_res = $res->GetNext()) {
		$arResult["ITEMS"][$key]["NAME"]=$ar_res["NAME"];
	}
	
endforeach?>

<?if ($arParams["UKR"]=="Y") {
	$arResult["MULTI_CITY"]="Y";
} else {
	$arResult["MULTI_CITY"]="N";
}?>