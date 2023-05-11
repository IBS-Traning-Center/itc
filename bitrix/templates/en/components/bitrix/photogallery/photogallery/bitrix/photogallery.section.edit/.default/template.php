<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if ($arParams["AJAX_CALL"] == "Y"):
	$APPLICATION->RestartBuffer();
endif;

?><div class="photo-window-edit" id="photo_section_edit_form"><?

?><form method="post" action="<?=POST_FORM_ACTION_URI?>" name="form_photo" id="form_photo" onsubmit="return CheckForm(this);"><?
	?><input type="hidden" name="save_edit" value="Y" /><?
	?><input type="hidden" name="edit" value="Y" /><?
	?><input type="hidden" name="sessid" value="<?=bitrix_sessid()?>" /><?
	?><input type="hidden" name="IBLOCK_SECTION_ID" value="<?=$arResult["FORM"]["IBLOCK_SECTION_ID"]?>" /><?

?><table cellpadding="0" cellspacing="0" border="0">
	<tr><td class="table-body"><?
	?><div class="inner"><?
	
	ShowError($arResult["ERROR_MESSAGE"]);

if ($arParams["ACTION"] == "CHANGE_ICON"):
	?><?
else:
	?><div class="photo-album-head name"><font class="starrequired">*</font><?=GetMessage("P_ALBUM_NAME")?>: <br /><?
		?><input type="text" name="NAME" value="<?=$arResult["FORM"]["NAME"]?>" /><?
	?></div><?
	?><div class="photo-album-head date"><?=GetMessage("P_ALBUM_DATE")?>: <br /><?
$APPLICATION->IncludeComponent(
	"bitrix:system.field.edit", 
	$arResult["FORM"]["~DATE"]["USER_TYPE"]["USER_TYPE_ID"], 
	array(
		"bVarsFromForm" => $arResult["bVarsFromForm"], 
		"arUserField" => $arResult["FORM"]["~DATE"], 
		"form_name" => "form_photo"), 
		null, 
		array("HIDE_ICONS"=>"Y"));
	?></div><?
	?><div class="photo-album-head description"><?=GetMessage("P_ALBUM_DESCRIPTION")?>: <br /><?
		?><textarea name="DESCRIPTION" rows="5"><?=$arResult["FORM"]["DESCRIPTION"]?></textarea><?
	?></div><?
	
	?><div class="photo-album-head password" id="section_password"><?
	if (!empty($arResult["FORM"]["~PASSWORD"]["VALUE"])):
		?><input type="checkbox" id="USE_PASSWORD" name="USE_PASSWORD" id="USE_PASSWORD" value="Y" onclick="document.getElementById('DROP_PASSWORD').value = this.checked ? 'N' : 'Y';" checked="checked" /><?
		?><label for="USE_PASSWORD"><?=GetMessage("P_SET_PASSWORD")?></label><?
		?><input type="hidden" id="DROP_PASSWORD" name="DROP_PASSWORD" id="DROP_PASSWORD" value="N"><?
	else:
		?><input type="checkbox" id="USE_PASSWORD" name="USE_PASSWORD" id="USE_PASSWORD" value="Y" onclick="document.getElementById('PHOTO_PASSWORD').disabled = !this.checked;" /><?
		?><label for="USE_PASSWORD"><?=GetMessage("P_SET_PASSWORD")?></label><?
		?><div class="photo-album-head password" style="padding-left:10px;"><?
		?><?=GetMessage("P_PASSWORD")?>:<br /><?
		?><input type="password" name="PASSWORD" id="PHOTO_PASSWORD" value="" disabled="disabled" /><?
		?></div><?
	endif;
	?></div><?
endif;
	?></div><?
	?></td></tr><?
	?><tr><td class="table-controls"><?
		?><input type="submit" name="name_submit" value="<?=GetMessage("P_SUBMIT");?>" /><?
		?><input type="button" name="name_cancel" value="<?=GetMessage("P_CANCEL");?>" onclick="CancelSubmit(this)" /><?
	?></td></tr><?
?></table><?
?></form><?
?></div><?
if ($arParams["AJAX_CALL"] == "Y"):
	$APPLICATION->ShowHeadScripts();
	$APPLICATION->ShowHeadStrings();
	die();
else:
?><script>
function CancelSubmit(pointer)
{
	if (pointer.form)
	{
		pointer.form.edit.value = 'cancel'; 
		pointer.form.submit();
	}
	return false;
}
function CheckForm()
{
	return true;
}
</script><?
endif;
?>