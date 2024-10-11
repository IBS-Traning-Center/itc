<?php

use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

Loc::loadMessages(__FILE__);

/** @var $arParams */
/** @var $arResult */

$this->setFrameMode(false);

if ($arResult) : ?>
    <div class="roles-block">
        <?php if (!empty($arResult['PICTURES'])) : ?>
            <div class="pictures-block">
                <?php foreach ($arResult['PICTURES'] as $link) : ?>
                    <div class="picture-item">
                        <img src="<?= $link ?>" alt="">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($arResult['ROLES_FIRST'])) : ?>
            <div class="roles-content">
                <p class="f-32 margin-bottom32"><?= Loc::getMessage('ROLES_HEADING') ?></p>
                <ul>
                    <?php foreach ($arResult['ROLES_FIRST'] as $role) : ?>
                        <li class="f-20"><?= $role ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php if (!empty($arResult['ROLES_SECOND'])) : ?>
            <div class="roles-content">
                <p class="f-32 margin-bottom32"><?= Loc::getMessage('ROLES_HEADING') ?></p>
                <ul>
                    <?php foreach ($arResult['ROLES_SECOND'] as $role) : ?>
                        <li class="f-20"><?= $role ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>