<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="subscribe-form-full" >
<form action="<?=$arResult["FORM_ACTION"]?>">
<div class="visible-form">
<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
	<label class="hidden" style="display: none" for="sf_RUB_ID_<?=$itemValue["ID"]?>">
	<input type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> /> <?=$itemValue["NAME"]?>
	</label>
<?endforeach;?>

	<table border="0" cellspacing="0" cellpadding="2" align="left">
		<tr>
			<td style="padding-bottom: 20px; padding-right: 20px;"><input type="text" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?=GetMessage("subscr_form_email_title")?>" /></td>
			<input type="hidden" name="RUB_ID" value="21"/>
			<td><input class="btn" style="display: inline-block; margin-left: 0;" type="submit" name="OK" value="<?=GetMessage("subscr_form_button")?>" /></td>
		</tr>
	</table>
</div>
<div class="hidden-form">
<p>Вы успешно подписались на рассылку</p>
</div>
</form>
</div>
<script>
jQuery(document).ready(function() {
	jQuery('#subscribe-form-full form').submit(function(){
		tform=jQuery(this);
		//console.info(tform);
		
		jQuery.post( "/ajax/subscribe.php", tform.serialize()).done(function( data ) {

			var obj = jQuery.parseJSON(data);
			//console.info(obj);
			if (obj.success=="Y") {
				
				tform.parent().parent().parent().find('.visible-form').css('display', 'none');
				tform.parent().parent().parent().find('.hidden-form').css('display', 'block');
			} else {
				alert('Вы уже подписаны на рассылку');
			}
		});
		return false;
	})
})
</script>