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
        $findme   = 'Класс';
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
	}

?>


