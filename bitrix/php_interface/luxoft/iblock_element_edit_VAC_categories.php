<form method="POST" action="<?=htmlspecialchars("iblock_element_edit.php?type=".urlencode($type)."&lang=".LANG."&IBLOCK_ID=".$IBLOCK_ID."&find_section_section=".intval($find_section_section));?>" ENCTYPE="multipart/form-data" name="form_element">
<?=bitrix_sessid_post()?>
<?echo GetFilterHiddens("find_");?>
<input type="hidden" name="Update" value="Y">
<input type="hidden" name="from" value="<?echo htmlspecialchars($from)?>">
<input type="hidden" name="WF" value="<?echo htmlspecialchars($WF)?>">
<input type="hidden" name="return_url" value="<?echo $return_url?>">
<input type="hidden" name="ID" value="<?echo $ID?>">
<input type="hidden" name="IBLOCK_SECTION_ID" value="<?echo IntVal($IBLOCK_SECTION_ID)?>">

<?
$bTab2 = ($arIBTYPE["SECTIONS"]=="Y");
$bTab4 = CModule::IncludeModule("workflow");

$aTabs = array();
$aTabs[] = array("DIV" => "edit1", "TAB" => "Категории вакансий", "ICON"=>"iblock_element", "TITLE"=>"Категории вакансий");

// $aTabs[] = array("DIV" => "edit5", "TAB" => GetMessage("IBEL_E_TAB_PREV"), "ICON"=>"iblock_element", "TITLE"=>GetMessage("IBEL_E_TAB_PREV_TITLE"));

//$aTabs[] = array("DIV" => "edit6", "TAB" => GetMessage("IBEL_E_TAB_DET"), "ICON"=>"iblock_element", "TITLE"=>GetMessage("IBEL_E_TAB_DET_TITLE"));

if($bTab2) $aTabs[] = array("DIV" => "edit2", "TAB" => $arIBTYPE["SECTION_NAME"], "ICON"=>"iblock_element_section", "TITLE"=>$arIBTYPE["SECTION_NAME"]);
$aTabs[] = array("DIV" => "edit3", "TAB" => GetMessage("IBLOCK_EL_TAB_MO"), "ICON"=>"iblock_element_params", "TITLE"=>GetMessage("IBLOCK_EL_TAB_MO_TITLE"));

//if($bTab4) $aTabs[] = array("DIV" => "edit4", "TAB" => GetMessage("IBLOCK_EL_TAB_WF"), "ICON"=>"iblock_element_wf", "TITLE"=>GetMessage("IBLOCK_EL_TAB_WF_TITLE"));

$tabControl = new CAdminTabControl("tabControl", $aTabs);
$customTabber->SetErrorState($bVarsFromForm);
$tabControl->AddTabs($customTabber);
$tabControl->Begin();

