<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();




$hasGeneralErrors = !empty($arResult['ERRORS']) && is_array($arResult['ERRORS']);

$emailValue = $_POST['REGISTER']['EMAIL'] ?? ($arResult['VALUES']['EMAIL'] ?? '');
$phoneValue = $_POST['REGISTER']['PERSONAL_PHONE'] ?? ($arResult['VALUES']['PERSONAL_PHONE'] ?? '');
$cityValue = $_POST['REGISTER']['PERSONAL_CITY'] ?? ($arResult['VALUES']['PERSONAL_CITY'] ?? '');

$fullNameValue = $nameValue = $lastNameValue = $secondNameValue = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['REGISTER']['FULL_NAME'])) {
    $fullNameValue = trim($_POST['REGISTER']['FULL_NAME']);
    $nameParts = splitFIOauthauth($fullNameValue);
    $lastNameValue = $nameParts['last_name'];
    $nameValue = $nameParts['name'];
    $secondNameValue = $nameParts['second_name'];
} elseif (!empty($arResult['VALUES'])) {
    $lastNameValue = $arResult['VALUES']['LAST_NAME'] ?? '';
    $nameValue = $arResult['VALUES']['NAME'] ?? '';
    $secondNameValue = $arResult['VALUES']['SECOND_NAME'] ?? '';
    $fullNameValue = trim($lastNameValue . ' ' . $nameValue . ' ' . $secondNameValue);
}
?>

<div class="bx-custom-register">
    <div class="registration-container">
        <div class="form-frame">

            <?php if ($hasGeneralErrors): ?>
                <div class="general-errors">
                    <?php foreach ($arResult['ERRORS'] as $error): ?>
                        <div class="error-item"><?= $error ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form class="inputs-container" method="post" action="<?= POST_FORM_ACTION_URI ?>" name="regform">
                <input type="hidden" name="backurl" value="<?= $arResult['BACKURL'] ?? '' ?>" />
                <input type="hidden" name="REGISTER[NAME]" id="hiddenName" value="<?= htmlspecialcharsbx($nameValue) ?>">
                <input type="hidden" name="REGISTER[LAST_NAME]" id="hiddenLastName" value="<?= htmlspecialcharsbx($lastNameValue) ?>">
                <input type="hidden" name="REGISTER[SECOND_NAME]" id="hiddenSecondName" value="<?= htmlspecialcharsbx($secondNameValue) ?>">
                <input type="hidden" name="REGISTER[LOGIN]" id="hiddenLogin" value="<?= htmlspecialcharsbx($emailValue) ?>">

                <div class="input-field">
                    <div class="input-wrapper <?= !empty($arResult['ERRORS']['EMAIL']) ? 'error' : '' ?>">
                        <input type="email" name="REGISTER[EMAIL]" value="<?= htmlspecialcharsbx($emailValue) ?>" placeholder="Email *" required autocomplete="email">
                    </div>
                    <div class="error-text <?= !empty($arResult['ERRORS']['EMAIL']) ? 'show' : '' ?>">
                        <?= $arResult['ERRORS']['EMAIL'] ?? 'Пожалуйста, введите корректный email' ?>
                    </div>
                </div>

                <div class="input-field">
                    <div class="input-wrapper">
                        <input type="password" name="REGISTER[PASSWORD]" placeholder="Пароль *" required>
                        <span class="field__icon" onclick="togglePassword(this)"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.9984 9.00462C14.2075 9.00462 15.9984 10.7955 15.9984 13.0046C15.9984 15.2138 14.2075 17.0046 11.9984 17.0046C9.78927 17.0046 7.99841 15.2138 7.99841 13.0046C7.99841 10.7955 9.78927 9.00462 11.9984 9.00462ZM11.9984 10.5046C10.6177 10.5046 9.49841 11.6239 9.49841 13.0046C9.49841 14.3853 10.6177 15.5046 11.9984 15.5046C13.3791 15.5046 14.4984 14.3853 14.4984 13.0046C14.4984 11.6239 13.3791 10.5046 11.9984 10.5046ZM11.9984 5.5C16.6119 5.5 20.5945 8.65001 21.6995 13.0644C21.8001 13.4662 21.5559 13.8735 21.1541 13.9741C20.7523 14.0746 20.345 13.8305 20.2444 13.4286C19.3055 9.67796 15.9198 7 11.9984 7C8.07534 7 4.68851 9.68026 3.75127 13.4332C3.6509 13.835 3.24376 14.0794 2.84189 13.9791C2.44002 13.8787 2.1956 13.4716 2.29596 13.0697C3.39905 8.65272 7.38289 5.5 11.9984 5.5Z" fill="#212121"/>
