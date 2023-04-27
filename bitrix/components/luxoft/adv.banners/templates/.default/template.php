<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$count=count($arResult["BANNERS"]);
$key=rand(0, $count-1);
$arItem=$arResult["BANNERS"][$key];
?>
<a href="<?=$arItem["URL"]?>" target="_blank" title="<?=$arItem["IMAGE_ALT"]?>"><img src="<?=$arItem["IMAGE"]["SRC"]?>" width="<?=$arItem["IMAGE"]["WIDTH"]?>" height="<?=$arItem["IMAGE"]["HEIGHT"]?>"/></a>
