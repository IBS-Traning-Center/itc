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
<?} else {?>
	<?$coords["0"]="44.481010167559"?>
	<?$coords["1"]="26.113874316216"?>
	<?$arAdress["ADDRESS"]='Dimitrie Pompeiu nr 5-7 , building C, Et. 5, sect 2, Bucharest, 014459'?>
	<?$arAdress["PHONE"]='021 371 4858'?>
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
				<?/*
                <div class="note">
                    <span class="ico"><img src="/agile/images/ico-note.png" alt=""></span>
                    
                </div>*/?>
            </div>
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
            <?/*<iframe src="https://www.google.com/maps/embed/v1/place?q=1-%D0%B9%20%D0%92%D0%BE%D0%BB%D0%BE%D0%BA%D0%BE%D0%BB%D0%B0%D0%BC%D1%81%D0%BA%D0%B8%D0%B9%20%D0%BF%D1%80-%D0%B4%20%D0%B4%D0%BE%D0%BC%2010%20%D1%81%D1%82%D1%80%D0%BE%D0%B5%D0%BD%D0%B8%D0%B5%203%2C%20%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0%2C%20%D0%B3%D0%BE%D1%80%D0%BE%D0%B4%20%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0%2C%20%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D1%8F&key=AIzaSyAA6MNC8nzXbi_ArfXl0QdLJtUv396yOmQ" width="100%" height="536" frameborder="0" style="border:0" allowfullscreen scrollwheel="false"></iframe>*/?>
        </div>
    </div>
    <div id="footer">
        <p>&copy; 2018 LUXOFT-TRAINING</p>
    </div>
    <a href="#" class="top">top</a>
    <ul class="social">
		<?$share_title=$arResult["NAME"];?>
        <li><a class="facebook" target="_blank" href="https://www.facebook.com/dialog/feed?app_id=1421562351392582&link=<?=urlencode("http://www.luxoft-training.com".$APPLICATION->GetCurDir())?>&display=popup&caption=<?=rawurlencode(iconv("windows-1251", "UTF-8", "Luxoft Training: High Standards of IT Training"))?>&name=<?=rawurlencode(iconv("windows-1251", "UTF-8", $share_title))?>&redirect_uri=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>">facebook</a></li>
        <li><a class="twitter" target="_blank" href="https://twitter.com/share?&text=<?=rawurlencode(iconv("windows-1251", "UTF-8", $share_title))?>&url=<?=urlencode("http://www.luxoft-training.com".$APPLICATION->GetCurDir())?>&redirect_uri=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>"">twitter</a></li>
        <li><a class="linkedin" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?=urlencode("http://www.luxoft-training.com".$APPLICATION->GetCurDir())?>&title=<?=rawurlencode(iconv("windows-1251", "UTF-8", $share_title))?>&summary=<?=rawurlencode(iconv("windows-1251", "UTF-8", 'Luxoft Training: High Standards of IT Training.'))?>"">linkedin</a></li>
        <li><a class="google" target="_blank" href="https://plus.google.com/share?url=<?=urlencode("http://www.luxoft-training.com".$APPLICATION->GetCurDir())?>">google</a></li>
    </ul>
	<?$APPLICATION->SetTitle($arResult["NAME"]);
	$APPLICATION->SetPageProperty("title", $arResult["NAME"]);?>
    <div class="popup" id="regpopup">
        <div class="popup-t">
            <a href="#" class="close">X</a>
            <h3>sign up</h3>
        </div>
		<?GLOBAL $arInfo?>
		<?$arInfo["COURSE_ID"]=$arResult["PROPERTIES"]["COURSE"]["VALUE"];?>
		<?$arInfo["TIME_ID"]=$arResult["PROPERTIES"]["TIME_COURSE"]["VALUE"];?>
		<?$arInfo["NAME"]=$arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["course_code"]["VALUE"]." ".$arResult["COURSE"]["NAME"];?>
		<?$APPLICATION->IncludeComponent("luxoft:form.result.new", "event-enroll.landing-en", Array(
                            "SEF_MODE" => "N",	// Enable SEF (Search Engine Friendly Urls) support
                            "WEB_FORM_ID" => "11",	// Web form ID
                            "LIST_URL" => "",	// Result list page
                            "EDIT_URL" => "",	// Result editing page
                            "SUCCESS_URL" => "",	// Success page URL
                            "CHAIN_ITEM_TEXT" => "",	// Name of additional navigation chain item
                            "CHAIN_ITEM_LINK" => "",	// Link for additional navigation chain item
                            "IGNORE_CUSTOM_TEMPLATE" => "N",	// Ignore custom template
                            "USE_EXTENDED_ERRORS" => "Y",	// Use extended error messages output
                            "CACHE_TYPE" => "A",	// Cache type
                            "CACHE_TIME" => "3600",	// Cache time (sec.)
                            "CACHE_NOTES" => "",
                            "COURSE_ID" => $arInfo["COURSE_ID"],
                            "VARIABLE_ALIASES" => array(
                                "WEB_FORM_ID" => "WEB_FORM_ID",
                                "RESULT_ID" => "RESULT_ID",
                            )
                        ),
                        false
                    );?>
		
      
    </div>