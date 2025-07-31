<?

$iBlockID = $arParams['IBLOCK_ID']; // ваш ID инфоблока
$sectionID = $arParams['PARENT_SECTION']; // ваш ID раздела

$section = CIBlockSection::GetByID($sectionID)->Fetch();
if ($section && $section['IBLOCK_ID'] == $iBlockID) {
	$arResult["SECTION_NAME"] = $section['NAME']; // название раздела
} else {
	$arResult["SECTION_NAME"] = "Раздел не найден или не принадлежит указанному инфоблоку";
}