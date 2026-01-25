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
 * @var string $templateFolder
 */
?>

<div class="sign-course-form-block">
    <div class="container sign-course-form-container">
        <div class="left-sign-course-block">
            <h2><?= Loc::getMessage('FORM_DESCRIPTION') ?></h2>
        </div>
        <div class="questions-block">
            <?= $arResult["FORM_HEADER"] ?>
            <div class="form-table data-table">
                <?php foreach ($arResult["QUESTIONS"] as $questionId => $question) : ?>
                    <?php if ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') : ?>
                        <?php echo $question['HTML_CODE']; ?>
                    <?php else : ?>
                        <?php if ($questionId == 'PHONE') : ?>
                            <div class="flex-question-block">
                            <?php endif; ?>
                            <?php
                            $customClass = '';

                            switch ($questionId) {
                                case 'FILE':
                                    $customClass = 'custom-file-upload';
                                    break;

                                case 'TYPE':
                                    $customClass = 'custom-multiselect';
                                    break;
                            }
                            ?>
                            <div class="question-block <?= $questionId ?> <?= $customClass ?>">
                                <?php if ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'checkbox') : ?>
                                    <input
                                        <?= ($question['REQUIRED'] == 'Y') ? 'required' : '' ?>
                                        name="form_checkbox_<?= $questionId ?>[]"
                                        value="<?= $question['STRUCTURE'][0]['ID'] ?>"
                                        type="<?= $question['STRUCTURE'][0]['FIELD_TYPE'] ?>"
                                        id="<?= $question['STRUCTURE'][0]['ID'] ?>">
                                    <span><?= $question['CAPTION'] ?></span>
                                <?php elseif ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'file') : ?>
                                    <div class="file-upload-wrapper">
                                        <input
                                            class="inputfile sign-course-form-input <?= $questionId ?> <?= isset($arResult['FORM_ERRORS'][$questionId]) ? 'has-error' : '' ?>"
                                            <?= ($question['REQUIRED'] == 'Y') ? 'required' : '' ?>
                                            <?= ($questionId == 'client_id') ? 'id="clientID"' : '' ?>
                                            name="form_file_<?= $question['STRUCTURE'][0]['ID'] ?>"
                                            id="file_upload_<?= $question['STRUCTURE'][0]['ID'] ?>"
                                            type="<?= $question['STRUCTURE'][0]['FIELD_TYPE'] ?>"
                                            accept=".doc,.docx,.pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf">

                                        <label for="file_upload_<?= $question['STRUCTURE'][0]['ID'] ?>" class="custom-file-btn">
                                            <span class="btn-text"><?= Loc::getMessage('FILE_TEXT') ?></span>
                                        </label>

                                        <div class="file-info" style="display: none;">
                                            <span class="file-name"></span>
                                            <button type="button" class="clear-file-btn">
                                                <?= Loc::getMessage('FILE_DELETE') ?>
                                            </button>
                                        </div>
                                    </div>
                                <?php elseif ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'multiselect') : ?>
                                    <?= $question['HTML_CODE']; ?>
                                <?php else : ?>
                                    <input
                                        class="inputtext sign-course-form-input <?= $questionId ?> <?= isset($arResult['FORM_ERRORS'][$questionId]) ? 'has-error' : '' ?>"
                                        <?= ($question['REQUIRED'] == 'Y') ? 'required' : '' ?>
                                        <?= ($questionId == 'client_id') ? 'id="clientID"' : '' ?>
                                        placeholder="<?= $questionId == 'PHONE' ? '+7 (___) ___-____' : $question['CAPTION'] ?> <?= ($question['REQUIRED'] == 'Y') ? '' : '(не обязательно)' ?>"
                                        name="form_text_<?= $question['STRUCTURE'][0]['ID'] ?>"
                                        type="<?= $question['STRUCTURE'][0]['FIELD_TYPE'] ?>">
                                <?php endif; ?>
                            </div>
                            <?php if ($questionId == 'EMAIL') : ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <input class="submit-main-feedback-form" <?= (intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : ""); ?> type="submit" name="web_form_submit" value="<?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>" />
                <?php if ($arResult['FORM_DESCRIPTION']) : ?>
                    <div class="under-main-feedback-form">
                        <span><?= $arResult['FORM_DESCRIPTION'] ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <?= $arResult["FORM_FOOTER"] ?>
        </div>
    </div>
</div>
<?php if ($arResult['FORM_NOTE']) : ?>
    <script>
        let successBackground = document.querySelector('.success-coach-background');
        let successModal = document.querySelector('.success-coach-modal');
        let body = document.querySelector('body');

        if (successBackground && successModal && body) {
            successModal.style.display = 'block';
            successBackground.style.display = 'block';
            body.style.overflow = 'hidden';

            let closeModalBtns = successModal.querySelectorAll('.close-coach-modal');

            if (closeModalBtns) {
                closeModalBtns.forEach(btn => {
                    btn.addEventListener('click', () => {
                        location.reload();
                    });
                });
            }
        }
    </script>
<?php endif; ?>
<div class="success-coach-background" style="display: none;"></div>
<div class="success-coach-modal" style="display: none;">
    <div class="success-coach-modal-container">
        <div class="close-coach-modal btn-icon">
            <?= Functions::buildSVG('close_btn', $templateFolder . '/images') ?>
        </div>
        <span class="success-coach-title"><?= Loc::getMessage('SUCCESS_TITLE') ?></span>
        <span class="success-coach-description"><?= Loc::getMessage('SUCCESS_DESCRIPTION') ?></span>
        <div class="close-coach-modal big-btn"><?= Loc::getMessage('SUCCESS_BTN_TITLE') ?></div>
    </div>
</div>
