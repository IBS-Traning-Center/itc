<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


if (!CModule::IncludeModule("iblock")) return;
if (intval($arParams['ID_IBLOCK'])) {} else {die();}
	/***********
	* Разделы *
	***********/
	$arFilter = array("IBLOCK_ID" => intval($arParams['ID_IBLOCK']),"ACTIVE" =>"Y", "GLOBAL_ACTIVE" => "Y"); /*"ACTIVE" =>"Y"*/
	$rs_section = CIBlockSection::GetList(Array("LEFT_MARGIN" => "ASC"), $arFilter, true, Array("UF_*"));
	while($ar_section = $rs_section->Fetch())
	{
		$arResult["SECTIONS"][$ar_section["ID"]] = $ar_section;
		if ($ar_section["DEPTH_LEVEL"] > 0 ){
			$arFilterCountElements = Array(
				"IBLOCK_ID"=>$arParams["ID_IBLOCK"],
				"ACTIVE"=>"Y",
				"SECTION_ID"=>$ar_section["ID"],
				"INCLUDE_SUBSECTIONS"=>"Y",
				"SECTION_GLOBAL_ACTIVE" =>"Y",
				"SECTION_ACTIVE" =>"Y",
				"PROPERTY_PP_COURSE.ACTIVE" => "Y"
			);
			$res = CIBlockElement::GetList(Array(), $arFilterCountElements, Array(), false, Array());
			$arResult["SECTIONS"][$ar_section["ID"]]["ELEMENT_CNT"] = $res;
		}
/*
		if ($ar_section["DEPTH_LEVEL"] == 1){
			$arSummaCourse = Array();
			$arSelectC = Array("ID", "NAME", "IBLOCK_SECTION_ID", "PROPERTY_PP_COURSE");
			$arFilterC = Array("IBLOCK_ID"=>$arParams["ID_IBLOCK"], "ACTIVE"=>"Y", "SECTION_ID"=>$ar_section["ID"], "INCLUDE_SUBSECTIONS"=>"Y");
			$res = CIBlockElement::GetList(Array(), $arFilterC, false, Array("nPageSize"=>50), $arSelectC);
			$index = 0;
			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();
				$index = $index + 1;
				if (!in_array($arFields['PROPERTY_PP_COURSE_VALUE'], $arSummaCourse)) {
					$arSummaCourse[] = $arFields['PROPERTY_PP_COURSE_VALUE'];
				}
			}
			echo count($arSummaCourse);
			echo "<br />";
		}
*/
	}

//iwrite($arResult["SECTIONS"]["NAME"]);
	/************
	* Элементы *
	************/

	$arFilter = array("IBLOCK_ID" => intval($arParams['ID_IBLOCK']),"ACTIVE" =>"Y", "SECTION_GLOBAL_ACTIVE" =>"Y", "SECTION_ACTIVE" =>"Y", "PROPERTY_PP_COURSE.ACTIVE" => "Y"); /*"ACTIVE" =>"Y"*/
	$arSelect = array("ID","NAME","PROPERTY_PP_COURSE","PROPERTY_PP_COURSE.NAME","PROPERTY_PP_COURSE.ACTIVE", "PROPERTY_PP_COURSE.CODE", "SORT", "IBLOCK_SECTION_ID");
	$rs_element = CIBlockElement::GetList(Array("SORT"=>"ASC", "PROPERTY_PP_COURSE.CODE" => "ASC"), $arFilter, false, false, $arSelect);
	while($ar_element = $rs_element->GetNext(false, false))
	{
		/************
		найдем также цену и длит
		************/
		$arSelectCourse = array("ID","PROPERTY_COURSE_DURATION","PROPERTY_COURSE_PRICE", "PROPERTY_COURSE_PRICE_UA");
		$arFilterCourse = array("IBLOCK_ID" =>6, "ID" => $ar_element["PROPERTY_PP_COURSE_VALUE"]);
		$rs_elementCourse = CIBlockElement::GetList(array(), $arFilterCourse, false, false, $arSelectCourse);
		while($ar_elementCourse = $rs_elementCourse->GetNext(false, false))
		{
			$ar_element['PARAM']  =  $ar_elementCourse;
		}
		$ar_element['IS_COURSE'] = "Y";
		$ar_element['DEPTH_LEVEL'] = $arResult["SECTIONS"][$ar_element['IBLOCK_SECTION_ID']]["DEPTH_LEVEL"] + 1 ;
		$arResult["SECTIONS"][$ar_element['IBLOCK_SECTION_ID']]["IS_PARENT"] = "Y";
		if(array_key_exists($ar_element["IBLOCK_SECTION_ID"], $arResult["ELEMENTS"]))
		{
			$arResult["ELEMENTS"][$ar_element["IBLOCK_SECTION_ID"]][$ar_element["ID"]] = $ar_element;
		}
		else
		{
			$arResult["ELEMENTS"][$ar_element["IBLOCK_SECTION_ID"]] = Array();
			$arResult["ELEMENTS"][$ar_element["IBLOCK_SECTION_ID"]][$ar_element["ID"]] = $ar_element;
		}
		//iwrite($ar_element);
	}

//iwrite($arResult["ELEMENTS"]);

/*********************
* Построение дерева *
*********************/

$previousLevel = 0;
$arStack = Array();
foreach($arResult["SECTIONS"] as $arSection)
{
//iwrite($arSection);
if($previousLevel && $arSection["DEPTH_LEVEL"] <= $previousLevel)
	{
		$delta = $previousLevel - $arSection["DEPTH_LEVEL"];
		for($i = 0; $i < ($delta + 1); $i++)
		{
			$section_id = array_pop($arStack);
			if(array_key_exists($section_id, $arResult["ELEMENTS"]))
			{
				foreach($arResult["ELEMENTS"][$section_id] as $arElement)
				{
					$arResult["ITEMS"][] = $arElement;
				}
			} 
				else {//$arSection["ELEMENT_CNT"] = 0;
			}
		} 
	}
   $arResult["ITEMS"][] = $arSection;
   $arStack[] = $arSection["ID"];
   $previousLevel = $arSection["DEPTH_LEVEL"];
}
	$section_id = array_pop($arStack);
	if(array_key_exists($section_id, $arResult["ELEMENTS"]))
		{
			foreach($arResult["ELEMENTS"][$section_id] as $arElement)
			{
				$arResult["ITEMS"][] = $arElement;
			}
		}


//iwrite($arResult["ITEMS"]);
?>