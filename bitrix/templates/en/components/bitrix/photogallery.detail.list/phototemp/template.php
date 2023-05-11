<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arParams["SHOW_TAGS"] = ($arParams["SHOW_TAGS"] == "Y" ? "Y" : "N");
$arParams["SHOW_CONTROLS"] = ($arParams["SHOW_CONTROLS"] == "Y" ? "Y" : "N");
$temp = array("STRING" => preg_replace("/[^0-9]/is", "/", $arParams["THUMBS_SIZE"]));
list($temp["WIDTH"], $temp["HEIGHT"]) = explode("/", $temp["STRING"]);
$arParams["THUMBS_SIZE"] = (intVal($temp["WIDTH"]) > 0 ? intVal($temp["WIDTH"]) : 120);
if ($arParams["PICTURES_SIGHT"] != "standart")
	$arParams["THUMBS_SIZE"] = $arParams["PICTURES"][$arParams["PICTURES_SIGHT"]]["size"];
$arResult["ELEMENTS"]["MAX_HEIGHT"] = $arParams["THUMBS_SIZE"];

if (!empty($arResult["ERROR_MESSAGE"])):
?><div class="photo-error"><?=ShowError($arResult["ERROR_MESSAGE"])?></div><?
endif;

if (!empty($arResult["ELEMENTS_LIST"]) && is_array($arResult["ELEMENTS_LIST"])):
?><div class="empty-clear"></div><?

if (($arParams["SHOW_PAGE_NAVIGATION"] == "top" || $arParams["SHOW_PAGE_NAVIGATION"] == "both") && !empty($arResult["NAV_STRING"])):
	?><div class="photo-navigation"><?=$arResult["NAV_STRING"]?></div><?
endif;

if ($arParams["SHOW_CONTROLS"] == "Y"):
	?><div class="photo-controls photo-view"><?
	if ($arResult["USER_HAVE_ACCESS"] == "Y"):
		?><!--<a href="<?=$arResult["SLIDE_SHOW"]?>" class="photo-view slide-show"><?=GetMessage("P_SLIDE_SHOW")?>--></a><?
	endif;
	if (!empty($arParams["PICTURES"]))
	{
		$arRes = array_merge(
			array("standart" => array("title" => GetMessage("P_STANDARD"))),
			$arParams["PICTURES"]);
		?><span class="photo-view sights"><?=GetMessage("P_PICTURES_SIGHT")?>: <?
		?><select name="picture" onchange="ChangeText(this);" title="<?=GetMessage("P_PICTURES_SIGHT_TITLE")?>"><?
		foreach ($arRes as $key => $val):
			?><option value="<?=$key?>"<?=($key."" == $arParams["PICTURES_SIGHT"]."" ? " selected" : "")?>><?=$val["title"]?></option><?
		endforeach;
		?></select></span><?
	}
	?></div><?

	if ($arParams["DetailListViewMode"] == "edit" && $arParams["PERMISSION"] >= "W"):
	?><div class="photo-controls"><?
		?><a href="<?=$APPLICATION->GetCurPageParam("view_mode=view&".bitrix_sessid_get(), array("view_mode", "sessid"), false)?>"<?
			?> class="photo-action go-to-view"<?
			?> title="<?=GetMessage("P_VIEW_TITLE")?>"><?=GetMessage("P_VIEW")?></a><?
		?><a href="javascript:void(0);" onmousedown="Delete();" class="photo-action delete"><?=GetMessage("P_DELETE_SELECTED")?></a><?
	?></div><?

	?><form action="<?=POST_FORM_ACTION_URI?>" method="post" id="photoForm"><?
	IncludeAJAX();
		?><input type="hidden" name="sessid" value="<?=bitrix_sessid()?>" /><?
		?><input type="hidden" name="detail_list_edit" value="Y" /><?
		?><input type="hidden" name="ACTION" id="ACTION" value="Y" /><?
		?><input type="hidden" name="SECTION_ID" value="<?=$arParams["SECTION_ID"]?>" /><?
		?><input type="hidden" name="IBLOCK_ID" value="<?=$arParams["IBLOCK_ID"]?>" /><?
		?><input type="hidden" name="REDIRECT_URL" value="<?=htmlspecialchars($APPLICATION->GetCurPageParam("", array(), false))?>" /><?
		?><div class="photo-controls photo-action select-all"><input type="checkbox" value="Y" id="select_all1" name="select_all" onclick="for (var ii = 0; ii < this.form.elements.length; ii++){if (this.form.elements[ii].name == 'items[]' || this.form.elements[ii].name == 'select_all'){this.form.elements[ii].checked = this.checked;}}" /><label for="select_all1"><?=GetMessage("P_SELECT_ALL")?></label></div><?
	elseif ($arParams["PERMISSION"] >= "W"):
	?><div class="photo-controls photo-action"><?
		?><a href="<?=$APPLICATION->GetCurPageParam("view_mode=edit&amp;".bitrix_sessid_get(), array("view_mode", "sessid"), false)?>"<?
		?> title="<?=GetMessage("P_EDIT_TITLE")?>"<?
		?> class="photo-action go-to-edit"><?=GetMessage("P_EDIT")?></a><?
	?></div><?
	endif;
