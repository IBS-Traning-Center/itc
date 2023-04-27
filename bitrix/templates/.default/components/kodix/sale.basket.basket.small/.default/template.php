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
	<? if ($QUANTITY) {?>
	<div class="basketList" id="basketList" style="">

			<div class="arr"><!--//--></div>
			<div class="text" style="">
				<? if (count($arResult["ITEMS"])>6) {?>
				<div class="scrollBar">
				<? } ?>
				<ul>
					<?foreach ($arResult["ITEMS"] as $product) {?>
					<?//iwrite($product);
					?>
					<li class="clear">
						<?if  ($arResult["TYPE"][$product["ID"]] == "COURSE") {?>
<div class="r">
<a title="Добавить курс в календарь" rel="nofollow" href="/training/catalog/ics_course.html?ID=<?=$product['PRODUCT_ID']?>"><img width="24" border="0" src="/downloads/images/47-ical_24_24.png"></a>
</div>

							<a style="text-decoration:underline;" href="<?=$product["DETAIL_PAGE_URL"]?>"> <?=$arResult["COURSE_CODE"][$product["ID"]]?></a>                     <? } ?>
						<a style="text-decoration:underline;" href="<?=$product["DETAIL_PAGE_URL"]?>"> <?=$product["NAME"]?></a>,

						  <?=$arResult["CITY_NAME"][$product["ID"]]?> <b><?=$arResult["STARTDATE"][$product["ID"]]?></b><br />   Кол-во мест: <?=intval($product["QUANTITY"])?>
					</li>
					<?}?>
				</ul>
				<? if (count($arResult["ITEMS"])>6) {?>
				</div>
				<? } ?>
				<div class="summary clear">
					<div class="l">Итого на сумму: </div>
					<div class="r"><?=FormatCurrency($SUM, $CURRENCY) ?></div>
				</div>

			<? $pageDelAllFromBasketUrl = $APPLICATION->GetCurPageParam("DELETE_ALL=Y", array()); ?>
			<?
			$uri = $APPLICATION->GetCurDir();
			if ($uri == "/ajax/"){
				if (strpos($_SERVER['HTTP_REFERER'], "?") === false) {
					$pageDelAllFromBasketUrl =  $_SERVER["HTTP_REFERER"]. "?DELETE_ALL=Y";
						} else {
					$pageDelAllFromBasketUrl =  $_SERVER["HTTP_REFERER"]. "&DELETE_ALL=Y";
				}
			}
			?>

 				<div class="summary clear">
					<div class="l"><span class="links"><a href="/personal/cart/">Корзина</a></span></div>
					<div class="r"><a  title="Очистить корзину" href="<?=$pageDelAllFromBasketUrl?>"><img width="20" src="/images_edu/diffs/basket_remove.png" alt="" id=""/></a></div>
				</div>

			</div>
	</div>
	<? } ?>
	<? /* <a href="<?=$arParams["PATH_TO_ORDER"] ?>" title="<?=GetMessage("TSBS_2ORDER") ?>"><?=GetMessage("TSBS_2ORDER") ?></a>
	<li class="nowrap">
			<?if ($arResult["READY"]=='Y'):?>
					<?if (strlen($arParams["PATH_TO_ORDER"])>0):?>
						<a href="<?=$arParams["PATH_TO_ORDER"] ?>" title="<?=GetMessage("TSBS_2ORDER") ?>"><?=GetMessage("TSBS_2ORDER") ?></a>
					<?endif;?>
					<!--<p class="gray"><span>&middot;</span>&nbsp;&nbsp;<a href="#TB_inline?width=550&height=550&inlineId=LinkToFForm&modal=true" id="LinkToF2" title="<?=GetMessage("LINK_TO_FRIEND") ?>" class="thickbox"><?=GetMessage("LINK_TO_FRIEND") ?></a></p>-->
				<?endif;?>
	</li>*/?>
<? } else {?>
<a href="<?=$arParams['PATH_TO_BASKET']?>" title="Ваша корзина пуста">Корзина услуг (0)</a>
<?  }?>
