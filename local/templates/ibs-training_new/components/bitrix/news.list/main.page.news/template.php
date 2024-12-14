<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

/** @var $arResult */

$item = $arResult['ITEMS'][0];

if ($item) : ?>
    <div class="container absolute-main-page-container">
        <div class="absolute-main-page-block">
            <span><?= $item['PROPERTIES']['TEXT_FOR_MAIN_PAGE']['VALUE'] ?: $item['NAME'] ?></span>
            <a href="/about/news/<?= $item['CODE'] ?>/" class="absolute-main-page-btn"><?= Loc::getMessage('MORE_INFO_BTN_TEXT') ?></a>
        </div>
    </div>
<?php endif; ?>