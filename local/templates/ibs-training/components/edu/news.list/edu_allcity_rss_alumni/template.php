<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	$ii=0; // для массива куда мы будем ложить значения
	$arValueOfCourses = array();
 ?><?foreach($arResult["ITEMS"] as $arItem):?><?
 //iwrite($arItem['PROPERTIES']);
          $schedule_course_id = $arItem['PROPERTIES']['schedule_course']['VALUE'];
          $id_city = $arItem['PROPERTIES']['city']['VALUE'];
          $schedule_startdate = $arItem['PROPERTIES']['startdate']['VALUE'];
          $schedule_enddate = $arItem['PROPERTIES']['enddate']['VALUE'];
          $schedule_time = $arItem['PROPERTIES']['schedule_time']['VALUE'];
          $schedule_description = $arItem['PROPERTIES']['schedule_description']['VALUE']['TEXT'];
          $schedule_price = $arItem['PROPERTIES']['schedule_price']['VALUE'];
          $schedule_duration = $arItem['PROPERTIES']['schedule_duration']['VALUE'];


		$dateArray = explode('.', $schedule_startdate);
		//print_r($dateArray);
		//$schedule_startdate =  date('j F', mktime(0, 0, 0, $dateArray[1], $dateArray[0], $dateArray[2]));


 		//if ($schedule_enddate == "")  { } else   {  $schedule_startdate .= "-" . $schedule_enddate; }
		//теперь  получим цену курса и ее длительность по умолчанию
 		$arSelect = Array("PROPERTY_course_price", "PROPERTY_course_duration", "PROPERTY_course_idcategory", "CODE");
		$arFilter = Array("IBLOCK_ID"=>6,"ID"=>$schedule_course_id);

		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$course_price= $ar_fields["PROPERTY_COURSE_PRICE_VALUE"];
	 		$course_code = $ar_fields["CODE"];
	 		$course_duration= $ar_fields["PROPERTY_COURSE_DURATION_VALUE"];
	 		$course_id_category= $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
		}
        if ($course_price == "")
        { } else   { $schedule_price =  $course_price; }
        if ($course_duration == "")
        { } else   { $schedule_duration =  $course_duration;  }

        $arSelect = Array("PROPERTY_edu_type_money", "NAME");
		$arFilter = Array("IBLOCK_ID"=>51,"ID"=>$id_city);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$valuta= $ar_fields["PROPERTY_EDU_TYPE_MONEY_VALUE"];
	 		$city_name= $ar_fields["NAME"];
		}
        ?><?php
        //$schedule_startdate =str_replace(".2009","", $schedule_startdate);
        //$schedule_startdate =str_replace(".2010","", $schedule_startdate);
         //$schedule_startdate =str_replace(" ","&nbsp;", $schedule_startdate);
         $schedule_duration =str_replace(" ","&nbsp;", $schedule_duration);
       $arValueOfCourses[$ii]["name"] = $arItem["~NAME"];
       $arValueOfCourses[$ii]["startdate"] = $schedule_startdate;
       $arValueOfCourses[$ii]["time"] = $schedule_time;
       $arValueOfCourses[$ii]["duration"] = $schedule_duration;
       $arValueOfCourses[$ii]["price"] = $schedule_price;
       $arValueOfCourses[$ii]["course_id"] = $schedule_course_id;
       $arValueOfCourses[$ii]["cat_id"] = $course_id_category;
       $arValueOfCourses[$ii]["detail_page_url"] =$arItem["DETAIL_PAGE_URL"];
       $arValueOfCourses[$ii]["city_name"] = $city_name;
       $arValueOfCourses[$ii]["valuta"] = $valuta;
       $arValueOfCourses[$ii]["ID"] =  $arItem['ID'];
       $arValueOfCourses[$ii]["course_code"] =  $course_code; 
?><? $ii=$ii+1; ?><?endforeach;?>
<?php
function cmp($a, $b)
{
    if ($a["sort"] == $b["sort"]) {
        return 0;
    }
    return ($a["sort"] < $b["sort"]) ? -1 : 1;
}
?><table cellspacing="2" cellpadding="2" border="0" width="100%" style="margin: 0px; padding: 0px; color: rgb(28, 84, 141); font-family: Arial,Helvetica,sans-serif;">
<?
	$sortirovka=0;
	$tempCity = "";
	$tempDate = "";
	while (list($key, $value) = each($arValueOfCourses)) {
	$sortirovka_new=$value["sort"];
    if ($tempCity !== $value["city_name"]){
    	$tempDate = "";
    }
?>
<tr valign=top style="margin: 2px 0px 2px 0px;">
	<td valign=top class="lux_td_city" align="right"><? if ($tempCity !== $value["city_name"]) {?><span style="color:#333333; line-height:90%; font-weight: bold; display: block; font-size: 14px; padding: 0px 5px 0px 0px;" class="client"><?=$value["city_name"]?>&nbsp;&nbsp;</span><? } ?></td>
	<td valign=top class="lux_td_name" style="margin: 2px 0px 2px 0px; min-height:12px; padding:0px 0px 7px 0px">

		<a style="margin: 3px 0px 9px 0px; line-height:140%; font-size: 13px; color: rgb(28, 84, 141); font-family: Arial,Helvetica,sans-serif;" href="http://ibs-training.ru/training/catalog/course.html?ID=<?=$value["course_id"];?>&ID_TIME=<?=$value["ID"];?>"><?= $value["name"] ?></a>

	

	</td>
	<td width="72" valign=top class="lux_td_name"><span style="font-weight: normal; display: block; font-size: 14px; padding: 0px 2px;"><?= $value["startdate"] ?></span></td>

	<td width="55" valign=top class="lux_td_duration" align="right"><span style="font-weight: normal; display: block; font-size: 14px; padding: 0px 2px;">&nbsp;&nbsp;&nbsp;&nbsp;<?=$value["duration"];?>&nbsp;час.</span></td>

</tr>
<?
	$sortirovka = $sortirovka_new;
	$tempCity = $value["city_name"];
	$tempDate = $value["startdate"];
   }
?>

</table>




