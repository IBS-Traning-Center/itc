<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="buble_body">
   <h2>Ближайшие вебинары:</h2>
 <?
 $GLOBALS["arrFilter1"] = array("ACTIVE" => "Y", "=PROPERTY_TYPE_EVENT" => 92);

 $APPLICATION->IncludeComponent("edu:news.list", "edu_seminars_short", array(
	"IBLOCK_TYPE" => "edu",
	"IBLOCK_ID" => "7",
	"PROPERTY_CITYCHECK" => "0",
	"PROPERTY_DATECHECK" => "0",
	"NEWS_COUNT" => "3",
	"SORT_BY1" => "PROPERTY_startdate",
	"SORT_ORDER1" => "ASC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "arrFilter1",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
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
	"DETAIL_URL" => "seminarinfo.html?ID=#ELEMENT_ID#",
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
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>

</div>
