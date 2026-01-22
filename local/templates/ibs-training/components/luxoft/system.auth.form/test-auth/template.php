<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ($arResult["FORM_TYPE"] == "login"):?>
<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
{
	ShowMessage($arResult['ERROR_MESSAGE']);
}
?>

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
	<p style="font-size: 14px;">Для прохождения теста необходимо авторизироваться на сайте</p>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="AUTH" />
	<div >
			<div class="form-section">
				<div class="label">
				E-mail:
				</div>
				<input style="width: 307px" type="text" name="USER_LOGIN" class="required email" maxlength="80" value="<?=$arResult["USER_LOGIN"]?>" size="30" /></td>
			</div>
			<div class="form-section">
				<div class="label">
				<?=GetMessage("AUTH_PASSWORD")?>:
				</div>
				<input style="width: 307px" type="password" name="USER_PASSWORD" class="required" maxlength="50" size="30" /></td>
			</div>
		
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
			<input type="submit" style="border:1px solid #AACFE4;margin:2px 0 15px 0px;padding:4px 2px; width:150px;" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" />
			
		

	</div>
</form>
 
</div>
</div>





<?else:?>
<p class="notetext">Вы зарегистрированы и успешно авторизовались.</p><br />

<p><a href="/">Вернуться на главную страницу</a></p>
<?endif?>