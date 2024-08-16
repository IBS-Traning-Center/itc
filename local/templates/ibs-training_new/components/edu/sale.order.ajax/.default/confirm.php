<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(strlen($_SESSION['SUCCESS']['PASSWORD'])>0){ ?>
	<div class="notetext">
	<h2>Вы зарегистрированы и авторизованы. При дальнейших посещениях  сайта используйте, пожалуйста, следующие  данные:</h2>
	    <b>Email</b>: <?=$_SESSION['SUCCESS']['EMAIL']?><br />
	    <b>Пароль</b>: <?=$_SESSION['SUCCESS']['PASSWORD']?><br />
	    <br /><p>Пароль можно изменить в своем <a href="/personal/profile/">личном кабинете</a></p>
	    <br /><p>Если пароль будет утерян, можно воспользоваться процедурой восстановления пароля</p>
	</div><br />
	<?unset($_SESSION['SUCCESS']['PASSWORD']);?>
<? } ?>

<?//iwrite($arResult['ORDER']);
?>

<div class="notetext">
<?
if (!empty($arResult["ORDER"]))
{
	?>
	<b><?=GetMessage("SOA_TEMPL_ORDER_COMPLETE")?></b><br />
				<?= GetMessage("SOA_TEMPL_ORDER_SUC", Array("#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"], "#ORDER_ID#" => $arResult["ORDER_ID"]))?><br /><br />
				<?= GetMessage("SOA_TEMPL_ORDER_SUC1", Array("#LINK#" => $arParams["PATH_TO_PERSONAL"])) ?>
	<?
	if (!empty($arResult["PAY_SYSTEM"]))
	{
		?>
		<br /><br />
		<?=GetMessage("SOA_TEMPL_PAY")?>: <?= $arResult["PAY_SYSTEM"]["NAME"] ?><br />
			<?
			if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0)
			{
						if ($arResult["PAY_SYSTEM"]["NEW_WINDOW"] == "Y")
						{
							?>
							<?if (intval($arResult['ORDER']['PAY_SYSTEM_ID']) !== PAYMENT_SYSTEM_ID_LUX_OFERTA_LEGAL){?>
								<script language="JavaScript">
									window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?= $arResult["ORDER_ID"] ?>');
								</script>
								<?= GetMessage("SOA_TEMPL_PAY_LINK", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$arResult["ORDER_ID"])) ?>
							<? } ?>
							<?if (intval($arResult['ORDER']['PAY_SYSTEM_ID']) == PAYMENT_SYSTEM_ID_LUX_OFERTA_LEGAL){?>
								<?= GetMessage("OFFERTA_TEMPL_PAY_LINK_WITH", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$arResult["ORDER_ID"]))?> <br />
								<?= GetMessage("OFFERTA_TEMPL_PAY_LINK_WITHOUT", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$arResult["ORDER_ID"]."&SHOWPODPIS=N")) ?>

								<br /><br /><div class="links"><a href="/personal/order/">Перейти в Мои заказы</a></div>
							<? } ?>

							<?
						}
						else
						{
							if (strlen($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"])>0)
							{
								include($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"]);
							}
						}
			}
	}
}
else
{
	?>
	<b><?=GetMessage("SOA_TEMPL_ERROR_ORDER")?></b><br />
				<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST", Array("#ORDER_ID#" => $arResult["ORDER_ID"]))?>
				<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST1")?>
	<?
}
?>
</div>