</svg></span>
                    </div>
                    <div class="fio-hint">Минимум 8 символов, включить цифры и спецсимволы</div>
                </div>

                <div class="input-field">
                    <div class="input-wrapper">
                        <input type="password" name="REGISTER[CONFIRM_PASSWORD]" placeholder="Повторите пароль *" required>
                        <span class="field__icon" onclick="togglePassword(this)"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.9984 9.00462C14.2075 9.00462 15.9984 10.7955 15.9984 13.0046C15.9984 15.2138 14.2075 17.0046 11.9984 17.0046C9.78927 17.0046 7.99841 15.2138 7.99841 13.0046C7.99841 10.7955 9.78927 9.00462 11.9984 9.00462ZM11.9984 10.5046C10.6177 10.5046 9.49841 11.6239 9.49841 13.0046C9.49841 14.3853 10.6177 15.5046 11.9984 15.5046C13.3791 15.5046 14.4984 14.3853 14.4984 13.0046C14.4984 11.6239 13.3791 10.5046 11.9984 10.5046ZM11.9984 5.5C16.6119 5.5 20.5945 8.65001 21.6995 13.0644C21.8001 13.4662 21.5559 13.8735 21.1541 13.9741C20.7523 14.0746 20.345 13.8305 20.2444 13.4286C19.3055 9.67796 15.9198 7 11.9984 7C8.07534 7 4.68851 9.68026 3.75127 13.4332C3.6509 13.835 3.24376 14.0794 2.84189 13.9791C2.44002 13.8787 2.1956 13.4716 2.29596 13.0697C3.39905 8.65272 7.38289 5.5 11.9984 5.5Z" fill="#212121"/>
