<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ($arResult["FORM_TYPE"] == "login"):?>
<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
{
	ShowMessage($arResult['ERROR_MESSAGE']);
}
?>
<? if($arResult['NEW_USER_REGISTRATION'] == 'Y' && ($arResult['USE_OPENID'] == 'Y' || $arResult['USE_LIVEID'] == 'Y')){?>
<script type="text/javascript">

function SAFChangeAuthForm(v)
{
	document.getElementById('at_frm_bitrix').style.display = (v == 'bitrix') ? 'block' : 'none';
	<? if ($arResult['USE_OPENID'] == 'Y') { ?>document.getElementById('at_frm_openid').style.display = (v == 'openid') ? 'block' : 'none';<?}?>
	<? if ($arResult['USE_LIVEID'] == 'Y') { ?>document.getElementById('at_frm_liveid').style.display = (v == 'liveid') ? 'block' : 'none';<?}?>
}

</script>
<table border="0" cellpadding="0" cellspacing="0">
<form id="choosemethod">
<tr>
	<td><input type="radio" id="auth_type_frm_bitrix" name="BX_AUTH_TYPE" value="bitrix" onclick="SAFChangeAuthForm(this.value)" checked></td>
	<td><label for="auth_type_frm_bitrix"><?=GetMessage('AUTH_A_INTERNAL')?></label></td>
</tr>
<? if ($arResult['USE_OPENID'] == 'Y') { ?>
<tr>
	<td><input type="radio" id="auth_type_frm_openid" name="BX_AUTH_TYPE" value="openid" onclick="SAFChangeAuthForm(this.value)"></td>
	<td><label for="auth_type_frm_openid"><?=GetMessage('AUTH_A_OPENID')?></label></td>
</tr>
<? } ?>
<? if ($arResult['USE_LIVEID'] == 'Y') { ?>
<tr>
	<td><input type="radio" id="auth_type_frm_liveid" name="BX_AUTH_TYPE" value="liveid" onclick="SAFChangeAuthForm(this.value)"></td>
	<td><label for="auth_type_frm_liveid"><?=GetMessage('AUTH_A_LIVEID')?></label></td>
</tr>
<? } ?>
</form>
</table>
<?}?>
<script>
$(document).ready(function(){
    /*$(".lux_training form").validate({


	 });*/
});
</script>
<style>
.lux_training form label.error {
	color:#FF0000;
	display:block;
	font-weight:normal;
	margin:-4px 0 10px;
	padding:0;
	text-align:left;
	vertical-align:top;
	width:100%;
}
</style>
<div id="at_frm_bitrix">
<div class="lux_training">
<form method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
	<?
	if (strlen($arResult["BACKURL"]) > 0)
	{
	?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<?
	}
	?>
	<?
	foreach ($arResult["POST"] as $key => $value)
	{
	?>
	<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
	<?
	}
	?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="AUTH" />
	<table width="95%">
			<tr>
				<td colspan="2">
				E-mail:<br />
				<input type="text" name="USER_LOGIN" class="required email" maxlength="80" value="<?=$arResult["USER_LOGIN"]?>" size="30" /></td>
			</tr>
			<tr>
				<td colspan="2">
				<?=GetMessage("AUTH_PASSWORD")?>:<br />
				<input type="password" name="USER_PASSWORD" class="required" maxlength="50" size="30" /></td>
			</tr>
		<?
		if ($arResult["STORE_PASSWORD"] == "Y")
		{
		?>
			<tr>
				<td valign="top"><input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" /></td>
				<td width="100%"><label for="USER_REMEMBER_frm"><?=GetMessage("AUTH_REMEMBER_ME")?></label></td>
			</tr>
		<?
		}
		?>
		<?
		if ($arResult["CAPTCHA_CODE"])
		{
		?>
			<tr>
				<td colspan="2">
				<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
				<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
				<input type="text" name="captcha_word" maxlength="50" value="" /></td>
			</tr>
		<?
		}
		?>
			<tr>
				<td colspan="2"><br /><input type="submit" style="border:1px solid #AACFE4;margin:2px 0 15px 0px;padding:4px 2px; width:150px;" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /></td>
			</tr>
		<?
		if($arResult["NEW_USER_REGISTRATION"] == "Y")
		{
		?>
			<tr>
				<td colspan="2"><a href="<?=$arResult["AUTH_REGISTER_URL"]?>"><?=GetMessage("AUTH_REGISTER")?></a><br /></td>
			</tr>
		<?
		}
		?>

			<tr>
				<td colspan="2"><a href="/auth/?forgot_password=yes"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a></td>
			</tr>
	</table>
</form>
</div>
</div>

<? if($arResult['NEW_USER_REGISTRATION'] == 'Y' && $arResult['USE_OPENID'] == 'Y'){?>
<div id="at_frm_openid" style="display: none">
<form method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
	<table width="95%">
			<tr>
				<td colspan="2">
				<?=GetMessage("AUTH_OPENID")?>:<br />
				<input type="text" name="OPENID_IDENTITY" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" size="17" /></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /></td>
			</tr>

	</table>
</form>
</div>
<?}?>

<? if($arResult['NEW_USER_REGISTRATION'] == 'Y' && $arResult['USE_LIVEID'] == 'Y'){?>
<div id="at_frm_liveid" style="display: none">
<a href="<?=$arResult['LIVEID_LOGIN_LINK']?>"><?=GetMessage('AUTH_LIVEID_LOGIN')?></a>
</div>
<?}?>

<?else:?>
<p class="notetext">Вы зарегистрированы и успешно авторизовались.</p><br />

<p><a href="/">Вернуться на главную страницу</a></p>
<?endif?>