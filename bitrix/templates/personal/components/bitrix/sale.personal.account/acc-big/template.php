<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo "<pre>"?>
<?//print_r($arResult["ACCOUNT_LIST"][0]["ACCOUNT_LIST"]["CURRENT_BUDGET"])?>
<?
foreach ($arResult["ACCOUNT_LIST"] as $arList) {
	if ($arList["CURRENCY"]["CURRENCY"]=="RUB") {
		$value=$arList["ACCOUNT_LIST"]["CURRENT_BUDGET"];
	}
}

$bons=intval($value);
?>
<?CModule::IncludeModule("currency")?>
<?$newval = CCurrencyRates::ConvertCurrency($bons, "RUB", "GRN");?>

<div class="box">
	<div  title="<?=intval($newval)?> грн." class="text">
		<strong>Мои бонусы</strong>
		
		<span <?if (strlen($bons)>4){?>style="font-size: 50px; line-height: 62px;"<?}?>  ><?=$bons?></span>
		<p><?=getCountVal($bons, array("Балл", "Балла", "Баллов"))?></p>
	</div>
	<div class="hidden-wrap-bonus" >
		<span><?=$bons?></span> руб.<br/>
		<span><?=intval($newval)?></span> грн.
	</div>
</div>

