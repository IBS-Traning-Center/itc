<?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (CModule::IncludeModule("iblock")):
$phrase=$_REQUEST['nameStartsWith'];
if ($_REQUEST["type"]=="k") {
$arSelect = Array("ID", "NAME", "CODE");
$arFilter = Array("IBLOCK_ID"=>6, "ACTIVE_DATE"=>"Y",  "ACTIVE"=>"Y");
$arFilter[]=array("LOGIC"=>"OR", "NAME"=> "%".$phrase."%", "CODE"=> "%".$phrase."%",);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
  $arFields = $ob->GetFields();
  $response[]=array('title_ru'=>$arFields["CODE"]." ".$arFields["NAME"], 'id'=>$arFields["ID"]);
}

} else {
	
	$arSelect = Array("ID", "NAME", "CODE", "PROPERTY_course_code", "PROPERTY_SCHEDULE_COURSE.NAME", "PROPERTY_CITY", "PROPERTY_STARTDATE");
	$arFilter = Array("IBLOCK_ID"=>9, ">PROPERTY_STARTDATE"=> date("Y-m-d", strtotime("-365 day")));
	$arFilter[]=array("LOGIC"=>"OR", array("PROPERTY_SCHEDULE_COURSE.NAME"=> "%".$phrase."%"), array("PROPERTY_course_code"=>"%".$phrase."%"));
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($arFields  = $res->GetNext())
	{
		$id_city=$arFields["PROPERTY_CITY_VALUE"];
		$arSelect = Array("PROPERTY_edu_type_money", "NAME");
		$arFilter = Array("IBLOCK_ID"=>51,"ID"=>$id_city);
		$pes = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_pields = $pes->GetNext()) {
			$valuta= $ar_pields["PROPERTY_EDU_TYPE_MONEY_VALUE"];
			$valuta_ENUM_ID = $ar_pields["PROPERTY_EDU_TYPE_MONEY_ENUM_ID"];
			$city_name = $ar_pields["NAME"];
		}
		$response[]=array('title_ru'=>$city_name.", ".$arFields["PROPERTY_COURSE_CODE_VALUE"]." ".$arFields["PROPERTY_STARTDATE_VALUE"].", ".$arFields["PROPERTY_SCHEDULE_COURSE_NAME"], 'id'=>$arFields["ID"]);
	
	}
}

echo json_encode($response);
endif;
exit;
?>
