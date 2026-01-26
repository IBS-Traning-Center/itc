<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;



$strReturn .= '<div class="breadcrumbs clearfix">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	$nextRef = ($index < $itemSize-2 && $arResult[$index+1]["LINK"] <> ""? ' itemref="bx_breadcrumb_'.($index+1).'"' : '');
	$child = ($index > 0? ' itemprop="child"' : '');
	$arrow = ($index > 0? '<i class="fa fa-angle-right"></i>' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
			
				<a class="breadcrumb-item" href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="url">
					<span itemprop="title">'.$title.'</span>
				</a>
';
	}
	else
	{
		$strReturn .= '
			<a href="javascript:void(0)" class="breadcrumb-item">
				<span>'.$title.'</span>
			</a >';
	}
}
$strReturn .="</div>";

return $strReturn;
