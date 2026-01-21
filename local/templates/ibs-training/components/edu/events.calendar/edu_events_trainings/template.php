<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?      $name_month ="";
		switch ($arResult["currentMonth"]) {
		    case "1":
		        $name_month="январе";
		        break;
		    case "2":
		        $name_month="феврале";
		        break;
		    case "3":
		        $name_month="марте";
		        break;
		    case "4":
		         $name_month="апреле";
		        break;
		    case "5":
		         $name_month="мае";
		        break;
		    case "6":
		         $name_month="июне";
		        break;
		    case "7":
		         $name_month="июле";
		        break;
		    case "8":
		         $name_month="августе";
		        break;
		    case "9":
		         $name_month="сентябре";
		        break;
		    case "10":
		         $name_month="октябре";
		        break;
		    case "11":
		         $name_month="ноябре";
		        break;
		    case "12":
		         $name_month="декабре";
		        break;
		}
//print_r($arResult);
?>
<div id="training" class="on_blue">
<div class="news-calendar lfloat" id="calendar">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="NewsCalMonthNav" align="left">
				<table border="0" width="100%"  cellspacing="0" cellpadding="5">
					<tr>
						<td width="10%" height=30>
							<?if($arResult["PREV_MONTH_URL"]):?>
							<a  style="font-size:22px; color:#C85711;margin-bottom:22px;" href="<?=$arResult["PREV_MONTH_URL"]?>" title="<?=$arResult["PREV_MONTH_URL_TITLE"]?>">&larr;</a>
						<?$isSdvig = true;?>
						<?endif?>
						<?if($arResult["PREV_MONTH_URL"] && $arResult["NEXT_MONTH_URL"] && !$arParams["SHOW_MONTH_LIST"]):?>
							<!--&nbsp;&nbsp;|&nbsp;&nbsp;-->
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
						</td>

						<td width="80%">
						<?if($arParams["SHOW_CURRENT_DATE"]):?>
							<h2 style="text-align: center; margin-bottom:-4px; color:#C85711;"><?=$arResult["TITLE"]?></h2>
						<?endif?></td>
						<td width="10%" height=30>
							<?if($arResult["NEXT_MONTH_URL"]):?>
								<a  style="font-size:22px; color:#C85711; margin-bottom:2px;" href="<?=$arResult["NEXT_MONTH_URL"]?>" title="<?=$arResult["NEXT_MONTH_URL_TITLE"]?>">&rarr;</a>
							<?endif?>
						</td>
					</tr>
				</table>
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
<?$total_number = 0;?>
	<table width='100%' border='0' cellspacing='0' cellpadding='4' class='NewsCalTable'>
		<tr class="weekdays">
			<?foreach($arResult["WEEK_DAYS"] as $WDay):?>
			<td class='NewsCalHeader'><?=$WDay["SHORT"]?></td>
			<?endforeach?>
		</tr>
		<?foreach($arResult["MONTH"] as $arWeek):?>
		<tr>
			<?foreach($arWeek as $arDay):?>
					<?$index = 0;?>
					<?foreach($arDay["events"] as $arEvent):?>
							<?$index = $index + 1;?>
							<?$total_number = $total_number +1;?>
					<?endforeach?>

				<td align="left" valign="top" class="<?=$arDay['td_class']?> <?if ($index>0) {?>active_day<? } ?>" width="14%">

		            <?if ($index>0) {?>
							<a id="day_<?=$arDay[day]?>" class="calendardate jt" href="#"><?=$arDay["day"]?></a>
					<? } else {?>
						<span class=""><?=$arDay["day"]?></span>
					<? } ?>
				</td>
			<?endforeach?>
		</tr >
		<?endforeach?>
	</table>
</div>
	<div style="" class="w445 lfloat"> <!-- second column -->
		<div class="wrapper">

		<?if ($total_number>0) {?>
			<h2>Мероприятия в <?=$name_month?>  <?=$arResult["currentYear"]?>:</h2>
				<?foreach($arResult["MONTH"] as $arWeek):?>

					<?foreach($arWeek as $arDay):?>
								<?$index = 0;?>
								<?foreach($arDay["events"] as $arEvent):?>
								<?//print_r($arDay["events"]);
								?>
								<?
									$id_city = $arEvent["city_id"];
									$arFilter = Array("IBLOCK_ID"=>51,"ID"=>$arEvent["city_id"]);
									$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
									while($ar_fields = $res->GetNext())
									{
										$city_name = $ar_fields["NAME"];
									}
								?>
									<?$total_number = $total_number +1;?>
									<div class="month_<?=$arDay['day']?> auto table_data" date="<?=$arDay['day']?>">
										 <div class="l w65">
		       						    	 &nbsp;<?=$arDay["day"]?>.<?if (strlen($arResult["currentMonth"])<2){?>0<? } ?><?=$arResult["currentMonth"]?>.<?=$arResult["currentYear"]?>
		       						     </div>
										 <div class="l w100 training_code" >
                                           &nbsp;&nbsp;<?=$arEvent['type_name']?>
		       						     </div>
										 <div class="r w260">
											 <? if (strlen($arEvent["link"]) < 1) {?>
											 	<a  class="" href="/training/seminar/<?=$arEvent['external_id']?>/"><?=$arEvent["title"]?></a> <?=$city_name?>
											 	<?} else {?>
											 	<a class="" href="<?=$arEvent['link']?>"><?=$arEvent["title"]?></a> <?=$city_name?>
											<? } ?>
										 </div>

		      						    </div>
								<?endforeach?>
					<?endforeach?>
				<?endforeach?>
			</table>
		<? }  else { ?>
		  <h2>Нет мероприятий  в этом месяце</h2>
		<?  } ?>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<script type="text/javascript" >
function Activation2() {
	$(document).ready(function() {
		$('#calendar a.calendardate').mouseover(function() {
			var current_id = $(this).text();
			$('div.month_'+current_id).attr("class",'table_data auto month_'+current_id+' onmouseoverdate');
			return false;
		})
		.mouseout(function() {
			var current_id = $(this).text();
			$('div.month_'+current_id).attr("class",'table_data auto month_'+current_id);
            return false;
		});
		$('#calendar a.calendardate').click(function() {
			return false;
		});



		$('div.table_data').mouseover(function() {
			 var current_date = $(this).attr("date");
			 $(this).attr("class",'table_data auto month_'+current_date+' onmouseoverdate');
			 $('#training a#day_'+current_date+'').attr("class",'jt calendardate a_on_hover').parent().attr("class",'active_state');
			 return false;

		})
		.mouseout(function() {
			 var current_date = $(this).attr("date");
			 $(this).attr("class",'table_data auto month_'+current_date+'');
			 $('#training a#day_'+current_date+'').attr("class",'jt calendardate').parent().attr("class",'active_day');
			 return false;
		})
		.click(function() {

		});
	});
}
</script>
<script type="text/javascript">
	BX.EvalGlobal(Activation2());
</script>

