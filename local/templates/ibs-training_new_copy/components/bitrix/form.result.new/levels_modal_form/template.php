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

<div class="main-feedback-form-block p-0 <?=$arParams['CUSTOM_CLASSES'];?>" id="<?=$arParams['CUSTOM_ID'];?>">
    <div class="main-feedback-form-container">
        <div class="questions-block">
            <?php if ($arResult["FORM_NOTE"]) : ?>
                <p class="f-20 success-text"><?= $arResult["FORM_NOTE"] ?></p>
            <?php endif; ?>
            <?php if ($arResult["isFormNote"] != "Y") : ?>
                <?=$arResult["FORM_HEADER"]?>
                <div class="form-table data-table m-0">

                    <?php foreach ($arResult["QUESTIONS"] as $questionId => $question) : ?>

                        <?php if ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden' 
                                || $question['STRUCTURE'][0]['FIELD_TYPE'] == 'dropdown') : ?>
                            <?php echo $question['HTML_CODE']; ?>
                            <?
                            // echo '<pre>';
                            // var_dump($question['CAPTION']);
                            // echo '</pre>';
                            ?>
                            <script>
                                $(document).ready(function () {
                                    const selectText = $('select[id^="form_dropdown_"]').next().find('.jq-selectbox__select-text');
                                    // console.log(selectText);
                                    selectText.text('<?=$question['CAPTION'];?>');
                                });
                            </script>

                        <?php elseif ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'radio') : ?>

                            
                            <div class="form-radio-btns">
                                
                            <?
                                foreach ($question['STRUCTURE'] as $key => $item) {?>

                                <label class="form-radio-btns__item">
                                    <input
                                        <?= ($item['REQUIRED'] == 'Y') ? 'required' : '' ?>
                                        <?= (!empty($item['FIELD_PARAM'])) ? ' '.$item['FIELD_PARAM'] : '' ?>
                                        name="form_radio_<?= $questionId ?>[]"
                                        type="<?= $item['FIELD_TYPE'] ?>"
                                        id="<?= $item['ID'] ?>"
                                        value="<?= $item['ID'] ?>">
                                        <span>
                                            <?= $item['MESSAGE'] ?>
                                        </span>
                                </label>
                            <?}?>
                            </div>

                        <?php else : ?>
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
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <input class="submit-main-feedback-form btn--dark bg--blue" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
                </div>
                <?=$arResult["FORM_FOOTER"]?>
            <?php endif; ?>
        </div>
    </div>
</div>