<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<style type="text/css">

.tableworkbg {background-color:#FFFFFF;}
.tableborder {background-color:#5E6B87;}
.tablehead {background-image: url(/images/table_head_back.gif); background-color:#FFFFFF; border-top: solid 1px #93CBEA; border-bottom: solid 1px #C7E2FF; padding-top: 5px; padding-bottom: 5px; background-repeat: repeat-x;}
.tdpadding  {padding-left:5px;}


</style>
<form action="<?=$arResult["FORM_ACTION"]?>" method="get">
	<table border="0" cellpadding="3" cellspacing="2" width="85%">

		<tbody><tr class="tablehead">

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td class="tdpadding"><h3><?echo GetMessage("SUBSCR_NAME")?></h3></td>

			<td class="tdpadding"><h3><?echo GetMessage("SUBSCR_DESC")?></h3></td>

			<?if($arResult["SHOW_COUNT"]):?>
				<td><font class="tableheadtext"><?echo GetMessage("SUBSCR_CNT")?></font></td>
			<?endif;?>
		</tr>

		<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
		<tr valign="top">
			<td class="tdpadding"><input type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemID?>" value="<?=$itemValue["ID"]?>" checked /></td>

			<td class="tdpadding"><p><label for="sf_RUB_ID_<?=$itemID?>"><?=$itemValue["NAME"]?></label></p></td>

			<td class="tdpadding"><p><?=$itemValue["DESCRIPTION"]?></p></td>

			<?if($arResult["SHOW_COUNT"]):?>
				<td align="right"><?=$itemValue["SUBSCRIBER_COUNT"]?></td>
			<?endif?>
		</tr>
		<?endforeach;?>
	</tbody>
</table>

<table border="0" cellpadding="2" cellspacing="2">
	<tbody>
	<tr>
		<td><font class="text"><?echo GetMessage("SUBSCR_ADDR")?>&nbsp;</font></td>
		<td><input type="text" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?echo GetMessage("SUBSCR_EMAIL_TITLE")?>" />
		</td>
		<td><input type="submit" value="<?echo GetMessage("SUBSCR_BUTTON")?>" /></td>
	</tr>
	</tbody>
</table>

</form>
<table border="0" cellpadding="0" cellspacing="0" width="85%"><tbody><tr><td class="tableborder"><img src="/images/1.gif" alt="" height="2" width="1"></td></tr></tbody></table>





<table border="0" cellpadding="0" cellspacing="0" width="85%">
<tbody><tr valign="top">
	<td width="35%">
<h2>Modify settings</h2>

<p>If you are already subscribed to our newsletters you can modify your settings - just enter your e-mail and password if needed.</p>


<form action="<?=$arResult["FORM_ACTION"]?>" method="get">
<?echo bitrix_sessid_post();?>
<table border="0" cellpadding="0" cellspacing="2">

<tbody><tr>
	<td>e-mail</td>
</tr>
<tr>
	<td><input type="text" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?echo GetMessage("SUBSCR_EMAIL_TITLE")?>" /></td>
</tr>
		<?if($arResult["SHOW_PASS"]=="Y"):?>
<tr>
	<td>password<font class="starrequired">*</font></td>
</tr>
<tr>
	<td><input type="password" name="AUTH_PASS" size="20" value="" title="<?echo GetMessage("SUBSCR_EDIT_PASS_TITLE")?>" /></td>
</tr>
		<?else:?>
<tr>
	<td><font class="text successcolor"><?echo GetMessage("SUBSCR_EDIT_PASS_ENTERED")?></font><font class="starrequired">*</font><br>
</tr>
		<?endif;?>

<tr>
	<td><input type="submit" value="<?echo GetMessage("SUBSCR_EDIT_BUTTON")?>" /></td>
</tr>
</tbody></table>
<input type="hidden" name="action" value="authorize" />
</form>




	</td>
	<td class="text" width="0%">&nbsp;</td>
	<td class="tableborder" width="0%"><img src="/images/1.gif" alt="" height="1" width="1"></td>
	<td class="text" width="0%">&nbsp;&nbsp;</td>

	<td width="35%">
<h2>If you forgot your password</h2>

<p>
Enter e-mail which you use for receiving our newsletters and password will be immediately sent to you.</p>
<form action="<?=$arResult["FORM_ACTION"]?>" method="get">
<?echo bitrix_sessid_post();?>
<table border="0" cellpadding="0" cellspacing="2">
<tbody><tr>
	<td>e-mail</td>
</tr>
<tr>

	<td><input type="text" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?echo GetMessage("SUBSCR_EMAIL_TITLE")?>" /></p>
	<td width="60%"></td>
</tr>
<tr>
	<td><input type="submit" value="<?echo GetMessage("SUBSCR_PASS_BUTTON")?>" /></td>
</tr>
</tbody></table>
<input name="action" value="sendpassword" type="hidden">
</form>

	</td>
	<td class="text" width="0%">&nbsp;</td>
	<td class="tableborder" width="0%"><img src="/images/1.gif" alt="" height="1" width="1"></td>

	<td class="text" width="0%">&nbsp;&nbsp;</td>
	<td width="30%">
<h2>
Unsubscribe</h2>
<p>If you want to unsubscribe, go to subscription settings and click the Unsubscribe.</p>
	</td>
</tr>
</tbody></table>
















<!--
<p><span class="starrequired">*&nbsp;</span><?echo GetMessage("SUBSCR_NOTE")?></p>
-->

