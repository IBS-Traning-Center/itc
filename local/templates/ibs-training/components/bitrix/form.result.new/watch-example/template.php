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
						ФИО 
						</div>
                        <input type="text" name="form_text_709" value="">
				</div>
				<div class="form-section">
                        <div class="label req">
                            Контактный телефон
                        </div>
                        <input type="text" name="form_text_710" value="">
				</div>
				<div class="form-section">
                          <div class="label req">
                            E-mail
                          </div>
                          <input type="text" name="form_text_711" value="">
				</div>
				<div class="form-section">
                          <div class="label">
                           Компания
                          </div>
                          <input type="text" name="form_text_712" value="">
				</div>
				<div class="form-section">
                          <div class="label req" >
                             Город
                          </div>
                          <input type="text" name="form_text_713" value="">
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
			
			  <label><input id="form-test-reg-agree" checked="checked" name="agree" value="Y" type="checkbox"/>Я даю свое согласие на обработку моих персональных данных.</label><br/><br/>
				<input  <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> class="main-test-button" type="submit" name="web_form_submit" value="Посмотреть" />
				


<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#form-test-reg-agree').change(function() {
			if ($(this).attr('checked')=="checked") {
				$('.main-test-button').removeAttr('disabled');
			} else {
				$('.main-test-button').attr('disabled', 'disabled');
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