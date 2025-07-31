<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?


        ?>
<?
	$ii=0; // для массива куда мы будем ложить значения
	$arValueOfCourses = array();
	$parent_section_new=0;
 ?>
<?foreach($arResult["ITEMS"] as $arItem):?>
        <?

          $prschedule_program_id =$arItem['ID'];
          $prschedule_program = $arItem['PROPERTIES']['prschedule_program']['VALUE'];
          $prschedule_city_id = $arItem['PROPERTIES']['city']['VALUE'];
        $arSelect = Array("NAME");
		$arFilter = Array("IBLOCK_ID"=>51,"ID"=>$prschedule_city_id);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$prschedule_city_name= $ar_fields["NAME"];
		}
          //echo "prschedule_city = $prschedule_city<br />";
          $prschedule_startdate = $arItem['PROPERTIES']['startdate']['VALUE'];
          $prschedule_enddate = $arItem['PROPERTIES']['enddate']['VALUE'];
          $prschedule_time = $arItem['PROPERTIES']['prschedule_time']['VALUE'];
          $prschedule_description = $arItem['PROPERTIES']['prschedule_desc']['VALUE']['TEXT'];
          $prschedule_price = $arItem['PROPERTIES']['prschedule_price']['VALUE'];
          $prschedule_duration = $arItem['PROPERTIES']['prschedule_duration']['VALUE'];
          $prschedule_courses = $arItem['PROPERTIES']['prschedule_courses']['~VALUE'];
          $parent_section_id = $arItem['PROPERTIES']['parent_section_id']['VALUE'];
          $parent_section_name = $arItem['PROPERTIES']['parent_section_name']['VALUE'];

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
       $arValueOfCourses[$ii]["detail_page_url"] =$arItem["DETAIL_PAGE_URL"];
       $arValueOfCourses[$ii]["school_name"] =$nameParent;
       $arValueOfCourses[$ii]["school_id"] =$idParent;
       $arValueOfCourses[$ii]["city_name"] =$prschedule_city_name;

?>



 	<table  cellSpacing="0" cellPadding="5"   border="0" class="lux_table" width="100%">
		<TR class=""  valign="top">
			<TD class="lux_td_name"  width="100%" valign="top"><p><a title="Подробнее" href="http://ibs-training.ru/timetable/pp.html?ID=<?=$prschedule_program_id?>"><?= $arItem["NAME"] ?></a></p></TD>
			<TD class="lux_td_city" width="70" valign="top"><p class="nobr" style="white-space:nowrap;"><?=$prschedule_city_name ?>&nbsp;&nbsp;&nbsp;</P></TD>
			<TD class="lux_td_name" width="70" valign="top"><p class="nobr" style="white-space:nowrap;"><nobr><?=$prschedule_startdate ?></nobr></P></TD>

		</TR>
	<? $ii=$ii+1; ?>
 <? if ($ii>0){?>
 </TABLE>
 <? }?>

<?endforeach;?>

<? if ($ii==0){?><?}?>

