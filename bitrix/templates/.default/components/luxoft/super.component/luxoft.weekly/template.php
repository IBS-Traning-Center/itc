<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<table cellSpacing="2" cellPadding="2"  border="0" class="lux_table">
<tr class="lux_header">
	<td align="left" width="100"> <span style="color: #555555; font-weight: bold; font-family: 'Courier New', Courier, FreeMono; text-transform: uppercase; font-size: 16px; font-weight: normal; text-decoration: none;margin-bottom:2px;">Город</span></td>
	<td align="center" width="420"><span style="color: #555555; font-weight: bold; font-family: 'Courier New', Courier, FreeMono; text-transform: uppercase; font-size: 16px; font-weight: normal; text-decoration: none;margin-bottom:2px;">Название</span></td>
	<td align="left"><span style="color: #555555; font-weight: bold; font-family: 'Courier New', Courier, FreeMono; text-transform: uppercase; font-size: 16px; font-weight: normal; text-decoration: none;margin-bottom:2px;">Дата</td>
	<td align="center"><span style="color: #555555; font-weight: bold; font-family: 'Courier New', Courier, FreeMono; text-transform: uppercase; font-size: 16px; font-weight: normal; text-decoration: none;margin-bottom:2px;">Прод-ть</span></td>
	<td align="right"><span style="color: #555555; font-weight: bold; font-family: 'Courier New', Courier, FreeMono; text-transform: uppercase; font-size: 16px; font-weight: normal; text-decoration: none;margin-bottom:2px;">Запись</span></td>	
</tr>
<?if (count($arResult['CLASSSES'])){?>
	<tr class="lux_usual">
		<td class="lux_td_time" style="background-color:#eeeeee;" colspan="5"><span style="color: #F26522; font-weight: bold; font-family: 'Courier New', Courier, FreeMono; text-transform: uppercase; font-size: 17px; text-decoration: none;margin-bottom:2px;">Классы</span></td>
	</tr>
	<? foreach($arResult['CLASSSES'] as $arClass){ ?>
	<tr class="lux_usual">
		<td class="lux_td_time" width="100" valign="top"><?if ($vCurCity !== $arClass['CITY_NAME']){?><?=$arClass['CITY_NAME']?><? } ?></td>
		<td class="lux_td_name" width="420" valign="top"><a href="http://www.luxoft-training.ru/timetable/pp.html?ID=<?=$arClass['ID']?>" target="_blank"><?=$arClass['NAME']?></a></td>
		<td class="lux_td_date" valign="top"><?=$arClass['STARTDATE']?> <?if ($arClass['ENDDATE']){?>- <?=$arClass['ENDDATE']?> <? } ?></td>
		<td class="lux_td_duration" align="center" valign="top"><nobr><?=$arClass['PRSCHEDULE_DURATION']?><?if ($arClass['PRSCHEDULE_DURATION']) {?> час.<? } ?></nobr></td>
		<td class="lux_td_record" valign="top"><!--<a href="http://www.luxoft-training.ru/events/seminar/<?echo $arItem['ID']?>/" target="_blank">Записаться</a>--></td>
	</tr>
	<? $vCurCity = $arClass['CITY_NAME'];?>
	<? } ?>
<? } ?>

<?if (count($arResult['COURSES'])){?>
	<tr class="lux_usual">
		<td class="lux_td_time" style="background-color:#eeeeee;"  colspan="5"><span style="color: #F26522; font-weight: bold; font-family: 'Courier New', Courier, FreeMono; text-transform: uppercase; font-size: 17px; text-decoration: none;margin-bottom:2px;">Курсы</span></td>
	</tr>
	<? foreach($arResult['COURSES'] as $arCourse){ ?>
	<tr class="lux_usual">
		<td class="lux_td_time" width="100" valign="top"><?if ($vCurCity !== $arCourse['CITY_NAME']){?></div><?=$arCourse['CITY_NAME']?><? } ?></td>
		<td class="lux_td_name" width="420" valign="top"><a href="http://www.luxoft-training.ru/internal/catalog/<?=$arCourse['SCHEDULE_COURSE_CODE']?>/" target="_blank"><?=$arCourse['SCHEDULE_COURSE_NAME']?></a><br />
				<?if ($arCourse['TEACHER_INFO']['EXPERT_ID']){?><b>Тренер: </b><?= $arCourse['TEACHER_INFO']['EXPERT_NAME'] ?> <?= $arCourse['TEACHER_INFO']['EXPERT_NAME_FULL'] ?><? } ?>
		</td>
		<td class="lux_td_date" valign="top"><?=$arCourse['STARTDATE']?> <?if (($arCourse['STARTDATE'] !== $arCourse['ENDDATE']) and (strlen($arCourse['ENDDATE']))>0){?>- <?=$arCourse['ENDDATE']?><? } ?></td>
		<td class="lux_td_duration" align="center" valign="top"><nobr><?=$arCourse['SCHEDULE_DURATION']?><?if ($arCourse['SCHEDULE_DURATION']) {?> час.<? } ?></nobr></td>
		<td class="lux_td_record" valign="top"><a href="https://inthr.luxoft.com/IntHRWebApp/aspx_PTC/CreateRequestInternal.aspx?Course=<?=$arCourse['SCHEDULE_COURSE_CODE']?>" target="_blank">Записаться</a></td>
	</tr>
	<? $vCurCity = $arCourse['CITY_NAME'];?>
	<? } ?>
<? } ?>

