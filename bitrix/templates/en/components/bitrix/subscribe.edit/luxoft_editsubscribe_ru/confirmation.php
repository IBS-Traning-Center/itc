<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//*************************************
//show confirmation form
//*************************************
?>
<form action="<?=$arResult["FORM_ACTION"]?>" method="get">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="data-table">
<thead><tr><td colspan="2"><?echo GetMessage("subscr_title_confirm")?></td></tr></thead>
<tr valign="top">
	<td width="40%">
		<?echo GetMessage("subscr_conf_code")?><span class="starrequired">*</span><br />
		<input type="text"  class="confirm" name="CONFIRM_CODE" value="<?echo $arResult["REQUEST"]["CONFIRM_CODE"];?>" size="20" />

		<p><?echo GetMessage("subscr_conf_date")?>:<br />
		<?echo $arResult["SUBSCRIPTION"]["DATE_CONFIRM"];?></p>

	</td>
	<td width="60%"><p>
		<?echo GetMessage("subscr_conf_note1")?> <a title="<?echo GetMessage("adm_send_code")?>" href="<?echo $arResult["FORM_ACTION"]?>?ID=<?echo $arResult["ID"]?>&amp;action=sendcode&amp;<?echo bitrix_sessid_get()?>"><?echo GetMessage("subscr_conf_note2")?></a>.
	</p></td>
</tr>
<tfoot><tr><td colspan="2"><input type="submit" class="but" name="confirm" value="<?echo GetMessage("subscr_conf_button")?>" /></td></tr></tfoot>
</table>
<input type="hidden" name="ID" value="<?echo $arResult["ID"];?>" />
<?echo bitrix_sessid_post();?>
</form>
<div class="botborder"> </div>