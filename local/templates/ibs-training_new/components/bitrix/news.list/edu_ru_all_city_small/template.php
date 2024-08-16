<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script>
$(document).ready(function() {
	var randInt;
	$("a.add-to-basket").click(function(){
		$(this).fadeOut("fast");
		$(this).fadeIn("fast");
		var id_record = $(this).attr("data_id");
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
               alert('Курс добавлен в корзину');
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
	CModule::IncludeModule("catalog");
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
			$vCurrencyAdd = " <span>р.</span>";
			break;
		case CITY_CURRENCY_BYR:
			$vCurrencyAdd = " бел. р.";
			break;
		case CITY_CURRENCY_GRN:
			$vCurrencyAdd = " грн.";
			break;
		default:
		  $vCurrencyAdd = " <span>р.</span>";
	}	
    // для массива куда мы будем ложить значения
	$ii=0;
	$arValueOfCourses = array();
	foreach($arResult["ITEMS"] as $arItem):?>
	<?
	
		
		$prepod_surname="";$prepod_name="";$prepod_code="";
		$schedule_landing="";
		$schedule_landing_code="";
		$schedule_landing = $arItem['PROPERTIES']['landing_mk']['VALUE'];
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
		if ($schedule_enddate == "")  { } else   {  $schedule_startdate = "<time itemprop='startDate' datetime='".$schedule_startdate_origin."'>".$schedule_startdate."</time>-" . "<time itemprop='endDate' datetime='".$schedule_enddate_origin."'>".$schedule_enddate."</time>"; }
		//iwrite($arItem['PROPERTIES']['IS_CLOSE']);
		$les = CIBlockElement::GetByID($schedule_landing);
		if($ar_res = $les->GetNext())
			$schedule_landing_code=$ar_res['CODE'];
		
		$ar_pes = CPrice::GetBasePrice($arItem["ID"]);
        if ($ar_pes["CURRENCY"]=="RUB") {
            $vCurrencyAdd = " <span>р.</span>";
        } elseif ($ar_pes["CURRENCY"]=="USD") {
            $vCurrencyAdd = "$";

        }  elseif ($ar_pes["CURRENCY"]=="BYR") {
            $vCurrencyAdd = " бел. р.";
        } elseif ($ar_pes["CURRENCY"]=="GRN") {
            $vCurrencyAdd = " $";
        } else {
            $vCurrencyAdd = " <span>р.</span>";
        }
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
	   $arValueOfCourses[$ii]["landing_code"] = $schedule_landing_code;
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
	   $arValueOfCourses[$ii]["valuta"] = $vCurrencyAdd;
       $arValueOfCourses[$ii]["schedule_city"] = $arItem['PROPERTIES']['city']['VALUE'];
if ($arItem['PROPERTIES']['IS_CLOSE']['VALUE_ENUM_ID'] === "136") {
       $arValueOfCourses[$ii]["show_basket"] = "N";
 

}
?>
	<? $ii=$ii+1; ?>
<?endforeach;?>
<?php/*
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
*/?>

<div class="left-course-list">
<?
	$sortirovka=0;
	while (list($key, $value) = each($arValueOfCourses)) {
		$sortirovka_new=$value["sort"];
        switch ($value["cat_id"]) {
            case "5735":
                $icon="buisness";
                break;
			case "53918":
                $icon="buisness";
                break;
            case "5725":
                $icon="analys";
                break;
            case "5730":
                $icon="develop";
                break;
            case "5728":
                $icon="arch";
                break;
            case "5729":
                $icon="test";
                break;
            case "5723":
                $icon="management";
                break;
        }
        ?>
        <div class="course-item">

                <a class="item-name js-tracking" data-type="Timetable" data-name="<?=$value["course_code"] ?> <?=$value["name"]?> || <?=$value[course_id]?> || <?=$value['schedule_id']?>" data-action="Click" itemprop="url" <?if (strlen($value["landing_code"])==0) {?>href="/kurs/<?=$value['XML']?>.html<? if ($value["show_basket"] === "Y"){?>?ID_TIME=<?=$value['schedule_id']?><? } ?>"<?} else {?>href="/master-class/<?=$value["landing_code"]?>/"<?}?>><?=$value["name"]?></a>
                <div class="it-section"><?=$value["cat_name"]?>  <?if (preg_match('#PTRN#', $value["course_code"])) {?><i class="guru">it-guru</i><?}?></div>
                <div class="treners-wrap">Тренер: <? if ($value["prepod_active"]=="Y") {?>
                        <a title="Перейти на страницу-карточку преподавателя" href="/about/experts/<?=$value['prepod_code']?>.html">
                            <?=$value["prepod_surname"];?> <?=$value["prepod_name"];?>
                        </a>
                    <? } else { ?>
                        <?=$value["prepod_surname"];?>  <?=$value["prepod_name"];?>
                    <? } ?>
                </div>

             <div class="date-cal">
                   <?=$value["startdate"]?>
             </div>

        </div>

<?
		$sortirovka = $sortirovka_new;
	}
?>
</div>
<a style="float: right" class="arrow-link" href="/timetable/">Полное расписание</a>
