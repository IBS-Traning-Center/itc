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
    <div class="container">
        <div class="top-news-list-block">
            <h2><?= Loc::getMessage('DETAIL_PAGE_NEWS_LIST_TITLE') ?></h2>
        </div>
        <div class="detail-page-news-list-block">
            <?php foreach ($arResult['ITEMS'] as $key => $item) : ?>
                <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="detail-page-news-list-item <?= ($key % 2) ? 'back-white' : '' ?>">
                    <h2><?= $item['NAME'] ?></h2>
                    <p class="f-32 description-news"><?= strip_tags($item['PREVIEW_TEXT']) ?></p>
                    <div class="bottom-news-item-block">
                        <?php if ($item['TAGS']) : ?>
                            <div class="tags-block">
                                <?php foreach ($item['TAGS'] as $tag) : ?>
                                    <span class="f-16"><?= $tag['UF_NAME'] ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <span class="date-create f-16"><?= $item['DATE_CREATE'] ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
