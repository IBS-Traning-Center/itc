<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arTemplateParameters = array(
	"WATERMARK" => array(
        "NAME" => GetMessage("P_WATERMARK"),
		"TYPE" => "CHECKBOX",
		"MULTIPLE" => "N",
		"DEFAULT" => "N"),
	"WATERMARK_COLORS" => Array(
		"NAME" => GetMessage("P_WATERMARK_COLORS"),
		"TYPE" => "LIST",
		"VALUES" => array(
			"FF0000" => GetMessage("P_COLOR_FF0000"), 
			"FFA500" => GetMessage("P_COLOR_FFA500"), 
			"FFFF00" => GetMessage("P_COLOR_FFFF00"), 
			"008000" => GetMessage("P_COLOR_008000"), 
			"00FFFF" => GetMessage("P_COLOR_00FFFF"), 
			"800080" => GetMessage("P_COLOR_800080"), 
			"FFFFFF" => GetMessage("P_COLOR_FFFFFF"),
			"000000" => GetMessage("P_COLOR_000000")),
		"ADDITIONAL_VALUES" => "Y",
		"MULTIPLE" => "Y"), 
	
	"SHOW_TAGS" => array(
        "NAME" => GetMessage("P_SHOW_TAGS"),
		"TYPE" => "CHECKBOX",
		"MULTIPLE" => "N",
		"DEFAULT" => "N"));
?>