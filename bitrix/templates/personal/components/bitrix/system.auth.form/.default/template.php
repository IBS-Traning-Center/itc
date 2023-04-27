<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ($arResult["FORM_TYPE"] == "login"):?>
<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
{
	ShowMessage($arResult['ERROR_MESSAGE']);
}
?>

<div class="authorization-box">
<h1>Авторизация</h1>
<div class="white-box">
<?/*
<p>Авторизация необходима для оплаты курсов, онлайн тренингов и быстрой записи на различного рода мероприятия, проводимые Luxoft Training</p>*/?>
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
	<div class="row">
		<label for="lb01">Логин:</label>
		<input id="lb01" type="text" name="USER_LOGIN" maxlength="80" value="<?=$arResult["USER_LOGIN"]?>" size="30" />
	</div>
	<div class="row">
		<label for="lb02">Пароль:</label>
		<input id="lb02" type="password" name="USER_PASSWORD" maxlength="50" size="30" />
	</div>		
	<div class="check-box">
		<input type="checkbox" name="USER_REMEMBER" value="Y" id="lb03">
		<label for="lb03">Запомнить меня на этом компьютере</label>
	</div>	
	
		
		<?
		if ($arResult["CAPTCHA_CODE"])
		{
		?>
			<div class="row">
				<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
				<input type="text" name="captcha_word" maxlength="50" value="" />
			</div>
		<?
		}
		?>
			<div class="buttons">
				<button type="submit"  name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" />Войти</button>
				<a href="/auth/registration.html">Регистрация</a><br/>
				<a href="/auth/forgot_pass.html">Забыли пароль?</a>
			</div>
		
</form>
</div>
</div>

<?endif?>