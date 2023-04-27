<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
require_once $_SERVER['DOCUMENT_ROOT']."/bitrix/php_interface/ical/iCalcreator.class.php";
		$seminar_name = $arResult["NAME"];
		$typeEventName = "Семинар";
		if ($arResult["PROPERTIES"]["type_event"]["VALUE_ENUM_ID"]==92){
			$typeEventName = "Вебинар";
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
		$seminar_id = $arResult["ID"];
		$location = $arResult['PROPERTIES']['location']['VALUE'];
		//$location = iconv("windows-1251", "UTF-8", $location);
		$lecturer = $arResult['PROPERTIES']['lecturer']['VALUE'];
		$startdate = $arResult['PROPERTIES']['startdate']['VALUE'];
		$startdateGlobal = $startdate;
		$icallocation= "Вебинар, проводимый с  использованием сервиса gotomeeting.com";
		$icallocation = iconv("windows-1251", "UTF-8", $icallocation);

		$content = nl2br($arResult['PROPERTIES']['content']['VALUE']);
		$people = nl2br($arResult['PROPERTIES']['people']['VALUE']);
		$time = $arResult['PROPERTIES']['time']['VALUE'];
		$titlefile = $arResult['PROPERTIES']['titlefile']['VALUE'];
		$city_id = $arResult['PROPERTIES']['city']['VALUE'];
		$arSelect = Array("NAME");
		$arFilter = Array("IBLOCK_ID"=>"51","ID"=>$city_id);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
			$city_name= $ar_fields["NAME"];
		}
		$course_tr_summary = $typeEventName.": ".$seminar_name;
		$course_tr_summary = iconv("windows-1251", "UTF-8", $course_tr_summary);
		$description .= $typeEventName.": ".$seminar_name."\n\n";
		if(strlen($arResult["DETAIL_TEXT"])>1)  {
			//$description .= "\n". $arResult["DETAIL_TEXT"]."\n\n";
		}
		 if(!$startdate=="")  {
		 	//$description .= "<span class='st'>Дата проведения:</span>";
		    //$description .= "<p class='indent'>".$startdate."</p>";
		 	$description .= "Дата проведения\n";
		    $description .= $startdate."\n\n";
		 }
		 if(!$time=="")  {
		 	//$description .= "<span class='st'>Время:</span>";
		    //$description .= "<p class='indent'>".$time."</p>";
		 	$description .= "Время\n";
		    $description .= $time."\n\n";
		 }

		 if(!$location=="")  {
		 	//$description .= "<span class='st'>Место проведения:</span>";
		    //$description .= "<p class='indent'>".$location."</p>";
		 	$description .= "Место проведения:\n";
		 	//$location = iconv("windows-1251", "UTF-8", $location);
		    $description .= $location."\n\n";
		 }
		if(strlen($arTrener["SURNAME"])>0)  {
		 	//$description .= "<span class='st'>Докладчик:</span>";
		    //$description .= "<p class='indent'><a href='/about/experts/".$arTrener['CODE'].".html\">".$arTrener['SURNAME']." ".$arTrener["NAME"]."</a> &mdash;".$arTrener["DESC"]."</p>";
		    $description .= "Докладчик:\n";
		    $description .= " ".$arTrener['SURNAME']." ".$arTrener["NAME"]." -".$arTrener["DESC"]."\n\n";
		 }

       $description .=  $arResult['PROPERTIES']['description']['~VALUE']."\n\n";
        $wordReg  =  "Регистрация:";
       // $wordReg = iconv("windows-1251", "UTF-8", $wordReg);
	 	$description .= $wordReg."\n";
	    $description .= "http://www.luxoft-training.ru/events/seminar/".$arResult['ID']."/\n\n";
       //$description = mb_convert_encoding($description, "UTF-8", "CP1251");
       $description = iconv("windows-1251", "UTF-8", $description);

$datetime = $startdate;
$format = "DD.MM.YYYY HH:MI:SS";

$arr = ParseDateTime($datetime, $format);

//    echo "День:    ".$arr["DD"]."<br>";    // День: 21
//    echo "Месяц:   ".$arr["MM"]."<br>";    // Месяц: 1
//    echo "Год:     ".$arr["YYYY"]."<br>";  // Год: 2004
//    echo "Часы:    ".$arr["HH"]."<br>";    // Часы: 23
//    echo "Минуты:  ".$arr["MI"]."<br>";    // Минуты: 44
//    echo "Секунды: ".$arr["SS"]."<br>";    // Секунды: 15


$location = iconv("windows-1251", "UTF-8", $location);
$v = new vcalendar();
//$v->setProperty( "x-wr-calname", "" );
//$v->setProperty( "X-WR-CALDESC", "Calendar Luxoft-training.ru Events" );
$v->setProperty( "X-WR-TIMEZONE", "Europe/Moscow" );

$e = new vevent(); // initiate a new EVENT
$e->setProperty( 'categories'
               , 'LUXOFT-TRAINING.RU' );  // catagorize
$e->setProperty( 'dtstart'
               ,  $arr["YYYY"], $arr["MM"], $arr["DD"], $arr["HH"], $arr["MI"], $arr["SS"] );  // 24 dec 2006 19.30
//$e->setProperty( 'duration'
//               , 0, 0, 3 );                    // 3 hours
$e->setProperty( 'description'
               , $description );    // describe the event
                   // locate the event
if ($typeEventName === "Вебинар"){
	$e->setProperty( "location", $icallocation);
}else {
	$e->setProperty( 'location' , $location );
}
//$e->setProperty('attendee', EMAIL_ADDRESS );
$e->setProperty('summary', $course_tr_summary );


$a = new valarm();                             // initiate ALARM
$a->setProperty( 'action'
               , 'DISPLAY' );                  // set what to do
$a->setProperty( 'description'
               , $course_tr_summary );          // describe alarm
$a->setProperty( 'trigger'
               , array( 'week' => 1 ));        // set trigger one week before
$a->setProperty( 'trigger'
               , array( 'day' => 1 ));        // set trigger one week before
$e->setComponent( $a );                        // add alarm component to event component as subcomponent*/

$v->addComponent( $e );
$v->setConfig( "unique_id", "luxoft-training.ru" );                         // add component to calendar
$v->setConfig( "filename", "luxoft-training-event-".$arResult['ID'].".ics" );


$v->saveCalendar();
$v->returnCalendar();
/* alt. production */
// $v->returnCalendar();                       // generate and redirect output to user browser
/* alt. dev. and test */
//$str = $v->createCalendar();                   // generate and get output in string, for testing?
//echo $str;


?>

