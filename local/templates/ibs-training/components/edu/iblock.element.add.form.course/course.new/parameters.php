<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"ANCHOR_PARAMETER" => Array(
		"NAME" => GetMessage("# Anchor Parameter"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"URL_FORM_PARAMETER" => Array(
		"NAME" => "FORM actions parameter to divide requests",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"SHOW_CITIES" => Array(
		"NAME" => GetMessage("SHOW_CITIES"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
	),	
);
?>