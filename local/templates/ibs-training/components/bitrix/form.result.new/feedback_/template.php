<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script type="text/javascript" src="/bitrix/templates/.default/en/jquery.validate.js"></script>
<script>
	$(document).ready(function(){
		$("#submit_contacts").validate();
	});
</script>
<style>
#stylized label {
	width:110px;
}
#stylized input {
	width:300px;
}
#stylized input.check {
	width:10px;
	margin:2px 0 0 15px;
}
#stylized input.but {
	margin-left:120px;
	width:125px;
	float:none;
}
.myform{
	overflow:visible;
	width:440px;
}
#stylized textarea {
	width:300px;
}
</style>
<?//print_r($arResult);
?>
<!--<h2><?=$arResult["FORM_NOTE"]?></h2>-->
<?if (($arResult["isFormNote"] == "Y")  and ($arResult["isFormErrors"]=="N") and $_GET["formresult"]=="addok"){?>
<h2>Спасибо большое за Ваш отзыв. <br />

</h2>

<? } ?>
<?if ($arResult["isFormNote"] != "Y") {?>
<div id="stylized" class="myform">
<?if ($arResult["isFormErrors"] == "Y"):?>
	<?=$arResult["FORM_ERRORS_TEXT"];?>
<?endif;?>
<? $arResult["FORM_HEADER"] = str_replace("form name=\"feedback\"", "form name=\"feedback\" id=\"submit_contacts\"", "$arResult[FORM_HEADER]"); ?>
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
		<label>
					<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
					<span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>
					<?endif;?>
					<?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><?=$arResult["REQUIRED_SIGN"];?><?endif;?>
					<?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
         </label>
         <?if ($FIELD_SID==="email"):?>
         	<?$arQuestion["HTML_CODE"] = str_replace("class=\"inputtext\"","class=\"required email\"",$arQuestion["HTML_CODE"]); ?>
         <?endif;?>
         <?if ($arQuestion["REQUIRED"] == "Y"):?>
         	<?$arQuestion["HTML_CODE"] = str_replace("class=\"inputtext\"","class=\"required\"",$arQuestion["HTML_CODE"]); ?>
         <?endif;?>
			<?=$arQuestion["HTML_CODE"]?>

<div class="clear"></div>
		<? } ?>

		<? if($arResult["isUseCaptcha"] == "Y") {  ?>
		<strong><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></strong>
				<input type="hidden" name="captcha_sid" value="<?=htmlspecialchars($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialchars($arResult["CAPTCHACode"]);?>" width="180" height="40" />
				<?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?>
				<input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
		<? } ?>
		<input class="but" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=strlen(trim($arResult['arForm']['BUTTON'])) <= 0 ? GetMessage('FORM_ADD') : $arResult['arForm']['BUTTON'];?>" />
		<? if ($arResult["F_RIGHT"] >= 15):?>&nbsp;
			<input type="hidden" name="web_form_apply" value="Y" />
			<!--<input type="submit" name="web_form_apply" value="<?=GetMessage("FORM_APPLY")?>" />-->
		<?endif;?>
		&nbsp;
		
	<?=$arResult["FORM_FOOTER"]?>

</div>
<? } ?>
<div class="clear"></div><br />