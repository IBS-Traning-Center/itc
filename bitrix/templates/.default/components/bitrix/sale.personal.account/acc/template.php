<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo "<pre>"?>
<?//print_r($arResult["ACCOUNT_LIST"][0]["ACCOUNT_LIST"]["CURRENT_BUDGET"])?>
<?
foreach ($arResult["ACCOUNT_LIST"] as $arList) {
	if ($arList["CURRENCY"]["CURRENCY"]=="EUR") {
		$value=$arList["ACCOUNT_LIST"]["CURRENT_BUDGET"];
	}
}

$bons=intval($value);
?>
<?CModule::IncludeModule("currency")?>
<?$newval = CCurrencyRates::ConvertCurrency($bons, "RUB", "GRN");?>
<h1>Bonus points </h1>
<div class="bonus-wraper">
<div style="font-size: 60px; color: #EE5F0E"><?=$bons?></div> points
</div>


