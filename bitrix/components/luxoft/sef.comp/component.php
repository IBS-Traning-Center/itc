<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (CModule::IncludeModule("iblock")) {
    if (strlen($_REQUEST["XML_ID"])>0){
        $arSelect = Array("ID");
        $arFilter = Array("IBLOCK_ID"=>6, "XML_ID"=> htmlspecialchars($_REQUEST["XML_ID"]), 'ACTIVE' => 'Y');
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        if ($ob = $res->GetNextElement())
        {
            $arFields = $ob->GetFields();
            GLOBAL $COURSE_ID;
            $COURSE_ID=$arFields["ID"];
        }
    }
    if (intval($_REQUEST["ID"])>0) {
        $arSelect = Array("XML_ID");
        $arFilter = Array("IBLOCK_ID"=>6, "ID"=> intval($_REQUEST["ID"]));
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        if ($ob = $res->GetNextElement())
        {
            $arFields = $ob->GetFields();
			$arUri=preg_split("#\?#", $APPLICATION->GetCurPageParam("", array("ID")));
			
			$addit="";
			if (strlen($arUri[1])) {
				$addit="?".$arUri[1];
			}
			LocalRedirect("/kurs/".$arFields["XML_ID"].".html".$addit, false, "301 Moved permanently");
			die();
        }
    }
	if (strlen($_REQUEST["XML_ID"])==0 && intval($_REQUEST["ID"])==0 && intval($_REQUEST["ID_TIME"])>0) {
		$arSelect = Array("ID", "NAME", "PROPERTY_schedule_course.XML_ID");
        $arFilter = Array("IBLOCK_ID"=> 9, "ID"=> intval($_REQUEST["ID_TIME"]));
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        if ($ob = $res->GetNextElement())
        {
            $arPields = $ob->GetFields();
			//print_r($arPields);
			
			$arUri=preg_split("#\?#", $APPLICATION->GetCurPageParam("", array("ID")));
			
			$addit="";
			if (strlen($arUri[1])) {
				$addit="?".$arUri[1];
			}
			LocalRedirect("/kurs/".$arPields["PROPERTY_SCHEDULE_COURSE_XML_ID"].".html".$addit, false, "301 Moved permanently");
			die();
        }
    }

}


?>