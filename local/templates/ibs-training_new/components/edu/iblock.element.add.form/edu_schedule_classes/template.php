<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
global $USER, $arEventInfo;
//iwrite($arParams);
if (strlen($arEventInfo["TYPE_ID"]) == 0) {
	$arEventInfo["TYPE_ID"] =  $arParams["PROPERTY_TYPE_EVENT"];
}
if (strlen($arEventInfo["NAME"]) == 0) {
	$arEventInfo["NAME"] =  $arParams["PROPERTY_EVENT_NAME"];
}
if (strlen($arEventInfo["DATE"]) == 0) {
	$arEventInfo["DATE"] =  $arParams["PROPERTY_EVENT_DATE_IN"];
}
if (strlen($arEventInfo["EVENT_CITY"]) == 0) {
	$arEventInfo["EVENT_CITY"] =  $arParams["PROPERTY_EVENT_CITY_IN"];
}
//iwrite($arEventInfo);
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
$arUserInfo["LOGIN"] = $USER->GetLogin();
$arUserInfo["EMAIL"] = $USER->GetParam("EMAIL");
$arUserInfo["FirstName"] = $USER->GetFirstName();
$arUserInfo["LastName"] = $USER->GetLastName();
$arUserInfo["PERSONAL_CITY"] = $arUser["PERSONAL_CITY"];
$arUserInfo["WORK_COMPANY"] = $arUser["WORK_COMPANY"];
$arUserInfo["PERSONAL_PHONE"] = $arUser["PERSONAL_PHONE"];
$arUserInfo["WORK_POSITION"] = $arUser["WORK_POSITION"];

//iwrite($arUser);
//iwrite($arParams);
//iwrite($arUserInfo);
?>
<a name="form_b"></a>
<script type="text/javascript" src="/bitrix/templates/.default/en/jquery.validate.js"></script>
<script>
	$(document).ready(function(){
		$("#submit_form").validate();
	});
</script>
<style type="text/css">
.myform {
	overflow:visible!important;
}
#stylized input.but {
	width:155px!important;
}
#stylized textarea {
	height:120px;
	width:200px;
}

</style>
<?
//echo "<pre>Template arParams: "; print_r($arParams); echo "</pre>";
//echo "<pre>Template arResult: "; print_r($arResult); echo "</pre>";
//exit();
?>
<?if (count($arResult["ERRORS"])):?>
	<?=ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif?>
<?if (strlen($arResult["MESSAGE"]) > 0):?>
<br />	<h2 class="slogan"><?=$arResult["MESSAGE"]?></h2>

 <h2>Сотрудник Учебного Центра свяжется с Вами в ближайшее время.</h2>
   <!--<span class="links"><a href="/mail/form.html">Задать вопрос по тренингу / семинару</a></span>-->
<br />	
<?endif?>
<?if (strlen($arResult["MESSAGE"]) > 0) { }else { ?>
<div id="stylized" class="myform">
<form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>#form_b" method="post" enctype="multipart/form-data" id="submit_form" >
    <h2>Регистрация</h2>
    <h3 id="event_n"><?=$arEventInfo['CODE']?> <?=$arEventInfo['NAME']?></h3>
    <p>Пожалуйста, заполните все необходимые поля.
Поля, обязательные к заполнению, отмечены звездочкой (<font color="red"><span class="form-required starrequired">*</span></font>) </p>
	<?=bitrix_sessid_post()?>
	<?if ($arParams["MAX_FILE_SIZE"] > 0):?><input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" /><?endif?>
		<?if (is_array($arResult["PROPERTY_LIST"]) && count($arResult["PROPERTY_LIST"] > 0)):?>

			<?foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>

					<label <?if (intval($propertyID) == 0) {?>style="display:none" <? } ?> <?if(in_array($propertyID, $arResult["PROPERTY_HIDDEN"])):?>style="display:none" <?endif?>  ><?if (intval($propertyID) > 0):?><?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?><?else:?><?=!empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID)?><?endif?><?if(in_array($propertyID, $arResult["PROPERTY_REQUIRED"])):?><font color="red">
