<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//print_r($arResult["ACCOUNT_LIST"][0]["ACCOUNT_LIST"]["TIMESTAMP_X"]);
$now = new DateTime();
$earAgo = $now->modify('-365 day')->format('d.m.Y H:i:s');
$lastBonuses = ConvertDateTime($arResult["ACCOUNT_LIST"][0]["ACCOUNT_LIST"]["TIMESTAMP_X"],'d.m.Y H:i:s');
?>
<?

  $bons=intval($arResult["ACCOUNT_LIST"][0]["ACCOUNT_LIST"]["CURRENT_BUDGET"]);

?>
<? if(strtotime($lastBonuses) > strtotime($earAgo)){ ?>
<a href="/personal_test/bonuses/">Посмотреть детали</a>
<p>Моя скидка <strong><?=$bons?></strong> <?=getCountVal($bons, array("Балл", "Балла", "Баллов"))?></p>
<?}?>
