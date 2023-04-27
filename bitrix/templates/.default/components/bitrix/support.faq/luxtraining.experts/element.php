<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->IncludeComponent(
	"edu:support.faq.section.list",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"AJAX_MODE" => "N",
		"SECTION" => $arParams["SECTION"],
		"EXPAND_LIST" => $arParams["EXPAND_LIST"],
		"LINK_ELEMENTS" => "",
		"LINK_ELEMENTS_LINK" => "/support/faq/?ELEMENT_ID=#ELEMENT_ID#",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",

		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	),
	$component
);?>
<?$APPLICATION->IncludeComponent(
	"bitrix:support.faq.element.detail",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"AJAX_MODE" => "N",
		"SECTION" => $arParams["SECTION"],
		"EXPAND_LIST" => $arParams["EXPAND_LIST"],
		"LINK_ELEMENTS" => "",
		"LINK_ELEMENTS_LINK" => "/support/faq/?ELEMENT_ID=#ELEMENT_ID#",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",

		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
	),
	$component
);?>
<br />
<?/*$APPLICATION->IncludeComponent("bitrix:search.page",
	"",
	Array(
		"RESTART"	=>	"N",
		"CHECK_DATES"	=>	"N",
		"USE_TITLE_RANK"	=>	"N",
		"arrWHERE" => array(),
		"arrFILTER" => array(
			"iblock_".$arParams["IBLOCK_TYPE"],
		),
		"arrFILTER_iblock_edu_const" => array(
			0 => $arParams["IBLOCK_ID"],
		),
		"SHOW_WHERE" => "N",
		"PAGE_RESULT_COUNT"	=>	"10",
		"AJAX_MODE"	=> $arParams["AJAX_MODE"],
		"AJAX_OPTION_SHADOW"	=>	$arParams["AJAX_OPTION_SHADOW"],
		"AJAX_OPTION_JUMP"	=>	$arParams["AJAX_OPTION_JUMP"],
		"AJAX_OPTION_STYLE"	=>	$arParams["AJAX_OPTION_STYLE"],
		"AJAX_OPTION_HISTORY"	=>	$arParams["AJAX_OPTION_HISTORY"],
		"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
		"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
		"PAGER_TITLE"	=>	GetMessage("SUPPORT_FAQ_SEARCH_RESULTS"),
		"PAGER_SHOW_ALWAYS"	=>	"N",
		"PAGER_TEMPLATE"	=>	""
	),
	$component
);*/?>