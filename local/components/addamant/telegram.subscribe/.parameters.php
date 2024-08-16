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
        'SUBSCRIBE_TITLE' => [
            'PARENT' => 'SETTINGS',
            'NAME' => Loc::getMessage('SUBSCRIBE_TITLE'),
            'TYPE' => 'STRING',
            'MULTIPLE' => 'N',
            'COLS' => 25
        ],
        'SUBSCRIBE_LINK' => [
            'PARENT' => 'SETTINGS',
            'NAME' => Loc::getMessage('SUBSCRIBE_LINK'),
            'TYPE' => 'STRING',
            'MULTIPLE' => 'N',
            'COLS' => 25
        ],
        'CACHE_TIME' => ['DEFAULT' => 3600],
    ]
];