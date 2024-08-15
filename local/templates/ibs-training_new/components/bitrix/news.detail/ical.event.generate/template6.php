<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
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
		$lecturer = $arResult['PROPERTIES']['lecturer']['VALUE'];
		$startdate = $arResult['PROPERTIES']['startdate']['VALUE'];
		$startdateGlobal = $startdate;
		//$description = nl2br($arResult['PROPERTIES']['description']['VALUE']);
		$description = nl2br(strip_tags($arResult['PROPERTIES']['description']['~VALUE']));
		$description = mb_convert_encoding($description, "UTF-8", "CP1251");
		$location = mb_convert_encoding($location, "UTF-8", "CP1251");

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
$datetime = $startdate;
$format = "DD.MM.YYYY HH:MI:SS";
//echo "Исходное время: ".$datetime."<br>";
//echo "Формат: ".$format."<hr>";
$arr = ParseDateTime($datetime, $format);

///    echo "День:    ".$arr["DD"]."<br>";    // День: 21
//    echo "Месяц:   ".$arr["MM"]."<br>";    // Месяц: 1
//    echo "Год:     ".$arr["YYYY"]."<br>";  // Год: 2004
//    echo "Часы:    ".$arr["HH"]."<br>";    // Часы: 23
//    echo "Минуты:  ".$arr["MI"]."<br>";    // Минуты: 44
//    echo "Секунды: ".$arr["SS"]."<br>";    // Секунды: 15



require_once $_SERVER['DOCUMENT_ROOT']."/bitrix/php_interface/ical/iCalcreator.class.php";
$v = new vcalendar();                          // initiate new CALENDAR

$e = new vevent();                             // initiate a new EVENT
$e->setProperty( 'categories'
               , 'LUXOFT-TRAINING.RU-EVENT' );                   // catagorize
$e->setProperty( 'dtstart'
               ,  $arr["YYYY"], $arr["MM"], $arr["DD"], $arr["HH"], $arr["MI"], $arr["SS"] );  // 24 dec 2006 19.30
$e->setProperty( 'duration'
               , 0, 0, 3 );                    // 3 hours
$e->setProperty( 'description'
               , $description );    // describe the event
$e->setProperty( 'location'
               , $location );                     // locate the event
$v->addComponent( $e );
$v->setConfig( "unique_id", "luxoft-training.ru" );                         // add component to calendar
$v->setConfig( "filename", "event-".$arResult['ID'].".ics" );
$v->saveCalendar();
$v->returnCalendar();
    //header( "Location: file.ics" );
  // exit();
/*$a = new valarm();                             // initiate ALARM
$a->setProperty( 'action'
               , 'DISPLAY' );                  // set what to do
$a->setProperty( 'description'
               , 'Buy X-mas gifts' );          // describe alarm
$a->setProperty( 'trigger'
               , array( 'week' => 1 ));        // set trigger one week before

$e->setComponent( $a );                        // add alarm component to event component as subcomponent*/


/* alt. production */
// $v->returnCalendar();                       // generate and redirect output to user browser
/* alt. dev. and test */
//$str = $v->createCalendar();                   // generate and get output in string, for testing?
//echo $str;


?><?/*

<div class="news-detail">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img class="detail_picture" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" />
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h3><?=$arResult["NAME"]?></h3>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
 	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
 	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<div style="clear:both"></div>
	<br />
	<?foreach($arResult["FIELDS"] as $code=>$value):?>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
			<br />
	<?endforeach;?>
	<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
		<br />
	<?endforeach;?>
</div>*/?>

