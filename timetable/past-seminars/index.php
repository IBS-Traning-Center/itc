<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Прошедшие семинары");

use Local\Util\Functions;
?>

<? $APPLICATION->IncludeComponent("bitrix:form.result.new", "send_price_list_2",Array(
    "SEF_MODE" => "Y",	// Включить поддержку ЧПУ
    "WEB_FORM_ID" => "24",	// ID веб-формы
    "SUCCESS_URL" => "",	// Страница с сообщением об успешной отправке
    "CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
    "CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
    "IGNORE_CUSTOM_TEMPLATE" => "Y",	// Игнорировать свой шаблон
    "USE_EXTENDED_ERRORS" => "Y",	// Использовать расширенный вывод сообщений об ошибках
    "CACHE_TYPE" => "A",	// Тип кеширования
    "CACHE_TIME" => "3600",	// Время кеширования (сек.)
    "SEF_FOLDER" => "/",	// Каталог ЧПУ (относительно корня сайта)
    "VARIABLE_ALIASES" => ""
), false);
?>

<div class="top-page-banner timetable" style="background-color: <?= $APPLICATION->GetPageProperty('BACKGROUND_COLOR_BANNER') ?>">
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
            );?>
            <h1><?= $APPLICATION->GetPageProperty('title') ?></h1>
        </div>
    </div>
   
    <div class="container<?= (isset($_GET["type"]) && $_GET["type"]=='events')?' events':''?>">
        <div class='timetable-filter-type-wrap'>
            <div class="timetable-filter-type-close"></div>
            <div class="timetable-type-wrap">
                <div class="timetable-type-title">Тип курсов</div>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "right-menu-more", Array(
                    "ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
                    "MAX_LEVEL" => "1",	// Уровень вложенности меню
                    "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                    "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                    ),
                    false
                );?>
                <div class="catalog-info-links">
                    <a onclick="$('.send-price-form-area').show(); return;"> <?= Functions::buildSVG('download-catalog', SITE_TEMPLATE_PATH. '/assets/images/icons')?> Скачать прайс</a>
                </div>
            </div>
            <div class="timetable-filter-type-submit btn-main size-l">Показать</div>
        </div>
        <div class="timetable-filter-type-shadow"></div>
        <div class="timetable-filter-type-mobile">
            <div class="timetable-filter-type-btn btn-main size-l">Фильтр</div>
            <div class="catalog-info-links">
                <a onclick="$('.send-price-form-area').show(); return;"> <?= Functions::buildSVG('download-catalog', SITE_TEMPLATE_PATH. '/assets/images/icons')?> Скачать прайс</a>
            </div>
        </div>
    </div>
</div>

<section id="content" class="not-main-page">
    <div class="container">
        <div class="timetable-menu">
            <div class="simple-select">
                <a class="title dropdown-link" href=""><span><?= $APPLICATION->GetPageProperty("title") ?></span><?= Functions::buildSVG('arrow-down', SITE_TEMPLATE_PATH. '/assets/images/icons')?></a>
                <ul class='timetable-menu-ul dropdown'>
                    <li class="active"><a href="/timetable/past-seminars/"><?= $APPLICATION->GetPageProperty("title") ?></a></li>
                    <li><a href="/timetable/?type=events">Предстоящие семинары</a></li>
                </ul>
            </div>
        </div>
        <?$APPLICATION->IncludeComponent(
            "edu:news.list",
            "edu_seminars_past_webinars",
            Array(
                "IBLOCK_TYPE" => "edu",
                "IBLOCK_ID" => "7",
                "PROPERTY_CITYCHECK" => "0",
                "PROPERTY_DATECHECK" => "0",
                "NEWS_COUNT" => "20",
                "SORT_BY1" => "PROPERTY_startdate",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "arrFilter",
                "FIELD_CODE" => array(
                    0 => "",
                    1=> "",
                ),
                "PROPERTY_CODE" => array(
                    0 => "location",
                    1 => "lecturer",
                    2 => "startdate",
                    3 => "enddate",
                    4 => "time",
                    5 => "description",
                    6 => "content",
                    7 => "titlefile",
                    8 => "file_old",
                    9 => "",
                ),
                "DETAIL_URL" => "/training/seminar/#ELEMENT_ID#/",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_SHADOW" => "Y",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "CACHE_FILTER" => "N",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "DISPLAY_PANEL" => "N",
                "SET_TITLE" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "PARENT_SECTION" => "",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_OPTION_ADDITIONAL" => "",
                "COMPONENT_TEMPLATE" => "edu_seminars_past_webinars",
                "PROPERTY_TYPECHECK" => "324"
            )
        );?>
    </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>