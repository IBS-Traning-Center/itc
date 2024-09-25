<?php

use \Bitrix\Iblock\Elements\ElementCoursesTable;
use \Bitrix\Iblock\Elements\ElementScheduleTable;
use \Bitrix\Iblock\Elements\ElementTrainersTable;
use \Bitrix\Iblock\Elements\ElementArticlesTable;
use Local\Util\HighloadblockManager;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!empty($arResult['SEARCH'])) {
    $coursesIds = [];
    $newsIds = [];
    $trainersIds = [];

    foreach ($arResult['SEARCH'] as $item) {
        if ($item['PARAM2'] == IBLOCK_ID_COURSES) {
            $coursesIds[] = $item['ITEM_ID'];
        }

        if ($item['PARAM2'] == IBLOCK_ID_NEWS) {
            $newsIds[] = $item['ITEM_ID'];
        }

        if ($item['PARAM2'] == IBLOCK_ID_TRAINERS) {
            $trainersIds[] = $item['ITEM_ID'];
        }
    }

    if (!empty($coursesIds)) {
        $coursesDB = ElementCoursesTable::getList([
            'select' => [
                'ID',
                'course_code',
                'NAME',
                'course_duration',
                'COMPLEXITY.ITEM',
                'IS_NEW.ITEM',
                'course_price',
                'short_descr',
                'XML_ID'
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                'ID' => $coursesIds
            ]
        ])->fetchCollection();

        $courses = [];
        if ($coursesDB) {
            foreach ($coursesDB as $courseBD) {
                $course = [];

                if ($courseBD->getId()) {
                    $course['ID'] = $courseBD->getId();
                }

                if ($courseBD->getXmlId()) {
                    $course['XML_ID'] = $courseBD->getXmlId();
                }

                if ($courseBD->getName()) {
                    $course['NAME'] = $courseBD->getName();
                }

                if ($courseBD->getCourseCode() && $courseBD->getCourseCode()->getValue()) {
                    $course['CODE'] = $courseBD->getCourseCode()->getValue();
                }

                if ($courseBD->getCourseDuration() && $courseBD->getCourseDuration()->getValue()) {
                    $course['DURATION'] = $courseBD->getCourseDuration()->getValue();
                }

                if (
                    $courseBD->getComplexity() &&
                    $courseBD->getComplexity()->getItem() &&
                    $courseBD->getComplexity()->getItem()->getValue()
                ) {
                    $course['COMPLEXITY'] = $courseBD->getComplexity()->getItem()->getValue();
                }

                if (
                    $courseBD->getIsNew() &&
                    $courseBD->getIsNew()->getItem() &&
                    $courseBD->getIsNew()->getItem()->getXmlId()
                ) {
                    $course['IS_NEW'] = $courseBD->getIsNew()->getItem()->getXmlId() == 'Y';
                }

                if ($courseBD->getCoursePrice() && $courseBD->getCoursePrice()->getValue()) {
                    $course['PRICE'] = $courseBD->getCoursePrice()->getValue();
                }

                if ($courseBD->getShortDescr() && $courseBD->getShortDescr()->getValue()) {
                    $course['DESCRIPTION'] = $courseBD->getShortDescr()->getValue();
                }

                if ($course['ID']) {
                    $schedule = ElementScheduleTable::getList([
                        'select' => [
                            'schedule_price'
                        ],
                        'filter' => [
                            'ACTIVE' => 'Y',
                            'schedule_course.VALUE' => $course['ID'],
                            '<startdate.VALUE' => date('Y-m-d'),
                            '>=enddate.VALUE' => date('Y-m-d')
                        ]
                    ])->fetch();

                    if ($schedule) {
                        if ($course['PRICE'] > $schedule['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_schedule_price_VALUE']) {
                            $course['OLD_PRICE'] = $course['PRICE'];
                            $course['PRICE'] = $schedule['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_schedule_price_VALUE'];
                        }
                    }
                }

                $courses[] = $course;
            }
        }

        $arResult['COURSES'] = $courses;
    }

    if (!empty($trainersIds)) {
        $trainersBD = ElementTrainersTable::getList([
            'select' => [
                'ID',
                'NAME',
                'CODE',
                'PREVIEW_PICTURE',
                'expert_title',
                'expert_name'
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                'ID' => $trainersIds
            ]
        ])->fetchCollection();

        $trainers = [];

        if ($trainersBD) {
            foreach ($trainersBD as $trainerBD) {
                $trainer = [];

                if ($trainerBD->getId()) {
                    $trainer['ID'] = $trainerBD->getId();
                }

                if ($trainerBD->getName()) {
                    $trainer['NAME'] = $trainerBD->getName();
                    $trainer['INITIALS'] = substr($trainerBD->getName(), 0, 1);
                }

                if ($trainerBD->getCode()) {
                    $trainer['CODE'] = $trainerBD->getCode();
                }

                if ($trainerBD->getPreviewPicture()) {
                    $trainer['PICTURE'] = CFile::GetPath($trainerBD->getPreviewPicture());
                }

                if ($trainerBD->getExpertTitle() && $trainerBD->getExpertTitle()->getValue()) {
                    $trainer['DESCRIPTION'] = $trainerBD->getExpertTitle()->getValue();
                }

                if ($trainerBD->getExpertName() && $trainerBD->getExpertName()->getValue()) {
                    $trainer['NAME'] = ($trainer['NAME']) ? $trainer['NAME'] . ' ' . $trainerBD->getExpertName()->getValue() : $trainerBD->getExpertName()->getValue();
                    $trainer['INITIALS'] = ($trainer['NAME']) ? substr($trainer['NAME'], 0, 1) . ' ' . substr($trainerBD->getExpertName()->getValue(), 0, 1) : substr($trainerBD->getExpertName()->getValue(), 0, 1);
                }

                $trainers[] = $trainer;
            }
        }

        $arResult['TRAINERS'] = $trainers;
    }

    if (!empty($newsIds)) {
        $newsBD = ElementArticlesTable::getList([
            'select' => [
                'ID',
                'NAME',
                'CODE',
                'PREVIEW_PICTURE',
                'PREVIEW_TEXT',
                'ACTIVE_FROM',
                'NEWS_TAGS'
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                'ID' => $newsIds
            ]
        ])->fetchCollection();

        $news = [];

        if ($newsBD) {
            foreach ($newsBD as $newBD) {
                $article = [];

                if ($newBD->getId()) {
                    $article['ID'] = $newBD->getId();
                }

                if ($newBD->getName()) {
                    $article['NAME'] = $newBD->getName();
                }

                if ($newBD->getCode()) {
                    $article['CODE'] = $newBD->getCode();
                }

                if ($newBD->getPreviewPicture()) {
                    $article['PICTURE'] = CFile::GetPath($newBD->getPreviewPicture());
                }

                if ($newBD->getPreviewText()) {
                    $article['DESCRIPTION'] = $newBD->getPreviewText();
                }

                if ($newBD->getActiveFrom()) {
                    $article['DATE_CREATE'] = FormatDate('d F Y', MakeTimeStamp($newBD->getActiveFrom()));
                }

                if ($newBD->getNewsTags() && $newBD->getNewsTags()->getAll()) {
                    $tags = [];

                    foreach ($newBD->getNewsTags()->getAll() as $tag) {
                        $tags[] = $tag->getValue();
                    }

                    if (!empty($tags)) {
                        $tagTable = new HighloadblockManager('TagsNews');

                        $tagTable->prepareParamsQuery(['UF_NAME', 'UF_XML_ID'], [], ['UF_XML_ID' => $tags]);
                        $itemTags = $tagTable->getDataAll();

                        $article['TAGS'] = $itemTags;
                    }
                }

                $news[] = $article;
            }
        }

        $arResult['NEWS'] = $news;
    }
}