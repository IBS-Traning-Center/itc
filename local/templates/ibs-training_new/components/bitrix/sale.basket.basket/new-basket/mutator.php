<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;
use Bitrix\Sale\PriceMaths;

$this->arParams['BRAND_PROPERTY'] ??= '';

$mobileColumns = $this->arParams['COLUMNS_LIST_MOBILE'] ?? $this->arParams['COLUMNS_LIST'];
$mobileColumns = array_fill_keys($mobileColumns, true);

$result['BASKET_ITEM_RENDER_DATA'] = [];

foreach ($this->basketItems as $row) {
    $rowData = [
        'ID'                    => $row['ID'],
        'PRODUCT_ID'            => $row['PRODUCT_ID'],
        'NAME'                  => $row['~NAME'] ?? $row['NAME'],
        'QUANTITY'              => $row['QUANTITY'],
        'PROPS'                 => $row['PROPS'],
        'PROPS_ALL'             => $row['PROPS_ALL'],
        'HASH'                  => $row['HASH'],
        'SORT'                  => $row['SORT'],
        'DETAIL_PAGE_URL'       => $row['DETAIL_PAGE_URL'],
        'CURRENCY'              => $row['CURRENCY'],
        'DISCOUNT_PRICE_PERCENT'        => $row['DISCOUNT_PRICE_PERCENT'],
        'DISCOUNT_PRICE_PERCENT_FORMATED' => $row['DISCOUNT_PRICE_PERCENT_FORMATED'],
        'SHOW_DISCOUNT_PRICE'   => (float)$row['DISCOUNT_PRICE'] > 0,
        'PRICE'                 => $row['PRICE'],
        'PRICE_FORMATED'        => $row['PRICE_FORMATED'],
        'FULL_PRICE'            => $row['FULL_PRICE'],
        'FULL_PRICE_FORMATED'   => $row['FULL_PRICE_FORMATED'],
        'DISCOUNT_PRICE'        => $row['DISCOUNT_PRICE'],
        'DISCOUNT_PRICE_FORMATED' => $row['DISCOUNT_PRICE_FORMATED'],
        'SUM_PRICE'             => $row['SUM_VALUE'],
        'SUM_PRICE_FORMATED'    => $row['SUM'],
        'SUM_FULL_PRICE'        => $row['SUM_FULL_PRICE'],
        'SUM_FULL_PRICE_FORMATED' => $row['SUM_FULL_PRICE_FORMATED'],
        'SUM_DISCOUNT_PRICE'    => $row['SUM_DISCOUNT_PRICE'],
        'SUM_DISCOUNT_PRICE_FORMATED' => $row['SUM_DISCOUNT_PRICE_FORMATED'],
        'MEASURE_RATIO'         => $row['MEASURE_RATIO'] ?? 1,
        'MEASURE_TEXT'          => $row['MEASURE_TEXT'],
        'AVAILABLE_QUANTITY'    => $row['AVAILABLE_QUANTITY'] ?? '0',
        'CHECK_MAX_QUANTITY'    => $row['CHECK_MAX_QUANTITY'] ?? 'N',
        'MODULE'                => $row['MODULE'],
        'PRODUCT_PROVIDER_CLASS'=> $row['PRODUCT_PROVIDER_CLASS'],
        'NOT_AVAILABLE'         => isset($row['NOT_AVAILABLE']) && $row['NOT_AVAILABLE'] === true,
        'DELAYED'               => $row['DELAY'] === 'Y',
        'SKU_BLOCK_LIST'        => [],
        'COLUMN_LIST'           => [],
        'SHOW_LABEL'            => false,
        'LABEL_VALUES'          => [],
        'BRAND'                 => $row[$this->arParams['BRAND_PROPERTY'] . '_VALUE'] ?? '',

        'DELIVERY_DATE'         => '',
        'DELIVERY_TIME'         => '',
        'DURATION'              => '',
        'LEVEL'                 => '',
        'CATEGORY_LEVEL'        => '',
        'CITY'                  => '',
        'TRAINER_NAME'          => '—',
        'TRAINER_AVATAR'        => '',
    ];

    $start = $end = '';
    foreach (['PROPERTY_startdate_VALUE', 'startdate', 'PROPERTY_STARTDATE_VALUE', 'DATE_ACTIVE_FROM'] as $key) {
        if (!empty($row[$key])) {
            $start = is_array($row[$key]) ? implode(', ', $row[$key]) : $row[$key];
            break;
        }
    }
    foreach (['PROPERTY_enddate_VALUE', 'enddate', 'PROPERTY_ENDDATE_VALUE'] as $key) {
        if (!empty($row[$key])) {
            $end = is_array($row[$key]) ? implode(', ', $row[$key]) : $row[$key];
            break;
        }
    }
    if ($start && $end) {
        $rowData['DELIVERY_DATE'] = $start . ' — ' . $end;
    } elseif ($start) {
        $rowData['DELIVERY_DATE'] = $start;
    } elseif ($end) {
        $rowData['DELIVERY_DATE'] = $end;
    }
    foreach (['PROPERTY_schedule_time_VALUE', 'schedule_time', 'PROPERTY_SCHEDULE_TIME_VALUE', 'PROPERTY_TIME_INTERVAL_VALUE', 'PROPERTY_TIME_VALUE', 'TIME'] as $key) {
        if (!empty($row[$key])) {
            $rowData['DELIVERY_TIME'] = is_array($row[$key]) ? implode(', ', $row[$key]) : $row[$key];
            break;
        }
    }

    $possibleProperties = [
        'DURATION' => ['PROPERTY_duration_VALUE', 'duration', 'PROPERTY_DURATION_VALUE', 'PROPERTY_course_duration_VALUE', 'course_duration'],
        'LEVEL' => ['PROPERTY_level_VALUE', 'level', 'PROPERTY_LEVEL_VALUE', 'PROPERTY_HABR_MIN_KVAL_VALUE', 'HABR_MIN_KVAL'],
        'CATEGORY_LEVEL' => ['PROPERTY_LEVEL_VALUE', 'PROPERTY_COMPLEXITY_VALUE', 'PROPERTY_category_level_VALUE', 'COMPLEXITY', 'LEVEL'],
        'TRAINER_AVATAR' => ['PROPERTY_TRAINER_AVATAR_VALUE', 'PROPERTY_trainer_photo_VALUE', 'PROPERTY_TRAINER_PHOTO_VALUE', 'TRAINER_AVATAR', 'trainer_photo'],
    ];

    foreach ($possibleProperties as $field => $keys) {
        foreach ($keys as $key) {
            if (!empty($row[$key])) {
                $rowData[$field] = is_array($row[$key]) ? implode(', ', $row[$key]) : $row[$key];
                break;
            }
        }
    }
    if (empty($rowData['CATEGORY_LEVEL']) && !empty($rowData['LEVEL'])) {
        $rowData['CATEGORY_LEVEL'] = $rowData['LEVEL'];
    }

    if (empty($rowData['DELIVERY_DATE']) || empty($rowData['DELIVERY_TIME']) || $rowData['TRAINER_NAME'] === '—' || empty($rowData['CITY'])) {
        if (CModule::IncludeModule('iblock')) {
            $courseScheduleIBlockId = false;
            $eduCitiesIBlockId = false;

            $res = CIBlock::GetList([], ['CODE' => ['course_shedule', 'edu_cities'], 'CHECK_PERMISSIONS' => 'N']);
            while ($arIBlock = $res->Fetch()) {
                if ($arIBlock['CODE'] == 'course_shedule') {
                    $courseScheduleIBlockId = $arIBlock['ID'];
                } elseif ($arIBlock['CODE'] == 'edu_cities') {
                    $eduCitiesIBlockId = $arIBlock['ID'];
                }
            }

            if ($courseScheduleIBlockId) {
                $arSelect = [
                    'ID', 'NAME', 'ACTIVE_FROM',
                    'PROPERTY_startdate', 'PROPERTY_enddate', 'PROPERTY_schedule_time',
                    'PROPERTY_duration', 'PROPERTY_level', 'PROPERTY_COMPLEXITY',
                    'PROPERTY_city', 'PROPERTY_CITY', 'PROPERTY_CITIES',
                    'PROPERTY_TRAINER_AVATAR', 'PROPERTY_TRAINER_PHOTO',
                ];
                $arFilter = [
                    'IBLOCK_ID' => $courseScheduleIBlockId,
                    'ACTIVE'    => 'Y',
                    'PROPERTY_schedule_course' => $row['PRODUCT_ID'],
                ];

                $rsElement = CIBlockElement::GetList(
                    ['ACTIVE_FROM' => 'DESC'],
                    $arFilter,
                    false,
                    ['nPageSize' => 1],
                    $arSelect
                );

                if ($arElement = $rsElement->Fetch()) {
                    $start = $arElement['PROPERTY_STARTDATE_VALUE'] ?? $arElement['ACTIVE_FROM'] ?? '';
                    $end   = $arElement['PROPERTY_ENDDATE_VALUE'] ?? '';
                    if ($start && $end) {
                        $rowData['DELIVERY_DATE'] = $start . ' — ' . $end;
                    } elseif ($start) $rowData['DELIVERY_DATE'] = $start;
                    elseif ($end) $rowData['DELIVERY_DATE'] = $end;

                    $rowData['DELIVERY_TIME'] = $arElement['PROPERTY_SCHEDULE_TIME_VALUE'] ?? '';

                    $cityValue = $arElement['PROPERTY_CITY_VALUE'] ?? $arElement['PROPERTY_city_VALUE'] ?? $arElement['PROPERTY_CITIES_VALUE'] ?? '';
                    if ($cityValue && $eduCitiesIBlockId) {
                        if (is_array($cityValue)) {
                            $cityIds = array_filter($cityValue, 'is_numeric');
                        } else {
                            $cityIds = is_numeric($cityValue) ? [$cityValue] : [];
                        }

                        if (!empty($cityIds)) {
                            $cityNames = [];

                            $rsCity = CIBlockElement::GetList(
                                [],
                                [
                                    'ID'        => $cityIds,
                                    'IBLOCK_ID' => $eduCitiesIBlockId,
                                    'ACTIVE'    => 'Y',
                                ],
                                false,
                                false,
                                ['ID', 'NAME']
                            );

                            while ($arCity = $rsCity->Fetch()) {
                                $name = trim($arCity['NAME']);
                                if ($name) $cityNames[] = $name;
                            }

                            if (!empty($cityNames)) {
                                $rowData['CITY'] = implode(', ', $cityNames);
                            }
                        } else {
                            $rowData['CITY'] = is_array($cityValue) ? implode(', ', $cityValue) : $cityValue;
                        }
                    }
                    $rowData['DURATION']       = $arElement['PROPERTY_DURATION_VALUE'] ?? $rowData['DURATION'];
                    $rowData['LEVEL']          = $arElement['PROPERTY_LEVEL_VALUE'] ?? $rowData['LEVEL'];
                    $rowData['CATEGORY_LEVEL'] = $arElement['PROPERTY_COMPLEXITY_VALUE'] ?? $rowData['CATEGORY_LEVEL'];

                    if (empty($rowData['CATEGORY_LEVEL']) && !empty($rowData['LEVEL'])) {
                        $rowData['CATEGORY_LEVEL'] = $rowData['LEVEL'];
                    }
                }
            }
        }
    }

    if ($rowData['MEASURE_RATIO'] != 1) {
        $price = PriceMaths::roundPrecision($rowData['PRICE'] * $rowData['MEASURE_RATIO']);
        if ($price != $rowData['PRICE']) {
            $rowData['PRICE'] = $price;
            $rowData['PRICE_FORMATED'] = CCurrencyLang::CurrencyFormat($price, $rowData['CURRENCY'], true);
        }

        $fullPrice = PriceMaths::roundPrecision($rowData['FULL_PRICE'] * $rowData['MEASURE_RATIO']);
        if ($fullPrice != $rowData['FULL_PRICE']) {
            $rowData['FULL_PRICE'] = $fullPrice;
            $rowData['FULL_PRICE_FORMATED'] = CCurrencyLang::CurrencyFormat($fullPrice, $rowData['CURRENCY'], true);
        }

        $discountPrice = PriceMaths::roundPrecision($rowData['DISCOUNT_PRICE'] * $rowData['MEASURE_RATIO']);
        if ($discountPrice != $rowData['DISCOUNT_PRICE']) {
            $rowData['DISCOUNT_PRICE'] = $discountPrice;
            $rowData['DISCOUNT_PRICE_FORMATED'] = CCurrencyLang::CurrencyFormat($discountPrice, $rowData['CURRENCY'], true);
        }
    }

    $rowData['SHOW_PRICE_FOR'] = (float)$rowData['QUANTITY'] !== (float)$rowData['MEASURE_RATIO'];

    if (!empty($row['PREVIEW_PICTURE_SRC'])) {
        $rowData['IMAGE_URL'] = $row['PREVIEW_PICTURE_SRC'];
    } elseif (!empty($row['DETAIL_PICTURE_SRC'])) {
        $rowData['IMAGE_URL'] = $row['DETAIL_PICTURE_SRC'];
    }

    $result['BASKET_ITEM_RENDER_DATA'][] = $rowData;
}
$totalData = [
    'DISABLE_CHECKOUT' => (int)$result['ORDERABLE_BASKET_ITEMS_COUNT'] === 0,
    'PRICE' => $result['allSum'],
    'PRICE_FORMATED' => $result['allSum_FORMATED'],
    'PRICE_WITHOUT_DISCOUNT_FORMATED' => $result['PRICE_WITHOUT_DISCOUNT'],
    'CURRENCY' => $result['CURRENCY']
];

