<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//echo "<pre>"; print_r($arParams); print_r($arResult); echo "</pre>";
 //iwrite($arResult);
$tempVaraible = $arResult["SHOW_FIELDS"][0];
$arResult["SHOW_FIELDS"][0]     = $arResult["SHOW_FIELDS"][3];
$arResult["REQUIRED_FIELDS"][0] = $arResult["REQUIRED_FIELDS"][3];
//$arResult["SHOW_FIELDS"][3] = "---";
$arResult["SHOW_FIELDS"][3] = $tempVaraible;
$arResult["SHOW_FIELDS"]=array("NAME", "LAST_NAME", "EMAIL", "PASSWORD", "PERSONAL_CITY", "CONFIRM_PASSWORD", "LOGIN");
$arResult["REQUIRED_FIELDS"] =array("NAME", "LAST_NAME", "EMAIL", "PASSWORD", "PERSONAL_CITY", "CONFIRM_PASSWORD", "LOGIN");
/*echo "<pre>";
print_r($arResult);*/
if (count($arResult["ERRORS"]) > 0)
{
	foreach ($arResult["ERRORS"] as $key => $error)
	{
		if (intval($key) <= 0) $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", GetMessage("REGISTER_FIELD_".$key), $error);
	}

	ShowError(implode("<br />", $arResult["ERRORS"]));
}
elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y")
{
	?><p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p><?
}?>
<div class="lux_training">
<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
<?
if (strlen($arResult["BACKURL"]) > 0)
{
?>
	<input type="hidden" name="backurl" value="/personal_test/learning/" />
<?
}
?>
  <script>
$(document).ready(function(){
    $('.lux_training form').validate({
		rules: {
			'REGISTER[PASSWORD]': {
				required: true,
				minlength: 6
			},
			'REGISTER[CONFIRM_PASSWORD]': {
				required: true,
				minlength: 6
			},
			'REGISTER[NAME]': {
				required: true
			},
			'REGISTER[LAST_NAME]': {
				required: true
			},
			'REGISTER[EMAIL]': {
				required: true
			}, 
			'REGISTER[PERSONAL_CITY]': {
				required: true
			}, 
		},
		messages: {
			'REGISTER[PASSWORD]': {
				required: "Это поле обязательно для заполнения",
				minlength: ""
			}
		}
	 });
	 $('input[name="REGISTER[EMAIL]"]').change(function() {
		$('input[name="REGISTER[LOGIN]"]').val($(this).val());
	 });
});
</script>
<?$k=1?>
<?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>


<? if ($FIELD !== "---"){?>
		<div style="float: left; <?if ($k!=2) {?>margin-right: 80px;<?}?><?if ($FIELD=="LOGIN") {?>display: none;<?}?>" class="form-section">
				<div class="label">
				<?=GetMessage("REGISTER_FIELD_".$FIELD)?><span class="starrequired">*</span>
				</div>
				
			<?
	switch ($FIELD)
	{
		case "PASSWORD":
		case "CONFIRM_PASSWORD":
			?><input style="width: 250px"  size="30" type="password" name="REGISTER[<?=$FIELD?>]" /><?
		break;

		case "PERSONAL_GENDER":
			?><select name="REGISTER[<?=$FIELD?>]">
				<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
				<option value="M"<?=$arResult["VALUES"][$FIELD] == "M" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_MALE")?></option>
				<option value="F"<?=$arResult["VALUES"][$FIELD] == "F" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
			</select><?
		break;

		case "PERSONAL_COUNTRY":
			//echo "<pre>"; print_r($arResult["COUNTRIES"]); echo "</pre>";
			?><select name="REGISTER[<?=$FIELD?>]"><?
			foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value)
			{
				?><option value="<?=$value?>"<?if ($value == $arResult["VALUES"][$FIELD]):?> selected="selected"<?endif?>><?=$arResult["COUNTRIES"]["reference"][$key]?></option>
			<?
			}
			?></select><?
		break;

		case "PERSONAL_PHOTO":
		case "WORK_LOGO":
			?><input size="30" type="file" name="REGISTER_FILES_<?=$FIELD?>" /><?
		break;

		case "PERSONAL_NOTES":
		case "WORK_NOTES":
			?><textarea cols="30" rows="5" name="REGISTER[<?=$FIELD?>]"><?=$arResult["VALUES"][$FIELD]?></textarea><?
		break;
		default:
			if ($FIELD == "PERSONAL_BIRTHDAY"):?><small><?=$arResult["DATE_FORMAT"]?></small><br /><?endif;
			?><input style="width: 250px"  size="30" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?><? if ($FIELD == $tempVaraible){?>123<? } ?>" /><?
				if ($FIELD == "PERSONAL_BIRTHDAY")
					$APPLICATION->IncludeComponent(
						'bitrix:main.calendar',
						'',
						array(
							'SHOW_INPUT' => 'N',
							'FORM_NAME' => 'regform',
							'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
							'SHOW_TIME' => 'N'
						),
						null,
						array("HIDE_ICONS"=>"Y")
					);
				?><?
	}?></div>
<? } ?>
<?if ($k==2) {?><div class="clearfix"></div><?}?>
<?$k++?>
<?if ($k==3) {?>
	<?$k=1;?>
<?}?>
<?endforeach?>
<div class="clearfix"></div>
<?// ********************* User properties ***************************************************?>
<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
	<tr><td colspan="2"><?=strLen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></td></tr>
	<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
	<tr><td><?if ($arUserField["MANDATORY"]=="Y"):?><span class="required">*</span><?endif;?>
		<?=$arUserField["EDIT_FORM_LABEL"]?>:</td><td>
			<?$APPLICATION->IncludeComponent(
				"bitrix:system.field.edit",
				$arUserField["USER_TYPE"]["USER_TYPE_ID"],
				array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y"));?></td></tr>
	<?endforeach;?>
<?endif;?>
<?// ******************** /User properties ***************************************************?>
<?
/* CAPTCHA */
if ($arResult["USE_CAPTCHA"] == "Y")
{
	?>
		<tr>
			<td colspan="2"><b><?=GetMessage("REGISTER_CAPTCHA_TITLE")?></b></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
			</td>
		</tr>
		<tr>
			<td><?=GetMessage("REGISTER_CAPTCHA_PROMT")?> <span class="starrequired">*</span>:</td>
			<td><input type="text" name="captcha_word" maxlength="50" value="" /></td>
		</tr>
	<?
}
/* CAPTCHA */
?>
<label><input id="" checked="checked" name="subscribe" value="Y" type="checkbox"/>Я хочу получать ежемесячный дайджест.</label><br/>
<label><input id="form-reg-agree1" checked="checked" name="agree" value="Y" type="checkbox"/>Я даю свое согласие на обработку моих персональных данных.</label><br/><br/>	
<input type="submit" class="reg-modal-btn main-button" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>" /></td>

</form>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#form-reg-agree1').change(function() {
			if ($(this).attr('checked')=="checked") {
				$('.reg-modal-btn').removeAttr('disabled');
			} else {
				$('.reg-modal-btn').attr('disabled', 'disabled');
			}
		});
	});
</script>