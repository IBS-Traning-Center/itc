<?php
use Bitrix\Main\Localization\Loc;
/**
 * @var CBitrixComponent $this
 * @var array $arParams
 * @var array $arResult
 * @var string $componentPath
 * @var string $componentName
 * @var string $componentTemplate
 * @var string $templateFolder
 * @global CDatabase $DB
 * @global CUser $USER
 * @global CMain $APPLICATION
 **/
?>
<div class="course-banner">
    <div class="course-banner__view <?="course-banner__view_{$arResult['category']['code']}"?>"
    <?php if($arResult['category']['picture']){?>style="background-image: url('<?=$arResult['category']['picture']?>')"<?php }?>></div>
    <div class="course-banner__content course-detail__container">
        <div class="course-banner__title"><?=$arResult['name']?></div>
        <?php if($arResult['content']['shortDescription']) {?>
            <div class="course-banner__description"><?=$arResult['content']['shortDescription']?></div>
        <?php }?>
        <div class="course-banner__teasers">
            <?php if($arResult['duration']) {?>
            <div class="course-banner__teaser">
                <div class="course-banner__teaser-icon">
                    <img src="<?="{$templateFolder}/src/images/course/detail/icons/banner-teaser-2.svg"?>" alt="">
                </div>
                <div class="course-banner__teaser-text"><?=$arResult['duration']?> <?=Loc::getMessage('HOURS')?></div>
            </div>
            <?php }?>
            <?php if($arResult['city']) {?>
            <div class="course-banner__teaser">
                <div class="course-banner__teaser-icon">
                    <img src="<?="{$templateFolder}/src/images/course/detail/icons/banner-teaser-3.svg"?>" alt="">
                </div>
                <div class="course-banner__teaser-text"><?=$arResult['city']?></div>
            </div>
            <?php }?>
            <?php if($arResult['language']) {?>
            <div class="course-banner__teaser">
                <div class="course-banner__teaser-icon">
                    <img src="<?="{$templateFolder}/src/images/course/detail/icons/banner-teaser-4.svg"?>" alt="">
                </div>
                <div class="course-banner__teaser-text"><?=$arResult['language']?></div>
            </div>
            <?php }?>
            <?php if($arResult['code']) {?>
            <div class="course-banner__teaser">
                <div class="course-banner__teaser-icon">
                    <img src="<?="{$templateFolder}/src/images/course/detail/icons/banner-teaser-1.svg"?>" alt="">
                </div>
                <div class="course-banner__teaser-text"><?=$arResult['code']?></div>
            </div>
            <?php }?>
            <?php if($arResult['certificate'] !== 'lt') {?>
                <div class="course-banner__teaser">
                    <div class="course-banner__teaser-icon">
                        <img src="<?="{$templateFolder}/src/images/course/detail/icons/banner-teaser-5.svg"?>" alt="">
                    </div>
                    <div class="course-banner__teaser-text"><?=Loc::getMessage('BANNER_TEASER_CERTIFICATE')?></div>
                </div>
            <?php }?>
        </div>
    </div>
</div>
