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
        'BLOCK_TITLE' => [
            'PARENT' => 'SETTINGS',
            'NAME' => Loc::getMessage('BLOCK_TITLE_TITLE'),
            'TYPE' => 'STRING',
            'MULTIPLE' => 'N',
            'COLS' => 25
        ],
        'KVAL_LINK' => [
            'PARENT' => 'SETTINGS',
            'NAME' => Loc::getMessage('KVAL_LINK_TITLE'),
            'TYPE' => 'STRING',
            'MULTIPLE' => 'N',
            'COLS' => 25
        ],
        'CACHE_TIME' => ['DEFAULT' => 3600],
    ]
];