endif;
?><div class="empty-clear"></div><?

?>

<?

?>



<div class="photo-photos"><?
foreach ($arResult["ELEMENTS_LIST"]	as $key => $arItem):
	if (!is_array($arItem))
		continue;

	?><table class="photo-photo<?=(($arParams["SHOW_CONTROLS"] == "Y" && $arParams["DetailListViewMode"] == "edit") ? " edit" : "")?>" <?
		?>style="height: <?=($arResult["ELEMENTS"]["MAX_HEIGHT"] + 19)
			/* 19: 5*2 - padding; 2*2 - image-border; 2*2 - div-border; 5 - additional space*/ ?>px;" cellpadding="0" cellspacing="0" border="0"><tr><td><?

		?><div class="photo-photo" ?><?
	if(is_array($arItem["PICTURE"])):
		if($arResult["USER_HAVE_ACCESS"] == "Y"):
			if ($arParams["SHOW_CONTROLS"] == "Y" && $arParams["DetailListViewMode"] == "edit"):
				?><input type="checkbox" value="<?=$arItem["ID"]?>" name="items[]" <?=(($arResult["bVarsFromForm"] == "Y" && in_array($arItem["ID"], $_REQUEST["items"])) ? "checked" : "")?> id="items_<?=$arItem["ID"]?>" /><?
				?><a href="javascript:void(0);" onclick="document.getElementById('items_<?=$arItem["ID"]?>').checked = !document.getElementById('items_<?=$arItem["ID"]?>').checked; document.getElementById('select_all1').checked=false;"><?
				?><?=CFile::ShowImage($arItem["PICTURE"]["SRC"], $arParams["THUMBS_SIZE"], $arParams["THUMBS_SIZE"], "border=\"0\" vspace=\"0\" hspace=\"0\" alt=\"".htmlspecialchars($arItem["CODE"])."\" title=\"".htmlspecialchars($arItem["~NAME"])."\"");?><?
				?></a><?
			else:
				?><a href="<?=$arItem["URL"]?>"><?
					?><?=CFile::ShowImage($arItem["PICTURE"]["SRC"], $arParams["THUMBS_SIZE"], $arParams["THUMBS_SIZE"], "border=\"0\" vspace=\"0\" hspace=\"0\" alt=\"".htmlspecialchars($arItem["CODE"])."\" title=\"".htmlspecialchars($arItem["~NAME"])."\"");?><?
				?></a><?
			endif;
		else:
		?><?=CFile::ShowImage($arItem["PICTURE"]["SRC"], $arParams["THUMBS_SIZE"], $arParams["THUMBS_SIZE"], "border=\"0\" vspace=\"0\" hspace=\"0\" alt=\"".htmlspecialchars($arItem["CODE"])."\" title=\"".htmlspecialchars($arItem["~NAME"])."\"");?><?
		endif;
	else:
		?><div class="empty"></div><?
	endif;


		if (!empty($arItem) && $arParams["DetailListViewMode"] != "edit"):
		?><div style="position:relative;"><?
			?><div class="photo-image-inner" id="item_<?=$arItem["ID"]?>"<?
				if (PhotoGetBrowser() == "opera"):
					?> style="overflow:auto; height:150px;"<?
				endif;
				?>><?
				if ($arResult["USER_HAVE_ACCESS"] == "Y"):
				?><div class="photo-title"><a href="<?=$arItem["URL"]?>"><?=$arItem["NAME"]?></a></div><?
				?><div class="photo-controls photo-view"><a class="photo-view original" <?
					?>href="<?=$arItem["SLIDE_SHOW_URL"]?>" <?
					?>title="<?=GetMessage("P_FULL_SCREEN_TITLE")?>"><?=GetMessage("P_FULL_SCREEN")?></a></div><?
				else:
				?><div class="photo-title"><?=$arItem["NAME"]?></div><?
				endif;

				?><div class="photo-date"><?=$arItem["DATE_CREATE"]?></div><?

		if ($arParams["SHOW_TAGS"] == "Y"):
			?><div class="photo-tags"><?
			if (!empty($arItem["TAGS_LIST"]))
			{
				$first = true;
				foreach ($arItem["TAGS_LIST"] as $tags):
					if (!$first)
					{
						?>, <?
					}
					?><a href="<?=$tags["TAGS_URL"]?>"><?=$tags["TAGS_NAME"]?></a><?
					$first = false;
				endforeach;
			}
				?></div><?
		endif;
		if ($arParams["SHOW_RATING"] == "Y"):
		?><div class="photo-rating"><table border="0" cellspacing="0" cellpadding="0"><tr><?
			foreach($arResult["VOTE_NAMES"] as $i=>$name):
				if(round($arItem["PROPERTIES"]["rating"]["VALUE"]) > $i):
					?><td><div class="star-voted" title="<?=$name?>"></div></td><?
				else:
					?><td><div class="star-empty" title="<?=$name?>"></div></td><?
				endif;
			endforeach;

			if($arItem["PROPERTIES"]["vote_count"]["VALUE"]):
				?><td><?=GetMessage("T_IBLOCK_VOTE_RESULTS", array("#VOTES#"=>$arItem["PROPERTIES"]["vote_count"]["VALUE"] , "#RATING#"=>$arItem["PROPERTIES"]["rating"]["VALUE"]))?></td><?
			else:
				?><td><?=GetMessage("T_IBLOCK_VOTE_NO_RESULTS")?></td><?
			endif;
		?></tr></table></div><?
		endif;

		if ($arParams["SHOW_SHOWS"] == "Y"):
		?><div class="photo-shows"><?=GetMessage("P_SHOWS")?>: <?=intVal($arItem["SHOW_COUNTER"])?></div><?
		endif;

		if ($arParams["SHOW_COMMENTS"] == "Y"):
		?><div class="photo-shows"><?=GetMessage("P_COMMENTS")?>: <?=intVal($arParams["COMMENTS_TYPE"] == "FORUM" ? $arItem["PROPERTIES"]["FORUM_MESSAGE_CNT"]["VALUE"] : $arItem["PROPERTIES"]["BLOG_COMMENTS_CNT"]["VALUE"])?></div><?
		endif;


		?><div class="photo-description"><?=$arItem["DETAIL_TEXT"]?></div><?

			?></div><?
		?></div><?
		endif;




		?></div><?

	?></td></tr></table><?
