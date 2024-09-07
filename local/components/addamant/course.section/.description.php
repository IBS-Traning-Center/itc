<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = [
    'NAME' => Loc::getMessage('COMPONENT_NAME_COURSE_WITH_DISCOUNT'),
    'DESCRIPTION' => Loc::getMessage('COMPONENT_DESCRIPTION_COURSE_WITH_DISCOUNT'),
    'PATH' => [
        'ID' => Loc::getMessage('COMPONENT_SECTION'),
    ],
];
