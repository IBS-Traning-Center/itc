<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="subscribe-form-full" >
<form  action="<?=$arResult["FORM_ACTION"]?>">
<div class="visible-form">
<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
	<label class="hidden" style="display: none" for="sf_RUB_ID_<?=$itemValue["ID"]?>">
	<input type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> /> <?=$itemValue["NAME"]?>
	</label>
<?endforeach;?>
	<div class="subsribe-block-2">
	<div class="input-sub-wrap"><input type="text" placholder="Email" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?=GetMessage("subscr_form_email_title")?>" /></div>
		
	<div class="input-button-wrap"><input class="btn sign-in" type="submit" name="OK" value="ПОДПИСАТЬСЯ" /></div>
	</div>	
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