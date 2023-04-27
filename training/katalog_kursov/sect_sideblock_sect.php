<a class="order-corp-wrap" href="/corporate/" ></a> 
<div class="nearest-courses"> 
  <div class="course-head">Ближайшие курсы в <?include $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/include/city-select.php';?> </div>
 <?$data  = date("Y-m-d H:i:s");
    $GLOBALS["arrFilter"] =array("PROPERTY_city" => array($_SESSION["cityID"], CITY_ID_ONLINE), "ACTIVE" => "Y" ,">PROPERTY_startdate" => $data);
    $APPLICATION->IncludeComponent("bitrix:news.list", "edu_ru_all_city_small", Array(
	"IBLOCK_TYPE" => "edu",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "9",	// Код информационного блока
	"NEWS_COUNT" => "5",	// Количество новостей на странице
	"SORT_BY1" => "PROPERTY_startdate",	// Поле для первой сортировки новостей
	"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
	"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
	"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
	"FILTER_NAME" => "arrFilter",	// Фильтр
	"FIELD_CODE" => array(	// Поля
		0 => "",
		1 => "",
	),
	"SHOW_PRICE" => $_SESSION["SHOW_PRICE"],
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
	"CACHE_TYPE" => "Y",	// Тип кеширования
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
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
	"PAGER_TEMPLATE" => "",	// Название шаблона
	"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
	"DISPLAY_DATE" => "N",	// Выводить дату элемента
	"DISPLAY_NAME" => "Y",	// Выводить название элемента
	"DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
	"DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
	"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	),
	false
);?> </div>
