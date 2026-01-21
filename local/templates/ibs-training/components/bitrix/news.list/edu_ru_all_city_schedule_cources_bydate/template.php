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
          if ($schedule_enddate == "")  { } else   {  $schedule_startdate .= "-<br />" . $schedule_enddate; }


		//теперь  получим цену курса и ее длительность по умолчанию
 		$arSelect = Array("PROPERTY_course_price", "PROPERTY_course_duration", "PROPERTY_course_idcategory", "PROPERTY_course_code");
		$arFilter = Array("IBLOCK_ID"=>6,"ID"=>$schedule_course_id);

		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$course_price= $ar_fields["PROPERTY_COURSE_PRICE_VALUE"];
	 		$course_duration= $ar_fields["PROPERTY_COURSE_DURATION_VALUE"];
	 		$course_id_category= $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
	 		$course_code= $ar_fields["PROPERTY_COURSE_CODE_VALUE"];
		}
        if ($course_price == "")
        { } else   { $schedule_price =  $course_price; }
        if ($course_duration == "")
        { } else   { $schedule_duration =  $course_duration;  }

       //теперь  получим имя категории и ее сортировку в категориях курсов ID =50
       /*
  		$arSelect = Array("NAME", "SORT");
		$arFilter = Array("IBLOCK_ID"=>50,"ID"=>$course_id_category);
		//print_r($arFilter);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$cat_name= $ar_fields["NAME"];
	 		$cat_sort= $ar_fields["SORT"];
		}
         */
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
		 		//print_r($ar_fields);
			}
		}
        ?>

<?php

       //$arValueOfCourses[$ii]["sort"] = $cat_sort;
       //$arValueOfCourses[$ii]["cat_name"] = $cat_name;
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
//usort($arValueOfCourses, "cmp");  // сортируем полученный массив по полю sort

//print_r($arValueOfCourses);
?>
<h2 style="position:absolute;" >Расписание ближайших курсов:</h2>
<div class="edu_sort"><p style="text-align:right; padding:0pt 0px 10px 0px; position:relative; top: 0px; left:0px;"> Cортировать по: Дате | <a class="" href="<?=$_SERVER["SCRIPT_NAME"]?>">Категории</a></p></div><div class="edu_empty"></div>

<TABLE cellSpacing="0" cellPadding="5"    border="0" class="edu">
<TR class="edu_header">
        <TD><nobr><P align="left">Дата<span style="text-align:right; font-size:18px;">&#8595;</span></P></nobr></TD>
        <TD ><P align="left">Код</P></TD>
		<TD ><P align="left">Название</P></TD>
  		<TD><P align="left">Время</P></TD>
		<TD><P align="left"><NOBR>Длит-ть</NOBR></P></TD>
		<TD><P align="left">Цена</P></TD>
	</TR>

<?
	$sortirovka=0;
	while (list($key, $value) = each($arValueOfCourses)) {
	$sortirovka_new=$value["sort"];
?>

<TR  class="ewTableAltRow"  onmouseover='ew_mouseover(this);' onmouseout='ew_mouseout(this);'>
	<TD class="td_date"><p class="nobr"><?= $value["startdate"] ?></p></TD>
	<TD class="td_code"><p class="nobr"><?= $value["course_code"] ?></p></TD>
	<TD class="td_name"><p><A href="/training/catalog/course.html?ID=<?=$value[course_id]?>"><?= $value["name"] ?></A><? if (strlen($value["prepod_surname"])>0) {?><br />тренер: <a href="/about/experts/<?=$value['prepod_code']?>.html"><?=$value["prepod_surname"];?> <?=$value["prepod_name"];?></a><? } ?></p></TD>
	<TD class="td_time"><p class="nobr"><?=$value["time"]?></p></TD>
	<TD class="td_duration"><p class="nobr"><p><?=$value["duration"];?> час.</p></TD>
	<TD class="td_price"><p class="nobr"><?=$value["price"]?> <?if ($valuta=="Рубли") {?> р.<? }else{ ?> грн. <? } ?></p></TD>
</TR>
<?
	$sortirovka = $sortirovka_new;
   }
?>
</TABLE>




