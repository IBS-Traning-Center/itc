<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
CModule::IncludeModule("currency");
$ii = 0; // для массива куда мы будем ложить значения
$arValueOfCourses = array();
global $arEventInfo, $bOnlineCourse, $arCoursesInfo;
$grivna_sign = 'грн.';
$rubl_sign = 'руб.';
// Выведем актуальную корзину для текущего пользователя

$arBasketItems = array();

$dbBasketItems = CSaleBasket::GetList(
    array(
        "NAME" => "ASC",
        "ID" => "ASC"
    ),
    array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => SITE_ID,
        "ORDER_ID" => "NULL"
    ),
    false,
    false,
    array("ID", "CALLBACK_FUNC", "MODULE",
        "PRODUCT_ID", "QUANTITY", "DELAY",
        "CAN_BUY", "PRICE", "WEIGHT")
);

while ($arItems = $dbBasketItems->Fetch()) {
    if (strlen($arItems["CALLBACK_FUNC"]) > 0) {
        CSaleBasket::UpdatePrice($arItems["ID"],
            $arItems["CALLBACK_FUNC"],
            $arItems["MODULE"],
            $arItems["PRODUCT_ID"],
            $arItems["QUANTITY"]);
        $arItems = CSaleBasket::GetByID($arItems["ID"]);
    }

    $arBasketItems[] = $arItems;
    $arProducts[] = $arItems["PRODUCT_ID"];
}

