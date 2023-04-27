<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (((!isset($_REQUEST["XML_ID"]) and (isset($_REQUEST["ID_TIME"]))))) {
	if (CModule::IncludeModule("iblock")){
		$arFilter = Array("IBLOCK_ID"=>D_TIMETABLE_ID_IBLOCK, "ID" =>$_REQUEST["ID_TIME"]);
		$res = CIBlockElement::GetList(array(), $arFilter, false, array(), array("PROPERTY_SCHEDULE_COURSE.ID", "PROPERTY_SCHEDULE_COURSE.XML_ID"));
		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
		
			$addit="";
			$arUri=preg_split("#\?#", $APPLICATION->GetCurPageParam("", array("ID")));
			$addit="";
			if (strlen($arUri[1])) {
				$addit="?".$arUri[1];
			}
			//$addit="";
			//$arUri=preg_split("#\?#", $APPLICATION->GetCurPageParam("ID=".$arFields["PROPERTY_SCHEDULE_COURSE_ID"], array()));
			//if (!$USER->IsAdmin()) {
			//	$curPage = $APPLICATION->GetCurPageParam("XML_ID=".$arFields["PROPERTY_SCHEDULE_COURSE_XML_ID"], array());
			//} else {
				$curPage= "/kurs/".$arFields["PROPERTY_SCHEDULE_COURSE_XML_ID"].".html".$addit;
				
			//}
			
			LocalRedirect($curPage, false, '301 Moved permanently');
		}
	}
} 


if(!isset($arParams["CACHE_TIME"])) {
	$arParams["CACHE_TIME"] = 3600;
}
CPageOption::SetOptionString("main", "nav_page_in_session", "N");
if($arParams["IBLOCK_ID"] < 1) {
	ShowError("IBLOCK_ID IS NOT DEFINED");
	return false;
}

if(!isset($arParams["ITEMS_LIMIT"])) {
	$arParams["ITEMS_LIMIT"] = 10;
}

$arNavParams = array();
$arNavigation = CDBResult::GetNavParams($arNavParams);

if($this->StartResultCache(false, array($arNavigation)))
{

	if(!CModule::IncludeModule("iblock")) {
		$this->AbortResultCache();
		ShowError("IBLOCK_MODULE_NOT_INSTALLED");
		return false;
	}	

	$arSort = array();
    $arFilter = array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arParams["ELEMENT_ID"]);
	$arSelect = array("ID", "PROPERTY_ID_LINKED_COURSES", "PROPERTY_course_test_link", "PROPERTY_show_one_price", "PROPERTY_ukraine_only", "PROPERTY_ID_PREDV_COURSES", "PROPERTY_SHORT_DESCR", "PREVIEW_PICTURE", "DETAIL_PICTURE");

	$rsElement = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);


	while($obElement = $rsElement->GetNextElement()) {
		$arElement = $obElement->GetFields();
		//$arElement["PROPERTIES"] = $obElement->GetProperties();
		$arResult['COURSE_INFO']['COUNT_LINKED_COURSES'] =  count($arElement['PROPERTY_ID_LINKED_COURSES_VALUE']);
		$arResult['COURSE_INFO']['COUNT_PREDV_COURSES'] =  count($arElement['PROPERTY_ID_PREDV_COURSES_VALUE']);
		$arResult['COURSE_INFO']['TEST_LINK'] = $arElement['PROPERTY_COURSE_TEST_LINK_VALUE'];
		$arResult['COURSE_INFO']['SHOW_ONE_PRICE'] = $arElement['PROPERTY_SHOW_ONE_PRICE_VALUE'];
		$arResult['COURSE_INFO']['SHOW_UKRANIAN_ONLY'] = $arElement['PROPERTY_UKRAINE_ONLY_VALUE'];
        $arResult['COURSE_INFO']["DESCRIPTION"]= $arElement['PROPERTY_SHORT_DESCR_VALUE'];
        if (intval($arElement['PREVIEW_PICTURE'])>0) {
            $arResult['COURSE_INFO']["PREVIEW_PICTURE"]= CFile::GetFileArray($arElement['PREVIEW_PICTURE']);
        }
		if (intval($arElement['DETAIL_PICTURE'])>0) {
            $arResult['COURSE_INFO']["DETAIL_PICTURE"]= CFile::GetFileArray($arElement['DETAIL_PICTURE']);
        }
	}
	/*
		get count of feedbacks
	*/
	$arFilter = array("IBLOCK_ID" => 94, "PROPERTY_PP_COURSE" => $arElement["ID"]);
	$arSelect = array("ID", "IBLOCK_SECTION_ID");
	$rsElement = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
	if ($arNewElement = $rsElement->GetNext())
	{
		$arResult['COURSE_INFO']["SECTION_INFO"]=GetIblockSection($arNewElement["IBLOCK_SECTION_ID"]);
	}
	
	$arFilter = array("IBLOCK_ID" => D_CLIENTS_FEEDBACK, "PROPERTY_COURSE" => $arParams["ELEMENT_ID"], "ACTIVE" =>"Y");	
	$arResult['COURSE_INFO']['COUNT_FEEDBACK'] = CIBlockElement::GetList(array(), $arFilter, array(), false, array("ID"));	

	$arResult['COURSE_INFO']['TIMETABLE_INFO'] = GetAllTimetableCoursesArray($arParams["ELEMENT_ID"]);
	$arResult['COURSE_INFO']['COUNT_TIMETABLE_COURSE'] = count($arResult['COURSE_INFO']['TIMETABLE_INFO'][0]['TIMETABLE']);
	
	
	$this->SetResultCacheKeys(array(
		"ID",
		"IBLOCK_ID",
		"NAV_CACHED_DATA",
		"NAME",
		"IBLOCK_SECTION_ID",
		"IBLOCK",
		"LIST_PAGE_URL", 
		"~LIST_PAGE_URL",
		"SECTION",
		"PROPERTIES",
		"COURSE_INFO",
		));
	//$this->IncludeComponentTemplate();
	$this->EndResultCache();
}
	return $arResult['COURSE_INFO'];
	
?>