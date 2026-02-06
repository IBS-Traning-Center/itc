<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

global $USER;
$authModalId = 'auth-modal';
use Bitrix\Sale\Basket;
use Bitrix\Main\Context;

$basket = Basket::loadItemsForFUser(
    \Bitrix\Sale\Fuser::getId(),
    Context::getCurrent()->getSite()
);
$basketItemsCount = $basket->count();

use Local\Util\Functions;
?>
<div class="main-top-menu-block">
    <?php if (!empty($arResult)) : ?>
        <?php foreach ($arResult as $key => $value) : ?>
            <?php
            $isCatalog = false;
            $isPersonal = false;
            $isNotifications = false;
            $isPoints = false;
            $isCart = false;
            $isIconOnly = false;
            $showItem = true;
            $isAboutUs = false;

            if (isset($value['PARAMS']['CATALOG']) && $value['PARAMS']['CATALOG'] === 'Y') {
                $isCatalog = true;
            }
            if (preg_match('~^/personal/?$~', $value['LINK']) ||
                preg_match('~^' . preg_quote(SITE_DIR, '~') . 'personal/?$~', $value['LINK']) ||
                (isset($value['PARAMS']['PERSONAL']) && $value['PARAMS']['PERSONAL'] === 'Y')) {
                $isPersonal = true;
            }

            if ($value['TEXT'] === 'Уведомления') {
                $isNotifications = true;
                $isIconOnly = true;
                $showItem = $USER->IsAuthorized();
            }

            if ($value['TEXT'] === 'Баллы') {
                $isPoints = true;
                $isIconOnly = true;
                $showItem = $USER->IsAuthorized();
            }

            if ($value['TEXT'] === 'Корзина') {
                $isCart = true;
                $isIconOnly = true;
                $showItem = $USER->IsAuthorized();
            }

            if ($value['TEXT'] === 'О нас' || $value['TEXT'] === 'About us' ||
                strpos($value['LINK'], '/about/') !== false) {
                $isAboutUs = true;
            }

            $isLast = (count($arResult) == $key + 1);

            if (!$showItem) continue;
            ?>
            <div class="main-top-menu-item-container <?= $isPersonal ? 'personal-container' : '' ?> <?= $isIconOnly ? 'no-border' : '' ?> <?= $isAboutUs ? 'no-border-right' : '' ?>">
                <?php if ($isPersonal && !$USER->IsAuthorized()) : ?>
                    <a href="javascript:void(0);"
                       class="main-top-menu-item <?= $isLast ? 'last-menu' : '' ?> open-auth-modal"
                       data-modal-id="<?= $authModalId ?>">

                        <span class="f-16"><?=$value['TEXT']?></span>
                        <span class="profile-icon-right">
                            <?= Functions::buildSVG('profile_icon', $templateFolder . '/images') ?>
                        </span>
                    </a>
                <?php else : ?>
                    <a href="<?=$value['LINK']?>"
                       class="main-top-menu-item <?= $isLast ? 'last-menu' : '' ?>">

                        <?= ($isCatalog) ? Functions::buildSVG('catalog_icon', $templateFolder . '/images') : '' ?>

                        <?php if (!$isNotifications && !$isPoints && !$isCart) : ?>
                            <?php if (!$isPersonal || !$USER->IsAuthorized()) : ?>
                                <span class="f-16 <?= $isCatalog ? 'catalog-link' : '' ?>"><?=$value['TEXT']?></span>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if ($isPersonal) : ?>

                            <span class="profile-icon-right">
                                <?= Functions::buildSVG('profile_icon', $templateFolder . '/images') ?>
                            </span>
                        <?php endif; ?>

                        <?php if ($isCart && $USER->IsAuthorized()) : ?>
                            <span class="cart-icon-right">
                                <?php if ($basketItemsCount > 0) : ?>
                                    <?= Functions::buildSVG('cart_icon_full', $templateFolder . '/images') ?>
                                <?php else : ?>
                                    <?= Functions::buildSVG('cart_icon', $templateFolder . '/images') ?>
                                <?php endif; ?>
                            </span>
                            <span class="f-16"><?=$value['TEXT']?></span>

                        <?php endif; ?>

                        <?php if ($isNotifications && $USER->IsAuthorized()) : ?>
                            <span class="notifications-icon-right">
                                <?= Functions::buildSVG('notifications_icon', $templateFolder . '/images') ?>
                            </span>
                        <?php endif; ?>

                        <?php if ($isPoints && $USER->IsAuthorized()) : ?>
                            <span class="points-count-block">
                                <span class="points-count"><?= $arParams['USER_BALANCE'] ?> Б</span>
                            </span>
                        <?php endif; ?>
                    </a>
                <?php endif; ?>

                <?php if ($isPersonal && $USER->IsAuthorized()) : ?>
                    <div class="profile-dropdown">
                        <a href="<?=$value['LINK']?>" class="dropdown-item">Личный кабинет</a>
                        <a href="?logout=yes&<?=bitrix_sessid_get()?>" class="dropdown-item logout">Выйти</a>
                    </div>
                <?php endif; ?>
            </div>

        <?php endforeach; ?>
    <?php endif; ?>
</div>
<div id="<?= $authModalId ?>" class="auth-modal-wrapper" style="display: none;">
    <div class="auth-modal-content">
        <div class="auth-modal-close-btn">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.1302 12.1302L35.8698 35.8698" stroke="black" stroke-width="2"/>
                <path d="M12.1302 35.8698L35.8698 12.1302" stroke="black" stroke-width="2"/>
            </svg>
        </div>

        <div class="auth-modal-body">
            <h2 class="auth-modal-title">Регистрация и вход</h2>
            <div class="auth-tabs">
                <button class="auth-tab auth-tab--register" onclick="switchAuthTab('register')">
                    <span class="auth-tab-text">Регистрация</span>
                </button>
                <button class="auth-tab auth-tab--login active" onclick="switchAuthTab('login')">
                    <span class="auth-tab-text">Вход</span>
                </button>
            </div>
            <div class="tabs-content">
                <div id="tab-register" class="tab-content">
                    <?php
                    $APPLICATION->IncludeComponent(
                        "bitrix:system.auth.registration",
                        "",
                        array(),
                        false
                    );
                    ?>
                </div>
                <div id="tab-login" class="tab-content active">
                    <?php
                    $APPLICATION->IncludeComponent(
                        "bitrix:system.auth.form",
                        "new_auth",
                        array(
                            "REGISTER_URL" => "",
                            "AUTH_FORGOT_PASSWORD_URL" => "/auth/forgot_pass.php",
                            "PROFILE_URL" => "/personal/",
                            "SHOW_ERRORS" => "Y"
                        ),
                        false
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>