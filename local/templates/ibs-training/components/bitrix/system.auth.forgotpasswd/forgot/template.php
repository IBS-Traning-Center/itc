<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?

ShowMessage($arParams["~AUTH_RESULT"]);
?>

<? if($arResult["ERRORS"]) {?>
<p><strong><?=$arResult["ERRORS"][0]?></strong><br/></p>
<?}else if (isset($arResult["EMAIL"]) && strlen($arResult["EMAIL"])>0 ) {?>
<strong>Информация для смены пароля выслана на указанный Email.</strong><br /><p> Проверьте, пожалуйста, ваш Email.
 В  письме от Учебного Центра Luxoft  Вы найдете ссылку, после перехода по которой у Вас появится возможность задать новый пароль</p>

 <?} else {?>

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

<table class="data-table bx-forgotpass-table">
	<thead>
		<tr> 
			<td colspan="2"><b><?=GetMessage("AUTH_GET_CHECK_STRING")?></b></td>
		</tr>
	</thead>
	<tbody>
<?/*
		<tr>
			<td><?=GetMessage("AUTH_LOGIN")?></td>
			<td><input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" />&nbsp;<?=GetMessage("AUTH_OR")?>
			</td>
		</tr>
*/?>
		<tr> 
			<td><?=GetMessage("AUTH_EMAIL")?></td>
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
<?/*
<p>
<a href="<?=$arResult["AUTH_AUTH_URL"]?>"><b><?=GetMessage("AUTH_AUTH")?></b></a>
</p> 
*/
?>
</form>
<? } ?>
<script type="text/javascript">
document.bform.USER_LOGIN.focus();
</script>
