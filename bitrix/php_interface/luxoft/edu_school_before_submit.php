<?
	if($REQUEST_METHOD=="POST" && strlen($Update)>0 && $view!="Y" && (!$error) && empty($dontsave))
	{
	$_POST["NAME"] = "345324523";
	 foreach ($PROP[176] as $key => $idValue) {
	   $idCourse = $idValue;
	 }

    $arGroupBy  = Array();
	$arSelectFields = Array("NAME");
	$arFilter = Array("IBLOCK_ID"=>6, "ID" => $idCourse);
	$arOrder = Array();
	$res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelectFields);
	while($ob = $res->GetNextElement())
	{
	  $arFields = $ob->GetFields();
	  $courseName = $arFields["NAME"];
	}
    $_POST["NAME"] = $courseName;
    //присвоили поля имя элемента  - имя курса
   }
?>
