<?php
declare(strict_types=1);
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
    <br/>
    <br/>
    <?php
    $APPLICATION->IncludeComponent(
        "bitrix:advertising.banner",
        "",
        array(
            "TYPE" => "INT_EVENTS",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "0"
        )
    ); ?>
    <br/>
    <br/>
    <?php
    $APPLICATION->IncludeComponent(
        "bitrix:advertising.banner",
        "",
        array(
            "TYPE" => "INT_EVENTS_SEC",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "0"
        )
    ); ?>