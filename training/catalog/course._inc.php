<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?/*
	$data  = date("Y-m-d");
	$GLOBALS["arrFilter"] =array("ACTIVE" => "Y" ,">=PROPERTY_startdate" => $data, "=PROPERTY_schedule_course" => $_REQUEST["ID"],  "!=PROPERTY_IS_CLOSE" => 136);
*/?> 	<?/*$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"edu_schedule_cources_by_idcourse",
	Array(
	"IBLOCK_TYPE" => "edu",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "9",	// Код информационного блока
	"NEWS_COUNT" => "4",	// Количество новостей на странице
	"SORT_BY1" => "PROPERTY_startdate",	// Поле для первой сортировки новостей
	"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
	"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
	"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
	"FILTER_NAME" => "arrFilter",	// Фильтр
	"FIELD_CODE" => array(	// Поля
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(	// Свойства
		0 => "",
		1 => "prschedule_startdate",
		2 => "prschedule_enddate",
		3 => "prschedule_time",
		4 => "prschedule_desc",
		5 => "",
	),
	"CHECK_DATES" => "N",	// Показывать только активные на данный момент элементы
	"DETAIL_URL" => "/edu/catalog/course.html?ID=#ELEMENT_ID#",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"CACHE_FILTER" => "N",	// Кэшировать при установленном фильтре
	"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
	"DISPLAY_PANEL" => "N",	// Добавлять в админ. панель кнопки для данного компонента
	"SET_TITLE" => "N",	// Устанавливать заголовок страницы
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
	"PARENT_SECTION" => "",	// ID раздела
	"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
	"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
	"PAGER_TITLE" => "",	// Название категорий
	"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
	"PAGER_TEMPLATE" => "",	// Название шаблона
	"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
	"PROPERTY_CITYCHECK" => "5741",
	"DISPLAY_DATE" => "N",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "N",
	"DISPLAY_PREVIEW_TEXT" => "N"
	)
);*/?>
<?global $arCourseInfoID;?>
<?$arCourseInfoID = $APPLICATION->IncludeComponent(
	"artions:course.info",
	".default",
	Array(
		"IBLOCK_TYPE" => "edu",
		"IBLOCK_ID" => "6",
		"ELEMENT_ID" => $_REQUEST["ID"],
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_NOTES" => ""
	),
false
);?>
<? 
//echo "<pre>";
//iwrite($arCourseInfoID);
//echo "</pre>";
?>


<?
global  $arEventInfo;
?>
<div class="buble_body">
	<h2>Весь Каталог курсов</h2>
	<span class="links"><a style="text-decoration:underline;"href="/training/catalog/">Перейти</a></span>
</div><br />
<div class="buble_body" style="padding-right:8px;">
<h2>Оставить  заявку</h2>
	<p>на участие в данном тренинге с открытой датой в филиалах:
</p>
<script>
						$(document).ready(function(){
							$('ul#cities_list li a').click(function() { 
								var vParam = $(this).attr('num'); 
								$('select.date_select').val(vParam);
								$('.tabsection-container-default ul li').removeClass("active");
								$('.tabsection-container-default ul li#tab-fill_form').addClass("active");
								$('.tab-boby-container .tab-boby > div').addClass("tab-off").hide();
								$('.tab-boby-container .tab-boby > div#tab-fill_form-body').show();	
								return false;
							});
						})
</script>	

	<ul id="cities_list">
	<?	$arCityInfo = GetAllActiveCitiesInfo();
		foreach ($arCityInfo as $arSingleCity){	?>
          <li><a href="#" class="ajax_link" style="font-size: 13px;" num="<?=$arSingleCity['ID']?>"><?=$arSingleCity['NAME']?></a></li>
	<? } ?>
	</ul>
	<?if ($arCourseInfoID['TIMETABLE_INFO'][0]["COURSE_DURATION"]) {?>
				<br /><h2>О курсе</h2>
				<strong>Длительность</strong>: <?=$arCourseInfoID['TIMETABLE_INFO'][0]["COURSE_DURATION"];?> час. <br />
			<? } ?>
			<?if ($arCourseInfoID['TIMETABLE_INFO'][0]["COURSE_PRICE_RUB"] || $arCourseInfoID['TIMETABLE_INFO'][0]["COURSE_PRICE_UA"]) {?>
				<strong>Стоимость</strong>:
				<?if($arCourseInfoID['TIMETABLE_INFO'][0]["COURSE_PRICE_RUB"]){?> <?=number_format($arCourseInfoID['TIMETABLE_INFO'][0]["COURSE_PRICE_RUB"], 0, '', ' ');?>  р.<? } ?>
				<?if($arCourseInfoID['TIMETABLE_INFO'][0]["COURSE_PRICE_UA"]){?> / <?=number_format($arCourseInfoID['TIMETABLE_INFO'][0]["COURSE_PRICE_UA"], 0, '', ' ');?>  грн.<? } ?>
			<? } ?>
	
</div><br />


<?
	if (intval($_REQUEST["ID_TIME"])>0){
		$arSearchClasses = GetArrClassesContainsThisCourse(intval($_REQUEST["ID_TIME"]));
		if (count($arSearchClasses) > 0 ) {
			$PHRASE_CLASS = "<div class='buble_body'>";
			if (count($arSearchClasses) == 1 ) {
				$PHRASE_CLASS .= "<h2>Тренинг входит в состав Класса: </h2>";
			} else {
				$PHRASE_CLASS .= "<h2>Тренинг входит в состав следующих Классов:</h2>";
			}
			foreach ($arSearchClasses as $arClassContent) {
				 $PHRASE_CLASS.= "<div class='links'><a href='http://ibs-training.ru/timetable/pp.html?ID=".$arClassContent['ID']."'>".$arClassContent['NAME']."</a>, ".$arClassContent['STARTDATE']." - ".$arClassContent['ENDDATE']."</div><br />";
			}
			$PHRASE_CLASS .= "</div><br />";
			echo $PHRASE_CLASS."<br />";
		}
	}

?>


<div class="" style="padding-left: 50px;">
	<?
	$uri = "http://ibs-training.ru";
	$uri .= $APPLICATION->GetCurPageParam(false, array("ID_TIME")); 
	?>
<!--
	<iframe src="http://www.facebook.com/plugins/like.php?href=<?=$uri?>&amp;layout=box_count&amp;show_faces=true&amp;locale=ru_RU&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:65px;" allowTransparency="true"></iframe>
-->
<div id="fb-root"></div>
 <script>
     window.fbAsyncInit = function() 
    {
         // init the FB JS SDK
         FB.init(
         {
            appId : '225734987442328', 
            channelUrl : '//ibs-training.ru',
            status : true, 
            cookie : true, 
            xfbml : true 
        }); 
     }; 
     (function(d)
     {
         var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement('script'); js.id = id; js.async = true;
         js.src = "//connect.facebook.net/ru_RU/all.js";
         ref.parentNode.insertBefore(js, ref);
     }(document));
 </script>
<div class="fb-like" data-href="<?=$uri?>" data-send="false" data-layout="box_count" data-width="450" data-show-faces="false"></div>

	<br /><br />
	<g:plusone></g:plusone>
	<script type="text/javascript">
	  window.___gcfg = {lang: 'ru'};

	  (function() {
		var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		po.src = 'https://apis.google.com/js/plusone.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	  })();
	</script>
</div>
<br />

<script>
	$(document).ready(function(){
		$("#catalog_download").click(function() {
			pageTracker._trackEvent('Download', 'Catalog', 'Courses Page');
		});
	});
</script>