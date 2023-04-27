<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script type="text/javascript" src="/bitrix/templates/en/js_main_v5/player.js"></script>
<script type="text/javascript" src="/bitrix/js/additional/jquery.cluetip.js"></script>
<link rel="stylesheet" type="text/css" href="/bitrix/templates/en/template_styles_main_v5.css" />
<link rel="stylesheet" type="text/css" href="/bitrix/js/additional/jquery.cluetip.css" />

<div class="news-calendar">

	<?if($arParams["SHOW_CURRENT_DATE"]):?>
		<p align="right" class="NewsCalMonthNav"><b><?=$arResult["TITLE"]?></b></p>
	<?endif?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="NewsCalMonthNav" align="left">
				<?if($arResult["PREV_MONTH_URL"]):?>
					<a href="<?=$arResult["PREV_MONTH_URL"]?>" title="<?=$arResult["PREV_MONTH_URL_TITLE"]?>"><?=GetMessage("IBL_NEWS_CAL_PR_M")?></a>
				<?endif?>
				<?if($arResult["PREV_MONTH_URL"] && $arResult["NEXT_MONTH_URL"] && !$arParams["SHOW_MONTH_LIST"]):?>
					&nbsp;&nbsp;|&nbsp;&nbsp;
				<?endif?>
				<?if($arResult["SHOW_MONTH_LIST"]):?>
					&nbsp;&nbsp;
					<select onChange="b_result()" name="MONTH_SELECT" id="month_sel">
						<?foreach($arResult["SHOW_MONTH_LIST"] as $month => $arOption):?>
							<option value="<?=$arOption["VALUE"]?>" <?if($arResult["currentMonth"] == $month) echo "selected";?>><?=$arOption["DISPLAY"]?></option>
						<?endforeach?>
					</select>
					&nbsp;&nbsp;
					<script language="JavaScript" type="text/javascript">
					<!--
					function b_result()
					{
						var idx=document.getElementById("month_sel").selectedIndex;
						<?if($arParams["AJAX_ID"]):?>
							jsAjaxUtil.InsertDataToNode(document.getElementById("month_sel").options[idx].value, 'comp_<?echo $arParams['AJAX_ID']?>', <?echo $arParams["AJAX_OPTION_SHADOW"]=="Y"? "true": "false"?>);
						<?else:?>
							window.document.location.href=document.getElementById("month_sel").options[idx].value;
						<?endif?>
					}
					-->
					</script>
				<?endif?>
				<?if($arResult["NEXT_MONTH_URL"]):?>
					<a href="<?=$arResult["NEXT_MONTH_URL"]?>" title="<?=$arResult["NEXT_MONTH_URL_TITLE"]?>"><?=GetMessage("IBL_NEWS_CAL_N_M")?></a>
				<?endif?>
			</td>
			<?if($arParams["SHOW_YEAR"]):?>
			<td class="NewsCalMonthNav" align="right">
				<?if($arResult["PREV_YEAR_URL"]):?>
					<a href="<?=$arResult["PREV_YEAR_URL"]?>" title="<?=$arResult["PREV_YEAR_URL_TITLE"]?>"><?=GetMessage("IBL_NEWS_CAL_PR_Y")?></a>
				<?endif?>
				<?if($arResult["PREV_YEAR_URL"] && $arResult["NEXT_YEAR_URL"]):?>
					&nbsp;&nbsp;|&nbsp;&nbsp;
				<?endif?>
				<?if($arResult["NEXT_YEAR_URL"]):?>
					<a href="<?=$arResult["NEXT_YEAR_URL"]?>" title="<?=$arResult["NEXT_YEAR_URL_TITLE"]?>"><?=GetMessage("IBL_NEWS_CAL_N_Y")?></a>
				<?endif?>
			</td>
			<?endif?>
		</tr>
	</table>
	<br />
	<table width='100%' border='0' cellspacing='1' cellpadding='4' class='NewsCalTable'>
	<tr class="weekdays">
	<?foreach($arResult["WEEK_DAYS"] as $WDay):?>
		<td class='NewsCalHeader'><?=$WDay["SHORT"]?></td>
	<?endforeach?>
	</tr>
	<?foreach($arResult["MONTH"] as $arWeek):?>
	<?//print_r($arWeek);
	?>
	<tr>
		<?foreach($arWeek as $arDay):?>

		<td align="left" valign="top" class='<?=$arDay["td_class"]?>' width="14%">
            <div id="inline_content_<?=$arDay[tday_class]?>_<?=$arDay[day]?>" style="display:none";>
            <?$index = 0;?>
			<?foreach($arDay["events"] as $arEvent):?>
			<?$index = $index + 1;?>
			<?//print_r($arEvent);
			?>
