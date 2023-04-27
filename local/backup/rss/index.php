<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<?$APPLICATION->IncludeComponent("bitrix:rss.out", "rss", Array(
	"IBLOCK_TYPE" => "edu",	// Тип информационного блока
	"IBLOCK_ID" => "23",	// Информационный блок
	"SECTION_ID" => "",	// Раздел
	"SECTION_CODE" => "",	// Код раздела
	"NUM_NEWS" => "20",	// Количество новостей для экспорта
	"NUM_DAYS" => "120",	// Количество дней для экспорта
	"RSS_TTL" => "600",	// Время жизни (в минутах)
	"YANDEX" => "N",	// Экспортировать в диалект Яндекса
	"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
	"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
	"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
	"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"CACHE_GROUPS" => "N",	// Учитывать права доступа
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>