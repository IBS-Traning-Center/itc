<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-calendar" id="calendar">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="NewsCalMonthNav" align="left">
				<table border="0" width="100%"  cellspacing="0" cellpadding="5">
					<tr>
						<td width="10%" height=30>
							<?if($arResult["PREV_MONTH_URL"]):?>
							<a  style="font-size:22px; color:#701132;margin-bottom:22px;" href="<?=$arResult["PREV_MONTH_URL"]?>" title="<?=$arResult["PREV_MONTH_URL_TITLE"]?>">&larr;</a>
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
		<h4 style="text-align: center; margin-bottom:4px; color:#701132; font-size:12px;"><?=$arResult["TITLE"]?></h4>
	<?endif?></td>
						<td width="10%" height=30>
							<?if($arResult["NEXT_MONTH_URL"]):?>
								<a  style="font-size:22px; color:#701132; margin-bottom:2px;" href="<?=$arResult["NEXT_MONTH_URL"]?>" title="<?=$arResult["NEXT_MONTH_URL_TITLE"]?>">&rarr;</a>
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
<style type="text/css">
table.edu_calendar
{
	font-size:85%;
	margin:8px 0px 0px 0px;
    padding:8px 0px 0px 0px;
}
table.edu_calendar a
{
	color:#701132;
}
table.edu_calendar .edu_header
{
	color: #000000;
	background-color: #EEEEEE;
	font-size:115%;
	height: 13px;
}
table.edu_calendar .edu_header td
{
	height: 10px;
}
</style>
	<table width='100%' border='0' cellspacing='0' cellpadding='4' class='NewsCalTable'>
	<tr class="weekdays">
	<?foreach($arResult["WEEK_DAYS"] as $WDay):?>
		<td class='NewsCalHeader'><?=$WDay["SHORT"]?></td>
	<?endforeach?>
	</tr>
	<?foreach($arResult["MONTH"] as $arWeek):?>
	<? //print_r($arWeek);
	?>
	<tr>
		<?foreach($arWeek as $arDay):?>
		<?//print_r($arDay);
		?>

		<td align="left" valign="top" class='<?=$arDay["td_class"]?>' width="14%">
            <div id="<?echo strtolower($arDay[td_class])?>_<?echo strtolower($arDay[tday_class])?>_<?=$arDay[day]?>" style="display:none";>


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
       //сначала  получим имя города
		$id_city = $arEvent["city_id"];
		$arFilter = Array("IBLOCK_ID"=>51,"ID"=>$id_city);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$city_name = $ar_fields["NAME"];
		}


?>

				<?if ($index==1) {?>
<TABLE cellSpacing="0" cellPadding="5"    border="0" class="calend edu_calendar">
<TR class="edu_header">
		<TD>Название</TD>
		<TD>Город</TD>
		<TD>Мероприятие</TD>
		<TD>&nbsp;</TD>
</TR>

				<? } ?>
<TR  class="ewTableAltRow">
	<TD class="td_name"><? if (strlen($arEvent["link"]) < 1) {?><a href="/events/seminar/seminarinfo.html?ID=<?=$arEvent['external_id']?>"><?=$arEvent["title"]?></a><?} else {?><a href="<?=$arEvent['link']?>"><?=$arEvent["title"]?></a><? } ?></TD>
	<TD class="td_name"><NOBR><?=$city_name?></NOBR></TD>
	<TD class="td_time"><NOBR><?=$arEvent["type_name"]?></NOBR></TD>
    <TD class="td_time"><NOBR><? if (strlen($arEvent["link"]) < 1) {?><a href="/events/seminar/seminarinfo.html?ID=<?=$arEvent['external_id']?>">подробнее</a><? } else {?><a href="<?=$arEvent['link']?>">подробнее</a><? } ?></NOBR></TD>
</TR>


			<?endforeach?>
            <?if ($index>0) {?> </TABLE><? } ?>

			 </div>
            <?if ($index>0) {?>
            <?//<!--title="  =$arDay[day]  =$arResult[TITLE]"-->
            ?>
			<span class="<?=$arDay["day_class"]?>"><a class="jt" href="#"  rel="#<?echo strtolower($arDay[td_class])?>_<?echo strtolower($arDay[tday_class])?>_<?=$arDay[day]?>"><?=$arDay["day"]?></a></span>
			<? } else {?>
			<span class="<?=$arDay["day_class"]?>"><?=$arDay["day"]?></span>
			<? } ?>
		</td>
		<?endforeach?>
	</tr >
	<?endforeach?>
	</table>

<script type="text/javascript" >


function Activation() {
$(document).ready(function() {
  $('div.html, div.jquery').next().css('display', 'none').end().click(function() {
    $(this).next().toggle('fast');
  });
  $('a.false').click(function() {
    return false;
  });
});
$(document).ready(function() {
  $('a.jt').cluetip({
    showTitle: false,
    activation: 'hover',
  	width: 400,
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

});
}
</script>
<script type="text/javascript">
	//jsAjaxUtil.EvalGlobal(Activation());
	BX.evalGlobal(Activation());
</script>

</div>