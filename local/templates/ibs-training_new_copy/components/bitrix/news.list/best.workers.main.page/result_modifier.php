<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var $arResult */

if (!empty($arResult['ITEMS'])) {
    $returnElem = [];
    foreach ($arResult['ITEMS'] as $key => $item) {
        if ($item['PROPERTIES']['ELEM_MONEY_RETURN']['VALUE'] == 'Да') {
            $returnElem = $item;
            unset($arResult['ITEMS'][$key]);
        }
    }

    $arResult['RETURN_ELEM'] = $returnElem;
}