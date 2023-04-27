<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?><?

$ORDER_ID = IntVal($GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["ID"]);

if ((!isset($ORDER_ID) or $ORDER_ID ==0)){
    $ORDER_ID = $_REQUEST['ORDER_ID'];
}
if (!is_array($arOrder))
    $arOrder = CSaleOrder::GetByID($ORDER_ID);

$bShowPodpis = true;
if ($_REQUEST['SHOWPODPIS']=="N"){
    $bShowPodpis = false;
}

$db_props = CSaleOrderPropsValue::GetOrderProps($ORDER_ID);
while ($arProps = $db_props->Fetch())
{

    if ($arProps['CODE'] == 'COMPANY'){
        $arOrderProps['COMPANY'] = $arProps['VALUE'];
    }
    if ($arProps['CODE'] == 'COMPANY_ADR'){
        $arOrderProps['COMPANY_ADR'] = $arProps['VALUE'];
    }
    if ($arProps['CODE'] == 'COMPANY_DOCADDRESS'){
        $arOrderProps['COMPANY_DOCADDRESS'] = $arProps['VALUE'];
    }
    if ($arProps['CODE'] == 'INN'){
        $arOrderProps['INN'] = $arProps['VALUE'];
    }
    if ($arProps['CODE'] == 'KPP'){
        $arOrderProps['KPP'] = $arProps['VALUE'];
    }
    if ($arProps['CODE'] == 'FIO_RESPONS'){
        $arOrderProps['FIO_RESPONS'] = $arProps['VALUE'];
    }
    if ($arProps['CODE'] == 'CONTACT_PERSON'){
        $arOrderProps['CONTACT_PERSON'] = $arProps['VALUE'];
    }
    if ($arProps['CODE'] == 'FIO_RESPONS'){
        $arOrderProps['FIO_RESPONS'] = $arProps['VALUE'];
    }
    if ($arProps['CODE'] == 'POSITION_RESPONS'){
        $arOrderProps['POSITION_RESPONS'] = $arProps['VALUE'];
    }
    if ($arProps['CODE'] == 'EMAIL'){
        $arOrderProps['EMAIL'] = $arProps['VALUE'];
    }
    if ($arProps['CODE'] == 'offerta'){
        $arOrderProps['offerta'] = $arProps['VALUE'];
    }
}

LocalRedirect('/personal/order/print_offer.php/?doc=invoice_oferta_ua&ORDER_ID='.$GLOBALS["SALE_INPUT_PARAMS"]['ORDER']['ID']);

