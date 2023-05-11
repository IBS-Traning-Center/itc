<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	//echo "<pre>Template arResult: "; print_r($arResult["SECTION"]); echo "</pre>";
?>
<?
	foreach($arResult["SECTIONS"] as $arSection):
        //echo "<pre>Template arSection: "; print_r($arSection); echo "</pre>";
	   	$ar_result=CIBlockSection::GetList(Array("SORT"=>"DESC"), Array("IBLOCK_ID"=>"54", "ID"=>$arSection["ID"]), false, Array("UF_ROUNDTABLE_TIME", "UF_ROUNDTABLE_DATE" ,"UF_CITY" ));

		if($razdel=$ar_result->GetNext()){ }

		$dateofroundtable = $razdel["UF_ROUNDTABLE_DATE"];  // зададим дату круглого стола
		$id_city =  $razdel["UF_CITY"];

		$datecurent = date("d.m.Y");   // зададим дату СЕГОДНЯШНЮЮ
	 	$result = $DB->CompareDates($dateofroundtable, $datecurent); // сравним даты
        //$arResult['PROPERTY_DATECHECK']   - переопределенная переменная  какие записи выводить старые или новые
        //$arResult['PROPERTY_CITYCHECK']   - переопределенная переменная  для какого города
	   	$arcity = array(
			"1"=>"5741",
			"2"=>"5744",
			"3"=>"5743",
			"4"=>"5745",
			"5"=>"5742",
			"6"=>"5746",
			"7"=>"5747"
		);
		// массив  - грызный хак чтобы не делать лишний запрос  получения XML_ID пользовательского свойста UF_CITY
		// в XML_ID  лежит  id города

/*	   echo "id_city= $arcity[$id_city]<br/>";
	   echo "в компоненте= $arResult[PROPERTY_CITYCHECK]<br/>";
	   echo "в компоненте дата= $arResult[PROPERTY_DATECHECK]<br/>";
*/     //print_r($arSection);
  		if ($arResult['PROPERTY_DATECHECK']==0) {  // это будущие события

			if ((($result==1) or ($result==0)) and (($arcity["$id_city"]==$arResult['PROPERTY_CITYCHECK']) or ($arResult['PROPERTY_CITYCHECK']=="0"))) { ?>
                <br />
				<h2><?=$arSection["NAME"]?></h2>
				<p><strong>Дата проведения:</strong> <?=$razdel["UF_ROUNDTABLE_DATE"]?><br />
				<!--<strong>Место проведения:</strong>  <?=$id_city?><br />-->
				<strong>Время:</strong> <?=$razdel["UF_ROUNDTABLE_TIME"]?><br />
				<?if ($arSection["DESCRIPTION"]) { ?><strong>Целевая аудитория:</strong> <?=$arSection["DESCRIPTION"]?><? } ?></p>
            <p><strong>Расписание:</strong><br /></p>
		    <?
			$arSelect = Array("PROPERTY_reporter", "PROPERTY_time", "NAME");
		    $arFilter = Array("IBLOCK_ID"=>54, "SECTION_ID"=>$arSection["ID"]);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			$number_of_events = 0;
				while($ar_fields = $res->GetNext())
				{
			 		$number_of_events = $number_of_events+1; // число круглых  столов всего; если 0 то выведем что событий не будет в ближ. время
			 		$reporter = $ar_fields["PROPERTY_REPORTER_VALUE"];
			 		$time = $ar_fields["PROPERTY_TIME_VALUE"];
			 		$name = $ar_fields["NAME"];?>
			     <table сlass="edu" border="0" cellpadding="5" cellspacing="1" width="460">
					<tbody><tr><td valign="top" width=100>
					<nobr><strong><?=$time?></strong></nobr></td><td><?=$reporter?><br /><?=$name?></td>
			    	</tr>
					</tbody>
				</table>

				<? } ?>
                <br />
	        <? } ?>

 	    <?}
 	     else // архивные события
 	    {
			if (($result==-1) and ($arResult['PROPERTY_CITYCHECK']== $arcity["$id_city"]))  {?>
                  <br />
				<h2><?=$arSection["NAME"]?></h2>
				<p><strong>Дата проведения:</strong> <?=$razdel["UF_ROUNDTABLE_DATE"]?><br />
				<!--<strong>Место проведения:</strong>  <?=$id_city?><br />-->
				<strong>Время:</strong> <?=$razdel["UF_ROUNDTABLE_TIME"]?><br />
				<?if ($arSection["DESCRIPTION"]) { ?><strong>Целевая аудитория:</strong> <?=$arSection["DESCRIPTION"]?><? } ?></p>
            <p><strong>Расписание:</strong><br /></p>
				<?if (strlen($arSection["DESCRIPTION"]>0)) { ?><p><strong>Целевая аудитория:</strong> <?=$arSection["DESCRIPTION"]?></p><? } ?>
		    <?
			$arSelect = Array("PROPERTY_reporter", "PROPERTY_time", "NAME");
		    $arFilter = Array("IBLOCK_ID"=>54, "SECTION_ID"=>$arSection["ID"]);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			$number_of_events = 0;
				while($ar_fields = $res->GetNext())
				{
			 		$number_of_events = $number_of_events+1;
			 		$reporter= $ar_fields["PROPERTY_REPORTER_VALUE"];
			 		$time= $ar_fields["PROPERTY_TIME_VALUE"];
			 		$name= $ar_fields["NAME"];?>
			     <table сlass="" border="0" cellpadding="5" cellspacing="1" width="460">
					<tbody><tr><td valign="top" width=100>
					<nobr><strong><?=$time?></strong></nobr></td><td><?=$reporter?><br /><?=$name?></td>
			    	</tr>
					</tbody>
				</table>
				<? } ?>
				<br />
				<? if ($number_of_events==0) {?><h2>Круглые столы в данном городе ни разу не были проведены</h2> <? } ?>
	        <?}

	    } ?>

<?endforeach?>
<? if ($number_of_events==0) {?><h2>В ближайшее время круглых столов не запланировано</h2> <? } ?>
