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
		$schedule_teacher_string = $arItem['PROPERTIES']['string_teacher']['VALUE'];
		$dateCourseStart = $schedule_startdate;
		if (strlen($schedule_enddate)>0) {
			$schedule_startdate .= "-" . $schedule_enddate;
		}

		//сначала  получим валюту города
		//Рубли или Гривны
		$arSelect = Array("PROPERTY_edu_type_money","NAME");
		$arFilter = Array("IBLOCK_ID"=>51,"ID"=>$schedule_city_id);
//iwrite($arFilter);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($arCity = $res->GetNext())
		{
			$currency = $arCity["PROPERTY_EDU_TYPE_MONEY_VALUE"];
			$CURRENCY_ENUM_ID = $arCity["PROPERTY_EDU_TYPE_MONEY_ENUM_ID"];
			$schedule_city = $arCity["NAME"];
//iwrite($arCity);
//echo $CURRENCY_ENUM_ID;
		}
		switch ($CURRENCY_ENUM_ID) {
			case CITY_CURRENCY_RUB:
				$vCurrencyAdd = " р.";
				break;
			case CITY_CURRENCY_BYR:
				$vCurrencyAdd = " бел. р.";
				break;
			case CITY_CURRENCY_GRN:
				$vCurrencyAdd = " грн.";
				break;
			default:
			  $vCurrencyAdd = " р.";


		}
//echo $vCurrencyAdd;	
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
		$schedule_discount=0;
		if (intval($_REQUEST["ID_TIME"])==$arItem["ID"] && strlen($_REQUEST["seo"])>0) {
            $schedule_discount=fn_GetCourseDis($arItem["ID"], $schedule_price);
        }
        if (strlen($schedule_duration) == 0) {
        	$schedule_duration = $course_duration;
        }
	    //теперь  получим имя преподавателя
$prepod_photo=array();
  		if ($schedule_teacher_id > 0) {
	  		$arSelect = Array("NAME", "PROPERTY_expert_name","CODE", "DETAIL_PICTURE");
			$arFilter = Array("IBLOCK_ID"=>56,"ID"=>$schedule_teacher_id);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ar_fields = $res->GetNext())
			{
		 		$prepod_surname = $ar_fields["NAME"];
		 		$prepod_code    = strtolower($ar_fields["CODE"]);
		 		$prepod_name    = $ar_fields["PROPERTY_EXPERT_NAME_VALUE"];
				$prepod_active  = $ar_fields["ACTIVE"];
				$prepod_photo = CFile::GetFileArray($ar_fields["DETAIL_PICTURE"]);
			}
		} else {
			$prepod_active  = "N";
			$prepod_surname = $schedule_teacher_string;
		}
        ?>

