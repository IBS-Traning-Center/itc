<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$dateOffsetEnd = 60 * 60 * 24 * 31;
if (!empty($arResult['PROPERTIES']['DATE_FROM']['VALUE'])) {
    $startDate = strtotime($arResult['PROPERTIES']['DATE_FROM']['VALUE']);
} else {
    $startDate = strtotime($arResult['DATE_CREATE']);
}

$date = date("Y-m-d", $startDate);

if (!empty($arResult['PROPERTIES']['DATE_ONLINE_FROM']['VALUE'])) {
    $date_online = date("Y-m-d", strtotime($arResult['PROPERTIES']['DATE_ONLINE_FROM']['VALUE']));
} else {
    $date_online = $date;
}


if (!empty($arResult['PROPERTIES']['DATE_TO']['VALUE'])) {
    $endDate = date("Y-m-d", strtotime($arResult['PROPERTIES']['DATE_TO']['VALUE']));
} else {
    $endDate = date("Y-m-d", strtotime($arResult['PROPERTIES']['DATE_FROM']['VALUE']) + $dateOffsetEnd);
}

if (!empty($arResult['PROPERTIES']['DATE_ONLINE_TO']['VALUE'])) {
    $endDate_online = date("Y-m-d", strtotime($arResult['PROPERTIES']['DATE_ONLINE_TO']['VALUE']));
} else {
    $endDate_online = $endDate;
}

$filterDate = (strtotime($date) < strtotime($date_online)) ? $date : $date_online;
$filterEndDate = (strtotime($endDate) > strtotime($endDate_online)) ? $endDate : $endDate_online;

unset($dateOffsetEnd);

$arCityId = '';

$regionCodes = $arResult['PROPERTIES']['REGION']['VALUE_XML_ID'];

if (!is_array($regionCodes)) $regionCodes = array(0 => $regionCodes);
foreach ($regionCodes as $regionCode) {
    switch ($regionCode) {
        case 'WORLD':
        case 'MOSCOW':
            $arCityId = array_merge($arCityId, [CITY_ID_MOSCOW]);
            break;
        case 'OMSK':
            $arCityId = array_merge($arCityId, [CITY_ID_OMSK]);
            break;
        case 'SPB':
            $arCityId = array_merge($arCityId, [CITY_ID_SPB]);
            break;
        case 'UA':
            $arCityId = array_merge($arCityId, [CITY_ID_KIEV, CITY_ID_DNEPR, CITY_ID_ODESSA]);
            break;
    }
}

$arSelect = array(
    "IBLOCK_ID",
    "ID",
    "NAME",
    "CODE",
    "DETAIL_PAGE_URL",
    "PROPERTY_CITY",
    "PROPERTY_COURSE_СODE",
    "PROPERTY_STARTDATE",
    "PROPERTY_ENDDATE",
    "PROPERTY_SCHEDULE_TIME",
    "PROPERTY_SCHEDULE_DESCRIPTION",
    "PROPERTY_SCHEDULE_PRICE",
    "PROPERTY_SCHEDULE_DURATION",
    "PROPERTY_SCHEDULE_COURSE_TYPE",
    "PROPERTY_HOT_CHECKBOX",
    "PROPERTY_PRSCHEDULE_STARTDATE",
    "PROPERTY_PRSCHEDULE_ENDDATE",
    "PROPERTY_PRSCHEDULE_TIME",
    "PROPERTY_PRSCHEDULE_DESC",
    "PROPERTY_SCHEDULE_COURSE",
    "PROPERTY_TEACHER",
    "PROPERTY_STRING_TEACHER",
    "PROPERTY_COURSE_CODE",
    "PROPERTY_ICON_SALE",
    "PROPERTY_ICON_SALE_LINK",
);
$arrFilter = array(
    "IBLOCK_TYPE" => "edu",
    "IBLOCK_ID" => "9",
    "PROPERTY_CITY" => $arCityId,
    "ACTIVE" => "Y", ">=PROPERTY_STARTDATE" => $filterDate,
    "<=PROPERTY_STARTDATE" => $filterEndDate
);

