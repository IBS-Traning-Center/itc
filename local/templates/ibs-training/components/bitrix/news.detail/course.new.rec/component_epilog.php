<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?		$city_word="";
		if (intval($_REQUEST["IN_CITY"])>0) {
			$res = CIBlockElement::GetByID(intval($_REQUEST["IN_CITY"]));
			if($ar_res = $res->GetNext())
			  $city_word=" ".GetMessage("CITY_WORD")." ".$ar_res['NAME'];
		}
		$APPLICATION->SetTitle(GetMessage("COURSE_WORD")." ".$arResult["NAME"].$city_word); 
		$APPLICATION->SetPageProperty("blue_title", $arResult["NAME"]); 



		if (strlen($arResult['PROPERTIES']['meta_keywords']['VALUE'])>0){
				$APPLICATION->SetPageProperty("keywords", $arResult['PROPERTIES']['meta_keywords']['VALUE']);
		}
		if (strlen($arResult['PROPERTIES']['meta_desc']['VALUE'])>0){
			$APPLICATION->SetPageProperty("description", $arResult['PROPERTIES']['meta_desc']['VALUE']);
		} elseif (strlen($arResult['PROPERTIES']['short_descr']['VALUE'])>0) {
			$APPLICATION->SetPageProperty("description", $arResult['PROPERTIES']['short_descr']['VALUE']);
		}
		$APPLICATION->AddHeadString('<link rel="canonical"  href="'.$APPLICATION->GetCurPage().'" />');
?>



