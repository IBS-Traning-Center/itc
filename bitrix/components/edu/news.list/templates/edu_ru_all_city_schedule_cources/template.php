<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
       //сначала  получим валюту города  // Рубли или Гривны
		$id_city=$APPLICATION->GetPageProperty("id_city");
            $arSelect = Array("PROPERTY_edu_type_money");
		$arFilter = Array("IBLOCK_ID"=>51,"ID"=>$id_city);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$valuta= $ar_fields["PROPERTY_EDU_TYPE_MONEY_VALUE"];
		}
        ?>

<?
	$ii=0; // для массива куда мы будем ложить значения
	$arValueOfCourses = array();
 ?>
<?foreach($arResult["ITEMS"] as $arItem):?>
        <?
          $schedule_course_id = $arItem['PROPERTIES']['schedule_course']['VALUE'];
          $schedule_city = $arItem['PROPERTIES']['schedule_city']['VALUE'];
          $schedule_startdate = $arItem['PROPERTIES']['startdate']['VALUE'];
          $schedule_enddate = $arItem['PROPERTIES']['enddate']['VALUE'];
          $schedule_time = $arItem['PROPERTIES']['schedule_time']['VALUE'];
          $schedule_description = $arItem['PROPERTIES']['schedule_description']['VALUE']['TEXT'];
          $schedule_price = $arItem['PROPERTIES']['schedule_price']['VALUE'];
          $schedule_duration = $arItem['PROPERTIES']['schedule_duration']['VALUE'];
          if ($schedule_enddate == "")  { } else   {  $schedule_startdate .= "-" . $schedule_enddate; }


		//теперь  получим цену курса и ее длительность по умолчанию
 		$arSelect = Array("PROPERTY_course_price", "PROPERTY_course_duration", "PROPERTY_course_idcategory");
		$arFilter = Array("IBLOCK_ID"=>6,"ID"=>$schedule_course_id);
		//print_r($arFilter);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$course_price= $ar_fields["PROPERTY_COURSE_PRICE_VALUE"];
	 		$course_duration= $ar_fields["PROPERTY_COURSE_DURATION_VALUE"];
	 		$course_id_category= $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
		}
        if ($course_price == "")
        { } else   { $schedule_price =  $course_price; }
        if ($course_duration == "")
        { } else   { $schedule_duration =  $course_duration;  }

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

        ?>

<?php

       $arValueOfCourses[$ii]["sort"] = $cat_sort;
       $arValueOfCourses[$ii]["cat_name"] = $cat_name;
       $arValueOfCourses[$ii]["name"] = $arItem["NAME"];
       $arValueOfCourses[$ii]["startdate"] = $schedule_startdate;
       $arValueOfCourses[$ii]["time"] = $schedule_time;
       $arValueOfCourses[$ii]["duration"] = $schedule_duration;
       $arValueOfCourses[$ii]["price"] = $schedule_price;
       $arValueOfCourses[$ii]["course_id"] = $schedule_course_id;
       $arValueOfCourses[$ii]["cat_id"] = $course_id_category;
       $arValueOfCourses[$ii]["detail_page_url"] =$arItem["DETAIL_PAGE_URL"];

?>
<? $ii=$ii+1; ?>
<?endforeach;?>


<?php  // дажее будем сортировать многомерный массив     по полю сортировку . таким образом отсортируем по категориям
function cmp($a, $b)
{
    if ($a["sort"] == $b["sort"]) {
        return 0;
    }
    return ($a["sort"] < $b["sort"]) ? -1 : 1;
}
usort($arValueOfCourses, "cmp");  // сортируем полученный массив по полю sort

//print_r($arValueOfCourses);
?>
<h2 style="position:absolute;">Расписание ближайших курсов:</h2>
<div class="edu_sort"><p style="text-align:right; padding:0pt 0px 10px 0px; position:relative; top: 0px; left:0px;">Cортировать по: <a class="" href="<? echo $_SERVER["SCRIPT_NAME"]."?by_date=Y"; ?>">Дате</a> | Категории</p></div><div class="edu_empty"></div>

<TABLE cellSpacing="0" cellPadding="5"    border="0" class="edu">
<?
	$sortirovka=0;
	while (list($key, $value) = each($arValueOfCourses)) {
	$sortirovka_new=$value["sort"];
?>
<? if ($sortirovka <> $sortirovka_new) {?>
<TR class="edu_header">
<TD colSpan=5>
<h3><?= $value["cat_name"] ?></h3></TD></TR>
<? } ?>
<TR  class="ewTableAltRow"  onmouseover='ew_mouseover(this);' onmouseout='ew_mouseout(this);'>
	<TD class="td_name"><P align="left"><A href="/edu/catalog/course.html?ID=<?=$value[course_id]?>"><?= $value["name"] ?></A></P></TD>
	<TD class="td_date"><P align="left"><NOBR><?= $value["startdate"] ?></NOBR></P></TD>
	<TD class="td_time"><NOBR><?=$value["time"]?></NOBR></TD>
	<TD class="td_duration"><P align="left"><NOBR><?=$value["duration"];?> час.</NOBR></P></TD>
	<TD class="td_price"><NOBR><?=$value["price"]?> <?if ($valuta=="Рубли") {?> р.<? }else{ ?> грн. <? } ?></NOBR></TD>
</TR>
<?
	$sortirovka = $sortirovka_new;
   }
?>
</TABLE>




