<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)die();?><?
if (CModule::IncludeModule("iblock")):
//iwrite($arResult);
$res = CIBlockSection::GetList(Array(), Array("IBLOCK_ID"=>76, "ID"=>$arParams['SECTION_ID'], "CODE"=>$arParams['SECTION_CODE']), false);
//$res = CIBlockSection::GetByID($arParams['SECTION_ID']);
if($ar_res = $res->GetNext()){
	$arResult['SECTION_NAME']  = $ar_res['NAME'];
}
 	$APPLICATION->SetPageProperty("title", $arResult["SECTION_NAME"]);
	$APPLICATION->SetPageProperty("blue_title", $arResult["SECTION_NAME"]);

endif;
?>