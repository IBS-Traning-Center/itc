<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?/*
<script>
   $(document).ready(function(){
    $(".cart-oferta input#agree_oferta").change(function () {
       var bChecked = $('.cart-oferta input#agree_oferta').attr('checked');
          if (bChecked){
                $("input#basketOrderButton2").attr("disabled","").removeClass("button_disabled").addClass("button_enabled");
          } else {
                $("input#basketOrderButton2").attr("disabled","disabled").removeClass("button_enabled").addClass("button_disabled");
          }
    })
  });
</script>
*/?>
<style>
table.cart-items td {
	white-space:normal;
}
</style>
<div id="order_form_div">
<div class="order-checkout" id="order_form">
<?
if(!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N")
{
	if(!empty($arResult["ERROR"]))
	{
		foreach($arResult["ERROR"] as $v)
			echo ShowError($v);
	}
	elseif(!empty($arResult["OK_MESSAGE"]))
	{
		foreach($arResult["OK_MESSAGE"] as $v)
			echo "<p class='sof-ok'>".$v."</p>";
	}
    print_r($arResult['SUCCESS']);
	include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/auth.php");
}
else
{
	if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y")
	{
		if(strlen($arResult["REDIRECT_URL"]) > 0)
		{
			?>
			<script>
			<!--
			//top.location.replace = '<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
			window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
			//setInterval("window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';",2000);
			//-->
			</script>
			<?
			die();
		}
		else
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/confirm.php");
	}
	else
	{
		$FORM_NAME = 'ORDERFORM_'.RandString(5);
		if(!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y")
		{?>
			<p class="errortext">
			<?foreach($arResult["ERROR"] as $v)
				echo $v;
			?>
			</p>
			<script>
			top.location.hash = '#order_form';
			</script>
			<?
		}
		?>

		<script>
		<!--
		function submitForm(val)
		{
			if(val != 'Y')
				document.getElementById('confirmorder').value = 'N';

			var orderForm = document.getElementById('ORDER_FORM_ID_NEW');
			jsAjaxUtil.InsertFormDataToNode(orderForm, 'order_form_div', false);
			orderForm.submit();
			return true;
		}
		//-->
		</script>
		<div style="display:none;">
			<div id="order_form_id">
			&nbsp;
				<?
				if(count($arResult["PERSON_TYPE"]) > 1)
				{
					?>
					<div class="order-item">
						<div class="order-title">
							<b class="r2"></b><b class="r1"></b><b class="r0"></b>
							<div class="order-title-inner">
								<span><?=GetMessage("SOA_TEMPL_PERSON_TYPE")?></span>
							</div>
						</div>
						<div class="order-info">
							<table width="100%" cellpadding="0" cellspacing="6">
								<tbody>
								<?
								foreach($arResult["PERSON_TYPE"] as $v)
								{
									//print_r($arResult["PERSON_TYPE"]);
									?>
									<tr>
										<td valign="top" width="0%"><input type="radio" id="PERSON_TYPE_<?= $v["ID"] ?>" name="PERSON_TYPE" value="<?= $v["ID"] ?>"<?if ($v["CHECKED"]=="Y") { echo " checked=\"checked\""; $ID_CURRENT_PERSON_TYPE = $v["ID"]; }?> onclick="submitForm()"></td>
										<td valign="top" width="100%"><label for="PERSON_TYPE_<?= $v["ID"] ?>"><?= $v["NAME"] ?></label></td>
									</tr>
									<?
								}
								?>
							</tbody></table>
							<? if ($ID_CURRENT_PERSON_TYPE == PAYMENT_TYPE_ID_LUX_LEGAL_ENTITY) {?>
								<div class="cart-oferta">

                                    <br />
									<h2>Очередность шагов</h2>
									<p>После оформления заказа сформируются 2 документа:</p>
									<blockquote>
									<ul>
									<li>заполненная счет-оферта(1)  с подписью и печатью</li>
									<li>заполненная счет-оферта(2)  (без подписи, печати со  стороны Luxoft Training) для подписи, печати со стороны заказчика </li>

									</ul>
                                    </blockquote>
                                    <p>Далее:</p>
<blockquote>
<ul>
<li>необходимо оплатить счет-оферту (1), а так же сообщить об оплате на <a href="education@ibs.ru">education@ibs.ru</a>, указав в письме номер счета-оферты</li>
<li>cчет-оферту(2) необходимо распечатать, подписать, поставить печать и направить оригиналы документов в 2-х экземплярах (с указанием обратного адреса, контактного лица) по адресу 127018, Москва, ул. Складочная, д. 3, стр. 1. Марии Зиборовой
<li>по окончании тренинга будут выставлены акты, счет-фактура и направлены вам вместе с подписанным счетом-офертой
<li>после подписания вами закрывающих документов, акт необходимо направить по адресу 127018, Москва, ул. Складочная, д. 3, стр. 1. Марии Зиборовой
</ul>
 </blockquote>
 <div class="botborder_no_indent"></div>

									<input checked="checked" value="agree_oferta" id="agree_oferta" name="agree_oferta" type="checkbox"> <label for="agree_oferta" style="font-weight:normal;">Я принимаю условия <a href="/downloads/docs/oferta_luxtr_legal.doc">договора-оферты</a> для юридических лиц по оказанию консультационных услуг Luxoft Training</label>
									<br /><br />
									<div class="links">Если у вас возникли вопросы по договору-оферте, юридическое лицо не является резидентом РФ или не имеет представительства на территории РФ, просьба написать письмо на <a href="mailto:education@ibs.ru ">education@ibs.ru </a> или воспользоваться <a href="/mail/form.html">формой</a> на сайте</div>

								</div>

					        <? } ?>
							<input type="hidden" name="PERSON_TYPE_OLD" value="<?=$arResult["USER_VALS"]["PERSON_TYPE_ID"]?>">
						</div>
					</div>
					<?
				}
				else
				{
					if(IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"]) > 0)
					{
						?>
						<input type="hidden" name="PERSON_TYPE" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>">
						<input type="hidden" name="PERSON_TYPE_OLD" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>">
						<?
					}
					else
					{
						foreach($arResult["PERSON_TYPE"] as $v)
						{
							?>
							<input type="hidden" id="PERSON_TYPE" name="PERSON_TYPE" value="<?=$v["ID"]?>">11
							<input type="hidden" name="PERSON_TYPE_OLD" value="<?=$v["ID"]?>">
							<?
						}
					}
				}

				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props.php");
				?>
				<?
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
				?>
				<?
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
				?>
				<?
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/summary.php");
				?>
				<input type="hidden" name="confirmorder" id="confirmorder" value="Y">


		<div class="clear"></div><br />
		<? if ($ID_CURRENT_PERSON_TYPE == PAYMENT_TYPE_ID_LUX_INDIVIDUAL) {?>
			<div class="cart-oferta">

				<input checked="checked" value="agree_oferta" id="agree_oferta" name="agree_oferta" type="checkbox"> <label for="agree_oferta" style="font-weight:normal;">Я принимаю условия <a href="/oferta_luxoft.doc">договора-оферты</a> по оказанию консультационных услуг Luxoft Training</label>
			</div>
        <? } ?>
		<? if ($ID_CURRENT_PERSON_TYPE == PAYMENT_TYPE_ID_LUX_LEGAL_ENTITY) {?>
<?/*			<div class="cart-oferta">

				<input checked="checked" value="agree_oferta" id="agree_oferta" name="agree_oferta" type="checkbox"> <label for="agree_oferta" style="font-weight:normal;">Я принимаю условия <a href="/oferta_luxoft.doc">договора-оферты</a> для юридических лиц по оказанию консультационных услуг Luxoft Training</label>
				<br />
				<p style="padding:5px 20px 10px 0;">Если у вас возникли вопросы по договору-оферте, юридическое лицо не является резидентом РФ или имеет представительство на территории РФ, просьба написать письмо на <a href="mailto:education@ibs.ru ">education@ibs.ru </a></p>
			</div>*/?>

        <? } ?>
        <br />
                <div class="order-buttons">
				<input type="button" class="button_enabled"  id="basketOrderButton2" name="submitbutton" onclick="submitForm('Y');" value="<?=GetMessage("SOA_TEMPL_BUTTON")?>">
				</div>
			</div>
		</div>

		<div id="form_new"></div>
		<script>
		<!--
		var newform = document.createElement("FORM");
		newform.method = "POST";
		newform.action = "";
		newform.name = "<?=$FORM_NAME?>";
		newform.id = "ORDER_FORM_ID_NEW";
		var im = document.getElementById('order_form_id');
		document.getElementById("form_new").appendChild(newform);
		newform.appendChild(im);
		//-->
		</script>

		<?
	}
}
?>
</div>
</div>