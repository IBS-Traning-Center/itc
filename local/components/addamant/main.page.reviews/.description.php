<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = [
    'NAME' => Loc::getMessage('COMPONENT_NAME_MAIN_PAGE_REVIEWS'),
    'DESCRIPTION' => Loc::getMessage('COMPONENT_DESCRIPTION_MAIN_PAGE_REVIEWS'),
    'PATH' => [
        'ID' => Loc::getMessage('COMPONENT_SECTION'),
    ],
];
