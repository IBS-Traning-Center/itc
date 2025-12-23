<?php
// ... (начало файла без изменений)

$frame = $this->createFrame()->begin();
?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Stag+Sans:wght@300;400&display=swap" rel="stylesheet">

    <style>
        /* Основная обёртка — изолирует всё */
        .subscr-wrapper {
            position: relative;
            z-index: 1; /* на случай z-index конфликтов */
        }

        .subscr-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 56px 56px 100px;
            gap: 48px;
            width: 1450px;
            background: #FFFFFF;
            min-height: 1117px;
            margin: 0 auto; /* центрируем, если нужно */
        }

        .subscr-tabs {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            gap: 4px;
            width: 536px;
            height: 40px;
        }

        .subscr-tab {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            height: 40px;
            font-family: 'Noto Sans';
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            color: #000000;
            background: #F0F0F0;
            width: auto;
        }

        .subscr-tab.active {
            background: #000000;
            color: #FFFFFF;
        }

        .subscr-content-wrapper {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 24px;
            width: 649px;
        }

        /* ... (все остальные классы с префиксом subscr- ) */

        .subscr-email-section {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 649px;
        }

        .subscr-email-label {
            font-family: 'Stag Sans';
            font-weight: 300;
            font-size: 16px;
            line-height: 22px;
            color: #000000;
        }

        .subscr-email-input-wrapper {
            box-sizing: border-box;
            display: flex;
            flex-direction: row;
            align-items: center;
            width: 649px;
            height: 80px;
            background: #FFFFFF;
            border-bottom: 2px solid #2B418B;
        }

        .subscr-email-input {
            font-family: 'Stag Sans';
            font-weight: 300;
            font-size: 24px;
            line-height: 32px;
            color: #000000;
            padding: 0 24px;
            width: 601px;
            height: 32px;
            border: none;
            background: transparent;
        }

        .subscr-topics-section {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 24px;
            width: 649px;
        }

        .subscr-topics-title {
            font-family: 'Noto Sans';
            font-weight: 700;
            font-size: 20px;
            line-height: 27px;
            color: #000000;
        }

        .subscr-topic-item {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            gap: 16px;
            width: 649px;
        }

        .subscr-sub-topic {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 16px;
            padding-left: 40px;
            width: 649px;
        }

        .subscr-checkbox-label {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 16px;
            cursor: pointer;
            width: 100%;
        }

        .subscr-checkbox {
            position: relative;
            width: 24px;
            height: 24px;
            flex-shrink: 0;
        }

        .subscr-checkbox-input {
            position: absolute;
            opacity: 0;
            width: 24px;
            height: 24px;
            cursor: pointer;
        }

        .subscr-checkbox-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 24px;
            height: 24px;
            background: #FFFFFF;
            border: 1px solid #000000;
            box-sizing: border-box;
        }

        .subscr-checkbox-bg.checked {
            background: #2B418B;
            border: none;
        }

        .subscr-check-mark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
        }

        .subscr-checkbox-bg.checked .subscr-check-mark {
            display: block;
            width: 13px;
            height: 9px;
            background: transparent;
            background-image: url("data:image/svg+xml,%3Csvg width='13' height='9' viewBox='0 0 13 9' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill-rule='evenodd' clip-rule='evenodd' d='M5.18579 8.83716L5.08969 8.93326L-2.89679e-05 3.84353L1.41418 2.42932L5.09607 6.11121L11.2073 0L12.6215 1.41421L5.19217 8.84353L5.18579 8.83716Z' fill='white'/%3E%3C/svg%3E");
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }

        .subscr-topic-text {
            font-family: 'Stag Sans';
            font-weight: 300;
            font-size: 16px;
            line-height: 24px;
            color: #000000;
            flex: 1;
        }

        .subscr-description {
            font-family: 'Stag Sans';
            font-weight: 300;
            font-size: 14px;
            line-height: 20px;
            color: #000000;
        }

        .subscr-buttons {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            gap: 24px;
            width: 649px;
            padding: 24px 0 0;
        }

        .subscr-btn {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 32px 40px;
            height: 54px;
            font-family: 'Noto Sans';
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            border-radius: 0;
            cursor: pointer;
            flex: 1;
        }

        .subscr-btn-cancel {
            background: #FFFFFF;
            border: 1px solid #2B418B;
            color: #2B418B;
        }

        .subscr-btn-save {
            background: #2B418B;
            color: #FFFFFF;
        }
    </style>

    <div class="subscr-wrapper">
        <form action="<?=$arResult['FORM_ACTION']?>" method="post">
            <div class="subscr-container">
                <div class="subscr-tabs">
                    <div class="subscr-tab">Настройки профиля</div>
                    <div class="subscr-tab subscr-tab-active">Настройки подписки</div>
                    <div class="subscr-tab">Смена пароля</div>
                </div>

                <div class="subscr-content-wrapper">
                    <div class="subscr-email-section">
                        <div class="subscr-email-label">Эл. почта для подписки</div>
                        <div class="subscr-email-input-wrapper">
                            <input class="subscr-email-input" name="sf_EMAIL" value="<?= $USER->IsAuthorized() ? $USER->GetEmail() : $arResult['EMAIL'] ?>" readonly>
                        </div>
                    </div>

                    <div class="subscr-topics-section">
                        <div class="subscr-topics-title">Темы рассылки</div>

                        <?php foreach ($arResult['RUBRICS'] as $item): ?>
                            <label class="subscr-checkbox-label subscr-topic-item">
                                <div class="subscr-checkbox">
                                    <input type="checkbox"
                                           class="subscr-checkbox-input"
                                           name="sf_RUB_ID[]"
                                           value="<?= $item['ID'] ?>"
                                        <?= $item['CHECKED'] ? 'checked' : '' ?>>
                                    <div class="subscr-checkbox-bg <?= $item['CHECKED'] ? 'checked' : '' ?>">
                                        <div class="subscr-check-mark"></div>
                                    </div>
                                </div>
                                <div style="flex: 1;">
                                    <div class="subscr-topic-text"><?= $item['NAME'] ?></div>
                                    <?php if (!empty($item['DESCRIPTION'])): ?>
                                        <div class="subscr-description"><?= $item['DESCRIPTION'] ?></div>
                                    <?php endif; ?>
                                </div>
                            </label>

                            <?php if (!empty($item['SUB_RUBRICS'])): ?>
                                <?php foreach ($item['SUB_RUBRICS'] as $sub): ?>
                                    <label class="subscr-checkbox-label subscr-sub-topic">
                                        <div class="subscr-checkbox">
                                            <input type="checkbox"
                                                   class="subscr-checkbox-input"
                                                   name="sf_RUB_ID[]"
                                                   value="<?= $sub['ID'] ?>"
                                                <?= $sub['CHECKED'] ? 'checked' : '' ?>>
                                            <div class="subscr-checkbox-bg <?= $sub['CHECKED'] ? 'checked' : '' ?>">
                                                <div class="subscr-check-mark"></div>
                                            </div>
                                        </div>
                                        <div class="subscr-topic-text"><?= $sub['NAME'] ?></div>
                                    </label>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <!-- Отписаться от всех -->
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
                        <button class="subscr-btn subscr-btn-cancel" type="button" onclick="window.history.back();">Отменить</button>
                        <button class="subscr-btn subscr-btn-save" type="submit">Сохранить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // JS с префиксами (чтобы не конфликтовал)
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.subscr-checkbox-input');
            inputs.forEach(input => {
                const bg = input.nextElementSibling;
                bg.classList.toggle('checked', input.checked);

                input.addEventListener('change', () => {
                    bg.classList.toggle('checked', input.checked);
                });
            });

            const unsubscribe = document.getElementById('unsubscribe-all');
            if (unsubscribe) {
                unsubscribe.addEventListener('change', function() {
                    if (this.checked) {
                        document.querySelectorAll('.subscr-checkbox-input:not(#unsubscribe-all)').forEach(cb => {
                            cb.checked = false;
                            cb.nextElementSibling.classList.remove('checked');
                        });
                    }
                });
            }
        });
    </script>
<?php
if ($arResult['SUCCESS']): ?>
    <div class="subscr-success" style="color: green; margin-top: 20px;">Подписка успешно сохранена!</div>
<?php elseif (!empty($arResult['ERROR'])): ?>
    <div class="subscr-error" style="color: red; margin-top: 20px;">Ошибка: <?=$arResult['ERROR']?></div>
<?php endif; ?>
<?php $frame->end(); ?>