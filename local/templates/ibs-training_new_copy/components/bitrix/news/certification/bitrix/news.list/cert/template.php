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

<section class="certificates-list">
	<div class="container">
		<div class="row g-3 g-lg-4 align-items-stretch">
			<?foreach($arResult["ITEMS"] as $arItem):
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="col-12 col-lg-4">
					<a href="<?=(!empty($arItem['PROPERTIES']['LINK']['VALUE'])) ? $arItem['PROPERTIES']['LINK']['VALUE'] : $arItem['DETAIL_PAGE_URL'];?>" class="certificates-list__item">
						<div class="certificates-list__item__title">
							<?=$arItem['PROPERTIES']['HTML_TITLE']['~VALUE']['TEXT']?>
							<span class="link">Подробнее</span>
						</div>
						<img src="<?=CFile::GetPath($arItem['PROPERTIES']['FRONT_ICON']['VALUE'])?>" alt="<?=$arItem['NAME']?>">
					</a>
				</div>
			<?endforeach;?>
		</div>
	</div>
</section>