$tabControl->BeginNextTab();
?>
	<?
	if($ID>0):
		$p = CIblockElement::GetByID($ID);
		$pr = $p->ExtractFields("prn_");
	endif;
	?>
	<tr>
		<td width="40%"><?echo GetMessage("IBLOCK_ACTIVE")?></td>
		<td width="60%"><input type="checkbox" name="ACTIVE" value="Y"<?if($str_ACTIVE=="Y")echo " checked"?>></td>
	</tr>
	<tr>
		<td><?echo GetMessage("IBLOCK_ACTIVE_PERIOD")?>(<?echo CLang::GetDateFormat("SHORT");?>)</td>
		<td><?echo CalendarPeriod("ACTIVE_FROM", $str_ACTIVE_FROM, "ACTIVE_TO", $str_ACTIVE_TO, "form_element", "N", "", "", "19")?></td>
	</tr>
	<tr>
		<td><span class="required">*</span><?echo GetMessage("IBLOCK_NAME")?></td>
		<td>
			<input type="text" name="NAME" size="50" maxlength="255" value="<?echo $str_NAME?>">
		</td>
	</tr>
	<?if(count($PROP)>0):?>
		<tr class="heading">
			<td colspan="2"><?echo GetMessage("IBLOCK_ELEMENT_PROP_VALUE");?></td>
		</tr>
		<?
		foreach($PROP as $prop_code=>$prop_fields):
			$prop_values = $prop_fields["VALUE"];
		?>
		<tr>
			<td valign="top"><?echo htmlspecialcharsex($prop_fields["NAME"]);?>:</td>
			<td><?_ShowPropertyField('PROP['.$prop_fields["ID"].']', $prop_fields, $prop_values, ((!$bVarsFromForm) && ($ID<=0)), $bVarsFromForm);?></td>
		</tr>
		<?endforeach;?>
	<?endif?>

	<?
	if ($view!="Y" && CModule::IncludeModule("catalog") && CCatalog::GetByID($IBLOCK_ID))
	{
		include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/catalog/admin/templates/product_edit.php");
	}
	$rsLinkedProps = CIBlockProperty::GetList(array(), array(
		"PROPERTY_TYPE" => "E",
		"LINK_IBLOCK_ID" => $IBLOCK_ID,
		"ACTIVE" => "Y",
		"FILTRABLE" => "Y",
	));
	$arLinkedProp = $rsLinkedProps->GetNext();
	if($arLinkedProp)
	{
		?>
		<tr class="heading">
			<td colspan="2"><?echo GetMessage("IBLOCK_ELEMENT_EDIT_LINKED");?></td>
		</tr>
		<?
		do {
			$elements_name = CIBlock::GetArrayByID($arLinkedProp["IBLOCK_ID"], "ELEMENTS_NAME");
			if(strlen($elements_name) <= 0)
				$elements_name = GetMessage("IBLOCK_ELEMENT_EDIT_ELEMENTS");
		?>
		<tr>
			<td colspan="2"><a href="<?echo $urlElementAdminPage?>?type=<?echo CIBlock::GetArrayByID($arLinkedProp["IBLOCK_ID"], "IBLOCK_TYPE_ID")?>&amp;IBLOCK_ID=<?echo urlencode($arLinkedProp["IBLOCK_ID"])?>&amp;lang=<?echo LANG?>&amp;set_filter=Y&amp;find_el_property_<?echo $arLinkedProp["ID"]?>=<?echo $ID?>"><?echo CIBlock::GetArrayByID($arLinkedProp["IBLOCK_ID"], "NAME").": ".$elements_name?></a></td>
		</tr>
		<?
		} while ($arLinkedProp = $rsLinkedProps->GetNext());
	}
	?>
<?
//$tabControl->BeginNextTab();
?>
	<tr style="display:none">
		<td nowrap valign="top" width="40%"><?echo GetMessage("IBLOCK_PICTURE")?></td>
		<td width="60%">
			<?echo CFile::InputFile("PREVIEW_PICTURE", 20, $str_PREVIEW_PICTURE, false, 0, "IMAGE", "", 40);?><br>
			<?echo CFile::ShowImage($str_PREVIEW_PICTURE, 200, 200, "border=0", "", true)?>

		</td>
	</tr>

	<?if(COption::GetOptionString("iblock", "use_htmledit", "Y")=="Y" && CModule::IncludeModule("fileman")):?>
	<tr style="display:none">
		<td colspan="2" align="center">
			<?CFileMan::AddHTMLEditorFrame(
			"PREVIEW_TEXT",
			$str_PREVIEW_TEXT,
			"PREVIEW_TEXT_TYPE",
			$str_PREVIEW_TEXT_TYPE,
			300,
			"N",
			0,
			"",
			"",
			$arIBlock["LID"]
			);?>
		</td>
	</tr>
	<?else:?>
	<tr style="display:none">
		<td><?echo GetMessage("IBLOCK_DESC_TYPE")?></td>
		<td><input type="radio" name="PREVIEW_TEXT_TYPE" id="PREVIEW_TEXT_TYPE_text" value="text"<?if($str_PREVIEW_TEXT_TYPE!="html")echo " checked"?>> <label for="PREVIEW_TEXT_TYPE_text"><?echo GetMessage("IBLOCK_DESC_TYPE_TEXT")?></label> / <input type="radio" name="PREVIEW_TEXT_TYPE" id="PREVIEW_TEXT_TYPE_html" value="html"<?if($str_PREVIEW_TEXT_TYPE=="html")echo " checked"?>> <label for="PREVIEW_TEXT_TYPE_html"><?echo GetMessage("IBLOCK_DESC_TYPE_HTML")?></label></td>
	</tr>
	<tr style="display:none">
		<td colspan="2" align="center">
			<textarea cols="60" rows="10" name="PREVIEW_TEXT" style="width:100%"><?echo $str_PREVIEW_TEXT?></textarea>
		</td>
	</tr>
	<?endif?>
