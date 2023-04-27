<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="subscribe-form">
<form action="<?=$arResult["FORM_ACTION"]?>">
	<table border="0" cellspacing="0" cellpadding="2" align="center">
		<tr>
			<td><input type="text" class="email_form"  name="sf_EMAIL" size="20" onblur="if(this.value=='') this.value='Введите e-mail'" onfocus="if(this.value=='Введите e-mail') this.value=''" value="Введите e-mail" title="<?=GetMessage("subscr_form_email_title")?>" />
			 <br /><?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
	<label for="sf_RUB_ID_<?=$itemValue["ID"]?>">
	<input type="checkbox" style="display:none;" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> />
	 <span class="label_text"><?=$itemValue["NAME"]?></span>
	</label><br />
<?endforeach;?>
			</td>
		</tr>
		<tr>
			<td align="center"><input type="submit" class="but" name="OK" value="<?=GetMessage("subscr_form_button")?>" /></td>
		</tr>
	</table>
</form>
</div>
