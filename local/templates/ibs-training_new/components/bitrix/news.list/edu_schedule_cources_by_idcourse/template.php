<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
CModule::IncludeModule("currency");
	$ii = 0; // для массива куда мы будем ложить значения
	$arValueOfCourses = array();
	global  $arEventInfo, $bOnlineCourse, $arCoursesInfo;
?>
<?foreach($arResult["ITEMS"] as $arItem):?>
<?
		//iwrite($arItem['PROPERTIES']);
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
		if (strlen($schedule_enddate)>0) {
			$schedule_startdate .= "-" . $schedule_enddate;
		}

		//сначала  получим валюту города
		//Рубли или Гривны
		$arSelect = Array("PROPERTY_edu_type_money","NAME");
		$arFilter = Array("IBLOCK_ID"=>51,"ID"=>$schedule_city_id);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($arCity = $res->GetNext())
		{
			$currency = $arCity["PROPERTY_EDU_TYPE_MONEY_VALUE"];
			$schedule_city = $arCity["NAME"];
		}

		// теперь  получим цену курса и ее длительность по умолчанию
		// делаем запрос только в первый раз чтобы не дергать одно и тоже
		if ($ii == 0){
	 		$arSelect = Array(
				"PROPERTY_course_price",
				"PROPERTY_course_duration",
				"PROPERTY_course_idcategory",
				"PROPERTY_course_code",
				"PROPERTY_course_format"
	 		);
			$arFilter = Array("IBLOCK_ID"=>6,"ID"=>$schedule_course_id);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ar_fields = $res->GetNext())
			{
		 		$course_price= $ar_fields["PROPERTY_COURSE_PRICE_VALUE"];
		 		$course_duration= $ar_fields["PROPERTY_COURSE_DURATION_VALUE"];
		 		$course_id_category= $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
		 		$course_code= $ar_fields["PROPERTY_COURSE_CODE_VALUE"];
		 		$course_online_enumid= $ar_fields["PROPERTY_COURSE_FORMAT_ENUM_ID"];
				$arEventInfo["PRICE"] =  $course_price;
				$arEventInfo["DURATION"] =  $course_duration;
			}
	        if ($course_online_enumid == 103 ){
	        	$bOnlineCourse = true;
	        } else {
                $bOnlineCourse = false;
	      	}
		}

        if (strlen($schedule_price) == 0) {
			$schedule_price = $course_price;
		}
        if (strlen($schedule_duration) == 0) {
        	$schedule_duration = $course_duration;
        }
	    //теперь  получим имя преподавателя
  		if ($schedule_teacher_id > 0) {
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

<?
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
		$arValueOfCourses[$ii]["online_id"] = $course_online_enumid;

		$arCoursesInfo[$ii]['NAME'] = $arItem["NAME"];
		$arCoursesInfo[$ii]['CODE'] = $course_code;
		$arCoursesInfo[$ii]['DATE'] = $schedule_startdate;
		$arCoursesInfo[$ii]['DATE_BEGIN'] = $arItem['PROPERTIES']['startdate']['VALUE'];
		$arCoursesInfo[$ii]['EVENT_CITY'] = $schedule_city;
		$arCoursesInfo[$ii]['ID_TIME'] = $arItem["ID"];


?>
		<? $ii = $ii+1; ?>
<?endforeach;?>
<script>
$(document).ready(function() {
	var randInt;
	$("a.tobasket").click(function(){
		$(this).fadeOut("fast");
		$(this).fadeIn("fast");
		var id_record = $(this).attr("id_basket");
		$.getJSON('/ajax/add_course_to_basket.php?action=ADD2BASKET&id='+id_record+'&quantity=1',function(data){
		});
		randInt = Math.floor(Math.random()*100000);
		$(".basketSmall").fadeOut("slow");
	   	$(".basketSmall").load("/ajax/show_basket.php?rand='+randInt+'",{limit: 25});
	   	$(".basketSmall").fadeIn("slow");
	   	pageTracker._trackEvent('Order', 'PutToBasket', id_record);
	   	return false;
	});
});
</script>

		<?
		 //echo count($arResult["ITEMS"]);
		$sortirovka=0; $number_of = 0;
		while (list($key, $value) = each($arValueOfCourses)) {
		?>
			<? if ($number_of == 0) {?>
				<div class="buble_body">
				<h2>Курс поставлен в расписание: </h2>
			<? } ?>
			<div class="idcourse">
				<p style="display:none">
					<?if (($_REQUEST["ID_TIME"] == $value["schedule_id"]) or (count($arResult["ITEMS"]) == 1)) {?>
						<span id="from_event_date"><?=$value["datecoursestart"]?></span>
						<?
						$arEventInfo["DATE"] = $value["datecoursestart"];
						$arEventInfo["EVENT_CITY"] = $value["schedule_city"];
						$arEventInfo["TIMETABLE_ID"] = $value['schedule_id'];

						?>
					<?} else {?>
						<?=$value["startdate"]?>
					<? } ?>
				</p>
<div>
<noindex><a href="/training/catalog/ics_course.html?ID=<?=$value['schedule_id']?>" rel="nofollow" title="Добавить курс в календарь"><img width="24" border="0" src="/downloads/images/47-ical_24_24.png"></a></noindex>
</div>
				<p>
					<strong><?=$value["startdate"]?>, <?=$value["schedule_city"]?></strong>
					<? if (strlen($value["prepod_surname"])>0) {?>
						<br />Тренер: <a href="/about/experts/<?=$value['prepod_code']?>.html">
						<?=$value["prepod_surname"];?> <?=$value["prepod_name"];?></a>
					<? } ?>
					<br />Время <?if ($value["online_id"] == "103"){?>(моск.)<? } ?>  : <?=$value["time"]?>
					<br />Длительность: <?=$value["duration"];?> час.
					<br />Стоимость: <?=number_format($value["price"], 0, '', ' ');?>
					<?if ($value["currency"]=="Рубли") {?> р.<? }else{ ?> грн. <? } ?>
				</p>

				<p>

					<span class="links">
						<a  title="Забронировать место на тренинге или подать предварительную заявку." href="/training/catalog/course.html?ID=<?=$_REQUEST['ID']?>&ID_TIME=<?=$value['schedule_id']?>#reg">Зарегистрироваться</a>
					</span><br />
					<span class="links">
						<noindex><a rel="nofollow"  title="Перейти к оплате тренинга. Оплата происходит путем онлайн платежей или по квитанции для частных лиц и выставления счета для юридических лиц" href="/services/buy_course.html?action=BUY&id=<?=$value['schedule_id']?>">Перейти к оплате</a></noindex>
					</span><br />

					<p style="text-align:center;"><a class="tobasket" rel="nofollow" title="Запомнить и положить в корзину услуг" id_basket="<?=$value['schedule_id']?>" href="#"><img src="/images_edu/diffs/basket_put.png" style="float:none;" width="32" height="32" alt="Запомнить и положить в корзину услуг" border="0"></a> <br />  </p>

				</p>
			</div>
			<div class="botborder"></div>
			<?
				$number_of  = $number_of + 1;
			}
		?>
		<?if ($number_of > 0){?>
		      </div><!-- .buble_body ends-->
		<br />
		<? } ?>
		<?
		//теперь рассмотрим ситуацию когда тренинг не стоит в расписании воообще
		// получим цену курса и ее длительность по умолчанию
		if (count($arResult["ITEMS"]) == 0){
			$arSelect = Array(
				"PROPERTY_course_price",
				"PROPERTY_course_duration",
				"PROPERTY_course_idcategory",
				"PROPERTY_course_code",
				"PROPERTY_course_format"
			);
			$arFilter = Array("IBLOCK_ID"=>6,"ID"=>intval($_GET["ID"]));
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ar_fields = $res->GetNext())
			{
				$course_price = $ar_fields["PROPERTY_COURSE_PRICE_VALUE"];
				$course_duration = $ar_fields["PROPERTY_COURSE_DURATION_VALUE"];
				$course_id_category = $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
				$course_code = $ar_fields["PROPERTY_COURSE_CODE_VALUE"];
		 		$course_online_enumid = $ar_fields["PROPERTY_COURSE_FORMAT_ENUM_ID"];
			}
			if ($course_online_enumid == 103 ){
				$bOnlineCourse = true;
			} else {
				$bOnlineCourse = false;
			}?>
			<?/*<h2>Курс в ближ. время  не запланирован</h2>
			<p>Можно <a href='#fill_form'>подать заявку</a> на участие.
			 Вас известят, когда курс будет поставлен в расписание.</p>
			*/?>
			<?/*
			<p><?if (strlen($course_duration)>0) {?>
				<strong>Длительность</strong>: <?=$course_duration;?> час.
			<? } ?>
			<?if (strlen($course_price)>0) {?>
				<br /><strong>Стоимость</strong>: <?=number_format($course_price, 0, '', ' ');?>  р.</p>
			<? } ?>
			</p>
			<p><strong>Вы можете:</strong><br />
			<span class="links"><a href="#fill_form">Зарегистрироваться</a></span></br>
			</p>
			*/?>
			<?
				$arEventInfo["DATE"] = "";
				$arEventInfo["EVENT_CITY"] = "-";
				$arEventInfo["PRICE"] =  $course_price;
				$arEventInfo["DURATION"] =  $course_duration;
			?>
		<? } ?>
