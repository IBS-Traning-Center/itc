<div id="footer">
	<p>&copy; 2020 LUXOFT TRAINING</p>
	<a href="#" class="top">top</a>
	<ul class="social">
		<?$share_title=$arResult["NAME"];?>
        <li><a class="vk" target="_blank" href="http://vkontakte.ru/share.php?&description=<?=rawurlencode(iconv("windows-1251", "UTF-8", "Luxoft Training: Курсы и тренинги для программистов, аналитиков, менеджеров проектов, тестировщиков."))?>&title=<?=rawurlencode(iconv("windows-1251", "UTF-8", $share_title))?>&url=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>&noparse=false">vk</a></li>
		<li><a class="twitter" target="_blank" href="https://twitter.com/share?&text=<?=rawurlencode(iconv("windows-1251", "UTF-8", $share_title))?>&url=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>&redirect_uri=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>"">twitter</a></li>
		<li><a class="linkedin" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>&title=<?=rawurlencode(iconv("windows-1251", "UTF-8", $share_title))?>&summary=<?=rawurlencode(iconv("windows-1251", "UTF-8", 'Luxoft Training: Курсы и тренинги для программистов, аналитиков, менеджеров проектов, тестировщиков.'))?>"">linkedin</a></li>
		<li><a class="google" target="_blank" href="https://www.youtube.com/channel/UC9Dr4GhYRy3sCsr-t_Vwkhg">google</a></li>
	</ul>
	<div class="overlay" id="overlay-form">
		<?$arCourse=GetIblockElement($arResult["PROPERTIES"]["COURSE"]["VALUE"]);?>
		<div class="close"><img src="../images/ico-close.png"></div>
		<div class="over-head"><?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>РЕГИСТРАЦИЯ УЧАСТНИКА<?} else {?>REGISTRATION FORM<?}?></div>
		<div style="clear:both"></div>
		<?GLOBAL $arInfo?>
		<?$arInfo["COURSE_ID"]=$arResult["PROPERTIES"]["COURSE"]["VALUE"];?>
		<?$arInfo["TIME_ID"]=$arResult["PROPERTIES"]["TIME_COURSE"]["VALUE"];?>
		<?$arTimeCourse=GetIblockElement($arResult["PROPERTIES"]["TIME_COURSE"]["VALUE"]);?>
		<?$arInfo["NAME"]=$arCourse["CODE"]." ".$arCourse["NAME"];?>
		<?$arInfo["LANDING_NAME"]=$arResult["NAME"]?>
		<?$arInfo["LANDING_ID"]=$arResult["ID"]?>
		<?$arInfo["LANDING_DURATION"]=$arResult["PROPERTIES"]["SCHOOL_DURATION"]?>
		<?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>
			<?$template="landing";?>
		<?} else {?>
			<?$template="landing_en";?>
		<?}?>
		<?$APPLICATION->IncludeComponent(
			"edu:iblock.element.add.form.course",
			"landing-quiz",
			array(
				"IBLOCK_TYPE" => "edu",
				"IBLOCK_ID" => "64",
				"STATUS_NEW" => "N",
				"LIST_URL" => "",
				"USE_CAPTCHA" => "N",
				"USER_MESSAGE_EDIT" => "",
				"USER_MESSAGE_ADD" => "Спасибо. Ваша заявка была успешно добавлена",
				"DEFAULT_INPUT_SIZE" => "60",
				"PROPERTY_CODES" => array(
					0 => "243",
					1 => "244",
					2 => "245",
					3 => "246",
					4 => "247",
					5 => "248",
					6 => "249",
					7 => "271",
					8 => "345",
					9 => "811",
					10 => "812",
					11 => "NAME",
				),
				"PROPERTY_CODES_REQUIRED" => array(
					0 => "244",
					1 => "245",
					2 => "246",
					3 => "247",
					4 => "249",
				),
				"PROPERTY_CODES_HIDDEN" => array(
					0 => "243",
					1 => "248",
					2 => "271",
				),
				"PROPERTY_TYPE_EVENT" => "316",
				"PROPERTY_TEXT_TO_DO" => "Регистрация на квиз",
				"PROPERTY_EVENT_NAME" => "",
				"PROPERTY_EVENT_CITY_IN" => "",
				"PROPERTY_EVENT_DATE_IN" => "",
				"GROUPS" => array(
					0 => "2",
				),
				"STATUS" => "ANY",
				"ELEMENT_ASSOC" => "CREATED_BY",
				"MAX_USER_ENTRIES" => "100000",
				"MAX_LEVELS" => "100000",
				"LEVEL_LAST" => "Y",
				"MAX_FILE_SIZE" => "0",
				"SEF_MODE" => "N",
				"SEF_FOLDER" => "/training/catalog/",
				"CUSTOM_TITLE_NAME" => "",
				"CUSTOM_TITLE_TAGS" => "",
				"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
				"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
				"CUSTOM_TITLE_IBLOCK_SECTION" => "",
				"CUSTOM_TITLE_PREVIEW_TEXT" => "",
				"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
				"CUSTOM_TITLE_DETAIL_TEXT" => "",
				"CUSTOM_TITLE_DETAIL_PICTURE" => "",
				"ANCHOR_PARAMETER" => "tab-record-link",
				"URL_FORM_PARAMETER" => "?SCHEDULE=Y",
				"SHOW_CITIES" => "N",
				"COMPONENT_TEMPLATE" => "landing-quiz"
			),
			false
		);?>
	</div>
</div>

	<?$APPLICATION->SetTitle($arResult["NAME"]);
	$APPLICATION->SetPageProperty("title", $arResult["NAME"]);
	?>
