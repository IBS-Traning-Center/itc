<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
    return;
/*
$arSelect = Array("ID", "NAME", "CODE", "PROPERTY_ARTICLE_ID");
$arFilter = Array("IBLOCK_ID"=>IBLOCK_EN_ADVERTISING_MODULE,  "ACTIVE"=>"Y");

$res = CIBlockElement::GetList(Array("sort"=>"DESC"), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    if ($arFields["PROPERTY_ARTICLE_ID_VALUE"]){
        $arElementAdvertsID[] = $arFields["PROPERTY_ARTICLE_ID_VALUE"];
    }
}


 * <?$APPLICATION->IncludeComponent("artions:schedule.page", "", Array(
                        "CACHE_TYPE" => "A",	// Cache type
                        "CACHE_TIME" => "360000",	// Cache time (sec.)
                    ),
                    false
                );?>
 * iwrite($arElementAdvertsID);

$arSections = Array();
$arSectionsFilter = Array('IBLOCK_ID'=>IBLOCK_SITE_STRUCTURE, "ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y" );
$dbsec_list = CIBlockSection::GetList(Array("left_margin"=>"asc"), $arSectionsFilter, false, array("ID", "DEPTH_LEVEL", "NAME", "CODE"));
while($sec = $dbsec_list->Fetch())
{
    if (in_array($sec["ID"], $arElementAdvertsID)){
        $arSections[$sec["ID"]] = str_repeat(" . ", $sec["DEPTH_LEVEL"]).$sec["NAME"];
    } else {
        // $arSections[$sec["ID"]] = str_repeat(" . ", $sec["DEPTH_LEVEL"]).$sec["NAME"]." #NO AD#";
    }
}
*/
$arPrice = array();
if(CModule::IncludeModule("catalog"))
{
    $rsPrice=CCatalogGroup::GetList($v1="sort", $v2="asc");
    while($arr=$rsPrice->Fetch())
        $arPrice[$arr["NAME"]] = "[".$arr["NAME"]."] ".$arr["NAME_LANG"];
}
else
{
    $arPrice = $arProperty_N;
}

$arComponentParameters = array(
    "GROUPS" => array(
    ),
    "PARAMETERS" => array(
        "SHOW_ALL_LOCATIONS" => Array(
            "PARENT" => "BASE",
            "NAME" => "Show all current locations, otherwise you have to choose specific location elements",
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "N",
            "REFRESH" => "Y",
        ),
        "RECORDS_COUNT_TOTAL" => Array(
            "PARENT" => "BASE",
            "NAME" => "Max count of all events for location",
            "TYPE" => "STRING",
            "DEFAULT" => "10",
        ),
        "RECORDS_COUNT_LOCATION" => Array(
            "PARENT" => "BASE",
            "NAME" => "Max count of  events per location",
            "TYPE" => "STRING",
            "DEFAULT" => "10",
        ),
        "PRICE_CODE" => array(
            "PARENT" => "PRICES",
            "NAME" => "Price type",
            "TYPE" => "LIST",
            "MULTIPLE" => "Y",
            "VALUES" => $arPrice,
        ),
        "CACHE_TIME"  =>  Array("DEFAULT"=>360000),
    ),
);

if ($arCurrentValues['SHOW_ALL_LOCATIONS'] !== "Y"){
    $arSelect = Array("ID", "NAME", "CODE");
    $arFilter = Array("IBLOCK_ID"=>D_EN_LOCATIONS_IBLOCK,  "ACTIVE"=>"Y");
    //$arFilter["SECTION_ID"] = SECTION_ID_EN_AWARDS;

    $res = CIBlockElement::GetList(Array("sort"=>"ASC"), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $arElements[$arFields["ID"]] = $arFields["NAME"];
    }
    //iwrite($arElements);
    $arComponentParameters['PARAMETERS']['LOCATION_ID'] = array(
        "PARENT" => "BASE",
        "NAME" => "Choose Location Elements",
        "TYPE" => "LIST",
        "VALUES" => $arElements,
        "DEFAULT" => '',
        "ADDITIONAL_VALUES" => "N",
        "REFRESH" => "N",
        "MULTIPLE" => "Y",
        "SIZE" => 10,
    );
    //$arCurrentValues['BY_SORTING'] = "N";
}

//iwrite($arCurrentValues);
?>