<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
    die();
}

/**
 * @var array $arResult
 */
?>

<div class="custom-popup-overlay" id="customSuccessPopup">
    <div class="custom-popup">
        <button class="custom-popup__close" onclick="closeCustomPopup()">
            <div class="custom-popup__close-icon"></div>
        </button>
        <div class="custom-popup__content">
            <h2 class="custom-popup__title">Запрос отправлен</h2>
            <div class="custom-popup__message">
                Документ будет загружен в Личный кабинет в течение<br>
                7 календарных дней
            </div>
            <div class="custom-popup__button-container">
                <a href="/personal/docs/" class="custom-popup__button">Закрыть</a>
            </div>
        </div>
    </div>
</div>

<section class="contact">
    <div class="contact__content">

        <div class="contact__text">
            <h2>
                <?= $arResult["isFormTitle"] ? $arResult["FORM_TITLE"] : 'Нужна помощь? Оставьте заявку, и мы свяжемся с вами в ближайшее время' ?>
            </h2>
            <?php if ($arResult["isFormDescription"] == "Y"): ?>
                <p><?= $arResult["FORM_DESCRIPTION"] ?></p>
            <?php endif; ?>
        </div>

        <?= $arResult["FORM_HEADER"] ?>
        <div class="contact__form">
            <?php
            foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):
                if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden'):
                    echo $arQuestion["HTML_CODE"];
                endif;
            endforeach;
            ?>

            <?php
            foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):
                if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] != 'hidden'):
                    $fieldType = $arQuestion['STRUCTURE'][0]['FIELD_TYPE'];
                    $isError = isset($arResult["FORM_ERRORS"][$FIELD_SID]);
                    $fieldClass = $isError ? 'error' : '';
                    $placeholder = htmlspecialcharsbx($arQuestion["CAPTION"]);

                    if ($arQuestion["REQUIRED"] == "Y" && !strpos($placeholder, '*')) {
                        $placeholder .= ' *';
                    }

                    $fieldName = strtolower($arQuestion["CAPTION"]);

                    $inputType = 'text';
                    $fieldTypeClass = '';

                    if (strpos($fieldName, 'телефон') !== false || strpos($fieldName, 'phone') !== false || strpos($fieldName, 'тел') !== false) {
                        $inputType = 'tel';
                        $fieldTypeClass = 'phone';
                    } elseif (strpos($fieldName, 'email') !== false || strpos($fieldName, 'почт') !== false || strpos($fieldName, 'e-mail') !== false) {
                        $inputType = 'email';
                        $fieldTypeClass = 'email';
                    } elseif (strpos($fieldName, 'имя') !== false || strpos($fieldName, 'name') !== false || strpos($fieldName, 'фио') !== false) {
                        $fieldTypeClass = 'name';
                    }
                    ?>

                    <div class="form-field">
                        <?php if ($fieldType == 'textarea'): ?>

                            <?php
                            $textareaHtml = $arQuestion["HTML_CODE"];
                            if ($arQuestion["REQUIRED"] == "Y" && strpos($textareaHtml, 'required') === false) {
                                $textareaHtml = str_replace('<textarea', '<textarea required', $textareaHtml);
                            }
                            echo $textareaHtml;
                            ?>
                            <?php if ($isError): ?>
                                <span class="form-error"><?= $arResult["FORM_ERRORS"][$FIELD_SID] ?></span>
                            <?php endif; ?>

                        <?php elseif ($fieldType == 'checkbox'): ?>
                            <label class="checkbox <?= $fieldClass ?>">
                                <?php
                                $checkboxHtml = $arQuestion["HTML_CODE"];
                                if ($arQuestion["REQUIRED"] == "Y" && strpos($checkboxHtml, 'required') === false) {
                                    $checkboxHtml = str_replace('<input', '<input required', $checkboxHtml);
                                }
                                echo $checkboxHtml;
                                ?>
                                <span><?= $arQuestion["CAPTION"] ?>
                                    <?php if ($arQuestion["REQUIRED"] == "Y"): ?>
                                        <span class="required">*</span>
                                    <?php endif; ?>
                                </span>
                                <?php if ($isError): ?>
                                    <span class="form-error"><?= $arResult["FORM_ERRORS"][$FIELD_SID] ?></span>
                                <?php endif; ?>
                            </label>

                        <?php elseif ($fieldType == 'dropdown'): ?>

                            <?php
                            $selectHtml = $arQuestion["HTML_CODE"];
                            if ($arQuestion["REQUIRED"] == "Y" && strpos($selectHtml, 'required') === false) {
                                $selectHtml = str_replace('<select', '<select required', $selectHtml);
                            }
                            echo $selectHtml;
                            ?>
                            <?php if ($isError): ?>
                                <span class="form-error"><?= $arResult["FORM_ERRORS"][$FIELD_SID] ?></span>
                            <?php endif; ?>

                        <?php else: ?>
                            <?php
                            $fieldHtml = $arQuestion["HTML_CODE"];

                            if ($inputType !== 'text') {
                                $fieldHtml = preg_replace('/type="text"/', 'type="' . $inputType . '"', $fieldHtml);
                            }
                            if ($arQuestion["REQUIRED"] == "Y" && strpos($fieldHtml, 'required') === false) {
                                $fieldHtml = str_replace('<input', '<input required', $fieldHtml);
                            }

                            if ($isError) {
                                $fieldHtml = preg_replace('/class="([^"]*)"/', 'class="$1 ' . $fieldClass . '"', $fieldHtml);
                                if (strpos($fieldHtml, 'class="') === false) {
                                    $fieldHtml = str_replace('<input ', '<input class="' . $fieldClass . '" ', $fieldHtml);
                                }
                            }

                            if (strpos($fieldHtml, 'placeholder=') === false) {
                                $fieldHtml = preg_replace('/<input/', '<input placeholder="' . $placeholder . '"', $fieldHtml);
                            }
                            ?>

                            <div class="question-block <?= $fieldTypeClass ?>">
                                <?= $fieldHtml ?>
                            </div>

                            <?php if ($isError): ?>
                                <span class="form-error"><?= $arResult["FORM_ERRORS"][$FIELD_SID] ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                <?php endif; ?>
            <?php endforeach; ?>

            <?php if($arResult["isUseCaptcha"] == "Y"): ?>
                <div class="captcha-container">
                    <label class="field-label">
                        <?= GetMessage("FORM_CAPTCHA_TABLE_TITLE") ?>
                    </label>
                    <input type="hidden" name="captcha_sid" value="<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>" />
                    <div style="margin-bottom: 10px;">
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>" width="180" height="40" alt="CAPTCHA"/>
                    </div>
                    <label class="field-label">
                        <?= GetMessage("FORM_CAPTCHA_FIELD_TITLE") ?>
                        <span class="required">*</span>
                    </label>
                    <input
                            type="text"
                            name="captcha_word"
                            placeholder="<?= GetMessage("FORM_CAPTCHA_FIELD_TITLE") ?> *"
                            class="inputtext"
                            required
                    >
                </div>
            <?php endif; ?>

            <div style="display: flex; gap: 24px; flex-direction: column;">
                <input
                        type="submit"
                        name="web_form_submit"
                        value="<?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>"
                    <?= (intval($arResult["F_RIGHT"]) < 10 ? "disabled" : ""); ?>
                />
            </div>

            <?php if ($arResult["REQUIRED_SIGN"]): ?>
                <p style="font-size: 12px; margin-top: 10px;">
                    <?= $arResult["REQUIRED_SIGN"] ?> - <?= GetMessage("FORM_REQUIRED_FIELDS") ?>
                </p>
            <?php endif; ?>
        </div>

        <?= $arResult["FORM_FOOTER"] ?>
    </div>
</section>