<?php
/**
 * AJAX-обработчик добавления сертификата в корзину
 */

define("NO_KEEP_STATISTIC", true);
define("STOP_STATISTICS", true);
define("NO_AGENT_CHECK", true);
define("NOT_CHECK_PERMISSIONS", true);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Bitrix\Iblock\ElementTable;

Loader::includeModule('sale');
Loader::includeModule('catalog');
Loader::includeModule('iblock');

header('Content-Type: application/json; charset=utf-8');

if (!check_bitrix_sessid()) {
    die(json_encode(['status' => 'error', 'message' => 'Неверная сессия']));
}

$productId = (int)($_POST['PRODUCT_ID'] ?? 0);
$quantity  = max(1, (int)($_POST['QUANTITY'] ?? 1));

if ($productId <= 0) {
    die(json_encode(['status' => 'error', 'message' => 'Неверный ID товара']));
}

// ================================================
// Обработка свойств из POST (формат PROPS[n][CODE/NAME/VALUE])
// ================================================

$arProps = [];

if (!empty($_POST['PROPS']) && is_array($_POST['PROPS'])) {
    foreach ($_POST['PROPS'] as $index => $propItem) {
        if (!is_array($propItem)) {
            continue;
        }

        $code  = trim($propItem['CODE']  ?? '');
        $name  = trim($propItem['NAME']  ?? $code);
        $value = trim((string)($propItem['VALUE'] ?? ''));

        // Добавляем только непустые значения
        if ($code !== '' && $value !== '' && $value !== '0') {
            $arProps[] = [
                'NAME'  => $name,
                'CODE'  => $code,
                'VALUE' => $value,
                'SORT'  => 100 + $index * 10,
            ];
        }
    }
}

// ================================================
// Получаем название товара
// ================================================

$element = ElementTable::getList([
    'filter' => ['=ID' => $productId, '=ACTIVE' => 'Y'],
    'select' => ['ID', 'NAME'],
    'limit'  => 1
])->fetch();

if (!$element) {
    die(json_encode(['status' => 'error', 'message' => 'Товар не найден или не активен']));
}

$name = $element['NAME'];

// ================================================
// Получаем цену
// ================================================

$price    = 0;
$currency = 'RUB';

$optimalPrice = \CCatalogProduct::GetOptimalPrice($productId, $quantity);

if ($optimalPrice && !empty($optimalPrice['PRICE']['PRICE'])) {
    $price    = (float)$optimalPrice['PRICE']['PRICE'];
    $currency = $optimalPrice['PRICE']['CURRENCY'];
} else {
    $basePrice = \CPrice::GetBasePrice($productId);
    if ($basePrice) {
        $price    = (float)$basePrice['PRICE'];
        $currency = $basePrice['CURRENCY'];
    }
}

// ================================================
// Добавляем в корзину
// ================================================

$arFields = [
    'PRODUCT_ID'             => $productId,
    'PRICE'                  => $price,
    'CURRENCY'               => $currency,
    'WEIGHT'                 => 0,
    'QUANTITY'               => $quantity,
    'LID'                    => defined('SITE_ID') ? SITE_ID : 's1',
    'DELAY'                  => 'N',
    'CAN_BUY'                => 'Y',
    'NAME'                   => $name,
    'MODULE'                 => 'catalog',
    'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
    'PROPS'                  => $arProps,  // массив свойств — именно так!
];

$basketId = CSaleBasket::Add($arFields);

if (intval($basketId) > 0) {
    // Подсчёт количества позиций в корзине (кол-во разных товаров)
    $res = CSaleBasket::GetList(
        [],
        [
            "FUSER_ID" => CSaleBasket::GetBasketUserID(true),
            "LID"      => SITE_ID,
            "ORDER_ID" => "NULL",
            "DELAY"    => "N",
            "CAN_BUY"  => "Y"
        ],
        false,
        false,
        ['ID']
    );

    $count = (int)$res->SelectedRowsCount();

    echo json_encode([
        'status' => 'success',
        'count'  => $count,
        // 'formatted_sum' => ... можно добавить позже, если нужно
    ]);
} else {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Не удалось добавить товар в корзину'
    ]);
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
die();