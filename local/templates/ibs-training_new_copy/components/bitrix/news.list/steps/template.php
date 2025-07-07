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


if(!empty($arResult["ITEMS"])): ?>

	<div class="steps__list">
		<?foreach($arResult["ITEMS"] as $key => $arItem) {
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			
			if($key <= 2) {
				?>
				<div class="steps__list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<span class="steps__list__item__number"><?=$arItem['PROPERTIES']['NUMBER']['VALUE']?></span>

					<div class="steps__list__item__point">
						<span></span>
					</div>
					
					<?if(!empty($arItem['PROPERTIES']['REPLACE_TITLE_HTML']['VALUE'])) {?>
						<div class="steps__list__item__title">
							<?=$arItem['PROPERTIES']['REPLACE_TITLE_HTML']['~VALUE']['TEXT'];?>
						</div>
					<?} else {?>
						<div class="steps__list__item__title"><?=$arItem['NAME'];?></div>
					<?}?>
				</div>
				<?
			}?>
		<?}?>
	</div>

	<?if(count($arResult["ITEMS"]) > 3):?>
	<div class="steps__list">
		<?foreach($arResult["ITEMS"] as $key => $arItem) {
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			
			if($key > 2) {
				?>
				<div class="steps__list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<span class="steps__list__item__number"><?=$arItem['PROPERTIES']['NUMBER']['VALUE']?></span>

					<div class="steps__list__item__point">
						<span></span>
					</div>

					<?if(!empty($arItem['PROPERTIES']['REPLACE_TITLE_HTML']['VALUE'])) {?>
						<div class="steps__list__item__title">
							<?=$arItem['PROPERTIES']['REPLACE_TITLE_HTML']['~VALUE']['TEXT'];?>
						</div>
					<?} else {?>
						<div class="steps__list__item__title"><?=$arItem['NAME'];?></div>
					<?}?>
				</div>
				<?
			}?>
		<?}?>
	</div>
	<?endif;?>

<?endif;?>