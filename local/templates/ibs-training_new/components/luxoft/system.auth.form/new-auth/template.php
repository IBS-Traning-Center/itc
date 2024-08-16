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
<div class="lux_training library-form">
<form method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
	
		<input type="hidden" name="backurl" value="/personal_test/learning/" />
	
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
	<div >
			<div style="" class="form-section">
				
				<input style="" placeholder="E-mail" type="text" name="USER_LOGIN" class="required email" maxlength="80" value="<?=$arResult["USER_LOGIN"]?>" size="30" />
			</div>
			<div  class="form-section">
			
				<input style="" placeholder="Пароль" style="width: 100%;" type="password" name="USER_PASSWORD" class="required" maxlength="50" size="30" />
			</div>
		
		<?
		if ($arResult["CAPTCHA_CODE"])
		{
		?>
			
				
				<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
				<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
				<input type="text" name="captcha_word" maxlength="50" value="" />
			
		<?
		}
		?>
		<div class="clearfix"></div>
		<label><input id="form-reg-agre" checked="checked" name="agree-3" value="Y" type="checkbox"/>Я хочу получать ежемесячный дайджест.</label><br/><br/>
		<input type="submit" class="sign-in" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" />
			
		

	</div>
</form>
</div>
</div>
<?else:?>
<?if ($_REQUEST["modalform"]=="yes") {?>
	<?LocalRedirect("/personal_test/learning/?utm_campaign=self_learning");?>
<?}?>
<p class="notetext">Вы зарегистрированы и успешно авторизовались.</p><br />
<p><a href="/">Вернуться на главную страницу</a></p>
<?endif?>