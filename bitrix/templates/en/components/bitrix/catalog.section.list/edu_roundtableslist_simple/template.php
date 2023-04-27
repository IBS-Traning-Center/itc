<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $index = 0;?>
<?foreach($arResult["SECTIONS"] as $arSection):?>

<?
   	$ar_result=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"54", "ID"=>$arSection["ID"]), false, Array("UF_ROUNDTABLE_TIME", "UF_ROUNDTABLE_DATE" ,"UF_CITY" ));
		if($razdel=$ar_result->GetNext()){ }
		$dateofroundtable = $razdel["UF_ROUNDTABLE_DATE"];  // зададим дату круглого стола
		$timeofroundtable = $razdel["UF_ROUNDTABLE_TIME"];  // зададим дату круглого стола
		$id_city =  $razdel["UF_CITY"];
		$datecurent = date("d.m.Y");   // зададим дату СЕГОДНЯШНЮЮ
	 	$result = $DB->CompareDates($dateofroundtable, $datecurent); // сравним даты
?>
<?if ($result=="1"){?>
<? $index = $index +1; if ($index==1){?><h3>Ближайшие круглые столы:</h3><?}
?>
	<p><strong>Дата: </strong><?=$dateofroundtable?> (<?=$timeofroundtable?>)</p>
	<h1 style="line-height:120%;"><!--<a href="<?=$arSection["SECTION_PAGE_URL"]?>">--><?=$arSection["NAME"]?><!--</a>--></h1>
	<?if (strlen($arSection["DESCRIPTION"])) {?><p class="grey"><?=$arSection["DESCRIPTION"]?></p><? } ?>

<? } ?>
<?endforeach?>
<? if ($index==0){?><h2>В ближайшие даты проведение Круглых столов не запланировано</h2><?} ?>


