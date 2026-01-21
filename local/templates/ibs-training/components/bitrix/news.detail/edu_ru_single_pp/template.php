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
<style type="text/css">
 blockquote {
	margin:0 0 0 0px;
}
h2 {
padding:10px 0 5px;
}
blockquote ul {
	list-style-image:none;
	list-style-position:outside;
	list-style-type:none;
	margin:0 0 10px 20px;
}
#content #one_list ul {
	list-style-image:url(/bitrix/templates/.default/en/images/list_index_bigger_no_up.gif);
	list-style-position:outside;
	list-style-type:circle;
	margin:0 0 0px 20px;
}
#content #one_list  ul li {
	margin:0 0 3px 20px;
}

#content #one_list blockquote ul {
	list-style-image:none;
	list-style-position:outside;
	list-style-type:none;
	margin:0 0 0px 20px;
	padding:0 0 0px 0px;
}
#content #one_list blockquote {
	margin:5px 0 0;
}
table.edu {
margin:0px 0px 15px 0px!important;
}
</style>

<?
          $prschedule_program_id = $arResult['ID'];
          $prschedule_program = $arResult['PROPERTIES']['prschedule_program']['VALUE'];
		  global  $arEventInfo ;
				$ar_result=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"76", "ID"=>$prschedule_program),
				 false,Array("DESCRIPTION", "NAME","CODE", "UF_PP_PURPOSE_NEW" ));
				if($razdel=$ar_result->GetNext()){
					$arSectionLevel[$ID_SECTION]["PURPOSE"] = $razdel["~UF_PP_PURPOSE_NEW"];
					$arSectionLevel[$ID_SECTION]["PRICE"] = $razdel["UF_CAT_PRICE"];
					$arSectionLevel[$ID_SECTION]["DURATION"] = $razdel["UF_CAT_DURATION"];
				}

          $prschedule_city = $arResult['PROPERTIES']['city']['VALUE'];
          $prschedule_startdate = $arResult['PROPERTIES']['startdate']['VALUE'];
          $prschedule_startdate_true= $prschedule_startdate;
          $prschedule_enddate = $arResult['PROPERTIES']['enddate']['VALUE'];
          $prschedule_time = $arResult['PROPERTIES']['prschedule_time']['VALUE'];
          $prschedule_description = $arResult['PROPERTIES']['prschedule_desc']['VALUE']['TEXT'];
          $prschedule_price = $arResult['PROPERTIES']['prschedule_price']['VALUE'];
          $prschedule_duration = $arResult['PROPERTIES']['prschedule_duration']['VALUE'];
          $parent_section_name = $arResult['PROPERTIES']['parent_section_name']['VALUE'];
          $prschedule_courses = $arResult['PROPERTIES']['prschedule_courses']['~VALUE'];
//iwrite($arResult['PROPERTIES']['prschedule_courses']['~VALUE']);
          if ($prschedule_enddate == "")  { } else   {  $prschedule_startdate .= " - " . $prschedule_enddate; }


        $id_city = $prschedule_city;
        $arSelect = Array("PROPERTY_edu_type_money", "NAME");
		$arFilter = Array("IBLOCK_ID"=>51,"ID"=>$id_city);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$valuta= $ar_fields["PROPERTY_EDU_TYPE_MONEY_VALUE"];
	 		$prschedule_city = $ar_fields["NAME"];
		}

		  $prschedule_courses = unserialize($prschedule_courses);
//iwrite($prschedule_courses);
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
	   				$arProgramsInfo["$id_value"]["duration"] = $duration;
	   				$arProgramsInfo["$id_value"]["price"] = $price;
    			}
			}

?>
<div class="r w200">
		<div class="buble_body">
				<p>
				<?if (strlen($prschedule_city)>0){?>
				<?if ($prschedule_city !== "Онлайн"){?> <span class="st">Город:</span><? } ?>
				 <span id="event_city_name"><?=$prschedule_city?></span>
				<br />
				<? } ?>
						<?if (strlen($prschedule_startdate)>0){?><span class="st" >Дата проведения: </span><?=$prschedule_startdate?><br /><span id="from_event_date" style="display:none"><?=$prschedule_startdate_true?></span> <? } ?>
						<?if (strlen($prschedule_duration)>0){?><span class="st">Длительность класса: </span> <?=$prschedule_duration?> ч.<br /><? } ?>
						<?if (strlen($prschedule_price)>0){?><span class="st">Стоимость участия в классе:</span> <?=$prschedule_price?> <?if ($valuta=="Рубли") {?> р.<? }else{ ?> грн. <? } ?><? } ?>
				    </p>
				<a name="pay"></a>
					<a class="orange links" href="#fill_form" title="Забронировать место в классе или подать предварительную заявку."><!--Оплатить по Договору-->Регистрация</a><br />
				<a class="orange links"  title="Перейти к оплате класса. Оплата происходит путем онлайн платежей или по квитанции для частных лиц и выставления счета для юридических лиц"  href="/services/buy_class.html?action=BUY&id=<?=$arResult['ID']?>">Перейти к оплате</a>
				<p class="tocenter">
				<a class="tobasket" rel="nofollow" title="Запомнить и положить в корзину услуг" id_basket="<?=$arResult['ID']?>" href="#"><img src="/images_edu/diffs/basket_put.png" width="32" height="32" alt="Запомнить и положить в корзину услуг" border="0"></a> <br />
				</p>
		</div>

		<br />

		<div class="buble_body">
			<h2>Оставить  заявку</h2>
			<p>на участие в классе с открытой датой в филиалах:</p>
			<ul>
			<?
				$arResult["arCityInfo"] = GetAllActiveCitiesInfo();
				foreach ($arResult["arCityInfo"] as $arSingleCity){	?>
		          <li><a href="/training/catalog/code/<?=$razdel['CODE']?>/?IN_CITY=<?=$arSingleCity['ID']?>#reg"><?=$arSingleCity['NAME']?></a></li>
			<? } ?>
			</ul>
		</div>
