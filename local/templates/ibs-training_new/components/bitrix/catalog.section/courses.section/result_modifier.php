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
        $format = $item['PROPERTIES']['FORMAT']['VALUE'] ?? '';
        $isCertification = $item['PROPERTIES']['is_certification']['VALUE_XML_ID'] ?? '';
        $isSelfStudy = ($format === 'Self_Study');
        $isCert = ($isCertification === 'Y');
        $useCoursePrice = ($isSelfStudy || $isCert);

        $schedule = null;

        if (!$useCoursePrice) {
            $schedule = ElementScheduleTable::getList([
                'select' => [
                    'ID',
                    'NAME',
                    'schedule_course',
                    'schedule_price',
                    'startdate',
                    'enddate'
                ],
                'filter' => [
                    'ACTIVE' => 'Y',
                    'schedule_course.VALUE' => $item['ID'],
                    '>=enddate.VALUE' => date('Y-m-d')
                ],
                'order' => ['startdate.VALUE' => 'ASC'],
                'limit' => 1
            ])->fetch();
        }

        if ($schedule) {
            $schedulePrice = $schedule['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_schedule_price_VALUE'] ?? null;

            if ($schedulePrice && $coursePrice && $schedulePrice < $coursePrice) {
                $arResult['ITEMS'][$key]['OLD_PRICE'] = $coursePrice;
                $arResult['ITEMS'][$key]['PROPERTIES']['course_price']['VALUE'] = $schedulePrice;
            } elseif ($schedulePrice && !$coursePrice) {
                $arResult['ITEMS'][$key]['PROPERTIES']['course_price']['VALUE'] = $schedulePrice;
            }

            $arResult['ITEMS'][$key]['SCHEDULE_ID'] = $schedule['ID'];
            $arResult['ITEMS'][$key]['SCHEDULE_NAME'] = $schedule['NAME'];
            $arResult['ITEMS'][$key]['HAS_SCHEDULE'] = true;
            $arResult['ITEMS'][$key]['SCHEDULE_PRICE'] = $schedulePrice ?: $coursePrice;
            $arResult['ITEMS'][$key]['SCHEDULE_START_DATE'] = $schedule['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_startdate_VALUE'] ?? '';
            $arResult['ITEMS'][$key]['SCHEDULE_END_DATE'] = $schedule['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_enddate_VALUE'] ?? '';
        } else {
            $arResult['ITEMS'][$key]['HAS_SCHEDULE'] = false;
            $arResult['ITEMS'][$key]['SCHEDULE_PRICE'] = $coursePrice;
            $arResult['ITEMS'][$key]['SCHEDULE_ID'] = 0;

            if ($useCoursePrice) {
                $arResult['ITEMS'][$key]['PROPERTIES']['course_price']['VALUE'] = $coursePrice;
            }
        }

        $arResult['ITEMS'][$key]['ORIGINAL_PRICE'] = $coursePrice;

        $arResult['ITEMS'][$key]['SHOW_CART_BUTTON'] = ($isSelfStudy || $isCert);
    }
}