endforeach;
?></div><?

?><div class="empty-clear"></div><?

if ($arParams["SHOW_CONTROLS"] == "Y" && $arParams["PERMISSION"] >= "W"):
	if ($arParams["DetailListViewMode"] == "edit"):
	?></form><?
	endif;
?><script type="text/javascript">
function Delete()
{
	var form = document.getElementById('photoForm');
	var bNotEmpty = false;
	if (form && form.elements["items[]"])
	{
		if (!form.elements["items[]"].length && form.elements["items[]"].checked)
		{
			bNotEmpty = true;
		}
		else if (form.elements["items[]"].length > 0)
		{
			for (var ii = 0; ii < form.elements["items[]"].length; ii++)
			{
				if (form.elements["items[]"][ii].checked == true)
				{
					bNotEmpty = true;
					break;
				}
			}
		}

		if (bNotEmpty)
		{
			if (confirm('<?=GetMessage("P_DELETE_CONFIRM")?>'))
			{
				form.elements['ACTION'].value = 'drop';
				form.submit();
			}
		}
	}
}
</script><?
endif;

if (($arParams["SHOW_PAGE_NAVIGATION"] == "bottom" || $arParams["SHOW_PAGE_NAVIGATION"] == "both") && !empty($arResult["NAV_STRING"])):
	?><div class="photo-navigation"><?=$arResult["NAV_STRING"]?></div><?
endif;

endif;

if (!empty($arResult["ERROR_MESSAGE"])):
?><div class="photo-error"><?=ShowError($arResult["ERROR_MESSAGE"])?></div><?
endif;
?>
<script type="text/javascript">
function ChangeText(obj)
{
	if (typeof obj != "object")
		return;
	if (<?=intVal($GLOBALS["USER"]->GetId())?> > 0)
	{
		var TID = CPHttpRequest.InitThread();
		CPHttpRequest.SetAction(TID, function(data){window.location.reload(true);})
		CPHttpRequest.Send(TID, '/bitrix/components/bitrix/photogallery.detail.list/user_settings.php', {"picture_sight":obj.value, "sessid":'<?=bitrix_sessid()?>'});
	}
	else
	{
		jsUtils.Redirect([], '<?=CUtil::addslashes($GLOBALS["APPLICATION"]->GetCurPageParam("PICTURES_SIGHT=#pictures_sight#", array("PICTURES_SIGHT", "sessid"), false))?>'.replace('#pictures_sight#', obj.value));
	}
}
function HideDescription(id)
{
	if (document.getElementById('item_' + id))
		document.getElementById('item_' + id).style.display = 'none';
}
function ShowDescription(id)
{
	if (document.getElementById('item_' + id))
		document.getElementById('item_' + id).style.display = 'block';
}

</script>
<div class="empty-clear"></div>