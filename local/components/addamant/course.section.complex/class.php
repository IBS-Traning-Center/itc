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
use \Bitrix\Iblock\Elements\ElementNewProgrammsTable;
use \Bitrix\Iblock\Elements\ElementTariffsTable;
use \Bitrix\Iblock\Elements\ElementCoursesTable;
use \Bitrix\Iblock\Elements\ElementScheduleTable;
use Local\Util\HighloadblockManager;

Loc::loadMessages(__FILE__);

class CourseSectionComplexComponent extends CBitrixComponent
{
    private $courseSectionComplexIBResult;
    private $courseInfo;
    private $dateNow;

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
        if (!$this->arParams['SECTION_CODE']) {
            throw new SystemException(
                Loc::getMessage('EMPTY_PARAMS')
            );
        }

        return true;
    }

    public function getSectionInfoCourseComplex()
    {
        return $this->courseSectionComplexIBResult = ElementNewProgrammsTable::getList([
            'select' => [
                'ID',
                'NAME',
                'COURSE',
                'COURSES',
                'PREVIEW_TEXT',
                'DETAIL_TEXT',
                'PRICE',
                'PRICE_UR',
                'COURSE_DURATION',
                'WHO_COURSE',
                'COURSE_FORMAT',
                'TARIFFS',
                'COMPLEXITY',
                'COURSE_LINKED',
                'LINK',
                'CODE',
                'DEMO_CODE',
                'DEMO_NAME',
                'COURSE_AWARD'
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                'IBLOCK_SECTION.CODE' => $this->arParams['SECTION_CODE']
            ]
        ])->fetchObject();
    }

    private function toArrayInfo()
    {
        if (!$this->courseSectionComplexIBResult) {
            return false;
        }

        $courseObject = $this->courseSectionComplexIBResult;
        $courseArray = [];

        if ($courseObject->getId()) {
            $courseArray['ID'] = $courseObject->getId();
        }

        if ($courseObject->getName()) {
            $courseArray['NAME'] = $courseObject->getName();
        }

        if ($courseObject->getCourse() && $courseObject->getCourse()->getValue()) {
            $courseArray['COURSE'] = $courseObject->getCourse()->getValue();
        }

        if ($courseObject->getCourses() && $courseObject->getCourses()->getAll()) {
            foreach ($courseObject->getCourses()->getAll() as $course) {
                $courseArray['COURSES'][] = $course->getValue();
            }
        }

        if ($courseObject->getCourseLinked() && $courseObject->getCourseLinked()->getAll()) {
            foreach ($courseObject->getCourseLinked()->getAll() as $course) {
                $courseArray['LINKED_COURSES'][] = $course->getValue();
            }
        }

        if ($courseObject->getPreviewText()) {
            $courseArray['SHORT_DESCRIPTION'] = $courseObject->getPreviewText();
        }

        if ($courseObject->getDetailText()) {
            $courseArray['DESCRIPTION'] = $courseObject->getDetailText();
        }

        if ($courseObject->getPrice() && $courseObject->getPrice()->getValue()) {
            $courseArray['PRICE'] = $courseObject->getPrice()->getValue();
        }

        if ($courseObject->getLink() && $courseObject->getLink()->getValue()) {
            $courseArray['LINK'] = $courseObject->getLink()->getValue();
        }

        if ($courseObject->getCode()) {
            $courseArray['CODE'] = $courseObject->getCode();
        }

        if ($courseObject->getPriceUr() && $courseObject->getPriceUr()->getValue()) {
            $courseArray['PRICE_UR'] = $courseObject->getPriceUr()->getValue();
        }

        if ($courseObject->getCourseDuration() && $courseObject->getCourseDuration()->getValue()) {
            $courseArray['DURATION'] = $courseObject->getCourseDuration()->getValue();
        }

        if ($courseObject->getComplexity() && $courseObject->getComplexity()->getAll()) {
            foreach ($courseObject->getComplexity()->getAll() as $value) {
                $courseArray['COMPLEXITY'][] = $value->getValue();
            }
        }

        if ($courseObject->getCourseAward() && $courseObject->getCourseAward()->getValue()) {
             $award = $courseObject->getCourseAward()->getValue();
             if ($award) {
                $courseArray['COURSE_AWARD'] = CFile::GetPath($award);
             }
        }

        if ($courseObject->getWhoCourse() && $courseObject->getWhoCourse()->getAll()) {
            $whoCourseCodes = [];
            foreach ($courseObject->getWhoCourse()->getAll() as $value) {
                $whoCourseCodes[] = $value->getValue();
            }

            if (!empty($whoCourseCodes)) {
                $whoCourseTable = new HighloadblockManager('WhoCourse');
                $whoCourseTable->prepareParamsQuery(['UF_NAME', 'UF_XML_ID', 'UF_PICTURE'], [], ['UF_XML_ID' => $whoCourseCodes]);
                $items = $whoCourseTable->getDataAll();

                if (!empty($items)) {
                    foreach ($items as &$item) {
                        if ($item['UF_PICTURE']) {
                            $item['UF_PICTURE'] = CFile::GetPath($item['UF_PICTURE']);
                        }
                    }

                    $data = [];
                    foreach ($whoCourseCodes as $code) {
                        foreach ($items as &$item) {
                            if ($item['UF_XML_ID'] == $code) {
                                $data[] = $item;
                                break;
                            }
                        }
                    }
                    $courseArray['WHO_COURSE'] = $data;
                }
            }
        }

        if ($courseObject->getCourseFormat() && $courseObject->getCourseFormat()->getValue()) {
            $courseFormat = $courseObject->getCourseFormat()->getValue();
            if (!empty($courseFormat)) {
                $hightTable = new HighloadblockManager('CourseFormats');
                $hightTable->prepareParamsQuery(['UF_NAME', 'UF_XML_ID', 'UF_PICTURE', 'UF_FULL_PICTURE'], [], ['UF_XML_ID' => $courseFormat]);
                $format = $hightTable->getData();
    
                if (!empty($format)) {
                    if ($format['UF_PICTURE']) {
                        $format['UF_PICTURE'] = CFile::GetPath($format['UF_PICTURE']);
                    }

                    if ($format['UF_FULL_PICTURE']) {
                        $format['UF_FULL_PICTURE'] = CFile::GetPath($format['UF_FULL_PICTURE']);
                    }
    
                    $courseArray['COURSE_FORMAT'] = $format;
                }
            }
        }

        if ($courseObject->getTariffs() && $courseObject->getTariffs()->getAll()) {
            foreach ($courseObject->getTariffs()->getAll() as $tariff) {
                $courseArray['TARIFFS'][] = $tariff->getValue();
            }
        }

        if ($courseObject->getDemoCode() && $courseObject->getDemoCode()->getValue()) {
            $courseArray['DEMO_CODE'] = $courseObject->getDemoCode()->getValue();
        }

        if ($courseObject->getDemoName() && $courseObject->getDemoName()->getValue()) {
            $courseArray['DEMO_NAME'] = $courseObject->getDemoName()->getValue();
        }

        $this->courseInfo = $courseArray;
    }

    private function getCourseComplexity()
    {
        if (empty($this->courseInfo['COMPLEXITY'])) {
            return false;
        }

        $propEnum = CIBlockPropertyEnum::GetList(
            [],
            [
                'IBLOCK_ID' => IBLOCK_ID_COMPLEX,
                'ID' => $this->courseInfo['COMPLEXITY']
            ]
        );

        $this->courseInfo['COMPLEXITY'] = [];

        while ($prop = $propEnum->GetNext()) {
            $this->courseInfo['COMPLEXITY'][] = $prop['VALUE'];
        }
    }

    private function getCourseTariffs()
    {
        if (empty($this->courseInfo['TARIFFS'])) {
            return false;
        }

        $tariffs = ElementTariffsTable::getList([
            'select' => [
                'PREVIEW_TEXT',
                'DETAIL_TEXT',
                'PRICE',
                'TIME_PRICE',
                'FOOTNOTE',
                'TYPE.ITEM'
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                'ID' => $this->courseInfo['TARIFFS']
            ]
        ])->fetchCollection();

        if ($tariffs) {
            $tariffsItems = [];
            foreach ($tariffs as $tariff) {
                $tariffItem = [];

                if ($tariff->getPreviewText()) {
                    $tariffItem['SHORT_DESCRIPTION'] = $tariff->getPreviewText();
                }

                if ($tariff->getDetailText()) {
                    $tariffItem['DESCRIPTION'] = $tariff->getDetailText();
                }

                if ($tariff->getPrice() && $tariff->getPrice()->getValue()) {
                    $tariffItem['PRICE'] = $tariff->getPrice()->getValue();
                }

                if ($tariff->getTimePrice() && $tariff->getTimePrice()->getValue()) {
                    $tariffItem['TIME_PRICE'] = $tariff->getTimePrice()->getValue();
                }

                if ($tariff->getFootnote() && $tariff->getFootnote()->getValue()) {
                    $tariffItem['FOOTNOTE'] = unserialize($tariff->getFootnote()->getValue());
                }

                if (
                    $tariff->getType() &&
                    $tariff->getType()->getItem() &&
                    $tariff->getType()->getItem()->getValue()
                ) {
                    $tariffItem['TYPE'] = $tariff->getType()->getItem()->getValue();
                }

                $tariffsItems[] = $tariffItem;
            }

            $this->courseInfo['TARIFFS'] = $tariffsItems;
        }
    }

    private function getCourseInfo()
    {
        if (empty($this->courseInfo['COURSE'])) {
            return false;
        }

        $course = ElementCoursesTable::getList([
            'select' => [
                'IS_NEW.ITEM',
                'IS_DEV',
                'MAGNET_CODE',
                'MAGNET_LEAD_NAME',
                'MAGNET_BUTTON_NAME',
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                'ID' => $this->courseInfo['COURSE'],
            ]
        ])->fetchObject();

        if ($course) {
            if ($course->getIsNew() && $course->getIsNew()->getItem() && $course->getIsNew()->getItem()->getXmlId()) {
                $this->courseInfo['IS_NEW'] = $course->getIsNew()->getItem()->getXmlId();
            }
            if ($course->getIsDev() && $course->getIsDev()->getValue()) {
                $this->courseInfo['IS_DEV'] = $course->getIsDev()->getValue();
            }
            if ($course->getMagnetCode() && $course->getMagnetCode()->getValue() && $course->getMagnetLeadName() && $course->getMagnetLeadName()->getValue() && $course->getMagnetButtonName() && $course->getMagnetButtonName()->getValue()) {
                $this->courseInfo['MAGNET_CODE'] = $course->getMagnetCode()->getValue();
                $this->courseInfo['MAGNET_LEAD_NAME'] = $course->getMagnetLeadName()->getValue();
                $this->courseInfo['MAGNET_BUTTON_NAME'] = $course->getMagnetButtonName()->getValue();
            }
        }
    }

    private function getCoursesInfo()
    {
        if (empty($this->courseInfo['COURSES'])) {
            return false;
        }

        $courses = ElementCoursesTable::getList([
            'select' => [
                'ID',
                'XML_ID',
                'course_code',
                'short_descr',
                'NAME',
                'COMPLEXITY.ITEM',
                'course_duration',
                'course_price',
                'ACTIVE'
            ],
            'filter' => [
                'ID' => $this->courseInfo['COURSES']
            ]
        ])->fetchCollection();

        if ($courses) {
            $coursesInfo = [];
            foreach ($courses as $course) {
                $courseInfo = [];

                if ($course->getId()) {
                    $courseInfo['ID'] = $course->getId();
                }

                if ($course->getName()) {
                    $courseInfo['NAME'] = $course->getName();
                }

                if ($course->getXmlId()) {
                    $courseInfo['XML_ID'] = $course->getXmlId();
                }

                if ($course->getCourseCode() && $course->getCourseCode()->getValue()) {
                    $courseInfo['CODE'] = $course->getCourseCode()->getValue();
                }

                if ($course->getShortDescr() && $course->getShortDescr()->getValue()) {
                    $courseInfo['DESCRIPTION'] = $course->getShortDescr()->getValue();
                }

                if ($course->getCourseDuration() && $course->getCourseDuration()->getValue()) {
                    $courseInfo['DURATION'] = $course->getCourseDuration()->getValue();
                }

                if ($course->getCoursePrice() && $course->getCoursePrice()->getValue()) {
                    $courseInfo['PRICE'] = $course->getCoursePrice()->getValue();
                }

                if (
                    $course->getComplexity() &&
                    $course->getComplexity()->getItem() &&
                    $course->getComplexity()->getItem()->getValue()
                ) {
                    $courseInfo['COMPLEXITY'] = $course->getComplexity()->getItem()->getValue();
                }

                if ($course->getActive()) {
                    $courseInfo['ACTIVE'] = $course->getActive();
                }

                $coursesInfo[] = $courseInfo;
            }

            $coursesSort = [];
            $items = $this->courseInfo['COURSES'];
            foreach ($items as $item) {
                foreach ($coursesInfo as $course) {
                    if ($item == $course['ID']) {
                        $coursesSort[] = $course;
                    }
                }
            }
            $this->courseInfo['COURSES'] = $coursesSort;
        }
    }

    private function getLinkedCoursesInfo()
    {
        if (empty($this->courseInfo['LINKED_COURSES'])) {
            return false;
        }

        $courses = ElementCoursesTable::getList([
            'select' => [
                'XML_ID',
                'course_code',
                'short_descr',
                'NAME',
                'COMPLEXITY.ITEM',
                'course_duration',
                'course_price',
                'PRICE_ON_REQUEST'
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                'ID' => $this->courseInfo['LINKED_COURSES']
            ]
        ])->fetchCollection();

        if ($courses) {
            $coursesInfo = [];
            foreach ($courses as $course) {
                $courseInfo = [];

                if ($course->getName()) {
                    $courseInfo['NAME'] = $course->getName();
                }

                if ($course->getXmlId()) {
                    $courseInfo['XML_ID'] = $course->getXmlId();
                }

                if ($course->getCourseCode() && $course->getCourseCode()->getValue()) {
                    $courseInfo['CODE'] = $course->getCourseCode()->getValue();
                }

                if ($course->getShortDescr() && $course->getShortDescr()->getValue()) {
                    $courseInfo['DESCRIPTION'] = $course->getShortDescr()->getValue();
                }

                if ($course->getCourseDuration() && $course->getCourseDuration()->getValue()) {
                    $courseInfo['DURATION'] = $course->getCourseDuration()->getValue();
                }

                if ($course->getCoursePrice() && $course->getCoursePrice()->getValue()) {
                    $courseInfo['PRICE'] = $course->getCoursePrice()->getValue();
                }

                if ($course->getPriceOnRequest() && $course->getPriceOnRequest()->getValue()) {
                    $courseInfo['PRICE_ON_REQUEST'] = $course->getPriceOnRequest()->getValue();
                }

                if (
                    $course->getComplexity() &&
                    $course->getComplexity()->getItem() &&
                    $course->getComplexity()->getItem()->getValue()
                ) {
                    $courseInfo['COMPLEXITY'] = $course->getComplexity()->getItem()->getValue();
                }

                $coursesInfo[] = $courseInfo;
            }

            usort($coursesInfo, function ($a, $b) {
                return $a['CODE'] <=> $b['CODE'];
            });

            $this->courseInfo['LINKED_COURSES'] = $coursesInfo;
        }
    }

    private function getDateNow()
    {
        return $this->dateNow = date('Y-m-d');
    }

    private function getSchedule()
    {
        if (!$this->courseInfo['COURSE']) {
            return false;
        }

        $schedule = ElementScheduleTable::getList([
            'select' => [
                'startdate',
                'course_sale',
                'sale_link',
                'sale_start_date',
                'sale_end_date'
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                'schedule_course.VALUE' => $this->courseInfo['COURSE'],
                '>startdate.VALUE' => $this->dateNow
            ]
        ])->fetchAll();

        if ($schedule) {
            $scheduleInfo = [];

            foreach ($schedule as $item) {
                $sched = [];

                if ($item['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_startdate_VALUE']) {
                    $sched['DATE_START'] = date('d.m.Y', strtotime($item['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_startdate_VALUE']));
                }

                if ($item['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_course_sale_VALUE']) {
                    $sched['SALE']['PERCENT'] = intval($item['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_course_sale_VALUE']);
                    $sched['SALE']['DATE'] = false;

                    if ($item['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_sale_start_date_VALUE'] && $item['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_sale_end_date_VALUE']) {
                        $saleStartDate = $item['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_sale_start_date_VALUE'];
                        $saleEndDate = $item['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_sale_end_date_VALUE'];
                        if ($saleStartDate && $saleEndDate) {
                            $today = date('Y-m-d');
                            if ((strtotime($today) >= strtotime($saleStartDate)) && (strtotime($today) <= strtotime($saleEndDate))) {
                                $sched['SALE']['DATE'] = true;
                            }
                        }
                    }

                    if ($item['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_sale_link_VALUE']) {
                        $sched['SALE']['LINK'] = $item['IBLOCK_ELEMENTS_ELEMENT_SCHEDULE_sale_link_VALUE'];
                    }
                }

                $scheduleInfo[] = $sched;
            }

            $this->courseInfo['SCHEDULE'] = $scheduleInfo;
        }
    }

    /* Записываем результат в переменную */
    public function makeReviewsResult()
    {
        $this->arResult = $this->courseInfo;
    }

    public function executeComponent(): void
    {
        $this->checkModules();
        $this->checkParams();

        $this->getSectionInfoCourseComplex();
        $this->toArrayInfo();

        $this->getCourseComplexity();
        $this->getCourseTariffs();
        $this->getCourseInfo();
        $this->getCoursesInfo();
        $this->getLinkedCoursesInfo();

        $this->getDateNow();
        $this->getSchedule();

        $this->makeReviewsResult();

        $this->includeComponentTemplate();
    }
}
