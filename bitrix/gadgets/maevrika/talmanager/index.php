<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

 $text = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/onlinek/index.php"); 

 $str =$text;
$marker = stripos($str, "maevrika:talk.manager");
if($marker) {
    $str = substr($str, $marker-37);
	$str = substr($str, 0, -64);
	}

$str2 = html_entity_decode($str);

$file = $_SERVER["DOCUMENT_ROOT"]."/bitrix/gadgets/maevrika/talmanager/dann.php";
$text2 = file_get_contents($file);
$text2 = htmlspecialchars($text2); 
$sr=strcmp($str,$text2);
if ($sr!="0") {
	$f = fopen($file,'wb');
	$ins=file_put_contents($file,$str2); 
}
include($file);
?>