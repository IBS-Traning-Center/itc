<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;
use Local\Util\Functions;

Loc::loadMessages(__FILE__);

/** @var $arParams */
/** @var $arResult */
/** @var $templateFolder */

$this->setFrameMode(false);

?>

<div class="subscribe-main-page-block container<?=(!empty($arParams['CUSTOM_CLASSES'])) ? ' '.$arParams['CUSTOM_CLASSES'] : ''?>">
    <div class="main-content-sub">
        <div class="subscribe-block_icon">
            <?= Functions::buildSVG('telegram_icon', $templateFolder . '/images') ?>
        </div>
        <div class="f-32 subscribe-block_title">
            <?= $arResult['SUBSCRIBE_TITLE'] ?: Loc::getMessage('DEFAULT_SUBSCRIBE_TITLE') ?>
        </div>
    </div>
    <a href="<?= $arResult['LINK'] ?: '' ?>" class="btn-main size-l subscribe-btn">
        <span><?= Loc::getMessage('BTN_SUBSCRIBE_TITLE') ?></span>
    </a>
</div>