<?
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (CModule::IncludeModule("iblock")):
	if (intval($_REQUEST["id"])>0) {
		$arSelect=array("NAME", "PREVIEW_TEXT", "PROPERTY_SUBJECT");
		$arFilter = Array("IBLOCK_ID"=>109, "ID"=>intval($_REQUEST["id"]), "ACTIVE_DATE"=>"Y",  "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
		  $arFields = $ob->GetFields();
		  $response=array('title_ru'=>$arFields["PREVIEW_TEXT"], "subject"=>$arFields["PROPERTY_SUBJECT_VALUE"]);
		}
	}
echo json_encode($response);
endif?>