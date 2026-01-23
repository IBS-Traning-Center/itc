<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentParameters = [
    'GROUPS' => [
        'SETTINGS' => [
            'NAME' => Loc::getMessage('SETTINGS'),
            'SORT' => 550,
        ],
    ],
    'PARAMETERS' => [
        'IBLOCKS_IDS' => [
            'PARENT' => 'SETTINGS',
            'NAME' => Loc::getMessage('IBLOCKS_IDS_TITLE_MAIN_PAGE_BANNER'),
            'TYPE' => 'STRING',
            'MULTIPLE' => 'N',
            'COLS' => 25
        ],
        'CATALOG_LINK' => [
            'PARENT' => 'SETTINGS',
            'NAME' => Loc::getMessage('CATALOG_LINK_TITLE_MAIN_PAGE_BANNER'),
            'TYPE' => 'STRING',
            'MULTIPLE' => 'N',
            'COLS' => 25
        ],
        'CACHE_TIME' => ['DEFAULT' => 3600],
    ]
];