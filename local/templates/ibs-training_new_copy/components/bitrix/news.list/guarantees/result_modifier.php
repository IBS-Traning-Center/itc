<?


$arResult['SECTION_WHY_US'] = [];
$arFilter = array('IBLOCK_ID' => intval(201), 'IBLOCK_TYPE' => 'edu_const', 'ID' => intval($arParams['PARENT_SECTION']));
$arSelect = array('ID', 'NAME', 'PICTURE', 'UF_*');
$db_list = CIBlockSection::GetList(
    array("SORT" => "ASC"),
    $arFilter,
    false,
    $arSelect,
    false
);

while ($ar_result = $db_list->GetNext()) {
    $arResult['SECTION_WHY_US'] = $ar_result;
}
