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
$this->setFrameMode(true); ?>
<div class="main-slider">
    <div class="main-slider__list">
        <?foreach ($arResult['ITEMS'] as $arItem) {?>
            <?if(!empty($arItem['PROPERTIES']['LINK']['VALUE'])) {?>
                <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" class="main-slider__item">
            <?} else {?>
                <div class="main-slider__item">
            <?}?>
                <div class="main-slider__view">
                    <?if(empty($arItem['PROPERTIES']['VIDEO']['VALUE'])) {?>
                        <picture class="main-slider__picture">
                            <source class="main-slider__image" srcset="<?=$arItem['PREVIEW_PICTURE']['MOBILE_SRC']?>" media="(max-width: 767px)">
                            <img class="main-slider__image" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
                        </picture>
                    <?} else {?>
                        <video poster="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" loop autoplay muted onload="this.play()">
                            <source src="<?=CFile::getPath($arItem['PROPERTIES']['VIDEO']['VALUE'])?>" type="video/mp4">
                        </video>
                    <?}?>
                </div>
                <div class="main-slider__info section-box__content">
                    <div class="section-box__inner">
                        <?if(!empty($arItem['PROPERTIES']['TITLE']['~VALUE'])) {?>
                        <div class="main-slider__title" <?if(!empty($arItem['PROPERTIES']['TEXT_COLOR']['VALUE'])) {?>style="color:<?=$arItem['PROPERTIES']['TEXT_COLOR']['VALUE']?>"<?}?>
                        ><?=$arItem['PROPERTIES']['TITLE']['~VALUE']?></div><?}?>
                        <?if(!empty($arItem['PREVIEW_TEXT'])){?><div class="main-slider__description" <?if(!empty($arItem['PROPERTIES']['TEXT_COLOR']['VALUE'])) {?>style="color:<?=$arItem['PROPERTIES']['TEXT_COLOR']['VALUE']?>"<?}?>
                            ><?=$arItem['PREVIEW_TEXT']?></div><?}?>
                    </div>
                </div>
            <?if(!empty($arItem['PROPERTIES']['LINK']['VALUE'])) {?>
                </a>
            <?} else {?>
                </div>
            <?}?>
        <?}?>
    </div>
</div>
