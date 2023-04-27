<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//***********************************
//setting section
//***********************************
?>

<style type="text/css">

.tableworkbg {background-color:#FFFFFF;}
.tableborder {background-color:#5E6B87;}
.tablehead {background-image: url(/images/table_head_back.gif); background-color:#FFFFFF; border-top: solid 1px #93CBEA; border-bottom: solid 1px #C7E2FF; padding-top: 3px; padding-bottom: 3px; background-repeat: repeat-x;}
.tdpadding  {padding-left:5px;}

#performance tfoot tr th, tfoot tr td {template_styles.c... (line 875)
background-color:transparent;
border-top:0px solid #CCCCCC;
padding:20px 10px;
}

</style>
<form action="<?=$arResult["FORM_ACTION"]?>" method="post">
<?echo bitrix_sessid_post();?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="data-table">
<thead><tr><td colspan="2" ><h2><?echo GetMessage("subscr_title_settings")?></h2></td></tr></thead>
<tr valign="top">
	<td width="40%" >
		<p><?echo GetMessage("subscr_email")?><span class="starrequired">*</span><br />
		<input type="text" name="EMAIL" value="<?=$arResult["SUBSCRIPTION"]["EMAIL"]!=""?$arResult["SUBSCRIPTION"]["EMAIL"]:$arResult["REQUEST"]["EMAIL"];?>" size="30" maxlength="255" /></p>
		<p><h4><?echo GetMessage("subscr_rub")?><span class="starrequired">*</span></h4><br />
		<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
			<label><input type="checkbox" name="RUB_ID[]" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> /><?=$itemValue["NAME"]?></label><br />
		<?endforeach;?></p>
		<p><h4><?echo GetMessage("subscr_fmt")?></h4><br />
		<label><input type="radio" name="FORMAT" value="text"<?if($arResult["SUBSCRIPTION"]["FORMAT"] == "text") echo " checked"?> /><?echo GetMessage("subscr_text")?></label>&nbsp;/&nbsp;<label><input type="radio" name="FORMAT" value="html"<?if($arResult["SUBSCRIPTION"]["FORMAT"] == "html") echo " checked"?> />HTML</label></p>
	</td>
	<td  width="0%">&nbsp;</td>
	<td class="tableborder" width="0%"><img src="/images/1.gif" alt="" height="1" width="1"></td>
	<td  width="0%">&nbsp;&nbsp;</td>

	<td width="60%">
		<p><?echo GetMessage("subscr_settings_note1")?></p>
		<p><?echo GetMessage("subscr_settings_note2")?></p>
	</td>
</tr>
<tfoot><tr><td colspan="2">
	<input type="submit" name="Save" value="<?echo ($arResult["ID"] > 0? GetMessage("subscr_upd"):GetMessage("subscr_add"))?>" />
	<input type="reset" value="<?echo GetMessage("subscr_reset")?>" name="reset" />
</td></tr></tfoot>
</table>
<input type="hidden" name="PostAction" value="<?echo ($arResult["ID"]>0? "Update":"Add")?>" />
<input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
<?if($_REQUEST["register"] == "YES"):?>
	<input type="hidden" name="register" value="YES" />
<?endif;?>
<?if($_REQUEST["authorize"]=="YES"):?>
	<input type="hidden" name="authorize" value="YES" />
<?endif;?>
</form>
<table border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td class="tableborder"><img src="/images/1.gif" alt="" height="2" width="1"></td></tr></tbody></table>
