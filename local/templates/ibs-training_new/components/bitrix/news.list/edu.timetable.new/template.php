<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	// сначала  получим валюту города
	// Рубли или Гривны
	$id_city=$APPLICATION->GetPageProperty("id_city");
	$arSelect = Array("PROPERTY_edu_type_money");
	$arFilter = Array("IBLOCK_ID"=>51,"ID"=>$id_city);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ar_fields = $res->GetNext()) {
		$valuta= $ar_fields["PROPERTY_EDU_TYPE_MONEY_VALUE"];
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
		$schedule_enddate = $arItem['PROPERTIES']['enddate']['VALUE'];
		$schedule_time = $arItem['PROPERTIES']['schedule_time']['VALUE'];
		$schedule_description = $arItem['PROPERTIES']['schedule_description']['VALUE']['TEXT'];
		$schedule_price = $arItem['PROPERTIES']['schedule_price']['VALUE'];
		$schedule_duration = $arItem['PROPERTIES']['schedule_duration']['VALUE'];
		$schedule_teacher_id = $arItem['PROPERTIES']['teacher']['VALUE'];
		if ($schedule_enddate == "")  { } else   {  $schedule_startdate .= "-<br />" . $schedule_enddate; }

		// теперь  получим цену курса  и ее
		// длительность по умолчанию
 		$arSelect = Array(
	 		"PROPERTY_course_price",
	 		"PROPERTY_course_duration",
	 		"PROPERTY_course_idcategory",
	 		"PROPERTY_course_code"
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
		}
        ?>
<?php
	   $arValueOfCourses[$ii]["schedule_id"] = $arItem["ID"];
       $arValueOfCourses[$ii]["sort"] = $cat_sort;
       $arValueOfCourses[$ii]["cat_name"] = $cat_name;
       $arValueOfCourses[$ii]["date_sort"] = $cat_date_sort;
       $arValueOfCourses[$ii]["name"] = $arItem["NAME"];
       $arValueOfCourses[$ii]["startdate"] = $schedule_startdate;
       $arValueOfCourses[$ii]["time"] = $schedule_time;
       $arValueOfCourses[$ii]["duration"] = $schedule_duration;
       $arValueOfCourses[$ii]["price"] = $schedule_price;
       $arValueOfCourses[$ii]["course_id"] = $schedule_course_id;
       $arValueOfCourses[$ii]["course_code"] = $course_code;
       $arValueOfCourses[$ii]["cat_id"] = $course_id_category;
       $arValueOfCourses[$ii]["prepod_surname"] = $prepod_surname;
       $arValueOfCourses[$ii]["prepod_code"] = $prepod_code;
       $arValueOfCourses[$ii]["prepod_name"] = $prepod_name;
       $arValueOfCourses[$ii]["prepod_active"] = $prepod_active;
       $arValueOfCourses[$ii]["detail_page_url"] =$arItem["DETAIL_PAGE_URL"];
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
	<h2 style="position:absolute;">Расписание ближайших курсов:</h2>
	<div class="edu_sort">
		<p class="timetable_sort">
		Cортировать по: <a href="<?=$_SERVER['SCRIPT_NAME']?>?by_date=Y<? if (isset($_GET['type'])) {?>&type=<?=$_GET['type']?><? }?><? if (isset($_GET['city'])) {?>&city=<?=$_GET['city']?><? } ?>">Месяцам</a>
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
			<td colSpan="6">
				<p><?= $value["cat_name"] ?></p>
			</td>
		</tr>
		<? } ?>
		<tr class="ewTableAltRow"  onmouseover='ew_mouseover(this);' onmouseout='ew_mouseout(this);'>
			<td class="td_code">
				<p class="nobr"><?=$value["course_code"] ?></p>
			</td>
			<td class="td_name">
				<p><a rel="nofollow" href="/training/catalog/course.html?ID=<?=$value[course_id]?>&ID_TIME=<?=$value['schedule_id']?>"><?= $value["name"] ?></a>
				<? if (strlen($value["prepod_surname"])>0)  {?>
					<br />тренер:
					<? if ($value["prepod_active"]=="Y") {?>
						<a class="orange" href="/about/experts/<?=$value['prepod_code']?>.html">
							<?=$value["prepod_surname"];?> <?=$value["prepod_name"];?>
						</a>
					<? } else { ?>
			        	<?=$value["prepod_surname"];?>  <?=$value["prepod_name"];?>
					<? } ?>
				<? } ?>
				</p>
			</td>
			<td class="td_date"><p class="nobr"><?= $value["startdate"] ?></p></td>
			<td class="td_time"><p class="nobr"><?=$value["time"]?></p></td>
			<td class="td_duration"><p class="nobr"><?=$value["duration"];?> ч.</p></td>
			<td class="td_price">
				<p class="nobr"><?=number_format($value["price"], 0, '', ' ');?> <?if ($valuta=="Рубли") {?> р.<? }else{ ?> грн. <? } ?></p>
			</td>
		<? global $USER;  if ($USER->IsAdmin()) {?>
			<td class="td_buy">
				<a rel="nofollow" href="/training/catalog/course.html?ID=<?=$value[course_id]?>&id_schedule=<?=$value['schedule_id']?>&payment_online=Y">Оплатить Online</a>
			</td>
		<? } ?>
		</tr>
<?
		$sortirovka = $sortirovka_new;
	}
?>
	</table>




