<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<ul id="nav">
<?if (!empty($arResult)):?>
<?  $previousLevel = 0;
foreach($arResult as $key=>$arItem):?>
	<? //iwrite($arItem);
	?>
	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>
	<?if ($arItem["IS_PARENT"]):?>
		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="first<?if ($key=="0") {?> start<?}?><?if ($arItem["SELECTED"]):?> selected<?endif?>"><a href="<?=$arItem["LINK"]?>" class="<?if ($key=="0") {?>home<?}?>"><?if ($key!="0") {?><?=$arItem["TEXT"]?><?}?></a>
				<ul class="inner">
		<?else:?>
			<li ><a href="<?=$arItem["LINK"]?>" > <?=$arItem["TEXT"]?><? echo "&nbsp;"; ?> <img src="/bitrix/templates/.default/en/images/arr4.gif" alt=""  /></a>
				<ul class="inner">
		<?endif?>
	<?else:?>
		<?if ($arItem["PERMISSION"] > "D"):?>
			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="first<?if ($key=="0") {?> start<?}?> <?if ($arItem["SELECTED"]):?>selected<?endif?> "><a class="<?if ($key=="0") {?>home<?}?>" href="<?=$arItem["LINK"]?>"><?if ($key!="0") {?><?=$arItem["TEXT"]?><?}?></a></li>
			<?else:?>
				<li <?if ($arItem["SELECTED"]):?> class="selected"<?endif?>><a href="<?=$arItem["LINK"]?>" <?if($arItem["PARAMS"]["new_window"] == 'Y'){?>target="_blank"<? } ?>><?=$arItem["TEXT"]?></a></li>
			<?endif?>
		<?else:?>
			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>
		<?endif?>
	<?endif?>
	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
<?endforeach?>
<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>
  <? //print_r($arResult);
   ?>
<?endif?>
 </ul>