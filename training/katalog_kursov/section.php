<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
LocalRedirect("/catalog/direction/" . $_REQUEST['SECTION_CODE'] . "/");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle(" ");
$APPLICATION->SetPageProperty("SHOW_BOTTOM_MAP", "Y");
$APPLICATION->SetPageProperty("SHOW_FULL_PAGE", "Y");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_after.php");
?><?$APPLICATION->IncludeComponent(
	"luxoft:super.component",
	"info.courses.bysection",
	Array(
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600",
		"ID_IBLOCK" => 94,
		"SORT_BY"   => "SORT",
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
    $arFilter = Array('IBLOCK_ID'=>94, "CODE"=>$_REQUEST["SECTION_CODE"]);
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
<link href="/bitrix/ext/tabs/templates/.default/style.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/static/js/section.js"></script>
<div class="bg-main-wrap" style="background: url('/static/images/singe.jpg') center 0; background-size: cover;">
		<div class="frame">
			<?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"bread",
	Array(
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "s1"
	)
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
<?
$banner_type = "ON_MAIN";
$page_url = $APPLICATION->GetCurDir();

  if(strpos($page_url,'upravlenie_proektami_razrabotki_po') !== false || strpos($page_url,'kursy-po-poduktam-atlassian') !== false){
    $banner_type = "ONLY_FOR_CAT_83005_5723";
  }
?>
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
);?></section>
<?if ($_REQUEST["SECTION_CODE"]=="uspeshnyy_rekrutment") {?>
<?LocalRedirect("/training/katalog_kursov/", false, "301 Moved permanently");?>
<?}?>
<div class="not-main-page gray">
    <div class="frame no-top-padding">
    <?if ($_REQUEST["SECTION_CODE"]!="upravlencheskaya_effektivnost_i_kommunikatsii") {?>
    <?
        $section=$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "course-section-list-new", array(
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
        <?//?>
    <?}?>
    </div>
</div>
<style>
    .section-box._callback-mini-background {
        padding: 0;
    }
    .section-box._callback-mini-background .section-box__container {
        transform: scale(0.7);
    }
</style>
<section class="section-box _callback-mini-background">
    <div class="section-box__container container">
        <div class="section-box__header">
            <div class="section-box__title _white"><b>Ищете нестандартное решение?</b><br>
                Наши эксперты помогут!</div>
        </div>
        <div class="section-box__content">
            <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH.'/include/callback-mini.php', [], ['MODE' => 'html']);?>
        </div>
    </div>
</section>
<?
/*
$APPLICATION->IncludeComponent(
	"luxoft:super.component",
	"section-items-list",
	Array(
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"ID_IBLOCK" => "94",
		"SECTION_CODE" => $_REQUEST['SECTION_CODE'],
		"SORT_BY" => "SORT",
		"SORT_ORDER" => "DESC"
	)
);*/?>
<?GLOBAL $META_DESCR;
if (strlen($META_DESCR)>0) {
	$APPLICATION->SetPageProperty("description", $META_DESCR);
}?>
<?if (strlen($arSectioninfo[0]["UF_META"])>0) {?>
		<?$APPLICATION->SetPageProperty("description", $arSectioninfo[0]["UF_META"]);?>
	<?} else {?>
		<?$APPLICATION->SetPageProperty("description", HTMLToTxt($arSectioninfo[0]["DESCRIPTION"]));?>
	<?}?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
