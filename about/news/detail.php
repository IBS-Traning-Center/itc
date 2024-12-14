<?php 

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); 

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
            <h1><?= $APPLICATION->ShowTitle(false); ?></h1>
        </div>
    </div>
</div>
<div class="container">
    <?php $APPLICATION->IncludeComponent(
    	"bitrix:news.detail", 
    	"en_single_pressrelease", 
    	array(
    		"IBLOCK_TYPE" => "edu",
    		"IBLOCK_ID" => "23",
    		"ELEMENT_ID" => "",
    		"ELEMENT_CODE" => $_REQUEST["ID"],
    		"CHECK_DATES" => "Y",
    		"FIELD_CODE" => array(
    			0 => "PREVIEW_TEXT",
    			1 => "DETAIL_TEXT",
    			2 => "SHOW_COUNTER",
    			3 => "",
    		),
    		"PROPERTY_CODE" => array(
    			0 => "",
    			1 => "publication",
    			2 => "",
    		),
    		"IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#",
    		"AJAX_MODE" => "N",
    		"AJAX_OPTION_SHADOW" => "Y",
    		"AJAX_OPTION_JUMP" => "N",
    		"AJAX_OPTION_STYLE" => "Y",
    		"AJAX_OPTION_HISTORY" => "N",
    		"CACHE_TYPE" => "A",
    		"CACHE_TIME" => "360000",
    		"META_KEYWORDS" => "-",
    		"META_DESCRIPTION" => "-",
    		"DISPLAY_PANEL" => "N",
    		"SET_TITLE" => "Y",
    		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
    		"ADD_SECTIONS_CHAIN" => "Y",
    		"ACTIVE_DATE_FORMAT" => "j F Y",
    		"USE_PERMISSIONS" => "N",
    		"DISPLAY_TOP_PAGER" => "N",
    		"DISPLAY_BOTTOM_PAGER" => "N",
    		"PAGER_TITLE" => "Страница",
    		"PAGER_TEMPLATE" => "",
    		"DISPLAY_DATE" => "Y",
    		"DISPLAY_NAME" => "N",
    		"DISPLAY_PICTURE" => "N",
    		"DISPLAY_PREVIEW_TEXT" => "N",
    		"AJAX_OPTION_ADDITIONAL" => "",
    		"COMPONENT_TEMPLATE" => "en_single_pressrelease",
    		"DETAIL_URL" => "",
    		"CACHE_GROUPS" => "Y",
    		"SET_CANONICAL_URL" => "N",
    		"SET_BROWSER_TITLE" => "Y",
    		"BROWSER_TITLE" => "NAME",
    		"SET_META_KEYWORDS" => "Y",
    		"SET_META_DESCRIPTION" => "Y",
    		"SET_LAST_MODIFIED" => "N",
    		"ADD_ELEMENT_CHAIN" => "Y",
    		"PAGER_SHOW_ALL" => "N",
    		"PAGER_BASE_LINK_ENABLE" => "N",
    		"SET_STATUS_404" => "N",
    		"SHOW_404" => "N",
    		"MESSAGE_404" => "",
    		"STRICT_SECTION_CHECK" => "N"
    	),
    	false
    ); ?>
</div>
<div class="grey-page-block">
<?php $GLOBALS['arMainPageNewsFilter'] = ['!PROPERTY_NOT_SHOW_HOME_PAGE_VALUE' => 'Да']; ?>
<?php $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "news.detail.page.list",
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
<?php $APPLICATION->IncludeComponent(
	"addamant:telegram.subscribe", 
	".default", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"SUBSCRIBE_TITLE" => "",
		"SUBSCRIBE_LINK" => "https://t.me/IBS_Training_Center",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
</div>
<script>
   /* $(document).ready(function () {
        $("#ya_share").one("click", function () {
            pageTracker._trackEvent('SocialBlock', 'News', 'All');
        });
        $(".b-share-icon_yaru").click(function () {
            pageTracker._trackEvent('SocialBlock', 'News', 'Ya.ru');
        });
        $(".b-share-icon_vkontakte").click(function () {
            pageTracker._trackEvent('SocialBlock', 'News', 'Vkontakte');
        });
        $(".b-share-icon_facebook").click(function () {
            pageTracker._trackEvent('SocialBlock', 'News', 'Facebook');
        });
        $(".b-share-icon_twitter").click(function () {
            pageTracker._trackEvent('SocialBlock', 'News', 'Twitter');
        });
        $(".b-share-icon_odnoklassniki").click(function () {
            pageTracker._trackEvent('SocialBlock', 'News', 'Odnoklassniki');
        });
        $(".b-share-icon_lj").click(function () {
            pageTracker._trackEvent('SocialBlock', 'News', 'LifeJournal');
        });
        $(".b-share-icon_moikrug").click(function () {
            pageTracker._trackEvent('SocialBlock', 'News', 'MoiKrug');
        });
        $(".b-share-icon_evernote").click(function () {
            pageTracker._trackEvent('SocialBlock', 'News', 'Evernote');
        });
        $(".b-share-icon_greader").click(function () {
            pageTracker._trackEvent('SocialBlock', 'News', 'Greader');
        });

    });

    $('body').on('click', '.registration-link', function () {
        if (localStorage.getItem('webform_done') === null) {
            $('.form-wrapper').fadeIn();
            localStorage.setItem('webform_done', 'true');
        }
        return false;
    });

    $('body').on('click', '.fa', function () {
        $('.form-wrapper').fadeOut();
        $('.mask').fadeOut();

        return false;
    });*/
</script>
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");