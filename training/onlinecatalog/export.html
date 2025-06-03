<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_after.php");
if (isset($_REQUEST["CODE"])){
		CModule::IncludeModule("iblock");
		$arOrder = array();
		$arFilter = array();
		$arSort = array();
		$arFilter = Array("IBLOCK_ID"=>6, "=PROPERTY_COURSE_CODE"=>$_REQUEST["CODE"]);
		$arGroupBy = false;
		$arNavStartParams = false;
		$arSelectFields = Array("ID");
		$res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			$ID = $arFields["ID"];
		}
		$_REQUEST["ID"] = $ID;
}
?><?$APPLICATION->IncludeComponent("bitrix:news.detail", "course.word", Array(
	"IBLOCK_TYPE" => "edu",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "6",	// Код информационного блока
	"ELEMENT_ID" => $_REQUEST["ID"],	// ID новости
	"CHECK_DATES" => "N",	// Показывать только активные на данный момент элементы
	"FIELD_CODE" => array(	// Поля
		0 => "",
		1 => "",
		2 => "",
	),
	"PROPERTY_CODE" => array(	// Свойства
		0 => "course_code",
		1 => "course_top",
		2 => "course_price",
		3 => "course_language",
		4 => "course_duration",
		5 => "course_type",
		6 => "course_description",
		7 => "course_puproses",
		8 => "course_topics",
		9 => "course_audience",
		10 => "course_required",
		11 => "course_linkedcourses",
		12 => "course_trainers",
		13 => "course_owner",
		14 => "course_addsources",
		15 => "course_requirements",
		16 => "course_other",
		17 => "course_filename",
		18 => "",
	),
	"IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#",	// URL страницы просмотра списка элементов (по умолчанию - из настроек инфоблока)
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"AJAX_OPTION_SHADOW" => "Y",	// Включить затенение
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
	"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
	"DISPLAY_PANEL" => "N",	// Добавлять в админ. панель кнопки для данного компонента
	"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
	"USE_PERMISSIONS" => "N",	// Использовать дополнительное ограничение доступа
	"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
	"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
	"PAGER_TITLE" => "Страница",	// Название категорий
	"PAGER_TEMPLATE" => "",	// Название шаблона
	"DISPLAY_DATE" => "N",	// Выводить дату элемента
	"DISPLAY_NAME" => "Y",	// Выводить название элемента
	"DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
	"DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
	),
	false
);?><?
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_before.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>