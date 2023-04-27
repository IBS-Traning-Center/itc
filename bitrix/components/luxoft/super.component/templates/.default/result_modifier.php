<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/* example
if (!CModule::IncludeModule("iblock")) return;
$iblocks = array(
   39 // Toyota Avtostrada
);
$arOrder = array(
   "DATE_ACTIVE_FROM" => "DESC",
);
$arSelect = array(
   "ID",
   "NAME"
);
$arNavParams = array(
   "nTopCount" => 2,
);
foreach ($iblocks as $key => $iblock_id)
{
   $arFilter = array(
      "IBLOCK_ID" => $iblock_id,
      "ACTIVE" => "Y",
      "ACTIVE_DATE" => "Y",
   );

   $db_elements = CIblockElement::GetList($arOrder, $arFilter, $arSelect, $arNavParams);
   while ($el = $db_elements->GetNext())
   {
      if ($el["PREVIEW_PICTURE"])
         $el["PREVIEW_PICTURE"] = CFile::GetFileArray($el["PREVIEW_PICTURE"]);
      if ($key%2 == 0)
         $arResult["NEWS"]["LEFT"][$iblock_id][] = $el;
      else
         $arResult["NEWS"]["RIGHT"][$iblock_id][] = $el;
   }
}
*/

?>