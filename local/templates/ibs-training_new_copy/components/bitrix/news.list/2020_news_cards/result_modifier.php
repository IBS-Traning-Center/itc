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
    if(!empty($arItem['PROPERTIES']['PREVIEW_PICTURES_CARD']['VALUE'])) {
        if(count($arItem['PROPERTIES']['PREVIEW_PICTURES_CARD']['VALUE']) == 3) {
            foreach ($arItem['PROPERTIES']['PREVIEW_PICTURES_CARD']['VALUE'] as $arCartPicture) {
                $arItem['PREVIEW_PICTURES_CARD'][] = CFile::GetPath($arCartPicture);
            }
        } elseif(is_array($arItem['PROPERTIES']['PREVIEW_PICTURES_CARD']['VALUE'])) {
            $arItem['PREVIEW_PICTURES_CARD'][] = CFile::ResizeImageGet($arItem['PROPERTIES']['PREVIEW_PICTURES_CARD']['VALUE'][0], array('width'=>368, 'height'=>816), BX_RESIZE_IMAGE_EXACT, false)['src'];
            $arItem['PREVIEW_PICTURES_CARD'][] = CFile::ResizeImageGet($arItem['PROPERTIES']['PREVIEW_PICTURES_CARD']['VALUE'][0], array('width'=>802, 'height'=>378), BX_RESIZE_IMAGE_EXACT, false)['src'];
            $arItem['PREVIEW_PICTURES_CARD'][] = CFile::ResizeImageGet($arItem['PROPERTIES']['PREVIEW_PICTURES_CARD']['VALUE'][0], array('width'=>368, 'height'=>378), BX_RESIZE_IMAGE_EXACT, false)['src'];
        } else {
            $arItem['PREVIEW_PICTURES_CARD'][] = CFile::ResizeImageGet($arItem['PROPERTIES']['PREVIEW_PICTURES_CARD']['VALUE'], array('width'=>368, 'height'=>816), BX_RESIZE_IMAGE_EXACT, false)['src'];
            $arItem['PREVIEW_PICTURES_CARD'][] = CFile::ResizeImageGet($arItem['PROPERTIES']['PREVIEW_PICTURES_CARD']['VALUE'], array('width'=>802, 'height'=>378), BX_RESIZE_IMAGE_EXACT, false)['src'];
            $arItem['PREVIEW_PICTURES_CARD'][] = CFile::ResizeImageGet($arItem['PROPERTIES']['PREVIEW_PICTURES_CARD']['VALUE'], array('width'=>368, 'height'=>378), BX_RESIZE_IMAGE_EXACT, false)['src'];
        }
    } else {
        $arItem['PREVIEW_PICTURES_CARD'][] = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]['ID'], array('width'=>368, 'height'=>816), BX_RESIZE_IMAGE_EXACT, false)['src'];
        $arItem['PREVIEW_PICTURES_CARD'][] = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]['ID'], array('width'=>802, 'height'=>378), BX_RESIZE_IMAGE_EXACT, false)['src'];
        $arItem['PREVIEW_PICTURES_CARD'][] = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]['ID'], array('width'=>368, 'height'=>378), BX_RESIZE_IMAGE_EXACT, false)['src'];
    }
}
