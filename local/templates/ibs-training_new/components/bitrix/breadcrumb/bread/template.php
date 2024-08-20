<?php

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @global CMain $APPLICATION
 * @var $arResult
 */

global $APPLICATION;

$strReturn = '';

$strReturn .= '<div class="breadcrumbs">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]['TITLE']);
    $link = $arResult[$index]['LINK'];

	if ($itemSize == $index + 1) {
        $strReturn .= '<span class="f-14">' . $title . '</span>';
    } else {
        $strReturn .= '<a href="' . $link . '">
                <span class="f-14">' . $title . '</span>
                <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 8.5V8.49999L11.2929 7.79288L11.2929 7.79289L6 2.5L5.29289 3.20711L10.5858 8.49999L5.29289 13.7929L6 14.5L11.2929 9.20711L12 8.5Z" fill="black"/>
                </svg>
            </a>';
    }
}
$strReturn .= '</div>';

return $strReturn;
