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
<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>?" enctype="multipart/form-data">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
<input type="hidden" name="LOGIN" value=<?=$arResult["arUser"]["LOGIN"]?> />
<input type="hidden" name="EMAIL" value=<?=$arResult["arUser"]["EMAIL"]?> />

<div class="content-form profile-form w445">
<br />
	<div class="legend">Ваши данные</div>
	<div class="fields">
		<div class="field field-firstname">
			<label class="field-title"><?=GetMessage('NAME')?></label>
			<div class="form-input"><input type="text" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" /></div>
		</div>
		<div class="field field-lastname">
			<label class="field-title"><?=GetMessage('LAST_NAME')?></label>
			<div class="form-input"><input type="text" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" /></div>

		</div>
		<div class="field field-secondname">
			<label class="field-title"><?=GetMessage('SECOND_NAME')?></label>
			<div class="form-input"><input type="text" name="SECOND_NAME" maxlength="50" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" /></div>
		</div>


		<div class="field field-phone">
			<label class="field-title">Телефон</label>
			<div class="form-input"><input type="text" name="PERSONAL_PHONE" maxlength="50" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" /></div>
		</div>
		<div class="field field-city">
			<label class="field-title">Город</label>
			<div class="form-input"><input type="text" name="PERSONAL_CITY" maxlength="50" value="<?=$arResult["arUser"]["PERSONAL_CITY"]?>" /></div>
		</div>
		<div class="field field-company">
			<label class="field-title">Компания</label>
			<div class="form-input"><input type="text" name="WORK_COMPANY" maxlength="150" value="<?=$arResult["arUser"]["WORK_COMPANY"]?>" /></div>
		</div>
		<div class="field field-position">
			<label class="field-title">Должность</label>
			<div class="form-input"><input type="text" name="WORK_POSITION" maxlength="50" value="<?=$arResult["arUser"]["WORK_POSITION"]?>" /></div>
		</div>




	</div>
</div>
<div class="content-form profile-form w445">
	<div class="legend"><?=GetMessage("MAIN_PSWD")?></div>
	<div class="fields">
		<div class="field field-password_new">
			<label class="field-title"><?=GetMessage('NEW_PASSWORD_REQ')?></label>

			<div class="form-input"><input type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" /></div>

		</div>
		<div class="field field-password_confirm">
			<label class="field-title"><?=GetMessage('NEW_PASSWORD_CONFIRM')?></label>
			<div class="form-input"><input type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" /></div>

		</div>
	</div>
</div>

<div class="content-form profile-form w445">
	<div class="button"><input name="save" value="<?=GetMessage("MAIN_SAVE")?>"class="input-submit" type="submit"></div>
</div>
</form>