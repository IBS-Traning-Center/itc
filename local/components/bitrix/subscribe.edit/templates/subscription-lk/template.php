<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

global $USER, $APPLICATION;

// Специальная обработка: отписка от всех одним кликом
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && $_POST['PostAction'] === 'Update'
    && $_POST['UNSUBSCRIBE_ALL'] === 'Y'
    && (int)$_POST['ID'] > 0
) {
    $subscr = new CSubscription();
    $subscr->Update(
        (int)$_POST['ID'],
        ['ACTIVE' => 'N']
    );
    LocalRedirect($APPLICATION->GetCurPageParam('unsubscribe=ok', []));
}

// Инициализация переменной для отписки от всех
$unsubscribeAll = false;
$createNewSubscription = false; // Флаг для создания новой подписки

// Получаем ID пользователя и его email
$userId = $USER->GetID();
$userEmail = $USER->GetEmail();

// Флаг авторизации пользователя
$isAuthorized = $USER->IsAuthorized();

// 1. Попробуем найти существующую подписку
if ($isAuthorized && ($userId || $userEmail)) {
    // Сначала ищем по USER_ID
    if ($userId) {
        $rsSubscriptions = CSubscription::GetList(
            ["ID" => "DESC"],
            ["USER_ID" => $userId, "ACTIVE" => "Y"]
        );
        if ($subscription = $rsSubscriptions->Fetch()) {
            $arResult['ID'] = (int)$subscription['ID'];
            $arResult['SUBSCRIPTION'] = $subscription;
        }
    }

    // Если не нашли по USER_ID, ищем по EMAIL
    if ($arResult['ID'] == 0 && $userEmail) {
        $rsSubscriptions = CSubscription::GetList(
            ["ID" => "DESC"],
            ["EMAIL" => $userEmail, "ACTIVE" => "Y"]
        );
        if ($subscription = $rsSubscriptions->Fetch()) {
            $arResult['ID'] = (int)$subscription['ID'];
            $arResult['SUBSCRIPTION'] = $subscription;
        }
    }

    // Если всё ещё не нашли, ищем любую подписку (включая неактивные)
    if ($arResult['ID'] == 0 && $userEmail) {
        $rsSubscriptions = CSubscription::GetList(
            ["ID" => "DESC"],
            ["EMAIL" => $userEmail]
        );
        if ($subscription = $rsSubscriptions->Fetch()) {
            $arResult['ID'] = (int)$subscription['ID'];
            $arResult['SUBSCRIPTION'] = $subscription;
        }
    }

    // 2. Если подписка не найдена, создадим новую
    if ($arResult['ID'] == 0) {
        $createNewSubscription = true;
        $unsubscribeAll = true; // Новая подписка - ничего не выбрано

        // Создаем временный массив подписки для отображения формы
        $arResult['SUBSCRIPTION'] = [
            'EMAIL' => $userEmail,
            'ACTIVE' => 'Y',
            'USER_ID' => $userId
        ];
    }
}

// Определяем выбранные рубрики
$selectedRubrics = [];
if ($arResult['ID'] > 0 && isset($arResult['SUBSCRIPTION']) && is_array($arResult['SUBSCRIPTION'])) {
    $rsRub = CSubscription::GetRubricList($arResult['ID']);
    while ($r = $rsRub->Fetch()) {
        $selectedRubrics[] = $r['ID'];
    }

    // Проверяем, активна ли подписка
    $isActive = ($arResult['SUBSCRIPTION']['ACTIVE'] ?? 'Y') === 'Y';

    // Если подписка неактивна или нет выбранных рубрик
    if (!$isActive || empty($selectedRubrics)) {
        $unsubscribeAll = true;
    }

    // Подготавливаем CHECKED для рубрик
    foreach ($arResult['RUBRICS'] as &$rubric) {
        $rubric['CHECKED'] = $isActive && in_array($rubric['ID'], $selectedRubrics);
    }
    unset($rubric);
}

// Если пришел POST, обновляем состояние
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['PostAction'] === 'Update') {
    if (isset($_POST['RUB_ID']) && is_array($_POST['RUB_ID'])) {
        $unsubscribeAll = empty($_POST['RUB_ID']);
    } elseif (!isset($_POST['RUB_ID'])) {
        $unsubscribeAll = true;
    }

    // Если ID = 0 в POST, значит создаем новую подписку
    if ((int)$_POST['ID'] === 0 && $isAuthorized) {
        $createNewSubscription = true;
    }
}
?>

