<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;
use Local\Util\Functions;

Loc::loadMessages(__FILE__);

/** @var $arParams */
/** @var $arResult */
/** @var $templateFolder */

$this->setFrameMode(false);

$defaultImage = $templateFolder . '/images/default_img.png';

?>

<div class="main-page-banner-block" style="background-image: url(<?= (!empty($arResult['ITEMS']) && $arResult['ITEMS'][0]['IMAGE']) ? $arResult['ITEMS'][0]['IMAGE'] : $defaultImage ?>)">
    <div class="container">
        <div class="main-page-banner-menu">
            <?php if (!empty($arResult['ITEMS'])) : ?>
                <?php foreach ($arResult['ITEMS'] as $key => $item) : ?>
                    <a href="<?= $item['URL'] ?>" class="main-page-banner-menu_item <?= ($key == 0) ? 'active' : '' ?>" data-image="<?= $item['IMAGE'] ?: $defaultImage ?>">
                        <span class="main-page-banner-menu_item-text">
                            <span class="mobile-number f-16"><?= ($key + 1 < 10) ? '0' . $key + 1 : $key + 1 ?></span>
                            <span class="main-name"><?= $item['NAME'] ?></span>
                        </span>
                        <span class="main-page-banner-menu_item-icon"><?= Functions::buildSVG('menu_icon', $templateFolder . '/images') ?></span>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
            <a href="<?= ($arResult['CATALOG_LINK']) ?: '/training/katalog_kursov/' ?>" class="main-page-banner-menu_item <?= (empty($arResult['ITEMS'])) ? 'active' : '' ?>" data-image="<?= $defaultImage ?>">
                <span class="main-page-banner-menu_item-text">
                    <span class="mobile-number f-16"><?= (count($arResult['ITEMS']) + 1 < 10) ? '0' . count($arResult['ITEMS']) + 1 : count($arResult['ITEMS']) + 1 ?></span>
                    <span class="main-name"><?= Loc::getMessage('ALL_COURSES_TEXT') ?></span>
                </span>
                <span class="main-page-banner-menu_item-icon"><?= Functions::buildSVG('menu_icon', $templateFolder . '/images') ?></span>
            </a>
        </div>
    </div>
    <div class="mobile-middle-btn container">
        <a href="/training/katalog_kursov/" class="btn-main"> <span class="f-16">Начать учиться бесплатно</span> </a>
    </div>
    <?php  $GLOBALS['arMainPageNewsFilter'] = ['PROPERTY_SHOW_ON_MAIN_PAGE_VALUE' => 'Да']; ?>
    <?php $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "main.page.news",
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
            "INCLUDE_SUBSECTIONS" => "Y",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "1",
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
            "PROPERTY_CODE" => array('TEXT_FOR_MAIN_PAGE'),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "SORT",
            "SORT_BY2" => "ID",
            "SORT_ORDER1" => "ASC",
            "SORT_ORDER2" => "DESC",
            "STRICT_SECTION_CHECK" => "N"
        )
    );?>
</div>
