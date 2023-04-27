<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
/*		$id_city=$APPLICATION->GetPageProperty("id_city");
        $arSelect = Array("PROPERTY_edu_type_money");
		$arFilter = Array("IBLOCK_ID"=>51,"ID"=>$id_city);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$valuta= $ar_fields["PROPERTY_EDU_TYPE_MONEY_VALUE"];
		}
*/
        ?>
<?
	$ii=0; // для массива куда мы будем ложить значения
	$arValueOfCourses = array();
 ?>
<?foreach($arResult["ITEMS"] as $arItem):?>
        <?
          //print_r($arItem);
          $prschedule_program_id =$arItem['ID'];
          $prschedule_program = $arItem['PROPERTIES']['prschedule_program']['VALUE'];
          $prschedule_city = $arItem['PROPERTIES']['city']['VALUE'];
          //echo "prschedule_city = $prschedule_city<br />";
          $prschedule_startdate = $arItem['PROPERTIES']['startdate']['VALUE'];
          $prschedule_enddate = $arItem['PROPERTIES']['enddate']['VALUE'];
          $prschedule_time = $arItem['PROPERTIES']['prschedule_time']['VALUE'];
          $prschedule_description = $arItem['PROPERTIES']['prschedule_desc']['VALUE']['TEXT'];
          $prschedule_price = $arItem['PROPERTIES']['prschedule_price']['VALUE'];
          $prschedule_duration = $arItem['PROPERTIES']['prschedule_duration']['VALUE'];
          $prschedule_courses = $arItem['PROPERTIES']['prschedule_courses']['~VALUE'];
          if ($prschedule_enddate == "")  { } else   {  $prschedule_startdate .= "-" . $prschedule_enddate; }
          ?>

		<?
		// получаем родительскую категорию - название школы и ее ID
		$nav = CIBlockSection::GetNavChain(49, $prschedule_program);
		while($ar_fields = $nav->GetNext())
		{
			if ($ar_fields["DEPTH_LEVEL"]==1){
				$idParent = $ar_fields["ID"];
				$nameParent = $ar_fields["NAME"];
			}
		}
		$arSelect = Array("PROPERTY_edu_type_money", "NAME");
        //$arSelect = Array("NAME");
		$arFilter = Array("IBLOCK_ID"=>51,"ID"=>$id_city);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$valuta= $ar_fields["PROPERTY_EDU_TYPE_MONEY_VALUE"];
	 		$city_name= $ar_fields["NAME"];
		}




		?>
          <?
		  $prschedule_courses = unserialize($prschedule_courses);

		    foreach ($prschedule_courses as $v1) {
   				foreach ($v1 as $key => $value) {
       				 if ($key==="VALUE" ){
       				 $rty[] = "$value";
       				 $id_value =$value;
       				 $rty[] = $value;
    				}
    				if ($key==="DURATION" ){
                     $duration = $value;
    				}
    				if ($key==="PRICE" ){
       				 $price =$value;
	   				}
	   				$rty2["$id_value"]["duration"] = $duration;
	   				$rty2["$id_value"]["price"] = $price;
    			}
			}
        ?>

<?php
       $arValueOfCourses[$ii]["name"] = $arItem["NAME"];
       $arValueOfCourses[$ii]["startdate"] = $prschedule_startdate;
       $arValueOfCourses[$ii]["time"] = $prschedule_time;
       $arValueOfCourses[$ii]["duration"] = $prschedule_duration;
       $arValueOfCourses[$ii]["price"] = $prschedule_price;
       $arValueOfCourses[$ii]["prschedule_program_id"] = $prschedule_program_id;
       $arValueOfCourses[$ii]["detail_page_url"] = $arItem["DETAIL_PAGE_URL"];
       $arValueOfCourses[$ii]["school_name"] = $nameParent;
       $arValueOfCourses[$ii]["school_id"] = $idParent;
       $arValueOfCourses[$ii]["valuta"] = $valuta;
       $arValueOfCourses[$ii]["city_name"] = $city_name;

?>
<? $ii=$ii+1; ?>
<?endforeach;?>



<?php  // далее будем сортировать многомерный массив     по полю сортировку . таким образом отсортируем по категориям
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
<? if ($ii>0) {?>
	<h2 style="" >Расписание ближайших занятий во  всех учебных центрах:</h2>
	<TABLE cellSpacing="0" cellPadding="5"    border="0" class="edu">
	<TR class="edu_header">
            <TD><P align="left">Школа</P></TD>
			<TD><P align="left">Название</P></TD>
	  		<!--<TD><P align="left">Время</P></TD>-->
			<TD><P align="left"><NOBR>Город</NOBR></P></TD>
			<TD><P align="left">Цена</P></TD>
			<TD><nobr><P align="left">Дата проведения <span style="text-align:right; font-size:18px;">&#8595;</span></P></nobr></TD>
		</TR>
	<?
		$sortirovka=0;
		while (list($key, $value) = each($arValueOfCourses)) {
		$sortirovka_new=$value["sort"];
	?>

	<TR  class="ewTableAltRow"  onmouseover='ew_mouseover(this);' onmouseout='ew_mouseout(this);'>
		<TD class=""><P align="left"><?=$value["school_name"]?></P></TD>
		<TD class="td_name"><P align="left"><A title="Подробнее о программе" href="/timetable/pp.html?ID=<?=$value[prschedule_program_id]?>"><?= $value["name"] ?></A></P></TD>
		<!--<TD class="td_time"><NOBR><?=$value["time"]?></NOBR></TD>-->
		<TD class="td_duration"><? if (strlen($value["price"])>0) {?><P align="left"><NOBR><?=$value["city_name"];?></NOBR></P><? } ?></TD>
		<TD class="td_price"><? if (strlen($value["price"])>0) {?><NOBR><?=$value["price"]?> <?if ($value["valuta"]=="Рубли") {?> р.<? }else{ ?> грн. <? } ?></NOBR><? } ?></TD>
		<TD class="td_date"><P align="left"><NOBR><?= $value["startdate"] ?></NOBR></P></TD>
	</TR>
	<?
		$sortirovka = $sortirovka_new;
	   }
	?>
	</TABLE>
<? } else {?>
	<h2 style="" >Программ подготовки в ближайшее время не запланировано</h2>
<? } ?>





