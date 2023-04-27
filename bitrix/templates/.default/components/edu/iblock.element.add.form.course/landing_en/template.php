<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
global $USER, $arEventInfo, $arCoursesInfo,$gCourseFormat;
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

if (is_array($_COOKIE["form_PROP"])) {
    $arUserInfo["EMAIL"]=$_COOKIE["form_PROP"]["246"];
    $arUserInfo["LastName"]=$_COOKIE["form_PROP"]["244"];
    $arUserInfo["WORK_COMPANY"] = $_COOKIE["form_PROP"]["245"];
    $arUserInfo["PERSONAL_CITY"] = $_COOKIE["form_PROP"]["249"];
    $arUserInfo["PERSONAL_PHONE"]= $_COOKIE["form_PROP"]["247"];


} else {
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
}
//iwrite($arUser);
//iwrite($arResult);
//iwrite($arParams);
//iwrite($arUserInfo);
?>
<a name="form_b"></a>
<script>
	$(document).ready(function(){
		$("#submit_form_<?=$arParams['ANCHOR_PARAMETER']?>").validate();
		$('.checkcap').val('secrettext123');
	});
</script>
<style type="text/css">
.myform {
	overflow:visible!important;
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
<?//print_r($arResult);
?>
<?/*if (strlen($arResult["MESSAGE.".$arParams['ANCHOR_PARAMETER'].""]) > 0):*/?>
<?if (strlen($arResult["MESSAGE"]) > 0):?>
<?php
// Function to return the JavaScript representation of a TransactionData object.
function getTransactionJs(&$trans) {
	return "ga('ecommerce:addTransaction', {'id': '".$trans['id']."', 'revenue': '".$trans['revenue']."', 'currency': 'RUB'});";
	}

// Function to return the JavaScript representation of an ItemData object.
function getItemJs(&$transId, &$item) {
  return "ga('ecommerce:addItem', {'id': '".$transId."', 'name': '".$item['name']."', 'sku': '".$item['sku']."', 'currency': 'RUB', 'quantity': '1', 'price': '".$item['price']."'});";
}
?>
<?

	$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_event_city", "PROPERTY_date", "PROPERTY_timetable_id");
	$arFilter = Array("IBLOCK_ID"=> 64, "ID"=> $_REQUEST["FORM_RESULT_ID"]);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	if ($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		//print_r($arFields);
		$arSelect1 = Array("ID", "NAME", "DATE_ACTIVE_FROM", "CATALOG_GROUP_1");
		$arFilter1 = Array("IBLOCK_ID"=> 9, "ID"=>$arFields["PROPERTY_TIMETABLE_ID_VALUE"]);
		$res1 = CIBlockElement::GetList(Array(), $arFilter1, false, false, $arSelect1);
		if ($ob1 = $res1->GetNextElement())
		{
			$arFields1 = $ob1->GetFields();
			//print_r($arFields1);
			$trans=array("id"=> $_REQUEST["FORM_RESULT_ID"], "revenue"=>$arFields1["CATALOG_PRICE_1"]);
			$items[]=array("name"=> $arFields["NAME"].' '.$arFields["PROPERTY_EVENT_CITY_VALUE"]." ".$arFields["PROPERTY_DATE_VALUE"], "sku"=> $arFields1["ID"], "price"=> $arFields1["CATALOG_PRICE_1"]);
			?>
			<script>
			ga('require', 'ecommerce');
			<?php
			echo getTransactionJs($trans);

			foreach ($items as &$item) {?>
			
			<? echo getItemJs($trans['id'], $item);
			}
			?>
			
			ga('ecommerce:send');
			
			</script>
		<?
		}
		
		
	}

?>
<br />
<?
//семинар  - вебинар
if ($arParams['PROPERTY_TYPE_EVENT'] == 80){?>
	<h2 class="slogan"><?=$arResult["MESSAGE"]?></h2>
	<? if ($arEventInfo["WEBINAR"] == "TRUE"){?>
		<h2>В ближайшее время на указанный Вами email будет выслано письмо с инструкцией по тому, как принять участие в вебинаре.</h2>
	<? } else {?>
		<h2>В ближайшее время на указанный Вами email будет выслано письмо с инструкцией по тому, как принять участие в семинаре.</h2>
	<? } ?>

<? } ?>
<?
//курс
if ($arParams['PROPERTY_TYPE_EVENT'] == 78){?>
	<h2 class="slogan"><?=$arResult["MESSAGE"]?></h2>
	<h2>Сотрудник Учебного Центра свяжется с Вами в ближайшее время.</h2>
	<?if (isset($_REQUEST["FORM_RESULT_ID"]) and (is_numeric($_REQUEST["FORM_RESULT_ID"]))){?>
		<?$arIDMethodPayment = GetIDMethodPayment($_REQUEST["FORM_RESULT_ID"]);
		//если метод оплаты  - онлайн 125  деаме перенапрвление на корзину
		if ($arIDMethodPayment["PAYMENT_ID"] ==  125){?>
		<p>Вы сейчас будете перенаправлены на страницу для оплаты курса online / по квитанции через банк. (при оформлении заказа укажите тип плательщика: Физическое лицо)<br /></p>
		Проблемы с перенаправлением? Пожалуйста, используйте <a href='/services/buy_course.html?action=BUY&id=<?=$arIDMethodPayment["TIMETABLE_ID"]?>&ID_RECORD=<?=$_REQUEST["FORM_RESULT_ID"]?>'> прямую ссылку.</a>
		<script type="text/javascript">
			setTimeout('Redirect()',5000);
			function Redirect()
			{
			  location.href = '/services/buy_course.html?action=BUY&id=<?=$arIDMethodPayment["TIMETABLE_ID"]?>&ID_RECORD=<?=$_REQUEST["FORM_RESULT_ID"]?>';
			}

		</script>

		<? } ?>
        <?if ($arIDMethodPayment["PAYMENT_ID"] ==  126){?>
        <p>На ваш email отправлено письмо с приглашением посетить данный курс. Вышлите, пожалуйста, все необходимые реквизиты для составления договора в ответе на данное письмо.<br />Либо  вы можете перейти по следующей <a href='/services/buy_course.html?action=BUY&id=<?=$arIDMethodPayment["TIMETABLE_ID"]?>&ID_RECORD=<?=$_REQUEST["FORM_RESULT_ID"]?>'>ссылке</a> для получения всех необходимых документов автоматически. (при оформлении заказа укажите тип плательщика: Юридическое лицо)</p>
        <? } ?>
	<? } ?>
	   <!--<span class="links"><a href="/mail/form.html">Задать вопрос по тренингу / семинару</a></span>-->
<? } ?>
<?
//конференция
if ($arParams['PROPERTY_TYPE_EVENT'] == 82){?>
	<h2 class="slogan"><?=$arResult["MESSAGE"]?></h2>
	<h2>Сотрудник Учебного Центра свяжется с Вами в ближайшее время.</h2>
	   <!--<span class="links"><a href="/mail/form.html">Задать вопрос по тренингу / семинару</a></span>-->
<? } ?>
<?
//школы  классы
if ($arParams['PROPERTY_TYPE_EVENT'] == 79){?>
	<h2 class="slogan"><?=$arResult["MESSAGE"]?></h2>
	<h2>Сотрудник Учебного Центра свяжется с Вами в ближайшее время.</h2>
	   <!--<span class="links"><a href="/mail/form.html">Задать вопрос по тренингу / семинару</a></span>-->
<? } ?>
<?
//круглые столы
if ($arParams['PROPERTY_TYPE_EVENT'] == 81){?>
	<h2 class="slogan"><?=$arResult["MESSAGE"]?></h2>
	<h2>Сотрудник Учебного Центра свяжется с Вами в ближайшее время.</h2>
	   <!--<span class="links"><a href="/mail/form.html">Задать вопрос по тренингу / семинару</a></span>-->
<? } ?>
<br />
<?endif?>
<?if (strlen($arResult["MESSAGE"]) > 0) { }else { ?>
<div id="stylized" class="myform">
<?//print_r($arParams['URL_FORM_PARAMETER'])?>
<?if ((strlen($_REQUEST["ID_TIME"])>0)) {?>
<?$arParams['URL_FORM_PARAMETER']=str_replace("?", "&", $arParams['URL_FORM_PARAMETER']);?>
<?}?>
<form name="iblock_add_<?=$arParams['ANCHOR_PARAMETER']?>" action="<?=POST_FORM_ACTION_URI?>#<?=$arParams['ANCHOR_PARAMETER']?>" method="post" enctype="multipart/form-data" id="submit_form_<?=$arParams['ANCHOR_PARAMETER']?>" >
    <h3 id="event_n"><?=$arEventInfo['CODE']?> <?=$arEventInfo['NAME']?></h3>
	<?GLOBAL $arInfo?>
	<?/*if ($USER->IsAdmin()) {?>
		<?print_r($arInfo)?>
	<?}*/?>
	<input type="hidden"  id="event_type_id" name="PROPERTY[248]" value="78" />
	<input type="text" style="display:none;"  id="event_name"  value="<?=$arInfo['NAME']?>" name="PROPERTY[NAME][0]" style="display:none;">
	<input type="hidden" name="PROPERTY[313][0]" value="<?=$arInfo["TIME_ID"]?>">
	<input  type="hidden" name="courseID" value="<?=$arInfo['COURSE_ID']?>"/>
	<input type="hidden" name="checkcap" class="checkcap" value=""/>
	<input type="hidden" class="required" value="" name="PROPERTY[244][0]" size="25">
	<div class="field-wrap">
	Last Name:<span class="req">*</span><br/>
	<input type="text" class="required" value="<?=$arUserInfo['LastName']?>" name="PROPERTY[811][0]" size="25">
	</div>
	<div class="field-wrap">
	First Name:<span class="req">*</span><br/>
	<input type="text" class="required" value="<?=$arUserInfo['FirstName']?>" name="PROPERTY[812][0]" size="25">
	</div>
	<div class="field-wrap" style="width:188px; margin-right: 9px; float: left;">
	E-mail:<span class="req">*</span><br/>
	<input type="text" value="<?=$arUserInfo["EMAIL"]?>" style="width: 172px" class="required email" name="PROPERTY[246][0]" size="25">
	</div>
	<div class="field-wrap" style="width:188px; float: left;">
	Phone:<span class="req">*</span><br/>
	<input type="text" class="required" style="width: 172px"  value="<?=$arUserInfo["PERSONAL_PHONE"]?>" name="PROPERTY[247][0]" size="25">
	</div>
	<div style="clear:both"></div>
	<div class="field-wrap" >
	Company:<span class="req">*</span><br/>
	<input type="text" class="required" value="<?=$arUserInfo['WORK_COMPANY']?>" name="PROPERTY[245][0]" size="25">
	<div style="display: none;" class="it-label">Сотрудники компании Luxoft подают заявки на курсы и тренинги через систему IntHR для получения подтверждения от PPM</div>
	</div>
	<div class="field-wrap">
	City:<span class="req">*</span><br/>
	<input type="text" class="required" value="" name="PROPERTY[249][0]" size="25">
	</div>
	<div class="field-wrap">
	Comment:<br/>
	<textarea cols="60" rows="5" name="PROPERTY[345][0]"></textarea>
	</div>					
<?/*
	 <?if ($arResult["DISCOUNT"]=="Y"){?>
        <input type="hidden" name="dis" value="Y"/>
		
        <input type="hidden" name="ID_TIME" value="<?=$arResult["ID_TIME"]?>"/>
    <?}?>
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
							case "E":
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
								 <?if ($propertyID==243){?>  id="event_date" value="<?/*if (isset($_REQUEST['IN_CITY']) === false){?><?=$arEventInfo['DATE']?><? } /*?>" <?/* } */?>
								 <?/*if (($propertyID==244) or ($propertyID==247) or ($propertyID == 249) or ($propertyID == 245) or ($propertyID==265)) {?>  class="required" <? } ?>
								 <?if ($propertyID==244){?>  value="<?=$arUserInfo['LastName']?> <?=$arUserInfo['FirstName']?>"<? } ?>
								 <?if ($propertyID==245){?>  value="<?=$arUserInfo['WORK_COMPANY']?>"<? } ?>
								 <?if ($propertyID==246){?>  value="<?=$arUserInfo['EMAIL']?>" class="required email"<? } ?>
								 <?if ($propertyID==247){?>  value="<?=$arUserInfo['PERSONAL_PHONE']?>"<? } ?>
								 <?if ($propertyID==265){?>  value="<?=$arUserInfo['WORK_POSITION']?>"<? } ?>
								 <?if ($propertyID==249){?>  value="<?=$arUserInfo['PERSONAL_CITY']?>"<? } ?>
								 <?if (($propertyID==313) and (isset($_REQUEST['IN_CITY']) !== true)) {?>  value="<?=$arEventInfo['TIMETABLE_ID']?>"<? } ?>
                                 <?if ($propertyID==407){?>  value="<?=$_REQUEST['IN_CITY']?>"<? } ?>
								 <?if ($propertyID==271){?>  id="event_city_text" <?
									/*
									if (strlen($arParams["PROPERTY_EVENT_CITY_IN"]) > 0){
										$value = $arParams["PROPERTY_EVENT_CITY_IN"];
									} else {
										$value = $arEventInfo["EVENT_CITY"];
									}
									*//*
									if (isset($_REQUEST['IN_CITY']) === true){
										$value = "";
									}
								 }
								 /*?>
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
							<select <?if(in_array($propertyID, $arResult["PROPERTY_HIDDEN"])):?>style="display:none;" <?endif?>
							 <?if ($propertyID==248) {?>id="event_type_id"<? } ?>
							 <?if (($propertyID==313) or ($propertyID==407)) {?>
							 name="PROPERTY[<?=$propertyID?>][0]" class="date_select" >
							 <? } else { ?>
							 name="PROPERTY[<?=$propertyID?>]<?=$type=="multiselect" ? "[]\" size=\"".$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]."\" multiple=\"multiple" : ""?>">
							 <? } ?>
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
							</select><div class="clear"></div>
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
			<?/*endif?>

		<?endif?>
<?*/?>
					<input onclick="javascript: pageTracker._trackEvent('FILL_FORM','COURSE','<?=$_REQUEST['ID']?>');" type="submit" class="but en" name="iblock_submit_<?=$arParams['ANCHOR_PARAMETER']?>" value="Sign Up" />
					<?if (strlen($arParams["LIST_URL"]) > 0 && $arParams["ID"] > 0):?><input type="submit" name="iblock_apply" value="Sign Up" /><?endif?>




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
<script type="text/javascript" >
    $(document).ready(function() {
        check_n_hide();
        $('.date_select[name="PROPERTY[313][0]"]').change(function(){
            check_n_hide();
        });
		$('input[name="PROPERTY[245][0]"]').change(function() {
			if ($(this).val().toUpperCase()=="LUXOFT" || $(this).val().toUpperCase()=="ЛЮКСОФТ") {
				console.info("123");
				$(this).parent().find('.it-label').css('display', 'block');
			} else {
				$(this).parent().find('.it-label').css('display', 'none');
			}
		 })

    })
	 $('form[name="iblock_add_tab-record-link"]').submit(function() {
	
        fio=$('input[name="PROPERTY[811][0]"]').val()+" "+$('input[name="PROPERTY[812][0]"]').val();
        $('input[name="PROPERTY[244][0]"]').val(fio);
    });
    function check_n_hide() {
        if ($('.date_select[name="PROPERTY[313][0]"]').val()!="0") {
            $('.date_select[name="PROPERTY[407][0]"]').attr('disabled', 'disabled');
            $('.date_select[name="PROPERTY[407][0]"]').hide();
            $('.date_select[name="PROPERTY[407][0]"]').prev().hide();
        } else {
            $('.date_select[name="PROPERTY[407][0]"]').removeAttr('disabled');
            $('.date_select[name="PROPERTY[407][0]"]').show();
            $('.date_select[name="PROPERTY[407][0]"]').prev().show();
        }
        console.info();
    }
</script>
