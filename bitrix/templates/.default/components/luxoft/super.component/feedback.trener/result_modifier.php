<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


if (!CModule::IncludeModule("iblock")) return;

if (!strlen($arParams['ELEMENT_ID'])>0) {
	$arSelect = Array("ID");
	$arFilter = Array("IBLOCK_ID"=>56, "CODE"=>$arParams['ELEMENT_CODE'], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement())
	{
	  $arFieldsExpert = $ob->GetFields();
		//iwrite($arFieldsExpert);
	}
	$arParams['ELEMENT_ID'] = $arFieldsExpert["ID"];
}


	$arSelect = Array("ID","PROPERTY_CLIENT","PROPERTY_CLIENT.NAME","PROPERTY_NAME", "PROPERTY_SURNAME", "PROPERTY_REVIEW", "PROPERTY_COURSE", "PROPERTY_COURSE.NAME", "PROPERTY_COURSE.CODE");
	$arFilter = Array("IBLOCK_ID"=>61, "PROPERTY_EXPERT_ID"=>$arParams['ELEMENT_ID'], "ACTIVE"=>"Y");
	$resF = CIBlockElement::GetList(Array("RAND" => "ASC"), $arFilter, false, Array("nTopCount" => $arParams['COUNT']), $arSelect);
	while($ob = $resF->GetNextElement())
	{
		$arFieldsFeedback = $ob->GetFields();
		$arResult['FEEDBACK'][] = $arFieldsFeedback;
	}

?>