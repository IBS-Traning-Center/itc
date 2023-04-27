<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?/*
<style>
*{
margin:0;
padding: 0;

}
img {
	border: none;
	
}
div.course-item {
	border-bottom: 1px solid #C7D2D5; 
	margin-bottom: 6px;
}
div.course-item  a {
	color: #0d44a0;
	
	
}
div.course-item .course-name {
	
	margin-bottom: 12px;
}

.softwidget-wrap {
	background-color: white;
	font-family: Arial,Helvetica,sans-serif;
	position: relative;
	width: 200px;
	

}
.widget-head {
	color: #701132;
	font-weight: bold;
	margin-bottom: 6px;
}
.widget-head a {
	text-decoration: none;
	color: #AD2827;
}

.date-of-course {
	float: left;
	color: #8A8A8A;
	font-size: 10px;
}
.cours-list {
	
}
.link-abs-wrap a {
	color: #0d44a0;
	font-size: 11px;
	text-decoration: underline;
}
.link-abs-wrap div {
	margin-bottom: 3px;
}
.abs-logo-link {
	position: absolute;
	bottom: 11px;
	right: 12px;
	width: 104px;
	height: 53px;
}
.link_to_all {
    background: url("/images/g_arrow.png") no-repeat scroll right 70% transparent;
    text-align: right;
    padding-right: 10px;
}
.link_to_all a:link, .link_to_all a:visited{
    color:#888888;
}
.discount {
	
	font-size: 12px;
	color: #AD2827;
	float: right;
	text-align: right;
}
.discount a {
	color: #AD2827 !important;
}
.info-hidden {
	
	display: none;
	position: absolute;
	bottom: -32px;
	right: 0px;
	background: white;
	color: #0d44a0;
	width: 150px;
	padding: 5px;
	font-size: 10px;
}
.show-hidden {
	position: relative;
}
.show-hidden span{
	border-bottom: 1px dotted #AD2827;
}
.cluetip-default {
	background: white !important;
	text-align: left !important;
}
.cluetip-default #cluetip-outer {
	background: white !important;
	border: 1px solid #CCC;
}
</style>
*/?>
<div class="softwidget-wrap">
<div class="widget-head">Ближайшие курсы</div>


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
				<a target="_blank" href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
			<?else:?>
				<b><?echo $arItem["NAME"]?></b>
			<?endif;?>
		<?endif;?>
		</div>
		<div class="date-of-course">
		<?if ($arItem["PROPERTIES"]["startdate"]["VALUE"]) {?>
			<?=$arItem["PROPERTIES"]["startdate"]["VALUE"]?><?}?><?if ($arResult["MULTI_CITY"]=="Y"){?>, <?=$arItem["PROPERTIES"]["city"]["TEXT"]?><?}?>
		</div>
		<?if (intval($arItem["DISCOUNT"])>0) {?>
			<?if ($arItem["DISCOUNT_TYPE"]=="P") {?>
			<div class="discount">
				<?if (intval($arItem['ID'])==47767) {?>
					<div class="show-hidden" title="|Тренер – Светлана Шмелева, преподаватель Гарвардской школы бизнеса. Данный курс – дебют для тренера в Luxoft Training. Приглашаем Вас на его пилотный курс!"><span>Пилотный курс</span>
					
						
					
					</div>
				<?}?>
				Скидка <?=$arItem["DISCOUNT"]?>%
			</div>
			<?} else {?>
			<div class="discount" style="font-size: 11px;">
				 Спец. цена <?=$arItem["PRICE"]["DISCOUNT_PRICE"]?> р.
			</div>
			<?}?>
		<?}?>
		<?if (intval($arItem['ID'])==51104) {?>
			<div class="discount">
			Спец. цена - 10 000 руб.
			</div>
		<?}?>
		
		<div style="clear:both"></div>
	</div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
<div class="link_to_all" ><a href="/timetable/">Полное расписание</a></div>
</div>
<script>

$(document).ready(function() {
	$('.show-hidden').cluetip({splitTitle: '|', showTitle: false});
})

</script>
