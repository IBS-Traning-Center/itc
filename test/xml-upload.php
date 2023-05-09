<?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?GLOBAL $APPLICATION?>
<?GLOBAL $USER?>

<?if ($USER->GetID()==2192) {?>
	
	
<?//} else {?>
	<?//echo "NO"?>
<?//}?>
<?$arCourse=xml_rus_courses_to_array($_REQUEST["file_content"])?>
<?CModule::IncludeModule("iblock")?>
    <?$arFilter = Array(
    "IBLOCK_ID"=> D_COURSE_ID_IBLOCK,
    "CODE" => $arCourse["Code"]
    );
    $res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false);
    if ($res->SelectedRowsCount()==1) {
        while($ar_fields = $res->GetNext())
        {
            $ELEMENT_ID=$ar_fields["ID"];
        }
    } else {
        $arErrors[]="Error";
    }?>
<?//print_r($ELEMENT_ID)?>
<?/*if (intval($ELEMENT_ID)>0) {?>
    <?//print_r($arCourse)?>
    <?//print_r($ELEMENT_ID)?>
    <?
    foreach ($arCourse["RecomCourses"] as $arRecom) {
        //print_r($arRecom);
        echo str_replace("&nbsp;", " ", $arRecom);
        $arSplit=preg_split("#\s+#", $arRecom);
        //print_r($arSplit);
    }
    $arProp["course_puproses"]=htmlspecialchars_decode($arCourse["Objectives"]);
    $arProp["course_audience"]=htmlspecialchars_decode($arCourse["TargetAudience"]);
    $arProp["course_duration"]=htmlspecialchars_decode($arCourse["Duration"]);
    $arProp["course_addsources"]=htmlspecialchars_decode($arCourse["RecomReading"]);

    $arProp["course_top_html"]=array('VALUE'=>array('TYPE'=>'HTML', 'TEXT'=>htmlspecialchars_decode($arCourse["Roadmap"])));;
    $arProp["course_desc_new"]=array('VALUE'=>array('TYPE'=>'HTML', 'TEXT'=>htmlspecialchars_decode($arCourse["Description"])));;
    $arProp["course_req_new"]=array('VALUE'=>array('TYPE'=>'HTML', 'TEXT'=>htmlspecialchars_decode($arCourse["Prerequisites"])));;
    CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, $arProp);
    ?>
<?}*/?>
	
<?} else {?>
	<?header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);?>
	<?echo "Athorization error";?>
<?}?>
<?function xml_rus_courses_to_array($file) {?>
		<?$xml=simplexml_load_string($file);?>
		<?$arRusArray=array();?>
		<?//echo "<pre>";?>
		<?//print_r($xml);?>
		<?//echo "</pre>";?>
		<?$arRusArray["Name"]=strip_tags($xml->CourseItem[0]->Title->children()->asXML())?>
		<?$arRusArray["Code"]=strip_tags($xml->CourseItem[0]->Code->asXML())?>
		<?$arRusArray["Duration"]=intval(strip_tags($xml->CourseItem[0]->Hours->asXML()))?>
		<?$arRusArray["Tags"]=strip_tags($xml->CourseItem[0]->Tags->asXML())?>
		<?foreach ($xml->CourseItem[0]->RecomCourses->ul->li as $key=>$recom) {?>
		   <?//echo (str_replace("&nbsp;", " ", (string)$recom))?>
		   <?$arRusArray["RecomCourses"][]=(string)$recom?>
		<?}?>
		<?$htmltags=array()?>
		<?$htmltags[]="ShortDescription";?>
		<?$htmltags[]="Description";?>
		<?$htmltags[]="TargetAudience";?>
		<?$htmltags[]="Objectives";?>
		<?$htmltags[]="Roadmap";?>
		<?$htmltags[]="Prerequisites";?>
		<?$htmltags[]="RecomReading";?>

		<?$htmltags[]="Other";?>
		<?foreach ($htmltags as $arTeg) {?>
			<?$arRusArray[$arTeg]=htmlspecialchars(str_replace(array("<".$arTeg.">", "</".$arTeg.">"), array("",""), $xml->CourseItem[0]->$arTeg->asXML()))?>
		<?}?>
		<?foreach ($arRusArray as $key=>$arItem) {?>
			<?if (!is_array($arRusArray[$key])) {?>
			<?$arRusArray[$key]=$arItem?>
			 <?} else {?>
				<?foreach ($arRusArray[$key] as $subkey=>$arSubItem) {?>
					<?$arRusArray[$key][$subkey]=$arSubItem?>
				<?}?>
			<?}?>
		<?}?>

		<?return $arRusArray?>
	<?}?>