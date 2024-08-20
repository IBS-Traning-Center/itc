<?php

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */
/** @var string $templateFolder */

$this->setFrameMode(false);


if (!empty($arResult['ITEMS'])) : ?>
    <div class="contacts-maps-block">
        <div class="tabs-block">
            <?php foreach ($arResult['TABS'] as $key => $tab) : ?>
                <div class="tab <?= $key == 0 ? 'active' : '' ?>" data-code="<?= $tab['CODE'] ?>">
                    <span class="f-16"><?= $tab['NAME'] ?></span>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="tab-content">
            <?php foreach ($arResult['ITEMS'] as $key => $item) : ?>
                <div class="tab-content-block <?= $key == 0 ? 'active' : '' ?>" data-code="<?= $item['CODE'] ?>">
                    <?php if ($item['PREVIEW_TEXT']) : ?>
                        <div class="prev-text">
                            <?= $item['PREVIEW_TEXT'] ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($item['PROPERTIES']['MAP']['VALUE']) : ?>
                        <div class="contact-map-block">
                            <?= $item['PROPERTIES']['MAP']['~VALUE'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

