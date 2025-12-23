<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;
use Local\Util\Functions;

Loc::loadMessages(__FILE__);

/** @var $arParams */
/** @var $arResult */
/** @var $templateFolder */

$this->setFrameMode(false);

if (!empty($arResult['ITEMS'])) : ?>
    <div class="stack_role-title-block">
        <div class="container">
            <?php if($arParams['SPECIAL_TITLE'] !== NULL):?>
                <h2 class="stack_role-h2"><?= htmlspecialcharsBack($arParams['SPECIAL_TITLE']);?></h2>
            <?php endif; ?>
            <?php if($arParams['SPECIAL_DESCRIPTON_1'] !== NULL):?>
                <p class="stack_role-desc"><?= $arParams['SPECIAL_DESCRIPTON_1'];?></p>
            <?php endif; ?>
            <?php if($arParams['SPECIAL_DESCRIPTON_2'] !== NULL):?>
                <p class="stack_role-desc"><?= $arParams['SPECIAL_DESCRIPTON_2'];?></p>
            <?php endif; ?>
        </div>
    </div>
    <div class="stack_role-block-wrap">
        <div class="container stack_role-block">
            <?php foreach ($arResult['ITEMS'] as $key => $item) : ?>
                <?php if ($item['PREVIEW_PICTURE']['SRC']) : ?>
                    <div class="stack_role-item">
                        <div class="stack_role-item-name">
                            <?= $item['NAME'] ?>
                        </div>
                        <div class="stack_role-item-img" style="background-image: url('<?= $item['PREVIEW_PICTURE']['SRC'] ?>')"></div>
                        <div class="stack_role-item-hover">
                            <div class="stack_role-item-name">
                                <?= $item['NAME'] ?>
                            </div>
                            <div class="stack_role-item-text">
                                <?= $item['PREVIEW_TEXT'] ?>
                            </div>
                            <? if($item['PROPERTIES']['BTN_NAME']['VALUE']): ?>
                                <div class="stack_role-item-link">
                                    <a href="<?= $item['PROPERTIES']['BTN_LINK']['VALUE'] ?>">
                                        <?= $item['PROPERTIES']['BTN_NAME']['VALUE'] ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
