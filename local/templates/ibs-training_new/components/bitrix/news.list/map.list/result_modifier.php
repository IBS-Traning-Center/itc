<?php

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */
/** @var string $templateFolder */

if (!empty($arResult['ITEMS'])) {
    $tabs = [];

    foreach ($arResult['ITEMS'] as $key => $item) {
        $tabs[$key] = [
            'NAME' => $item['NAME'],
            'CODE' => $item['CODE']
        ];
    }

    $arResult['TABS'] = $tabs;
}