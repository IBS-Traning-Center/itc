<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach ($arResult["ITEMS"] as $key=>$arItem) {?>
	
	<?
	$arSelect = Array("ID", "NAME", "PROPERTY_schedule_course", "PROPERTY_schedule_course.NAME", "PROPERTY_teacher", "PROPERTY_teacher.NAME", "PROPERTY_schedule_time", "PROPERTY_startdate","PROPERTY_enddate",  "PROPERTY_schedule_duration");
	$arFilter = Array("IBLOCK_ID"=>9, "ID"=> $arItem["PROPERTIES"]["SCH_COURSE"]["VALUE"]);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
	while($ob = $res->GetNextElement())
	{
	  $arFields = $ob->GetFields();
	 
	  $arResult["ITEMS"][$key]["COURSE-INFO"]=$arFields;
	  
		$arSelect = Array("ID", "NAME", "PROPERTY_expert_name", "CODE");
		$arFilter = Array("IBLOCK_ID"=>56, "ID"=>$arFields["PROPERTY_TEACHER_VALUE"]);
		$pes = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
		while($obj = $pes->GetNextElement())
		{
		  $arFiel = $obj->GetFields();
		  $arResult["ITEMS"][$key]["COURSE-INFO"]["TRENER"]["CODE"]=$arFiel["CODE"];
		  $arResult["ITEMS"][$key]["COURSE-INFO"]["TRENER"]["NAME"]=$arFiel["NAME"].' '.$arFiel["PROPERTY_EXPERT_NAME_VALUE"];
		}
		
		$arSelect1= Array("ID", "PROPERTY_FILE");
		//print_r($arFields["PROPERTY_SCHEDULE_COURSE_VALUE"]);
		$arFilter1 = Array("IBLOCK_ID"=>110, "PROPERTY_SCH_COURSE"=> $arFields["ID"]);
		$des = CIBlockElement::GetList(Array(), $arFilter1, false, false, $arSelect1);
		while($obj1 = $des->GetNextElement())
		{
		  $arField2 = $obj1->GetFields();
		  $arProp = $obj1->GetProperties();
		 

			
			$file_element_ID=$arField2["PROPERTY_FILE_VALUE"];
			$arSelect4 = Array("ID", "IBLOCK_ID", "PROPERTY_*");
			$arFilter4 = Array("ID" => $file_element_ID);
			$des = CIBlockElement::GetList(Array(), $arFilter4, false, false, $arSelect4);
			
			while($ob4 = $des->GetNextElement())
			{
			
			$arFields4 = $ob4->GetFields();
			$arProp2 = $ob4->GetProperties();
			
			}

		  $arResult["ITEMS"][$key]["FILE"][]=$arProp2["FILE"]["VALUE"];

		}
		
	}
	/*foreach ($arItem["PROPERTIES"]["FILE"]["VALUE"] as $file) {
		//if ($USER->IsAdmin()) {
			$res = CIBlockElement::GetByID($file);
			if($ar_res = $res->GetNextElement())
				$ar_prop=$ar_res->GetProperties();
				$arResult["ITEMS"][$key]["FILE"][]=CFile::GetFileArray($ar_prop["FILE"]["VALUE"]);
		//}
		//$arResult["ITEMS"][$key]["FILE"][]=CFile::GetFileArray($file);
	}*/
		?>
		
<?}?>
