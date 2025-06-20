<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

global $APPLICATION;

$APPLICATION->SetTitle('Результат поиска');
$GLOBALS['arFilterSearch'] = ['ACTIVE' => 'Y'];
?>
<?php $APPLICATION->IncludeComponent(
	"bitrix:search.page",
	"clear1",
	array(
		"TAGS_SORT" => "NAME",
		"TAGS_PAGE_ELEMENTS" => "150",
		"TAGS_PERIOD" => "",
		"TAGS_URL_SEARCH" => "",
		"TAGS_INHERIT" => "Y",
		"FONT_MAX" => "50",
		"FONT_MIN" => "10",
		"COLOR_NEW" => "000000",
		"COLOR_OLD" => "C8C8C8",
		"PERIOD_NEW_TAGS" => "",
		"SHOW_CHAIN" => "Y",
		"COLOR_TYPE" => "Y",
		"WIDTH" => "99%",
		"AJAX_MODE" => "N",
		"RESTART" => "N",
		"CHECK_DATES" => "Y",
		"arrWHERE" => "",
		"arrFILTER" => array(
			0 => "iblock_edu",
		),
		"SHOW_WHERE" => "N",
		"PAGE_RESULT_COUNT" => "50",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"PAGER_TITLE" => "Search results",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "luxoft",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"COMPONENT_TEMPLATE" => "clear1",
		"NO_WORD_LOGIC" => "N",
		"USE_TITLE_RANK" => "Y",
		"DEFAULT_SORT" => "rank",
		"FILTER_NAME" => "arFilterSearch",
		"SHOW_WHEN" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"USE_LANGUAGE_GUESS" => "N",
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"USE_SUGGEST" => "N",
		"SHOW_ITEM_TAGS" => "Y",
		"SHOW_ITEM_DATE_CHANGE" => "Y",
		"SHOW_ORDER_BY" => "Y",
		"SHOW_TAGS_CLOUD" => "N",
		"arrFILTER_iblock_edu" => array(
			0 => "6",
			1 => "23",
			2 => "56",
		)
	),
	false
);?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>