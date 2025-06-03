<?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CreateReccommend(1647, 22355);
function CreateReccommend($USER_ID=0, $COURSE_ID=0) {
	CModule::IncludeModule("iblock");
	$arFilter = Array("IBLOCK_ID"=>94,  "PROPERTY_PP_COURSE"=> $COURSE_ID, "ACTIVE"=>"Y");
	$arSelect=array("ID", "NAME", "IBLOCK_SECTION_ID");
	$pes = CIBlockElement::GetList(Array("NAME"=>"ASC"), $arFilter, false, false, $arSelect);
	if ($arFields=$pes->GetNext()) {
		$category=$arFields["IBLOCK_SECTION_ID"];
	}

	$arSelect=array("NAME", "ID");
	$arFilter = Array("IBLOCK_ID"=>107,  "PROPERTY_USER"=> $USER_ID, "ACTIVE"=>"Y");
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
			CIBlockElement::SetPropertyValuesEx($PRODUCT_ID, false, array("USER"=>$USER_ID, "COURSE"=>$COURSE_ID, "CATEGORY"=>$category));
		}
	}