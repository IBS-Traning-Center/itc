<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

use Local\Util\Functions;
$APPLICATION->SetPageProperty("SHOW_BOTTOM_MAP", "N");
$APPLICATION->SetPageProperty("title", "Корпоративное обучение");
$APPLICATION->SetPageProperty("keywords", "корпоративное обучение, корпоративный тренинг, обучение программированию, обучение тестированию, обучение проектированию");
$APPLICATION->SetPageProperty("description", "Разрабатываем обучающие программы для компаний любого уровня и масштаба");
$APPLICATION->SetTitle("Корпоративное обучение: аналитики, разработчики, менеджеры проектов, тестировщики");
?>
<div class="corporate-page">
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
            <p><?= $APPLICATION->GetPageProperty('description') ?></p>
        </div>
        <div class="buttons-block-banner">
            <a class="btn-main size-l" href="#mainFeedbackFormBlock">
                <span class="f-24">Получить консультацию</span>
            </a>
        </div>
    </div>
</div>
<div class="container">
    <div class="text-page-block about-learn">
        <div class="text-block-left">
            <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/corporate/learn_left_text.php', [], ['MODE' => 'html']);?>
        </div>
        <div class="text-block-right">
            <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/corporate/learn_right_text.php', [], ['MODE' => 'html']);?>
        </div>
    </div>
    <div class="text-page-block why-block">
        <div class="text-block-left">
            <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/corporate/why_left_text.php', [], ['MODE' => 'html']);?>
        </div>
        <div class="text-block-right">
            <?php $APPLICATION->IncludeFile(
                SITE_DIR . 'include/corporate/why_right_text.php', 
                [
                    'custom' => Functions::buildSVG('custom', SITE_TEMPLATE_PATH. '/assets/images/icons'),
                    'cost' => Functions::buildSVG('cost', SITE_TEMPLATE_PATH. '/assets/images/icons'),
                    'operat' => Functions::buildSVG('operat', SITE_TEMPLATE_PATH. '/assets/images/icons'),
                    'problem' => Functions::buildSVG('problem', SITE_TEMPLATE_PATH. '/assets/images/icons')
                ], 
                ['MODE' => 'html']);?>
        </div>
    </div>
</div>
<div class="grey-page-block offset-block">
    <div class="container">
        <div class="text-page-block full-width">
            <div class="text-block-left">
                <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/corporate/offset_left_text.php', [], ['MODE' => 'html']);?>
            </div>
        </div> 
    </div>
</div>
<div class="container">
    <div class="text-page-block you-need-block">
        <div class="text-block-left">
            <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/corporate/need_left_text.php', [], ['MODE' => 'html']);?>
        </div>
        <div class="text-block-right">
            <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/corporate/need_right_text.php', [], ['MODE' => 'html']);?>
        </div>
    </div>
</div>
<div class="blue-page-block">
    <div class="container">
        <div class="text-page-block suitable-block">
            <div class="text-block-left">
                <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/corporate/suitable_left_text.php', [], ['MODE' => 'html']);?>
            </div>
            <div class="text-block-right">
                <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/corporate/suitable_right_text.php', [], ['MODE' => 'html']);?>
            </div>
        </div>
    </div>
</div>
<div class="blue-page-block stage-block-wrap">
    <div class="container">
        <div class="text-page-block stage-block">
            <div class="text-block-left">
                <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/corporate/stage_left_text.php', [], ['MODE' => 'html']);?>
            </div>
            <div class="text-block-right">
                <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/corporate/stage_right_text.php', [], ['MODE' => 'html']);?>
            </div>
        </div>
    </div>
</div>
<div class="container text-page-block">
    <div class="questions-block-wrap">
        <?php $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "question.list",
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
            "IBLOCK_ID" => "186",
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
            "STRICT_SECTION_CHECK" => "N",
        )
    );?>
    </div>
</div>
    <?php $APPLICATION->IncludeComponent(
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
            "CACHE_TYPE" => "N",
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
            "STRICT_SECTION_CHECK" => "N",
            "SPECIAL_TITLE" => "Истории успеха",
            "SPECIAL_DESCRIPTON" => "Компании, доверившие обучение сотрудников нам:"
        )
    );?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
