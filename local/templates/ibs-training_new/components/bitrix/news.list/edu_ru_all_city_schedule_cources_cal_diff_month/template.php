<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
    die(); 
} 

use Local\Util\Functions;
?>
<script>
    $(document).ready(function () {
        var randInt;
        $("a.add-to-basket").click(function () {
            $(this).fadeOut("fast");
            $(this).fadeIn("fast");
            var id_record = $(this).attr("id_basket");
            $.getJSON('/ajax/add_course_to_basket.php?action=ADD2BASKET&id=' + id_record + '&quantity=1', function (data) {
                $(".basketSmall").fadeOut("slow");
                $(".basketSmall").load("/ajax/show_basket.php?rand='+randInt+'", {limit: 25}, function () {
                    $(".basketSmall").fadeIn("fast");
                    alert('Курс добавлен в корзину');
                });
            });
            return false;
        });
    });
</script>

<?
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
    $rubl_sign = '₽';


// сначала  получим валюту города
// Рубли или Гривны
CModule::IncludeModule("catalog");
$id_city = $APPLICATION->GetPageProperty("id_city");
$arSelect = Array("PROPERTY_edu_type_money");
$arFilter = Array("IBLOCK_ID" => 51, "ID" => $id_city);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while ($ar_fields = $res->GetNext()) {
    $valuta = $ar_fields["PROPERTY_EDU_TYPE_MONEY_VALUE"];
    $valuta_ENUM_ID = $ar_fields["PROPERTY_EDU_TYPE_MONEY_ENUM_ID"];
}
switch ($valuta_ENUM_ID) {
    case CITY_CURRENCY_RUB:
        $vCurrencyAdd = " ₽";
        break;
    case CITY_CURRENCY_BYR:
        $vCurrencyAdd = " ₽";
        break;
    case CITY_CURRENCY_GRN:
        $vCurrencyAdd = " грн.";
        break;
    default:
        $vCurrencyAdd = " ₽";
}
// для массива куда мы будем ложить значения
$ii = 0;
$arValueOfCourses = array();
$arCoursesInner = array();
foreach ($arResult["ITEMS"] as $arItem):

    $prepod_surname = "";
    $prepod_name = "";
    $prepod_code = "";
    $schedule_landing = "";
    $schedule_landing_code = "";
    $schedule_landing_link = "";
    $schedule_landing = $arItem['PROPERTIES']['landing_mk']['VALUE'];
    $schedule_course_id = $arItem['PROPERTIES']['schedule_course']['VALUE'];
    $schedule_city = $arItem['PROPERTIES']['schedule_city']['VALUE'];
    $schedule_startdate = $arItem['PROPERTIES']['startdate']['VALUE'];
    $schedule_startdate_origin = date("Y-m-d", strtotime($arItem['PROPERTIES']['startdate']['VALUE']));
    $schedule_enddate = $arItem['PROPERTIES']['enddate']['VALUE'];
    $schedule_enddate_origin = date("Y-m-d", strtotime($arItem['PROPERTIES']['enddate']['VALUE']));
    $schedule_time = $arItem['PROPERTIES']['schedule_time']['VALUE'];
    $schedule_description = $arItem['PROPERTIES']['schedule_description']['VALUE'];
    $schedule_price = $arItem['PROPERTIES']['schedule_price']['VALUE'];
    $schedule_new_icon = $arItem['PROPERTIES']['NEW_ICON']['VALUE'];
    $schedule_onl_price = $arItem['PROPERTIES']['schedule_onl_price']['VALUE'];
    $schedule_landing_link = $arItem['PROPERTIES']['landing_link']['VALUE'];
    $schedule_yes_basket = $arItem['PROPERTIES']['CAN_BUY']['VALUE'];
    $schedule_duration = $arItem['PROPERTIES']['schedule_duration']['VALUE'];
    $schedule_teacher_id = $arItem['PROPERTIES']['teacher']['VALUE'];
    $schedule_no_basket = $arItem['PROPERTIES']['no_basket']['VALUE'];
    $schedule_teacher_string = $arItem['PROPERTIES']['string_teacher']['VALUE'];
    if ($schedule_enddate == "") {
    } else {
        $schedule_startdate = "<div class='date-wrapper'><time itemprop='startDate' datetime='" . $schedule_startdate_origin . "'>" . $schedule_startdate . "-</time>" . "<time itemprop='endDate' datetime='" . $schedule_enddate_origin . "'>" . $schedule_enddate . "</time></div>";
    }
    //iwrite($arItem['PROPERTIES']['IS_CLOSE']);
    $les = CIBlockElement::GetByID($schedule_landing);
    if ($ar_res = $les->GetNext())
        $schedule_landing_code = $ar_res['CODE'];
    $ar_pes = CPrice::GetBasePrice($arItem["ID"]);
    if ($ar_pes["CURRENCY"] == "RUB") {
        $vCurrencyAdd = " <span>₽</span>";
    } elseif ($ar_pes["CURRENCY"] == "USD") {
        $vCurrencyAdd = "$";

    } elseif ($ar_pes["CURRENCY"] == "BYR") {
        $vCurrencyAdd = "<span>₽</span>";
    } elseif ($ar_pes["CURRENCY"] == "GRN") {
        $vCurrencyAdd = "<span>грн.</span>";
    } else {
        $vCurrencyAdd = " <span>₽</span>";
    }
    $schedule_dis = 0;

    $arDiscounts = CCatalogDiscount::GetDiscountByPrice(
        $ar_pes["ID"],
        $USER->GetUserGroupArray(),
        "N",
        SITE_ID
    );
    $discountPrice = CCatalogProduct::CountPriceWithDiscount(
        $ar_pes["ID"],
        $ar_pes["CURRENCY"],
        $arDiscounts
    );
    if (intval($arDiscounts[0]["VALUE"]) > 0) {
        $schedule_dis = $arDiscounts[0]["VALUE"];
    } elseif(intval($arItem['PROPERTIES']["course_sale"]['VALUE'])>0) {
        $schedule_dis = intval($arItem['PROPERTIES']["course_sale"]['VALUE']);
    }
    // теперь  получим цену курса  и ее
    // длительность по умолчанию
    $arSelect = Array(
        "PROPERTY_course_price",
        "XML_ID",
        "PROPERTY_course_duration",
        "PROPERTY_course_idcategory",
        "PROPERTY_course_code",
        "PROPERTY_course_format",
        "NAME",
        "PROPERTY_COMPLEXITY"
    );
    $arFilter = Array(
        "IBLOCK_ID" => 6,
        "ID" => $schedule_course_id
    );

    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while ($ar_fields = $res->GetNext()) {
        $course_price = $ar_fields["PROPERTY_COURSE_PRICE_VALUE"];
        $course_duration = $ar_fields["PROPERTY_COURSE_DURATION_VALUE"];
        $course_id_category = $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
        $course_code = $ar_fields["PROPERTY_COURSE_CODE_VALUE"];
        $course_online_enumid = $ar_fields["PROPERTY_COURSE_FORMAT_ENUM_ID"];
        $courseNameFromCatalog = $ar_fields["NAME"];
        $courseXML = $ar_fields["XML_ID"];
        $courseComplexity = $ar_fields['PROPERTY_COMPLEXITY_VALUE'];
    }

     
    if ($schedule_price == "") {
        $schedule_price = $course_price;
    }
    if ($schedule_duration == "") {
        $schedule_duration = $course_duration;
    }

    // теперь  получим имя категории
    // и ее сортировку в категориях курсов ID =50
    $arSelect = Array("NAME", "SORT");
    $arFilter = Array("IBLOCK_ID" => 50, "ID" => $course_id_category);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
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
        $arSelect = Array("NAME", "PROPERTY_expert_name", "CODE", "ACTIVE");
        $arFilter = Array("IBLOCK_ID" => 56, "ID" => $schedule_teacher_id);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
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

    $arValueOfCourses[$ii]["schedule_course_sale"] = $arItem['PROPERTIES']["course_sale"]['VALUE'];
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
    $arValueOfCourses[$ii]["price"] = $schedule_price;
    $arValueOfCourses[$ii]["onl_price"] = $schedule_onl_price;
    $arValueOfCourses[$ii]["course_id"] = $schedule_course_id;
    $arValueOfCourses[$ii]["course_code"] = $course_code;
    $arValueOfCourses[$ii]["cat_id"] = $course_id_category;
    $arValueOfCourses[$ii]["schedule_new_icon"] = $schedule_new_icon;
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
    $arValueOfCourses[$ii]["no_basket"] = $schedule_no_basket;
    $arValueOfCourses[$ii]["schedule_city"] = $arItem['PROPERTIES']['city']['VALUE'];
    if ($arItem['PROPERTIES']['IS_CLOSE']['VALUE_ENUM_ID'] === "136") {
        $arValueOfCourses[$ii]["show_basket"] = "N";
    }
    $arValueOfCourses[$ii]["courseComplexity"] = $courseComplexity;

   

    if (intval($arValueOfCourses[$ii]["schedule_course_sale"]) > 0) {
        $price = $arValueOfCourses[$ii]["price"] - ($arValueOfCourses[$ii]["price"] * intval($arValueOfCourses[$ii]["schedule_course_sale"]) / 100);
        $printPrice = "<div class='price-sale-wrap'><span class='price-sale'>" . number_format($arValueOfCourses[$ii]["price"], 0, '', ' ') . " " . $vCurrencyAdd /*. "<i class='icon discount'>-".$arValueOfCourses[$ii]["schedule_course_sale"]."%</i> */."</span>".
            "<br/><span class='price'>" . number_format($price, 0, '', ' ') . " " . $vCurrencyAdd . "</span></div>";
    } else {
        $printPrice = "<div class='price-nosale-wrap'><span class='price'>" . number_format($arValueOfCourses[$ii]["price"], 0, '', ' ') . " " . $vCurrencyAdd . "</span></div>";
    }


    $arCoursesInner[$arValueOfCourses[$ii]["course_id"]][date("n", strtotime($schedule_startdate_origin))][] = $arValueOfCourses[$ii]["startdate"] . $printPrice;
    if ($arValueOfCourses[$ii]["price"] > $arHightestPrice[$arValueOfCourses[$ii]["course_id"]]) {
        $arHightestPrice[$arValueOfCourses[$ii]["course_id"]] = $arValueOfCourses[$ii]["price"];
    }
    if (count($arCoursesInner[$arValueOfCourses[$ii]["course_id"]], COUNT_RECURSIVE) >= 3) {
        unset($arValueOfCourses[$ii]);
    }
     $ii = $ii + 1; ?>
