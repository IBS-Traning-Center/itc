<?php

use Local\Util\Functions;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var $arParams */
/** @var $arResult */
/** @var $templateFolder */

$this->setFrameMode(false);

if ($arResult && $arResult['IBLOCK_ELEMENTS_ELEMENT_TESTING_VIDEO_VALUE']) : ?>
    <?php $link = CFile::GetPath($arResult['IBLOCK_ELEMENTS_ELEMENT_TESTING_VIDEO_VALUE']) ?>
    <div class="video-testing">
        <video muted="" loop="" disablepictureinpicture="" webkit-playsinline="" playsinline="" pip="false">
            <source src="<?= $link ?>#t=0.001">
        </video>
        <div class="custom-controls">
            <div class="buttons-block">
                <div class="start-video-btn">
                    <?= Functions::buildSVG('start-btn-icon', $templateFolder . '/images') ?>
                </div>
                <div class="stop-video-btn">
                    <?= Functions::buildSVG('stop-btn-icon', $templateFolder . '/images') ?>
                </div>
            </div>
            <div class="current-video-time">
                <div class="current-video-time_back"></div>
            </div>
        </div>
    </div>
<?php endif; ?>