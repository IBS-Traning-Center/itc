<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
if($_REQUEST["filter_canceled"] == "Y" && $_REQUEST["filter_history"] == "Y")
	$page = "canceled";
elseif($_REQUEST["filter_status"] == "F" && $_REQUEST["filter_history"] == "Y")
	$page = "completed";
elseif($_REQUEST["filter_history"] == "Y")
	$page = "all";
else
	$page = "active";
?>
<div class="order-list">
	<div class="inline-filter order-filter">
		<label><?=GetMessage("STPOL_F_NAME")?></label>
		<?if($page != "active"):?><a href="<?=$arResult["CURRENT_PAGE"]?>?filter_history=N"><?else:?><b><?endif;?><?=GetMessage("STPOL_F_ACTIVE")?><?if($page != "active"):?></a><?else:?></b><?endif;?>

		<?if($page != "all"):?><a href="<?=$arResult["CURRENT_PAGE"]?>?filter_history=Y"><?else:?><b><?endif;?><?=GetMessage("STPOL_F_ALL")?><?if($page != "all"):?></a><?else:?></b><?endif;?>

		<?if($page != "completed"):?><a href="<?=$arResult["CURRENT_PAGE"]?>?filter_status=F&filter_history=Y"><?else:?><b><?endif;?><?=GetMessage("STPOL_F_COMPLETED")?><?if($page != "completed"):?></a><?else:?></b><?endif;?>

		<?if($page != "canceled"):?><a href="<?=$arResult["CURRENT_PAGE"]?>?filter_canceled=Y&filter_history=Y"><?else:?><b><?endif;?><?=GetMessage("STPOL_F_CANCELED")?><?if($page != "canceled"):?></a><?else:?></b><?endif;?>
	</div>
			<?
			$bNoOrder = true;
			foreach($arResult["ORDERS"] as $key => $val)
			{
				$bNoOrder = false;
				//iwrite($val)
				?>
				<div class="order-item">
					<div class="order-title">
						<b class="r2"></b><b class="r1"></b><b class="r0"></b>
						<div class="order-title-inner">
							<span><?=GetMessage("STPOL_ORDER_NO")?><?=$val["ORDER"]["ID"] ?>&nbsp;<?=GetMessage("STPOL_FROM")?>&nbsp;<?=$val["ORDER"]["DATE_INSERT"]; ?></span>
							<a title="<?echo GetMessage("STPOL_DETAIL")?>" href="<?=$val["ORDER"]["URL_TO_DETAIL"] ?>"><?echo GetMessage("STPOL_DETAIL")?></a>
						</div>
					</div>
					<div class="order-info">
						<div class="order-details">
							<div class="order-props">

								<p><label><?echo GetMessage("STPOL_SUM")?></label> <span><?=$val["ORDER"]["FORMATED_PRICE"]?></span></p>
								<p><label><?=GetMessage("STPOL_PAYED")?></label> <span><?echo (($val["ORDER"]["PAYED"]=="Y") ? GetMessage("STPOL_Y") : GetMessage("STPOL_N"));?></span></p>
								<?if(IntVal($val["ORDER"]["PAY_SYSTEM_ID"])>0)
									echo "<p><label>".GetMessage("P_PAY_SYS")."</label> <span>".$arResult["INFO"]["PAY_SYSTEM"][$val["ORDER"]["PAY_SYSTEM_ID"]]["NAME"]."</span></p>"?>
                                <?if ((SITE_ID=="ru") and ($val["ORDER"]["PAY_SYSTEM_ID"] == PAYMENT_SYSTEM_ID_LUX_OFERTA_LEGAL)){?>

<blockquote>
<ul>
<li>необходимо оплатить <a href="/personal/order/payment/?ORDER_ID=<?=intval($val['ORDER']['ID'])?>">счет-оферту</a> (1), а также сообщить об оплате на <a href="mailto:education@ibs.ru">education@ibs.ru</a>, указав в письме номер счета-оферты</li>
<li><a href="/personal/order/payment/?ORDER_ID=<?=intval($val['ORDER']['ID'])?>&SHOWPODPIS=N">cчет-оферту (без подписей со стороны УЦ Luxoft)</a> (2) необходимо распечатать, подписать, поставить печать и направить оригиналы документов в 2-х экземплярах (с указанием обратного адреса, контактного лица) по адресу 127018, Москва, ул. Складочная, д. 3, стр. 1. Марии Зиборовой.
<li>по окончании тренинга будут выставлены акты, счет-фактура и направлены вам вместе с подписанным счетом-офертой
<li>после подписания вами закрывающих документов, акт необходимо направить по адресу 127018, Москва, ул. Складочная, д. 3, стр. 1. Марии Зиборовой
</ul>
<span class="links">Сам договор-оферта доступен по <a href="/downloads/docs/oferta_luxtr_legal.doc">ссылке</a></span>
	<div class="links">Если у вас возникли вопросы по договору-оферте, юридическое лицо не является резидентом РФ или не имеет представительства на территории РФ, просьба написать письмо на <a href="mailto:education@ibs.ru ">education@ibs.ru </a> или воспользоваться <a href="/mail/form.html">формой</a> на сайте</div>
 </blockquote>

                                <? } ?>
								<?if(IntVal($val["ORDER"]["DELIVERY_ID"])>0)
								{
									echo "<p><label>".GetMessage("P_DELIVERY")."</label> <span>".$arResult["INFO"]["DELIVERY"][$val["ORDER"]["DELIVERY_ID"]]["NAME"]."</span></p>";
								}
								elseif (strpos($val["ORDER"]["DELIVERY_ID"], ":") !== false)
								{
									echo "<p><label>".GetMessage("P_DELIVERY")."</label> <span>";
									$arId = explode(":", $val["ORDER"]["DELIVERY_ID"]);
									echo $arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["NAME"]." (".$arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["PROFILES"][$arId[1]]["TITLE"].")"."</span></p>";
								}
								?>
							</div>


							<div class="order-items">
								<label><?echo GetMessage("STPOL_CONTENT")?></label>
								<ol>



									<?
									foreach($val["BASKET_ITEMS"] as $vvval)
									{
										?>
<?
		$dbBasketProps = CSaleBasket::GetPropsList(
			array("SORT" => "ASC", "ID" => "DESC"),
			array(
					"BASKET_ID" => $vvval["ID"],
					"!CODE" => array("CATALOG.XML_ID", "PRODUCT.XML_ID")
				),
			false,
			false,
			array("NAME", "VALUE")
		);
		while($arBasketPropsTmp = $dbBasketProps->GetNext())
		{
				$arService[$arBasketPropsTmp['NAME']] = $arBasketPropsTmp["VALUE"];
		}

?>
										<li>
											<?
											//iwrite($vvval);
											if (strlen($vvval["DETAIL_PAGE_URL"]) > 0)
												echo "<a href=\"".$vvval["DETAIL_PAGE_URL"]."\">";
											echo $arService["COURSE_CODE"];
											echo " ";
											echo $vvval["NAME"];
											if (strlen($vvval["DETAIL_PAGE_URL"]) > 0)
												echo "</a><br />";
											if($vvval["QUANTITY"] > 1)
												echo " &mdash; ".$vvval["QUANTITY"].GetMessage("STPOL_SHT");
											?>

					  				<?=$arService["CITY_NAME"]?> <b><?=$arService["STARTDATE"]?> </b> <?=$arService["SCHEDULE_TIME"]?>
										</li>
										<?
									}
									?>
								</ol>

							</div>
						</div>

						<div class="order-status-info">
							<?if ($val["ORDER"]["CANCELED"] == "Y"):?>
								<div class="order-status-date"><?=$val["ORDER"]["DATE_CANCEL"]?></div>
								<div class="order-status order-status-deny"><?=GetMessage("STPOL_CANCELED");?></div>
							<?else:?>
								<div class="order-status-date"><?=$val["ORDER"]["DATE_STATUS"]?></div>
								<div class="order-status order-status-<?=toLower($val["ORDER"]["STATUS_ID"])?>"><?=$arResult["INFO"]["STATUS"][$val["ORDER"]["STATUS_ID"]]["NAME"]?></div>
							<?endif;?>

							<?if (($val["ORDER"]["PERSON_TYPE_ID"] == 1) and ($val["ORDER"]["ID"] > 82)){ ?>
								<a target="_blank" href="/personal/order/print_oferta.php?doc=invoice_oferta&ORDER_ID=<?=$val["ORDER"]["ID"]?>" class="orange">См. счет-оферту</a>
							<? } ?>

							<div class="order-status-links">
								<?if ($val["ORDER"]["CAN_CANCEL"] == "Y"):?>
									<a title="<?= GetMessage("STPOL_CANCEL") ?>" href="<?=$val["ORDER"]["URL_TO_CANCEL"]?>"><?= GetMessage("STPOL_CANCEL") ?></a>
								<?endif;?>
								<a title="<?= GetMessage("STPOL_REORDER") ?>" href="<?=$val["ORDER"]["URL_TO_COPY"]?>"><?= GetMessage("STPOL_REORDER1") ?></a>
							</div>
						</div>
					</div>
				</div>
				<?
			}

			if ($bNoOrder)
			{
				?><center><?echo ShowNote(GetMessage("STPOL_NO_ORDERS"))?></center><?
			}
			?>
</div>

<?if(strlen($arResult["NAV_STRING"]) > 0):?>
	<div class="navigation"><?=$arResult["NAV_STRING"]?></p>
<?endif?>
