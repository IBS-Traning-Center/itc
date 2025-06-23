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


<div class="talent-content talent-grid-block history">
	<h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/about/history_title.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок 25+ лет на рынке']); ?></h2>
	
	<div>
		<div class="get-grid-block">
			<?foreach($arResult["ITEMS"] as $key => $arItem):
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

				if($key <= 2) {
					?>
					<div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<h2>0<?=$key+1?></h2>
						<div class="line-block"></div>
						<p class="f-20"><?=$arItem['PROPERTIES']['LABEL']['VALUE']?></p>
						<div class="d-none item-preview-text"><?=$arItem['PREVIEW_TEXT']?></div>
					</div>
					<?
				}
			?>
			<?endforeach;?>
		</div>

		<div id="history-item-text">
			<!-- preview text... -->
		</div>


		<div class="get-grid-block">
			<?foreach($arResult["ITEMS"] as $key => $arItem):
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

				if($key > 2) {
					?>
					<div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<h2>0<?=$key+1?></h2>
						<div class="line-block"></div>
						<p class="f-20"><?=$arItem['PROPERTIES']['LABEL']['VALUE']?></p>
						<div class="d-none item-preview-text"><?=$arItem['PREVIEW_TEXT']?></div>
					</div>
					<?
				}
			?>
			<?endforeach;?>
		</div>
	</div>

	<div></div>
</div>