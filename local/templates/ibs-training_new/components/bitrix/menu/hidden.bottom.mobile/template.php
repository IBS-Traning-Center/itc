<?php

use Local\Util\Functions;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var $arResult
 * @var $arParams
 * @var string $templateFolder
 */

global $USER, $APPLICATION;
$authModalId = 'auth-modal';

?>
<?php if (!empty($arResult)) : ?>
    <div class="hidden-bottom-mobile-menu-block">
        <div class="container hidden-bottom-mobile-menu-container">
            <?php foreach ($arResult as $key => $value) :
                $isCatalog = false;
                $isPersonal = false;

                if (isset($value['PARAMS']['CATALOG']) && $value['PARAMS']['CATALOG'] === 'Y') {
                    $isCatalog = true;
                }

                if (strpos($value['LINK'], '/personal/') !== false ||
                    (isset($value['PARAMS']['PERSONAL']) && $value['PARAMS']['PERSONAL'] === 'Y')) {
                    $isPersonal = true;
                }

                $isLast = (count($arResult) == $key + 1);

                if($value['PARAMS']['HIDE_AUTH'] == 'Y' && !$USER->IsAuthorized()){
                    continue;
                }
                
                $isPersonal = (strpos($value['LINK'], '/personal/') !== false || 
                             (isset($value['PARAMS']['PERSONAL']) && $value['PARAMS']['PERSONAL'] === 'Y'));
                
                if ($isPersonal && !$USER->IsAuthorized()) : ?>
                    <a href="javascript:void(0);" class="hidden-bottom-mobile-menu-item open-auth-modal" data-modal-id="<?= $authModalId ?>">
                        <span class="f-20"><?= $value['TEXT'] ?></span>
                    </a>
                <?php else : ?>
                    <a href="<?= $value['LINK'] ?>" class="hidden-bottom-mobile-menu-item">
                        <span class="f-20"><?= $value['TEXT'] ?></span>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="background-hidden-mobile-menu"></div>

    
<?php endif; ?>