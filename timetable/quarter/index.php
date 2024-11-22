
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty("title", "Расписание");
use Local\Util\Functions;

if ($id_city!=14909) {
	$id_city=$_SESSION["cityID"];
}

if ($_REQUEST["type"]!="online") {?>
<?$APPLICATION->IncludeComponent("bitrix:form.result.new", "send_price_list_2", Array(
    "SEF_MODE" => "Y",	// Включить поддержку ЧПУ
    "WEB_FORM_ID" => "24",	// ID веб-формы
    "SUCCESS_URL" => "",	// Страница с сообщением об успешной отправке
    "CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
    "CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
    "IGNORE_CUSTOM_TEMPLATE" => "Y",	// Игнорировать свой шаблон
    "USE_EXTENDED_ERRORS" => "Y",	// Использовать расширенный вывод сообщений об ошибках
    "CACHE_TYPE" => "A",	// Тип кеширования
    "CACHE_TIME" => "3600",	// Время кеширования (сек.)
    "SEF_FOLDER" => "/",	// Каталог ЧПУ (относительно корня сайта)
    "VARIABLE_ALIASES" => ""
),
    false
);?>
	<div class="top-page-banner timetable" style="background-color: <?= $APPLICATION->GetPageProperty('BACKGROUND_COLOR_BANNER') ?>">
    	<div class="container">
    	    <div class="banner-content">
    	        <?php $APPLICATION->IncludeComponent(
    	                'bitrix:breadcrumb',
    	                'bread',
    	                [
    	                    'START_FROM' => '0',
    	                    'PATH' => '',
    	                    'SITE_ID' => 's1',
    	                ],
    	                false
    	        ); ?>
    	        <h1><?= $APPLICATION->GetPageProperty('title') ?></h1>
    	    </div>
    	</div>
		<div class="container">
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
			<div class='timetable-filter-type-wrap'>
				<div class="timetable-filter-type-close"></div>
            	<div class="timetable-type-wrap">
            	    <div class="timetable-type-title">Тип курсов</div>
            	    <?$APPLICATION->IncludeComponent("bitrix:menu", "right-menu-more", Array(
            	        "ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
            	        "MAX_LEVEL" => "1",	// Уровень вложенности меню
            	        "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
            	        "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
            	    ),
            	        false
            	    );?>
            	    <div class="catalog-info-links">
            	        <a onclick="$('.send-price-form-area').show(); return;"> <?= Functions::buildSVG('download-catalog', SITE_TEMPLATE_PATH. '/assets/images/icons')?> Скачать прайс</a>
            	    </div>
            	</div>     
				<?if ($_REQUEST["type"]=="online") {
					$id_city=14909;
				}
				if ($id_city!=14909) {
					$id_city=$_SESSION["cityID"];
				}
				$data  = date("Y-m-d H:i:s");
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
					$res1 = CIBlockElement::GetByID($arFields["PROPERTY_SCHEDULE_COURSE_TYPE_VALUE"]);
					if($ar_res1 = $res1->GetNext())
					if (is_array($_REQUEST["cat"]) && in_array($arFields["PROPERTY_SCHEDULE_COURSE_TYPE_VALUE"], $_REQUEST["cat"])) {
						$arSelected[] = array("ID"=> $arFields["PROPERTY_SCHEDULE_COURSE_TYPE_VALUE"], "NAME"=> $ar_res1['NAME']);
					}
					$arCat[]=array("ID"=> $arFields["PROPERTY_SCHEDULE_COURSE_TYPE_VALUE"], "NAME"=> $ar_res1['NAME']);
				}
				?>
				<div class="timetable-filter-wrap">
            	    <div <?if ($_REQUEST["type"]=="online") {?> style="margin-left: 0;"<?}?> class="simple-select category-picker">
            	        <div class="timetable-filter-title">Направления</div>
            	        <ul>
            	            <li><a class="<?= ($_REQUEST["cat"]=='' || $_REQUEST["cat"]==NULL)? 'active':''; ?>" href="/timetable/">Все курсы</a></li>
            	            <?foreach ($arCat as $catergory) {?>
            	                <li style="display: none;"><a data-id="<?=$catergory["ID"]?>" <?=(is_array($_REQUEST["cat"]) && in_array($catergory["ID"], $_REQUEST["cat"]))? 'class="active"':''?> href="javascript:void(0)"><?=$catergory["NAME"]?></a></li>
            	            <?}?>
            	        </ul>
            	        <div class="more-item" style="display: none;">
            	            <span>Показать ещё</span><?= Functions::buildSVG('arrow-down', SITE_TEMPLATE_PATH. '/assets/images/icons')?>
            	        </div>  
            	    </div>  
            	    <div class="search-item-catalog">
            	        <form id="filter">
            	            <input type="text" name="qcat" value="<?=$_REQUEST["qcat"]?>" placeholder="Поиск курса" />
            	            <?= Functions::buildSVG('search-loop', SITE_TEMPLATE_PATH. '/assets/images/icons')?>
            	            <?foreach ($arCat as $catergory) {?>
            	                <input style="display: none;" type="checkbox" class="no_redraw" <?=(is_array($_REQUEST["cat"]) && in_array($catergory["ID"], $_REQUEST["cat"]))? 'checked="checked"':''?> value="<?=$catergory["ID"]?>" name="cat[]" />
            	            <?}?>
            	        </form>
            	    </div>
            	</div>
            	<div class="timetable-filter-type-submit btn-main size-l">Показать</div>
			</div>
        	<div class="timetable-filter-type-shadow">
        	</div>
        	<div class="timetable-filter-type-mobile">
        	    <div class="timetable-filter-type-btn btn-main size-l">Фильтр</div>
        	    <div class="catalog-info-links">
        	        <a onclick="$('.send-price-form-area').show(); return;"> <?= Functions::buildSVG('download-catalog', SITE_TEMPLATE_PATH. '/assets/images/icons')?> Скачать прайс</a>
        	    </div>
        	</div>
		</div>
	</div>
