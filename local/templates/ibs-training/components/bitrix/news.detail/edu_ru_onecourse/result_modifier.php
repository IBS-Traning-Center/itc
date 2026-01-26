<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

	if(CModule::IncludeModule("iblock")){
		$arSelect = Array("ID", "NAME", "IBLOCK_SECTION_ID", "PROPERTY_PP_COURSE");
		$arFilter = Array("IBLOCK_ID"=>76, "ACTIVE"=>"Y", "=PROPERTY_PP_COURSE"=>$_REQUEST["ID"]);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		$index = 0;
		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			$index = $index + 1;
			$arClasses[]= $arFields['IBLOCK_SECTION_ID'];
		}
		
		$findme = 'Класс';
		$index = 0;
		foreach ($arClasses as $idClass ){
			$res = CIBlockSection::GetByID($idClass);
			$ar_res = $res->GetNext();
			$pos = strpos($ar_res['NAME'], $findme);
	       		if ($pos !== false) {
            			$arResult['LINKED_CLASSES'][$index]['ID'] = $ar_res['ID'];
            			$arResult['LINKED_CLASSES'][$index]['NAME'] = $ar_res['NAME'];
            			$arResult['LINKED_CLASSES'][$index]['CODE'] = $ar_res['CODE'];
	        	}
	        	$index = $index + 1;
		}

		if ($arResult['PROPERTIES']['ID_COURSE_TYPE']['VALUE']>0){
				$arSelect = Array("ID", "NAME", "PREVIEW_TEXT");
				$arFilter = Array("IBLOCK_ID"=>81, "=ID"=>$arResult['PROPERTIES']['ID_COURSE_TYPE']['VALUE']);
				$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
				while($ob = $res->GetNextElement())
				{
					$arFields = $ob->GetFields();
					//iwrite($arFields);
					$arResult['PROPERTIES']['ID_COURSE_TYPE']['TYPE_NAME'] =  $arFields['NAME'];
					$arResult['PROPERTIES']['ID_COURSE_TYPE']['TYPE_PREVIEW'] =  $arFields['PREVIEW_TEXT'];
					//iwrite($arResult['PROPERTIES']['ID_COURSE_TYPE']);
				}
		}


	}

?>


