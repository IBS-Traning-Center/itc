<?php

use \Bitrix\Iblock\Elements\ElementCertificatesTable;
use \Bitrix\Iblock\Elements\ElementScheduleTable;
use \Bitrix\Iblock\Elements\ElementCoursesTable;
use Local\Util\HighloadblockManager;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */

if ($arResult) {
    $certificates = ElementCertificatesTable::getList([
        'select' => [
            'NAME',
            'PREVIEW_PICTURE',
            'DETAIL_PICTURE'
        ],
        'filter' => [
            'EXPERT.VALUE' => $arResult['ID']
        ]
    ])->fetchAll();

    if (!empty($certificates)) {
        foreach ($certificates as $certificate) {
            if ($certificate['DETAIL_PICTURE']) {
                $arResult['CERTIFICATES'][] = [
                    'NAME' => $certificate['NAME'] ?: '',
                    'PICTURE' => CFile::GetPath($certificate['DETAIL_PICTURE'])
                ];
            } else if ($certificate['PREVIEW_PICTURE']) {
                $arResult['CERTIFICATES'][] = [
                    'NAME' => $certificate['NAME'] ?: '',
                    'PICTURE' => CFile::GetPath($certificate['PREVIEW_PICTURE'])
                ];
            }
        }
    }

    if (!empty($arResult['PROPERTIES']['TRAINER_VIDEOS']['VALUE'])) {
        $videosCode = [];
        foreach ($arResult['PROPERTIES']['TRAINER_VIDEOS']['VALUE'] as $value) {
            $videosCode[] = $value;
        }

        $videosTable = new HighloadblockManager('TrainersVideo');
        $videosTable->prepareParamsQuery(['UF_NAME', 'UF_XML_ID', 'UF_PICTURE', 'UF_VIDEO_LINK'], [], ['UF_XML_ID' => $videosCode]);

        $videos = $videosTable->getDataAll();

        foreach ($videos as &$video) {
            $value = $video['UF_VIDEO_LINK'];
            $isRutube = strpos($value, 'rutube') !== false;
            $isYoutube = strpos($value, 'youtube') !== false;
            if (!$isRutube && !$isYoutube) continue;
    
            if ($isRutube) {
                preg_match("/\/video\/([a-zA-Z0-9_-]+)/", $value, $matches);
                if (!empty($matches[1])) {
                    $video['ID'] = $matches[1]; // ID для RuTube
                    $video['PLATFORM'] = 'rutube';
                } else {
                    continue;
                }
            }	

            if ($isYoutube) {
                $video['PLATFORM'] = 'youtube';
            } else {
                continue;
            }
        }
        $arResult['VIDEOS'] = $videos;
    }

    $dateNow = date('Y-m-d');

    $schedules = ElementScheduleTable::getList([
        'select' => [
            'schedule_course'
        ],
        'filter' => [
            'ACTIVE' => 'Y',
            'teacher.VALUE' => $arResult['ID'],
            '<startdate.VALUE' => $dateNow,
            '>=enddate.VALUE' => $dateNow
        ]
    ])->fetchCollection();

    $coursesIds = [];
    if ($schedules) {
        foreach ($schedules as $schedule) {
            if ($schedule->getScheduleCourse() && $schedule->getScheduleCourse()->getValue()) {
                $coursesIds[] = $schedule->getScheduleCourse()->getValue();
            }
        }
    }

    if (!empty($coursesIds)) {
        $courses = ElementCoursesTable::getList([
            'select' => [
                'course_code',
                'NAME',
                'course_duration',
                'COMPLEXITY.ITEM',
                'course_price',
                'short_descr',
                'XML_ID'
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                'ID' => $coursesIds
            ]
        ])->fetchCollection();

        $coursesInfo = [];
        if ($courses) {
            foreach ($courses as $course) {
                $courseInfo = [];

                if ($course->getName()) {
                    $courseInfo['NAME'] = $course->getName();
                }

                if ($course->getCourseCode() && $course->getCourseCode()->getValue()) {
                    $courseInfo['CODE'] = $course->getCourseCode()->getValue();
                }

                if ($course->getCourseDuration() && $course->getCourseDuration()->getValue()) {
                    $courseInfo['DURATION'] = $course->getCourseDuration()->getValue();
                }

                if (
                    $course->getComplexity() &&
                    $course->getComplexity()->getItem() &&
                    $course->getComplexity()->getItem()->getValue()
                ) {
                    $courseInfo['COMPLEXITY'] = $course->getComplexity()->getItem()->getValue();
                }

                if ($course->getCoursePrice() && $course->getCoursePrice()->getValue()) {
                    $courseInfo['PRICE'] = $course->getCoursePrice()->getValue();
                }

                if ($course->getShortDescr() && $course->getShortDescr()->getValue()) {
                    $courseInfo['DESCRIPTION'] = $course->getShortDescr()->getValue();
                }

                if ($course->getXmlId()) {
                    $courseInfo['XML_ID'] = $course->getXmlId();
                }

                $coursesInfo[] = $courseInfo;
            }

            $arResult['COURSES'] = $coursesInfo;
        }
    }
}