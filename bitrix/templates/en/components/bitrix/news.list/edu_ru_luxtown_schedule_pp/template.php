<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
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
	$parent_section_new=0;
 ?>
<?foreach($arResult["ITEMS"] as $arItem):?>
        <?

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
       $arValueOfCourses[$ii]["id_buy"] = $arItem["ID"];
       $arValueOfCourses[$ii]["startdate"] = $prschedule_startdate;
       $arValueOfCourses[$ii]["time"] = $prschedule_time;
       $arValueOfCourses[$ii]["duration"] = $prschedule_duration;
       $arValueOfCourses[$ii]["price"] = $prschedule_price;
       $arValueOfCourses[$ii]["prschedule_program_id"] = $prschedule_program_id;
       $arValueOfCourses[$ii]["detail_page_url"] =$arItem["DETAIL_PAGE_URL"];
       $arValueOfCourses[$ii]["school_name"] =$nameParent;
       $arValueOfCourses[$ii]["school_id"] =$idParent;
?>

<? if  ($parent_section_id<>$parent_section_new) {?>
    <? if ($ii>0){?></table><? }?>
    <h6 class="lux_catname"><?=$parent_section_name?></h6>
 	<table cellSpacing="0" cellPadding="5" border="0" class="lux_table">
		<TR class="lux_header">
			<TD>Название</TD>
			<TD>Дата</TD>
			<TD>Время</TD>
			<TD>Длит-ть</TD>

		</TR>
<? } ?>

		<TR class="lux_usual">
			<TD class="lux_td_name"><a target="_blank" href="http://ibs-training.ru/timetable/pp.html?ID=<?=$prschedule_program_id?>"><?= $arItem["NAME"] ?></a></TD>
			<TD class="lux_td_date"><?=$prschedule_startdate ?></TD>
			<TD class="lux_td_time"><?=$prschedule_time?>
<?if ($id_city == "14909"){?>
 <br />(время моск.)
<? } ?>
</p></TD>
			<TD class="lux_td_duration"><? if (strlen($prschedule_duration)>0) {?><?=$prschedule_duration;?> ч.<? } ?></TD>


		</TR>
	<? $ii=$ii+1; ?>
<? $parent_section_new = $parent_section_id ?>
<?endforeach;?>
<? if ($ii!==0){?></table><? } ?>
<? if ($ii==0){?><h4 class="lux_noclass">В ближайшее время проведение занятий в классах не запланировано</h4><? } ?>

