<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

//iwrite($arResult);

//$vCurPageUrl  = 
?>
<?if ($_REQUEST["SHOW_ADMIN_INFO"] === "Y"){?>
<?iwrite($arResult);?>
<? } ?>

<?if ($arResult["SHOW_INFO"] === "Y"){?>

<?if ($arResult["IS_AUTHORIZED"] === "Y"){?>
<div class="ltr_send_info">
	<?if ($arResult['SEND_EMAIL'] === "N"){?>
		<?if (is_array($arResult['BASKETITEMS']) && count($arResult['BASKETITEMS'])>0){?>
			<a  class="link_send_info" href="<?echo $APPLICATION->GetCurPageParam("SEND_EMAIL=Y", array("SEND_EMAIL"));?>">Отправить email с выбранными курсами себе на почту</a><br/>
			<a href="<?echo $APPLICATION->GetCurPageParam("clear_all=Y", array("clear_all"));?>">Удалить всё из корзины</a>
		<? } ?>
		<? } else {?>

	<? } ?>	
	<?if ($arResult['SEND_EMAIL'] === "Y"){?>
	<p><strong>Письмо с выбранными курсами успешно отправлено</strong></p>
	<? } ?>	
</div>
<? } ?>

<? } ?>