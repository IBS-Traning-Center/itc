<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var $arParams */
/** @var $arResult */

$this->setFrameMode(false);
if ($arResult) : ?>
    <div class="scheme-block">
        <?php foreach ($arResult as $key => $item) : ?>
            <?php $key++; ?>
            <div class="scheme-item">
                <h2 class="scheme-num"><?= ($key < 10) ? '0' . $key : $key ?></h2>
                <div class="scheme-line"></div>
                <div class="scheme-item-content">
                    <?php if ($item['VALUE']) : ?>
                        <span class="f-32 scheme-name"><?= $item['VALUE'] ?></span>
                    <?php endif; ?>
                    <?php if ($item['DESCRIPTION']) : ?>
                        <span class="f-20 scheme-description"><?= $item['DESCRIPTION'] ?></span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>