<? endforeach; ?>

<?php

$currentValue = $arValueOfCourses;

// далее будем сортировать многомерный массив
// по полю сортировку
// таким образом отсортируем по категориям

if ($arParams["SORT_BY2"] != "PROPERTY_startdate") {
    function cmp($a, $b)
    {
        if ($a["date_sort"] == $b["date_sort"]) {
            return 0;
        }
        return ($a["date_sort"] < $b["date_sort"]) ? -1 : 1;
    }

    usort($arValueOfCourses, "cmp");  // сортируем полученный массив по полю sort
}
?>

<? if ($arParams["NEXT"] != "Y") { 
    $now = time(); 
    $nowdate = date("Y-m"); 
    $now = strtotime($nowdate . "-01");
    $now1month = strtotime(date("Y-m") . '-01 +1 month');
    $now2month = strtotime(date("Y-m") . '-01 +2 month');
} else { 
    $now = strtotime(date("Y-m") . '-15 +3 month');
    $now1month = strtotime(date("Y-m") . '-15 +4 month');
    $now2month = strtotime(date("Y-m") . '-15 +5 month');
} ?>
    <div class="pagination-quarter">
        <? if ($_REQUEST["showquart"] != "next") { ?>
            <span class="before-quater">
                <?= Functions::buildSVG('icon-pagination', SITE_TEMPLATE_PATH. '/assets/images/icons')?>
                <span>Предыдущий</span>
            </span>
            <a class="next-quater" href="<?= $APPLICATION->GetCurPageParam('showquart=next', array('showquart')); ?>">
                <span>Следующий</span>
                <?= Functions::buildSVG('icon-pagination', SITE_TEMPLATE_PATH. '/assets/images/icons')?>
            </a>
        <? } else { ?>
            <a href="<?= $APPLICATION->GetCurPageParam('showquart=now', array('showquart')); ?>" class="before-quater">
                <?= Functions::buildSVG('icon-pagination', SITE_TEMPLATE_PATH. '/assets/images/icons')?>
                <span>Предыдущий</span>
            </a>
            <span class="next-quater" href="<?= $APPLICATION->GetCurPageParam('showquart=next', array('showquart')); ?>">
                <span>Следующий</span>
                <?= Functions::buildSVG('icon-pagination', SITE_TEMPLATE_PATH. '/assets/images/icons')?>
            </span>
        <? } ?>
    </div>
