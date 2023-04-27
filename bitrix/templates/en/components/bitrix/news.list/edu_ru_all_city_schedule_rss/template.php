<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
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
            $(".basketSmall").load("/ajax/show_basket.php?rand='+randInt+'",{limit: 25}, function(){
               $(".basketSmall").fadeIn("slow");
            });

        });
	   	return false;
	});
	$(".show_tooltip").tooltip({  position: 'center right', opacity: 0.9,  effect: 'toggle' ,  offset: [25, 10] });
});
</script>

<?

	// сначала  получим валюту города
	// Рубли или Гривны
	$id_city=$APPLICATION->GetPageProperty("id_city");
	$arSelect = Array("PROPERTY_edu_type_money");
	$arFilter = Array("IBLOCK_ID"=>51,"ID"=>$id_city);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ar_fields = $res->GetNext()) {
		$valuta= $ar_fields["PROPERTY_EDU_TYPE_MONEY_VALUE"];
		$valuta_ENUM_ID = $ar_fields["PROPERTY_EDU_TYPE_MONEY_ENUM_ID"];
	}
	switch ($valuta_ENUM_ID) {
		case CITY_CURRENCY_RUB:
			$vCurrencyAdd = " р.";
			break;
		case CITY_CURRENCY_BYR:
			$vCurrencyAdd = " бел. р.";
			break;
		case CITY_CURRENCY_GRN:
			$vCurrencyAdd = " $";
			break;
		default:
		  $vCurrencyAdd = " р.";
	}	
    // для массива куда мы будем ложить значения
	$ii=0;
	$arValueOfCourses = array();
	foreach($arResult["ITEMS"] as $arItem):?>
	<?
		$prepod_surname="";$prepod_name="";$prepod_code="";
		$schedule_course_id = $arItem['PROPERTIES']['schedule_course']['VALUE'];
		$schedule_city = $arItem['PROPERTIES']['schedule_city']['VALUE'];
		$schedule_startdate = $arItem['PROPERTIES']['startdate']['VALUE'];
		$schedule_startdate_origin = date("Y-m-d", strtotime($arItem['PROPERTIES']['startdate']['VALUE']));
		$schedule_enddate = $arItem['PROPERTIES']['enddate']['VALUE'];
		$schedule_enddate_origin = date("Y-m-d", strtotime($arItem['PROPERTIES']['enddate']['VALUE']));
		$schedule_time = $arItem['PROPERTIES']['schedule_time']['VALUE'];
		$schedule_description = $arItem['PROPERTIES']['schedule_description']['VALUE']['TEXT'];
		$schedule_price = $arItem['PROPERTIES']['schedule_price']['VALUE'];
		$schedule_onl_price = $arItem['PROPERTIES']['schedule_onl_price']['VALUE'];
		$schedule_duration = $arItem['PROPERTIES']['schedule_duration']['VALUE'];
		$schedule_teacher_id = $arItem['PROPERTIES']['teacher']['VALUE'];
		$schedule_teacher_string = $arItem['PROPERTIES']['string_teacher']['VALUE'];
		if ($schedule_enddate == "")  { } else   {  $schedule_startdate = "<time itemprop='startDate' datetime='".$schedule_startdate_origin."'>".$schedule_startdate."</time>-<br />" . "<time itemprop='endDate' datetime='".$schedule_enddate_origin."'>".$schedule_enddate."</time>"; }
		//iwrite($arItem['PROPERTIES']['IS_CLOSE']);

		// теперь  получим цену курса  и ее
		// длительность по умолчанию
 		$arSelect = Array(
	 		"PROPERTY_course_price",
			"XML_ID",
	 		"PROPERTY_course_duration",
	 		"PROPERTY_course_idcategory",
	 		"PROPERTY_course_code",
			"PROPERTY_course_format",
	 		"NAME"
 		);
		$arFilter = Array(
			"IBLOCK_ID"=>6,
			"ID"=>$schedule_course_id
		);

		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$course_price= $ar_fields["PROPERTY_COURSE_PRICE_VALUE"];
	 		$course_duration= $ar_fields["PROPERTY_COURSE_DURATION_VALUE"];
	 		$course_id_category= $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
	 		$course_code= $ar_fields["PROPERTY_COURSE_CODE_VALUE"];
	 		$course_online_enumid= $ar_fields["PROPERTY_COURSE_FORMAT_ENUM_ID"];
	 		$courseNameFromCatalog = $ar_fields["NAME"];
			$courseXML=$ar_fields["XML_ID"];
			
			
		}
        if ($schedule_price == "") {
        	$schedule_price =  $course_price;
        }
        if ($schedule_duration == ""){
        	$schedule_duration =  $course_duration;
        }
		
		
        // теперь  получим имя категории
        // и ее сортировку в категориях курсов ID =50
  		$arSelect = Array("NAME", "SORT");
		$arFilter = Array("IBLOCK_ID"=>50,"ID"=>$course_id_category);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$cat_name= $ar_fields["NAME"];
	 		$cat_sort= $ar_fields["SORT"];
	 		$cat_date_sort = ($ar_fields["SORT"]*100)+$ii;
		}

		$prepod_surname="";
		$prepod_code="";
		$prepod_active="";
		$prepod_name="";

		if  ($schedule_teacher_id > 0) {

	        //теперь  получим имя преподавателя
	  		$arSelect = Array("NAME", "PROPERTY_expert_name","CODE", "ACTIVE");
			$arFilter = Array("IBLOCK_ID"=>56,"ID"=>$schedule_teacher_id);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ar_fields = $res->GetNext())
			{
		 		$prepod_surname = $ar_fields["NAME"];
		 		$prepod_code    = strtolower($ar_fields["CODE"]);
		 		$prepod_name    = $ar_fields["PROPERTY_EXPERT_NAME_VALUE"];
		 		$prepod_active  = $ar_fields["ACTIVE"];
			}
		} else {
			$prepod_active  = "N";
			$prepod_surname = $schedule_teacher_string;
		}
        ?>