if ($result['DISCOUNT_PRICE_ALL'] > 0) {
    $totalData['DISCOUNT_PRICE_FORMATED'] = $result['DISCOUNT_PRICE_FORMATED'];
}
if ($result['allWeight'] > 0) {
    $totalData['WEIGHT_FORMATED'] = $result['allWeight_FORMATED'];
}
if ($this->priceVatShowValue === 'Y') {
    $totalData['SHOW_VAT'] = true;
    $totalData['VAT_SUM_FORMATED'] = $result['allVATSum_FORMATED'];
    $totalData['SUM_WITHOUT_VAT_FORMATED'] = $result['allSum_wVAT_FORMATED'];
}
if ($this->hideCoupon !== 'Y' && !empty($result['COUPON_LIST'])) {
    $totalData['COUPON_LIST'] = $result['COUPON_LIST'];
    foreach ($totalData['COUPON_LIST'] as &$coupon) {
        if ($coupon['JS_STATUS'] === 'ENTERED') {
            $coupon['CLASS'] = 'danger';
        } elseif ($coupon['JS_STATUS'] === 'APPLYED') {
            $coupon['CLASS'] = 'muted';
        } else {
            $coupon['CLASS'] = 'danger';
        }
    }
}

$result['TOTAL_RENDER_DATA'] = $totalData;