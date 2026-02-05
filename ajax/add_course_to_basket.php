<?php
define("NO_KEEP_STATISTIC", true);
define("STOP_STATISTICS", true);
define("NO_AGENT_CHECK", true);
define("NOT_CHECK_PERMISSIONS", true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// Включаем модули с проверкой
if (!CModule::IncludeModule("sale") || !CModule::IncludeModule("catalog")) {
    die(json_encode(['error' => 'Модули не подключены']));
}

// CSRF защита
if (!check_bitrix_sessid()) {
    die(json_encode(['error' => 'Ошибка безопасности']));
}

// Получаем и валидируем данные
$action = $_REQUEST["action"] ?? '';
$productId = intval($_REQUEST["id"] ?? 0);
$quantity = intval($_REQUEST["quantity"] ?? 1);
$discount = trim($_REQUEST["dis"] ?? '');

// Валидация
if (!in_array($action, ['ADD2BASKET', 'BUY'])) {
    die(json_encode(['error' => 'Неверное действие']));
}

if ($productId <= 0) {
    die(json_encode(['error' => 'Неверный ID товара']));
}

if ($quantity <= 0 || $quantity > 100) {
    die(json_encode(['error' => 'Неверное количество']));
}

try {
    // Получаем информацию о курсе
    $arPropsTemp = GetFullInfoAboutCourse($productId);
    $arProps = [];

    foreach ($arPropsTemp as $key => $value) {
        $arProps[] = [
            "NAME" => htmlspecialcharsbx($key),
            "VALUE" => htmlspecialcharsbx($value),
            "CODE" => htmlspecialcharsbx($key),
        ];
    }

    // Получаем информацию о товаре
    $dbElement = CIBlockElement::GetByID($productId);
    if (!$arElement = $dbElement->Fetch()) {
        throw new Exception('Товар не найден');
    }
    $dbPrice = CPrice::GetList(
        [],
        [
            "PRODUCT_ID" => $productId,
            "CATALOG_GROUP_ID" => 1
        ]
    );

    if (!$arPrice = $dbPrice->Fetch()) {
        throw new Exception('Цена товара не найдена');
    }

    // Рассчитываем финальную цену
    $finalPrice = $arPrice["PRICE"];
    $currency = $arPrice["CURRENCY"];

    // Применяем скидку если есть
    if (!empty($discount)) {
        $finalPrice = fn_GetCourseDis($productId, $finalPrice);
    }

    // Проверяем пользовательскую цену
    if (isset($_REQUEST['dprice']) && floatval($_REQUEST['dprice']) > 0) {
        $finalPrice = floatval($_REQUEST['dprice']);
    }

    // Подготавливаем данные для корзины
    $basketFields = [
        "PRODUCT_ID" => $productId,
        "QUANTITY" => $quantity,
        "LID" => SITE_ID,
        "PROPS" => $arProps,
        "CURRENCY" => $currency,
        "NAME" => htmlspecialchars_decode($arElement['NAME']),
        "PRICE" => $finalPrice,
        "MODULE" => 'catalog',
        "PRODUCT_PROVIDER_CLASS" => 'CCatalogProductProvider',
        "DETAIL_PAGE_URL" => $arElement['DETAIL_PAGE_URL'] ?? '',
        "CAN_BUY" => 'Y',
        "DELAY" => 'N',
        "CUSTOM_PRICE" => 'Y'
    ];

    // Добавляем в корзину
    $basketId = CSaleBasket::Add($basketFields);

    if (!$basketId) {
        throw new Exception('Ошибка добавления в корзину: ' . CSaleBasket::GetLastError());
    }

    // Если действие "Купить" - редирект
    if ($action == "BUY") {
        echo json_encode([
            'success' => true,
            'redirect' => '/personal/cart/'
        ]);
    } else {
        // Возвращаем информацию о корзине
        $arBasketItems = GetBasketList();
        $allCurrency = CSaleLang::GetLangCurrency(SITE_ID);
        $numProducts = 0;
        $allSum = 0;

        foreach ($arBasketItems as $item) {
            $numProducts++;
            $allSum += ($item["PRICE"] * $item["QUANTITY"]);
        }

        $summa = SaleFormatCurrency($allSum, $allCurrency);

        echo json_encode([
            'success' => true,
            'count' => $numProducts,
            'sum' => $summa,
            'formatted_sum' => $summa,
            'basket_id' => $basketId
        ]);
    }

} catch (Exception $e) {
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}
?>