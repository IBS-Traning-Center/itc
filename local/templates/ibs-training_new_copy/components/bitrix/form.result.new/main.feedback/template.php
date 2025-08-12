<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;
use Local\Util\Functions;

Loc::loadMessages(__FILE__);

/**
 * @var array $arResult
 * @var array $arParams
 */

?>

<div class="main-feedback-form-block <?= $arParams['CUSTOM_CLASSES']; ?>" id="mainFeedbackFormBlock">
    <div class="container main-feedback-form-container">
        <div class="row g-4 g-xxl-5">
            <?php if ($arResult['arForm']['NAME']) : ?>
                <div class="col-12 col-xl 6">
                    <h2 class="title--h2"><?= $arResult['arForm']['NAME'] ?></h2>

                    <?php if ($arResult['FORM_DESCRIPTION']) : ?>
                        <div class="main-feedback-form-description">
                            <?= $arResult['FORM_DESCRIPTION'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="col-12 col-xl 6">
                <div class="questions-block">
                    <?php if ($arResult["FORM_NOTE"]) : ?>
                        <p class="f-20 success-text"><?= $arResult["FORM_NOTE"] ?></p>
                    <?php endif; ?>
                    <?php if ($arResult["isFormNote"] != "Y") : ?>
                        <?= $arResult["FORM_HEADER"] ?>
                        <div class="form-table data-table">
                            <?php
                            // echo $arResult["QUESTIONS"]["cert_location"]["HTML_CODE"];
                            // unset($arResult["QUESTIONS"]["cert_location"]);
                            ?>

                            <?php foreach ($arResult["QUESTIONS"] as $questionId => $question) : ?>

                                <?php if (
                                    $question['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden'
                                    || $question['STRUCTURE'][0]['FIELD_TYPE'] == 'dropdown'
                                ) : ?>
                                    <?php
                                    if ($questionId == 'expert_testing' || $questionId == 'cert_direction') { ?>
                                        <div class="question-block-caption"><?= $question['CAPTION']; ?> </div>
                                    <? } ?>
                                    <?php echo $question['HTML_CODE']; ?>

                                    <script>
                                        //$(document).ready(function() {
                                        //    const selectText = $('select[id^="form_dropdown_"]').next().find('.jq-selectbox__select-text');
                                        //    selectText.text('<?//= $question['CAPTION']; ?>');
                                        //    $('.jq-selectbox__dropdown li:first').removeClass('sel').removeClass('selected');
                                        //});
                                    </script>

                                <?php elseif ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'radio') : ?>

                                    <div class="form-radio-btns">

                                        <?
                                        foreach ($question['STRUCTURE'] as $key => $item) { ?>

                                            <label class="form-radio-btns__item">
                                                <input
                                                    <?= ($item['REQUIRED'] == 'Y') ? 'required' : '' ?>
                                                    <?= (!empty($item['FIELD_PARAM'])) ? ' ' . $item['FIELD_PARAM'] : '' ?>
                                                    name="form_radio_<?= $questionId ?>[]"
                                                    type="<?= $item['FIELD_TYPE'] ?>"
                                                    id="<?= $item['ID'] ?>"
                                                    value="<?= $item['ID'] ?>">
                                                <span>
                                                    <?= $item['MESSAGE'] ?>
                                                </span>
                                            </label>
                                        <? } ?>
                                    </div>

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
                                                    class="inputtext main-feedback-form-input <?= $questionId ?> <?= isset($arResult['FORM_ERRORS'][$questionId]) ? 'has-error' : '' ?>"
                                                    <?= ($question['REQUIRED'] == 'Y') ? 'required' : '' ?>
                                                    <?= ($questionId == 'client_id') ? 'id="clientID"' : '' ?>
                                                    placeholder="<?= $question['CAPTION'] ?> <?= ($question['REQUIRED'] == 'Y') ? '*' : '(не обязательно)' ?>"
                                                    name="form_text_<?= $question['STRUCTURE'][0]['ID'] ?>"
                                                    type="<?= $question['STRUCTURE'][0]['FIELD_TYPE'] ?>">
                                            <?php endif; ?>
                                        </div>
                                        <?php if ($questionId == 'phone') : ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <input class="submit-main-feedback-form" <?= (intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : ""); ?> type="submit" name="web_form_submit" value="<?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>" />
                        </div>
                        <?= $arResult["FORM_FOOTER"] ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($arResult["FORM_NOTE"]) : ?>
    <div class="success-modal-form-block">
        <div class="success-modal-form-content">
            <span class="close-success-modal"><?= Functions::buildSVG('close-modal', $templateFolder . '/images') ?></span>
            <span class="modal-success-title"><?= Loc::getMessage('SUCCESS_FORM_TITLE') ?></span>
            <p class="description-text"><?= Loc::getMessage('SUCCESS_FORM_DESCRIPTION') ?></p>
            <button class="close-success-modal"><?= Loc::getMessage('SUCCESS_BTN_TEXT') ?></button>
        </div>
    </div>
    <div class="success-modal-form-background"></div>

    <script>
        let closeModalBtns = document.querySelectorAll('.close-success-modal');
        let successModal = document.querySelector('.success-modal-form-block');
        let successBackModal = document.querySelector('.success-modal-form-background');

        if (successBackModal && successModal && closeModalBtns) {
            closeModalBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    reloadPage();
                });
            });

            successBackModal.addEventListener('click', () => {
                reloadPage();
            });
        }

        function reloadPage()
        {
            const url = new URL(window.location.href);
            url.searchParams.set('scrollTo', 'mainFeedbackFormBlock');
            window.location.href = url.toString();
        }
    </script>
<?php endif; ?>