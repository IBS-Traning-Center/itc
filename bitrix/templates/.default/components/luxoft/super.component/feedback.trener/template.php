<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//iwrite($arResult);
?>

<? if (count($arResult['FEEDBACK'])>0){?>
<div class="floated_right" style="background:#EFF3FF;float:none; margin:0 0 10px 5px;">
	<h2 style="color: #8596BD;">Отзывы о проведенных тренингах </h2>
<?foreach ($arResult['FEEDBACK'] as $arFeedback){?>
	<p style="padding:0 0px 10px 0;"><?if (strlen($arFeedback['PROPERTY_SURNAME_VALUE'])>0) {?><strong><?=$arFeedback['PROPERTY_SURNAME_VALUE']?> <?=$arFeedback['PROPERTY_NAME_VALUE']?></strong><? } ?>
	
	<?if ($arFeedback['PROPERTY_CLIENT_VALUE'] ) {?>
		Компания:  (<?=$arFeedback['PROPERTY_CLIENT_NAME']?>):
	<? } ?><br />


<?=nl2br($arFeedback['PROPERTY_REVIEW_VALUE']);?> <a href="/training/catalog/course.html?ID=<?=$arFeedback['PROPERTY_COURSE_VALUE']?>">(подробнее о курсе)</a>
<? } ?>
<br /></p>
</div>


<br />
<? } ?>