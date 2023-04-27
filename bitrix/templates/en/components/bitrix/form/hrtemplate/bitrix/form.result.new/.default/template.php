<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS"];?><?endif;?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>
<?=bitrix_sessid_post()?>

<table>
<?
if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y")
{
?>
	<tr>
		<td><?
/***********************************************************************************
					form header
***********************************************************************************/
if ($arResult["isFormTitle"])
{
?>
	<h3><?//=$arResult["FORM_TITLE"]?></h3>
<?
} //endif ;

	if ($arResult["isFormImage"] == "Y")
	{
	?>
	<a href="<?=$arResult["FORM_IMAGE"]["URL"]?>" target="_blank" alt="<?=GetMessage("FORM_ENLARGE")?>"><img src="<?=$arResult["FORM_IMAGE"]["URL"]?>" <?if($arResult["FORM_IMAGE"]["WIDTH"] > 300):?>width="300"<?elseif($arResult["FORM_IMAGE"]["HEIGHT"] > 200):?>height="200"<?else:?><?=$arResult["FORM_IMAGE"]["ATTR"]?><?endif;?> hspace="3" vscape="3" border="0" /></a>
	<?//=$arResult["FORM_IMAGE"]["HTML_CODE"]?>
	<?
	} //endif
	?>

			<p><?=$arResult["FORM_DESCRIPTION"]?></p>
		</td>
	</tr>
	<?
} // endif
	?>
</table>
<br />
<?
/***********************************************************************************
						form questions
***********************************************************************************/
?>
<table class="form-table data-table">
	<thead>
		<tr>
			<th colspan="2">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
	<?
	//print_r($arResult["QUESTIONS"]);
	echo "";
    if (isset($_GET["id"]) and (is_numeric($_GET["id"]))){ $id_vacancy  = $_GET["id"]; } else {$id_vacancy  =119;}
      if(CModule::IncludeModule("iblock"))
 {
	if (isset($id_vacancy))
	{
	    $arFilter = array();
	    $arFilter["ID"] = $id_vacancy;
	    $items = GetIBlockElementList(1, false, $arSort, 1, $arFilter );
	    while($arItem = $items->GetNext())
	   {
	   	  $arIBlockElement = GetIBlockElement($id_vacancy);
	      $vacancy_name = $arItem["NAME"];
	      $vacancy_intcode = $arIBlockElement['PROPERTIES']['int_id']['VALUE'];
	      $vacancy_emailteacher = $arIBlockElement['PROPERTIES']['email']['VALUE'];
   	   }
    }
 }


 //echo "$vacancy_emailteacher<BR>";
// echo "$vacancy_intcode<BR>";
 // print_r($arResult["QUESTIONS"]);
// echo  $arResult['QUESTIONS']['code']['CAPTION'];
 //   $arResult['QUESTIONS']['STRUCTURE']['0']['code']['VALUE']= $vacancy_intcode;
    $arResult['QUESTIONS']['name']['STRUCTURE']['0']['VALUE']= $vacancy_name;
    $arResult['QUESTIONS']['code']['STRUCTURE']['0']['VALUE'] = $vacancy_intcode;
    $arResult['QUESTIONS']['hremail']['STRUCTURE']['0']['VALUE']= $vacancy_emailteacher;

 //  "<input type="hidden" name="form_hidden_609" value="77777"/>"
    $htmlcode  = "<input type='hidden' name='form_hidden_";
    $htmlcode  .= $arResult['QUESTIONS']['code']['STRUCTURE']['0']['ID'];
    $htmlcode  .="' value='$vacancy_intcode'/>";
    echo "<B>$htmlcode<B>";
    $arResult['QUESTIONS']['code']['HTML_CODE']=$htmlcode;



     $htmlcode  = "<input type='hidden' name='form_hidden_";
    $htmlcode  .= $arResult['QUESTIONS']['name']['STRUCTURE']['0']['ID'];
    $htmlcode  .="' value='$vacancy_name'/>";
    echo "<B>$htmlcode<B>";
    $arResult['QUESTIONS']['name']['HTML_CODE']=$htmlcode;



     $htmlcode  = "<input type='hidden' name='form_hidden_";
    $htmlcode  .= $arResult['QUESTIONS']['hremail']['STRUCTURE']['0']['ID'];
    $htmlcode  .="' value='$vacancy_emailteacher'/>";
    echo "<B>$htmlcode<B>";
    $arResult['QUESTIONS']['hremail']['HTML_CODE']=$htmlcode;

  //print_r($arResult["QUESTIONS"]);

	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
	?>
		<tr>
			<td>
				<?if ($arQuestion["STRUCTURE"]['0']['FIELD_TYPE'] !== "hidden"):?><?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><?=$arResult["REQUIRED_SIGN"];?><?endif;?><?endif;?>
				<?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
			</td>
			<td><?=$arQuestion["HTML_CODE"]?></td>
		</tr>
	<?
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
			<td><input type="hidden" name="captcha_sid" value="<?=htmlspecialchars($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialchars($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>
		</tr>
		<tr>
			<td><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></td>
			<td><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></td>
		</tr>
<?
} // isUseCaptcha
?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="2">
				<input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"];?>" />
				<?if ($arResult["F_RIGHT"] >= 15):?>
				&nbsp;<input type="hidden" name="web_form_apply" value="Y" /><input type="submit" name="web_form_apply" value="<?=GetMessage("FORM_APPLY")?>" />
				<?endif;?>
				&nbsp;<input type="reset" value="<?=GetMessage("FORM_RESET");?>" />
			</th>
		</tr>
	</tfoot>
</table>
<p>
<?=$arResult["REQUIRED_SIGN"];?> - <?=GetMessage("FORM_REQUIRED_FIELDS")?>
</p>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>