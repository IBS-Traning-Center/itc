<?
    include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    CModule::IncludeModule("iblock");
    $arSend = array(
        'USER_MAIL'=> "education@ibs.ru"
    );


    if (preg_match("#luxoft#", $arSend["USER_MAIL"]))
    {
        echo("WORK!");
    }

    $arFilterR = array("IBLOCK_ID"=>9, NAME=>"СОЗДАНИЕ БЕССЕРВЕРНОГО ВЕБ-ПРИЛОЖЕНИЯ С ТЕХНОЛОГИЯМИ AMAZON");
    $arSelectR = Array("ID","IBLOCK_ID","NAME", "NAME");
    $res2 = CIBlockElement::GetList(array(), $arFilterR, false, false, $arSelectR);
    while($ob = $res2->GetNextElement())
    {

        echo '<pre>';
            print_r($ob);
        echo '</pre>';
        break;
    }


    //$arFilterM = array("IBLOCK_ID"=>159, "ID"=>92145);

    /*$arSelect = Array(
        "ID",
        "IBLOCK_ID",
        "NAME",
        "PROPERTY_PRICE_1",
        "PROPERTY_PRICE_2",
        "PROPERTY_DATE_1",
        "PROPERTY_DATE_2",
        "PROPERTY_DATE_3",
        "PROPERTY_DATE_EVENT"
        );*/

    /*$arSelect = Array(
        "ID",
        "IBLOCK_ID",
        "NAME",
        "PROPERTY_*"
    );


    $res2 = CIBlockElement::GetList(array(), $arFilterM, false, false, $arSelect);
    while($ob = $res2->GetNextElement())
    {
        $arprops = $ob->GetProperties();

        /*echo '<pre>';
            print_r($arprops);
        echo '</pre>';*/


     /*   $price1 = (int)$arprops["PRICE_1"]["VALUE"];
        $price2 =  (int)$arprops["PRICE_2"]["VALUE"];


        $date1 = date('d.m.Y', strtotime($arprops["DATE_1"]["VALUE"]));
        $date2 = date('d.m.Y', strtotime($arprops["DATE_2"]["VALUE"]));

        $dateEvent = date('d.m.Y', strtotime($arprops["DATE_EVENT"]["VALUE"]));

        $curDate = date("d.m.Y");

        $timeStart = date_parse($arprops["TIME_START"]["VALUE"])['hour'];
        $timeEnd = date_parse($arprops["TIME_END"]["VALUE"])['hour'];

        $timeSpan = $timeEnd - $timeStart;


        if(strtotime($curDate) < strtotime($date2))
            echo $price1;
        else if(strtotime($curDate) > strtotime($date2) && strtotime($curDate) < strtotime($dateEvent))
            echo $price2;

    }




);*/

?>
