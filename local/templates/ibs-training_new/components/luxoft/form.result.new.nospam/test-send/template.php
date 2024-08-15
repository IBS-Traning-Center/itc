<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>


<?
if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y")
{
?>
	<?
/***********************************************************************************
					form header
***********************************************************************************/
if ($arResult["isFormTitle"])
{
?>

<?
} //endif ;
}
?>
<?
/***********************************************************************************
						form questions
***********************************************************************************/
?>	
				<div class="form-section">
					<div class="label req">
						ФИО *
						</div>
                        <input type="text" name="form_text_687" value="">
				</div>
				<div class="form-section">
                        <div class="label req">
                            Контактный телефон *
                        </div>
                        <input type="text" name="form_text_688" value="">
				</div>
				<div class="form-section">
                          <div class="label req">
                            E-mail *
                          </div>
                          <input type="text" name="form_email_689" value="">
				</div>
				<div class="form-section">
                          <div class="label">
                           Компания
                          </div>
                          <input type="text" name="form_text_690" value="">
				</div>
				<div class="form-section">
                          <div class="label req" >
                             Город *
                          </div>
                          <input type="text" name="form_text_691" value="">
				</div>

<?
if($arResult["isUseCaptcha"] == "Y")
{
?>
		<tr>
			<th colspan="2"><b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b></th>
		</tr>
		<tr>
			<td> </td>
			<td><input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>
		</tr>
		<tr>
			<td><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></td>
			<td><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></td>
		</tr>
<?
} // isUseCaptcha
?>
			
			  
				<label class="agree-text" ><input id="form-reg-agree" checked="checked" name="agree" value="Y" type="checkbox"/>Настоящим я подтверждаю, что я ознакомлен с <a style="color: #535353; text-decoration: underline;" target="_blank" href="/terms-of-use/">Условиями использования</a>, условия мне понятны и я согласен соблюдать их.</label>
					<label class="agree-text" ><input id="form-reg-two" checked="checked" name="agree-2" value="Y" type="checkbox"/>Я ознакомлен с порядком обработки моих персональных данных согласно <a style="color: #535353; text-decoration: underline;" target="_blank" href="/privacy-policy/">Политике в сфере персональных данных</a>.</label>
			 
				<input  <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> class="main-test-button sign-in" type="submit" name="web_form_submit" value="Отправить" />
				<input class="checkspam" type="hidden" name="checkcap" value=""/>


<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>
<script type="text/javascript">
	$(document).ready(function() {
$('.checkspam').val('iamnotbot');
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
		$('form[name="testing_download"]').submit(function() {
			var val="";
			var error=0;
			$(this).find('.label.req').each(function() {
				val=$(this).parent().find('input').val();
				//alert(val);
				if (val.length>0) {
				} else {
					$(this).parent().addClass('error');
					error++
				}
								
			})
			if (error>0) {
					return false;
			}
		});
	});
</script>