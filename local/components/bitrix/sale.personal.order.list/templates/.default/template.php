<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

function loadBasketProperties($orderId) {
    $basketItems = [];

    CModule::IncludeModule("sale");

    $dbBasket = CSaleBasket::GetList(
        array(),
        array("ORDER_ID" => $orderId),
        false,
        false,
        array("*")
    );

    while ($arItem = $dbBasket->Fetch()) {
        $dbProps = CSaleBasket::GetPropsList(
            array("SORT" => "ASC"),
            array("BASKET_ID" => $arItem["ID"]),
            false,
            false,
            array("*")
        );

        $props = [];
        while ($arProp = $dbProps->Fetch()) {
            $props[$arProp["CODE"]] = $arProp["VALUE"];
        }

        $arItem["BASKET_PROPS"] = $props;
        $basketItems[] = $arItem;
    }

    return $basketItems;
}

if (!empty($arResult['ORDERS'])) {
    foreach ($arResult['ORDERS'] as $key => $order) {
        $orderId = $order['ORDER']['ID'];
        $basketItemsWithProps = loadBasketProperties($orderId);

        foreach ($order['BASKET_ITEMS'] as $itemKey => $item) {
            foreach ($basketItemsWithProps as $basketItemWithProps) {
                if ($basketItemWithProps['ID'] == $item['ID']) {
                    $arResult['ORDERS'][$key]['BASKET_ITEMS'][$itemKey]['BASKET_PROPS'] = $basketItemWithProps['BASKET_PROPS'];
                    break;
                }
            }
        }
    }
}

$filterHistory = $_REQUEST['filter_history'] ?? 'N';
$showCanceled = $_REQUEST['show_canceled'] ?? 'N';
$showAll = $_REQUEST['show_all'] ?? 'N';

$activeTab = 'active';
if ($showCanceled === 'Y') {
    $activeTab = 'canceled';
} elseif ($filterHistory === 'Y') {
    $activeTab = 'completed';
} elseif ($showAll === 'Y') {
    $activeTab = 'all';
}


$canceledStatuses = ['CA'];
$completedStatuses = ['CO', 'F'];
$shippedStatuses = ['DF'];
$waitingStatuses = ['DN'];
$acceptedStatuses = ['N'];
$returnStatuses = ['OV'];