<?
//получим значения наимнований по id
//
?>
<?
       //сначала  получим валюту города  // Рубли или Гривны
		$id_city = $arEvent["city_id"];
		$arSelect = Array("PROPERTY_edu_type_money","NAME");
		$arFilter = Array("IBLOCK_ID"=>51,"ID"=>$id_city);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$valuta = $ar_fields["PROPERTY_EDU_TYPE_MONEY_VALUE"];
	 		$city_name = $ar_fields["NAME"];
		}

		//теперь  получим цену курса и ее длительность по умолчанию
 		$arSelect = Array("PROPERTY_course_price", "PROPERTY_course_duration");
		$arFilter = Array("IBLOCK_ID"=>6,"ID"=>$arEvent["course_id"]);
		//print_r($arFilter);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$course_price= $ar_fields["PROPERTY_COURSE_PRICE_VALUE"];
	 		$course_duration= $ar_fields["PROPERTY_COURSE_DURATION_VALUE"];
		}
        if ($arEvent["price"] == "")
         { $arEvent["price"] =  $course_price;}      //исправить ВЕЗДЕ!!!!!!!!!!!!1
        if ($arEvent["duration"] == "")
          { $arEvent["duration"] =  $course_duration;  }


        if (strlen($arEvent["teacher_id"])>0){
			$arSelect = Array("NAME","PROPERTY_EXPERT_NAME", "PROPERTY_EXPERT_NAME", "DETAIL_PICTURE","PROPERTY_EXPERT_TITLE", "PROPERTY_EXPERT_SHORT");
			$arFilter = Array("IBLOCK_ID"=>56,"ID"=>$arEvent["teacher_id"]);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ar_fields = $res->GetNext())
			{
		 		$teacher_surname = $ar_fields["NAME"];
		 		$teacher_name = $ar_fields["PROPERTY_EXPERT_NAME_VALUE"];
		 		$teacher_title = $ar_fields["PROPERTY_EXPERT_TITLE_VALUE"];
		 		$teacher_short = $ar_fields["PROPERTY_EXPERT_SHORT_VALUE"];
                //print_r($ar_fields);
                //echo "teacher_short=$teacher_short";
                $ar_teacherphoto["DETAIL_PICTURE"] = CFile::GetFileArray($ar_fields["DETAIL_PICTURE"]);
                //print_r($ar_fields);
			}
        if ($ar_teacherphoto["DETAIL_PICTURE"]["WIDTH"]>150) {$ar_teacherphoto["DETAIL_PICTURE"]["WIDTH"] = 150;}
        }


        ?>
<?
?>
<?
/*    [time] =&gt;
    [url] =&gt; news_detail.php?ID=8588
    [title] =&gt; Oracle 10g, нас ...
    [preview] =&gt; Oracle 10g, настройка производительности SQL-выражений
    [DATE_ACTIVE_FROM] =&gt; 19.01.2009
    [city_id] =&gt; 5741
    [teacher_id] =&gt; 7698
    [schedule_course_id] =&gt; 6058
    [schedule_time] =&gt; 10:00-14:00
    [hot_checkbox] =&gt; Горящий курс
    [duration] =&gt; 24
    [price] =&gt; 16800
    [active_to] =&gt; 26.01.2009
    [active_from] =&gt; 19.01.2009
     course_id*/
