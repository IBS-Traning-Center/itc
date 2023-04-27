<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<?
unset($arResult['menuType']);
unset($arResult['menuDir']);
?>
 <? $a=1 ;?>
 <ul class="side-nav">

   <?foreach($arResult as $arItem):?>
     <?  //iwrite($arItem);
?>
      <?if($arItem["SELECTED"]):?>
        <?if(($arItem["PARAMS"]["vip"]=='3') or ($arItem["PARAMS"]["vip"]=='4') or ($arItem["PARAMS"]["show_always"]=='Y') ) { ?>
         <li class="active <?if (strlen($arItem['PARAMS']['class_name'])>0) {?> <?=$arItem['PARAMS']['class_name']?><? } ?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			
         <? } else { ?>
         <?if($arItem["PARAMS"]["sub"]!=='1') { ?>
          <li class="active <?if ($arItem['PARAMS']['show_always']):?> vip<?endif?><?if (strlen($arItem['PARAMS']['class_name'])>0) {?> <?=$arItem['PARAMS']['class_name']?><? } ?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
          <? } ?>
          <?if($arItem["PARAMS"]["sub"]=='1') { ?>
          <li class="active indent minus <?if ($arItem['PARAMS']['show_always']):?> vip<?endif?><?if (strlen($arItem['PARAMS']['class_name'])>0) {?> <?=$arItem['PARAMS']['class_name']?><? } ?>"> <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
          <? } ?>
         <? $a=0;?>
         <? } ?>

      <?else:?>

         <?if(($arItem["PARAMS"]["vip"]=='3')and ( $a==0 )) { ?>
      		<li class="vip<?if (strlen($arItem['PARAMS']['class_name'])>0) {?> <?=$arItem['PARAMS']['class_name']?><? } ?>"><a href="<?=$arItem["LINK"]?>"  <?if($arItem["PARAMS"]["new_window"] == 'Y'){?>target="_blank"<? } ?>><?=$arItem["TEXT"]?></a></li>
         <? }  ?>
         <?if(($arItem["PARAMS"]["vip"]=='3')and ( strlen($arItem['PARAMS']['class_name'])>0 ) and ( $a!== 0 ) ) { ?>
      		<li class="vip<?if (strlen($arItem['PARAMS']['class_name'])>0) {?> <?=$arItem['PARAMS']['class_name']?><? } ?>"><a href="<?=$arItem["LINK"]?>"  <?if($arItem["PARAMS"]["new_window"] == 'Y'){?>target="_blank"<? } ?>><?=$arItem["TEXT"]?></a></li>
         <? }  ?>
		 
		 
         <?if(($arItem["PARAMS"]["vip"]!=='3') and ($arItem["PARAMS"]["sub"]=='1')) { ?>
         	<li class="indent<?if (strlen($arItem['PARAMS']['class_name'])>0) {?> <?=$arItem['PARAMS']['class_name']?><? } ?><?if ($arItem['PARAMS']['indent']):?> vert_indent<?endif?>"> <a href="<?=$arItem["LINK"]?>"  <?if($arItem["PARAMS"]["new_window"] == 'Y'){?>target="_blank"<? } ?>><?=$arItem["TEXT"]?></a></li>
         	<? $a=1 ;?>
         <? }  ?>

         <?if(($arItem["PARAMS"]["vip"]!=='3') and ($arItem["PARAMS"]["sub"]!=='1')  and ($arItem["PARAMS"]["vip"]!=='4') ) { ?>
         	<li class="<?if ($arItem["PARAMS"]["show_always"]):?>vip<?endif?><?if (strlen($arItem['PARAMS']['class_name'])>0) {?> <?=$arItem['PARAMS']['class_name']?><? } ?>"><a href="<?=$arItem["LINK"]?>"  <?if($arItem["PARAMS"]["new_window"] == 'Y'){?>target="_blank"<? } ?>><?=$arItem["TEXT"]?></a></li>
         <? $a=1 ;?>
         <? }  ?>

         <?if(($arItem["PARAMS"]["vip"]!=='3') and ($arItem["PARAMS"]["vip"]=='4')) { ?>
         	<li class="vip<?if (strlen($arItem['PARAMS']['class_name'])>0) {?> <?=$arItem['PARAMS']['class_name']?><? } ?>"><a href="<?=$arItem["LINK"]?>"  <?if($arItem["PARAMS"]["new_window"] == 'Y'){?>target="_blank"<? } ?>><?=$arItem["TEXT"]?></a></li>
         <? $a=1 ;?>
         <? }  ?>

      <?endif?>
   <?endforeach?>
   </ul>

<?endif?>