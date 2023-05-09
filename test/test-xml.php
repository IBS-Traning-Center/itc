<?php include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?php GLOBAL $APPLICATION?>
<?php GLOBAL $USER?>
<?php $file=file_get_contents('file.txt');?>
<?php $arCourse=xml_rus_courses_to_array($file);?>
<?php echo "<pre>"?>
<?php print_r($arCourse)?>
<?php echo "</pre>";?>
<?php function xml_rus_courses_to_array($file) {?>
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
	<?$arRusArray[$key]=$arItem?>
<?}?>

<?return $arRusArray?>
<?}?>