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
		  $prschedule_city = $arItem['PROPERTIES']['city']['VALUE'];
	      $prschedule_program_id = $arItem['PROPERTIES']['prschedule_program']['VALUE'];
	      $prschedule_startdate = $arItem['PROPERTIES']['prschedule_startdate']['VALUE'];
	      $prschedule_enddate = $arItem['PROPERTIES']['prschedule_enddate']['VALUE'];
	      $prschedule_time = $arItem['PROPERTIES']['prschedule_time']['VALUE'];
	      $prschedule_desc = $arItem['PROPERTIES']['prschedule_desc']['VALUE']['TEXT'];
	      $prog_id  =  $arItem["ID"];

 	      if ($prschedule_enddate == "")
        { } else
        {
            $prschedule_startdate .= "-" . $prschedule_enddate;
        }
          $arFilter = array();
 		  $arSort = array();
          $arFilter["ID"] = $prschedule_program_id;
          $items2 = GetIBlockElementList(8, false, $arSort, 1, $arFilter );

	    while($arItem2 = $items2->GetNext())
	   {
	   	  $ID2 = $arItem2["ID"];
	   	  //echo "ID2=$ID2";
	      $arIBlockElement = GetIBlockElement($ID2);
	      $code = strip_tags($arIBlockElement['PROPERTIES']['code']['VALUE']);
	      $price = strip_tags($arIBlockElement['PROPERTIES']['price']['VALUE']);
	      $duration = strip_tags($arIBlockElement['PROPERTIES']['duration']['VALUE']);
	      //echo "duration=$duration";
	   }
        ?>
<? if ($i % 2 <> 1)
        { ?><TR bgColor=#f7f7f7><? }
        else
        { ?><TR bgColor=white><? } ?>
<TD width="100%">
<P align=left>
<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="/ru/edu/programcontent.html?ID=<?=$prschedule_program_id ?>"><b><?echo $arItem["NAME"]?></b></a><br />
			<?else:?>
				<b><?echo $arItem["NAME"]?></b><br />
			<?endif;?>
		<?endif;?>
</P></TD>
<TD>
<P align=left><NOBR><?= $prschedule_startdate ?></NOBR></P></TD>
<TD>
<P align=left><NOBR><?= $duration ?> час.</NOBR></P></TD>
<TD>
<P align=left><NOBR><?= $prschedule_time ?></NOBR></P></TD>
<TD>
<P align=left><NOBR><?= $price ?> р.</NOBR></P></TD></TR>





	</p>
<?endforeach;?>
</TABLE>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
