<?php

use Local\Util\HighloadblockManager;
use \Bitrix\Iblock\Elements\ElementTrainersTable;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */

$trainers = ElementTrainersTable::getList([
    'select' => [
        'TRAINER_TAGS'
    ],
    'filter' => [
        'ACTIVE' => 'Y'
    ]
])->fetchAll();

if ($trainers) {
    $tagsCode = [];

    foreach ($trainers as $trainer) {
        if ($trainer['IBLOCK_ELEMENTS_ELEMENT_TRAINERS_TRAINER_TAGS_VALUE']) {
            $tagsCode[] = $trainer['IBLOCK_ELEMENTS_ELEMENT_TRAINERS_TRAINER_TAGS_VALUE'];
        }
    }

    if (!empty($tagsCode)) {
        $tagsCode = array_unique($tagsCode);

        $tagTable = new HighloadblockManager('TagsCatalog');

        $tagTable->prepareParamsQuery(['UF_NAME', 'UF_XML_ID'], [], ['UF_XML_ID' => $tagsCode]);
        $itemsTags = $tagTable->getDataAll();

        $arResult['FILTER_TAGS'] = $itemsTags;
    }
}