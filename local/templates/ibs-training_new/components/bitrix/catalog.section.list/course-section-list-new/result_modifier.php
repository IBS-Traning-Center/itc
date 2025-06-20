<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/**
 * @var $arResult;
 * @var $arParams;
 */

if(true) {
$complexity = [];
$sections = [];
foreach ($arResult['SECTIONS'] as & $section) {
    $section["DETAIL_PAGE_URL"]=preg_replace("/\#CODE\#/", $section["CODE"], $section["SECTION_PAGE_URL"]);
    $sectionLevels[$section['DEPTH_LEVEL']][(string) $section['ID']] = $section['IBLOCK_SECTION_ID'];
    $sections[$section['ID']] = & $section;
}
unset($section);

if(count($sections) && !empty($arResult['SECTION']['ID'])) {
    $sections[$arResult['SECTION']['ID']] = & $arResult['SECTION'];
}

$elements = [];
$elementsCourse = [];

$rsElements = CIBlockElement::GetList(
    ['SORT' => 'ASC'],
    [
        'ACTIVE' => 'Y',
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        "SECTION_ID" => count($sections) ? array_keys($sections) : (string)$arResult['SECTION']['ID']
    ],
    false,
    false,
    [
        "ID",
        "SORT",
        "NAME",
        "IBLOCK_ID",
        "IBLOCK_TYPE",
        "IBLOCK_SECTION_ID",
        "PROPERTY_PP_COURSE",
        "PROPERTY_PP_COURSE.NAME",
        "PROPERTY_PP_COURSE.ACTIVE",
        "PROPERTY_PP_COURSE",
        "PROPERTY_PP_COURSE.CODE",
        "PROPERTY_PP_COURSE.XML_ID"
    ]
);
while ($arElement = $rsElements->GetNext()) {
    $elements[$arElement['ID']] = $arElement;
    $elementsCourse[$arElement['PROPERTY_PP_COURSE_VALUE']][] = $arElement['ID'];
    unset($arElement);
}
unset($rsElements);

$rsElementsCourse = CIBlockElement::GetList(['SORT' => 'ASC'],['IBLOCK_ID' => 6, "ID" => array_keys($elementsCourse)],false,false,[
    'ID',
    'CODE',
    'NAME',
    'ACTIVE',
    'PROPERTY_COURSE_DURATION',
    'PROPERTY_COURSE_PRICE',
    'PROPERTY_SHORT_DESCR',
    'PROPERTY_change_link',
    'PROPERTY_COURSE_PRICE_UA',
    'PROPERTY_NEW_ICON',
    'PROPERTY_COMPLEXITY',
]);
while ($arElementCourse = $rsElementsCourse->GetNext()) {
    $courseIDs = $elementsCourse[(string)$arElementCourse['ID']];
    foreach ($courseIDs as $courseID) {
        if ($arElementCourse['ACTIVE'] === 'Y') {
            if($arElementCourse['PROPERTY_COMPLEXITY_VALUE']) {
                if(is_array($arElementCourse['PROPERTY_COMPLEXITY_VALUE'])) {
                    foreach ($arElementCourse['PROPERTY_COMPLEXITY_VALUE'] as $complexity) {
                        $arResult['complexity'][] = $complexity;
                        unset($complexity);
                    }
                } else {
                    $arResult['complexity'][] = $arElementCourse['PROPERTY_COMPLEXITY_VALUE'];
                }
            }
            $elements[$courseID] = array_merge($arElementCourse, $elements[$courseID]);
        } else {
            unset($elements[$courseID]);
        }
    }
    unset($arElementCourse);
}
unset($rsElementsCourse, $elementsCourse);

$elementsSort = [];
foreach ($elements as $element) $elementsSort[$element['ID']] = $element['CODE'];
array_multisort($elementsSort, $elements);

foreach ($elements as $element) {
    if (count($sections)) {
        if (isset($sections[$element['IBLOCK_SECTION_ID']])) {
            $sections[$element['IBLOCK_SECTION_ID']]['ELEMENTS'][$element['ID']] = $element;
        }
    } elseif ($arResult['SECTION']['ID'] === $element['IBLOCK_SECTION_ID']) {
        $arResult['ELEMENTS'][$element['ID']] = $element;
    }
    unset($element);
}
unset($elements);

if (is_array($sectionLevels)) {
    krsort($sectionLevels);
}

foreach ($sectionLevels as $sectionLevel) {
    foreach ($sectionLevel as $sectionID => $parentSectionID) {
        if($sections[$parentSectionID]) {
            $sections[$parentSectionID]['SECTIONS'][$sectionID] = $sections[$sectionID];
            unset($sections[$sectionID]);
        }
        unset($sectionID,$parentSectionID);
    }
}
unset($sectionLevels);

foreach ($sections as & $section) {
    $section['QUANTITY_ELEMENTS'] = 0;
    if($section['ELEMENTS']) $section['QUANTITY_ELEMENTS'] += count($section['ELEMENTS']);
    if($section['SECTIONS']) {
        foreach ($section['SECTIONS'] as & $section2) {
            $section2['QUANTITY_ELEMENTS'] = 0;
            if($section2['ELEMENTS']) {
                $section2['QUANTITY_ELEMENTS'] += count($section2['ELEMENTS']);
                $section['QUANTITY_ELEMENTS'] += count($section2['ELEMENTS']);
            }
            if($section2['SECTIONS']) {
                foreach ($section2['SECTIONS'] as & $section3) {
                    $section3['QUANTITY_ELEMENTS'] = 0;
                    if($section3['ELEMENTS']) {
                        $section3['QUANTITY_ELEMENTS'] += count($section3['ELEMENTS']);
                        $section2['QUANTITY_ELEMENTS'] += count($section3['ELEMENTS']);
                        $section['QUANTITY_ELEMENTS'] += count($section3['ELEMENTS']);
                    }
                    if($section3['SECTIONS']) {
                        foreach ($section3['SECTIONS'] as & $section4) {
                            $section4['QUANTITY_ELEMENTS'] = 0;
                            if($section4['ELEMENTS']) {
                                $section4['QUANTITY_ELEMENTS'] += count($section4['ELEMENTS']);
                                $section3['QUANTITY_ELEMENTS'] += count($section4['ELEMENTS']);
                                $section2['QUANTITY_ELEMENTS'] += count($section4['ELEMENTS']);
                                $section['QUANTITY_ELEMENTS'] += count($section4['ELEMENTS']);
                            }
                        }
                    }
                }
            }
        }
    }
}

$arResult['SECTIONS'] = $sections;
unset($sections);

} else {

    $curLevel = 1;
    $arParams['ID_IBLOCK'] = 94;
    $rootSectionId = -1;

    $SectList = CIBlockSection::GetList(
        $arSort,
        array(
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "CODE" => $_REQUEST["SECTION_CODE"],
            "ACTIVE" => "Y"
        ),
        false,
        array(
            "ID",
            "IBLOCK_ID",
            "IBLOCK_TYPE_ID",
            "IBLOCK_SECTION_ID",
            "CODE",
            "SECTION_ID",
            "NAME",
            "SECTION_PAGE_URL"
        )
    );
    while ($SectListGet = $SectList->GetNext()) {
        $rootSectionId = $SectListGet['ID'];
    }

    $arFilter = array(
        "IBLOCK_ID" => intval($arParams['ID_IBLOCK']),
        "ACTIVE" => "Y",
        "SECTION_ID" => $rootSectionId,
        "GLOBAL_ACTIVE" => "Y"
    );
    $rs_section = CIBlockSection::GetList(
        array("DEPTH_LEVEL" => "ASC"),
        $arFilter,
        true,
        array("UF_*", "DETAIL_PAGE_URL")
    );
    while ($ar_section = $rs_section->Fetch()) {
        //   if(in_array($ar_section['ID'], $debugArray) ) { // убрать это ограничение!
        $ar_section["DETAIL_PAGE_URL"] = preg_replace(
            "/\#CODE\#/",
            $ar_section["CODE"],
            $ar_section["SECTION_PAGE_URL"]
        );
        $arResult["SECTIONS"][$ar_section["ID"]] = $ar_section;
        if ($ar_section["DEPTH_LEVEL"] > 0) {
            $arFilterCountElements = array(
                "IBLOCK_ID" => $arParams["ID_IBLOCK"],
                "ACTIVE" => "Y",
                "SECTION_ID" => $ar_section["ID"],
                "INCLUDE_SUBSECTIONS" => "Y",
                "SECTION_GLOBAL_ACTIVE" => "Y",
                "SECTION_ACTIVE" => "Y",
                "PROPERTY_PP_COURSE.ACTIVE" => "Y"
            );
            $res = CIBlockElement::GetList(
                array("SORT" => "ASC"),
                $arFilterCountElements,
                array(),
                false,
                array('ID', 'NAME')
            );
            $arResult["SECTIONS"][$ar_section["ID"]]["ELEMENT_CNT"] = $res;
        }
    }

    $arFilter = array(
        "IBLOCK_ID" => intval($arParams['ID_IBLOCK']),
        "ACTIVE" => "Y",
        "SECTION_GLOBAL_ACTIVE" => "Y",
        "SECTION_ACTIVE" => "Y",
        "PROPERTY_PP_COURSE.ACTIVE" => "Y"
    ); /*"ACTIVE" =>"Y"*/
    $arSelect = array(
        "IBLOCK_ID",
        "IBLOCK_TYPE",
        "ID",
        "NAME",
        "PROPERTY_PP_COURSE",
        "PROPERTY_PP_COURSE.NAME",
        "PROPERTY_PP_COURSE.ACTIVE",
        "PROPERTY_PP_COURSE",
        "PROPERTY_PP_COURSE.CODE",
        "PROPERTY_PP_COURSE.XML_ID",
        "SORT",
        "IBLOCK_SECTION_ID"
    );
    $rs_element = CIBlockElement::GetList(
        array("SORT" => "ASC", "PROPERTY_PP_COURSE.CODE" => "ASC"),
        $arFilter,
        false,
        false,
        $arSelect
    );
    while ($ar_element = $rs_element->GetNext(false, false)) {
        $arSelectCourse = array(
            "ID",
            "PROPERTY_COURSE_DURATION",
            "PROPERTY_COURSE_PRICE",
            "PROPERTY_SHORT_DESCR",
            "PROPERTY_change_link",
            "PROPERTY_COURSE_PRICE_UA",
            "PROPERTY_NEW_ICON"
        );
        $arFilterCourse = array("IBLOCK_ID" => 6, "ID" => $ar_element["PROPERTY_PP_COURSE_VALUE"]);
        $rs_elementCourse = CIBlockElement::GetList(
            array("SORT" => "ASC"),
            $arFilterCourse,
            false,
            false,
            $arSelectCourse
        );
        while ($ar_elementCourse = $rs_elementCourse->GetNext(false, false)) {
            $ar_element['PARAM'] = $ar_elementCourse;
        }
        $arResult["ELEMENTS"][$ar_element['ID']] = $ar_element;
    }
}
$arResult['complexity'] = array_unique($arResult['complexity']);
