<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//iwrite($arResult['INFO']);?>
<style>
.no_border_bottom{
	border-bottom:0px!important;
}
.no_border_left{
	border-left:0px!important;
}
.no_border_right{
	border-right:0px!important;
}
</style>

<? $vHTMLBlock .= "
<table cellSpacing='0' cellPadding='5'  border='0' class='edu'>
	<tr class='edu_header'>
		<td>
			<p><nobr>Код курса</nobr></p>
		</td>
		<td vAlign=top width='100%'>
			<p>Название курса</p>
		</td>
		<td vAlign=center width=70 VALIGN='middle'>
			<p class='nobr'>Продол-ть</p>
		</td>
		<td vAlign=center width=70 VALIGN='middle'>
			<p class='nobr'>Цена</p>
		</td>
	</tr> ";
 ?>
<?
$vTotalPrice = 0 ;
$vTotalDuration = 0 ;
?>
<?foreach($arResult["ITEMS"] as $arItem):?>
        <?
	      $course_duration = $arItem['PROPERTY_COURSE_DURATION_VALUE'];
	      $course_price = $arItem['PROPERTY_COURSE_PRICE_VALUE'];
	      $vTotalPrice = $vTotalPrice + intval($arItem['PROPERTY_COURSE_PRICE_VALUE']) ;
	      $vTotalDuration = $vTotalDuration + intval($arItem['PROPERTY_COURSE_DURATION_VALUE']);
	      if (strlen($course_price)>0){
	      	$course_price .= " р.";
	      }
	      $course_code = $arItem['PROPERTY_COURSE_CODE_VALUE'];
	      $course_id = $arItem["ID"];
		  $arItem["NAME"] =$arItem["NAME"];

        ?>
<? $vHTMLBlock .= "
		<tr  class='ewTableAltRow'  onmouseover='ew_mouseover(this);' onmouseout='ew_mouseout(this);'>
			<td class='td_code' width=70>
				<p class='nobr'>".$course_code."</p>
			</td>
			<td vAlign=top width='100%'>
				<p><a href='/training/catalog/course.html?ID=".$arItem['ID']."'>".$arItem['NAME']."</a></p>
			</td>
			<td vAlign=center width=70>
				<p class='nobr'>".$course_duration." ч.</p>
			</td>
			<td vAlign=center width=70>
				<p class='nobr'>".$course_price."</p>
			</td>
		</tr>
		";
		?>
<?endforeach;?>
<?
// если это Класс это выводим общую стоимость
//echo $arResult['SECTION_NAME'];
if (strpos($arResult['SECTION_NAME'], "Класс") !== false){
?>
<? $vHTMLBlock .= "
		<tr  class='ewTableAltRow'>
			<!--
			<td class='td_code no_border_left no_border_right no_border_bottom' width=70>

			</td>
			-->
			<td vAlign=top width='100%' class='' colspan='2'>
					<div style='text-align:right'><p style='text-align: right;'>Всего:&nbsp;</p></div>
			</td>
			<td vAlign=center width=70>
				<p class='nobr'>".$vTotalDuration." ч.</p>
			</td>
			<td vAlign=center width=70>
				<p class='nobr'>".$vTotalPrice." р.</p>
			</td>
		</tr>
		";
		?>
<? } ?>
<?
$vHTMLBlock .= "</table>";
?>

<div class="r w200">

<?
if (count($arResult["RECORDS"])>0) {?>
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



<div class="buble_body" style="">
<?foreach($arResult["RECORDS"] as $arRecord):?>

	<p>
<span class="st">Город:</span> <span id="event_city_name"><?=$arRecord['PROPERTY_CITY_NAME']?></span>
<br>
		<span class="st">Дата проведения: </span><?=$arRecord['PROPERTY_STARTDATE_VALUE']?><?if (strlen($arRecord['PROPERTY_ENDDATE_VALUE'])>0){?> - <?=$arRecord['PROPERTY_ENDDATE_VALUE']?><? } ?><br /><span style="display: none;" id="from_event_date"><?=$arRecord['PROPERTY_STARTDATE_VALUE']?></span>
		<span class="st">Длительность класса: </span> <nobr><?=$arRecord['PROPERTY_PRSCHEDULE_DURATION_VALUE']?> ч.</nobr><br>
		<span class="st">Стоимость участия в классе:</span> <nobr><?=$arRecord['PROPERTY_PRSCHEDULE_PRICE_VALUE']?> <?if (($arRecord['PROPERTY_CITY_VALUE'] == CITY_ID_KIEV) or ($arRecord['PROPERTY_CITY_VALUE'] == CITY_ID_ODESSA) or ($arRecord['PROPERTY_CITY_VALUE'] == CITY_ID_DNEPR)) {?> грн.<? } else {?> р. <? } ?></nobr></p>
<a name="pay"></a>
	<a title="Забронировать место в классе или подать предварительную заявку." href="/timetable/pp.html?ID=<?=$arRecord['ID']?>#fill_form" class="orange links"><!--Оплатить по Договору-->Регистрация</a><br>
<a href="/services/buy_class.html?action=BUY&amp;id=<?=$arRecord['ID']?>" title="Перейти к оплате класса. Оплата происходит путем онлайн платежей или по квитанции для частных лиц и выставления счета для юридических лиц" class="orange links">Перейти к оплате</a>
<p class="tocenter">
	<a href="#" id_basket="<?=$arRecord['ID']?>" title="Запомнить и положить в корзину услуг" rel="nofollow" class="tobasket">
	<img width="32" height="32" border="0" alt="Запомнить и положить в корзину услуг" src="/images_edu/diffs/basket_put.png">
	</a><br>
</p>
<?if (count($arResult["RECORDS"])>1) {?>
	<div class="botborder"></div>
<? }?>

<?endforeach;?>
</div>
<?	}  ?>
<?
global  $arEventInfo;
?>
<div class="buble_body">

	<h2>Оставить  заявку</h2>
	<p>на участие в классе с открытой датой в филиалах:</p>

	<ul>
	<?
		foreach ($arResult["arCityInfo"] as $arSingleCity){	?>
          <li><a href="/training/catalog/code/<?=$arResult["INFO"]['CODE']?>/?IN_CITY=<?=$arSingleCity['ID']?>#reg"><?=$arSingleCity['NAME']?></a></li>
	<? } ?>
	</ul>

	<p><?if (strlen($vTotalDuration)>0) {?>
				<strong>Длительность</strong>: <?=$vTotalDuration;?> час.
			<? } ?>
			<?if (strlen($vTotalPrice)>0) {?>
				<strong>Стоимость</strong>: <?=number_format($vTotalPrice, 0, '', ' ');?>  р.</p>
			<? } ?>
	</p>
	</div>
</div>

<div class="l w500">
<?


if (strpos($arResult['INFO']['DESCRIPTION'], "#TABLE#") !== false){
?>
<?$arResult['INFO']['DESCRIPTION'] = str_replace("#TABLE#", $vHTMLBlock, $arResult['INFO']['DESCRIPTION']);?>
	<?=$arResult['INFO']['DESCRIPTION'];?>
<?} else {?>
	<?=$arResult['INFO']['DESCRIPTION'];?>
	<?if (strpos($arResult['SECTION_NAME'], "Класс") !== false){?>
		<?=$vHTMLBlock;?>
	<? } ?>
<? } ?>
<?
//$component->SetResultCacheKeys(array('ITEMS', 'SECTION_NAME'));
?>

<?//iwrite($arResult);
?>
</div>
<div class="clear"></div>