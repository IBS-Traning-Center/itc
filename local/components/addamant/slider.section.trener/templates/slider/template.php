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

?>
<?php if (!empty($arResult['ITEMS'])) : ?>
<div class="slider-trener-block"> 
    <div class="slider-trener-menu" id="sliderTrenerContent">
        <?php foreach ($arResult['ITEMS'] as $key => $item) : ?>
            <a href="<?= $item['URL'] ?>" class="slider-trener-menu_item">
                <img src="<?= $item['PICTURE'] ?>">
                <span class="slider-trener-menu_item-text" style="display: none;">
                    <span class="main-name"><?= $item['NAME'] ?></span>
                </span>
            </a>
        <?php endforeach; ?>
        <a href="<?= ($arResult['CATALOG_LINK']) ?: '/training/katalog_kursov/' ?>" class="slider-trener-menu_item all">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                <path d="M8.33594 31.667H3.33594V26.667H8.33594V31.667ZM35.0029 31.667H11.6689V26.667H35.0029V31.667ZM8.33594 21.667H3.33594V16.667H8.33594V21.667ZM28.3359 21.667H11.6689V16.667H28.3359V21.667ZM8.33594 11.667H3.33594V6.66699H8.33594V11.667ZM36.6689 11.667H11.6689V6.66699H36.6689V11.667Z" fill="#2B418B"/>
            </svg>
            <span class="slider-trener-menu_item-text">
                <span class="main-name"><?= Loc::getMessage('ALL_COURSES_TEXT') ?></span>
            </span>
        </a>
    </div>
</div>
<?php endif; ?>