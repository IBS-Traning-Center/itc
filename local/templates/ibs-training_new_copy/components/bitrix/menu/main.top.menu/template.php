<?php

use Local\Util\Functions;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

global $USER;

?>
<div class="main-top-menu-block">
    <?php if (!empty($arResult)) : ?>
        <?php foreach ($arResult as $key => $value) : ?>
            <?php
            $isCatalog = false;
            $isPersonal = false;

            if (isset($value['PARAMS']['CATALOG']) && $value['PARAMS']['CATALOG'] === 'Y') {
                $isCatalog = true;
            }

            if (strpos($value['LINK'], '/personal/') !== false ||
                (isset($value['PARAMS']['PERSONAL']) && $value['PARAMS']['PERSONAL'] === 'Y')) {
                $isPersonal = true;
            }

            $isLast = (count($arResult) == $key + 1);
            ?>

            <!-- ВСЕ внутри одного контейнера -->
            <div class="main-top-menu-item-container <?= $isPersonal ? 'personal-container' : '' ?>">
                <a href="<?=$value['LINK']?>"
                   class="main-top-menu-item <?= $isLast ? 'last-menu' : '' ?>">

                    <?= ($isCatalog) ? Functions::buildSVG('catalog_icon', $templateFolder . '/images') : '' ?>

                    <?php if (!$isPersonal || !$USER->IsAuthorized()) : ?>
                        <span class="f-16 <?= $isCatalog ? 'catalog-link' : '' ?>"><?=$value['TEXT']?></span>
                    <?php endif; ?>

                    <?php if ($isPersonal) : ?>
                        <span class="profile-icon-right">
                            <?= Functions::buildSVG('profile_icon', $templateFolder . '/images') ?>
                        </span>
                    <?php endif; ?>
                </a>

                <?php if ($isPersonal && $USER->IsAuthorized()) : ?>
                    <!-- Дропдаун теперь внутри того же контейнера -->
                    <div class="profile-dropdown">
                        <a href="<?=$value['LINK']?>" class="dropdown-item">Личный кабинет</a>
                        <a href="?logout=yes&<?=bitrix_sessid_get()?>" class="dropdown-item logout">Выйти</a>
                    </div>
                <?php endif; ?>
            </div>

        <?php endforeach; ?>
    <?php endif; ?>
</div>