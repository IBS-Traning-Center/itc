<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?foreach($arResult["ITEMS"] as $arItem):?>
<?
  		if  ($arItem["PROPERTIES"]["client"]["VALUE"]>0) {
	  		$arSelect = Array("NAME", "PROPERTY_TEXT_CITY");
			$arFilter = Array("IBLOCK_ID"=>D_CLIENTS_REFERENCE,"ID"=>$arItem["PROPERTIES"]["client"]["VALUE"]);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ar_fields = $res->GetNext())
			{
		 		//print_r($ar_fields);
		 		$arResult['CLIENTS'][$arItem['ID']]['NAME'] = $ar_fields["NAME"];
		 		$arResult['CLIENTS'][$arItem['ID']]['CITY'] = $ar_fields["PROPERTY_TEXT_CITY_VALUE"];
			}
		}
		//iwrite($arResult['CLIENTS']);
?>
<?endforeach;?>

