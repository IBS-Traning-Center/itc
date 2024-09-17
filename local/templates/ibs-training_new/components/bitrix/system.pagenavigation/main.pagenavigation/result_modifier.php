<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @param array $arResult
 * @param int $pageNum
 *
 * @return string
 */
function replaceUrlTemplate(array $arResult, int $pageNum = 1): string
{
    $urlPath = $arResult['sUrlPath'];
    $navQueryString = ($arResult['NavQueryString'] != '') ? $arResult['NavQueryString'] . '&amp;' : '';
    $navQueryStringFull = ($arResult['NavQueryString'] != '') ? '?' . $arResult['NavQueryString'] : '';
    $navNum = $arResult['NavNum'];

    if ($pageNum > 0) {
        return $urlPath . '?' . $navQueryString . 'PAGEN_' . $navNum . '=' . $pageNum;
    }

    return $urlPath . $navQueryStringFull;
}