<span class="form-required starrequired">*</span>
</font><?endif?></label>

						<?
						//echo "<pre>"; print_r($arResult["PROPERTY_LIST_FULL"]); echo "</pre>";
						if (intval($propertyID) > 0)
						{
							if (
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "T"
								&&
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] == "1"
							)
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "S";
							elseif (
								(
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "S"
									||
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "N"
								)
								&&
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] > "1"
							)
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "T";
						}
						elseif (($propertyID == "TAGS") && CModule::IncludeModule('search'))
							$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "TAGS";

						if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y")
						{
							$inputNum = ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) ? count($arResult["ELEMENT_PROPERTIES"][$propertyID]) : 0;
							$inputNum += $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE_CNT"];
						}
						else
						{
							$inputNum = 1;
						}

						switch ($arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"]):
							case "TAGS":
								$APPLICATION->IncludeComponent(
									"bitrix:search.tags.input",
									"",
									array(
										"VALUE" => $arResult["ELEMENT"][$propertyID],
										"NAME" => "PROPERTY[".$propertyID."][0]",
										"TEXT" => 'size="'.$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"].'"',
									), null, array("HIDE_ICONS"=>"Y")
								);
								break;
							case "T":
								for ($i = 0; $i<$inputNum; $i++)
								{

									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) > 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
									}
									else
									{
										$value = "";
									}
								?>
						<textarea cols="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>" rows="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]?>" name="PROPERTY[<?=$propertyID?>][<?=$i?>]"><?=$value?></textarea>
								<?
								}
							break;

							case "S":
							case "N":
								for ($i = 0; $i<$inputNum; $i++)
								{
									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];

									}
									else
									{
										$value = "";
									}
								?>
                                <?//проверка на hidden поля
                                ?>
								<input type="text" <?if(in_array($propertyID, $arResult["PROPERTY_HIDDEN"])):?>style="display:none;" <?endif?>  <?if ($propertyID=="NAME"){?>  id="event_name"  value="<?=$arEventInfo['CODE']?> <?=$arEventInfo['NAME']?>" style="display:none;" <? } ?>
								 <?if ($propertyID==243){?>  id="event_date" value="<?=$arEventInfo['DATE']?>" <? } ?>
								 <?if (($propertyID==244) or ($propertyID==247) or ($propertyID==249) or ($propertyID==245) or ($propertyID==265)) {?>  class="required" <? } ?>
								 <?if ($propertyID==244){?>  value="<?=$arUserInfo['LastName']?> <?=$arUserInfo['FirstName']?>"<? } ?>
								 <?if ($propertyID==245){?>  value="<?=$arUserInfo['WORK_COMPANY']?>"<? } ?>
								 <?if ($propertyID==246){?>  class="required email" value="<?=$arUserInfo['EMAIL']?>"<? } ?>
								 <?if ($propertyID==247){?>  value="<?=$arUserInfo['PERSONAL_PHONE']?>"<? } ?>
								  <?if ($propertyID==265){?>  value="<?=$arUserInfo['WORK_POSITION']?>"<? } ?>
								 <?if ($propertyID==249){?>  value="<?=$arUserInfo['PERSONAL_CITY']?>"<? } ?>
								 <?if ($propertyID==271){?>  id="event_city_text" <?
									if (strlen($arParams["PROPERTY_EVENT_CITY_IN"]) > 0){
										$value = $arParams["PROPERTY_EVENT_CITY_IN"];
									} else {
										$value = $arEventInfo["EVENT_CITY"];
									}
								} ?>
								  name="PROPERTY[<?=$propertyID?>][<?=$i?>]" size="25" value="<?=$value?>" />
								<?if(in_array($propertyID, $arResult["PROPERTY_HIDDEN"])){} else {?>
								<?if($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == "DateTime"):?><?
									$APPLICATION->IncludeComponent(
										'bitrix:main.calendar',
										'',
										array(
											'FORM_NAME' => 'iblock_add',
											'INPUT_NAME' => "PROPERTY[".$propertyID."][".$i."]",
											'INPUT_VALUE' => $value,
										),
										null,
										array('HIDE_ICONS' => 'Y')
									);
									?><!--<br /><small><?=GetMessage("IBLOCK_FORM_DATE_FORMAT")?><?=FORMAT_DATETIME?></small>--><?
								endif
								?><br /><? } ?><?
							}
							break;

							case "F":
								for ($i = 0; $i<$inputNum; $i++)
								{
									$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									?>
						<input type="hidden" name="PROPERTY[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" value="<?=$value?>" />
						<input type="file" size="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>"  name="PROPERTY_FILE_<?=$propertyID?>_<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>" /><br />
									<?

									if (!empty($value) && is_array($arResult["ELEMENT_FILES"][$value]))
									{
										?>
					<input type="checkbox" name="DELETE_FILE[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" id="file_delete_<?=$propertyID?>_<?=$i?>" value="Y" /><label for="file_delete_<?=$propertyID?>_<?=$i?>"><?=GetMessage("IBLOCK_FORM_FILE_DELETE")?></label><br />
										<?

										if ($arResult["ELEMENT_FILES"][$value]["IS_IMAGE"])
										{
											?>
					<img src="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>" height="<?=$arResult["ELEMENT_FILES"][$value]["HEIGHT"]?>" width="<?=$arResult["ELEMENT_FILES"][$value]["WIDTH"]?>" border="0" /><br />
											<?
										}
										else
										{
											?>
					<?=GetMessage("IBLOCK_FORM_FILE_NAME")?>: <?=$arResult["ELEMENT_FILES"][$value]["ORIGINAL_NAME"]?><br />
					<?=GetMessage("IBLOCK_FORM_FILE_SIZE")?>: <?=$arResult["ELEMENT_FILES"][$value]["FILE_SIZE"]?> b<br />
					[<a href="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>"><?=GetMessage("IBLOCK_FORM_FILE_DOWNLOAD")?></a>]<br />
											<?
										}
									}
								}

							break;
							case "L":

								if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["LIST_TYPE"] == "C")
									$type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "checkbox" : "radio";
								else
									$type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "multiselect" : "dropdown";

								switch ($type):
									case "checkbox":
									case "radio":

										//echo "<pre>"; print_r($arResult["PROPERTY_LIST_FULL"][$propertyID]); echo "</pre>";

										foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"][$propertyID]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"][$propertyID] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key) {$checked = true; break;}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
							<input  <?if(in_array($propertyID, $arResult["PROPERTY_HIDDEN"])):?>style="display:none" <?endif?> type="<?=$type?>" name="PROPERTY[<?=$propertyID?>]<?=$type == "checkbox" ? "[".$key."]" : ""?>" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label><br />
											<?
										}
									break;

									case "dropdown":
									case "multiselect":
									?>
							<select <?if(in_array($propertyID, $arResult["PROPERTY_HIDDEN"])):?>style="display:none;" <?endif?> <?if ($propertyID==248) {?>id="event_type_id"<? } ?>  name="PROPERTY[<?=$propertyID?>]<?=$type=="multiselect" ? "[]\" size=\"".$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]."\" multiple=\"multiple" : ""?>">
									<?
										if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
										else $sKey = "ELEMENT";

										foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											//echo "pipec";
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{

												foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum)
												{
													//echo "key = $key <br />";
													//echo "arElEnum['VALUE'] = ".$arElEnum['VALUE']." <br />";

													if ($key == $arElEnum["VALUE"]) {$checked = true; break;}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}
											if ($key == $arEventInfo["TYPE_ID"]) {$checked = true; }
											if (strlen($arResult["TYPE_ID"]) > 0) {
												if ($key == $arResult["TYPE_ID"]) {$checked = true; }
											}
											?>

								<option value="<?=$key?>" <?=$checked ? " selected=\"selected\"" : ""?>><?=$arEnum["VALUE"]?></option>
											<?
										}
									?>
							</select>
									<?
									break;

								endswitch;
							break;
						endswitch;?>

			<?endforeach;?>
			<?if($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0):?>
			<?
