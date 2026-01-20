<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class=""><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<div style="clear:both"></div>
	<br />
	<?foreach($arResult["FIELDS"] as $code=>$value):?>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
			<br />
	<?endforeach;?>
	  <?
	      $course_name = $arResult["NAME"];
	      $course_id = $arResult["ID"];


	      //$course_code = $arItem['PROPERTIES']['course_code']['VALUE'];
	      $course_code = $arResult['PROPERTIES']['course_code']['VALUE'];
	      $course_price = $arResult['PROPERTIES']['course_price']['VALUE'];
	      $course_language = $arResult['PROPERTIES']['course_language']['VALUE'];
	      $course_duration = $arResult['PROPERTIES']['course_duration']['VALUE'];
	      $course_type = $arResult['PROPERTIES']['course_type']['VALUE'];
	      $course_puproses = nl2br($arResult['PROPERTIES']['course_puproses']['VALUE']['TEXT']);
	      $course_topics = nl2br($arResult['PROPERTIES']['course_topics']['VALUE']['TEXT']);
	      $course_audience = nl2br($arResult['PROPERTIES']['course_audience']['VALUE']['TEXT']);
	      $course_required = nl2br($arResult['PROPERTIES']['course_required']['VALUE']['TEXT']);
	      $course_linkedcourses = nl2br($arResult['PROPERTIES']['course_linkedcourses']['VALUE']['TEXT']);
	      $course_trainers = $arResult['PROPERTIES']['course_trainers']['VALUE'];
	      $course_owner = $arResult['PROPERTIES']['course_owner']['VALUE'];
	      $course_requirements = nl2br($arResult['PROPERTIES']['course_requirements']['VALUE']['TEXT']);
	      $course_addsources = nl2br($arResult['PROPERTIES']['course_addsources']['VALUE']['TEXT']);
	      $course_other = nl2br($arResult['PROPERTIES']['course_other']['VALUE']['TEXT']);
	      $course_filename = $arResult['PROPERTIES']['course_filename']['VALUE'];
	      $course_idcategory = strip_tags($arResult['DISPLAY_PROPERTIES']['course_idcategory']['DISPLAY_VALUE']);
 ?>

<P>
Код: <?=$course_code?><br />
Продолжительность: <?=$course_duration?> час.<br />Цена: <?=$course_price?> р.<br />
<? if(!$course_description=="")  {  ?><span><br /><br />Описание:</span><br /><br />
<div class=""><?=$course_description?></div><? } ?>
<? if(!$course_puproses=="")  {  ?><span><br />Цели:</span><br /><br />
<div class=""><?=$course_puproses?></div>
<P></P><? } ?>
<? if(!$course_topics=="")  {  ?><P><span>Разбираемые темы:</span><br /><br />
<div class=""><?=$course_topics?></div>
<P></P><? } ?>
<? if(!$course_audience=="")  {  ?><P><span>Целевая аудитория:</span><br /><br />
<div class=""><?=$course_audience?></div>
<P></P><? } ?>
<? if(!$course_required=="")  {  ?><P><span>Предварительная подготовка:</span><br /><br />
<div class=""><?=$course_required?></div><br />
<P></P><? } ?>
<? if(!$course_trainers=="")  {  ?><P><span>Инструкторы, преподаватели:</span><br /><br />
<div class=""><?=$course_trainers?></div><? } ?>
<? if(!$course_owner=="")  {  ?><br /><span>Владелец:</span><br /><br />
<div class=""><?=$course_owner?></div><? } ?>
<? if(!$course_addsources=="")  {  ?><br /><span>Рекомендуемые дополнительные материалы, источники:</span><br /><br />
<div class=""><?=$course_addsources?></div><? } ?>
<? if(!$course_classrequirements=="")  {  ?><br /><span>Требования к классу:</span><br /><br />
<div class=""><?=$course_classrequirements?></div><? } ?>
<? if(!$course_other=="")  {  ?>
<br /><span>Примечание:</span><br /><br />
<div class=""><?=$course_other?></div><? } ?>




   <!--
	<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
		<br />
	<?endforeach;?> -->

