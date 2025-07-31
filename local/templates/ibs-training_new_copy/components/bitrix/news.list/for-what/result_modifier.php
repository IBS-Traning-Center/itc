<?
// Получаем текущий раздел
$currentSectionId = $arParams['PARENT_SECTION'];

// Получаем подразделы текущего раздела
$subSectionsObj = CIBlockSection::GetList(
    ['SORT' => 'ASC'],
    [
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'SECTION_ID' => $currentSectionId,
        'ACTIVE' => 'Y',
        'GLOBAL_ACTIVE' => 'Y',
    ],
    false,
    ['ID', 'NAME', 'SECTION_PAGE_URL']
);

$arResult['SUBSECTIONS'] = [];
$arResult['SUBSECTION_TABS'] = [];
$subSectionKey = 0;

while ($subSection = $subSectionsObj->GetNext()) {
    $arResult['SUBSECTION_TABS'][$subSection['ID']]["CODE"] = $subSection["CODE"];
    $arResult['SUBSECTION_TABS'][$subSection['ID']]["NAME"] = $subSection["NAME"];
    $arResult['SUBSECTIONS'][] = $subSection;
    $subSectionKey++;
}

foreach ($arResult['SUBSECTIONS'] as $key => $section) {
    // Получаем элементы подраздела
    $elements = CIBlockElement::GetList(
        ['SORT' => 'ASC'],
        [
            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
            'SECTION_ID' => intval($section['ID']),
            'ACTIVE' => 'Y',
        ],
        false,
        false,
        ['ID', 'NAME']
    );
    while ($element = $elements->GetNext()) {
        $arResult['SUBSECTIONS'][$key]['SUBSECTION_LIST'][$element['ID']]['ID'] = $element['ID'];
        $arResult['SUBSECTIONS'][$key]['SUBSECTION_LIST'][$element['ID']]['NAME'] = $element['NAME'];
    }
}