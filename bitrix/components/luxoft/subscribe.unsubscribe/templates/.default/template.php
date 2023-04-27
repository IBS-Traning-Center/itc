<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arParams["CONFIRM_UNSUBSCIBE"]=="Y" && $arResult["ERROR"]==""):?>

	<?= GetMessage("ASD_SUCCESS_UNSUBSCRIBE_L")?>.

<?elseif ($arResult["ERROR"] != ""):?>

	<?ShowError($arResult["ERROR"]);?>

<?else:?>
	<form>
		<h3>Укажитие, пожалуйста, причину, по которой вы хотите отписаться:</h3>
		<input type="hidden" name="mid" value="<?=$arParams["ASD_MAIL_ID"]?>"/>
		<input type="hidden" name="confirm" value="Y"/>
		<input type="hidden" name="mhash" value="<?=$arParams["ASD_MAIL_MD5"]?>"/>
		<input type="hidden" name="email" value="<?=$arResult["EMAIL"]?>"/>
		<input type="radio" name="reason" value='Письма приходят слишком часто'/>Письма приходят слишком часто<br/>
		<input type="radio" name="reason" value='Мне не интересна тема рассылки'/>Мне не интересна тема рассылки<br/>
		<input type="radio" name="reason" value='Я не подписывался на эту рассылку'/>Я не подписывался на эту рассылку<br/>
		<input type="radio" name="reason" value='Другое'/>Другое <input style="padding-top: 2px; padding-bottom: 2px;" type="text" name="another" /><br/>
		<br/>
		<input type="submit" name="sub" value="Отписаться"/>
		<br/>
	</form>
	<?//= GetMessage("ASD_CONFIRM_TEXT", array("#EMAIL#" => $arResult["EMAIL"], "#CONFIRM_URL#" => $arParams["CONFIRMED_URL"]))?>

<?endif?>