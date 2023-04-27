<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arResult["FORM_TITLE"] = "Sign up for course";
//if ($arParams['COURSE_CODE']){

    //Handle case when COURSE_CODE used
    if($arParams["COURSE_ID"] <= 0)
        $arParams["COURSE_ID"] = CIBlockFindTools::GetElementID(
            $arParams["COURSE_ID"],
            $arParams["COURSE_CODE"],
            false,
            false,
            array(
                "IBLOCK_ID" => D_EN_COURSE_ID_IBLOCK,
                "IBLOCK_LID" => SITE_ID,
                "IBLOCK_ACTIVE" => "Y",
                "ACTIVE" => "Y",
            )
        );
    //echo $arParams["COURSE_CODE"];
    //echo $arParams["COURSE_ID"];

    $rsElement = CIBlockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => D_EN_COURSE_ID_IBLOCK, "ID" =>$arParams["COURSE_ID"]), false, false, array( "ID", "NAME" ));
    while($obElement = $rsElement->GetNextElement()) {
         $arElement = $obElement->GetFields();
         $arResult["FORM_TITLE"] = "Sign up for ".$arElement["NAME"];
    }

    /*
     * get element in schedule
     * if count of future courses in schedlue >0
     * we have to show it in the form
     */
    $arFilter = array("IBLOCK_ID" => D_EN_SCHEDULE_IBLOCK, "ACTIVE" => "Y", "ACTIVE_DATE"=> "Y", ">=PROPERTY_STARTDATE" => date("Y-m-d"), "PROPERTY_COURSE_ID" => $arParams["COURSE_ID"]);

    if (is_array($arParams["LOCATION_ID"]) && count($arParams["LOCATION_ID"])>0){
        $arFilter["=PROPERTY_CITY_ID"]  = $arParams["LOCATION_ID"];
    }
    if(count($arParams["IBLOCK_ELEMENTS_ID"])){
        $arFilter["ID"]  = $arParams["IBLOCK_ELEMENTS_ID"];
    }
    //iwrite($arFilter);
    $arSelect = array("ID",
        "CODE",
        "NAME",
        "PROPERTY_COURSE_ID.NAME",
        "PROPERTY_COURSE_ID.CODE",
        "PROPERTY_COURSE_ID.ID",
        "PROPERTY_COURSE_ID.DETAIL_PAGE_URL",
        "PROPERTY_DURATION",
        "PROPERTY_CITY_ID.ID",
        "PROPERTY_CITY_ID.NAME",
        "PROPERTY_CITY_ID.CODE",
        "PROPERTY_CITY_ID.IBLOCK_SECTION_ID",
        "PROPERTY_TIME",
        "PROPERTY_TRAINER_ID",
        "PROPERTY_TRAINER_ID.ID",
        "PROPERTY_TRAINER_ID.NAME",
        "PROPERTY_TRAINER_ID.PROPERTY_SHORT_NAME",
        "PROPERTY_TRAINER_ID.PROPERTY_SHORT_DESC",
        "PROPERTY_TRAINER_ID.DETAIL_PAGE_URL",
        "PROPERTY_TRAINER_SIMPLE",
        "PROPERTY_STARTDATE",
        "CATALOG_GROUP_1",
        "PROPERTY_ENDDATE"
    );

    $rsElement = CIBlockElement::GetList($arSort, $arFilter, false, $arNavParams, $arSelect);

    $arArticleID =  array();
    $arResult['TOTAL_COUNT'] = 0;
    while($obElement = $rsElement->GetNextElement()) {

        $arElement = $obElement->GetFields();
        $arElement = bitrixCleaningArray($arElement);
        $arElement['COURSE_ID_DETAIL_PAGE_URL'] = str_replace("//", "/", $arElement['COURSE_ID_DETAIL_PAGE_URL']);
        $arElement['TRAINER_ID_DETAIL_PAGE_URL'] = str_replace("//", "/", $arElement['TRAINER_ID_DETAIL_PAGE_URL']);
        /**
         * working with dates
         */
        $vDateTempStart = date_create($arElement["STARTDATE"]);
        $arElement["FULL_DATES"] =  date_format($vDateTempStart, 'M j');

        if ($arElement["ENDDATE"]){
        //    $vDateTempEnd = date_create($arElement["ENDDATE"]);
        //    $arElement["FULL_DATES"] .= " - ".date_format($vDateTempEnd, 'M j');
        }


        //iwrite($arElement);
        $arResult['COURSES'][] = $arElement;
    }
//}
?>
