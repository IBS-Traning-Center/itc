<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Iblock\ElementTable;
use Bitrix\Iblock\IblockTable;
use Bitrix\Catalog\ProductTable;

/**
 * Получает все свойства товара по ID
 */

Loader::includeModule('sale');

function getProductProperties($productId, $iblockId = null)
{
    if (!$productId) {
        return [];
    }

    if (!$iblockId) {
        $res = CIBlockElement::GetByID($productId);
        if ($element = $res->Fetch()) {
            $iblockId = $element['IBLOCK_ID'];
        }
    }

    if (!$iblockId) {
        return [];
    }

    $properties = [];

    $dbProps = CIBlockElement::GetProperty(
        $iblockId,
        $productId,
        array("sort" => "asc"),
        array()
    );

    while ($prop = $dbProps->Fetch()) {
        if (!empty($prop['VALUE']) && $prop['CODE'] != '') {
            $value = '';

            switch ($prop['PROPERTY_TYPE']) {
                case 'L':
                    $value = $prop['VALUE_ENUM'] ?: $prop['VALUE'];
                    break;

                case 'F':
                    if ($prop['VALUE'] > 0) {
                        $file = CFile::GetFileArray($prop['VALUE']);
                        if ($file) {
                            $value = $file['SRC'];
                        }
                    }
                    break;

                case 'E':
                    $elements = [];
                    if (is_array($prop['VALUE'])) {
                        foreach ($prop['VALUE'] as $elementId) {
                            $elRes = CIBlockElement::GetByID($elementId);
                            if ($el = $elRes->Fetch()) {
                                $elements[] = $el['NAME'];
                            }
                        }
                        $value = implode(', ', $elements);
                    } else {
                        $elRes = CIBlockElement::GetByID($prop['VALUE']);
                        if ($el = $elRes->Fetch()) {
                            $value = $el['NAME'];
                        }
                    }
                    break;

                case 'G':
                    $sections = [];
                    if (is_array($prop['VALUE'])) {
                        foreach ($prop['VALUE'] as $sectionId) {
                            $sectRes = CIBlockSection::GetByID($sectionId);
                            if ($sect = $sectRes->Fetch()) {
                                $sections[] = $sect['NAME'];
                            }
                        }
                        $value = implode(', ', $sections);
                    } else {
                        $sectRes = CIBlockSection::GetByID($prop['VALUE']);
                        if ($sect = $sectRes->Fetch()) {
                            $value = $sect['NAME'];
                        }
                    }
                    break;

                case 'S':
                case 'N':
                case 'USER':
                default:
                    $value = $prop['VALUE'];
                    break;
            }

            if (!empty($value)) {
                $properties[$prop['CODE']] = [
                    'NAME' => $prop['NAME'],
                    'VALUE' => $value,
                    'VALUE_RAW' => $prop['VALUE'],
                    'PROPERTY_TYPE' => $prop['PROPERTY_TYPE'],
                    'USER_TYPE' => $prop['USER_TYPE'],
                    'SORT' => $prop['SORT']
                ];
            }
        }
    }

    return $properties;
}

