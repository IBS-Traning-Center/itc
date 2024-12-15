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

$settings = Functions::getSiteSettings();

?>

<div class="sign-course-form-block">
    <div class="container sign-course-form-container">
        <div class="left-sign-course-block">
            <?php if ($arResult['arForm']['NAME']) : ?>
                <h1><?= $arResult['arForm']['NAME'] ?></h1>
            <?php endif; ?>
            <?php if ($arParams['OLD_PRICE']) : ?>
                <p class="f-24 old-price"><?= $arParams['OLD_PRICE'] ?></p>
            <?php endif; ?>
            <?php if ($arParams['COURSE_PRICE']) : ?>
                <p class="course-price"><?= $arParams['COURSE_PRICE'] . ' ₽' ?></p>
            <?php endif; ?>
            <?php if ($arParams['UR_PRICE'] || $arParams['COURSE_PRICE']) : ?>
                <?php if ($arParams['UR_PRICE']) : ?>
                    <p class="f-24 price-for-ur"><?= Loc::getMessage('PRICE_FOR_UR_FACE', ['#PRICE#' => $arParams['UR_PRICE']]) ?></p>
                <?php elseif ($arParams['COURSE_PRICE']) : ?>
                    <p class="f-24 price-for-ur"><?= Loc::getMessage('PRICE_FOR_UR_FACE', ['#PRICE#' => $arParams['COURSE_PRICE']]) ?></p>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($settings['MONEY_RETURN_LINK']) : ?>
                <a href="<?= $settings['MONEY_RETURN_LINK'] ?>" class="f-16 money-return"><?= Loc::getMessage('RETURN_MONEY_TEXT') ?></a>
            <?php endif; ?>
        </div>
        <div class="questions-block">
            <?php if ($arResult["FORM_NOTE"]) : ?>
                <p class="f-20 success-text"><?= $arResult["FORM_NOTE"] ?></p>
            <?php endif; ?>
            <?php if ($arParams['COURSE_PRICE'] && !$arResult["FORM_NOTE"]) : ?>
                <div class="sign-course-tabs-block">
                    <div class="sign-course-tab phys active">
                        <span class="f-16"><?= Loc::getMessage('PHYS_FACE_TAB_TEXT', ['#PRICE#' => $arParams['COURSE_PRICE']]) ?></span>
                    </div>
                    <div class="sign-course-tab ur">
                        <?php if ($arParams['UR_PRICE']) : ?>
                            <span class="f-16"><?= Loc::getMessage('UR_FACE_TAB_TEXT', ['#PRICE#' => $arParams['UR_PRICE']]) ?></span>
                        <?php else : ?>
                            <span class="f-16"><?= Loc::getMessage('UR_FACE_TAB_TEXT', ['#PRICE#' => $arParams['COURSE_PRICE']]) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="select-dates-block" <?= ($arResult["FORM_NOTE"]) ? 'style="display: none"' : '' ?>>
                <div class="select-dates-content">
                    <span class="f-24"><?= (!empty($arParams['DATES'])) ? $arParams['DATES'][0] : Loc::getMessage('OPEN_DATES_TITLE') ?></span>
                    <?= (!empty($arParams['DATES'])) ? Functions::buildSVG('down-arrow-icon', $templateFolder . '/images') : '' ?>
                </div>
                <?php if (!empty($arParams['DATES'])) : ?>
                    <div class="select-dates-dropdown-block">
                        <?php foreach ($arParams['DATES'] as $date) : ?>
                            <div class="select-date">
                                <span class="f-24"><?= $date ?></span>
                            </div>
                        <?php endforeach; ?>
                        <div class="select-date">
                            <span class="f-24"><?= Loc::getMessage('OPEN_DATES_TITLE') ?></span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($arResult["isFormNote"] != "Y") : ?>
                <?=$arResult["FORM_HEADER"]?>
                <div class="form-table data-table">
                    <?php foreach ($arResult["QUESTIONS"] as $questionId => $question) : ?>
                        <?php
                            $value = false;

                            switch ($questionId) {
                                case 'course_id':
                                    if ($arParams['COURSE_ID']) {
                                        $value = $arParams['COURSE_ID'];
                                    }
                                    break;
                                case 'date':
                                    if (!empty($arParams['DATES'])) {
                                        $value = $arParams['DATES'][0];
                                    } else {
                                        $value = 'Открытая дата';
                                    }

                                    break;
                                case 'face':
                                    if ($arParams['COURSE_PRICE']) {
                                        $value = $arParams['COURSE_PRICE'];
                                    }
                                    break;
                                 case 'course_name':
                                    if ($arParams['COURSE_SIGN']) {
                                        $value = $arParams['COURSE_SIGN'] . ' ';
                                    }
                                    if ($arParams['COURSE_NAME']) {
                                        $value = $value . $arParams['COURSE_NAME'];
                                    }
                                    break;
                                case 'course_link':
                                    if ($arParams['COURSE_LINK']) {
                                        $value = 'https://ibs-training.ru/kurs/' . $arParams['COURSE_LINK'] . '.html';
                                    }
                                    break;
                                case 'course_name_crm':
                                    $name = false;
                                    if ($arParams['COURSE_SIGN']) {
                                        $name = $arParams['COURSE_SIGN'] . ' ';
                                    }
                                    if ($arParams['COURSE_NAME']) {
                                        $name = $name . $arParams['COURSE_NAME'];
                                    }
                                    if ($name) {
                                        $value = 'Заявка. Курс: ' . $name;
                                    }       
                                    break;
                            }
                        ?>
                        <?php if ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') : ?>
                            <?php echo $question['HTML_CODE']; ?>
                        <?php else : ?>
                            <?php if ($questionId == 'email') : ?>
                                <div class="flex-question-block">
                            <?php endif; ?>
                            <div class="question-block <?= $questionId ?>">
                                <input
                                        class="inputtext sign-course-form-input <?= $questionId ?> <?= isset($arResult['FORM_ERRORS'][$questionId]) ? 'has-error' : '' ?>"
                                        <?= ($question['REQUIRED'] == 'Y') ? 'required' : '' ?>
                                        placeholder="<?= $question['CAPTION'] ?> <?= ($question['REQUIRED'] == 'Y') ? '*' : '(не обязательно)' ?>"
                                        name="form_text_<?= $question['STRUCTURE'][0]['ID'] ?>"
                                        type="<?= $question['STRUCTURE'][0]['FIELD_TYPE'] ?>"
                                        value="<?= $value ?: '' ?>">
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