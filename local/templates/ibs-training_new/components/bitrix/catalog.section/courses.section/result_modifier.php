<?php

use \Bitrix\Iblock\Elements\ElementScheduleTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var $arParams */
/** @var $arResult */
/** @var $templateFolder */

if (!empty($arResult['ITEMS'])) {
    foreach ($arResult['ITEMS'] as $key => $item) {
        $coursePrice = $item['PROPERTIES']['course_price']['VALUE'] ?: '';

        $schedule = ElementScheduleTable::getList([
            'select' => [
                'schedule_course',
                'schedule_price',
                'ID'
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                'schedule_course.VALUE' => $item['ID'],
                '>=enddate.VALUE' => date('Y-m-d')
            ],
        ])->fetch();

        if (
            $schedule &&
            $schedule['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_schedule_price_VALUE'] &&
            $schedule['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_schedule_price_VALUE'] < $coursePrice
        ) {
            $arResult['ITEMS'][$key]['OLD_PRICE'] = $coursePrice;
            $arResult['ITEMS'][$key]['PROPERTIES']['course_price']['VALUE'] = $schedule['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_schedule_price_VALUE'];
        }
    }
}