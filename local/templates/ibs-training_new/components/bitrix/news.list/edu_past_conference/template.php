<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? $index=0; ?>
<blockquote>
<ul>
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

<li><?echo $arItem["NAME"]?>
<?if (strlen($arItem["PROPERTIES"]["not_date"]["VALUE"])>0) {}else {?> 
<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
<? echo " ".$city_name.", ".$arItem["DISPLAY_ACTIVE_FROM"]."";?><?endif ?>
<? } ?>

<? $index = $index +1; ?>
<?endforeach;?>

</ul>
</blockquote>