<?php
	   $arValueOfCourses[$ii]["schedule_id"] = $arItem["ID"];
       $arValueOfCourses[$ii]["sort"] = $cat_sort;
       $arValueOfCourses[$ii]["cat_name"] = $cat_name;
       $arValueOfCourses[$ii]["date_sort"] = $cat_date_sort;
       //$arValueOfCourses[$ii]["name"] = $arItem["NAME"];
       $arValueOfCourses[$ii]["name"] = $courseNameFromCatalog;
	   $arValueOfCourses[$ii]["XML"] = $courseXML;
       //$courseNameFromCatalog
       $arValueOfCourses[$ii]["startdate"] = $schedule_startdate;
       $arValueOfCourses[$ii]["time"] = $schedule_time;
       $arValueOfCourses[$ii]["duration"] = $schedule_duration;
       $arValueOfCourses[$ii]["price"] = $schedule_price;
	   $arValueOfCourses[$ii]["onl_price"] = $schedule_onl_price;
       $arValueOfCourses[$ii]["course_id"] = $schedule_course_id;
       $arValueOfCourses[$ii]["course_code"] = $course_code;
       $arValueOfCourses[$ii]["cat_id"] = $course_id_category;
       $arValueOfCourses[$ii]["prepod_surname"] = $prepod_surname;
       $arValueOfCourses[$ii]["prepod_code"] = $prepod_code;
       $arValueOfCourses[$ii]["prepod_name"] = $prepod_name;
       $arValueOfCourses[$ii]["prepod_active"] = $prepod_active;
       $arValueOfCourses[$ii]["detail_page_url"] =$arItem["DETAIL_PAGE_URL"];
       $arValueOfCourses[$ii]["online_id"] = $course_online_enumid;
       $arValueOfCourses[$ii]["time_interval"] = nl2br($arItem['PROPERTIES']['TIME_INTERVAL']['VALUE']);
       $arValueOfCourses[$ii]["show_basket"] = "Y";
       $arValueOfCourses[$ii]["schedule_city"] = $arItem['PROPERTIES']['city']['VALUE'];
if ($arItem['PROPERTIES']['IS_CLOSE']['VALUE_ENUM_ID'] === "136") {
       $arValueOfCourses[$ii]["show_basket"] = "N";
 

}
?>
	<? $ii=$ii+1; ?>
<?endforeach;?>
<?php
	// далее будем сортировать многомерный массив
	// по полю сортировку
	// таким образом отсортируем по категориям
	function cmp($a, $b)
	{
	    if ($a["date_sort"] == $b["date_sort"]) {
	        return 0;
	    }
	    return ($a["date_sort"] < $b["date_sort"]) ? -1 : 1;
	}
	usort($arValueOfCourses, "cmp");  // сортируем полученный массив по полю sort
?>

	<h2 class="abs" style="position:absolute;">Расписание ближайших курсов:</h2>
	<div class="edu_sort">
		<p class="timetable_sort">
		Cортировать по: <a href="/timetable/index.html?by_date=Y<? if (isset($_GET['type'])) {?>&type=<?=$_GET['type']?><? }?><? if (isset($_GET['city'])) {?>&city=<?=$_GET['city']?><? } ?>">Дате</a>
		| Направлениям
		</p>
	</div>
	<div class="edu_empty"></div>
	<table cellSpacing="0" cellPadding="5" border="0" class="edu">
