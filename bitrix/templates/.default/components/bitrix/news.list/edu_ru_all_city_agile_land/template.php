<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $GLOBALS["arrFilter"], false, false, $arSelect);
while($ob = $res->GetNextElement())
{ 
	$arFileds = $ob->GetFields(); 
	$arProps = $ob->GetProperties();
	$arRes['ELEMENTS'][$arFileds['ID']]['ID'] =  $arFileds['ID'];
	$arRes['ELEMENTS'][$arFileds['ID']]['NAME'] =  $arFileds['NAME'];
	$arRes['ELEMENTS'][$arFileds['ID']]['PROPERTIES'] =  $arProps;	
}

if(count($GLOBALS["linkSchedule"]) > 0) 
{	
	foreach ($GLOBALS["linkSchedule"] as $arItem) 
	{
		$arSelect = Array("ID","IBLOCK_ID", "NAME", "PROPERTY_schedule_course.XML_ID", "PROPERTY_city.NAME", "PROPERTY_startdate","PROPERTY_enddate", "PROPERTY_schedule_duration", "PROPERTY_schedule_price");
		$arFilter = Array("IBLOCK_ID"=> 9, "ID"=> $arItem, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);

		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			$arRes["LINK_SCHEDULE"][$arItem] = $arFields;
		}
	}
}


?>
<? if(count($arRes['ELEMENTS'])>0 || count($arRes["LINK_SCHEDULE"]) >0){?>
<div class="table" id="s4">
<h2>ближайшие сертификационные тренинги</h2>
<table>
	<thead>
		<tr>
			<th>Название</th>
			<th>место</th>
			<th>дата</th>
                        <th>кол-во часов</th>
                        <th>стоимость</th>
		</tr>
	</thead>
	<tbody>


		<?foreach($arRes["ELEMENTS"] as $arItem){

		// city
		$arSelect1 = Array("NAME");
		$arFilter1 = Array("IBLOCK_ID"=>51,"ID"=>$arItem['PROPERTIES']['city']['VALUE']);
		$res = CIBlockElement::GetList(Array(), $arFilter1, false, false, $arSelect1);
		while($ar_fields = $res->GetNext()) {
			$arItem['CITY'] = $ar_fields['NAME'];
		}

		// course
		$arSelect2 = Array("XML_ID");
		$arFilter2 = Array("IBLOCK_ID"=>6,"ID"=>$arItem['PROPERTIES']['schedule_course']['VALUE']);
		$res = CIBlockElement::GetList(Array(), $arFilter2, false, false, $arSelect2);
		while($ar_fields = $res->GetNext())
		{
			$arItem['COURSE_URL'] = $ar_fields["XML_ID"];
		}

			$value['url'] = $arItem['COURSE_URL'];
			$value["name"] = $arItem['NAME'];
			$value["city"] =$arItem['CITY'];
			$value["startdate"] = $arItem['PROPERTIES']['startdate']['VALUE'];
			$value["duration"] = $arItem['PROPERTIES']['schedule_duration']['VALUE'];
			$value["price"] = $arItem['PROPERTIES']['schedule_price']['VALUE'];
			$value["valuta"] = 'руб.'
		?>
			<tr>
				<td><a target="_blank" href="/kurs/<?=$value['url']?>.html"><?=$value["name"]?></a></td>
				<td><?=$value["city"]?></td>
				<td><?=$value["startdate"]?></td>
				<td><?=$value["duration"];?></td>
				<td><?=number_format($value["price"], 0, '', ' ');?> <?=$value["valuta"]?></td>
			</tr>
		<?}?>
		
 		<?foreach($arRes["LINK_SCHEDULE"] as $Item => $values){?>
			<tr style="border-bottom: 1px solid #d1dde8">
				<td><a target="_blank" href="/kurs/<?=$values["PROPERTY_SCHEDULE_COURSE_XML_ID"]?>.html"><?=$values["NAME"]?></a></td>
				<td><?=$values["PROPERTY_CITY_NAME"]?></td>
				<td><?=$values["PROPERTY_STARTDATE_VALUE"]?>-<br><?=$values["PROPERTY_ENDDATE_VALUE"]?></td>
				<td><?=$values["PROPERTY_SCHEDULE_DURATION_VALUE"]?></td>
				<td><?=number_format($values["PROPERTY_SCHEDULE_PRICE_VALUE"], 0, '', ' ');?> <?=$values["PROPERTIES"]["valuta"]?></td>
			</tr>
		<? } ?>
	</tbody>
</table>
</div>
<?}?>