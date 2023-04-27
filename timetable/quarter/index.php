<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<?if ($id_city!=14909) {?>
    <?$id_city=$_SESSION["cityID"]?>
<?}?>
 <?if ($_REQUEST["type"]!="online") {?>
											 <section class="bg-main-wrap" style="background: url('/static/images/bg-catalog.jpg') center 0; background-size: cover;">
		<div class="frame">
			<div class="breadcrumbs clearfix">
				<a class="breadcrumb-item" href="/">Главная</a> 
				<a class="breadcrumb-item" href="#">Раписание</a>
				
			</div>
			<?switch ($_SESSION["cityID"]) {
				case CITY_ID_SPB:
					$file="luxoft_training_price_spb.xls?radn=".rand();
					break;
				case CITY_ID_OMSK:
					$file="luxoft_training_price_omsk.xls?radn=".rand();
					break;
				case CITY_ID_KIEV:
					$file="luxoft_training_price_kiev.xls?radn=".rand();
					break;
				case CITY_ID_ODESSA:
					$file="luxoft_training_price_odessa.xls?radn=".rand();
					break;
				case CITY_ID_DNEPR:
					$file="luxoft_training_price_dnepropetrovsk.xls?radn=".rand();
					break;
				default:
					$file="luxoft_training_price_moscow.xls?radn=".rand();
			}?>
			<div class="clearfix heading-white">
				<h1>Расписание и цены курсов </h1>
				<div class="catalog-info-links">
					<a href="/files/<?=$file?>"><i class="fa fa-usd" aria-hidden="true"></i> Скачать прайс</a>
				</div>
			</div>
			 <?$APPLICATION->IncludeComponent("bitrix:menu", "right-menu-more", Array(
				"ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
					"MAX_LEVEL" => "1",	// Уровень вложенности меню
					"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
					"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
				),
				false
			);?>
			<?if ($_REQUEST["type"]=="online") {?>
			   <?$id_city=14909?>
			<?}?>
			<?if ($id_city!=14909) {?>
				<?$id_city=$_SESSION["cityID"]?>
			<?}?>
			<?$data  = date("Y-m-d H:i:s");
						$GLOBALS["arrFilter"] =array("PROPERTY_city" => array($id_city, 14909), "ACTIVE" => "Y" ,">PROPERTY_startdate" => $data);
						if (strlen($_REQUEST["qcat"])>0) {
                            $GLOBALS["arrFilter"][]=array("LOGIC"=>"OR", array("NAME"=> "%".$_REQUEST["qcat"]."%"), array("CODE"=> "%".$_REQUEST["qcat"]."%"));
                        }
				$arFilter=$GLOBALS["arrFilter"];
				$arFilter["IBLOCK_ID"]=9;

				$arSelect = Array("ID", "NAME", "PROPERTY_schedule_course_type", "PROPERTY_schedule_course_type.NAME");
				
				$res = CIBlockElement::GetList(Array(), $arFilter, array("PROPERTY_schedule_course_type"), Array("nPageSize"=>99), $arSelect);
				while($ob = $res->GetNextElement())
				{
				 $arFields = $ob->GetFields();
				 //print_r($arFields);
				 $res1 = CIBlockElement::GetByID($arFields["PROPERTY_SCHEDULE_COURSE_TYPE_VALUE"]);
				 if($ar_res1 = $res1->GetNext())
				   //echo $ar_res1['NAME'];
				   if (in_array($arFields["PROPERTY_SCHEDULE_COURSE_TYPE_VALUE"], $_REQUEST["cat"])) {
					$arSelected[]=array("ID"=> $arFields["PROPERTY_SCHEDULE_COURSE_TYPE_VALUE"], "NAME"=> $ar_res1['NAME']);
				   }
				   $arCat[]=array("ID"=> $arFields["PROPERTY_SCHEDULE_COURSE_TYPE_VALUE"], "NAME"=> $ar_res1['NAME']);
				}
				//print_r($arCat);
			?>
			<div class="search-item-catalog">
				<form id="filter">
					<input type="text" name="qcat" placeholder="Найти курс" />
					<?foreach ($arCat as $catergory) {?>
						<input style="display: none;" type="checkbox" class="no_redraw" <?if (in_array($catergory["ID"], $_REQUEST["cat"])) {?>checked="checked"<?}?> value="<?=$catergory["ID"]?>" name="cat[]" />
					<?}?>
					<input type="hidden" name="showquart" value="<?=$_REQUEST['showquart']?>"/>
				</form>
			</div>
			<?if (is_array($arSelected)) {?>
				<ul class="selected-items">
					<?foreach ($arSelected as $secCat) {?>
						<li><?=$secCat["NAME"]?> <a class="delete-cat" data-id="<?=$secCat["ID"]?>" href="javascript:void(0)">&#215;</a></li>
					<?}?>
				</ul>
			<?}?>
			<div class="timetable-filter-wrap">
				Раписание курсов в <?include $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/include/city-select.php';?>
				<?foreach ($arCat as $catergory) {?>
						<input style="display: none;" type="checkbox" class="no_redraw" <?if (in_array($catergory["ID"], $_REQUEST["cat"])) {?>checked="checked"<?}?> value="<?=$catergory["ID"]?>" name="cat[]" />
				<?}?>
				<div id="city_id" data-id="<?=$id_city?>" style="display: none"></div>
				<div class="simple-select category-picker"><a class="title dropdown-link" href="">Выберите направление <i class="fa fa-caret-down" aria-hidden="true"></i></a>
					<ul class="dropdown">
						<?foreach ($arCat as $catergory) {?>
							<li><a data-id="<?=$catergory["ID"]?>" href="javascript:void(0)"><?=$catergory["NAME"]?></a></li>
						<?}?>
					</ul>
				</div>
			</div>
		</div>
</section>
 <?
						if ($_REQUEST["showquart"]=="next") {
							$timestart=strtotime(date('Y-m')."-1 +3 month");
							$monthstart=date("Y-m", $timestart);
							$data  = $monthstart."-1 00:00:00";
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
						if ($USER->IsAdmin()) {
							//echo $data;
						}
						$GLOBALS["arrFilter"] =array("PROPERTY_city" => array($id_city, 14909), "PROPERTY_IS_CLOSE"=> false, "ACTIVE" => "Y" ,">PROPERTY_startdate" => $data, "<PROPERTY_startdate"=>$enddate);
						if (strlen($_REQUEST["qcat"])>0) {
                            $GLOBALS["arrFilter"][]=array("LOGIC"=>"OR", array("NAME"=> "%".$_REQUEST["qcat"]."%"));
                        }
						if (count($_REQUEST["cat"])>0) {
							$GLOBALS["arrFilter"]["PROPERTY_SCHEDULE_COURSE_TYPE"]=$_REQUEST["cat"];
						}
						?>
<?if ($_REQUEST["type"]=="online") {?>
   <?$id_city=14909?>
<?}?>
<?if ($id_city!=14909) {?>
    <?$id_city=$_SESSION["cityID"]?>
<?}?>
<section id="content" class="bg not-main-page">	
							<div class="timetable-menu ">
								<div class="frame no-y-padding clearfix">
									<ul class='timetable-menu-ul'>
										<li ><a href="/timetable/">Полное расписание</a></li>
										<li class="active"><a href="/timetable/quarter/">Расписание на квартал</a></li>
									</ul>
								
								</div>
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
								12 => "course_sale",
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
</section>

 <?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>