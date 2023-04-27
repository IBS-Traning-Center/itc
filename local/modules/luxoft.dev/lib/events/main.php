<?php
namespace Luxoft\Dev\Events;

class Main
{
    public static function OnBeforeProlog() {
        require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/php_interface/ikso/props/prop_elist_ajax.php");
        // TODO Проверить зачем нужен prop_element_list_sorted.php
        //require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/php_interface/artions/props/prop_element_list_sorted.php");
    }
}