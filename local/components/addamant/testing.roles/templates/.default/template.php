<?php

use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

Loc::loadMessages(__FILE__);

/** @var $arParams */
/** @var $arResult */

$this->setFrameMode(false);

// echo '<pre>';
// var_dump($arResult);
// echo '</pre>';
?>
<div class="tabs--wrapper">
    <div class="tabs">
        <div class="tabs__item active" data-tab="langs"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/expertise-tabs/1.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок 1']); ?></div>
        <div class="tabs__item" data-tab="roles"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/expertise-tabs/2.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок 2']); ?></div>
        <div class="tabs__item" data-tab="standarts"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/expertise-tabs/3.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок 3']); ?></div>
    </div>
</div>

<!-- <div class="testing-content-block"> -->

<?
if ($arResult) : ?>
    <!-- <div class="roles-block"> -->
        <?php if (!empty($arResult['PICTURES'])) : ?>
            <div class="pictures-block" data-code="langs">
                <?php foreach ($arResult['PICTURES'] as $link) : ?>
                    <div class="picture-item">
                        <img src="<?= $link ?>" alt="">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div data-code="roles" style="display: none;">
            <?php if (!empty($arResult['ROLES_FIRST'])) : ?>
                <div class="roles-content">
                    <!-- <p class="f-32 margin-bottom32"><?//= Loc::getMessage('ROLES_HEADING') ?></p> -->
                    <ul>
                        <?php foreach ($arResult['ROLES_FIRST'] as $role) : ?>
                            <li class="f-20"><?= $role ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?/*php if (!empty($arResult['ROLES_SECOND'])) : ?>
                <div class="roles-content">
                    <!-- <p class="f-32 margin-bottom32"><?//= Loc::getMessage('ROLES_HEADING') ?></p> -->
                    <ul>
                        <?php foreach ($arResult['ROLES_SECOND'] as $role) : ?>
                            <li class="f-20"><?= $role ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; */?>
        </div>

        <div data-code="standarts" style="display: none;" class="tabs-wrapper expertise__images">
            <?$APPLICATION->IncludeFile(
                SITE_DIR . 'include/testing-new/standarts-tab.php', 
                [], ['MODE' => 'html', 'NAME' => 'Контент табы Наши стандарты']);
            ?>
        </div>
    <!-- </div> -->
<?php endif; ?>

<!-- </div> -->