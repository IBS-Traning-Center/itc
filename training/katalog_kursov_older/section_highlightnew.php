<?$APPLICATION->IncludeComponent(
    "luxoft:super.component",
    "info.courses.bysection",
    Array(
        "CACHE_TYPE" => "N",
        "CACHE_TIME" => "3600",
        "ID_IBLOCK"=> 94,
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
}

?>
<div class="hightlight-area">
    <h2><?=$arSectioninfo[0]["NAME"]?></h2>
    <div class="descript"><?=$arSectioninfo[0]["DESCRIPTION"]?></div>
</div>

	<?//print_r($arSectioninfo[0]["UF_H_TITLE"]);?>
	<?if (strlen($arSectioninfo[0]["UF_H_TITLE"])>0) {?>
		<?$APPLICATION->SetPageProperty("blue_title", $arSectioninfo[0]["UF_H_TITLE"]);?>
		<?$APPLICATION->SetPageProperty("title", $arSectioninfo[0]["UF_H_TITLE"]);?>
	<?} else {?>
		<?$APPLICATION->SetPageProperty("title", $ar_result["NAME"]);?>
	<?}?>
	<?if (strlen($arSectioninfo[0]["UF_META"])>0) {?>
		<?$APPLICATION->SetPageProperty("description", $arSectioninfo[0]["UF_META"]);?>
	<?} else {?>
		<?$APPLICATION->SetPageProperty("description", $arSectioninfo[0]["DESCRIPTION"]);?>
	<?}?>