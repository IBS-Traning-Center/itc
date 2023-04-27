<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (count($arResult["ITEMS"])!=0) {?>

<?

	// сначала  получим валюту города
	// Рубли или Гривны

    // для массива куда мы будем ложить значения
	$ii=0;
	$arValueOfCourses = array();
	foreach($arResult["ITEMS"] as $arItem):?>
	<?
		$prepod_surname="";$prepod_name="";$prepod_code="";
		$schedule_course_id = $arItem['PROPERTIES']['schedule_course']['VALUE'];
		$schedule_city = $arItem['PROPERTIES']['schedule_city']['VALUE'];
		$scheduled_city = $arItem['PROPERTIES']['city']['VALUE'];
		$schedule_startdate = $arItem['PROPERTIES']['startdate']['VALUE'];
		$schedule_startdate_origin = date("Y-m-d", strtotime($arItem['PROPERTIES']['startdate']['VALUE']));
		$schedule_enddate = $arItem['PROPERTIES']['enddate']['VALUE'];
		$schedule_enddate_origin = date("Y-m-d", strtotime($arItem['PROPERTIES']['enddate']['VALUE']));
		$schedule_time = $arItem['PROPERTIES']['schedule_time']['VALUE'];
		$schedule_description = $arItem['PROPERTIES']['schedule_description']['VALUE']['TEXT'];
		$schedule_price = $arItem['PROPERTIES']['schedule_price']['VALUE'];
		$schedule_onl_price = $arItem['PROPERTIES']['schedule_onl_price']['VALUE'];
		$schedule_duration = $arItem['PROPERTIES']['schedule_duration']['VALUE'];
		$schedule_teacher_id = $arItem['PROPERTIES']['teacher']['VALUE'];
		$schedule_teacher_string = $arItem['PROPERTIES']['string_teacher']['VALUE'];
		//if ($schedule_enddate == "")  { } else   {  $schedule_startdate = $schedule_startdate." - ".$schedule_enddate; }
		//iwrite($arItem['PROPERTIES']['IS_CLOSE']);

		// теперь  получим цену курса  и ее
		// длительность по умолчанию
 		$arSelect = Array(
	 		"PROPERTY_course_price",
			"XML_ID",
			"PROPERTY_course_duration",
	 		"PROPERTY_course_idcategory",
	 		"PROPERTY_course_code",
			"PROPERTY_course_format",
	 		"NAME"
 		);
		$arFilter = Array(
			"IBLOCK_ID"=>6,
			"ID"=>$schedule_course_id
		);

		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$course_city = $ar_fields["PROPERTY_CITY_VALUE"];
			$course_price= $ar_fields["PROPERTY_COURSE_PRICE_VALUE"];
	 		$course_duration= $ar_fields["PROPERTY_COURSE_DURATION_VALUE"];
	 		$course_id_category= $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
	 		$course_code= $ar_fields["PROPERTY_COURSE_CODE_VALUE"];
	 		$course_online_enumid= $ar_fields["PROPERTY_COURSE_FORMAT_ENUM_ID"];
	 		$courseNameFromCatalog = $ar_fields["NAME"];
			$courseXML=$ar_fields["XML_ID"];


		}
        if ($schedule_price == "") {
        	$schedule_price =  $course_price;
        }
        if ($schedule_duration == ""){
        	$schedule_duration =  $course_duration;
        }


        // теперь  получим имя категории
        // и ее сортировку в категориях курсов ID =50
  		$arSelect = Array("NAME", "SORT");
		$arFilter = Array("IBLOCK_ID"=>50,"ID"=>$course_id_category);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$cat_name= $ar_fields["NAME"];
	 		$cat_sort= $ar_fields["SORT"];
	 		$cat_date_sort = ($ar_fields["SORT"]*100)+$ii;
		}

		$prepod_surname="";
		$prepod_code="";
		$prepod_active="";
		$prepod_name="";

		if  ($schedule_teacher_id > 0) {
	        //теперь  получим имя преподавателя
	  		$arSelect = Array("NAME", "PROPERTY_expert_name", "PROPERTY_EXPERT_EMAIL1", "CODE", "ACTIVE");
			$arFilter = Array("IBLOCK_ID"=>56,"ID"=>$schedule_teacher_id);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ar_fields = $res->GetNext())
			{
		 		$prepod_surname = $ar_fields["NAME"];
		 		$prepod_code    = strtolower($ar_fields["CODE"]);
		 		$prepod_name    = $ar_fields["PROPERTY_EXPERT_NAME_VALUE"];
				$prepod_email   = $ar_fields["PROPERTY_EXPERT_EMAIL1_VALUE"];
		 		$prepod_active  = $ar_fields["ACTIVE"];
			}
		} else {
			$prepod_active  = "N";
			$prepod_surname = $schedule_teacher_string;
		}

		$id_city=$scheduled_city;
		$arSelect = Array("PROPERTY_edu_type_money", "NAME");
		$arFilter = Array("IBLOCK_ID"=>51,"ID"=>$id_city);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_pields = $res->GetNext()) {
			$valuta= $ar_pields["PROPERTY_EDU_TYPE_MONEY_VALUE"];
			$valuta_ENUM_ID = $ar_pields["PROPERTY_EDU_TYPE_MONEY_ENUM_ID"];
			$city_name = $ar_pields["NAME"];
		}
		switch ($valuta_ENUM_ID) {
			case CITY_CURRENCY_RUB:
				$vCurrencyAdd = " р.";
				break;
			case CITY_CURRENCY_BYR:
				$vCurrencyAdd = " бел. р.";
				break;
			case CITY_CURRENCY_GRN:
				$vCurrencyAdd = " грн.";
				break;
			default:
			  $vCurrencyAdd = " р.";
		}

        ?>

