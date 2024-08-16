<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

/** @var $arResult */
/** @var $templateFolder */

$this->setFrameMode(false);

if (!empty($arResult['ITEMS'])) : ?>
    <div class="best-workers-block">
        <div class="best-workers-default">
            <?php foreach ($arResult['ITEMS'] as $key => $item) : ?>
                <a href="<?= $item['PROPERTIES']['LINK']['VALUE'] ?>" class="best-workers-default_item">
                    <span><?= $item['NAME'] ?></span>
                </a>
            <?php endforeach; ?>
        </div>
        <?php if (!empty($arResult['RETURN_ELEM'])) : ?>
            <a href="<?= $arResult['RETURN_ELEM']['PROPERTIES']['LINK']['VALUE'] ?>" class="best-workers-return-elem">
                <div class="best-workers-return-elem_icon">
                    <span>&#8381;</span>
                </div>
                <span class="best-workers-return-elem_name"><?= $arResult['RETURN_ELEM']['NAME'] ?></span>
            </a>
        <?php endif; ?>
    </div>
<?php endif;