<?php

use \Bitrix\Iblock\Elements\ElementCompanyReviewsTable;
use \Bitrix\Iblock\Elements\ElementReviewsTable;
use Bitrix\Main\Entity\Query;
use Local\Util\IblockHelper;

$companyReviewsIblock = IblockHelper::getIdByCode('companyreviews');
$studentReviewsIblock = IblockHelper::getIdByCode('reviews');

foreach($arResult["ITEMS"] as $key => &$arItem){
	if($arItem['IBLOCK_ID'] == $companyReviewsIblock){
		$element = ElementCompanyReviewsTable::getByPrimary($arItem['ID'], [
			'select' => ['ID', 'NAME', 'PREVIEW_PICTURE', 'PREVIEW_TEXT', 'REVIEW_USER_NAME_' => 'REVIEW_USER_NAME', 'VIDEO_MESS_' => 'VIDEO_MESS.FILE'],
		])->fetch();
		
		$arItem = $element;
	}else{
		$element = ElementReviewsTable::getByPrimary($arItem['ID'], [
			'select' => ['ID', 'NAME', 'PREVIEW_PICTURE', 'PREVIEW_TEXT', 'USER_NAME_' => 'USER_NAME', 'USER_SURNAME_' => 'USER_SURNAME', 'USER_REVIEW_' => 'USER_REVIEW', 'VIDEO_MESS_' => 'VIDEO_MESS.FILE'],
		])->fetch();
		
		$arItem = $element;
	}
	
}
var_export($arResult["ITEMS"]);

//var_export($arResult);
/*$companyReviewsIBResult = ElementCompanyReviewsTable::getList([
    'select' => [
        'ID',
        'IBLOCK_ID',
		'NAME',
        'PREVIEW_PICTURE',
        'PREVIEW_TEXT',
        'REVIEW_USER_NAME',
        'VIDEO_MESS.FILE'
    ],
    'filter' => [
        'ACTIVE' => 'Y'
    ]
])->fetchCollection();

foreach ($companyReviewsIBResult as $key => $review) {
    if ($review->getId()) {
        $arResult["ITEMS"][]['ID'] = $review->getId();  
    }
    if ($review->getIblockId()) {
        $arResult["ITEMS"][]['IBLOCK_ID'] = $review->getIblockId();  
    }
	if ($review->getName()) {
		$arResult["ITEMS"][]['NAME'] = $review->getName();
	}

	if ($review->getPreviewPicture()) {
		$arResult["ITEMS"][]['PREVIEW_PICTURE'] = $review->getPreviewPicture();
	}

	if ($review->getPreviewText()) {
		$arResult["ITEMS"][]['PREVIEW_TEXT'] = $review->getPreviewText();
	}

	if ($review->getReviewUserName() && $review->getReviewUserName()->getValue()) {
		$arResult["ITEMS"][]['REVIEW_USER_NAME'] = $review->getReviewUserName()->getValue();
	}

	if ($review->getVideoMess() && $review->getVideoMess()->getFile()) {
		$arResult["ITEMS"][]['VIDEO'] = '/upload/' . $review->getVideoMess()->getFile()->getSubdir() . '/' . $review->getVideoMess()->getFile()->getFileName();
	}
}


$reviewsIBResult = ElementReviewsTable::getList([
    'select' => [
        'ID',
		'NAME',
        'PREVIEW_PICTURE',
        'USER_NAME',
        'USER_SURNAME',
        'USER_REVIEW',
        'VIDEO_MESS.FILE'
    ],
    'filter' => [
        'ACTIVE' => 'Y'
    ]
])->fetchCollection();

foreach ($this->studentsReviewsIBResult as $key => $review) {
	$newReview = [];

	if ($review->getId()) {
		$arResult["ITEMS"][]['ID'] = $review->getId();
	}

	if ($review->getName()) {
		$arResult["ITEMS"][]['NAME'] = $review->getName();
	}

	if ($review->getPreviewPicture()) {
		$arResult["ITEMS"][]['PREVIEW_PICTURE'] = $review->getPreviewPicture();
	}

	if ($review->getUserName() && $review->getUserName()->getValue()) {
		$arResult["ITEMS"][]['USER_NAME'] = $review->getUserName()->getValue();
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
}
*/
