<?php

use \Bitrix\Iblock\Elements\ElementScheduleTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var $arParams */
/** @var $arResult */
/** @var $templateFolder */
$coursePrice = 0;
if (!empty($arResult['PROPERTIES']['course_price']['VALUE'])) {
    $coursePrice = (float) $arResult['PROPERTIES']['course_price']['VALUE'];
}

$format = $arResult['format']['UF_XML_ID'] ?? '';
$isCertification = $arResult['certificate'] ?? '';
$isSelfStudy = ($format === 'Self_Study');
$isCert = ($isCertification === 'Y');

$useCoursePrice = ($isSelfStudy || $isCert);

if (!isset($arResult['sale']['price']) || empty($arResult['sale']['price'])) {
    $arResult['sale']['price'] = $coursePrice;
    $arResult['price'] = $coursePrice;
}
$arResult['ORIGINAL_PRICE'] = $coursePrice;

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
            'schedule_course.VALUE' => $arResult['id'],
            '>=enddate.VALUE' => date('Y-m-d')
        ],
        'order' => ['startdate.VALUE' => 'ASC'],
        'limit' => 1
    ])->fetch();
}

if ($schedule) {

    $schedulePrice = 0;
    if (!empty($schedule['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_schedule_price_VALUE'])) {
        $schedulePrice = (float) $schedule['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_schedule_price_VALUE'];
    }

    if ($schedulePrice > 0 && $coursePrice > 0 && $schedulePrice < $coursePrice) {
        $arResult['OLD_PRICE'] = $coursePrice;
    }

    if ($schedulePrice > 0 && !$useCoursePrice) {
        $arResult['sale']['price'] = $schedulePrice;
        $arResult['price'] = $schedulePrice;
    }

    $arResult['SCHEDULE_ID'] = $schedule['ID'];
    $arResult['SCHEDULE_NAME'] = $schedule['NAME'];
    $arResult['HAS_SCHEDULE'] = true;
    $arResult['SCHEDULE_PRICE'] = $schedulePrice ?: $coursePrice;
    $arResult['SCHEDULE_START_DATE'] = $schedule['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_startdate_VALUE'] ?? '';
    $arResult['SCHEDULE_END_DATE'] = $schedule['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_enddate_VALUE'] ?? '';
} else {
    $arResult['HAS_SCHEDULE'] = false;
    $arResult['SCHEDULE_PRICE'] = $coursePrice;
    $arResult['SCHEDULE_ID'] = 0;
    $arResult['SCHEDULE_NAME'] = '';
    $arResult['SCHEDULE_START_DATE'] = '';
    $arResult['SCHEDULE_END_DATE'] = '';
}

$arResult['IS_SELF_STUDY'] = $isSelfStudy;
$arResult['IS_CERTIFICATION'] = $isCert;
$arResult['USE_COURSE_PRICE'] = $useCoursePrice;

$arResult['SHOW_CART_BUTTON'] = ($isSelfStudy || $isCert);