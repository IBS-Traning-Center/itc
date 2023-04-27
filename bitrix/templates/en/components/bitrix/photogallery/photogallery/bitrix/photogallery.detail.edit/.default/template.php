<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/*************************************************************************
	Processing of received parameters
*************************************************************************/
$arParams["SHOW_TAGS"] = ($arParams["SHOW_TAGS"] == "Y" ? "Y" : "N");
$arResult["SHOW_TAGS"] = (($arResult["SHOW_TAGS"] == "Y" && $arParams["SHOW_TAGS"] == "Y") ? "Y" : "N");
/*************************************************************************
	/Processing of received parameters
*************************************************************************/

if ($arParams["AJAX_CALL"] == "Y"):
	$APPLICATION->RestartBuffer();
else:
	?><div class="photo-controls"><?
	if (!empty($arResult["DETAIL_LINK"])):
		?><a href="<?=$arResult["DETAIL_LINK"]?>" title="<?=GetMessage("P_GO_TO_SECTION")?>" <?
		?>><?=GetMessage("P_UP")?></a><?
	endif;
	?></div><?
endif;

?><div class="photo-window-edit" id="photo_photo_edit"><?
?><script>
window.cancelblur = function(e)
{
	if (!e)
		e=window.event;
	e.preventDefault();
	e.stopPropagation();
}
</script><?
?><form method="post" action="<?=POST_FORM_ACTION_URI?>" name="form_photo" id="form_photo" onsubmit="return CheckForm(this);"><?
?><input type="hidden" name="edit" value="Y"><?
?><input type="hidden" name="sessid" value="<?=bitrix_sessid()?>"><?
?><input type="hidden" name="SECTION_ID" value="<?=$arResult["ELEMENT"]["~IBLOCK_SECTION_ID"]?>"><?
?><input type="hidden" name="ELEMENT_ID" value="<?=$arResult["ELEMENT"]["~ID"]?>"><?

?><table cellpadding="0" cellspacing="0" border="0">
	<tr><td class="table-body"><?
	?><div class="inner"><?
	ShowError($arResult["ERROR_MESSAGE"]);
	
	?><div class="photo-album-head name"><font class="starrequired">*</font><?=GetMessage("P_TITLE")?>: <br /><?
		?><input type="text" name="TITLE" value="<?=$arResult["ELEMENT"]["NAME"]?>" /><?
	?></div><?
	?><div class="photo-album-head date"><?=GetMessage("P_DATE")?>: <br /><?
	$APPLICATION->IncludeComponent(
		"bitrix:main.calendar", 
		"", 
		array(
			"SHOW_INPUT" => "Y", 
			"FORM_NAME" => "form_photo",
			"INPUT_NAME" => "DATE_CREATE",
			"INPUT_VALUE" => $arResult["ELEMENT"]["DATE_CREATE"]));

	/*echo CalendarDate("DATE_CREATE", $arResult["ELEMENT"]["DATE_CREATE"], "form_photo", "15");?><?*/
	?></div><?
	
	?><div class="photo-album-head albums"><?=GetMessage("P_ALBUMS")?>: <br /><?
	if (is_array($arResult["SECTION_LIST"]))
	{
		?><select id="TO_SECTION_ID" name="TO_SECTION_ID"><?
		foreach ($arResult["SECTION_LIST"] as $key => $val):
			?><option value="<?=$key?>" <?
				?> <?=($arResult["ELEMENT"]["IBLOCK_SECTION_ID"] == $key ? "selected" : "")?>><?=$val?></option><?
		endforeach;
		?></select><?
	}
	?></div><?
	if ($arParams["SHOW_TAGS"] == "Y" && IsModuleInstalled("search")):
	?><div class="photo-album-head tags"><?=GetMessage("P_TAGS")?>: <br /><?
		$APPLICATION->IncludeComponent(
			"bitrix:search.tags.input", 
			"", 
			array(
				"VALUE" => $arResult["ELEMENT"]["TAGS"], 
				"NAME" => "TAGS"));
	?></div><?
	elseif ($arParams["SHOW_TAGS"] == "Y"):
	?><div class="photo-album-head tags"><?=GetMessage("P_TAGS")?>: <br /><?
		?><input type="text" name="TAGS" value="<?=$arResult["ELEMENT"]["TAGS"]?>" /><?
	?></div><?
	endif;
	?><div class="photo-album-head description"><?=GetMessage("P_DESCRIPTION")?>: <br /><?
		?><textarea name="DESCRIPTION"><?=$arResult["ELEMENT"]["DETAIL_TEXT"]?></textarea><?
	?></div><?
	
	?></div><?
	?></td></tr><?
	?><tr><td class="table-controls"><?
	?><input type="submit" name="name_submit" value="<?=GetMessage("P_SUBMIT");?>" /><?
	?><input type="button" name="cancel" value="<?=GetMessage("P_CANCEL");?>" onclick="CancelSubmit(this)" /><?
	?></td></tr><?
?></table><?
?></form><?
?></div><?

if ($arParams["AJAX_CALL"] == "Y"):
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

document.getElementById('TO_SECTION_ID').onclick = function(e){
	alert('ER');
	if (!jsUtils.IsIE)
	{
		e.preventDefault();
		e.stopPropagation();
	}

	return false;
}
</script><?
endif;

?>