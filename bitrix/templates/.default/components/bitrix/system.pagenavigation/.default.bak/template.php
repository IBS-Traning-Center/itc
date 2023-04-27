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
<style type="text/css">
div.navigation-lux-style { line-height:200%; }
div.navigation-lux-style a { padding:3px 4px; }
span.nav-current-page
{
   background-color:#e8e9ec;
   padding:3px 4px;
}
div.navigation-lux-style span.disabled { color:#999; }
div.navigation-lux-style span.arrow { }
div.navigation-lux-style span.ctrl  { }
</style>
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
         <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" id="next_page">&larr;</a>
      <?else:?>
         <?if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):?>
            <a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" id="next_page">&larr;</a>
         <?else:?>
            <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" id="next_page">&larr;</a>
         <?endif?>
      <?endif?>
   <?else:?>
      <span class="disabled"><span class="arrow"></span>
      <span class="ctrl"></span>
     </span>
   <?endif?>

   <?if ($arResult["NavPageNomer"] > 1):?>
      <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"  id="previous_page">&rarr;</a>
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
         <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" id="next_page">&larr;</a>
      <?else:?>
         <?if ($arResult["NavPageNomer"] > 2):?>
            <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" id="next_page">&larr;</a>
         <?else:?>
            <a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" id="next_page">&larr;</a>
         <?endif?>
      <?endif?>
   <?else:?>
      <span class="disabled">
      <span class="arrow"></span>
      	<span class="ctrl"></span>
     	 &larr;
      </span>
   <?endif?>


   <?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
      <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
         <span class="nav-current-page"><?=$arResult["nStartPage"]?></span>
      <?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
         <a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a>
      <?else:?>
         <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
      <?endif?>
      <?$arResult["nStartPage"]++?>
   <?endwhile?>




   <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
      <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" id="previous_page">&rarr;</a>
      <span class="ctrl"></span><span class="arrow"></span>
   <?else:?>
      <span class="disabled">&rarr;
      <span class="ctrl"></span><span class="arrow"></span></span>
   <?endif?>


<?endif?>

</div>