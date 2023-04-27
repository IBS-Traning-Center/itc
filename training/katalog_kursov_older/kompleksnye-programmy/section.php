<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetPageProperty("SHOW_FULL_PAGE", "Y");
$APPLICATION->SetPageProperty("blue_title", "Каталог курсов по направлениям");
$APPLICATION->SetPageProperty("keywords", "тренинги,   процессы разработки, управление требованиями, разработка ПО, тестирование ПО, java, архитектура ПО, oracle, BEA, курсы, обучение в области разработки ПО");
$APPLICATION->SetPageProperty("description", "Обучение в сфере разработки ПО. Курсы по всем направлениям для тестировщик, аналитиков, разработчиков, проектировщиков.");
$APPLICATION->SetTitle("Каталог курсов по направлениям: обучение аналитиков, тестировщиков, менеджеров проектов");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_after.php");
?>



<a href="/training/katalog_kursov/kompleksnye-programmy/" class="arrow-link-back">Вернуться к каталогу</a>
<?if ($_REQUEST["SECTION_CODE"]!="upravlencheskaya_effektivnost_i_kommunikatsii") {?>
<?$section=$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "course-section-list", array(
	"IBLOCK_TYPE" => "edu_const",
	"IBLOCK_ID" => "49",
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
<?} else {?>
	<?//$APPLICATION->SetPageProperty("blue_title", "Управленческая эффективность и коммуникации");?>
<?}?>
<?$APPLICATION->IncludeComponent("luxoft:super.component", "section-items-list", Array(
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"ID_IBLOCK" => "49",	// Идентификатор Инфоблока
	"SECTION_CODE" => $_REQUEST['SECTION_CODE'],
	),
	false
);?>
<?GLOBAL $META_DESCR;
if (strlen($META_DESCR)>0) {
	$APPLICATION->SetPageProperty("description", $META_DESCR);
}?>
<a href="/training/katalog_kursov/kompleksnye-programmy/" class="arrow-link-back">Вернуться к каталогу</a>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>