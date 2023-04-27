<?$arMap=GetIblockElement($arResult["PROPERTIES"]["CONTACTS"]["VALUE"])?>
<?$coords=explode(",",$arMap["PROPERTIES"]["GOOGLE_MAP"]["VALUE"])?>
<?$coords["2"]=$coords["1"]-0.003?>
<div id="map-scroll" class="map-google">
	<div class="top-map-line">
		<div class="adress-wrap">
			<div class="adr-center-wrap">
				<div class="adr-content">
					<div class="adr-info-sec">
						<div class="adr-pict">
							<img src="/images/landing/map-coursor.jpg"/>
						</div>
						<div class="adr-text"><?=$arMap["PROPERTIES"]["ADDRESS"]["VALUE"]?></div>
						<div style="clear:both"></div>
					</div>
					<div class="adr-info-sec">
						<div class="adr-pict" style="padding-top: 5px;">
							<img src="/images/landing/phone-coursor.jpg"/>
						</div>
						<div class="adr-text"><?foreach ($arMap["PROPERTIES"]["PHONE"]["VALUE"] as $VALUE) {?><?=$VALUE?><br/><?}?></div>
						<div style="clear:both"></div>
					</div>
					<div class="adr-info-sec">
						<div class="adr-pict">
							<img src="/images/landing/mail-coursor.jpg"/>
						</div>
						<div class="adr-text"><a href="mailto:education@luxoft.com">education@luxoft.com</a></div>
						<div style="clear:both"></div>
					</div>
					<div class="adr-info-sec">
						<div class="adr-pict">
							<img src="/images/landing/attention.jpg"/>
						</div>
						<div class="adr-text">What visitors have to take with them to training</div>
						<div style="clear:both"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="main-map">
		<?$APPLICATION->IncludeComponent("bitrix:map.google.view","changed",Array(
        "INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => serialize( 
			   array( 
				  'google_lat' => $coords[0], 
				  'google_lon' => $coords[2], 
				  'google_scale' => 17, 
				  'PLACEMARKS' => array( 
					 array( 
						'TEXT' => "", 
						'LON' =>  $coords[1], 
						'LAT' => $coords[0], 
					 ), 
				  ), 
			   ) 
			),
        "MAP_WIDTH" => "100%",
        "MAP_HEIGHT" => "464",
        "CONTROLS" => array(
            "SMALL_ZOOM_CONTROL",
            "TYPECONTROL",
            "SCALELINE"
        ),
        "OPTIONS" => array(
            "ENABLE_DBLCLICK_ZOOM",
            "ENABLE_DRAGGING",
            "ENABLE_KEYBOARD"
        ),
        "MAP_ID" => "gm_1"
		)
		);?>
	</div>
	<div class="bottom-map-line"></div>
</div>
<div class="copyright">
	© <?=date('Y')?> LUXOFT-TRAINING
</div>
<div class="overlay" id="overlay-partner">
	<div class="over-head">СТАТЬ ПАРТНЕРОМ</div><div class="close"><img src="/images/landing/overlay-close.jpg"></div>
	<div style="clear:both"></div>
	<div class="overlay-content">Если вы хотите стать партнером мероприятия, напишите нам об этом на <a href="mailto:education@luxoft.com">education@luxoft.com</a></div>
