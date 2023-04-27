<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//iwrite($arResult);
//iwrite($arParams);
if ($arParams['arUserField']['ID'] == 29){
$arInfo = GetInfoAboutExpertByID($arParams['arUserField']['VALUE']);
//iwrite($arInfo);
$arResult['INFO_EXPERT'] = $arInfo;
}
?>