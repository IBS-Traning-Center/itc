<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script type="text/javascript" src="/bitrix/templates/.default/en/jquery.validate.js"></script>
<script>
	$(document).ready(function(){
		$("#submit_feedback").validate();
	});
</script>
<style>
#stylized label {
	width:110px;
}
#stylized input {
	width:250px;
}
#stylized input.check {
	width:10px;
	margin:2px 0 0 15px;
}
#stylized input.but {
	margin-left:110px;
	width:125px;
	float:none;
}
.myform{
	overflow:visible;
	width:440px;
}
</style>

<h2><?=$arResult["FORM_NOTE"]?></h2>
<?if (($arResult["isFormNote"] == "Y")  and ($arResult["isFormErrors"]=="N") and $_GET["formresult"]=="addok"){?>
<p>Спасибо большое за Вашу заявку. Сотрудник Учебного Центра свяжется с Вами в ближайшее время.<br />
 <strong>Перейти:</strong><br />
   <span class="links"><a href="/">Главная страница</a></span><br />
   <span class="links"><a href="/timetable/">Расписание мероприятий</a></span> <br />
   <span class="links"><a href="/training/school/">Каталог Школ</a></span> <br />
   <span class="links"><a href="/contacts/">Адреса представительств Учебного Центра Luxoft</a></span> <br />
</p>
<? } ?>

<?if ($arResult["isFormNote"] != "Y") {?>
<div id="stylized" class="myform">
<?if ($arResult["isFormErrors"] == "Y"):?>
	<?=$arResult["FORM_ERRORS_TEXT"];?>
<?endif;?>
<? $arResult["FORM_HEADER"] = str_replace("form name=\"feedback\"", "form name=\"feedback\" id=\"submit_feedback\"", "$arResult[FORM_HEADER]"); ?>
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
 		<?if ($FIELD_SID==="class") {
			$arQuestion["HTML_CODE"] = "<input type=\"hidden\"  size=\"0\" value=\"\" name=\"form_text_624\" id=\"text_schools\" class=\"inputtext\"/>";
			$APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list",
				"edu_school_form_accordion",
				Array(
				"IBLOCK_TYPE" => "edu_schools",	// Тип инфо-блока
				"IBLOCK_ID" => "49",	// Инфо-блок
				"SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID раздела
				"SECTION_CODE" => "",	// Код раздела
				"COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
				"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
				"SECTION_URL" => "/training/school/#SECTION_ID#/",	// URL, ведущий на страницу с содержимым раздела
				"CACHE_TYPE" => "A",	// Тип кеширования
				"CACHE_TIME" => "3600",	// Время кеширования (сек.)
				"DISPLAY_PANEL" => "N",	// Добавлять в админ. панель кнопки для данного компонента
				"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
				),
				component
			);

			 } ?>

			<?=$arQuestion["HTML_CODE"]?>
		<? } ?>

		<? if($arResult["isUseCaptcha"] == "Y") {  ?>
		<strong><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></strong>
				<input type="hidden" name="captcha_sid" value="<?=htmlspecialchars($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialchars($arResult["CAPTCHACode"]);?>" width="180" height="40" />
				<?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?>
				<input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
		<? } ?>
		<input class="but" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=strlen(trim($arResult['arForm']['BUTTON'])) <= 0 ? GetMessage('FORM_ADD') : Отправить ;?>" />
		<? if ($arResult["F_RIGHT"] >= 15):?>&nbsp;
			<input type="hidden" name="web_form_apply" value="Y" />
			<!--<input type="submit" name="web_form_apply" value="<?=GetMessage("FORM_APPLY")?>" />-->
		<?endif;?>
		&nbsp;
		<!--<input type="reset" value="<?=GetMessage("FORM_RESET");?>" />-->
	<?=$arResult["FORM_FOOTER"]?>
</div>
<? } ?>

<div class="clear"></div><br />