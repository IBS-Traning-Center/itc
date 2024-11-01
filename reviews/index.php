<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("SHOW_BOTTOM_MAP", "N");
$APPLICATION->SetPageProperty("title", "Отзывы");
$APPLICATION->SetPageProperty("keywords", "корпоративное обучение, корпоративный тренинг, обучение программированию, обучение тестированию, обучение проектированию");
$APPLICATION->SetPageProperty("description", "Разрабатываем обучающие программы для компаний любого уровня и масштаба");
$APPLICATION->SetTitle("Отзывы");

use Local\Util\IblockHelper;

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$reviewTab = $request->get('reviews');

$iblockId = null;
if($reviewTab == 'all' || $reviewTab == NULL){
    $iblockId[] = IblockHelper::getIdByCode('reviews');
    $iblockId[] = IblockHelper::getIdByCode('companyreviews');
}elseif($reviewTab == 'company'){
    $iblockId[] = IblockHelper::getIdByCode('companyreviews');
}else{
    $iblockId[] = IblockHelper::getIdByCode('reviews');
}

$GLOBALS['arrReviewsID'] = [
    'IBLOCK_ID' => $iblockId,
    [
        'LOGIC' => 'OR',
        ['!PROPERTY_VIDEO_MESS' => false],
        ['!PREVIEW_TEXT' => false],
        ['!PROPERTY_USER_REVIEW' => false]
    ]
];
?>
<div class="top-page-banner" style="background-color: <?= $APPLICATION->GetPageProperty('BACKGROUND_COLOR_BANNER') ?>">
    <div class="container">
        <div class="banner-content">
            <?php $APPLICATION->IncludeComponent(
                    'bitrix:breadcrumb',
                    'bread',
                    [
                        'START_FROM' => '0',
                        'PATH' => '',
                        'SITE_ID' => 's1',
                    ],
                    false
            ); ?>
            <h1><?= $APPLICATION->GetPageProperty('title') ?></h1>
            <div class="reviews-tabs-block">
				<div class="tabs">
					<a class="reviews-tab f-16<?= ($reviewTab == 'all' || $reviewTab == NULL)? ' active':''?>" href="?reviews=all" ><span>Все</span></a>
					<a class="reviews-tab f-16<?= ($reviewTab == 'company')? ' active':''?>" href="?reviews=company" class="reviews-tab f-16"><span>Отзывы компаний</span></a>
					<a class="reviews-tab f-16<?= ($reviewTab == 'student')? ' active':''?>" href="?reviews=student" class="reviews-tab f-16"><span>Отзывы учеников</span></a>
				</div>
			</div>
        </div>
    </div>
</div>
<div class="container">
	<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"reviews", 
	array(
		"ACTIVE_DATE_FORMAT" => "",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrReviewsID",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "",
		"IBLOCK_TYPE" => "edu",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "16",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "main.pagenavigation",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "reviews"
	),
	false
);?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>