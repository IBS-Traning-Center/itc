<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>

	<div class="form-section">
								<input placeholder="ФИО" name="form_text_625" type="text"/>
							</div>
							<div class="form-section">
								<input placeholder="Контактный телефон" name="form_text_628" type="text"/>
							</div>
							<div class="form-section">
								<input placeholder="E-mail" name="form_email_630" type="text"/>
							</div>
							<div class="form-section">
								<input placeholder="Компания" name="form_text_626" type="text"/>
							</div>
							<div class="form-section">
								<input placeholder="Город" name="form_text_629" type="text"/>
							</div>
							<label class="agree-text" style="text-align: left;"><input id="form-reg-agree" checked="checked" name="agree" value="Y" type="checkbox"/> Настоящим я подтверждаю, что я ознакомлен с <a style="color: #535353; text-decoration: underline;" target="_blank" href="/terms-of-use/">Условиями использования</a>, условия мне понятны и я согласен соблюдать их.</label><br/>
							<label class="agree-text" style="text-align: left;"><input id="form-reg-two" checked="checked" name="agree-2" value="Y" type="checkbox"/> Я ознакомлен с порядком обработки моих персональных данных согласно <a style="color: #535353; text-decoration: underline;" target="_blank" href="/privacy-policy/">Политике в сфере персональных данных</a>.</label>
							<div class="submit-btn">
							<input class="btn main-test-button" type="submit" name="web_form_apply"  value="Заказать обратный звонок" />
							</div>

	
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>
<script type="text/javascript" >
    $(document).ready(function() {
		$('#form-reg-agree').change(function() {
			if ($(this).prop('checked')==true) {
				console.info($(this).prop('checked'));
				if ($('#form-reg-two').prop('checked')==true) {
					console.info($('#form-reg-two').prop('checked'));
					$('.main-test-button').removeAttr('disabled');
				}
			} else {
				console.info($(this).prop('checked'));
				$('.main-test-button').prop('disabled', 'disabled');
			}
		});
		$('#form-reg-two').change(function() {
			if ($(this).prop('checked')==true) {
				if ($('#form-reg-agree').prop('checked')==true) {
					$('.main-test-button').removeAttr('disabled');
				}
			} else {
				$('.main-test-button').prop('disabled', 'disabled');
			}
		});
	})
</script>