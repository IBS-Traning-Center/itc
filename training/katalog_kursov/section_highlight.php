<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
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

<?if (strlen($arSectioninfo[0]["DESCRIPTION"])>0) {?>

<div class="headline_image">
<?if (intval($arSectioninfo[0]["PICTURE"])>0) {?>
	<?$arFile = CFile::GetFileArray($arSectioninfo[0]["PICTURE"]);?>
 <img src="<?=$arFile["SRC"]?>" alt="" title=""> 
<?}?>
<p style="padding-right:0;">
<?=$arSectioninfo[0]["DESCRIPTION"]?>
 </p>
</div>
<?
GLOBAL $META_DESCR;
$META_DESCR=$arSectioninfo[0]["UF_META"];
if (strlen($META_DESCR)>0) {
	$APPLICATION->SetPageProperty("description", $META_DESCR);
}
?>
<?
}?>
<?if (intval($arSectioninfo[0]["UF_EXPERT"])>0 ) {?>
	<?$res = CIBlockElement::GetByID($arSectioninfo[0]["UF_EXPERT"]);
	if($ob = $res->GetNextElement()) {
		$arExpert=$ob->GetFields();
		$arExpert["DETAIL_PICTURE"]=CFile::GetFileArray($arExpert['DETAIL_PICTURE']);
		$arExpert["PROPERTIES"]=$ob->GetProperties();
		$obParser = new CTextParser;
		$arExpert["DETAIL_TEXT"] = $obParser->html_cut($arExpert["DETAIL_TEXT"], 470);
		
	}
	/*if ($USER->IsAdmin()) {
				print_r($arExpert);
			}*/
	?>
	<h2 style="margin-bottom: 10px;">Эксперт направления</h2>
	<div>
		<img style="margin-right: 10px; float: left;" src="<?=$arExpert["DETAIL_PICTURE"]["SRC"]?>" height="<?=$arExpert["DETAIL_PICTURE"]["HEIGHT"]?>" width="<?=$arExpert["DETAIL_PICTURE"]["WIDTH"]?>"/>
		<b><a href="/about/experts/<?=$arExpert["CODE"]?>.html"><?=$arExpert["NAME"]?> <?=$arExpert["PROPERTIES"]["expert_name"]["VALUE"]?></a></b><br/>
		<p><?=$arExpert["DETAIL_TEXT"]?></p>
		<div style="clear:both"></div>
	</div>
<?}?>


