<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-list">

<TABLE cellSpacing=1 cellPadding=5 bgColor=gray border=0 сlass="">
<TR bgColor=#ebebeb>
<TD vAlign=top>
<P align=center><NOBR>Код</NOBR></P></TD>
<TD vAlign=top width="100%">
<P align=left>Название курса</P></TD>
<TD vAlign=center width=70 VALIGN="middle">
<P align=center><NOBR>Продол-ть</NOBR></P></TD>
<TD vAlign=center width=70 VALIGN="middle">
<P align=center>Цена</P></TD></TR>

<?foreach($arResult["ITEMS"] as $arItem):?>
	<p class="news-item">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img class="preview_picture" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["NAME"]?>" style="float:left" /></a>
		<?endif?>
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
		<?endif?>


		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<?echo $arItem["PREVIEW_TEXT"];?>
		<?endif;?>
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<div style="clear:both"></div>
		<?endif?>
		<?foreach($arItem["FIELDS"] as $code=>$value):?>
			<small>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
			</small><br />
		<?endforeach;?>
        <?
          $course_code = $arItem['PROPERTIES']['course_code']['VALUE'];
	      $course_duration = $arItem['PROPERTIES']['course_duration']['VALUE'];
	      $course_price = $arItem['PROPERTIES']['course_price']['VALUE'];
	      $course_id = $arItem["ID"];
	      $arFilter = array();
 		  $arSort = array();
 		  $data  = date("d.m.Y");
    	  $arSort["PROPERTY_schedule_startdate"] = "ASC";
	      $arFilter["PROPERTY_schedule_course"] = $course_id;
	      $arFilter[">=PROPERTY_schedule_startdate"] = CDatabase::FormatDate("$data", CLang::GetDateFormat("FULL"), "YYYY-MM-DD HH:MI:SS");
	      $items2 = GetIBlockElementList(9, false, $arSort, 1, $arFilter );
	      $schedule_startdate ="";
	    while($arItem2 = $items2->GetNext())
	   {
	   	  $ID2 = $arItem2["ID"];
	      $arIBlockElement = GetIBlockElement($ID2);

         // $course_city = strip_tags($arIBlockElement['DISPLAY_PROPERTIES']['schedule_city']['DISPLAY_VALUE']);
          $course_city = $arIBlockElement['PROPERTIES']['schedule_city']['VALUE'];
	      $schedule_startdate = $arIBlockElement['PROPERTIES']['schedule_startdate']['VALUE'];
          //получим город по его ID = $course_city
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
<P align=left>
<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
	<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a>
	<?else:?>
<b><?echo $arItem["NAME"]?></b><br />
	<?endif;?>
<?endif;?>
<? if(!$schedule_startdate=="")  {  ?><BR>Ближайший курс: <?=$schedule_startdate?> г. <?=$city?><? } ?></P></TD>
</P></TD>
<TD vAlign=center width=70 VALIGN="middle">
<P align=right><NOBR><?=$course_duration?> час.</NOBR></P></TD>
<TD vAlign=center width=70 VALIGN="middle">
<P align=right><NOBR><?=$course_price?> руб.</NOBR></P></TD></TR>



	</p>
<?endforeach;?>
</TABLE>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
