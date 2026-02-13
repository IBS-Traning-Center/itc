<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

global $USER;
$currentUserId = $USER->GetID();
if(!isset($_SESSION['VIEWED_NOTIFICATIONS'])) {
    $_SESSION['VIEWED_NOTIFICATIONS'] = [];
}

$arResult['VIEWED_ITEMS'] = $_SESSION['VIEWED_NOTIFICATIONS'];

$filteredItems = [];
foreach($arResult['ITEMS'] as $item) {
    $userId = $item['PROPERTIES']['USER']['VALUE'];
    if(is_array($userId)) {
        $isForCurrentUser = in_array($currentUserId, $userId);
    } else {
        $isForCurrentUser = ($userId == $currentUserId);
    }
    if(empty($userId)) {
        $isForCurrentUser = true;
    }

    if($isForCurrentUser) {
        $filteredItems[] = $item;
    }
}

$arResult['ITEMS'] = $filteredItems;

$tab = $_REQUEST['tab'] ?? 'all';

switch($tab) {
    case 'unread':
        foreach($arResult['ITEMS'] as $key => $item) {
            if(in_array($item['ID'], $arResult['VIEWED_ITEMS']) ||
                $item['PROPERTIES']['IS_READ']['VALUE'] == 'Y') {
                unset($arResult['ITEMS'][$key]);
            }
        }
        break;

    case 'read':
        foreach($arResult['ITEMS'] as $key => $item) {
            if(!in_array($item['ID'], $arResult['VIEWED_ITEMS']) &&
                $item['PROPERTIES']['IS_READ']['VALUE'] != 'Y') {
                unset($arResult['ITEMS'][$key]);
            }
        }
        break;

    case 'all':
    default:
        break;
}
usort($arResult['ITEMS'], function($a, $b) {
    return strtotime($b['ACTIVE_FROM']) - strtotime($a['ACTIVE_FROM']);
});