<?php
include($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
if (CModule::IncludeModule("iblock")):
    $phrase = iconv("UTF-8", "windows-1251", $_REQUEST['nameStartsWith']);
    if ($_REQUEST["type"] == "k") {
        $arSelect = array("ID", "NAME", "CODE");
        $arFilter = array("IBLOCK_ID" => 6, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $arFilter[] = array("LOGIC" => "OR", "NAME" => "%" . $phrase . "%", "CODE" => "%" . $phrase . "%",);
        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $response[] = array('title_ru' => iconv("windows-1251", "UTF-8", $arFields["CODE"] . " " . $arFields["NAME"]), 'id' => $arFields["ID"]);
        }
    } else {
        $arSelect = array("ID", "NAME", "CODE", "PROPERTY_course_code", "PROPERTY_SCHEDULE_COURSE.NAME", "PROPERTY_CITY", "PROPERTY_STARTDATE");
        $arFilter = array("IBLOCK_ID" => 9, ">PROPERTY_STARTDATE" => date("Y-m-d", strtotime("now")));
        $arFilter[] = array("LOGIC" => "OR", array("PROPERTY_SCHEDULE_COURSE.NAME" => "%" . $phrase . "%"), array("PROPERTY_course_code" => "%" . $phrase . "%"));
        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        while ($arFields = $res->GetNext()) {
            $id_city = $arFields["PROPERTY_CITY_VALUE"];
            $arSelect = array("PROPERTY_edu_type_money", "NAME");
            $arFilter = array("IBLOCK_ID" => 51, "ID" => $id_city);
            $pes = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            while ($ar_pields = $pes->GetNext()) {
                $valuta = $ar_pields["PROPERTY_EDU_TYPE_MONEY_VALUE"];
                $valuta_ENUM_ID = $ar_pields["PROPERTY_EDU_TYPE_MONEY_ENUM_ID"];
                $city_name = $ar_pields["NAME"];
            }
            $response[] = array('title_ru' => iconv("windows-1251", "UTF-8", $arFields["PROPERTY_COURSE_CODE_VALUE"] . " " . $arFields["PROPERTY_SCHEDULE_COURSE_NAME"] . ", " . $city_name . ", " . $arFields["PROPERTY_STARTDATE_VALUE"]), 'id' => $arFields["ID"]);
        }
    }
    echo json_encode($response);
endif;
exit;
