<?
	//phpinfo();
	//die;
	if($REQUEST_METHOD=="POST" && strlen($Update)>0 && $view!="Y" && (!$error) && empty($dontsave))
	{
	$myID=$_POST["ID"];


    $temp_array = $_POST["x_prschedule_content"];
    $arr = array();
    $index = 0;
    foreach ($temp_array as $value) {
		$new_duration=$_POST["duration_$value"];
		$new_price=$_POST["price_$value"];
		$arr["$index"]['VALUE']= $value;
        $arr["$index"]['DURATION'] = $new_duration;
        $arr["$index"]['PRICE'] = $new_price;
		$index = $index+1;
		}

	$arr_ser =serialize($arr);
    if ($myID==0)
	{

		 // $PROP[209]['n0'] =$arr_ser;
	}
	else
	{
 		 //$PROP[209]["$myID:209"] = $arr_ser;

	}
     $PROP[209] = $arr_ser;
	//phpinfo();
	//die;

	    //echo "new_duration = $new_duration<BR>";
	    //echo "new_price = $new_price<BR>";



   /*
	$arFilter = array();
	$arFilter["ID"] = $ID_record;
	$arSort["SORT"] = "ASC";
	$items = GetIBlockElementList(6, false, $arSort, 1, $arFilter );
	while($arItem = $items->GetNext())
	{
	 	$name_cource = $arItem["NAME"];
	 	$IDD = $arItem["ID"];
	 	$arIBlockElement = GetIBlockElement($ID_record);
	 	$categ_id = $arIBlockElement['PROPERTIES']['course_idcategory']['VALUE'];
        echo "categ_id =$categ_id";//print_r($arIBlockElement);

	}
    */
    if($REQUEST_METHOD=="POST" && strlen($Update)>0 && $view!="Y")

   {
   /*
    $arSelect = Array("PROPERTY_course_idcategory", "NAME");
	$arFilter = Array("ID"=>$ID_record);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ar_fields = $res->GetNext())
	{
  		$categ_id= $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
  		$name_cource = $ar_fields["NAME"];
	}
    $_POST[NAME]=$name_cource;
     */



    /*
    if ($myID==0)
	{
		 $_POST["PROP"][196]['n0']['VALUE'] =  "";
		 $_REQUEST["PROP"][196]['n0']['VALUE'] =  "";
	}
	else
	{
		 $_POST["PROP"][196]["$myID:196"]['VALUE'] =  "";
		 $_REQUEST["PROP"][196]["$myID:196"]['VALUE'] =  "";
	}
    $_POST["ACTIVE_FROM"] = date("d.m.Y H:i:s");
   //$error = new _CIBlockError(2, "INTERNAL_CODE_REQUIRED",  "ВВЕДЕН ПУСТОЙ INTERNAL_CODE");
     */
   }
   }
?>
