<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/**
 * @var $arResult;
 * @var $arParams;
 */

$sections = [];
foreach ($arResult['SECTIONS'] as & $section) {
    if($section['GLOBAL_ACTIVE'] === 'Y') {
        $section["DETAIL_PAGE_URL"]=preg_replace("/\#CODE\#/", $section["CODE"], $section["SECTION_PAGE_URL"]);
        $sectionLevels[$section['DEPTH_LEVEL']][(string)$section['ID']] = $section['IBLOCK_SECTION_ID'];
        $sections[$section['ID']] = &$section;
    }
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
        'SECTION_ID' => count($sections) ? array_keys($sections) : (string)$arResult['SECTION']['ID']
    ],
    false,
    false,
    [
        "ID",
        "SORT",
        "NAME",
        "ACTIVE",
        "IBLOCK_ID",
        "IBLOCK_TYPE",
        "SECTION_ID",
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

$rsElementsCourse = CIBlockElement::GetList(
    ['SORT' => 'ASC'],
    ['IBLOCK_ID' => 6, "ID" => array_keys($elementsCourse)],
    false,
    false,
    [
        'ID',
        'CODE',
        'NAME',
        'ACTIVE',
        'IBLOCK_ID',
        'IBLOCK_TYPE',
        'SECTION_ID',
        'IBLOCK_SECTION_ID',
        'PROPERTY_COURSE_DURATION',
        'PROPERTY_COURSE_PRICE',
        'PROPERTY_SHORT_DESCR',
        'PROPERTY_change_link',
        'PROPERTY_COURSE_PRICE_UA',
        'PROPERTY_NEW_ICON',
        'PROPERTY_COMPLEXITY'
    ]
);
while ($arElementCourse = $rsElementsCourse->GetNext()) {
    $courseIDs = $elementsCourse[(string)$arElementCourse['ID']];
    foreach ($courseIDs as $courseID) {
        if ($arElementCourse['ACTIVE'] === 'Y') {
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

krsort($sectionLevels);
foreach ($sectionLevels as $sectionLevel) {
    foreach ($sectionLevel as $sectionID => $parentSectionID) {
        if ($sections[$parentSectionID]) {
            $sections[$parentSectionID]['SECTIONS'][$sectionID] = $sections[$sectionID];
            unset($sections[$sectionID]);
        }
        unset($sectionID, $parentSectionID);
    }
}
unset($sectionLevels);

foreach ($sections as & $section) {
    $section['QUANTITY_ELEMENTS'] = 0;
    if ($section['ELEMENTS']) {
        $section['QUANTITY_ELEMENTS'] += count($section['ELEMENTS']);
    }
    if ($section['SECTIONS']) {
        foreach ($section['SECTIONS'] as & $section2) {
            $section2['QUANTITY_ELEMENTS'] = 0;
            if ($section2['ELEMENTS']) {
                $section2['QUANTITY_ELEMENTS'] += count($section2['ELEMENTS']);
                $section['QUANTITY_ELEMENTS'] += count($section2['ELEMENTS']);
            }
            if ($section2['SECTIONS']) {
                foreach ($section2['SECTIONS'] as & $section3) {
                    $section3['QUANTITY_ELEMENTS'] = 0;
                    if ($section3['ELEMENTS']) {
                        $section3['QUANTITY_ELEMENTS'] += count($section3['ELEMENTS']);
                        $section2['QUANTITY_ELEMENTS'] += count($section3['ELEMENTS']);
                        $section['QUANTITY_ELEMENTS'] += count($section3['ELEMENTS']);
                    }
                    if ($section3['SECTIONS']) {
                        foreach ($section3['SECTIONS'] as & $section4) {
                            $section4['QUANTITY_ELEMENTS'] = 0;
                            if ($section4['ELEMENTS']) {
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