foreach ($arResult["ITEMS"] as $arItem) {

    GLOBAL $USER;

    //iwrite($arItem['PROPERTIES']);
    $prepod_surname = "";
    $prepod_name = "";
    $prepod_code = "";
    $schedule_yes_basket = "";
    $schedule_course_id = $arItem['PROPERTIES']['schedule_course']['VALUE'];
    $schedule_city_id = $arItem['PROPERTIES']['city']['VALUE'];
    $schedule_startdate = $arItem['PROPERTIES']['startdate']['VALUE'];
    $schedule_enddate = $arItem['PROPERTIES']['enddate']['VALUE'];
    $schedule_time = $arItem['PROPERTIES']['schedule_time']['VALUE'];
    $schedule_description = $arItem['PROPERTIES']['schedule_description']['VALUE']['TEXT'];
    $schedule_price = $arItem['PROPERTIES']['schedule_price']['VALUE'];
    $schedule_duration = $arItem['PROPERTIES']['schedule_duration']['VALUE'];
    $schedule_teacher_id = $arItem['PROPERTIES']['teacher']['VALUE'];
    $schedule_yes_basket = $arItem['PROPERTIES']['CAN_BUY']['VALUE'];
    $schedule_no_basket = $arItem['PROPERTIES']['no_basket']['VALUE'];
    $schedule_teacher_string = $arItem['PROPERTIES']['string_teacher']['VALUE'];
    $dateCourseStart = $schedule_startdate;
    if (strlen($schedule_enddate) > 0) {
        $schedule_startdate .= " - " . $schedule_enddate;
    }

    //сначала  получим валюту города
    //Рубли или Гривны
    $arSelect = Array("PROPERTY_edu_type_money", "NAME");
    $arFilter = Array("IBLOCK_ID" => 51, "ID" => $schedule_city_id);
    //iwrite($arFilter);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while ($arCity = $res->GetNext()) {
        $currency = $arCity["PROPERTY_EDU_TYPE_MONEY_VALUE"];
        $CURRENCY_ENUM_ID = $arCity["PROPERTY_EDU_TYPE_MONEY_ENUM_ID"];
        $schedule_city = $arCity["NAME"];
        //iwrite($arCity);
        //echo $CURRENCY_ENUM_ID;
    }
    switch ($CURRENCY_ENUM_ID) {
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

    // теперь  получим цену курса и ее длительность по умолчанию
    // делаем запрос только в первый раз чтобы не дергать одно и тоже
    if ($ii == 0) {
        $arSelect = Array(
            "PROPERTY_course_price",
            "PROPERTY_course_duration",
            "PROPERTY_course_idcategory",
            "PROPERTY_course_code",
            "PROPERTY_course_format",
            'PROPERTY_COURSE_PRICE_UA'
        );
        $arFilter = Array("IBLOCK_ID" => 6, "ID" => $schedule_course_id);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while ($ar_fields = $res->GetNext()) {
            $course_price = $ar_fields["PROPERTY_COURSE_PRICE_VALUE"];
            $course_price_ua = $ar_fields["PROPERTY_COURSE_PRICE_UA_VALUE"];
            $course_duration = $ar_fields["PROPERTY_COURSE_DURATION_VALUE"];
            $course_id_category = $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
            $course_code = $ar_fields["PROPERTY_COURSE_CODE_VALUE"];
            $course_online_enumid = $ar_fields["PROPERTY_COURSE_FORMAT_ENUM_ID"];
            $arEventInfo["PRICE"] = $course_price;
            $arEventInfo["DURATION"] = $course_duration;
        }
        if ($course_online_enumid == 103) {
            $bOnlineCourse = true;
        } else {
            $bOnlineCourse = false;
        }
    }

    if (strlen($schedule_price) == 0) {
        $schedule_price = $course_price;
    }
    $schedule_discount = 0;
    if (intval($_REQUEST["ID_TIME"]) == $arItem["ID"] && strlen($_REQUEST["seo"]) > 0) {
        $schedule_discount = fn_GetCourseDis($arItem["ID"], $schedule_price);
    }
    if (strlen($schedule_duration) == 0) {
        $schedule_duration = $course_duration;
    }
    $schedule_price_ua = $course_price_ua;
    if($schedule_price_ua == ""){
        $schedule_price_ua = fn_getMostNewCityPrice(null, null,5745, $course_duration);
    }

    $shedule_course_sale = 0;
    // проверим есть ли скидка у Курса в расписании
    $arSelect = Array(
        "ID",
        "IBLOCK_ID",
        "NAME",
        "PROPERTY_COURSE_SALE",
    );

    $arFilter = Array("IBLOCK_ID" => 9, "ID" => $arItem["ID"]);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while ($ar_fields = $res->GetNext()) {
        $shedule_course_sale = $ar_fields["PROPERTY_COURSE_SALE_VALUE"];
    }


    //теперь  получим имя преподавателя
    $prepod_photo = array();
    if ($schedule_teacher_id > 0) {
        $arSelect = Array("NAME", "PROPERTY_expert_name", "CODE", "DETAIL_TEXT", "DETAIL_PICTURE", "PROPERTY_expert_short");
        $arFilter = Array("IBLOCK_ID" => 56, "ID" => $schedule_teacher_id);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while ($ar_fields = $res->GetNext()) {
            $prepod_surname = $ar_fields["NAME"];
            $prepod_code = strtolower($ar_fields["CODE"]);
            $prepod_name = $ar_fields["PROPERTY_EXPERT_NAME_VALUE"];
            $prepod_active = $ar_fields["ACTIVE"];
            $prepod_photo = CFile::GetFileArray($ar_fields["DETAIL_PICTURE"]);
            $prepod_short = $ar_fields["PROPERTY_EXPERT_SHORT_VALUE"];
            $arPrepods[$schedule_city][$prepod_code] = array("NAME" => $prepod_surname . " " . $prepod_name, "SHORT" => $prepod_short, "DESCRIPTION" => $ar_fields["DETAIL_TEXT"], "PHOTO" => $prepod_photo, "CODE" => $prepod_code);
        }
    } else {
        $prepod_active = "N";
        $prepod_surname = $schedule_teacher_string;
    }
    ?>

    <?
    $ar_pes = CPrice::GetBasePrice($arItem["ID"]);
    if ($ar_pes["CURRENCY"] == "RUB") {
        $vCurrencyAdd = $rubl_sign; //" <span class='rouble-sign'>1</span>";
    } elseif ($ar_pes["CURRENCY"] == "USD") {
        $vCurrencyAdd = "$";
    } elseif ($ar_pes["CURRENCY"] == "BYR") {
        $vCurrencyAdd = $rubl_sign; //" <span class='rouble-sign'>1</span>";
    } elseif ($ar_pes["CURRENCY"] == "GRN") {
        $vCurrencyAdd = $grivna_sign; //" <span class='grn'>грн.</span>";
    } else {
        $vCurrencyAdd = $rubl_sign; //" <span class='rouble-sign'>1</span>";
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
        $schedule_dis_type = $arDiscounts[0]["VALUE_TYPE"];
    }

    $arValueOfCourses[$ii]["datecoursestart"] = $dateCourseStart;
    $arValueOfCourses[$ii]["schedule_id"] = $arItem["ID"];
    $arValueOfCourses[$ii]["name"] = $arItem["NAME"];
    $arValueOfCourses[$ii]["schedule_city_id"] = $schedule_city_id;

    $arValueOfCourses[$ii]["startdate"] = $schedule_startdate;
    $arValueOfCourses[$ii]["time"] = $schedule_time;
    $arValueOfCourses[$ii]["duration"] = $schedule_duration;
    $arValueOfCourses[$ii]["price"] = $schedule_price;
    $arValueOfCourses[$ii]["price_ua"] = $schedule_price_ua;
    $arValueOfCourses[$ii]["schedule_discount"] = $schedule_discount;
    $arValueOfCourses[$ii]["course_id"] = $schedule_course_id;
    $arValueOfCourses[$ii]["course_code"] = $course_code;
    $arValueOfCourses[$ii]["cat_id"] = $course_id_category;
    $arValueOfCourses[$ii]["prepod_surname"] = $prepod_surname;
    $arValueOfCourses[$ii]["prepod_code"] = $prepod_code;
    $arValueOfCourses[$ii]["prepod_short"] = $prepod_short;
    $arValueOfCourses[$ii]["prepod_name"] = $prepod_name;
    $arValueOfCourses[$ii]["prepod_photo"] = $prepod_photo;
    $arValueOfCourses[$ii]["detail_page_url"] = $arItem["DETAIL_PAGE_URL"];
    $arValueOfCourses[$ii]["schedule_city"] = $schedule_city;
    $arValueOfCourses[$ii]["currency"] = $currency;
    $arValueOfCourses[$ii]["online_id"] = $course_online_enumid;
    $arValueOfCourses[$ii]["schedule_yes_basket"] = $schedule_yes_basket;
    $arValueOfCourses[$ii]["time_interval"] = $arItem['PROPERTIES']['TIME_INTERVAL']['VALUE'];
    $arValueOfCourses[$ii]['CURRENCY_NEW'] = $vCurrencyAdd;
    $arValueOfCourses[$ii]["discount"] = $schedule_dis;
    $arValueOfCourses[$ii]["discount_type"] = $schedule_dis_type;
    $arValueOfCourses[$ii]["no_basket"] = $schedule_no_basket;
    $arValueOfCourses[$ii]['schedule_course_sale'] = $shedule_course_sale;
    $arCoursesInfo[$ii]['NAME'] = $arItem["NAME"];
    $arCoursesInfo[$ii]['CODE'] = $course_code;
    $arCoursesInfo[$ii]['DATE'] = $schedule_startdate;
    $arCoursesInfo[$ii]['DATE_BEGIN'] = $arItem['PROPERTIES']['startdate']['VALUE'];
    $arCoursesInfo[$ii]['EVENT_CITY'] = $schedule_city;
    $arCoursesInfo[$ii]['ID_TIME'] = $arItem["ID"];

    if ($arItem['PROPERTIES']['IS_CLOSE']['VALUE_ENUM_ID'] === "136") {
        $arValueOfCourses[$ii]["show_basket"] = "N";
    }
    if ($arValueOfCourses[$ii]["no_basket"] == "Да") {
        $arValueOfCourses[$ii]["show_basket"] = "N";
    }
    $arCityList[$schedule_city_id] = array("NAME" => $schedule_city);
    if ($schedule_city_id == CITY_ID_ONLINE) {
        $arONLINE[] = $arValueOfCourses[$ii];
    }

    $ii = $ii + 1;
}?>
<script>
    $(document).ready(function () {
        var randInt;
        $("a.to-basket").click(function () {
            randInt = Math.floor(Math.random() * 100000);
            var id_record = $(this).data("course");

            var basket_link = $(this);
            console.info('/ajax/add_course_to_basket.php?action=ADD2BASKET&id=' + id_record + '&quantity=1');
            $.get('/ajax/add_course_to_basket.php?action=ADD2BASKET&id=' + id_record + '&quantity=1', function (data) {
                basket_link.addClass('success');
                basket_link.html('<i class="fa fa-check" aria-hidden="true"></i> В корзине');

                /*$(".basketSmall").load("/ajax/show_basket.php?rand='+randInt+'",{limit: 25}, function(){
                    $(".basketSmall").fadeIn("fast");
                    alert('Курс добавлен в корзину');
                });*/

            });

            /*$(".basketSmall").fadeOut("slow");
               $(".basketSmall").load("/ajax/show_basket.php?rand='+randInt+'",{limit: 25});
               $(".basketSmall").fadeIn("slow");*/

            return false;
        });
        //$(".show_tooltip").tooltip({  position: 'center right', opacity: 0.9,  effect: 'toggle' ,  offset: [25, 10] });
    });
