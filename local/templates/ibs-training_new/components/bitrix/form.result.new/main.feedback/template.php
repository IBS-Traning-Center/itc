<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

/**
 * @var array $arResult
 * @var array $arParams
 */
CJSCore::Init(['phone_number']);
?>

<div class="main-feedback-form-block" id="mainFeedbackFormBlock">
    <div class="container main-feedback-form-container">
        <?php if ($arResult['arForm']['NAME']) : ?>
            <h1><?= $arResult['arForm']['NAME'] ?></h1>
        <?php endif; ?>
        <div class="questions-block">
            <?php if ($arResult["FORM_NOTE"]) : ?>
                <p class="f-20 success-text"><?= $arResult["FORM_NOTE"] ?></p>
            <?php endif; ?>
            <?php if ($arResult["isFormNote"] != "Y") : ?>
                <?=$arResult["FORM_HEADER"]?>
                <div class="form-table data-table">
                    <?php foreach ($arResult["QUESTIONS"] as $questionId => $question) : ?>
                        <?php
                            if  ($questionId == 'course_name_crm' && $arParams['MAGNET_LEAD_NAME']) {
                                $value = $arParams['MAGNET_LEAD_NAME'];
                            } else if ($questionId == 'magnet_code' && $arParams['MAGNET_CODE']) {
                                $value = $arParams['MAGNET_CODE'];
                            }
                        ?>
                        <?php if ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') : ?>
                            <?php echo $question['HTML_CODE']; ?>
                        <?php else : ?>
                            <?php if ($questionId == 'email') : ?>
                                <div class="flex-question-block">
                            <?php endif; ?>
                            <div class="question-block <?= $questionId ?>">
                                <?php if ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'checkbox') : ?>
                                    <input
                                        <?= ($question['REQUIRED'] == 'Y') ? 'required' : '' ?>
                                        name="form_checkbox_<?= $questionId ?>[]"
                                        type="<?= $question['STRUCTURE'][0]['FIELD_TYPE'] ?>"
                                        id="<?= $question['STRUCTURE'][0]['ID'] ?>"
                                        value="<?= $question['STRUCTURE'][0]['ID'] ?>">
                                    <span><?= $question['CAPTION'] ?></span>
                                <?php else : ?>
                                    <input
                                            class="inputtext main-feedback-form-input <?= $questionId ?> <?= ($questionId == 'phone' ? 'phone' : '') ?> <?= isset($arResult['FORM_ERRORS'][$questionId]) ? 'has-error' : '' ?>"
                                        <?= ($question['REQUIRED'] == 'Y') ? 'required' : '' ?>
                                        <?= ($questionId == 'client_id') ? 'id="clientID"' : '' ?>
                                        placeholder="<?= $question['CAPTION'] ?> <?= ($question['REQUIRED'] == 'Y') ? '*' : '(не обязательно)' ?>"
                                        name="form_text_<?= $question['STRUCTURE'][0]['ID'] ?>"
                                        type="<?= $question['STRUCTURE'][0]['FIELD_TYPE'] ?>"
                                        value="<?= $value ?: '' ?>">
                                <?php endif; ?>
                            </div>
                            <?php if ($questionId == 'phone') : ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <input class="submit-main-feedback-form" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
                    <?php if ($arResult['FORM_DESCRIPTION']) : ?>
                        <div class="under-main-feedback-form">
                            <span><?= $arResult['FORM_DESCRIPTION'] ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <?=$arResult["FORM_FOOTER"]?>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var phoneInputs = document.querySelectorAll('input.phone');

        phoneInputs.forEach(function(input) {
            if (input.dataset.maskInitialized) return;
            input.dataset.maskInitialized = 'true';

            input.addEventListener('input', function(e) {
                let cursor = e.target.selectionStart;
                let oldLength = e.target.value.length;

                let value = e.target.value.replace(/\D/g, '');

                if (value.startsWith('8') && value.length > 1) {
                    value = '7' + value.substring(1);
                }

                if (value.length > 0 && !value.startsWith('7')) {
                    value = '7' + value;
                }

                if (value.length > 11) {
                    value = value.substring(0, 11);
                }

                let formatted = '';
                if (value.length >= 1) formatted = '+7';
                if (value.length > 1) formatted += ' (' + value.substr(1, 3);
                if (value.length >= 5) formatted += ') ' + value.substr(4, 3);
                if (value.length >= 8) formatted += '-' + value.substr(7, 2);
                if (value.length >= 10) formatted += '-' + value.substr(9, 2);

                e.target.value = formatted;

                // Корректировка курсора
                let newLength = formatted.length;
                let newCursor = cursor + (newLength - oldLength);
                if (newCursor > newLength) newCursor = newLength;

                setTimeout(() => {
                    e.target.setSelectionRange(newCursor, newCursor);
                }, 0);
            });

            if (input.value) {
                input.dispatchEvent(new Event('input'));
            }
        });
    });
</script>