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
                        <?php if ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') : ?>
                            <?php echo $question['HTML_CODE']; ?>
                        <?php else : ?>
                            <?php if ($questionId == 'email') : ?>
                                <div class="flex-question-block">
                            <?php endif; ?>
                            <div class="question-block <?= $questionId ?>">
                                <input
                                        class="inputtext main-feedback-form-input <?= $questionId ?> <?= isset($arResult['FORM_ERRORS'][$questionId]) ? 'has-error' : '' ?>"
                                        <?= ($question['REQUIRED'] == 'Y') ? 'required' : '' ?>
                                        placeholder="<?= $question['CAPTION'] ?> <?= ($question['REQUIRED'] == 'Y') ? '*' : '(не обязательно)' ?>"
                                        name="form_text_<?= $question['STRUCTURE'][0]['ID'] ?>"
                                        type="<?= $question['STRUCTURE'][0]['FIELD_TYPE'] ?>">
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