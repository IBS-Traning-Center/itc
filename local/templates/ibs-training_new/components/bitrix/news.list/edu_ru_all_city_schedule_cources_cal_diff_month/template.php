<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<script>
    $(document).ready(function () {
        var randInt;
        $("a.add-to-basket").click(function () {
            $(this).fadeOut("fast");
            $(this).fadeIn("fast");
            var id_record = $(this).attr("id_basket");
            /*$.getJSON('/ajax/add_course_to_basket.php?action=ADD2BASKET&id='+id_record+'&quantity=1',function(data){
            });
            randInt = Math.floor(Math.random()*100000);
            $(".basketSmall").fadeOut("slow");
               $(".basketSmall").load("/ajax/show_basket.php?rand='+randInt+'",{limit: 25});
               //pageTracker._trackEvent('Order', 'PutToBasket', id_record);
               $(".basketSmall").fadeIn("slow");
            */
            $.getJSON('/ajax/add_course_to_basket.php?action=ADD2BASKET&id=' + id_record + '&quantity=1', function (data) {
                $(".basketSmall").fadeOut("slow");
                $(".basketSmall").load("/ajax/show_basket.php?rand='+randInt+'", {limit: 25}, function () {
                    $(".basketSmall").fadeIn("fast");
                    alert('Курс добавлен в корзину');
                });


            });
            return false;
        });
        //$(".show_tooltip").tooltip({  position: 'center right', opacity: 0.9,  effect: 'toggle' ,  offset: [25, 10] });
    });
</script>

