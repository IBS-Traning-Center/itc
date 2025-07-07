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

<section class="our-services spaces bg--gray">
	<div class="container">
		<h2 class="title--h2"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/about/our-services-title.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></h2>

		<div class="row g-5 justify-content-lg-center">
			<div class="d-none d-lg-block col-5">
				<div class="our-services__image">
					<img src="<?=$arResult["ITEMS"][0]['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arResult["NAME"];?> - фото">
				</div>
			</div>

			<div class="col-12 col-lg-7">
				<div class="our-services__list">
					<?foreach($arResult["ITEMS"] as $key => $arItem):
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
							<a 
							href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" 
							target="_blank" class="our-services__item" 
							id="<?=$this->GetEditAreaId($arItem['ID']);?>"
							data-img="<?=$arItem['PREVIEW_PICTURE']['SRC']?>">
								<span class="d-lg-none">0<?=$key+1?></span>
								<p class="our-services__item__title"><?=$arItem['NAME']?></p>
							</a>
					<?endforeach;?>
				</div>
			</div>
		</div>
	</div>
</section>