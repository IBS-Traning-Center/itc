<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "тренинги,  процессы разработки, управление требованиями, разработка ПО, тестирование ПО, java, архитектура ПО, oracle, BEA, курсы, обучение в области разработки ПО");
$APPLICATION->SetPageProperty("description", "Курсы программирования от экспертов-практиков в Luxoft Training. Примеры разработки реальных проектов. Обучение программистов, тестировщиков, аналитиков, менеджеров проектов. Повышение квалификации для ИТ-специалистов.");
$APPLICATION->SetTitle("Каталог курсов по направлениям: обучение аналитиков, тестировщиков, менеджеров проектов");
?>
<p> </p>

<h2>Опыт реальных проектов</h2>
 Luxoft Training обладает широкой экспертизой в сфере разработки и внедрения банковских продуктов и услуг. Наши знания базируются на опыте компании Luxoft и множестве реализованных проектов для таких клиентов, как: CitiBank, Credit Suisse, Deutche Bank и другие.
<br /><br />
 <?$GLOBALS["arrFilter"] = array("ACTIVE" => "Y", "=PROPERTY_AREA" => 7821 );?>

 <?$APPLICATION->IncludeComponent("bitrix:news.list", "clients_list_sm", array(
	"IBLOCK_TYPE" => "edu",
	"IBLOCK_ID" => "63",
	"NEWS_COUNT" => "18",
	"SORT_BY1" => "PROPERTY_FEATURED",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "arrFilter",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "url",
		1 => "featured",
		2 => "otzyv",
		3 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "news_detail.php?ID=#ELEMENT_ID#",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Клиенты",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y",
	"DISPLAY_DATE" => "N",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
<br />

<h2>Получение практических навыков</h2>
 Курсы, представленные в этом разделе, направлены на изучение конкретных навыков, для этого 70 % занятий отведено практике. По итогам обучения у Вас сформируется необходимый навык, который поможет Вам в дальнейшей работе.
<br />

<br />

<h2>Посттренинговое сопровождение</h2>
 Нам важно, чтобы Вы могли применять на практике навыки, полученные на наших тренингах. Поэтому мы организуем посттренинговое сопровождение для наших клиентов. Вы сможете задавать интересующие Вас вопросы тренерам через неделю, месяц или даже год после окончания обучения. 
<div> 
  <br />

  <h2>Обучение на территории заказчика</h2>
 Мы очень гибко подходим к процессу обучения, поэтому если Вы хотите обучить целый отдел или группу сотрудников, то мы можем организовать обучение у Вас в офисе, адаптировать тренинг под бизнес-процессы Вашей компании. Мы сделаем все, чтобы тренинг был максимально полезным и комфортным для Ваших сотрудников.
  <br />

  <br />

  <br />

  <h2>Каталог курсов</h2>

  <p></p>
 <?$APPLICATION->IncludeComponent(
	"luxoft:super.component",
	"newcatalog.main.fin",
	Array(
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000",
		"ID_IBLOCK" => "94",
		"SECTION_CODE" => "finansy-i-banki"
	)
);?>
  <br />
 
  <p>По запросу на <a href="mailto:<?=EMAIL_ADDRESS?>" title="Написать письмо" ><?=EMAIL_ADDRESS?></a> мы ответим на любые дополнительные вопросы касательно обучения в нашем Luxoft Training.</p>
 </div>

 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
