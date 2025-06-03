<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

	if (strlen($_REQUEST["save"])>0) {
		$arSelect=array("NAME", "ID");
		$arFilter = Array("IBLOCK_ID"=>107,  "PROPERTY_USER"=> $USER->GetID(),"ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array("NAME"=>"ASC"), $arFilter, false, false, $arSelect);
		if ($arFields=$res->GetNext()) {
			$PRODUCT_ID=$arFields["ID"];
		} else {
			$el = new CIBlockElement;
			$arLoadProductArray = Array(
				  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
				  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
				  "IBLOCK_ID"      => 107,
				  "NAME"           => $USER->GetID()."_reccomend",
				  "ACTIVE"         => "Y",            // активен
				  );

				if($PRODUCT_ID = $el->Add($arLoadProductArray))
				  echo $PRODUCT_ID;
				else
				  echo "Error: ".$el->LAST_ERROR;
		}
		CIBlockElement::SetPropertyValuesEx($PRODUCT_ID, false, array("USER"=>$USER->GetID(), "CITY" => $_REQUEST['city'], "COURSE"=>$_REQUEST["courseid"], "CATEGORY"=> $_REQUEST["category"]));
		LocalRedirect($APPLICATION->GetCurDir());
	}
	$arSort = array(
		"left_margin"=>"asc",
	);
	//EXECUTE
	
	$arSelect=array("NAME", "ID", "PROPERTY_CITY", "PROPERTY_COURSE", "PROPERTY_COURSE.NAME", "PROPERTY_COURSE.CODE", "PROPERTY_CATEGORY");
	$arFilter = Array("IBLOCK_ID"=>107,  "PROPERTY_USER"=> $USER->GetID(), "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array("NAME"=>"ASC"), $arFilter, false, false, $arSelect);
	while ($arFields=$res->GetNext()) {
		$arResult["city"][]=$arFields["PROPERTY_CITY_VALUE"];
		$arResult["category"][]=$arFields["PROPERTY_CATEGORY_VALUE"];
		$arResult["course"]=$arFields["PROPERTY_COURSE_VALUE"];
		$arResult["courseNAME"]=$arFields["PROPERTY_COURSE_CODE"]." ".$arFields["PROPERTY_COURSE_NAME"];
	}
	
	$arFilter = array(
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
		"IBLOCK_ID" => 94,
		"CNT_ACTIVE" => "Y",
	);
	$arSelect=array("DEPTH_LEVEL", "ID", "NAME", "IS_PARENT");
	$rsSections = CIBlockSection::GetList($arSort, $arFilter, $arParams["COUNT_ELEMENTS"], $arSelect);
	$rsSections->SetUrlTemplates("", $arParams["SECTION_URL"]);
	while($arSection = $rsSections->GetNext())
	{
		if(isset($arSection["PICTURE"]))
			$arSection["PICTURE"] = CFile::GetFileArray($arSection["PICTURE"]);

		$arButtons = CIBlock::GetPanelButtons(
			$arSection["IBLOCK_ID"],
			0,
			$arSection["ID"],
			array("SESSID"=>false, "CATALOG"=>true)
		);
		$arSection["EDIT_LINK"] = $arButtons["edit"]["edit_section"]["ACTION_URL"];
		$arSection["DELETE_LINK"] = $arButtons["edit"]["delete_section"]["ACTION_URL"];

		$arResult["cat"][]=$arSection;
		
	}


	$this->IncludeComponentTemplate();

?>