?>
				<?if ($index>1) {echo ""; } ?>

				<div class="NewsCalNews" style="padding-top:5px;">
  					    <a href="/training/catalog/course.html?ID=<?=$arEvent[course_id]?>"><?=$arEvent["title"]?></a><br />
					    <span class="info">Место проведения:</span> <?=$city_name?><br />
					    <span class="info">Время:</span> <?=$arEvent["schedule_time"]?><br />
					    <span class="info">Цена:</span> <?=$arEvent["price"]?><?if ($valuta=="Рубли") {?> р.<? }else{ ?> грн. <? } ?>  <?if (strlen($arEvent["hot_checkbox"])>0) {?><span class="red">Горящий тренинг!!</span><? }?><br />
					    <span class="info">Продолжительность:</span> <?=$arEvent["duration"]?> ч.<br />
					    <span class="info">Окончание тренинга:</span><?if ($arEvent["active_to"]!== $arEvent["active_from"]) {?> <?=$arEvent["active_to"]?><br /><? } else { ?> в этот же день <br /><? } ?>
					    <!--<a href="/training/catalog/course.html?ID=<?=$arEvent[course_id]?>">Более подробная информация по курсу</a>-->
					    <?if (strlen($arEvent["teacher_id"])>0){?>
					    <img src="<?=$ar_teacherphoto[DETAIL_PICTURE][SRC] ?>" width="<?=$ar_teacherphoto[DETAIL_PICTURE][WIDTH]?>"  alt="" border="0" style="float:left; margin:5px 5px 5px 2px;" >
					    <span class="info">Тренер:</span> <?=$teacher_surname?> <?=$teacher_name?><br />
					    <span class="info">О тренере:</span> <?=$teacher_title?><br /> <?=$teacher_short?>
					    <div class="clear"></div>
					    <? } ?>
				</div>

			<?endforeach?>

			 </div>
            <?if ($index>0) {?>
			<span class="<?=$arDay["day_class"]?>"><a class="jt" href="#" title="<?=$arDay[day]?> <?=$arResult[TITLE]?>" rel="#inline_content_<?=$arDay[tday_class]?>_<?=$arDay[day]?>"><?=$arDay["day"]?></a></span>
			<? } else {?>
			<span class="<?=$arDay["day_class"]?>"><?=$arDay["day"]?></span>
			<? } ?>
		</td>
		<?endforeach?>
	</tr >
	<?endforeach?>
	</table>
</div>


<script type="text/javascript" >
$(document).ready(function() {


  $('a.jt').cluetip({

  	activation: 'click',
  	width: 300,
  	hideLocal:true,
    local: true,
    cluetipClass: 'jtip',
    arrows: true,
    dropShadow: false,
    sticky: true,
    mouseOutClose: true,
    closePosition: 'title',
    closeText: '<img src="cross.png" alt="Закрыть" />'
  });
// Rounded Corner theme
  $('ol.rounded a:eq(0)').cluetip({splitTitle: '|', dropShadow: false, cluetipClass: 'rounded', showtitle: false});
  $('ol.rounded a:eq(1)').cluetip({cluetipClass: 'rounded', dropShadow: false, showtitle: false, positionBy: 'mouse'});
  $('ol.rounded a:eq(2)').cluetip({cluetipClass: 'rounded', dropShadow: false, showtitle: false, positionBy: 'bottomTop', topOffset: 70});
  $('ol.rounded a:eq(3)').cluetip({cluetipClass: 'rounded', dropShadow: false, sticky: true, ajaxCache: false, arrows: true});
  $('ol.rounded a:eq(4)').cluetip({cluetipClass: 'rounded', dropShadow: false});
});

//unrelated to clueTip -- just for the demo page...

$(document).ready(function() {
  $('div.html, div.jquery').next().css('display', 'none').end().click(function() {
    $(this).next().toggle('fast');
  });

  $('a.false').click(function() {
    return false;
  });
});
</script>