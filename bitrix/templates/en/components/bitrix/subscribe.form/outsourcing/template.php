<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<style type="text/css">
h1, form, button
{
	border:0;
	margin:0;
	padding:0;
}

.spacer
{
	clear:both;
	height:1px;
}
</style>
<script type="text/javascript" src="/bitrix/templates/en/jquery.validate.js"></script>
  <script>
  $(document).ready(function(){
    $("#submit_outsourcing").validate();
  });
  </script>
<div id="stylized" class="myform">
<form action="<?=$arResult["FORM_ACTION"]?>" id="submit_outsourcing">

<? $index=0; ?>
<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
<? if ($index==1) { ?>
<!--<label for="sf_RUB_ID_<?=$itemValue["ID"]?>"></label>-->
	<input style="display:none" type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>" checked />


<? } ?>
<? $index=$index+1; ?>

<?endforeach;?>
<h1> <?=$itemValue["NAME"]?> </h1>
<p>Please complete the form below. Mandatory fields marked <font color="red"><span class="form-required starrequired">*</span></font></p>

<label>Your Email:<font color="red"><span class="form-required starrequired">*</span></font></label> <input  class="required email" type="text" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>"  />
<label>First Name:</label><input class="inputtext" name="outsource_name" value="" size="60" type="text">
<label>Last Name:</label><input class="inputtext" name="outsource_surname" value="" size="60" type="text">
<label>Company:</label><input class="inputtext" name="outsource_company" value="" size="60" type="text">
<input type="submit" name="OK" class="but" value="<?=GetMessage("subscr_form_button")?>" />
<div class="spacer"></div>
</form>
</div>
<br />
