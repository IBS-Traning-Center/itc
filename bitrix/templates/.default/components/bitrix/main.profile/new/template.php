<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
//echo "<pre>"; print_r($arResult); echo "</pre>";
//exit();
//echo "<pre>"; print_r($_SESSION); echo "</pre>";

?>
<?=ShowError($arResult["strProfileError"]);?>
<?
if ($arResult['DATA_SAVED'] == 'Y')
	echo ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>
<form method="post" name="form1" class="form-reg margin-0" action="<?=$arResult["FORM_TARGET"]?>?" enctype="multipart/form-data">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
<input type="hidden" name="LOGIN" value=<?=$arResult["arUser"]["LOGIN"]?> />


<div class="content-form profile-form w445">
<div class="fields">
		<div class="form-section field-firstname">
			<div class="field-title label"><?=GetMessage('NAME')?></div>
			<div class="form-input"><input type="text" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" /></div>
		</div>
		<div class="form-section field-lastname">
			<div class="field-title label"><?=GetMessage('LAST_NAME')?></div>
			<div class="form-input"><input type="text" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" /></div>

		</div>
		<div class="form-section field-secondname">
			<div class="field-title label"><?=GetMessage('SECOND_NAME')?></div>
			<div class="form-input"><input type="text" name="SECOND_NAME" maxlength="50" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" /></div>
		</div>
<div class="form-section field-secondname">
			<div class="field-title label">Email</div>
			<div class="form-input"><input type="text" name="EMAIL" maxlength="50" value="<?=$arResult["arUser"]["EMAIL"]?>" /></div>
		</div>
			<div class="form-section field-city">
			<div class="field-title label">Country</div>
			<div class="form-input"><input type="text" name="PERSONAL_STATE" maxlength="50" value="<?=$arResult["arUser"]["PERSONAL_STATE"]?>" /></div>
		</div>
		<div class="form-section field-city">
			<div class="field-title label">City</div>
			<div class="form-input"><input type="text" name="PERSONAL_CITY" maxlength="50" value="<?=$arResult["arUser"]["PERSONAL_CITY"]?>" /></div>
		</div>
		<div class="form-section field-company">
			<div class="field-title label">Company</div>
			<div class="form-input"><input type="text" name="WORK_COMPANY" maxlength="150" value="<?=$arResult["arUser"]["WORK_COMPANY"]?>" /></div>
		</div>
		<div class="form-section field-position">
			<div class="field-title label">Position</div>
			<div class="form-input"><input type="text" name="WORK_POSITION" maxlength="50" value="<?=$arResult["arUser"]["WORK_POSITION"]?>" /></div>
		</div>

	</div>
</div>
<div class="content-form profile-form">
	
	<div class="fields">
		<div class="form-section field-password_new">
			<div class="field-title label"><?=GetMessage('NEW_PASSWORD_REQ')?></div>

			<div class="form-input"><input type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" /></div>

		</div>
		<div class="form-section field-password_confirm">
			<div class="field-title label"><?=GetMessage('NEW_PASSWORD_CONFIRM')?></div>
			<div class="form-input"><input type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" /></div>

		</div>
	</div>
</div>

<div class="content-form profile-form w445">
	<input name="save" value="<?=GetMessage("MAIN_SAVE")?>"class="btn sign-in btn-primary" style="margin-left:0" type="submit">
</div>
</form>