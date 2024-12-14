<?php

use Bitrix\Main\Application;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */

global $APPLICATION;

?>

<?php $APPLICATION->IncludeComponent(
   'addamant:courses.sections.list',
   '.default',
   Array(
       'ADDITIONAL_COUNT_ELEMENTS_FILTER' => 'additionalCountFilter',
       'ADD_SECTIONS_CHAIN' => 'Y',
       'CACHE_FILTER' => 'N',
       'CACHE_GROUPS' => 'Y',
       'CACHE_TIME' => '36000000',
       'CACHE_TYPE' => 'N',
       'COUNT_ELEMENTS' => 'Y',
       'COUNT_ELEMENTS_FILTER' => 'CNT_ACTIVE',
       'FILTER_NAME' => 'sectionsFilter',
       'HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS' => 'N',
       'IBLOCK_ID' => $arParams['SECTION_IBLOCK_ID'],
       'IBLOCK_TYPE' => '',
       'SECTION_CODE' => '',
       'SECTION_FIELDS' => [],
       'SECTION_ID' => '',
       'SECTION_URL' => '',
       'SECTION_USER_FIELDS' => [],
       'SHOW_PARENT_NAME' => 'Y',
       'TOP_DEPTH' => '2',
       'VIEW_MODE' => 'LINE'
   )
); ?>