<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var $arParams */
/** @var $arResult */

if (!empty($arResult['ITEMS'])) {
    usort($arResult['ITEMS'], 'sortArraySec');

    $SHOW_MAX_ELEM = 7;

    foreach ($arResult['ITEMS'] as $key => $item) {
        if ($key + 1 > $SHOW_MAX_ELEM) {
            continue;
        }

        $arResult['ITEMS_SORT'][$key]['NAME'] = $item['NAME'];
        
        if ($item['IMAGE']) {
            $arResult['ITEMS_SORT'][$key]['IMAGE'] = CFile::GetPath($item['IMAGE']);
        }

        if ($item['IBLOCK_SECTION_PAGE_URL']) {
            $url = str_replace('#CODE#/', '', $item['IBLOCK_SECTION_PAGE_URL']);
            $arResult['ITEMS_SORT'][$key]['URL'] = $url . $item['CODE'] . '/';
        }
    }
}

function sortArraySec($a, $b)
{
    return strcmp($a['SORT'], $b['SORT']);
}