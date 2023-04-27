<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//print_r($arResult["COURSE"]["NAME"])?>
<?
$APPLICATION->AddChainItem("Описание курса", "/personal_test/learning/course/?COURSE_ID=".$arResult["COURSE"]["ID"]);
?>