if (!empty($arResult['ORDERS']) && $activeTab !== 'all') {
    $filteredOrders = [];

    foreach ($arResult['ORDERS'] as $order) {
        $statusId = $order['ORDER']['STATUS_ID'];
        $isCanceled = $order['ORDER']['CANCELED'] === 'Y';

        switch ($activeTab) {
            case 'canceled':
                if ($isCanceled || $statusId === 'CA') {
                    $filteredOrders[] = $order;
                }
                break;

            case 'completed':
                if (in_array($statusId, $completedStatuses) && !$isCanceled) {
                    $filteredOrders[] = $order;
                }
                break;

            case 'active':
                if (!$isCanceled &&
                    !in_array($statusId, $completedStatuses) &&
                    !in_array($statusId, $canceledStatuses)) {
                    $filteredOrders[] = $order;
                }
                break;
        }
    }

    $arResult['ORDERS'] = $filteredOrders;
}
?>
<div class="lk-layout">
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
            );?>
        </aside>

        <div class="lk-content-main">
            <div class="lk-header">
                <h1 class="lk-header__title">Мои заказы</h1>
            </div>

            <div class="personal-orders-wrapper">
                <div class="orders-top-panel">
                    <div class="status-tags">
                        <a href="?show_all=Y" class="tag <?=($activeTab === 'all') ? 'active' : ''?>">
                            Все
                        </a>
                        <a href="?filter_history=N&show_canceled=N" class="tag <?=($activeTab === 'active') ? 'active' : ''?>">
                            Активные
                        </a>
                        <a href="?filter_history=Y&show_canceled=N" class="tag <?=($activeTab === 'completed') ? 'active' : ''?>">
                            Пройденные
                        </a>
                        <a href="?show_canceled=Y&filter_history=N" class="tag <?=($activeTab === 'canceled') ? 'active' : ''?>">
                            Отменённые
                        </a>
                    </div>

                    <div class="rules-section">
                        <a href="#" class="rules-link">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 18H18V10H9V13L4 9.5L9 6V9H19V18Z" fill="#2B418B"/>
                            </svg>
                            Правила отмены заказов
                        </a>
                    </div>
                </div>
                <?php if (empty($arResult['ORDERS'])): ?>

                    <div class="empty-state">
                        <h3>
                            <?php if ($activeTab === 'canceled'): ?>
                                <?=Loc::getMessage('SPOL_TPL_EMPTY_CANCELED_ORDER')?>
                            <?php elseif ($activeTab === 'completed'): ?>
                                <?=Loc::getMessage('SPOL_TPL_EMPTY_HISTORY_ORDER_LIST')?>
                            <?php else: ?>
                                <?=Loc::getMessage('SPOL_TPL_EMPTY_ORDER_LIST')?>
                            <?php endif; ?>
                        </h3>
                        <a href="<?=htmlspecialcharsbx($arParams['PATH_TO_CATALOG'] ?? '/catalog/')?>">Перейти в каталог курсов →</a>
                    </div>
                <?php else: ?>
                    <div class="orders-list">
                        <?php foreach ($arResult['ORDERS'] as $order): ?>
                            <?php

                            $orderData = $order['ORDER'];
                            $basketItems = $order['BASKET_ITEMS'] ?? [];
                            $payments = $order['PAYMENT'] ?? [];
                            $isCanceled = $orderData['CANCELED'] === 'Y' || $orderData['STATUS_ID'] === 'CA';
                            $isCompleted = in_array($orderData['STATUS_ID'], $completedStatuses) && !$isCanceled;
                            $isShipped = $orderData['STATUS_ID'] === 'DF' && !$isCanceled;
                            $isWaiting = $orderData['STATUS_ID'] === 'DN' && !$isCanceled;
                            $isAccepted = $orderData['STATUS_ID'] === 'N' && !$isCanceled;
                            $isPaid = false;

                            if (!$isCanceled && !$isCompleted && !empty($payments)) {
                                foreach ($payments as $payment) {
                                    if ($payment['PAID'] === 'Y') {
                                        $isPaid = true;
                                        break;
                                    }
                                }
                            }
                            $dateInsert = $orderData['DATE_INSERT_FORMATED'] ?? FormatDate('d.m.Y', MakeTimeStamp($orderData['DATE_INSERT']));
                            $dateStatus = $orderData['DATE_STATUS_FORMATED'] ?? FormatDate('d.m.Y', MakeTimeStamp($orderData['DATE_STATUS']));
                            if ($isCanceled) {
                                $displayDate = FormatDate('d F Y', MakeTimeStamp($orderData['DATE_INSERT']));
                            } elseif ($isCompleted) {
                                $statusText = ($orderData['STATUS_ID'] === 'CO') ? 'Курс прошёл' : 'Заказ выполнен';
                                $displayDate = $statusText . ' ' . FormatDate('d F Y', MakeTimeStamp($orderData['DATE_STATUS']));
                            } elseif ($isShipped) {
                                $displayDate = 'Отгружен ' . FormatDate('d F Y', MakeTimeStamp($orderData['DATE_STATUS']));
                            } else {
                                $displayDate = FormatDate('d F', MakeTimeStamp($orderData['DATE_INSERT'])) . ' — ' . FormatDate('d F Y', MakeTimeStamp($orderData['DATE_STATUS']));

                                $tsInsert = MakeTimeStamp($orderData['DATE_INSERT']);
                                if ($tsInsert > time()) {
                                    $daysDiff = ceil(($tsInsert - time()) / 86400);
                                    $daysWord = $daysDiff . ' ' . ($daysDiff == 1 ? 'день' : ($daysDiff < 5 ? 'дня' : 'дней'));
                                    $displayDate .= ' (через ' . $daysWord . ')';
                                }
                            }

                            foreach ($basketItems as $item):
                                $basketProps = isset($item['BASKET_PROPS']) ? $item['BASKET_PROPS'] : [];


                                $paymentStatus = 'Ожидает оплаты';
                                $badgeClass = 'warning';
                                $buttonText = 'Перейти к оплате';
                                $buttonClass = 'primary';
                                $buttonLink = $orderData['URL_TO_DETAIL'];

                                if ($isCanceled) {
                                    $paymentStatus = 'Отменено';
                                    $badgeClass = 'error';
                                    $buttonText = 'Смотреть похожие курсы';
                                    $buttonClass = 'secondary';
                                    $buttonLink = $arParams['PATH_TO_CATALOG'] ?? '/catalog/';
                                } elseif ($isCompleted) {
                                    if ($orderData['STATUS_ID'] === 'CO') {
                                        $paymentStatus = 'Пройден';
                                    } else {
                                        $paymentStatus = 'Выполнен';
                                    }
                                    $badgeClass = 'success';
                                    $buttonText = 'Смотреть материалы';
                                    $buttonClass = 'secondary';
                                } elseif ($isShipped) {
                                    $paymentStatus = 'Отгружен';
                                    $buttonText = 'Перейти к заказу';
                                    $buttonClass = 'secondary';
                                } elseif ($isPaid) {
                                    $paymentStatus = 'Оплачено';
                                    $buttonText = 'Перейти к курсу';
                                    $buttonClass = 'secondary';
                                } elseif ($isWaiting) {
                                    $paymentStatus = 'Ожидает обработки';
                                } elseif ($isAccepted) {
                                    $paymentStatus = 'Ожидает оплаты';
                                }
                                $courseName = $item['NAME'] ?? 'Название курса';
                                $courseLevel = $item['NOTES'] ?? ($properties['LEVEL']['VALUE'] ?? 'Уровень «Профессионал»');
                                $coursePrice = SaleFormatCurrency($item['PRICE'], $item['CURRENCY']);
                                $courseImage = $item['DETAIL_PICTURE'] ??
                                    $item['PREVIEW_PICTURE'] ??
                                    ($properties['PICTURE']['VALUE'] ??
                                        ($properties['PREVIEW_PICTURE']['VALUE'] ??
                                            '/local/components/bitrix/sale.personal.order.list/templates/.default/images/order.svg'));


                                ?>
                                <div class="order-card-cont">
                                    <div class="order-card <?=$isCanceled ? 'canceled' : ''?>">
                                        <?php if ($hasDiscount && !$isCanceled && floatval($item['DISCOUNT_PRICE']) > 0): ?>
                                            <div class="discount-badge">
                                                <span class="icon icon-close"></span>
                                                <span>Скидка</span>
                                            </div>
                                        <?php endif; ?>

                                        <div class="card-image">
                                            <img src="<?=htmlspecialcharsbx($courseImage)?>" alt="<?=htmlspecialcharsbx($courseName)?>">
                                        </div>

                                        <div class="card-content">

                                            <div class="card-info">
                                                <div class="card-meta">
                                                    <div class="mob-cont">
                                                    <div class="order-number-badge">
                                                        №<?=htmlspecialcharsbx($orderData['ACCOUNT_NUMBER'])?>
                                                    </div>
                                                    <div class="mob">
                                                        <?php if (!$isCanceled && !$isCompleted && !$isShipped && in_array($orderData['STATUS_ID'], ['N', 'DN', /* добавьте другие разрешённые статусы */])): ?>
                                                            <button
                                                                    class="cancel-item-btn"
                                                                    data-basket-id="<?= $item['ID'] ?>"
                                                                    data-order-id="<?= $orderData['ID'] ?>"
                                                                    data-order-number="<?= htmlspecialcharsbx($orderData['ACCOUNT_NUMBER']) ?>"
                                                                    data-course-name="<?= htmlspecialcharsbx($courseName) ?>"
                                                            >
                                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M24.4346 11.4092L22.082 26.5762L22.0166 27H9.68945L9.62305 26.5762L7.27051 11.4092L8.25879 11.2568L10.5459 26H21.1592L23.4463 11.2568L24.4346 11.4092ZM19.1172 5.33008L20.291 8.58301H26V9.58301H6V8.58301H11.7783L11.7178 8.55566L13.1914 5.29395L13.3242 5H18.998L19.1172 5.33008ZM12.8037 8.58301H19.2275L18.2959 6H13.9697L12.8037 8.58301Z" fill="black"/>
                                                                </svg>

                                                            </button>
                                                        <?php endif; ?>

                                                    </div>
                                                    </div>
                                                    <div class="meta-item">
                                        <span class="icon icon-calendar">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect x="3.75" y="3.75" width="16.5" height="16.5" stroke="black" stroke-width="1.5"/>
                                                <line x1="4" y1="8.25" x2="20" y2="8.25" stroke="black" stroke-width="1.5"/>
                                                <rect x="7" y="11" width="2" height="2" fill="black"/>
                                                <rect x="11" y="11" width="2" height="2" fill="black"/>
                                                <rect x="15" y="11" width="2" height="2" fill="black"/>
                                                <rect x="7" y="15" width="2" height="2" fill="black"/>
                                                <rect x="11" y="15" width="2" height="2" fill="black"/>
                                                <rect x="15" y="15" width="2" height="2" fill="black"/>
                                            </svg>
                                        </span>
                                                        <span>
    <?php
    $start = $item['BASKET_PROPS']['SCHEDULE_START_DATE'] ?? '';
    $end   = $item['BASKET_PROPS']['SCHEDULE_END_DATE']   ?? '';

    if ($start && $end) {
        $startDt = new DateTime($start);
        $endDt   = new DateTime($end);
        $now     = new DateTime();

        $startF = $startDt->format('j') . ' ' .
            FormatDate('F', MakeTimeStamp($start)) . ' ' .
            $startDt->format('Y');

        $endF   = $endDt->format('j') . ' ' .
            FormatDate('F', MakeTimeStamp($end)) . ' ' .
            $endDt->format('Y');

        $daysToStart = (int) $now->diff($startDt)->format('%r%a');
        $daysToEnd   = (int) $now->diff($endDt)->format('%r%a');
        $duration    = (int) $startDt->diff($endDt)->days + 1;

        if ($daysToEnd < 0) {
            echo "Курс прошёл $startF";
        }
        elseif ($startDt->format('Y-m-d') === $endDt->format('Y-m-d')) {
            $text = $startF;
            if ($daysToStart > 0) {
                $text .= " (через $daysToStart дн.)";
            } elseif ($daysToStart === 0) {
                $text .= " (сегодня)";
            }
            echo $text;
        }
        else {
            $range = "$startF — $endF";

            if ($daysToStart > 0) {
                $range .= " (через $daysToStart—" . ($daysToStart + $duration - 1) . " дн.)";
            }
            elseif ($daysToEnd >= 0) {
                $range .= " (идёт сейчас)";
            }

            echo $range;
        }
    }
    else {
        echo '—';
    }
    ?>
