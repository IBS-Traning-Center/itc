<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @global CMain $APPLICATION
 */

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use \Bitrix\Iblock\Elements\ElementCourseDirectionsTable;
use \Bitrix\Iblock\Elements\ElementNewProgrammsTable;

Loc::loadMessages(__FILE__);

class CourseSectionComponent extends CBitrixComponent
{
    private $courseSectionIBResult;
    private $needlCoursesIds;

    /* Проверка подключения компонента */
    /**
     * @throws \Bitrix\Main\LoaderException
     * @throws SystemException
     */
    private function checkModules()
    {

        if (!Loader::includeModule('iblock')) {
            throw new SystemException(
                Loc::getMessage('IBLOCK_IS_NOT_INITIALIZED')
            );
        }

        return true;
    }

    /* Проверка входящих параметров */
    /**
     * @throws \Bitrix\Main\LoaderException
     * @throws SystemException
     */
    private function checkParams()
    {
        if (
            !$this->arParams['IBLOCK_ID'] ||
            !$this->arParams['SECTION_CODE']
        ) {
            throw new SystemException(
                Loc::getMessage('EMPTY_PARAMS')
            );
        }

        return true;
    }

    public function getSectionElements()
    {
        if ($this->arParams['IBLOCK_ID'] == IBLOCK_ID_COMPLEX) {
            return $this->courseSectionIBResult = ElementNewProgrammsTable::getList([
                'select' => [
                    'pp_course'
                ],
                'filter' => [
                    'ACTIVE' => 'Y',
                    'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
                    'IBLOCK_SECTION.CODE' => $this->arParams['SECTION_CODE'],
                ]
            ])->fetchAll();
        } elseif ($this->arParams['IBLOCK_ID'] == IBLOCK_ID_DIRECTION) {
            return $this->courseSectionIBResult = ElementCourseDirectionsTable::getList([
                'select' => [
                    'PP_COURSE'
                ],
                'filter' => [
                    'ACTIVE' => 'Y',
                    'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
                    'IBLOCK_SECTION.CODE' => $this->arParams['SECTION_CODE'],
                ]
            ])->fetchAll();
        }
    }

    private function writeElementsIds()
    {
        if (!$this->courseSectionIBResult) {
            return false;
        }

        foreach ($this->courseSectionIBResult as $item) {
            if (
                $this->arParams['IBLOCK_ID'] == IBLOCK_ID_COMPLEX &&
                $item['IBLOCK_ELEMENTS_ELEMENT_NEW_PROGRAMMS_pp_course_VALUE']
            ) {
                $this->needlCoursesIds[] = $item['IBLOCK_ELEMENTS_ELEMENT_NEW_PROGRAMMS_pp_course_VALUE'];
            } elseif (
                $this->arParams['IBLOCK_ID'] == IBLOCK_ID_DIRECTION &&
                $item['IBLOCK_ELEMENTS_ELEMENT_COURSE_DIRECTIONS_PP_COURSE_VALUE']
            ) {
                $this->needlCoursesIds[] = $item['IBLOCK_ELEMENTS_ELEMENT_COURSE_DIRECTIONS_PP_COURSE_VALUE'];
            }
        }
    }

    private function getSectionInfo()
    {
        $sectionDB = CIBlockSection::GetList(
            [],
            [
                'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
                'CODE' => $this->arParams['SECTION_CODE']
            ],
            false,
            [
                'NAME'
            ]
        );

        while($section = $sectionDB->GetNext())
        {
            if ($section['NAME']) {
                $this->arResult['SECTION_NAME'] = $section['NAME'];
            }
        }
    }

    /* Записываем результат в переменную */
    public function makeReviewsResult()
    {
        $this->arResult['COURSES_IDS'] = $this->needlCoursesIds;
    }

    public function executeComponent(): void
    {
        $this->checkModules();
        $this->checkParams();

        $this->getSectionElements();
        $this->writeElementsIds();

        $this->getSectionInfo();

        $this->makeReviewsResult();

        $this->includeComponentTemplate();
    }
}
