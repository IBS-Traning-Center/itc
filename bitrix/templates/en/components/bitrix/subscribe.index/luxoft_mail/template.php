<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<form action="<?=$arResult["FORM_ACTION"]?>" method="get"  class="luxform">
<fieldset>

<ol>
<li><label0>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label0> 
<label><strong><?echo GetMessage("SUBSCR_NAME")?></strong></label>   <label2><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo GetMessage("SUBSCR_DESC")?></strong></label2>

			
			
			<?if($arResult["SHOW_COUNT"]):?>
				<label><?echo GetMessage("SUBSCR_CNT")?></label>
			<?endif;?>
	</li>
		<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
 <li>   <label0> <input type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemID?>" value="<?=$itemValue["ID"]?>" checked /></label0>
			<label for="sf_RUB_ID_<?=$itemID?>"><?=$itemValue["NAME"]?></label>
			<label2><?=$itemValue["DESCRIPTION"]?></label2></li>


		<?endforeach;?>
	
	<li><label><?echo GetMessage("SUBSCR_ADDR")?></label>&nbsp;<input type="text" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?echo GetMessage("SUBSCR_EMAIL_TITLE")?>" /><input type="submit" value="<?echo GetMessage("SUBSCR_BUTTON")?>" /></li>
<ol></fieldset></form>
<br />

<form action="<?=$arResult["FORM_ACTION"]?>" method="get">
<?echo bitrix_sessid_post();?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="data-table">
<thead><tr><td colspan="2"><?echo GetMessage("SUBSCR_EDIT_TITLE")?></td></tr></thead>
<tr valign="top">
	<td width="40%">
		<p>e-mail<br />
		<input type="text" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?echo GetMessage("SUBSCR_EMAIL_TITLE")?>" /></p>
		<?if($arResult["SHOW_PASS"]=="Y"):?>
			<p><?echo GetMessage("SUBSCR_EDIT_PASS")?><span class="starrequired">*</span><br />
			<input type="password" name="AUTH_PASS" size="20" value="" title="<?echo GetMessage("SUBSCR_EDIT_PASS_TITLE")?>" /></p>
		<?else:?>
			<p><span class="green"><?echo GetMessage("SUBSCR_EDIT_PASS_ENTERED")?></span><span class="starrequired">*</span></p>
		<?endif;?>
	<td width="60%">
		<p><?echo GetMessage("SUBSCR_EDIT_NOTE")?></p>
	</td>
</tr>
<tfoot><tr><td colspan="2">
	<input type="submit" value="<?echo GetMessage("SUBSCR_EDIT_BUTTON")?>" />
</td></tr></tfoot>
</table>
<input type="hidden" name="action" value="authorize" />
</form>
<br />

<form action="<?=$arResult["FORM_ACTION"]?>" method="get">
<?echo bitrix_sessid_post();?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="data-table">
<thead><tr><td colspan="2"><?echo GetMessage("SUBSCR_PASS_TITLE")?></td></tr></thead>
<tr valign="top">
	<td width="40%">
		<p>e-mail<br />
		<input type="text" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?echo GetMessage("SUBSCR_EMAIL_TITLE")?>" /></p>
	<td width="60%">
		<p><?echo GetMessage("SUBSCR_PASS_NOTE")?></p>
	</td>
</tr>
<tfoot><tr><td colspan="2">
	<input type="submit" value="<?echo GetMessage("SUBSCR_PASS_BUTTON")?>" />
</td></tr></tfoot>
</table>
<input type="hidden" name="action" value="sendpassword" />
</form>
<br />

<form action="<?=$arResult["FORM_ACTION"]?>" method="get">
<?echo bitrix_sessid_post();?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="data-table">
<thead><tr><td colspan="2"><?echo GetMessage("SUBSCR_UNSUBSCRIBE_TITLE")?></td></tr></thead>
<tr valign="top">
	<td width="40%">
		<p>e-mail<br />
		<input type="text" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?echo GetMessage("SUBSCR_EMAIL_TITLE")?>" /></p>
		<?if($arResult["SHOW_PASS"]=="Y"):?>
			<p><?echo GetMessage("SUBSCR_EDIT_PASS")?><span class="starrequired">*</span><br />
			<input type="password" name="AUTH_PASS" size="20" value="" title="<?echo GetMessage("SUBSCR_EDIT_PASS_TITLE")?>" /></p>
		<?else:?>
			<p><span class="green"><?echo GetMessage("SUBSCR_EDIT_PASS_ENTERED")?></span><span class="starrequired">*</span></p>
		<?endif;?>
	<td width="60%">
		<p><?echo GetMessage("SUBSCR_UNSUBSCRIBE_NOTE")?></p>
	</td>
</tr>
<tfoot><tr><td colspan="2">
	<input type="submit" value="<?echo GetMessage("SUBSCR_EDIT_BUTTON")?>" />
</td></tr></tfoot>
</table>
<input type="hidden" name="action" value="authorize" />
</form>
<br />


<p><span class="starrequired">*&nbsp;</span><?echo GetMessage("SUBSCR_NOTE")?></p>

