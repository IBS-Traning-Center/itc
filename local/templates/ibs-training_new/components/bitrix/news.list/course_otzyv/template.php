<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$index = 1;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
<?//print_r($arItem);

  		if  ($arItem["PROPERTIES"]["client"]["VALUE"]>0) {
	        //теперь  получим имя имя клиента
	  		$arSelect = Array("NAME", "PROPERTY_TEXT_CITY");
			$arFilter = Array("IBLOCK_ID"=>63,"ID"=>$arItem["PROPERTIES"]["client"]["VALUE"]);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ar_fields = $res->GetNext())
			{
		 		//print_r($ar_fields);
		 		$otzyv_client_name = $ar_fields["NAME"];
		 		$otzyv_client_city = $ar_fields["PROPERTY_TEXT_CITY_VALUE"];
			}
		}

?>
	<p><strong>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
	<span class="client_name"><?echo $arItem["NAME"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
	<span><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif?>
	</strong>
	<?if ($index == 1) {?>
		<div class="buble_body">
		 <h2>Отзывы: </h2>
	<? } ?>
	    		<?
                    $otzyv_client_id = $arItem["PROPERTIES"]["client"]["VALUE"];
                    $otzyv_author_surname = $arItem["PROPERTIES"]["surname"]["VALUE"];
                    $otzyv_author_name =$arItem["PROPERTIES"]["name"]["VALUE"];
                    $otzyv_author_text =$arItem["PROPERTIES"]["review"]["VALUE"];
	    		?>

<?if (($otzyv_client_id == 22985)) {?>
	<p><?if (strlen($otzyv_author_surname)>0) {?><strong><?=$otzyv_author_surname?> <?=$otzyv_author_name?></strong><? } ?> (<?=$otzyv_client_name?>):<br />
<? } else {?>
	<p>Компания <strong><?=$otzyv_client_name?></strong> <?if (strlen($otzyv_client_city)>0){?>(<?=$otzyv_client_city?>)<? } ?>:<br />
<? } ?>
<?=nl2br($otzyv_author_text);?></p>

<?$index = $index + 1 ;?>
<?endforeach;?>
	<?if ($index > 1) {?>
		</div>
	<?}?>

