<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<style type="text/css">
div.team_member img {
    width:auto;
}
div.team_member_about {
    padding:0 0 10px 150px;
}
div.team_member {
color:#000000;
}
</style>
<?foreach($arResult["ITEMS"] as $arItem):?>
<?//print_r($arItem);?>
<?
 $partner_short = $arItem['PREVIEW_TEXT']; // nl2br($arItem['~PREVIEW_TEXT']);
 $partner_site = nl2br($arItem['PROPERTIES']['site']['VALUE']);
 $partner_site_no_www = str_replace("http://www.","",$partner_site);
 $partner_site_no_www = str_replace("http://","",$partner_site);
 $partner_site_no_www = str_replace("/","",$partner_site_no_www);
$partner_site_no_www = $partner_site;
?>
<div class="team_member"><? if (strlen($arItem["PREVIEW_PICTURE"]["SRC"]) > 0) {?><a rel="nofollow" target="_blank" href="<?=$partner_site?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"  title="<?=$arItem["NAME"]?>" /></a><? } else {?><? } ?>
  <h2> <?=$arItem["NAME"]?></h2>




<div class="team_member_about">
  <div><?=$partner_short?><br /><noindex>Сайт: <a target="_blank" rel="nofollow" href="<?=$partner_site?>"><?=$partner_site_no_www?></a></noindex></div>
 </div>
<div class="clear"></div>
</div>


<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

