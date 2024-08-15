<?php

use Local\Util\Functions;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

global $USER;

/**
 * @var $arResult
 * @var $arParams
 * @var string $templateFolder
 */

if (!empty($arResult)) : ?>
    <div class="social-footer-menu-block">
    <?php foreach ($arResult as $key => $item) : ?>
        <?php $lowerName = $item['TEXT']; ?>
        <div class="social-footer-menu-icon">
            <?php switch ($lowerName) {
                case 'telegram' :
                    echo Functions::buildSVG('telegram', $templateFolder . '/images');
                    break;
                case 'vk' :
                    echo Functions::buildSVG('vk', $templateFolder . '/images');
                    break;
                case 'whatsapp' :
                    echo Functions::buildSVG('whatsapp', $templateFolder . '/images');
                    break;
            } ?>
        </div>
    <?php endforeach; ?>
    </div>
<?php endif; ?>