<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//***********************************
//setting section
//***********************************
?>

<style type="text/css">

.tableworkbg {background-color:#FFFFFF;}
.tableborder {background-color:#5E6B87;}
.tablehead {background-color:#FFFFFF; border-top: solid 1px #93CBEA; border-bottom: solid 1px #C7E2FF; padding-top: 3px; padding-bottom: 3px; background-repeat: repeat-x;}
.tdpadding  {

}
</style>

<form action="<?=$arResult["FORM_ACTION"]?>" method="post">
<?echo bitrix_sessid_post();?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="data-table">
<thead><tr><td colspan="2" ><h2><?echo GetMessage("subscr_title_settings")?></h2></td></tr></thead>
<tr valign="top">
	<td width="40%" >
<div class="subscribe">
		<label><?echo GetMessage("subscr_email")?><span class="starrequired">*</span></label>
		<input type="text" name="EMAIL" value="<?=$arResult["SUBSCRIPTION"]["EMAIL"]!=""?$arResult["SUBSCRIPTION"]["EMAIL"]:$arResult["REQUEST"]["EMAIL"];?>" size="30" maxlength="255" />
</div>
		<h2><?echo GetMessage("subscr_rub")?><span class="starrequired">*</span></h2> <br />

		<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>

			<div class="box"><input type="checkbox" class="tdpadding" name="RUB_ID[]" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> /></div>
			<div class="info_text"><label><?=$itemValue["NAME"]?></label><br /></div>
			<div class="clear"></div>
		<?endforeach;?>
		<!--<br /><br /><br />
		<h2><?echo GetMessage("subscr_fmt")?></h2>
		<input type="radio" class="tdpadding" name="FORMAT" selected value="text"<?if($arResult["SUBSCRIPTION"]["FORMAT"] == "text") echo " checked"?> /><label><?echo GetMessage("subscr_text")?></label>&nbsp;&nbsp;<input type="radio" class="tdpadding" name="FORMAT" value="html"<?if($arResult["SUBSCRIPTION"]["FORMAT"] == "html") echo " checked"?> /><label>HTML</label> -->


	</td>

	<td width="60%">
	<div class="subscribe">
		<p><?echo GetMessage("subscr_settings_note1")?></p>
		<p><?echo GetMessage("subscr_settings_note2")?></p>
	</div>
	</td>

</tr>
<tfoot><tr><td colspan="2">
<div class="subscribe"><br />
	<input type="submit"  class="but" name="Save" value="<?echo ($arResult["ID"] > 0? GetMessage("subscr_upd"):GetMessage("subscr_add"))?>" />
</div>
	</td></tr></tfoot>
</table>
<input type="hidden" name="PostAction" value="<?echo ($arResult["ID"]>0? "Update":"Add")?>" />
<input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
<?if($_REQUEST["register"] == "YES"):?>
	<input type="hidden" name="register" value="YES" />
<?endif;?>
<?if($_REQUEST["authorize"]=="YES"):?>
	<input type="hidden" name="authorize" value="YES" />
<?endif;?>
</form>
<div class="botborder"> </div>