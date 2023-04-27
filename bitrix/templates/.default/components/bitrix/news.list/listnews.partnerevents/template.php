<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<div id="news_output">
<table cellspacing="0" cellpadding="0" border="0">
	<tbody>
<?foreach($arResult["ITEMS"] as $arItem):?>
<?
//iwrite($arItem["PROPERTIES"]["GO_LINK"]);
$flagNofollow = false;
$isPDF = false;
if (($arItem["PROPERTIES"]["GO_LINK"]["VALUE_ENUM_ID"] == 132) and
 (strlen($arItem["PROPERTIES"]["SOURCE_URL"]["VALUE"])>0)) {
	$arItem["DETAIL_PAGE_URL"] = $arItem["PROPERTIES"]["SOURCE_URL"]["VALUE"];
	$flagNofollow = true;
}
if (($arItem["PROPERTIES"]["IS_PDF"]["VALUE_ENUM_ID"] == 137) and
 (strlen($arItem["PROPERTIES"]["SOURCE_URL"]["VALUE"]) == 0)) {
	$isPDF = true;
}

?>
<tr >
	<td valign="top"  width="22%" style="border-bottom: #A6A6A6 1px solid; margin:0px 0px 5px 0px;">
	<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
<? echo "<h4>".$arItem["DISPLAY_ACTIVE_FROM"]."</h4>";?><?endif ?>
	</td>

<td width="78%" valign="top" style="border-bottom: #A6A6A6 1px solid; margin:0px 0px 5px 0px; vertical-align:top;">
<? if (strlen($arItem["PREVIEW_PICTURE"]["SRC"]) > 0) {?>
<div class="item_pict">
	<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
	<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"  title="<?=$arItem["NAME"]?>"  /></a>
</div>
<? } ?>


<p>
<?if (strlen($arItem["PROPERTIES"]["SOURCE_NAME"]["VALUE"])>0) {?>
	<strong><?=$arItem["PROPERTIES"]["SOURCE_NAME"]["VALUE"];?></strong> <br />
<? } ?>
<a <?if ($flagNofollow) {?>rel="nofollow"  target="_blank" class="" <? } ?> href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
<span class="nobr">
<?if ($flagNofollow) {?>
 <img border="0" src="/images/icon/bg-author-link.gif" alt=""/>
<? } ?>
<?if ($arItem["PROPERTIES"]["YOUTUBE_ID"]["VALUE"]) {?>
 <img border="0" width="16" src="/downloads/images/social/t_youtube.png" alt=""/>
<? } ?>
<?if ($isPDF) {?>
 <img border="0" width="16" src="/images/icon/icon_pdf.gif" alt=""/>
<? } ?>

</span> 
</p>
<?
   $content = $arItem['PREVIEW_TEXT'];
?>
<? if ($content=="") {  } else { ?>
<p><?=$content?></p>
<? } ?>
<br />
</td>
</tr>

<?endforeach;?>

	</tbody>
</table>
</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>