function getProductDetails($productId)
{
    $details = [
        'DETAIL_PICTURE' => null,
        'PREVIEW_PICTURE' => null,
        'DETAIL_PAGE_URL' => null,
        'PREVIEW_TEXT' => null,
        'DETAIL_TEXT' => null,
        'DATE_ACTIVE_FROM' => null,
        'DATE_ACTIVE_TO' => null
    ];

    if (!$productId) {
        return $details;
    }

    $res = CIBlockElement::GetList(
        array(),
        array('ID' => $productId),
        false,
        false,
        array(
            'ID',
            'IBLOCK_ID',
            'NAME',
            'DETAIL_PICTURE',
            'PREVIEW_PICTURE',
            'DETAIL_PAGE_URL',
            'PREVIEW_TEXT',
            'DETAIL_TEXT',
            'DATE_ACTIVE_FROM',
            'DATE_ACTIVE_TO'
        )
    );

    if ($element = $res->Fetch()) {
        // Получаем картинки
        if ($element['DETAIL_PICTURE']) {
            $file = CFile::GetFileArray($element['DETAIL_PICTURE']);
            if ($file) {
                $details['DETAIL_PICTURE'] = $file['SRC'];
            }
        }

        if ($element['PREVIEW_PICTURE']) {
            $file = CFile::GetFileArray($element['PREVIEW_PICTURE']);
            if ($file) {
                $details['PREVIEW_PICTURE'] = $file['SRC'];
            }
        }

        if ($element['DETAIL_PAGE_URL']) {
            $details['DETAIL_PAGE_URL'] = $element['DETAIL_PAGE_URL'];
        } else {
            $resIblock = CIBlock::GetByID($element['IBLOCK_ID']);
            if ($iblock = $resIblock->Fetch()) {
                $details['DETAIL_PAGE_URL'] = str_replace(
                    array('#SECTION_ID#', '#ELEMENT_ID#'),
                    array('', $element['ID']),
                    $iblock['DETAIL_PAGE_URL']
                );
            }
        }

        $details['PREVIEW_TEXT'] = $element['PREVIEW_TEXT'];
        $details['DETAIL_TEXT'] = $element['DETAIL_TEXT'];
        $details['DATE_ACTIVE_FROM'] = $element['DATE_ACTIVE_FROM'];
        $details['DATE_ACTIVE_TO'] = $element['DATE_ACTIVE_TO'];
        $details['IBLOCK_ID'] = $element['IBLOCK_ID'];
    }

    return $details;
}

function getCatalogProperties($productId)
{
    $catalogProps = [];

    if (!Loader::includeModule('catalog')) {
        return $catalogProps;
    }

    $product = CCatalogProduct::GetByID($productId);
    if ($product) {
        $catalogProps = $product;
    }

    return $catalogProps;
}

function getProductOffers($productId)
{
    $offers = [];

    if (!Loader::includeModule('catalog') || !Loader::includeModule('iblock')) {
        return $offers;
    }

    $offers = CCatalogSKU::getOffersList($productId);

    return $offers ?: [];
}

if (!empty($arResult['ORDERS']) && is_array($arResult['ORDERS'])) {
    foreach ($arResult['ORDERS'] as &$order) {
        if (!empty($order['BASKET_ITEMS']) && is_array($order['BASKET_ITEMS'])) {
            foreach ($order['BASKET_ITEMS'] as &$item) {
                $productId = intval($item['PRODUCT_ID']);

                if ($productId > 0) {

                    $productDetails = getProductDetails($productId);
                    $item = array_merge($item, $productDetails);

                    $properties = getProductProperties($productId, $productDetails['IBLOCK_ID'] ?? null);
                    $item['PROPERTIES'] = $properties;

                    $catalogProps = getCatalogProperties($productId);
                    $item['CATALOG_PROPS'] = $catalogProps;

                    $offers = getProductOffers($productId);
                    $item['OFFERS'] = $offers;

                    if (empty($item['NOTES']) && isset($properties['LEVEL'])) {
                        $item['NOTES'] = $properties['LEVEL']['VALUE'];
                    }

                    if (empty($item['DETAIL_PICTURE']) && isset($properties['PICTURE'])) {
                        $item['DETAIL_PICTURE'] = $properties['PICTURE']['VALUE'];
                    }

                    if (empty($item['PREVIEW_PICTURE']) && isset($properties['PREVIEW_PICTURE'])) {
                        $item['PREVIEW_PICTURE'] = $properties['PREVIEW_PICTURE']['VALUE'];
                    }

                    if (isset($properties['DATE_START'])) {
                        $item['COURSE_DATE_START'] = $properties['DATE_START']['VALUE'];
                    }
                    if (isset($properties['DATE_END'])) {
                        $item['COURSE_DATE_END'] = $properties['DATE_END']['VALUE'];
                    }

                    if (isset($properties['TIME_START']) && isset($properties['TIME_END'])) {
                        $item['COURSE_TIME'] = $properties['TIME_START']['VALUE'] . '–' . $properties['TIME_END']['VALUE'];
                    }

                    if (isset($properties['TEACHERS'])) {
                        $item['TEACHERS'] = $properties['TEACHERS']['VALUE'];
                    }

                    if (isset($properties['DESCRIPTION'])) {
                        $item['COURSE_DESCRIPTION'] = $properties['DESCRIPTION']['VALUE'];
                    }
                }
            }
            unset($item);
        }
    }
    unset($order);
}


?>