<?
//$tabControl->BeginNextTab();
?>
	<tr style="display:none">
		<td valign="top" width="40%"><?echo GetMessage("IBLOCK_PICTURE")?></td>
		<td width="60%">
			<?echo CFile::InputFile("DETAIL_PICTURE", 20, $str_DETAIL_PICTURE, false, 0, "IMAGE", "", 40);?><br>
			<?echo CFile::ShowImage($str_DETAIL_PICTURE, 200, 200, "border=0", "", true)?>
		</td>
	</tr>
	<?if(COption::GetOptionString("iblock", "use_htmledit", "Y")=="Y" && CModule::IncludeModule("fileman")):?>
	<tr style="display:none">
		<td colspan="2" align="center">
			<?CFileMan::AddHTMLEditorFrame("DETAIL_TEXT", $str_DETAIL_TEXT, "DETAIL_TEXT_TYPE", $str_DETAIL_TEXT_TYPE, 440, "N", 0, "", "", $arIBlock["LID"]);?>
		</td>
	</tr>
	<?else:?>
	<tr style="display:none">
		<td><?echo GetMessage("IBLOCK_DESC_TYPE")?></td>
		<td><input type="radio" name="DETAIL_TEXT_TYPE" id="DETAIL_TEXT_TYPE_text" value="text"<?if($str_DETAIL_TEXT_TYPE!="html")echo " checked"?>> <label for="DETAIL_TEXT_TYPE_text"><?echo GetMessage("IBLOCK_DESC_TYPE_TEXT")?></label> / <input type="radio" name="DETAIL_TEXT_TYPE" id="DETAIL_TEXT_TYPE_html" value="html"<?if($str_DETAIL_TEXT_TYPE=="html")echo " checked"?>> <label for="DETAIL_TEXT_TYPE_html"><?echo GetMessage("IBLOCK_DESC_TYPE_HTML")?></label></td>
	</tr>
	<tr style="display:none">
		<td colspan="2" align="center">
			<textarea cols="60" rows="20" name="DETAIL_TEXT" style="width:100%"><?echo $str_DETAIL_TEXT?></textarea>
		</td>
	</tr>
	<?endif?>


<?
$tabControl->EndTab();
?>

<?if($bTab2):
	$tabControl->BeginNextTab();
	?>
	<tr style="display:none">
		<td valign="top" width="40%"><?echo GetMessage("IBLOCK_SECTION")?></td>
		<td width="60%">
		<?$l = CIBlockSection::GetTreeList(Array("IBLOCK_ID"=>$IBLOCK_ID));?>
		<select name="IBLOCK_SECTION[]" size="14" multiple>
			<option value="0"<?if(is_array($str_IBLOCK_ELEMENT_SECTION) && in_array(0, $str_IBLOCK_ELEMENT_SECTION))echo " selected"?>><?echo GetMessage("IBLOCK_CONTENT")?></option>
		<?
			while($l->ExtractFields("l_")):
				?><option value="<?echo $l_ID?>"<?if(is_array($str_IBLOCK_ELEMENT_SECTION) && in_array($l_ID, $str_IBLOCK_ELEMENT_SECTION))echo " selected"?>><?echo str_repeat(" . ", $l_DEPTH_LEVEL)?><?echo $l_NAME?></option><?
			endwhile;
		?>
		</select>
		</td>
	</tr>
	<?
	$tabControl->EndTab();
endif;

$tabControl->BeginNextTab();
?>
	<tr>
		<td width="40%"><?echo GetMessage("IBLOCK_SORT")?></td>
		<td width="60%">
			<input type="text" name="SORT" size="7" maxlength="10" value="<?echo $str_SORT?>">
		</td>
	</tr>
	<?if(COption::GetOptionString("iblock", "show_xml_id", "N")=="Y"):?>
	<tr>
		<td><?echo GetMessage("IBLOCK_EXTERNAL_CODE")?></td>
		<td>
			<input type="text" size="20" name="XML_ID" maxlength="255" value="<?echo $str_XML_ID?>">
		</td>
	</tr>
	<?endif?>
	<tr>
		<td><?echo GetMessage("IBLOCK_CODE")?></td>
		<td>
			<input type="text" size="20" name="CODE" maxlength="255" value="<?echo $str_CODE?>">
		</td>
	</tr>
	<tr>
		<td><?echo GetMessage("IBLOCK_TAGS")?><br><?echo GetMessage("IBLOCK_ELEMENT_EDIT_TAGS_TIP")?></td>
		<td>
			<?if(CModule::IncludeModule('search')):
				$arLID = array();
				$rsSites = CIBlock::GetSite($IBLOCK_ID);
				while($arSite = $rsSites->Fetch())
					$arLID[] = $arSite["LID"];
				echo InputTags("TAGS", $str_TAGS, $arLID, 'size="55"');
			else:?>
				<input type="text" size="20" name="TAGS" maxlength="255" value="<?echo $str_TAGS?>">
			<?endif?>
		</td>
	</tr>
