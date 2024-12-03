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

?>
<div class="main-top-menu-block">
    <?php if (!empty($arResult)) : ?>
        <?php foreach ($arResult as $key => $value) : ?>
            <a href="<?=$value['LINK']?>" class="main-top-menu-item <?= (count($arResult) == $key + 1) ? 'last-menu' : '' ?>">
                <?php
                $isCatalog = false;

                if ($value['PARAMS']['CATALOG'] === 'Y') {
                    $isCatalog = true;
                }
                ?>
                <?= ($isCatalog) ? Functions::buildSVG('catalog_icon', $templateFolder . '/images') : ''?>
                <span class="f-16 <?=($isCatalog) ? 'catalog-link' : ''?>"><?=$value['TEXT']?></span>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>