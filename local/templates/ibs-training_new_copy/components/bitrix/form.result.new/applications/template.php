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

$certLevels = [];
?>

<div class="main-feedback-form-block <?=$arParams['CUSTOM_CLASSES'];?>" id="applicationsFormBlock">
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
                        <?=$arResult["FORM_HEADER"]?>
                        <div class="form-table data-table">
                            <?php
                            // echo $arResult["QUESTIONS"]["cert_location"]["HTML_CODE"];
                            // unset($arResult["QUESTIONS"]["cert_location"]);
                            ?>
        
                            <?php foreach ($arResult["QUESTIONS"] as $questionId => $question) : ?>
        
                                <?php if ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'dropdown') : ?>
                                    <?php
                                        echo $question['HTML_CODE'];

                                        if ($questionId == 'cert_level') {
                                            foreach ($question['STRUCTURE'] as $value) {
                                                $certLevels[] = [
                                                    'ID' => $value['ID'],
                                                    'VALUE' => $value['VALUE'],
                                                    'TEXT' => $value['MESSAGE']
                                                ];
                                            }
                                        }
                                    ?>
                                    <script>
                                        $(document).ready(function () {
                                            const selectText = $('select[id^="form_dropdown_"]').next().find('.jq-selectbox__select-text');
                                            selectText.text('<?=$question['STRUCTURE'][0]['MESSAGE'];?>');
                                        });
                                    </script>
        
                                <?php elseif ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'radio') : ?>
                                    <div class="form-radio-btns">
                                    <?php
                                        foreach ($question['STRUCTURE'] as $key => $item) { ?>
        
                                            <label class="form-radio-btns__item">
                                                <input
                                                        <?= ($item['REQUIRED'] == 'Y') ? 'required' : '' ?>
                                                        <?= (!empty($item['FIELD_PARAM'])) ? ' '.$item['FIELD_PARAM'] : '' ?>
                                                        name="form_radio_<?= $questionId ?>[]"
                                                        type="<?= $item['FIELD_TYPE'] ?>"
                                                        id="<?= $item['ID'] ?>"
                                                        value="<?= $item['ID'] ?>"
                                                        data-value="<?= $item['VALUE'] ?>"
                                                    >
                                                    <span>
                                                        <?= $item['MESSAGE'] ?>
                                                    </span>
                                            </label>
                                        <?php } ?>
                                    </div>
                                <?php elseif ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') : ?>
                                    <?php if ($questionId == 'course_name') : ?>
                                            <input
                                                class="inputtext main-feedback-form-input <?= $questionId ?>"
                                                name="form_hidden_<?= $question['STRUCTURE'][0]['ID'] ?>"
                                                type="<?= $question['STRUCTURE'][0]['FIELD_TYPE'] ?>"
                                                value="<?= $arParams['COURSE_NAME'] ?>"
                                                >
                                    <?php else : ?>
                                        <?php echo $question['HTML_CODE']; ?>
                                    <?php endif; ?>
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
                                    <?php if ($questionId == 'date') : ?>
                                        <div class="dates-block">
                                            <div class="take-date-block">
                                                <div class="select-dates-block basic">
                                                    <?php if (!empty($arParams['BASIC_DATES'])) { ?>
                                                        <?php foreach ($arParams['BASIC_DATES'] as $cityCode => $dates) : ?>
                                                            <div class="select-dates <?= $cityCode?>">
                                                                <div class="select-dates-content">
                                                                    <span class="f-24"><?= $dates[0] ?></span>
                                                                    <?= Functions::buildSVG('down-arrow-icon', $templateFolder . '/images'); ?>
                                                                </div>
                                                                <div class="select-dates-dropdown-block">
                                                                    <?php foreach ($dates as $date) : ?>
                                                                        <div class="select-date">
                                                                            <span class="f-24"><?= $date ?></span>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <? } ?>
                                                    <div class="select-date-input">
                                                        <input class="inputtext select-free-date main-feedback-form-input <?= $questionId ?>" type="date">
                                                    </div>
                                                </div>
                                                <div class="select-dates-block spec">
                                                    <?php if (!empty($arParams['SPEC_DATES'])) { ?>
                                                        <?php foreach ($arParams['SPEC_DATES'] as $cityCode => $dates) : ?>
                                                            <div class="select-dates <?= $cityCode?>">
                                                                <div class="select-dates-content">
                                                                    <span class="f-24"><?= $dates[0] ?></span>
                                                                    <?= Functions::buildSVG('down-arrow-icon', $templateFolder . '/images'); ?>
                                                                </div>
                                                                <div class="select-dates-dropdown-block">
                                                                    <?php foreach ($dates as $date) : ?>
                                                                        <div class="select-date">
                                                                            <span class="f-24"><?= $date ?></span>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <? } ?>
                                                    <div class="select-date-input">
                                                        <input class="inputtext select-free-date main-feedback-form-input <?= $questionId ?>" type="date">
                                                    </div>
                                                </div>
                                                <div class="select-dates-block prof">
                                                    <?php if (!empty($arParams['PROF_DATES'])) { ?>
                                                        <?php foreach ($arParams['PROF_DATES'] as $cityCode => $dates) : ?>
                                                            <div class="select-dates <?= $cityCode?>">
                                                                <div class="select-dates-content">
                                                                    <span class="f-24"><?= $dates[0] ?></span>
                                                                    <?= Functions::buildSVG('down-arrow-icon', $templateFolder . '/images'); ?>
                                                                </div>
                                                                <div class="select-dates-dropdown-block">
                                                                    <?php foreach ($dates as $date) : ?>
                                                                        <div class="select-date">
                                                                            <span class="f-24"><?= $date ?></span>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <? } ?>
                                                    <div class="select-date-input">
                                                        <input class="inputtext select-free-date main-feedback-form-input <?= $questionId ?>" type="date">
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if (!empty($certLevels)) : ?>
                                                <div class="cert-levels">
                                                    <?php foreach ($certLevels as $certLevel) : ?>
                                                        <div class="cert-level" data-id="<?= $certLevel['ID'] ?>" data-value="<?= $certLevel['VALUE'] ?>">
                                                            <?= $certLevel['TEXT'] ?>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <input class="submit-main-feedback-form" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
                        </div>
                        <?=$arResult["FORM_FOOTER"]?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>