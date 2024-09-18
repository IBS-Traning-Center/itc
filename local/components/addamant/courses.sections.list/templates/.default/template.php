<?php

use Bitrix\Main\Localization\Loc;
use Local\Util\Functions;
use Local\Util\ComponentHelper;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arResult */
/** @var array $arParams */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

Loc::loadMessages(__FILE__);

$defaultImage = $templateFolder . '/images/default_section_img.png';
$defaultImageTable = $templateFolder . '/images/default_table_img.png';

if (!empty($arResult['SECTIONS'])) : ?>
<div class="catalog-sections-main">
    <div class="top-page-banner catalog-page">
        <div class="container">
            <div class="banner-content">
                <?php
                    $helper = new ComponentHelper($component);
                    $helper->deferredCall('ShowNavChain');
                ?>
                <h1><?= $APPLICATION->GetTitle() ?></h1>
                <div class="mobile-button-open-filter btn-main">
                    <span class="f-16"><?= Loc::getMessage('MOBILE_OPEN_FILTER_BTN_TEXT') ?></span>
                </div>
                <?php $currentPage = $APPLICATION->GetCurPage(); ?>
                <div class="sections-tabs-block tabs-by-section">
                    <a href="/catalog/" class="tab <?= ($currentPage == '/catalog/') ? 'active' : '' ?>">
                        <span class="f-16"><?= Loc::getMessage('TAB_TEXT_ALL') ?></span>
                    </a>
                    <a href="/catalog/complex/" class="tab <?= ($currentPage == '/catalog/complex/') ? 'active' : '' ?>">
                        <span class="f-16"><?= Loc::getMessage('TAB_TEXT_COMPLEX') ?></span>
                    </a>
                    <a href="/catalog/direction/" class="tab <?= ($currentPage == '/catalog/direction/') ? 'active' : '' ?>">
                        <span class="f-16"><?= Loc::getMessage('TAB_TEXT_DIRECTION') ?></span>
                    </a>
                </div>
                <div class="filter-block">
                    <div class="sections-tabs-block tabs-by-tags">
                        <div data-code="all" class="tab active all-tags-tab">
                            <span class="f-16"><?= Loc::getMessage('TAB_TEXT_BY_TAG_ALL') ?></span>
                        </div>
                        <?php if ($arResult['FILTER_TABS']) {
                            foreach ($arResult['FILTER_TABS'] as $tab) : ?>
                                <div data-code="<?= $tab['CODE'] ?>" class="tab tab-by-tag">
                                    <span class="f-16"><?= $tab['NAME'] ?></span>
                                </div>
                            <?php endforeach;
                        } ?>
                    </div>
                    <div class="search-course-block">
                        <form action="<?= $currentPage ?>">
                            <input autocomplete="off" type="text" id="search-catalog" name="q" placeholder="Поиск курса" class="search-main">
                            <button type="submit">
                                <?= Functions::buildSVG('search_button', SITE_TEMPLATE_PATH. '/assets/images') ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="sections-block">
        <div class="swap-view-buttons container">
            <div id="defaultViewBtn" class="active">
                <?= Functions::buildSVG('default', $templateFolder . '/images') ?>
            </div>
            <div id="tabletViewBtn">
                <?= Functions::buildSVG('table', $templateFolder . '/images') ?>
            </div>
        </div>
        <?php $APPLICATION->IncludeComponent(
            "addamant:course.with.discount",
            ".default",
            Array(
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "N"
            ),
            $component
        );?>
        <div class="container catalog-sections default">
            <?php foreach ($arResult['SECTIONS'] as $key => $section) : ?>
                <a href="<?= $section['SECTION_PAGE_URL'] ?>" class="section-block">
                    <p class="section_name f-32"><?= $section['NAME'] ?></p>
                    <?php if ($section['DESCRIPTION']) : ?>
                        <p class="section-description f-20"><?= HTMLToTxt($section['DESCRIPTION']) ?></p>
                    <?php endif; ?>
                    <div class="info-section-block">
                        <div class="image-block" style="background-image: url('<?= ($section['PICTURE'] && $section['PICTURE']['SRC']) ? $section['PICTURE']['SRC'] : $defaultImage ?>')"></div>
                        <p class="min-section-price f-24">
                            <?= ($section['PRICE'] > 0) ? 'от ' . $section['PRICE'] . ' ₽' : Loc::getMessage('FREE_COURSE_TEXT') ?>
                        </p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="container catalog-sections table">
            <?php foreach ($arResult['SECTIONS'] as $key => $section) : ?>
                <div class="section-block">
                    <div class="image-block" style="background-image: url('<?= ($section['PICTURE'] && $section['PICTURE']['SRC']) ? $section['PICTURE']['SRC'] : $defaultImageTable ?>')"></div>
                    <div class="info-section-block">
                        <p class="section_name f-32"><?= $section['NAME'] ?></p>
                        <?php if ($section['DESCRIPTION']) : ?>
                            <p class="section-description f-20"><?= HTMLToTxt($section['DESCRIPTION']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="btn-section-block">
                        <p class="min-section-price f-24">
                            <?= ($section['PRICE'] > 0) ? 'от ' . $section['PRICE'] . ' ₽' : Loc::getMessage('FREE_COURSE_TEXT') ?>
                        </p>
                        <a href="<?= $section['SECTION_PAGE_URL'] ?>" class="btn-main size-l">
                            <span class="f-24">Смотреть <?= Functions::numWord($section['ELEMENT_CNT'], ['курс', 'курса', 'курсов']) ?></span>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php $helper->saveCache(); ?>
<?php endif; ?>

<div class="mobile-filter-modal">
    <div class="mobile-filter-modal-content">
        <p class="f-16 f-bold course-type"><?= Loc::getMessage('MOBILE_TEXT_COURSE_TYPE') ?></p>
        <p class="f-16 f-bold course-direction"><?= Loc::getMessage('MOBILE_TEXT_COURSE_DIRECTION') ?></p>
    </div>
    <div class="btn-main apply-filter">
        <span class="f-16"><?= Loc::getMessage('MOBILE_BTN_FILTER_SHOW') ?></span>
    </div>
</div>
<div class="background-modal-filter"></div>