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
$this->setFrameMode(true);
?>

<div class="tabs--wrapper">
	<div class="tabs">
		<? foreach ($arResult['SECTIONS'] as $key => &$arSection) {
			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
		?>
			<div class="tabs__item<?=($key==0) ? ' active' : '';?>" id="<?=$arSection['CODE'];?>" data-tab="<?=$arSection['CODE'];?>"><?=$arSection['NAME'];?></div>

		<? }
		unset($arSection);
		?>
	</div>
</div>