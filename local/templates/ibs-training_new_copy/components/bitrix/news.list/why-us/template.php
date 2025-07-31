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

if($arResult['ITEMS']) :
?>

	<section class="why-us <?=$arParams['CUSTOM_CLASS'];?>">
		<div class="container">
			
			<h2 class="title--h2">
				<?= $arResult["SECTION_NAME"] ?>
			</h2>

			<div class="row g-4 g-xxl-5 justify-content-between">
				<?foreach($arResult["ITEMS"] as $key => $arItem):
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
					<div class="col-12 col-lg-6">
						<div class="why-us__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<?if(!empty($arItem['PROPERTIES']['ICON']['VALUE'])):?>
								<img src="<?=CFile::GetPath($arItem['PROPERTIES']['ICON']['VALUE']);?>" alt="icon">
							<?endif;?>

							<div>
								<?if(!empty($arItem['NAME'])):?>
									<p class="why-us__item__title"><?=$arItem['NAME'];?></p>
								<?endif;?>
		
								<?if(!empty($arItem['PREVIEW_TEXT'])):?>
									<div class="why-us__item__desc"><?=$arItem['PREVIEW_TEXT'];?></div>
								<?endif;?>
							</div>
						</div>
					</div>
				<?endforeach;?>
			</div>
		</div>
	</section>

<?endif;?>