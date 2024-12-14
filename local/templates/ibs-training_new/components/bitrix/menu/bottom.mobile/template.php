<?php

use \Bitrix\Main\Localization\Loc;
use Local\Util\Functions;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

Loc::loadMessages(__FILE__);

global $USER;

/**
 * @var $arResult
 * @var $arParams
 * @var string $templateFolder
*/

?>
<?php if (!empty($arResult)) : ?>
    <div class="bottom-mobile-menu-block">
        <div class="container bottom-mobile-menu-container">
            <?php foreach ($arResult as $key => $value) : ?>
                <div class="bottom-menu-item-block">
                    <?php switch ($value['PARAMS']['TYPE']) {
                        case 'MAIN_PAGE' : ?>
                            <div class="icon">
                                <?= Functions::buildSVG('main_page_icon', $templateFolder . '/images') ?>
                            </div>
                            <?php break;
                        case 'CATALOG' : ?>
                            <div class="icon">
                                <?= Functions::buildSVG('catalog_icon', $templateFolder . '/images') ?>
                            </div>
                            <?php break;
                        case 'TIME_TABLE' : ?>
                            <div class="icon">
                                <?= Functions::buildSVG('time_icon', $templateFolder . '/images') ?>
                            </div>
                            <?php break;
                    } ?>
                    <a class="f-14 <?= ($value['PARAMS']['TYPE'] == 'CATALOG') ? 'catalog-link' : '' ?>" href="<?= $value['LINK'] ?>"><?= $value['TEXT'] ?></a>
                </div>
            <?php endforeach; ?>
            <div class="bottom-menu-item-block more-links">
                <div class="icon">
                    <?= Functions::buildSVG('more_icon', $templateFolder . '/images') ?>
                </div>
                <span class="f-14"><?= Loc::getMessage('MORE_LINK_TITLE') ?></span>
            </div>
        </div>
    </div>
<?php endif; ?>