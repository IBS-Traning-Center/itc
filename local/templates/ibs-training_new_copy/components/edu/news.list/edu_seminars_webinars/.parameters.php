<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arrEventType = array();
$arrEventType[] = "Не выбрано";
$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>7, "CODE"=>"type_event"));
while($enum_fields = $property_enums->GetNext())
{
  $arrEventType[$enum_fields["ID"]] = $enum_fields["VALUE"];
}

$arTemplateParameters = array(
  	 "PROPERTY_TYPECHECK" => array(
         "PARENT" => "DATA_SOURCE",
     	 "NAME" => "Показывать события по типу без привязки к дате",
    	 "TYPE" => "LIST",
     	 "VALUES" => $arrEventType,
  	),
	"DISPLAY_DATE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_DATE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_NAME" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_NAME"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PICTURE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_PICTURE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PREVIEW_TEXT" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_TEXT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
);
?>
