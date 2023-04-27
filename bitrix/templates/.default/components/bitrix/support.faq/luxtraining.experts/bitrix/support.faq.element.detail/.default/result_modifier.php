<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
function code_replace_func($matches)
{
	return preg_replace("/\n/is","",'
		<table cellpadding="0" cellspacing="0" class="data-table">
			<tr>
				<td>'.htmlspecialchars($matches[3]).'</td>
			</tr>
		</table>
	');
}

global $APPLICATION, $USER;
		
	$arResult['ITEM']["DETAIL_TEXT"] = preg_replace_callback("/(<|\[)CODE(>|\])(.+?)(<|\[)\/CODE(>|\])/is",code_replace_func,$arResult['ITEM']["DETAIL_TEXT"]);

	if(strtoupper($arResult['ITEM']["PREVIEW_TEXT_TYPE"]) == "TEXT")
		$arResult['ITEM']["PREVIEW_TEXT"] = nl2br($arResult['ITEM']["PREVIEW_TEXT"]);
	if(strtoupper($arResult['ITEM']["DETAIL_TEXT_TYPE"]) == "TEXT")
		$arResult['ITEM']["DETAIL_TEXT"] = nl2br($arResult['ITEM']["DETAIL_TEXT"]);	
	
	//create button
	if($USER->IsAuthorized())
	{
		if($APPLICATION->GetShowIncludeAreas())
		{

			$ar = CIBlock::ShowPanel($arParams['IBLOCK_ID'], $arResult['ITEM']['ID'], 0, $arParams["IBLOCK_TYPE"], true);
			if(is_array($ar))
			{
				foreach($ar as $arButton)
				{
					if(preg_match("/[^A-Z0-9_]ID=\d+/", $arButton["URL"]))
					{
						$arButton["URL"] = preg_replace("/&return_url=(.+?)&/", "&", $arButton["URL"]);
						$arResult['ITEM']['EDIT_BUTTON'] = '<a href="'.htmlspecialchars($arButton["URL"]).'" title="'.htmlspecialchars($arButton["TITLE"]).'"><img src="'.$arButton["IMAGE"].'" width="20" height="20" border="0" /></a>';
					}
				}
			}
		}
	}
//iwrite($arResult['ITEM']);
		$arSelect = array("PROPERTY_ANSW_ID_EXPERT.NAME", "PROPERTY_ANSW_ID_EXPERT.CODE", "PROPERTY_ANSW_ID_EXPERT.ID", "ID", "PROPERTY_ANSW_IS_SHOW_FULL", "PROPERTY_ANSW_QUESTION");
		$arFilter = array("IBLOCK_ID"=>D_EXPERTS_ANSWERS,  "ID"=>$arResult['ITEM']['ID']);
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$ar_fields = $ob->GetFields();
			$arResult['EXPERT'] = $ar_fields;
		}
//iwrite($arResult['EXPERT']);
		$arSelect = array("PROPERTY_EXPERT_NAME", "PROPERTY_EXPERT_SHORT", "ID");
		$arFilter = array("IBLOCK_ID"=>56,  "ID"=>$arResult['EXPERT']['PROPERTY_ANSW_ID_EXPERT_ID']);
//iwrite($arFilter);
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$ar_fields = $ob->GetFields();
			$arResult['EXPERT']['NAME'] = $ar_fields['PROPERTY_EXPERT_NAME_VALUE'];
			$arResult['EXPERT']['SHORT'] = $ar_fields['PROPERTY_EXPERT_SHORT_VALUE'];
		}
//iwrite($arResult['EXPERT']);

?>