<?php

use \Bitrix\Main\Context;

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */
/** @var string $templateFolder */

$this->setFrameMode(false);

$request = Context::getCurrent()->getRequest();
$codeMap = $request->get('map');

if (!empty($arResult['ITEMS'])) : ?>
    <div class="contacts-maps-block">
        <div class="tabs-block">
            <?php foreach ($arResult['TABS'] as $key => $tab) : ?>
                <div class="tab
                    <?php if ($codeMap && $codeMap == $tab['CODE']) : ?>
                        <?php echo 'active'; ?>
                    <?php endif; ?>
                " data-code="<?= $tab['CODE'] ?>">
                    <span class="f-16"><?= $tab['NAME'] ?></span>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="tab-content">
            <?php foreach ($arResult['ITEMS'] as $key => $item) : ?>
                <div class="tab-content-block
                    <?php if ($codeMap && $codeMap == $item['CODE']) : ?>
                        <?php echo 'active'; ?>
                    <?php endif; ?>
                " data-code="<?= $item['CODE'] ?>">
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

