<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//print_r($arResult["LESSON"]["NAME"])?>
<?
$APPLICATION->AddChainItem($arResult["LESSON"]["NAME"], "/personal_test/learning/course/?COURSE_ID=".$arResult["COURSE"]["ID"]."&LESSON_ID=".$arResult["LESSON"]["ID"]);
?>