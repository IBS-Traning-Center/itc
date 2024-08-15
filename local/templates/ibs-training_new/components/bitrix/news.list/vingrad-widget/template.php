<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<style>
*{
margin:0;
padding: 0;
}
img {
	border: none;
}
div.course-item 
{
	
	font-size: 11px;
	margin-bottom: 7px;
	line-height: 1.3;
	
}
div.course-item  a {
	color: #fff;
	text-decoration: underline;
	
}
div.course-item .course-name {
	margin-bottom: 3px;
}
.date-of-course{
	text-align: right;
	font-size: 10px;
	color: #fff;
}
.softwidget-wrap {
	font-family: Arial,Helvetica,sans-serif ;
	position: relative;
	padding: 8px;
	width: 222px;
	height: 482px;
	border: 1px solid #9D9E9E;
	background: url('/images/snippets/vingrad-bg.png') no-repeat;
}
.widget-head {
	
	color: #ffca65;
	font-size: 25px;
	margin-bottom: 13px;
}
.widget-head a {
	text-decoration: none;
	color: #ffca65;
}
.link-abs-wrap {
	position: absolute;
	bottom: 5px;
	left: 5px;
	width: 100%;
	
}
.cours-list {
	height: 346px; 
	overflow: hidden;
}
.link-abs-wrap a {
	color: #ffca65;
	font-size: 11px;
	text-decoration: underline;
}
.link-abs-wrap div {
	margin-bottom: 10px;
}
.abs-logo-link {
	position: absolute;
	bottom: 11px;
	right: 12px;
	width: 104px;
	height: 53px;
}
</style>
<div class="softwidget-wrap">
<div class="widget-head"><a target="_blank" href="http://ibs-training.ru/timetable/?r1=vingrad&r2=widget">Курсы<br/> <span style="white-space:nowrap">по разработке ПО</span></a></div>
<div class="link-abs-wrap">
	<div><a target="_blank" href="http://ibs-training.ru/timetable/?r1=vingrad&r2=widget">РАСПИСАНИЕ</a></div>
	<div><a target="_blank" href="http://ibs-training.ru/training/catalog_directions/?r1=vingrad&r2=widget">КАТАЛОГ КУРСОВ</a></div>
</div>
<div class="abs-logo-link">
	<a target="_blank"  href="http://ibs-training.ru/?r1=vingrad&r2=widget"><img src="/images/snippets/lg-white.png" width="103" height="54"/></a>
</div>
<div class="cours-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="course-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		
		<div class="course-name">
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a target="_blank" href="<?echo $arItem["DETAIL_PAGE_URL"]?>&r1=vingrad&r2=widget#tab-record-link"><?echo $arItem["NAME"]?></a>
			<?else:?>
				<b><?echo $arItem["NAME"]?></b>
			<?endif;?>
		<?endif;?>
		</div>
		<div class="date-of-course">
		<?if ($arItem["PROPERTIES"]["startdate"]["VALUE"]) {?>
			<?=$arItem["PROPERTIES"]["startdate"]["VALUE"]?><?}?><?if ($arResult["MULTI_CITY"]=="Y"){?>, <?=$arItem["PROPERTIES"]["city"]["TEXT"]?><?}?>
		</div>
	</div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
</div>
