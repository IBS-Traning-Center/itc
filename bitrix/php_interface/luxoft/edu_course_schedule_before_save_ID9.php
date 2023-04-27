<?
	$myID=$_POST[ID];
	if ($myID==0)
		$ID_record = $_POST["PROP"][51]['n0'];
	else
		$ID_record = $_POST["PROP"][51]["$myID:51"];
	if($REQUEST_METHOD=="POST" && strlen($Update)>0 && $view!="Y"){
		$arSelect = Array("PROPERTY_course_idcategory", "NAME");
		$arFilter = Array("ID"=>$ID_record);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
			$categ_id= $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
			$name_cource = $ar_fields["~NAME"];
		}
		$_POST['NAME']=$name_cource;
	}
?>
