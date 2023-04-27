<?php
use Bitrix\Main\Localization\Loc;
/**
 * @var CBitrixComponent $this
 * @var array $arParams
 * @var array $arResult
 * @var string $componentPath
 * @var string $componentName
 * @var string $componentTemplate
 * @global CDatabase $DB
 * @global CUser $USER
 * @global CMain $APPLICATION
 **/
?>
<div class="course-reviews course-detail__container">
    <div class="course-reviews__header">
        <div class="course-reviews__title"><?=Loc::getMessage('TITLE_REVIEWS')?> (<?=$arResult['countReviews']?>)</div>
    </div>
    <div class="course-reviews__main">
        <?php foreach ($arResult['reviews'] as $indexReview => $review) { ?>
            <div class="course-reviews__item <?php if($indexReview > 2) {?>course-reviews__item_hide<?php }?>">
                <div class="course-reviews-item">
                    <div class="course-reviews-item__content"><?=$review['text']?></div>
                    <div class="course-reviews-item__author"><?=$review['name']?></div>
                </div>
            </div>
        <?php }?>
    </div>
    <?php if(count($arResult['reviews']) > 2) {?>
        <a href="#" class="js_show-all-reviews course-detail__button course-detail__button_h-s course-detail__button_color-white"
           data-alternative-text="<?=Loc::getMessage('HIDE_ALL_REVIEWS')?>">
            <span><?=Loc::getMessage('SHOW_ALL_REVIEWS')?></span>
        </a>
    <?php }?>
</div>