</script>
<? $city_vis = 0;
if (count($arPrepods) > 0) { ?>
    <div id="trainer" class="not-main-page">
        <div class="frame">
            <div class="trainer-slider-outer">
                <div class="trainer-heading">Тренер в
                    <? $t = 0; ?>
                    <? foreach ($arPrepods as $code => $arCity) { ?>
                        <a class="trainer-changer button <? if ($t == 0) { ?>active<? } ?>" data-open="<?= $t ?>"
                           href="#"><?= $code ?></a>
                        <? $t++ ?>
                    <? } ?>
                </div>
                <? $k = 0; ?>
                <? foreach ($arPrepods as $code => $arCity) { ?>
                    <div class="training-slider-inner <? if ($k == 0) { ?>active<? } ?> trainer-list-<?= $k ?>">
                        <? foreach ($arCity as $trainer_code => $trainer) { ?>
                            <div class="trainer-item">
                                <div class="trainer-header clearfix">
                                    <div class="trainer-picture">
                                        <img src="<?= $trainer["PHOTO"]["SRC"] ?>" alt=""/>
                                    </div>
                                    <div class="trainer-short-description ">
                                        <a class="trainer-link"
                                           href="/about/experts/<?= $trainer['CODE'] ?>.html"><?= $trainer["NAME"] ?></a>
                                        <?= $trainer["SHORT"] ?>
                                    </div>
                                </div>
                                <div class="trainer-content <? if (strlen($trainer["DESCRIPTION"]) < 800) { ?>open<? } ?>">
                                    <div class="trainer-description">
                                        <? //strlen($trainer["DESCRIPTION"])?>
                                        <?= $trainer["DESCRIPTION"] ?>
                                    </div>
                                    <div <? if (strlen($trainer["DESCRIPTION"]) < 800) { ?>style="display: none" <? } ?>
                                         class="open-link">
                                        <a href="#">Развернуть</a>
                                    </div>
                                </div>
                            </div>
                        <? } ?>

                    </div>
                    <? $k++ ?>
                <? } ?>
            </div>
        </div>
    </div>
<? } ?>
<div id="timetable-inn" style="background: url('/static/images/course-bg.jpg') center; background-size: cover;"
     class="bg-main-wrap">
    <div class="frame">
        <? /*if($arValueOfCourses[0]["schedule_city_id"]!=CITY_ID_ONLINE) {*/ ?>
        <? GLOBAL $arCourseInfoID ?>
        <? if ($arCourseInfoID["TIMETABLE_INFO"][0]["COURSE_CODE"] != "SDP-031" &&
            $arCourseInfoID["TIMETABLE_INFO"][0]["COURSE_CODE"] != "SDP-032" &&
            $arCourseInfoID["TIMETABLE_INFO"][0]["COURSE_CODE"] != "SDP-033" &&
            $arCourseInfoID["TIMETABLE_INFO"][0]["COURSE_CODE"] != "SDP-035" &&
            $arCourseInfoID["TIMETABLE_INFO"][0]["COURSE_CODE"] != "SDP-036" &&
            $arCourseInfoID["TIMETABLE_INFO"][0]["COURSE_CODE"] != "FITCH-001" &&
            $arCourseInfoID["TIMETABLE_INFO"][0]["COURSE_CODE"] != "FITCH-002" && $arCourseInfoID["TIMETABLE_INFO"][0]["COURSE_CODE"] != "FITCH-003") { ?>
            <!--<div class="skidka-10">-10% <span>ФИЗИЧЕСКИМ ЛИЦАМ</span></div>-->
        <? } ?>
        <?
        $active = "";
        if (count($arCityList) == 0) {
            $active = " active";
        }?>

        <div class="timetable-inn-header">Раcписание курса в <? include $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . '/include/city-select-no-select.php'; ?> <a class="other-cities <?=$active?>" href="#">Цены</a></div>
        <? if (count($arCityList) > 0) { ?>
            <div class="timetable-inn-small">Данный курс запланирован в
                городах: <? $t = 0 ?><? foreach ($arCityList as $city) { ?><? if ($t > 0) {
                    echo ',';
                } ?> <b><?= $city["NAME"] ?></b><? $t++ ?><? } ?> </div>
        <? } ?>
        <? //}

        //echo count($arResult["ITEMS"]);
        $sortirovka = 0;
        $number_of = 0;
        while (list($key, $value) = each($arValueOfCourses)) { ?>

        <?
        $newcity = $value["schedule_city_id"]; ?>
        <?php
        //        if ($USER->IsAdmin()  ) {
        //
        //            var_dump($arONLINE);
        //        }
        ?>
        <? if ($key == 0 || $newcity != $oldcity) { ?>
        <? if ($key != 0) { ?>
        <? foreach ($arONLINE as $arCourse) { ?>
            <div class="timetable-inn-item-outer">
                <div class="timetable-inn-item-inner">
                    <div class="timetable-inn-top">
                        <div class="timetable-dates">
                            <?= $arCourse["startdate"] ?>
                        </div>
                        <div class="short-info-course">
                            <div><span>Время: </span> <?= $arCourse["time"] ?><?
                                if ($arCourse["schedule_city_id"] == "CITY_ID_ONLINE") { ?> (мск.)<?
                                } ?></div>
                            <div><span>Локация: </span> <?= $arCourse["schedule_city"] ?></div>
                            <div><span>Длительность: </span> <?= $arCourse["duration"]; ?> ч.</div>
                        </div>
                        <a class="sign-in smallest scroll" href="#register">Записаться</a>
                    </div>
                    <div class="timetable-more-info">
                        <div class="trainer-inn-heading">Тренер</div>
                        <? if (strlen($arCourse['prepod_code']) > 0) { ?>
                            <a class="trainer-inn-name" target="_blank"
                               href="/about/experts/<?= $arCourse['prepod_code'] ?>.html"><?= $arCourse["prepod_surname"]; ?>  <?= $arCourse["prepod_name"]; ?></a>
                        <? } else { ?>
                            <span class="trainer-inn-name"><?= $arCourse["prepod_surname"]; ?>  <?= $arCourse["prepod_name"]; ?></span>
                        <? } ?>
                        <div class="clearfix">
                            <div class="picture-70">
                                <?
                                if (strlen($arCourse["prepod_photo"]["SRC"]) > 0) { ?>
                                    <img src="<?= $arCourse["prepod_photo"]["SRC"] ?>"/>
                                    <?
                                } ?>
                            </div>
                            <div class="text-tr">
                                <?= $arCourse["prepod_short"]; ?>
                            </div>
                        </div>
                        <div class="price-wrap clearfix">
                            <div class="big-price">
                                <b>
                                    <?
                                    if (intval($arCourse["discount"]) == 0 || $arCourse["discount"] == $arCourse["price"]) { ?>
                                        <?= number_format($arCourse["price"], 0, '', ' '); ?> <?= $arCourse["CURRENCY_NEW"]; ?><br>
                                        <?if ($value["schedule_city_id"] == CITY_ID_ONLINE) {?>
                                            <?= number_format($arCourse["price_ua"], 0, '', ' '); ?> <?=$grivna_sign?>
                                        <?}?>
                                    <? } elseif (intval($arCourse["discount"]) > 0 && $arCourse["discount_type"] == "P") { ?>
                                        <s><?= number_format($arCourse["price"], 0, '', ' '); ?> <?= $arCourse["CURRENCY_NEW"]; ?></s>&nbsp<?= number_format($arCourse["price"] * (100 - $arCourse["discount"]) / 100, 0, '', ' '); ?>  <?= $arCourse["CURRENCY_NEW"]; ?>
                                        <?if ($value["schedule_city_id"] == CITY_ID_ONLINE) {?>
                                            <s><?= number_format($arCourse["price_ua"], 0, '', ' '); ?> <?=$grivna_sign?></s>&nbsp<?= number_format($arCourse["price_ua"] * (100 - $arCourse["discount"]) / 100, 0, '', ' '); ?>  <?=$grivna_sign?>
                                        <?}?>
                                    <? } elseif (intval($arCourse["discount"]) > 0 && $arCourse["discount_type"] == "F") { ?>
                                        <s><?= number_format($arCourse["price"], 0, '', ' '); ?> <?= $arCourse["CURRENCY_NEW"]; ?></s>&nbsp<?= number_format($arCourse["price"] - $arCourse["discount"], 0, '', ' '); ?>  <?= $arCourse["CURRENCY_NEW"]; ?>
                                        <?if ($value["schedule_city_id"] == CITY_ID_ONLINE) {?>
                                            <s><?= number_format($arCourse["price_ua"], 0, '', ' '); ?> <?=$grivna_sign?></s>&nbsp<?= number_format($arCourse["price_ua"] - $arCourse["discount"], 0, '', ' '); ?>  <?=$grivna_sign?>
                                        <? } ?>
                                    <? } ?>
                                    </span>
                                </b>
                            </div>
                            <?
                            if(checkUserGroup(['34', '47', '48', '79', '1'])) {
                                if (($arCourse["schedule_city_id"] == CITY_ID_MOSCOW && $arCourse["schedule_yes_basket"] == "Да") || ($arCourse["schedule_city_id"] != CITY_ID_MOSCOW && $arCourse["schedule_city_id"] != CITY_ID_MINSK && $arCourse['show_basket'] != "N")) {
                                    if (in_array($arCourse['schedule_id'], $arProducts)) { ?>
                                        <a href="#" data-course="<?= $arCourse['schedule_id'] ?>" class="to-basket success"><i
                                                    class="fa fa-check" aria-hidden="true"></i> В корзинe</a>
                                    <? } else { ?>
                                        <a href="#" data-course="<?= $arCourse['schedule_id'] ?>" class="to-basket">В корзину</a>
                                        <?
                                    }
                                }
                            }?>
                        </div>
                    </div>

                </div>
            </div>
        <? } ?>

        <div class="timetable-inn-item-empty">
            <div class="timetable-inn-item-empty-inner">
                <div class="empty-text">Не подходят даты, время или хотите заказать корпоративное обучение для команды?</div>
                <a class="plus-round" href="#">+</a>
                <div class="empty-text">Предложите свой вариант</div>
            </div>
        </div>
    </div>
    <?}?>

    <div class="timetable-inn-list clearfix <? if ($newcity == $_SESSION["cityID"]) { ?> active<? } ?>"
         id="city_<?= $newcity ?>">
        <? if ($newcity == $_SESSION["cityID"] || $newcity == CITY_ID_ONLINE) {
            if ($newcity != CITY_ID_ONLINE) {$city_vis = $newcity;}
        } ?>
        <? $HAS_ANYTHING = "YES" ?>
        <? if ($newcity != CITY_ID_ONLINE) { ?>
            <? $HAS_NORMAL = "YES" ?>
        <? } ?>
        <? } ?>

        <div class="timetable-inn-item-outer">
            <div class="timetable-inn-item-inner">
                <div class="timetable-inn-top">
                    <div class="timetable-dates">
                        <?= $value["startdate"] ?>
                    </div>
                    <div class="short-info-course">
                        <div><span>Время: </span> <?= $value["time"] ?><?
                            if ($value["schedule_city_id"] == "CITY_ID_ONLINE") { ?> (мск.)<?
                            } ?></div>
                        <div><span>Локация: </span> <?= $value["schedule_city"] ?></div>
                        <div><span>Длительность: </span> <?= $value["duration"]; ?> ч.</div>
                    </div>
                    <a class="sign-in smallest scroll" href="#register">Записаться</a>
                </div>
                <div class="timetable-more-info">
                    <div class="trainer-inn-heading">Тренер</div>
                    <? if (strlen($value['prepod_code']) > 0) { ?>
                        <a class="trainer-inn-name" target="_blank"
                           href="/about/experts/<?= $value['prepod_code'] ?>.html"><?= $value["prepod_surname"]; ?>  <?= $value["prepod_name"]; ?></a>
                    <? } else { ?>
                        <span>В процессе согласования</span>
                    <? } ?>
                    <div class="clearfix">
                        <div class="picture-70">
                            <? if (strlen($value["prepod_photo"]["SRC"]) > 0) { ?>
                                <img src="<?= $value["prepod_photo"]["SRC"] ?>"/>
                            <? } ?>
                        </div>
                        <div class="text-tr">
                            <?= $value["prepod_short"]; ?>
                        </div>
                    </div>
                    <div class="price-wrap clearfix">
                        <? if (intval($value["schedule_course_sale"]) > 0) { ?>
                        <div class="big-price-sale">
                            <span class="sale-percent">-<?= intval($value["schedule_course_sale"]) ?>%</span>
                            <? } else { ?>
                            <div class="big-price">
                                <? } ?>

                                <b><? if (intval($value["discount"]) == 0 || $value["discount"] == $value["price"]) { ?>
                                        <?= number_format($value["price"], 0, '', ' '); ?> <?= $value["CURRENCY_NEW"]; ?>
                                        <?if ($value["schedule_city_id"] == CITY_ID_ONLINE) {?>
                                            <br><?= number_format($value["price_ua"], 0, '', ' '); ?> <?=$grivna_sign?>
                                        <?}?>
                                    <? } elseif (intval($value["discount"]) > 0 && $value["discount_type"] == "P") { ?>
                                        <s><?= number_format($value["price"], 0, '', ' '); ?> <?= $value["CURRENCY_NEW"]; ?></s>&nbsp<?= number_format($value["price"] * (100 - $value["discount"]) / 100, 0, '', ' '); ?>  <?= $value["CURRENCY_NEW"]; ?><br>
                                        <?if ($value["schedule_city_id"] == CITY_ID_ONLINE) {?>
                                            <br><s><?= number_format($value["price_ua"], 0, '', ' '); ?> <?=$grivna_sign?></s>&nbsp<?= number_format($value["price_ua"] * (100 - $value["discount"]) / 100, 0, '', ' '); ?>  <?=$grivna_sign?>
                                        <?}?>
                                    <? } elseif (intval($value["discount"]) > 0 && $value["discount_type"] == "F") { ?>
                                        <s><?= number_format($value["price"], 0, '', ' '); ?> <?= $value["CURRENCY_NEW"]; ?></s>&nbsp<?= number_format($value["price"] - $value["discount"], 0, '', ' '); ?>  <?= $value["CURRENCY_NEW"]; ?><br>
                                        <?if ($value["schedule_city_id"] == CITY_ID_ONLINE) {?>
                                            <br> <s><?= number_format($value["price_ua"], 0, '', ' '); ?> <?= $value["CURRENCY_NEW"]; ?></s>&nbsp<?= number_format($value["price_ua"] - $value["discount"], 0, '', ' '); ?>  <?=$grivna_sign?>
                                        <? }?>
                                    <? }?></b>
                                <? if (intval($value["schedule_course_sale"]) > 0) { ?>
                                    <div class="course-price-sale">
                                        <?= number_format($value["price"] * (100 - $value["schedule_course_sale"]) / 100, 0, '', ' '); ?>&nbsp<?= $value["CURRENCY_NEW"]; ?>
                                    </div>
                                <? } ?>
                            </div>

                            <?
                            if(checkUserGroup(['34', '47', '48', '79', '1'])) {
                                if (($value["schedule_city_id"] == CITY_ID_MOSCOW && $value["schedule_yes_basket"] == "Да") || ($value["schedule_city_id"] != CITY_ID_MOSCOW && $value["schedule_city_id"] != CITY_ID_MINSK && $value['show_basket'] != "N")) {
                                    if (in_array($value['schedule_id'], $arProducts)) { ?>
                                        <a href="#" data-course="<?= $value['schedule_id'] ?>" class="to-basket success"><i
                                                    class="fa fa-check" aria-hidden="true"></i> В корзинe</a>
                                    <? } else { ?>
                                        <a href="#" data-course="<?= $value['schedule_id'] ?>" class="to-basket">В
                                            корзину</a>
                                        <?
                                    }
                                }
                            }?>
                        </div>
                    </div>

                </div>
            </div>


            <p style="display:none">
                <?
                if (($_REQUEST["ID_TIME"] == $value["schedule_id"]) or (count($arResult["ITEMS"]) == 1)) { ?>
                    <span id="from_event_date"><?= $value["datecoursestart"] ?></span>
                    <?
                    $arEventInfo["DATE"] = $value["datecoursestart"];
                    $arEventInfo["EVENT_CITY"] = $value["schedule_city_id"];
                    $arEventInfo["TIMETABLE_ID"] = $value['schedule_id'];

                    ?>
                <? } else { ?>
                    <?= $value["startdate"] ?>
                <? } ?>
            </p>


            <?
            $oldcity = $value["schedule_city_id"];
            $number_of = $number_of + 1;
            } ?>
            <? if ($HAS_NORMAL == "YES"){ ?>
            <div class="timetable-inn-item-empty">
                <div class="timetable-inn-item-empty-inner">
                    <div class="empty-text">
                        Не подходят даты, время или хотите заказать корпоративное обучение для команды?
                    </div>
                    <a class="plus-round" href="#">+</a>
                    <div class="empty-text">
                        Предложите свой вариант
                    </div>
                </div>
            </div>
        </div>
    <? } ?>
        <? if ($HAS_NORMAL != "YES"){ ?>
        <? if (count($arCityList) > 0) { ?>
    </div>
<? } ?>
<? } ?>
    <div class="timetable-inn-list <? /*if ($HAS_NORMAL != "YES" || intval($city_vis) == 0*/ if(count(@$arCityList)>0) { ?> active<? } ?> empty-list clearfix">
        <? foreach ($arONLINE as $arCourse) { ?>
        <div class="timetable-inn-item-outer">
            <div class="timetable-inn-item-inner">
                <div class="timetable-inn-top">
                    <div class="timetable-dates">
                        <?= $arCourse["startdate"] ?>
                    </div>
                    <div class="short-info-course">
                        <div>
                            <span>Время: </span> <?= $arCourse["time"] ?><? if ($arCourse["schedule_city_id"] == "CITY_ID_ONLINE") { ?> (мск.)<? } ?>
                        </div>
                        <div><span>Локация: </span> <?= $arCourse["schedule_city"] ?></div>
                        <div><span>Длительность: </span> <?= $arCourse["duration"]; ?> ч.</div>
                    </div>
                    <a class="sign-in smallest scroll" href="#register">Записаться</a>
                </div>
                <div class="timetable-more-info">
                    <div class="trainer-inn-heading">
                        Тренер
                    </div>
                    <? if (strlen($arCourse['prepod_code']) > 0) { ?>
                        <a class="trainer-inn-name" target="_blank"
                           href="/about/experts/<?= $arCourse['prepod_code'] ?>.html"><?= $arCourse["prepod_surname"]; ?>  <?= $arCourse["prepod_name"]; ?></a>
                    <? } else { ?>
                        <span><?= $arCourse["prepod_surname"]; ?>  <?= $arCourse["prepod_name"]; ?></span>
                    <? } ?>
                    <div class="clearfix">
                        <div class="picture-70">
                            <img src="<?= $arCourse["prepod_photo"]["SRC"] ?>"/>
                        </div>
                        <div class="text-tr">
                            <?= $arCourse["prepod_short"]; ?>
                        </div>
                    </div>
                    <div class="price-wrap clearfix">
                        <? if (intval($arCourse["schedule_course_sale"]) > 0) { ?>
                        <div class="big-price-sale">
                            <span class="sale-percent">-<?= intval($arCourse["schedule_course_sale"]) ?>%</span>
                            <? } else { ?>
                            <div class="big-price">
                                <? } ?>

                                <b><? if (intval($arCourse["discount"]) == 0 || $arCourse["discount"] == $arCourse["price"]) { ?>
                                        <?= number_format($arCourse["price"], 0, '', ' '); ?> <?= $arCourse["CURRENCY_NEW"]; ?>
                                        <?if ($arCourse["schedule_city_id"] == CITY_ID_ONLINE) {?>
                                            <br><?= number_format($arCourse["price_ua"], 0, '', ' '); ?> <?=$grivna_sign?>
                                        <?}?>
                                    <? } elseif (intval($arCourse["discount"]) > 0 && $arCourse["discount_type"] == "P") { ?>
                                        <s><?= number_format($arCourse["price"], 0, '', ' '); ?> <?= $arCourse["CURRENCY_NEW"]; ?></s>&nbsp<?= number_format($arCourse["price"] * (100 - $arCourse["discount"]) / 100, 0, '', ' '); ?>  <?= $arCourse["CURRENCY_NEW"]; ?>
                                        <?if ($arCourse["schedule_city_id"] == CITY_ID_ONLINE) {?>
                                            <br><s><?= number_format($arCourse["price_ua"], 0, '', ' '); ?> <?=$grivna_sign?></s>&nbsp<?= number_format($arCourse["price_ua"] * (100 - $arCourse["discount"]) / 100, 0, '', ' '); ?>  <?=$grivna_sign?>
                                        <?}?>
                                    <? } elseif (intval($arCourse["discount"]) > 0 && $arCourse["discount_type"] == "F") { ?>
                                        <s><?= number_format($arCourse["price"], 0, '', ' '); ?> <?= $arCourse["CURRENCY_NEW"]; ?></s>&nbsp<?= number_format($arCourse["price"] - $arCourse["discount"], 0, '', ' '); ?>  <?= $arCourse["CURRENCY_NEW"]; ?>
                                        <?if ($arCourse["schedule_city_id"] == CITY_ID_ONLINE) {?>
                                            <br><s><?= number_format($arCourse["price_ua"], 0, '', ' '); ?> <?=$grivna_sign?></s>&nbsp<?= number_format($arCourse["price_ua"] - $arCourse["discount"], 0, '', ' '); ?>  <?=$grivna_sign?>
                                        <?}?>
                                    <? } ?></b>
                                <? if (intval($arCourse["schedule_course_sale"]) > 0) { ?>
                                    <div class="course-price-sale">
                                        <?= number_format($arCourse["price"] * (100 - $arCourse["schedule_course_sale"]) / 100, 0, '', ' '); ?>&nbsp<?= $arCourse["CURRENCY_NEW"]; ?>
                                        <?if ($arCourse["schedule_city_id"] == CITY_ID_ONLINE) {?>
                                            <br><?= number_format($arCourse["price_ua"] * (100 - $arCourse["schedule_course_sale"]) / 100, 0, '', ' '); ?>&nbsp<?=$grivna_sign?>
                                        <?}?>
                                    </div>
                                <? } ?>
                            </div>
                            <?
                            if(checkUserGroup(['34', '47', '48', '79', '1'])) {
                                if (($arCourse["schedule_city_id"] == CITY_ID_MOSCOW && $arCourse["schedule_yes_basket"] == "Да") || ($arCourse["schedule_city_id"] != CITY_ID_MOSCOW && $arCourse["schedule_city_id"] != CITY_ID_MINSK && $arCourse['show_basket'] != "N")) { ?>
                                    <? if (in_array($arCourse['schedule_id'], $arProducts)) { ?>
                                        <a href="#" data-course="<?= $arCourse['schedule_id'] ?>" class="to-basket success"><i
                                                    class="fa fa-check" aria-hidden="true"></i> В корзинe</a>
                                    <? } else { ?>
                                        <a href="#" data-course="<?= $arCourse['schedule_id'] ?>" class="to-basket">В корзину</a>
                                    <? }
                                }
                            }?>
                        </div>
                    </div>

                </div>
            </div>
            <? } ?>
            <div class="timetable-inn-item-empty">
                <div class="timetable-inn-item-empty-inner">
                    <div class="empty-text">
                        Не подходят даты, время или хотите заказать корпоративное обучение для команды?
                    </div>
                    <a class="plus-round" href="#">+</a>
                    <div class="empty-text">
                        Предложите свой вариант
                    </div>
                </div>
            </div>
        </div>
        <div class="timetable-inn-list-1  all-city-list clearfix <?if(count(@$arCityList) ==0) {?> active <?}?>">
            <? GLOBAL $arCourseInfoID ?>
            <? $duration = $arCourseInfoID["TIMETABLE_INFO"][0]["COURSE_DURATION"]; ?>
            <? $moskowpr = $arCourseInfoID["TIMETABLE_INFO"][0]["COURSE_PRICE_RUB"] ?>
            <?
            $kievpr = $arCourseInfoID["TIMETABLE_INFO"][0]["COURSE_PRICE_UA"];
            if($kievpr == "") $kievpr = $schedule_price_ua;
            ?>
            <table class="dashed-border">

                <? // Здесь было захардкодена отдельная обработка курсов в коде которых присутствует PTRN, эт одавало ошибку при выводе цен - они не выводились, если что можно этот кусок кода вернуть ?>
                <? //if (preg_match("#PTRN#", $arCourseInfoID["TIMETABLE_INFO"][0]["COURSE_CODE"])) {?>
                <? //if ($arCourseInfoID["TIMETABLE_INFO"][0]["COURSE_CODE"]=="PTRN-029") {?>
                <!--<tr>
					<td class="city">
						Киев
					</td>
					<td class="price"><? //=number_format(fn_getMostNewCityPrice($moskowpr, $kievpr,CITY_ID_KIEV, $duration), 0, ',', ' ');?>&nbsp;<?=$grivna_sign?></td>
				 </tr>-->

                <? //} else {?>
                <!--<tr>
                <td class="city">-->

                <? //=$arCourseInfoID["TIMETABLE_INFO"][0]["TIMETABLE"][0]["TIMETABLE_CITY_NAME"]?>

                <!--</td>
                <td class="price" align="right">-->
                <? //=number_format($arCourseInfoID["TIMETABLE_INFO"][0]["TIMETABLE"][0]["TIMETABLE_PRICE"], 0, ',', ' ');?>
                <? //if (($arCourseInfoID["TIMETABLE_INFO"][0]["TIMETABLE"][0]["TIMETABLE_CITY_ID"]==CITY_ID_KIEV)|| ($arCourseInfoID["TIMETABLE_INFO"][0]["TIMETABLE"][0]["TIMETABLE_CITY_ID"]==CITY_ID_ODESSA)|| ($arCourseInfoID["TIMETABLE_INFO"][0]["TIMETABLE"][0]["TIMETABLE_CITY_ID"]==CITY_ID_DNEPR)) {?>
                <!--грн.-->
                <? //} else {?>
                <!--<span class="rouble-sign">1</span>-->
                <? //}?>
                <!--</td>
             </tr>-->
                <? //}?>
                <? //} else if если будем раскомментировать этот блок, то if в блоке нижеубираем, берем этот else if ?>

                <tr>
                    <td><b>Онлайн </b></td>
                    <td class="price" align="right">
                        <?= number_format($moskowpr, 0, ',', ' '); ?>&nbsp;<?=$rubl_sign?><!--<span class="rouble-sign">1</span>--><br>
                        <?= number_format($kievpr, 0, ',', ' '); ?>&nbsp;<?=$grivna_sign?>
                    </td>
                </tr>

                <?if(false) {?>

                <? if ($arCourseInfoID["TIMETABLE_INFO"][0]["TIMETABLE"][0]["TIMETABLE_CITY_ID"] == CITY_ID_ONLINE) { ?>
                    <tr>
                    <td><b>Онлайн </b></td>
                    <td class="price" align="right">
                        <?= number_format($moskowpr, 0, ',', ' '); ?>&nbsp;<?=$rubl_sign?><!--<span class="rouble-sign">1</span>--><br>
                        <?= number_format($kievpr, 0, ',', ' '); ?>&nbsp;<?=$grivna_sign?>
                    </td>
                <? } else {
                    $priceUA = round(($moskowpr / 35 - $moskowpr / 35 * 0.3) / 10) * 10;
                    ?>
                    <? if ($arCourseInfoID["SHOW_UKRANIAN_ONLY"] != "Да") { ?>
                        <tr>
                            <td class="city">Москва</td>
                            <td class="price"><?= number_format($moskowpr, 0, ',', ' '); ?>&nbsp;<?=$rubl_sign?><!--<span class="rouble-sign">1</span>--></td>
                        </tr>
                    <? } ?>
                    <? if ($arCourseInfoID["SHOW_ONE_PRICE"] != "Да") { ?>
                        <? if ($arCourseInfoID["SHOW_UKRANIAN_ONLY"] != "Да") { ?>
                            <tr>
                                <td class="city">Санкт-Петербург</td>
                                <td class="price"><?= number_format(fn_getNewCityPrice($moskowpr, CITY_ID_SPB, $duration), 0, ',', ' '); ?>&nbsp;<?=$rubl_sign?><!--<span class="rouble-sign">1</span>--></td>
                            </tr>
                            <tr>
                                <td class="city">Омск</td>
                                <td class="price"><?= number_format(fn_getNewCityPrice($moskowpr, CITY_ID_OMSK, $duration), 0, ',', ' '); ?>&nbsp;<?=$rubl_sign?><!--<span class="rouble-sign">1</span>--></td>
                            </tr>
                        <? } ?>
                        <? //if (intval($kievpr)>0) {?>
                        <tr>
                            <td class="city">Киев</td>
                            <td class="price"><?= number_format(fn_getMostNewCityPrice($moskowpr, $kievpr, CITY_ID_KIEV, $duration), 0, ',', ' '); ?>
                                <span style="font-weight: normal;">&nbsp;<?=$grivna_sign?></span></td>
                        </tr>
                        <tr>
                            <td class="city">Одесса</td>
                            <td class="price"><?= number_format(fn_getMostNewCityPrice($moskowpr, $kievpr, CITY_ID_ODESSA, $duration), 0, ',', ' '); ?>
                                <span style="font-weight: normal;">&nbsp;<?=$grivna_sign?></span></td>
                        </tr>
                        <tr>
                            <td class="city">Днепр</td>
                            <td class="price"><?= number_format(fn_getMostNewCityPrice($moskowpr, $kievpr, CITY_ID_DNEPR, $duration), 0, ',', ' '); ?>
                                <span style="font-weight: normal;">&nbsp;<?=$grivna_sign?></span></td>
                        </tr>
                    <? } ?>
                    <? //}?>
                <? } ?>
                <?}?>
            </table>
        </div>
        <? if (count($arCityList) == 0) { ?>
    </div>
<? } ?>
    <? if (count($arResult["ITEMS"]) != 0) { ?>

</div>
<? } ?>
<? /*<div class="date-offer">
   Не подходят даты или время?<br>
   <a href="#">Предложите свой вариант</a>
</div>*/ ?>
<?
//теперь рассмотрим ситуацию когда тренинг не стоит в расписании воообще
// получим цену курса и ее длительность по умолчанию
if (count($arResult["ITEMS"]) == 0) {
    $arSelect = Array(
        "PROPERTY_course_price",
        "PROPERTY_course_duration",
        "PROPERTY_course_idcategory",
        "PROPERTY_course_code",
        "PROPERTY_course_format"
    );
    $arFilter = Array("IBLOCK_ID" => 6, "ID" => intval($_GET["ID"]));
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while ($ar_fields = $res->GetNext()) {
        $course_price = $ar_fields["PROPERTY_COURSE_PRICE_VALUE"];
        $course_duration = $ar_fields["PROPERTY_COURSE_DURATION_VALUE"];
        $course_id_category = $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
        $course_code = $ar_fields["PROPERTY_COURSE_CODE_VALUE"];
        $course_online_enumid = $ar_fields["PROPERTY_COURSE_FORMAT_ENUM_ID"];
    }
    if ($course_online_enumid == 103) {
        $bOnlineCourse = true;
    } else {
        $bOnlineCourse = false;
    } ?>

    <?
    $arEventInfo["DATE"] = "";
    $arEventInfo["EVENT_CITY"] = "-";
    $arEventInfo["PRICE"] = $course_price;
    $arEventInfo["DURATION"] = $course_duration;
    ?>
<? } ?>
</div>
