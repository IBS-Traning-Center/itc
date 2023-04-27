<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('sale');
Bitrix\Main\Loader::includeModule("catalog");

$basket = \Bitrix\Sale\OrderBase::getBasket(5247);

echo var_export($basket);