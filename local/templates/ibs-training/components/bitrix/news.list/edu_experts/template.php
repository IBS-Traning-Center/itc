<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

<?foreach($arResult["ITEMS"] as $arItem):?>
<?//print_r($arItem);?>
<?
 $expert_short = $arItem['~DETAIL_TEXT']; // nl2br($arItem['PROPERTIES']['expert_short']['VALUE']);
 $expert_name = nl2br($arItem['PROPERTIES']['expert_name']['VALUE']);
 $expert_title = nl2br($arItem['PROPERTIES']['expert_title']['VALUE']);
?>
<div class="team_member"><? if (strlen($arItem["PREVIEW_PICTURE"]["SRC"]) > 0) {?><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"  title="<?=$arItem["NAME"]?>" width="50" /><? } else {?><? } ?>
  <h2><?=$expert_name?> <?=$arItem["NAME"]?></h2>
 <?=$expert_title?></div>

<div class="clear"></div>
 <?if ($USER->IsAdmin()) { ?>
			<style type="text/css">
			#two_blocks img.admin {
			height:15px;
			padding:0px 0px 0px 0px;
			width:15px;
			}
			</style>
 <div id="block_edit<? echo rand(); ?>" style="margin:0px; padding:0px;  class="popupitem" onclick="jsPopup.ShowDialog('/bitrix/admin/iblock_element_edit.php?type=edu&lang=en&IBLOCK_ID=<?=$arResult[ID]?>&ID=<?=$arItem[ID]?>&filter_section=&return_url=%2F&bxpublic=Y&from_module=iblock', {'width':'700', 'height':'500', 'resize':false })"><img class="admin" src="/images/index/label_edit.jpg" width="15px" height="15px" alt="click me for edit" border="0"></div><? } ?>

<div class="team_member_about">
  <p><?=$expert_short?></p>
 </div>


<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

