<?php

use Local\Util\HighloadblockManager;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var $arParams */
/** @var $arResult */
/** @var $templateFolder */

if (!empty($arResult['ITEMS'])) {
    foreach ($arResult['ITEMS'] as $key => $item) {
        if ($item['PROPERTIES']['NEWS_TAGS']['VALUE']) {
            $item['PROPERTIES']['NEWS_TAGS']['VALUE'] = array_unique($item['PROPERTIES']['NEWS_TAGS']['VALUE']);

            $tagTable = new HighloadblockManager('TagsNews');

            $tagTable->prepareParamsQuery(['UF_NAME', 'UF_XML_ID'], [], ['UF_XML_ID' => $item['PROPERTIES']['NEWS_TAGS']['VALUE']]);
            $itemTags = $tagTable->getDataAll();

            $arResult['ITEMS'][$key]['TAGS'] = $itemTags;
        }

        $dateCreate = $item['ACTIVE_FROM'];
        $newDateCreate = FormatDate('d F Y', MakeTimeStamp($item['ACTIVE_FROM']));

        $arResult['ITEMS'][$key]['DATE_CREATE'] = $newDateCreate;
    }
}