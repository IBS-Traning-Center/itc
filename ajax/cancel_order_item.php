<?php
/**
 * /ajax/cancel_order_item.php
 * Отмена одной позиции в заказе.
 * Если в заказе была только одна позиция → полностью отменяем заказ.
 * Если позиций несколько → создаём новый заказ без отменённой позиции.
 */

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Bitrix\Sale;

if (!Loader::includeModule('sale')) {
    die(json_encode(['status' => 'error', 'error' => 'Модуль sale не подключён']));
}

$request = Context::getCurrent()->getRequest();
header('Content-Type: application/json; charset=utf-8');

if ($request['action'] !== 'cancel_item') {
    die(json_encode(['status' => 'error', 'error' => 'Неверный action']));
}

$orderId  = (int)$request['orderId'];
$basketId = (int)$request['basketId'];

if ($orderId <= 0 || $basketId <= 0) {
    die(json_encode(['status' => 'error', 'error' => 'Неверные параметры']));
}

$oldOrder = Sale\Order::load($orderId);
if (!$oldOrder) {
    die(json_encode(['status' => 'error', 'error' => 'Заказ не найден']));
}

// Проверки, при которых отмена позиции запрещена
$statusId = $oldOrder->getField('STATUS_ID');
$forbiddenStatuses = ['F', 'CO', 'CA', 'DF', 'OV', 'OT', 'P'];

$paymentCollection = $oldOrder->getPaymentCollection();
$hasPaidPayment = false;
foreach ($paymentCollection as $payment) {
    if ($payment->isPaid()) {
        $hasPaidPayment = true;
        break;
    }
}

if (
    $oldOrder->isCanceled() ||
    $oldOrder->isPaid() ||
    $hasPaidPayment ||
    $oldOrder->getShipmentCollection()->isShipped() ||
    in_array($statusId, $forbiddenStatuses)
) {
    die(json_encode([
        'status' => 'error',
        'error'  => 'Нельзя отменить позицию: заказ оплачен / отгружен / завершён / отменён'
    ]));
}


$oldBasket = $oldOrder->getBasket();
$itemCount = $oldBasket->count();

if ($itemCount <= 1) {

    $oldOrder->setField('CANCELED', 'Y');
    $oldOrder->setField('REASON_CANCELED', 'Клиент отменил единственный курс в заказе');


    $result = $oldOrder->save();

    if ($result->isSuccess()) {
        echo json_encode([
            'status'            => 'success',
            'message'           => 'Заказ полностью отменён',
            'order_id'          => $oldOrder->getId(),
            'order_number'      => $oldOrder->getField('ACCOUNT_NUMBER'),
            'is_fully_canceled' => true
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'error'  => 'Не удалось отменить заказ: ' . implode(', ', $result->getErrorMessages())
        ]);
    }

    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
    exit;
}

$oldOrder->setField('CANCELED', 'Y');
$oldOrder->setField('REASON_CANCELED', 'Клиент отменил одну из позиций (курс #' . $basketId . ')');

$cancelResult = $oldOrder->save();
if (!$cancelResult->isSuccess()) {
    die(json_encode([
        'status' => 'error',
        'error'  => 'Не удалось отменить старый заказ: ' . implode(', ', $cancelResult->getErrorMessages())
    ]));
}


$newOrder = Sale\Order::create(SITE_ID, $oldOrder->getUserId());
$newOrder->setPersonTypeId($oldOrder->getPersonTypeId());
$newOrder->setField('CURRENCY', $oldOrder->getCurrency());


$initResult = $newOrder->save();
if (!$initResult->isSuccess()) {

    $oldOrder->setField('CANCELED', 'N');
    $oldOrder->save();

    die(json_encode([
        'status' => 'error',
        'error'  => 'Ошибка создания нового заказа: ' . implode(', ', $initResult->getErrorMessages())
    ]));
}

$newBasket = $newOrder->getBasket();

$hasItems = false;

