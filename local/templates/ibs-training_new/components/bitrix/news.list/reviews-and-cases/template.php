<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true){
	die();
}
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

use Bitrix\Main\Localization\Loc;
use Local\Util\Functions;
?>

<section class="reviews">
	<div class="container">
		<h2 class="title--h2"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/reviews-title.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок Отзывов']); ?></h2>
		<a href="/reviews/" target="_blank" class="reviews__link"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/read-all-reviews.php', [], ['MODE' => 'html', 'NAME' => 'Кнопка Читать все отзывы']); ?></a>

		<!-- Slider main container -->
		<div class="reviews__slider">
			<!-- Additional required wrapper -->
			<div class="swiper-wrapper">
			<?foreach($arResult["ITEMS"] as $arItem) :
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				
				?>
				<div class="swiper-slide reviews__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="reviews__item--inner">
						<div class="reviews__item__text">
							<?=$arItem['PREVIEW_TEXT'];?>
							<div class="readmore">
								<span>...</span>&nbsp;<a href="/reviews/" target="_blank" class="link">Читать&nbsp;всё</a>
							</div>
						</div>
					</div>
					<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME'];?>" class="reviews__item__image">
				</div>
			<?endforeach;?>
		</div>
		<!-- If we need pagination -->
		<div class="swiper-pagination"></div>
	</div>
</section>