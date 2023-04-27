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
<form method="post" class="profile-form" name="form1" action="<?=$arResult["FORM_TARGET"]?>?" enctype="multipart/form-data">
<fieldset>
		
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
<input type="hidden" name="LOGIN" value=<?=$arResult["arUser"]["LOGIN"]?> />


	<?$percent=0;?>
	<div class="field">
			<div class="row">
				<label for="lb01">Имя:</label>
				<input type="text" id="lb01" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" />
				<?if (strlen($arResult["arUser"]["NAME"])>0) {?>
					<?$percent+=10;?>
				<?} else {?>
					<?$arNone[]=array("NAME"=>"Имя", "PERCENT"=> 10)?>
				<?}?>
			</div>
			<div class="row">
				<label for="lb02">Фамилия:</label>
				<input id="lb02" type="text" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" />
				<?if (strlen($arResult["arUser"]["LAST_NAME"])>0) {?>
					<?$percent+=10;?>
				<?} else {?>
					<?$arNone[]=array("NAME"=>"Фамилия", "PERCENT"=> 10)?>
				<?}?>
			</div>
			<div class="row">
				<label for="lb03">Отчество:</label>
				<input id="lb03" for="lb05" type="text" name="SECOND_NAME" maxlength="50" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" />
				<?if (strlen($arResult["arUser"]["SECOND_NAME"])>0) {?>
					<?$percent+=5;?>
				<?} else {?>
					<?$arNone[]=array("NAME"=>"Отчество", "PERCENT"=> 5)?>
				<?}?>
			</div>
	</div>
	<div class="field">
			<div class="row">
				<label for="lb04">Email:</label>
				<input id="lb04" type="text" name="EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>" title="">
				<?if (strlen($arResult["arUser"]["EMAIL"])>0) {?>
					<?$percent+=5;?>
				<?} else {?>
					<?$arNone[]=array("NAME"=>"Email", "PERCENT"=> 5)?>
				<?}?>
			</div>
			<div class="row">
				<label for="lb05">Телефон:</label>
				<input type="text" id="lb05" name="PERSONAL_PHONE" maxlength="50" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" />
				<?if (strlen($arResult["arUser"]["PERSONAL_PHONE"])>0) {?>
					<?$percent+=10;?>
				<?} else {?>
					<?$arNone[]=array("NAME"=>"Телефон", "PERCENT"=> 10)?>
				<?}?>
			</div>
			<div class="row">
				<label for="lb06">Город:</label>
				<input type="text" id="lb06" name="PERSONAL_CITY" maxlength="50" value="<?=$arResult["arUser"]["PERSONAL_CITY"]?>" />
				<?if (strlen($arResult["arUser"]["PERSONAL_CITY"])>0) {?>
					<?$percent+=10;?>
				<?} else {?>
					<?$arNone[]=array("NAME"=>"Город", "PERCENT"=> 10)?>
				<?}?>
			</div>
		<div class="row">
			<label for="lb07">Компания:</label>
			<input type="text" id="lb07" name="WORK_COMPANY" maxlength="150" value="<?=$arResult["arUser"]["WORK_COMPANY"]?>" />
			<?if (strlen($arResult["arUser"]["WORK_COMPANY"])>0) {?>
					<?$percent+=10;?>
				<?} else {?>
					<?$arNone[]=array("NAME"=>"Компания", "PERCENT"=> 10)?>
				<?}?>
		</div>
		<div class="row">
			<label for="lb08">Должность:</label>
			<input type="text" id="lb08" name="WORK_POSITION" maxlength="50" value="<?=$arResult["arUser"]["WORK_POSITION"]?>" />
			<?if (strlen($arResult["arUser"]["WORK_POSITION"])>0) {?>
					<?$percent+=10;?>
				<?} else {?>
					<?$arNone[]=array("NAME"=>"Должность", "PERCENT"=> 10)?>
				<?}?>
		</div>
		
	</div>
	<div class="field">
	<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
		<div class="row" style="position: relative; overflow: visible;">
			<?
            if ($FIELD_NAME=="UF_VKNICK") {
				if (strlen($arUserField["VALUE"])>0) {
					$percent+=10;
				} else {
					$arNone[]=array("NAME"=>"ID ВКонтакте", "PERCENT"=> 10);
				}
			} elseif ($FIELD_NAME=="UF_TWITTERNICK") {
                $percent+=10;
                continue;

				if (strlen($arUserField["VALUE"])>0) {
					$percent+=10;
				} else {
					$arNone[]=array("NAME"=>"ID Twitter", "PERCENT"=> 10);
				}
			} else {
                if ($FIELD_NAME=="UF_LINKEDIN_ID") {
                    continue;
                }
				if (strlen($arUserField["VALUE"])>0) {
					$percent+=10;
				} else {
					$arNone[]=array("NAME"=>"ID LinkedIn", "PERCENT"=> 10);
				}
			}?>
			<div class="hidden-podzk"><img src=<?if ($FIELD_NAME=="UF_VKNICK") {?>"/images/icon/vk-tooltip.png"<?} elseif  ($FIELD_NAME=="UF_TWITTERNICK") {?>"/images/icon/twitter-tooltip.png"<?} else {?>"/images/icon/linkjpg.jpg"<?}?>/></div>
			<label ><?=$arUserField["EDIT_FORM_LABEL"]?>: <img class="img-hover-show" src="/bitrix/js/main/core/images/hint.gif" style="margin-left: 5px;"></label>
			<?$APPLICATION->IncludeComponent(
						"bitrix:system.field.edit",
						$arUserField["USER_TYPE"]["USER_TYPE_ID"],
						array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y"));?>
		<div style="clear:both;"></div>
		</div>
		
		<?endforeach;?>	
		
	</div>
	<div class="field">
		<div class="row">
			<label><?=GetMessage('NEW_PASSWORD_REQ')?></label>
			<input type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" />
		</div>
		<div class="row">
			<label style="line-height: 1.1"><?=GetMessage('NEW_PASSWORD_CONFIRM')?></label>
			<input type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" />
		</div>
	</div>
	
		<div class="profile-fill">
			<div class="pr-header">
				Ваш профиль заполнен на <?=$percent?>%
			</div>
			<div class="line-wrap">
				<div class="line-white">
					<div class="bg-top-line"></div>
					<div style="width: <?=$percent?>%" class="bg-color-line"></div>
				</div>
			</div>
			<?if (count($arNone)>0) {?>
				<div>
					Вы можете указать:
				</div>
				<table class="plus-percent" cellpadding=0 cellspacing=0 border=0>
					<?foreach ($arNone as $key=>$arNoneItem) {?>
						<tr>
							<td class="first<?if ($key==0) {?> noline<?}?>">
								<?=$arNoneItem["NAME"]?>
							</td>
							<td class="sec<?if ($key==0) {?> noline<?}?>">
								+<?=$arNoneItem["PERCENT"]?>%
							</td>
						</tr>
					<?}?>
				</table>
			<?}?>
		</div>
			<?//echo $percent;?>
			<?//print_r($arNone);?>
		
<div class="bottom-buttons">
	<button name="save" value="<?=GetMessage("MAIN_SAVE")?>">Сохранить настройки</button>
	<a href="/personal_test/subscribe/">Настройки подписки</a>
</div>
</form>
<style>
.hidden-podzk {
	display: none;
	position: absolute;
	top: -35px;
	left: 0px;
	 box-shadow: 0 0 10px rgba(0,0,0,0.5);
}
.img-hover-show {
	cursor: pointer;
}
</style>
<script>
	$('.img-hover-show').mouseenter(function(){
		$(this).parent().parent().find('.hidden-podzk').css('display', 'block');
	})
	$('.img-hover-show').mouseleave(function(){
		$('.hidden-podzk').css('display', 'none');
	})
</script>