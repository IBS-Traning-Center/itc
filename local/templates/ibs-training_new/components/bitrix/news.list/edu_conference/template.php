<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

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

<p><a href="<?echo $arItem["PROPERTIES"]["site"]["VALUE"]?>"><?echo $arItem["NAME"]?></a>
<?if (strlen($arItem["PROPERTIES"]["not_date"]["VALUE"])>0) {}else {?> 
<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
<? echo "<br />".$city_name.", ".$arItem["DISPLAY_ACTIVE_FROM"]."";?><?endif ?>
<? } ?>

<?if (strlen($arItem["PROPERTIES"]["anons"]["VALUE"])>0) {?> 
<br /><?echo nl2br($arItem["PROPERTIES"]["anons"]["VALUE"]);?>
<? } ?>
<div class="botborder"></div>
<? $index = $index +1; ?>
<?endforeach;?>
<? if ($index==0) { ?>В ближайшие даты проведение конференций не запланировано<? } ?>
