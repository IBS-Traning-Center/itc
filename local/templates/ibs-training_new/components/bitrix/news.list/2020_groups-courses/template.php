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
IncludeTemplateLangFile(__FILE__);?>
<div class="groups-courses">
    <div class="groups-courses__list">
        <?foreach ($arResult['ITEMS'] as $arItem) {?>
            <div class="groups-courses__item">
                <div class="groups-courses-item">
                    <div class="groups-courses-item__view" style="background-image: url('<?=$arItem['PREVIEW_PICTURE']['SRC']?>')"></div>
                    <div class="groups-courses-item__info">
                        <div class="groups-courses-item__title"><?=$arItem['~NAME']?></div>
                        <div class="groups-courses-item__hide">
                            <div class="groups-courses-item__subtitle"><?=$arItem['PREVIEW_TEXT']?></div>
                            <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" class="groups-courses-item__link"><?=GetMessage('READ_MORE')?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?}?>
    </div>
</div>
<script>
    $(function () {
        $('.groups-courses__list').slick({
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

