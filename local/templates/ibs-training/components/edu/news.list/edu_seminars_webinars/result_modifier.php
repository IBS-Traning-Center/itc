<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if($arParams['PROPERTY_TYPECHECK']>0){
		$arSelect = array_merge($arParams["FIELD_CODE"], array(
			"ID",
			"IBLOCK_ID",
			"IBLOCK_SECTION_ID",
			"NAME",
			"ACTIVE_FROM",
			"DETAIL_PAGE_URL",
			"DETAIL_TEXT",
			"DETAIL_TEXT_TYPE",
			"PREVIEW_TEXT",
			"PREVIEW_TEXT_TYPE",
			"PREVIEW_PICTURE",
			"PROPERTY_*"
		));
		$arFilter = array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
		"<=PROPERTY_startdate"=> ConvertDateTime(date("d.m.Y"), "YYYY-MM-DD"),
		"PROPERTY_type_event" => $arParams['PROPERTY_TYPECHECK']
		);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($obElement = $res->GetNextElement()) {
		$arItem = $obElement->GetFields();
		$arItem["PROPERTIES"] = $obElement->GetProperties();
		$arResult["ITEMS"][] = $arItem;
	}	
}

foreach($arResult["ITEMS"] as &$arItem){
    if(!empty($arItem['PROPERTY_16']) && !empty($arItem['PROPERTY_18'])) {
        if(!empty($arItem['PROPERTY_17'])) {
            $start  = new DateTime($arItem['PROPERTY_16']);
            $end    = new DateTime($arItem['PROPERTY_17']);
            $interval = $end->diff($start);
            $countDay = intval($interval->format('%a'));
        } else {
            $countDay = 1;
        }
        $times = explode('-', $arItem['PROPERTY_18']);
        if(count($times) === 2) {
            $time = strtotime(trim($times[1])) - strtotime(trim($times[0]));
            $arItem['DURATION'] = $countDay * round(($time/3600), 0, PHP_ROUND_HALF_UP);
        }
    }
	if ($arItem['PROPERTIES']['trener']['VALUE']){
		$arSelect = Array("NAME", "PROPERTY_expert_name", "CODE", "ACTIVE");
		$arFilter = Array("IBLOCK_ID"=>D_EXPERT_ID_IBLOCK, "ID"=>$arItem['PROPERTIES']['trener']['VALUE']);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext()) {
			$arResult['TRENER_INFO'][$arItem['ID']] = $ar_fields;
		}	
	}
}



