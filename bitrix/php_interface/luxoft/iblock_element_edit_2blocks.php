

<?
	$tabControl->BeginEpilogContent();
?>




<script language="JavaScript">
<!--
function addNewRow(tableID)
{
	var tbl = document.getElementById(tableID);
	var cnt = tbl.rows.length;
	var oRow = tbl.insertRow(cnt-1);
	var oCell = oRow.insertCell(0);
	var sHTML=tbl.rows[cnt-2].cells[0].innerHTML;
	var p = 0;
	while(true)
	{
		var s = sHTML.indexOf('[n',p);
		if(s<0)break;
		var e = sHTML.indexOf(']',s);
		if(e<0)break;
		var n = parseInt(sHTML.substr(s+2,e-s));
		sHTML = sHTML.substr(0, s)+'[n'+(++n)+']'+sHTML.substr(e+1);
		p=s+1;
	}
	var p = 0;
	while(true)
	{
		var s = sHTML.indexOf('__n',p);
		if(s<0)break;
		var e = sHTML.indexOf('__',s+2);
		if(e<0)break;
		var n = parseInt(sHTML.substr(s+3,e-s));
		sHTML = sHTML.substr(0, s)+'__n'+(++n)+'__'+sHTML.substr(e+2);
		p=e+2;
	}
	oCell.innerHTML = sHTML;
}
//-->
</script>
<script type="text/javascript">

