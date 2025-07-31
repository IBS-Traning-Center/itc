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
<div class="certifications">
    <div class="certifications__list">
        <?foreach ($arResult['ITEMS'] as $arItem) {?>
            <div class="certifications__item">
                <?php if( !empty($arItem['PROPERTIES']['LINK']['VALUE']) ) {?>
                    <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" class="certifications__item-link">
                <?php }?>
                <img class="certifications__item-img" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
            </div>
        <?}?>
    </div>
</div>
<script>
    $(function () {
        $('.certifications__list').slick({
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
