<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?foreach ($arResult["ITEMS"] as $key=>$arItem) {?>
	<?$arRet[$key]["NAME"]= $arItem["NAME"];
	$arRet[$key]["LINK"] = $arItem["DETAIL_PAGE_URL"]."&r1=hashcode&r2=widget";
	$arRet[$key]["TIME"] = $arItem["PROPERTY_STARTDATE_VALUE"];
	$arRet[$key]["CITY"] = $arItem["PROPERTIES"]["city"]["TEXT"];
	?>
<?}?>
<?//$APPLICATION->RestartBuffer();?>
<?echo $_REQUEST["tag"];?>
<?echo "<pre>"?>
<?print_r(($arRet))?>

