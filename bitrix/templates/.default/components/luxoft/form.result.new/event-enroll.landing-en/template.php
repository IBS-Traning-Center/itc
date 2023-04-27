<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?//iwrite($arResult);?>

<?if ($arResult["isFormErrors"] == "Y"):?>
    <div class="alert alert-error">
    <p><?=$arResult["FORM_ERRORS_TEXT"];?></p>
    </div>
<?endif;?>
<?if ($_REQUEST["formresult"]){?>
    <div class="alert alert-success">
        <p><?=$arResult["FORM_NOTE"]?></p>
    </div>
	
	<?if ($_REQUEST["CODE"]=="JVA-028" || $_REQUEST["CODE"]=="ADM-007" || $_REQUEST["CODE"]=="SCRIPT-002" ||  $_REQUEST["CODE"]=="SQA-026") {?>
	<?$APPLICATION->AddHeadString("<!-- Facebook Conversion Code for Luxoft Training --><script>(function() {var _fbq = window._fbq || (window._fbq = []);
		if (!_fbq.loaded) {
		var fbds = document.createElement('script');
		fbds.async = true;
		fbds.src = '//connect.facebook.net/en_US/fbds.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(fbds, s);
		_fbq.loaded = true;
		}
		})();
		window._fbq = window._fbq || [];
		window._fbq.push(['track', '6025506205846', {'value':'0.01','currency':'USD'}]);
		</script>
		<noscript><img height='1' width='1' alt='' style='display:none' src='https://www.facebook.com/tr?ev=6025506205846&amp;cd[value]=0.01&amp;cd[currency]=USD&amp;noscript=1' /></noscript>
		",true)?>
		<?}?>
<? } ?>
<?if (!$_REQUEST["formresult"]){?>
   <?=$arResult["FORM_NOTE"]?>
<? } ?>

<?if ($arResult["isFormNote"] != "Y")
{
?>
<?$arResult["FORM_HEADER"]  = str_replace("<form", "<form class=\"form-horizontal\"", $arResult["FORM_HEADER"]); ?>
<?=$arResult["FORM_HEADER"]?>


<?if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y"){?>
<?
/***********************************************************************************
					form header
***********************************************************************************/
if ($arResult["isFormTitle"]){?>
	 <?GLOBAL $arInfo?>

<? } ?>
    <!--
    <p>
        <?=$arResult["REQUIRED_SIGN"];?> - <?=GetMessage("FORM_REQUIRED_FIELDS")?>
    </p>
    -->
    <?

	if ($arResult["isFormImage"] == "Y"){	?>
	    <?//=$arResult["FORM_IMAGE"]["HTML_CODE"]?>
	<? } //endif ?>
		<?=$arResult["FORM_DESCRIPTION"]?>
	<? } //endif ?>
<?
/***********************************************************************************
						form questions
***********************************************************************************/
?>
    <fieldset>
        <?if (is_array($arResult['COURSES']) && !empty($arResult['COURSES'])){?>
        <div style="display: none;" class="row">
            <label class="control-label" for="field661">Choose dates</label>
            <div class="controls">
                <div class="input-append">
                    <input class="span2" <?if (count($arResult['COURSES'])>0) {?> value="<?=$arResult['COURSES'][0]['FULL_DATES']?>, <?=$arResult['COURSES'][0]['CITY_ID_NAME']?>" <?}?> id="appendedDropdownButton" type="text" name="form_text_661" id="field661">
                    <div class="btn-group">
                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                            Dates
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <?foreach($arResult['COURSES'] as $arCourse){?>
                            <li><a data-schedule-id="<?=$arCourse['ID']?>" href="#enroll"><?=$arCourse['FULL_DATES']?>, <?=$arCourse['CITY_ID_NAME']?></a></li>
                            <? } ?>
                            <li><a data-no-set="Y" href="#enroll">My preferred dates</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <? } ?>

        <?if (!is_array($arResult['COURSES']) || empty($arResult['COURSES'])){?>
        <div class="row">
            <label class="control-label" for="field661">My preferred dates</label>
            <div class="controls">
                    <input  class="inputtext required" type="text" name="form_text_661" id="field661">

            </div>
        </div>
        <? } ?>
		<input type="hidden" name="form_hidden_660" <?if (count($arResult['COURSES'])>0) {?>value="<?=$arResult['COURSES'][0]["ID"]?>"<?}?>>
		<input type="hidden" name="check_bot" value="" class="check-me"/>
	<?
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
		if ($arQuestion["STRUCTURE"][0]['ID'] == 661)
            continue;
		if ($arQuestion["STRUCTURE"][0]['ID'] == 660)
            continue;
        if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
		{
			echo $arQuestion["HTML_CODE"];
		}
		else
		{
            if ($arQuestion["STRUCTURE"][0]['FIELD_TYPE'] === "email"){
                  $arQuestion["HTML_CODE"] = str_replace("class=\"inputtext\"","class=\"inputtext required email\"", $arQuestion["HTML_CODE"]);
            }
            if ($arQuestion["REQUIRED"] === "Y"){
                $arQuestion["HTML_CODE"] = str_replace("class=\"inputtext\"","class=\"inputtext required\"", $arQuestion["HTML_CODE"]);
            }
            $arQuestion["HTML_CODE"] = str_replace("input ","input id=\"field".$arQuestion["STRUCTURE"][0]['ID']."\"", $arQuestion["HTML_CODE"]);
            $arQuestion["HTML_CODE"] = str_replace("textarea ","textarea id=\"field".$arQuestion["STRUCTURE"][0]['ID']."\"", $arQuestion["HTML_CODE"]);
            $arQuestion["HTML_CODE"] = str_replace("value=\"662\"", "", $arQuestion["HTML_CODE"]);
	?>
            <div class="row" <?if (($arQuestion["STRUCTURE"][0]['ID']==662) && (count($arResult['COURSES'])>0)) {?> style="display:none" <?}?>>
                <label class="control-label"  for="field<?=$arQuestion["STRUCTURE"][0]['ID']?>"><?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><span class="required">*</span><?endif;?></label>
                <div class="controls">
                    <?=$arQuestion["HTML_CODE"]?>
                    <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
                        <span class="help-inline error-fld"><?=$arResult["FORM_ERRORS"][$FIELD_SID]?></span>
                    <?endif;?>

                </div>
            </div>


	<?
		}
	} //endwhile
	?>
<?
if($arResult["isUseCaptcha"] == "Y")
{
?>
		<tr>
			<th colspan="2"><b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b></th>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>
		</tr>
		<tr>
			<td><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></td>
			<td><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></td>
		</tr>
<?
} // isUseCaptcha
?>
	<?/*
	<div class="control-group">
		<div class="controls">
			<label class='checkbox'><input type="checkbox"  checked name="subscribe" value="Y"> Upgrade your skills by subscribing to our monthly newsletter</label>
		</div>
	</div>
	*/?>
	<div class="centered">
        <input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> class="btn submit" style="border:none" type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
        <?if ($arResult["F_RIGHT"] >= 15):?>
				<input type="hidden" name="web_form_apply" value="Y" /><!--<input type="submit" name="web_form_apply" value="<?=GetMessage("FORM_APPLY")?>" />-->
        <?endif;?>
    </div>




    </fieldset>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>

<script>
	$('.check-me').val('iamnotbot');
</scripT>