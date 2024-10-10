<?php

use Local\Util\Functions;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var $arParams */
/** @var $arResult */
/** @var $templateFolder */

$this->setFrameMode(false);

if (!empty($arResult)) : ?>
    <div class="rules-block">
        <?php foreach ($arResult as $item) : ?>
            <div class="rule-item">
                <div class="rule-info">
                    <span class="f-32"><?= $item['HEADING'] ?: '' ?></span>
                    <div class="icons-block">
                        <div class="arrow">
                            <?= Functions::buildSVG('arrow', $templateFolder . '/images') ?>
                        </div>
                        <div class="minus">
                            <?= Functions::buildSVG('minus', $templateFolder . '/images') ?>
                        </div>
                    </div>
                </div>
                <div class="rules-hidden-block">
                    <p class="f-20"><?= $item['TEXT'] ?: '' ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
