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
    <?
//квизы
if ($arParams['PROPERTY_TYPE_EVENT'] == 316){?>
    <h2 class="slogan"><a href="https://kahoot.it/">Переход на квиз</a></h2>
    <? } ?>
<br />
<?endif?>
<?if (strlen($arResult["MESSAGE"]) > 0) { }else { ?>
<div id="stylized" class="myform">
<?//print_r($arParams['URL_FORM_PARAMETER'])?>
<?if ((strlen($_REQUEST["ID_TIME"])>0)) {?>
<?$arParams['URL_FORM_PARAMETER']=str_replace("?", "&", $arParams['URL_FORM_PARAMETER']);?>
<?}?>
<form name="iblock_add_<?=$arParams['ANCHOR_PARAMETER']?>"
      action="<?=POST_FORM_ACTION_URI?>"
      method="post" enctype="multipart/form-data" id="submit_form_<?=$arParams['ANCHOR_PARAMETER']?>"
      onsubmit="document.getElementById('submit_button_register').style.display='none'; document.getElementById('message_sending').style.display='block';"  >
    <h3 id="event_n"><?=$arEventInfo['CODE']?> <?=$arEventInfo['NAME']?></h3>
	<?GLOBAL $arInfo?>
	<input type="hidden"  id="event_type_id" name="PROPERTY[248]" value="<?=$arParams['PROPERTY_TYPE_EVENT']?>" />
	<input type="text" style="display:none;"  id="event_name"  value="<?=$arInfo['LANDING_NAME']?>" name="PROPERTY[NAME][0]" style="display:none;">
	<input type="hidden" name="PROPERTY[313][0]" value="<?=$arInfo["TIME_ID"]?>">
    <input type="hidden" name="PROPERTY[314][0]" value="<?=$arInfo["LANDING_ID"]?>">
    <input type="hidden" name="PROPERTY[315][0]" value="<?=$arInfo["LANDING_DURATION"]?>">
	<input type="hidden" name="courseID" value="<?=$arInfo['COURSE_ID']?>"/>
	<input type="hidden" name="checkcap" class="checkcap" value=""/>
	<input type="hidden" class="required" value="" name="PROPERTY[244][0]" size="25">
	<div class="field-wrap">
	ФИО:*<br/>
	<input type="text" class="required" value="<?=$arUserInfo['LastName']?>" name="PROPERTY[811][0]" size="25">
	</div>

	<div class="field-wrap" style="width:188px; margin-right: 9px; float: left;">
	E-mail:*<br/>
	<input type="text" value="<?=$arUserInfo["EMAIL"]?>" style="width: 172px" class="required email" name="PROPERTY[246][0]" size="25">
	</div>
	<div class="field-wrap" style="width:188px; float: left;">
	Телефон:*<br/>
	<input type="text" class="required" style="width: 205px"  value="<?=$arUserInfo["PERSONAL_PHONE"]?>" name="PROPERTY[247][0]" size="25">
	</div>
	<div style="clear:both"></div>
	<div class="field-wrap" >
	Компания:*<br/>
	<input type="text" class="required" value="<?=$arUserInfo['WORK_COMPANY']?>" name="PROPERTY[245][0]" size="25">
	<div style="display: none;" class="it-label">Сотрудники компании Luxoft подают заявки на курсы и тренинги через систему LuxTalent для получения подтверждения от PPM</div>
	</div>
	<div class="field-wrap">
	Город:*<br/>
	<input type="text" class="required" value="<?=$arUserInfo["WORK_POSITION"]?>" name="PROPERTY[249][0]" size="25">
	</div>
	<div class="field-wrap">
	Комментарий:<br/>
	<textarea cols="60" rows="2" name="PROPERTY[345][0]"></textarea>
	</div>					

					<label class="agree-text" ><input id="form-reg-agree" checked="checked" name="agree" value="Y" type="checkbox"/> Настоящим я подтверждаю, что я ознакомлен с <a style="color: #535353; text-decoration: underline;" target="_blank" href="/terms-of-use/">Условиями использования</a>, условия мне понятны и я согласен соблюдать их.</label><br/>
					<label class="agree-text" ><input id="form-reg-two" checked="checked" name="agree-2" value="Y" type="checkbox"/> Я ознакомлен с порядком обработки моих персональных данных согласно <a style="color: #535353; text-decoration: underline;" target="_blank" href="/privacy-policy/">Политике в сфере персональных данных</a>.</label>
					<br/>
					<br/>
					<input onclick="javascript: pageTracker._trackEvent('FILL_FORM','COURSE','<?=$_REQUEST['ID']?>');" value="Зарегистрироваться" type="submit" class="but main-test-button" id="submit_button_register" name="iblock_submit_<?=$arParams['ANCHOR_PARAMETER']?>" value=" " />
    <label class="sign-in main-reg-button" id="message_sending" style="display:none; text-align:center;background: #F3F3F3;color:black!important;">Данные отправляются...</label>
    <?if (strlen($arParams["LIST_URL"]) > 0 && $arParams["ID"] > 0):?><input type="submit" name="iblock_apply" value="<?=GetMessage("IBLOCK_FORM_APPLY")?>" /><?endif?>




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
		$('#form-reg-agree').change(function() {
			if ($(this).prop('checked')==true) {
				console.info($(this).prop('checked'));
				if ($('#form-reg-two').prop('checked')==true) {
					console.info($('#form-reg-two').prop('checked'));
					$('.main-test-button').removeAttr('disabled');
				}
			} else {
				console.info($(this).prop('checked'));
				$('.main-test-button').prop('disabled', 'disabled');
			}
		});
		$('#form-reg-two').change(function() {
			if ($(this).prop('checked')==true) {
				if ($('#form-reg-agree').prop('checked')==true) {
					$('.main-test-button').removeAttr('disabled');
				}
			} else {
				$('.main-test-button').prop('disabled', 'disabled');
			}
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
	
        fio=$('input[name="PROPERTY[811][0]"]').val();
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
