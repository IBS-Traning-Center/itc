<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
global $USER, $APPLICATION, $DB;
if (
    $USER->IsAuthorized()
    && (
        in_array('34', CUser::GetUserGroup($USER->GetID()))
        || in_array('1', CUser::GetUserGroup($USER->GetID()))
    )
) {
    $APPLICATION->SetTitle("Расписание и цены");

    /*Для Weekly формируем страницу без цен*/
    if (!isset($_SESSION['SHOW_PRICE'])) {
        $_SESSION['SHOW_PRICE'] = "Y";
    }

    if (isset($_REQUEST['SHOW_PRICE'])) {
        if (($_REQUEST['SHOW_PRICE'] == "Y") or ($_REQUEST['SHOW_PRICE'] == "N")) {
            $_SESSION['SHOW_PRICE'] = $_REQUEST['SHOW_PRICE'];
        }
    }

    $id_city = "14909"; //Москва
    $APPLICATION->SetPageProperty("id_city", $id_city);

    $id_type = 4;    //курсы
    $bOnline = true;
    $ID_IBLOCK = 9;

// создаем объект
    $obCache = new CPHPCache;
// время кеширования - 30 минут
    $life_time = 5 * 60;
// формируем идентификатор кеша в зависимости от всех параметров
// которые могут повлиять на результирующий HTML
    $cache_id = 5743;

// если кеш есть и он ещё не истек, то
    if ($obCache->InitCache($life_time, $cache_id, "/")) {
        // получаем закешированные переменные
        $vars = $obCache->GetVars();
        $sch_in_moscow = $vars["sch_in_moscow"];
        $sch_in_omsk = $vars["sch_in_omsk"];
        $sch_in_spb = $vars["sch_in_spb"];
        $sch_in_kiev = $vars["sch_in_kiev"];
        $sch_in_odessa = $vars["sch_in_odessa"];
        $sch_in_dnepr = $vars["sch_in_dnepr"];
        $sch_in_online = $vars["sch_in_online"];
        $res_in_moscow = $vars["res_in_moscow"];
        $res_in_omsk = $vars["res_in_omsk"];
        $res_in_spb = $vars["res_in_spb"];
        $res_in_kiev = $vars["res_in_kiev"];
        $res_in_odessa = $vars["res_in_odessa"];
        $res_in_dnepr = $vars["res_in_dnepr"];
        $res_in_online = $vars["res_in_online"];
        $res_in_novorossiysk = $vars["res_in_novorossiysk"];
        $sch_in_novorossiysk = $vars["sch_in_novorossiysk"];
        $res_in_minsk = $vars["res_in_minsk"];
        $sch_in_minsk = $vars["sch_in_minsk"];
        $res_in_nsk = $vars["res_in_nsk"];
        $sch_in_nsk = $vars["sch_in_nsk"];
        // иначе обращаемся к базе
    } else {
        if (CModule::IncludeModule("iblock")) {
            $arGroupBy = array();
            $arOrder = array();
            $arSelectFields = array("ID");
            $arFilter = array("IBLOCK_ID" => 10, "ACTIVE" => "Y", "PROPERTY_city" => 5741, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
            $sch_in_moscow = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
            $arFilter = array("IBLOCK_ID" => 10, "ACTIVE" => "Y", "PROPERTY_city" => 5742, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
            $sch_in_omsk = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
            $arFilter = array("IBLOCK_ID" => 10, "ACTIVE" => "Y", "PROPERTY_city" => 5744, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
            $sch_in_spb = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
            $arFilter = array("IBLOCK_ID" => 10, "ACTIVE" => "Y", "PROPERTY_city" => 5745, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
            $sch_in_kiev = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
            $arFilter = array("IBLOCK_ID" => 10, "ACTIVE" => "Y", "PROPERTY_city" => 5746, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
            $sch_in_odessa = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
            $arFilter = array("IBLOCK_ID" => 10, "ACTIVE" => "Y", "PROPERTY_city" => 5747, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
            $sch_in_dnepr = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
            $arFilter = array("IBLOCK_ID" => 10, "ACTIVE" => "Y", "PROPERTY_city" => 14909, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
            $sch_in_online = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
            $arFilter = array("IBLOCK_ID" => 10, "ACTIVE" => "Y", "PROPERTY_city" => CITY_ID_NOVOROSSIYSK, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
            $sch_in_novorossiysk = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
            $arFilter = array("IBLOCK_ID" => 10, "ACTIVE" => "Y", "PROPERTY_city" => CITY_ID_MINSK, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
            $sch_in_minsk = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
            $arFilter = array("IBLOCK_ID" => 10, "ACTIVE" => "Y", "PROPERTY_city" => CITY_ID_NOVOSIBIRSK, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
            $sch_in_nsk = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);

            $arGroupBy = array();
            $arOrder = array();
            $arSelectFields = array("ID");
            $arFilter = array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_city" => 5741, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
            $res_in_moscow = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
            $arFilter = array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_city" => 5742, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
            $res_in_omsk = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
            $arFilter = array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_city" => 5744, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
            $res_in_spb = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
            $arFilter = array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_city" => 5745, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
            $res_in_kiev = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
            $arFilter = array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_city" => 5746, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
            $res_in_odessa = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
            $arFilter = array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_city" => 5747, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
            $res_in_dnepr = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
            $arFilter = array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_city" => 14909, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
            $res_in_online = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
            $arFilter = array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_city" => CITY_ID_NOVOROSSIYSK, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
            $res_in_novorossiysk = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);

            $arFilter = array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_city" => CITY_ID_MINSK, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
            $res_in_minsk = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
            $arFilter = array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_city" => CITY_ID_NOVOSIBIRSK, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
            $res_in_nsk = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        }
    }
// начинаем буферизирование вывода
    if ($obCache->StartDataCache()) {
        // записываем предварительно буферизированный вывод в файл кеша
        // вместе с дополнительной переменной
        $obCache->EndDataCache(array(
            "sch_in_moscow" => $sch_in_moscow,
            "sch_in_omsk" => $sch_in_omsk,
            "sch_in_spb" => $sch_in_spb,
            "sch_in_kiev" => $sch_in_kiev,
            "sch_in_odessa" => $sch_in_odessa,
            "sch_in_dnepr" => $sch_in_dnepr,
            "sch_in_online" => $sch_in_online,
            "sch_in_novorossiysk" => $sch_in_novorossiysk,
            "res_in_moscow" => $res_in_moscow,
            "res_in_omsk" => $res_in_omsk,
            "res_in_spb" => $res_in_spb,
            "res_in_kiev" => $res_in_kiev,
            "res_in_odessa" => $res_in_odessa,
            "res_in_dnepr" => $res_in_dnepr,
            "res_in_online" => $res_in_online,
            "res_in_novorossiysk" => $res_in_novorossiysk,
            "res_in_minsk" => $res_in_minsk,
            "sch_in_minsk" => $sch_in_minsk,
            "res_in_nsk" => $res_in_nsk,
            "sch_in_nsk" => $sch_in_nsk,
        ));
    } ?>
    <div id="showcalendar" class="usual">
        <div class="inside">
            <div class="block_border">
                <?
                $data = date("Y-m-d");
                $GLOBALS["arrFilter"] = array("PROPERTY_city" => $id_city, "ACTIVE" => "Y", ">PROPERTY_startdate" => $data);
                $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "edu_ru_all_city_schedule_cources_cal",
                    array(
                        "IBLOCK_TYPE" => "edu",    // Тип информационного блока (используется только для проверки)
                        "IBLOCK_ID" => "9",    // Код информационного блока
                        "NEWS_COUNT" => "120",    // Количество новостей на странице
                        "SORT_BY1" => "PROPERTY_startdate",    // Поле для первой сортировки новостей
                        "SORT_ORDER1" => "ASC",    // Направление для первой сортировки новостей
                        "SORT_BY2" => "SORT",    // Поле для второй сортировки новостей
                        "SORT_ORDER2" => "ASC",    // Направление для второй сортировки новостей
                        "FILTER_NAME" => "arrFilter",    // Фильтр
                        "FIELD_CODE" => array(    // Поля
                            0 => "",
                            1 => "",
                        ),
                        "SHOW_PRICE" => $_SESSION['SHOW_PRICE'],
                        "PROPERTY_CODE" => array(    // Свойства
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
                        "CHECK_DATES" => "N",    // Показывать только активные на данный момент элементы
                        "DETAIL_URL" => "/edu/catalog/course.html?ID=#ELEMENT_ID#",    // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
                        "AJAX_MODE" => "N",    // Включить режим AJAX
                        "AJAX_OPTION_SHADOW" => "Y",    // Включить затенение
                        "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
                        "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
                        "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
                        "CACHE_TYPE" => "A",    // Тип кеширования
                        "CACHE_TIME" => "3600",    // Время кеширования (сек.)
                        "CACHE_FILTER" => "Y",    // Кэшировать при установленном фильтре
                        "PREVIEW_TRUNCATE_LEN" => "",    // Максимальная длина анонса для вывода (только для типа текст)
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",    // Формат показа даты
                        "DISPLAY_PANEL" => "N",    // Добавлять в админ. панель кнопки для данного компонента
                        "SET_TITLE" => "N",    // Устанавливать заголовок страницы
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",    // Включать инфоблок в цепочку навигации
                        "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",    // Скрывать ссылку, если нет детального описания
                        "PARENT_SECTION" => "",    // ID раздела
                        "PARENT_SECTION_CODE" => "",    // Код раздела
                        "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
                        "DISPLAY_BOTTOM_PAGER" => "N",    // Выводить под списком
                        "PAGER_TITLE" => "",    // Название категорий
                        "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
                        "PAGER_TEMPLATE" => "",    // Название шаблона
                        "PAGER_DESC_NUMBERING" => "N",    // Использовать обратную навигацию
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "N",
                        "DISPLAY_PREVIEW_TEXT" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
                    )
                ); ?>
            </div>
        </div>
    </div>
    <?php
} else {
    LocalRedirect('/timetable/');
}
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
