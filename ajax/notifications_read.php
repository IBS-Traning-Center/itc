<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

use Bitrix\Main\Loader;
use Bitrix\Iblock\ElementTable;
use Bitrix\Iblock\PropertyEnumerationTable;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Iblock\ElementPropertyTable;
define('IBLOCK_NOTIFICATIONS_ID', 106);
if (!Loader::includeModule('iblock')) {
    die(json_encode(['success' => false, 'error' => 'Module iblock not loaded']));
}

header('Content-Type: application/json');

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$elementId = (int)$request->get('id');
$action = $request->get('action');

if (!$elementId) {
    die(json_encode(['success' => false, 'error' => 'No ID']));
}

if ($action === 'markAsRead') {
    // 1. Сохраняем в сессию
    if (!isset($_SESSION['VIEWED_NOTIFICATIONS'])) {
        $_SESSION['VIEWED_NOTIFICATIONS'] = [];
    }

    if (!in_array($elementId, $_SESSION['VIEWED_NOTIFICATIONS'])) {
        $_SESSION['VIEWED_NOTIFICATIONS'][] = $elementId;
    }

    // 2. Обновляем свойство IS_READ в инфоблоке
    $property = \CIBlockProperty::GetList(
        [],
        ['IBLOCK_ID' => IBLOCK_NOTIFICATIONS_ID, 'CODE' => 'IS_READ']
    )->Fetch();

    if ($property) {
        \CIBlockElement::SetPropertyValuesEx(
            $elementId,
            IBLOCK_NOTIFICATIONS_ID,
            ['IS_READ' => 'Y']
        );
    }

    echo json_encode(['success' => true]);
} elseif ($action === 'markAllAsRead') {
    $ids = $request->get('ids');
    if ($ids) {
        $ids = explode(',', $ids);
        foreach ($ids as $id) {
            \CIBlockElement::SetPropertyValuesEx(
                (int)$id,
                IBLOCK_NOTIFICATIONS_ID,
                ['IS_READ' => 'Y']
            );
        }
    }
    echo json_encode(['success' => true]);
}

\Bitrix\Main\Application::getInstance()->end();