<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="cart-items" id="id-shelve-list" style="display:none;">
	<div class="inline-filter cart-filter">
		<label><?=GetMessage("SALE_PRD_IN_BASKET")?></label>&nbsp;
			<a href="#" class="ajax_link"  onclick="ShowBasketItems(1);"><?=GetMessage("SALE_PRD_IN_BASKET_ACT")?> (<?=count($arResult["ITEMS"]["AnDelCanBuy"])?>)</a>&nbsp;
			<b><?=GetMessage("SALE_PRD_IN_BASKET_SHELVE")?></b>&nbsp;
			<?if(false):?>
				<a href="#" class="ajax_link"  onclick="ShowBasketItems(3);"><?=GetMessage("SALE_PRD_IN_BASKET_NOTA")?> (<?=count($arResult["ITEMS"]["nAnCanBuy"])?>)</a>
			<?endif;?>
	</div>
	<?if(count($arResult["ITEMS"]["DelDelCanBuy"]) > 0):?>
	<table class="cart-items" cellspacing="0">
	<thead>
		<tr>
			<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-name"><?= GetMessage("SALE_NAME")?></td>
			<?endif;?>
			<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-price"><?= GetMessage("SALE_PRICE")?></td>
			<?endif;?>
			<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-type"><?= GetMessage("SALE_PRICE_TYPE")?></td>
			<?endif;?>
			<?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-discount"><?= GetMessage("SALE_DISCOUNT")?></td>
			<?endif;?>
			<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-weight"><?= GetMessage("SALE_WEIGHT")?></td>
			<?endif;?>
			<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-quantity"><?= GetMessage("SALE_QUANTITY")?></td>
			<?endif;?>
			<td class="cart-item-actions">
				<?if (in_array("DELETE", $arParams["COLUMNS_LIST"]) || in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
					<?= GetMessage("SALE_ACTION")?>
				<?endif;?>
			</td>
		</tr>
	</thead>
	<tbody>
	<?
	foreach($arResult["ITEMS"]["DelDelCanBuy"] as $arBasketItems)
	{
		?>
		<tr>
			<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
				<?foreach ($arBasketItems["PROPS"] as $arServiceTemp) {?>
					<?
					$arService[$arServiceTemp['NAME']] = $arServiceTemp["VALUE"];
					?>
				<?}?>
				<td class="cart-item-name">
				<?if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0){ ?>
					<a class="orange" href="<?=$arBasketItems["DETAIL_PAGE_URL"] ?>">
				<? } ?>
				<?=$arService["COURSE_CODE"]?><?if
					 (strlen($arBasketItems["DETAIL_PAGE_URL"])>0){?></a>
				<? } ?>

				<?if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0){ ?>
					<a class="orange" href="<?=$arBasketItems["DETAIL_PAGE_URL"] ?>">
				<? } ?>
					<?=$arBasketItems["NAME"] ?>
				<?if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0){?>
					</a>
				<? } ?>


                <br />
					  <?=$arService["CITY_NAME"]?> <b><?=$arService["STARTDATE"]?>  <?=$arService["SCHEDULE_TIME"]?></b>
				</td>
			<?endif;?>
			<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-price"><?=$arBasketItems["PRICE_FORMATED"]?></td>
			<?endif;?>
			<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-type"><?=$arBasketItems["NOTES"]?></td>
			<?endif;?>
			<?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-discount"><?=$arBasketItems["DISCOUNT_PRICE_PERCENT_FORMATED"]?></td>
			<?endif;?>
			<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-weight"><?=$arBasketItems["WEIGHT_FORMATED"]?></td>
			<?endif;?>
			<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-quantity"><?=$arBasketItems["QUANTITY"]?></td>
			<?endif;?>
			<td class="cart-item-actions">
				<?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
					<a class="cart-delete-item" href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["delete"])?>" title="<?=GetMessage("SALE_DELETE_PRD")?>"></a>
				<?endif;?>
				<?if (in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
					<a class="cart-shelve-item" href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["add"])?>"><?=GetMessage("SALE_ADD_CART")?></a>
				<?endif;?>
			</td>
		</tr>
		<?
	}
	?>
	</tbody>
</table>
<?endif;?>
</div>
<?