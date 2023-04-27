<?php
use Bitrix\Main\EventManager;
use Luxoft\Dev\Tools;

if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/vendor/autoload.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/vendor/autoload.php");
}
if (Bitrix\Main\Loader::includeModule('luxoft.dev')) {
    \Luxoft\Dev\Core::getInstance();
}

include_once '2021/index.php';
include "inc_define.php";
include "functions.php";
include "inc_debug.php";
include "inc_additional.php";
include "inc_iblock.php";

include "inc_functionality.php";
include "inc_property.php";
//include "third_party/uf/uf_iblock_element.php";
//include "third_party/uf/uf_iblock_element_list.php";

AddEventHandler('main', 'OnBeforeEventSend', "CheckEmailOnBeforeEventSend");
function CheckEmailOnBeforeEventSend($arFields, & $arTemplate)
{
    foreach ($arTemplate as & $field) {
        $field = str_replace('#EMPLOYEE_GROUP#', EMAIL_ADDRESS, $field);
    }
}

//
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", array("MyClass", "OnBeforeIBlockElementAddHandler"));
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", array("MyClass", "OnBeforeIBlockElementUpdateHandler"));
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", array("MyClass", "OnAfterIBlockElementAddHandler"));
AddEventHandler("iblock", "OnAfterIBlockElementAdd", array("MyClass", "OnAfterIBlockElementAddHandler"));
AddEventHandler("iblock", "OnBeforeIBlockElementDelete", array("MyClass", "OnBeforeIBlockElementDeleteHandler"));
//AddEventHandler("catalog", "OnBeforePriceAdd", array("MyClass", "OnBeforePriceAddHandler"));
AddEventHandler("catalog", "OnBeforePriceUpdate", array("MyClass", "OnBeforePriceUpdateHandler"));
AddEventHandler("sale", "OnOrderPaySendEmail", "bxModifySaleMail");
AddEventHandler("main", "OnBeforeUserRegister", array("MyClass", "OnBeforeUserRegisterHandler"));
AddEventHandler("main", "OnBeforeUserUpdate", array("MyClass", "OnBeforeUserUpdateHandler"));
AddEventHandler("main", "OnBeforeProlog", "IBlockOnBeforePrologHandler");
AddEventHandler("main", "OnAfterUserAdd", "OnAfterUserRegisterHandler");
AddEventHandler("main", "OnAfterUserRegister", "OnAfterUserRegisterHandler");
AddEventHandler("sale", "OnBasketUpdate", "BasketUpdate");
AddEventHandler("sale", "OnSalePayOrder", "OrderPayment");

function OrderPayment($ID, $val)
{
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("learning");
    if ($val == "Y") {
        $arOrder = CSaleOrder::GetByID($ID);
        //print_r($arOrder);
        $rsUser = CUser::GetByID($arOrder["USER_ID"]);
        $arUser = $rsUser->Fetch();
        $arSendFields["NAME"] = $arUser["LOGIN"];
        $arSendFields["EMAIL"] = $arUser["EMAIL"];
        $arBasketItems = array();
        $dbBasketItems = CSaleBasket::GetList(
            array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
            array(
                "ORDER_ID" => $ID
            ),
            false,
            false,
            array("ID", "CALLBACK_FUNC", "MODULE",
                "PRODUCT_ID", "QUANTITY", "DELAY",
                "CAN_BUY", "PRICE", "WEIGHT")
        );
        while ($arItems = $dbBasketItems->Fetch()) {
            if (strlen($arItems["CALLBACK_FUNC"]) > 0) {
                CSaleBasket::UpdatePrice($arItems["ID"],
                    $arItems["CALLBACK_FUNC"],
                    $arItems["MODULE"],
                    $arItems["PRODUCT_ID"],
                    $arItems["QUANTITY"]);
                $arItems = CSaleBasket::GetByID($arItems["ID"]);
            }

            $arBasketItems[] = $arItems;
        }

        foreach ($arBasketItems as $arItem) {
            if ($arItem["PRODUCT_ID"] == "65838" || $arItem["PRODUCT_ID"] == "65837" || $arItem["PRODUCT_ID"] == "65836" || $arItem["PRODUCT_ID"] == "65835" || $arItem["PRODUCT_ID"] == "65520" || $arItem["PRODUCT_ID"] == "81662") {
                $arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_LEARN_TEST");
                $arFilter = array("IBLOCK_ID" => 138, "ID" => $arItem["PRODUCT_ID"]);
                if ($arItem["PRODUCT_ID"] == "65520") {
                    $arFilter["IBLOCK_ID"] = 136;
                }
                $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
                if ($ob = $res->GetNextElement()) {
                    $arFields = $ob->GetFields();
                    //print_r($arFields);
                    if (CModule::IncludeModule("learning")) {
                        $COURSE_ID = $arFields["PROPERTY_LEARN_TEST_VALUE"];
                        $arGroup = GetGroupByCode("test_" . $arFields["PROPERTY_LEARN_TEST_VALUE"]);
                        $GROUP_ID = $arGroup["ID"];
                        $res = CUser::GetUserGroupList($arOrder["USER_ID"]);
                        while ($arGroup = $res->Fetch()) {
                            $arUserGroups[] = $arGroup["GROUP_ID"];
                            //print "<pre>"; print_r($arGroup); print "</pre>";
                        }
                        $arUserGroups[] = $GROUP_ID;
                        CUser::SetUserGroup($arOrder["USER_ID"], $arUserGroups);
                        $res = CTest::GetList(
                            array("SORT" => "ASC"),
                            array("ACTIVE" => "Y", "COURSE_ID" => $COURSE_ID, "CHECK_PERMISSIONS" => "N")
                        );
                        if ($arTest = $res->GetNext()) {
                            //echo "Test id: ".$arTest["ID"]."<br>";
                            $TEST_ID = $arTest["ID"];

                            $arSendFields["TEST_LINK"] = 'https://ibs-training.ru/training/testing/' . $COURSE_ID . '/' . $arTest["ID"] . '/';
                            $arSendFields["TEST_NAME"] = $arTest["NAME"];
                        }
                    }

                }


                if ($arItem["QUANTITY"] > 1) {
                    $check = new CGradeBook;
                    //echo($arOrder["USER_ID"]." LOL ".$TEST_ID." LOL ".$arItem["QUANTITY"]-1);
                    $add = $check->AddExtraAttempts($arOrder["USER_ID"], $TEST_ID, $arItem["QUANTITY"] - 1);
                    if ($add) {
                        //echo "URA";
                    }
                }
                //print_r($arSendFields);
                CEvent::Send("TEST_SALE", SITE_ID, $arSendFields);
                //die();

            }

        }
    }
}

function GetGroupByCode($code)
{
    $rsGroups = CGroup::GetList($by = "c_sort", $order = "asc", array("STRING_ID" => $code));
    return $rsGroups->Fetch();
}

EventManager::getInstance()->addEventHandler('sale', 'OnSaleOrderSaved', 'saleOrderSaved');
function saleOrderSaved(\Bitrix\Main\Event $event)
{
    /** @var \Bitrix\Sale\Order $order */
    $order = $event->getParameter("ENTITY");
    $isNew = $event->getParameter("IS_NEW");
    if ($isNew) {
        /** @var \Bitrix\Sale\PropertyValueCollection $propertyCollection */
        $propertyCollection = $order->getPropertyCollection();

        /**
         * Перебираем свойства и изменяем нужные значения
         * @var \Bitrix\Sale\PropertyValue $propertyItem
         */
        foreach ($propertyCollection as $propertyItem) {
            switch ($propertyItem->getField("CODE")) {
                case 'INVOICE':
                    $invoiceNumber = 1;
                    if (CModule::IncludeModule("sale")) {
                        $rsSales = CSaleOrder::GetList(array("ID" => "DESC"), array('PERSON_TYPE_ID' => 9), false, array('nTopCount' => 2), array('ID', 'PROPERTY_VAL_BY_CODE_INVOICE', 'PROPERTY_VAL_BY_CODE_CUSTOMER'));
                        while ($arSales = $rsSales->Fetch()) {
                            $db_props = CSaleOrderPropsValue::GetOrderProps($arSales['ID']);
                            while ($arProps = $db_props->Fetch()) {
                                if ($arProps['CODE'] == 'INVOICE') {
                                    $invoiceNumber = ((int)$arProps['VALUE'] + 1);
                                    break;
                                }
                            }
                        }
                    }
                    $propertyItem->setField("VALUE", $invoiceNumber);
                    break;
                case 'offerta':
                    $arFilter = array('!PROPERTY_VAL_BY_CODE_offerta' => false, "PERSON_TYPE_ID" => 1);
                    $rsSales = CSaleOrder::GetList(array("ID" => "DESC"), $arFilter, false, array("nPageSize" => 1));
                    if ($arSales = $rsSales->Fetch()) {
                        $db_props = CSaleOrderPropsValue::GetOrderProps($arSales["ID"]);
                        $arOrderProps = [];
                        while ($arProps = $db_props->Fetch()) {
                            if ($arProps['CODE'] && $arProps['VALUE']) {
                                $arOrderProps[$arProps['CODE']] = $arProps['VALUE'];
                            }
                            unset($arProps);
                        }
                        $number = intval($arOrderProps["offerta"]) + 1;
                    } else {
                        $number = 1;
                    }

                    $arFilter = array('!PROPERTY_VAL_BY_CODE_offerta' => false, "PERSON_TYPE_ID" => 3);
                    $rsSales = CSaleOrder::GetList(array("ID" => "DESC"), $arFilter, false, array("nPageSize" => 1));
                    if ($arSales = $rsSales->Fetch()) {
                        $db_props = CSaleOrderPropsValue::GetOrderProps($arSales["ID"]);
                        $arOrderProps = [];
                        while ($arProps = $db_props->Fetch()) {
                            if ($arProps['CODE'] && $arProps['VALUE']) {
                                $arOrderProps[$arProps['CODE']] = $arProps['VALUE'];
                            }
                            unset($arProps);
                        }
                        $number_ur = intval($arOrderProps["offerta"]) + 1;
                    } else {
                        $number_ur = 1;
                    }

                    if ($number_ur > $number) {
                        $number = $number_ur;
                    }

                    $propertyItem->setField("VALUE", $number);
                    break;
            }
        }
        $propertyCollection->save();
    }
}

//AddEventHandler("iblock", "OnBeforeIBlockSectionAdd", Array("MyClass", "OnBeforeSectionAddHandler"));
//AddEventHandler("iblock", "OnBeforeIBlockSectionUpdate", Array("MyClass", "OnBeforeSectionAddHandler"));
AddEventHandler("sender", "OnTriggerList", array("MySenderEventHandler", "onTriggerList"));

class MySenderEventHandler
{
    public static function onTriggerList($data)
    {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/php_interface/test_start_trigger.php');
        $data['TRIGGER'] = 'SenderTriggerTestNotFinished';
        return $data;
    }
}

function BasketUpdate($ID, $arFields)
{
    $dbBasketItems = CSaleBasket::GetList(
        array(
            "NAME" => "ASC",
            "ID" => "ASC"
        ),
        array(
            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "ORDER_ID" => "NULL"
        ),
        false,
        false,
        array()
    );
    $arrDis = array(45422, 47288, 45424);
    CModule::IncludeModule("catalog");
    while ($arBasketIt = $dbBasketItems->Fetch()) {
        //print_r($arBasketIt);

        if (in_array($arBasketIt["PRODUCT_ID"], $arrDis)) {

            $key = array_search($arBasketIt["PRODUCT_ID"], $arrDis);
            if ($key !== false) {
                unset($arrDis[$key]);

            }
        }
    }
    $allCoupons = CCatalogDiscount::GetCoupons();
    if (count($arrDis) == 0) {
        if (!in_array('CP-XBRYT-KWFN53U', $allCoupons)) {
            CCatalogDiscountCoupon::SetCoupon('CP-XBRYT-KWFN53U');
            LocalRedirect('/personal/cart/');
        }
    } else {
        if (in_array('CP-XBRYT-KWFN53U', $allCoupons)) {
            CCatalogDiscount::ClearCoupon();
            LocalRedirect('/personal/cart/');
        }
    }

}

AddEventHandler("subscribe", "BeforePostingSendMail", array("MyClass", "BeforePostingSendMailHandler"));
function IBlockOnBeforePrologHandler()
{
    require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/php_interface/ikso/props/prop_elist_ajax.php");
    // TODO Проверить зачем нужен prop_element_list_sorted.php
    //require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/php_interface/artions/props/prop_element_list_sorted.php");
}

function bxModifySaleMail($orderID, &$eventName, &$arFields)
{
    $arOrder = CSaleOrder::GetByID($orderID);
    $db_props = CSaleOrderPropsValue::GetOrderProps($orderID);
    while ($arProps = $db_props->Fetch()) {
        if ($arProps['CODE'] == 'F_NAME') {
            $arOrderProps['F_NAME'] = $arProps['VALUE'];
        }
        if ($arProps['CODE'] == 'F_S_NAME') {
            $arOrderProps['F_S_NAME'] = $arProps['VALUE'];
        }
    }
    $arFields["ORDER_USER"] = $arFields["ORDER_USER"] . " " . $arOrderProps['F_NAME'] . " " . $arOrderProps['F_S_NAME'];
    $arFields["ORDER_PRICE"] = intval($arOrder["PRICE"]);
}

