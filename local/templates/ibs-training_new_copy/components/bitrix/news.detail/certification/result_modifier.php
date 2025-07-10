<?php

use \Bitrix\Iblock\Elements\ElementScheduleTable;
use \Bitrix\Iblock\Elements\ElementCitiesTable;

/** @var array $arResult */
/** @var array $arParams */

if ($arResult) {
    $basicDates = [];
    $specDates = [];
    $profDates = [];

    if (is_array($arResult['PROPERTIES']['COURSE_BASIC']['VALUE']) && !empty($arResult['PROPERTIES']['COURSE_BASIC']['VALUE'])) {
        foreach ($arResult['PROPERTIES']['COURSE_BASIC']['VALUE'] as $elementId) {
            $schedules = getSchedule($elementId);

            foreach ($schedules as $schedule) {
                $basicDates[getCityCode($schedule['CITY_VALUE'])][] = date('d.m.Y', strtotime($schedule['START_DATE_VALUE']));
            }
        }
    }

    if (is_array($arResult['PROPERTIES']['COURSE_SPEC']['VALUE']) && !empty($arResult['PROPERTIES']['COURSE_SPEC']['VALUE'])) {
        foreach ($arResult['PROPERTIES']['COURSE_SPEC']['VALUE'] as $elementId) {
            $schedules = getSchedule($elementId);

            foreach ($schedules as $schedule) {
                $specDates[getCityCode($schedule['CITY_VALUE'])][] = date('d.m.Y', strtotime($schedule['START_DATE_VALUE']));
            }
        }
    }

    if (is_array($arResult['PROPERTIES']['COURSE_FROF']['VALUE']) && !empty($arResult['PROPERTIES']['COURSE_FROF']['VALUE'])) {
        foreach ($arResult['PROPERTIES']['COURSE_FROF']['VALUE'] as $elementId) {
            $schedules = getSchedule($elementId);

            foreach ($schedules as $schedule) {
                $profDates[getCityCode($schedule['CITY_VALUE'])][] = date('d.m.Y', strtotime($schedule['START_DATE_VALUE']));
            }
        }
    }
}

if ($basicDates) {
    $basicDates = sortDatesArray($basicDates);
}

if ($specDates) {
    $specDates = sortDatesArray($specDates);
}

if ($profDates) {
    $profDates = sortDatesArray($profDates);
}

$arResult['BASIC_DATES'] = $basicDates;
$arResult['SPEC_DATES'] = $specDates;
$arResult['PROF_DATES'] = $profDates;

function getSchedule($elementId) : array
{
    return ElementScheduleTable::getList([
        'order' => [
            'ID' => 'DESC'
        ],
        'select' => [
            'START_DATE_' => 'startdate',
            'CITY_' => 'city'
        ],
        'filter' => [
            'schedule_course.VALUE' => $elementId,
            '>startdate.VALUE' => date('Y-m-d H:i:s'),
            'ACTIVE' => 'Y'
        ]
    ])?->fetchAll() ?: [];
}

function getCityCode($cityId) : string
{
    return ElementCitiesTable::getList([
        'select' => ['CODE'],
        'filter' => ['ID' => $cityId]
    ])?->fetch()['CODE'] ?: '';
}

function sortDatesArray($datesArray) : array
{
    $compareDates = function ($a, $b) {
        $dateA = DateTime::createFromFormat('d.m.Y', $a);
        $dateB = DateTime::createFromFormat('d.m.Y', $b);
        
        if ($dateA == $dateB) {
            return 0;
        }
        return ($dateA < $dateB) ? -1 : 1;
    };

    array_walk($datesArray, function (&$value) use ($compareDates) {
        if (is_array($value)) {
            usort($value, $compareDates);
        }
    });

    $isFlatDateArray = true;

    foreach ($datesArray as $item) {
        if (!is_string($item) || !DateTime::createFromFormat('d.m.Y', $item)) {
            $isFlatDateArray = false;
            break;
        }
    }

    if ($isFlatDateArray) {
        usort($datesArray, $compareDates);
    }

    return $datesArray;
}