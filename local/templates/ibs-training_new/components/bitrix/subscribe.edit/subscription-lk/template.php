<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$frame = $this->createFrame()->begin();
?>

<div class="subscr-wrapper">
    <form method="post" action="">
        <?=bitrix_sessid_post();?>

        <input type="hidden" name="action" value="update">

        <div class="subscr-container">
            <div class="tabs">
                <a class="tab " href="/personal/profile/">Профиль</a>
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
                                value="<?= htmlspecialcharsbx($arResult['REQUEST']['EMAIL']) ?>"
                                readonly
                        >
                    </div>
                </div>

                <div class="subscr-topics-section">
                    <div class="subscr-topics-title">Темы рассылки</div>

                    <?php foreach ($arResult['RUBRICS'] as $rubric): ?>
                        <?php
                        $isChecked = is_array($arResult['RUBRIC_ID']) && in_array($rubric['ID'], $arResult['RUBRIC_ID']);
                        ?>
                        <label class="subscr-checkbox-label subscr-topic-item">
                            <div class="subscr-checkbox">
                                <input type="checkbox" class="subscr-checkbox-input" name="RUB_ID[]" value="<?= $rubric['ID'] ?>"
                                    <?= $isChecked ? 'checked' : '' ?>>
                                <div class="subscr-checkbox-bg <?= $isChecked ? 'checked' : '' ?>">
                                    <div class="subscr-check-mark"></div>
                                </div>
                            </div>
                            <div class="subscr-topic-text-cont">
                                <div class="subscr-topic-text"><?= $rubric['NAME'] ?></div>
                                <?php if (!empty($rubric['DESCRIPTION'])): ?>
                                    <div class="subscr-description"><?= $rubric['DESCRIPTION'] ?></div>
                                <?php endif; ?>
                            </div>
                        </label>
                    <?php endforeach; ?>

                    <label class="subscr-checkbox-label subscr-topic-item">
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
</div>

<script>
    // ваш JS для чекбоксов + unsubscribe-all
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.subscr-checkbox-input:not(#unsubscribe-all)');
        inputs.forEach(input => {
            const bg = input.nextElementSibling;
            bg.classList.toggle('checked', input.checked);
            input.addEventListener('change', () => bg.classList.toggle('checked', input.checked));
        });

        const unsubscribe = document.getElementById('unsubscribe-all');
        if (unsubscribe) {
            unsubscribe.addEventListener('change', function() {
                if (this.checked) {
                    inputs.forEach(cb => {
                        cb.checked = false;
                        cb.nextElementSibling.classList.remove('checked');
                    });
                }
            });
        }
    });
</script>

<?php $frame->end(); ?>
