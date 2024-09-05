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
use \Bitrix\Iblock\Elements\ElementCoursesTable;
use \Bitrix\Iblock\Elements\ElementScheduleTable;

Loc::loadMessages(__FILE__);

class CourseWithDiscountComponent extends CBitrixComponent
{
    private $scheduleIBResult;
    private $coursesIBResult;
    private $dateNow;
    private $coursesIds;
    private $newCoursesPrice;
    private $coursesInfo;

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

    public function getDateNow()
    {
        return $this->dateNow = date('Y-m-d');
    }

    public function getScheduleElements()
    {
        return $this->scheduleIBResult = ElementScheduleTable::getList([
            'select' => [
                'ID',
                'schedule_course',
                'enddate',
                'schedule_price'
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                '<startdate.VALUE' => $this->dateNow,
                '>=enddate.VALUE' => $this->dateNow
            ]
        ])->fetchCollection();
    }

    private function scheduleToArray()
    {
        if (!$this->scheduleIBResult) {
            return false;
        }

        foreach ($this->scheduleIBResult as $key => $review) {
            $elemPrice = null;
            $coursePrice = null;

            if ($review->getSchedulePrice() && $review->getSchedulePrice()->getValue()) {
                $elemPrice = $review->getSchedulePrice()->getValue();
            }

            if ($review->getScheduleCourse() && $review->getScheduleCourse()->getValue()) {
                $course = ElementCoursesTable::getList([
                    'select' => [
                        'course_price'
                    ],
                    'filter' => [
                        'ACTIVE' => 'Y',
                        'ID' => $review->getScheduleCourse()->getValue()
                    ]
                ])->fetchObject();

                if ($course && $course->getCoursePrice() && $course->getCoursePrice()->getValue()) {
                    $coursePrice = $course->getCoursePrice()->getValue();
                }

                if (
                    !is_null($elemPrice) &&
                    !is_null($coursePrice) &&
                    $elemPrice < $coursePrice
                ) {
                    $this->newCoursesPrice[$review->getScheduleCourse()->getValue()] = [
                        'NEW_PRICE' => $elemPrice
                    ];
                    $this->coursesIds[] = $review->getScheduleCourse()->getValue();
                }
            }
        }
    }

    public function getCoursesInfo()
    {
        if (empty($this->coursesIds)) {
            return false;
        }

        $coursesIds = array_unique($this->coursesIds);

        return $this->coursesIBResult = ElementCoursesTable::getList([
            'select' => [
                'ID',
                'XML_ID',
                'NAME',
                'short_descr',
                'PREVIEW_PICTURE',
                'course_price',
                'course_duration',
                'IS_NEW.ITEM',
                'COMPLEXITY.ITEM'
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                'ID' => $coursesIds
            ]
        ])->fetchCollection();
    }

    private function coursesInfoToArray()
    {
        if (!$this->coursesIBResult) {
            return false;
        }

        $courses = [];

        foreach ($this->coursesIBResult as $key => $item) {
            $course = [];

            if ($item->getId()) {

                $course['ID'] = $item->getId();

                $course['NEW_PRICE'] = $this->newCoursesPrice[$item->getId()] ? $this->newCoursesPrice[$item->getId()]['NEW_PRICE'] : '';
            }

            if ($item->getName()) {
                $course['NAME'] = $item->getName();
            }

            if ($item->getXmlId()) {
                $course['XML_ID'] = $item->getXmlId();
            }

            if ($item->getShortDescr()) {
                $course['DESCRIPTION'] = $item->getShortDescr()->getValue();
            }

            if ($item->getPreviewPicture()) {
                $course['PICTURE'] = CFile::GetPath($item->getPreviewPicture());
            }

            if ($item->getCoursePrice() && $item->getCoursePrice()->getValue()) {
                $course['OLD_PRICE'] = $item->getCoursePrice()->getValue();
            }

            if ($item->getCourseDuration() && $item->getCourseDuration()->getValue()) {
                $course['COURSE_DURATION'] = $item->getCourseDuration()->getValue();
            }

            if (
                $item->getIsNew() &&
                $item->getIsNew()->getItem() &&
                $item->getIsNew()->getItem()->getXmlId()
            ) {
                $course['IS_NEW'] = $item->getIsNew()->getItem()->getXmlId();
            }

            if (
                $item->getComplexity() &&
                $item->getComplexity()->getItem() &&
                $item->getComplexity()->getItem()->getXmlId()
            ) {
                $course['COMPLEXITY'] = $item->getComplexity()->getItem()->getXmlId();
            }


            if (
                $course['OLD_PRICE'] &&
                $course['NEW_PRICE']
            ) {
                $course['DISCOUNT_PERCENT'] = round(($course['OLD_PRICE'] - $course['NEW_PRICE']) / $course['OLD_PRICE'] * 100);
            }

            $courses[] = $course;
        }

        return $this->coursesInfo = $courses;
    }

    /* Записываем результат в переменную */
    public function makeReviewsResult()
    {
        $this->arResult['COURSES'] = $this->coursesInfo;
    }

    public function executeComponent(): void
    {
        $this->checkModules();

        $this->getDateNow();

        $this->getScheduleElements();
        $this->scheduleToArray();

        $this->getCoursesInfo();
        $this->coursesInfoToArray();

        $this->makeReviewsResult();

        $this->includeComponentTemplate();
    }
}