<?

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
    $schedule_description = $arItem['PROPERTIES']['schedule_description']['VALUE']['TEXT'];
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
        $schedule_startdate = "<time itemprop='startDate' datetime='" . $schedule_startdate_origin . "'>" . $schedule_startdate . "</time>-<br />" . "<time itemprop='endDate' datetime='" . $schedule_enddate_origin . "'>" . $schedule_enddate . "</time>";
    }
    //iwrite($arItem['PROPERTIES']['IS_CLOSE']);
    $les = CIBlockElement::GetByID($schedule_landing);
    if ($ar_res = $les->GetNext())
        $schedule_landing_code = $ar_res['CODE'];
    $ar_pes = CPrice::GetBasePrice($arItem["ID"]);
    if ($ar_pes["CURRENCY"] == "RUB") {
        $vCurrencyAdd = " <span>р.</span>";
    } elseif ($ar_pes["CURRENCY"] == "USD") {
        $vCurrencyAdd = "$";

    } elseif ($ar_pes["CURRENCY"] == "BYR") {
        $vCurrencyAdd = "<span>р.</span>";
    } elseif ($ar_pes["CURRENCY"] == "GRN") {
        $vCurrencyAdd = "<span>грн.</span>";
    } else {
        $vCurrencyAdd = " <span>р.</span>";
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
        "NAME"
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


    if (intval($arValueOfCourses[$ii]["schedule_course_sale"]) > 0) {
        $price = $arValueOfCourses[$ii]["price"] - ($arValueOfCourses[$ii]["price"] * intval($arValueOfCourses[$ii]["schedule_course_sale"]) / 100);
        $printPrice = "<br/><span style='font-size: 18px;' class='price-sale'>" . number_format($arValueOfCourses[$ii]["price"], 0, '', ' ') . " " . $vCurrencyAdd . "<i class='icon discount'>-".$arValueOfCourses[$ii]["schedule_course_sale"]."%</i></span>" .
            "<br/><span style='font-size: 18px;color: #1D427D;' class='price'>" . number_format($price, 0, '', ' ') . " " . $vCurrencyAdd . "</span>";
    } else {
        $printPrice = "<br/><span style='font-size: 18px;' class='price'>" . number_format($arValueOfCourses[$ii]["price"], 0, '', ' ') . " " . $vCurrencyAdd . "</span>";
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



if ($arParams["SORT_BY2"] != "date") {
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

<? if ($arParams["NEXT"] != "Y") { ?>
    <? $now = time(); ?>
    <? $nowdate = date("Y-m"); ?>
    <? $now = strtotime($nowdate . "-1") ?>
    <? //print_r($nowdate."-1");?>
    <? $now1month = strtotime(date("Y-m") . '-1 +1 month') ?>
    <? $now2month = strtotime(date("Y-m") . '-1 +2 month') ?>
<? } else { ?>
    <? $now = strtotime(date("Y-m") . '-15 +3 month'); ?>

    <? $now1month = strtotime(date("Y-m") . '-15 +4 month') ?>
    <? $now2month = strtotime(date("Y-m") . '-15 +5 month') ?>
<? } ?>
<div class="timetable-list">
    <div class="timetable-item">
        <div class="frame no-y-padding clearfix">

            <? if ($_REQUEST["showquart"] != "next") { ?>
                <span class="before-quater"><i class="fa fa-angle-left" aria-hidden="true"></i> Предыдущий</span>
                <a class="next-quater"
                   href="<?= $APPLICATION->GetCurPageParam('showquart=next', array('showquart')); ?>">Следующий <i
                            class="fa fa-angle-right" aria-hidden="true"></i></a>
            <? } else { ?>
                <a href="<?= $APPLICATION->GetCurPageParam('showquart=now', array('showquart')); ?>"
                   class="before-quater"><i class="fa fa-angle-left" aria-hidden="true"></i> Предыдущий</a>
                <span class="next-quater"
                      href="<?= $APPLICATION->GetCurPageParam('showquart=next', array('showquart')); ?>">Следующий <i
                            class="fa fa-angle-right" aria-hidden="true"></i></span>
            <? } ?>
        </div>
        <div class="frame no-y-padding clearfix timetable-flex">
            <div class="timetable-name-wrap">
            </div>
            <div class="time-3-wrapper heading clearfix">
                <div class="time-one-wrapper"><?= FormatDate('f', $now) ?></div>
                <div class="time-one-wrapper"><?= FormatDate('f', $now1month) ?></div>
                <div class="time-one-wrapper"><?= FormatDate('f', $now2month) ?></div>
            </div>
        </div>
    </div>

    <?
    $sortirovka = 0;
    while (list($key, $value) = each($arValueOfCourses)) {
        $sortirovka_new = $value["sort"];
        switch ($value["cat_id"]) {
            case "5735":
                $icon = "buisness";
                break;
            case "53918":
            case "84094":
                $icon = "buisness";
                break;
            case "5725":
                $icon = "analys";
                break;
            case "84093":
            case "5730":
            case "84095":
                $icon = "developer-icon";
                break;
            case "83007":
            case "5728":
                $icon = "arch";
                break;
            case "5729":
                $icon = "test";
                break;
            case "83005":
            case "5723":
                $icon = "management";
                break;
            default:
                $icon = "analys";
        }
        ?>
        <? if ($key == 0 || $value["cat_name"] != $last_name) { ?>
            <div class="category-item-timetable">
                <div class="frame no-y-padding clearfix timetable-flex">
                    <?= $value["cat_name"] ?>
                </div>
            </div>
        <? } ?>
        <? $last_name = $value["cat_name"] ?>
        <div class="timetable-item quater">
            <div class="frame no-y-padding clearfix timetable-flex">
                <div class="timetable-name-wrap <?= $icon ?>">
                    <div class="name-n-code-wrap"><span class="code"><?= $value["course_code"] ?></span> <a
                                class="course-name-time"
                                <? if ($value['schedule_id'] == "64888") { ?>href="/scrum-master/"
                                <? } elseif (strlen($value["landing_link"]) == 0) { ?>href="/kurs/<?= $value['XML'] ?>.html<? if ($value["show_basket"] === "Y") { ?>?ID_TIME=<?= $value['schedule_id'] ?><? } ?>"
                                <? } else { ?>href="<?= $value["landing_link"] ?>"<? } ?> data-type="Timetable"
                                data-action="Click"
                                data-name="<?= $value["course_code"] ?> <?= $value["name"] ?> || <?= $value["course_id"] ?> || <?= $value['schedule_id'] ?>"><?= $value["name"] ?></a>
                    </div>
                    <div class="trener-cat-info">
                        <div class="cat-info"><?= $value["cat_name"] ?> <? if ($value["schedule_new_icon"] == "Да") { ?>
                                <i class="icon newone">new</i><? } ?><? if ($value["schedule_city"] == CITY_ID_ONLINE) { ?>
                                <i class="icon new">online</i><? } ?><? if (preg_match('#PTRN#', $value["course_code"]) && $value["course_code"] != "PTRN-035" && $value["course_code"] != "PTRN-041" && $value["course_code"] != "PTRN-042" && $value["course_code"] != "PTRN-043" && $value["course_code"] != "PTRN-044") { ?>
                                <i class="icon guru">it-guru</i><? } ?>
                            <? if (intval($value["discount"]) > 0 && false) { ?><i class="icon discount">-<?= intval($value["discount"]) ?>%</i><?}?>
                            <? if ($value["popular"] == "Да") { ?><i class="popular">popular</i><? } ?><? if ($value["certified"] == "Yes") { ?><i class="icon certified">certified</i><? } ?></div>
                        <? if ($value["prepod_active"] == "Y") { ?>
                            <div class="trener-info">Тренер - <a
                                        href="/about/experts/<?= $value['prepod_code'] ?>.html"><?= $value["prepod_surname"]; ?> <?= $value["prepod_name"]; ?></a>
                            </div>
                        <? } else { ?>
                            <div class="trener-info">Тренер
                                - <?= $value["prepod_surname"]; ?>  <?= $value["prepod_name"]; ?></div>
                        <? } ?>
                    </div>
                </div>
                <div class="time-3-wrapper clearfix">
                    <div class="time-one-wrapper">
                        <? foreach ($arCoursesInner[$value["course_id"]][date('n', $now)] as $date) { ?>
                            <div class="date-nly"><?= $date ?></div>
                        <? } ?>
                    </div>
                    <div class="time-one-wrapper">
                        <? foreach ($arCoursesInner[$value["course_id"]][date('n', $now1month)] as $date) { ?>
                            <div class="date-nly"><?= $date ?></div>
                        <? } ?>
                    </div>
                    <div class="time-one-wrapper">
                        <? foreach ($arCoursesInner[$value["course_id"]][date('n', $now2month)] as $date) { ?>
                            <div class="date-nly"><?= $date ?></div>
                        <? } ?></div>
                </div>
            </div>
        </div>
    <? } ?>
    <? /*if (count($arValueOfCourses)==0) {?>
		К сожалению, на данную тематику нет запланированных курсов в открытом расписании. <a href="/training/katalog_kursov/?qcat="<?=$_REQUEST["qcat"]?>>Искать курс в каталоге</a>
	<?}*/ ?>
</div>