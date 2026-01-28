<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
use Local\Util\Functions;
?>
<div class="lk-layout">
    <aside class="lk-sidebar">
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "personal_menu",
            Array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "left",
                "COMPONENT_TEMPLATE" => "personal_menu",
                "DELAY" => "N",
                "MAX_LEVEL" => "1",
                "MENU_CACHE_GET_VARS" => [],
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "left",
                "USE_EXT" => "N"
            )
        );?> </aside>
    <div class="lk-content-main">
        <div class="lk-header">
            <h1 class="lk-header__title">Уведомления</h1>
        </div>
        <div class="frame-851213393">
            <div class="lk-content">
                <div class="lk-header-row">
                    <div class="lk-tabs">
                        <button class="lk-tab is-active">Все</button>
                        <button class="lk-tab">Не прочитанные</button>
                        <button class="lk-tab">Прочитанные</button>
                    </div>

                </div>
                <div class="notifications-list">
                    <div class="notification-card" data-read="false">
                        <div class="notification-card-top" >
                        <div class="notification-title-wrapper">
                            <div class="dot"></div>
                            <h2 class="title">Близится срок оплаты за курс «Python»</h2>
                        </div>

                        <div class="description">
                            Второй платёж в 12 500 ₽ необходимо внести до 12.09.2025
                        </div>
                        </div>

                        <button class="btn payment-btn" type="button">
                            Оплатить 12 500 ₽ сейчас
                        </button>
                    </div>
                    <div class="notification-card read" data-read="true">
                        <div class="notification-card-top" >
                        <div class="notification-title-wrapper">
                            <h2 class="title">С новым годом!</h2>
                        </div>
                        <div class="description">
                            Поздравляем вас с новым годом и дарим 500 баллов, которые можно потратить на покупку курсов
                        </div>
                        </div>
                        <button class="btn secondary-btn" type="button">
                            Смотреть курсы
                        </button>
                    </div>
                </div>
        </div>
        </div>
        </div>
        </div>
