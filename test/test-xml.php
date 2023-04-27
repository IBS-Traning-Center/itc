<?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?GLOBAL $APPLICATION?>
<?GLOBAL $USER?>
<?$file=file_get_contents('file.txt');?>
<?$arCourse=xml_rus_courses_to_array($file);?>
<?echo "<pre>"?>
<?print_r($arCourse)?>
<?echo "</pre>";?>
<?//$cpfile=iconv("UTF-8", "windows-1251", $file)?>
<?//print_r($cpfile);?>
<?function xml_rus_courses_to_array($file) {?>
<?$xml=simplexml_load_string($file);?>
<?$arRusArray=array();?>
<?$arRusArray["Name"]=strip_tags($xml->CourseItem[0]->Title->children()->asXML())?>
<?$arRusArray["Code"]=strip_tags($xml->CourseItem[0]->Code->asXML())?>
<?$arRusArray["Duration"]=strip_tags($xml->CourseItem[0]->Hours->asXML())?>
<?$arRusArray["Tags"]=strip_tags($xml->CourseItem[0]->Tags->asXML())?>
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
	<?$arRusArray[$key]=iconv("UTF-8", "windows-1251", $arItem)?>
<?}?>

<?return $arRusArray?>
<?}?>