foreach ($oldBasket as $oldItem) {
    if ($oldItem->getId() == $basketId) {
        continue;
    }

    $hasItems = true;

    $productId = $oldItem->getProductId();
    $module    = $oldItem->getField('MODULE');

    $props = $oldItem->getPropertyCollection();
    $scheduleId = null;

    foreach ($props as $prop) {
        $code  = $prop->getField('CODE');
        $value = $prop->getField('VALUE');

        if ($value && in_array(strtoupper($code), ['SCHEDULE_ID', 'RASPISANIE_ID', 'COURSE_SCHEDULE']) ||
            stripos($code, 'schedule') !== false || stripos($code, 'raspisanie') !== false) {
            $scheduleId = (int)$value;
            break;
        }
    }

    if ($scheduleId > 0) {
        $productId = $scheduleId;
    }

    $newItem = $newBasket->createItem($module, $productId);
    if (!$newItem) {

        $newItem = $newBasket->createItem($module, $oldItem->getProductId());
        if (!$newItem) {
            continue;
        }
    }

    $fields = [
        'QUANTITY'        => $oldItem->getQuantity(),
        'CURRENCY'        => $oldItem->getCurrency(),
        'LID'             => SITE_ID,
        'PRICE'           => $oldItem->getPrice(),
        'BASE_PRICE'      => $oldItem->getBasePrice(),
        'NAME'            => $oldItem->getField('NAME'),
        'DETAIL_PAGE_URL' => $oldItem->getField('DETAIL_PAGE_URL'),
        'CUSTOM_PRICE'    => 'Y',
    ];

    foreach (['PRODUCT_PROVIDER_CLASS', 'CATALOG_XML_ID', 'PRODUCT_XML_ID', 'NOTES', 'DISCOUNT_PRICE'] as $f) {
        $val = $oldItem->getField($f);
        if ($val !== null) $fields[$f] = $val;
    }

    $newItem->setFields($fields);

    $newProps = $newItem->getPropertyCollection();
    $propsToSet = [];
    foreach ($props as $oldProp) {
        $propsToSet[] = [
            'NAME'  => $oldProp->getField('NAME'),
            'CODE'  => $oldProp->getField('CODE'),
            'VALUE' => $oldProp->getField('VALUE'),
            'SORT'  => $oldProp->getField('SORT') ?: 100,
        ];
    }
    if (!empty($propsToSet)) {
        $newProps->setProperty($propsToSet);
    }
}


if (!$hasItems) {
    $newOrder->setField('CANCELED', 'Y');
    $newOrder->save();


    $oldOrder->setField('CANCELED', 'N');
    $oldOrder->save();

    die(json_encode([
        'status' => 'error',
        'error'  => 'Не удалось скопировать позиции в новый заказ'
    ]));
}


$newBasket->save();


$oldProps = $oldOrder->getPropertyCollection();
$newProps = $newOrder->getPropertyCollection();

foreach ($oldProps as $oldProp) {
    $propId = $oldProp->getField('ORDER_PROPS_ID');
    $value  = $oldProp->getValue();
    if ($propId && $value !== null) {
        $newProp = $newProps->getItemByOrderPropertyId($propId);
        if ($newProp) {
            $newProp->setValue($value);
        }
    }
}

$newOrder->setField('COMMENTS', 'Создан после отмены позиции из заказа №' . $oldOrder->getField('ACCOUNT_NUMBER'));
$newOrder->setField('STATUS_ID', 'N');

$saveResult = $newOrder->save();
if (!$saveResult->isSuccess()) {

    $oldOrder->setField('CANCELED', 'N');
    $oldOrder->save();

    die(json_encode([
        'status' => 'error',
        'error'  => 'Ошибка сохранения нового заказа: ' . implode(', ', $saveResult->getErrorMessages())
    ]));
}

$newBasket->refresh();
echo json_encode([
    'status'            => 'success',
    'message'           => 'Позиция отменена. Создан новый заказ',
    'new_order_id'      => $newOrder->getId(),
    'new_order_number'  => $newOrder->getField('ACCOUNT_NUMBER'),
    'new_order_total'   => Sale\PriceMaths::roundPrecision($newOrder->getPrice()),
    'new_order_url'     => '/personal/order/detail/' . $newOrder->getId() . '/',
    'is_fully_canceled' => false
]);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");