<?php
namespace Luxoft\Dev\Events;

class Email {
    public static function OnBeforeEventSend($arFields, $arTemplate)
    {
        switch ($arTemplate['EMAIL_FROM']) {
            case '#EMPLOYEE_GROUP#':
                $arTemplate['EMAIL_FROM'] = 'education@ibs.ru; vagerner@ibs.ru; esmolenskaia@ibs.ru; asamotoy@ibs.ru; kgavrilchenko@ibs.ru; vrikhsieva@ibs.ru; ebulatova@ibs.ru; eignatenko@ibs.ru;nkonstantinova@ibs.ru; vkiselev@ibs.ru; epryadko@ibs.ru;';
                break;
        }
        switch ($arTemplate['BCC']) {
            case '#EMPLOYEE_GROUP#':
                $arTemplate['BCC'] = 'education@ibs.ru; vagerner@ibs.ru; esmolenskaia@ibs.ru; asamotoy@ibs.ru; kgavrilchenko@ibs.ru; vrikhsieva@ibs.ru; ebulatova@ibs.ru; eignatenko@ibs.ru;nkonstantinova@ibs.ru; vkiselev@ibs.ru; epryadko@ibs.ru;';
                break;
        }
    }
    public static function OnOrderPaySendEmail($orderID, &$eventName, &$arFields)
    {
        $arOrder = CSaleOrder::GetByID($orderID);
        $db_props = CSaleOrderPropsValue::GetOrderProps($orderID);
        while ($arProps = $db_props->Fetch()) {
            if ($arProps['CODE'] == 'F_NAME') {
                $arOrderProps['F_NAME'] = $arProps['VALUE'];
            }
            if ($arProps['CODE'] == 'F_S_NAME') {
                $arOrderProps['F_S_NAME'] = $arProps['VALUE'];
            }
        }
        $arFields["ORDER_USER"] = $arFields["ORDER_USER"] . " " . $arOrderProps['F_NAME'] . " " . $arOrderProps['F_S_NAME'];
        $arFields["ORDER_PRICE"] = intval($arOrder["PRICE"]);
    }
}