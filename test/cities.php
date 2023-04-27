<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
$data  = date("Y-m-d", strtotime('-3 day'));
//$data  = date("Y-m-d");
?>
<?$timeend = strtotime('+124 day')?>
<?$enddate = date("Y-m-d", $timeend)?>
<?//echo $enddate?>
<?/* MSK=5741, SPB=5744, OMSK=5742, KIEV=5745, DNEPR=5747, ODESSA=5746*/?>
<?$GLOBALS["arrFilter"] = array("PROPERTY_CITY" => intval(5741), "ACTIVE" => "Y", ">=PROPERTY_STARTDATE" => $data, "<=PROPERTY_STARTDATE" => $enddate, "PROPERTY_teacher"=>53468);
$APPLICATION->IncludeComponent("bitrix:news.list", "subcribe.cities.new.new2018", Array(
    "IBLOCK_TYPE" => "edu",	// Тип информационного блока (используется только для проверки)
    "IBLOCK_ID" => "9",	// Код информационного блока
    "NEWS_COUNT" => "110",	// Количество новостей на странице
    "SORT_BY1" => "PROPERTY_STARTDATE",	// Поле для первой сортировки новостей
    "SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
    "SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
    "SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
    "FILTER_NAME" => "arrFilter",	// Фильтр
    "FIELD_CODE" => array(	// Поля
        0 => "",
        1 => "",
    ),
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
    "AJAX_OPTION_SHADOW" => "Y",
    "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
    "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
    "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
    "CACHE_TYPE" => "N",	// Тип кеширования
    "CACHE_TIME" => "36000",	// Время кеширования (сек.)
    "CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре
    "PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
    "ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
    "DISPLAY_PANEL" => "N",
    "SET_TITLE" => "N",	// Устанавливать заголовок страницы
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
    "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
    "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
    "PARENT_SECTION" => "",	// ID раздела
    "PARENT_SECTION_CODE" => "",	// Код раздела
    "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
    "DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
    "PAGER_TITLE" => "",	// Название категорий
    "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
    "PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
    "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
    "DISPLAY_DATE" => "N",	// Выводить дату элемента
    "DISPLAY_NAME" => "Y",	// Выводить название элемента
    "DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
    "DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
    "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
),
    false
);
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:blog.new_posts",
    "subscribe.snippet.new",
    Array(
        "GROUP_ID" => "2",
        "BLOG_URL" => "",
        "MESSAGE_COUNT" => "2",
        "MESSAGE_LENGTH" => "200",
        "PREVIEW_WIDTH" => "80",
        "PREVIEW_HEIGHT" => "80",
        "DATE_TIME_FORMAT" => "d.m.Y",
        "PATH_TO_BLOG" => "blog_blog.php?page=blog&blog=#blog#",
        "PATH_TO_POST" => "/blog/#blog#/#post_id#.html",
        "PATH_TO_USER" => "blog_user.php?page=user&user_id=#user_id#",
        "PATH_TO_GROUP_BLOG_POST" => "",
        "CACHE_TYPE" => "N",
        "CACHE_TIME" => "86400",
        "PATH_TO_SMILE" => "/bitrix/images/blog/smile/",
        "USE_SOCNET" => "N",
        "BLOG_VAR" => "blog",
        "POST_VAR" => "post_id",
        "USER_VAR" => "user_id",
        "PAGE_VAR" => "page",
        "SEO_USER" => "Y"
    )
);?>