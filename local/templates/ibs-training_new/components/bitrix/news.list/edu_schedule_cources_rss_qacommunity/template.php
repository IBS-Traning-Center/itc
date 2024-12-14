<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	$ii=0; // для массива куда мы будем ложить значения
	$vMavCount = 8;
	$arValueOfCourses = array();
 ?><?foreach($arResult["ITEMS"] as $arItem):?><?
          //$course_code = $arItem['PROPERTIES']['course_code']['VALUE'];
          $prepod_surname="";$prepod_name="";$prepod_code="";
          $schedule_course_id = $arItem['PROPERTIES']['schedule_course']['VALUE'];
          $schedule_city = $arItem['PROPERTIES']['city']['VALUE'];
          $schedule_startdate = $arItem['PROPERTIES']['startdate']['VALUE'];
          $schedule_enddate = $arItem['PROPERTIES']['enddate']['VALUE'];
          $schedule_time = $arItem['PROPERTIES']['schedule_time']['VALUE'];
          $schedule_description = $arItem['PROPERTIES']['schedule_description']['VALUE']['TEXT'];
          $schedule_price = $arItem['PROPERTIES']['schedule_price']['VALUE'];
          $schedule_duration = $arItem['PROPERTIES']['schedule_duration']['VALUE'];
          $schedule_teacher_id = $arItem['PROPERTIES']['teacher']['VALUE'];
        //iwrite($arItem['PROPERTIES']);

        $arSelect = Array("NAME");
		$arFilter = Array("IBLOCK_ID"=>51, "ID"=>$schedule_city);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$vCityName = $ar_fields["NAME"];
		}


 		$arSelect = Array(
	 		"PROPERTY_course_price",
	 		"PROPERTY_course_duration",
	 		"PROPERTY_course_idcategory",
	 		"PROPERTY_course_code",
			"PROPERTY_course_format",
			"PROPERTY_ID_COURSE_OWNER",
	 		"NAME",
	 		"PROPERTY_city",
 		);
		$arFilter = Array("IBLOCK_ID"=>6,"ID"=>$schedule_course_id);
		//print_r($arFilter);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$course_price = $ar_fields["PROPERTY_COURSE_PRICE_VALUE"];
	 		$course_duration = $ar_fields["PROPERTY_COURSE_DURATION_VALUE"];
	 		$course_id_category = $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
	 		$course_code = $ar_fields["PROPERTY_COURSE_CODE_VALUE"];
	 		$course_online_enumid = $ar_fields["PROPERTY_COURSE_FORMAT_ENUM_ID"];
	 		$courseNameFromCatalog = $ar_fields["NAME"];
	 		$courseOwnerID = $ar_fields["PROPERTY_ID_COURSE_OWNER_ENUM_ID"];

		}

  		$arSelect = Array("NAME", "SORT");
		$arFilter = Array("IBLOCK_ID"=>50,"ID"=>$course_id_category);

		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$cat_name= $ar_fields["NAME"];
	 		$cat_sort= $ar_fields["SORT"];
		}

       $arValueOfCourses[$ii]["sort"] = $cat_sort;
       $arValueOfCourses[$ii]["cat_name"] = $cat_name;
       $arValueOfCourses[$ii]["name"] = trim($courseNameFromCatalog);
       $arValueOfCourses[$ii]["startdate"] = $schedule_startdate;
       $arValueOfCourses[$ii]["time"] = $schedule_time;
       $arValueOfCourses[$ii]["duration"] = $schedule_duration;
       $arValueOfCourses[$ii]["price"] = $schedule_price;
       $arValueOfCourses[$ii]["course_id"] = $schedule_course_id;
       $arValueOfCourses[$ii]["course_code"] = $course_code;
       $arValueOfCourses[$ii]["cat_id"] = $course_id_category;
       $arValueOfCourses[$ii]["online_id"] = $course_online_enumid;
       $arValueOfCourses[$ii]["courseOwnerID"] = $courseOwnerID;
       $arValueOfCourses[$ii]["time_id"] = $arItem["ID"];
       $arValueOfCourses[$ii]["detail_page_url"] =$arItem["DETAIL_PAGE_URL"];
       $arValueOfCourses[$ii]["city"]  =  $vCityName;
?><? $ii=$ii+1;?>
<?endforeach;?>


<div id="lux_block" style="text-align: left; font-size: 10px; font-weight: normal; font-family:Arial serif; width:240px; height:498px;">
<div style="padding:0px 2px 0px 2px;">
<div id="lux_title" align="left" style="font-size: 16px; font-family: trebuchet MS; font-weight: normal; color: #0033CC; text-decoration: underline;  margin-bottom:2px;"><a target="_blank" style="color:#0033CC;" href="http://www.luxoft-training.ru/?r1=dneprqa&r2=schedule" title="Обучение от экспертов в сфере разработки ПО по IT специальностям. Курсы">Учебный Центр Luxoft</a></div>
<div id="lux_nearest" align="left" style="font-size: 14px; font-family: trebuchet MS; font-weight: normal; color:#666666; text-decoration: none;margin-bottom:2px; ">Ближайшие курсы:</div>

<!-- COURSE BLOCK -->
<div id="lux_tr_course">
<ul style="font-size: 12px; font-family: trebuchet MS; font-weight: normal; font-color:#0033CC; text-decoration: none; list-style:none; margin:0 0 5px 0px; padding:0px;">
<?
	$index = 0;
	while (list($key, $value) = each($arValueOfCourses)) {
?>
<? if ((($value["courseOwnerID"] == 120) or ($value["courseOwnerID"] == 121))  and ($vMavCount > $index)) {?>
<li style="padding:0px 0px 3px 0px ;">
		<a style="font-size: 12px; color:#0033CC;" title="Подробнее о курсе: <?=$value['name']?>" href="http://www.luxoft-training.ru/training/catalog/course.html?ID=<?=$value[course_id]?>&ID_TIME=<?=$value[time_id]?>&r1=dneprqa&r2=schedule"><?= $value["name"] ?></a> <?= $value["city"] ?>, <span class="lux_span_date"  style="font-size: 12px"> <?=$value["startdate"] ?> </span>
</li>
<? $index = $index + 1; ?>
<? } ?>
<?
   }
?>
</ul>
</div>
<!-- COURSE BLOCK  END-->
<span class="lux_more" style="padding:3px 0px 0px 0px; font-size: 14px; font-family: trebuchet MS; font-weight: normal; color:#666666; text-decoration: none;">
	<a style="color:#666666;" href="http://www.luxoft-training.ru/events/seminar/?r1=dneprqa&r2=schedule" title="">
		Бесплатные мероприятия
	</a>
</span><br />
<span class="lux_more" style="padding:3px 0px 0px 0px; font-size: 14px; font-family: trebuchet MS; font-weight: normal; color:#666666; font-decoration: none;">
	<a style="color:#666666;" href="http://www.luxoft-training.ru/timetable/index.html?city=kiev&r1=dneprqa&r2=schedule" title="Полное расписание курсов Учебного Центра Luxoft">
		Полное расписание
	</a>
</span><br />
<span class="lux_discount_featured" style="font-size:13px; font-family: trebuchet MS; font-weight: normal; color:#000;">Скидка 15%</span> <span class="lux_discount_usual" style="font-size:13px; font-family: trebuchet MS; font-weight: normal; color:#000;">для членов QA community</span>
</div>
</div>

