<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<table cellSpacing="0" cellPadding="5"  border="0" class="lux_table">
<tr class="lux_header">
	<td>Название мероприятия</td>
	<td>Дата</td>
	<td>Время</td>
</tr>
<?foreach($arResult["ITEMS"] as $arItem):?>
         <?
         if ($USER->IsAdmin()) {
         	//print_r($arItem);
		 };
	      $seminar_name = $arItem["NAME"];
	      //$program_id = $arItem["ID"];
	      $location = $arItem['PROPERTIES']['location']['VALUE'];
	      //$lecturer = $arItem['PROPERTIES']['lecturer']['VALUE'];
	      $startdate = $arItem['PROPERTIES']['startdate']['VALUE'];
	      //$description = nl2br($arItem['PROPERTIES']['description']['VALUE']);
	      //$content = nl2br($arItem['PROPERTIES']['content']['VALUE']);
	      $time = $arItem['PROPERTIES']['time']['VALUE'];
	      $type_event = $arItem['PROPERTIES']['type_event']['VALUE_ENUM_ID'];
	      //$titlefile = $arItem['PROPERTIES']['titlefile']['VALUE'];
	      //$city_id = $arItem['PROPERTIES']['cities']['VALUE'];

$datetime = $startdate;
$format = "DD.MM.YYYY HH:MI:SS";

$arr = ParseDateTime($datetime, $format);

//    echo "День:    ".$arr["DD"]."<br>";    // День: 21
//    echo "Месяц:   ".$arr["MM"]."<br>";    // Месяц: 1
//    echo "Год:     ".$arr["YYYY"]."<br>";  // Год: 2004
//    echo "Часы:    ".$arr["HH"]."<br>";    // Часы: 23
//    echo "Минуты:  ".$arr["MI"]."<br>";    // Минуты: 44
//    echo "Секунды: ".$arr["SS"]."<br>";    // Секунды: 15
$startdate = $arr["DD"].".".$arr["MM"].".".$arr["YYYY"];
		?>
<tr class="lux_usual">
	<td class="lux_td_name"><a href="http://ibs-training.ru/events/seminar/<?echo $arItem['ID']?>/" target="_blank"><?=$seminar_name?></a><br />
	<?if ($type_event==92){?><span class="lux_more_info"><strong>Вебинар</strong><? }else { ?><strong>Семинар:</strong> <?=$location?><? } ?></span></td>
	<td class="lux_td_date"><?=$startdate ?></td>
	<td class="lux_td_time"><?=$time ?><br /><?if ($type_event==92){?>(мск.)<? } ?></td>
</tr>


<?endforeach;?>
</table>

