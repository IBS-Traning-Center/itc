<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if ($arParams["PERMISSION"] >= "W")
{
	// EbK
	$GLOBALS['APPLICATION']->IncludeComponent("bitrix:main.calendar", "", array("SILENT" => "Y"), $component, array("HIDE_ICONS" => "Y"));
}
?><div class="photo-controls photo-action"><?


if (!empty($arResult["SECTION"]["NEW_LINK"])):
	?><a href="<?=$arResult["SECTION"]["NEW_LINK"]?>" title="<?=GetMessage("P_ADD_ALBUM_TITLE")?>"  class="photo-action new-album" <?
	?>onclick="EditAlbum('<?=CUtil::JSEscape($arResult["SECTION"]["~NEW_LINK"])?>'); return false;"<?
	?>><?=GetMessage("P_ADD_ALBUM")?></a><?
endif;

if (!empty($arResult["SECTION"]["UPLOAD_LINK"])):
	?><a href="<?=$arResult["SECTION"]["UPLOAD_LINK"]?>" class="photo-action photo-upload"><?=GetMessage("P_UPLOAD")?></a><?
endif;
?></div><?
?><div class="empty-clear"></div>

<div class="description" id="photo_album_description_<?=$arResult["SECTION"]["ID"]?>"><?=$arResult["SECTION"]["DESCRIPTION"]?></div>

<table cellpadding="0" cellspacing="0" border="1" width="100%" class="photo-album" style="display:none"><?
	?><tr><td width="1%"><?
	?><div class="photo-album-img"><?
		?><?
	?></div><?
	?></td><?
	?><td><?
	?><div class="photo-album-info"><?
	
		?><div class="password" id="photo_album_password_<?=$arResult["SECTION"]["ID"]?>" title="<?=GetMessage("P_PASSWORD")?>" <?
		if (empty($arResult["SECTION"]["PASSWORD"])):
			?>style="display:none;"<?
		endif;
		?>></div><?
		?>
<!--

<div class="name<?=($arResult["SECTION"]["ACTIVE"] != "Y" ? " nonactive" : "")?>" id="photo_album_name_<?=$arResult["SECTION"]["ID"]?>"><?=$arResult["SECTION"]["NAME"]?></div>

-->

<?

	if (!empty($arResult["SECTION"]["PASSWORD"]) && !$arParams["PASSWORD_CHECKED"]):
		?><div class="password-title" style="position:relative;"  title="<?=GetMessage("P_PASSWORD_TITLE")?>"><?
		?><form name="photogallery" method="post" action="<?=POST_FORM_ACTION_URI?>" style="display:none; position:absolute;" id="password_form_<?=$arResult["SECTION"]["ID"]?>"><?
			?><?=bitrix_sessid_post()?><?
			?><input type="password" name="password_<?=$arResult["SECTION"]["ID"]?>" id="password_<?=$arResult["SECTION"]["ID"]?>" value="" /> <input type="submit" name="supply_password" value="<?=GetMessage("P_SUPPLY_PASSWORD")?>"></form><?
			?><a href="javascript:void(0);" onclick="var tt = document.getElementById('password_form_<?=$arResult["SECTION"]["ID"]?>'); tt.style.display = ''; tt.elements[1].focus();"><?=GetMessage("P_PASSWORD")?></a><?
		?></div><?
	endif;
		
		?>




<!--
<div class="photos"><?=GetMessage("P_PHOTOS_CNT")?>: <?=$arResult["SECTION"]["ELEMENTS_CNT"]?></div>
-->
<?
		
		if (intVal($arResult["SECTIONS_CNT"]) > 0):
			?><div class="photo-album-cnt-album"><?=GetMessage("P_ALBUMS_CNT")?>: <?=$arResult["SECTIONS_CNT"]?></div><?
		endif;
	
		?><div class="photo-controls photo-album-controls"><?
		
		if (!empty($arResult["SECTION"]["EDIT_LINK"])):
			?><a href="<?=$arResult["SECTION"]["EDIT_LINK"]?>" class="photo-action album-edit" <?
				?> onclick="EditAlbum('<?=CUtil::JSEscape($arResult["SECTION"]["EDIT_LINK"])?>'); return false;"><?
				?><?=GetMessage("P_SECTION_EDIT")?></a><?
		endif;
	
		if (!empty($arResult["SECTION"]["EDIT_ICON_LINK"])):
			?><a href="<?=$arResult["SECTION"]["EDIT_ICON_LINK"]?>" class="photo-action album-edit-icon" <?
				?>onclick="EditAlbum('<?=CUtil::JSEscape($arResult["SECTION"]["EDIT_ICON_LINK"])?>'); return false;"><?
				?><?=GetMessage("P_EDIT_ICON")?></a><?
		endif;
		
		if (!empty($arResult["SECTION"]["DROP_LINK"])):
			?><a href="<?=$arResult["SECTION"]["DROP_LINK"]?>" class="photo-action album-delete" <?
				?>onclick="return confirm('<?=GetMessage('P_SECTION_DELETE_ASK')?>');"><?
				?><?=GetMessage("P_SECTION_DELETE")?></a><?
		endif;
		
		?></div><?
		
	?></div><?
	?></td></tr><?
?></table>
<div class="empty-clear"></div>