<div class="subscr-wrapper">
    <?php if ($_GET['unsubscribe'] === 'ok'): ?>
        <?= ShowMessage(['MESSAGE' => 'Вы успешно отписались от всех рассылок.', 'TYPE' => 'OK']) ?>
    <?php endif; ?>

    <?php foreach ($arResult['MESSAGE'] as $msg): ?>
        <?= ShowMessage(['MESSAGE' => $msg, 'TYPE' => 'OK']) ?>
    <?php endforeach; ?>

    <?php foreach ($arResult['ERROR'] as $err): ?>
        <?= ShowMessage(['MESSAGE' => $err, 'TYPE' => 'ERROR']) ?>
    <?php endforeach; ?>

    <?php
    // Определяем, можем ли мы редактировать подписку
    $canEdit = false;
    $subscriptionEmail = $arResult['SUBSCRIPTION']['EMAIL'] ?? '';

    if ($USER->IsAuthorized()) {
        $userEmail = $USER->GetEmail();

        // Вариант 1: есть существующая подписка и доступ к ней
        if ($arResult['ID'] > 0 && CSubscription::IsAuthorized($arResult['ID'])) {
            $canEdit = true;
        }
        // Вариант 2: есть существующая подписка с тем же email
        elseif ($arResult['ID'] > 0 && $subscriptionEmail === $userEmail) {
            $canEdit = true;
        }
        // Вариант 3: нужно создать новую подписку
        elseif ($createNewSubscription) {
            $canEdit = true;
        }
        // Вариант 4: стандартный поиск компонента
        elseif ($arResult['ID'] == 0 && $userEmail) {
            $rsSub = CSubscription::GetList([], ["EMAIL" => $userEmail]);
            if ($sub = $rsSub->Fetch()) {
                $arResult['ID'] = (int)$sub['ID'];
                $arResult['SUBSCRIPTION'] = $sub;
                $canEdit = true;
            } else {
                // Если не нашли, разрешаем создание новой
                $canEdit = true;
                $createNewSubscription = true;
            }
        }
    } else {
        // Для неавторизованных
        if ($arResult['ID'] > 0 && CSubscription::IsAuthorized($arResult['ID'])) {
            $canEdit = true;
        }
    }

    // Если мы создаем новую подписку, убедимся что email установлен
    if ($createNewSubscription && empty($subscriptionEmail) && $userEmail) {
        $arResult['SUBSCRIPTION']['EMAIL'] = $userEmail;
    }
    ?>

    <?php if ($canEdit): ?>
        <form method="post" action="<?= $arResult["FORM_ACTION"] ?>" class="subscr-form" id="subscription-form">
            <?= bitrix_sessid_post(); ?>
            <input type="hidden" name="PostAction" value="Update">
            <input type="hidden" name="ID" value="<?= (int)$arResult['ID'] ?>">
            <input type="hidden" name="UNSUBSCRIBE_ALL" id="unsubscribe-all-hidden" value="<?= $unsubscribeAll ? 'Y' : 'N' ?>">

            <?php if ($createNewSubscription): ?>
                <input type="hidden" name="NEW_SUBSCRIPTION" value="Y">
                <input type="hidden" name="CONFIRM_CODE" value="">
                <input type="hidden" name="FORMAT" value="html">
                <input type="hidden" name="SEND_CONFIRM" value="N">
            <?php endif; ?>

            <div class="subscr-container">
                <div class="tabs">
                    <a class="tab" href="/personal/profile/">Профиль</a>
                    <a class="tab active">Подписка</a>
                    <a class="tab" href="/personal/profile/password/">Пароль</a>
                </div>

                <div class="subscr-content-wrapper">
                    <div class="subscr-email-section">
                        <div class="subscr-email-label">Эл. почта для подписки</div>
                        <div class="subscr-email-input-wrapper">
                            <input
                                    class="subscr-email-input"
                                    name="EMAIL"
                                    type="email"
                                    value="<?= htmlspecialcharsbx($arResult['SUBSCRIPTION']['EMAIL'] ?? '') ?>"
                                    placeholder="Введите email для подписки"
                                    required
                                <?= ($createNewSubscription && !empty($userEmail)) ? 'readonly' : '' ?>
                            >
                            <?php if ($createNewSubscription): ?>
                                <div class="subscr-new-notice">Создание новой подписки</div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="subscr-topics-section">
                        <div class="subscr-topics-title">Темы рассылки</div>

                        <?php
                        foreach ($arResult['RUBRICS'] as $rubric):
                            // Определяем состояние чекбокса
                            $checked = false;

                            if (isset($_POST['RUB_ID']) && is_array($_POST['RUB_ID'])) {
                                // Если пришел POST, используем его значения
                                $checked = in_array($rubric['ID'], $_POST['RUB_ID']);
                            } elseif (isset($rubric['CHECKED'])) {
                                // Иначе используем данные из подписки
                                $checked = $rubric['CHECKED'] && !$unsubscribeAll;
                            }
                            // Для новой подписки все чекбоксы не отмечены
                            elseif ($createNewSubscription) {
                                $checked = false;
                            }
                            ?>
                            <label class="subscr-checkbox-label subscr-topic-item">
                                <div class="subscr-checkbox">
                                    <input
                                            type="checkbox"
                                            class="custom-checkbox-input topic-checkbox"
                                            name="RUB_ID[]"
                                            value="<?= $rubric['ID'] ?>"
                                        <?= $checked ? 'checked' : '' ?>
                                            data-was-checked="<?= $checked ? '1' : '0' ?>"
                                    >
                                    <div class="custom-checkbox-icon"></div>
                                </div>
                                <div class="subscr-topic-text-cont">
                                    <div class="subscr-topic-text"><?= htmlspecialcharsbx($rubric['NAME']) ?></div>
                                    <?php if (!empty($rubric['DESCRIPTION'])): ?>
                                        <div class="subscr-description"><?= htmlspecialcharsbx($rubric['DESCRIPTION']) ?></div>
                                    <?php endif; ?>
                                </div>
                            </label>
                        <?php endforeach; ?>

                        <label class="subscr-checkbox-label subscr-topic-item unsubscribe-all-label">
                            <div class="subscr-checkbox">
                                <input
                                        type="checkbox"
                                        class="custom-checkbox-input"
                                        id="unsubscribe-all"
                                    <?= $unsubscribeAll ? 'checked' : '' ?>
                                >
                                <div class="custom-checkbox-icon"></div>
                            </div>
                            <div class="subscr-topic-text">Отписаться от всех рассылок</div>
                        </label>
                    </div>

                    <div class="subscr-buttons">
                        <button type="button" class="subscr-btn subscr-btn-cancel" onclick="history.back()">Отменить</button>
                        <button type="submit" class="subscr-btn subscr-btn-save">
                            <?= $createNewSubscription ? 'Создать подписку' : 'Сохранить' ?>
                        </button>
                    </div>
                </div>
            </div>
        </form>

    <?php endif; ?>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Обработка чекбокса "Отписаться от всех"
        const unsubscribeAllCheckbox = document.getElementById('unsubscribe-all');
        const topicCheckboxes = document.querySelectorAll('.topic-checkbox');
        const unsubscribeAllHidden = document.getElementById('unsubscribe-all-hidden');

        if (unsubscribeAllCheckbox) {
            // Обработчик для "Отписаться от всех"
            unsubscribeAllCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    // Отключаем все чекбоксы тем
                    topicCheckboxes.forEach(checkbox => {
                        checkbox.checked = false;
                        checkbox.disabled = true;
                    });
                    unsubscribeAllHidden.value = 'Y';
                } else {
                    // Включаем все чекбоксы тем
                    topicCheckboxes.forEach(checkbox => {
                        checkbox.disabled = false;
                    });
                    unsubscribeAllHidden.value = 'N';
                }
            });

            // При загрузке страницы устанавливаем начальное состояние
            if (unsubscribeAllCheckbox.checked) {
                topicCheckboxes.forEach(checkbox => {
                    checkbox.disabled = true;
                });
            }
        }

        // Обработчик для чекбоксов тем
        topicCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                // Если выбран хотя бы один чекбокс темы, снимаем "Отписаться от всех"
                if (unsubscribeAllCheckbox && unsubscribeAllCheckbox.checked) {
                    unsubscribeAllCheckbox.checked = false;
                    topicCheckboxes.forEach(cb => {
                        cb.disabled = false;
                    });
                    unsubscribeAllHidden.value = 'N';
                }

                // Если ни один чекбокс не выбран, включаем "Отписаться от всех"
                const anyChecked = Array.from(topicCheckboxes).some(cb => cb.checked);
                if (!anyChecked && unsubscribeAllCheckbox) {
                    unsubscribeAllCheckbox.checked = true;
                    topicCheckboxes.forEach(cb => {
                        cb.disabled = true;
                    });
                    unsubscribeAllHidden.value = 'Y';
                }
            });
        });

        // Обработка отправки формы
        const form = document.getElementById('subscription-form');
        if (form) {
            form.addEventListener('submit', function() {
                // Если "Отписаться от всех" выбран, очищаем RUB_ID
                if (unsubscribeAllCheckbox && unsubscribeAllCheckbox.checked) {
                    topicCheckboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });
                }
            });
        }
    });
</script>
