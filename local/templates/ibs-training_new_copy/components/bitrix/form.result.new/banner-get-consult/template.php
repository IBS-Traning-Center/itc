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

<div class="main-feedback-form-block <?=$arParams['CUSTOM_CLASSES'];?>" id="bannerGetConsultFormBlock">
    <div class="container main-feedback-form-container">
        <!-- <div class="row g-4 g-xxl-5"> -->
            <?php if ($arResult['arForm']['NAME']) : ?>
                <!-- <div class="col-12 col-xl 6"> -->
                    <h2 class="title--h1 mb-4 mb-xxl-5"><?= $arResult['arForm']['NAME'] ?></h2>

                    <?php if ($arResult['FORM_DESCRIPTION']) : ?>
                        <div class="main-feedback-form-description mt-5">
                            <?= $arResult['FORM_DESCRIPTION'] ?>
                        </div>
                    <?php endif; ?>
                <!-- </div> -->
            <?php endif; ?>
            <!-- <div class="col-12 col-xl 6"> -->
                <div class="questions-block">
                    <?php if ($arResult["isFormNote"] != "Y") : ?>
                        <?=$arResult["FORM_HEADER"]?>
                        <div class="form-table data-table row">
        
                            <?php foreach ($arResult["QUESTIONS"] as $questionId => $question) : ?>

                                <?php if ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'checkbox') :

                                    // empty need be
                                
                                    
                                else : ?>
                                    <?php if ($questionId == 'phone' || $questionId == 'email') : ?>
                                        <div class="col-12 col-lg-4">
                                    <?php endif; ?>

                                        <div class="question-block <?= $questionId ?>">            
                                            <input
                                                class="inputtext main-feedback-form-input <?= $questionId ?> <?= isset($arResult['FORM_ERRORS'][$questionId]) ? 'has-error' : '' ?>"
                                                <?= ($question['REQUIRED'] == 'Y') ? 'required' : '' ?>
                                                <?= ($questionId == 'client_id') ? 'id="clientID"' : '' ?>
                                                placeholder="<?= $question['CAPTION'] ?> <?= ($question['REQUIRED'] == 'Y') ? '*' : '(не обязательно)' ?>"
                                                name="form_text_<?= $question['STRUCTURE'][0]['ID'] ?>"
                                                type="<?= $question['STRUCTURE'][0]['FIELD_TYPE'] ?>">
                                        </div>

                                    <?php if ($questionId == 'phone' || $questionId == 'email') : ?>
                                        </div>
                                    <?php endif; ?>

                                <?php endif; ?>

                            <?php endforeach; ?>

                            <div class="col-12 col-lg-4">
                                <input class="btn--white" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> id="mainBannerFormBtn" type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
                            </div>
                        </div>
                        
                        <?php foreach ($arResult["QUESTIONS"] as $questionId => $question) : ?>
                            <?php if ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'checkbox') : ?>
                                    <?php if ($questionId == 'privacy_policy') : ?>
                                        <div class="col-12">
                                    <?php endif; ?>

                                    <div class="question-block <?= $questionId ?>">
                                        <input
                                            <?= ($question['REQUIRED'] == 'Y') ? 'required' : '' ?>
                                            name="form_checkbox_<?= $questionId ?>[]"
                                            type="<?= $question['STRUCTURE'][0]['FIELD_TYPE'] ?>"
                                            id="<?= $question['STRUCTURE'][0]['ID'] ?>"
                                            value="<?= $question['STRUCTURE'][0]['ID'] ?>">
                                        <span><?= $question['CAPTION'] ?></span>
                                    </div>

                                    <?php if ($questionId == 'agree_of_subject') : ?>
                                        </div>
                                    <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <!-- </div> -->
        <!-- </div> -->
    </div>
</div>