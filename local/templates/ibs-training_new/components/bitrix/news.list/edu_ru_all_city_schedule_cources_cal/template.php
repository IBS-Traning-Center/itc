<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
    die();
}

use Local\Util\Functions;?>
<script>
$(document).ready(function() {
	var randInt;
	$("a.add-to-basket").click(function(){
		$(this).fadeOut("fast");
		$(this).fadeIn("fast");
		var id_record = $(this).attr("id_basket");

		$.getJSON('/ajax/add_course_to_basket.php?action=ADD2BASKET&id='+id_record+'&quantity=1',function(data){
            $(".basketSmall").fadeOut("slow");
            $(".basketSmall").load("/ajax/show_basket.php?rand='+randInt+'",{limit: 25}, function(){
                $(".basketSmall").fadeIn("fast");
                alert('Курс добавлен в корзину');
            });
        });
	   	return false;
	});
});
</script>

<?php

$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>6, "CODE"=>"COMPLEXITY"));
$COMPLEXITY = [];
while($enum_fields = $property_enums->GetNext())
{
    $COMPLEXITY[$enum_fields["ID"]] = $enum_fields["VALUE"];
}

function getLevel($value){
    switch ($value) {
        case 'Junior':
            return "level--junior";
        case 'Middle':
            return "level--middle";
        case 'Senior':
            return "level--senior";
    }
}
function getLevels($arCourse){
    $result = "";
    foreach (array_values($arCourse['PROPERTY_COMPLEXITY_VALUE']) as $key=> $value) {
        $result .= getLevel($value)." ";
    }

    return $result;
}
function plural_form($number, $after) {
    $cases = array (2, 0, 1, 1, 1, 2);
    echo $number.' '.$after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
}
    $grivna_sign = 'грн.';
    $rubl_sign = 'руб.';

	// сначала  получим валюту города
	// Рубли или Гривны
	CModule::IncludeModule("catalog");
	$id_city=$APPLICATION->GetPageProperty("id_city");
	$arSelect = Array("PROPERTY_edu_type_money");
	$arFilter = Array("IBLOCK_ID"=>51,"ID"=>$id_city);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ar_fields = $res->GetNext()) {
		$valuta= $ar_fields["PROPERTY_EDU_TYPE_MONEY_VALUE"];
		$valuta_ENUM_ID = $ar_fields["PROPERTY_EDU_TYPE_MONEY_ENUM_ID"];
	}
	switch ($valuta_ENUM_ID) {
		case CITY_CURRENCY_RUB:
			$vCurrencyAdd = " р.";
			break;
		case CITY_CURRENCY_BYR:
			$vCurrencyAdd = " р.";
			break;
		case CITY_CURRENCY_GRN:
			$vCurrencyAdd = " грн.";
			break;
		default:
		  $vCurrencyAdd = " р.";
	}
    // для массива куда мы будем ложить значения
	$ii=0;
	$arValueOfCourses = array();
	foreach($arResult["ITEMS"] as $arItem) {
        $prepod_surname = "";
        $prepod_name = "";
        $prepod_code = "";
        $schedule_landing = "";
        $schedule_landing_code = "";
        $schedule_landing_link = "";
        $schedule_landing = $arItem['PROPERTIES']['landing_mk']['VALUE'];
        $schedule_course_id = $arItem['PROPERTIES']['schedule_course']['VALUE'];
        $schedule_city = $arItem['PROPERTIES']['schedule_city']['VALUE'];

        $res = CIBlockElement::GetByID($arItem['PROPERTIES']['city']['VALUE']);

        if ($ar_res = $res->GetNext()) {
            $schedule_city_name = $ar_res['NAME'];
        }

        $schedule_course_sale = $arItem['PROPERTIES']['course_sale']['VALUE'];
        $schedule_startdate = $arItem['PROPERTIES']['startdate']['VALUE'];
        $schedule_startdate_origin = date("Y-m-d", strtotime($arItem['PROPERTIES']['startdate']['VALUE']));
        $schedule_enddate = $arItem['PROPERTIES']['enddate']['VALUE'];
        $schedule_enddate_origin = date("Y-m-d", strtotime($arItem['PROPERTIES']['enddate']['VALUE']));
        $schedule_time = $arItem['PROPERTIES']['schedule_time']['VALUE'];
        $schedule_description = $arItem['PROPERTIES']['schedule_description']['VALUE'];
        $schedule_price = $arItem['PROPERTIES']['schedule_price']['VALUE'];
        $schedule_new_icon = $arItem['PROPERTIES']['NEW_ICON']['VALUE'];
        $schedule_icon_sale = $arItem['PROPERTIES']['ICON_SALE']['VALUE'];
        $schedule_icon_sale_link = $arItem['PROPERTIES']['ICON_SALE_LINK']['VALUE'];
        $schedule_onl_price = $arItem['PROPERTIES']['schedule_onl_price']['VALUE'];
        $schedule_yes_basket = $arItem['PROPERTIES']['CAN_BUY']['VALUE'];
        $schedule_duration = $arItem['PROPERTIES']['schedule_duration']['VALUE'];
        $schedule_landing_link = $arItem['PROPERTIES']['landing_link']['VALUE'];
        $schedule_teacher_id = $arItem['PROPERTIES']['teacher']['VALUE'];
        $schedule_no_basket = $arItem['PROPERTIES']['no_basket']['VALUE'];
        $schedule_teacher_string = $arItem['PROPERTIES']['string_teacher']['VALUE'];
        if ($schedule_enddate == "") {
        } else {
            $schedule_startdate = "<time itemprop='startDate' datetime='" . $schedule_startdate_origin . "'>" . $schedule_startdate . "-</time><br />" . "<time itemprop='endDate' datetime='" . $schedule_enddate_origin . "'>" . $schedule_enddate . "</time>";
        }
        //iwrite($arItem['PROPERTIES']['IS_CLOSE']);
        $les = CIBlockElement::GetByID($schedule_landing);
        if ($ar_res = $les->GetNext()) {
            $schedule_landing_code = $ar_res['CODE'];
        }
        $ar_pes = CPrice::GetBasePrice($arItem["ID"]);
        if ($ar_pes["CURRENCY"] == "RUB") {
            $vCurrencyAdd = $rubl_sign; //"  <span class='rouble-sign'>1</span>";
        } elseif ($ar_pes["CURRENCY"] == "USD") {
            $vCurrencyAdd = "$";
        } elseif ($ar_pes["CURRENCY"] == "BYR") {
            $vCurrencyAdd = "<span>р.</span>";
        } elseif ($ar_pes["CURRENCY"] == "GRN") {
            $vCurrencyAdd = "<span>грн.</span>";
        } else {
            $vCurrencyAdd = $rubl_sign; // "  <span class='rouble-sign'>1</span>";
        }
        $schedule_dis = 0;

        $arDiscounts = array();
        unset($arResultDis);
        $cache = new CPHPCache();
        $cache_time = 36000;
        $cache_id = 'discount' . $ar_pes["ID"] . $USER->GetUserGroupArray();
        $cache_path = 'discount';
        if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path)) {
            $res = $cache->GetVars();
            if (is_array($res["discount"]) || (count($res["discount"]) > 0)) {
                $arResultDis = $res["discount"];
            }
            $arDiscounts = $arResultDis;
        }
        if (!is_array($arResultDis)) {
            $arDiscounts = CCatalogDiscount::GetDiscountByPrice(
                $ar_pes["ID"],
                $USER->GetUserGroupArray(),
                "N",
                SITE_ID
            );

            //////////// end cache /////////
            if ($cache_time > 0) {
                $cache->StartDataCache($cache_time, $cache_id, $cache_path);
                $cache->EndDataCache(array("discount" => $arDiscounts));
            }
        }
        if (intval($arDiscounts[0]["VALUE"]) > 0) {
            $schedule_dis = $arDiscounts[0]["VALUE"];
            $schedule_dis_type = $arDiscounts[0]["VALUE_TYPE"];
        }
        // теперь  получим цену курса  и ее
        // длительность по умолчанию
        $arSelect = array(
            "PROPERTY_course_price",
            "PROPERTY_COURSE_PRICE_UA",
            "XML_ID",
            "PROPERTY_course_duration",
            "PROPERTY_popular",
            "PROPERTY_CERTIFIED",
            "PROPERTY_course_idcategory",
            "PROPERTY_course_code",
            "PROPERTY_course_format",
            "NAME",
            "PROPERTY_COMPLEXITY"
        );
        $arFilter = array(
            "IBLOCK_ID" => 6,
            "ID" => $schedule_course_id
        );

        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        while ($ar_fields = $res->GetNext()) {
            $course_price = $ar_fields["PROPERTY_COURSE_PRICE_VALUE"];
            $course_price_ua = $ar_fields["PROPERTY_COURSE_PRICE_UA_VALUE"];
            $course_duration = $ar_fields["PROPERTY_COURSE_DURATION_VALUE"];
            $course_popular = $ar_fields["PROPERTY_POPULAR_VALUE"];
            $course_certified = $ar_fields["PROPERTY_CERTIFIED_VALUE"];
            $course_id_category = $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
            $course_code = $ar_fields["PROPERTY_COURSE_CODE_VALUE"];
            $course_online_enumid = $ar_fields["PROPERTY_COURSE_FORMAT_ENUM_ID"];
            $courseNameFromCatalog = $ar_fields["NAME"];
            $courseXML = $ar_fields["XML_ID"];
            if($courseComplexity = unserialize($ar_fields['~PROPERTY_COMPLEXITY_VALUE'])) {
                if(empty($courseComplexity['VALUE'])) {
                    unset($courseComplexity);
                } else {
                    if(is_array($courseComplexity['VALUE'])) {
                        $currentComplexity = [];
                        foreach ($courseComplexity['VALUE'] as $complexity) {
                            $currentComplexity[] = $COMPLEXITY[$complexity];
                        }
                        $courseComplexity = $currentComplexity;
                    } else {
                        $courseComplexity = $COMPLEXITY[$courseComplexity['VALUE']];
                    }
                }
            }
        }
        if ($schedule_price == "") {
            $schedule_price = $course_price;
        }
        //echo fn_getMostNewCityPrice(null, null,5745, $course_duration);
        // Цена для Украины
        $schedule_price_ua = $course_price_ua;
        if ($schedule_price_ua == "") {
            $schedule_price_ua = fn_getMostNewCityPrice(null, null, 5745, $course_duration);
        }

        if ($schedule_duration == "") {
            $schedule_duration = $course_duration;
        }


        // теперь  получим имя категории
        // и ее сортировку в категориях курсов ID =50
        $arSelect = array("NAME", "SORT");
        $arFilter = array("IBLOCK_ID" => 50, "ID" => $course_id_category);
        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        while ($ar_fields = $res->GetNext()) {
            $cat_name = $ar_fields["NAME"];
            $cat_sort = $ar_fields["SORT"];
            $cat_date_sort = ($ar_fields["SORT"] * 100) + $ii;
        }

        $prepod_surname = "";
        $prepod_code = "";
        $prepod_active = "";
        $prepod_name = "";

        if ($schedule_teacher_id > 0) {
            //теперь  получим имя преподавателя
            $arSelect = array("NAME", "PROPERTY_expert_name", "CODE", "ACTIVE");
            $arFilter = array("IBLOCK_ID" => 56, "ID" => $schedule_teacher_id);
            $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            while ($ar_fields = $res->GetNext()) {
                $prepod_surname = $ar_fields["NAME"];
                $prepod_code = strtolower($ar_fields["CODE"]);
                $prepod_name = $ar_fields["PROPERTY_EXPERT_NAME_VALUE"];
                $prepod_active = $ar_fields["ACTIVE"];
            }
        } else {
            $prepod_active = "N";
            $prepod_surname = $schedule_teacher_string;
        }

        $arValueOfCourses[$ii]["schedule_id"] = $arItem["ID"];
        $arValueOfCourses[$ii]["sort"] = $cat_sort;
        $arValueOfCourses[$ii]["cat_name"] = $cat_name;
        $arValueOfCourses[$ii]["date_sort"] = $cat_date_sort;
        //$arValueOfCourses[$ii]["name"] = $arItem["NAME"];
        $arValueOfCourses[$ii]["name"] = $courseNameFromCatalog;
        $arValueOfCourses[$ii]["XML"] = $courseXML;
        //$courseNameFromCatalog
        $arValueOfCourses[$ii]["landing_code"] = $schedule_landing_code;
        $arValueOfCourses[$ii]["landing_link"] = $schedule_landing_link;

        $arValueOfCourses[$ii]["startdate"] = $schedule_startdate;
        $arValueOfCourses[$ii]["time"] = $schedule_time;
        $arValueOfCourses[$ii]["duration"] = $schedule_duration;
        $arValueOfCourses[$ii]["popular"] = $course_popular;
        $arValueOfCourses[$ii]["certified"] = $course_certified;
        $arValueOfCourses[$ii]["price"] = $schedule_price;
        $arValueOfCourses[$ii]["price_ua"] = $schedule_price_ua;
        $arValueOfCourses[$ii]["city_name"] = $schedule_city_name;
        $arValueOfCourses[$ii]["onl_price"] = $schedule_onl_price;
        $arValueOfCourses[$ii]["course_id"] = $schedule_course_id;
        $arValueOfCourses[$ii]["course_code"] = $course_code;
        $arValueOfCourses[$ii]["cat_id"] = $course_id_category;
        $arValueOfCourses[$ii]["schedule_new_icon"] = $schedule_new_icon;
        $arValueOfCourses[$ii]["icon-sale"] = $schedule_icon_sale;
        $arValueOfCourses[$ii]["icon-sale-link"] = $schedule_icon_sale_link;
        $arValueOfCourses[$ii]["prepod_surname"] = $prepod_surname;
        $arValueOfCourses[$ii]["prepod_code"] = $prepod_code;
        $arValueOfCourses[$ii]["prepod_name"] = $prepod_name;
        $arValueOfCourses[$ii]["prepod_active"] = $prepod_active;
        $arValueOfCourses[$ii]["detail_page_url"] = $arItem["DETAIL_PAGE_URL"];
        $arValueOfCourses[$ii]["online_id"] = $course_online_enumid;
        $arValueOfCourses[$ii]["schedule_yes_basket"] = $schedule_yes_basket;
        $arValueOfCourses[$ii]["time_interval"] = nl2br($arItem['PROPERTIES']['TIME_INTERVAL']['VALUE']);
        $arValueOfCourses[$ii]["show_basket"] = "Y";
        $arValueOfCourses[$ii]["valuta"] = $vCurrencyAdd;
        $arValueOfCourses[$ii]["discount"] = $schedule_dis;
        $arValueOfCourses[$ii]["discount_type"] = $schedule_dis_type;
        $arValueOfCourses[$ii]["no_basket"] = $schedule_no_basket;
        $arValueOfCourses[$ii]["schedule_course_sale"] = $schedule_course_sale;
        $arValueOfCourses[$ii]["courseComplexity"] = $courseComplexity;

        $arValueOfCourses[$ii]["schedule_city"] = $arItem['PROPERTIES']['city']['VALUE'];
        if ($arItem['PROPERTIES']['IS_CLOSE']['VALUE_ENUM_ID'] === "136") {
            $arValueOfCourses[$ii]["show_basket"] = "N";
        }
        if ($arValueOfCourses[$ii]["no_basket"] == "Да") {
            $arValueOfCourses[$ii]["show_basket"] = "N";
        }
        $ii = $ii + 1;
    };?>

    <div class="timetable-list 444">

    <? $sortirovka=0;
    foreach ($arValueOfCourses as $key => $value) {
        $sortirovka_new=$value["sort"];?>
        <?
	    $this->AddEditAction($value['schedule_id'], $value['EDIT_LINK'], CIBlock::GetArrayByID($value["IBLOCK_ID"], "ELEMENT_EDIT"));
	    $this->AddDeleteAction($value['schedule_id'], $value['DELETE_LINK'], CIBlock::GetArrayByID($value["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	    ?>
        <div class="timetable-item" id="<?=$this->GetEditAreaId($value['schedule_id']);?>" itemscope itemtype="http://data-vocabulary.org/Event" >
            <div class="timetable-item-wrap">
					<div class="timetable-name-wrap">
						<div class="name-n-code-wrap">
                            <div class="code-icon-wrap">
                                <span class="code"><?=$value["course_code"]?></span>
                                <div class="code-icon-right">
                                    <? if(isset($value["courseComplexity"]) ){
                                        if(is_array($value["courseComplexity"])) {
                                            foreach (array_values($value["courseComplexity"]) as $key=> $complexityValue) {?>
                                                <span class="icon level <?=getLevel($complexityValue)?>"><?=$complexityValue?></span>
                                                <?unset($key,$complexityValue);}
                                        } else {?>
                                            <span class="icon level <?=getLevel($value["courseComplexity"])?>"><?=$value["courseComplexity"]?></span>
                                        <?}
                                    }?>
                                    <span class="hours"> <?plural_form($value["duration"], array("час", "часа", "часов"))?></span>
                                </div>
                            </div>
                            <a class="course-name-time"  <?if ($value['schedule_id']=="64888") {?>href="/scrum-master/" <?} elseif (strlen($value["landing_link"])==0) {?>href="/kurs/<?=$value['XML']?>.html<? if ($value["show_basket"] === "Y"){?>?ID_TIME=<?=$value['schedule_id']?><? } ?>"<?} else {?>href="<?=$value["landing_link"]?>"<?}?> data-type="Timetable" data-action="Click" data-name="<?=$value["course_code"] ?> <?=$value["name"]?> || <?=$value["course_id"]?> || <?=$value['schedule_id']?>"><?=$value["name"]?></a>
                        </div>
                       <div class="trener-cat-info">
							<div class="cat-info">
                            <?if ($value["schedule_new_icon"] == "Да") {?>
                                <i class="icon newone"><?= Functions::buildSVG('icon-new', SITE_TEMPLATE_PATH. '/assets/images/icons')?> Новинка</i>
                            <?}
                            /*if ($value["schedule_city"] == CITY_ID_ONLINE) {?>
                                <i class="icon new"><?= Functions::buildSVG('icon-new', SITE_TEMPLATE_PATH. '/assets/images/icons')?> online</i>
                            <?}
                            if (preg_match('#PTRN#', $value["course_code"]) && $value["course_code"]!="PTRN-035" && $value["course_code"]!="PTRN-041" && $value["course_code"]!="PTRN-042" && $value["course_code"]!="PTRN-043" && $value["course_code"]!="PTRN-044") {
							    ?><i class="icon guru"><?= Functions::buildSVG('icon-new', SITE_TEMPLATE_PATH. '/assets/images/icons')?> it-guru</i><?
							}
                            if (intval($value["discount"])>0 && $value["discount_type"]=="P") {?>
                                <i class="icon discount">-<?=intval($value["discount"])?>%</i>
                            <?}
                            if (intval($value["discount"])>0 && $value["discount_type"]=="F") {?>
                                <i class="icon discount">-<?=number_format($value["discount"], 0, '', ' ');?> <?=$value["valuta"]?></i>
                            <?}
                            if ($value["popular"] == "Да") {?><i class="icon popular">popular</i><?}?><?if ($value["certified"] == "Yes") {?><i class="icon certified">certified</i><?}?><?if ($value["icon-sale"] == "yes") {?><i class="icon new-year"><a href="<?=$value["icon-sale-link"]?>" target="_blank"><b>%</b>Акция</a></i><?}*/?></div>
						</div>
					</div>
					<div class="time-price-wrapper clearfix">
                        <? if ($value["prepod_active"]=="Y") {?>
							<div class="trener-info">Тренер: <a  href="/about/experts/<?=$value['prepod_code']?>.html"><?=$value["prepod_surname"];?> <?=$value["prepod_name"];?></a></div>
						<?} else {?>
							<div class="trener-info">Тренер: <?=$value["prepod_surname"];?>  <?=$value["prepod_name"];?></div>
						<?}?>
                        <div class="time-wrapper">
                            Дата и время:
                            <div class="time-wrapper-right">
                                <div class="timedate">
                                    <?=$value["startdate"]?>
                                </div>
                                <div class="time<?if (strlen($value["time_interval"])>0){?> time-with-tooltip<?}?>">
                                    <?=$value["time"]?>
                                    <?if (strlen($value["time_interval"])>0){?>
                                        <span style="display: none;" class="tooltip">
                                            <?= Functions::buildSVG('arrow-tooltip', SITE_TEMPLATE_PATH. '/assets/images/icons')?>
						                    <?=$value["time_interval"]?>
						                </span>
                                    <?}?>
                                </div>
                            </div>
                        </div>
						<div class="price-wrapper">
                            <?if (intval($value["schedule_course_sale"])>0) {?>
                                <span class="sale-percent">
                                    <?= Functions::buildSVG('icon-sale', SITE_TEMPLATE_PATH. '/assets/images/icons')?>
                                    Скидка
                                    <?= number_format($value["schedule_course_sale"]);?>%
                                </span>
                                <div class="price-sale">
                            <?} else {?>
                        <div class="price">
                            <?}?>
                            <?if (intval($value["discount"])>0 && $value["discount_type"]=="P") {?>
						        <?=number_format($value["price"]*(100-$value["discount"])/100, 0, '', ' ');?><br>
					        <?} elseif (intval($value["discount"])>0 && $value["discount_type"]=="F") {?>
                                <?=number_format($value["price"]-$value["discount"], 0, '', ' ');?><br>
					        <?} else {?>
                                <?=number_format($value["price"], 0, '', ' ');?> <?=$value["valuta"]?><br>
                            <?}?>
                        </div>
                    <? if (intval($value["schedule_course_sale"])>0) {?>
                        <div class="sale">
                            <?=number_format($value["price"]*(100-$value["schedule_course_sale"])/100, 0, '', ' ');?>&nbsp;<?=$value["valuta"]?><br>
                        </div>
                    <?php }?>
                </div>
				</div>
			</div>
		</div>
    <?php } ?>
	</div>
<?	$pageAll=$arResult["NAV_RESULT"]->NavPageCount;
	$pageNOW=$arResult["NAV_RESULT"]->NavPageNomer;
	$pageSize=$arResult["NAV_RESULT"]->NavPageSize;

	?>
<?if ($pageNOW!=$pageAll) {?>
	<?$param="PAGEN_1=".(intval($pageNOW)+1)?>
	<div style="display: none;" class="navigate">
		<a href="<?=$APPLICATION->GetCurPageParam($param, array("PAGEN_1"))?>" onclick="showMore('<?=$APPLICATION->GetCurPageParam($param, array('PAGEN_1'))?>')" class="hidden-link">NEXT</a>
	</div>
	<script type="text/javascript">
	$(document).ready(function() {
		$(window).scroll(function() {
			//console.info($(window).scrollTop());
			var height=$('.timetable-list').height();
			if ($(window).scrollTop()>$('.timetable-list').height()-1000) {
				//console.info($(window).scrollTop());
				if ($('.navigate a').length>0) {
					$('.navigate a').trigger('click');
					$('.navigate a').remove();
				}
			}
		})
	});
	function showMore(param) {
		$.get(param, function( data ) {
			returned=$(data).find('.timetable-list').html();
			$('.navigate').html($(data).find('.navigate').html());
			$('.timetable-list').append(returned);
		});
	}
	</script>
<?}?>
