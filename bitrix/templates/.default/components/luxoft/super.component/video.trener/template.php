<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//iwrite($arResult);
?>

<? if (count($arResult['VIDEO_URLS'])>0){?>
<div class="floated_right" style="background:#EFF3FF; float:none; margin:0 0 10px 5px;">

	<h2 style="color: #8596BD;">Записи выступлений</h2>
	<blockquote style="margin:0 0 0 0px">
	<ul>
<?
foreach ($arResult['VIDEO_URLS'] as $arFieldsUrls){?>


	<li><a href="<?=$arFieldsUrls['PROPERTY_URL_VALUE']?>" rel="nofollow" target="_blank"><?=$arFieldsUrls['NAME']?></a></li>
<?
}
?>
</ul>
</blockquote>
</div>
<? } ?>


