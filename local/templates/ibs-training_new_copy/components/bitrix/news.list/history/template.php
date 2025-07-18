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

<div class="history__list">
	<?foreach($arResult["ITEMS"] as $key => $arItem):
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

		if($key <= 2) {
			?>
			<div class="history__list__item<?=($key == 0) ? ' active' : '';?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<span class="title--h2"><?=$arItem['NAME']?></span>
				<div class="history__list__item__point">
					<span></span>
				</div>
				<p class="f-20"><?=$arItem['PROPERTIES']['LABEL']['VALUE']?></p>
				<div class="history__list__item__text" style="display: none;"><?=$arItem['PREVIEW_TEXT']?></div>
			</div>
			<?
		}
	?>
	<?endforeach;?>
</div>

<div class="history__text d-none d-lg-block" id="history-text">
	<?=$arResult["ITEMS"][0]['PREVIEW_TEXT'];?>
</div>

<div class="history__list">
	<?foreach($arResult["ITEMS"] as $key => $arItem):
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	
		if($key > 2) {
			?>
			<div class="history__list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<?if($arItem['CODE'] == 'infinity'):?>
					<span class="title--h2 infin">&infin;
						<svg viewBox="0 0 68 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="infinity">
							<path d="M67.1228 27.96C67.1228 39 61.1228 47.48 50.8828 47.48C43.6828 47.48 38.6428 44.52 33.9228 34.92C30.0028 42.92 24.5628 47.08 16.8828 47.16C7.52281 47.24 0.882812 39.88 0.882812 28.28C0.882812 17.24 7.36281 9 17.2028 9C23.1228 9 29.2828 11.8 34.2428 21.88C39.0428 12.2 43.6828 9.24 51.0428 9.24C60.5628 9.24 67.1228 16.84 67.1228 27.96ZM6.32281 28.28C6.32281 35.4 10.0028 41.8 17.1228 41.8C22.9628 41.8 27.2828 37.24 31.2828 28.6C27.4428 19.4 23.4428 14.28 17.2828 14.28C10.3228 14.28 6.32281 20.84 6.32281 28.28ZM50.7228 14.6C44.4028 14.6 41.1228 19.56 36.9628 28.28C40.6428 37.16 44.4828 42.12 50.5628 42.12C57.6028 42.12 61.8428 35.72 61.8428 28.36C61.8428 20.76 57.4428 14.6 50.7228 14.6Z" fill="white"/>
						</svg>
					</span>
				<?else:?>
					<span class="title--h2"><?=$arItem['NAME']?></span>
				<?endif;?>

				<div class="history__list__item__point">
					<span></span>
				</div>
				<p class="f-20"><?=$arItem['PROPERTIES']['LABEL']['VALUE']?></p>
				<div class="history__list__item__text" style="display: none;"><?=$arItem['PREVIEW_TEXT']?></div>
			</div>
			<?
		}
	?>
	<?endforeach;?>
</div>