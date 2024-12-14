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
<br/>
<div class="cart-items" id="id-cart-list">
	<?if(count($arResult["ITEMS"]["AnDelCanBuy"]) > 0):?>


	<?
	$i=0;
	foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arBasketItems)
	{
		?>
		<div class="cart-item-brd">

			<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
				<?foreach ($arBasketItems["PROPS"] as $arServiceTemp) {?>
					<?
					$arService[$arServiceTemp['NAME']] = $arServiceTemp["VALUE"];
					?>
				<?}?>
				<? //iwrite($arService);
				?>
				<div class="cart-item-name">
                    <div class='cart-link'>
				<?if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0){ ?>
					<a href="<?=$arBasketItems["DETAIL_PAGE_URL"] ?>">
				<? } ?>
				<?//if ($USER->IsAdmin()) {?>
					<?$info=GetIblockElement($arBasketItems["PRODUCT_ID"])?>
					<?//print_r($info["PROPERTIES"]["CAN_BUY"]["VALUE"])?>
					<?$arGroups = $USER->GetUserGroupArray();?>
					<?if ($info["PROPERTIES"]["CAN_BUY"]["VALUE"]!="Да" &&  $arService["CITY_NAME"]=="Москва" && !in_array("34", $arGroups)) {?>
						<?//echo "123";?>
						<?$arFields = array(
						     "DELAY" => "Y"
						);
						CSaleBasket::Update($arBasketItems["ID"], $arFields);
						?>
					<?}?>
				<?//}?>
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
                    </div>

					  <?=$arService["CITY_NAME"]?> <b><?=$arService["STARTDATE"]?> </b> <?=$arService["SCHEDULE_TIME"]?>
				</div>
			<?endif;?>
           	<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
				<div class="cart-item-price" style="padding-top: 5px;" ><?=$arBasketItems["PRICE_FORMATED"]?><?if (strlen($arBasketItems["DISCOUNT_PRICE_PERCENT_FORMATED"])>0) {?><div style="font-size: 12px; color: #777"> скидка <?=$arBasketItems["DISCOUNT_PRICE_PERCENT_FORMATED"]?></div><?}?></div>
			<?endif;?>
			<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
				<div class="cart-item-type"><?=$arBasketItems["NOTES"]?></div>
			<?endif;?>

			<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
				<div class="cart-item-weight"><?=$arBasketItems["WEIGHT_FORMATED"]?></div>
			<?endif;?>
			<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
				<div class="cart-item-quantity"><a class="remove cursor" href="javascript:void(0)">-</a></span><input maxlength="18" style="width: 30px; text-align: center;" type="text" name="QUANTITY_<?=$arBasketItems["ID"] ?>" value="<?=$arBasketItems["QUANTITY"]?>" size="3"><a class="add cursor" href="javascript:void(0)">+</a><br/>
                <?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
                    <a class="cart-delete-item" href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["delete"])?>" title="<?=GetMessage("SALE_DELETE_PRD")?>">удалить курс</a>

                <?endif;?>
                </div>
			<?endif;?>
			<div class="cart-item-actions">


			</div>
            <div class="clearfix"></div>
		</div>
		<?
		$i++;
	}
	?>

	<div>

			<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
				<div  class="cart-item-name">
					<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
						<p><?echo GetMessage("SALE_ALL_WEIGHT")?>:</p>
					<?endif;?>
					<?/*if (doubleval($arResult["DISCOUNT_PRICE"]) > 0)
					{
						?><p><?echo GetMessage("SALE_CONTENT_DISCOUNT")?><?
						if (strLen($arResult["DISCOUNT_PERCENT_FORMATED"])>0)
							echo " (".$arResult["DISCOUNT_PERCENT_FORMATED"].")";?>:</p><?
					}*/?>
					<?if ($arParams['PRICE_VAT_SHOW_VALUE'] == 'Y'):?>
						<p><?echo GetMessage('SALE_VAT_INCLUDED')?></p>
					<?endif;?>
					<p style="float: right;"><b><?= GetMessage("SALE_ITOGO")?>:</b></p>
                    <div class="cart-code" style="float: left;">
                        <input type="text" onclick="if (this.value=='<?=GetMessage("SALE_COUPON_VAL")?>')this.value=''" onblur="if (this.value=='')this.value='<?=GetMessage("SALE_COUPON_VAL")?>'" value="<?if (strlen($arResult["COUPON"])>0)  {echo  $arResult["COUPON"];} else {echo GetMessage("SALE_COUPON_VAL"); }?>" name="COUPON">
                    </div>
				</div>
			<?endif;?>
			<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
				<div class="cart-item-price">
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
				</div>
			<?endif;?>
			<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
				<div class="cart-item-type">&nbsp;</div>
			<?endif;?>
			<?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
				<div class="cart-item-discount">&nbsp;</div>
			<?endif;?>
			<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
				<div class="cart-item-weight">&nbsp;</div>
			<?endif;?>
			<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
				<div class="cart-item-quantity">&nbsp;</div>
			<?endif;?>
			<?if (in_array("DELETE", $arParams["COLUMNS_LIST"]) || in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
				<div class="cart-item-actions">&nbsp;</div>
			<?endif;?>
            <div class="clearfix"></div>
		</div>
    </div>

	<div class="cart-ordering">
    	<div class="clear"></div><br />
		<div class="cart-oferta">
			<input  checked="checked" value="agree_oferta" id="agree_oferta" name="agree_oferta" type="checkbox"> <label  style="font-weight:normal;">Я принимаю условия <a href="/oferta_luxoft_.doc">договора-оферты</a> по оказанию консультационных услуг Luxoft Training</label>
		</div>
        <br />
		<div class="cart-buttons">
			<input type="submit" value="<?echo GetMessage("SALE_UPDATE")?>" name="BasketRefresh">
			<input type="submit" class="button_enabled" style="" value="<?echo GetMessage("SALE_ORDER")?>" name="BasketOrder"  id="basketOrderButton2">
		</div>
	</div>
    <script>
        $(document).ready(function() {
            $('.cursor').click(function(){
                input=$(this).parent().find('input');
                if ($(this).hasClass('add')) {
                    input.val(input.val()*1+1)
                } else if ($(this).hasClass('remove')) {
                    if (input.val()>1) {
                        input.val(input.val()*1-1)
                    }
                }
            });
        });
    </script>
	<?else:
		echo ShowNote(GetMessage("SALE_NO_ACTIVE_PRD"));?>
		</div>
	<?endif;?>

<?