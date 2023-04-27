<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?$cbr=simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp');?>
<?echo "<pre>";?>
<?foreach ($cbr->Valute as $valute)  {?>
	<?if ($valute->CharCode == "UAH") {?>
		<?print_r($valute)?>

	<?

	//курс получили, возможно, курс на нынешнюю дату уже есть на сайте, проверяем 
	
	$DATE_RATE=date("d.m.Y");
	$NEW_RATE['CURRENCY']= 'GRN'; 
    $NEW_RATE['RATE_CNT'] =(string)$valute->Nominal; 
	$NEW_RATE['RATE'] = str_replace(',', '.', (string)$valute->Value); 
    $NEW_RATE['DATE_RATE']=$DATE_RATE; 
	print_r($NEW_RATE);
    CCurrencyRates::Add($NEW_RATE); 
                

	?>
             
	<?}?>
<?}?>
