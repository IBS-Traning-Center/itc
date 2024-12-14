<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
foreach($arResult["ITEMS"] as $arItem){
	if ($arItem['PROPERTIES'][trener]['VALUE']){
		$arSelect = Array("NAME", "PROPERTY_expert_name", "CODE", "ACTIVE");
		$arFilter = Array("IBLOCK_ID"=>D_EXPERT_ID_IBLOCK, "ID"=>$arItem['PROPERTIES'][trener]['VALUE']);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
			$arResult['TRENER_INFO'][$arItem['ID']] = $ar_fields;
		}	
	}
}
//iwrite($arResult['TRENER_INFO']);
?>