<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<style>
body{
margin:0;
padding: 0;
}
div.course-item 
{
	font-family: Arial,Helvetica,sans-serif;
	font-size: 13px;
	margin-bottom: 10px;
}
div.course-item  a {
	color: #0d44a0;
	text-decoration: underline;
}
div.course-item .course-name {
	margin-bottom: 5px;
}
.date-of-course{
	font-size: 11px;
}

</style>
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
				<a target="_blank" href="<?echo $arItem["DETAIL_PAGE_URL"]?>&seo=Y&r1=ya&r2=vidget&r3=schedule#tab-record-link"><?echo $arItem["NAME"]?></a>
			<?else:?>
				<b><?echo $arItem["NAME"]?></b>
			<?endif;?>
		<?endif;?>
		</div>
		<div class="date-of-course">
		<?if ($arItem["PROPERTIES"]["startdate"]["VALUE"]) {?>
			<?=$arItem["PROPERTIES"]["startdate"]["VALUE"]?><?}?><?if ($arResult["MULTI_CITY"]=="Y"){?>, <?=$arItem["PROPERTIES"]["city"]["TEXT"]?>,<?}?><?if ($arItem["PROPERTIES"]["LINK_DISCOUNT"]["VALUE"]>0) {?> скидка <?=$arItem["PROPERTIES"]["LINK_DISCOUNT"]["VALUE"]?>%<?}?>
		</div>
	</div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