<?
$tabControl->EndTab();
?>

<?if($bTab4):?>
<?
//	$tabControl->BeginNextTab();
	if(strlen($pr["DATE_CREATE"])>0):
	?>
		<tr style="display:none" >
			<td width="40%"><?echo GetMessage("IBLOCK_CREATED")?></td>
			<td width="60%"><?echo $pr["DATE_CREATE"]?><?
			if (intval($pr["CREATED_BY"])>0):
			?>&nbsp;&nbsp;&nbsp;[<a href="user_edit.php?lang=<?=LANG?>&amp;ID=<?=$pr["CREATED_BY"]?>"><?echo $pr["CREATED_BY"]?></a>]&nbsp;<?=htmlspecialcharsex($pr["CREATED_USER_NAME"])?><?
			endif;
			?></td>
		</tr>
	<?endif;?>
	<?if(strlen($str_TIMESTAMP_X)>0):?>
	<tr style="display:none">
		<td><?echo GetMessage("IBLOCK_LAST_UPDATE")?></td>
		<td><?echo $str_TIMESTAMP_X?><?
		if (intval($str_MODIFIED_BY)>0):
		?>&nbsp;&nbsp;&nbsp;[<a href="user_edit.php?lang=<?=LANG?>&amp;ID=<?=$str_MODIFIED_BY?>"><?echo $str_MODIFIED_BY?></a>]&nbsp;<?=$str_USER_NAME?><?
		endif;
		?></td>
	</tr>
	<?endif?>
	<?if($WF=="Y" && strlen($prn_WF_DATE_LOCK)>0):?>
	<tr style="display:none">
		<td nowrap><?echo GetMessage("IBLOCK_DATE_LOCK")?></td>
		<td nowrap><?echo $prn_WF_DATE_LOCK?><?
		if (intval($prn_WF_LOCKED_BY)>0):
		?>&nbsp;&nbsp;&nbsp;[<a href="user_edit.php?lang=<?=LANG?>&ID=<?=$prn_WF_LOCKED_BY?>"><?echo $prn_WF_LOCKED_BY?></a>]&nbsp;<?=$prn_LOCKED_USER_NAME?><?
		endif;
		?></td>
	</tr>
	<?endif;?>
	<?if ($WF=="Y" || $view=="Y"):?>
	<tr style="display:none">
		<td><?=GetMessage("IBLOCK_WF_STATUS")?></td>
		<td nowrap>
		<?echo SelectBox("WF_STATUS_ID", CWorkflowStatus::GetDropDownList("N", "desc"), "", $str_WF_STATUS_ID);?></td>
	</tr>
	<?endif;?>
	<tr  style="display:none" class="heading">
		<td colspan="2"><b><?=GetMessage("IBLOCK_COMMENTS")?></b></td>
	</tr>
	<tr style="display:none">
		<td colspan="2">
			<textarea name="WF_COMMENTS" style="width:100%" rows="10"><?echo $str_WF_COMMENTS?></textarea>
		</td>
	</tr>
<?$tabControl->EndTab();?>
<?endif?>
<?
$tabControl->Buttons();
?>
<input <?if ($view=="Y" || $prn_LOCK_STATUS=="red") echo "disabled";?> type="submit" class="button" name="save" value="<?echo GetMessage("IBLOCK_EL_SAVE")?>">
<input <?if ($view=="Y" || $prn_LOCK_STATUS=="red") echo "disabled";?> class="button" type="submit" name="apply" value="<?echo GetMessage('IBLOCK_APPLY')?>">
<input <?if ($view=="Y" || $prn_LOCK_STATUS=="red") echo "disabled";?> type="submit" class="button" name="dontsave" value="<?echo GetMessage("IBLOCK_EL_CANC")?>">
<?
$tabControl->End();
?>

</form>