/*				<!--<tr>
					<td><?=GetMessage("IBLOCK_FORM_CAPTCHA_TITLE")?></td>
					<td>
						<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
					</td>
				</tr>
				<tr>
					<td><?=GetMessage("IBLOCK_FORM_CAPTCHA_PROMPT")?><span class="starrequired">*</span>:</td>
					<td><input type="text" name="captcha_word" maxlength="50" value=""></td>
				</tr> -->*/
				?>
			<?endif?>

		<?endif?>

					<input type="submit" class="but" name="iblock_submit" value="Зарегистрироваться" />
					<?if (strlen($arParams["LIST_URL"]) > 0 && $arParams["ID"] > 0):?><input type="submit" name="iblock_apply" value="<?=GetMessage("IBLOCK_FORM_APPLY")?>" /><?endif?>
					<?/*<input type="reset" value="<?=GetMessage("IBLOCK_FORM_RESET")?>" />*/?>



</form>
<div class="clear"> </div>
</div>
<?/*
<script type="text/javascript" >
	$(document).ready(function() {
      var text_info = $('#title h1').text();
      var course_code = $('#course_code').text();
      var event_city_name = $('#event_city_name').text();
      text_info = course_code +' '+ text_info;
      $("#event_name").attr("value",text_info);
      $("#event_n").text(text_info);
      var date_info = $('#from_event_date').text();
      $("input#event_date").attr("value",date_info);
<?php
	if (strlen($arParams["PROPERTY_EVENT_CITY_IN"]) > 0){ } else { ?>
	    $("input#event_city_text").attr("value",event_city_name);
<?php } ?>
      $("#event_type_id").val(<?=$arResult["TYPE_ID"]?>);
	});
</script>
*/?>
<? } ?>
