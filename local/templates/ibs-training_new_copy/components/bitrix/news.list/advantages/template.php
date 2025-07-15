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

<section class="advantages">
	<div class="container">
		<div class="row g-4 justify-space-between align-items-flex-start">
			<?foreach($arResult["ITEMS"] as $key => $arItem):
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
				<div class="col-12 col-xl-4">
					<div class="advantages__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<div class="advantages__item__head">
							<div class="advantages__item__key"><?=$key + 1?></div>
	
							<h3 class="advantages__item__title"><?=$arItem['NAME']?></h3>
						</div>

						<ul class="advantages__item__points">
							<?foreach($arItem['PROPERTIES']['POINTS']['VALUE'] as $point) {?>
								<li><?=$point?></li>
							<?}?>
						</ul>

						<a href="<?=$arItem['PROPERTIES']['LINK_HREF']['VALUE']?>"><?=$arItem['PROPERTIES']['LINK_TEXT']['VALUE']?></a>

						<?
						// echo '<pre>';
						// var_dump($arItem['PROPERTIES']['LINK_HREF']);
						// echo '</pre>';
						?>
					</div>
				</div>
			<?endforeach;?>
		</div>
	</div>
</section>