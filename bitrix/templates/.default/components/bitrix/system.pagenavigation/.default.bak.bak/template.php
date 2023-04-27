<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"])
{
   if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
      return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

?>

<script type="text/javascript">
document.onkeydown = PageNavigation;
function PageNavigation (event)
{
   if (!document.getElementById)
      return;
   if (window.event)
      event = window.event;
   if (event.ctrlKey)
   {
      var key = (event.keyCode ? event.keyCode : (event.which ? event.which : null) );
      if (!key)
         return;

      var link = null;
      if (key == 37)
         link = document.getElementById('next_page');
      else if (key == 39)
         link = document.getElementById('previous_page');

      if (link && link.href)
         document.location = link.href;
   }
}
</script>
<div class="navigation-lux-style">

<?if($arResult["bDescPageNumbering"] === true):?>



   <?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
      <span class="arrow"><</span><span class="ctrl"></span>
      <?if($arResult["bSavePage"]):?>
         <a  href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" class="prev-arrow" id="next_page"></a>
      <?else:?>
         <?if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):?>
            <a  href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="prev-arrow" id="next_page"></a>
         <?else:?>
            <a  href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" class="prev-arrow"  id="next_page"></a>
         <?endif?>
      <?endif?>
   <?else:?>
      <span class="prev-arrow disabled"></span>
   <?endif?>

   <?if ($arResult["NavPageNomer"] > 1):?>
      <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" class="prev-arrow " id="previous_page"></a>
      <span class="ctrl"></span><span class="arrow"></span>
   <?else:?>
      <span class="disabled">
      <span class="ctrl"></span><span class="arrow">&rarr;</span></span>
   <?endif?>

   <br />

   <?while($arResult["nStartPage"] >= $arResult["nEndPage"]):?>
      <?$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;?>
      <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
         <span class="nav-current-page"><?=$NavRecordGroupPrint?></span>
      <?elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):?>
         <a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a>
      <?else:?>
         <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a>
      <?endif?>
      <?$arResult["nStartPage"]--?>
   <?endwhile?>

<?else:?>


   <?if ($arResult["NavPageNomer"] > 1):?>
      <span class="arrow"></span><span class="ctrl"></span>
      <?if($arResult["bSavePage"]):?>
         <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" class="prev-arrow " id="next_page"></a>
      <?else:?>
         <?if ($arResult["NavPageNomer"] > 2):?>
            <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" class="prev-arrow " id="next_page"></a>
         <?else:?>
            <a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="prev-arrow " id="next_page"></a>
         <?endif?>
      <?endif?>
   <?else:?>
      <span class="prev-arrow disabled">

      </span>
   <?endif?>


   <?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
      <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
         <span class="nav-current-page"><?=$arResult["nStartPage"]?></span>
      <?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
         <a class="nav-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a>
      <?else:?>
         <a class="nav-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
      <?endif?>
      <?$arResult["nStartPage"]++?>
   <?endwhile?>




   <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
      <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" class="next-arrow" id="previous_page"></a>
      <span class="ctrl"></span><span class="arrow"></span>
   <?else:?>
      <span class="next-arrow disabled">
      </span>
   <?endif?>


<?endif?>

</div>