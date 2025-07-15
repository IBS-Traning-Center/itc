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

if($arResult["ITEMS"]):
?>

	<section class="promo">
		<div class="container">
			<h2 class="title--h2 text-lg-center">
			<?$APPLICATION->IncludeFile(SITE_DIR . 'include/certification/promo-title.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок Акций']); ?>
			
			<?//=$arResult["NAME"];?></h2>

			<div class="row g-4 justify-content-between">
				<?foreach($arResult["ITEMS"] as $key => $arItem):
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
					<div class="col-12 col-xl-4">
						<div class="promo__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt="<?=$arItem['NAME']?>">

							<div>
								<h3 class="promo__item__title"><?=$arItem['NAME']?></h3>
		
								<div class="promo__item__discount"><?=$arItem['PROPERTIES']['DISCOUNT']['VALUE'];?></div>
		
								<div class="promo__item__desc"><?=$arItem['PREVIEW_TEXT']?></div>
							</div>
						</div>
					</div>
				<?endforeach;?>
			</div>
		</div>
	</section>

<?endif;?>