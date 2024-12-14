<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */

if ($arParams['IS_COMPLEX']) {
    $APPLICATION->IncludeComponent(
        'addamant:course.section.complex',
        '.default',
        [
            'CACHE_TIME' => '3600',
            'CACHE_TYPE' => 'A',
            'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE']
        ]
    );
} else {
    $APPLICATION->IncludeComponent(
        'addamant:course.section',
        '.default',
        [
            'CACHE_TIME' => '3600',
            'CACHE_TYPE' => 'A',
            'IBLOCK_ID' => $arParams['SECTION_IBLOCK_ID'][0],
            'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE']
        ]
    );
}
