<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

// Получаем ID текущего пользователя
global $USER;
$currentUserId = $USER->GetID();
?>
<?php // var_dump($arResult); ?>
<div class="lk-layout">
    <aside class="lk-sidebar">
        <? $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "personal_menu",
            array(
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
        ); ?>
    </aside>

    <div class="lk-content-main">
        <div class="lk-header">
            <h1 class="lk-header__title">Уведомления</h1>
        </div>
        <div class="frame-851213393">
            <div class="lk-content">
                <div class="lk-header-row">
                    <div class="lk-tabs">
                        <?php
                        $currentTab = $_REQUEST['tab'] ?? 'all';
                        $tabs = [
                            'all' => 'Все',
                            'unread' => 'Не прочитанные',
                            'read' => 'Прочитанные'
                        ];
                        foreach($tabs as $code => $name): ?>
                            <button class="lk-tab <?=$currentTab == $code ? 'is-active' : ''?>"
                                    data-tab="<?=$code?>">
                                <?=$name?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="notifications-list">
                    <?php
                    $userItems = [];
                    if(!empty($arResult["ITEMS"])) {
                        foreach($arResult["ITEMS"] as $arItem) {
                            $userId = $arItem["PROPERTIES"]["USER"]["VALUE"];
                            if(is_array($userId)) {
                                $isForCurrentUser = in_array($currentUserId, $userId);
                            } else {
                                $isForCurrentUser = ($userId == $currentUserId);
                            }
                            if(empty($userId)) {
                                $isForCurrentUser = true;
                            }

                            if($isForCurrentUser) {
                                $userItems[] = $arItem;
                            }
                        }
                    }

                    if(!empty($userItems)):
                        ?>
                        <?php foreach($userItems as $arItem): ?>
                        <?php
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
                        $isRead = false;
                        if ($arItem["PROPERTIES"]["IS_READ"]["VALUE"] == 'Y') {
                            $isRead = true;
                        } elseif (isset($_SESSION['VIEWED_NOTIFICATIONS']) &&
                            in_array($arItem['ID'], $_SESSION['VIEWED_NOTIFICATIONS'])) {
                            $isRead = true;
                        }
                        $btnText = $arItem["PROPERTIES"]["BUTTON_TEXT"]["VALUE"];
                        $btnType = $arItem["PROPERTIES"]["BUTTON_TYPE"]["VALUE"] == 'primary' ? 'payment-btn' : 'secondary-btn';
                        $btnLink = $arItem["PROPERTIES"]["LINK"]["VALUE"];
                        $btnPrice = $arItem["PROPERTIES"]["PRICE"]["VALUE"];
                        $btnTarget = $arItem["PROPERTIES"]["TARGET"]["VALUE"] == 'Y' ? '_blank' : '_self';
                        ?>

                        <div class="notification-card <?=$isRead ? 'read' : ''?>"
                             id="<?=$this->GetEditAreaId($arItem['ID']);?>"
                             data-id="<?=$arItem['ID']?>"
                             data-read="<?=$isRead ? 'true' : 'false'?>"
                             data-user-id="<?=$currentUserId?>">

                            <div class="notification-card-top">
                                <div class="notification-title-wrapper">
                                    <?php if(!$isRead): ?>
                                        <div class="dot"></div>
                                    <?php endif; ?>
                                    <h2 class="title"><?=$arItem["NAME"]?></h2>
                                </div>

                                <?php if($arItem["PREVIEW_TEXT"]): ?>
                                    <div class="description">
                                        <?=$arItem["PREVIEW_TEXT"]?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if($btnText): ?>
                                <a href="<?=$btnLink?>"
                                   class="btn <?=$btnType?>"
                                   type="button"
                                   target="<?=$btnTarget?>">
                                    <?=$btnText?>
                                    <?php if($btnPrice): ?> <?=$btnPrice?> ₽<?php endif; ?>
                                </a>
                            <?php endif; ?>

                        </div>
                    <?php endforeach; ?>

                        <?php if($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
                        <?=$arResult["NAV_STRING"]?>
                    <?php endif; ?>

                    <?php else: ?>
                        <div style="text-align: center; padding: 60px 20px; color: #999;">
                            Нет уведомлений
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>