<?if (count($arResult['SEMINARS'])){?>
	<tr class="lux_usual">
		<td class="lux_td_time"  style="background-color:#eeeeee;" colspan="5"><span style="color: #F26522; font-weight: bold; font-family: 'Courier New', Courier, FreeMono; text-transform: uppercase; font-size: 17px; text-decoration: none;margin-bottom:2px;">Семинары</span></td>
	</tr>
	<? foreach($arResult['SEMINARS'] as $arSeminar){ ?>
	<?
	$datetime = $arSeminar['STARTDATE'];
	$format = "DD.MM.YYYY HH:MI:SS";
	$arr = ParseDateTime($datetime, $format);
	$arSeminar['STARTDATE'] = $arr["DD"].".".$arr["MM"].".".$arr["YYYY"];
	?>
	<tr class="lux_usual">
		<td class="lux_td_time" width="100" valign="top" ><?=$arSeminar['CITY_NAME']?></td>
		<td class="lux_td_name" width="400"valign="top" ><a href="http://www.luxoft-training.ru/events/seminar/<?=$arSeminar['ID']?>/" target="_blank"><?=$arSeminar['NAME']?></a><br /> 
		<?if ($arSeminar['LOCATION']){?><?=$arSeminar['LOCATION']?><br /><? } ?>
		<?if ($arSeminar['TEACHER_INFO']['EXPERT_ID']){?><b>Тренер: </b><?= $arSeminar['TEACHER_INFO']['EXPERT_NAME'] ?> <?= $arSeminar['TEACHER_INFO']['EXPERT_NAME_FULL'] ?><? } ?>
		
		</td>
		<td class="lux_td_date" valign="top"><?=$arSeminar['STARTDATE']?></td>
		<td class="lux_td_duration" align="center" valign="top"><nobr><?=$arSeminar['DURATION']?><?if ($arSeminar['DURATION']) {?> час.<? } ?></nobr></td>
		<td class="lux_td_record" valign="top"><a href="http://www.luxoft-training.ru/events/seminar/<?=$arSeminar['ID']?>/" target="_blank">Записаться</a></td>
	</tr>
	<? } ?>
<? } ?>

<?if (count($arResult['WEBINARS'])){?>
	<tr class="lux_usual">
		<td class="lux_td_time" colspan="5" style="background-color:#eeeeee;" ><span style="color: #F26522; font-weight: bold; font-family: 'Courier New', Courier, FreeMono; text-transform: uppercase; font-size: 17px; text-decoration: none;margin-bottom:2px;">Вебинары</span></td>
	</tr>
	<? foreach($arResult['WEBINARS'] as $arSeminar){ ?>
	<?
	$datetime = $arSeminar['STARTDATE'];
	$format = "DD.MM.YYYY HH:MI:SS";
	$arr = ParseDateTime($datetime, $format);
	$arSeminar['STARTDATE'] = $arr["DD"].".".$arr["MM"].".".$arr["YYYY"];
	?>
	<tr class="lux_usual">
		<td class="lux_td_time" width="100" valign="top" >&nbsp;</td>
		<td class="lux_td_name" width="400" valign="top" ><a href="http://www.luxoft-training.ru/events/seminar/<?=$arSeminar['ID']?>/" target="_blank"><?=$arSeminar['NAME']?></a><br /> 
		<?if ($arSeminar['LOCATION']){?><?=$arSeminar['LOCATION']?><br /><? } ?>
		<?if ($arSeminar['TEACHER_INFO']['EXPERT_ID']){?><b>Тренер: </b><?= $arSeminar['TEACHER_INFO']['EXPERT_NAME'] ?> <?= $arSeminar['TEACHER_INFO']['EXPERT_NAME_FULL'] ?><? } ?>
		
		</td>
		<td class="lux_td_date" valign="top"><?=$arSeminar['STARTDATE']?></td>
		<td class="lux_td_duration" align="center" valign="top"><nobr><?=$arSeminar['DURATION']?><?if ($arSeminar['DURATION']) {?> час.<? } ?></nobr></td>
		<td class="lux_td_record" valign="top"><a href="http://www.luxoft-training.ru/events/seminar/<?=$arSeminar['ID']?>/" target="_blank">Записаться</a></td>
	</tr>
	<? } ?>
<? } ?>


</table>