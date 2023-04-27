<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("blue_title", "Каталог курсов по направлениям");
$APPLICATION->SetPageProperty("title", "Обучение в сфере разработки ПО. Каталог курсов: обучение аналитиков, тестировщиков, менеджеров проектов, разработчиков ПО, архитекторов и проектировщиков");
$APPLICATION->SetPageProperty("keywords", "тренинги,   процессы разработки, управление требованиями, разработка ПО, тестирование ПО, java, архитектура ПО, oracle, BEA, курсы, обучение в области разработки ПО");
$APPLICATION->SetPageProperty("description", "Обучение в сфере разработки ПО. Курсы по всем направлениям для тестировщик, аналитиков, разработчиков, проектировщиков.");
$APPLICATION->SetTitle("Каталог курсов по направлениям: обучение аналитиков, тестировщиков, менеджеров проектов");
?>

<?
	$cache = new CPHPCache();
	$cache_time = 3600;
	$cache_id = 'arSectionkListID';
	$cache_path = '/arSectionListID/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path))
	{
	$res = $cache->GetVars();
	if (is_array($res["Sectioninfo"]) && (count($res["Sectioninfo"]) > 0))
    $arSectioninfo = $res["Sectioninfo"];
	}
	if (!is_array($arSectioninfo))
	{
	$arFilter = Array('IBLOCK_ID'=>94, array("LOGIC"=> "OR", array("CODE"=>$_REQUEST["SECTION_CODE"]), array("XML_ID"=> $_REQUEST["SECTION_CODE"])));
	$db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
	
	
		while($ar_result = $db_list->GetNext())
		{
			
			$arSectioninfo[]=$ar_result;
			
			
		}
	
	if ($cache_time > 0)
	{
         $cache->StartDataCache($cache_time, $cache_id, $cache_path);
         $cache->EndDataCache(array("Sectioninfo"=>$arSectioninfo));
	}
	}
	foreach ($arSectioninfo as $ar_result) { 
	if ($ar_result["CODE"]!=$_REQUEST["SECTION_CODE"]) {
				if ($ar_result["XML_ID"]==$_REQUEST["SECTION_CODE"]) {
					LocalRedirect('/training/katalog_kursov/'.$ar_result["CODE"].'/', false, '301 Moved permanently');
				} 
			} elseif ($ar_result["CODE"]==$_REQUEST["SECTION_CODE"]) {
				$APPLICATION->SetPageProperty("title", "Курсы ".$ar_result["NAME"]);
			}
	}

?>


<?if ($_REQUEST["SECTION_CODE"]!="upravlencheskaya_effektivnost_i_kommunikatsii") {?>
<?$section=$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "course-section-list", array(
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
<?} else {?>
	<?$APPLICATION->SetPageProperty("blue_title", "Управленческая эффективность и коммуникации");?>
<?}?>
<?$APPLICATION->IncludeComponent(
    "luxoft:super.component",
    "section-items-list",
    Array(
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "ID_IBLOCK"=> 94,
        "SECTION_CODE" => "{$_REQUEST['SECTION_CODE']}"
    )
);?>
<a class="back_to_cat" href="/training/catalog_directions/">Назад в каталог курсов</a> 
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>