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
		$schedule_yes_basket = $arItem['PROPERTIES']['CAN_BUY']['VALUE'];
		$schedule_no_basket = $arItem['PROPERTIES']['no_basket']['VALUE'];
		$schedule_onl_price = $arItem['PROPERTIES']['schedule_onl_price']['VALUE'];
		$schedule_duration = $arItem['PROPERTIES']['schedule_duration']['VALUE'];
		$schedule_teacher_id = $arItem['PROPERTIES']['teacher']['VALUE'];
		$schedule_teacher_string = $arItem['PROPERTIES']['string_teacher']['VALUE'];
		if ($schedule_enddate == "")  { } else   {  $schedule_startdate = $schedule_startdate." - ".$schedule_enddate; }
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
	  		$arSelect = Array("NAME", "PROPERTY_expert_name","CODE", "ACTIVE");
			$arFilter = Array("IBLOCK_ID"=>56,"ID"=>$schedule_teacher_id);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ar_fields = $res->GetNext())
			{
		 		$prepod_surname = $ar_fields["NAME"];
		 		$prepod_code    = strtolower($ar_fields["CODE"]);
		 		$prepod_name    = $ar_fields["PROPERTY_EXPERT_NAME_VALUE"];
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
		if ($arItem["TYPE"]=="CAT") {
			$arValueOfCourses[$ii]["type"]="cat";
			$arValueOfCourses[$ii]["name"]=$arItem["NAME"];
			$arValueOfCourses[$ii]["XML"]=$arItem["XML_ID"];
		} else {
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
	   $arValueOfCourses[$ii]["schedule_yes_basket"]=$schedule_yes_basket;
       $arValueOfCourses[$ii]["prepod_active"] = $prepod_active;
       $arValueOfCourses[$ii]["detail_page_url"] =$arItem["DETAIL_PAGE_URL"];
       $arValueOfCourses[$ii]["online_id"] = $course_online_enumid;
       $arValueOfCourses[$ii]["time_interval"] = nl2br($arItem['PROPERTIES']['TIME_INTERVAL']['VALUE']);
       $arValueOfCourses[$ii]["show_basket"] = "Y";
	   $arValueOfCourses[$ii]["no_basket"] = $schedule_no_basket;
       $arValueOfCourses[$ii]["schedule_city"] = $arItem['PROPERTIES']['city']['VALUE'];
if ($arItem['PROPERTIES']['IS_CLOSE']['VALUE_ENUM_ID'] === "136") {
       $arValueOfCourses[$ii]["show_basket"] = "N";
 

}
	if ($arValueOfCourses[$ii]["no_basket"]=="Да") {
			$arValueOfCourses[$ii]["show_basket"] = "N";	
		}
}
?>
	<? $ii=$ii+1; ?>
<?endforeach;?>

	<ul class="list">
	<?foreach ($arValueOfCourses as $value) {?>
		<li class="inactive">
			<div class="description">
				<div class="info">
					<h3><a target="_blank" href="/kurs/<?=$value['XML']?>.html<? if ($value["show_basket"] === "Y"){?>?ID_TIME=<?=$value['schedule_id']?><? } ?>"><?=$value["name"]?></a></h3>
					<?if ($value["type"]!="cat") {?>
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
				<?}?>
				</div>
				<?if ($value["type"]=="cat") {?>
					<div class="more">
						<p><a href="/kurs/<?=$value['XML']?>.html#tab-price-link">Смотреть цены</a></p>
						<span class="date">Даты проведения уточняются</span>
					</div>
				<?} else {?>
					<div class="more">
						<p><strong><?=number_format($value["price"], 0, '', ' ');?><?if ($value["valuta"]=="Рубли") {?> р.<? }else{ ?> грн.<? } ?></strong> г. <?=$value["city_name"]?></p>
						<span class="time"><?=$value["time"]?></span> <span class="date"><?=$value["startdate"]?></span>
					</div>
				<?}?>
			</div>
			<div class="actions 111">
				<?if(false) {?>
                    <a <?if ($value["type"]=="cat" ||  ($value["schedule_city"]== CITY_ID_MOSCOW && $value["schedule_yes_basket"]!="Да") || ($value["schedule_city"]== CITY_ID_MINSK) || ($value['show_basket']=="N")) {?>href="javascript:void(0)" <?} else {?> title="" href="/ajax/add_course_to_basket.php?action=BUY&id=<?=$value['schedule_id']?>&quantity=1" <?}?> target="_blank" data-type="Personal" data-action="AddToBasket" data-name="<?=$value["course_code"] ?> <?=$value["name"]?> || <?=$value[course_id]?> || <?=$value['schedule_id']?>" class="pay <?if ($value["type"]!="cat" &&  $value["schedule_city"]!= CITY_ID_MOSCOW) {?><?}?> js-tracking">оплатить</a>
                    <a href="javascript:void(0)" data-type="Personal" data-action="AddToBasket" data-name="<?=$value["course_code"] ?> <?=$value["name"]?> || <?=$value[course_id]?> || <?=$value['schedule_id']?>" class="pay js-tracking">оплатить</a>
                <?} else {?><?}?>
                <a target="_blank" href="/kurs/<?=$value['XML']?>.html<? if ($value["show_basket"] === "Y"){?>?ID_TIME=<?=$value['schedule_id']?><? } ?>#tab-record-link" class="reg">Регистрация</a>
				<a <?if ($value["type"]!="cat" &&  (($value["schedule_city"]!= CITY_ID_MOSCOW && $value["schedule_city"]!= CITY_ID_MINSK && $value['show_basket']!="N") || ($value["schedule_city"]== CITY_ID_MOSCOW && $value["schedule_yes_basket"]=="Да") )) {?> class="tobasket js-tracking cart <?if ($value["type"]!="cat" &&  $value["schedule_city"]!= CITY_ID_MOSCOW) {?>tooltip<?}?>"  title="" rel="nofollow" data-type="Personal" data-action="AddToBasket" data-name="<?=$value["course_code"] ?> <?=$value["name"]?> || <?=$value[course_id]?> || <?=$value['schedule_id']?>"  title="Запомнить и положить в корзину услуг" id_basket="<?=$value['schedule_id']?>" <?} else {?>class="cart non-active" <?}?> href="#">В корзину</a>
			</div>
		</li>
	<?}?>
	</ul>
<?} else {?>
	<p style="font-size: 14px; margin-bottom: 20px;" >В настоящий момент у вас нет активных курсов</p>
<?}?>
<script>
$(document).ready(function(){
 simple_tooltip("a.tooltip","tooltip1");
});
function simple_tooltip(target_items, name){
 $(target_items).each(function(i){

	$("body").append("<div class='"+name+"' id='"+name+i+"'><p>"+$(this).attr('title')+"</p></div>");
 var my_tooltip = $("#"+name+i);

 $(this).removeAttr("title").mouseover(function(){
 my_tooltip.css({opacity:1, display:"none"}).fadeIn(400);
 }).mousemove(function(kmouse){
 my_tooltip.css({left:kmouse.pageX-250, top:kmouse.pageY+25});
 }).mouseout(function(){
 my_tooltip.fadeOut(400);
 });
 });
}




</script>
<style>
.tooltip1{
 position:absolute;
 z-index:999;
 left:-9999px;
 background-color: white;
 padding:5px;
 border:1px solid #cecece;
 width:250px;
 box-shadow: 0 0 10px rgba(0,0,0,0.5);
}

.tooltip1 p{
 margin:0;
 padding:0;
 color:#444;
 background-color:white;
 padding:2px 7px;
}
</style>
