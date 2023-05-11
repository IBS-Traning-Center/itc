<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?

ShowMessage($arParams["~AUTH_RESULT"]);
//print_r($arResult);
?>
<?if (isset($arResult["EMAIL"]) and (strlen($arResult["EMAIL"])>0)) {?>
<strong>Информация для смены пароля выслана на указанный Email.</strong><br /><p> Проверьте, пожалуйста, ваш Email.
 В  письме от Учебного Центра Luxoft  Вы найдете ссылку, после перехода по которой у Вас появится возможность задать новый пароль</p>

 <?} else {?>
<div class="lux_training">
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
				<td colspan="2"><b><?=GetMessage("AUTH_GET_CHECK_STRING")?></b><br /><br /></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Ваш E-Mail:<br />
					<input type="text" name="USER_EMAIL" maxlength="255"   size="30"  />
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="2"><br />
					<input type="submit" style="border:1px solid #AACFE4;margin:2px 0 15px 0px;padding:4px 2px; width:150px;" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>" />
				</td>
			</tr>
		</tfoot>
	</table>
</form>
</div>
<? } ?>


