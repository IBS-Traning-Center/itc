<?
    include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	CModule::IncludeModule("iblock");
	$data  = date("d.m.Y H:", strtotime("-1 hour"))."00:00";
	$arSelect = Array("ID", "NAME", "DATE_CREATE", "CODE", "NAME", "ACTIVE", "PROPERTY_timetable_id", "PROPERTY_COMMENT", "PROPERTY_lastname", "PROPERTY_CAT_COURSE", "PROPERTY_firstname", "PROPERTY_middlename", "PROPERTY_email", "PROPERTY_city", "PROPERTY_telephone", "PROPERTY_company");
	$arFilter = Array("IBLOCK_ID"=> 64, ">DATE_CREATE"=> $data."00:00");
	$res = CIBlockElement::GetList(Array("DATE_CREATE"=>"DESC"), $arFilter, false, Array("nPageSize"=>100), $arSelect);
	while($ob = $res->GetNextElement())
	{
			$arFields = $ob->GetFields();
			//echo  '<pre>';
			//var_dump($arFields);
            //print_r($arFields);
            //echo  '</pre>';
			leedsRU($arFields["ID"]);
	}

?>