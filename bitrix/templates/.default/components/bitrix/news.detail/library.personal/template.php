<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="">
	
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h2><?=$arResult["NAME"]?></h2>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	

	<?if ($arResult["PROPERTIES"]["DESC"]['VALUE']){?>
		<span class="st">Описание:</span>
		<p class="indent"><?=$arResult["PROPERTIES"]["DESC"]['VALUE']?></p>
	<? } ?>
	<?if ($arResult["PROPERTIES"]["AUTHOR"]['VALUE']){?>
		<span class="st">Автор:</span>
		<p class="indent"><?=$arResult["PROPERTIES"]["AUTHOR"]['VALUE']?></p>
	<? } ?>	

	<?if (in_array("144", $arResult["PROPERTIES"]["IS_TYPE"]['VALUE_ENUM_ID'])) {?>
		<?foreach ($arResult["PROPERTIES"]["YOUTUBE_ID"]['VALUE'] as $key => $value){?>
			<? if ($arResult["PROPERTIES"]["YOUTUBE_ID"]['DESCRIPTION'][$key]){?>
			<p class="indent"><br /><?=$arResult["PROPERTIES"]["YOUTUBE_ID"]['DESCRIPTION'][$key]?>
			<? } ?>
			<iframe width="515" height="370" src="https://www.youtube.com/embed/<?=$value?>?rel=0" frameborder="0" allowfullscreen></iframe><br />
			</p>
		<? } ?>
	<? } ?>

	<?if (in_array("146", $arResult["PROPERTIES"]["IS_TYPE"]['VALUE_ENUM_ID'])) {?>
	<?if ($arResult["PROPERTIES"]["FILES"]['VALUE']){?><span class="st">Скачать файл:</span><? } ?>
	<?//iwrite($arResult["PROPERTIES"]["FILES"]);?>
		<?foreach ($arResult["PROPERTIES"]["FILES"]['VALUE'] as $key => $value){?>
			<p class="indent"><img width="16" border="0" alt="" src="/downloads/images/social/icon_pdf.gif"> <a href="<?=CFile::GetPath($value)?>"><?if ($arResult["PROPERTIES"]["FILES"]['DESCRIPTION'][$key]){?><?=$arResult["PROPERTIES"]["FILES"]['DESCRIPTION'][$key]?><?} else {?>Загрузить файл<? } ?></p>
		<? } ?>
	<? } ?>	

	<?if (in_array("145", $arResult["PROPERTIES"]["IS_TYPE"]['VALUE_ENUM_ID'])) {?>
	<?if ($arResult["PROPERTIES"]["LINKS"]['VALUE']){?><span class="st">Ссылки:</span><? } ?>
	<?//iwrite($arResult["PROPERTIES"]["LINKS"]);?>
		<?foreach ($arResult["PROPERTIES"]["LINKS"]['VALUE'] as $key => $value){?>
			<p class="indent"><a href="<?=$value?>"><?if ($arResult["PROPERTIES"]["LINKS"]['DESCRIPTION'][$key]){?><?=$arResult["PROPERTIES"]["LINKS"]['DESCRIPTION'][$key]?><?} else {?>Ссылка<? } ?></p>
		<? } ?>
	<? } ?>
	
</div>