<?
if ($_REQUEST["showquart"]=="next") {
	$timestart=strtotime(date('Y-m')."-01 +3 month");
	$monthstart=date("Y-m", $timestart);
	$data = $monthstart."-01 00:00:00";
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
}
if (is_array($_REQUEST["cat"]) && count($_REQUEST["cat"])>0) {
	$GLOBALS["arrFilter"]["PROPERTY_SCHEDULE_COURSE_TYPE"]=$_REQUEST["cat"];
}
if ($_REQUEST["type"]=="online") {
	$id_city=14909;
}
if ($id_city!=14909) {
	$id_city=$_SESSION["cityID"];
}?>
<section id="content" class="not-main-page">
	<div class="container">
        <div class="timetable-menu">
            <div class="simple-select">
                <a class="title dropdown-link" href=""><span>Выберите направление</span><?= Functions::buildSVG('arrow-down', SITE_TEMPLATE_PATH. '/assets/images/icons')?></a>
                <?if ($_REQUEST["type"]!="online") {?>
                    <ul class='timetable-menu-ul dropdown'>
                        <li><a href="/timetable/">Полное расписание</a></li>
                        <li class="active"><a href="/timetable/quarter/">Расписание на квартал</a></li>
                    </ul>
                <?}?>
            </div>
            <div class="sorting-wrap">
                <span>Сортировка по: </span> <a <?if ($_REQUEST["sort"]!="direction") {?>class="active"<?}?> href="<?=$APPLICATION->GetCurPageParam("sort=date", array("sort"));?>">Дате</a><a <?if ($_REQUEST["sort"]=="direction") {?>class="active"<?}?> href="<?=$APPLICATION->GetCurPageParam("sort=direction", array("sort"));?>">Направлению</a>
            </div>
        </div>		
		<?
		if ($_REQUEST["sort"]!="direction")
		{
			$sorting="PROPERTY_startdate";
		}
		else
		{
			$sorting="PROPERTY_SCHEDULE_COURSE_TYPE";
		}
		
		$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"edu_ru_all_city_schedule_cources_cal_diff_month",
			Array(
			"NEXT"=> $NEXT,
			"IBLOCK_TYPE" => "edu",	// Тип информационного блока (используется только для проверки)
			"IBLOCK_ID" => "9",	// Код информационного блока
			"NEWS_COUNT" => "100",	// Количество новостей на странице
			"SORT_BY1" => $sorting,	// Поле для первой сортировки новостей
			"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
			"SORT_BY2" => "PROPERTY_startdate",	// Поле для второй сортировки новостей
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
	</div>
</section>

 <?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>