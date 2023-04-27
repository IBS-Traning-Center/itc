<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
    <? $APPLICATION->SetTitle("$arResult[NAME]"); ?>
    <?
		//print_r($arResult);
		$seminar_name = $arResult["NAME"];
		$seminar_id = $arResult["ID"];
		$location = $arResult['PROPERTIES']['location']['VALUE'];
		$lecturer = $arResult['PROPERTIES']['lecturer']['VALUE'];
		$startdate = $arResult['PROPERTIES']['startdate']['VALUE'];
		$description = nl2br($arResult['PROPERTIES']['description']['VALUE']);
		$content = nl2br($arResult['PROPERTIES']['content']['VALUE']);
		$time = $arResult['PROPERTIES']['time']['VALUE'];
		$titlefile = $arResult['PROPERTIES']['titlefile']['VALUE'];
		$city_id = $arResult['PROPERTIES']['city']['VALUE'];
		$arSelect = Array("NAME");
		$arFilter = Array("IBLOCK_ID"=>"51","ID"=>$city_id);

		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
			$city_name= $ar_fields["NAME"];
		}
    ?>
<div class="floated_right">
	<p>
	<span class="st">Докладчик: </span><?=$lecturer?><br/>
	<span class="st">Дата проведения: </span><?=$startdate?><br/>
	<span class="st">Время: </span><?=$time?><br/>
	<!--<span class="st">Стоимость участия в :</span> </p>-->
<?if ($arResult['PROPERTIES']['type'][VALUE_ENUM_ID]==89){?><span class="st">Стоимость: </span>Вебинар бесплатный<br/><?}else {?><span class="st">Стоимость: </span><?=$arResult['PROPERTIES']['price']['VALUE'] ?><br /><? } ?><br />
	<a href="#fill_form" class="orange">Записаться на вебинар</a>
</div>



<h2><?=$seminar_name?></h2>
<span id="event_city_name" style="display:none;"><?=$city_name?></span>

<? if(!$description=="")  {  ?>
	<span class="st">Краткое описание</span>
	<p class="indent"><?=$description?></p>
<? } ?>
<? if(!$content=="")  {  ?>
	<span class="st">Содержание семинара</span>
	<p class="indent"><?=$content?></p>
<? } ?>
<? if(!$titlefile=="")  {  ?>
	<span class="st">Дополнительные файлы</span>
	<p class="indent"><a  href=""><?php echo $titlefile; ?></p>
<? } ?>





    <? $APPLICATION->SetTitle("Семинары"); ?>
