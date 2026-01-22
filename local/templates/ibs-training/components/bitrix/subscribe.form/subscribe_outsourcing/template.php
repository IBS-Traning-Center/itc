<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

         <form action="<?=$arResult["FORM_ACTION"]?>" method="post" >
<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
           <input type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>" /><label for="sf_RUB_ID_<?=$itemValue["ID"]?>"><?=$itemValue["NAME"]?></label><br />
<?endforeach;?>
           <input type="text"  id="textinput" name="sf_EMAIL" size="12" title="<?=GetMessage("subscr_form_email_title")?>" value="<?=$arResult["EMAIL"]?>"  onblur="inscript(this);" />
           <input type="image" name="OK"  alt="" src="/images/button.gif" />
         </form>



