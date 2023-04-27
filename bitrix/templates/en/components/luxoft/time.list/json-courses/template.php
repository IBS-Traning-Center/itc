<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?foreach ($arResult["ITEMS"] as $key=>$arItem) {?>
	<?$arRet[$key]["NAME"]= iconv("windows-1251", "UTF-8", $arItem["NAME"]);	
	$arRet[$key]["LINK"] = "http://www.luxoft-training.ru".$arItem["DETAIL_PAGE_URL"].'&r1=hashcode&r2=widget';
	$arRet[$key]["TIME"] = $arItem["PROPERTY_STARTDATE_VALUE"];
	$arRet[$key]["CITY"] = iconv("windows-1251", "UTF-8", $arItem["PROPERTIES"]["city"]["TEXT"]);
	?>
<?}?>
<?$APPLICATION->RestartBuffer();?>
<?echo json_encode($arRet)?>
<?die()?>

