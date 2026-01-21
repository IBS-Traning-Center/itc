<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


if (!CModule::IncludeModule("iblock")) return;

$curLevel = 1;
$parentID;
$arParams['ID_IBLOCK'] = 94;
$rootSectionId = -1;

$SectList = CIBlockSection::GetList($arSort, array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "CODE" => $_REQUEST["SECTION_CODE"], "ACTIVE"=>"Y") ,false, array("ID","IBLOCK_ID","IBLOCK_TYPE_ID","IBLOCK_SECTION_ID","CODE","SECTION_ID","NAME","SECTION_PAGE_URL"));
while ($SectListGet = $SectList->GetNext())
{
    $rootSectionId = $SectListGet['ID'];
}

$arFilter = array("IBLOCK_ID" => intval($arParams['ID_IBLOCK']),"ACTIVE" =>"Y", "SECTION_ID" =>  $rootSectionId, "GLOBAL_ACTIVE" => "Y");
$rs_section = CIBlockSection::GetList(Array("DEPTH_LEVEL" => "ASC"), $arFilter, true, Array("UF_*", "DETAIL_PAGE_URL"));
while($ar_section = $rs_section->Fetch())
{
    //   if(in_array($ar_section['ID'], $debugArray) ) { // убрать это ограничение!
    $ar_section["DETAIL_PAGE_URL"] = preg_replace("/\#CODE\#/", $ar_section["CODE"], $ar_section["SECTION_PAGE_URL"]);
    $arResult["SECTIONS"][$ar_section["ID"]] = $ar_section;
    if ($ar_section["DEPTH_LEVEL"] > 0) {
        $arFilterCountElements = Array(
            "IBLOCK_ID" => $arParams["ID_IBLOCK"],
            "ACTIVE" => "Y",
            "SECTION_ID" => $ar_section["ID"],
            "INCLUDE_SUBSECTIONS" => "Y",
            "SECTION_GLOBAL_ACTIVE" => "Y",
            "SECTION_ACTIVE" => "Y",
            "PROPERTY_PP_COURSE.ACTIVE" => "Y"
        );
        $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilterCountElements, Array(), false, Array('ID','NAME'));
        $arResult["SECTIONS"][$ar_section["ID"]]["ELEMENT_CNT"] = $res;
    }
}

$arFilter = array("IBLOCK_ID" => intval($arParams['ID_IBLOCK']), "ACTIVE" =>"Y", "SECTION_GLOBAL_ACTIVE" =>"Y", "SECTION_ACTIVE" =>"Y", "PROPERTY_PP_COURSE.ACTIVE" => "Y"); /*"ACTIVE" =>"Y"*/
$arSelect = array("IBLOCK_ID", "IBLOCK_TYPE", "ID","NAME","PROPERTY_PP_COURSE","PROPERTY_PP_COURSE.NAME","PROPERTY_PP_COURSE.ACTIVE", "PROPERTY_PP_COURSE", "PROPERTY_PP_COURSE.CODE", "PROPERTY_PP_COURSE.XML_ID", "SORT", "IBLOCK_SECTION_ID");
$rs_element = CIBlockElement::GetList(Array("SORT"=> "ASC", "PROPERTY_PP_COURSE.CODE" => "ASC"), $arFilter, false, false, $arSelect);
while($ar_element = $rs_element->GetNext(false, false))
{
    $arSelectCourse = array("ID","PROPERTY_COURSE_DURATION","PROPERTY_COURSE_PRICE", "PROPERTY_SHORT_DESCR", "PROPERTY_change_link","PROPERTY_COURSE_PRICE_UA","PROPERTY_NEW_ICON");
    $arFilterCourse = array("IBLOCK_ID" =>6, "ID" => $ar_element["PROPERTY_PP_COURSE_VALUE"]);
    $rs_elementCourse = CIBlockElement::GetList(array("SORT"=> "ASC"), $arFilterCourse, false, false, $arSelectCourse);
    while($ar_elementCourse = $rs_elementCourse->GetNext(false, false))
    {
        $ar_element['PARAM']  =  $ar_elementCourse;
    }
    $arResult["ELEMENTS"][$ar_element['ID']] = $ar_element;
 }
