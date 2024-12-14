<?php
$courses = [];
$schedule = [];
$teachers = [];
if ($arResult['PROPERTIES']['COURSES']['VALUE']) {
    if (is_array($arResult['PROPERTIES']['COURSES']['VALUE'])) {
        $propertyCourses = $arResult['PROPERTIES']['COURSES']['VALUE'];
    } else {
        $propertyCourses[] = $arResult['PROPERTIES']['COURSES']['VALUE'];
    }
    foreach ($propertyCourses as $arCourse) {
        $courses[] = (int)$arCourse;
        $schedule[] = (int)$arCourse;
    }
    unset($arCourse);
}

$rsCourse = CIBlockElement::GetList([], ['IBLOCK_ID' => 6, 'ID' => $courses, 'ACTIVE' => 'Y'], false, false, [
    'IBLOCK_ID',
    'ID',
    'CODE',
    'NAME',
    'XML_ID',
    'PROPERTY_COURSE_CODE',
    'ROPERTY_SHORT_DESCR',
    'PROPERTY_COURSE_PRICE',
    'PROPERTY_COURSE_PRICE_UA',
    'PROPERTY_COURSE_DURATION',
    'PROPERTY_COURSE_LIST_COACH',
    'PROPERTY_COMPLEXITY',
]);
$courses = [];
while ($arCourse = $rsCourse->GetNext()) {
    if (empty($arResult['SCHOOL_SCHEDULE'][$arCourse['ID']])) {
        $arResult['SCHOOL_SCHEDULE'][$arCourse['ID']] = [];
    }
    $school_schedule = &$arResult['SCHOOL_SCHEDULE'][$arCourse['ID']];
    $school_schedule['COURSE_ID'] = $arCourse['ID'];
    $school_schedule['CODE'] = $arCourse['CODE'];
    $school_schedule['NAME'] = $arCourse['NAME'];
    $school_schedule['XML_ID'] = $arCourse['XML_ID'];
    $school_schedule['PRICE'] = $arCourse['PROPERTY_COURSE_PRICE_VALUE'];
    $school_schedule['PRICE_UA'] = $arCourse['PROPERTY_COURSE_PRICE_UA_VALUE'];
    $school_schedule['DURATION'] = $arCourse['PROPERTY_COURSE_DURATION_VALUE'];
    $school_schedule['TEACHER'] = $arCourse['PROPERTY_COURSE_LIST_COACH_VALUE'];
    unset($school_schedule, $arCourse);
}
unset($rsCourse);


if ($arResult['PROPERTIES']['SCHEDULE']['VALUE']) {
    if (is_array($arResult['PROPERTIES']['SCHEDULE']['VALUE'])) {
        $schedule = array_merge($schedule, $arResult['PROPERTIES']['SCHEDULE']['VALUE']);
    } else {
        $schedule[] = $arResult['PROPERTIES']['SCHEDULE']['VALUE'];
    }
}

