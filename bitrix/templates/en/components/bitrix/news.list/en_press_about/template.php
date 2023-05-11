<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<table border="0" cellpadding="0" cellspacing="0">
<?foreach($arResult["ITEMS"] as $arItem):?>

<tr><td valign="top" style="text-align: left; border-bottom: 1px solid #c0c0c0; padding-right: 5px;" align="left">
<a class="breadcrumbsPress" href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<?echo $arItem["DISPLAY_ACTIVE_FROM"]?>
		<?endif?>
</a>
<br>
<span class="pressReleaseTitle">
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a><br />
			<?else:?>
				<?echo $arItem["NAME"]?><br />
			<?endif;?>
		<?endif;?>
</span>
<br>
<br>
<? $picturelink = nl2br($arItem['PROPERTIES']['picturelink']['VALUE']); ?>
<? if ($picturelink=="") {} else { ?>
<img src="<?=$picturelink ?>"/>
<br/>
<br/>
<? } ?>
</td>

<td valign="top" style="border-bottom: 1px solid #c0c0c0; padding-top: 10px;">
<span class="pressReleaseAbstract">
<? $content = nl2br($arItem['PROPERTIES']['abstract']['VALUE']['TEXT']); ?>
<? if ($content=="") {} else { ?>
<br /><span class=""><?=$content?></span>
<? } ?>
</span>
<br>
&nbsp;
</td>
</tr>



<?endforeach;?>
</table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
