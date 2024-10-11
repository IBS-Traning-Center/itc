<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$sections = [];
foreach ($arResult['ITEMS'] as $arItem) {
    $sections[] = $arItem['IBLOCK_SECTION_ID'];
    unset($arItem);
}
$sections= array_unique($sections);

$dbSections =CIBlockSection::GetList(array('SORT' => 'ASC'), array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ID' => $sections), false, array('ID', 'NAME', 'SECTION_PAGE_URL'), false);
$sections = array();
while($arSection = $dbSections->GetNext()) {
    $sections[$arSection['ID']] = $arSection;
}

$arResult['SECTIONS'] = $sections;