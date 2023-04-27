<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style>
.cal-news-item{
color:#555555;
font-size:12px;
    border-bottom: 1px solid #B7DDF2;
    margin-bottom: 10px;
    padding-bottom: 10px;

}
.cal-date-time{
color: #454545;
font-size:13px;
display:block;
margin:4px 0px 4px 0px;
font-weight: bold;

}
</style>

<div class="cal-news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
<?//iwrite($arItem['PROPERTIES']['EVENT_LINKS']);
?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="cal-news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<span class="cal-date-time"><?=$arItem['PROPERTIES']['EVENT_YEAR']['VALUE']?> г.:</span>
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>

		<img class="image_left_m bradius5" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="" title="" />

		<?endif?>
		
			
		
<div style="overflow:hidden;">
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<?echo $arItem["PREVIEW_TEXT"];?>
		<?endif;?>
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<div style="clear:both"></div>
		<?endif?>
<noindex>
<?if ((is_array($arItem['PROPERTIES']['EVENT_LINKS']['VALUE'])) and (is_array($arItem['PROPERTIES']['EVENT_LINKS']['~DESCRIPTION']))){
	$index = 0;
	foreach ($arItem['PROPERTIES']['EVENT_LINKS']['DESCRIPTION'] as $vDesc){?>
		<div class="links"><a rel="nofollow" href="<?=$arItem['PROPERTIES']['EVENT_LINKS']['~VALUE'][$index]?>"><?=$vDesc?></a></div>
		<? $index = $index + 1; 
		}
} 
?>
</noindex>
</div>
<div class="clear"></div>
	</div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
