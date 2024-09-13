<?php

use \Bitrix\Iblock\Elements\ElementCourseDirectionsTable;
use \Bitrix\Iblock\Elements\ElementNewProgrammsTable;
use \Bitrix\Iblock\Elements\ElementCoursesTable;
use Local\Util\HighloadblockManager;
use Bitrix\Main\Context;
use Bitrix\Main\Entity\Query;

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$request = Context::getCurrent()->getRequest();

/** @var array $arResult */
/** @var array $arParams */

$filter = $request->get('filter');

if (!empty($arResult['SECTIONS'])) {
    $oldArray = $arResult['SECTIONS'];

    usort($oldArray, function($a, $b) use ($oldArray) {
        return array_search($a['SORT'], $oldArray) - array_search($b['SORT'], $oldArray);
    });

    $arResult['SECTIONS'] = $oldArray;

    $filterTabs = [];
    $elements = [];

    foreach ($arResult['SECTIONS'] as $key => $section) {
        if ($section['ELEMENT_CNT'] <= 0) {
            unset($arResult['SECTIONS'][$key]);
            continue;
        }

        if ($section['IBLOCK_ID'] == IBLOCK_ID_DIRECTION) {
            $elementsBD = ElementCourseDirectionsTable::getList([
                'select' => [
                    'ID',
                    'PP_COURSE'
                ],
                'filter' => [
                    'ACTIVE' => 'Y',
                    'IBLOCK_SECTION.ID' => $section['ID']
                ],
            ])->fetchAll();

            if (!empty($elementsBD)) {
                foreach ($elementsBD as $elem) {
                    $elements[] = [
                        'COURSE_ID' => $elem['IBLOCK_ELEMENTS_ELEMENT_COURSE_DIRECTIONS_PP_COURSE_VALUE'],
                        'SECTION_ID' => $section['ID']
                    ];
                }
            }
        } elseif ($section['IBLOCK_ID'] == IBLOCK_ID_COMPLEX) {
            $elementsBD = ElementNewProgrammsTable::getList([
                'select' => [
                    'ID',
                    'COURSES'
                ],
                'filter' => [
                    'ACTIVE' => 'Y',
                    'IBLOCK_SECTION.ID' => $section['ID']
                ],
            ])->fetchAll();

            if (!empty($elementsBD)) {
                foreach ($elementsBD as $elem) {
                    $elements[] = [
                        'COURSE_ID' => $elem['IBLOCK_ELEMENTS_ELEMENT_NEW_PROGRAMMS_pp_course_VALUE'],
                        'SECTION_ID' => $section['ID']
                    ];
                }
            }
        }
    }

    $coursesInfo = [];
    $tags = [];

    if (!empty($elements)) {
        foreach ($elements as $key => $courseInfo) {
            $query = new Query(ElementCoursesTable::getEntity());
            $query->setSelect([
                'ID',
                'COURSE_TAGS',
                'course_price'
            ])
            ->setFilter([
                'ACTIVE' => 'Y',
                'ID' => $courseInfo['COURSE_ID']
            ]);

            if (!empty($filter) && $filter[0] != 'all') {
                $query->addFilter('COURSE_TAGS.VALUE', $filter);
            }

            $result = $query->exec();

            $coursesBD = $result->fetchCollection();

            if (!empty($coursesBD)) {
                foreach ($coursesBD as $course) {
                    $coursePrice = 0;

                    if ($course->getCourseTags() && $course->getCourseTags()->getAll()) {
                        foreach ($course->getCourseTags()->getAll() as $tag) {
                            $tags[] = $tag->getValue();
                        }
                    }

                    if ($course->getCoursePrice() && $course->getCoursePrice()->getValue()) {
                        $coursePrice = $course->getCoursePrice()->getValue();
                    }

                    $coursesInfo[] = [
                        'PRICE' => $coursePrice,
                        'SECTION_ID' => $courseInfo['SECTION_ID']
                    ];
                }
            }
        }
    }

    if (!empty($tags)) {
        $tagTable = new HighloadblockManager('TagsCatalog');

        $tagTable->prepareParamsQuery(['UF_NAME', 'UF_XML_ID'], [], ['UF_XML_ID' => $tags]);
        $itemsTags = $tagTable->getDataAll();

        $filterTabs = $itemsTags;
    }

    foreach ($arResult['SECTIONS'] as $key => $section) {
        $price = [];

        foreach ($coursesInfo as $info) {
            if ($info['SECTION_ID'] == $section['ID']) {
                if ($info['PRICE']) {
                    $price[] = intval($info['PRICE']);
                }
            }
        }

        if (empty($price)) {
            $price = [0];
        }

        $arResult['SECTIONS'][$key]['PRICE'] = min($price);
    }

    $coursesInfo = array_unique_key($coursesInfo, 'SECTION_ID');

    $newSections = [];

    foreach ($coursesInfo as $info) {
        foreach ($arResult['SECTIONS'] as $key => $section) {
            if ($info['SECTION_ID'] == $section['ID']) {
                $newSections[] = $section;
            }
        }
    }

    $arResult['SECTIONS'] = $newSections;

    $newFilerTabs = [];

    if (!empty($filterTabs)) {
        foreach ($filterTabs as $filterTab) {
            $newFilerTabs[] = [
                'NAME' => $filterTab['UF_NAME'],
                'CODE' => $filterTab['UF_XML_ID']
            ];
        }
    }

    $newFilerTabs = array_unique($newFilerTabs, SORT_REGULAR);

    $arResult['FILTER_TABS'] = $newFilerTabs;
}

function array_unique_key($array, $key) {

    $tmp = $key_array = [];
    $i = 0;

    foreach($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];

            $tmp[$i] = $val;
        }
        $i++;
    }

    return $tmp;
}