<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$ii = 0; // для массива куда мы будем класть значения
$vMavCount = 9;
$arValueOfCourses = array();
foreach ($arResult["ITEMS"] as $arItem) {
    $prepod_surname = "";
    $prepod_name = "";
    $prepod_code = "";
    $schedule_course_id = $arItem['PROPERTIES']['schedule_course']['VALUE'];
    //iwrite($arItem['PROPERTIES']);
    $city = $arItem['PROPERTIES']['city']['VALUE'];
    $schedule_startdate = $arItem['PROPERTIES']['startdate']['VALUE'];
    $schedule_enddate = $arItem['PROPERTIES']['enddate']['VALUE'];
    $schedule_time = $arItem['PROPERTIES']['schedule_time']['VALUE'];
    $schedule_description = $arItem['PROPERTIES']['schedule_description']['VALUE']['TEXT'];
    $schedule_price = $arItem['PROPERTIES']['schedule_price']['VALUE'];
    $schedule_duration = $arItem['PROPERTIES']['schedule_duration']['VALUE'];
    $schedule_teacher_string = $arItem['PROPERTIES']['string_teacher']['VALUE'];
    $schedule_teacher_id = $arItem['PROPERTIES']['teacher']['VALUE'];
    if (strlen($schedule_enddate) > 0) {
        $schedule_startdate .= "-<br/>" . $schedule_enddate;
    }
    $schedule_startdate = str_replace(".2011", "", $schedule_startdate);
    $schedule_startdate = str_replace(".2011", "", $schedule_startdate);
    $schedule_startdate = str_replace(".2012", "", $schedule_startdate);
    $arSelect = Array(
        "PROPERTY_course_price",
        "PROPERTY_course_duration",
        "PROPERTY_course_idcategory",
        "PROPERTY_course_code",
        "PROPERTY_course_format",
        "PROPERTY_short_descr",
        "PROPERTY_ID_COURSE_OWNER",
        "NAME",
    );
    $arFilter = Array("IBLOCK_ID" => 6, "ID" => $schedule_course_id);
    //print_r($arFilter);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while ($ar_fields = $res->GetNext()) {
        $course_price = $ar_fields["PROPERTY_COURSE_PRICE_VALUE"];
        $course_duration = $ar_fields["PROPERTY_COURSE_DURATION_VALUE"];
        $course_id_category = $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
        $course_code = $ar_fields["PROPERTY_COURSE_CODE_VALUE"];
        $course_online_enumid = $ar_fields["PROPERTY_COURSE_FORMAT_ENUM_ID"];
        $courseNameFromCatalog = $ar_fields["NAME"];
        $courseShort = $ar_fields["PROPERTY_SHORT_DESCR_VALUE"];
        $courseOwnerID = $ar_fields["PROPERTY_ID_COURSE_OWNER_ENUM_ID"];
        //iwrite($ar_fields);
    }

    $arSelect = Array("NAME", "SORT");
    $arFilter = Array("IBLOCK_ID" => 50, "ID" => $course_id_category);

    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while ($ar_fields = $res->GetNext()) {
        $cat_name = $ar_fields["NAME"];
        $cat_sort = $ar_fields["SORT"];
    }
    $prepod_photo = "";
    if ($schedule_teacher_id > 0) {
        $arSelect = Array("NAME", "PROPERTY_expert_name", "CODE", "PREVIEW_PICTURE");
        $arFilter = Array("IBLOCK_ID" => 56, "ID" => $schedule_teacher_id);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while ($ar_fields = $res->GetNext()) {

            $prepod_surname = $ar_fields["NAME"];
            $prepod_code = strtolower($ar_fields["CODE"]);
            $prepod_name = $ar_fields["PROPERTY_EXPERT_NAME_VALUE"];
            $prepod_active = $ar_fields["ACTIVE"];
            $prepod_photo = CFile::GetFileArray($ar_fields["PREVIEW_PICTURE"]);
        }
    } else {
        $prepod_photo["SRC"] = "/images_new/about/zagl.jpg";
        $prepod_active = "N";
        $prepod_surname = $schedule_teacher_string;
    }

    $arValueOfCourses[$ii]["sort"] = $cat_sort;
    $arValueOfCourses[$ii]["cat_name"] = $cat_name;
    $arValueOfCourses[$ii]["name"] = trim($courseNameFromCatalog);
    $arValueOfCourses[$ii]["short"] = $courseShort;
    $arValueOfCourses[$ii]["startdate"] = $schedule_startdate;
    $arValueOfCourses[$ii]["time"] = $schedule_time;
    $arValueOfCourses[$ii]["duration"] = $schedule_duration;
    $arValueOfCourses[$ii]["price"] = $schedule_price;
    $arValueOfCourses[$ii]["course_id"] = $schedule_course_id;
    $arValueOfCourses[$ii]["course_code"] = $course_code;
    $arValueOfCourses[$ii]["cat_id"] = $course_id_category;
    $arValueOfCourses[$ii]["prepod_surname"] = $prepod_surname;
    $arValueOfCourses[$ii]["prepod_code"] = $prepod_code;
    $arValueOfCourses[$ii]["prepod_name"] = $prepod_name;
    $arValueOfCourses[$ii]["prepod_photo"] = $prepod_photo;
    $arValueOfCourses[$ii]["online_id"] = $course_online_enumid;
    $arValueOfCourses[$ii]["courseOwnerID"] = $courseOwnerID;
    $arValueOfCourses[$ii]["time_id"] = $arItem["ID"];
    $arValueOfCourses[$ii]["detail_page_url"] = $arItem["DETAIL_PAGE_URL"];
    $arValueOfCourses[$ii]["city"] = GetCityNameByID($arItem['PROPERTIES']['city']['VALUE']);
    //iwrite($arValueOfCourses);
    if ($arItem['PROPERTIES']['city']['VALUE'] == CITY_ID_OMSK) { ?>
        <? $utm = 'utm_source=rassylka&utm_medium=email_Omsk&utm_campaign=digest_' . date('m_Y'); ?>
    <? } elseif ($arItem['PROPERTIES']['city']['VALUE'] == CITY_ID_SPB) { ?>
        <? $utm = 'utm_source=rassylka&utm_medium=email_Spb&utm_campaign=digest_' . date('m_Y'); ?>
    <? } elseif (($arItem['PROPERTIES']['city']['VALUE'] == CITY_ID_KIEV) || ($arItem['PROPERTIES']['city']['VALUE'] == CITY_ID_DNEPR) || ($arItem['PROPERTIES']['city']['VALUE'] == CITY_ID_ODESSA)) { ?>
        <? $utm = 'utm_source=rassylka&utm_medium=email_Ukraine&utm_campaign=digest_' . date('m_Y'); ?>
    <? } else { ?>
        <? $utm = 'utm_source=rassylka&utm_medium=email_Moscow&utm_campaign=digest_' . date('m_Y'); ?>
    <? } ?>
    <? $ii = $ii + 1; ?>
