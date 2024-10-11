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
        <?php if($arParams['SPECIAL_TITLE'] == NULL):?>
            <h3 class="our-clients-h3"><?= Loc::getMessage('OUR_CLIENT_HEAD') ?></h3>  
        <? else: ?>
            <h2 class="our-clients-h2"><?= $arParams['SPECIAL_TITLE'];?></h2>
        <?php endif; ?>
        <?php if($arParams['SPECIAL_DESCRIPTON'] !== NULL):?>
            <p class="our-clients-desc"><?= $arParams['SPECIAL_DESCRIPTON'];?></p>
        <?php endif; ?>
    </div>
    <div class="our-clients-block-wrap">
        <div class="container our-clients-block">
            <?php foreach ($arResult['ITEMS'] as $key => $item) : ?>
                <?php if ($item['PREVIEW_PICTURE']['SRC']) : ?>
                    <div class="our-clients-item">
                        <img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $item['NAME'] ?>">
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
