<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


	<?if (count($arResult["ITEMS"])<intval($arParams["NEWS_COUNT"])) {?>
		<?if (count(array_diff($arParams["ADDIT_ARRAY"], array('', '0')))>0) {?>
			<?$arSelect=array("NAME", "ID", "CODE", "XML_ID");
			$arFilter = Array("IBLOCK_ID"=>6, "ACTIVE"=>"Y","ID"=>$arParams["ADDIT_ARRAY"]);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>$arParams["NEWS_COUNT"]-count($arResult["ITEMS"])), $arSelect);
			while ($arFields=$res->GetNext()) {
				
				$arResult["ITEMS"][]=array("TYPE"=> "CAT", "XML_ID"=> $arFields["XML_ID"], "ID"=> $arFields["ID"],"NAME"=>$arFields["NAME"], "CODE"=>$arFields["CODE"]);
			}?>
		<?}?>
	<?}?>
