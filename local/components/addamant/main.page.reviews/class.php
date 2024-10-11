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
use \Bitrix\Iblock\Elements\ElementCompanyReviewsTable;
use \Bitrix\Iblock\Elements\ElementReviewsTable;
use Bitrix\Main\Entity\Query;


Loc::loadMessages(__FILE__);

class MainPageReviewsComponent extends CBitrixComponent
{
    private $studentsReviewsIBResult;
    private $companyReviewsIBResult;
    private $needleCourseId;

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

    private function checkParams()
    {
        if ($this->arParams['NEEDLE_COURSE_ID']) {
            $this->needleCourseId = $this->arParams['NEEDLE_COURSE_ID'];
        }
    }

    public function getCompanyIblock()
    {
        if ($this->needleCourseId) {
            return false;
        }

        return $this->companyReviewsIBResult = ElementCompanyReviewsTable::getList([
            'select' => [
                'ID',
                'NAME',
                'PREVIEW_PICTURE',
                'PREVIEW_TEXT',
                'REVIEW_USER_NAME',
                'VIDEO_MESS.FILE',
                'SHOW_ON_MAIN_PAGE.ITEM'
            ],
            'filter' => [
                'ACTIVE' => 'Y'
            ]
        ])->fetchCollection();
    }

    public function getStudentsIblock()
    {
        $query = new Query(ElementReviewsTable::getEntity());
        $query->setSelect([
            'ID',
            'NAME',
            'PREVIEW_PICTURE',
            'USER_NAME',
            'USER_SURNAME',
            'USER_REVIEW',
            'VIDEO_MESS.FILE',
            'SHOW_ON_MAIN_PAGE.ITEM'
        ])
        ->setFilter([
            '=ACTIVE' => 'Y'
        ]);

        if ($this->needleCourseId) {
            $query->addFilter('course.VALUE', $this->needleCourseId);
        }

        $result = $query->exec();
        return $this->studentsReviewsIBResult = $result->fetchCollection();
    }

    private function companyReviewsToArray()
    {
        if (!$this->companyReviewsIBResult) {
            return false;
        }

        $reviews = [];
        foreach ($this->companyReviewsIBResult as $key => $review) {
            $newReview = [];

            if ($review->getId()) {
                $newReview['ID'] = $review->getId();
            }

            if ($review->getName()) {
                $newReview['NAME'] = $review->getName();
            }

            if ($review->getPreviewPicture()) {
                $newReview['PREVIEW_PICTURE'] = $review->getPreviewPicture();
            }

            if ($review->getPreviewText()) {
                $newReview['PREVIEW_TEXT'] = $review->getPreviewText();
            }

            if ($review->getReviewUserName() && $review->getReviewUserName()->getValue()) {
                $newReview['REVIEW_USER_NAME'] = $review->getReviewUserName()->getValue();
            }

            if ($review->getVideoMess() && $review->getVideoMess()->getFile()) {
                $newReview['VIDEO'] = '/upload/' . $review->getVideoMess()->getFile()->getSubdir() . '/' . $review->getVideoMess()->getFile()->getFileName();
            }

            if ($review->getShowOnMainPage() && $review->getShowOnMainPage()->getItem() && $review->getShowOnMainPage()->getItem()->getXmlId()) {
                $newReview['SHOW_ON_MAIN_PAGE'] = $review->getShowOnMainPage()->getItem()->getXmlId();
            }

            if ($newReview['SHOW_ON_MAIN_PAGE'] === 'Y') {
                $reviews[$key] = $newReview;
            }
        }

        $this->companyReviewsIBResult = $reviews;
    }

    private function studentsReviewsToArray()
    {
        if (!$this->studentsReviewsIBResult) {
            return false;
        }

        $reviews = [];
        foreach ($this->studentsReviewsIBResult as $key => $review) {
            $newReview = [];

            if ($review->getId()) {
                $newReview['ID'] = $review->getId();
            }

            if ($review->getName()) {
                $newReview['NAME'] = $review->getName();
            }

            if ($review->getPreviewPicture()) {
                $newReview['PREVIEW_PICTURE'] = $review->getPreviewPicture();
            }

            if ($review->getUserName() && $review->getUserName()->getValue()) {
                $newReview['USER_NAME'] = $review->getUserName()->getValue();
            }

            if ($review->getUserSurname() && $review->getUserSurname()->getValue()) {
                $newReview['USER_SURNAME'] = $review->getUserSurname()->getValue();
            }

            if ($review->getUserReview() && $review->getUserReview()->getValue()) {
                $newReview['USER_REVIEW'] = $review->getUserReview()->getValue();
            }

            if ($review->getVideoMess() && $review->getVideoMess()->getFile()) {
                $newReview['VIDEO'] = '/upload/' . $review->getVideoMess()->getFile()->getSubdir() . '/' . $review->getVideoMess()->getFile()->getFileName();
            }

            if ($review->getShowOnMainPage() && $review->getShowOnMainPage()->getItem() && $review->getShowOnMainPage()->getItem()->getXmlId()) {
                $newReview['SHOW_ON_MAIN_PAGE'] = $review->getShowOnMainPage()->getItem()->getXmlId();
            }

            if ($this->needleCourseId) {
                $reviews[$key] = $newReview;
            } elseif ($newReview['SHOW_ON_MAIN_PAGE'] === 'Y') {
                $reviews[$key] = $newReview;
            }
        }

        $this->studentsReviewsIBResult = $reviews;
    }

    /* Записываем результат в переменную */
    public function makeReviewsResult()
    {
        $this->arResult['COMPANY_REVIEWS'] = $this->companyReviewsIBResult;
        $this->arResult['STUDENTS_REVIEWS'] = $this->studentsReviewsIBResult;

        $this->arResult['BLOCK_TITLE'] = $this->arParams['BLOCK_TITLE'] ?: '';
        $this->arResult['KVAL_LINK'] = $this->arParams['KVAL_LINK'] ?: '';
    }

    public function executeComponent(): void
    {
        $this->checkModules();
        $this->checkParams();

        $this->getCompanyIblock();
        $this->getStudentsIblock();

        $this->companyReviewsToArray();
        $this->studentsReviewsToArray();

        $this->makeReviewsResult();

        $this->includeComponentTemplate();
    }
}
