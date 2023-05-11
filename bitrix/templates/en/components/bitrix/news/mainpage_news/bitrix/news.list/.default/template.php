<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>

		   <h3><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></h3>
           <h5><?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<?echo $arItem["DISPLAY_ACTIVE_FROM"]?>
			<?endif?></h5>
			<? $content = strip_tags(nl2br($arItem['PROPERTIES']['abstract']['VALUE']['TEXT'])); ?>
<? if ($content=="") {echo "<br />"; } else { ?>
<p><?=$content?></p>
<? } ?>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>


