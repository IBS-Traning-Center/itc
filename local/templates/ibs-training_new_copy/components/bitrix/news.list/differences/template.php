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


<div class="row g-32 justify-content-between">
	<?foreach($arResult["ITEMS"] as $key => $arItem):
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
		<div class="col-12 col-lg-6<?=($key == 2) ? ' lastitem' : ''?>">
			<div class="differences__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<?if(!empty($arItem['PROPERTIES']['ICON']['VALUE'])):?>
					<img src="<?=CFile::GetPath($arItem['PROPERTIES']['ICON']['VALUE']);?>" alt="иконка" class="differences__item__icon">
				<?endif;?>

				<div class="differences__item__content">
					<?if(!empty($arItem['NAME']) && $arItem['NAME'] != ' '):?>
						<h3 class="differences__item__title"><?=$arItem['NAME']?>
					<?endif;?>
						<?if(!empty($arItem['PROPERTIES']['LABEL']['VALUE'])):?>
							<span class="differences__item__label"><?=$arItem['PROPERTIES']['LABEL']['VALUE']?></span>
						<?endif;?>
					<?if(!empty($arItem['NAME']) && $arItem['NAME'] != ' '):?>
						</h3>
					<?endif;?>

					<?if(!empty($arItem['PROPERTIES']['STICKER']['VALUE'])):?>
						<p class="differences__item__sticker"><?=$arItem['PROPERTIES']['STICKER']['VALUE']?></p>
					<?endif;?>

					<?if(!empty($arItem['PREVIEW_TEXT'])):?>
						<div class="differences__item__text">
							<?=$arItem['PREVIEW_TEXT'];?>
						</div>
					<?endif;?>

					<?if(!empty($arItem['DETAIL_TEXT'])):?>
						<div class="differences__item__desc">
							<div class="differences__item__desc__modal">
								<span class="modal--close"></span>
								<?=$arItem['DETAIL_TEXT'];?>
							</div>
						</div>
					<?endif;?>
				</div>
			</div>
		</div>
	<?endforeach;?>
</div>