<?php

class Catalog
{
    public static function OnBeforePriceAdd(&$arFields)
    {
        $arVariables = array(
            'price' => 0,
            'duration' => 0,
            'currency' => '',
        );

        $arOrder = array();
        $arSort = array();
        $arGroupBy = false;
        $arNavStartParams = array();
        $arFilter = array("IBLOCK_ID" => 9, "ID" => $arFields["PRODUCT_ID"]);
        $arSelectFields = array("PROPERTY_SCHEDULE_PRICE", "PROPERTY_SCHEDULE_DURATION", "PROPERTY_CITY");
        $res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
        while ($ob = $res->GetNextElement()) {
            $ar_fields = $ob->GetFields();
            //iwrite($ar_fields);

            if (strlen($ar_fields['PROPERTY_SCHEDULE_DURATION_VALUE'])) {
                $arVariables["duration"] = $ar_fields["PROPERTY_SCHEDULE_DURATION_VALUE"];
            }

            if (strlen($ar_fields["PROPERTY_SCHEDULE_PRICE_VALUE"]) == 0) {
                $arSelectCourse = array("PROPERTY_COURSE_PRICE", "PROPERTY_COURSE_DURATION");
                $arFilterCourse = array("IBLOCK_ID" => 6, "ID" => $ar_fields["PROPERTY_SCHEDULE_COURSE_VALUE"]);

                $resCourse = CIBlockElement::GetList(array(), $arFilterCourse, false, false, $arSelectCourse);
                while ($ar_fieldsCourse = $resCourse->GetNext()) {
                    if (strlen($ar_fields["PROPERTY_SCHEDULE_PRICE_VALUE"]) == 0) {
                        $arVariables["price"] = $ar_fieldsCourse["PROPERTY_COURSE_PRICE_VALUE"];
                    }
                    if ($arVariables["duration"] === 0) {
                        $arVariables["duration"] = $ar_fieldsCourse["PROPERTY_COURSE_DURATION_VALUE"];
                    }
                }
            } else {
                $arVariables["price"] = $ar_fields["PROPERTY_SCHEDULE_PRICE_VALUE"];
            }
            if (($ar_fields['PROPERTY_CITY_VALUE'] == "5745")
                or ($ar_fields['PROPERTY_CITY_VALUE'] == "5746")
                or ($ar_fields['PROPERTY_CITY_VALUE'] == "5747")) {
                $arVariables['currency'] = "GRN";
            } else {
                $arVariables['currency'] = "RUB";
            }
            if ($ar_fields['PROPERTY_CITY_VALUE'] == CITY_ID_MINSK)
                $arVariables['currency'] = "BYR";
        }

        if ($arVariables["price"] !== 0) {
            $arFields["PRICE"] = $arVariables["price"];
            $arFields["CURRENCY"] = $arVariables['currency'];
        }

        return $arFields;
    }
    public static function OnBeforePriceUpdate($idPrice, &$arFields)
    {
        $arVariables = array(
            'price' => 0,
            'duration' => 0,
            'currency' => '',
        );

        $arOrder = array();
        $arSort = array();
        $arGroupBy = false;
        $arNavStartParams = array();
        $arFilter = array("IBLOCK_ID" => 9, "ID" => $arFields["PRODUCT_ID"]);
        $arSelectFields = array("PROPERTY_SCHEDULE_PRICE", "PROPERTY_SCHEDULE_DURATION", "PROPERTY_CITY");
        $res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
        while ($ob = $res->GetNextElement()) {
            $ar_fields = $ob->GetFields();
            //iwrite($ar_fields);

            if (strlen($ar_fields['PROPERTY_SCHEDULE_DURATION_VALUE'])) {
                $arVariables["duration"] = $ar_fields["PROPERTY_SCHEDULE_DURATION_VALUE"];
            }

            if (strlen($ar_fields["PROPERTY_SCHEDULE_PRICE_VALUE"]) == 0) {
                $arSelectCourse = array("PROPERTY_COURSE_PRICE", "PROPERTY_COURSE_DURATION");
                $arFilterCourse = array("IBLOCK_ID" => 6, "ID" => $ar_fields["PROPERTY_SCHEDULE_COURSE_VALUE"]);

                $resCourse = CIBlockElement::GetList(array(), $arFilterCourse, false, false, $arSelectCourse);
                while ($ar_fieldsCourse = $resCourse->GetNext()) {
                    if (strlen($ar_fields["PROPERTY_SCHEDULE_PRICE_VALUE"]) == 0) {
                        $arVariables["price"] = $ar_fieldsCourse["PROPERTY_COURSE_PRICE_VALUE"];
                    }
                    if ($arVariables["duration"] === 0) {
                        $arVariables["duration"] = $ar_fieldsCourse["PROPERTY_COURSE_DURATION_VALUE"];
                    }
                }
            } else {
                $arVariables["price"] = $ar_fields["PROPERTY_SCHEDULE_PRICE_VALUE"];
            }

            if (($ar_fields['PROPERTY_CITY_VALUE'] == "5745")
                or ($ar_fields['PROPERTY_CITY_VALUE'] == "5746")
                or ($ar_fields['PROPERTY_CITY_VALUE'] == "5747")) {
                $arVariables['currency'] = "GRN";
            } else {
                $arVariables['currency'] = "RUB";
            }
            if ($ar_fields['PROPERTY_CITY_VALUE'] == CITY_ID_MINSK)
                $arVariables['currency'] = "BYR";
        }

        if ($arFields['CATALOG_GROUP_ID'] !== 3 &&
            $arVariables["price"] !== 0
        ) {
            $arFields["PRICE"] = $arVariables["price"];
            $arFields["CURRENCY"] = $arVariables['currency'];
        }

        if (
            $arFields['CATALOG_GROUP_ID'] === 3 &&
            $arVariables['duration'] !== 0 &&
            empty($arFields["PRICE"])
        ) {
            $arFields["PRICE"] = (intval($arVariables['duration']) > 39) ? intval($arVariables['duration']) * 225 : intval($arVariables['duration']) * 300;
            $arFields["CURRENCY"] = 'GRN';
        }

        return $arFields;
    }
}