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
                'startdate',
                'enddate',
                'schedule_price',
                'course_sale'
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                '>startdate.VALUE' => $this->dateNow
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
            $courseSale = null;
            $startDate = null;
            $endDate = null;

            if ($review->getCourseSale() && $review->getCourseSale()->getValue()) {
                $courseSale = $review->getCourseSale()->getValue();
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

                if ($review->getStartdate() && $review->getStartdate()->getValue()) {
                    $value = $review->getStartdate()->getValue();
                    $startDate = date("d.m.Y", strtotime($value));
                }

                if ($review->getEnddate() && $review->getEnddate()->getValue()) {
                    $value = $review->getEnddate()->getValue();
                    $endDate = date("d.m.Y", strtotime($value));
                }

                if (
                    !is_null($courseSale) &&
                    !is_null($coursePrice)
                ) {
                    $courseSale = intval($courseSale);
                    $elemPrice = $coursePrice * (100 - $courseSale) / 100;
                    $this->newCoursesPrice[$review->getScheduleCourse()->getValue()] = [
                        'NEW_PRICE' => $elemPrice,
                        'COURSE_SALE' => $courseSale,
                        'START_DATE' => $startDate,
                        'END_DATE' => $endDate
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
                $course['COURSE_SALE'] = $this->newCoursesPrice[$item->getId()] ? $this->newCoursesPrice[$item->getId()]['COURSE_SALE'] : '';
                $course['START_DATE'] = $this->newCoursesPrice[$item->getId()] ? $this->newCoursesPrice[$item->getId()]['START_DATE'] : '';
                $course['END_DATE'] = $this->newCoursesPrice[$item->getId()] ? $this->newCoursesPrice[$item->getId()]['END_DATE'] : '';
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

            if ($course['COURSE_SALE']) {
                $course['DISCOUNT_PERCENT'] = $course['COURSE_SALE'];
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
