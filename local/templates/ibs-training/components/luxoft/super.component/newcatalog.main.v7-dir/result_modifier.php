<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


if (!CModule::IncludeModule("iblock")) return;
if (intval($arParams['ID_IBLOCK'])) {} else {die();}
/***********
 * ??????? *
 ***********/
$arFilter = array("IBLOCK_ID" => intval($arParams['ID_IBLOCK']),"ACTIVE" =>"Y", "GLOBAL_ACTIVE" => "Y","DEPTH_LEVEL" => '1'); /*"ACTIVE" =>"Y"*/
$rs_section = CIBlockSection::GetList(Array("LEFT_MARGIN" => "ASC"), $arFilter, true, Array("UF_*", "DETAIL_PAGE_URL"));
while($ar_section = $rs_section->Fetch())
{
    $ar_section["DETAIL_PAGE_URL"]=preg_replace("/\#CODE\#/", $ar_section["CODE"], $ar_section["SECTION_PAGE_URL"]);
    $arResult["SECTIONS"][$ar_section["ID"]] = $ar_section;
    if ($ar_section["DEPTH_LEVEL"] > 0 ){
        $arFilterCountElements = Array(
            "IBLOCK_ID"=>$arParams["ID_IBLOCK"],
            "ACTIVE"=>"Y",
            "SECTION_ID"=>$ar_section["ID"],
            "INCLUDE_SUBSECTIONS"=>"Y",
            "SECTION_GLOBAL_ACTIVE" =>"Y",
            "SECTION_ACTIVE" =>"Y",
            "PROPERTY_PP_COURSE.ACTIVE" => "Y"
        );
        $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilterCountElements, false, false, Array('IBLOCK_ID', 'ID'));
        $arResult["SECTIONS"][$ar_section["ID"]]["ELEMENT_CNT"] = 0;
        while($ELEMENTS_SECTION_ID = $res->GetNext()) {
            $arResult["SECTIONS"][$ar_section["ID"]]["ELEMENT_CNT"]++;
            $arResult['ELEMENTS_SECTION_ID'][$ELEMENTS_SECTION_ID['ID']] = $ar_section["ID"];
        };
    }
    /*
            if ($ar_section["DEPTH_LEVEL"] == 1){
                $arSummaCourse = Array();
                $arSelectC = Array("ID", "NAME", "IBLOCK_SECTION_ID", "PROPERTY_PP_COURSE");
                $arFilterC = Array("IBLOCK_ID"=>$arParams["ID_IBLOCK"], "ACTIVE"=>"Y", "SECTION_ID"=>$ar_section["ID"], "INCLUDE_SUBSECTIONS"=>"Y");
                $res = CIBlockElement::GetList(Array(), $arFilterC, false, Array("nPageSize"=>50), $arSelectC);
                $index = 0;
                while($ob = $res->GetNextElement())
                {
                    $arFields = $ob->GetFields();
                    $index = $index + 1;
                    if (!in_array($arFields['PROPERTY_PP_COURSE_VALUE'], $arSummaCourse)) {
                        $arSummaCourse[] = $arFields['PROPERTY_PP_COURSE_VALUE'];
                    }
                }
                echo count($arSummaCourse);
                echo "<br />";
            }
    */
}

//iwrite($arResult["SECTIONS"]["NAME"]);
/************
 * ???????? *
 ************/

$arFilter = array("IBLOCK_ID" => intval($arParams['ID_IBLOCK']), "ACTIVE" =>"Y", "SECTION_GLOBAL_ACTIVE" =>"Y", "SECTION_ACTIVE" =>"Y", "PROPERTY_PP_COURSE.ACTIVE" => "Y"); /*"ACTIVE" =>"Y"*/
$arSelect = array("IBLOCK_ID", "IBLOCK_TYPE", "ID","NAME","PROPERTY_PP_COURSE","PROPERTY_PP_COURSE.NAME","PROPERTY_PP_COURSE.ACTIVE", "PROPERTY_PP_COURSE", "PROPERTY_PP_COURSE.CODE", "PROPERTY_PP_COURSE.XML_ID", "SORT", "IBLOCK_SECTION_ID");
$rs_element = CIBlockElement::GetList(Array("SORT"=> "ASC", "PROPERTY_PP_COURSE.CODE" => "ASC"), $arFilter, false, false, $arSelect);
while($ar_element = $rs_element->GetNext(false, false))
{

    $arSelectCourse = array("ID","PROPERTY_COURSE_DURATION","PROPERTY_COURSE_PRICE", "PROPERTY_SHORT_DESCR", "PROPERTY_change_link","PROPERTY_COURSE_PRICE_UA","PROPERTY_NEW_ICON","PROPERTY_ICON_SALE","PROPERTY_ICON_SALE_LINK","PROPERTY_COMPLEXITY");
    $arFilterCourse = array("IBLOCK_ID" =>6, "ID" => $ar_element["PROPERTY_PP_COURSE_VALUE"]);
    $rs_elementCourse = CIBlockElement::GetList(array("SORT"=> "ASC"), $arFilterCourse, false, false, $arSelectCourse);
    while($ar_elementCourse = $rs_elementCourse->GetNext(false, false))
    {
        $ar_element['PARAM']  =  $ar_elementCourse;
    }
    $ar_element['IS_COURSE'] = "Y";
    $ar_element['DEPTH_LEVEL'] = $arResult["SECTIONS"][$ar_element['IBLOCK_SECTION_ID']]["DEPTH_LEVEL"] + 1 ;
    $arResult["SECTIONS"][$ar_element['IBLOCK_SECTION_ID']]["IS_PARENT"] = "Y";
    $SECTION_ID = (isset($arResult['ELEMENTS_SECTION_ID'][$ar_element['ID']])) ? $arResult['ELEMENTS_SECTION_ID'][$ar_element['ID']] : $ar_element["IBLOCK_SECTION_ID"];
    if(array_key_exists($SECTION_ID, $arResult["ELEMENTS"]))
    {
        $arResult["ELEMENTS"][$SECTION_ID][$ar_element["ID"]] = $ar_element;
    }
    else
    {
        $arResult["ELEMENTS"][$SECTION_ID] = Array();
        $arResult["ELEMENTS"][$SECTION_ID][$ar_element["ID"]] = $ar_element;
    }
    //iwrite($ar_element);
}

//iwrite($arResult["ELEMENTS"]);

/*********************
 * ?????????? ?????? *
 *********************/

$previousLevel = 0;
$arStack = Array();
foreach($arResult["SECTIONS"] as $arSection)
{
//iwrite($arSection);
    if($previousLevel && $arSection["DEPTH_LEVEL"] <= $previousLevel)
    {
        $delta = $previousLevel - $arSection["DEPTH_LEVEL"];
        for($i = 0; $i < ($delta + 1); $i++)
        {
            $section_id = array_pop($arStack);
            if(array_key_exists($section_id, $arResult["ELEMENTS"]))
            {
                foreach($arResult["ELEMENTS"][$section_id] as $arElement)
                {
                    $arResult["ITEMS"][] = $arElement;
                }
            }
            else {//$arSection["ELEMENT_CNT"] = 0;
            }
        }
    }
    $arResult["ITEMS"][] = $arSection;
    $arStack[] = $arSection["ID"];
    $previousLevel = $arSection["DEPTH_LEVEL"];
}
$section_id = array_pop($arStack);
if(array_key_exists($section_id, $arResult["ELEMENTS"]))
{
    foreach($arResult["ELEMENTS"][$section_id] as $arElement)
    {
        $arResult["ITEMS"][] = $arElement;
    }
}


//iwrite($arResult["ITEMS"]);
?>
