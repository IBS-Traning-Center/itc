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
<nav class="course-menu">
    <ul class="course-menu__list">
        <?php foreach ($arResult['menu'] as $menuItem) {?>
            <li class="course-menu__item">
                <a href="<?=$menuItem['link']?>" class="course-menu__link"><?=$menuItem['text']?></a>
            </li>
        <?php }?>
    </ul>
    <div class="course-menu__mobile">
        <div class="course-menu__mobile-dropdown">
            <div class="course-menu__mobile-dropdown-select"><?=$arResult['menu'][0]['text']?></div>
            <div class="course-menu__mobile-dropdown-list">
                <?php foreach ($arResult['menu'] as $menuItem) {?>
                    <li class="course-menu__item">
                        <a onclick="" href="<?=$menuItem['link']?>" class="course-menu__link"><?=$menuItem['text']?></a>
                    </li>
                <?php }?>
            </div>
            <div class="course-menu__mobile-dropdown-wrap"></div>
        </div>
        <div class="course-menu__mobile-prices">
            <div class="course-offer__prices">
                <?php if($arResult['sale']['price']) {?>
                    <div class="course-offer__price"><?=$arResult['sale']['priceFormatted']?></div>
                <?php }?>
                <?php if($arResult['sale']['lastPrice']) {?>
                    <div class="course-offer__price-last"><?=$arResult['sale']['lastPriceFormatted']?></div>
                <?php }?>
            </div>
        </div>
        <div class="course-menu__mobile-button">
            <div onclick="window.vueEventBus.$emit('courseDetailModal', '<?=$arResult['scheduleId']?>')" class="course-detail__button course-detail__button_h-l course-detail__button_color-orange">
                <span><?=Loc::getMessage('BUTTON_SIGN_UP_SHORT')?></span>
            </div>
        </div>
    </div>
</nav>