<?php
	   $arValueOfCourses[$ii]["schedule_id"] = $arItem["ID"];
       $arValueOfCourses[$ii]["sort"] = $cat_sort;
	   $arValueOfCourses[$ii]["valuta"]=$valuta;
	   $arValueOfCourses[$ii]["city_name"]=$city_name;
       $arValueOfCourses[$ii]["cat_name"] = $cat_name;
       $arValueOfCourses[$ii]["date_sort"] = $cat_date_sort;
       //$arValueOfCourses[$ii]["name"] = $arItem["NAME"];
       $arValueOfCourses[$ii]["name"] = $courseNameFromCatalog;
	   $arValueOfCourses[$ii]["XML"] = $courseXML;
       //$courseNameFromCatalog
       $arValueOfCourses[$ii]["startdate"] = $schedule_startdate;
       $arValueOfCourses[$ii]["time"] = $schedule_time;
       $arValueOfCourses[$ii]["duration"] = $schedule_duration;
       $arValueOfCourses[$ii]["price"] = $schedule_price;
	   $arValueOfCourses[$ii]["onl_price"] = $schedule_onl_price;
       $arValueOfCourses[$ii]["course_id"] = $schedule_course_id;
       $arValueOfCourses[$ii]["course_code"] = $course_code;
       $arValueOfCourses[$ii]["cat_id"] = $course_id_category;
       $arValueOfCourses[$ii]["prepod_surname"] = $prepod_surname;
       $arValueOfCourses[$ii]["prepod_code"] = $prepod_code;
       $arValueOfCourses[$ii]["prepod_name"] = $prepod_name;
	   $arValueOfCourses[$ii]["prepod_email"] = $prepod_email;
       $arValueOfCourses[$ii]["prepod_active"] = $prepod_active;
       $arValueOfCourses[$ii]["detail_page_url"] =$arItem["DETAIL_PAGE_URL"];
       $arValueOfCourses[$ii]["online_id"] = $course_online_enumid;
       $arValueOfCourses[$ii]["time_interval"] = nl2br($arItem['PROPERTIES']['TIME_INTERVAL']['VALUE']);
       $arValueOfCourses[$ii]["show_basket"] = "Y";
       $arValueOfCourses[$ii]["schedule_city"] = $arItem['PROPERTIES']['city']['VALUE'];
if ($arItem['PROPERTIES']['IS_CLOSE']['VALUE_ENUM_ID'] === "136") {
       $arValueOfCourses[$ii]["show_basket"] = "N";


}
?>
	<? $ii=$ii+1; ?>
