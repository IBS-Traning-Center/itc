<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(empty($arResult))
	return "";
$page = $_SERVER["SCRIPT_NAME"];
$path= $_SERVER["REQUEST_URI"];
$numberofchains = count($arResult);
$mystring = $page;
$findme   = 'index.html';
$pos = strpos($mystring, $findme);
if ($pos === false) {
    //echo "Строка '$findme' не найдена в строке '$mystring1'";
} else {
    //echo "Строка '$findme' найдена в строке '$mystring1'";
    //echo " в позиции $pos";
    $numberofchains = $numberofchains-1;
    //echo "numberofchains=$numberofchains<br />";
}
$discount = 1;
if (strstr($path, '/training/')) { $discount = 2; }
if (strstr($path, '/school/')) { $discount = 2; }
for($index = $numberofchains-$discount, $itemSize = 0; $index >= $itemSize; $index--)
{
	if($index < $numberofchains)
		$strReturn .= ' / ';

	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
		$strReturn .= $title;
}
$strReturn = str_replace("Home", "Учебный Центр Luxoft" ,$strReturn);
$strReturn = str_replace("Главная", "Учебный Центр Luxoft" ,$strReturn);
return $strReturn;
?>

