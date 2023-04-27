<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!isset($arParams["CACHE_TIME"])) {
    $arParams["CACHE_TIME"] = 3600;
}

CPageOption::SetOptionString("main", "nav_page_in_session", "N");


if(!isset($arParams["RECORDS_COUNT"])) {
    $arParams["RECORDS_COUNT"] = 50;
}

$arNavParams = array();

if ($arParams["RECORDS_COUNT"] > 0) {
    $arNavParams = array(
        "nTopCount" => $arParams["RECORDS_COUNT"],
    );
}

$arNavigation = CDBResult::GetNavParams($arNavParams);

if($this->StartResultCache(false, array($arNavigation)))
{
    if(!CModule::IncludeModule("iblock")) {
        $this->AbortResultCache();
        ShowError("IBLOCK_MODULE_NOT_INSTALLED");
        return false;
    }

    //iwrite($arParams);
    //This function returns array with prices description and access rights
    //in case catalog module n/a prices get values from element properties
    $arResultPrices = CIBlockPriceTools::GetCatalogPrices(D_EN_SCHEDULE_IBLOCK, $arParams["PRICE_CODE"]);


    if ($arParams["USE_RANDOM"] === "Y"){
        $arSort =  Array("RAND" => "ASC");
    } else {
        $arSort = array("PROPERTY_CITY_ID.SORT" => "ASC", "PROPERTY_STARTDATE" => "ASC");
    }
    $arFilter = array("IBLOCK_ID" => D_EN_SCHEDULE_IBLOCK, "ACTIVE" => "Y", "ACTIVE_DATE"=> "Y", ">=PROPERTY_STARTDATE" => date("Y-m-d"));

    if (is_array($arParams["LOCATION_ID"]) && count($arParams["LOCATION_ID"])>0){
        $arFilter["=PROPERTY_CITY_ID"]  = $arParams["LOCATION_ID"];
    }
    if(count($arParams["IBLOCK_ELEMENTS_ID"])){
        $arFilter["ID"]  = $arParams["IBLOCK_ELEMENTS_ID"];
    }
    //iwrite($arFilter);
    $arSelect = array("ID",
                    "CODE",
                    "NAME",
                    "PROPERTY_COURSE_ID.NAME",
                    "PROPERTY_COURSE_ID.CODE",
                    "PROPERTY_COURSE_ID.ID",
                    "PROPERTY_COURSE_ID.DETAIL_PAGE_URL",
                    "PROPERTY_DURATION",
                    "PROPERTY_CITY_ID.ID",
                    "PROPERTY_CITY_ID.NAME",
                    "PROPERTY_CITY_ID.CODE",
                    "PROPERTY_CITY_ID.IBLOCK_SECTION_ID",
                    "PROPERTY_TIME",
                    "PROPERTY_TRAINER_ID",
					"PROPERTY_TRAINER_ID.ID",
                    "PROPERTY_TRAINER_ID.NAME",
					"PROPERTY_TRAINER_ID.CODE",
                    "PROPERTY_TRAINER_ID.PROPERTY_SHORT_NAME",
                    "PROPERTY_TRAINER_ID.PROPERTY_SHORT_DESC",
                    "PROPERTY_TRAINER_ID.DETAIL_PAGE_URL",
					"PROPERTY_LANG",
					"PROPERTY_LANG.NAME",
					"PROPERTY_LANG.PROPERTY_short_name",
                    "PROPERTY_TRAINER_SIMPLE",
                    "PROPERTY_STARTDATE",
                    "PROPERTY_ADDITIONAL_TIME",
                    "CATALOG_GROUP_1",
					"CATALOG_GROUP_2",
                    "PROPERTY_ENDDATE"
    );
	
    $rsElement = CIBlockElement::GetList($arSort, $arFilter, false, $arNavParams, $arSelect);
	
    $arArticleID =  array();
    $arResult['TOTAL_COUNT'] = 0;
    while($obElement = $rsElement->GetNextElement()) {
		
        $arElement = $obElement->GetFields();
		$arElement["CITY_NAME"] = $arElement["PROPERTY_CITY_ID_NAME"];
        $arElement = bitrixCleaningArray($arElement);
		
		$arNewFilter = array("IBLOCK_ID" => 133, "ACTIVE" => "Y", "CODE" => $arElement["COURSE_ID_CODE"]);
		$rsElement2 = CIBlockElement::GetList($arSort, $arNewFilter, false, $arNavParams, $arSelect);
		if ($obElement2 = $rsElement2->GetNextElement()) {
			$arPolish = $obElement2->GetFields();
			$arElement["PL_NAME"]=$arPolish["NAME"];

		}
        $arButtons = CIBlock::GetPanelButtons(
            $arElement["IBLOCK_ID"],
            $arElement["ID"],
            0,
            array("SECTION_BUTTONS"=>false, "SESSID"=>false)
        );
        $arElement["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
        $arElement["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
        $arElement['COURSE_ID_DETAIL_PAGE_URL'] = str_replace("//", "/", $arElement['COURSE_ID_DETAIL_PAGE_URL']);
        $arElement['TRAINER_ID_DETAIL_PAGE_URL'] = str_replace("//", "/", $arElement['TRAINER_ID_DETAIL_PAGE_URL']);


        if($APPLICATION->GetShowIncludeAreas())
            $this->AddIncludeAreaIcons(CIBlock::GetComponentMenu($APPLICATION->GetPublicShowMode(), $arButtons));

        $resCountry = CIBlockSection::GetByID($arElement["CITY_ID_IBLOCK_SECTION_ID"]);
        if($ar_res = $resCountry->GetNext()){
			
			$arCountry["COUNTRY_NAME"] = $ar_res['NAME'];
            $arCountryNames[] = $ar_res['NAME'];
            $arCountry["COUNTRY_CODE"] = $ar_res['CODE'];
            $arCity['CITY_NAME'] = $arElement['CITY_ID_NAME'];
            $arCity['CITY_CODE'] = $arElement['CITY_ID_CODE'];
            $arCountry['CITIES'][$arCity['CITY_CODE']] = $arCity;
            $arElement["COUNTRY"] = $arCountry;

        }
		
        /**
         * working with dates
         */
        $vDateTempStart = date_create($arElement["STARTDATE"]);
        $arElement["FULL_DATES"] =  date_format($vDateTempStart, 'M j, Y');
		
        if ($arElement["ENDDATE"]){
            $vDateTempEnd = date_create($arElement["ENDDATE"]);
            $arElement["FULL_DATES"] .= " - ".date_format($vDateTempEnd, 'M j, Y');
        }


		if (!is_array($arResult["LOCATIONS"][$arCountry['COUNTRY_NAME']])) {
			$arResult["LOCATIONS"][$arCountry['COUNTRY_NAME']] = $arCountry;
		}
		$arResult["LOCATIONS"][$arCountry['COUNTRY_NAME']]["CITIES"][$arCity['CITY_CODE']] = $arCity;
		
        unset($arCountry);
        $arResult["LOCATIONS_CODE"][$arElement['COUNTRY']['COUNTRY_NAME']] = $arElement['COUNTRY']['COUNTRY_CODE'];
        $arResult["CITIES"][] = $arElement['CITY_ID_CODE'];

        $arResult["ITEMS"][$arElement['CITY_ID_CODE']][] = $arElement;


        $arResult["COUNT"][$arElement['CITY_ID_NAME']] = $arResult["COUNT"][$arElement['CITY_ID_NAME']] + 1;
        $arResult["TOTAL_COUNT"] = $arResult["TOTAL_COUNT"] + 1;

    }
	//if ($USER->IsAdmin()) {
				
				$t=0;
				if ($_SESSION["country"]=="PL"){
					reset($arResult["LOCATIONS"]);
					$arFirst = current($arResult["LOCATIONS"]);
					if ($arFirst["COUNTRY_NAME"]!="Poland") {
						$arPoland=$arResult["LOCATIONS"]["Poland"];
						unset($arResult["LOCATIONS"]["Poland"]);
						$arResult["LOCATIONS"]=array_merge(array("Poland"=> $arPoland), $arResult["LOCATIONS"]);
					}
					
				} else {
					reset($arResult["LOCATIONS"]);
					$arFirst = current($arResult["LOCATIONS"]);
					if ($arFirst["COUNTRY_NAME"]!="Romania") {
						$arRomania=$arResult["LOCATIONS"]["Romania"];
						unset($arResult["LOCATIONS"]["Romania"]);
						$arResult["LOCATIONS"]=array_merge(array("Romania"=> $arRomania), $arResult["LOCATIONS"]);
					}
					
				
				}
			//}
    $arResult["CITIES"] = array_unique($arResult["CITIES"]);
    $arResult["LOCATIONS_CODE"] = array_unique($arResult["LOCATIONS_CODE"]);


    $arResult["NAV_STRING"] = $rsElement->GetPageNavStringEx($navComponentObject, "№", "", "");

    $this->SetResultCacheKeys(array(
        "NAV_STRING",
        "ITEMS",
        "LOCATIONS",
        "LOCATIONS_CODE",
        "COUNT",
        "CITIES",
    ));

    $this->IncludeComponentTemplate();

}

?>
