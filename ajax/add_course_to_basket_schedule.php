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
    echo json_encode(['success' => false, 'error' => 'Неверный ID курса']);
    die();
}

if ($scheduleId <= 0) {
    echo json_encode(['success' => false, 'error' => 'Неверный ID расписания']);
    die();
}

if ($quantity <= 0 || $quantity > 10) {
    echo json_encode(['success' => false, 'error' => 'Неверное количество']);
    die();
}

try {

    $scheduleElement = CIBlockElement::GetByID($scheduleId);
    if (!$arSchedule = $scheduleElement->Fetch()) {
        throw new Exception('Расписание не найдено');
    }

    $courseElement = CIBlockElement::GetByID($productId);
    if (!$arCourse = $courseElement->Fetch()) {
        throw new Exception('Курс не найден');
    }

    $dbProps = CIBlockElement::GetProperty(
        $arSchedule['IBLOCK_ID'],
        $scheduleId,
        [],
        ['CODE' => 'schedule_course']
    );

    $isValidSchedule = false;
    while ($arProp = $dbProps->Fetch()) {
        if ($arProp['VALUE'] == $productId) {
            $isValidSchedule = true;
            break;
        }
    }

    if (!$isValidSchedule) {
        throw new Exception('Расписание не соответствует курсу');
    }

    $schedulePrice = 0;
    $dbSchedulePrice = CIBlockElement::GetProperty(
        $arSchedule['IBLOCK_ID'],
        $scheduleId,
        [],
        ['CODE' => 'schedule_price']
    );

    if ($arPriceProp = $dbSchedulePrice->Fetch()) {
        $schedulePrice = floatval($arPriceProp['VALUE']);
    }

    if ($schedulePrice <= 0) {
        $dbPrice = CPrice::GetList([], [
            "PRODUCT_ID" => $productId,
            "CATALOG_GROUP_ID" => 1
        ]);

        if ($arPrice = $dbPrice->Fetch()) {
            $schedulePrice = $arPrice["PRICE"];
            $currency = $arPrice["CURRENCY"];
        } else {
            $dbCoursePrice = CIBlockElement::GetProperty(
                $arCourse['IBLOCK_ID'],
                $productId,
                [],
                ['CODE' => 'course_price']
            );

            if ($arCoursePrice = $dbCoursePrice->Fetch()) {
                $schedulePrice = floatval($arCoursePrice['VALUE']);
            }
        }
    }

    $startDate = '';
    $endDate = '';
    $city = '';

    $dbStartDate = CIBlockElement::GetProperty(
        $arSchedule['IBLOCK_ID'],
        $scheduleId,
        [],
        ['CODE' => 'startdate']
    );
    if ($arStartDate = $dbStartDate->Fetch()) {
        $startDate = $arStartDate['VALUE'];
    }

    $dbCity = CIBlockElement::GetProperty(
        $arSchedule['IBLOCK_ID'],
        $scheduleId,
        [],
        ['CODE' => 'city']
    );
    if ($arCity = $dbCity->Fetch()) {
        $city = $arCity['VALUE'];
    }

    $arProps = [];

    $arProps[] = [
        "NAME" => "ID расписания",
        "CODE" => "SCHEDULE_ID",
        "VALUE" => $scheduleId
    ];

    if (!empty($startDate)) {
        $arProps[] = [
            "NAME" => "Дата начала",
            "CODE" => "START_DATE",
            "VALUE" => $startDate
        ];
    }

    if (!empty($city)) {
        $arCityElement = CIBlockElement::GetByID($city);
        if ($arCityData = $arCityElement->Fetch()) {
            $arProps[] = [
                "NAME" => "Город",
                "CODE" => "CITY",
                "VALUE" => $arCityData['NAME']
            ];
        }
    }

    $arProps[] = [
        "NAME" => "Курс",
        "CODE" => "COURSE_NAME",
        "VALUE" => $arCourse['NAME']
    ];

    $dbBasket = CSaleBasket::GetList(
        [],
        [
            "PRODUCT_ID" => $productId,
            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "ORDER_ID" => "NULL",
            "DELAY" => "N"
        ]
    );

    $alreadyInCart = false;
    $basketId = 0;

    while ($arItem = $dbBasket->Fetch()) {
        $dbItemProps = CSaleBasket::GetProps(
            $arItem["ID"],
            [],
            ["CODE" => "SCHEDULE_ID"]
        );

        while ($arProp = $dbItemProps->Fetch()) {
            if ($arProp["CODE"] == "SCHEDULE_ID" && $arProp["VALUE"] == $scheduleId) {
                $alreadyInCart = true;
                $basketId = $arItem["ID"];
                $newQuantity = $arItem["QUANTITY"] + $quantity;
                CSaleBasket::Update($arItem["ID"], ["QUANTITY" => $newQuantity]);
                break 2;
            }
        }
    }

    if (!$alreadyInCart) {
        $arFields = [
            "PRODUCT_ID" => $productId,
            "QUANTITY" => $quantity,
            "PRICE" => $schedulePrice,
            "CURRENCY" => $currency ?? 'RUB',
            "LID" => LANG,
            "NAME" => $arCourse['NAME'],
            "PROPS" => $arProps,
            "MODULE" => "catalog",
            "CAN_BUY" => "Y",
            "DELAY" => "N"
        ];

        $basketId = CSaleBasket::Add($arFields);

        if (!$basketId) {
            throw new Exception('Не удалось добавить товар в корзину');
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
        'already_in_cart' => $alreadyInCart
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");