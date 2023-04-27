<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?foreach ($arResult["ITEMS"] as $key=>$arItem) {?>
	<?$arRet[$key]["NAME"]= /*iconv("windows-1251", "UTF-8", */$arItem["NAME"]/*)*/;	
	$arRet[$key]["LINK"] = $arItem["DETAIL_PAGE_URL"]."&r1=hashcode&r2=widget";
	$arRet[$key]["TIME"] = $arItem["PROPERTY_STARTDATE_VALUE"];
	$arRet[$key]["CITY"] = /*iconv("windows-1251", "UTF-8", */$arItem["PROPERTIES"]["city"]["TEXT"]/*)*/;
	?>
<?}?>
<?//$APPLICATION->RestartBuffer();?>
<?echo iconv("UTF-8", "windows-1251", $_REQUEST["tag"]);?>
<?echo "<pre>"?>
<?print_r(($arRet))?>

