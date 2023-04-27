<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
if (CModule::IncludeModule("iblock")) {
    $arSelect = Array("PROPERTY_COURSE_CODE","ID","NAME", "XML_ID");
    $arFilter = Array("IBLOCK_ID"=>6, "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNextElement())
    {
    $ar_fields = $ob->GetFields();
    echo "<pre>";
	print_r($ar_fields);
	echo "</pre>";
    $el = new CIBlockElement;
    $arCode = Array("XML_ID" => strtolower(codeTranslite($ar_fields['NAME'])));
    $result = $el->Update($ar_fields["ID"], $arCode);
    //echo $result;
	
    }
}
?>