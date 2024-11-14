<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

global $USER, $APPLICATION;
$APPLICATION->SetPageProperty("title", "Обучение по разработке ПО | IBS Training Center");
$APPLICATION->SetPageProperty("keywords", "курсы для программистов,  учебный центр IBS, уц ibs, дистанционное обучение, корпоративное обучение");
$APPLICATION->SetPageProperty("description", "Обучение для программистов, аналитиков, менеджеров проектов: тренинги, курсы, бесплатные семинары и вебинары, конференции");
$APPLICATION->SetTitle("IBS Training Center: Курсы и тренинги для программистов, аналитиков, менеджеров проектов, тестировщиков. Разработка ПО, обучение, учебный центр");

?><div class="container top-main-page-block">
	<h4 class="left-text"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/main_page/top_left_text.php', [], ['MODE' => 'html', 'NAME' => 'Главная страница. Верхний текст.']);?></h4>
	<div class="right-text-block">
		<h4 class="right-text"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/main_page/top_right_text.php', [], ['MODE' => 'html', 'NAME' => 'Главная страница. Верхний текст.']);?></h4>
        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/main_page/right_btn.php', [], ['MODE' => 'html', 'NAME' => 'Главная страница. Правая кнопка.']);?>
    </div>
</div>
 <?$APPLICATION->IncludeComponent(
	"addamant:main.page.banner",
	".default",
	Array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CATALOG_LINK_TITLE_MAIN_PAGE_BANNER" => "/catalog/",
		"IBLOCKS_IDS_TITLE_MAIN_PAGE_BANNER" => "49, 94"
	)
);?>
<div class="container">
	<h1 class="main-page-heading"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/main_page/heading.php', [], ['MODE' => 'html', 'NAME' => 'Главная страница. Заголовок.']);?></h1>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"best.workers.main.page",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
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
		"COMPONENT_TEMPLATE" => "best.workers.main.page",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "173",
		"IBLOCK_TYPE" => "edu_const",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "4",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "sotrydniki_krytie",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"LINK",1=>"ELEM_MONEY_RETURN",2=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ID",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"our.clients",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
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
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("",""),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "63",
		"IBLOCK_TYPE" => "edu",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "500",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("",""),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
<?$APPLICATION->IncludeComponent(
	"addamant:main.page.reviews",
	".default",
	Array(
		"BLOCK_TITLE" => "Чувствуете, что застряли в своей зарплате или роли?",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"KVAL_LINK" => "#"
	)
);?>
<?php $GLOBALS['arMainPageNewsFilter'] = ['!PROPERTY_NOT_SHOW_HOME_PAGE_VALUE' => 'Да']; ?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"main.page.news.list",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
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
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("",""),
		"FILTER_NAME" => "arMainPageNewsFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "23",
		"IBLOCK_TYPE" => "edu",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("news_type","action","countdown_time","FORUM_MESSAGE_CNT","NOT_SHOW_HOME_PAGE","reg_link","NEWS_TAGS","FORUM_TOPIC_ID","type","REDIRECT_URL","SHOW_ON_MAIN_PAGE","TEXT_FOR_MAIN_PAGE",""),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
<?$APPLICATION->IncludeComponent(
	"addamant:telegram.subscribe", 
	".default", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"SUBSCRIBE_LINK" => "https://t.me/IBS_Training_Center",
		"SUBSCRIBE_TITLE" => "",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
