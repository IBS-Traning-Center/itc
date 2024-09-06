<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */


$APPLICATION->IncludeComponent(
    "addamant:course.section",
    ".default",
    array(
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "IBLOCK_ID" => $arParams['SECTION_IBLOCK_ID'][0],
        "SECTION_CODE" => $arResult['VARIABLES']['SECTION_CODE']
    )
);
