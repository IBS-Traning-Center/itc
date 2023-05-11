<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(empty($arResult))
	return "";
	//print_r($arResult);
$strReturn = '<div id="breadcrumb"><p>';
for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
{
	if($index > 0)
		$strReturn .= ' \ ';

	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	if(($arResult[$index]["LINK"] <> ""))
		$strReturn .= '<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a>';
	else
		$strReturn .= $title;
}
$strReturn .= '</p></div>';
return $strReturn;
?>

