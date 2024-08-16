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
<div class="categories-courses">
    <?foreach ($arResult['ITEMS'] as $arItem) {?>
        <div class="categories-course">
            <div class="categories-course__title"><?=$arItem['~NAME']?></div>
            <div class="categories-course__list">
                <?foreach ($arItem['PROPERTIES']['CATEGORY_COURSE']['~VALUE'] as $indexCourse => $arCourse) {
                    $link = $arItem['PROPERTIES']['CATEGORY_COURSE']['~DESCRIPTION'][$indexCourse]?>
                    <a href="<?=$link?>" class="categories-course__item"><?=$arCourse?></a>
                <?}?>
            </div>
            <?if(!empty($arItem['PROPERTIES']['LINK']['VALUE'])) {?>
            <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" class="categories-course__link">
                <div class="button _white"><span><?=GetMessage('CATEGORIES_LEARN_MORE')?></span></div>
            </a>
            <?}?>
        </div>
    <?}?>
</div>
<script>
    $(function () {
        $('.categories-courses').on('init', function () {
            function autoHeight() {
                var maxHeight = 0;
                $('.categories-courses .categories-course').each(function () {
                    var $this = $(this),
                        height = $this.height()+parseInt($this.css('paddingTop'))+parseInt($this.css('paddingBottom'));
                    if(maxHeight < height) maxHeight = height;
                })
                $('.categories-courses .categories-course').css('minHeight', maxHeight+'px')
            }
            autoHeight();
            $(window).resize(function () {
                autoHeight();
            })
        })
        $('.categories-courses').slick({
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
