<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?/*
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_PICTURE", "DETAIL_PICTURE");
$arFilter = Array("IBLOCK_ID"=> 120, "PROPERTY_EXPERT"=> $arResult["ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $cert["PREVIEW_PICTURE"]=CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
 $cert["DETAIL_PICTURE"]=CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
 $cert["NAME"]=CFile::GetFileArray($arFields["NAME"]);
 $arResult["CERT"][]=$cert;
}
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_URL");
$arFilter = Array("IBLOCK_ID"=> 77, "PROPERTY_URL"=> "%youtu%", "PROPERTY_EXPERT_ID"=> $arResult["ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
$arVideoFields = $ob->GetFields();

$arUrl=parse_url($arVideoFields["PROPERTY_URL_VALUE"]);
//print_r($arUrl["query"]);
parse_str($arUrl["query"], $output);
$id=$output["v"];
$video["SRC"]="http://img.youtube.com/vi/".$id."/mqdefault.jpg";
$video["NAME"]=$arVideoFields["NAME"];
$video["URL"]=$arVideoFields["PROPERTY_URL_VALUE"];
$video["ID"]=$id;
$arResult["VIDEO"][]=$video;
}*/
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_REVIEW");
$arFilter = Array("IBLOCK_ID"=> 122, "PROPERTY_course"=> $arResult["ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
$arFields = $ob->GetFields();
$arResult["REVIEW"][]=array("NAME"=> $arFields["NAME"], "REVIEW"=> $arFields["PROPERTY_REVIEW_VALUE"]);

}
?> 