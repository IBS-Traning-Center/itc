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
    <div class="bottom-footer-menu-block">
        <?php foreach ($arResult as $key => $item) : ?>
            <a href="<?= $item['LINK'] ?>" class="f-16"><?= $item['TEXT'] ?></a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>