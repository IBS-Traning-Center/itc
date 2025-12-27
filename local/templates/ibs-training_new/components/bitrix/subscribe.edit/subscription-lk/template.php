<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $USER, $APPLICATION;
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
if ($arResult['ID'] == 0 && $USER->IsAuthorized()) {
    $email = $USER->GetEmail();
    if ($email) {
        $rsSub = CSubscription::GetList(
            ["ID" => "DESC"],
            ["EMAIL" => $email]
        );
        if ($sub = $rsSub->Fetch()) {
            $arResult['ID'] = (int)$sub['ID'];
            $arResult['SUBSCRIPTION'] = $sub;

            $selected = [];
            $rsRub = CSubscription::GetRubricList($arResult['ID']);
            while ($r = $rsRub->Fetch()) {
                $selected[] = $r['ID'];
            }

            $isActive = ($arResult['SUBSCRIPTION']['ACTIVE'] === 'Y');

            foreach ($arResult['RUBRICS'] as &$rubric) {
                $rubric['CHECKED'] = $isActive && in_array($rubric['ID'], $selected);
            }
            unset($rubric);

        }
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

    <?php if (CSubscription::IsAuthorized($arResult['ID'])): ?>

        <form method="post" action="<?= $arResult["FORM_ACTION"] ?>" class="subscr-form">
            <?= bitrix_sessid_post(); ?>
            <input type="hidden" name="PostAction" value="Update">
            <input type="hidden" name="ID" value="<?= (int)$arResult['ID'] ?>">
            <input type="hidden" name="UNSUBSCRIBE_ALL" id="unsubscribe-all-hidden" value="N">

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
                                    type="text"
                                    value="<?= htmlspecialcharsbx($arResult['SUBSCRIPTION']['EMAIL'] ?? '') ?>"
                                    placeholder="Введите новый email"
                            >

                        </div>
                    </div>

                    <div class="subscr-topics-section">
                        <div class="subscr-topics-title">Темы рассылки</div>

                        <?php
                        $isActive = ($arResult['SUBSCRIPTION']['ACTIVE'] ?? 'Y') === 'Y';
                        foreach ($arResult['RUBRICS'] as $rubric):
                            $checked = false;
                            if ($isActive) {
                                $checked = !empty($rubric['CHECKED']);
                                if (isset($_POST['RUB_ID']) && is_array($_POST['RUB_ID'])) {
                                    $checked = in_array($rubric['ID'], $_POST['RUB_ID']);
                                }
                            }
                            ?>
                            <label class="subscr-checkbox-label subscr-topic-item">
                                <div class="subscr-checkbox">
                                    <input
                                            type="checkbox"
                                            class="subscr-checkbox-input topic-checkbox"
                                            name="RUB_ID[]"
                                            value="<?= $rubric['ID'] ?>"
                                        <?= $checked ? 'checked' : '' ?>
                                    >
                                    <div class="subscr-checkbox-bg <?= $checked ? 'checked' : '' ?>">
                                        <div class="subscr-check-mark"></div>
                                    </div>
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
                                <input type="checkbox" class="subscr-checkbox-input" id="unsubscribe-all">
                                <div class="subscr-checkbox-bg">
                                    <div class="subscr-check-mark"></div>
                                </div>
                            </div>
                            <div class="subscr-topic-text">Отписаться от всех рассылок</div>
                        </label>
                    </div>

                    <div class="subscr-buttons">
                        <button type="button" class="subscr-btn subscr-btn-cancel" onclick="history.back()">Отменить</button>
                        <button type="submit" class="subscr-btn subscr-btn-save">Сохранить</button>
                    </div>
                </div>
            </div>
        </form>

    <?php else: ?>
        <?= ShowMessage(['MESSAGE' => 'Нет доступа к редактированию подписки.', 'TYPE' => 'ERROR']) ?>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const topicCheckboxes = document.querySelectorAll('.topic-checkbox');
        const unsubscribeAll = document.getElementById('unsubscribe-all');
        const hidden = document.getElementById('unsubscribe-all-hidden');

        function updateVisual(input) {
            const bg = input.closest('.subscr-checkbox')?.querySelector('.subscr-checkbox-bg');
            if (bg) bg.classList.toggle('checked', input.checked);
        }

        document.querySelectorAll('.subscr-checkbox-input').forEach(updateVisual);

        if (unsubscribeAll) {
            unsubscribeAll.addEventListener('change', function () {
                if (this.checked) {
                    hidden.value = 'Y';
                    topicCheckboxes.forEach(cb => {
                        cb.checked = false;
                        updateVisual(cb);
                    });
                } else {
                    hidden.value = 'N';
                }
                updateVisual(this);
            });
        }

        document.querySelectorAll('.subscr-checkbox-label').forEach(label => {
            label.addEventListener('click', function (e) {
                if (e.target.closest('.subscr-checkbox-input')) return;
                const input = this.querySelector('.subscr-checkbox-input');
                if (input) {
                    input.checked = !input.checked;
                    updateVisual(input);
                    if (input.id === 'unsubscribe-all') {
                        input.dispatchEvent(new Event('change'));
                    } else if (input.checked && unsubscribeAll?.checked) {
                        unsubscribeAll.checked = false;
                        hidden.value = 'N';
                        updateVisual(unsubscribeAll);
                    }
                }
            });
        });
    });
</script>