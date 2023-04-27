<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle(" ");
$APPLICATION->SetPageProperty("SHOW_BOTTOM_MAP", "Y");
$APPLICATION->SetPageProperty("SHOW_FULL_PAGE", "Y");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_after.php");
?>
<?$APPLICATION->IncludeComponent(
    "luxoft:super.component",
    "info.courses.bysection",
    Array(
        "CACHE_TYPE" => "N",
        "CACHE_TIME" => "3600",
        "ID_IBLOCK"=>49,
        "SECTION_CODE" => "{$_REQUEST['SECTION_CODE']}"
    )
);?>

<?
$cache = new CPHPCache();
$cache_time = 3600;
$cache_id = 'arSectionkListID'.$_REQUEST["SECTION_CODE"];
$cache_path = '/arSectionListID/';
if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path))
{
    $res = $cache->GetVars();
    if (is_array($res["Sectioninfo"]) && (count($res["Sectioninfo"]) > 0))
        $arSectioninfo = $res["Sectioninfo"];
}
if (!is_array($arSectioninfo))
{
    $arFilter = Array('IBLOCK_ID'=>49, "CODE"=>$_REQUEST["SECTION_CODE"]);
    //print_r($arFilter);
    $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true, array("NAME", "DESCRIPTION", "PICTURE", "UF_*"));


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
}?>
<div class="bg-main-wrap" style="background: url('/static/images/singe.jpg') center 0; background-size: cover;">
		<div class="frame">
			<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "bread", Array(
				"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
					"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
					"SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
				),
				false
			);?>
			<div class="clearfix heading-white">
				<h1><?=$arSectioninfo[0]["NAME"]?></h1>
				<div class="catalog-info-links">
                    <?php $randomString = \Bitrix\Main\Security\Random::getString(10);?>
					<a href="/files/ibs-training-catalog.pdf?=<?=$randomString?>"><i class="fa fa-book" aria-hidden="true"></i> Скачать каталог</a>
					<?/*<a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Скачать прайс</a>*/?>
				</div>
			</div>
			<div class="heading-text">
				<?=$arSectioninfo[0]["DESCRIPTION"]?>
			</div>
		</div>
</div>
<section id="banner" class="banner-main-page">
    <?$APPLICATION->IncludeComponent(
        "bitrix:advertising.banner",
        ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "TYPE" => "ON_MAIN",
            "NOINDEX" => "Y",
            "QUANTITY" => "1",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "0"
        ),
        false
    );?>
</section>
<?if ($_REQUEST["SECTION_CODE"]=="uspeshnyy_rekrutment") {?>
<?LocalRedirect("/training/katalog_kursov/", false, "301 Moved permanently");?>
<?}?>

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
	<?//?>
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
<?if (strlen($arSectioninfo[0]["UF_META"])>0) {?>
		<?$APPLICATION->SetPageProperty("description", $arSectioninfo[0]["UF_META"]);?>
	<?} else {?>
		<?$APPLICATION->SetPageProperty("description", HTMLToTxt($arSectioninfo[0]["DESCRIPTION"]));?>
	<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>