<?
	$sortirovka=0;
	while (list($key, $value) = each($arValueOfCourses)) {
		$sortirovka_new=$value["sort"];
		if ($sortirovka <> $sortirovka_new) {?>
		<tr class="edu_header">
			<td colSpan="7">
				<p id="cat_<?=$value['cat_id']?>"><?= $value["cat_name"] ?></p>
			</td>
		</tr>
		<? } ?>
		<tr class="ewTableAltRow" itemscope itemtype="http://data-vocabulary.org/Event" onmouseover='ew_mouseover(this);' onmouseout='ew_mouseout(this);'>
			<td class="td_code">
				<p class="nobr"><?=$value["course_code"] ?></p>
			</td>
			<td class="td_name">
				<p><a class="js-tracking" data-type="Timetable" data-action="Click" data-name="<?=$value["course_code"] ?> <?=$value["name"]?> || <?=$value[course_id]?> || <?=$value['schedule_id']?>" title="Перейти на страницу с подробным описанием тренинга" itemprop="url" target="_blank" href="http://ibs-training.ru/kurs/<?=$value['XML']?>.html<? if ($value["show_basket"] === "Y"){?>?ID_TIME=<?=$value['schedule_id']?><? } ?>"><span itemprop="summary"><?=$value["name"] ?></span></a>
				<?/*if (preg_match('#PTRN#', $value["course_code"])) {?><span class="one-t-course"><img class="abs-image" title="Курс читается один раз" src="/images/ikonka1.png"/></span><?}*/?>
				<? if (strlen($value["prepod_surname"])>0)  {?>
					<br />тренер:
					<? if ($value["prepod_active"]=="Y") {?>
						<a class="orange"  title="Перейти на страницу-карточку преподавателя" href="http://ibs-training.ru/about/experts/<?=$value['prepod_code']?>.html">
							<?=$value["prepod_surname"];?> <?=$value["prepod_name"];?>
						</a>
					<? } else { ?>
			        	<?=$value["prepod_surname"];?>  <?=$value["prepod_name"];?>
					<? } ?>
				<? } ?>
				</p>
			</td>
			<td class="td_date"><p class="nobr"><?= $value["startdate"] ?></p></td>
			<td class="td_time" validn="top"><div class="nobr tocenter "><?/*=$value["time"]*/?>
<?
//global $USER;
//if ($USER->IsAdmin()){
?>
<?//iwrite($value);
?>
<?if (strlen($value["time_interval"])>0){?> 
<a  class="show_tooltip posrel"><?=$value["time"]?></a>
<div class="tooltip">
<?=$value["time_interval"]?>
</div>

<? } else { ?>
<?=$value["time"]?>
<? } ?>
<? //}
 ?>
<?if (($value["online_id"] == "103") or ($value["schedule_city"] == CITY_ID_ONLINE)){?>
 <br />(время моск.)
<? } ?>
<br /><div style="padding-top:4px;"><a title="Добавить курс в календарь"  data-type="Timetable" data-action="AddToCalendar" data-name="<?=$value["course_code"] ?> <?=$value["name"]?> || <?=$value[course_id]?> || <?=$value['schedule_id']?>"rel="nofollow" class="ical_img js-tracking" href="/training/catalog/ics_course.html?ID=<?=$value['schedule_id']?>"><img width="24" border="0" src="/downloads/images/47-ical_24_24.png"></a></div>
</div></td>
			<td class="td_duration"><p class="nobr"><?=$value["duration"];?> ч.</p></td>
			<td class="td_price">
				<? if ($arParams['SHOW_PRICE'] !== "N"){?>
					<p class="nobr"><?=number_format($value["price"], 0, '', ' ');?> <?=$vCurrencyAdd ?><?/*if ($valuta=="Рубли") {?> р.<? }else{ ?> грн. <? } */?></p>
					<?if ($value["schedule_city"] == CITY_ID_ONLINE) {?>
                        <?
						if (intval($value["onl_price"])>0) {
							$newval = $value["onl_price"];
						} else {
							$newval=round($value["price"]/4);
						}?>
                        <p class="nobr"><?=number_format($newval, 0, '', ' ');?> $ </p>
                    <?}?>
				<? } ?>
			</td>
		<?/* global $USER;  if ($USER->IsAdmin()) {*/?>
			<td class="td_buy">
				<? if ($arParams['SHOW_PRICE'] !== "N"){?>
<? if ($value["show_basket"] === "Y"){?>
<p class="tocenter">
<a class="tobasket js-tracking" rel="nofollow" data-type="Timetable" data-action="AddToBasket" data-name="<?=$value["course_code"] ?> <?=$value["name"]?> || <?=$value[course_id]?> || <?=$value['schedule_id']?>"  title="Запомнить и положить в корзину услуг" id_basket="<?=$value['schedule_id']?>" href="#"><img src="/images_edu/diffs/basket_put.png" width="32" height="32" alt="Запомнить и положить в корзину услуг" border="0"></a> <br />
</p>
<? } ?>
				<? } ?>

			</td>
		<?/* } */?>
		</tr>
<?
		$sortirovka = $sortirovka_new;
	}
?>
	</table>