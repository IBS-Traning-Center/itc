<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule("iblock");
	$arOrder = Array("SORT"=>"ASC", "PROPERTY_PRIORITY"=>"ASC");
	$arFilter = Array("IBLOCK_ID"=>51); //Array("IBLOCK_ID"=>IntVal($yvalue), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$arGroupBy = false;
	$arNavStartParams = false;
	$arSelectFields = Array("ID", "NAME", "DATE_ACTIVE_FROM");
	$res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
	$arrCities[]="Выбрать все города";
	while($ob = $res->GetNextElement())
	{
	 $arFields = $ob->GetFields();
	 $arrCities[$arFields["ID"]] = $arFields["NAME"];
	}

	$arrStartDate[0]="Предстоящие события";
	$arrStartDate[1]="Архивные события";

$arTemplateParameters = array(

	"PROPERTY_CITYCHECK" => Array(
      "NAME" => "Для какого города",
      "TYPE" => "LIST",
      "VALUES" => $arrCities,
 	"PARENT" => "BASE",
   ),
  	"PROPERTY_DATECHECK" => Array(
       "PARENT" => "BASE",
     	 "NAME" => "Показывать события по дате",
    	 "TYPE" => "LIST",
     	 "VALUES" => $arrStartDate,
   )
);
?>
