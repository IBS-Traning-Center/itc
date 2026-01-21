<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;
use Local\Util\Functions;

global $APPLICATION;

Loc::loadMessages(__FILE__);

/** @var $arParams */
/** @var $arResult */
/** @var $templateFolder */

$this->setFrameMode(false);

$defaultImage = $templateFolder . '/images/banner.png';

?>

<div class="main-page-banner-sec-block"> 
    <div class="main-page-heading"><?= Loc::getMessage('TITLE_COURSES_SEC_TEXT')?></div>
    <div class="container">
        <div class="main-page-banner-sec-menu">
            <?php if (!empty($arResult['ITEMS_SORT'])) : ?>
                <?php foreach ($arResult['ITEMS_SORT'] as $key => $item) : ?>
                    <a href="<?= $item['URL'] ?>" class="main-page-banner-sec-menu_item" data-image="<?= $item['IMAGE'] ?: $defaultImage ?>">
                        <span class="main-page-banner-sec-menu_item-text">
                            <span class="main-name"><?= $item['NAME'] ?></span>
                        </span>
                        <span class="main-page-banner-sec-menu_item-icon"><?= Functions::buildSVG('menu_icon', $templateFolder . '/images') ?></span>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
            <a href="<?= ($arResult['CATALOG_LINK']) ?: '/training/katalog_kursov/' ?>" class="main-page-banner-sec-menu_item <?= (empty($arResult['ITEMS_SORT'])) ? 'active' : '' ?>" data-image="<?= $defaultImage ?>">
                <span class="main-page-banner-sec-menu_item-text">
                    <span class="main-name"><?= Loc::getMessage('ALL_COURSES_SEC_TEXT') ?></span>
                </span>
                <span class="main-page-banner-sec-menu_item-icon"><?= Functions::buildSVG('menu_icon', $templateFolder . '/images') ?></span>
            </a>
        </div>
        <div class="main-page-banner-sec-menu-img" style="background-image: url(<?= (!empty($arResult['ITEMS_SORT']) && $arResult['ITEMS_SORT'][0]['IMAGE']) ? $arResult['ITEMS_SORT'][0]['IMAGE'] : $defaultImage ?>)">
        </div>
    </div>
</div>
