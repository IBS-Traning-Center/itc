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

	<section class="guarantees">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-6">
					<h2 class="title--h2"><?=$arResult['SECTION_WHY_US']['UF_BLOCK_TITLE']?></h2>
					
					<div class="guarantees__content">
						<?if(!empty($arResult['SECTION_WHY_US']['PICTURE'])) {?>
							<img src="<?=CFile::GetPath($arResult['SECTION_WHY_US']['PICTURE'])?>" alt="<?=$arResult['SECTION_WHY_US']['NAME']?>" class="guarantees__image">
							<?}?>
							<p><?=$arResult['SECTION_WHY_US']['NAME']?></p>
						</div>
					</div>
					
					<div class="col-12 col-lg-6">
						<ul class="guarantees__list">
							<?foreach($arResult["ITEMS"] as $key => $arItem):
								$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
								$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
								
								// echo '<pre>';
								// var_dump($arItem['PROPERTIES']['NUMBER']['VALUE']);
								// echo '</pre>';
						?>
								<li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
									<span><?=$arItem['PROPERTIES']['NUMBER']['VALUE'];?></span>
									<?=$arItem['NAME']?>
								</li>
						<?endforeach;?>
					</ul>
				</div>
			</div>
		</div>
	</section>

<?endif;?>