/***********************************************
* Textarea Maxlength script- © Dynamic Drive (www.dynamicdrive.com)
* This notice must stay intact for legal use.
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

function ismaxlength(obj){
var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : ""
if (obj.getAttribute && obj.value.length>mlength)
obj.value=obj.value.substring(0,mlength)
}

</script>
<?=bitrix_sessid_post()?>
<?echo GetFilterHiddens("find_");?>
<input type="hidden" name="Update" value="Y">
<input type="hidden" name="from" value="<?echo htmlspecialchars($from)?>">
<input type="hidden" name="WF" value="<?echo htmlspecialchars($WF)?>">
<input type="hidden" name="return_url" value="<?echo $return_url?>">
<?if($ID>0 && !$bCopy):?>
	<input type="hidden" name="ID" value="<?echo $ID?>">
<?endif;?>
<input type="hidden" name="IBLOCK_SECTION_ID" value="<?echo IntVal($IBLOCK_SECTION_ID)?>">

<?
$tabControl->EndEpilogContent();

$customTabber->SetErrorState($bVarsFromForm);

$tabControl->Begin(array(
	"FORM_ACTION" => "/bitrix/admin/iblock_element_edit.php?type=".urlencode($type)."&lang=".LANG."&IBLOCK_ID=".$IBLOCK_ID."&find_section_section=".intval($find_section_section),
));

$tabControl->BeginNextFormTab();
?>
	<?
	if($ID > 0 && !$bCopy):
		$p = CIblockElement::GetByID($ID);
		$pr = $p->ExtractFields("prn_");
	endif;
$tabControl->AddCheckBoxField("ACTIVE", "Включена/Отключена", false, "Y", $str_ACTIVE=="Y");
$tabControl->BeginCustomField("ACTIVE_PERIOD", GetMessage("IBLOCK_ACTIVE_PERIOD"));
?>

<?
$tabControl->EndCustomField("ACTIVE_PERIOD",
	'<input type="hidden" id="ACTIVE_FROM" name="ACTIVE_FROM" value="'.$str_ACTIVE_FROM.'">'.
	'<input type="hidden" id="ACTIVE_TO" name="ACTIVE_TO" value="'.$str_ACTIVE_TO.'">'
);
$tabControl->AddEditField("NAME","Имя блока", true, array("align" => "left", "size" => 50, "maxlength" => 255), $str_NAME);

if(count($PROP)>0):
	$tabControl->AddSection("IBLOCK_ELEMENT_PROP_VALUE", GetMessage("IBLOCK_ELEMENT_PROP_VALUE"));
	foreach($PROP as $prop_code=>$prop_fields):
		//print_r($prop_fields);
		$prop_values = $prop_fields["VALUE"];
		$tabControl->BeginCustomField("PROPERTY_".$prop_fields["ID"], $prop_fields["NAME"]);
		?>
        <!-- -->
		<?if($prop_fields["ID"]==127) { //print_r($prop_values);
foreach ($prop_values as $k => $v) {
}

		?>
                <tr>
                        <td valign="top"><?echo htmlspecialcharsex($prop_fields["NAME"]);?>:</td>
                        <td align="left"><textarea maxlength="150 " onkeyup="return ismaxlength(this)" rows="3" cols="40" name="PROP[127][<?=$k?>]"><?=$v?></textarea>
</td>
                </tr>
        <? } else { ?>
        <!-- -->

		<tr>
			<td valign="top"><?echo $tabControl->GetCustomLabelHTML();?>:</td>
			<td align="left"><?_ShowPropertyField('PROP['.$prop_fields["ID"].']', $prop_fields, $prop_fields["VALUE"], ((!$bVarsFromForm) && ($ID<=0)), $bVarsFromForm);?></td>
		</tr>
		<? } ?>
		<?
			$hidden = "";
			if(!is_array($prop_fields["~VALUE"]))
				$values = Array();
			else
				$values = $prop_fields["~VALUE"];
			$start = 1;
			foreach($values as $key=>$val)
			{
				if($bCopy)
				{
					$key = "n".$start;
					$start++;
				}
				if(!is_array($val) || !array_key_exists("VALUE",$val))
					$val = array("VALUE"=>$val, "DESCRIPTION"=>"");

				@$hidden .= '<input type="hidden" name="PROP['.$prop_fields["ID"].']['.$key.'][VALUE]" value="'.htmlspecialchars($val["VALUE"]).'">';
				@$hidden .= '<input type="hidden" name="PROP['.$prop_fields["ID"].']['.$key.'][DESCRIPTION]" value="'.htmlspecialchars($val["DESCRIPTION"]).'">';
			}
		$tabControl->EndCustomField("PROPERTY_".$prop_fields["ID"], $hidden);
		endforeach;?>
	<?endif?>

	<?
	if ($view!="Y" && CModule::IncludeModule("catalog") && CCatalog::GetByID($IBLOCK_ID))
	{
		$tabControl->BeginCustomField("CATALOG", GetMessage("IBLOCK_TCATALOG"), true);
		include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/catalog/admin/templates/product_edit.php");
		$tabControl->EndCustomField("CATALOG", "");
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
		$tabControl->BeginCustomField("LINKED_PROP", GetMessage("IBLOCK_ELEMENT_EDIT_LINKED"));
		?>
		<tr class="heading">
			<td colspan="2"><?echo $tabControl->GetCustomLabelHTML();?></td>
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
		$tabControl->EndCustomField("LINKED_PROP", "");
	}
	?>
<?


$tabControl->BeginCustomField("PREVIEW_PICTURE", GetMessage("IBLOCK_FIELD_PREVIEW_PICTURE"));
?>
	<tr>
		<td nowrap valign="top" width="40%"><?echo $tabControl->GetCustomLabelHTML()?></td>
		<td align="left" width="60%">
			<?if($ID > 0 && !$bCopy):?>
				<?echo CFile::InputFile("PREVIEW_PICTURE", 20, $str_PREVIEW_PICTURE, false, 0, "IMAGE", "", 40);?><br>
				<?echo CFile::ShowImage($str_PREVIEW_PICTURE, 200, 200, "border=0", "", true)?>
			<?else:?>
				<?echo CFile::InputFile("PREVIEW_PICTURE", 20, "", false, 0, "IMAGE", "", 40);?><br>
				<?echo CFile::ShowImage("", 200, 200, "border=0", "", true)?>
			<?endif?>
		</td>
	</tr>
<?
$tabControl->EndCustomField("PREVIEW_PICTURE", "");


if (!defined('BX_PUBLIC_MODE') || BX_PUBLIC_MODE != 1):
	ob_start();
	?>
	<input <?if ($view=="Y" || $prn_LOCK_STATUS=="red") echo "disabled";?> type="submit" class="button" name="save" value="<?echo GetMessage("IBLOCK_EL_SAVE")?>">
	<input <?if ($view=="Y" || $prn_LOCK_STATUS=="red") echo "disabled";?> class="button" type="submit" name="apply" value="<?echo GetMessage('IBLOCK_APPLY')?>">
	<input <?if ($view=="Y" || $prn_LOCK_STATUS=="red") echo "disabled";?> type="submit" class="button" name="dontsave" value="<?echo GetMessage("IBLOCK_EL_CANC")?>">
	<?
	$buttons_add_html = ob_get_contents();
	ob_end_clean();
	$tabControl->Buttons(false, $buttons_add_html);
else:
	$tabControl->Buttons(array('disabled' => ($view=="Y" || $prn_LOCK_STATUS=="red")));
endif;

$tabControl->Show();

if((!defined('BX_PUBLIC_MODE') || BX_PUBLIC_MODE != 1) && $BlockPerm >= "X")
{
	echo
		BeginNote(),
		GetMessage("IBEL_E_IBLOCK_MANAGE_HINT"),
		' <a href="iblock_edit.php?type='.htmlspecialchars($type).'&amp;lang='.LANG.'&amp;ID='.$IBLOCK_ID.'&amp;admin=Y&amp;return_url='.urlencode("iblock_element_edit.php?ID=".$ID.($WF=="Y"?"&WF=Y":"")."&lang=".LANG. "&type=".htmlspecialchars($type)."&IBLOCK_ID=".$IBLOCK_ID."&find_section_section=".intval($find_section_section).(strlen($return_url)>0?"&return_url=".UrlEncode($return_url):"")).'">',
		GetMessage("IBEL_E_IBLOCK_MANAGE_HINT_HREF"),
		'</a>',
		EndNote()
	;
}




?>