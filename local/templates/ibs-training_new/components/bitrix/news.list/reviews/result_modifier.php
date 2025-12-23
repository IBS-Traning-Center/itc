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
	
}