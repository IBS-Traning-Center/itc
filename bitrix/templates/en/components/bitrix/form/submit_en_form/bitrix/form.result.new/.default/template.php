<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<style type="text/css">
.vacancyitem
{
	border-bottom: 0px solid #eee;
}
</style>
<style type="text/css">

.spacer
{
	clear:both;
	height:1px;
}
</style>
<style type="text/css">


.submit { margin-left: 12em; }
em { font-weight: bold; padding-right: 1em; vertical-align: top; }
</style>

<script type="text/javascript" src="/bitrix/templates/en/jquery.validate.js"></script>
  <script>
  $(document).ready(function(){
    $("#submit_resume").validate();
  });
  </script>


<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>
<?=$arResult["FORM_NOTE"]?>
<?if ($arResult["isFormNote"] != "Y")
{
?>
<div id="stylized" class="myform">
<? $arResult["FORM_HEADER"] = str_replace("form name=\"resumeen\"", "form name=\"resumeen\" id=\"submit_resume\"", "$arResult[FORM_HEADER]"); ?>
<?=$arResult["FORM_HEADER"]?>
<? //print_r($arResult);
 ?>

<?
/***********************************************************************************
						form questions
***********************************************************************************/
?>
<h1>Send resume</h1>
<p>Please complete the form below. Mandatory fields marked <font color="red"><span class="form-required starrequired">*</span></font></p>


	<?
	$index=0;
    //print_r($arResult["QUESTIONS"]);

	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
    // echo "FIELD_SID=$FIELD_SID";
	?>
	   <? if (($index===0) or  ($index===1) or ($index===2) or ($index===3) or ($index===4)  )  {?>
		<label>
				<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
				<span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>
				<?endif;?>
				<?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><?=$arResult["REQUIRED_SIGN"];?><?endif;?>
				<?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
		</label>

		<?if ($FIELD_SID==="email") {
			$arQuestion["HTML_CODE"] = str_replace("class=\"inputtext\"","class=\"required email\"",$arQuestion["HTML_CODE"]); } ?>

			<?=$arQuestion["HTML_CODE"]?>

		<? } else { ?>
		 <label style="display:none">

				<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
				<span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>
				<?endif;?>
				<?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><?=$arResult["REQUIRED_SIGN"];?><?endif;?>
				<?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
		</label>
		 <? } ?>
	<? $index=$index+1;
	} //endwhile
	?>
<?
if($arResult["isUseCaptcha"] == "Y")
{
?>
		<label>
			<?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?>
		</label>

			<label><input type="hidden" name="captcha_sid" value="<?=htmlspecialchars($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialchars($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>
		</label>
		<label>
			<?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?>
			<input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
		</label>
<?
} // isUseCaptcha
?>


				<input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> class="but" type="submit" name="web_form_submit" value="<?=strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"];?>" />
				<?if ($arResult["F_RIGHT"] >= 15):?>
				&nbsp;<input type="hidden" name="web_form_apply" value="Y" />
			<!--	<input  type="submit" name="web_form_apply" value="<?=GetMessage("FORM_APPLY")?>" />      -->
				<?endif;?>
<div class="spacer"></div>





<?=$arResult["FORM_FOOTER"]?>
</div>
<?
} //endif (isFormNote)
?>


