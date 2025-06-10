<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
       //сначала  получим валюту города  // Рубли или Гривны

		$id_city=$GLOBALS["arrFilter"]["PROPERTY_city"];
        $arSelect = Array("PROPERTY_edu_type_money");
		$arFilter = Array("IBLOCK_ID"=>51,"ID"=>$id_city);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$valuta= $ar_fields["PROPERTY_EDU_TYPE_MONEY_VALUE"];
		}
        ?><?
	$ii=0; // для массива куда мы будем ложить значения
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

          if ($schedule_enddate == "")  { } else   {  $schedule_startdate .= "- " . $schedule_enddate; }


		//теперь  получим цену курса и ее длительность по умолчанию
 		$arSelect = Array("PROPERTY_course_price", "PROPERTY_course_duration", "PROPERTY_course_idcategory", "PROPERTY_course_code");
		$arFilter = Array("IBLOCK_ID"=>6,"ID"=>$schedule_course_id);
		//print_r($arFilter);
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


       //теперь  получим имя категории и ее сортировку в категориях курсов ID =50
  		$arSelect = Array("NAME", "SORT");
		$arFilter = Array("IBLOCK_ID"=>50,"ID"=>$course_id_category);
		//print_r($arFilter);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$cat_name= $ar_fields["NAME"];
	 		$cat_sort= $ar_fields["SORT"];
		}
		$prepod_surname=""; $prepod_code=""; $prepod_active=""; $prepod_name="";
		if  ($schedule_teacher_id>0) {
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
		 		//print_r($ar_fields);
			}
		}
        ?><?php
       //print_r($arItem);
       //if ($schedule_enddate == "")  { } else   {  $schedule_startdate .= "-<br />" . $schedule_enddate; }
       $arValueOfCourses[$ii]["sort"] = $cat_sort;
       $arValueOfCourses[$ii]["cat_name"] = $cat_name;
       $arValueOfCourses[$ii]["name"] = $arItem["title"];
       //echo  "прою".$arItem["NAME"];
       $arValueOfCourses[$ii]["startdate"] = strip_tags($schedule_startdate);
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
       if ($valuta=="Рубли") {
			$arValueOfCourses[$ii]["valuta"] ="p.";
		} else {
			$arValueOfCourses[$ii]["valuta"] ="грн.";
		}
?><? $ii=$ii+1; ?><?endforeach;?><?php  // дажее будем сортировать многомерный массив     по полю сортировку . таким образом отсортируем по категориям
function cmp($a, $b)
{
    if ($a["sort"] == $b["sort"]) {
        return 0;
    }
    return ($a["sort"] < $b["sort"]) ? -1 : 1;
}
usort($arValueOfCourses, "cmp");  // сортируем полученный массив по полю sort
//print_r($arValueOfCourses);
?><?='<?xml version="1.0" encoding="'.SITE_CHARSET.'"?>'?><rss version="2.0"><?
	$sortirovka=0;
	while (list($key, $value) = each($arValueOfCourses)) {
	$sortirovka_new=$value["sort"];
?>
	<item>
		<course_sort><?=$value["sort"]?></course_sort>
		<course_cat_title><?=$value["cat_name"]?></course_cat_title>
		<course_code><?=$value["course_code"]?></course_code>
		<course_teacher_active><?=$value["prepod_active"]?></course_teacher_active>
		<course_teacher_surname><?=$value["prepod_surname"]?></course_teacher_surname>
		<course_teacher_code><?=$value["prepod_code"]?></course_teacher_code>
		<course_teacher_name><?=$value["prepod_name"]?></course_teacher_name>
		<course_stardate><?=$value["startdate"]?></course_stardate>
		<course_duration><?=$value["duration"]?></course_duration>
		<course_price><?=$value["price"]?></course_price>
		<course_time><?=$value["time"]?></course_time>
		<course_valuta><?=$value["valuta"]?></course_valuta>
		<course_id><?=$value["course_id"]?></course_id>
		<course_name><?=$value["name"]?></course_name>
     </item>
<?
	$sortirovka = $sortirovka_new;
   }
?>
</rss>