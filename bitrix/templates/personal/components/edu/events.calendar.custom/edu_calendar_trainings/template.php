<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h2>Расписание курсов</h2>
<div class="calendar">
<div class="month">
	<a href="<?=$arResult["PREV_MONTH_URL"]?>" class="prev">&lt;</a>
	<span><?=$arResult["TITLE"]?></span>
	<a href="<?=$arResult["NEXT_MONTH_URL"]?>" class="next">&gt;</a>
</div>
<table width='100%' border='0' cellspacing='0' cellpadding='4' class='NewsCalTable'>
	<tr class="weekdays">
	<?foreach($arResult["WEEK_DAYS"] as $WDay):?>
		<th><?=$WDay["SHORT"]?></th>
	<?endforeach?>
	</tr>
	<?foreach($arResult["MONTH"] as $arWeek):?>
	<? //print_r($arWeek);
	?>
	<tr>
		<?foreach($arWeek as $arDay):?>
		<?//print_r($arDay);
		?>
		<?$allevents=array();?>
		<?$registered="N"?>
		<?$recommended="N"?>
		<?GLOBAL $arReg;?>
		<?GLOBAL $arRec;?>
		<?$index = 0;?>
		<?foreach($arDay["events"] as $arEvent){?>
			
			<?$index = $index + 1;?>
			
			<?if (in_array($arEvent["id"], $arReg)) {?>
				
				<?$green[]=$arEvent["id"]?>
				<?$registered="Y"?>
			<?}?>
			<?if (in_array($arEvent["id"], $arRec)) {?>
				
				<?$yellow[]=$arEvent["id"]?>
				<?$recommended="Y"?>
			<?}?>
			
		<?}?>
		
		<td <?if ($arDay["td_class"]=="NewsCalOtherMonth") {?>class='other'<?} elseif ($registered=="Y") {?>class="registered over-calendar"<?} elseif ($recommended=="Y") {?>class="recommended over-calendar" <?} elseif (count($arDay["events"])>0) {?>class="over-calendar other-c"<?}?>>
            
			<?if ($index>0) {?>
           	<div style="position: relative; height: 38px;">
			<div class="show-it"><?foreach($arDay["events"] as $key=>$arEvent){?>
<?$firsttime="";?><?$firsttime=preg_split("#-#", $arEvent["time"])?><?if ($key!=0) {?><br/><?}?><?if ($key==0) {?><?=$arDay["day"]?><?}?><span class="time"><?=$firsttime[0]?></span><br/><a href="/training/catalog/course.html?ID=<?=$arEvent["schedule_course"];?>" class="text <?if (in_array($arEvent["id"], $yellow)) {?> yellow<?}?> <?if (in_array($arEvent["id"], $green)) {?> green<?}?>"><?=$arEvent["title"];?></a>
			<?}?>
			</div>
			</div>
			<? } else {?>
			<span class="show-it"><?=$arDay["day"]?></span>
			<? } ?>
		</td>
		<?endforeach?>
	</tr >
	<?endforeach?>
	</table>
	<div class="desc">
		<ul>
			<li class="registered">Курсы с регистрацией</li>
			<li class="recommended">Рекомендуемые курсы</li>
			<li class="other-c">Другие курсы</li>
		</ul>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('.over-calendar').mouseover(function() {
			$(this).addClass('show');
		});
		$('.over-calendar').mouseleave(function() {
			$(this).removeClass('show');
		});
	});
</script>
<style>
.over-calendar a {
	text-decoration: none;
	border: 0;
	color: #aaa;
}
.over-calendar .show-it{
position: absolute;
width: 90px;
height: 30px;
padding:3px 8px;
overflow:hidden;
height:33px;
}
.over-calendar .green {
	color: #6ea23f;
}
.over-calendar .yellow {
	color: #e5af47;
}
.over-calendar.show .text {
	white-space: normal;
}

.over-calendar.show .show-it{
z-index: 99;
position: absolute;
width: 199px;
height: auto !important;

}
.over-calendar.show .text {
	width: auto;
}
.bx-core-waitwindow {
	background: white !important;
	border: 1px solid #f0f0f0 !important;
	color: #aaa;
}
</style>


