<?php

use Local\Util\Functions;
use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var $arResult
 * @var $arParams
 * @var string $templateFolder
*/

Loc::loadMessages(__FILE__);

?>
<?php if (!empty($arResult)) : ?>
    <div class="left-menu-block">
        <?php foreach ($arResult as $key => $item) : ?>
            <?php if ($item['SELECTED']) : ?>
                <div class="left-menu-item selected">
                    <span class="f-16 menu-num"><?= ($key + 1 < 10) ? '0' . $key + 1 : $key + 1 ?></span>
                    <span class="f-20"><?= $item['TEXT'] ?></span>
                </div>
            <?php else : ?>
                <a href="<?= $item['LINK'] ?>" class="left-menu-item">
                    <span class="f-16 menu-num"><?= ($key + 1 < 10) ? '0' . $key + 1 : $key + 1 ?></span>
                    <div class="elems-block">
                        <span class="f-20"><?= $item['TEXT'] ?></span>
                        <?= Functions::buildSVG('arrow_menu', $templateFolder . '/images') ?>
                    </div>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
        <div class="mobile-select-menu-block">
            <span class="f-16"><?= Loc::getMessage('MOBILE_TEXT') ?></span>
            <?= Functions::buildSVG('mobile-icon', $templateFolder . '/images') ?>
        </div>
        <div class="mobile-left-menu-block">
            <?php foreach ($arResult as $key => $item) : ?>
                <?php if ($item['SELECTED']) : ?>
                    <span class="f-20"><?= $item['TEXT'] ?></span>
                <?php else : ?>
                    <a href="<?= $item['LINK'] ?>" class="f-20"><?= $item['TEXT'] ?></a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="background-hidden-mobile-menu"></div>
    </div>
<?php endif; ?>