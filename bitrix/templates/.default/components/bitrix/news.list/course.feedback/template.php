<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="">

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?/*
	<p>
		<strong>
			<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
				<span class="client_name"><?echo $arItem["NAME"]?></span>
			<?endif;?>
			<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
				<span><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
			<?endif?>
		</strong>
	</p>
	*/?>
	<p class="no_padding">
	<?if (($arItem["PROPERTIES"]["client"]["VALUE"] == D_DIFF_ELEMENT_PRIVATEMAN)
		or	($arItem["PROPERTIES"]["client"]["VALUE"] == "")) {?>

		<?if (strlen($arItem["PROPERTIES"]["surname"]["VALUE"])>0) {?>
			<strong><?=$arItem["PROPERTIES"]["surname"]["VALUE"]?> <?=$arItem["PROPERTIES"]["name"]["VALUE"]?>:</strong><br />
		<? } else {?>
			<strong>Участник тренинга: </strong><br />
		<? } ?>
	<? } else { ?>
		Компания <strong><?=$arResult['CLIENTS'][$arItem['ID']]['NAME']?></strong>
		<?if (strlen($arResult['CLIENTS'][$arItem['ID']]['CITY'])>0){?>
			(<?=$arResult['CLIENTS'][$arItem['ID']]['CITY']?>)
		<? } ?>:
		<br />
	<? } ?>
	</p>
	<div class="site_quote">
		<?=nl2br($arItem["PROPERTIES"]["review"]["VALUE"]);?>
	</div>
<?endforeach;?>
</div>


