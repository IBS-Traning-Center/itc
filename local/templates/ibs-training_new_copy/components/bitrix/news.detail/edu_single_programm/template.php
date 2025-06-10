<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


    <?
	      $program_name = $arResult["NAME"];
	      $program_id = $arResult["ID"];
	      $price = $arResult['PROPERTIES']['price']['VALUE'];
	      $code = $arResult['PROPERTIES']['code']['VALUE'];
	      $duration = $arResult['PROPERTIES']['duration']['VALUE'];
	      $description = nl2br($arResult['PROPERTIES']['description']['VALUE']['TEXT']);
	      $courses = $arResult['PROPERTIES']['courses']['VALUE'];
	      $header = $arResult['PROPERTIES']['header']['VALUE'];

	      ?>
<?=$description?> <BR /><BR />
<table cellSpacing=1 cellPadding=5  border=0 сlass="edu">
<tr>
<td>Код</td>
<td vAlign=top width="100%">
<p align=left>Название курса</p></td>
<td vAlign=center width=70 VALIGN="middle">
<P align=center><NOBR>Продол-ть</NOBR></P></td>
<td vAlign=center width=70 VALIGN="middle">
<P align=center>Цена</P></TD></TR>
	      	<?foreach($courses as $key=>$value):?>

			<?
		  $arFilter = array();
 		  $arSort = array();
 		  $arFilter["ID"] = $value;
	      $items = GetIBlockElementList(6, false, $arSort, 1, $arFilter );
	    while($arItem = $items->GetNext())
	   {
	   	  $ID = $arItem["ID"];
	   	  $NAME = $arItem["NAME"];
	      $arIBlockElement = GetIBlockElement($ID);

          $course_code = strip_tags($arIBlockElement['PROPERTIES']['course_code']['VALUE']);
	      $course_price = strip_tags($arIBlockElement['PROPERTIES']['course_price']['VALUE']);
	      $course_duration= strip_tags($arIBlockElement['PROPERTIES']['course_duration']['VALUE']);

	   }

	      //$course_id2 = $ID;
	      $arFilter2 = array();
 		  $arSort2 = array();
 		  $data  = date("d.m.Y");
    	  $arSort2["PROPERTY_schedule_startdate"] = "ASC";
	      $arFilter2["PROPERTY_schedule_course"] = $ID;
	      $arFilter2[">=PROPERTY_schedule_startdate"] = CDatabase::FormatDate("$data", CLang::GetDateFormat("FULL"), "YYYY-MM-DD HH:MI:SS");
	      $items2 = GetIBlockElementList(9, false, $arSort2, 1, $arFilter2 );
	      $schedule_startdate ="";
	    while($arItem2 = $items2->GetNext())
	   {
	   	  $ID2 = $arItem2["ID"];
	      $arIBlockElement = GetIBlockElement($ID2);
	     // print_r($arIBlockElement);
          $course_city = strip_tags($arIBlockElement['PROPERTIES']['schedule_city']['VALUE']);
	      $schedule_startdate = $arIBlockElement['PROPERTIES']['schedule_startdate']['VALUE'];
          $arFilterCity = array();
 		  $arSortCity = array();
 		  $arFilterCity["ID"] = $course_city;
	      $itemsCity = GetIBlockElementList(4, false, $arSortCity, 1, $arFilterCity );

	     while($arItemCity = $itemsCity->GetNext())
	     {
	     	$city = $arItemCity["NAME"];
	     }
	   }



	   ?>

<TR bgColor=white>
<TD vAlign=top><NOBR><?=$course_code?></NOBR></TD>
<TD vAlign=top width="100%">
<P align=left><a href="/ru/edu/catalog/course.php?ID=<?=$ID?>"><?=$NAME?></a>
<? if(!$schedule_startdate=="")  {  ?><BR>Ближайший курс: <?=$schedule_startdate?> г. <?=$city?><? } ?></P></TD>

</P></TD>
<TD vAlign=center width=70 VALIGN="middle">
<P align=right><NOBR><?=$course_duration?> час.</NOBR></P></TD>
<TD vAlign=center width=70 VALIGN="middle">
<P align=right><NOBR><?=$course_price?> руб.</NOBR></P></TD></TR>
			<?endforeach;?>
</TABLE>