if (!empty($arResult['PROPERTIES']['CODE_FILTER']['VALUE'])) {
    $arrFilter['PROPERTY_COURSE_CODE'] = $arResult['PROPERTIES']['CODE_FILTER']['VALUE'];
}


$dbCourse = CIBlockElement::GetList(array("PROPERTY_STARTDATE" => "ASC", "SORT" => "ASC"), $arrFilter, false, false, $arSelect);
$regions = [];
$arScheduleCourseId = [];
$arTeacherId = [];
$arCity = [];
while ($arItem = $dbCourse->GetNext()) {
    if (empty($arItem['PROPERTY_CITY_VALUE'])) continue;
    $schedule = [
        'id' => $arItem['ID'],
        'code' => $arItem['PROPERTY_COURSE_CODE_VALUE'],
        'course' => $arItem['PROPERTY_SCHEDULE_COURSE_VALUE'],
        'type' => $arItem['PROPERTY_SCHEDULE_COURSE_TYPE_VALUE'],
        'city' => $arItem['PROPERTY_CITY_VALUE'],
        'date' => $arItem['PROPERTY_STARTDATE_VALUE'],
        'time' => $arItem['PROPERTY_SCHEDULE_TIME_VALUE'],
        'description' => $arItem['~PROPERTY_SCHEDULE_DESCRIPTION_VALUE'],
        'price' => $arItem['PROPERTY_SCHEDULE_PRICE_VALUE'],
        'duration' => $arItem['PROPERTY_SCHEDULE_DURATION_VALUE'],
        'teacher' => [
            'id' => $arItem['PROPERTY_TEACHER_VALUE'],
            'name' => $arItem['PROPERTY_STRING_TEACHER_VALUE']
        ],
        'icon_sale' => $arItem['PROPERTY_ICON_SALE_VALUE'],
        'icon_sale_link' => $arItem['PROPERTY_ICON_SALE_LINK_VALUE'],
    ];

    if ($schedule['city'] == CITY_ID_ONLINE) {
        Bitrix\Main\Diag\Debug::writeToFile('Online - ' . $schedule['city']);
        if (
            strtotime($schedule['date']) < strtotime($date_online) ||
            strtotime($schedule['date']) > strtotime($endDate_online)) continue;
    } else {
        Bitrix\Main\Diag\Debug::writeToFile('Not Online` - ' . $schedule['city']);
        if (
            strtotime($schedule['date']) < strtotime($date) ||
            strtotime($schedule['date']) > strtotime($endDate)) continue;
    }

    if (strlen($arItem['PROPERTY_ENDDATE_VALUE']) > 0) {
        $schedule['date'] .= "-<br/>" . $arItem['PROPERTY_ENDDATE_VALUE'];
    }
    $schedule['date'] = str_replace(".2011", "", $schedule['date']);
    $schedule['date'] = str_replace(".2012", "", $schedule['date']);

    $regions[$schedule['city']]['items'][$schedule['id']] = $schedule;

    $arResult['directions'][$schedule['type']];
    $arResult['directions'][$schedule['type']]['items'][$schedule['id']] = &$regions[$schedule['city']]['items'][$schedule['id']];

    $arCourseId[] = $schedule['course'];
    $arTeacherId[] = $schedule['teacher']['id'];
    $arCity[$schedule['city']] = $schedule['city'];
}
unset($date, $endDate, $arCityId, $arSelect, $arrFilter, $dbCourse, $arItem, $schedule);

$rsDirections = CIBlockElement::GetList(array('SORT' => 'ASC', 'NAME' => 'ASC'), array('ID' => array_keys($arResult['directions'])), false, false, array('ID', 'NAME'));
while ($arDirection = $rsDirections->GetNext()) {
    if (!empty($arResult['directions'][$arDirection['ID']])) {
        $arResult['directions'][$arDirection['ID']]['id'] = $arDirection['ID'];
        $arResult['directions'][$arDirection['ID']]['name'] = $arDirection['NAME'];
    }
    unset($arDirection);
}
unset($rsDirections);

