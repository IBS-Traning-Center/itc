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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function validateEmail(email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

        function validatePhone(phone) {
            const re = /^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/;
            return re.test(String(phone).replace(/\s+/g, ''));
        }

        const emailFields = document.querySelectorAll('input[type="email"]');
        emailFields.forEach(function(field) {
            field.addEventListener('blur', function() {
                if (this.value && !validateEmail(this.value)) {
                    this.setCustomValidity('Введите корректный email адрес');
                } else {
                    this.setCustomValidity('');
                }
            });

            field.addEventListener('input', function() {
                this.setCustomValidity('');
            });
        });

        const telFields = document.querySelectorAll('input[type="tel"]');
        telFields.forEach(function(field) {
            // Маска для телефона
            field.addEventListener('input', function(e) {
                let value = this.value.replace(/\D/g, '');
                if (value.length > 0) {
                    if (value[0] === '7' || value[0] === '8') {
                        value = value.substring(1);
                    }
                    if (value.length > 10) {
                        value = value.substring(0, 10);
                    }

                    let formattedValue = '+7 ';
                    if (value.length > 0) {
                        formattedValue += '(' + value.substring(0, 3);
                    }
                    if (value.length > 3) {
                        formattedValue += ') ' + value.substring(3, 6);
                    }
                    if (value.length > 6) {
                        formattedValue += '-' + value.substring(6, 8);
                    }
                    if (value.length > 8) {
                        formattedValue += '-' + value.substring(8, 10);
                    }
                    this.value = formattedValue;
                }
            });

            field.addEventListener('blur', function() {
                if (this.value && !validatePhone(this.value)) {
                    this.setCustomValidity('Введите корректный номер телефона');
                } else {
                    this.setCustomValidity('');
                }
            });

            field.addEventListener('input', function() {
                this.setCustomValidity('');
            });
        });

        const form = document.querySelector('.contact__form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                let isValid = true;

                emailFields.forEach(function(field) {
                    if (field.value && !validateEmail(field.value)) {
                        isValid = false;
                        field.setCustomValidity('Введите корректный email адрес');
                        field.style.outline = '2px solid #ff6b6b';
                    }
                });

                telFields.forEach(function(field) {
                    if (field.value && !validatePhone(field.value)) {
                        isValid = false;
                        field.setCustomValidity('Введите корректный номер телефона');
                        field.style.outline = '2px solid #ff6b6b';
                    }
                });

                if (!isValid) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'form-error-message';
                    errorDiv.style.cssText = 'color: #FF6B6B; font-family: Stag Sans; font-size: 14px; margin-bottom: 15px; padding: 10px; background: rgba(255,107,107,0.1);';
                    errorDiv.innerHTML = 'Пожалуйста, проверьте корректность заполнения полей Email и Телефона';

                    const oldErrors = form.querySelectorAll('.form-error-message');
                    oldErrors.forEach(error => error.remove());

                    form.insertBefore(errorDiv, form.firstChild);
                    return;
                }

                const submitBtn = form.querySelector('input[type="submit"]');
                const originalText = submitBtn.value;
                submitBtn.value = 'Отправка...';
                submitBtn.disabled = true;

                const formData = new FormData(form);

                if (typeof BX !== 'undefined' && BX.bitrix_sessid) {
                    formData.append('sessid', BX.bitrix_sessid());
                }

                fetch(form.action || window.location.href, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.text())
                    .then(data => {
                        showCustomPopup();

                        form.reset();

                        emailFields.forEach(field => {
                            field.style.outline = 'none';
                            field.setCustomValidity('');
                        });

                        telFields.forEach(field => {
                            field.style.outline = 'none';
                            field.setCustomValidity('');
                        });
                    })
                    .catch(error => {
                        console.error('Ошибка отправки формы:', error);
                        alert('Произошла ошибка при отправке формы. Попробуйте еще раз.');
                    })
                    .finally(() => {
                        submitBtn.value = originalText;
                        submitBtn.disabled = false;
                    });
            });
        }

        if (window.location.search.indexOf('formresult=addok') !== -1) {
            setTimeout(showCustomPopup, 500);
        }
    });

    function showCustomPopup() {
        const popup = document.getElementById('customSuccessPopup');
        if (popup) {
            popup.classList.add('active');
            document.body.style.overflow = 'hidden';

            if (window.history && window.history.replaceState) {
                const newUrl = window.location.pathname;
                window.history.replaceState({}, document.title, newUrl);
            }
        }
    }

    function closeCustomPopup() {
        const popup = document.getElementById('customSuccessPopup');
        if (popup) {
            popup.classList.remove('active');
            document.body.style.overflow = 'auto';

            window.location.href = '/personal/docs/';
        }
    }

    document.addEventListener('click', function(e) {
        const popup = document.getElementById('customSuccessPopup');
        if (popup && popup.classList.contains('active') && e.target === popup) {
            closeCustomPopup();
        }
    });

    document.addEventListener('keydown', function(e) {
        const popup = document.getElementById('customSuccessPopup');
        if (popup && popup.classList.contains('active') && e.key === 'Escape') {
            closeCustomPopup();
        }
    });
</script>



<section class="contact">
    <div class="contact__content container">

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

                            <?= $arQuestion["HTML_CODE"] ?>
                            <?php if ($isError): ?>
                                <span class="form-error"><?= $arResult["FORM_ERRORS"][$FIELD_SID] ?></span>
                            <?php endif; ?>

                        <?php elseif ($fieldType == 'checkbox'): ?>
                            <label class="checkbox <?= $fieldClass ?>">
                                <?= $arQuestion["HTML_CODE"] ?>
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

                            <?= $arQuestion["HTML_CODE"] ?>
                            <?php if ($isError): ?>
                                <span class="form-error"><?= $arResult["FORM_ERRORS"][$FIELD_SID] ?></span>
                            <?php endif; ?>

                        <?php else: ?>
                            <?php
                            $fieldHtml = $arQuestion["HTML_CODE"];

                            if ($inputType !== 'text') {
                                $fieldHtml = preg_replace('/type="text"/', 'type="' . $inputType . '"', $fieldHtml);
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
                            placeholder="<?= GetMessage("FORM_CAPTCHA_FIELD_TITLE") ?>"
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