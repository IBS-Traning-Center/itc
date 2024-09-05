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
    <h3 class="questions-h3"><?= Loc::getMessage('QUESTION_HEAD') ?></h3>  
    <div class="questions-block">
        <?php foreach ($arResult['ITEMS'] as $key => $item) : ?>
            <div class="question-item-name">
                <?= $item['NAME'] ?>
                <div class="arrow"><?= Functions::buildSVG('arrow-right', SITE_TEMPLATE_PATH. '/assets/images/icons')?></div>
                <div class="no-arrow"><?= Functions::buildSVG('no-arrow-right', SITE_TEMPLATE_PATH. '/assets/images/icons')?></div>
            </div>
            <div class="question-item-answer"><?= $item['PREVIEW_TEXT'] ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
