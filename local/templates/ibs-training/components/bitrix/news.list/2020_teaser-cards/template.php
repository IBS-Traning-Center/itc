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
<div class="teaser-cards">
    <?foreach ($arResult['ITEMS'] as $arItem) {?>
    <?if(!empty($arItem['PROPERTIES']['LINK']['VALUE'])) {?>
        <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" class="teaser-card">
    <?} else {?>
        <div class="teaser-card">
    <?}?>

        <div class="teaser-card__view">
            <img class="teaser-card__image" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
        </div>
        <div class="teaser-card__title"><?=$arItem['NAME']?></div>
        <div class="teaser-card__subtitle"><?=$arItem['PREVIEW_TEXT']?></div>
    <?if(!empty($arItem['PROPERTIES']['LINK']['VALUE'])) {?>
        </a>
    <?} else {?>
        </div>
    <?}?>
    <?}?>
</div>
<script>
    $(function () {
        $('.teaser-cards').slick({
            arrows: true,
            autoplay: true,
            slidesToShow: <?=(count($arResult['ITEMS']) < 4) ? count($arResult['ITEMS']) : 4?>,
            slidesToScroll: <?=(count($arResult['ITEMS']) < 4) ? count($arResult['ITEMS']) : 4?>,
            autoplaySpeed: 5000,
            responsive: [
                {
                    breakpoint: 1180,
                    settings: {
                        slidesToShow: <?=(count($arResult['ITEMS']) < 3) ? count($arResult['ITEMS']) : 3?>,
                        slidesToScroll: <?=(count($arResult['ITEMS']) < 3) ? count($arResult['ITEMS']) : 3?>,
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: <?=(count($arResult['ITEMS']) < 2) ? count($arResult['ITEMS']) : 2?>,
                        slidesToScroll: <?=(count($arResult['ITEMS']) < 2) ? count($arResult['ITEMS']) : 2?>,
                    }
                },
                {
                    breakpoint: 540,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
            ]
        })
    })
</script>
