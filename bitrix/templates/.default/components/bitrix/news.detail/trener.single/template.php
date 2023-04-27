<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style text="text/css">
div.team_member_about {
	padding:0 0 10px 0px;
}
div.team_member_about  {
	margin:0px;
}
div.indent{
	line-height:140%;
}
</style>
<?
$expert_short = nl2br($arResult['PROPERTIES']['expert_short']['VALUE']);
$expert_name = nl2br($arResult['PROPERTIES']['expert_name']['VALUE']);
$expert_title = nl2br($arResult['PROPERTIES']['expert_title']['VALUE']);
$expert_language = nl2br($arResult['PROPERTIES']['expert_language']['VALUE']);
$expert_area = $arResult['PROPERTIES']['HTML_AREA']['~VALUE']['TEXT'];
$expert_special = $arResult['PROPERTIES']['HTML_SPECIAL']['~VALUE']['TEXT'];
$expert_experience = $arResult['PROPERTIES']['HTML_EXPERIENCE']['~VALUE']['TEXT'];
$expert_teacher =$arResult['PROPERTIES']['HTML_TEACHER']['~VALUE']['TEXT'];
$expert_edu = $arResult['PROPERTIES']['HTML_EDU']['~VALUE']['TEXT'];
$expert_certified = $arResult['PROPERTIES']['HTML_CERTIFIED']['~VALUE']['TEXT'];
$expert_publications = $arResult['PROPERTIES']['HTML_PUBLICATIONS']['~VALUE']['TEXT'];
$expert_social = $arResult['PROPERTIES']['HTML_SOCIAL']['~VALUE']['TEXT'];

if ($arResult['PROPERTIES']['HTML_AREA']['VALUE']['TYPE'] == "text" )
	$expert_area = nl2br($expert_area);
if ($arResult['PROPERTIES']['HTML_SPECIAL']['VALUE']['TYPE'] == "text" )
	$expert_special = nl2br($expert_special);
if ($arResult['PROPERTIES']['HTML_EXPERIENCE']['VALUE']['TYPE'] == "text" )
	$expert_experience = nl2br($expert_experience);
if ($arResult['PROPERTIES']['HTML_TEACHER']['VALUE']['TYPE'] == "text" )
	$expert_teacher = nl2br($expert_teacher);
if ($arResult['PROPERTIES']['HTML_EDU']['VALUE']['TYPE'] == "text" )
	$expert_edu = nl2br($expert_edu);
if ($arResult['PROPERTIES']['HTML_CERTIFIED']['VALUE']['TYPE'] == "text" )
	$expert_certified = nl2br($expert_certified);
if ($arResult['PROPERTIES']['HTML_PUBLICATIONS']['VALUE']['TYPE'] == "text" )
	$expert_publications = nl2br($expert_publications);
if ($arResult['PROPERTIES']['HTML_SOCIAL']['VALUE']['TYPE'] == "text" )
	$expert_social = nl2br($expert_social); 
//iwrite($arResult['PROPERTIES']['expert_featured']);

 //HTML_AREA
 //HTML_SPECIAL
 //HTML_EXPERIENCE
 //HTML_TEACHER
 //HTML_EDU
 //HTML_CERTIFIED
 
$expert_featured = nl2br($arResult['PROPERTIES']['expert_featured']['VALUE']);
$expert_blog = nl2br($arResult['PROPERTIES']['expert_blog']['VALUE']);

if(($_SERVER["REAL_FILE_PATH"] === "/about/experts/detail.html") and ($arResult['PROPERTIES']['expert_featured']['VALUE_ENUM_ID'] !== "75")){
	$vTempURL= str_replace("experts","treners",$_SERVER["REQUEST_URI"]);
	LocalRedirect($vTempURL, false, "301 Moved permanently");
}
if(($_SERVER["REAL_FILE_PATH"] === "/about/treners/detail.html") and ($arResult['PROPERTIES']['expert_featured']['VALUE_ENUM_ID'] === "75")){
	$vTempURL= str_replace("treners","experts",$_SERVER["REQUEST_URI"]);
	LocalRedirect($vTempURL, false, "301 Moved permanently");
}
?>
<?
$APPLICATION->SetTitle("$expert_name");
$APPLICATION->SetPageProperty("blue_title", $arResult["NAME"] ." ". $expert_name);
$APPLICATION->SetPageProperty("title", $arResult["NAME"] ." ". $expert_name." / Эксперты и Тренеры Luxoft Training");

?>
<div class="trener-wrap">
<div class="team_member"  itemscope itemtype="http://data-vocabulary.org/Person">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img itemprop="photo" class="detail_picture" style="max-width:250px; max-height:350px" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"  title="<?=$arResult["NAME"]?>" />
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class=""><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h1><span itemprop="name"><?=$arResult["NAME"]?> <?=$expert_name?></span></h1>
	<?endif;?>
	<meta itemprop="affiliation" content="Luxoft-Training"/>
	<strong ><span itemprop="role"><?=$expert_short?></span></strong>
</div>


<div class="team_member_about">
  <p><?=$arResult['DETAIL_TEXT']?></p>
</div>
<div>
  <?if (strlen($expert_area)>0) {?>
  	<strong>Ключевые области знаний:</strong><div class="indent"><?=$expert_area?></div><br />
  <? } ?>
  <?if (strlen($expert_special)>0) {?>
  	<strong>Специализации:</strong><div class="indent">  <?=$expert_special?></div><br />
  <? } ?>
  <?if (strlen($expert_experience)>0) {?>
  	<strong>Профессиональный опыт:</strong><div class="indent">  <?=$expert_experience?></div><br />
  <? } ?>
  <?if (strlen($expert_teacher)>0) {?>
  	<strong>Преподавательский опыт:</strong><div class="indent"> <?=$expert_teacher?></div><br />
  <? } ?>
  <?if (strlen($expert_edu)>0) {?>
  	<strong>Образование:</strong><div class="indent">  <?=$expert_edu?></div><br />
  <? } ?>
  <?if (strlen($expert_certified)>0) {?>
  	<strong>Курсы, сертификаты:</strong><div class="indent">  <?=$expert_certified?></div><br />
  <? } ?>
  <?if (strlen($expert_publications)>0) {?>
  	<strong>Публикации:</strong><div class="indent">  <?=$expert_publications?></div><br />
  <? } ?>
  <?if (strlen($expert_social)>0) {?>
  	<strong>Социальная сфера:</strong><div class="indent">  <?=$expert_social?></div><br />
  <? } ?>
  <?if (strlen($expert_language)>0) {?>
  	<strong>Англ. язык (уровень владения):</strong><div class="indent">  <?=$expert_language?></div><br />
  <? } ?>
</div>



<?/*
 	<?if(strlen($arResult["DETAIL_TEXT"])>0):?>
		<p><?echo $arResult["DETAIL_TEXT"];?></p>
 	<?else:?>
		<p><?echo $arResult["PREVIEW_TEXT"];?></p>
	<?endif?>
*/?>
</div>