<?
		$ar_pes = CPrice::GetBasePrice($arItem["ID"]);
        if ($ar_pes["CURRENCY"]=="RUB") {
            $vCurrencyAdd = " р.";
        } elseif ($ar_pes["CURRENCY"]=="USD") {
            $vCurrencyAdd = "$";
        }  elseif ($ar_pes["CURRENCY"]=="BYR") {
            $vCurrencyAdd = " бел. р.";
        } elseif ($ar_pes["CURRENCY"]=="GRN") {
            $vCurrencyAdd = " грн.";
        } else {
            $vCurrencyAdd = " р.";
        }
		$arValueOfCourses[$ii]["datecoursestart"] = $dateCourseStart;
		$arValueOfCourses[$ii]["schedule_id"] = $arItem["ID"];
		$arValueOfCourses[$ii]["name"] = $arItem["NAME"];
		$arValueOfCourses[$ii]["schedule_city_id"] = $schedule_city_id;

		$arValueOfCourses[$ii]["startdate"] = $schedule_startdate;
		$arValueOfCourses[$ii]["time"] = $schedule_time;
		$arValueOfCourses[$ii]["duration"] = $schedule_duration;
		$arValueOfCourses[$ii]["price"] = $schedule_price;
		$arValueOfCourses[$ii]["schedule_discount"] = $schedule_discount;
		$arValueOfCourses[$ii]["course_id"] = $schedule_course_id;
		$arValueOfCourses[$ii]["course_code"] = $course_code;
		$arValueOfCourses[$ii]["cat_id"] = $course_id_category;
		$arValueOfCourses[$ii]["prepod_surname"] = $prepod_surname;
		$arValueOfCourses[$ii]["prepod_code"] = $prepod_code;
		$arValueOfCourses[$ii]["prepod_name"] = $prepod_name;
		$arValueOfCourses[$ii]["prepod_photo"] = $prepod_photo;
		$arValueOfCourses[$ii]["detail_page_url"] =$arItem["DETAIL_PAGE_URL"];
		$arValueOfCourses[$ii]["schedule_city"] = $schedule_city;
		$arValueOfCourses[$ii]["currency"] = $currency;
		$arValueOfCourses[$ii]["online_id"] = $course_online_enumid;
		$arValueOfCourses[$ii]["time_interval"] = $arItem['PROPERTIES']['TIME_INTERVAL']['VALUE'];
		$arValueOfCourses[$ii]['CURRENCY_NEW'] = $vCurrencyAdd ; 
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
		randInt = Math.floor(Math.random()*100000);
		var id_record = $(this).attr("id_basket");
		//console.info('/ajax/add_course_to_basket.php?action=ADD2BASKET&id='+id_record+'&quantity=1&dis='+$(this).attr('rev'));
		$.getJSON('/ajax/add_course_to_basket.php?action=ADD2BASKET&id='+id_record+'&quantity=1&dis='+$(this).attr('rev'),function(data){
			$(".basketSmall").fadeOut("slow");
			$(".basketSmall").load("/ajax/show_basket.php?rand='+randInt+'",{limit: 25}, function(){
				$(".basketSmall").fadeIn("slow");
				alert('Курс добавлен в корзину');
			});
		});
		
		/*$(".basketSmall").fadeOut("slow");
	   	$(".basketSmall").load("/ajax/show_basket.php?rand='+randInt+'",{limit: 25});
	   	$(".basketSmall").fadeIn("slow");*/

	   	return false;
	});
	$(".show_tooltip").tooltip({  position: 'center right', opacity: 0.9,  effect: 'toggle' ,  offset: [25, 10] });

});
</script>

		<?
		 //echo count($arResult["ITEMS"]);
		$sortirovka=0; $number_of = 0;
		while (list($key, $value) = each($arValueOfCourses)) {
		?>
			<? if ($number_of == 0) {?>
				<div class="">
				
				
			<? } ?>
			<div class="idcourse">
				<?if (strlen($value["prepod_photo"]["SRC"])>0) {?>
					<div style="float: left; padding:0; margin-right: 20px; padding-top: 15px;" title="<?=$value["prepod_surname"];?>  <?=$value["prepod_name"];?>"> 
						<img src="<?=$value["prepod_photo"]["SRC"]?>" alt="<?=$value["prepod_name"];?>" />
					</div>
				<?}?>
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
	
				<div style="margin-bottom: 15px; float: left;">
					<strong><?=$value["startdate"]?></strong> <noindex><a href="/training/catalog/ics_course.html?ID=<?=$value['schedule_id']?>" rel="nofollow" title="Добавить курс в календарь"><img class="" width="24" border="0" src="/downloads/images/47-ical_24_24.png"/></a></noindex>
					<br />Локация: <?=$value["schedule_city"]?>
					<? if (strlen($value["prepod_surname"])>0) {?>
						<br />Тренер:
						<?if ($value["prepod_code"]) {?>
						<a href="/about/experts/<?=$value['prepod_code']?>.html"><?=$value["prepod_surname"];?> <?=$value["prepod_name"];?></a>
						<?} else {?>
						<?=$value["prepod_surname"];?>  <?=$value["prepod_name"];?>
						<?}?>
					<? } ?>
					<br />Время <?if (($value["online_id"] == "103") or ($value["schedule_city_id"] == CITY_ID_ONLINE)){?>(моск.)<? } ?>  : 
					<?if ($value["time_interval"]){?> 
						<a  class="show_tooltip posrel"><?=$value["time"]?></a>
						<div class="tooltip"><?=$value["time_interval"]?></div>
					<? } else { ?>
							<?=$value["time"]?>
					<? } ?>
					<br />Длительность: <?=$value["duration"];?> час.
					<br />Стоимость: 
					 <?if (intval($value["schedule_discount"])==0 || $value["schedule_discount"]==$value["price"]) {?>
                            <?=number_format($value["price"], 0, '', ' ');?> <?=$value["CURRENCY_NEW"];?>
                        <?} else {?>
                            <s><?=number_format($value["price"], 0, '', ' ');?> <?=$value["CURRENCY_NEW"];?></s>&nbsp<?=number_format($value["schedule_discount"], 0, '', ' ');?>  <?=$value["CURRENCY_NEW"];?>
                        <?}?>
				</div>
				<div style="float: right;padding-top: 14px; text-align: center">
				<h2>Корзина:</h2>				
				<div style="width: 116px; background-color: #FFFFFF; padding:5px 5px 5px 0px;">
					<p style="text-align:center; padding: 0; padding-bottom: 10px;"><a class="tobasket js-tracking" rev="<?if (intval($value["schedule_discount"])>0) {?>seo<?}?>" data-type="CoursePage" data-action="AddToBasket" data-name="<?=$value["course_code"] ?> <?=$value["name"]?> || <?=$value[course_id]?> || <?=$value['schedule_id']?>" rel="nofollow" title="Запомнить и положить в корзину услуг" id_basket="<?=$value['schedule_id']?>" href="#"><img src="/images_edu/diffs/basket_put.png" style="float:none;" width="32" height="32" alt="Запомнить и положить в корзину услуг" border="0"/></a>  </p>
					<span class="links">
						<noindex><a rel="nofollow" class="js-tracking" data-type="CoursePage" data-action="AddToBasket" data-name="<?=$value["course_code"] ?> <?=$value["name"]?> || <?=$value[course_id]?> || <?=$value['schedule_id']?>"  title="Перейти к оплате тренинга. Оплата происходит путем онлайн платежей или по квитанции для частных лиц и выставления счета для юридических лиц" href="/services/buy_course.html?action=BUY&id=<?=$value['schedule_id']?><?if (intval($value["schedule_discount"])>0) {?>&dis=seo<?}?>">Перейти к оплате</a></noindex>
					</span><br />

					

				</div>
				</div>
				 <div style="clear:both"></div>

			</div>
			<div class="botborder cl" style="border-bottom: 1px solid #EEEEEE;"></div>
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

			<?
				$arEventInfo["DATE"] = "";
				$arEventInfo["EVENT_CITY"] = "-";
				$arEventInfo["PRICE"] =  $course_price;
				$arEventInfo["DURATION"] =  $course_duration;
			?>
		<? } ?>