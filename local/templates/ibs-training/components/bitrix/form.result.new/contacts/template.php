<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<script>
	$(document).ready(function(){
		$("#submit_contacts").validate();
	});
</script>
<style>
#stylized label {
	width:100%;
}
#stylized input {
    width: 100%;
    background: none;
    border-radius: 3px;
    margin-top: 5px;
    padding-left: 10px;
    border: 1px solid #7a8891;
}
#stylized input.check {
	width:10px;
	margin:2px 0 0 15px;
}
#stylized input.but {
	margin-left:110px;
	width:125px;
	float:none;
	background: #f28535;
}
#stylized textarea{
    background: none;
    outline: none;
    border: 1px solid #7a8891;
    border-radius: 3px;
    width: 100%;
    padding: 10px 10px;
    margin-top: 5px;
}
.myform{
	overflow:visible;
	width:440px;
}
</style>
<?//print_r($arResult);
?>
<h2><?=$arResult["FORM_NOTE"]?></h2>
<?if (($arResult["isFormNote"] == "Y")  and ($arResult["isFormErrors"]=="N") and $_GET["formresult"]=="addok"){?>
 <p>Спасибо большое за Ваш вопрос. Сотрудник Учебного Центра свяжется с Вами в ближайшее время.<br />
   <span class="links"><a href="/mail/form.html">Задать еще один вопрос</a></span>
 </p>

<? } ?>
<?if ($arResult["isFormNote"] != "Y") {?>
<div id="stylized" class="myform">
<?if ($arResult["isFormErrors"] == "Y"):?>
	<?=$arResult["FORM_ERRORS_TEXT"];?>
<?endif;?>
<? $arResult["FORM_HEADER"] = str_replace("form name=\"contacts\"", "form name=\"contacts\" id=\"submit_contacts\"", "$arResult[FORM_HEADER]"); ?>
	<?=$arResult["FORM_HEADER"]?>
		<? if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y") {?>
			<? if ($arResult["isFormTitle"]) {?>

			<? } ?>
			<? if ($arResult["isFormImage"] == "Y"){ ?>
				<a href="<?=$arResult["FORM_IMAGE"]["URL"]?>" target="_blank" alt="<?=GetMessage("FORM_ENLARGE")?>"><img src="<?=$arResult["FORM_IMAGE"]["URL"]?>" <?if($arResult["FORM_IMAGE"]["WIDTH"] > 300):?>width="300"<?elseif($arResult["FORM_IMAGE"]["HEIGHT"] > 200):?>height="200"<?else:?><?=$arResult["FORM_IMAGE"]["ATTR"]?><?endif;?> hspace="3" vscape="3" border="0" /></a>
			<? } ?>
			<?=$arResult["FORM_DESCRIPTION"]?>
			<!--<?=$arResult["REQUIRED_SIGN"];?>-<?=GetMessage("FORM_REQUIRED_FIELDS")?>-->

		<? } ?>


		<? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) { ?>
		<?//print_r($arQuestion);
		?>
		<div class="form-section">
		<div class="label">
					<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
					<span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>
					<?endif;?>
					<?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><?=$arResult["REQUIRED_SIGN"];?><?endif;?>
					<?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
         </div>
         <?if ($FIELD_SID==="email"):?>
         	<?$arQuestion["HTML_CODE"] = str_replace("class=\"inputtext\"","class=\"required email\"",$arQuestion["HTML_CODE"]); ?>
         <?endif;?>
         <?if ($arQuestion["REQUIRED"] == "Y"):?>
         	<?$arQuestion["HTML_CODE"] = str_replace("class=\"inputtext\"","class=\"required\"",$arQuestion["HTML_CODE"]); ?>
         <?endif;?>
			<?=$arQuestion["HTML_CODE"]?>
		</div>
		<? } ?>

<label class="agree-text"><div class="jq-checkbox checked" id="form-reg-agree-styler"><input id="form-reg-agree" checked="checked" name="agree" value="Y" type="checkbox"><div class="jq-checkbox__div"></div></div><span style="color:#000">Настоящим я подтверждаю, что я ознакомлен с <a style="color: #535353; text-decoration: underline;" target="_blank" href="/terms-of-use/">Условиями использования</a>, условия мне понятны и я согласен соблюдать их.</span></label>

<label class="agree-text"><div class="jq-checkbox checked" id="form-reg-two-styler"><input id="form-reg-two" checked="checked" name="agree-2" value="Y" type="checkbox"><div class="jq-checkbox__div"></div></div><span style="color:#000">Я ознакомлен с порядком обработки моих персональных данных согласно </span><a style="color: #535353; text-decoration: underline;" target="_blank" href="/privacy-policy/">Политике в сфере персональных данных</a>.</label>

		<? if($arResult["isUseCaptcha"] == "Y") {  ?>
		<strong><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></strong>
				<input type="hidden" name="captcha_sid" value="<?=htmlspecialchars($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialchars($arResult["CAPTCHACode"]);?>" width="180" height="40" />
				<?/*=GetMessage("FORM_CAPTCHA_FIELD_TITLE")*/?><?/*=$arResult["REQUIRED_SIGN"];*/?>
				<input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
		<? } ?>
		<input class="but main-test-button sign-in" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=strlen(trim($arResult['arForm']['BUTTON'])) <= 0 ? GetMessage('FORM_ADD') : Отправить;?>" />
		<? if ($arResult["F_RIGHT"] >= 15):?>&nbsp;
			<input type="hidden" name="web_form_apply" value="Y" />
			<!--<input type="submit" name="web_form_apply" value="<?=GetMessage("FORM_APPLY")?>" />-->
		<?endif;?>
		&nbsp;
<input class="checkspam" type="hidden" name="checkcap" value="iamnotbot">
		<!--<input type="reset" value="<?=GetMessage("FORM_RESET");?>" />-->
	<?=$arResult["FORM_FOOTER"]?>

</div>
<? } ?>
<div class="clear"></div><br />