<?php

use \Bitrix\Iblock\Elements\ElementCompanyReviewsTable;
use \Bitrix\Iblock\Elements\ElementReviewsTable;
use Local\Util\IblockHelper;

$companyReviewsIblock = IblockHelper::getIdByCode('companyreviews');
$studentReviewsIblock = IblockHelper::getIdByCode('reviews');

foreach($arResult["ITEMS"] as $key => &$arItem){
	if($arItem['IBLOCK_ID'] == $companyReviewsIblock){
		$element = ElementCompanyReviewsTable::getByPrimary($arItem['ID'], [
			'select' => ['ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'PREVIEW_TEXT', 'DETAIL_TEXT', 'REVIEW_USER_NAME_' => 'REVIEW_USER_NAME', 'VIDEO_MESS_' => 'VIDEO_MESS.FILE'],
		])->fetch();
		
		$elementVideo = '';
		if($element['VIDEO_MESS_ID'] !== NULL){
			$elementVideo = '/upload/' . $element['VIDEO_MESS_SUBDIR'] .'/'. $element['VIDEO_MESS_FILE_NAME'];
		}
		
		$element['VIDEO'] = $elementVideo;
		$arItem = $element;
		
	}else{
		$element = ElementReviewsTable::getByPrimary($arItem['ID'], [
			'select' => ['ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'USER_NAME_' => 'USER_NAME', 'USER_SURNAME_' => 'USER_SURNAME', 'USER_REVIEW_' => 'USER_REVIEW', 'VIDEO_MESS_' => 'VIDEO_MESS.FILE'],
		])->fetch();
		
		$elementVideo = '';
		if($element['VIDEO_MESS_ID'] !== NULL){
			$elementVideo = '/upload/' . $element['VIDEO_MESS_SUBDIR'] .'/'. $element['VIDEO_MESS_FILE_NAME'];
		}

		$element['VIDEO'] = $elementVideo;
		$arItem = $element;
	}
	
}/*
echo '<pre>';
var_export($arResult["ITEMS"]);
echo '</pre>';
/*array (
    'ID' => '26488',
    'NAME' => 'Медиалогия',
    'PREVIEW_PICTURE' => '15615',
    'PREVIEW_TEXT' => 'Роль тренера в данном обучении очень важна: ему удалось воссоздать реальную рабочую атмосферу, стрессовую ситуацию и конфликт в команде, а участникам ставились задачи справиться с такими ситуациями и они делали это успешно.',
    'REVIEW_USER_NAME_ID' => '207544',
    'REVIEW_USER_NAME_IBLOCK_ELEMENT_ID' => '26488',
    'REVIEW_USER_NAME_IBLOCK_PROPERTY_ID' => '1334',
    'REVIEW_USER_NAME_VALUE' => 'Евангелина Самохина',
    'VIDEO_MESS_ID' => '15616',
    'VIDEO_MESS_TIMESTAMP_X' => 
    \Bitrix\Main\Type\DateTime::__set_state(array(
       'value' => 
      \DateTime::__set_state(array(
         'date' => '2024-08-15 06:24:43.000000',
         'timezone_type' => 3,
         'timezone' => 'Europe/Moscow',
      )),
       'userTimeEnabled' => true,
    )),
    'VIDEO_MESS_MODULE_ID' => 'iblock',
    'VIDEO_MESS_HEIGHT' => '0',
    'VIDEO_MESS_WIDTH' => '0',
    'VIDEO_MESS_FILE_SIZE' => '2395431',
    'VIDEO_MESS_CONTENT_TYPE' => 'video/mp4',
    'VIDEO_MESS_SUBDIR' => 'iblock/494/zousw07ki2i86gyuxep1xtvjwchjx8je',
    'VIDEO_MESS_FILE_NAME' => 'istockphoto-1324777173-640_adpp_is.mp4',
    'VIDEO_MESS_ORIGINAL_NAME' => 'istockphoto-1324777173-640_adpp_is.mp4',
    'VIDEO_MESS_DESCRIPTION' => '',
    'VIDEO_MESS_HANDLER_ID' => NULL,
    'VIDEO_MESS_EXTERNAL_ID' => '98bd722ae82b5037f68bc84404c6c952',
  ),*/
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