<?endforeach;?>

	<ul class="list">
	<?foreach ($arValueOfCourses as $value) {?>

		<li>
			<div class="description" style="width: 100%;">
				<div class="info">
					<h3><a target="_blank" href="/kurs/<?=$value['XML']?>.html<? if ($value["show_basket"] === "Y"){?>?ID_TIME=<?=$value['schedule_id']?><? } ?>"><?=$value["name"]?></a></h3>
					<?if (strlen($value["prepod_surname"])>0)  {?>
					<p>Тренер:


					<? if ($value["prepod_active"]=="Y") {?>
						<a target="_blank" title="Перейти на страницу-карточку преподавателя" href="/about/experts/<?=$value['prepod_code']?>.html">
							<?=$value["prepod_surname"];?> <?=$value["prepod_name"];?>
						</a>
					<? } else { ?>
			        	<?=$value["prepod_surname"];?>  <?=$value["prepod_name"];?>
					<? } ?>
					</p>
				<? } ?>
				</div>
				<div class="more">
					<p><?=$value["duration"]?> ч.</p>
					<span class="time"><?=$value["startdate"]?></span>
				</div>
			</div>

		</li>
	<?}?>
	</ul>
	<script>
									$('.closel').click(function(){
											$(this).parent().css('display', 'none');
									});
									$('.btn-share').click(function(){
											$(this).parent().find('.l').css('display', 'block');
									});
									$('.share-button').click(function(){

										window.open($(this).attr('href'),
										"",
										"width="+600+",height="+387+",toolbar=no,left="+600+",top="+387);
										return false;
									});
								</script>
	<style>
		.courses .actions td td  {
			padding-left: 10px;
		}
		.courses .actions table table{
			margin: 0;
		}
		.courses .actions td td a{
			background: none;
			padding: 0;
			margin-right: 5px;

		}
		.closel {
			position: absolute;
			color: red;
			top: 0;
			right: 0;
			cursor: pointer;
		}
	</style>
	<div class="usermail" style="display:none"><?=$USER->GetEmail();?></div>
<?/*
	$sortirovka=0;
	while (list($key, $value) = each($arValueOfCourses)) {
		$sortirovka_new=$value["sort"];
		if ($sortirovka <> $sortirovka_new) {?>
		<tr class="edu_header">
			<td colSpan="7">
				<p id="cat_<?=$value['cat_id']?>"><?= $value["cat_name"] ?></p>
			</td>
		</tr>
		<? } ?>
		<tr class="ewTableAltRow" itemscope itemtype="http://data-vocabulary.org/Event" onmouseover='ew_mouseover(this);' onmouseout='ew_mouseout(this);'>
			<td class="td_code">
				<p class="nobr"><?=$value["course_code"] ?></p>
			</td>
			<td class="td_name">
				<p><a class="js-tracking" data-type="Timetable" data-action="Click" data-name="<?=$value["course_code"] ?> <?=$value["name"]?> || <?=$value[course_id]?> || <?=$value['schedule_id']?>" title="Перейти на страницу с подробным описанием тренинга" itemprop="url" href="/kurs/<?=$value['XML']?>.html<? if ($value["show_basket"] === "Y"){?>?ID_TIME=<?=$value['schedule_id']?><? } ?>"><span itemprop="summary"><?=$value["name"] ?></span></a>
				<?if (preg_match('#PTRN#', $value["course_code"])) {?><span class="one-t-course"><img class="abs-image" title="Курс читается один раз" src="/images/ikonka1.png"/></span><?}?>
				<? if (strlen($value["prepod_surname"])>0)  {?>
					<br />тренер:
					<? if ($value["prepod_active"]=="Y") {?>
						<a class="orange"  title="Перейти на страницу-карточку преподавателя" href="/about/experts/<?=$value['prepod_code']?>.html">
							<?=$value["prepod_surname"];?> <?=$value["prepod_name"];?>
						</a>
					<? } else { ?>
			        	<?=$value["prepod_surname"];?>  <?=$value["prepod_name"];?>
					<? } ?>
				<? } ?>
				</p>
			</td>
			<td class="td_date"><p class="nobr"><?= $value["startdate"] ?></p></td>
			<td class="td_time" validn="top"><div class="nobr tocenter "><?/*=$value["time"]*/?>