if (!empty($arResult['PROPERTIES']['DIRECTION_FILTER']['VALUE'])) {
    $directions = $arResult['PROPERTIES']['DIRECTION_FILTER']['VALUE'];
    if (!is_array($directions)) $directions = array(0 => $directions);
    foreach ($directions as &$currentDirection) $currentDirection = trim($currentDirection);

    foreach ($arResult['directions'] as $indexDirection => $direction) {
        if (!in_array(trim($direction['id']), $directions)) {
            unset($arResult['directions'][$indexDirection]);
        }
    }
}

$arCity = array_unique($arCity);
if (count($arCity)) {
    $arSelect = array("ID", "NAME", "SORT");
    $arFilter = array("IBLOCK_ID" => D_CITIES_IBLOCK, "ID" => $arCity);
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    $arCity = [];
    while ($ar_fields = $res->GetNext()) {
        if ($ar_fields['NAME'] === 'Онлайн') $ar_fields['SORT'] = 1;
        $arCity[$ar_fields['ID']] = [
            'name' => $ar_fields["NAME"],
            'sort' => $ar_fields["SORT"]
        ];
    }
}
unset($arSelect, $arFilter, $res, $ar_fields);

$arCourseId = array_unique($arCourseId);
if (count($arCourseId)) {
    $arSelect = array(
        "ID",
        "NAME",
        "PROPERTY_course_price",
        "PROPERTY_course_duration",
        "PROPERTY_course_idcategory",
        "PROPERTY_course_code",
        "PROPERTY_course_format",
        "PROPERTY_short_descr",
        "PROPERTY_ID_COURSE_OWNER",
    );
    $arFilter = array("IBLOCK_ID" => 6, "ID" => $arCourseId);
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    $arCurse = [];
    $arCourseCategoryId = [];
    while ($ar_fields = $res->GetNext()) {
        $arCurse[$ar_fields['ID']] = [
            'id' => $ar_fields['ID'],
            'price' => $ar_fields["PROPERTY_COURSE_PRICE_VALUE"],
            'duration' => $ar_fields["PROPERTY_COURSE_DURATION_VALUE"],
            'idCategory' => $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"],
            'code' => $ar_fields["PROPERTY_COURSE_CODE_VALUE"],
            'onlineEnumId' => $ar_fields["PROPERTY_COURSE_FORMAT_ENUM_ID"],
            'nameFromCatalog' => $ar_fields["NAME"],
            'short' => $ar_fields["PROPERTY_SHORT_DESCR_VALUE"],
            'ownerId' => $ar_fields["PROPERTY_ID_COURSE_OWNER_ENUM_ID"],
        ];
        $arCourseCategoryId[] = $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
    }
    unset($arSelect, $arFilter, $res, $ar_fields);
}

$arCourseCategoryId = array_unique($arCourseCategoryId);
if (count($arCourseCategoryId)) {
    $arSelect = array("ID", "NAME", "SORT");
    $arFilter = array("IBLOCK_ID" => 50, "ID" => $arCourseCategoryId);
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    $arCourseCategory = [];
    while ($ar_fields = $res->GetNext()) {
        $arCourseCategory[$ar_fields['ID']] = [
            "name" => $ar_fields["NAME"],
            "sort" => $ar_fields["SORT"]
        ];
    }
    unset($arSelect, $arFilter, $res, $ar_fields);
}

$arTeacherId = array_unique($arTeacherId);
if (count($arTeacherId)) {
    $arSelect = array("ID", "NAME", "CODE", "PROPERTY_EXPERT_NAME", "PREVIEW_PICTURE");
    $arFilter = array("IBLOCK_ID" => 56, "ID" => $arTeacherId);
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    $arTeacher = [];
    while ($ar_fields = $res->GetNext()) {
        $arTeacher[$ar_fields['ID']] = [
            "id" => $ar_fields["ID"],
            "active" => $ar_fields["ACTIVE"],
            "code" => strtolower($ar_fields["CODE"]),
            "name" => $ar_fields["PROPERTY_EXPERT_NAME_VALUE"],
            "surname" => $ar_fields["NAME"],
            "photo" => CFile::GetFileArray($ar_fields["PREVIEW_PICTURE"])['SRC']
        ];
    }
    unset($arSelect, $arFilter, $res, $ar_fields);
}

