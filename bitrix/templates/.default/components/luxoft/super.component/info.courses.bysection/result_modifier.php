<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


if (!CModule::IncludeModule("iblock")) return;
if (intval($arParams['ID_IBLOCK'])) {} else {die();}

$arFilter = array("IBLOCK_ID" => intval($arParams['ID_IBLOCK']),"CODE" => $arParams["SECTION_CODE"]); /*"ACTIVE" =>"Y"*/
$rs_section = CIBlockSection::GetList(Array("LEFT_MARGIN" => "ASC"), $arFilter, true, Array("UF_*", "PREVIEW_TEXT", "PICTURE"));
if ($ar_section = $rs_section->Fetch())
{
    $arResult["IBLOCK_ID"]=$ar_section["IBLOCK_ID"];
    $arResult["ID"]=$ar_section["ID"];
    $arResult["INFO"]=$ar_section["DESCRIPTION"];
 $arResult["META"]=$ar_section["UF_META"];
    $arButtons = CIBlock::GetPanelButtons(
        $ar_section["IBLOCK_ID"],
        0,
        $ar_section["ID"],
        array("SESSID"=>false, "CATALOG"=>true)
    );
    $arResult["EDIT_LINK"] = $arButtons["edit"]["edit_section"]["ACTION_URL"];


 }


?>