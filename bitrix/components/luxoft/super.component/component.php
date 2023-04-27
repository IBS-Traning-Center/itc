<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// including cache area (result_modifier.php)
if($this->StartResultCache())
{
	$this->IncludeComponentTemplate();
}

// including Nocache File
$modifier_path = $_SERVER["DOCUMENT_ROOT"].$arResult["__TEMPLATE_FOLDER"]."/result_modifier_nc.php";
if (file_exists($modifier_path))
	require_once($modifier_path);
?>
