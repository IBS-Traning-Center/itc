<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?if ($arResult["READY"]=="Y" || $arResult["DELAY"]=="Y" || $arResult["NOTAVAIL"]=="Y") {?>

	<?$SUM = 0;?>
	<?$QUANTITY = 0;?>
	<?if ($arResult["READY"]=="Y"):
		foreach ($arResult["ITEMS"] as $v)
		{
			if ($v["DELAY"]=="N" && $v["CAN_BUY"]=="Y")
			{
				$SUM += $v['PRICE'] * $v['QUANTITY'];
				$QUANTITY += $v['QUANTITY'];	
				$CURRENCY = $v['CURRENCY'];
			}
		}
	endif;?>	
		
	<a href="<?=$arParams['PATH_TO_BASKET']?>" title="Корзина">Корзина (
			
				<?if ($arResult["READY"] == "Y"): ?>			
					<?=intval($QUANTITY)?> <?=getCountVal(intval($QUANTITY), array(GetMessage('QUANTITY_1'), GetMessage('QUANTITY_2'), GetMessage('QUANTITY_3'))) ?> <?=GetMessage('SUM') ?> <?=FormatCurrency($SUM, $CURRENCY) ?>
				<?elseif ($arResult["DELAY"] == "Y" && $arResult["NOTAVAIL"] == "Y"): ?>
					<?=GetMessage("DELAY_AND_NOTAVAIL_PRODUCTS") ?>
				<?elseif ($arResult["DELAY"] == "Y"): ?>
					<?=GetMessage("DELAY_PRODUCTS") ?>
				<?elseif ($arResult["NOTAVAIL"] == "Y"): ?>
					<?=GetMessage("NOTAVAIL_PRODUCTS") ?>
				<?endif; ?>
	) </a>	


	<? /*
	<li class="nowrap">
			<?if ($arResult["READY"]=='Y'):?>
					<?if (strlen($arParams["PATH_TO_ORDER"])>0):?>
						<a href="<?=$arParams["PATH_TO_ORDER"] ?>" title="<?=GetMessage("TSBS_2ORDER") ?>"><?=GetMessage("TSBS_2ORDER") ?></a>		
					<?endif;?>
					<!--<p class="gray"><span>&middot;</span>&nbsp;&nbsp;<a href="#TB_inline?width=550&height=550&inlineId=LinkToFForm&modal=true" id="LinkToF2" title="<?=GetMessage("LINK_TO_FRIEND") ?>" class="thickbox"><?=GetMessage("LINK_TO_FRIEND") ?></a></p>-->
				<?endif;?>
	</li>*/?>
<? } else {?>
<a href="<?=$arParams['PATH_TO_BASKET']?>" title="Ваша корзина пуста">Корзина (0)</a>
<?  }?>
