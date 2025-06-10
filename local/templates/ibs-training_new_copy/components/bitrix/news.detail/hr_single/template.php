<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	      $vacancy_name = $arResult["NAME"];
	      $vacancy_id = $arResult["ID"];
	      $vacancy_site = $arResult['PROPERTIES']['ensite']['VALUE'];
	      $vacancy_email = $arResult['PROPERTIES']['email']['VALUE'];
	      $vacancy_code = $arResult['PROPERTIES']['int_id']['VALUE'];
	      $vacancy_city = strip_tags($arResult['DISPLAY_PROPERTIES']['cities']['DISPLAY_VALUE']);
	      $vacancy_hot = $arResult['PROPERTIES']['hot']['VALUE'];
	      $vacancy_description_en = nl2br($arResult['PROPERTIES']['description_en']['VALUE']['TEXT']);
	      $vacancy_requirements_en = nl2br($arResult['PROPERTIES']['requirements_en']['VALUE']['TEXT']);
	      $vacancy_category = $arResult['PROPERTIES']['categories']['VALUE'];
	      // получаем вакансию на русском или англ
 		  $arFilter = array();
 		  $arSort = array();
	      $arFilter["ID"] = $vacancy_category;
       ?>
<div class="vacancyitem">
        <p><a class="title" href="/careers/<?=$vacancy_id?>/"><?=$vacancy_name?></a><? if ($vacancy_hot=="hot"):?> <span  class="feathered"> -  <? echo GetMessage("HOT"); ?>!</span> <?endif;?></p>
        <? if (strlen($vacancy_code)>1) {  ?>
        <p><label><? echo GetMessage("VACANCY_CODE"); ?>:</label> <?=$vacancy_code?> </p><? } ?>
        <? if (strlen($vacancy_description_en)>1) {  ?>
        <label><? echo GetMessage("VACANCY_DESCRIPTIONS"); ?></label>
        <p><?=$vacancy_description_en?></p><? } ?>
        <? if (strlen($vacancy_requirements_en)>1) {  ?>
        <label><? echo GetMessage("VACANCY_REQUIREMENTS"); ?>:</label>  <? } ?>
        <p><?=$vacancy_requirements_en?></p>
</div>






