<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


if (!CModule::IncludeModule("iblock")) return;
//iwrite($arParams);

$vCurrentDate = date("Y-m-d");
$arCities = array(CITY_ID_MOSCOW, CITY_ID_SPB, CITY_ID_OMSK, CITY_ID_KIEV, CITY_ID_DNEPR, CITY_ID_ODESSA, CITY_ID_ONLINE);
if ($arParams['INCLUDE_CLASSES'] === "Y") {
	$vFromDate = date("Y-m-d");
	$vToDate = date("Y-m-d", mktime(0,0,0,date("m"), date("d") + $arParams['COUNT_DAYS_CLASS'], date("Y")));
	$arSelect = Array("ID", "NAME", "PROPERTY_CITY.NAME", "PROPERTY_CITY.ID", "PROPERTY_STARTDATE", "PROPERTY_ENDDATE", "PROPERTY_PRSCHEDULE_DURATION", "PROPERTY_PRSCHEDULE_PRICE" );
	$arFilter = Array(
	"IBLOCK_ID"=>D_TIMETABLECLASSES_ID_IBLOCK,
	"ACTIVE"=>"Y",
	">=PROPERTY_STARTDATE" => $vFromDate,
	"<=PROPERTY_STARTDATE" => $vToDate,
	"PROPERTY_CITY" => $arCities
	);
	$arOrder = Array("PROPERTY_STARTDATE" =>"ASC");
	$res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		$arResult['CLASSSES'][] = bitrixCleaningArray($arFields);	  
	}
}


if ($arParams['INCLUDE_COURSES'] === "Y") {
	$vFromDate = date("Y-m-d", mktime(0,0,0,date("m"), date("d") + $arParams['COUNT_DAYS_COURSE_BEGIN'], date("Y")));
	$vToDate = date("Y-m-d", mktime(0,0,0,date("m"), date("d") + $arParams['COUNT_DAYS_COURSE_END'], date("Y")));
	$arSelect = Array("ID", "NAME", "PROPERTY_CITY.NAME", "PROPERTY_CITY.ID", "PROPERTY_STARTDATE",
	"PROPERTY_ENDDATE", "PROPERTY_SCHEDULE_DURATION", "PROPERTY_PRICE", "PROPERTY_SCHEDULE_COURSE",
	"PROPERTY_SCHEDULE_COURSE.NAME", "PROPERTY_SCHEDULE_COURSE.CODE", "PROPERTY_TEACHER");
	$arFilter = Array(
		"IBLOCK_ID"=>D_TIMETABLE_ID_IBLOCK,
		"ACTIVE"=>"Y",
		">=PROPERTY_STARTDATE" => $vFromDate,
		"<=PROPERTY_STARTDATE" => $vToDate,
		"PROPERTY_CITY" => $arCities
	);
	$arOrder = Array("PROPERTY_CITY" =>"ASC", "PROPERTY_STARTDATE" =>"ASC");
	$res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		$arFields = bitrixCleaningArray($arFields);
		
 		$arSelect = Array("PROPERTY_IS_CLASS", "PROPERTY_COURSE_IDCATEGORY", "PROPERTY_ID_COURSE_OWNER", "ID");
		$arFilter = Array("IBLOCK_ID"=>D_COURSE_ID_IBLOCK, "ID"=>$arFields['SCHEDULE_COURSE']);

		$res2 = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res2->GetNext())
		{
	 		$course_id_category= $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
	 		$courseOwnerID = $ar_fields["PROPERTY_ID_COURSE_OWNER_ENUM_ID"];
	 		$bIs_Class = $ar_fields["PROPERTY_IS_CLASS_ENUM_ID"] === "135" ? true : false;
		}		
		if ($arFields['TEACHER']){
			$arFields['TEACHER_INFO'] = GetInfoAboutExpertByID($arFields['TEACHER']);
		}
		if (!$bIs_Class){
			$arResult['COURSES'][] = $arFields;	
		}	else {
			$arResult['COURSES_AS_CLASS'][] = $arFields;	
		}	
	}
}
if ($arParams['INCLUDE_EVENTS'] === "Y") {
	$vFromDate = date("Y-m-d");
	$vToDate = date("Y-m-d", mktime(0,0,0,date("m"), date("d") + $arParams['COUNT_DAYS_EVENT'], date("Y")));
	$arSelect = Array("ID", "NAME", "PROPERTY_CITY.NAME", "PROPERTY_CITY.ID", "PROPERTY_STARTDATE",   "PROPERTY_LOCATION", "PROPERTY_TYPE_EVENT", "PROPERTY_TIME", "PROPERTY_TRENER");
	$arFilter = Array(
	"IBLOCK_ID"=>D_SEMINARS_IBLOCK,
	"ACTIVE"=>"Y", ">=PROPERTY_STARTDATE" => $vFromDate,
	"<=PROPERTY_STARTDATE" => $vToDate,
	"PROPERTY_CITY" => $arCities
	);
	$arOrder = Array("PROPERTY_STARTDATE" =>"ASC");
	$res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		$arFields = bitrixCleaningArray($arFields);
		if ($arFields['TRENER']){
			$arFields['TEACHER_INFO'] = GetInfoAboutExpertByID($arFields['TRENER']);
		}
		if ($arFields['TYPE_EVENT_ENUM_ID'] == 92){
			$arResult['WEBINARS'][] = $arFields;
		} else {
			$arResult['SEMINARS'][] = $arFields;		
		}	  
	}
}


//iwrite($arResult);
?>

