<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональный раздел");

$categoryFilter = $_GET['specialty'] ?? '';
$priceFrom = $_GET['price_from'] ?? 0;
$priceTo = $_GET['price_to'] ?? 9999999;

function getSelfStudyValue() {
    $property = CIBlockProperty::GetList(
        array(),
        array('IBLOCK_ID' => 6, 'CODE' => 'FORMAT')
    )->Fetch();

    if ($property && $property['PROPERTY_TYPE'] == 'L') {
        $enumRes = CIBlockPropertyEnum::GetList(
            array(),
            array(
                'PROPERTY_ID' => $property['ID'],
                'VALUE' => 'Self_Study'
            )
        );

        if ($enum = $enumRes->Fetch()) {
            return $enum['ID'];
        }
    }

    return 'Self_Study';
}

$selfStudyValue = getSelfStudyValue();

$baseCourseFilter = array(
    'IBLOCK_ID' => 6,
    'ACTIVE' => 'Y',
);
if (is_numeric($selfStudyValue)) {
    $baseCourseFilter['!=PROPERTY_FORMAT_VALUE'] = $selfStudyValue;
} else {
    $baseCourseFilter['!=PROPERTY_FORMAT'] = $selfStudyValue;
}
$coursesRes = CIBlockElement::GetList(
    array(),
    $baseCourseFilter,
    false,
    false,
    array('ID')
);

$allCourseIds = array();
while ($course = $coursesRes->Fetch()) {
    $allCourseIds[] = $course['ID'];
}

$arFilter = array(
    "IBLOCK_ID" => 9,
    "ACTIVE" => "Y",
);

$arFilter['PROPERTY_SCHEDULE_COURSE'] = $allCourseIds;

if ($categoryFilter) {

    $filteredCourseFilter = $baseCourseFilter;
    $filteredCourseFilter['PROPERTY_COURSE_IDCATEGORY'] = (int)$categoryFilter;

    $filteredCoursesRes = CIBlockElement::GetList(
        array(),
        $filteredCourseFilter,
        false,
        false,
        array('ID')
    );

    $filteredCourseIds = array();
    while ($course = $filteredCoursesRes->Fetch()) {
        $filteredCourseIds[] = $course['ID'];
    }

    if (!empty($filteredCourseIds)) {
        $arFilter['PROPERTY_SCHEDULE_COURSE'] = $filteredCourseIds;
    } else {
        $arFilter['ID'] = 0;
    }
}

if ($priceFrom > 0) {
    $arFilter['>=PROPERTY_SCHEDULE_PRICE'] = $priceFrom;
}
if ($priceTo < 9999999) {
    $arFilter['<=PROPERTY_SCHEDULE_PRICE'] = $priceTo;
}
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "personal-lk",
    array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(),
        "FILTER_NAME" => "arFilter",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "9",
        "IBLOCK_TYPE" => "edu",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "INCLUDE_SUBSECTIONS" => "Y",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "20",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "Новости",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array(
            "course_code", "startdate", "enddate", "schedule_time",
            "schedule_description", "schedule_price", "schedule_onl_price",
            "schedule_duration", "hot_checkbox", "online_link", "TIME_INTERVAL",
            "IS_CLOSE", "LINK_DISCOUNT", "string_teacher", "LMS_ID", "CAN_BUY",
            "sale_start_date", "sale_end_date", "ICON_SALE", "NEW_ICON", "INIT",
            "sale_name", "ON_MAIN", "course_sale", "landing_link", "sale_link",
            "ICON_SALE_LINK", "TESTDEV", "no_basket", "FORMAT", "COURSE_PRICE_UR",
            "SCHEDULE_COURSE"
        ),
        "SET_BROWSER_TITLE" => "Y",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "Y",
        "SHOW_404" => "N",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N"
    ),
    false
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>