<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach($arResult["ITEMS"] as $key=>$arItem) {?>
    <?$arResult["ITEMS"][$key]["SMALL_PICTURE"]=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>120, 'height'=>42), BX_RESIZE_IMAGE_PROPORTIONAL, true)?>
<?}?>
