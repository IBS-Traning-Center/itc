<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


if (!CModule::IncludeModule("iblock")) return;
if (intval($arParams['ID_IBLOCK'])) {} else {die();}

$arFilter = array("IBLOCK_ID" => intval($arParams['ID_IBLOCK']), "SECTION_CODE"=> $arParams["SECTION_CODE"],"ACTIVE" =>"Y", "SECTION_GLOBAL_ACTIVE" =>"Y", "SECTION_ACTIVE" =>"Y", "PROPERTY_PP_COURSE.ACTIVE" => "Y");
if ($arParams["SECTION_CODE"]=="upravlencheskaya_effektivnost_i_kommunikatsii") {
    $arFilter["INCLUDE_SUBSECTIONS"]="Y";
}
$arSelect = array("IBLOCK_ID", "IBLOCK_TYPE", "ID","NAME","PROPERTY_PP_COURSE","PROPERTY_PP_COURSE.NAME","PROPERTY_PP_COURSE.ACTIVE", "PROPERTY_PP_COURSE.CODE", "SORT", "IBLOCK_SECTION_ID");
$rs_element = CIBlockElement::GetList(Array("SORT" => "ASC", "PROPERTY_PP_COURSE.CODE" => "ASC"), $arFilter, false, false, $arSelect);
while($ar_element = $rs_element->GetNext(false, false))
{
    $arSelectCourse = array("ID","PROPERTY_COURSE_DURATION","PROPERTY_COURSE_PRICE", "PROPERTY_SHORT_DESCR", "PROPERTY_change_link", "PROPERTY_COURSE_PRICE_UA", "PROPERTY_NEW_ICON","PROPERTY_ICON_SALE","PROPERTY_ICON_SALE_LINK","PROPERTY_COMPLEXITY");
    $arFilterCourse = array("IBLOCK_ID" =>6, "ID" => $ar_element["PROPERTY_PP_COURSE_VALUE"]);
    $rs_elementCourse = CIBlockElement::GetList(array('NAME' => 'ASC'), $arFilterCourse, false, false, $arSelectCourse);
    while($ar_elementCourse = $rs_elementCourse->GetNext(false, false))
    {
        $ar_element['PARAM']  =  $ar_elementCourse;
    }

    $arResult["ELEMENTS"][] = $ar_element;


}



$arResult["ITEMS"] = $arResult["ELEMENTS"];
//print_r($arResult["ITEMS"]);


//iwrite($arResult["ITEMS"]);
?>