</div>
<div class="overlay" id="overlay-form">
	<?$arCourse=GetIblockElement($arResult["PROPERTIES"]["COURSE"]["VALUE"]);?>
	<div class="over-head">РЕГИСТРАЦИЯ УЧАСТНИКА</div><div class="close"><img src="/images/landing/overlay-close.jpg"></div>
	<div style="clear:both"></div>
	<?GLOBAL $arInfo?>
	<?$arInfo["COURSE_ID"]=$arResult["PROPERTIES"]["COURSE"]["VALUE"];?>
	<?$arInfo["TIME_ID"]=$arResult["PROPERTIES"]["TIME_COURSE"]["VALUE"];?>
	<?$arTimeCourse=GetIblockElement($arResult["PROPERTIES"]["TIME_COURSE"]["VALUE"]);?>
	<?$arInfo["NAME"]=$arCourse["CODE"]." ".$arCourse["NAME"];?>
	<?$APPLICATION->IncludeComponent("edu:iblock.element.add.form.course", "landing", Array(
	"IBLOCK_TYPE" => "edu",	// Тип инфо-блока
	"IBLOCK_ID" => "64",	// Инфо-блок
	"STATUS_NEW" => "N",	// Деактивировать элемент
	"LIST_URL" => "",	// Страница со списком своих элементов
	"USE_CAPTCHA" => "N",	// Использовать CAPTCHA
	"USER_MESSAGE_EDIT" => "",	// Сообщение об успешном сохранении
	"USER_MESSAGE_ADD" => "Спасибо. Ваша заявка была успешно добавлена",	// Сообщение об успешном добавлении
	"DEFAULT_INPUT_SIZE" => "60",	// Размер полей ввода
	"PROPERTY_CODES" => array(	// Свойства, выводимые на редактирование
		0 => "NAME",
		1 => "248",
		2 => "244",
		3 => "246",
		4 => "243",
		5 => "245",
		6 => "247",
		7 => "249",
		8 => "271",
		9 => "313",
		10 => "345",
		11 => "407",
	),
	"PROPERTY_CODES_REQUIRED" => array(	// Свойства, обязательные для заполнения
		0 => "244",
		1 => "246",
		2 => "245",
		3 => "247",
		4 => "249",
	),
	"PROPERTY_CODES_HIDDEN" => array(	// Поля, которые недоступны для заполнения пользователю:
		0 => "248",
		1 => "243",
		2 => "271",
		3 => "313",
	),
	"PROPERTY_TYPE_EVENT" => "78",	// Тип события
	"PROPERTY_TEXT_TO_DO" => "Регистрация на данный курс",	// Надпись
	"PROPERTY_EVENT_NAME" => "",	// Название мероприятия (если точно известно)
	"PROPERTY_EVENT_CITY_IN" => "",	// Город ивента (если точно известен)
	"PROPERTY_EVENT_DATE_IN" => "",	// Дата (если точна известна)
	"GROUPS" => array(	// Группы пользователей, имеющие право на добавление/редактирование
		0 => "2",
	),
	"STATUS" => "ANY",	// Редактирование возможно
	"ELEMENT_ASSOC" => "CREATED_BY",	// Привязка к пользователю
	"MAX_USER_ENTRIES" => "100000",	// Ограничить кол-во элементов для одного пользователя
	"MAX_LEVELS" => "100000",	// Ограничить кол-во рубрик, в которые можно добавлять элемент
	"LEVEL_LAST" => "Y",	// Разрешить добавление только на последний уровень рубрикатора
	"MAX_FILE_SIZE" => "0",	// Максимальный размер загружаемых файлов, байт (0 - не ограничивать)
	"SEF_MODE" => "N",	// Включить поддержку ЧПУ
	"SEF_FOLDER" => "/training/catalog/",	// Каталог ЧПУ (относительно корня сайта)
	"CUSTOM_TITLE_NAME" => "Название курса",	// * наименование *
	"CUSTOM_TITLE_TAGS" => "",	// * теги *
	"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",	// * дата начала *
	"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",	// * дата завершения *
	"CUSTOM_TITLE_IBLOCK_SECTION" => "",	// * раздел инфоблока *
	"CUSTOM_TITLE_PREVIEW_TEXT" => "",	// * текст анонса *
	"CUSTOM_TITLE_PREVIEW_PICTURE" => "",	// * картинка анонса *
	"CUSTOM_TITLE_DETAIL_TEXT" => "",	// * подробный текст *
	"CUSTOM_TITLE_DETAIL_PICTURE" => "",	// * подробная картинка *
	"ANCHOR_PARAMETER" => "tab-record-link",
	"URL_FORM_PARAMETER" => "?SCHEDULE=Y",
	"SHOW_CITIES" => "N"
	),
	false
);?>
</div>
<div class="overlay" id="succes">
<div class="over-head">SING UP</div><div class="close"><img src="/images/landing/overlay-close.jpg"></div>
	<div style="clear:both"></div>
	<div class="overlay-content">
		You have been successfully registered to event.
	</div>
</div>
<?

$APPLICATION->SetTitle($arResult["NAME"]);
$APPLICATION->SetPageProperty("description", $arResult["PROPERTIES"]["META_DESC"]["VALUE"]);
$APPLICATION->SetPageProperty("title", $arResult["NAME"]);
?>
<?if (intval($_REQUEST["FORM_RESULT_ID"])>0) {?>
<script>
	$(document).ready(function() {
	 $("#succes").overlay({
		top: 260,
		mask: {
    // you might also consider a "transparent" color for the mask
		color: '#000',
     // load mask a little faster
		loadSpeed: 200,
     // very transparent
		opacity: 0.5
		},
 
    // disable this for modal dialog-type of overlays
		onLoad: function() {
		_gaq.push(['_trackEvent', 'register', 'master-class', 'succes']);
		yaCounter23056159.reachGoal('master-reg');
		//console.info('123');
		},
 
    // load it immediately after the construction
    load: true
 
    });
	
	})
</script>
<?}?>