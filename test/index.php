<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<script src="//unpkg.com/@textback/notification-widget@latest/build/index.js"></script>
<tb-notification-widget   data-user-id="USER_ID" data-order-id="ORDER_ID" widget-id="14dec7cd-27b0-103d-5404-0165a91fd6b2">
</tb-notification-widget>
<script>
	var widgetContainer = document.querySelector('tb-notification-widget');
	var options = {
    widgetId: "14dec7cd-27b0-103d-5404-0165a91fd6b2",
    element: widgetContainer,
    data: {userId: "USER_ID", orderId: "ORDER_ID"}
	};
	new TextBack.NotificationWidget(options)
</script>
<?if ($id_city!=14909) {?>
    <?$id_city=$_SESSION["cityID"]?>
<?}?>
 <?if ($_REQUEST["type"]!="online") {?>
						 <div class="search-course-wrap">
							<form action="">
								<input style='width: 88%;' placeholder="Найти курс" name="qcat" value="<?=$_REQUEST["qcat"]?>" type="text">
								<input class="orange" value="Найти" type="submit">
							</form>
						</div>
                           <div class="timetable-heading" style="float: left;" >Расписание курсов в   <?include $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/include/city-select.php';?></div> <div class="quart-picker" style="float: right; padding-top: 30px;"><?if ($_REQUEST["showquart"]!="next") {?><a class="arrow-link" href="<?=$APPLICATION->GetCurPageParam('showquart=next', array('showquart') );?>">Cледующий квартал</a><?} else {?><a class="arrow-link-back" href="<?=$APPLICATION->GetCurPageParam('showquart=now', array('showquart') );?>">Предыдущий квартал</a><?}?></div>
							<div class="clearfix"></div>
					   <?} else {?>
                            <div style="margin-top: 25px; margin-bottom: 25px;" class="timetable-heading">Расписание онлайн-курсов</div>
                        <?}?>
                        <?
						if ($_REQUEST["showquart"]=="next") {
							$data  = date("Y-m-d H:i:s", strtotime('+3 month'));
							$time=strtotime('+5 month');
							$month= date('Y-m', $time);
							$enddate=$month."-".date('t', $time)." 23:59:59";
							$NEXT="Y";
						} else {
							$data  = date("Y-m-d H:i:s");
							$time=strtotime('+2 month');
							$month= date('Y-m', $time);
							$enddate=$month."-".date('t', $time)." 23:59:59";
							$NEXT="N";
						}
						
						$GLOBALS["arrFilter"] =array("PROPERTY_city" => array($id_city, 14909), "PROPERTY_IS_CLOSE"=> false, "ACTIVE" => "Y" ,">PROPERTY_startdate" => $data, "<PROPERTY_startdate"=>$enddate);
						if (strlen($_REQUEST["qcat"])>0) {
                            $GLOBALS["arrFilter"][]=array("LOGIC"=>"OR", array("NAME"=> "%".$_REQUEST["qcat"]."%"));
                        }?>
						<div style="text-align: left; padding-left: 10px;" class="sort-devider">
							<span>Сортировка по:</span> <a <?if ($_REQUEST["sort"]!="date") {?>class="active"<?}?> href="<?=$APPLICATION->GetCurPageParam("sort=direction", array("sort"));?>">Направлению</a> | <a <?if ($_REQUEST["sort"]=="date") {?>class="active"<?}?> href="<?=$APPLICATION->GetCurPageParam("sort=date", array("sort"));?>">Дате</a>
						</div>
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"edu_ru_all_city_schedule_cources_cal_diff_month",
							Array(
							"NEXT"=> $NEXT,
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
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>