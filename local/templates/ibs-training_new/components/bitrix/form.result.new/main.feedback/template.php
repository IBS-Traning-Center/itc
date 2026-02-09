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

?>

<div class="main-feedback-form-block" id="mainFeedbackFormBlock">
    <div class="container main-feedback-form-container">
        <?php if ($arResult['arForm']['NAME']) : ?>
            <h2><?= $arResult['arForm']['NAME'] ?></h2>
        <?php endif; ?>

        <div class="questions-block">
            <?php if ($arResult["FORM_NOTE"]) : ?>
                <p class="f-20 success-text"><?= $arResult["FORM_NOTE"] ?></p>
            <?php endif; ?>

            <?php if ($arResult["isFormNote"] != "Y") : ?>
                <?= $arResult["FORM_HEADER"] ?>

                <div class="form-table data-table">
                    <?php foreach ($arResult["QUESTIONS"] as $questionId => $question) : ?>

                        <?php
                        $value = '';
                        if ($questionId == 'course_name_crm' && $arParams['MAGNET_LEAD_NAME']) {
                            $value = $arParams['MAGNET_LEAD_NAME'];
                        } elseif ($questionId == 'magnet_code' && $arParams['MAGNET_CODE']) {
                            $value = $arParams['MAGNET_CODE'];
                        }
                        ?>

                        <?php if ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') : ?>
                            <?= $question['HTML_CODE'] ?>
                        <?php else : ?>
                            <?php if ($questionId == 'phone') : ?>
                                <div class="flex-question-block">
                            <?php endif; ?>

                            <div class="question-block <?= $questionId ?>">
                                <?php if ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'checkbox') : ?>
                                    <input
                                        <?= ($question['REQUIRED'] == 'Y') ? 'required' : '' ?>
                                            name="form_checkbox_<?= $questionId ?>[]"
                                            type="checkbox"
                                            id="<?= $question['STRUCTURE'][0]['ID'] ?>"
                                            value="<?= $question['STRUCTURE'][0]['ID'] ?>">
                                    <span><?= $question['CAPTION'] ?></span>
                                <?php else : ?>
                                    <input
                                            class="inputtext main-feedback-form-input <?= $questionId ?> <?= isset($arResult['FORM_ERRORS'][$questionId]) ? 'has-error' : '' ?>"
                                        <?= ($question['REQUIRED'] == 'Y') ? 'required' : '' ?>
                                        <?= ($questionId == 'client_id') ? 'id="clientID"' : '' ?>
                                        <?= ($questionId == 'phone') ? 'id="phone_input" type="tel"' : '' ?>
                                            placeholder="<?= $question['CAPTION'] ?> <?= ($question['REQUIRED'] == 'Y') ? '' : '(не обязательно)' ?>"
                                            name="form_text_<?= $question['STRUCTURE'][0]['ID'] ?>"
                                            type="<?php if($questionId == 'phone'){echo 'tel';}elseif($questionId == 'email'){echo 'email';}else{ echo $question['STRUCTURE'][0]['FIELD_TYPE'];}?>"
                                            
                                            value="<?= $value ?: '' ?>">
                                <?php endif; ?>
                            </div>
                            <?php if ($questionId == 'email') : ?>
                                </div>
                            <?php endif; ?>

                        <?php endif; ?>
                    <?php endforeach; ?>

                    <input
                            class="submit-main-feedback-form"
                        <?= (intval($arResult["F_RIGHT"]) < 10 ? 'disabled="disabled"' : '') ?>
                            type="submit"
                            name="web_form_submit"
                            value="<?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]) ?>" />

                    <?php if ($arResult['FORM_DESCRIPTION']) : ?>
                        <div class="under-main-feedback-form">
                            <span><?= $arResult['FORM_DESCRIPTION'] ?></span>
                        </div>
                    <?php endif; ?>
                </div>

            <?= $arResult["FORM_FOOTER"] ?>
            <?php CJSCore::Init(['masked_input']); ?>
                <script>
                    BX.ready(function() {
                        if (BX('phone_input')) {
                            new BX.MaskedInput({
                                mask: '+7 (999) 999-99-99',
                                input: BX('phone_input'),
                                placeholder: '_'
                            });
                        }
                    });
                </script>

            <?php endif;?>
        </div>
    </div>
</div>