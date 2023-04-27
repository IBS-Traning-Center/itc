<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach ($arResult["SECTIONS"] as $key=>$arSection) {
       $arFilterCountElements = Array(
            "IBLOCK_ID"=>$arParams["IBLOCK_ID"],
            "ACTIVE"=>"Y",
            "SECTION_ID"=>$arSection["ID"],
            "INCLUDE_SUBSECTIONS"=>"Y",
            "SECTION_GLOBAL_ACTIVE" =>"Y",
            "SECTION_ACTIVE" =>"Y",
            "PROPERTY_PP_COURSE.ACTIVE" => "Y"
        );

        $res = CIBlockElement::GetList(Array(), $arFilterCountElements, Array(), false, Array());
        $arResult["SECTIONS"][$key]["ELEMENT_CNT"] = $res;
}