</span>
                                                    </div>

                                                    <div class="meta-item">
                                            <span class="icon icon-time">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="12" cy="12" r="9.5" stroke="black"/>
                                                    <line x1="11.5" y1="12" x2="11.5" y2="5" stroke="black"/>
                                                    <path d="M18 12V13H11V12H18Z" fill="black"/>
                                                </svg>
                                            </span>
                                                        <span><?=htmlspecialcharsbx($item['BASKET_PROPS']['SCHEDULE_TIME'])?></span>
                                                    </div>

                                                </div>

                                                <h3 class="course-title <?=$isCanceled ? 'archived' : ''?>">
                                                    <?=htmlspecialcharsbx($courseName)?>
                                                </h3>

                                                <div class="course-level">
                                                    <?=htmlspecialcharsbx($courseLevel)?>
                                                </div>

                                            </div>
                                            <div class="card-btn-desc">
                                                <div class="card-actions">
                                                    <?php

                                                    $finalLink = $buttonLink;
                                                    $finalButtonText = $buttonText;

                                                    if ($isCompleted) {
                                                        $courseUrl = '';

                                                        if (!empty($item['PRODUCT_ID']) && CModule::IncludeModule("iblock")) {
                                                            $dbElement = CIBlockElement::GetByID($item['PRODUCT_ID']);
                                                            if ($arElement = $dbElement->Fetch()) {
                                                                $elementCode = $arElement['XML_ID'] ?? '';
                                                                if (!empty($elementCode)) {
                                                                    $courseUrl = '/kurs/' . $elementCode . '.html';
                                                                }
                                                            }
                                                        }
                                                        if (!empty($courseUrl)) {
                                                            $finalLink = $courseUrl;
                                                            $finalButtonText = 'Перейти к курсу';
                                                        }
                                                    }
                                                    ?>

                                                    <a href="<?=htmlspecialcharsbx($finalLink)?>"
                                                       class="action-button <?=$buttonClass?> <?=($buttonClass === 'secondary' && !$isCanceled && !$isCompleted) ? 'small' : ''?>">
                                                        <?=$finalButtonText?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-sidebar">
                                            <div class="price-section">
                                                <?php if (floatval($item['DISCOUNT_PRICE']) > 0 && !$isCanceled): ?>
                                                    <?php
                                                    $oldPrice = floatval($item['PRICE']) + floatval($item['DISCOUNT_PRICE']);
                                                    $oldPriceFormatted = SaleFormatCurrency($oldPrice, $item['CURRENCY']);
                                                    ?>
                                                    <div class="course-price old">
                                                        <?=$oldPriceFormatted?>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="course-price">
                                                    <?=$coursePrice?>
                                                </div>
                                            </div>
                                            <div class="additional-info">
                                                <?php if ($isCanceled): ?>
                                                    Отменен
                                                <?php else: ?>
                                                    <?=$paymentStatus?>
                                                <?php endif; ?>
                                            </div>

                                            <?php if ($isPaid && !$isCanceled && !$isCompleted): ?>
                                                <div class="status-badge warning">
                                    <span class="icon"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10 2C14.4183 2 18 5.58172 18 10C18 14.4183 14.4183 18 10 18C5.58172 18 2 14.4183 2 10C2 5.58172 5.58172 2 10 2ZM10 3C6.13401 3 3 6.13401 3 10C3 13.866 6.13401 17 10 17C13.866 17 17 13.866 17 10C17 6.13401 13.866 3 10 3ZM14 11H9V5H10V10H14V11Z" fill="black"/>
