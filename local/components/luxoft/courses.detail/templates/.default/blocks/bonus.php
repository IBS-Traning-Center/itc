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
<div class="course-bonus course-detail__container">
    <div class="course-bonus__header">
        <div class="course-bonus__title"><?=Loc::getMessage('TITLE_BONUS')?></div>
    </div>
    <div class="course-bonus__main">
        <div class="course-bonus__item">
            <div class="course-bonus__item-number">10%</div>
            <div class="course-bonus__item-text"><?=Loc::getMessage('BONUS_INDIVIDUAL')?></div>
        </div>
        <div class="course-bonus__item">
            <div class="course-bonus__item-number">5%</div>
            <div class="course-bonus__item-text"><?=Loc::getMessage('BONUS_PRICE')?></div>
        </div>
        <div class="course-bonus__item">
            <div class="course-bonus__item-number">5%</div>
            <div class="course-bonus__item-text"><?=Loc::getMessage('BONUS_RECOMMENDATION')?></div>
        </div>
    </div>
    <div class="course-bonus__footer">
        <div onclick="window.vueEventBus.$emit('courseDetailModal', '<?=$arResult['scheduleId']?>')"
            class="course-detail__button course-detail__button_h-l course-detail__button_color-orange">
            <span><?=Loc::getMessage('BUTTON_SIGN_UP')?></span>
        </div>
    </div>
</div>
