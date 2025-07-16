<?php

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

global $APPLICATION;

Asset::getInstance()->addCss(SITE_DIR . 'local/assets/css/testing/testing.css');
?>

<div class="page_testing">


    <?// Блок - обложка раздела ?>
    <section class="start bg--gray">
        <a href="./start-image.jpg" class="start__image h-100 d-none d-xxl-block" target="_blank" data-fancybox>
            <img src="./start-image.jpg" alt="Оценка, тестирование и сертификация IT-специалистов">
        </a>

        <div class="container">
            <?$APPLICATION->IncludeComponent(
                'bitrix:breadcrumb',
                'bread',
                [
                    'START_FROM' => '0',
                    'PATH' => '',
                    'SITE_ID' => 's1',
                ],
                false
            );?>

            <h1 class="title--h1">
            <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/h1-title.php', [], 
                            ['MODE' => 'html', 'NAME' => 'Заголовок']); ?>
                </h1>

            <p style="font-weight: 400;">
                <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/under-h1-text.php', [], 
                            ['MODE' => 'html', 'NAME' => 'Заголовок']); ?>
            </p>
        
            <div class="start__btns">
                <div>
                    <?
                    $APPLICATION->IncludeFile(
                        SITE_DIR . 'include/testing-new/start__btns-1.php', [], 
                        ['MODE' => 'html', 'NAME' => 'Кнопка 1']);
                    ?>
                </div>

                <div>
                    <?
                    $APPLICATION->IncludeFile(
                        SITE_DIR . 'include/testing-new/start__btns-2.php', [], 
                        ['MODE' => 'html', 'NAME' => 'Кнопка 2']);
                    ?>
                </div>
            </div>
        </div>
    </section>


    <? // Блок "Фундаментально. Объективно. Честно."
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "fundamental",
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
            "DISPLAY_DATE" => "N",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "N",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array("NAME","PREVIEW_TEXT",""),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "192",
            "IBLOCK_TYPE" => "edu_const",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "N",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "3",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "",
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
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N"
        )
    );?>

    <section>
        <div class="testing-content">
            <div class="container">
                <div class="testing-flex testing-content-block">
                    <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/h2-text-about.php', [], ['MODE' => 'html', 'NAME' => 'h2 текст']); ?></h2>
                    <div>
                        <p class="f-20 margin-bottom24"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/description_1.php', [], ['MODE' => 'html', 'NAME' => 'Описание 1']); ?></p>
                        <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/description_2.php', [], ['MODE' => 'html', 'NAME' => 'Описание 2']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="testing-tasks bg--gray">
        <div class="container">
            <div class="row g-4 gy-md-0 gx-lg-5 flex-lg-nowrap">
                <div class="col-12 col-md-6 col-lg-8 col-lg-7 testing-tasks--left">
                    <h2 class="title--h2"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/h2_test.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок когда нужна оценка']); ?></h2>
                    
                    <? // Блок "Какие задачи решают услуги по оценке и сертификации ИТ‑сотрудников?"
                    $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "testing_tasks",
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
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "N",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => array("NAME",""),
                            "FILTER_NAME" => "",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "209",
                            "IBLOCK_TYPE" => "edu_const",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "N",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "50",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "",
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
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER1" => "ASC",
                            "SORT_ORDER2" => "ASC",
                            "STRICT_SECTION_CHECK" => "N"
                        )
                    );?>
                </div>

                <div class="col-12 col-md-6 col-lg-4 col-lg-5 pe-lg-0">
                    <div class="testing-tasks__image">
                        <img 
                            src="<?= SITE_TEMPLATE_PATH ?>/assets/images/testing-tasks__image.png" 
                            alt="image"
                        >
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="experience bg--lightblue spaces">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-4">
                    <h2 class="title--h2">
                        <?$APPLICATION->IncludeFile(
                            SITE_DIR . 'include/testing/h2_blue_text.php', 
                            [], ['MODE' => 'html', 'NAME' => 'Заголовок']);
                        ?>
                    </h2>
                </div>

                <div class="col-12 col-xl-8">
                    <? // Блок "Опыт Учебного центра IBS"
                    $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "experience",
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
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "N",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => array("NAME",""),
                            "FILTER_NAME" => "",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "210",
                            "IBLOCK_TYPE" => "edu_const",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "N",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "50",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array("NUMBER",""),
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
                            "STRICT_SECTION_CHECK" => "N"
                        )
                    );?>
                </div>
            </div>
        </div>
    </section>


    <section class="mini-gallery bg--gray spaces">
        <div class="our-students-block m-0 p-0">
            <div class="container">
                <h2 class="title--h2"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/h2-clients.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></h2>
            </div>
    
            <?php $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "our.clients",
                    Array(
                        "SPECIAL_TITLE"=>" ", // скрывает заголовок блока
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
        </div>
    </section>


    <section class="assessment_types bg--gray spaces">
        <div class="container">
            <h2 class="title--h2 mb-4 mb-xxl-5 text-lg-center"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/h2-assessment.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></h2>

            <?
            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "assessment_types",
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
                    "DISPLAY_DATE" => "N",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "N",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array("NAME","PREVIEW_TEXT",""),
                    "FILTER_NAME" => "",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "208",
                    "IBLOCK_TYPE" => "edu_const",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "N",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "30",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array("TESTING","EXPERT","CERT","TEXT_UPPER"),
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
                    "STRICT_SECTION_CHECK" => "N"
                )
            );?>
        </div>
    </section>


    <section class="steps spaces">
        <div class="container">
            <h2 class="title--h2">
                <?$APPLICATION->IncludeFile(
                    SITE_DIR . 'include/testing-new/h2-steps.php', 
                    [], ['MODE' => 'html', 'NAME' => 'Заголовок']); 
                ?>
            </h2>

            <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list",
                "tabs",
                Array(
                    "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "COUNT_ELEMENTS" => "N",
                    "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                    "FILTER_NAME" => "",
                    "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
                    "HIDE_SECTION_NAME" => "N",
                    "IBLOCK_ID" => "211",
                    "IBLOCK_TYPE" => "edu_const",
                    "SECTION_CODE" => "",
                    "SECTION_FIELDS" => array("NAME", ""),
                    "SECTION_ID" => "",
                    "SECTION_URL" => "",
                    "SECTION_USER_FIELDS" => array("", ""),
                    "SHOW_PARENT_NAME" => "Y",
                    "TOP_DEPTH" => "1",
                    "VIEW_MODE" => "TEXT"
                )
            );

            $arFilter = Array('IBLOCK_ID'=>211, 'IBLOCK_TYPE'=>'edu_const');
            $arSelect = Array('ID', 'NAME', 'CODE');
            $db_list = CIBlockSection::GetList(
                Array("SORT"=>"ASC"), 
                $arFilter,
                false,
                $arSelect,
                false
            );
            $tabKey = 0;

            while($ar_result = $db_list->GetNext())
            {
                ?>
                <div data-code="<?=$ar_result['CODE'];?>" <?=($tabKey > 0) ? 'style="display: none;"' : '';?>>
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "steps",
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
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "N",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => array("NAME"),
                            "FILTER_NAME" => "",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "211",
                            "IBLOCK_TYPE" => "edu_const",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "N",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "6",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => $ar_result['CODE'],
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array("NUMBER","REPLACE_TITLE_HTML"),
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
                            "STRICT_SECTION_CHECK" => "N"
                            )
                        );
                    ?>
                </div>
            <? $tabKey++;
            }
            ?>
        </div>
    </section>


    <section class="banner bg--lightblue">
        <div class="container">
            <div class="row g-3 flex-column flex-md-row align-items-sm-center">
                <div class="col-12 col-md-9">
                    <h2 class="title--h2"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/check-skills-title.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></h2>
                    <p class="f-32"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/check-skills-text.php', [], ['MODE' => 'html', 'NAME' => 'Текст']); ?></p>
                </div>
                <div class="col-12 col-md-3">
                    <?$APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/check-skills-btn.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?>
                </div>
            </div>
        </div>
    </section>


    <section class="expertise spaces">
        <div class="container">
            <h2 class="title--h2 mb-4 mb-xxl-5"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/h2-expertise.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></h2>

            <?php $APPLICATION->IncludeComponent(
                'addamant:testing.roles',
                '.default',
                [
                    'CACHE_TIME' => '36000000',
                    'CACHE_TYPE' => 'A',
                ]
            ); ?>
            
        </div>
    </section>


    <section class="bg--lightblue">
        <div class="container">
            <?$APPLICATION->IncludeComponent(
                "bitrix:form.result.new",
                "banner-get-consult",
                array(
                    "CUSTOM_CLASSES" => "spaces",
                    "CACHE_TIME" => "3600",
                    "CACHE_TYPE" => "A",
                    "CHAIN_ITEM_LINK" => "",
                    "CHAIN_ITEM_TEXT" => "",
                    "EDIT_URL" => "",
                    "IGNORE_CUSTOM_TEMPLATE" => "N",
                    "LIST_URL" => "",
                    "SEF_MODE" => "N",
                    "SUCCESS_URL" => "",
                    "AJAX_MODE" => "Y",
                    "USE_EXTENDED_ERRORS" => "N",
                    "VARIABLE_ALIASES" => array("RESULT_ID" => "RESULT_ID", "WEB_FORM_ID" => "WEB_FORM_ID"),
                    "WEB_FORM_ID" => "49"
                )
            );?>
        </div>
    </section>
        

    <? // Блок "Отзывы и кейсы"
    $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "reviews-and-cases",
    Array(
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
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "N",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array("NAME","PREVIEW_TEXT","PREVIEW_PICTURE",""),
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "82",
        "IBLOCK_TYPE" => "edu",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "N",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "30",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "main.pagenavigation",
        "PAGER_TITLE" => "",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array("SHORT_DESC","REVIEW_USER_NAME",""),
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
        "STRICT_SECTION_CHECK" => "N"
    )
    );?>


    <div class="testing-content-block container telegram">
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
        ); ?>
    </div>


    <?$APPLICATION->IncludeComponent(
        "bitrix:form.result.new",
        "main.feedback",
        array(
            "CUSTOM_CLASSES" => "bg--lightblue",
            "CACHE_TIME" => "3600",
            "CACHE_TYPE" => "A",
            "CHAIN_ITEM_LINK" => "",
            "CHAIN_ITEM_TEXT" => "",
            "EDIT_URL" => "",
            "IGNORE_CUSTOM_TEMPLATE" => "N",
            "LIST_URL" => "",
            "SEF_MODE" => "N",
            "SUCCESS_URL" => "",
            "AJAX_MODE" => "Y",
            "USE_EXTENDED_ERRORS" => "N",
            "VARIABLE_ALIASES" => array("RESULT_ID" => "RESULT_ID", "WEB_FORM_ID" => "WEB_FORM_ID"),
            "WEB_FORM_ID" => "48"
        )
    );?>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>