function OnAfterUserRegisterHandler(&$arFields)
{
    if (intval($arFields["ID"]) > 0) {
        $toSend = array();
        $toSend["PASSWORD"] = $arFields["PASSWORD"];
        $toSend["EMAIL"] = $arFields["EMAIL"];
        $toSend["USER_ID"] = $arFields["ID"];
        $toSend["USER_IP"] = $arFields["USER_IP"];
        $toSend["USER_HOST"] = $arFields["USER_HOST"];
        $toSend["LOGIN"] = $arFields["LOGIN"];
        $toSend["NAME"] = (trim($arFields["NAME"]) == "") ? $toSend["NAME"] = htmlspecialchars('<Не указано>') : $arFields["NAME"];
        $toSend["LAST_NAME"] = (trim($arFields["LAST_NAME"]) == "") ? $toSend["LAST_NAME"] = htmlspecialchars('<Не указано>') : $arFields["LAST_NAME"];
        //CEvent::SendImmediate ("NEW_USER_WITH_PASSWORD", SITE_ID, $toSend);
    }
    return $arFields;
}

class MyClass
{
    function OnBeforeSectionAddHandler(&$arFields)
    {
        if ($arFields["IBLOCK_ID"] == 94) {
            $arFields["CODE"] = strtolower(codeTranslite($arFields["NAME"]));
        }
    }

    function BeforePostingSendMailHandler($arFields)
    {
        $rsSub = CSubscription::GetByEmail($arFields["EMAIL"]);
        $arSub = $rsSub->Fetch();
        //$arFields["BODY"] = str_replace("#MAIL_ID_SUBSCRIBER#", $arSub["ID"], $arFields["BODY"]);
        $arFields["BODY"] = str_replace("#MAIL_ID#", $arSub["ID"], $arFields["BODY"]);
        $arFields["BODY"] = str_replace("#MAIL_MD5#", MyClass::GetMailHash($arFields["EMAIL"]), $arFields["BODY"]);
        /*
        $USER_NAME = "";$index = 0;
        $filter = Array("=EMAIL" => $arFields["EMAIL"]);
        $rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter);
        while($arUsers = $rsUsers->Fetch()) {
            if ($index == 0){
                $USER_NAME = rucfirst(strtolower_utf8(strtolower($arUsers['NAME'])));
                $USER_NAME = ", ". $USER_NAME;
                $USER_ID   = $arUsers["ID"];
            }
            $index =$index + 1;
        }
        $arFields["BODY"] = str_replace("#MAIL_ID#", $USER_ID, $arFields["BODY"]);
        $arFields["BODY"] = str_replace("#NAME#", $USER_NAME, $arFields["BODY"]);
        */
        return $arFields;
    }

    function GetMailHash($email)
    {
        return md5(md5($email) . MAIL_SALT);
    }

    function OnBeforePriceAddHandler(&$arFields)
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

    function OnBeforePriceUpdateHandler($idPrice, &$arFields)
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

    function OnBeforeUserRegisterHandler(&$arFields)
    {
        $arFields["LOGIN"] = $arFields["EMAIL"];
        if ($arFields["NAME"] == $arFields["LAST_NAME"]) {
            global $APPLICATION;
            $APPLICATION->ThrowException('Имя совпадает с фамилией. Такого быть не должно.');
            return false;
        }
        global $APPLICATION;
        if ($APPLICATION->GetCurDir() == '/system-test-registration/') {
            $arFields["GROUP_ID"][] = 89;
            $arFields["GROUP_ID"][] = 94;

        }
    }

    function OnBeforeUserUpdateHandler(&$arFields)
    {
        $arFields["LOGIN"] = $arFields["EMAIL"];
    }

    // создаем обработчик события "OnBeforeIBlockElementUpdate"
    function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {
        global $DB, $USER, $APPLICATION;

        if ($arFields["IBLOCK_ID"] == 165) {
            $timetableIds = array_map(function ($item) {
                return $item['VALUE'];
            }, $arFields['PROPERTY_VALUES'][1314]);
            $arFields["DETAIL_TEXT"] = Tools\Email::getScheduleEmailBlock($arFields['ID'], $timetableIds);
        }

        if ($arFields["IBLOCK_ID"] == 180) {
            //Bitrix\Main\Diag\Debug::dumpToFile($arFields,'','OnBeforeIBlockElementUpdateHandler.log');
            $date = '';
            foreach ($arFields["PROPERTY_VALUES"][1280] as $currentValue) {
                if ($currentValue['VALUE']) {
                    $date = str_replace('.', '_', $currentValue['VALUE']);
                }
                unset($currentValue);
            }
            if ($arFields["PROPERTY_VALUES"][1282][0]) {
                $arFields["PROPERTY_VALUES"][1282][0] = 'https://ibs-training.ru/frdo-form/' . $arFields['CODE'] . '/' . $date . '/';
            } else {
                foreach ($arFields["PROPERTY_VALUES"][1282] as &$currentValue) {
                    $currentValue['VALUE'] = 'https://ibs-training.ru/frdo-form/' . $arFields['CODE'] . '/' . $date . '/';
                    unset($currentValue);
                }
            }
        }

        // сделаем проверку на заполеннеость поля URL  для вебинаров
        if ($arFields["IBLOCK_ID"] == 7) {
            $ELEMENT_ID = $arFields["ID"];
            //AddMessage2Log(print_r($arFields,1), "my_module_id");
            if (($arFields['PROPERTY_VALUES'][284][0] == 92) and (strlen($arFields['PROPERTY_VALUES'][286]["$ELEMENT_ID:286"]) < 3)) {
                global $APPLICATION;
                $APPLICATION->throwException("Введите ссылку на трансляцию для вебинара");
                //return false;
                $arFields["ACTIVE"] = "N";
            }
        }

        if ($arFields["IBLOCK_ID"] == D_EXPERT_ID_IBLOCK) {
            if (in_array(GROUP_FORBID_EXPERTS_IBLOCK_EDIT, $USER->GetUserGroupArray())) {
                $APPLICATION->throwException("Извините, но у вас нет прав на редактирование и удаление записей в таблице Экспертов");
                return false;
            }
        }

        $IBLOCK_ID = $arFields["IBLOCK_ID"];
        if (
            ($IBLOCK_ID == D_SEMINARS_IBLOCK) or
            ($IBLOCK_ID == D_TIMETABLE_ID_IBLOCK) or
            ($IBLOCK_ID == D_TIMETABLECLASSES_ID_IBLOCK) or
            ($IBLOCK_ID == D_SEMINARS_REFERENCE) or
            ($IBLOCK_ID == D_RECORDS_IBLOCK) or
            ($IBLOCK_ID == D_NEWS) or
            ($IBLOCK_ID == D_PARTNERS) or
            ($IBLOCK_ID == D_CLIENTS_REFERENCE) or
            ($IBLOCK_ID == D_CLIENTS_FEEDBACK)
        ) {
            if (in_array(GROUP_FORBID_EDU_SECTION, $USER->GetUserGroupArray())) {
                $APPLICATION->throwException("Извините, но у вас нет прав на редактирование и удаление записей  данного информационнного блока");
                return false;
            }
        }
    }

    function OnBeforeIBlockElementAddHandler(&$arFields)
    {
        global $DB;

        if ($arFields["IBLOCK_ID"] == 165) {
            $timetableIds = array_map(function ($item) {
                return $item['VALUE'];
            }, $arFields['PROPERTY_VALUES'][1314]);
            $arFields["DETAIL_TEXT"] = Tools\Email::getScheduleEmailBlock($arFields['ID'], $timetableIds);
        }

        if ($arFields["IBLOCK_ID"] == 180) {
            $date = str_replace('.', '_', $arFields["PROPERTY_VALUES"][1280][0]['VALUE']);
            $arFields["PROPERTY_VALUES"][1282][0] = 'https://ibs-training.ru/frdo-form/' . $arFields['CODE'] . '/' . $date . '/';
        }

        if ($arFields["IBLOCK_ID"] == 10) {
            $ELEMENT_ID = $arFields["ID"];
            $IBLOCK_ID = $arFields["IBLOCK_ID"];
            $ACTIVE = $arFields["ACTIVE"];
            $id_class = $arFields["PROPERTY_VALUES"][60][0];
            if (strlen($arFields["NAME"]) < 3) {
                if (strlen($id_class) > 0) {
                    $res = CIBlockSection::GetByID($id_class);
                    if ($ar_res = $res->GetNext()) {
                        $arFields["NAME"] = $ar_res['NAME'];
                    }
                }
            }
        }
        /**
         * делаем проверку на пустое поле NAME. Если оно пустое,
         * то по его элементу получаем имя присваиваем
         */
        if ($arFields["IBLOCK_ID"] == 64) // УЦ Запись на курсы и мероприятия
        {
            $idElement = &$_GET['ID'];
            global $USER;
            if ((strlen($arFields["NAME"]) < 3) and strlen($idElement) > 0) {
                $res = CIBlockElement::GetByID($idElement);
                if ($ar_res = $res->GetNext())
                    $arFields["NAME"] = $ar_res['NAME'];
            }
        }
        // сделаем проверку на заполеннеость поля URL  для вебинаров
        if ($arFields["IBLOCK_ID"] == 7) // УЦ Расписание семинаров, вебинаров
        {
            if (($arFields['PROPERTY_VALUES'][284][0] == 92) and (strlen($arFields['PROPERTY_VALUES'][286]['n0']) < 3)) {
                global $APPLICATION;
                $APPLICATION->throwException("Введите ссылку на трансляцию для вебинара");
                //return false;
                $arFields["ACTIVE"] = "N";
            }
        }
    }

