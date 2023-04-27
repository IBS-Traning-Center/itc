<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach($arResult["ITEMS"] as $key=>$arItem) {
	$arSelect = Array("ID",  "PROPERTY_SCHEDULE_COURSE.NAME");
	$arFilter = Array("IBLOCK_ID"=>9, "ID"=>$arItem["PROPERTIES"]["SCH_COURSE"]["VALUE"]);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	if ($ob = $res->GetNextElement()) {
		$arFields=$ob->GetFields();
		$arResult["ITEMS"][$key]["COURSE_NAME"]=$arFields["PROPERTY_SCHEDULE_COURSE_NAME"];
	}
}?>