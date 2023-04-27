<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//iwrite($arParams);
?>

<? if (count($arResult['POSTS'])>0){?>
<div class="floated_right" style="background:#EFF3FF; float:none; margin:0 0 10px 5px;">

	<h2 style="color: #8596BD;">Последние записи в блоге</h2>
	<blockquote style="margin:0 0 0 0px">
	<ul>
<?
foreach ($arResult['POSTS'] as $arPost){?>


	<li><a href="/blog/<?=$arPost['URL']?>/<?=$arPost['ID']?>.html" rel="nofollow" target="_blank"><?=$arPost['NAME']?>, <?=$arPost['DATE_PUBLISH']?></a></li>
<?
}
?>
</ul>
</blockquote>
<div class="" style="text-align:right;">
<a href="/blog/<?=$arPost['URL']?>/rss/"><img src="/bitrix/templates/.default/components/bitrix/blog/.default/images/rss_icon.gif" border="0" /></a>
</div>
</div>

<? } ?>