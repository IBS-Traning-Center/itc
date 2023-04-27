<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	$APPLICATION->RestartBuffer();
	require_once $_SERVER['DOCUMENT_ROOT']."/bitrix/php_interface/ical/iCalcreator.class.php";


		if (CModule::IncludeModule("iblock")){
			$arSelect = Array(
				"PROPERTY_SCHEDULE_COURSE.ID",
				"PROPERTY_SCHEDULE_COURSE.NAME",
				"PROPERTY_SCHEDULE_COURSE.CODE",
			);
			$arFilter = Array("IBLOCK_ID"=>9, "ACTIVE"=>"Y", "ID" =>$arResult["ID"]);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();
				$arResult["ID_COURSE"] =  $arFields["PROPERTY_SCHEDULE_COURSE_ID"];
				$arResult["NAME_COURSE"] =  $arFields["PROPERTY_SCHEDULE_COURSE_NAME"];
				$arResult["CODE_COURSE"] =  $arFields["PROPERTY_SCHEDULE_COURSE_CODE"];
			}
		}



		$idTrener = $arResult['PROPERTIES']['trener']['VALUE'];
		$arTrener["SURNAME"] = "";
		if (strlen($arResult['PROPERTIES']['trener']['VALUE'])>0){
			$arOrder = array();
			$arSort = array();
			$arFilter = array("IBLOCK_ID"=>56, "ID"=>$arResult['PROPERTIES']['trener']['VALUE']);
			$arGroupBy = false;
			$arNavStartParams = array();
			$arSelectFields = array("ID", "NAME", "PROPERTY_EXPERT_SHORT", "PROPERTY_EXPERT_NAME", "CODE");
			$res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
			$index = 0;
			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();
				$arTrener["SURNAME"] = $arFields["NAME"];
				$arTrener["ID"] = $arFields["ID"];
				$arTrener["CODE"] = $arFields["CODE"];
				$arTrener["NAME"] = $arFields["PROPERTY_EXPERT_NAME_VALUE"];
				$arTrener["DESC"] = $arFields["PROPERTY_EXPERT_SHORT_VALUE"];
	   		}
		}


        //iwrite($arResult);


		/*
		//$arResult['PROPERTIES']['startdate']['VALUE']
		//$arResult['PROPERTIES']['enddate']['VALUE']
		//$arResult['PROPERTIES']['schedule_time']['VALUE']
		//$arResult['PROPERTIES']['schedule_price']['VALUE']
		//$arResult['PROPERTIES']['schedule_duration']['VALUE']
		*/

        $arTime = explode("-",$arResult['PROPERTIES']['schedule_time']['VALUE']);
        $timeOfBegining = $arTime[0];
        $timeOfEnd = $arTime[1];
        //iwrite ($arTime);

        $arTimeOfBegining = explode(":",$timeOfBegining);
        $arTimeOfBeginingHH = $arTimeOfBegining[0];
        $arTimeOfBeginingMM = $arTimeOfBegining[1];

        $arTimeOfEnd = explode(":",$timeOfEnd);
        $arTimeOfEndHH = $arTimeOfEnd[0];
        $arTimeOfEndMM = $arTimeOfEnd[1];

		if (strlen($arResult['PROPERTIES']['enddate']['VALUE']) == 0) {
			$arResult['PROPERTIES']['enddate']['VALUE'] =  $arResult['PROPERTIES']['startdate']['VALUE'];
		}
		$schedule_startdate = $arResult['PROPERTIES']['startdate']['VALUE'];
        if (strlen($arResult['PROPERTIES']['enddate']['VALUE'])>0) {
			$schedule_startdate .= "-" . $arResult['PROPERTIES']['enddate']['VALUE'];
		}

		$city_id = $arResult['PROPERTIES']['city']['VALUE'];
		$arSelect = Array("NAME");
		$arFilter = Array("IBLOCK_ID"=>"51","ID"=>$city_id);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
			$city_name= $ar_fields["NAME"];
		}



		$description .= $arResult["CODE_COURSE"]." ".$arResult["NAME_COURSE"]."\n\n";

		 if(!$arResult['PROPERTIES']['startdate']['VALUE']=="")  {
		 	$description .= "Дата проведения курса: ";
		    $description .= $schedule_startdate."\n";
		 }
		 if(!$arResult['PROPERTIES']['schedule_time']['VALUE']=="")  {

		 	$description .= "Время: ";
		    $description .= $arResult['PROPERTIES']['schedule_time']['VALUE']."\n\n";
		 }

		 if(!$city_name=="")  {
		 	//$description .= "Место проведения:\n";
		    //$description .= $city_name."\n\n";
		 }

		if(strlen($arTrener["SURNAME"])>0)  {
		    $description .= "Докладчик:\n";
		    $description .= " ".$arTrener['SURNAME']." ".$arTrener["NAME"]." -".$arTrener["DESC"]."\n\n";
		 }

       //$description .=  $arResult['PROPERTIES']['description']['~VALUE']."\n\n";
       $wordReg  =  "Регистрация и подробнее о курсе:";
	   $description .= $wordReg."\n";
	   $description .= "http://www.luxoft-training.ru/training/catalog/course.html?ID=".$arResult['ID_COURSE']."&ID_TIME=".$arResult['ID']."\n\n";

       $description = iconv("windows-1251", "UTF-8", $description);
       $summary = "Посещение курса Учебного центра Luxoft \"".$arResult["NAME_COURSE"]."\"";
        $summary = iconv("windows-1251", "UTF-8", $summary);

