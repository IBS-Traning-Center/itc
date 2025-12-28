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
                $isPersonal = false;

                // Проверка на каталог
                if (isset($value['PARAMS']['CATALOG']) && $value['PARAMS']['CATALOG'] === 'Y') {
                    $isCatalog = true;
                }

                // Проверка на личный кабинет
                if (strpos($value['LINK'], '/personal/') !== false ||
                    (isset($value['PARAMS']['PERSONAL']) && $value['PARAMS']['PERSONAL'] === 'Y')) {
                    $isPersonal = true;
                }
                ?>
                <?= ($isCatalog) ? Functions::buildSVG('catalog_icon', $templateFolder . '/images') : ''?>
                <span class="f-16 <?=($isCatalog) ? 'catalog-link' : ''?>"><?=$value['TEXT']?></span>
                <?php if ($isPersonal) : ?>
                    <span class="profile-icon-right"><?= Functions::buildSVG('profile_icon', $templateFolder . '/images') ?></span>
                <?php endif; ?>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>