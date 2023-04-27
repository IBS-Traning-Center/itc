<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<?
/*
if($section_php = $APPLICATION->GetFileRecursive(".section.php"))
{
   @include($_SERVER['DOCUMENT_ROOT'].$section_php);
   $path= $_SERVER["REQUEST_URI"];
   if (strstr($path, '/performance/')) {
       echo "<h2>Performance Services</h2>"; } else  {
       echo "<h2>$sSectionName</h2>"; }
} */
?><ul>

   <?foreach($arResult as $arItem):?>
      <?if($arItem["SELECTED"]):?>
        <?if($arItem["PARAMS"]["vip"]=='3') { ?>
         <li class="selectedvip"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
<style type="text/css">

#left_menu li.selected a{
	background-color: #FFFFFF;
	color:#5C6590;
}
</style>

         <? } else { ?>
         <li class="selected"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
         <? }  ?>

      <?else:?>
        <?if($arItem["PARAMS"]["vip"]=='3') { ?>
         <li class="vip"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
         <? } else { ?>
         <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
         <? }  ?>

      <?endif?>
   <?endforeach?>
   </ul>

<?endif?>