$arResult["NAME_COURSE"] =  iconv("windows-1251", "UTF-8", $arResult["NAME_COURSE"]);
	$begintime = $arResult['PROPERTIES']['startdate']['VALUE'];
	$format = "DD.MM.YYYY HH:MI:SS";
	$arr = ParseDateTime($begintime, $format);
	$arr["HH"] = $arTimeOfBeginingHH;
	$arr["MI"] = $arTimeOfBeginingMM;


	$endtime = $arResult['PROPERTIES']['enddate']['VALUE'];
	$format = "DD.MM.YYYY HH:MI:SS";
	$arrEnd = ParseDateTime($endtime, $format);
	$arrEnd["HH"] = $arTimeOfEndHH;
	$arrEnd["MI"] = $arTimeOfEndMM;


	$location = iconv("windows-1251", "UTF-8", $city_name);
	$v = new vcalendar();
	$v->setProperty( "X-WR-TIMEZONE", "Europe/Moscow" );

$e = new vevent(); // initiate a new EVENT
$e->setProperty( 'categories'
               , 'LUXOFT-TRAINING.RU' );  // catagorize
$e->setProperty( 'dtstart'
               ,  $arr["YYYY"], $arr["MM"], $arr["DD"], $arr["HH"], $arr["MI"], $arr["SS"] );

$e->setProperty( 'dtend'
               ,  $arrEnd["YYYY"], $arrEnd["MM"], $arrEnd["DD"], $arrEnd["HH"], $arrEnd["MI"], $arrEnd["SS"] );

$e->setProperty( 'description'
               , $description );    // describe the event
                   // locate the event
//$e->setProperty( 'attendee', EMAIL_ADDRESS );
$e->setProperty('summary', $summary );
$e->setProperty( 'LOCATION' , $location );

//$e->setProperty('summary', $course_tr_summary );
$a = new valarm();                             // initiate ALARM
$a->setProperty( 'action'
               , 'DISPLAY' );                  // set what to do
$a->setProperty( 'description'
               , $description );          // describe alarm
$a->setProperty( 'trigger'
               , array( 'week' => 1, 'day' => 1 ));        // set trigger one week before
$e->setComponent( $a );                        // add alarm component to event component as subcomponent

$v->addComponent( $e );
$v->setConfig( "unique_id", "luxoft-training.ru" );                         // add component to calendar
$v->setConfig( "filename", "luxoft-training-event-".$arResult['ID'].".ics" );


$v->saveCalendar();
$v->returnCalendar();



?>

