<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script>
$(document).ready(function() {
	var randInt;
	$("a.tobasket").click(function(){
		$(this).fadeOut("fast");
		$(this).fadeIn("fast");
		var id_record = $(this).attr("id_basket");
		$.getJSON('/ajax/add_school_to_basket.php?action=ADD2BASKET&id='+id_record+'&quantity=1',function(data){
		});
		randInt = Math.floor(Math.random()*100000);
		$(".basketSmall").fadeOut("slow");
	   	$(".basketSmall").load("/ajax/show_basket.php?rand='+randInt+'",{limit: 25});
	   	$(".basketSmall").fadeIn("slow");
	   	return false;
	});
});
</script>
<?
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
	$parent_section_new="3432";
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
    <? if ($ii>0){?></TABLE><? }?>
    <h2><?=$parent_section_name?></h2>
 	<table cellSpacing="0" cellPadding="5" border="0" class="edu">
		<TR class="edu_header">
			<TD width="100%"><P align="left">Название</P></TD>
			<TD width="70"><p class="nobr">Дата<!-- <span style="text-align:right; font-size:18px;">&#8595;</span>--></p></TD>
			<TD width="170"><P align="left">Время</P></TD>
			<TD width="70"><p class="nobr">Длит-ть</p></TD>
			<TD width="70"><? if ($arParams['SHOW_PRICE'] !== "N"){?><p class="nobr">Цена</p><? } ?></TD>
<TD width="70"><p class="nobr">&nbsp;</p></TD>
		</TR>
<? } ?>

		<TR  class="ewTableAltRow"  onmouseover='ew_mouseover(this);' onmouseout='ew_mouseout(this);'>
			<TD class="td_name"><p><a title="Перейти на страницу с подробным описанием класса" href="/timetable/pp.html?ID=<?=$prschedule_program_id?>"><?= $arItem["NAME"] ?></a></p></TD>
			<TD class="td_date"><p class="nobr"><?=$prschedule_startdate ?></P></TD>
			<TD class="td_time"><p class="nobr"><?=$prschedule_time?>
<?if ($id_city == "14909"){?>
 <br />(время моск.)
<? } ?>
</p></TD>
			<TD class="td_duration"><? if (strlen($prschedule_duration)>0) {?><p class="nobr"><?=$prschedule_duration;?> ч.</p><? } ?></TD>
			<TD class="td_price">
							<? if ($arParams['SHOW_PRICE'] !== "N"){?>
			<p class="nobr"><? if (strlen($prschedule_price)>0) {?><?=number_format($prschedule_price, 0, '', ' ');?> <?if ($valuta=="Рубли") {?> р.<? }else{ ?> грн. <? } ?><? } ?></p>
							<? } ?>
			</TD>
			<TD class="td_pay">
							<? if ($arParams['SHOW_PRICE'] !== "N"){?>
				<p style="text-align:center;"><a class="tobasket" rel="nofollow" title="Запомнить и положить в корзину услуг" id_basket="<?=$prschedule_program_id?>" href="#"><img src="/images_edu/diffs/basket_put.png" style="float:none;" width="32" height="32" alt="Запомнить и положить в корзину услуг" border="0"></a> <br />  </p>
				           <? } ?>
				</TD>

		</TR>
	<? $ii=$ii+1; ?>
<? $parent_section_new = $parent_section_id ?>
<?endforeach;?>
</table>
<? if ($ii==0){?><?}?>

