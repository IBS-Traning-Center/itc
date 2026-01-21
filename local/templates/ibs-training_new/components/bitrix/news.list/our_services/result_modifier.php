<?php

foreach($arResult['ITEMS'] as $key => $arItem):
    if($arItem['PROPERTIES']['ON_MAIN']['VALUE'] == '' && $arParams['ON_MAIN'] == 'Y'):
        unset($arResult['ITEMS'][$key]);
    elseif($arItem['PROPERTIES']['ON_MAIN']['VALUE'] == 'Y' && $arParams['ON_MAIN'] == NULL):
        unset($arResult['ITEMS'][$key]);
    endif;
endforeach;

$arResult['ITEMS'] = array_values($arResult['ITEMS']);