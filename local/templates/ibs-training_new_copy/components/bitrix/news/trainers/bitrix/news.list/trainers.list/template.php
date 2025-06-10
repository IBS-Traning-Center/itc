<?php

use Bitrix\Main\Localization\Loc;
use Local\Util\Functions;
use Local\Util\ComponentHelper;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

Loc::loadMessages(__FILE__);
$this->setFrameMode(true);
$currentPage = $APPLICATION->GetCurPage();

?>
<div class="top-page-banner" style="background-color: <?= $APPLICATION->GetPageProperty('BACKGROUND_COLOR_BANNER') ?>">
    <div class="container">
        <div class="banner-content">
            <?php
                $helper = new ComponentHelper($component);
                $helper->deferredCall('ShowNavChain');
            ?>
            <h1><?= $APPLICATION->GetTitle() ?></h1>
        </div>
        <div class="buttons-block-banner">
            <a class="btn-main size-l" data-scroll="mainFeedbackFormBlock">
                <span class="f-24"><?= Loc::getMessage('TAKE_KONS_TEXT') ?></span>
            </a>
        </div>
    </div>
    <div class="container">
        <div class="filter-tags-block">
            <div class="tag-block all-tags active" data-code="all">
                <span class="f-16"><?= Loc::getMessage('ALL_TAGS_FILTER_TEXT') ?></span>
            </div>
            <?php if (!empty($arResult['FILTER_TAGS'])) : ?>
                <?php foreach ($arResult['FILTER_TAGS'] as $tag) : ?>
                    <div class="tag-block" data-code="<?= $tag['UF_XML_ID'] ?>">
                        <span class="f-16"><?= $tag['UF_NAME'] ?></span>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="search-block">
            <form action="<?= $currentPage ?>">
                <input autocomplete="off" type="text" id="search-catalog" name="q" placeholder="Поиск тренера" class="search-main">
                <button type="submit">
                    <?= Functions::buildSVG('search_button', SITE_TEMPLATE_PATH. '/assets/images') ?>
                </button>
            </form>
        </div>
    </div>
</div>
<?php if (!empty($arResult['ITEMS'])) : ?>
    <div class="trainers-block container">
        <?php foreach ($arResult['ITEMS'] as $key => $item) : ?>
            <?php $key++; ?>
            <?php if ($key == 1) : ?>
                <div class="small-trainer-cards-block">
            <?php endif; ?>
            <?php if ($key == 9) : ?>
                <div class="small-trainer-cards-block">
            <?php endif; ?>
            <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="trainer-item">
                <?php if ($item['PREVIEW_PICTURE']['SRC']) : ?>
                    <div class="trainer-image-block">
                        <img src="<?= $item['DETAIL_PICTURE']['SRC'] ?>" alt="<?= $item['NAME'] ?>">
                    </div>
                <?php else : ?>
                    <div class="trainer-image-block no-photo">
                        <span><?= $item['INITIALS'] ?></span>
                    </div>
                <?php endif; ?>
                <div class="info-trainer-block">
                    <p class="f-32"><?= $item['PROPERTIES']['expert_name']['VALUE'] ? $item['NAME'] . ' ' . $item['PROPERTIES']['expert_name']['VALUE'] : $item['NAME']; ?></p>
                    <?php if ($item['PROPERTIES']['expert_title']['VALUE']) : ?>
                        <p class="f-20"><?= $item['PROPERTIES']['expert_title']['VALUE'] ?></p>
                    <?php endif; ?>
                </div>
            </a>
            <?php if ($key == 8) : ?>
                </div>
            <?php endif; ?>
            <?php if ($key == count($arResult['ITEMS'])) : ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <?= $arResult['NAV_STRING'] ?>
    </div>
<?php endif; ?>
<?php $helper->saveCache(); ?>
