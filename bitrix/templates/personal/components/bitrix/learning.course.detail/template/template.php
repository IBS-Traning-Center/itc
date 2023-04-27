<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="learn-box">
<h2><?=$arResult["COURSE"]["NAME"]?></h2>
</div>
<?if (!empty($arResult["COURSE"])):?>

	<?=$arResult["COURSE"]["DETAIL_TEXT"]?>

<?endif?>
<?//print_r($arResult)?>
