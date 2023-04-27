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
<div class="course-detail">
    <div class="course-detail__banner">
        <?php require __DIR__.'/blocks/banner.php'; ?>
    </div>
    <div class="course-detail__page-offer">
        <?php require __DIR__.'/blocks/offer.php'; ?>
    </div>
    <div class="course-detail__menu-and-offer">
        <div class="course-menu-and-offer">
            <div class="course-detail__container">
                <div class="course-detail__offer">
                    <?php require __DIR__.'/blocks/offer.php'; ?>
                </div>
                <?php if($arResult['menu']) {?>
                    <div class="course-detail__menu">
                        <?php require __DIR__.'/blocks/menu.php'; ?>
                    </div>
                <?php }?>
            </div>
        </div>
        <?php require __DIR__.'/blocks/menu-and-offer.php'; ?>
    </div>

    <div id="description" class="course-detail__content">
        <?php require __DIR__.'/blocks/content.php'; ?>
    </div>

    <div id="schedule" class="course-detail__schedule"
         <?php if($arResult['category']['picture']){?>style="background-image: url('<?=$arResult['category']['picture']?>')"<?php }?>>
        <?php require __DIR__.'/blocks/schedules.php'; ?>
    </div>

    <?php if($arResult['trainers']) {?>
    <div id="trainers" class="course-detail__trainers">
        <?php require __DIR__.'/blocks/trainers.php'; ?>
    </div>
    <?php }?>

    <?php if($arResult['reviews']) {?>
    <div id="reviews" class="course-detail__reviews">
        <?php require __DIR__.'/blocks/reviews.php'; ?>
    </div>
    <?php }?>

    <?php if($arResult['courses']) {?>
    <div id="courses" class="course-detail__courses">
        <?php require __DIR__.'/blocks/courses.php'; ?>
    </div>
    <?php }?>

    <?php if($arResult['recommended']) {?>
        <div id="recommendations" class="course-detail__recommendations">
            <?php if(is_array($arResult['recommended'])){?>
                <?php require __DIR__.'/blocks/recommendations.php'; ?>
            <?php } else {?>
                <?php require __DIR__.'/blocks/recommended.php'; ?>
            <?php }?>
        </div>
    <?php }?>

    <div class="course-detail__teasers">
        <?php require __DIR__.'/blocks/teasers.php'; ?>
    </div>

    <?php if($arParams['location'] === 'ru') {?>
        <div class="course-detail__bonus">
            <?php require __DIR__.'/blocks/bonus.php'; ?>
        </div>
    <?php }?>
</div>
<div id="courseModal" class="course-modal"></div>
<div id="detailModalMenu"></div>
<script data-skip-moving>
    if(typeof window.vueData === 'undefined') {
        window.vueData = {}
    }

    window.vueData.courseDetail = <?= CUtil::PhpToJSObject($arResult) ?>;
    window.vueData.detailModalMenu = <?= CUtil::PhpToJSObject($arResult['menu']) ?>;
    window.vueData.courseDetail.lang = <?= CUtil::PhpToJSObject([
        'openDate'              =>  Loc::getMessage('FORM_OPEN_DATE'),
        'title'                 =>  Loc::getMessage('FORM_TITLE'),
        'name'                  =>  Loc::getMessage('FORM_NAME'),
        'company'               =>  Loc::getMessage('FORM_COMPANY'),
        'position'              =>  Loc::getMessage('FORM_POSITION'),
        'positionPlaceholder'   =>  Loc::getMessage('FORM_POSITION_PLACEHOLDER'),
        'email'                 =>  Loc::getMessage('FORM_EMAIL'),
        'phone'                 =>  Loc::getMessage('FORM_PHONE'),
        'city'                  =>  Loc::getMessage('FORM_CITY'),
        'comment'               =>  Loc::getMessage('FORM_COMMENT'),
        'register'              =>  Loc::getMessage('FORM_REGISTER'),
        'agree_1'               =>  Loc::getMessage('FORM_AGREE_1'),
        'agree_2'               =>  Loc::getMessage('FORM_AGREE_2'),
        'successTitle'          =>  Loc::getMessage('FORM_SUCCESS_TITLE'),
        'successMessage'        =>  Loc::getMessage('FORM_SUCCESS_MESSAGE'),
        'titleSuccess'          =>  Loc::getMessage('FORM_TITLE_SUCCESS'),
        'titleError'            =>  Loc::getMessage('FORM_TITLE_ERROR'),
        'errorFields'           =>  Loc::getMessage('FORM_ERROR_FIELDS'),
        'errorName'             =>  Loc::getMessage('FORM_ERROR_NAME'),
        'errorCompany'          =>  Loc::getMessage('FORM_ERROR_COMPANY'),
        'errorPosition'         =>  Loc::getMessage('FORM_ERROR_POSITION'),
        'errorEmail'            =>  Loc::getMessage('FORM_ERROR_EMAIL'),
        'errorPhone'            =>  Loc::getMessage('FORM_ERROR_PHONE'),
        'errorCity'             =>  Loc::getMessage('FORM_ERROR_CITY'),
    ]) ?>;
</script>