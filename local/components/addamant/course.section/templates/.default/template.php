<?php

use \Bitrix\Main\Localization\Loc;
use Local\Util\ComponentHelper;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

Loc::loadMessages(__FILE__);

/** @var array $arResult */
/** @var array $arParams */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

global $APPLICATION;

$APPLICATION->SetPageProperty('title', $arResult['SECTION_NAME']);
$APPLICATION->SetTitle($arResult['SECTION_NAME']);
$APPLICATION->AddChainItem($arResult['SECTION_NAME'], '');

$this->setFrameMode(false);

if (!empty($arResult['COURSES_IDS'])) : ?>
<div class="courses-section-main-block">
    <div class="top-page-banner section-page">
        <div class="container">
            <div class="banner-content">
                <?php
                $helper = new ComponentHelper($component);
                $helper->deferredCall('ShowNavChain');
                ?>
                <h1><?= $APPLICATION->GetTitle() ?></h1>
                <div class="open-filter-mobile-btn btn-main">
                    <span class="f-16"><?= Loc::getMessage('MOBILE_OPEN_FILTER_BTN_TEXT') ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="courses-section-block container">
        <div class="filter-course-block">
            <?php
                $GLOBALS['smartPreFilter'] = ['=ID' => $arResult['COURSES_IDS']];
                $GLOBALS['courseSectionFilter'] = ['=ID' => $arResult['COURSES_IDS']];

                $APPLICATION->IncludeComponent(
                "bitrix:catalog.smart.filter",
                "courses.filter",
                    Array(
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "CONVERT_CURRENCY" => "N",
                        "DISPLAY_ELEMENT_COUNT" => "Y",
                        "FILTER_NAME" => "courseSectionFilter",
                        "FILTER_VIEW_MODE" => "vertical",
                        "HIDE_NOT_AVAILABLE" => "N",
                        "IBLOCK_ID" => "6",
                        "IBLOCK_TYPE" => "edu",
                        "PAGER_PARAMS_NAME" => "arrPager",
                        "POPUP_POSITION" => "left",
                        "PREFILTER_NAME" => "smartPreFilter",
                        "PRICE_CODE" => array(),
                        "SAVE_IN_SESSION" => "N",
                        "SECTION_CODE" => "",
                        "SECTION_DESCRIPTION" => "-",
                        "SECTION_ID" => "",
                        "SECTION_TITLE" => "-",
                        "SEF_MODE" => "N",
                        "TEMPLATE_THEME" => "blue",
                        "XML_EXPORT" => "N"
                    )
                );
            ?>
        </div>
        <div class="content-course-block">
            <?php $APPLICATION->IncludeComponent(
                "addamant:course.with.discount",
                ".default",
                Array(
                    "CACHE_TIME" => "3600",
                    "CACHE_TYPE" => "N"
                ),
                $component
            );?>
            <?php
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "courses.section",
                Array(
                    "ACTION_VARIABLE" => "action",
                    "ADD_PICT_PROP" => "-",
                    "ADD_PROPERTIES_TO_BASKET" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "ADD_TO_BASKET_ACTION" => "ADD",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "BACKGROUND_IMAGE" => "-",
                    "BASKET_URL" => "/personal/basket.php",
                    "BROWSER_TITLE" => "-",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "COMPATIBLE_MODE" => "N",
                    "CONVERT_CURRENCY" => "N",
                    "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
                    "DETAIL_URL" => "",
                    "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "DISPLAY_COMPARE" => "N",
                    "DISPLAY_TOP_PAGER" => "N",
                    "ELEMENT_SORT_FIELD" => "shows",
                    "ELEMENT_SORT_FIELD2" => "shows",
                    "ELEMENT_SORT_ORDER" => "asc",
                    "ELEMENT_SORT_ORDER2" => "asc",
                    "ENLARGE_PRODUCT" => "STRICT",
                    "FILTER_NAME" => "courseSectionFilter",
                    "HIDE_NOT_AVAILABLE" => "N",
                    "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                    "IBLOCK_ID" => "6",
                    "IBLOCK_TYPE" => "edu",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "LABEL_PROP" => array(),
                    "LAZY_LOAD" => "N",
                    "LINE_ELEMENT_COUNT" => "3",
                    "LOAD_ON_SCROLL" => "N",
                    "MESSAGE_404" => "",
                    "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                    "MESS_BTN_BUY" => "Купить",
                    "MESS_BTN_DETAIL" => "Подробнее",
                    "MESS_BTN_LAZY_LOAD" => "Показать ещё",
                    "MESS_BTN_SUBSCRIBE" => "Подписаться",
                    "MESS_NOT_AVAILABLE" => "Нет в наличии",
                    "MESS_NOT_AVAILABLE_SERVICE" => "Недоступно",
                    "META_DESCRIPTION" => "-",
                    "META_KEYWORDS" => "-",
                    "OFFERS_LIMIT" => "5",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => "arrows",
                    "PAGER_TITLE" => "Товары",
                    "PAGE_ELEMENT_COUNT" => "18",
                    "PARTIAL_PRODUCT_PROPERTIES" => "N",
                    "PRICE_CODE" => array(),
                    "PRICE_VAT_INCLUDE" => "N",
                    "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                    "PRODUCT_ID_VARIABLE" => "id",
                    "PRODUCT_PROPERTIES" => array(""),
                    "PRODUCT_PROPS_VARIABLE" => "prop",
                    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                    "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                    "PRODUCT_SUBSCRIPTION" => "N",
                    "PROPERTY_CODE" => ['*'],
                    "PROPERTY_CODE_MOBILE" => array(),
                    "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
                    "RCM_TYPE" => "personal",
                    "SECTION_CODE" => "",
                    "SECTION_ID" => "",
                    "SECTION_ID_VARIABLE" => "SECTION_ID",
                    "SECTION_URL" => "",
                    "SECTION_USER_FIELDS" => array("",""),
                    "SEF_MODE" => "N",
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SHOW_ALL_WO_SECTION" => "N",
                    "SHOW_CLOSE_POPUP" => "N",
                    "SHOW_DISCOUNT_PERCENT" => "N",
                    "SHOW_FROM_SECTION" => "N",
                    "SHOW_MAX_QUANTITY" => "N",
                    "SHOW_OLD_PRICE" => "N",
                    "SHOW_PRICE_COUNT" => "1",
                    "SHOW_SLIDER" => "N",
                    "SLIDER_INTERVAL" => "3000",
                    "SLIDER_PROGRESS" => "N",
                    "TEMPLATE_THEME" => "blue",
                    "USE_ENHANCED_ECOMMERCE" => "N",
                    "USE_MAIN_ELEMENT_SECTION" => "N",
                    "USE_PRICE_COUNT" => "N",
                    "USE_PRODUCT_QUANTITY" => "N"
                )
            ); ?>
        </div>
    </div>
</div>
<div class="mobile-filter-modal">
    <div class="mobile-filter-modal-content"></div>
</div>
<div class="background-modal-filter"></div>
<?php $helper->saveCache(); ?>
<?php endif; ?>