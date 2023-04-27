<?php
namespace Luxoft\Dev\Events;

class Form
{
    public static function onAfterResultAdd($WEB_FORM_ID, $RESULT_ID)
    {
        global $USER;
        if ($WEB_FORM_ID == 8) {
            $id_webinar = &$_GET['ID'];
            //echo "id_webinar= $id_webinar";
            if (isset($id_webinar) and (is_numeric($id_webinar))) {
                CModule::IncludeModule("iblock");
                $arOrder = array();
                $arFilter = array();
                $arSort = array();
                $arFilter = array("IBLOCK_ID" => 68, "ID" => $id_webinar);
                $arGroupBy = false;
                $arNavStartParams = false;
                $arSelectFields = array("ID", "NAME", "PROPERTY_STARTDATE", "PROPERTY_REGISTRATION_LINK", "PROPERTY_EMAIL",);
                $res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
                while ($ob = $res->GetNextElement()) {
                    $arFields = $ob->GetFields();
                    $webinar_name = $arFields["NAME"];
                    $webinar_id = $arFields["ID"];
                    $webinar_date = $arFields["PROPERTY_STARTDATE_VALUE"];
                    $webinar_link = $arFields["PROPERTY_REGISTRATION_LINK_VALUE"];
                    $webinar_email = $arFields["PROPERTY_EMAIL_VALUE"];
                    //print_r($arFields);
                    //die();
                }
                CFormResult::SetField($RESULT_ID, 'webinar_email', $webinar_email);
                CFormResult::SetField($RESULT_ID, 'webinar_name', $webinar_name);
                CFormResult::SetField($RESULT_ID, 'webinar_id', $webinar_id);
                CFormResult::SetField($RESULT_ID, 'webinar_date', $webinar_date);
                CFormResult::SetField($RESULT_ID, 'webinar_link', $webinar_link);
            }
            CFormResult::SetField($RESULT_ID, 'user_ip', $_SERVER["REMOTE_ADDR"]);
        }
        /* $WEB_FORM_ID == 9  - форма покупки онлайн тренинга
         *
         *
         *OnAfterIBlockElementAdd
         */
        if ($WEB_FORM_ID == 9) {
            $id_schedule = &$_GET['id_schedule'];
            if (isset($id_schedule) and (is_numeric($id_schedule))) {
                CModule::IncludeModule("iblock");
                $arOrder = array();
                $arFilter = array();
                $arSort = array();
                $arFilter = array("IBLOCK_ID" => 9, "ID" => $id_schedule);
                $arGroupBy = false;
                $arNavStartParams = false;
                $arSelectFields = array(
                    "ID",
                    "NAME",
                    "PROPERTY_STARTDATE",
                    "PROPERTY_REGISTRATION_LINK",
                    "PROPERTY_COURSE_CODE",
                    "PROPERTY_SCHEDULE_COURSE",
                    "PROPERTY_SCHEDULE_PRICE",
                    "PROPERTY_ONLINE_LINK",
                    "PROPERTY_CITY"
                );
                $res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
                while ($ob = $res->GetNextElement()) {
                    $arFields = $ob->GetFields();
                    $schedule_name = $arFields["NAME"];
                    $schedule_id = $arFields["ID"];
                    $schedule_date = $arFields["PROPERTY_STARTDATE_VALUE"];
                    $schedule_code = $arFields["PROPERTY_COURSE_CODE_VALUE"];
                    $schedule_course_id = $arFields["PROPERTY_SCHEDULE_COURSE_VALUE"];
                    $schedule_price = $arFields["PROPERTY_SCHEDULE_PRICE_VALUE"];
                    $online_link = $arFields["PROPERTY_ONLINE_LINK_VALUE"];

                    //print_r($arFields);
                    //die();

                    if (strlen($schedule_price == 0)) {
                        $arSelect = array("PROPERTY_course_price",);
                        $arFilter = array("IBLOCK_ID" => 6, "ID" => $schedule_course_id);
                        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
                        while ($ar_fields = $res->GetNext()) {
                            $schedule_price = $ar_fields["PROPERTY_COURSE_PRICE_VALUE"];
                            $currency = "Рубли";
                        }
                    }

                    $arSelect = array("PROPERTY_EDU_TYPE_MONEY");
                    $arFilter = array("IBLOCK_ID" => 51, "ID" => $arFields["PROPERTY_CITY_VALUE"]);
                    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
                    while ($ar_fields = $res->GetNext()) {
                        $currency = $ar_fields["PROPERTY_EDU_TYPE_MONEY_VALUE"];
                    }

                }
                CFormResult::SetField($RESULT_ID, 'user_ip', $_SERVER["REMOTE_ADDR"]);
                CFormResult::SetField($RESULT_ID, 'course_id', $schedule_course_id);
                CFormResult::SetField($RESULT_ID, 'course_code', $schedule_code);
                CFormResult::SetField($RESULT_ID, 'schedule_id', $schedule_id);
                CFormResult::SetField($RESULT_ID, 'course_name', $schedule_name);
                CFormResult::SetField($RESULT_ID, 'schedule_date', $schedule_date);
                CFormResult::SetField($RESULT_ID, 'price', $schedule_price);
                CFormResult::SetField($RESULT_ID, 'link', $online_link);
                CFormResult::SetField($RESULT_ID, 'currency', $currency);
                // print_r($arFields);
                //die();
                //CFormResult::SetField($RESULT_ID, 'link', $_SERVER["REMOTE_ADDR"]);
            }

        }
    }
}