<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
?>

<?
if ($arResult['ERROR'])
{
  ShowMessage($arResult['ERROR_MESSAGE']);
}
?>

<?if($arResult['ERROR_MESSAGE']['TYPE'] != 'OK') {?>
<form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?
if (strlen($arResult["BACKURL"]) > 0)
{
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
}
?>
	<input type="hidden" name="AUTH_FORM" value="Y">
	<input type="hidden" name="TYPE" value="SEND_PWD">
	<p>
	<?=GetMessage("AUTH_FORGOT_PASSWORD_1")?>
	</p>

<table class="data-table">
	<thead>
		<tr>
			<td colspan="2"><b><?=GetMessage("AUTH_GET_CHECK_STRING")?></b></td>
		</tr>
	</thead>
	<tbody>
		<!--<tr>
			<td><?=GetMessage("AUTH_LOGIN")?></td>
			<td><input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" />&nbsp;<?=GetMessage("AUTH_OR")?>
			</td>
		</tr>-->
		<tr>
			<td>E-Mail:</td>
			<td>
				<input type="email" name="USER_EMAIL" maxlength="255" />
			</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2">
				<input type="submit" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>" />
			</td>
		</tr>
	</tfoot>
</table>
</form>
<?}?>
<script>
<!--
document.bform.USER_EMAIL.focus();
// -->
</script>
