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
                <div class="main-footer-menu-item <?= ($item['PARAMS']['OFFICE'] === 'Y') ? 'office-block' : '' ?> <?= ($item['PARAMS']['CERTIFICATE'] === 'Y') ? 'certificate-block' : '' ?> ">
                    <span class="f-16 f-bold"><?= $item['TEXT'] ?></span>
            <?php endif; ?>
            <?php if ($item['PARAMS']['TITLE'] !== 'Y') : ?>
                <?php if ($item['PARAMS']['PHONE'] === 'Y') : ?>
                    <a href="tel:<?= preg_replace('![^0-9]+!', '', $item['LINK']) ?>" class="f-16"><?= $item['TEXT'] ?></a>
                <?php elseif ($item['PARAMS']['MAIL'] === 'Y') : ?>
                    <a href="mailto:<?= $item['TEXT'] ?>" class="f-16"><?= $item['TEXT'] ?></a>
                <?php elseif ($item['PARAMS']['IMG']) : ?>
                    <div class="image">
                        <span class="f-16"><?= $item['TEXT'] ?></span>
                        <a href="<?= $item['LINK'] ?>" target="_blank"><img src="<?= $item['PARAMS']['IMG'] ?>"></a>
                    </div>
                <?php else : ?>
                    <a href="<?= $item['LINK'] ?>" class="f-16"><?= $item['TEXT'] ?></a>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($key + 1 == count($arResult)) : ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>