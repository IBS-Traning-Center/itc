<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"SPECIAL_TITLE" => Array(
		"NAME" => GetMessage("SPECIAL_TITLE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"SPECIAL_DESCRIPTON_1" => Array(
		"NAME" => GetMessage("SPECIAL_DESCRIPTON_1"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"SPECIAL_DESCRIPTON_2" => Array(
		"NAME" => GetMessage("SPECIAL_DESCRIPTON_2"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
);
