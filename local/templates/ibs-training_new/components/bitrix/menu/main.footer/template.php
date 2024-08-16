<?php

use Local\Util\Functions;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

global $USER;

/**
 * @var $arResult
 * @var $arParams
 * @var string $templateFolder
 */

if (!empty($arResult)) : ?>
    <div class="main-footer-menu-block">
        <?php foreach ($arResult as $key => $item) : ?>
            <?php if ($item['PARAMS']['TITLE'] === 'Y') : ?>
                <?php if ($key != 0) : ?>
                    </div>
                <?php endif; ?>
                <div class="main-footer-menu-item <?= ($item['PARAMS']['OFFICE'] === 'Y') ? 'office-block' : '' ?>">
                    <span class="f-16 f-bold"><?= $item['TEXT'] ?></span>
            <?php endif; ?>
            <?php if ($item['PARAMS']['TITLE'] !== 'Y') : ?>
                <a href="<?= $item['LINK'] ?>" class="f-16"><?= $item['TEXT'] ?></a>
            <?php endif; ?>
            <?php if ($key + 1 == count($arResult)) : ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>