    /**
     * @param $arFields
     */
    function OnAfterIBlockElementAddHandler(&$arFields)
    {
        /*
         Заполнение автоматических скидок для виджета
         */
        /*if  ($arFields["IBLOCK_ID"]==D_TIMETABLE_ID_IBLOCK) {
            $CITY_PROPERTY=$arFields["PROPERTY_VALUES"][CITY_PROP_ID][$arFields["XML_ID"].":".CITY_PROP_ID]["VALUE"];
            if ($CITY_PROPERTY==CITY_ID_MOSCOW) {
                if (intval($arFields["PROPERTY_VALUES"][DISCOUNT_PROP_ID][$arFields["XML_ID"].":".DISCOUNT_PROP_ID]["VALUE"])==0){
                    fn_randomDiscount($arFields["ID"]);
                }

            } elseif ($CITY_PROPERTY==CITY_ID_KIEV || $CITY_PROPERTY==CITY_ID_DNEPR || $CITY_PROPERTY==CITY_ID_ODESSA){
                fn_randomDiscount($arFields["ID"], $arFields["PROPERTY_VALUES"][DURATION_PROP_ID][$arFields["XML_ID"].":".DURATION_PROP_ID]["VALUE"]);
            }
        }*/
        //в карточке курса поле CODE присваиваем значение с поля COURSE_CODE
        //6 - ID инфоблока карточек курсов
        //31 - ID свойства код курса
        if ($arFields["IBLOCK_ID"] == 6) {
            CModule::IncludeModule("iblock");
            $arSelect = array("PROPERTY_COURSE_CODE", "NAME", "XML_ID");
            $arFilter = array("IBLOCK_ID" => $arFields["IBLOCK_ID"], "ID" => $arFields["ID"]);
            $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            while ($ob = $res->GetNextElement()) {
                $ar_fields = $ob->GetFields();
                if (
                    strtoupper($ar_fields["PROPERTY_COURSE_CODE_VALUE"]) !== $arFields["CODE"]
                    && strlen($ar_fields["PROPERTY_COURSE_CODE_VALUE"]) > 0
                ) {
                    $el = new CIBlockElement;
                    $arCode = array("CODE" => strtoupper($ar_fields["PROPERTY_COURSE_CODE_VALUE"]));
                    $result = $el->Update($arFields["ID"], $arCode);
                }
                /*
                if (
                    $ar_fields["XML_ID"] != strtolower(codeTranslite($ar_fields['NAME']))
                    && strlen($ar_fields["XML_ID"]) > 0
                ) {
                    $el = new CIBlockElement;
                    $arCode = array("XML_ID" => strtolower(codeTranslite($ar_fields['NAME'])),);
                    $result = $el->Update($arFields["ID"], $arCode);
                }
                */
            }
        }


        //в отзывах поля код курса присваиваем его значение
        //61 - ID инфоблока Отзывов
        //255 - курса курса
        if ($arFields["IBLOCK_ID"] == 61) {
            $ELEMENT_ID = $arFields["ID"];
            $IBLOCK_ID = $arFields["IBLOCK_ID"];
            $id_course = $arFields["PROPERTY_VALUES"][225]["$ELEMENT_ID:225"];
            if (strlen($id_course) > 0) {
                $arSelect = array("PROPERTY_course_code");
                $arFilter = array("IBLOCK_ID" => "6", "ID" => $id_course);
                $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

                while ($ar_fields = $res->GetNext()) {
                    $course_code = $ar_fields["PROPERTY_COURSE_CODE_VALUE"];
                }
                CIBlockElement::SetPropertyValueCode($ELEMENT_ID, "253", $course_code);
            }
        }

        //в Школах  полю код курса присваиваем его значение
        //49 - ID инфоблока расписание
        //176 - курса курса
        if ($arFields["IBLOCK_ID"] == 49) {
            $ELEMENT_ID = $arFields["ID"];
            $IBLOCK_ID = $arFields["IBLOCK_ID"];
            $ACTIVE = $arFields["ACTIVE"];
            $id_course = $arFields["PROPERTY_VALUES"][176]["$ELEMENT_ID:176"];
            $arIDCourse = $arFields["PROPERTY_VALUES"][176];
            foreach ($arIDCourse as $v) {
                $id_course = $v;
            }
            //echo "course_code=$id_course";

            //die();

            if (strlen($id_course) > 0) {
                $arSelect = array("PROPERTY_course_code");
                $arFilter = array("IBLOCK_ID" => "6", "ID" => $id_course);
                $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
                while ($ar_fields = $res->GetNext()) {
                    $course_code = $ar_fields["PROPERTY_COURSE_CODE_VALUE"];
                }
                CIBlockElement::SetPropertyValueCode($ELEMENT_ID, "256", $course_code);
            }
        }
        /*

        10 - ID инфоблока расписание Школ / Классов
        60 - id свойства элемента "Курсы"
        $id_class -
        */
        if ($arFields["IBLOCK_ID"] == 10) {
            $ELEMENT_ID = $arFields["ID"];
            $IBLOCK_ID = $arFields["IBLOCK_ID"];
            $ACTIVE = $arFields["ACTIVE"];
            $id_class = $arFields["PROPERTY_VALUES"][60][0];

            if (strlen($id_class) > 0) {
                $res = CIBlockSection::GetByID($id_class);
                if ($ar_res = $res->GetNext()) {
                    $id_parent_section = $ar_res ["IBLOCK_SECTION_ID"];
                    CIBlockElement::SetPropertyValues($ELEMENT_ID, $IBLOCK_ID, $id_parent_section, "parent_section_id");
                    $res2 = CIBlockSection::GetByID($id_parent_section);
                    if ($ar_res2 = $res2->GetNext()) {
                        CIBlockElement::SetPropertyValues($ELEMENT_ID, $IBLOCK_ID, $ar_res2['NAME'], "parent_section_name");
                    }
                }
            }

        }

        /*
        //нужно отправить письмо если стоит галка
        ID_LINKED_COURSES = 304  связанные курсы
        FLAG_TEST_SEND    = 305  тестовая рассылка //список
            *TEST - 96
            *TOSUBSCRIBERS - 97
        FLAG_SEND_MAIL    = 306  отправить письмо  //список
            *DRAFT - 98
            *SEND - 99
            *ALREADYSENT - 100
        SEND_MAIL_TEXT    = 307  дополнительный текст в письме

        */
        if ($arFields["IBLOCK_ID"] == 7) {
            $arOrder = array();
            $arSort = array();
            $arGroupBy = false;
            $arNavStartParams = false;
            $arFilter = array("IBLOCK_ID" => $arFields["IBLOCK_ID"], "ID" => $arFields["ID"]);
            $arSelectFields = array("ID", "PROPERTY_FLAG_SEND_MAIL", "PROPERTY_ID_LINKED_COURSES", "PROPERTY_FLAG_TEST_SEND",
                "PROPERTY_TYPE_EVENT", "PROPERTY_SEND_MAIL_TEXT", "PROPERTY_STARTDATE", "PROPERTY_USE_EMPTY_TPL", "PROPERTY_ID_LINKED_REFER", "PROPERTY_MAX_NUM", "PROPERTY_REGISTRATION_LINK", "PROPERTY_TIME", "PROPERTY_SEND_TITLE");
            $res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
            while ($ob = $res->GetNextElement()) {
                $arFieldsForEmail = $ob->GetFields();
                //iwrite($arFieldsForEmail['PROPERTY_USE_EMPTY_TPL_ENUM_ID']);
            }

            if ($arFieldsForEmail['PROPERTY_FLAG_SEND_MAIL_ENUM_ID'] == 99) { // если нужно послать рассылку
                /*
                #ID# - ID Event
                #EVENT_NAME# - Имя ивента
                #EVENT_DATE# - Дата ивента
                #BLOCK_COURSES# - Блок курсов
                #TYPE_EVENT# - Тип события
                #SUBSCRIBER_EMAIL# - EMAIL подписчика
                #TEXT_ADD# - Текст из дополнительного текстового поля
                #SUBSCRIBER_NAME# - Имя подписчика
                #MATERIALS# - Материалы вида: Материалы по этому мероприятию  доступны по <ссылко>ссылке<ссылко>
                */

                // get materials if exists
                $arSend["MATERIALS"] = "";
                $arOrder = array();
                $arSort = array();
                $arGroupBy = false;
                $arNavStartParams = array();
                $arFilter = array("IBLOCK_ID" => 7, "ID" => $arFields["ID"]);
                $arSelectFields = array("PROPERTY_FILE");
                $res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
                while ($ob = $res->GetNextElement()) {
                    $ar_fields = $ob->GetFields();
                    if (strlen($ar_fields["PROPERTY_FILE_VALUE"]) > 0) {
                        $arSend["MATERIALS_URL"] = "https://ibs-training.ru" . CFile::GetPath($ar_fields['PROPERTY_FILE_VALUE']);
                        $arSend["MATERIALS"] = "Материалы по этому мероприятию  доступны по <a href=" . $arSend['MATERIALS_URL'] . ">ссылке</a>";

                    }
                    //global $USER;
                    //if ($USER->GetID() == 1){
                    //iwrite($arSend);
                    //die();
                    //}
                }


                $arSend["ID"] = $arFields["ID"];
                $arSend["EVENT_DATE"] = $arFieldsForEmail["PROPERTY_STARTDATE_VALUE"];

                if (!empty($arFieldsForEmail['PROPERTY_SEND_TITLE_VALUE'])) {
                    $arSend["EVENT_TITLE"] = $arFieldsForEmail['PROPERTY_SEND_TITLE_VALUE'];
                } else {
                    $arSend["EVENT_TITLE"] = $arFields["NAME"];
                }

                $arSend["EVENT_NAME"] = $arFields["NAME"];

                if ($arFieldsForEmail["PROPERTY_TYPE_EVENT_ENUM_ID"] == 91) { // семинар
                    $arSend["TYPE_EVENT"] = "Семинар";
                }
                if ($arFieldsForEmail["PROPERTY_TYPE_EVENT_ENUM_ID"] == 92) { // семинар
                    $arSend["TYPE_EVENT"] = "Вебинар";
                }

                //$arSend["TEXT_ADD"] = "<p>Дата проведения: ".date('d.m.Y', strtotime($arFieldsForEmail["PROPERTY_STARTDATE_VALUE"]))."<br> Время: ".$arFieldsForEmail["PROPERTY_TIME_VALUE"]."</p>";


                $arSend["TEXT_ADD"] .= $arFieldsForEmail["~PROPERTY_SEND_MAIL_TEXT_VALUE"]["TEXT"];
                $arSend['REGISTRATION_LINK'] = $arFieldsForEmail["PROPERTY_REGISTRATION_LINK_VALUE"];

                // получим из связанных курсов  блок ближайших курсов в расписании
                //сперва получим масcив нужных данных
                $arIDCourses = $arFieldsForEmail["PROPERTY_ID_LINKED_COURSES_VALUE"];
                $todayDate = date("Y-m-d");
                $arSort = array("PROPERTY_COURSE_CODE" => "ASC", "PROPERTY_STARTDATE" => "ASC");
                $arGroupBy = false;
                $arNavStartParams = false;
                $arFilter = array("IBLOCK_ID" => 9, "ACTIVE" => "Y", ">=PROPERTY_STARTDATE" => $todayDate, "PROPERTY_SCHEDULE_COURSE" => $arIDCourses);
                $arSelectFields = array("ID", "NAME", "PROPERTY_COURSE_CODE", "PROPERTY_STARTDATE", "PROPERTY_ENDDATE", "PROPERTY_SCHEDULE_TIME",
                    "PROPERTY_SCHEDULE_PRICE", "PROPERTY_SCHEDULE_COURSE.NAME", "PROPERTY_SCHEDULE_DURATION", "PROPERTY_SCHEDULE_TIME", "PROPERTY_CITY.NAME", "PROPERTY_CITY.ID", "PROPERTY_CITY",
                    "PROPERTY_TEACHER", "PROPERTY_TEACHER.NAME", "PROPERTY_TEACHER.CODE", "PROPERTY_SCHEDULE_COURSE");
                $res = CIBlockElement::GetList($arSort, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
                $textCourseBlockData = "<p>Приглашаем Вас и Ваших коллег посетить следующие тренинги по данной тематике:</p>";
                $countLinkedCourses = 0;
                $lastCourseCode = '';
                while ($ob = $res->GetNextElement()) {
                    $ar_fields = $ob->GetFields();
                    $countLinkedCourses = $countLinkedCourses + 1;
                    if ($lastCourseCode !== $ar_fields['PROPERTY_COURSE_CODE_VALUE']) {
                        if ($lastCourseCode !== '') {
                            $textCourseBlockData .= "<br />";
                        }
                        $textCourseBlockData .= "<strong><a href='https://ibs-training.ru/training/catalog/course.html?ID=" . $ar_fields['PROPERTY_SCHEDULE_COURSE_VALUE'] . "'>" . $ar_fields['PROPERTY_COURSE_CODE_VALUE'] . ' ' . $ar_fields["PROPERTY_SCHEDULE_COURSE_NAME"] . "</a></strong><br />";
                        if ($ar_fields["PROPERTY_CITY_VALUE"] == 14909) {
                            $textCourseBlockData .= "Онлайн, ";
                        } else {
                            $textCourseBlockData .= $ar_fields["PROPERTY_CITY_NAME"] . ", очный курс, ";
                        }
                        $textCourseBlockData .= $ar_fields["PROPERTY_STARTDATE_VALUE"];
                        if (strlen($ar_fields["PROPERTY_ENDDATE_VALUE"]) > 0) {
                            $textCourseBlockData .= " - " . $ar_fields["PROPERTY_ENDDATE_VALUE"];
                        }
                        $textCourseBlockData .= "<br />";

                        //$textCourseBlockData .= "Тренер: <a href='https://ibs-training.ru/about/experts/".$ar_fields["PROPERTY_TEACHER_CODE"].".html'>". $ar_fields["PROPERTY_TEACHER_NAME"]."</a><br />";
                        if (strlen($ar_fields["PROPERTY_SCHEDULE_TIME_VALUE"]) > 0) {
                            //$textCourseBlockData .= "Время: ". $ar_fields["PROPERTY_SCHEDULE_TIME_VALUE"]."<br />";
                        }
                        if (strlen($ar_fields["PROPERTY_SCHEDULE_DURATION_VALUE"]) > 0) {
                            //$textCourseBlockData .= "Длительность: ". $ar_fields["PROPERTY_SCHEDULE_DURATION_VALUE"]." часа <br />";
                        }
                        if (($ar_fields["PROPERTY_CITY_VALUE"] == 5745) or ($ar_fields["PROPERTY_CITY_VALUE"] == 5746)
                            or ($ar_fields["PROPERTY_CITY_VALUE"] == 5747)) {
                            $curCurrency = "грн.";
                        } else {
                            $curCurrency = "руб.";
                        }
                        if (strlen($ar_fields["PROPERTY_SCHEDULE_PRICE_VALUE"]) > 0) {
                            //$textCourseBlockData .= "Стоимость: ". $ar_fields["PROPERTY_SCHEDULE_PRICE_VALUE"]." ". $curCurrency."<br />";
                        }
                    } else {
                        if ($ar_fields["PROPERTY_CITY_VALUE"] == 14909) {
                            $textCourseBlockData .= "Онлайн, ";
                        } else {
                            $textCourseBlockData .= $ar_fields["PROPERTY_CITY_NAME"] . ", очный курс, ";
                        }
                        $textCourseBlockData .= $ar_fields["PROPERTY_STARTDATE_VALUE"];
                        if (strlen($ar_fields["PROPERTY_ENDDATE_VALUE"]) > 0) {
                            $textCourseBlockData .= " - " . $ar_fields["PROPERTY_ENDDATE_VALUE"];
                        }
                        $textCourseBlockData .= "<br />";
                    }
                    $lastCourseCode = $ar_fields['PROPERTY_COURSE_CODE_VALUE'];
                }
                //die();
                //echo "<br />$textCourseBlockData";
                $textCourseBlockData .= "";
                if (count($arIDCourses) == 0) {
                    $textCourseBlockData = "";

                }
                $arSend["BLOCK_COURSES"] = $textCourseBlockData;
                //
                //если рассылка  тестовая ищем всех получателей из группы тестироващиков с ID = 42:
                if ($arFieldsForEmail["PROPERTY_FLAG_TEST_SEND_ENUM_ID"] <> 97) {
                    $arUsers = CGroup::GetGroupUser(42);
                    foreach ($arUsers as $userID) {
                        $rsUser = CUser::GetByID($userID);
                        $arUser = $rsUser->Fetch();
                        $arUser["EMAIL"];
                        $arSend["SUBSCRIBER_EMAIL"] = $arUser["EMAIL"];
                        $arSend["SUBSCRIBER_NAME"] = $arUser["NAME"];
                        //iwrite($arFields["PROPERTY_VALUES"]);
                        //die();
                        if ($arFieldsForEmail['PROPERTY_USE_EMPTY_TPL_ENUM_ID'] == "104") {
                            CEvent::Send('EVENTS_SUBSCRIBE', SITE_ID, $arSend, 'N', 89);
                        } else {
                            CEvent::Send('EVENTS_SUBSCRIBE', SITE_ID, $arSend, 'N', 71);
                        }
                    }

                } else {
                    //получаем email подписчиков
                    $arOrder = array();
                    $arSort = array();
                    $arGroupBy = false;
                    $arNavStartParams = false;
                    $arFilter = array("IBLOCK_ID" => 64, "PROPERTY_EVENT_ID" => $arFields["ID"], "ACTIVE" => "Y");
                    $arSelectFields = array("ID", "PROPERTY_FULLNAME", "PROPERTY_EMAIL");
                    $res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
                    while ($ob = $res->GetNextElement()) {
                        $ar_fields = $ob->GetFields();
                        $arSend["SUBSCRIBER_EMAIL"] = $ar_fields["PROPERTY_EMAIL_VALUE"];
                        $arSend["SUBSCRIBER_NAME"] = $ar_fields["PROPERTY_FULLNAME_VALUE"];
                        //CEvent::Send('EVENTS_SUBSCRIBE',SITE_ID, $arSend, 'N', 71);
                        if ($arFieldsForEmail["PROPERTY_USE_EMPTY_TPL_ENUM_ID"] == "104") {
                            CEvent::Send('EVENTS_SUBSCRIBE', SITE_ID, $arSend, 'N', 89);
                        } else {
                            CEvent::Send('EVENTS_SUBSCRIBE', SITE_ID, $arSend, 'N', 71);
                        }

                    }

                }
                //iwrite($arSend);
                //die();
                CIBlockElement::SetPropertyValuesEx($arFields["ID"], false, array("FLAG_SEND_MAIL" => 100));
            }

            // заполним дефолтовыми значениями из спровочника меропритияй ID =73   (ID свойства 341)
            if (strlen($arFieldsForEmail['PROPERTY_ID_LINKED_REFER_VALUE']) > 0) {
                $idLinkedReferenceEvent = $arFieldsForEmail['PROPERTY_ID_LINKED_REFER_VALUE'];
                echo "idLinkedReferenceEvent = $idLinkedReferenceEvent";
                $arOrder = array();
                $arSort = array();
                $arGroupBy = false;
                $arNavStartParams = array();
                $arFilter = array("IBLOCK_ID" => 73, "ID" => $idLinkedReferenceEvent);
                $arSelectFields = array("ID", "PROPERTY_TYPE_EVENT", "PROPERTY_VERSION", "PROPERTY_DURATION", "PROPERTY_DESCRIPTION",
                    "PROPERTY_CONTENT", "PROPERTY_PEOPLE", "PROPERTY_ID_LINKED_COURSES", "PROPERTY_LECTURER");
                $res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
                while ($ar_fields = $res->GetNext()) {
                    //PROPERTY_TYPE_EVENT
                    //iwrite($ar_fields);
                    //91 - семинар  - 105
                    //92 - вебинар  - 106
                    if ($ar_fields['PROPERTY_TYPE_EVENT_ENUM_ID'] == 106) {
                        $arValues['type_event'] = 92;
                    }
                    if ($ar_fields['PROPERTY_TYPE_EVENT_ENUM_ID'] == 105) {
                        $arValues['type_event'] = 91;
                    }
                    $arValues['description'] = $ar_fields["~PROPERTY_DESCRIPTION_VALUE"];
                    $arValues['content'] = $ar_fields["~PROPERTY_CONTENT_VALUE"];
                    $arValues['people'] = $ar_fields["~PROPERTY_PEOPLE_VALUE"];
                    $arValues['lecturer'] = $ar_fields["PROPERTY_LECTURER_VALUE"];
                    $arValues['ID_LINKED_COURSES'] = $ar_fields["PROPERTY_ID_LINKED_COURSES_VALUE"];
                    $arValues['ID_LINKED_REFER'] = "";

                }
                CIBlockElement::SetPropertyValuesEx($arFields["ID"], $arFields["IBLOCK_ID"], $arValues);
                //iwrite($arValues);
                // die();
            }
            $vCountRegisteredForEvent = GetCountRegisteredForEvent($arFieldsForEmail['ID']);
            $arNewData['CURRENT_COUNT'] = $vCountRegisteredForEvent;
            if ($arFieldsForEmail['PROPERTY_MAX_NUM_VALUE'] > 0) {
                if ($vCountRegisteredForEvent > $arFieldsForEmail['PROPERTY_MAX_NUM_VALUE']) {
                    $arNewData['FLAG_CLOSE_REG'] = 101;
                }
            }
            CIBlockElement::SetPropertyValuesEx($arFields["ID"], $arFields["IBLOCK_ID"], $arNewData);
        } /* END ID = 7 */

        /*
        нам нужно обединить даты семинаров, круглых столов, конференций в один инфоблок для  использования календаря (уменьшение кол-ва  запросов)
        в этом блоке синхронизируем изменения СЕМИНАРОВ:
        параметры:
        7 - ID инфоблока Семинары
        65 - ID результирующего инфоблока всех мероприятий
        16 - дата начала семинаров
        17 - дата окончания; если пустое то присвоем ему дату начала
        257 - id свойство типа события меропрития; возможные варианты:
                85 - семинары
                86 - круглый стол
                87 - конференеция
                95 - вебинары
        259 - id города
        284  - тип вебинары (92) или семинары (91 семинар - по умолчанию)

        */
        if ($arFields["IBLOCK_ID"] == 7) {
            $ELEMENT_ID = $arFields["ID"];
            $IBLOCK_ID = 65;
            $ACTIVE = $arFields["ACTIVE"];
            $idSeminarType = 85;
            if ($arFields["PROPERTY_VALUES"][284][0] == 92) {
                $idSeminarType = 95;
            }
            $arDateBegin = $arFields["PROPERTY_VALUES"][16];
            foreach ($arDateBegin as $arValue) {
                foreach ($arValue as $value) {
                    $ev_date_begin = $value;
                }
            }
            $arDateEnd = $arFields["PROPERTY_VALUES"][17];
            foreach ($arDateEnd as $arValue) {
                foreach ($arValue as $value) {
                    $ev_date_end = $value;
                }
                $ev_date_end = $v;
            }
            if (strlen($ev_date_end) > 0) {
            } else {
                $ev_date_end = $ev_date_begin;
            }
            $ev_name = $arFields["NAME"];
            $ev_ext_id = $arFields["ID"];
            //формируем массив элементов для вставки в инфоблок
            $arCity = $arFields["PROPERTY_VALUES"][58];
            foreach ($arCity as $value) {
                $id_city = $value;
            }
            $PROP = array();
            $PROP[257] = $idSeminarType;
            $PROP[259] = $id_city;
            $arNewElementValues = array(
                "MODIFIED_BY" => 1,
                "IBLOCK_ID" => $IBLOCK_ID,
                "ACTIVE_FROM" => $ev_date_begin,
                "ACTIVE_TO" => $ev_date_end,
                "NAME" => $ev_name,
                "ACTIVE" => $ACTIVE,
                "PROPERTY_VALUES" => $PROP,
                "XML_ID" => $ev_ext_id,
            );
            $flag = 0;  // 1 - значит не буим добавлять ибо существует  запись с  а будем апдейтить;
            // 0 - добавляем;
            /*
            $resIb65 = CIBlockElement::GetList(['ID' => 'DESC'], ['IBLOCK_TYPE' => 'edu','IBLOCK_ID' => 65, 'ID' => $ev_ext_id], false, false, ['IBLOCK_ID','ID','XML_ID']);
           if($arFields = $resIb65->GetNext()) {
               $ExistsElement = new CIBlockElement;
               $ExistsElement->Update($arFields['ID'], $arNewElementValues);
           } else {
               $NewElement = new CIBlockElement;
               $NewElement->Add($arNewElementValues);
           }
            */
        }


        /*
        нам нужно объединить даты семинаров, круглых столов, конференций в один инфоблок для  использования календаря
        в этом блоке синхронизируем изменения СЕМИНАРОВ:
        параметры:
        66 - ID инфоблока Конференции
        65 - ID результирующего инфоблока всех мероприятий
        16 - дата начала семинаров
        17 - дата окончания; если пустое то присвоем ему дату начала
        257 - id свойство типа события меропрития; возможные варианты:
                85 - семинары
                86 - круглый стол
                87 - конференеция
        259 - id города
        */
        if ($arFields["IBLOCK_ID"] == 66) {
            $ELEMENT_ID = $arFields["ID"];
            $IBLOCK_ID = 65;
            $ACTIVE = $arFields["ACTIVE"];
            $ev_date_begin = $arFields["ACTIVE_FROM"];
            $ev_date_end = $arFields["ACTIVE_TO"];

            $not_insert = $arFields["PROPERTY_VALUES"][263][0];
            //echo "not_insert=$not_insert";
            //print_r($arFields);
            //die();
            if ($not_insert == 88) {
            } else {
                if (strlen($ev_date_end) > 0) {
                } else {
                    $ev_date_end = $ev_date_begin;
                }
                $ev_name = $arFields["NAME"];
                $ev_ext_id = $arFields["ID"];
                //формируем массив элементов для вставки в инфоблок
                $arCity = $arFields["PROPERTY_VALUES"][261];
                foreach ($arCity as $value) {
                    $id_city = $value;
                }
                $arLink = $arFields["PROPERTY_VALUES"][262];
                foreach ($arLink as $value) {
                    $conference_link = $value;
                }
                $PROP = array();
                $PROP[257] = 87;
                $PROP[258] = $conference_link;
                $PROP[259] = $id_city;
                $arNewElementValues = array(
                    "MODIFIED_BY" => 1,
                    "IBLOCK_ID" => $IBLOCK_ID,
                    "ACTIVE_FROM" => $ev_date_begin,
                    "ACTIVE_TO" => $ev_date_end,
                    "NAME" => $ev_name,
                    "ACTIVE" => $ACTIVE,
                    "PROPERTY_VALUES" => $PROP,
                    "XML_ID" => $ev_ext_id,
                );
                $flag = 0;  // 1 - значит не буим добавлять ибо существует  запись с  а будем апдейтить;
                // 0 - добавляем;

                $arGroupBy = false;
                $arFilter = array();
                $arSelectFields = array("ID");
                $arFilter = array("IBLOCK_ID" => 65, "XML_ID" => $ev_ext_id);
                $arOrder = array();
                $res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
                while ($arFields = $res->GetNext()) {
                    $flag = 1;
                    $EXISTS_ELEMENT_ID = $arFields["ID"];
                }

                if ($flag == 0) {

                    $NewElement = new CIBlockElement;
                    if ($NEW_ELEMENT_ID = $NewElement->Add($arNewElementValues)) {
                        //echo "New element ID: ".$NEW_ELEMENT_ID;
                        //echo "<br />";
                    } else {
                        //echo "Error111";
                        //print_r($arNewElementValues);
                    }
                }

                if ($flag == 1) {
                    $ExistsElement = new CIBlockElement;
                    if ($result = $ExistsElement->Update($EXISTS_ELEMENT_ID, $arNewElementValues)) {
                        //echo "OK";
                    } else {
                        //echo "Error222";
                    }
                }
            }
        }
        /*
         ИБ 64 - ИБ записи на курсы, семинары, вебинары
         тут отсылаем письма - уведомления о получении заявки
         290  - ID записи мероприятия
         271  - город где проводится мероприятие
         IBLOCK_ID = 7 - "УЦ Семинары, вебинары"
        */

        if ($arFields["IBLOCK_ID"] == 64) {
            /*if ($USER->IsAdmin()) {
                echo "321";
                die;
            }*/
            $id_webinar = &$_GET['ID'];
            $reg_link = "";
            global $USER;
            if (isset($id_webinar) and (is_numeric($id_webinar))) {
                $ELEMENT_ID = $arFields["ID"];
                CIBlockElement::SetPropertyValueCode($ELEMENT_ID, "290", $id_webinar);

                if (isset($_GET['ID_TIME']) and (is_numeric($_GET['ID_TIME']))) {
                    CIBlockElement::SetPropertyValues($ELEMENT_ID, $arFields["IBLOCK_ID"], "313", $_GET['ID_TIME']);
                }
                /*	$arSelect = Array("ID", "PROPERTY_CITY", "PROPERTY_CITY.NAME");
                    $arFilter = Array("IBLOCK_ID"=>9,"ID"=>$_GET['ID_TIME']);
                    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                    while($ar_fields = $res->GetNext())
                    {
                        if (strlen($ar_fields["PROPERTY_CITY_NAME"])>0){
                            CIBlockElement::SetPropertyValueCode($ELEMENT_ID, "271", $ar_fields["PROPERTY_CITY_NAME"]);
                        }
                    }
                }
                */
                /*$arOrder = Array();
                $arFilter = Array("IBLOCK_ID"=>7, "ID"=>$id_webinar );
                $arGroupBy = false;
                $arNavStartParams = false;
                $arSelectFields = Array("ID", "NAME", "PROPERTY_REGISTRATION_LINK", "PROPERTY_EMAIL","PROPERTY_TIME" );
                $res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
                while($ob = $res->GetNextElement())
                {
                    $arFields2 = $ob->GetFields();
                    $reg_link = $arFields2["PROPERTY_REGISTRATION_LINK_VALUE"];
                    $reg_id = $arFields2["ID"];
                    $reg_name_responsible = $arFields2["PROPERTY_EMAIL_VALUE"];
                    $reg_time = $arFields2["PROPERTY_TIME_VALUE"];
                }
                */
            }

            // It was 205

            if (($arFields["ID"]) > 0) {
                $arOrder = array();
                $arFilter = array("IBLOCK_ID" => 64, "ID" => $arFields["ID"]);
                $arGroupBy = false;
                $arNavStartParams = false;
                $arSelectFields = array(
                    "NAME", "PROPERTY_FULLNAME", "PROPERTY_EMAIL", "PROPERTY_TYPE", "PROPERTY_DATE", "PROPERTY_COMPANY",
                    "PROPERTY_TELEPHONE", "PROPERTY_CAT_COURSE", "PROPERTY_CITY", "PROPERTY_DOLGNOST", "PROPERTY_DOLGNOST", "PROPERTY_EVENT_CITY", "PROPERTY_EVENT_ID",
                    "PROPERTY_TIMETABLE_ID", "PROPERTY_COMMENT", "PROPERTY_ID_CITY_ORDER", "PROPERTY_LINK_DISCOUNT", "PROPERTY_lastname", "PROPERTY_firstname", "PROPERTY_middlename");
                $res2 = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
                while ($ob = $res2->GetNextElement()) {
                    $arFields3 = $ob->GetFields();
                    $orderer_name = $arFields3["PROPERTY_FULLNAME_VALUE"];
                    $orderer_email = $arFields3["PROPERTY_EMAIL_VALUE"];
                    $orderer_type = $arFields3["PROPERTY_TYPE_VALUE"];
                    $orderer_date = $arFields3["PROPERTY_DATE_VALUE"];
                    $orderer_company = $arFields3["PROPERTY_COMPANY_VALUE"];
                    $orderer_tel = $arFields3["PROPERTY_TELEPHONE_VALUE"];
                    $orderer_city = $arFields3["PROPERTY_CITY_VALUE"];
                    $orderer_dolgnost = $arFields3["PROPERTY_DOLGNOST_VALUE"];
                    $orderer_name = $arFields3["PROPERTY_FULLNAME_VALUE"];
                    $orderer_event_city = $arFields3["PROPERTY_EVENT_CITY_VALUE"];
                    $orderer_event = $arFields3["NAME"];
                    $orderer_event_id = $arFields3["PROPERTY_EVENT_ID_VALUE"];
                    $orderer_timetable_id = $arFields3["PROPERTY_TIMETABLE_ID_VALUE"];
                    $link_dis = $arFields3["PROPERTY_LINK_DISCOUNT_VALUE"];
                    $commentOrder = $arFields3["PROPERTY_COMMENT_VALUE"];
                    $orderer_courseID = $arFields3["PROPERTY_CAT_COURSE_VALUE"];
                    $cityID = $arFields3['PROPERTY_ID_CITY_ORDER_VALUE'];
                    $arRecordEventInfo = $arFields3;
                    $firstname = $arFields3['PROPERTY_FIRSTNAME_VALUE'];
                    $lastname = $arFields3['PROPERTY_LASTNAME_VALUE'];
                    $secondname = $arFields3['PROPERTY_MIDDLENAME_VALUE'];
                }
                global $USER;
                if (!$USER->IsAuthorized()) {
                    $rsUsers = CUser::GetList(($by = "ID"), ($order = "desc"), array("EMAIL" => trim($orderer_email)));
                    if ($arUser = $rsUsers->GetNext()) {
                        $PROP["USER"] = $arUser["ID"];
                    } else {
                        $NEW_LOGIN = $orderer_email;
                        $NEW_EMAIL = $orderer_email;
                        $def_group = COption::GetOptionString("main", "new_user_registration_def_group", "");
                        if ($def_group != "") {
                            $GROUP_ID = explode(",", $def_group);
                            $arPolicy = $USER->GetGroupPolicy($GROUP_ID);
                        } else {
                            $arPolicy = $USER->GetGroupPolicy(array());
                        }
                        $password_min_length = intval($arPolicy["PASSWORD_LENGTH"]);
                        if ($password_min_length <= 0)
                            $password_min_length = 6;
                        $password_chars = array(
                            "abcdefghijklnmopqrstuvwxyz",
                            "ABCDEFGHIJKLNMOPQRSTUVWXYZ",
                            "0123456789",
                        );
                        if ($arPolicy["PASSWORD_PUNCTUATION"] === "Y")
                            $password_chars[] = ",.<>/?;:'\"[]{}\|`~!@#\$%^&*()-_+=";
                        $NEW_PASSWORD = $NEW_PASSWORD_CONFIRM = randString($password_min_length + 2, $password_chars);
                        $user = new CUser;
                        $arAuthResult = $user->Add(array(
                                "LOGIN" => strtolower($NEW_EMAIL),
                                "WORK_COMPANY" => $orderer_company,
                                "NAME" => $firstname,
                                "LAST_NAME" => $lastname,
                                "SECOND_NAME" => $secondname,
                                "PASSWORD" => $NEW_PASSWORD,
                                "PASSWORD_CONFIRM" => $NEW_PASSWORD_CONFIRM,
                                "EMAIL" => strtolower($NEW_EMAIL),
                                "GROUP_ID" => $GROUP_ID,
                                "ACTIVE" => "Y",
                                "LID" => SITE_ID,
                            )
                        );
                        if (IntVal($arAuthResult) <= 0) {
                            $arResult["FORM_ERRORS"] = $arResult["FORM_ERRORS"] . "\n\r" . $user->LAST_ERROR;
                        } else {
                            $PROP["USER"] = IntVal($arAuthResult);
                            $arEventFields = array(
                                "EMAIL" => strtolower($NEW_EMAIL),
                                "PASSWORD" => $NEW_PASSWORD,
                                "NAME" => "",
                                "LAST_NAME" => "",
                            );
                            CEvent::Send("NEW_USER_LK", SITE_ID, $arEventFields, "Y", "135");

                        }
                    }
                } else {
                    $PROP["USER"] = $USER->GetID();
                }
                if (intval($orderer_timetable_id) == 0) {
                    $PROP["COURSE"] = $orderer_courseID;
                } else {
                    $PROP["SCH_COURSE"] = intval($orderer_timetable_id);
                }
                $el = new CIBlockElement;
                $arLoadProductArray = array(
                    "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
                    "IBLOCK_ID" => 108,
                    "PROPERTY_VALUES" => $PROP,
                    "NAME" => $PROP["USER"] . "_" . $orderer_courseID . $orderer_event_id . "_" . date("Y_m_d"),
                    "ACTIVE" => "Y",            // активен
                );
                if ($PRODUCT_ID = $el->Add($arLoadProductArray))
                    $PRODUCT_ID;
                CreateReccommend($PROP["USER"], $orderer_courseID, $cityID);
                if (strlen($commentOrder) == 0) {
                    $commentOrder = "без комментария к заявке";
                }
                $email_go_to = EMAIL_ADDRESS;
                $discount_string = "";
                if (intval($link_dis) > 0) {
                    $discount_string = "<br/> <b>Скидка пользователя: </b>" . $link_dis . "%";
                };


                $arSend = array(
                    'TEXT' =>
                        '<b>запись на событие: </b>' . $arFields3["NAME"] .
                        '<br/> <b>тип: </b>' . $arFields3["PROPERTY_TYPE_VALUE"] .
                        '<br/> <b>дата: </b>' . $arFields3["PROPERTY_DATE_VALUE"] .
                        '<br/> <b>фио: </b>' . $arFields3["PROPERTY_FULLNAME_VALUE"] .
                        '<br/> <b>телефон: </b>' . $arFields3["PROPERTY_TELEPHONE_VALUE"] .
                        '<br/> <b>E-mail: </b>' . $arFields3["PROPERTY_EMAIL_VALUE"] .
                        '<br/> <b>компания: </b>' . $arFields3["PROPERTY_COMPANY_VALUE"] .
                        '<br/> <b>город: </b>' . $arFields3["PROPERTY_CITY_VALUE"] .
                        '<br/> <b>должность: </b>' . $arFields3["PROPERTY_DOLGNOST_VALUE"] . $discount_string .
                        '<br/> <b>Комментарий к заявке: </b>' . $commentOrder,
                    'ID_RECORD' => $arFields["ID"],
                    'EDU_MAIL' => $email_go_to,
                    'EDU_TYPE' => $arFields3["PROPERTY_TYPE_VALUE"],
                    'EDU_EVENT' => $arFields3["NAME"],
                    'EDU_EVENT_CITY' => $arFields3["PROPERTY_EVENT_CITY_VALUE"],
                    'EDU_EVENT_COMMENT' => $arFields3["PROPERTY_COMMENT_VALUE"],
                );

                $arSendEvent = array(
                    'ID_RECORD' => $arFields["ID"],
                    'EDU_EVENT_EVENT_ID' => $arFields3["PROPERTY_EVENT_ID_VALUE"],
                    'EDU_EVENT_USER_EMAIL' => $arFields3["PROPERTY_EMAIL_VALUE"],
                    'EDU_EVENT_FIO' => $arFields3["PROPERTY_FULLNAME_VALUE"],
                    'EDU_EVENT_DATE' => $arFields3["PROPERTY_DATE_VALUE"],
                    'EDU_EVENT_TYPE' => $arFields3["PROPERTY_TYPE_VALUE"],
                    'EDU_EVENT_NAME' => $arFields3["NAME"],
                    'EDU_EVENT_CITY' => $arFields3["PROPERTY_EVENT_CITY_VALUE"],
                );

                if ($orderer_type == "Курсы") {
                    CStatEvent::AddCurrent("form_filled", "courses", $id_webinar);
                }
                if ($orderer_type == "Школы") {
                    CStatEvent::AddCurrent("form_filled", "schools", $id_webinar);
                }

                //если курсы
                $mystring = $arFields3["NAME"];
                $findme = '-ONL';
                $pos = strpos($mystring, $findme);
                $findme_onlineclass = 'онлайн';
                $pos_online = strpos($mystring, $findme_onlineclass);
                //если курсы получим, время, цену, длит
                if (($arFields3["PROPERTY_TYPE_ENUM_ID"] == 78) and (strlen($arFields3["PROPERTY_TIMETABLE_ID_VALUE"]) > 0)) {
                    $arFilterCourseTimetable = array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "ID" => $arFields3["PROPERTY_TIMETABLE_ID_VALUE"]);
                    $arSelectFieldsCourseTimetable = array(
                        "NAME", "ID", "PROPERTY_SCHEDULE_TIME", "PROPERTY_COURSE_CODE", "PROPERTY_SCHEDULE_COURSE", "PROPERTY_SCHEDULE_DURATION",
                        "PROPERTY_SCHEDULE_PRICE", "PROPERTY_COURSE_SALE", "PROPERTY_CITY", "PROPERTY_STARTDATE", "PROPERTY_ENDDATE", "PROPERTY_CITY.NAME", "PROPERTY_COURSE_ID",);
                    $resTimetable = CIBlockElement::GetList(array(), $arFilterCourseTimetable, false, false, $arSelectFieldsCourseTimetable);
                    while ($obCourseTimetable = $resTimetable->GetNextElement()) {
                        $arFieldsCourseTimetable = $obCourseTimetable->GetFields();
                        $arSendEvent['COURSE_NAME'] = $arFieldsCourseTimetable["NAME"];
                        $arSendEvent['COURSE_CODE'] = $arFieldsCourseTimetable["PROPERTY_COURSE_CODE_VALUE"];
                        $arSendEvent['TIMETABLE_ID'] = $arFieldsCourseTimetable["ID"];
                        $arSendEvent['COURSE_TIME'] = $arFieldsCourseTimetable["PROPERTY_SCHEDULE_TIME_VALUE"];
                        $arSendEvent['COURSE_DURATION'] = $arFieldsCourseTimetable["PROPERTY_SCHEDULE_DURATION_VALUE"] . " ч.";
                        $arSendEvent['COURSE_PRICE'] = $arFieldsCourseTimetable["PROPERTY_SCHEDULE_PRICE_VALUE"];
                        $arSendEvent['CITY_ID'] = $arFieldsCourseTimetable["PROPERTY_CITY_VALUE"];
                        $arSendEvent['COURSE_ID'] = $arFieldsCourseTimetable["PROPERTY_SCHEDULE_COURSE_VALUE"];
                        //iwrite($arFieldsCourseTimetable);
                        $arSendEvent['DISCOUNT_PRICE'] = "";
                        $arSendEvent['DIS_FLAG'] = "";
                        if (($arSendEvent['CITY_ID'] == "5745") or ($arSendEvent['CITY_ID'] == "5746") or ($arSendEvent['CITY_ID'] == "5747")) {
                            $arSendEvent['CITY_CURRENCY'] = "грн.";
                        } else {
                            $arSendEvent['CITY_CURRENCY'] = "руб.";
                        }
                        if (intval($link_dis) > 0) {
                            $arSendEvent['DISCOUNT_PRICE'] = "Стоимость с учетом скидки: " . (100 - $link_dis) * $arSendEvent['COURSE_PRICE'] / 100 . " " . $arSendEvent['CITY_CURRENCY'] . "<br/>";
                            $arSendEvent['DIS_FLAG'] = "&dis=seo";
                        }

                        if ($arFieldsCourseTimetable["ID"] == "52697") {
                            $arSendEvent['DISCOUNT_PRICE'] = "Вы можете посетить последующие курсы программы «Менеджер проектов в IT» по более выгодным ценам:<br/>
                            <a href='https://ibs-training.ru/kurs/otsenka_planirovanie_i_kontrol_ispolneniya_proekta.html?ID_TIME=52698'>PM-002 Оценка, планирование и контроль исполнения проекта</a>  – со скидкой 5%<br/>
                            <a href='https://ibs-training.ru/kurs/rabota_s_personalom_v_proekte.html?ID_TIME=52699'>PM-003 Работа с персоналом в проекте</a> – со скидкой 10%<br/>
                            <a href='https://ibs-training.ru/kurs/otsenka_proekta_razmer_i_trudozatraty_.html?ID_TIME=52700'>PM-004 Оценка проекта: размер и трудозатраты</a>– со скидкой 15%<br/>
                            <br/>";
                        }
                        if ($arFieldsCourseTimetable["ID"] == "52698") {
                            $arSendEvent['DISCOUNT_PRICE'] = "Вы можете посетить последующие курсы программы «Менеджер проектов в IT» по более выгодным ценам:<br/>
                            <a href='https://ibs-training.ru/kurs/rabota_s_personalom_v_proekte.html?ID_TIME=52699'>PM-003 Работа с персоналом в проекте</a> – со скидкой 10%<br/>
                            <a href='https://ibs-training.ru/kurs/otsenka_proekta_razmer_i_trudozatraty_.html?ID_TIME=52700'>PM-004 Оценка проекта: размер и трудозатраты</a>– со скидкой 15%<br/>
                            <br/>";
                        }
                        if ($arFieldsCourseTimetable["PROPERTY_SCHEDULE_COURSE_VALUE"] == 22365 || $arFieldsCourseTimetable["PROPERTY_SCHEDULE_COURSE_VALUE"] == 22366) {
                            $arSendEvent['DISCOUNT_PRICE'] = '<br/>Учебный центр Luxoft Training предоставляет возможность получения сертификата по системному анализу. 
Данная сертификация практикуется в компании «Luxoft» и является достаточной для выполнения роли системного аналитика в проектах международного уровня. 
Для получения сертификата необходимо пройти обучение по двум базовым курсам (<a href="https://ibs-training.ru/kurs/masterskaya_po_razrabotke_i_upravleniyu_trebovaniyami_uml_i_model_stsenariev_ispolzovaniya__use_case_model.html">REQ-002 "Мастерская по разработке и управлению требованиями. UML и Модель сценариев использования (Use Case Model)"</a>; <a href="https://ibs-training.ru/kurs/obektno-orientirovannyy__analiz_is_kontseptualnoe_modelirovanie_na_uml_dlya_sistemnyh_analitikov_.html">REQ-003 "Объектно-ориентированный анализ ИС. Концептуальное моделирование на UML для системных аналитиков"</a>) и успешно сдать онлайн-тестирование по изученным темам.<br/> 
Более подробно о сертификации Вы можете узнать у менеджера отдела продаж.';
                        }

                        //проверим ситуацию когда добаляется курс где
                        //поле  TIMETABLE_ID заполнено а все остальное  - нет
                        //такое происходит когда идет выбор из списка дат когда начнется курс
                        $arFieldsCourseInsert["event_city"] = $arFieldsCourseTimetable["PROPERTY_CITY_NAME"];
                        $arFieldsCourseInsert["date"] = $arFieldsCourseTimetable["PROPERTY_STARTDATE_VALUE"];
                        $arFieldsCourseInsert["date_end"] = $arFieldsCourseTimetable["PROPERTY_ENDDATE_VALUE"];
                        CIBlockElement::SetPropertyValuesEx($arFields["ID"], 64, $arFieldsCourseInsert);
                        //заполняем значение      $arFields3["PROPERTY_DATE_VALUE"] - по нему проверяется поставлен ли курс в расписание
                        $arFields3["PROPERTY_DATE_VALUE"] = $arFieldsCourseTimetable["PROPERTY_STARTDATE_VALUE"];
                        $arFields3["PROPERTY_END_DATE_VALUE"] = $arFieldsCourseTimetable["PROPERTY_ENDDATE_VALUE"];
                        $arFields3["PROPERTY_EVENT_CITY_VALUE"] = $arFieldsCourseTimetable["PROPERTY_CITY_NAME"];
                        $arSendEvent["EDU_EVENT_DATE"] = $arFieldsCourseTimetable["PROPERTY_STARTDATE_VALUE"];
                        $arSendEvent["EDU_EVENT_END_DATE"] = $arFieldsCourseTimetable["PROPERTY_ENDDATE_VALUE"];
                        $arSendEvent["EDU_EVENT_CITY"] = $arFieldsCourseTimetable["PROPERTY_CITY_NAME"];
                        $arSendEvent['EDU_EVENT_DATE'] = (!empty($arFields3["PROPERTY_END_DATE_VALUE"])) ? $arFields3["PROPERTY_DATE_VALUE"] . ' - ' . $arFields3["PROPERTY_END_DATE_VALUE"] : $arFields3["PROPERTY_DATE_VALUE"];
                        $arSendEvent['COURSE_PRICE'] = (!empty($arFieldsCourseTimetable['PROPERTY_COURSE_SALE_VALUE'])) ? number_format($arFieldsCourseTimetable['PROPERTY_SCHEDULE_PRICE_VALUE'] * (100 - $arFieldsCourseTimetable['PROPERTY_COURSE_SALE_VALUE']) / 100, 0, '', ' ') : number_format($arFieldsCourseTimetable['PROPERTY_SCHEDULE_PRICE_VALUE'], 0, '', ' ');

                        //заполним поле "входит ли тренинг в состав Класса(ов)"
                        $arSearchClasses = GetArrClassesContainsThisCourse($arSendEvent['TIMETABLE_ID']);
                        if (count($arSearchClasses) > 0) {
                            if (count($arSearchClasses) == 1) {
                                $PHRASE_CLASS = "Тренинг входит в состав Класса: ";
                                $PHRASE_CLASS = "Тренинг входит в состав Класса: ";
                            } else {
                                $PHRASE_CLASS = "Тренинг входит в состав следующих Классов: <br />";
                            }
                            foreach ($arSearchClasses as $arClassContent) {
                                $PHRASE_CLASS .= "<a href='https://ibs-training.ru/timetable/pp.html?ID=" . $arClassContent['ID'] . "'>" . $arClassContent['NAME'] . "</a><br />";
                            }
                        } else {
                            $PHRASE_CLASS = "";
                        }
                        $arSendEvent["COURSE_INSERT_IN"] = $PHRASE_CLASS;
                    }

                    $arSend['TEXT'] =
                        '<b>запись на событие: </b>' . $arFields3["NAME"] .
                        '<br/> <b>тип: </b>' . $arFields3["PROPERTY_TYPE_VALUE"] .
                        '<br/> <b>дата: </b>' . $arSendEvent['EDU_EVENT_DATE'] .
                        '<br/> <b>фио: </b>' . $arFields3["PROPERTY_FULLNAME_VALUE"] .
                        '<br/> <b>телефон: </b>' . $arFields3["PROPERTY_TELEPHONE_VALUE"] .
                        '<br/> <b>E-mail: </b>' . $arFields3["PROPERTY_EMAIL_VALUE"] .
                        '<br/> <b>компания: </b>' . $arFields3["PROPERTY_COMPANY_VALUE"] .
                        '<br/> <b>город: </b>' . $arFields3["PROPERTY_CITY_VALUE"] .
                        '<br/> <b>Стоимость: </b>' . $arSendEvent['COURSE_PRICE'] . ' ' . $arSendEvent['CITY_CURRENCY'] .
                        '<br/> <b>Комментарий к заявке: </b>' . $commentOrder;

                    CEvent::Send('NEW_COURSE_SUBSCRIBE', SITE_ID, $arSend, 'N');
                }

                if ($USER->IsAdmin()) {
                    //echo "<pre>";
                    //print_r($arSendEvent);
                    //die();
                }

                //
                //если семинары получим, время, цену, длит
                if ($arFields3["PROPERTY_TYPE_ENUM_ID"] == 80) {
                    $arFilterSeminar = array("IBLOCK_ID" => 7, "ID" => $arFields3["PROPERTY_EVENT_ID_VALUE"]);
                    $arSelectFieldsSeminar = array("ID", "NAME", "PROPERTY_REGISTRATION_LINK", "PROPERTY_LOCATION", "PROPERTY_TYPE_EVENT", "PROPERTY_TIME", "PROPERTY_REGISTRATION_LINK");
                    $resSeminar = CIBlockElement::GetList(array(), $arFilterSeminar, false, false, $arSelectFieldsSeminar);
                    while ($obSeminar = $resSeminar->GetNextElement()) {
                        $arFieldsSeminar = $obSeminar->GetFields();
                        $arSendEvent['WEBINAR_LINK'] = $arFieldsSeminar["PROPERTY_REGISTRATION_LINK_VALUE"];
                        $reg_link = $arFieldsSeminar["PROPERTY_REGISTRATION_LINK_VALUE"];
                        $arSendEvent["SEM_WEB_ID"] = $arFieldsSeminar["ID"];
                        $reg_id = $arFieldsSeminar["ID"];
                        $reg_name_responsible = $arFieldsSeminar["PROPERTY_EMAIL_VALUE"];
                        $reg_time = $arFieldsSeminar["PROPERTY_TIME_VALUE"];
                        $arSendEvent["SEM_WEB_TIME"] = $arFieldsSeminar["PROPERTY_TIME_VALUE"];
                        $arSendEvent["SEM_LOCATION"] = $arFieldsSeminar["PROPERTY_LOCATION_VALUE"];
                        //PROPERTY_TYPE_EVENT_ENUM_ID = 91 семинар
                        //PROPERTY_TYPE_EVENT_ENUM_ID = 92 вебинар
                    }
                }
                /*
                    78 - Курсы
                    79 - Школы
                    80 - Семинары
                    81 - Круглые столы
                    82 - Конференции
                */
                /*для курсов добавим связанные курсы:*/
                if ($arFields3["PROPERTY_TYPE_ENUM_ID"] == 78) {
                    $arSendEvent['COURSE_LINKED_COURSES'] = printLinkedCoursesToEmail($arSendEvent['EDU_EVENT_EVENT_ID']);
                }
                /*
                1 Повод: Регистрация на очный курс без даты
                https://ibs-training.ru/bitrix/admin/message_edit.php?lang=ru&ID=80&type=&tabControl_active_tab=edit1
                */
                if (($arFields3["PROPERTY_TYPE_ENUM_ID"] == 78) and
                    (strlen($arFields3["PROPERTY_DATE_VALUE"]) == 0) and
                    ($pos === false)) {
                    if (
                        preg_match("#dxc#", strtolower($arFields["PROPERTY_VALUES"]['company'])) ||
                        preg_match("#luxoft#", strtolower($arFields["PROPERTY_VALUES"]['company'])) ||
                        preg_match("#люксофт#", strtolower($arFields["PROPERTY_VALUES"]['company'])) ||
                        preg_match("#@luxoft#", strtolower($arSendEvent["EDU_EVENT_USER_EMAIL"])) ||
                        preg_match("#@dxc-luxoft#", strtolower($arSendEvent["EDU_EVENT_USER_EMAIL"])) ||
                        preg_match("#@dxc#", strtolower($arSendEvent["EDU_EVENT_USER_EMAIL"]))
                    ) {
                        CEvent::Send('DIFF_EVENTS_SEND', SITE_ID, $arSendEvent, "N", 148);
                    } else {
                        CEvent::Send('DIFF_EVENTS_SEND', SITE_ID, $arSendEvent, "N", 80);
                    }
                    //также добавим данного пользователя в списко подписчиков на данный тренинг
                    $newRecord = new CIBlockElement;
                    $PROP = array();
                    $PROP[389] = $arSendEvent["EDU_EVENT_EVENT_ID"];  // свойству с кодом 389 Курс
                    $PROP[390] = date("d.m.Y H:i:s");             // свойству с кодом 390 Дата подписки
                    $PROP[408] = $arRecordEventInfo['PROPERTY_ID_CITY_ORDER_VALUE'];
                    $arLoadSubcriberInfo = array(
                        "IBLOCK_ID" => 75,
                        "PROPERTY_VALUES" => $PROP,
                        "NAME" => $arSendEvent["EDU_EVENT_USER_EMAIL"],
                        "ACTIVE" => "Y",
                        "CODE" => $arSendEvent["COURSE_CODE"],
                    );
                    $IDSubsciber = $newRecord->Add($arLoadSubcriberInfo);
                }
                /*
                1а**** Повод: Регистрация на online курс без даты
                https://ibs-training.ru/bitrix/admin/message_edit.php?lang=ru&ID=90&type=&tabControl_active_tab=edit1
                */
                if (($arFields3["PROPERTY_TYPE_ENUM_ID"] == 78) and
                    (strlen($arFields3["PROPERTY_DATE_VALUE"]) == 0) and
                    ($pos !== false)) {
                    CEvent::Send('DIFF_EVENTS_SEND', SITE_ID, $arSendEvent, "N", 90);
                    //также добавим данного пользоватлея в списко подписчиков на данный тренинг
                    $newRecord = new CIBlockElement;
                    $PROP = array();
                    $PROP[389] = $arSendEvent['EDU_EVENT_EVENT_ID'];  // свойству с кодом 389 Курс
                    $PROP[390] = date("d.m.Y H:i:s");             // свойству с кодом 390 Дата подписки
                    $PROP[408] = $arRecordEventInfo['PROPERTY_ID_CITY_ORDER_VALUE'];
                    $arLoadSubcriberInfo = array(
                        "IBLOCK_ID" => 75,
                        "PROPERTY_VALUES" => $PROP,
                        "NAME" => $arSendEvent["EDU_EVENT_USER_EMAIL"],
                        "ACTIVE" => "Y",
                        "CODE" => $arSendEvent["COURSE_CODE"],
                    );
                    $IDSubsciber = $newRecord->Add($arLoadSubcriberInfo);
                }
                /*
                2 Повод:  Регистрация на очный курс, поставленный в расписание
                https://ibs-training.ru/bitrix/admin/message_edit.php?lang=ru&ID=81&type=this&tabControl_active_tab=edit1
                проверить нужно на оффлайн или онлайн  и выбрать тока  оффлайн
                */
                if (($arFields3["PROPERTY_TYPE_ENUM_ID"] == 78) and
                    (strlen($arFields3["PROPERTY_DATE_VALUE"]) > 0) and
                    ($pos === false) and ($arSendEvent['CITY_ID'] != CITY_ID_MOSCOW)) {
                    if (
                        preg_match("#dxc#", strtolower($arFields["PROPERTY_VALUES"]['company'])) ||
                        preg_match("#luxoft#", strtolower($arFields["PROPERTY_VALUES"]['company'])) ||
                        preg_match("#люксофт#", strtolower($arFields["PROPERTY_VALUES"]['company'])) ||
                        preg_match("#@luxoft#", strtolower($arSendEvent["EDU_EVENT_USER_EMAIL"])) ||
                        preg_match("#@dxc-luxoft#", strtolower($arSendEvent["EDU_EVENT_USER_EMAIL"])) ||
                        preg_match("#@dxc#", strtolower($arSendEvent["EDU_EVENT_USER_EMAIL"]))
                    ) {
                        CEvent::Send('DIFF_EVENTS_SEND', SITE_ID, $arSendEvent, "N", 148);
                    } else {
                        CEvent::Send('DIFF_EVENTS_SEND', SITE_ID, $arSendEvent, "N", 81);
                    }
                }

                if (($arFields3["PROPERTY_TYPE_ENUM_ID"] == 78) and
                    (strlen($arFields3["PROPERTY_DATE_VALUE"]) > 0) and
                    ($pos === false) and ($arSendEvent['CITY_ID'] == CITY_ID_MOSCOW)) {
                    if (
                        preg_match("#dxc#", strtolower($arFields["PROPERTY_VALUES"]['company'])) ||
                        preg_match("#luxoft#", strtolower($arFields["PROPERTY_VALUES"]['company'])) ||
                        preg_match("#люксофт#", strtolower($arFields["PROPERTY_VALUES"]['company'])) ||
                        preg_match("#@luxoft#", strtolower($arSendEvent["EDU_EVENT_USER_EMAIL"])) ||
                        preg_match("#@dxc-luxoft#", strtolower($arSendEvent["EDU_EVENT_USER_EMAIL"])) ||
                        preg_match("#@dxc#", strtolower($arSendEvent["EDU_EVENT_USER_EMAIL"]))
                    ) {
                        CEvent::Send('DIFF_EVENTS_SEND', SITE_ID, $arSendEvent, "N", 148);
                    } else {
                        CEvent::Send('DIFF_EVENTS_SEND', SITE_ID, $arSendEvent, "N", 146);
                    }
                }
                /*
                3 Повод:  Регистрация на online курс, поставленный в расписание
                https://ibs-training.ru/bitrix/admin/message_edit.php?lang=ru&ID=82&type=this&tabControl_active_tab=edit1
                проверить нужно на оффлайн или онлайн и выбрать тока  онлайн
                */
                if (($arFields3["PROPERTY_TYPE_ENUM_ID"] == 78) and
                    (strlen($arFields3["PROPERTY_DATE_VALUE"]) > 0) and
                    ($pos !== false)) {
                    CEvent::Send('DIFF_EVENTS_SEND', SITE_ID, $arSendEvent, "N", 82);
                }
                /*
                5 Повод:  Регистрация на очный класс в целом, поставленный в расписание
                https://ibs-training.ru/bitrix/admin/message_edit.php?lang=ru&ID=83&type=this&tabControl_active_tab=edit1
                */
                if (($arFields3["PROPERTY_TYPE_ENUM_ID"] == 79) and
                    (strlen($arFields3["PROPERTY_DATE_VALUE"]) > 0) and
                    ($pos_online === false)) {
                    $arSendEvent['CLASS_INFO'] = getClassFullInfo($arFields3["PROPERTY_EVENT_ID_VALUE"]);
                    CEvent::Send('DIFF_EVENTS_SEND', SITE_ID, $arSendEvent, "N", 83);
                }
                /*
                6 Повод:  Регистрация на online класс (бесплатный)
                https://ibs-training.ru/bitrix/admin/message_edit.php?lang=ru&ID=84&type=this&tabControl_active_tab=edit1
                */
                if (($arFields3["PROPERTY_TYPE_ENUM_ID"] == 79) and
                    (strlen($arFields3["PROPERTY_DATE_VALUE"]) > 0) and
                    ($pos_online !== false)) {
                    $arSendEvent['CLASS_INFO'] = getClassFullInfo($arFields3["PROPERTY_EVENT_ID_VALUE"]);
                    CEvent::Send('DIFF_EVENTS_SEND', SITE_ID, $arSendEvent, "N", 84);
                }
                /*
                7 Повод:  Регистрация на семинар (бесплатный)
                https://ibs-training.ru/bitrix/admin/message_edit.php?lang=ru&ID=85&type=this&tabControl_active_tab=edit1
                */
                if (($arFields3["PROPERTY_TYPE_ENUM_ID"] == 80) and ($arFieldsSeminar["PROPERTY_TYPE_EVENT_ENUM_ID"] == 91) and
                    (strlen($arSendEvent['WEBINAR_LINK']) == 0)) {
                    CEvent::Send('DIFF_EVENTS_SEND', SITE_ID, $arSendEvent, "N", 85);
                }
                /*
                8 Повод:  Регистрация на вебинар (бесплатный) со ссылкой если существует
                https://ibs-training.ru/bitrix/admin/message_edit.php?lang=ru&ID=86&type=this&tabControl_active_tab=edit1
                если существует линк на вебинар
                */
                if (($arFields3["PROPERTY_TYPE_ENUM_ID"] == 80) and ($arFieldsSeminar["PROPERTY_TYPE_EVENT_ENUM_ID"] == 92) and
                    (strlen($arSendEvent['WEBINAR_LINK']) > 0)) {
                    $arSendEvent["EDU_EVENT_TIME"] = $reg_time;
                    $arSendEvent["REGISTRATION_LINK"] = $arFieldsSeminar['PROPERTY_REGISTRATION_LINK_VALUE'];
                    CEvent::Send('DIFF_EVENTS_SEND', SITE_ID, $arSendEvent, "N", 86);
                }
                /*
                        8.1 Повод:  Регистрация на Self-learning курс
                        https://ibs-training.ru/bitrix/admin/message_edit.php?lang=ru&ID=214
                        */
                if (($arFields3["PROPERTY_TYPE_ENUM_ID"] == 80) and ($arFieldsSeminar["PROPERTY_TYPE_EVENT_ENUM_ID"] == 324) and (strlen($arSendEvent['WEBINAR_LINK']) > 0)) {
                    $arSendEvent["EDU_EVENT_TIME"] = $reg_time;
                    $arSendEvent["REGISTRATION_LINK"] = $arFieldsSeminar['PROPERTY_REGISTRATION_LINK_VALUE'];
                    CEvent::Send('DIFF_EVENTS_SEND', SITE_ID, $arSendEvent, "N", 214);
                }
                if ($arFields3["PROPERTY_TYPE_ENUM_ID"] == 80) {
                    $vCountRegisteredForEvent = GetCountRegisteredForEvent($arSendEvent['EDU_EVENT_EVENT_ID']);
                    $arNewData['CURRENT_COUNT'] = $vCountRegisteredForEvent;
                    $vGetMaxCountForEvent = GetMaxCountForEvent($arSendEvent['EDU_EVENT_EVENT_ID']);

                    if ($vGetMaxCountForEvent) {
                        if ($vCountRegisteredForEvent >= $vGetMaxCountForEvent) {
                            $arNewData['FLAG_CLOSE_REG'] = 101;
                            //iwrite($arNewData);
                            //iwrite($arSendEvent);
                            //die();
                        }
                        if ($vCountRegisteredForEvent == $vGetMaxCountForEvent) {
                            $arSendEvent['CURRENT_COUNT_RECORDS'] = $arNewData['CURRENT_COUNT'];
                            $arSendEvent['MAX_COUNT_RECORDS'] = $vGetMaxCountForEvent;
                            CEvent::Send('EVENTS_NOTIFICATION', SITE_ID, $arSendEvent, "N", 100);

                        }
                    }
                    CIBlockElement::SetPropertyValuesEx($arSendEvent['EDU_EVENT_EVENT_ID'], D_SEMINARS_IBLOCK, $arNewData);
                }
                /*
                9 Повод:  Регистрация на вебинар (бесплатный)  если  не существует линка
                https://ibs-training.ru/bitrix/admin/message_edit.php?lang=ru&ID=87&type=this&tabControl_active_tab=edit1
                если существует линк на вебинар  =  пусто
                */
                if (($arFields3["PROPERTY_TYPE_ENUM_ID"] == 80) and ($arFieldsSeminar["PROPERTY_TYPE_EVENT_ENUM_ID"] == 92) and
                    (strlen($arSendEvent['WEBINAR_LINK']) == 0)) {
                    $arSendEvent["EDU_EVENT_TIME"] = $reg_time;
                    $arSendEvent["REGISTRATION_LINK"] = $arFieldsSeminar['PROPERTY_REGISTRATION_LINK_VALUE'];
                    CEvent::Send('DIFF_EVENTS_SEND', SITE_ID, $arSendEvent, "N", 87);
                }

                /*
                10  Повод:  Регистрация на мастер-класс
                */
                if ($arFields3["PROPERTY_TYPE_ENUM_ID"] == 205) {
                    // берем элемент инфоблока Лендинга
                    $arFilterM = array("IBLOCK_ID" => 159, "ID" => (int)$_REQUEST['PROPERTY']['314'][0]);
                    $arSelectM = array(
                        "ID",
                        "IBLOCK_ID",
                        "NAME",
                        "PROPERTY_*"
                    );
                    $resM = CIBlockElement::GetList(array(), $arFilterM, false, false, $arSelectM);
                    while ($ob = $resM->GetNextElement()) {
                        $arprops = $ob->GetProperties();
                        $price1 = (int)$arprops["PRICE_1"]["VALUE"];
                        $price2 = (int)$arprops["PRICE_2"]["VALUE"];

                        $date2 = date('d.m.Y', strtotime($arprops["DATE_2"]["VALUE"]));
                        $dateEvent = date('d.m.Y', strtotime($arprops["DATE_EVENT"]["VALUE"]));
                        $curDate = date("d.m.Y");
                        $timeEvent = $arprops["TIME_START"]["VALUE"] . '-' . $arprops["TIME_END"]["VALUE"];

                        $timeStart = date_parse($arprops["TIME_START"]["VALUE"])['hour'];
                        $timeEnd = date_parse($arprops["TIME_END"]["VALUE"])['hour'];
                        $timeSpan = $timeEnd - $timeStart;

                        $curPrice = $price1;
                        if (strtotime($curDate) > strtotime($date2) && strtotime($curDate) < strtotime($dateEvent))
                            $curPrice = $price2;
                    }

                    CIBlockElement::SetPropertyValueCode($arFields['ID'], 'date', $dateEvent);            // дата мастер-класса

                    $arSendMC = array(
                        'TEXT' =>
                            '<b>запись на событие: </b>' . $arFields3["NAME"] .
                            '<br/> <b>тип: </b>' . $arFields3["PROPERTY_TYPE_VALUE"] .
                            '<br/> <b>дата: </b>' . $dateEvent .
                            '<br/> <b>цена: </b>' . $curPrice .
                            '<br/> <b>фио: </b>' . $arFields3["PROPERTY_FULLNAME_VALUE"] .
                            '<br/> <b>телефон: </b>' . $arFields3["PROPERTY_TELEPHONE_VALUE"] .
                            '<br/> <b>E-mail: </b>' . $arFields3["PROPERTY_EMAIL_VALUE"] .
                            '<br/> <b>компания: </b>' . $arFields3["PROPERTY_COMPANY_VALUE"] .
                            '<br/> <b>Комментарий к заявке: </b>' . $commentOrder,
                        'ID_RECORD' => $arFields["ID"],
                        'EDU_MAIL' => $email_go_to,
                        'EDU_TYPE' => $arFields3["PROPERTY_TYPE_VALUE"],
                        'EDU_EVENT_NAME' => $arFields3["NAME"],
                        'EDU_EVENT_CITY' => $arFields3["PROPERTY_EVENT_CITY_VALUE"],
                        'EDU_EVENT_COMMENT' => $arFields3["PROPERTY_COMMENT_VALUE"],
                    );

                    $arSendEvent['EDU_EVENT_TIME'] = $timeEvent;
                    $arSendEvent['EDU_EVENT_DURATION'] = $timeSpan;
                    $arSendEvent['EDU_EVENT_PRICE'] = $curPrice;

                    if (
                        preg_match("#dxc#", strtolower($arFields["PROPERTY_VALUES"]['company'])) ||
                        preg_match("#luxoft#", strtolower($arFields["PROPERTY_VALUES"]['company'])) ||
                        preg_match("#люксофт#", strtolower($arFields["PROPERTY_VALUES"]['company'])) ||
                        preg_match("#@luxoft#", strtolower($arSendEvent["EDU_EVENT_USER_EMAIL"])) ||
                        preg_match("#@dxc-luxoft#", strtolower($arSendEvent["EDU_EVENT_USER_EMAIL"])) ||
                        preg_match("#@dxc#", strtolower($arSendEvent["EDU_EVENT_USER_EMAIL"]))
                    ) // сотрудник Luxoft
                    {
                        CEvent::Send('DIFF_EVENTS_SEND', SITE_ID, $arSendEvent, "N", "204");
                    } else // не сотрудник Люксофт
                    {
                        CEvent::Send('DIFF_EVENTS_SEND', SITE_ID, $arSendEvent, 'N', "205");
                    }
                    CEvent::Send('DIFF_EVENTS_SEND', SITE_ID, $arSendMC, 'N', "206"); // sales
                }

                /*
                11  Повод:  Регистрация на школу
                */
                if ($arFields3["PROPERTY_TYPE_ENUM_ID"] == 79) {
                    // берем элемент инфоблока Лендинга
                    $event_id = (int)$_REQUEST['PROPERTY']['314'][0];
                    $arFilterM = array("IBLOCK_ID" => 162, "ID" => $event_id);
                    $arSelectM = array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
                    $resM = CIBlockElement::GetList(array(), $arFilterM, false, false, $arSelectM);
                    if ($ob = $resM->GetNextElement()) {
                        $arProps = $ob->GetProperties();

                        $currentDate = date("d.m.Y");

                        $arSchool = array(
                            'event_id' => $event_id,
                            'duration' => intval($_REQUEST['PROPERTY']['315'][0]),

                            'sale_price' => (int)$arProps["PRICE_1"]["VALUE"],
                            'full_price' => (int)$arProps["PRICE_2"]["VALUE"],
                            'sale_date' => date('d.m.Y', strtotime($arProps["DATE_1"]["VALUE"])),

                            'event_dates' => $arProps["DATE_EVENT"]["VALUE"],

                            'time_start' => $arProps["TIME_START"]["VALUE"],
                            'time_end' => $arProps["TIME_END"]["VALUE"],
                            'time_range' => $arProps["TIME_START"]["VALUE"] . '-' . $arProps["TIME_END"]["VALUE"],

                            'structure' => $arProps['SCHOOL_STRUCTURE']["VALUE"]
                        );

                        // Определяем цену
                        if (!empty($arSchool['sale_price'])) {
                            $arSchool['current_price'] = (strtotime($currentDate) <= strtotime($arSchool['sale_date'])) ? $arSchool['sale_price'] : $arSchool['full_price'];
                        } else {
                            $arSchool['current_price'] = $arSchool['full_price'];
                        }

                        // проверка даты проведения мероприятия на интервал
                        $isDateRange = !(strtotime($arSchool['event_dates']));

                        // определние даты начала и конца мероприятия
                        if ($isDateRange) {
                            $arDateRange = explode("-", str_replace(' ', '', $arSchool['event_dates']));

                            $arSchool['date_start'] = date('d.m.Y', strtotime($arDateRange[0]));
                            $arSchool['date_end'] = date('d.m.Y', strtotime($arDateRange[1]));
                        } else {
                            $arSchool['date_start'] = $arSchool['date_end'] = date('d.m.Y', strtotime($arSchool['event_dates']));
                        }

                        // установка даты завершения мероприятия в инфоблок с заявками
                        CIBlockElement::SetPropertyValueCode($arFields['ID'], 'date', $arSchool['date_end']);

                        $isEventStart = (strtotime($currentDate) < strtotime($arSchool['date_start']));

                        // Формирование контента для почтового шаблона
                        if ($isEventStart) {
                            $arSendEvent['EVENT_CONTENT'] = "
                        <p>Вы зарегистрированы на школу <strong>" . $arFields3["NAME"] . "</strong>.</p>
                        <p>
                             Дата начала: " . $arSchool['date_start'] . " <br>
                             Время: " . $arSchool['time_range'] . "<br>
                             Длительность: " . $arSchool['duration'] . " часов<br>
                             Стоимость: " . $arSchool['current_price'] . " рублей<br>
                        </p>
                        <p>
                             Ближе к дате проведения школы Вам будет отправлено приглашение.
                        </p>";
                        } else {
                            // Поиск всех курсов мероприятия
                            $arSendEvent['EVENT_CONTENT'] = "";

                            if (count($arSchool['structure']) > 1) {


                                $arSendEvent['EVENT_CONTENT'] .= "<p>Вы зарегистрированы на школу <strong>" . $arFields3["NAME"] . "</strong>. Вас обязательно известят, когда школа будет поставлена в расписание.</p>
                            <p>На данный момент вы можете пройти обучение:</p>";

                                $rsStructure = CIBlockElement::GetList(
                                    array('PROPERTY_START_DAY' => 'ASC'),
                                    array('IBLOCK_ID' => '9', 'ID' => $arSchool['structure']),
                                    false, false,
                                    array(
                                        'IBLOLCK_ID', 'ID', 'NAME',
                                        'PROPERTY_SCHEDULE_COURSE', 'PROPERTY_STARTDATE', 'PROPERTY_ENDDATE',
                                        'PROPERTY_SCHEDULE_TIME', 'PROPERTY_SCHEDULE_PRICE', 'PROPERTY_SCHEDULE_ONL_PRICE',
                                        'PROPERTY_SCHEDULE_DURATION'
                                    )
                                );

                                while ($arStructure = $rsStructure->GetNext()) {
                                    $currentCourse = array(
                                        'ID' => $arStructure['ID'],
                                        'NAME' => $arStructure['NAME'],
                                        'COURSE_ID' => $arStructure['PROPERTY_SCHEDULE_COURSE_VALUE'],
                                        'DATE_START' => date('d.m.Y', strtotime($arStructure['PROPERTY_STARTDATE_VALUE'])),
                                        'DATE_END' => date('d.m.Y', strtotime($arStructure['PROPERTY_ENDDATE_VALUE'])),
                                        'TIME' => $arStructure['PROPERTY_SCHEDULE_TIME_VALUE'],
                                        'PRICE' => $arStructure['PROPERTY_SCHEDULE_PRICE_VALUE'],
                                        'PRICE_UA' => $arStructure['PROPERTY_SCHEDULE_ONL_PRICE_VALUE'],
                                        'DURATION' => $arStructure['PROPERTY_SCHEDULE_DURATION_VALUE']
                                    );

                                    if (strtotime($currentCourse['DATE_START']) < strtotime(date('d.m.Y'))) continue;

                                    if (!empty($currentCourse['DATE_END'])) {
                                        $currentCourse['DATE_RANGE'] = date('d.m.Y', strtotime($currentCourse['DATE_START'])) . ' - ' . date('d.m.Y', strtotime($currentCourse['DATE_END']));
                                    } else {
                                        $currentCourse['DATE_RANGE'] = date('d.m.Y', strtotime($currentCourse['DATE_START']));
                                    }

                                    if (!empty($currentCourse['COURSE_ID']) && (
                                            empty($currentCourse['PRICE']) ||
                                            empty($currentCourse['PRICE_UA']) ||
                                            empty($currentCourse['DURATION'])
                                        )
                                    ) {
                                        $rsCourses = CIBlockElement::GetList(
                                            array('PROPERTY_START_DAY' => 'ASC'),
                                            array('IBLOCK_ID' => '6', 'ID' => $arSchool['structure']),
                                            false, false,
                                            array('IBLOLCK_ID', 'ID', 'NAME', 'PROPERTY_COURSE_PRICE', 'COURSE_PRICE_UA', 'COURSE_DURATION')
                                        );
                                        if ($arCourse = $rsCourses->GetNext()) {
                                            if (empty($currentCourse['PRICE'])) {
                                                $currentCourse['PRICE'] = $arCourse['PROPERTY_COURSE_PRICE'];
                                            }
                                            if (empty($currentCourse['PRICE_UA'])) {
                                                $currentCourse['PRICE_UA'] = $arCourse['COURSE_PRICE_UA'];
                                            }
                                            if (empty($currentCourse['DURATION'])) {
                                                $currentCourse['DURATION'] = $arCourse['COURSE_DURATION'];
                                            }
                                            unset($arCourse);
                                        }
                                        unset($rsCourses);
                                    }

                                    $arSendEvent['EVENT_CONTENT'] .= "
                                    <p>" . $currentCourse['NAME'] . "</br>
                                        </br> 
                                        Дата проведения: " . $currentCourse['DATE_RANGE'] . "</br>
                                        Время: " . $currentCourse['TIME'] . "</br>
                                        Длительность: " . $currentCourse['DURATION'] . " ч.</br>
                                        Стоимость: " . $currentCourse['PRICE'] . " руб.</br>
                                        </br>
                                    </p>";
                                    unset($arStructure, $currentCourse);
                                }
                                unset($rsStructure);
                            }
                        }

                        $arSendMC = array(
                            'TEXT' =>
                                '<b>запись на событие: </b>' . $arFields3["NAME"] .
                                '<br/> <b>тип: </b>' . $arFields3["PROPERTY_TYPE_VALUE"] .
                                '<br/> <b>дата: </b>' . $arSchool['date_start'] .
                                '<br/> <b>цена: </b>' . $arSchool['current_price'] .
                                '<br/> <b>фио: </b>' . $arFields3["PROPERTY_FULLNAME_VALUE"] .
                                '<br/> <b>телефон: </b>' . $arFields3["PROPERTY_TELEPHONE_VALUE"] .
                                '<br/> <b>E-mail: </b>' . $arFields3["PROPERTY_EMAIL_VALUE"] .
                                '<br/> <b>компания: </b>' . $arFields3["PROPERTY_COMPANY_VALUE"] .
                                '<br/> <b>Комментарий к заявке: </b>' . $commentOrder,
                            'ID_RECORD' => $arFields["ID"],
                            'EDU_MAIL' => $email_go_to,
                            'EDU_TYPE' => $arFields3["PROPERTY_TYPE_VALUE"],
                            'EDU_EVENT_NAME' => $arFields3["NAME"],
                            'EDU_EVENT_CITY' => $arFields3["PROPERTY_EVENT_CITY_VALUE"],
                            'EDU_EVENT_COMMENT' => $arFields3["PROPERTY_COMMENT_VALUE"],
                        );

                        $arSendEvent['EDU_EVENT_EVENT_ID'] = $arSchool['event_id'];
                        $arSendEvent['EDU_EVENT_TIME'] = $arSchool['time_range'];
                        $arSendEvent['EDU_EVENT_DATE'] = $arSchool['event_dates'];
                        $arSendEvent['EDU_EVENT_DURATION'] = $arSchool['duration'];
                        $arSendEvent['EDU_EVENT_PRICE'] = $arSchool['current_price'];

                        if (
                            preg_match("#dxc#", strtolower($arFields["PROPERTY_VALUES"]['company'])) ||
                            preg_match("#luxoft#", strtolower($arFields["PROPERTY_VALUES"]['company'])) ||
                            preg_match("#люксофт#", strtolower($arFields["PROPERTY_VALUES"]['company'])) ||
                            preg_match("#@luxoft#", strtolower($arSendEvent["EDU_EVENT_USER_EMAIL"])) ||
                            preg_match("#@dxc-luxoft#", strtolower($arSendEvent["EDU_EVENT_USER_EMAIL"])) ||
                            preg_match("#@dxc#", strtolower($arSendEvent["EDU_EVENT_USER_EMAIL"]))
                        ) // сотрудник Luxoft
                        {
                            CEvent::Send('DIFF_EVENTS_SEND', SITE_ID, $arSendEvent, "N", "211");
                        } else // не сотрудник Люксофт
                        {
                            CEvent::Send('DIFF_EVENTS_SEND', SITE_ID, $arSendEvent, 'N', "212");
                        }
                        CEvent::Send('DIFF_EVENTS_SEND', SITE_ID, $arSendMC, 'N', "206"); // sales
                    }
                }

                /*
                12  Повод:  Регистрация на Квиз
                */
                if ($arFields3["PROPERTY_TYPE_ENUM_ID"] == 316) {
                    // берем элемент инфоблока Квиза
                    $arFilterM = array("IBLOCK_ID" => 164, "ID" => (int)$_REQUEST['PROPERTY']['314'][0]);
                    $arSelectM = array(
                        "ID",
                        "IBLOCK_ID",
                        "NAME",
                        "PROPERTY_*"
                    );
                    $resM = CIBlockElement::GetList(array(), $arFilterM, false, false, $arSelectM);
                    while ($ob = $resM->GetNextElement()) {
                        $arprops = $ob->GetProperties();
                        if (strlen($arprops["DATE_EVENT"]["VALUE"]) > 0) {
                            CIBlockElement::SetPropertyValueCode($arFields['ID'], 'DATA_EVENT', $arprops["DATE_EVENT"]["VALUE"]);
                        }
                    }
                }

                if (strlen($reg_link) > 0) {
                    $arSend_webinar = array(
                        'WEB_EMAIL' => $orderer_email,
                        'WEB_NAME' => $orderer_name,
                        'WEB_EVENT_NAME' => $orderer_event,
                        'WEB_EVENT_DATE' => $orderer_date,
                        'WEB_EVENT_TIME' => $reg_time,
                        'WEB_EVENT_ID' => $reg_id,
                        'WEB_REG_LINK' => $reg_link,
                        'WEB_REG_RESPONSE' => $reg_name_responsible,
                    );
                    //CEvent::Send('NEW_WEBINAR_SUBSCRIBE',SITE_ID, $arSend_webinar, 'N');
                    //if ($USER->IsAdmin()) {
                    //print_r($arSend_webinar);
                    //die();
                    //}
                }
            }
        }
    }
    // создаем обработчик события "OnBeforeIBlockElementDelete"
    // при удалении элементов из инф блоков Семинары ID = 7
    // и инф блока Конференции ID = 66 удаляем
    // связанныую запись из инфоблока Календарь событий ID =65
    function OnBeforeIBlockElementDeleteHandler($ID)
    {
        global $USER, $APPLICATION;
        $IBLOCK_ID = "";
        $res = CIBlockElement::GetByID($ID);
        if ($arFields = $res->GetNext())
            $IBLOCK_ID = $arFields['IBLOCK_ID'];
        if (($IBLOCK_ID == 66) or ($IBLOCK_ID == 7)) {
            $arFilter = array("IBLOCK_ID" => 65, "XML_ID" => $ID);
            $res2 = CIBlockElement::GetList(array(), $arFilter, array("ID"));
            while ($arToDeleteRecord = $res2->GetNext()) {
                CIBlockElement::Delete($arToDeleteRecord["ID"]);
            }
        }
        /* запретим доступ на удаление  элементов Инфоблока Эксперты для группы GROUP_FORBID_EXPERTS_IBLOCK_EDIT */
        if ($IBLOCK_ID == D_EXPERT_ID_IBLOCK) {
            if (in_array(GROUP_FORBID_EXPERTS_IBLOCK_EDIT, $USER->GetUserGroupArray())) {
                $APPLICATION->throwException("Извините, но у вас нет прав на редактирование и удаление записей в таблице Экспертов");
                return false;
            }
        }

        if (
            ($IBLOCK_ID == D_SEMINARS_IBLOCK) or
            ($IBLOCK_ID == D_TIMETABLE_ID_IBLOCK) or
            ($IBLOCK_ID == D_TIMETABLECLASSES_ID_IBLOCK) or
            ($IBLOCK_ID == D_SEMINARS_REFERENCE) or
            ($IBLOCK_ID == D_RECORDS_IBLOCK) or
            ($IBLOCK_ID == D_NEWS) or
            ($IBLOCK_ID == D_PARTNERS) or
            ($IBLOCK_ID == D_CLIENTS_REFERENCE) or
            ($IBLOCK_ID == D_CLIENTS_FEEDBACK)
        ) {
            if (in_array(GROUP_FORBID_EDU_SECTION, $USER->GetUserGroupArray())) {
                $APPLICATION->throwException("Извините, но у вас нет прав на редактирование и удаление записей  данного информационнного блока");
                return false;
            }
        }
    }
}
