<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//elements detail?>
<?//iwrite($arResult['EXPERT']);
?>
<div>
		<?
		//add edit element button
		/*if(isset($arResult['ITEM']['EDIT_BUTTON']))
			echo $arResult['ITEM']['EDIT_BUTTON'];*/
		?>
		<?if($arResult['EXPERT']['PROPERTY_ANSW_IS_SHOW_FULL_ENUM_ID'] == 148){?>

		<div class="site_quote"><?=nl2br($arResult['EXPERT']['~PROPERTY_ANSW_QUESTION_VALUE'])?></div>
		<? }else {?>

		<h2><?=$arResult['ITEM']['NAME']?></h2>
		<? } ?>

		<?=$arResult['ITEM']['PREVIEW_TEXT']?>
		<?/*=$arResult['ITEM']['DETAIL_TEXT']*/?>
<?if ($arResult['EXPERT']['PROPERTY_ANSW_ID_EXPERT_NAME']){?>

<br /><br /><div class="" style="text-align:right;">
<i><a href="/about/experts/<?=$arResult['EXPERT']['PROPERTY_ANSW_ID_EXPERT_CODE']?>.html"><?=$arResult['EXPERT']['NAME']?> <?=$arResult['EXPERT']['PROPERTY_ANSW_ID_EXPERT_NAME']?></a>,<br /><b><?=$arResult['EXPERT']['SHORT']?></b></i>
</div>
<? } ?>
</div>