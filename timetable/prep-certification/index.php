<?php
declare(strict_types=1);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle('Расписание подготовки к Российскому центру сертификации ИТ-специалистов');
$APPLICATION->SetPageProperty("title", "Подготовка к сертификации");
/**
 * @global CMain $APPLICATION
 */
?>
<div class="top-page-banner timetable sertification" style="background-color: <?= $APPLICATION->GetPageProperty('BACKGROUND_COLOR_BANNER') ?>">
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
        </div>
    </div>
   
    <div class="container">
        <div class="timetable-type-wrap">
            <?$APPLICATION->IncludeComponent("bitrix:menu", "right-menu-more", Array(
                "ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
                "MAX_LEVEL" => "1",	// Уровень вложенности меню
                "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
            ),
                false
            );?>
        </div>   
    </div>

<?
$data  = date("Y-m-d H:i:s");
$GLOBALS["arrFilter"] =array("ACTIVE" => "Y", "preparation_certification" => "Y", ">PROPERTY_startdate" => $data);
$APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "edu_ru_all_city_schedule_cources_cal",
                    Array(
                        "IBLOCK_TYPE" => "edu",	// Тип информационного блока (используется только для проверки)
                        "IBLOCK_ID" => "9",	// Код информационного блока
                        "NEWS_COUNT" => "30",	// Количество новостей на странице

                        "FILTER_NAME" => "arrFilter",	// Фильтр
                        "FIELD_CODE" => array(	// Поля
                            0 => "",
                            1 => "",
                        ),
                        "SHOW_PRICE" => $_SESSION['SHOW_PRICE'],
                        "PROPERTY_CODE" => array(	// Свойства
                            0 => "course_сode",
                            1 => "startdate",
                            2 => "enddate",
                            3 => "schedule_time",
                            4 => "schedule_description",
                            5 => "schedule_price",
                            6 => "schedule_duration",
                            7 => "hot_checkbox",
                            8 => "prschedule_startdate",
                            9 => "prschedule_enddate",
                            10 => "prschedule_time",
                            11 => "prschedule_desc",
                            12 => "",
                        ),
                        "CHECK_DATES" => "N",	// Показывать только активные на данный момент элементы
                        "DETAIL_URL" => "/edu/catalog/course.html?ID=#ELEMENT_ID#",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
                        "AJAX_MODE" => "N",	// Включить режим AJAX
                        "AJAX_OPTION_SHADOW" => "Y",	// Включить затенение
                        "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
                        "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
                        "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
                        "CACHE_TYPE" => "A",	// Тип кеширования
                        "CACHE_TIME" => "36000",	// Время кеширования (сек.)
                        "CACHE_FILTER" => "Y",	// Кэшировать при установленном фильтре
                        "PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
                        "DISPLAY_PANEL" => "N",	// Добавлять в админ. панель кнопки для данного компонента
                        "SET_TITLE" => "N",	// Устанавливать заголовок страницы
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
                        "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
                        "PARENT_SECTION" => "",	// ID раздела
                        "PARENT_SECTION_CODE" => "",	// Код раздела
                        "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
                        "DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
                        "PAGER_TITLE" => "",	// Название категорий
                        "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
                        "PAGER_TEMPLATE" => "",	// Название шаблона
                        "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "N",
                        "DISPLAY_PREVIEW_TEXT" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
                    )
                );?>
</div>
<section id="content" class="not-main-page">
    
</section>
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");