<?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?$file=simplexml_load_file('course.xml')?>
<?echo "<pre>"?>
<?print_r($file);?>
<?echo "</pre>";?>