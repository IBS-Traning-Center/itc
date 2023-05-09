<?
GLOBAL $USER;

	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>
<?header("Access-Control-Allow-Origin: *");?>
<?
GLOBAL $arrFilter;
GLOBAL $arrFilter1;
GLOBAL $arrFilter2;
$arrFilter[">PROPERTY_startdate"]=date("Y-m-d", strtotime("+14 day"));
$arrFilter["<PROPERTY_startdate"]=date("Y-m-d", strtotime("+91 day"));
$arrFilter1[">PROPERTY_startdate"]=date("Y-m-d", strtotime("+14 day"));
$arrFilter1["<PROPERTY_startdate"]=date("Y-m-d", strtotime("+91 day"));
$arrFilter2[">PROPERTY_startdate"]=date("Y-m-d", strtotime("+14 day"));
$arrFilter2["<PROPERTY_startdate"]=date("Y-m-d", strtotime("+91 day"));
$xml =  simplexml_load_file('http://ipgeobase.ru:7020/geo?ip='.$_REQUEST["ip"]);
$city=(string)$xml->ip->region;
$country=(string)$xml->ip->country;
if ($country=="RU") {
			if ($city=="Омская область" || $city=="Новосибирская область" || $city=="Ханты-Мансийский автономный округ" || $city=="Тюменская область" || $city=="Алтайский край") {
				$arrFilter["PROPERTY_city"]=CITY_ID_OMSK;
				$arrFilter1["PROPERTY_city"]=CITY_ID_OMSK;
			
			} elseif ($city=="Санкт-Петербург") {
				
				$arrFilter["PROPERTY_city"]=CITY_ID_SPB;
				$arrFilter1["PROPERTY_city"]=CITY_ID_SPB;
			} else {
				$arrFilter["PROPERTY_city"]=CITY_ID_MOSCOW;
				$arrFilter1["PROPERTY_city"]=CITY_ID_MOSCOW;
			}
		}  elseif ($country=="UA") {
			if ($city=="Одесская область") {
				$arrFilter["PROPERTY_city"]=CITY_ID_ODESSA;
				$arrFilter1["PROPERTY_city"]=CITY_ID_ODESSA;
			} elseif ($city=="Днепропетровская область") {
				$arrFilter["PROPERTY_city"]=CITY_ID_DNEPR;
				$arrFilter1["PROPERTY_city"]=CITY_ID_DNEPR;
			} else {
				$arrFilter["PROPERTY_city"]=CITY_ID_KIEV;
				$arrFilter1["PROPERTY_city"]=CITY_ID_KIEV;
			}
		}
	if (strlen($_REQUEST["tag"])>0) {
			$arrFilter[]=array("LOGIC"=>"OR", "NAME"=>"%".$_REQUEST["tag"]."%", "PREVIEW_TEXT"=> "%".$_REQUEST["tag"]."%");
		}

$count=5;
if (intval($_REQUEST["num"])>0) {
	$count=intval($_REQUEST["num"]);
}
$arCount=$APPLICATION->IncludeComponent("luxoft:time.list", "json-courses", Array(
	"IBLOCK_TYPE" => "edu",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "9",	// Код информационного блока
	"NEWS_COUNT" => $count,	// Количество новостей на странице
	"TAG"=> $_REQUEST["tag"],
	"CITY"=> $city,
	"COUNTRY"=> $country,
	"SORT_BY1" => "PROPERTY_startdate",	// Поле для первой сортировки новостей
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
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
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
<?//print_r($arCount)?>
<?//print_r ()?>