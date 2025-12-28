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
                <?= $arResult["FORM_TITLE"] ?>
            </h2>
            <?php if ($arResult["isFormDescription"] == "Y"): ?>
                <p><?= $arResult["FORM_DESCRIPTION"] ?></p>
            <?php endif; ?>
        </div>

        <?= $arResult["FORM_HEADER"] ?>

        <div class="contact__form">
            
            <?php foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion): ?>
                <?php if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden'): ?>
                    <?= $arQuestion["HTML_CODE"] ?>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion): ?>
                <?php if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') continue; ?>

                <?php
                $fieldType = $arQuestion['STRUCTURE'][0]['FIELD_TYPE'];
                $isRequired = $arQuestion["REQUIRED"] === "Y";
                $isError = !empty($arResult["FORM_ERRORS"][$FIELD_SID]);
                $errorClass = $isError ? 'error' : '';
                $placeholder = htmlspecialcharsbx($arQuestion["CAPTION"]);
                if ($isRequired && strpos($placeholder, '*') === false) {
                    $placeholder .= ' *';
                }
                $fieldNameLower = mb_strtolower($arQuestion["CAPTION"]);
                $inputType = 'text';
                $fieldWrapperClass = '';

                if (strpos($fieldNameLower, 'телефон') !== false || strpos($fieldNameLower, 'phone') !== false || strpos($fieldNameLower, 'тел') !== false) {
                    $inputType = 'tel';
                    $fieldWrapperClass = 'phone';
                } elseif (strpos($fieldNameLower, 'email') !== false || strpos($fieldNameLower, 'почт') !== false || strpos($fieldNameLower, 'e-mail') !== false) {
                    $inputType = 'email';
                    $fieldWrapperClass = 'email';
                } elseif (strpos($fieldNameLower, 'имя') !== false || strpos($fieldNameLower, 'name') !== false || strpos($fieldNameLower, 'фио') !== false) {
                    $fieldWrapperClass = 'name';
                }
                ?>

                <div class="form-field <?= $errorClass ?>">

                    <?php if ($fieldType == 'textarea'): ?>
                        <?php
                        $html = $arQuestion["HTML_CODE"];
                        if (strpos($html, 'placeholder=') === false) {
                            $html = preg_replace('/<textarea/', '<textarea placeholder="' . $placeholder . '"', $html);
                        }
                        // Добавляем required, если нужно
                        if ($isRequired && strpos($html, 'required') === false) {
                            $html = str_replace('<textarea', '<textarea required', $html);
                        }
                        echo $html;
                        ?>

                    <?php elseif ($fieldType == 'checkbox'): ?>
                        <label class="checkbox <?= $errorClass ?>">
                            <?php
                            $html = $arQuestion["HTML_CODE"];
                            if ($isRequired && strpos($html, 'required') === false) {
                                $html = str_replace('<input', '<input required', $html);
                            }
                            echo $html;
                            ?>
                            <span><?= $arQuestion["CAPTION"] ?>
                                <?php if ($isRequired): ?><span class="required">*</span><?php endif; ?>
                            </span>
                        </label>

                    <?php elseif ($fieldType == 'dropdown'): ?>
                        <?php
                        $html = $arQuestion["HTML_CODE"];
                        if ($isRequired && strpos($html, 'required') === false) {
                            $html = str_replace('<select', '<select required', $html);
                        }
                        if ($isRequired && strpos($html, '<option value="">') === false && strpos($html, "<option value=''") === false) {
                            $html = str_replace('<select', '<select><option value="">— Выберите —</option>', $html);
                        }
                        echo $html;
                        ?>

                    <?php else:?>
                        <?php
                        $html = $arQuestion["HTML_CODE"];
                        if ($inputType !== 'text') {
                            $html = preg_replace('/type="text"/i', 'type="' . $inputType . '"', $html);
                        }

                        if ($isRequired && strpos($html, 'required') === false) {
                            $html = str_replace('<input', '<input required', $html);
                        }

                        if ($isError) {
                            if (strpos($html, 'class="') !== false) {
                                $html = preg_replace('/class="([^"]*)"/', 'class="$1 error"', $html);
                            } else {
                                $html = str_replace('<input ', '<input class="error" ', $html);
                            }
                        }

                        if (strpos($html, 'placeholder=') === false) {
                            $html = preg_replace('/<input/', '<input placeholder="' . $placeholder . '"', $html);
                        }

                        echo '<div class="question-block ' . $fieldWrapperClass . '">' . $html . '</div>';
                        ?>

                    <?php endif; ?>

                    <?php if ($isError): ?>
                        <span class="form-error"><?= htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID]) ?></span>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>
            <?php if ($arResult["isUseCaptcha"] == "Y"): ?>
                <div class="captcha-container">
                    <label class="field-label"><?= GetMessage("FORM_CAPTCHA_TABLE_TITLE") ?></label>
                    <input type="hidden" name="captcha_sid" value="<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>" />
                    <div style="margin-bottom: 10px;">
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>" width="180" height="40" alt="CAPTCHA"/>
                    </div>
                    <label class="field-label">
                        <?= GetMessage("FORM_CAPTCHA_FIELD_TITLE") ?> <span class="required">*</span>
                    </label>
                    <input
                            type="text"
                            name="captcha_word"
                            placeholder="<?= GetMessage("FORM_CAPTCHA_FIELD_TITLE") ?> *"
                            class="inputtext <?= !empty($arResult['FORM_ERRORS']['captcha_word']) ? 'error' : '' ?>"
                            required
                    >
                    <?php if (!empty($arResult['FORM_ERRORS']['captcha_word'])): ?>
                        <span class="form-error"><?= htmlspecialcharsbx($arResult['FORM_ERRORS']['captcha_word']) ?></span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div style="display: flex; gap: 24px; flex-direction: column;">
                <input
                        type="submit"
                        name="web_form_submit"
                        value="<?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>"
                    <?= (intval($arResult["F_RIGHT"]) < 10 ? "disabled" : "") ?>
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
