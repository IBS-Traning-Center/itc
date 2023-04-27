<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(false);
?>
<div class="bannercontainer">

<div class="banner">
<ul>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<li <?if (strlen($arItem["PROPERTIES"]["LINK"]["VALUE"])>0) {?>data-link="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>"<?}?> id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="slide1" data-transition="boxfade" data-slotamount="6" data-masterspeed="300">
            <img alt="" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" />
            <?=$arItem["PREVIEW_TEXT"]?>
	</li>
<?endforeach;?>
</ul>
    <div class="tp-bannertimer"></div>
</div>
</div>