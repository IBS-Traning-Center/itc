<?php
define("NO_KEEP_STATISTIC", true);
define("STOP_STATISTICS", true);
define("NO_AGENT_CHECK", true);
define("NOT_CHECK_PERMISSIONS", true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

header('Content-Type: application/json; charset=utf-8');

CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
CModule::IncludeModule("iblock");

if (!check_bitrix_sessid()) {
    echo json_encode(['success' => false, 'error' => 'Ошибка безопасности']);
    die();
}

$productId = intval($_POST['id'] ?? $_GET['id'] ?? 0);
$scheduleId = intval($_POST['schedule_id'] ?? $_GET['schedule_id'] ?? 0);
$quantity = intval($_POST['quantity'] ?? $_GET['quantity'] ?? 1);

if ($productId <= 0) {
    echo json_encode(['success' => false, 'error' => 'Неверный ID товара']);
    die();
}

if ($quantity <= 0 || $quantity > 10) {
    echo json_encode(['success' => false, 'error' => 'Неверное количество']);
    die();
}

try {
    $dbElement = CIBlockElement::GetByID($productId);
    if (!$arElement = $dbElement->Fetch()) {
        throw new Exception('Курс не найден');
    }

    $dbProduct = CCatalogProduct::GetByID($productId);
    if (!$dbProduct) {
        $arCatalogFields = array(
            "ID" => $productId,
            "QUANTITY" => 100,
            "WEIGHT" => 0,
            "WIDTH" => 0,
            "HEIGHT" => 0,
            "LENGTH" => 0,
            "AVAILABLE" => "Y",
            "SUBSCRIBE" => "N",
            "VAT_ID" => 0,
            "VAT_INCLUDED" => "Y",
            "CAN_BUY_ZERO" => "Y",
            "NEGATIVE_AMOUNT_TRACE" => "D",
            "QUANTITY_TRACE" => "N",
            "TYPE" => 3
        );

        CCatalogProduct::Add($arCatalogFields);
    }

    $schedulePrice = 0;
    $scheduleName = '';
    $scheduleStartDate = '';
    $scheduleEndDate = '';
    $scheduleTime = '';

    if ($scheduleId > 0) {
        if (class_exists('\\Bitrix\\Iblock\\Elements\\ElementScheduleTable')) {
            $schedule = \Bitrix\Iblock\Elements\ElementScheduleTable::getList([
                'select' => ['ID', 'NAME', 'schedule_price', 'schedule_course', 'startdate', 'enddate', 'schedule_time'],
                'filter' => [
                    'ID' => $scheduleId,
                    'ACTIVE' => 'Y',
                    'schedule_course.VALUE' => $productId
                ]
            ])->fetch();

            if ($schedule) {
                $schedulePrice = floatval($schedule['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_schedule_price_VALUE'] ?? 0);
                $scheduleName = $schedule['NAME'];
                $scheduleStartDate = $schedule['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_startdate_VALUE'] ?? '';
                $scheduleEndDate = $schedule['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_enddate_VALUE'] ?? '';
                $scheduleTime = $schedule['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_schedule_time_VALUE'] ?? '';
            }
        }
    }

    $price = 0;
    $currency = 'RUB';

    if ($schedulePrice > 0) {
        $price = $schedulePrice;
    } else {
        $dbPrice = CPrice::GetList(
            [],
            [
                "PRODUCT_ID" => $productId,
                "CATALOG_GROUP_ID" => 1,
            ]
        );

        if ($arPrice = $dbPrice->Fetch()) {
            $price = floatval($arPrice["PRICE"]);
            $currency = $arPrice["CURRENCY"];
        } else {
            $dbCoursePrice = CIBlockElement::GetProperty(
                $arElement['IBLOCK_ID'],
                $productId,
                [],
                ['CODE' => 'course_price']
            );

            if ($arCoursePrice = $dbCoursePrice->Fetch() && !empty($arCoursePrice['VALUE'])) {
                $price = floatval($arCoursePrice['VALUE']);
                $arPriceFields = array(
                    "PRODUCT_ID" => $productId,
                    "CATALOG_GROUP_ID" => 1,
                    "PRICE" => $price,
                    "CURRENCY" => "RUB",
                    "QUANTITY_FROM" => false,
                    "QUANTITY_TO" => false
                );

                if ($priceId = CPrice::GetList([], ["PRODUCT_ID" => $productId, "CATALOG_GROUP_ID" => 1])->Fetch()) {
                    CPrice::Update($priceId["ID"], $arPriceFields);
                } else {
                    CPrice::Add($arPriceFields);
                }
            }
        }
    }

    $arBasketProps = array();

    if ($scheduleId > 0) {
        $arBasketProps[] = array(
            "NAME" => "Расписание",
            "CODE" => "SCHEDULE_ID",
            "VALUE" => $scheduleId
        );

        if (!empty($scheduleName)) {
            $arBasketProps[] = array(
                "NAME" => "Группа",
                "CODE" => "SCHEDULE_NAME",
                "VALUE" => $scheduleName
            );
        }

        if (!empty($scheduleStartDate)) {

            $arBasketProps[] = array(
                "NAME" => "Дата начала",
                "CODE" => "SCHEDULE_START_DATE",
                "VALUE" => $scheduleStartDate
            );

            if ($scheduleStartDate) {
                try {
                    $dateTime = new DateTime($scheduleStartDate);
                    $formattedStartDate = $dateTime->format('d.m.Y');
                    $arBasketProps[] = array(
                        "NAME" => "Дата начала (формат)",
                        "CODE" => "SCHEDULE_START_DATE_FORMATTED",
                        "VALUE" => $formattedStartDate
                    );
                } catch (Exception $e) {

                }
            }
        }

        if (!empty($scheduleEndDate)) {
            $arBasketProps[] = array(
                "NAME" => "Дата окончания",
                "CODE" => "SCHEDULE_END_DATE",
                "VALUE" => $scheduleEndDate
            );

            if ($scheduleEndDate) {
                try {
                    $dateTime = new DateTime($scheduleEndDate);
                    $formattedEndDate = $dateTime->format('d.m.Y');
                    $arBasketProps[] = array(
                        "NAME" => "Дата окончания (формат)",
                        "CODE" => "SCHEDULE_END_DATE_FORMATTED",
                        "VALUE" => $formattedEndDate
                    );
                } catch (Exception $e) {

                }
            }
        }

        if (!empty($scheduleTime)) {
            $arBasketProps[] = array(
                "NAME" => "Время проведения",
                "CODE" => "SCHEDULE_TIME",
                "VALUE" => $scheduleTime
            );
        }

        if ($schedulePrice > 0) {
            $arBasketProps[] = array(
                "NAME" => "Цена по расписанию",
                "CODE" => "SCHEDULE_PRICE_VALUE",
                "VALUE" => $schedulePrice
            );
        }
    }

    $arBasketProps[] = array(
        "NAME" => "Курс",
        "CODE" => "COURSE_NAME",
        "VALUE" => $arElement['NAME']
    );

    error_log("Schedule Props: " . print_r($arBasketProps, true));

    $dbBasketItem = CSaleBasket::GetList(
        [],
        [
            "PRODUCT_ID" => $productId,
            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "ORDER_ID" => "NULL",
            "DELAY" => "N"
        ]
    );

    if ($existingItem = $dbBasketItem->Fetch()) {
        $newQuantity = $existingItem["QUANTITY"] + $quantity;
        CSaleBasket::Update($existingItem["ID"], ["QUANTITY" => $newQuantity]);
        $basketId = $existingItem["ID"];
    } else {
        $arFields = array(
            "PRODUCT_ID" => $productId,
            "QUANTITY" => $quantity,
            "PRICE" => $price,
            "CURRENCY" => $currency,
            "LID" => LANG,
            "NAME" => $arElement['NAME'],
            "PROPS" => $arBasketProps,
            "MODULE" => "catalog",
            "CALLBACK_FUNC" => false,
            "NOTES" => false,
            "ORDER_CALLBACK_FUNC" => false,
            "CANCEL_CALLBACK_FUNC" => false,
            "PAY_CALLBACK_FUNC" => false,
            "DETAIL_PAGE_URL" => $arElement['DETAIL_PAGE_URL'] ?? '',
            "DISCOUNT_PRICE" => 0,
            "CATALOG_XML_ID" => false,
            "PRODUCT_XML_ID" => false,
            "VAT_RATE" => false,
            "MEASURE_NAME" => false,
            "MEASURE_CODE" => false,
            "CAN_BUY" => "Y",
            "DELAY" => "N",
            "SUBSCRIBE" => "N",
            "IGNORE_CALLBACK_FUNC" => "N"
        );

        $basketId = CSaleBasket::Add($arFields);

        if (!$basketId) {
            $arFields = array(
                "PRODUCT_ID" => $productId,
                "QUANTITY" => $quantity,
                "PRICE" => $price,
                "CURRENCY" => $currency,
                "LID" => LANG,
                "NAME" => $arElement['NAME'],
                "CAN_BUY" => "Y"
            );

            $basketId = CSaleBasket::Add($arFields);

            if (!$basketId) {
                throw new Exception('Не удалось добавить товар в корзину');
            }
        }
    }

    $dbBasket = CSaleBasket::GetList(
        [],
        [
            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => LANG,
            "ORDER_ID" => "NULL",
            "DELAY" => "N"
        ],
        false,
        false,
        ["ID", "QUANTITY", "PRICE", "CURRENCY"]
    );

    $totalCount = 0;
    $totalPrice = 0;
    $basketCurrency = 'RUB';

    while ($arItem = $dbBasket->Fetch()) {
        $totalCount += $arItem["QUANTITY"];
        $totalPrice += $arItem["PRICE"] * $arItem["QUANTITY"];
        $basketCurrency = $arItem["CURRENCY"];
    }

    $formattedSum = SaleFormatCurrency($totalPrice, $basketCurrency);

    echo json_encode([
        'success' => true,
        'count' => $totalCount,
        'sum' => $totalPrice,
        'formatted_sum' => $formattedSum,
        'basket_id' => $basketId,
        'message' => 'Курс успешно добавлен в корзину'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>