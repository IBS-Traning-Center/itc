<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("blue_title", "Контакты Luxoft Training");
$APPLICATION->SetPageProperty("title", "Контакты Luxoft Training");
$APPLICATION->SetPageProperty("keywords", "Адрес УЦ Luxoft, как проехать Luxoft, контакты Люксофт, телефон Люксофт, Luxoft Москва, luxoft Киев, Люксофт Омск, Luxoft Training, адрес Luxoft Training");
$APPLICATION->SetPageProperty("description", "Курсы по программированию: Москва, Санкт-Петербург, Омск, Киев, Днепропетровск, Одесса.");
$APPLICATION->SetTitle("Контакты Luxoft Training  ");
?>
<div class="bg-main-wrap bg dark-blue " style="">
		<div class="frame">
			<div class="breadcrumbs clearfix">
				<a class="breadcrumb-item" href="/">Главная</a>
				<a class="breadcrumb-item" href="#">Контакты</a>

			</div>
			<div class="clearfix heading-white">
				<h1>Контактная информация</h1>
			</div>
			<?$APPLICATION->IncludeComponent("bitrix:menu", "right-menu-more", Array(
				"ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
					"MAX_LEVEL" => "1",	// Уровень вложенности меню
					"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
					"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
				),
				false
			);?>
			<div class="detail-info-1">
			<?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"map",
	array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"USE_SHARE" => "Y",
		"SHARE_HIDE" => "N",
		"SHARE_TEMPLATE" => "",
		"SHARE_HANDLERS" => array(
			0 => "delicious",
		),
		"SHARE_SHORTEN_URL_LOGIN" => "",
		"SHARE_SHORTEN_URL_KEY" => "",
		"AJAX_MODE" => "Y",
		"IBLOCK_TYPE" => "edu_const",
		"IBLOCK_ID" => "152",
		"ELEMENT_ID" => "",
		"ELEMENT_CODE" => $_REQUEST["CODE"],
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "DESCRIPTION",
			2 => "",
		),
		"IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",
		"DETAIL_URL" => "",
		"SET_TITLE" => "Y",
		"SET_CANONICAL_URL" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_STATUS_404" => "Y",
		"SET_LAST_MODIFIED" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"USE_PERMISSIONS" => "Y",
		"GROUP_PERMISSIONS" => array(
			0 => "1",
			1 => "2",
		),
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Страница",
		"PAGER_TEMPLATE" => "",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"STRICT_SECTION_CHECK" => "Y",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"COMPONENT_TEMPLATE" => "map",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
