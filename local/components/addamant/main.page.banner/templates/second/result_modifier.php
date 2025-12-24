<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var $arParams */
/** @var $arResult */

if (!empty($arResult['ITEMS'])) {
    usort($arResult['ITEMS'], 'sortArraySec');

    $SHOW_MAX_ELEM = 5;

    foreach ($arResult['ITEMS'] as $key => $item) {
        if ($key + 1 > $SHOW_MAX_ELEM) {
            unset($arResult['ITEMS'][$key]);
        }

        if ($item['IMAGE']) {
            $arResult['ITEMS'][$key]['IMAGE'] = CFile::GetPath($item['IMAGE']);
        }

        if ($item['IBLOCK_SECTION_PAGE_URL']) {
            $url = str_replace('#CODE#/', '', $item['IBLOCK_SECTION_PAGE_URL']);
            $arResult['ITEMS'][$key]['URL'] = $url . $item['CODE'] . '/';
        }
    }
}

function sortArraySec($a, $b)
{
    return strcmp($a['SORT'], $b['SORT']);
}