$icons = [
    '5735' => '/images/digest2014/bisnes.jpg',
    '34743' => '/images/digest2014/bisnes.jpg',
    '53918' => '/images/digest2014/bisnes.jpg',
    '5725' => '/images/digest2014/analys.jpg',
    '5730' => '/images/digest2014/develop.jpg',
    '5728' => '/images/digest2014/arch.jpg',
    '5729' => '/images/digest2014/test.jpg',
    '5723' => '/images/digest2014/manag.jpg',
    'default' => '/images/digest2014/analys.jpg'
];

foreach ($regions as $regionKey => &$arRegion) {
    foreach ($arRegion['items'] as $regionItemKey => &$arItem) {
        if (!empty($arResult['PROPERTIES']['UTM_TEMPLATE']['VALUE'])) {
            $arItem['utm'] = $arResult['PROPERTIES']['UTM_TEMPLATE']['VALUE'];
        } else {
            switch ($arItem['city']) {
                case CITY_ID_OMSK:
                    $arItem['utm'] = 'utm_source=rassylka&utm_medium=email_Omsk&utm_campaign=digest_' . date('m_Y', $startDate);
                    break;
                case CITY_ID_SPB:
                    $utm = 'utm_source=rassylka&utm_medium=email_Spb&utm_campaign=digest_' . date('m_Y', $startDate);
                    break;
                case CITY_ID_KIEV:
                case CITY_ID_DNEPR:
                case CITY_ID_ODESSA:
                    $arItem['utm'] = 'utm_source=rassylka&utm_medium=email_Ukraine&utm_campaign=digest_' . date('m_Y', $startDate);
                    break;
                default:
                    $arItem['utm'] = 'utm_source=rassylka&utm_medium=email_Moscow&utm_campaign=digest_' . date('m_Y', $startDate);
            }
        }
        if (!empty($arCity[$arItem['city']])) {
            $arItem['city'] = $arCity[$arItem['city']];
        }
        $course = $arCurse[$arItem['course']];
        if (!empty($course)) {
            if (!empty($arCourseCategory[$course['idCategory']])) {
                $course['category'] = [
                    'id' => $course['idCategory'],
                    'sort' => $arCourseCategory[$course['idCategory']]['sort'],
                    'name' => $arCourseCategory[$course['idCategory']]['name'],
                    'icon' => (!empty($icons[$course["idCategory"]])) ? $icons[$course["idCategory"]] : $icons['default']
                ];
                unset($course['id_category']);
            }
            $arItem['course'] = $course;
        }


        if (!empty($arItem['teacher'])) {
            if (($arItem['teacher']['id'] > 0) && !empty($arTeacher[$arItem['teacher']['id']])) {
                $arItem['teacher'] = $arTeacher[$arItem['teacher']['id']];
            } else {
                $arItem['teacher']['photo'] = "/images_new/about/zagl.jpg";
                $arItem['teacher']['active'] = "N";
            }
        }
    }
    if (!empty($arCity[$regionKey]) && !empty($arCity[$regionKey]['sort']) && ((int)$arCity[$regionKey]['sort'] > 0)) {
        $arResult['regions'][(int)$arCity[$regionKey]['sort']] = [
            'name' => $arCity[$regionKey]['name'],
            'items' => $arRegion['items']
        ];
    } else {
        $arResult['regions'][] = [
            'name' => 'Другой город',
            'items' => $arRegion['items']
        ];
    }
    unset($regionItemKey, $arItem);
}
unset($regions, $regionKey, $arRegion);
ksort($arResult['regions']);
