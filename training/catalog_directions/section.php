<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("blue_title", "Каталог курсов по направлениям");
$APPLICATION->SetPageProperty("title", "Обучение в сфере разработки ПО. Каталог курсов: обучение аналитиков, тестировщиков, менеджеров проектов, разработчиков ПО, архитекторов и проектировщиков");
$APPLICATION->SetPageProperty("keywords", "тренинги,   процессы разработки, управление требованиями, разработка ПО, тестирование ПО, java, архитектура ПО, oracle, BEA, курсы, обучение в области разработки ПО");
$APPLICATION->SetPageProperty("description", "Обучение в сфере разработки ПО. Курсы по всем направлениям для тестировщик, аналитиков, разработчиков, проектировщиков.");
$APPLICATION->SetTitle("Каталог курсов по направлениям: обучение аналитиков, тестировщиков, менеджеров проектов");
?>
<?if ($_REQUEST["SECTION_CODE"]!="manager-eff") {?>
<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "course-section-list", array(
	"IBLOCK_TYPE" => "edu_const",
	"IBLOCK_ID" => "94",
	"SECTION_ID" => "",
	"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
	"COUNT_ELEMENTS" => "Y",
	"TOP_DEPTH" => "3",
	"SECTION_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"SECTION_USER_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"SECTION_URL" => "",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"ADD_SECTIONS_CHAIN" => "Y"
	),
	$component
);
?>
<?}?>
<?$APPLICATION->IncludeComponent(
    "luxoft:super.component",
    "section-items-list",
    Array(
        "CACHE_TYPE" => "N",
        "CACHE_TIME" => "3600",
        "ID_IBLOCK"=> 94,
        "SECTION_CODE" => "{$_REQUEST['SECTION_CODE']}"
    )
);?>
<a class="back_to_cat" href="/training/catalog_directions/">Назад в каталог курсов</a> 
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>