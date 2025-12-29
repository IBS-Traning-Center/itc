<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var $arResult
 * @var $arParams
 * @var string $templateFolder
*/

global $USER;
?>
<?php if (!empty($arResult)) : ?>
    <div class="hidden-bottom-mobile-menu-block">
        <div class="container hidden-bottom-mobile-menu-container">
            <?php foreach ($arResult as $key => $value) : 
                if($value['PARAMS']['HIDE_AUTH'] == 'Y' && !$USER->IsAuthorized()){
                    continue;
                }?>
                <a href="<?= $value['LINK'] ?>" class="hidden-bottom-mobile-menu-item">
                    <span class="f-20"><?= $value['TEXT'] ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="background-hidden-mobile-menu"></div>
<?php endif; ?>