<?
//global $USER;
//if ($USER->IsAdmin()){
?>
<?//iwrite($value);
?>
<?/*if (strlen($value["time_interval"])>0){?>
<a  class="show_tooltip posrel"><?=$value["time"]?></a>
<div class="tooltip">
<?=$value["time_interval"]?>
</div>

<? } else { ?>
<?=$value["time"]?>
<? } ?>
<? //}
 ?>
<?if (($value["online_id"] == "103") or ($value["schedule_city"] == CITY_ID_ONLINE)){?>
 <br />(время моск.)
<? } ?>
<br /><div style="padding-top:4px;"><a title="Добавить курс в календарь"  data-type="Timetable" data-action="AddToCalendar" data-name="<?=$value["course_code"] ?> <?=$value["name"]?> || <?=$value[course_id]?> || <?=$value['schedule_id']?>"rel="nofollow" class="ical_img js-tracking" href="/training/catalog/ics_course.html?ID=<?=$value['schedule_id']?>"><img width="24" border="0" src="/downloads/images/47-ical_24_24.png"></a></div>
</div></td>
			<td class="td_duration"><p class="nobr"><?=$value["duration"];?> ч.</p></td>
			<td class="td_price">
				<? if ($arParams['SHOW_PRICE'] !== "N"){?>
					<p class="nobr"><?=number_format($value["price"], 0, '', ' ');?> <?=$vCurrencyAdd ?><?/*if ($valuta=="Рубли") {?> р.<? }else{ ?> грн. <? } ?></p>
					<?/*if ($value["schedule_city"] == CITY_ID_ONLINE) {?>
                        <?
						if (intval($value["onl_price"])>0) {
							$newval = $value["onl_price"];
						} else {
							$newval=round($value["price"]/4);
						}?>
                        <p class="nobr"><?=number_format($newval, 0, '', ' ');?> грн.</p>
                    <?}?>
				<? } ?>
			</td>
		<?/* global $USER;  if ($USER->IsAdmin()) {*/?>
			<?/*<td class="td_buy">
				<? if ($arParams['SHOW_PRICE'] !== "N"){?>
<? if ($value["show_basket"] === "Y"){?>
<p class="tocenter">
<a class="tobasket js-tracking" rel="nofollow" data-type="Timetable" data-action="AddToBasket" data-name="<?=$value["course_code"] ?> <?=$value["name"]?> || <?=$value[course_id]?> || <?=$value['schedule_id']?>"  title="Запомнить и положить в корзину услуг" id_basket="<?=$value['schedule_id']?>" href="#"><img src="/images_edu/diffs/basket_put.png" width="32" height="32" alt="Запомнить и положить в корзину услуг" border="0"></a> <br />
</p>
<? } ?>
				<? } ?>

			</td>
		<?/* } ?>
		</tr>
<?
		$sortirovka = $sortirovka_new;
	}
*/?>
<div class="formpopup" style="display:none">
<?$APPLICATION->IncludeComponent("bitrix:form.result.new", "quest", Array(
	"SEF_MODE" => "Y",	// Включить поддержку ЧПУ
	"WEB_FORM_ID" => "12",	// ID веб-формы
	"LIST_URL" => "",	// Страница со списком результатов
	"EDIT_URL" => "",	// Страница редактирования результата
	"SUCCESS_URL" => "",	// Страница с сообщением об успешной отправке
	"CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
	"CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
	"IGNORE_CUSTOM_TEMPLATE" => "Y",	// Игнорировать свой шаблон
	"USE_EXTENDED_ERRORS" => "Y",	// Использовать расширенный вывод сообщений об ошибках
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"SEF_FOLDER" => "/",	// Каталог ЧПУ (относительно корня сайта)
	"VARIABLE_ALIASES" => ""
	),
	false
);?>
</div>
<?} else {?>
	<p style="font-size: 14px; margin-bottom: 20px;" >В настоящий момент у вас нет пройденных курсов</p>
<?}?>
