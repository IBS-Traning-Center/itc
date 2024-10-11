<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	$ii = 0; // для массива куда мы будем ложить значения
	$arValueOfCourses = array();
?>
<?foreach($arResult["ITEMS"] as $arItem):?><?

//iwrite($arItem);
		$schedule_course_id = $arItem['PROPERTIES']['schedule_course']['VALUE'];
		$id_city = $arItem['PROPERTIES']['city']['VALUE'];
		$schedule_startdate = $arItem['PROPERTIES']['startdate']['VALUE'];
		$schedule_enddate = $arItem['PROPERTIES']['enddate']['VALUE'];
		$schedule_time = $arItem['PROPERTIES']['schedule_time']['VALUE'];
		$schedule_description = $arItem['PROPERTIES']['schedule_description']['VALUE']['TEXT'];
		$schedule_price = $arItem['PROPERTIES']['schedule_price']['VALUE'];
		$schedule_duration = $arItem['PROPERTIES']['schedule_duration']['VALUE'];
		$dateArray = explode('.', $schedule_startdate);
		$schedule_startdate =  date('j F', mktime(0, 0, 0, $dateArray[1], $dateArray[0], $dateArray[2]));
 		//if ($schedule_enddate == "")  { } else   {  $schedule_startdate .= "-" . $schedule_enddate; }
		//теперь  получим цену курса и ее длительность по умолчанию
 		$arSelect = Array("PROPERTY_course_price", "PROPERTY_course_duration","PROPERTY_IS_CLASS", "PROPERTY_course_idcategory", "CODE","PROPERTY_ID_COURSE_OWNER");
		$arFilter = Array("IBLOCK_ID"=>6,"ID"=>$schedule_course_id);

		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$course_price= $ar_fields["PROPERTY_COURSE_PRICE_VALUE"];
	 		$course_code = $ar_fields["CODE"];
	 		$course_duration= $ar_fields["PROPERTY_COURSE_DURATION_VALUE"];
	 		$course_id_category= $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
	 		$courseOwnerID = $ar_fields["PROPERTY_ID_COURSE_OWNER_ENUM_ID"];
	 		$bIs_Class = $ar_fields["PROPERTY_IS_CLASS_ENUM_ID"] === "135" ? true : false;


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
		$schedule_startdate = str_replace(".2009","", $schedule_startdate);
		$schedule_startdate = str_replace(".2010","", $schedule_startdate);
		$schedule_startdate = str_replace(".2011","", $schedule_startdate);
		$schedule_startdate = str_replace(" ","&nbsp;", $schedule_startdate);
		$schedule_duration  = str_replace(" ","&nbsp;", $schedule_duration);
		if ($arParams["ONLY_PARTNER_COURSE"] === "Y"){
			$arOwnerID[0] = 122; 
		}
		if ($arParams["ONLY_OWN_COURSE"] === "Y"){
			$arOwnerID[0] = 120; $arOwnerID[1] = 121; $arOwnerID[3] = 123;
		}
		if (count($arOwnerID) == 0){
			$arOwnerID[0] = 120; $arOwnerID[1] = 121; $arOwnerID[3] = 123;
		}
		if (($courseOwnerID == $arOwnerID[0] ) or ($courseOwnerID == $arOwnerID[1] )){
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
				$arValueOfCourses[$ii]["courseOwnerID"] = $courseOwnerID;
				$arValueOfCourses[$ii]["ID"] =  $arItem['ID'];
				$arValueOfCourses[$ii]["course_code"] =  $course_code;
				$arValueOfCourses[$ii]["bIs_Class"] =  false; 
if ($arParams["CHECK_IS_CLASS"] === "Y"){
				$arValueOfCourses[$ii]["bIs_Class"] =  $bIs_Class; 
} 
				$ii=$ii+1; 
			}
			
endforeach;
iwrite($arValueOfCourses);
?>
<?php
function cmp($a, $b)
{
    if ($a["sort"] == $b["sort"]) {
        return 0;
    }
    return ($a["sort"] < $b["sort"]) ? -1 : 1;
}
?>
<?if (count($arValueOfCourses)>0){?>
	<table cellSpacing="0" cellPadding="5"    border="0" class="lux_table" width="100%">
	<?
		$sortirovka=0;
		$tempCity = "";
		$tempDate = "";
		while (list($key, $value) = each($arValueOfCourses)) {
			$sortirovka_new=$value["sort"];
			if ($tempCity !== $value["city_name"])
				$tempDate = "";
			?>
<?if (!$value["bIs_Class"]){?>
				<tr valign=top>
					<td valign=top class="lux_td_city" width="135"><? if ($tempCity !== $value["city_name"]) {?><strong><?=$value["city_name"]?></strong><? } ?></td>
					<td valign=top class="lux_td_name">
						<a href="http://ibs-training.ru/internal/catalog/<?=$value["course_code"];?>/"><?= $value["name"] ?></a>
					</td>
					<td valign=top class="lux_td_name"><?=$value["startdate"];?></td>
					<td valign=top class="lux_td_duration"><?=$value["duration"];?>&nbsp;час.</td>
				</tr>

			<? 
			$sortirovka = $sortirovka_new;
			$tempCity = $value["city_name"];
			$tempDate = $value["startdate"];
			?>
<? } ?>
		<? }	?>
	</table>
<? } ?>