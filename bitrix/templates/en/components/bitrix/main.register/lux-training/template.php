<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//echo "<pre>"; print_r($arParams); print_r($arResult); echo "</pre>";
 //iwrite($arResult);
$tempVaraible = $arResult["SHOW_FIELDS"][0];
$arResult["SHOW_FIELDS"][0]     = $arResult["SHOW_FIELDS"][3];
$arResult["REQUIRED_FIELDS"][0] = $arResult["REQUIRED_FIELDS"][3];
//$arResult["SHOW_FIELDS"][3] = "---";
$arResult["SHOW_FIELDS"][3] = $tempVaraible;

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
<style type="text/css">
#stylized label {
	display:block;
	float:none;
	font-weight:bold;
	text-align:right;
	width:auto;
	text-align:left;
	margin:2px 0 2px 10px;
}
#stylized label  {
	font-weight:normal;
}
#stylized label.headers{
	font-weight:bold;
	margin:6px 0 0 10px;
}
#stylized h2 {
	margin: 3px 0 0px 10px;
}

#stylized input[type="radio"], #stylized input[type="checkbox"] {
	margin:0px 5px 0 10px;
	border:0 solid #AACFE4;
	padding:2px;


}
#stylized input {
	border:1px solid #AACFE4;
	float:none;
	font-size:16px;
	margin:2px 0 5px 10px;
}

#stylized textarea {
	float:none;
	margin:2px 0 5px 10px;
	width:400px;
}
#stylized textarea[name="form_textarea_795"] {
	height:40px;
}

#stylized input {
	width:auto;
}
#stylized input[type="text"] {
	width:400px;
	float:none;
	margin:2px 0 2px 10px;
}
#stylized input[type="file"] {
	float:none;
}
.spacer
{
	clear:both;
	height:1px;
}
.submit { margin-left: 12em; }

#stylized label.error {
	width:auto;
	margin:2px 0 2px 10px;
}
.myform {
	margin:0;
	padding:14px;
	width:430px;
}
#stylized input.but {
margin:20px 0 20px 120px;
width:200px;
}
#stylized p {
border-top:0px solid #B7DDF2;
border-bottom:0px solid #B7DDF2;
color:#666666;
font-size:11px;
margin:0 10px 5px 10px;
padding-top:4px 0 2px 0;
}
#stylized label.error {
margin:-3px 0 0 10px;
width:auto;
}
</style>
  <script>
$(document).ready(function(){
    $("#stylized form").validate({
		rules: {
			'REGISTER[PASSWORD]': {
				required: true,
				minlength: 6
			},
			'REGISTER[CONFIRM_PASSWORD]': {
				required: true,
				minlength: 6
			}
		},
		messages: {
			'REGISTER[PASSWORD]': {
				required: "Пожалуйста, введите пароль",
				minlength: "Пароль должен быть не менее 6 символов длиной."
			}
		}
	 });
});
</script>

<div  id="stylized" class="myform">
<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
<?
if (strlen($arResult["BACKURL"]) > 0)
{
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
}
?>


	<h2><?=GetMessage("AUTH_REGISTER")?></h2>

<?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
<? if ($FIELD !== "---"){?>
		<div <? if ($FIELD == $tempVaraible){?>style="display:none;"<? }?> >
			<label class="headers"><?=GetMessage("REGISTER_FIELD_".$FIELD)?><?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?> <span class="starrequired">*</span><?endif?>:</label>
			<?
	switch ($FIELD)
	{
		case "PASSWORD":
		case "CONFIRM_PASSWORD":
			?><input  <?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?>class="required"<?endif?> size="30" type="password" id="REGISTER[<?=$FIELD?>]" name="REGISTER[<?=$FIELD?>]" /><?
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
			?><input size="30" <?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?>class='required <? if ($FIELD == "EMAIL") echo 'email'; ?>'<?endif?>  type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?><? if ($FIELD == $tempVaraible){?>123<? } ?>" /><?
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
	}?>
		</div>
<? } ?>
<?endforeach?>
<?// ********************* User properties ***************************************************?>
<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
	<div><label><?=strLen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></label></div>
	<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
	<div><label><?if ($arUserField["MANDATORY"]=="Y"):?><span class="required">*</span><?endif;?>
		<?=$arUserField["EDIT_FORM_LABEL"]?>:</label>
			<?$APPLICATION->IncludeComponent(
				"bitrix:system.field.edit",
				$arUserField["USER_TYPE"]["USER_TYPE_ID"],
				array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y"));?></div>
	<?endforeach;?>
<?endif;?>
<?// ******************** /User properties ***************************************************?>
<?
/* CAPTCHA */
if ($arResult["USE_CAPTCHA"] == "Y")
{
	?>
			<label><?=GetMessage("REGISTER_CAPTCHA_TITLE")?></label>

				<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />

			<label><?=GetMessage("REGISTER_CAPTCHA_PROMT")?> <span class="starrequired">*</span>:</label>
			<input type="text" name="captcha_word" maxlength="50" value="" /></td>

	<?
}
/* CAPTCHA */
?>

			<input type="submit" class="but" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>" />
</form>
</div>