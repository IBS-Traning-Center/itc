<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
foreach ($arResult['ITEMS'] as & $arItem) {
    if(!empty($arItem['PROPERTIES']['MOBILE_PICTURE']['VALUE'])) {
        $arItem['PREVIEW_PICTURE']['MOBILE_SRC'] = CFile::GetPath($arItem['PROPERTIES']['MOBILE_PICTURE']['VALUE']);
    } else {
        $arItem['PREVIEW_PICTURE']['MOBILE_SRC'] = $arItem['PREVIEW_PICTURE']['SRC'];
    }
}
