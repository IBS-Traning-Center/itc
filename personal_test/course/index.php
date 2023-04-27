<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Рекомендуемые курсы");
?>
<?if (!$USER->IsAuthorized()) {?>
<?$APPLICATION->IncludeComponent("bitrix:system.auth.form","",Array(
     "REGISTER_URL" => "register.php",
     "FORGOT_PASSWORD_URL" => "",
     "PROFILE_URL" => "profile.php",
     "SHOW_ERRORS" => "Y" 
     )
);?>
<?} else {?>
<script>
$(document).ready(function() {
	var randInt;
	$("a.tobasket").click(function(){
		$(this).fadeOut("fast");
		$(this).fadeIn("fast");
		var id_record = $(this).attr("id_basket");
		/*$.getJSON('/ajax/add_course_to_basket.php?action=ADD2BASKET&id='+id_record+'&quantity=1',function(data){
		});
		randInt = Math.floor(Math.random()*100000);
		$(".basketSmall").fadeOut("slow");
	   	$(".basketSmall").load("/ajax/show_basket.php?rand='+randInt+'",{limit: 25});
	   	//pageTracker._trackEvent('Order', 'PutToBasket', id_record);
	   	$(".basketSmall").fadeIn("slow");
		*/
		$.getJSON('/ajax/add_course_to_basket.php?action=ADD2BASKET&id='+id_record+'&quantity=1',function(data){
            $(".basketSmall").fadeOut("slow");
			alert("Курс добавлен в корзину");
            $(".basketSmall").load("/ajax/show_basket.php?rand='+randInt+'",{limit: 25}, function(){
                $(".basketSmall").fadeIn("slow");
			   
            });

        });
	   	return false;
	});
	//$(".show_tooltip").tooltip({  position: 'center right', opacity: 0.9,  effect: 'toggle' ,  offset: [25, 10] });
});
</script>
<div class="courses">
<?	$arReg[]=999999;
	$arRegK[]=999999;
	$data  = date("Y-m-d");
	$GLOBALS["arrFilter"] =array("ACTIVE" => "Y" ,">PROPERTY_startdate" => $data, "ID"=>$arReg);

	?>
<div class="heading">
						<h2>Активные курсы</h2>
						<?/*<a href="#">Настроить выбор курсов</a>*/?>
	</div>
	<?GLOBAL $arRegK?>
	
<?$APPLICATION->IncludeComponent("bitrix:news.list", "edu_ru_all_city_schedule_cources_cal", array(
	"IBLOCK_TYPE" => "edu",
	"IBLOCK_ID" => "9",
	"NEWS_COUNT" => "40",
	"ADDIT_ARRAY" => $arRegK,		
	"SORT_BY1" => "PROPERTY_startdate",
	"SORT_ORDER1" => "ASC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "arrFilter",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "startdate",
		1 => "enddate",
		2 => "schedule_time",
		3 => "schedule_description",
		4 => "schedule_price",
		5 => "schedule_duration",
		6 => "hot_checkbox",
		7 => "course_СЃode",
		8 => "prschedule_startdate",
		9 => "prschedule_enddate",
		10 => "prschedule_time",
		11 => "prschedule_desc",
		12 => "",
	),
	"CHECK_DATES" => "N",
	"DETAIL_URL" => "/edu/catalog/course.html?ID=#ELEMENT_ID#",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "Y",
	"CACHE_TIME" => "3600",
	"CACHE_FILTER" => "Y",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y",
	"DISPLAY_DATE" => "N",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "N",
	"DISPLAY_PREVIEW_TEXT" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
</div>

<div class="courses done">

<?
	$data  = date("Y-m-d");
	$GLOBALS["arrFilter"] =array("ACTIVE" => "Y" ,"<PROPERTY_startdate" => $data, "ID"=>$arReg);
?>

<div class="heading">
						<h2>Пройденные курсы</h2>
						<?/*<a href="#">Настроить выбор курсов</a>*/?>
	</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"edu_ru_done", 
	array(
		"IBLOCK_TYPE" => "edu",
		"IBLOCK_ID" => "9",
		"NEWS_COUNT" => "10",
		"SORT_BY1" => "PROPERTY_startdate",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrFilter",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"SHOW_PRICE" => $_SESSION["SHOW_PRICE"],
		"PROPERTY_CODE" => array(
			0 => "startdate",
			1 => "enddate",
			2 => "schedule_time",
			3 => "schedule_description",
			4 => "schedule_price",
			5 => "schedule_duration",
			6 => "hot_checkbox",
			7 => "course_СЃode",
			8 => "prschedule_startdate",
			9 => "prschedule_enddate",
			10 => "prschedule_time",
			11 => "prschedule_desc",
			12 => "",
		),
		"CHECK_DATES" => "N",
		"DETAIL_URL" => "/edu/catalog/course.html?ID=#ELEMENT_ID#",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DISPLAY_PANEL" => "N",
		"SET_TITLE" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "edu_ru_done",
		"CACHE_GROUPS" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>
</div>
<div class="formpopup" style="display:none">
<?$APPLICATION->IncludeComponent("bitrix:form.result.new", "quest", Array(
	"SEF_MODE" => "N",	// Включить поддержку ЧПУ
	"WEB_FORM_ID" => "12",	// ID веб-формы
	"LIST_URL" => "",	// Страница со списком результатов
	"EDIT_URL" => "",	// Страница редактирования результата
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
</div>
<div class="courses">
	<div class="heading">
		<h2>Рекомендуемые курсы</h2>
		<a class="openModal" href="javascript:void(0)">Настроить выбор курсов</a>
	</div>
	<?
	$data  = date("Y-m-d");
	$GLOBALS["arrFilter"] =array("ID"=>$arRec, "ACTIVE" => "Y" ,">PROPERTY_startdate" => $data);
	GLOBAL $arLinked;
	?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"edu_ru_all_city_schedule_cources_cal",
		Array(
			"IBLOCK_TYPE" => "edu",	
			"IBLOCK_ID" => "9",	
			"NEWS_COUNT" => "5",	
			"SORT_BY1" => "PROPERTY_startdate",	
			"SORT_ORDER1" => "ASC",	
			"ADDIT_ARRAY" => $arLinked,		
			"SORT_BY2" => "SORT",	
			"SORT_ORDER2" => "ASC",	
			"FILTER_NAME" => "arrFilter",	
			"FIELD_CODE" => array(	
								0 => "",
								1 => "",
							),
							"SHOW_PRICE" => $_SESSION['SHOW_PRICE'],
							"PROPERTY_CODE" => array(	
								0 => "course_СЃode",
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
							"CHECK_DATES" => "N",	
							"DETAIL_URL" => "/edu/catalog/course.html?ID=#ELEMENT_ID#",	
							"AJAX_MODE" => "N",	
							"AJAX_OPTION_SHADOW" => "Y",	
							"AJAX_OPTION_JUMP" => "N",	
							"AJAX_OPTION_STYLE" => "Y",	
							"AJAX_OPTION_HISTORY" => "N",	
							"CACHE_TYPE" => "Y",	
							"CACHE_TIME" => "3600",	
							"CACHE_FILTER" => "Y",	
							"PREVIEW_TRUNCATE_LEN" => "",	
							"ACTIVE_DATE_FORMAT" => "d.m.Y",	
							"DISPLAY_PANEL" => "N",	
							"SET_TITLE" => "N",	
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	
							"ADD_SECTIONS_CHAIN" => "N",	
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",	
							"PARENT_SECTION" => "",	
							"PARENT_SECTION_CODE" => "",	
							"DISPLAY_TOP_PAGER" => "N",	
							"DISPLAY_BOTTOM_PAGER" => "N",	
							"PAGER_TITLE" => "",	
							"PAGER_SHOW_ALWAYS" => "N",	
							"PAGER_TEMPLATE" => "",
							"PAGER_DESC_NUMBERING" => "N",	
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	
							"DISPLAY_DATE" => "N",
							"DISPLAY_NAME" => "Y",
							"DISPLAY_PICTURE" => "N",
							"DISPLAY_PREVIEW_TEXT" => "N",
							"AJAX_OPTION_ADDITIONAL" => "",	
							)
						);?>
</div>
<div class="popup">
	<?$APPLICATION->IncludeComponent(
    "luxoft:pick.recommend",
    "",
    Array(
 
    )
);?>
		
</div>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>