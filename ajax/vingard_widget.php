<?
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<style>
	* {
		margin: 0;
		padding: 0;
	}
	img {
		border: none;
	}
	
</style>
<?$ran=rand(0, 1);?>
<?if ($ran==0) {?>
<?/*$APPLICATION->IncludeComponent(
	"bitrix:advertising.banner",
	"",
	Array(
		"TYPE" => "VINGRAD",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "300"
	)
);*/?>
<?$APPLICATION->IncludeComponent(
    "luxoft:adv.banners",
    "",
    Array(
        "TYPE" => "VINGRAD",
   )
);	
?>
<?} else {?>


<div class="soft-labwidget"> 

<?GLOBAL $arrFilter;
$arrFilter["!PROPERTY_course_idcategory"]=5735;
$arrFilter[">PROPERTY_startdate"]=date("Y-m-d", strtotime("+21 day"));
$arrFilter["<PROPERTY_startdate"]=date("Y-m-d", strtotime("+91 day"));
$APPLICATION->IncludeComponent("bitrix:news.list", "vingrad-widget", Array(
	"IBLOCK_TYPE" => "edu",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "9",	// Код информационного блока
	"NEWS_COUNT" => "8",	// Количество новостей на странице
	"SORT_BY1" => "RAND",	// Поле для первой сортировки новостей
	"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
	"SORT_BY2" => "ACTIVE_FROM",	// Поле для второй сортировки новостей
	"SORT_ORDER2" => "DESC",	// Направление для второй сортировки новостей
	"FILTER_NAME" => "arrFilter",	// Фильтр
	"FIELD_CODE" => array(	// Поля
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(	// Свойства
		0 => "",
		1 => "DESCRIPTION",
		2 => "",
	),
	"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
	"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
	"AJAX_MODE" => "Y",	// Включить режим AJAX
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "600",	// Время кеширования (сек.)
	"CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
	"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
	"SET_STATUS_404" => "Y",	// Устанавливать статус 404, если не найдены элемент или раздел
	"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",	// Включать инфоблок в цепочку навигации
	"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
	"PARENT_SECTION" => "",	// ID раздела
	"PARENT_SECTION_CODE" => "",	// Код раздела
	"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
	"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
	"PAGER_TITLE" => "???????",	// Название категорий
	"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
	"PAGER_TEMPLATE" => "",	// Название шаблона
	"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
	"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
	"DISPLAY_DATE" => "Y",	// Выводить дату элемента
	"DISPLAY_NAME" => "Y",	// Выводить название элемента
	"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
	"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
	"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	),
	false
);
?>
</div>
<?}?>