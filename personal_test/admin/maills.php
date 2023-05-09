<?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (CModule::IncludeModule("iblock")):
	if (intval($_REQUEST["id"])>0) {
		
		$arSelect=array("NAME", "PROPERTY_EMAIL_LIST");
		$arFilter = Array("IBLOCK_ID"=>111, "PROPERTY_SCH_COURSE"=>intval($_REQUEST["id"]));
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		if ($arFields=$res->GetNext()) {
			$response=array('title'=>$arFields["PROPERTY_EMAIL_LIST_VALUE"]["TEXT"]);
		}
	}
	echo json_encode($response);
endif;
?>