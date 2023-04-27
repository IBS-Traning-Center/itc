<?$arMap=GetIblockElement($arResult["PROPERTIES"]["CONTACTS"]["VALUE"])?>
<?//$coords=explode(",",$arMap["PROPERTIES"]["GOOGLE_MAP"]["VALUE"])?>
<?if ($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["city"]["VALUE"]==CITY_ID_KIEV) {?>
	<?$coords["0"]="50.450304"?>
	<?$coords["1"]="30.410531"?>
	<?$arAdress["ADDRESS"]='ул. Радищева, 10/14, БЦ "Ирва", корп. Б, эт. 2'?>
	<?$arAdress["PHONE"]='+38 (044) 238-81-08 (доп. 3532, 6954)'?>
<?} elseif ($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["city"]["VALUE"]==CITY_ID_SPB) {?>
	<?$coords["0"]="59.9618152"?>
	<?$coords["1"]="30.4031138"?>
	<?$arAdress["ADDRESS"]='Свердловская наб., д. 44, лит. Я, БЦ "Осень"'?>
	<?$arAdress["PHONE"]='+7 (812) 457-1044 (доп. 6250, 6251, 5921, 6172)'?>
<?} elseif ($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["city"]["VALUE"]==CITY_ID_DNEPR) {?>
	<?$coords["0"]="48.46111598"?>
	<?$coords["1"]="35.04991919"?>
	<?$arAdress["ADDRESS"]='Екатерининский б-р, д. 2, БЦ "Босфор", эт. 4'?>
	<?$arAdress["PHONE"]='+38 (056) 787-12-21 (доп. 2841, 6954)'?>
<?} elseif ($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["city"]["VALUE"]==CITY_ID_OMSK) {?>
	<?$coords["0"]="54.95799807"?>
	<?$coords["1"]="73.39365542"?>
	<?$arAdress["ADDRESS"]='Омск, проспект Карла Маркса 41, корпус 7'?>
	<?$arAdress["PHONE"]='+7 (3812) 33-23-08 (доп. 6250, 6251, 5921, 6172)'?>
<?} else {?>
	<?$coords["0"]="55.802672"?>
	<?$coords["1"]="37.491271"?>
	<?$arAdress["ADDRESS"]='ул. Складочная, д. 3, стр. 1'?>
	<?$arAdress["PHONE"]='	+7 (495) 609-6967<br/>
 +7 (495) 967-8030 (доп. 6250, 6251, 5921, 6172) '?>
<?}?>
<?$coords["2"]=$coords["1"]-0.003?>
	 <?$data  = date("Y-m-d H:i:s");
		if ($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["city"]["VALUE"]==CITY_ID_KIEV) {
			$ar_city=array(CITY_ID_KIEV, 14909);
		} else {
			$ar_city=array(CITY_ID_OMSK, 14909, CITY_ID_MOSCOW, CITY_ID_SPB);
		}
		//print_r($arResult["COURSE"]);
		$GLOBALS["arrFilter"] =array("PROPERTY_city" => $ar_city, "!ID"=> $arResult["PROPERTIES"]["TIME_COURSE"]["VALUE"], "ACTIVE" => "Y" ,">PROPERTY_startdate" => $data, "PROPERTY_course_code"=> array("SDP-031", "SDP-032", "SDP-033", "SDP-034", "SDP-035"));
						if (strlen($_REQUEST["qcat"])>0) {
                            $GLOBALS["arrFilter"][]=array("LOGIC"=>"OR", array("NAME"=> "%".$_REQUEST["qcat"]."%"));
                        }?>
						<?/*
						<div class="sort-devider">
							<span>Сортировка по:</span> <a <?if ($_REQUEST["sort"]!="date") {?>class="active"<?}?> href="<?=$APPLICATION->GetCurPageParam("sort=direction", array("sort"));?>">Направлению</a> | <a <?if ($_REQUEST["sort"]=="date") {?>class="active"<?}?> href="<?=$APPLICATION->GetCurPageParam("sort=date", array("sort"));?>">Дате</a>
						</div>*/?>
	<?/*				
     <div class="table" id="s4">
            <h2>ближайшие сертификационные тренинги</h2>
            <?$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"edu_ru_all_city_agile_land",
							Array(
							"IBLOCK_TYPE" => "edu",	// Тип информационного блока (используется только для проверки)
							"IBLOCK_ID" => "9",	// Код информационного блока
							"NEWS_COUNT" => "100",	// Количество новостей на странице
							"SORT_BY1" => "PROPERTY_startdate",	// Поле для первой сортировки новостей
							"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
							"SORT_BY2" => $_REQUEST["sort"],	// Поле для второй сортировки новостей
							"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
							"FILTER_NAME" => "arrFilter",	// Фильтр
							"FIELD_CODE" => array(	// Поля
								0 => "",
								1 => "",
							),
							"SHOW_PRICE" => $_SESSION['SHOW_PRICE'],
							"PROPERTY_CODE" => array(	// Свойства
								0 => "course_сode",
								1 => "startdate",
								2 => "enddate",
								3 => "schedule_time",
								4 => "schedule_description",
								5 => "schedule_price",
								6 => "schedule_duration",
								7 => "hot_checkbox",
								8 => "prschedule_startdate",
								9 => "prschedule_enddate",
								10 => "prschedule_time",
								11 => "prschedule_desc",
								12 => "",
							),
							"CHECK_DATES" => "N",	// Показывать только активные на данный момент элементы
							"DETAIL_URL" => "/edu/catalog/course.html?ID=#ELEMENT_ID#",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
							"AJAX_MODE" => "N",	// Включить режим AJAX
							"AJAX_OPTION_SHADOW" => "Y",	// Включить затенение
							"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
							"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
							"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
							"CACHE_TYPE" => "Y",	// Тип кеширования
							"CACHE_TIME" => "3600",	// Время кеширования (сек.)
							"CACHE_FILTER" => "Y",	// Кэшировать при установленном фильтре
							"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
							"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
							"DISPLAY_PANEL" => "N",	// Добавлять в админ. панель кнопки для данного компонента
							"SET_TITLE" => "N",	// Устанавливать заголовок страницы
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
							"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
							"PARENT_SECTION" => "",	// ID раздела
							"PARENT_SECTION_CODE" => "",	// Код раздела
							"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
							"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
							"PAGER_TITLE" => "",	// Название категорий
							"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
							"PAGER_TEMPLATE" => "",	// Название шаблона
							"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
							"DISPLAY_DATE" => "N",
							"DISPLAY_NAME" => "Y",
							"DISPLAY_PICTURE" => "N",
							"DISPLAY_PREVIEW_TEXT" => "N",
							"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
							)
						);?>
			
        </div>
		*/?>
        <div class="map" id="s5">
            <div class="info">
                <ul>
                    <li>
                        <span class="ico"><img src="/agile/images/ico-addr.png" alt=""></span>
                        <?=$arAdress["ADDRESS"]?>
                    </li>
                    <li>
                        <span class="ico"><img src="/agile/images/ico-phone.png" alt=""></span>
                         <?=$arAdress["PHONE"]?>
                    </li>
                    <li>
                        <span class="ico"><img src="/agile/images/ico-mail.png" alt=""></span>
                        <a href="mailto:&#101;&#100;&#117;&#099;&#097;&#116;&#105;&#111;&#110;&#064;&#108;&#117;&#120;&#111;&#102;&#116;&#046;&#099;&#111;&#109;">&#101;&#100;&#117;&#099;&#097;&#116;&#105;&#111;&#110;&#064;&#108;&#117;&#120;&#111;&#102;&#116;&#046;&#099;&#111;&#109;</a>
                    </li>
                </ul>
                <div class="note">
                    <span class="ico"><img src="/agile/images/ico-note.png" alt=""></span>
                    <em>Посетителям необходимо иметь с собой документ, удостоверяющий личность</em>
                </div>
            </div>
			<?$APPLICATION->IncludeComponent("bitrix:map.yandex.view","",Array(
        "INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => serialize( 
			   array( 
				  'yandex_lat' => $coords[0], 
				  'yandex_lon' => $coords[2], 
				  'yandex_scale' => 17, 
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
            <?/*<iframe src="https://www.google.com/maps/embed/v1/place?q=1-%D0%B9%20%D0%92%D0%BE%D0%BB%D0%BE%D0%BA%D0%BE%D0%BB%D0%B0%D0%BC%D1%81%D0%BA%D0%B8%D0%B9%20%D0%BF%D1%80-%D0%B4%20%D0%B4%D0%BE%D0%BC%2010%20%D1%81%D1%82%D1%80%D0%BE%D0%B5%D0%BD%D0%B8%D0%B5%203%2C%20%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0%2C%20%D0%B3%D0%BE%D1%80%D0%BE%D0%B4%20%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0%2C%20%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D1%8F&key=AIzaSyAA6MNC8nzXbi_ArfXl0QdLJtUv396yOmQ" width="100%" height="536" frameborder="0" style="border:0" allowfullscreen scrollwheel="false"></iframe>*/?>
        </div>
    </div>
    <div id="footer">
        <p>&copy; 2018 LUXOFT-TRAINING</p>
    </div>
    <a href="#" class="top">top</a>
    <ul class="social">
		<?$share_title=$arResult["NAME"];?>
        <li><a class="facebook" target="_blank" href="https://www.facebook.com/dialog/feed?app_id=1421562351392582&link=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>&display=popup&caption=<?=rawurlencode(iconv("windows-1251", "UTF-8", "Luxoft Training: Курсы и тренинги для программистов, аналитиков, менеджеров проектов, тестировщиков"))?>&name=<?=rawurlencode(iconv("windows-1251", "UTF-8", $share_title))?>&redirect_uri=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>">facebook</a></li>
        <li><a class="vk" target="_blank" href="http://vkontakte.ru/share.php?&description=<?=rawurlencode(iconv("windows-1251", "UTF-8", "Luxoft Training: Курсы и тренинги для программистов, аналитиков, менеджеров проектов, тестировщиков."))?>&title=<?=rawurlencode(iconv("windows-1251", "UTF-8", $share_title))?>&url=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>&noparse=false">vk</a></li>
        <li><a class="twitter" target="_blank" href="https://twitter.com/share?&text=<?=rawurlencode(iconv("windows-1251", "UTF-8", $share_title))?>&url=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>&redirect_uri=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>"">twitter</a></li>
        <li><a class="linkedin" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>&title=<?=rawurlencode(iconv("windows-1251", "UTF-8", $share_title))?>&summary=<?=rawurlencode(iconv("windows-1251", "UTF-8", 'Luxoft Training: Курсы и тренинги для программистов, аналитиков, менеджеров проектов, тестировщиков.'))?>"">linkedin</a></li>
        <li><a class="google" target="_blank" href="https://plus.google.com/share?url=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>">google</a></li>
    </ul>
	<?$APPLICATION->SetTitle($arResult["NAME"]);
	$APPLICATION->SetPageProperty("title", $arResult["NAME"]);?>
    <div class="popup" id="regpopup">
        <div class="popup-t">
            <a href="#" class="close">X</a>
            <h3>регистрация участника</h3>
        </div>
		<?GLOBAL $arInfo?>
		<?if (strlen($arResult["PROPERTIES"]["OG_TEXT"]["VALUE"])>0) {?>
			<?$APPLICATION->AddHeadString('<meta property="og:description" content="'.$arResult["PROPERTIES"]["OG_TEXT"]["VALUE"].'" />',true)?>
		<?} else {?>
			<?$APPLICATION->AddHeadString('<meta property="og:description" content="Luxoft является членом ICAgile – международного консорциума организаций, нацеленных на развитие образования в сфере Agile." />',true)?>
		<?}?>
		<?$arInfo["COURSE_ID"]=$arResult["PROPERTIES"]["COURSE"]["VALUE"];?>
		<?$arInfo["TIME_ID"]=$arResult["PROPERTIES"]["TIME_COURSE"]["VALUE"];?>
		<?$arInfo["NAME"]=$arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["course_code"]["VALUE"]." ".$arResult["COURSE"]["NAME"];?>
		
		<?$APPLICATION->IncludeComponent("edu:iblock.element.add.form.course", "landing-agile", Array(
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