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
                    <input placeholder="Фамилия, имя, отчество" type="text" name="form_text_715" value="">
				</div>
				<div class="form-section">
                    <input type="text" placeholder="Контактный телефон" name="form_text_716" value="">
				</div>
				<div class="form-section">
                    <input type="text" placeholder=" E-mail" name="form_email_717" value="">
				</div>
				<div class="form-section">
                    <input type="text" placeholder="Компания"  name="form_text_718" value="">
				</div>
				<div class="form-section">
                     <input type="text" placeholder="Город" name="form_text_719" value="">
				</div>

<?
if($arResult["isUseCaptcha"] == "Y")
{
?>
		<tr>
			<th colspan="2"><b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b></th>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>
		</tr>
		<tr>
			<td><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></td>
			<td><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></td>
		</tr>
<?
} // isUseCaptcha
?>
			
			  <label class="agree-text"><input id="form-test-reg-agree" checked="checked" name="agree" value="Y" type="checkbox"/>Я даю свое согласие на обработку моих персональных данных.</label>
				<input  <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> class="main-test-button sign-in" type="submit" name="web_form_submit" value="Отправить" />
				


<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#form-test-reg-agree').change(function() {
			if ($(this).prop('checked')==true) {
				$('.main-test-button').removeProp('disabled');
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