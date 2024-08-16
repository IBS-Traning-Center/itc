<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<blockquote>
<ul>
<? $index=0; ?>
<?foreach($arResult["ITEMS"] as $arItem):?>

<?
		//сначала  получим имя города
		$id_city = $arItem["PROPERTIES"]["city"]["VALUE"];
		$arFilter = Array("IBLOCK_ID"=>51,"ID"=>$id_city);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$city_name = $ar_fields["NAME"];
		}
?>
<? //print_r($arItem);
?>

<li><a href="/events/seminar/seminarinfo.html?ID=<?=$arItem['ID']?>"><?echo $arItem["NAME"]?></a>
<?if (strlen($arItem["PROPERTIES"]["not_date"]["VALUE"])>0) {}else {?>

<? echo $city_name.", ".$arItem["PROPERTIES"]["startdate"]["VALUE"]."";?>
<? } ?></li>


<? $index = $index +1; ?>
<?endforeach;?>
<? if ($index==0) { ?>В ближайшие даты проведение семинаров не запланировано<? } ?>
</ul>
</blockquote>