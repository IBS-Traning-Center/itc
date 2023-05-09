<?php
define("NO_KEEP_STATISTIC", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$action=$_REQUEST["action"];
CModule::IncludeModule("iblock");
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
print_r( date("Y-m-d H:i:s", strtotime("-1 day")));
$arFilter = Array("IBLOCK_ID"=> 64, ">DATE_ACTIVE_FROM"=> date("d.m.Y H:i:s", strtotime("-30 second")));
$res = CIBlockElement::GetList(Array("DATE_CREATE"=> "DESC"), $arFilter, false, Array("nPageSize"=>1), $arSelect);
if ($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $APPLICATION->RestartBuffer();
 //print_r($arFields);
 $json=json_encode(array("success"=> "Y", "course"=> $arFields["NAME"]));
print_r($json);
 } else {
	$APPLICATION->RestartBuffer();
	echo json_encode(array("success"=> "N"));
}
?> 
