<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	$ii=0; // для массива куда мы будем ложить значения
	$vMavCount = 9;
	$arValueOfCourses = array();
 ?><?foreach($arResult["ITEMS"] as $arItem):?><?
          //$course_code = $arItem['PROPERTIES']['course_code']['VALUE'];
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

 		$arSelect = Array(
	 		"PROPERTY_course_price",
	 		"PROPERTY_course_duration",
	 		"PROPERTY_course_idcategory",
	 		"PROPERTY_course_code",
			"PROPERTY_course_format",
			"PROPERTY_ID_COURSE_OWNER",
	 		"NAME",
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
	 		//iwrite($ar_fields);
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
?><? $ii=$ii+1;?>
<?endforeach;?>

<div id="lux_block" style="text-align: left; font-size: 10px; font-weight: normal; font-family:Arial serif; width:230px; height:398px; background: #FFF;">
<div style="padding:5px;">
<div id="lux_title" align="left" style="font-size: 17px;font-weight: bold;  margin-bottom:5px;margin-left:0px;"><a target="_blank" style="color:#FC711B;" href="http://ibs-training.ru/?r1=sql_ru&r2=schedule" title="Обучение от экспертов в сфере разработки ПО по IT специальностям">Учебный Центр Luxoft</a></div>

<!-- COURSE BLOCK -->
<div id="lux_tr_course">
<ul style="font-size: 13px; list-style:none; margin:0 0 3px 0px; padding:0px;">
<?
	$index = 0;
	while (list($key, $value) = each($arValueOfCourses)) {
?>
<? if ((($value["courseOwnerID"] == 120) or ($value["courseOwnerID"] == 121))  and ($vMavCount > $index)) {?>
<li style="padding:0px 0px 6px 0px ;">
		<a style="font-size: 13px; color:blue; " href="http://ibs-training.ru/training/catalog/course.html?ID=<?=$value[course_id]?>&ID_TIME=<?=$value[time_id]?>&r1=sql_ru&r2=schedule"><?= $value["name"] ?></a>,<span class="lux_span_date"  style="font-size: 13px"> <?=$value["startdate"] ?> </span>
</li>
<? $index = $index + 1; ?>
<? } ?>
<?
   }
?>
</ul>
</div>
<!-- COURSE BLOCK  END-->
<span class="lux_more" style="padding:5px 0px 0px 0px; font-size: 13px;  font-weight: bold">
	<a style="color:#blue;" href="http://ibs-training.ru/timetable/?r1=sql_ru&r2=schedule" title="Полное расписание">
		Расписание всех тренингов
	</a>
</span>
</div>
</div>