$rsSchedule = CIBlockElement::GetList(
    [
        'PROPERTY_startdate' => 'ASC',
        'PROPERTY_enddate' => 'ASC'
    ],
    [
        'IBLOCK_ID' => 9,
        'ACTIVE' => 'Y',
        'PROPERTY_SCHEDULE_COURSE' => $schedule,
        '>PROPERTY_STARTDATE' => date("Y-m-d"),
    ],
    false,
    false,
    [
        'IBLOCK_ID',
        'ID',
        'XML_ID',
        'NAME',
        'CODE',
        'PROPERTY_SCHEDULE_COURSE',
        'PROPERTY_STARTDATE',
        'PROPERTY_ENDDATE',
        'PROPERTY_SCHEDULE_PRICE',
        'PROPERTY_SCHEDULE_ONL_PRICE',
        'PROPERTY_SCHEDULE_DURATION',
        'PROPERTY_TEACHER',
    ]
);
$schedule = [];
$dates = [];
while ($arSchedule = $rsSchedule->GetNext()) {
    if (
        in_array($arSchedule['PROPERTY_SCHEDULE_COURSE_VALUE'], $schedule)
        && !in_array($arSchedule['ID'], $arResult['PROPERTIES']['SCHEDULE']['VALUE'])
    ) continue;

    $school_schedule = &$arResult['SCHOOL_SCHEDULE'][$arSchedule['PROPERTY_SCHEDULE_COURSE_VALUE']];
    $school_schedule['SCHEDULE_ID'] = $arSchedule['ID'];
    $school_schedule['START_DATE'] = $arSchedule['PROPERTY_STARTDATE_VALUE'];
    $school_schedule['END_DATE'] = $arSchedule['PROPERTY_ENDDATE_VALUE'];
    if (!empty($arSchedule['PROPERTY_SCHEDULE_DURATION_VALUE'])) {
        $school_schedule['DURATION'] = $arSchedule['PROPERTY_SCHEDULE_DURATION_VALUE'];
    }
    if (!empty($arSchedule['PROPERTY_SCHEDULE_PRICE_VALUE'])) {
        $school_schedule['PRICE'] = $arSchedule['PROPERTY_SCHEDULE_PRICE_VALUE'];
    }
    if (!empty($arSchedule['PROPERTY_SCHEDULE_ONL_PRICE_VALUE'])) {
        $school_schedule['PRICE_UA'] = $arSchedule['PROPERTY_SCHEDULE_ONL_PRICE_VALUE'];
    }

    if ($arSchedule['PROPERTY_TEACHER_VALUE']) {
        $school_schedule['TEACHER'] = $arSchedule['PROPERTY_TEACHER_VALUE'];
    }

    if (is_array($school_schedule['TEACHER'])) {
        $teachers = array_merge($teachers, $school_schedule['TEACHER']);
    } else {
        $teachers[] = $school_schedule['TEACHER'];
    }
    $schedule[] = $arSchedule['PROPERTY_SCHEDULE_COURSE_VALUE'];
    unset($school_schedule, $arSchedule);
}
unset($rsSchedule);


if (count($teachers)) {
    $rsTeachers = CIBlockElement::GetList(
        ['PROPERTY_STARTDATE' => 'ASC'],
        [
            'IBLOCK_ID' => 56,
            'ACTIVE' => 'Y',
            'ID' => $teachers
        ],
        false,
        false,
        [
            'IBLOCK_ID',
            'ID',
            'XML_ID',
            'NAME',
            'CODE',
            'PREVIEW_TEXT',
            'DETAIL_PICTURE',
            'DETAIL_TEXT',
            'PROPERTY_EXPERT_NAME',
            'PROPERTY_EXPERT_SHORT'
        ]
    );
    while ($arTeacher = $rsTeachers->GetNext()) {

        $arTeacher['NAME'] .= ' ' . $arTeacher['PROPERTY_EXPERT_NAME_VALUE'];
        $arTeacher['DETAIL_PICTURE'] = CFile::GetPath($arTeacher['DETAIL_PICTURE']);

        $arTeacher['DESCRIPTION'] = $arTeacher['PROPERTY_EXPERT_SHORT_VALUE'];
        if (strlen($arTeacher['DESCRIPTION']) && strlen($arTeacher['DETAIL_TEXT'])) {
            $arTeacher['DESCRIPTION'] .= '<br>';
        }
        $arTeacher['DESCRIPTION'] .= $arTeacher['DETAIL_TEXT'];

        $arResult['SCHOOL_TEACHERS'][] = $arTeacher;
        unset($arTeacher);

    }
}

foreach ($arResult['SCHOOL_SCHEDULE'] as $schoolSchedule) {
    if ($schoolSchedule['DURATION']) {
        $arResult['TOTAL_DURATION'] += $schoolSchedule['DURATION'];
    }
    if ($schoolSchedule['PRICE']) {
        $arResult['TOTAL_PRICE'] += $schoolSchedule['PRICE'];
    }
    if ($schoolSchedule['PRICE_UA']) {
        $arResult['TOTAL_PRICE_UA'] += $schoolSchedule['PRICE_UA'];
    }
}

