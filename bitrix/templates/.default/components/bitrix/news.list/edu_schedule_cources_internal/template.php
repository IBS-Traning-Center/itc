<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
CModule::IncludeModule("currency");
	$ii=0; // для массива куда мы будем ложить значения
	$arValueOfCourses = array();
	$GLOBALS["existInTimetable"] = "Y";
	$GLOBALS["testUrlToIntHR"] = "https://inthr.luxoft.com/IntHRWebApp/aspx_PTC/CreateRequestInternal.aspx?Course=";

?>

<?foreach($arResult["ITEMS"] as $arItem):?>
<?
		$prepod_surname="";$prepod_name="";$prepod_code="";
		$schedule_course_id = $arItem['PROPERTIES']['schedule_course']['VALUE'];
		$schedule_city_id = $arItem['PROPERTIES']['city']['VALUE'];
		$schedule_startdate = $arItem['PROPERTIES']['startdate']['VALUE'];
		$schedule_enddate = $arItem['PROPERTIES']['enddate']['VALUE'];
		$schedule_time = $arItem['PROPERTIES']['schedule_time']['VALUE'];
		$schedule_description = $arItem['PROPERTIES']['schedule_description']['VALUE']['TEXT'];
		$schedule_price = $arItem['PROPERTIES']['schedule_price']['VALUE'];
		$schedule_duration = $arItem['PROPERTIES']['schedule_duration']['VALUE'];
		$schedule_teacher_id = $arItem['PROPERTIES']['teacher']['VALUE'];
		$dateCourseStart = $schedule_startdate;
		if ($schedule_enddate == "")  { } else   {
			$schedule_startdate .= "-" . $schedule_enddate;
		}

		//сначала  получим валюту города
		// Рубли или Гривны
		$arSelect = Array("PROPERTY_edu_type_money","NAME");
		$arFilter = Array("IBLOCK_ID"=>51,"ID"=>$schedule_city_id);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
			$currency= $ar_fields["PROPERTY_EDU_TYPE_MONEY_VALUE"];
			$schedule_city =  $ar_fields["NAME"];
		}

		//теперь  получим цену курса
		// и ее длительность по умолчанию
 		$arSelect = Array(
			"PROPERTY_course_price",
			"PROPERTY_course_duration",
			"PROPERTY_course_idcategory",
			"PROPERTY_course_code"
 		);
		$arFilter = Array("IBLOCK_ID"=>6,"ID"=>$schedule_course_id);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$course_price= $ar_fields["PROPERTY_COURSE_PRICE_VALUE"];
	 		$course_duration= $ar_fields["PROPERTY_COURSE_DURATION_VALUE"];
	 		$course_id_category= $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
	 		$course_code= $ar_fields["PROPERTY_COURSE_CODE_VALUE"];
		}
        if ($schedule_price== "")
        { $schedule_price =  $course_price; }
        if ($schedule_duration =="")
         { $schedule_duration =  $course_duration;  }
  		if  ($schedule_teacher_id>0) {

	        //теперь  получим имя преподавателя
	  		$arSelect = Array("NAME", "PROPERTY_expert_name","CODE");
			$arFilter = Array("IBLOCK_ID"=>56,"ID"=>$schedule_teacher_id);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ar_fields = $res->GetNext())
			{
		 		$prepod_surname = $ar_fields["NAME"];
		 		$prepod_code    = strtolower($ar_fields["CODE"]);
		 		$prepod_name    = $ar_fields["PROPERTY_EXPERT_NAME_VALUE"];
			}
		}
        ?>

<?php
		$arValueOfCourses[$ii]["datecoursestart"] = $dateCourseStart;
		$arValueOfCourses[$ii]["schedule_id"] = $arItem["ID"];
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
		$arValueOfCourses[$ii]["detail_page_url"] =$arItem["DETAIL_PAGE_URL"];
		$arValueOfCourses[$ii]["schedule_city"] = $schedule_city;
		$arValueOfCourses[$ii]["currency"] = $currency;
		//iwrite($arValueOfCourses[$ii]);
?>
		<? $ii = $ii+1; ?>
<?endforeach;?>


		<?php
		// даlее будем сортировать многомерный массив
		// по полю сортировку .
		// таким образом отсортируем по категориям
		function cmp($a, $b)
		{
			if ($a["sort"] == $b["sort"]) {
				return 0;
			}
			return ($a["sort"] < $b["sort"]) ? -1 : 1;
		}
		?>

		<?
		$sortirovka=0; $number_of = 0;
		while (list($key, $value) = each($arValueOfCourses)) {
			$sortirovka_new=$value["sort"];?>
			<? if ($number_of == 0) {?>
				<h2>Курс поставлен в расписание: </h2>
			<? } ?>
			<div class="idcourse">
				<p style="display:none">
					<?if (($_REQUEST["ID_TIME"] == $value["schedule_id"]) or (count($arResult["ITEMS"]) == 1)) {?>
						<span id="from_event_date"><?=$value["datecoursestart"]?></span>
					<?} else {?>
						<?=$value["startdate"]?>
					<? } ?>
				</p>
				<p><strong><?=$value["startdate"]?>, <?=$value["schedule_city"]?></strong>
				<? if (strlen($value["prepod_surname"])>0) {?>
					<br />Тренер: <a href="/about/experts/<?=$value['prepod_code']?>.html">
					<?=$value["prepod_surname"];?> <?=$value["prepod_name"];?></a>
				<? } ?>
				<br />Время: <?=$value["time"]?>
				<br />Длительность: <?=$value["duration"];?> час.
				<!--<br />Стоимость: <?=number_format($value["price"], 0, '', ' ');?>
				<?if ($value["currency"]=="Рубли") {?> р.<? }else{ ?> грн. <? } ?>
				-->
				</p>
				<p>
				<span class="links"><a target="_blank" href="<? echo $GLOBALS['testUrlToIntHR'].$course_code;?>">Подать заявку на участие через систему IntHR</a> </br>
				<br /><a href='#fill_form'>(как это сделать?)</a></span>
				
				</p>
			</div>
			<div class="botborder"></div>
		<?
			$sortirovka = $sortirovka_new;
			$number_of  = $number_of + 1;
		}
		?>
<?
	if ($number_of==0){
		//теперь  получим цену курса
		// и ее длительность по умолчанию
		$arSelect = Array(
			"PROPERTY_course_price",
			"PROPERTY_course_duration",
			"PROPERTY_course_idcategory",
			"PROPERTY_course_code"
		);
		$arFilter = Array("IBLOCK_ID"=>6,"=PROPERTY_COURSE_CODE"=>$_GET["CODE"]);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
			$course_price= $ar_fields["PROPERTY_COURSE_PRICE_VALUE"];
			$course_duration= $ar_fields["PROPERTY_COURSE_DURATION_VALUE"];
			$course_id_category= $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
			$course_code= $ar_fields["PROPERTY_COURSE_CODE_VALUE"];

		}
		$GLOBALS["existInTimetable"] = "N";
?>
		<h2>Курс в ближ. время  не запланирован</h2>
		<p>Можно <a target="_blank" href="<? echo $GLOBALS['testUrlToIntHR'].$course_code;?>">подать заявку</a>  на участие через систему IntHR
		 <br /><a href='#fill_form'>(как это сделать?)</a> </p>
		<p><?if (strlen($course_duration)>0) {?>
			<strong>Длительность</strong>: <?=$course_duration;?> час.
		<? } ?>

		</p>
	<? } ?>





