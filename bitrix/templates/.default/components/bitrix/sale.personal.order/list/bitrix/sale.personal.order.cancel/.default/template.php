<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<p><a name="tb"></a>
<span class="links"><a href="<?=$arResult["URL_TO_LIST"]?>"><?=GetMessage("SALE_RECORDS_LIST")?></a>
</p>

<?if(strlen($arResult["ERROR_MESSAGE"])<=0):?>

	<form method="post" action="<?=POST_FORM_ACTION_URI?>">
		<?=bitrix_sessid_post()?>
		<input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
		<?=GetMessage("SALE_CANCEL_ORDER1") ?>
		<a href="<?=$arResult["URL_TO_DETAIL"]?>"><?=GetMessage("SALE_CANCEL_ORDER2")?> #<?=$arResult["ID"]?></a>?
		<p><b><?= GetMessage("SALE_CANCEL_ORDER3") ?></b><br /><br />
		<?= GetMessage("SALE_CANCEL_ORDER4") ?>:<br /></p>
		<textarea style="border:1px solid #AACFE4;height:80px;padding:4px 2px;width:450px;"  name="REASON_CANCELED" cols="60" rows="3"></textarea><br /><br />
		<input type="hidden" name="CANCEL" value="Y">
		<input type="submit"  style="border:1px solid #AACFE4;padding:4px 2px;" name="action" value="<?= GetMessage("SALE_CANCEL_ORDER_BTN") ?>">
	</form>

<?
else:
	echo ShowError($arResult["ERROR_MESSAGE"]);
endif;?>