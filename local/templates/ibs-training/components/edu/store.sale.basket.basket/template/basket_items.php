<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script>
  $(document).ready(function(){
    $(".cart-oferta input#agree_oferta").change(function () {
       var bChecked =  $('.cart-oferta input#agree_oferta').attr('checked');
          if (bChecked){
                $("input#basketOrderButton2").removeAttr("disabled").removeClass("button_disabled").addClass("button_enabled");

          } else {
                $("input#basketOrderButton2").attr("disabled","disabled").removeClass("button_enabled").addClass("button_disabled");
          }
    })
  });

  </script>

<div class="cart-items" id="id-cart-list">
	<div class="inline-filter cart-filter">
		<label><?=GetMessage("SALE_PRD_IN_BASKET")?></label>&nbsp;
			<b><?=GetMessage("SALE_PRD_IN_BASKET_ACT")?></b>&nbsp;
			<a href="#" class="ajax_link"  onclick="ShowBasketItems(2);"><?=GetMessage("SALE_PRD_IN_BASKET_SHELVE")?> (<?=count($arResult["ITEMS"]["DelDelCanBuy"])?>)</a>&nbsp;
			<?if(false):?>
			<a href="#" class="ajax_link"  onclick="ShowBasketItems(3);"><?=GetMessage("SALE_PRD_IN_BASKET_NOTA")?> (<?=count($arResult["ITEMS"]["nAnCanBuy"])?>)</a>
			<?endif;?>
	</div>

	<?if(count($arResult["ITEMS"]["AnDelCanBuy"]) > 0):?>
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
	$i=0;
	foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arBasketItems)
	{
		?>
		<tr>

			<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
				<?foreach ($arBasketItems["PROPS"] as $arServiceTemp) {?>
					<?
					$arService[$arServiceTemp['NAME']] = $arServiceTemp["VALUE"];
					?>
				<?}?>
				<? //iwrite($arService);
				?>
				<td class="cart-item-name">
				<?if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0){ ?>
					<a href="<?=$arBasketItems["DETAIL_PAGE_URL"] ?>">
				<? } ?>
				<?=$arService["COURSE_CODE"]?><?if
					 (strlen($arBasketItems["DETAIL_PAGE_URL"])>0){?></a>
				<? } ?>

				<?if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0){ ?>
					<a href="<?=$arBasketItems["DETAIL_PAGE_URL"] ?>">
				<? } ?>
					<?=$arBasketItems["NAME"] ?>
				<?if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0){?>
					</a>
				<? } ?>


                <br />
					  <?=$arService["CITY_NAME"]?> <b><?=$arService["STARTDATE"]?> </b> <?=$arService["SCHEDULE_TIME"]?>
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
				<td class="cart-item-quantity"><input maxlength="18" type="text" name="QUANTITY_<?=$arBasketItems["ID"] ?>" value="<?=$arBasketItems["QUANTITY"]?>" size="3"></td>
			<?endif;?>
			<td class="cart-item-actions">
				<?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
					<a class="cart-delete-item" href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["delete"])?>" title="<?=GetMessage("SALE_DELETE_PRD")?>"><i class="fa fa-times" aria-hidden="true"></i></a>
				<?endif;?>
				<?/*if (in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
					<a class="cart-shelve-item" href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["shelve"])?>"><?=GetMessage("SALE_OTLOG")?><?if ($arService["TYPE"] == "COURSE"){?>
					<br ><?=GetMessage("SALE_OTLOG_2")?>
	<? } ?>
<?if ($arService["TYPE"] == "SCHOOL"){?>
					<br ><?=GetMessage("SALE_OTLOG_2")?>
	<? } ?>
					</a>
				<?endif;*/?>
			</td>
		</tr>
		<?
		$i++;
	}
	?>
	</tbody>
	<tfoot>
		<tr>
			<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-name">
					<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
						<p><?echo GetMessage("SALE_ALL_WEIGHT")?>:</p>
					<?endif;?>
					<?if (doubleval($arResult["DISCOUNT_PRICE"]) > 0)
					{
						?><p><?echo GetMessage("SALE_CONTENT_DISCOUNT")?><?
						if (strLen($arResult["DISCOUNT_PERCENT_FORMATED"])>0)
							echo " (".$arResult["DISCOUNT_PERCENT_FORMATED"].")";?>:</p><?
					}?>
					<?if ($arParams['PRICE_VAT_SHOW_VALUE'] == 'Y'):?>
						<p><?echo GetMessage('SALE_VAT_INCLUDED')?></p>
					<?endif;?>
					<p><b><?= GetMessage("SALE_ITOGO")?>:</b></p>
				</td>
			<?endif;?>
			<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-price">
					<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
						<p><?=$arResult["allWeight_FORMATED"]?></p>
					<?endif;?>
					<?if (doubleval($arResult["DISCOUNT_PRICE"]) > 0):?>
						<p><?=$arResult["DISCOUNT_PRICE_FORMATED"]?></p>
					<?endif;?>
					<?if ($arParams['PRICE_VAT_SHOW_VALUE'] == 'Y'):?>
						<p><?=$arResult["allVATSum_FORMATED"]?></p>
					<?endif;?>
					<p><b><?=$arResult["allSum_FORMATED"]?></b></p>
				</td>
			<?endif;?>
			<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-type">&nbsp;</td>
			<?endif;?>
			<?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-discount">&nbsp;</td>
			<?endif;?>
			<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-weight">&nbsp;</td>
			<?endif;?>
			<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-quantity">&nbsp;</td>
			<?endif;?>
			<?if (in_array("DELETE", $arParams["COLUMNS_LIST"]) || in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-actions">&nbsp;</td>
			<?endif;?>
		</tr>
	</tfoot>
	</table>

	<div class="cart-ordering">
		<?if ($arParams["HIDE_COUPON"] != "Y"):?>
			<div class="cart-code">
				<input type="text" onclick="if (this.value=='<?=GetMessage("SALE_COUPON_VAL")?>')this.value=''" onblur="if (this.value=='')this.value='<?=GetMessage("SALE_COUPON_VAL")?>'" value="<?=GetMessage("SALE_COUPON_VAL")?>" name="COUPON">
			</div>
		<?endif;?>
        <?if(false) {?>
		<div class="clear"></div><br />
		<div class="cart-oferta">
			<input  checked="checked" value="agree_oferta" id="agree_oferta" name="agree_oferta" type="checkbox"> <label for="agree_oferta" style="font-weight:normal;">Я принимаю условия <a href="/oferta_luxoft.doc">договора-оферты</a> по оказанию консультационных услуг Luxoft Training</label>
		</div>
        <?}?>
        <br />
		<div class="cart-buttons">
			<input type="submit" class="button main-button" value="<?echo GetMessage("SALE_UPDATE")?>" name="BasketRefresh">
			<input type="submit" class="button_enabled main-button" style="" value="<?echo GetMessage("SALE_ORDER")?>" name="BasketOrder"  id="basketOrderButton2">
		</div>
	</div>
	<?else:
		echo ShowNote(GetMessage("SALE_NO_ACTIVE_PRD"));
	endif;?>
</div>
<?