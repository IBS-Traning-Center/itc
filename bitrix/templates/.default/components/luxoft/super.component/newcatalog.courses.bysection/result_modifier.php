<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!CModule::IncludeModule("iblock")) return;

//iwrite($arParams);



if ((intval($arParams['SECTION_ID'])) or 	(isset($arParams['SECTION_CODE']))	){

} else {
	LocalRedirect("/404.html");
}

$arSummaCourse = Array();
$arSelect = Array("ID", "NAME", "IBLOCK_SECTION_ID", "PROPERTY_PP_COURSE");

$arFilter = Array("IBLOCK_ID"=>76, "ACTIVE"=>"Y", "SECTION_ID"=>$arParams['SECTION_ID'], "INCLUDE_SUBSECTIONS"=>"Y", "SECTION_CODE"=>$arParams['SECTION_CODE']);
//iwrite($arFilter);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
$index = 0;
while($ob = $res->GetNextElement())
{
  $arFields = $ob->GetFields();
  $index = $index + 1;
  if (!in_array($arFields['PROPERTY_PP_COURSE_VALUE'], $arSummaCourse)) {
	$arSummaCourse[] = $arFields['PROPERTY_PP_COURSE_VALUE'];
  }
}
if ($index === 0) {
	LocalRedirect("/404.html");
}
$res = CIBlockSection::GetList(Array(), Array("IBLOCK_ID"=>76, "ID"=>$arParams['SECTION_ID'], "CODE"=>$arParams['SECTION_CODE']), false);
if($ar_res = $res->GetNext()){
	$arResult['SECTION_NAME']  = $ar_res['NAME'];
	$arResult['INFO'] = $ar_res;
	$arResult['ID_SECTION'] = $ar_res['ID'];
}



if (count($arSummaCourse)>0){
//echo "count=".count($arSummaCourse);
//iwrite($arSummaCourse);
		$arSelect = array(
		 "ID",
		 "PROPERTY_course_duration",
		 "PROPERTY_course_price",
		 "PROPERTY_course_code",
		 "NAME"
		 );
		$arFilter = array("IBLOCK_ID"=>6, "ACTIVE"=> "", "ID" => $arSummaCourse);
		$res = CIBlockElement::GetList(array("CODE"=>"ASC"), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$ar_fields = $ob->GetFields();
			$arResult['ITEMS'][] = $ar_fields;
		}

}


//$component->SetResultCacheKeys(array('ITEMS', 'SECTION_NAME'));


$arSelect = Array("ID", "NAME", "IBLOCK_SECTION_ID", "PROPERTY_PRSCHEDULE_PRICE", "PROPERTY_PRSCHEDULE_DURATION" ,"PROPERTY_STARTDATE", "PROPERTY_ENDDATE", "PROPERTY_CITY.NAME", "PROPERTY_CITY");
$arFilter = Array("IBLOCK_ID"=>10, "ACTIVE"=>"Y", "ACTIVE_DATE"=>"Y", "=PROPERTY_PRSCHEDULE_PROGRAM" =>$arResult['ID_SECTION'], ">=PROPERTY_STARTDATE" => date("d.m.Y"), "<=PROPERTY_ENDDATE" => date("d.m.Y"));
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
	$arFields = $ob->GetFields();
    //iwrite($arFields);
    $arResult['RECORDS'][] = $arFields;
}
	$arResult["arCityInfo"] = GetAllActiveCitiesInfo();


	global  $arEventInfo ;
	$arEventInfo["NAME"] = $arResult["SECTION_NAME"];
	$arEventInfo["CODE"] = "";
	$arEventInfo["DATE"] = "";
	$arEventInfo["TYPE_ID"] = 79;
	$arEventInfo["EVENT_CITY"] = "";
	//iwrite($arEventInfo);



?>