<div class="timetable-list quarter">
    <?
    $sortirovka = 0;
    foreach ($arValueOfCourses as $key => $value) {
        $sortirovka_new = $value["sort"];?>
        <div class="timetable-item quarter">
            <div class="timetable-name-wrap <?= $icon ?>">
                <div class="name-n-code-wrap">
                    <div class="code-icon-wrap">
                        <span class="code"><?= $value["course_code"] ?></span> 
                        <div class="code-icon-right">
                            <? if(isset($value["courseComplexity"]) ){?>
                                <span class="icon level <?=getLevel($value["courseComplexity"])?>"><?=$value["courseComplexity"]?></span>
                            <?}?>
                            <span class="hours"> <?plural_form($value["duration"], array("час", "часа", "часов"))?></span>
                        </div>
                    </div>
                    <a class="course-name-time"
                        <? if ($value['schedule_id'] == "64888") { ?>href="/scrum-master/"
                        <? } elseif (strlen($value["landing_link"]) == 0) { ?>href="/kurs/<?= $value['XML'] ?>.html<? if ($value["show_basket"] === "Y") { ?>?ID_TIME=<?= $value['schedule_id'] ?><? } ?>"
                        <? } else { ?>href="<?= $value["landing_link"] ?>"<? } ?> data-type="Timetable"
                        data-action="Click"
                        data-name="<?= $value["course_code"] ?> <?= $value["name"] ?> || <?= $value["course_id"] ?> || <?= $value['schedule_id'] ?>">
                        <?= $value["name"] ?>
                    </a>
                </div>
                <div class="trener-cat-info">
                    <? if ($value["prepod_active"] == "Y") { ?>
                        <div class="trener-info">Тренер: <a href="/about/experts/<?= $value['prepod_code'] ?>.html"><?= $value["prepod_surname"]; ?> <?= $value["prepod_name"]; ?></a>
                        </div>
                    <? } else { ?>
                        <div class="trener-info">Тренер: <?= $value["prepod_surname"]; ?>  <?= $value["prepod_name"]; ?></div>
                    <? } ?>
                    <? if (intval($value["discount"]) > 0) { ?>
                        <div class="price-wrapper">
                            <span class="sale-percent">
                                <?= Functions::buildSVG('icon-sale', SITE_TEMPLATE_PATH. '/assets/images/icons')?>
                                Скидка
                                <?= intval($value["discount"]) ?>%
                            </span>
                        </div>
                    <?}?>
                </div>
            </div>
            <div class="time-3-wrapper">
                <div class="time-one-wrapper<?= ($arCoursesInner[$value["course_id"]][date('n', $now)] !== NULL)? ' active':''?>">
                    <? if($arCoursesInner[$value["course_id"]][date('n', $now)] !== NULL){?>
                        <div class="month-nly"><?= FormatDate('f', $now);?></div>
                    <?}?>
                    <? foreach ($arCoursesInner[$value["course_id"]][date('n', $now)] as $date) { ?>
                        <div class="date-nly"><?= $date ?></div>
                    <? } ?>
                </div>
                <div class="time-one-wrapper<?= ($arCoursesInner[$value["course_id"]][date('n', $now1month)] !== NULL)? ' active':''?>">
                <? if($arCoursesInner[$value["course_id"]][date('n', $now1month)] !== NULL){?>
                        <div class="month-nly"><?= FormatDate('f', $now1month);?></div>
                    <?}?>
                    <? foreach ($arCoursesInner[$value["course_id"]][date('n', $now1month)] as $date) { ?>
                        <div class="date-nly"><?= $date ?></div>
                    <? } ?>
                </div>
                <div class="time-one-wrapper<?= ($arCoursesInner[$value["course_id"]][date('n', $now2month)] !== NULL)? ' active':''?>">
                <? if($arCoursesInner[$value["course_id"]][date('n', $now2month)] !== NULL){?>
                        <div class="month-nly"><?= FormatDate('f', $now2month);?></div>
                    <?}?>
                    <? foreach ($arCoursesInner[$value["course_id"]][date('n', $now2month)] as $date) { ?>
                        <div class="date-nly"><?= $date ?></div>
                    <? } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>