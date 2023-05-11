<?
    if (isset($id) and (is_numeric($id)) ) { $id_vacancy = $id; } else { $id_vacancy = 2057; }
      if(CModule::IncludeModule("iblock"))
 {
	    $arFilter = array();
	    $arFilter["ID"] = $id_vacancy;
	    $items = GetIBlockElementList(1, false, $arSort, 1, $arFilter );
	    while($arItem = $items->GetNext())
	   {
	   	  $arIBlockElement = GetIBlockElement($id_vacancy);
	      $vacancy_name = $arItem["NAME"];
	      $vacancy_code = $arIBlockElement['PROPERTIES']['int_id']['VALUE'];
	      $vacancy_emailteacher = $arIBlockElement['PROPERTIES']['email']['VALUE'];
   	   }
  }


?>