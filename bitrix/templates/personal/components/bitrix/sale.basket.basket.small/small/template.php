<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arResult["READY"]=="Y" || $arResult["DELAY"]=="Y" || $arResult["NOTAVAIL"]=="Y" || $arResult["SUBSCRIBE"]=="Y"):?>

	<?if ($arResult["READY"]=="Y"):?>
		
		<?
		$t=0;
		foreach ($arResult["ITEMS"] as $v)
		{
			if ($v["DELAY"]=="N" && $v["CAN_BUY"]=="Y")
			{
				
			$t++;	
				
			}
		}
		?>
	<?endif?>
<?endif;?>
<a href="/personal/cart/" class="cart"><span><?=intval($t)?></span></a>