<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = [
    'NAME' => Loc::getMessage('COMPONENT_NAME_SUBSCRIBE'),
    'DESCRIPTION' => Loc::getMessage('COMPONENT_DESCRIPTION_SUBSCRIBE'),
    'PATH' => [
        'ID' => Loc::getMessage('COMPONENT_SECTION'),
    ],
];
