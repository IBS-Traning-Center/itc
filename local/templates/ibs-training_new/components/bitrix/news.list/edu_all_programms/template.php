<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-list">
<TABLE cellSpacing=1 cellPadding=5 width=460 bgColor=gray border=0 сlass="">

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<? $i=0; ?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<p class="news-item">
	<? $i=$i+1; ?>

        <?

          $code = $arItem['PROPERTIES']['code']['VALUE'];
	      $duration = $arItem['PROPERTIES']['duration']['VALUE'];
	      $price = $arItem['PROPERTIES']['price']['VALUE'];
	      $prog_id  =  $arItem["ID"];
	      $arFilter = array();
 		  $arSort = array();
 		  $data  = date("d.m.Y");
         //$arFilter[">=PROPERTY_birthday"] = CDatabase::FormatDate("01.01.1967", CLang::GetDateFormat("FULL"), "YYYY-MM-DD HH:MI:SS");
 		 // $arSort["DATE_ACTIVE_FROM"] = "ASC";
 		  $arSort["PROPERTY_prschedule_startdate"] = "ASC";
	      $arFilter["PROPERTY_prschedule_program"] = $prog_id;
	      $arFilter[">=PROPERTY_prschedule_startdate"] = CDatabase::FormatDate("$data", CLang::GetDateFormat("FULL"), "YYYY-MM-DD HH:MI:SS");
	      $items = GetIBlockElementList(10, false, $arSort, 1, $arFilter );
	      $prschedule_startdate= "";
	    while($arItem2 = $items->GetNext())
	   {
	   	  $ID2 = $arItem2["ID"];
	      $arIBlockElement = GetIBlockElement($ID2);
	     // print_r($arIBlockElement);
          $course_city = strip_tags($arIBlockElement['PROPERTIES']['prschedule_city']['VALUE']);
	      $prschedule_startdate = $arIBlockElement['PROPERTIES']['prschedule_startdate']['VALUE'];
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
<?
 if ($i % 2 <> 1)
        { ?> <TR bgColor=white> <? }
        else
        { ?> <TR bgColor=#ebebeb> <? } ?>
<TD><NOBR><?=$code?></NOBR></TD>
<TD width="100%">
<P align=left>
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
			<?else:?>
				<b><?echo $arItem["NAME"]?></b><br />
			<?endif;?>
		<?endif;?>
<? if(!$prschedule_startdate=="")  {  ?>Ближайший курс: <?=$prschedule_startdate?> г. <?=$city?><? } ?></P></TD>
<TD width=150>
<P align=left><NOBR><?=$duration?> час.</NOBR></P></TD>
<TD><NOBR><?=$price?> р.</NOBR></TD></TR>


      <!--
		<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
			<small>
			<?=$arProperty["NAME"]?>:&nbsp;
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
			<?else:?>
				<?=$arProperty["DISPLAY_VALUE"];?>
			<?endif?>
			</small><br />
		<?endforeach;?>     -->
	</p>
<?endforeach;?>
</TABLE>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
