<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<div class="part">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img  class="part_img" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["NAME"]?>" /></a>
			<?else:?>
				<img class="part_img" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["NAME"]?>" />
			<?endif;?>
		<?endif?>
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<div class="date">
<?//echo $arItem["PROPERTIES"]["EVENT_DATE"]["VALUE"]
echo  $arItem["DISPLAY_ACTIVE_FROM"];
?>
</div>
		<?endif?>
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<div class="name_conf"><?echo $arItem["NAME"]?></div>
			<?else:?>
				<div class="name_conf"><?echo $arItem["NAME"]?></div>
			<?endif;?>
		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<div class="part_content"><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
			<?echo $arItem["PREVIEW_TEXT"];?></a></div>
		<?endif;?>

		<? if ((strlen($arItem["PROPERTIES"]["SERVICE_ID"]["VALUE"])>0) and
		 (ConvertDateTime($arItem["PROPERTIES"]["EVENT_DATE"]["VALUE"], "YYYY-MM-DD") > date("Y-m-d") )){?>

			<div class="part_content">
<p class="more"><img width="24" height="24"  style="position:relative;top:7px;" border="0" alt="" src="http://www.luxoft-training.ru/images_edu/diffs/basket_put.png"> <b><a href="/services/index.php?action=BUY&ID=<?=$arItem["PROPERTIES"]["SERVICE_ID"]["VALUE"]?>">Оплатить участие</a></b></p>
</div>
		<?} ?>
	</div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

