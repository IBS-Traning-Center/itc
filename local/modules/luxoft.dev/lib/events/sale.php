<?php
namespace Luxoft\Dev\Events;

class Sale
{
    public static function saleOrderSaved(\Bitrix\Main\Event $event)
    {
        /** @var \Bitrix\Sale\Order $order */
        $order = $event->getParameter("ENTITY");
        $isNew = $event->getParameter("IS_NEW");
        if($isNew) {
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
                            $rsSales = CSaleOrder::GetList(array("ID" => "DESC"), array('PERSON_TYPE_ID' => 9), false, array('nTopCount' => 2),array('ID','PROPERTY_VAL_BY_CODE_INVOICE','PROPERTY_VAL_BY_CODE_CUSTOMER'));
                            while ($arSales = $rsSales->Fetch()) {
                                $db_props = CSaleOrderPropsValue::GetOrderProps($arSales['ID']);
                                while ($arProps = $db_props->Fetch()) {
                                    if($arProps['CODE'] == 'INVOICE') {
                                        $invoiceNumber = ((int) $arProps['VALUE'] + 1);
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

    public static function OnBasketUpdate($ID, $arFields)
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

    public static function OnSalePayOrder($ID, $val)
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

                                $arSendFields["TEST_LINK"] = 'http://ibs-training.ru/training/testing/' . $COURSE_ID . '/' . $arTest["ID"] . '/';
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

    public static function onSaleBasketItemEntitySaved(Bitrix\Main\Event $event)
    {
        $entity = $event->getParameter("ENTITY");
        $fields = $entity->getFields();

        $priceObject = Bitrix\Catalog\Model\Price::getList([
            'filter' => ['PRODUCT_ID' => $fields['PRODUCT_ID'], 'CATALOG_GROUP_ID' => 3],
            'cache' => ['ttl' => 3600],
        ])->fetch();
        if(!$priceObject) {
            $scheduleObject = Bitrix\Iblock\Elements\ElementScheduleTable::getList([
                'filter' => ['ID' => $fields["PRODUCT_ID"]],
                'select' => ['ID', 'SCHEDULE_PRICE', 'SCHEDULE_DURATION', 'SCHEDULE_COURSE', 'CITY'],
                'cache' => ['ttl' => 3600],
            ])->fetchObject();
            if($scheduleObject) {

                $arVariables = array(
                    'price' => 0,
                    'duration' => 0,
                );

                if($scheduleObject->getScheduleCourse() && $scheduleObject->getScheduleCourse()->getValue()) {
                    $courseObject = Bitrix\Iblock\Elements\ElementCoursesTable::getList([
                        'filter' => ['ID' => $scheduleObject->getScheduleCourse()->getValue()],
                        'select' => ['ID', 'COURSE_PRICE_UA', 'COURSE_DURATION'],
                        'cache' => ['ttl' => 3600],
                    ])->fetchObject();

                    if($courseObject && $courseObject->getCoursePriceUa() && $courseObject->getCoursePriceUa()->getValue()) {
                        $arVariables["price"] = $courseObject->getCoursePriceUa()->getValue();
                    }

                    if($courseObject && $courseObject->getCourseDuration() && $courseObject->getCourseDuration()->getValue()) {
                        $arVariables["duration"] = $courseObject->getCourseDuration()->getValue();
                    }
                }

                if($scheduleObject->getScheduleDuration() && $scheduleObject->getScheduleDuration()->getValue()) {
                    $arVariables["duration"] = $scheduleObject->getScheduleDuration()->getValue();
                }

                if(!$arVariables["price"] && $arVariables["duration"]) {
                    $arVariables['price'] = (intval($arVariables['duration']) > 39) ? intval($arVariables['duration']) * 225 : intval($arVariables['duration']) * 300;
                }

                if($arVariables['price']) {
                    Bitrix\Catalog\Model\Price::add([
                        'PRODUCT_ID' => (int) $fields["PRODUCT_ID"],
                        'CATALOG_GROUP_ID' => 3,
                        'PRICE' => $arVariables['price'],
                        'CURRENCY' => 'GRN',
                    ]);
                }
            }
        }
    }
}