<? } ?>
<table border="0" cellpadding="0" cellspacing="0" width="750" summary="" align="center">
    <tr>
        <td style="padding: 0 15px;" class="emailContainer" valign="top">
            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                <tr>
                    <td style="width: 249px; height: 80px; background: #426192; text-align: center; vertical-align: middle; font-size: 20px;">
                        <a style="display: block; color: #fff; text-decoration: none; font-family: tahoma, geneva, sans-serif;"
                           href="http://ibs-training.ru/timetable/">Расписание курсов</a>
                    </td>
                    <td style="background: #fff; text-align: right; font-size: 16px; color: #426192; font-weight: bold; padding-right: 28px; font-family: tahoma, geneva, sans-serif;">
                        <img src="/images/digest2018/icon-location.jpg"/>&nbsp;&nbsp;&nbsp;&nbsp;
                        <? if ($arItem['PROPERTIES']['city']['VALUE'] == CITY_ID_MOSCOW) { ?>
                            МОСКВА
                        <? } elseif ($arItem['PROPERTIES']['city']['VALUE'] == CITY_ID_KIEV) { ?>
                            КИЕВ
                        <? } elseif ($arItem['PROPERTIES']['city']['VALUE'] == CITY_ID_SPB) { ?>
                            САНКТ-ПЕТЕРБУРГ
                        <? } elseif ($arItem['PROPERTIES']['city']['VALUE'] == CITY_ID_OMSK) { ?>
                            ОМСК
                        <? } elseif ($arItem['PROPERTIES']['city']['VALUE'] == CITY_ID_DNEPR) { ?>
                            ДНЕПР
                        <? } elseif ($arItem['PROPERTIES']['city']['VALUE'] == CITY_ID_ODESSA) { ?>
                            ОДЕССА
                        <? } else { ?>
                            ОНЛАЙН
                        <? } ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="whitespace" height="45">&nbsp;</td>
    </tr><? $index = 0;
    while (list($key, $value) = each($arValueOfCourses)) {
        switch ($value["cat_id"]) {
            case "5735":
                $icon = "/images/digest2014/bisnes.jpg";
                break;
            case "34743":
                $icon = "/images/digest2014/bisnes.jpg";
                break;
            case "53918":
                $icon = "/images/digest2014/bisnes.jpg";
                break;
            case "5725":
                $icon = "/images/digest2014/analys.jpg";
                break;
            case "5730":
                $icon = "/images/digest2014/develop.jpg";
                break;
            case "5728":
                $icon = "/images/digest2014/arch.jpg";
                break;
            case "5729":
                $icon = "/images/digest2014/test.jpg";
                break;
            case "5723":
                $icon = "/images/digest2014/manag.jpg";
                break;
            default:
                $icon = "/images/digest2014/analys.jpg";
        }?>
    <tr>
        <td style="padding: 0 15px;">
            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                <tr>
                    <td style="background: #fff; border-bottom: 1px solid #f4f4f4; height: 84px; padding-left: 36px; border-left: 3px solid #426192; vertical-align: middle; width: 400px; padding-right: 15px;">
                        <a style="font-size: 16px; color: #426192; text-decoration: none; font-family: tahoma, geneva, sans-serif;"
                           href="http://ibs-training.ru/training/catalog/course.html?ID=<?= $value[course_id] ?>&ID_TIME=<?= $value[time_id] ?>&<?= $utm ?>"><?= $value["name"] ?></a>
                    </td>
                    <td style="background: #fff; background: #fff; border-bottom: 1px solid #f4f4f4; padding-right: 15px;">
                        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                            <tr>
                                <td style="padding-right: 12px; width: 16px;"><img
                                            src="/images/digest2018/date.jpg"/></td>
                                <td style="font-size: 14px; color: #426192; font-family: tahoma, geneva, sans-serif;"><?= $value["startdate"] ?></td>
                            </tr>
                        </table>
                    </td>
                    <td style="background: #fff; background: #fff; border-bottom: 1px solid #f4f4f4; text-align: right; padding-right: 36px;">
                        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                            <td style="padding-right: 12px; width: 15px;"><img src="/images/digest2018/time.jpg"/>
                            </td>
                            <td style="font-size: 14px; color: #426192; font-family: tahoma, geneva, sans-serif;"><?= $value["time"] ?><? if (($value["online_id"] == "103") or ($value["schedule_city"] == CITY_ID_ONLINE)) { ?>(мск.)<? } ?></td>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="whitespace" height="10">&nbsp;</td>
    </tr><?
        $index = $index + 1;
    }?>
    <tr>
        <td class="whitespace" height="20">&nbsp;</td>
    </tr>
</table>
								
									
							