</svg>
</span>
                                                    <span>Ждём начала</span>
                                                </div>
                                            <?php elseif ($isCompleted): ?>

                                                <div class="status-badge success">
                                                    <span>Доступен</span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-btn-mob">
                                            <div class="card-actions">
                                                <a href="<?=htmlspecialcharsbx($buttonLink)?>"
                                                   class="action-button <?=$buttonClass?> <?=($buttonClass === 'secondary' && !$isCanceled && !$isCompleted) ? 'small' : ''?>">
                                                    <?=$buttonText?>
                                                </a>

                                                <!--                                                --><?php //if (!$isPaid && !$isCanceled && !$isCompleted): ?>
                                                <!--                                                    <div style="font-family: 'Inter'; font-size: 16px; color: var(--color-dark-blue); text-decoration: underline; display: flex; align-items: center;">-->
                                                <!--                                                        Вы выбрали рассрочку-->
                                                <!--                                                        <a href="#" style="margin-left: 4px;">Смотреть условия</a>-->
                                                <!--                                                    </div>-->
                                                <!--                                                --><?php //endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="desc">
                                    <?php if (!$isCanceled && !$isCompleted && !$isShipped && in_array($orderData['STATUS_ID'], ['N', 'DN', /* добавьте другие разрешённые статусы */])): ?>
                                        <button
                                                class="cancel-item-btn"
                                                data-basket-id="<?= $item['ID'] ?>"
                                                data-order-id="<?= $orderData['ID'] ?>"
                                                data-order-number="<?= htmlspecialcharsbx($orderData['ACCOUNT_NUMBER']) ?>"
                                                data-course-name="<?= htmlspecialcharsbx($courseName) ?>"
                                        >
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M24.4346 11.4092L22.082 26.5762L22.0166 27H9.68945L9.62305 26.5762L7.27051 11.4092L8.25879 11.2568L10.5459 26H21.1592L23.4463 11.2568L24.4346 11.4092ZM19.1172 5.33008L20.291 8.58301H26V9.58301H6V8.58301H11.7783L11.7178 8.55566L13.1914 5.29395L13.3242 5H18.998L19.1172 5.33008ZM12.8037 8.58301H19.2275L18.2959 6H13.9697L12.8037 8.58301Z" fill="black"/>
                                            </svg>

                                        </button>
                                    <?php endif; ?>

                                </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="cancel-modal-overlay" id="cancelModal">
        <div class="cancel-modal">
            <button class="cancel-modal-close" id="closeCancelModal">
                <span class="cancel-modal-close-icon"></span>
            </button>

            <h2 class="cancel-modal-header" id="modalTitle"></h2>
            <div class="cancel-modal-content" id="modalContent"></div>

            <div class="cancel-modal-buttons">
                <button class="cancel-modal-button cancel-modal-cancel" id="cancelAction">
                    Не отменять
                </button>
                <button class="cancel-modal-button cancel-modal-confirm" id="confirmCancel">
                    Отменить заказ
                </button>
            </div>
        </div>
    </div>

    <div class="cancel-modal-overlay" id="confirmCancelModal">
        <div class="confirm-cancel-modal">
            <button class="confirm-cancel-modal-close" id="closeConfirmCancelModal">
                <span class="confirm-cancel-modal-close-icon"></span>
            </button>

            <h2 class="confirm-cancel-modal-header">Заказ отменён</h2>
            <div class="confirm-cancel-modal-content">
                По вопросам возврата денег за заказ с вами свяжется менеджер в течение 7 дней.
            </div>

            <div class="confirm-cancel-modal-buttons">
                <button class="confirm-cancel-modal-button" id="finalConfirmButton">
                    Завершить
                </button>
            </div>
        </div>
    </div>

    <div class="cancel-modal-overlay" id="rulesCancelModal">
        <div class="rules-cancel-modal">
            <button class="rules-cancel-modal-close" id="closeRulesCancelModal">
                <span class="rules-cancel-modal-close-icon"></span>
            </button>

            <div class="rules-cancel-modal-text">
                <h2 class="rules-cancel-modal-header">Правила отмены заказа</h2>

                <div class="rules-cancel-modal-content">
                    Вы можете отменить заказ Курса в любой момент
                </div>

                <div class="rules-cancel-modal-content">
                    Заказ на сертификацию можно отменить до старта сертификации в расписании
                </div>
            </div>

            <div class="rules-cancel-modal-buttons">
                <button class="rules-cancel-modal-button" id="closeRulesButton">
                    Понятно
                </button>
            </div>
        </div>
    </div>
</div>