if ($arResult['PROPERTIES']['PRICE']['VALUE']) {
    $arResult['PRICE'] = number_format($arResult['PROPERTIES']['PRICE']['VALUE'], 0, '', ' ');
}
if ($arResult['TOTAL_PRICE'] && $arResult['PROPERTIES']['SALE_PERCENT']['VALUE']) {
    $percent = $arResult['PROPERTIES']['SALE_PERCENT']['VALUE'];
    $arResult['SALE'] = [
        'PERCENT' => $percent,
        'PERCENT_SUM' => number_format(round($arResult['TOTAL_PRICE'] * $percent / 100), 0, '', ' '),
        'SUM' => number_format($arResult['TOTAL_PRICE'] - round($arResult['TOTAL_PRICE'] * $percent / 100), 0, '', ' '),
        'PERCENT_SUM_UA' => number_format(round($arResult['TOTAL_PRICE_UA'] * $percent / 100), 0, '', ' '),
        'SUM_UA' => number_format($arResult['TOTAL_PRICE_UA'] - round($arResult['TOTAL_PRICE_UA'] * $percent / 100), 0, '', ' '),
    ];
}

$arResult['TOTAL_PRICE'] = number_format($arResult['TOTAL_PRICE'], 0, '', ' ');
$arResult['TOTAL_PRICE_UA'] = number_format($arResult['TOTAL_PRICE_UA'], 0, '', ' ');

$SCHOOL_SCHEDULE = [];
foreach ($arResult['PROPERTIES']['COURSES']['VALUE'] as $keyCourseID => $courseID) {
    $SCHOOL_SCHEDULE[$keyCourseID] = $arResult['SCHOOL_SCHEDULE'][$courseID];
}
$arResult['SCHOOL_SCHEDULE'] = $SCHOOL_SCHEDULE;

foreach ($arResult['SCHOOL_SCHEDULE'] as $schoolSchedule) {
    $dates[] = [
        'start' => $schoolSchedule['START_DATE'],
        'end' => $schoolSchedule['END_DATE']
    ];
    unset($schoolSchedule);
}

$arResult['$dates'] = $dates;
$arResult['SCHOOL_START_DATE'] = $dates[0]['start'];
$arResult['SCHOOL_END_DATE'] = end($dates)['end'];
if ($arResult['PROPERTIES']['DATE_START']['VALUE']) {
    $arResult['SCHOOL_START_DATE'] = $arResult['PROPERTIES']['DATE_START']['VALUE'];
}
if ($arResult['PROPERTIES']['DATE_FINISH']['VALUE']) {
    $arResult['SCHOOL_END_DATE'] = $arResult['PROPERTIES']['DATE_FINISH']['VALUE'];
}

if ($arResult['SCHOOL_START_DATE'] && $arResult['SCHOOL_END_DATE']) {
    $arResult['SCHOOL_DATE'] = $arResult['SCHOOL_START_DATE'] . ' - ' . $arResult['SCHOOL_END_DATE'];
} else {
    $arResult['SCHOOL_DATE'] = 'Даты на согласовании';
}


unset($SCHOOL_SCHEDULE);

if (false) { // сортировка по дате
    foreach ($arResult['SCHOOL_SCHEDULE'] as $arSchedule) {
        $SCHOOL_SCHEDULE[] = $arSchedule;
        $SORT_START_DATE[] = $arSchedule['START_DATE'] ? strtotime($arSchedule['START_DATE']) : 9E+100;
        $SORT_END_DATE[] = $arSchedule['END_DATE'] ? strtotime($arSchedule['END_DATE']) : 9E+100;
    }
    array_multisort($SORT_START_DATE, SORT_ASC, $SORT_END_DATE, SORT_ASC, $SCHOOL_SCHEDULE);
    $arResult['SCHOOL_SCHEDULE'] = $SCHOOL_SCHEDULE;
    unset($SORT_DATE, $SCHOOL_SCHEDULE);
}

$cp = $this->__component; // объект компонента
if (is_object($cp)) {
    $cacheKeys = [];

    if (!empty($arResult['TOTAL_DURATION'])) {
        $cp->arResult['TOTAL_DURATION'] = $arResult['TOTAL_DURATION'];
        $cacheKeys[] = 'TOTAL_DURATION';
    }

    if (!empty($arResult['SCHOOL_SCHEDULE'])) {
        $cp->arResult['SCHOOL_SCHEDULE'] = $arResult['SCHOOL_SCHEDULE'];
        $cacheKeys[] = 'SCHOOL_SCHEDULE';
    }

    if (!empty($arResult['SALE'])) {
        $cp->arResult['SALE'] = $arResult['SALE'];
        $cacheKeys[] = 'SALE';
    }

    $cp->SetResultCacheKeys($cacheKeys);
}
