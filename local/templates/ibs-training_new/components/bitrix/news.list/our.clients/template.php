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

if (!empty($arResult['ITEMS'])) : ?>
    <div class="container">
        <h3 class="our-clients-h3"><?= Loc::getMessage('OUR_CLIENT_HEAD') ?></h3>
    </div>
    <div class="container our-clients-block">
        <?php foreach ($arResult['ITEMS'] as $key => $item) : ?>
            <?php if ($item['PREVIEW_PICTURE']['SRC']) : ?>
                <div class="our-clients-item">
                    <img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $item['NAME'] ?>">
                </div>
            <?php else : ?>
                <div class="our-clients-item">
                    <span><?= $item['NAME'] ?></span>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