</svg></span>
                    </div>
                </div>

                <div class="input-field">
                    <div class="input-wrapper <?= (!empty($arResult['ERRORS']['NAME']) || !empty($arResult['ERRORS']['LAST_NAME'])) ? 'error' : '' ?>">
                        <input type="text" name="REGISTER[FULL_NAME]" id="fullName" value="<?= htmlspecialcharsbx($fullNameValue) ?>" placeholder="ФИО*" required>
                    </div>
                    <div class="error-text <?= (!empty($arResult['ERRORS']['NAME']) || !empty($arResult['ERRORS']['LAST_NAME'])) ? 'show' : '' ?>">
                        <?= $arResult['ERRORS']['NAME'] ?? $arResult['ERRORS']['LAST_NAME'] ?? 'Пожалуйста, введите ваше ФИО полностью' ?>
                    </div>
                </div>

                <div class="input-field">
                    <div class="input-wrapper <?= !empty($arResult['ERRORS']['PERSONAL_PHONE']) ? 'error' : '' ?>">
                        <input type="tel"
                               name="REGISTER[PERSONAL_PHONE]"
                               value="<?= htmlspecialcharsbx($phoneValue) ?>"
                               placeholder="Телефон"
                               autocomplete="tel">
                    </div>
                    <div class="error-text <?= !empty($arResult['ERRORS']['PERSONAL_PHONE']) ? 'show' : '' ?>">
                        <?= $arResult['ERRORS']['PERSONAL_PHONE'] ?? 'Необязательное поле' ?>
                    </div>
                </div>

                <div class="input-field">
                    <div class="input-wrapper <?= !empty($arResult['ERRORS']['PERSONAL_CITY']) ? 'error' : '' ?>">
                        <input type="text"
                               name="REGISTER[PERSONAL_CITY]"
                               value="<?= htmlspecialcharsbx($cityValue) ?>"
                               placeholder="Город"
                               autocomplete="address-level2">
                    </div>
                    <div class="error-text <?= !empty($arResult['ERRORS']['PERSONAL_CITY']) ? 'show' : '' ?>">
                        <?= $arResult['ERRORS']['PERSONAL_CITY'] ?? 'Необязательное поле' ?>
                    </div>
                </div>

                <?php if ($arResult["USE_CAPTCHA"] == "Y"): ?>
                    <div class="input-field">
                        <div style="margin-bottom: 16px;">
                            <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>"
                                 width="180" height="40" alt="CAPTCHA" />
                            <input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>" />
                        </div>
                        <div class="input-wrapper">
                            <input type="text" name="captcha_word" placeholder="Введите код с картинки *" maxlength="50" required />
                        </div>
                        <?php if (!empty($arResult['ERRORS']['CAPTCHA_WORD'])): ?>
                            <div class="error-text show"><?= $arResult['ERRORS']['CAPTCHA_WORD'] ?></div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="checkboxes-container">
                    <label class="checkbox-group">
                        <input type="checkbox" id="policyCheckbox" name="policyCheckbox" required>

                        <span class="checkbox__label">
                            Ознакомлен с <a href="/privacy-policy/" target="_blank">Политикой обработки персональных данных</a>
                        </span>
                    </label>

                    <label class="checkbox-group">
                        <input type="checkbox" id="termsCheckbox" name="termsCheckbox" required>

                        <span class="checkbox__label">
                            Соглашаюсь с <a href="/agree_of_subject/" target="_blank">Условиями обработки персональных данных</a>
                        </span>
                    </label>
                </div>

                <div class="submit-section">
                    <button type="submit" class="submit-button" name="register_submit_button">
                        Зарегистрироваться
                    </button>
                </div>

                <div class="login-link">
                    Уже есть аккаунт? <a href="<?= $arResult['AUTH_AUTH_URL'] ?? '/auth/' ?>">Войти</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function togglePassword(icon) {
        const input = icon.parentElement.querySelector('input');
        if (input) {
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form.inputs-container');
        const fullNameInput = document.getElementById('fullName');
        const hiddenName = document.getElementById('hiddenName');
        const hiddenLastName = document.getElementById('hiddenLastName');
        const hiddenSecondName = document.getElementById('hiddenSecondName');
        const hiddenLogin = document.getElementById('hiddenLogin');
        const emailInput = form.querySelector('input[name="REGISTER[EMAIL]"]');

        function splitFIOauth(fullName) {
            const parts = fullName.trim().split(/\s+/);
            return {
                lastName: parts[0] || '',      // Фамилия
                name: parts[1] || '',          // Имя
                secondName: parts[2] || ''     // Отчество
            };
        }
        if (fullNameInput) {
            fullNameInput.addEventListener('input', function() {
                const fioParts = splitFIOauth(this.value);
                hiddenLastName.value = fioParts.lastName;
                hiddenName.value = fioParts.name;
                hiddenSecondName.value = fioParts.secondName;
            });

            const fioParts = splitFIOauth(fullNameInput.value);
            hiddenLastName.value = fioParts.lastName;
            hiddenName.value = fioParts.name;
            hiddenSecondName.value = fioParts.secondName;
        }

        if (emailInput && hiddenLogin) {
            emailInput.addEventListener('input', function() {
                hiddenLogin.value = this.value;
            });
            // Инициализация
            hiddenLogin.value = emailInput.value;
        }

        if (form) {
            form.addEventListener('submit', function(e) {
                console.log('Отправка формы...');

                // Заполняем скрытые поля из ФИО
                if (fullNameInput && fullNameInput.value.trim()) {
                    const fioParts = splitFIOauth(fullNameInput.value);

                    if (!hiddenLastName.value && fioParts.lastName) {
                        hiddenLastName.value = fioParts.lastName;
                    }
                    if (!hiddenName.value && fioParts.name) {
                        hiddenName.value = fioParts.name;
                    }
                    if (!hiddenSecondName.value && fioParts.secondName) {
                        hiddenSecondName.value = fioParts.secondName;
                    }

                    console.log('ФИО разбито:', {
                        lastName: hiddenLastName.value,
                        name: hiddenName.value,
                        secondName: hiddenSecondName.value
                    });
                }

                if (emailInput && hiddenLogin && !hiddenLogin.value && emailInput.value) {
                    hiddenLogin.value = emailInput.value;
                }

                console.log('Отправляются данные:');
                const formData = new FormData(form);
                for (let [key, value] of formData.entries()) {
                    console.log(key + ': ' + value);
                }

                const policyCheckbox = document.getElementById('policyCheckbox');
                const termsCheckbox = document.getElementById('termsCheckbox');

                if (!policyCheckbox.checked || !termsCheckbox.checked) {
                    e.preventDefault();
                    alert('Пожалуйста, примите условия обработки персональных данных');
                    return false;
                }

                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailInput && !emailRegex.test(emailInput.value)) {
                    e.preventDefault();
                    alert('Пожалуйста, введите корректный email');
                    emailInput.focus();
                    return false;
                }

                const passwordInput = form.querySelector('input[name="REGISTER[PASSWORD]"]');
                const confirmPasswordInput = form.querySelector('input[name="REGISTER[CONFIRM_PASSWORD]"]');

                if (passwordInput && confirmPasswordInput) {
                    if (passwordInput.value !== confirmPasswordInput.value) {
                        e.preventDefault();
                        alert('Пароли не совпадают');
                        confirmPasswordInput.focus();
                        return false;
                    }

                    if (passwordInput.value.length < 8) {
                        e.preventDefault();
                        alert('Пароль должен содержать не менее 8 символов');
                        passwordInput.focus();
                        return false;
                    }
                }

                if (fullNameInput) {
                    const fioValue = fullNameInput.value.trim();
                    const nameParts = fioValue.split(/\s+/);

                    if (fioValue.length === 0) {
                        e.preventDefault();
                        alert('Пожалуйста, введите ФИО');
                        fullNameInput.focus();
                        return false;
                    }

                    if (nameParts.length < 2) {
                        e.preventDefault();
                        alert('Пожалуйста, введите и Фамилию, и Имя через пробел');
                        fullNameInput.focus();
                        return false;
                    }
                }

                <?php if (isset($_REQUEST['register_submit_button'])): ?>
                if (typeof yaCounter23056159 !== 'undefined') {
                    yaCounter23056159.reachGoal("Registration");
                }

                <?php endif; ?>

                return true;
            });

            // Скрытие ошибок при вводе
            const inputs = form.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    const wrapper = this.closest('.input-wrapper');
                    const errorText = wrapper?.nextElementSibling;

                    if (wrapper && wrapper.classList.contains('error')) {
                        wrapper.classList.remove('error');
                    }

                    if (errorText && errorText.classList.contains('show')) {
                        errorText.classList.remove('show');
                    }
                });
            });

            // Маска для телефона
            const phoneInput = form.querySelector('input[name="REGISTER[PERSONAL_PHONE]"]');
            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    let value = this.value.replace(/\D/g, '');

                    if (value.length > 0) {
                        // Формат: +7 (XXX) XXX-XX-XX
                        let formatted = '+7';

                        if (value.length > 1) {
                            formatted += ' (' + value.substring(1, 4);
                        }
                        if (value.length >= 4) {
                            formatted += ') ' + value.substring(4, 7);
                        }
                        if (value.length >= 7) {
                            formatted += '-' + value.substring(7, 9);
                        }
                        if (value.length >= 9) {
                            formatted += '-' + value.substring(9, 11);
                        }

                        this.value = formatted;
                    }
                });
                if (phoneInput.value && phoneInput.value.replace(/\D/g, '').length > 1) {
                    phoneInput.dispatchEvent(new Event('input'));
                }
            }
        }

        // Аналитика при загрузке страницы
        <?php if (!isset($_REQUEST['register_submit_button'])): ?>

        <?php endif; ?>
    });
    
</script>
<?
function splitFIOauthauth($fullName) {
    $parts = preg_split('/\s+/', trim($fullName));
    $result = ['last_name' => '', 'name' => '', 'second_name' => ''];
    if (count($parts) >= 1) $result['last_name'] = $parts[0];
    if (count($parts) >= 2) $result['name'] = $parts[1];
    if (count($parts) >= 3) $result['second_name'] = $parts[2];
    return $result;
}
?>