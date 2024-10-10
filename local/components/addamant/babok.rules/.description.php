<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = [
    'NAME' => Loc::getMessage('COMPONENT_NAME_CAAS_AUDIT'),
    'DESCRIPTION' => Loc::getMessage('COMPONENT_DESCRIPTION_CAAS_AUDIT'),
    'PATH' => [
        'ID' => Loc::getMessage('COMPONENT_SECTION'),
    ],
];