</div>



<div class="l w500">
<h2>Информация о классе:</h2>
 <div id="one_list">
	<?if (strlen($razdel["~UF_PP_PURPOSE_NEW"])>0){?>
		<p><?=nl2br($razdel["~UF_PP_PURPOSE_NEW"])?><br /></p>
	<? } ?>

	<?if (strlen($arResult['PROPERTIES']['prschedule_desc']['VALUE'])>0){?>
		<p><?=nl2br($arResult['PROPERTIES']['prschedule_desc']['VALUE'])?><br /></p>
	<? } ?>

<!--<span class="links"><a href="/training/catalog/code/<?=$razdel["CODE"]?>/">Подробнее о классе</a></span><br />-->
	<span id="section_name" style="display:none;"><?=$parent_section_name?></span>
  </div>

<br />
	<TABLE cellSpacing="0" cellPadding="5" border="0" class="edu">
	<h2>Состав класса:</h2>
	<TR class="edu_header">
 		<TD width="100%"><P>Код и название курса</P></TD>
			<TD><nobr><P align="">Дата <span style="text-align:right; font-size:18px;">&#8595;</span></P></nobr></TD>
			<TD><P>Время</P></TD>
			<TD><P>Длит.</P></TD>
			<!--<TD><P>Цена</P></TD>-->
		</TR>
	<?
			    foreach ($arProgramsInfo as $key => $arValue) {
                //echo "key=$key<br />";
		        $arGroupBy  = Array();
		      	$arSelectFields = Array("ID", "NAME", "PROPERTY_TEACHER", "PROPERTY_COURSE_CODE", "PROPERTY_SCHEDULE_COURSE", "PROPERTY_SCHEDULE_COURSE.NAME", "PROPERTY_SCHEDULE_COURSE.CODE", "PROPERTY_STARTDATE", "PROPERTY_ENDDATE", "PROPERTY_SCHEDULE_TIME");
				$arFilter = Array("IBLOCK_ID"=>9, "ACTIVE"=>"Y", "ID" => $key);
				$arOrder = Array("PROPERTY_STARTDATE" => "ASC");
				$res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelectFields);
				$index = 0;
				while($ob = $res->GetNextElement())
				{
				  $schedule_teacher_id ="";
				  $arFields = $ob->GetFields();
//iwrite($arFields);
				  $pp_id = $key;
				  $pp_name =  $arFields["PROPERTY_SCHEDULE_COURSE_NAME"];
				  $schedule_teacher_id =  $arFields["PROPERTY_TEACHER_VALUE"];
				  $pp_startdate =  $arFields["PROPERTY_STARTDATE_VALUE"];
				  $pp_enddate =  $arFields["PROPERTY_ENDDATE_VALUE"];
				  $pp_duration =  $arProgramsInfo["$key"]["duration"];
				  $pp_price =  $arProgramsInfo["$key"]["price"];
				  $pp_course_id =  $arFields["PROPERTY_SCHEDULE_COURSE_VALUE"];
				  $pp_course_code =  $arFields["PROPERTY_SCHEDULE_COURSE_CODE"];
				  if ($pp_course_code==""){
				  $pp_course_code =  $arFields["PROPERTY_SCHEDULE_COURSE_CODE"];
				  }
				  $pp_time =  $arFields["PROPERTY_SCHEDULE_TIME_VALUE"];
				  //$pp_time = str_replace("-","-<br />",$pp_time);
				  if (strlen($pp_enddate)>0){ $pp_startdate .= "- ".$pp_enddate;}
				if  ($schedule_teacher_id>0) {
			  		//echo $schedule_teacher_id;
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
				?>
	<TR  class="ewTableAltRow"  onmouseover='ew_mouseover(this);' onmouseout='ew_mouseout(this);'>

		<TD><p><a href="/training/catalog/course.html?ID=<?=$pp_course_id?>"><?=$pp_course_code?> <?=$pp_name?></a>
	<? if (strlen($schedule_teacher_id)>0)  {?><br />тренер:
		<? if ($prepod_active=="Y") {?>
		<a class="blue" href="/about/experts/<?=$prepod_code?>.html"><?=$prepod_surname?>
		<?=$prepod_name?></a>
		<? } else { ?>
        	<?=$prepod_surname?>  <?=$prepod_name?>
		<? } ?>
	<? } ?>
</p></TD>

		<TD><p class="nobr"><?=$pp_startdate?></p></TD>
		<TD><p class="nobr"><?=$pp_time?>
<?if ($id_city == "14909"){?>
 <br />(время моск.)
<? } ?>
</p></TD>
		<TD><p class="nobr"><?=$pp_duration?> ч.</p></TD>
		<!--<TD><p class="nobr"><?=$pp_price?><?if ($valuta=="Рубли") {?> р.<? }else{ ?> грн. <? } ?></p></TD>-->
	</TR>

				<?}
				}
	?>


	</TABLE>
<?
	$arEventInfo["NAME"] = $arResult["NAME"];
	$arEventInfo["CODE"] = "";
	$arEventInfo["DATE"] = $prschedule_startdate_true;
	$arEventInfo["TYPE_ID"] = 79;
	$arEventInfo["EVENT_CITY"] = $prschedule_city;
/*
	78 - Курсы
	79 - Школы
	80 - Семинары
	81 - Круглые столы
	82 - Конференции
*/
?>
</div>

<div class="clear"></div>