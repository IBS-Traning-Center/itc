<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
function splitFIO($fullName) {
    $parts = preg_split('/\s+/', trim($fullName));
    $result = [
        'last_name' => '',
        'name' => '',
        'second_name' => ''
    ];

    if (count($parts) >= 1) $result['last_name'] = $parts[0]; // Фамилия
    if (count($parts) >= 2) $result['name'] = $parts[1];      // Имя
    if (count($parts) >= 3) $result['second_name'] = $parts[2]; // Отчество

    return $result;
}
$hasGeneralErrors = false;
if (!empty($arResult['ERRORS']) && is_array($arResult['ERRORS'])) {
    $hasGeneralErrors = true;
}

$emailValue = $_POST['REGISTER']['EMAIL'] ?? ($arResult['VALUES']['EMAIL'] ?? '');
$phoneValue = $_POST['REGISTER']['PERSONAL_PHONE'] ?? ($arResult['VALUES']['PERSONAL_PHONE'] ?? '');
$cityValue = $_POST['REGISTER']['PERSONAL_CITY'] ?? ($arResult['VALUES']['PERSONAL_CITY'] ?? '');

$fullNameValue = '';
$nameValue = '';
$lastNameValue = '';
$secondNameValue = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['REGISTER']['FULL_NAME'])) {
        $fullNameValue = trim($_POST['REGISTER']['FULL_NAME']);
        $nameParts = splitFIO($fullNameValue);

        $lastNameValue = $nameParts['last_name'];
        $nameValue = $nameParts['name'];
        $secondNameValue = $nameParts['second_name'];
    }

    $nameValue = $_POST['REGISTER']['NAME'] ?? $nameValue;
    $lastNameValue = $_POST['REGISTER']['LAST_NAME'] ?? $lastNameValue;
    $secondNameValue = $_POST['REGISTER']['SECOND_NAME'] ?? $secondNameValue;
}
elseif (!empty($arResult['VALUES']['NAME']) || !empty($arResult['VALUES']['LAST_NAME']) || !empty($arResult['VALUES']['SECOND_NAME'])) {
    $lastNameValue = $arResult['VALUES']['LAST_NAME'] ?? '';
    $nameValue = $arResult['VALUES']['NAME'] ?? '';
    $secondNameValue = $arResult['VALUES']['SECOND_NAME'] ?? '';

    $fullNameValue = trim($lastNameValue . ' ' . $nameValue . ' ' . $secondNameValue);
}
?>
 <style>
     .password-wrapper {
         position: relative;
     }

     .field__icon {
         position: absolute;
         right: 24px;
         top: 50%;
         transform: translateY(-50%);
         cursor: pointer;
         user-select: none;
         opacity: 0.7;
         z-index: 2; /* Добавьте это, чтобы иконка была поверх */
     }

     .field__icon:hover {
         opacity: 1;
     }


        .registration-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 64px;
            gap: 10px;
            isolation: isolate;
            position: relative;
            width: 1024px;
            min-height: auto;
            background: #FFFFFF;
            margin: auto;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        }

        .form-frame {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 0px;
            gap: 32px;
            width: 896px;
            flex: 1;
        }

        .form-header {
            width: 100%;
            height: 72px;
            font-family: 'Noto Sans';
            font-style: normal;
            font-weight: 400;
            font-size: 56px;
            line-height: 72px;
            color: #000000;
            margin-bottom: 10px;
        }

        .form-tabs {
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 0px;
            gap: 8px;
            width: 209px;
            height: 40px;
        }

        .tab {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            padding: 8px 16px;
            height: 40px;
            text-decoration: none;
            cursor: pointer;
            font-family: 'Noto Sans';
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            transition: all 0.3s ease;
        }

        .tab.active {
            background: #000000;
            color: #FFFFFF;
        }

        .tab.inactive {
            background: #F0F0F0;
            color: #000000;
        }

        .general-errors {
            width: 100%;
            padding: 16px;
            background: #FFF0F0;
            border: 1px solid #FF0000;
            border-radius: 4px;
            margin-bottom: 16px;
        }

        .general-errors .error-item {
            color: #FF0000;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .general-errors .error-item:last-child {
            margin-bottom: 0;
        }

        .inputs-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 0px;
            gap: 24px;
            width: 100%;
        }

        .input-field {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 0px;
            gap: 4px;
            width: 100%;
        }

        .input-wrapper {
            box-sizing: border-box;
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 24px;
            width: 100%;
            height: 80px;
            background: #F8F7F7;
            border-bottom: 1px solid #000000;
            border-radius: 0px;
            position: relative;
        }

        .input-wrapper.error {
            border-bottom: 1px solid #ff0000;
        }

        .input-field input {
            width: 100%;
            height: 32px;
            font-family: 'Noto Sans', sans-serif;
            font-style: normal;
            font-weight: 300;
            font-size: 24px;
            line-height: 32px;
            color: #000000;
            background: transparent;
            border: none;
            outline: none;
        }

        .input-field input::placeholder {
            color: #000000;
            opacity: 0.7;
        }

        .input-icon {
            width: 24px;
            height: 24px;
            flex: none;
            display: none;
        }

        .input-icon.show {
            display: block;
        }

        .error-icon {
            position: relative;
            width: 24px;
            height: 24px;
        }

        .error-icon::after {
            content: '!';
            position: absolute;
            width: 24px;
            height: 24px;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background: #ff0000;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .error-text {
            width: 100%;
            min-height: 22px;
            font-family: 'Noto Sans';
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 22px;
            text-transform: capitalize;
            color: #000000;
            display: none;
        }

        .error-text.show {
            display: block;
            color: #ff0000;
        }

        .fio-hint {
            width: 100%;
            font-size: 14px;
            color: #666;
            margin-top: 4px;
            font-style: italic;
        }

        .checkboxes-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 0px;
            gap: 24px;
            width: 100%;
            margin-top: 20px;
        }

        .checkbox-group {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            padding: 0px;
            gap: 16px;
            width: 100%;
            min-height: 24px;
        }

        .checkbox-wrapper {
            position: relative;
            width: 24px;
            height: 24px;
            flex: none;
        }

        .checkbox-wrapper input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .checkbox-custom {
            box-sizing: border-box;
            position: absolute;
            width: 100%;
            height: 100%;
            background: #FFFFFF;
            border: 1px solid #000000;
        }

        .checkbox-wrapper input[type="checkbox"]:checked + .checkbox-custom {
            background: #000000;
        }

        .checkbox-wrapper input[type="checkbox"]:checked + .checkbox-custom::after {
            content: '✓';
            position: absolute;
            color: #FFFFFF;
            font-size: 16px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .checkbox-label {
            width: 856px;
            min-height: 24px;
            font-family: 'Noto Sans', sans-serif;
            font-style: normal;
            font-weight: 300;
            font-size: 16px;
            line-height: 24px;
            color: #000000;
            cursor: pointer;
        }

        .submit-section {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 32px 0px 0px;
            gap: 10px;
            width: 100%;
        }

        .submit-button {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 32px 40px;
            gap: 10px;
            width: 100%;
            height: 97px;
            background: #2B418B;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-family: 'Noto Sans';
            font-style: normal;
            font-weight: 400;
            font-size: 24px;
            line-height: 33px;
            color: #FFFFFF;
        }

        .submit-button:hover {
            background: #1a2d6b;
        }

        .submit-button:disabled {
            background: #cccccc;
            cursor: not-allowed;
        }

        .close-button {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            padding: 24px;
            gap: 10px;
            position: absolute;
            width: 96px;
            height: 96px;
            right: 0px;
            top: 0px;
            background: #FFFFFF;
            border: none;
            cursor: pointer;
            z-index: 1;
        }

        .close-icon {
            position: relative;
            width: 48px;
            height: 48px;
        }

        .close-icon::before,
        .close-icon::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 50%;
            width: 30px;
            height: 2px;
            background: #000000;
        }

        .close-icon::before {
            transform: translate(-50%, -50%) rotate(45deg);
        }

        .close-icon::after {
            transform: translate(-50%, -50%) rotate(-45deg);
        }

        .login-link {
            text-align: center;
            width: 100%;
            margin-top: 20px;
            font-family: 'Noto Sans';
            font-size: 16px;
            color: #000000;
        }

        .login-link a {
            color: #000;
            text-decoration: underline;
        }

        .login-link a:hover {
            color: #2B418B;
        }

        @media (max-width: 1100px) {
            .registration-container {
                width: 100%;
                padding: 40px;
            }

            .form-frame {
                width: 100%;
            }

            .form-header {
                font-size: 48px;
                line-height: 60px;
            }
        }

        @media (max-width: 768px) {
            .registration-container {
                padding: 20px;
            }

            .form-header {
                font-size: 36px;
                line-height: 48px;
            }

            .input-field input {
                font-size: 20px;
            }

            .submit-button {
                padding: 24px 20px;
                height: 80px;
                font-size: 20px;
            }

            .close-button {
                width: 72px;
                height: 72px;
            }

            .checkbox-label {
                font-size: 14px;
                line-height: 20px;
            }
        }

        @media (max-width: 480px) {
            .form-header {
                font-size: 28px;
                line-height: 36px;
            }

            .input-wrapper {
                padding: 16px;
                height: 60px;
            }

            .input-field input {
                font-size: 18px;
            }

            .submit-button {
                height: 70px;
                font-size: 18px;
                padding: 16px;
            }

            .checkbox-label {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
<div class="registration-container">


    <div class="form-frame">
        <h1 class="form-header">Регистрация и вход</h1>

        <div class="form-tabs">
            <a href="#" class="tab active">Регистрация</a>
            <a href="<?= $arResult['AUTH_AUTH_URL'] ?? '/auth/' ?>" class="tab inactive">Вход</a>
        </div>

        <?php if ($hasGeneralErrors && !empty($arResult['ERRORS'])): ?>
            <div class="general-errors">
                <?php foreach ($arResult['ERRORS'] as $error): ?>
                    <div class="error-item"><?= $error ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Форма -->
        <form class="inputs-container" method="post" action="<?= POST_FORM_ACTION_URI ?>" name="regform">
            <?php if (strlen($arResult["BACKURL"]) > 0): ?>
                <input type="hidden" name="backurl" value="<?= $arResult['BACKURL'] ?>" />
            <?php endif; ?>

            <!-- ВАЖНО: Bitrix ожидает поля в определенном формате -->
            <!-- Скрытые поля для ФИО (должны быть обязательно!) -->
            <input type="hidden" name="REGISTER[NAME]" id="hiddenName" value="<?= htmlspecialcharsbx($nameValue) ?>">
            <input type="hidden" name="REGISTER[LAST_NAME]" id="hiddenLastName" value="<?= htmlspecialcharsbx($lastNameValue) ?>">
            <input type="hidden" name="REGISTER[SECOND_NAME]" id="hiddenSecondName" value="<?= htmlspecialcharsbx($secondNameValue) ?>">

            <!-- Также нужно поле LOGIN (обычно = EMAIL в Bitrix) -->
            <input type="hidden" name="REGISTER[LOGIN]" id="hiddenLogin" value="<?= htmlspecialcharsbx($emailValue) ?>">

            <!-- Поле для email (обязательное) -->
            <div class="input-field">
                <div class="input-wrapper <?= !empty($arResult['ERRORS']['EMAIL']) ? 'error' : '' ?>">
                    <input type="email"
                           name="REGISTER[EMAIL]"
                           value="<?= htmlspecialcharsbx($emailValue) ?>"
                           placeholder="Email *"
                           required
                           autocomplete="email">
                    <?php if (!empty($arResult['ERRORS']['EMAIL'])): ?>
                        <div class="input-icon error-icon show"></div>
                    <?php endif; ?>
                </div>
                <?php if (!empty($arResult['ERRORS']['EMAIL'])): ?>
                    <div class="error-text show"><?= $arResult['ERRORS']['EMAIL'] ?></div>
                <?php else: ?>
                    <div class="error-text">Пожалуйста, введите корректный email</div>
                <?php endif; ?>
            </div>

            <div class="input-field">
                <div class="input-wrapper password-wrapper">
                    <input type="password"
                           name="REGISTER[PASSWORD]"
                           placeholder="Пароль *"
                           required>
                    <span class="field__icon" onclick="togglePassword(this)"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.9984 9.00462C14.2075 9.00462 15.9984 10.7955 15.9984 13.0046C15.9984 15.2138 14.2075 17.0046 11.9984 17.0046C9.78927 17.0046 7.99841 15.2138 7.99841 13.0046C7.99841 10.7955 9.78927 9.00462 11.9984 9.00462ZM11.9984 10.5046C10.6177 10.5046 9.49841 11.6239 9.49841 13.0046C9.49841 14.3853 10.6177 15.5046 11.9984 15.5046C13.3791 15.5046 14.4984 14.3853 14.4984 13.0046C14.4984 11.6239 13.3791 10.5046 11.9984 10.5046ZM11.9984 5.5C16.6119 5.5 20.5945 8.65001 21.6995 13.0644C21.8001 13.4662 21.5559 13.8735 21.1541 13.9741C20.7523 14.0746 20.345 13.8305 20.2444 13.4286C19.3055 9.67796 15.9198 7 11.9984 7C8.07534 7 4.68851 9.68026 3.75127 13.4332C3.6509 13.835 3.24376 14.0794 2.84189 13.9791C2.44002 13.8787 2.1956 13.4716 2.29596 13.0697C3.39905 8.65272 7.38289 5.5 11.9984 5.5Z" fill="#212121"/>
</svg></span>
                </div>
                <div class="fio-hint">Минимум 6 символов, включить цифры и спецсимволы</div>
            </div>

            <!-- Поле для подтверждения пароля (обязательное) -->
            <div class="input-field">
                <div class="input-wrapper password-wrapper">
                    <input type="password"
                           name="REGISTER[CONFIRM_PASSWORD]"
                           placeholder="Повторите пароль *"
                           required>
                    <span class="field__icon" onclick="togglePassword(this)"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.9984 9.00462C14.2075 9.00462 15.9984 10.7955 15.9984 13.0046C15.9984 15.2138 14.2075 17.0046 11.9984 17.0046C9.78927 17.0046 7.99841 15.2138 7.99841 13.0046C7.99841 10.7955 9.78927 9.00462 11.9984 9.00462ZM11.9984 10.5046C10.6177 10.5046 9.49841 11.6239 9.49841 13.0046C9.49841 14.3853 10.6177 15.5046 11.9984 15.5046C13.3791 15.5046 14.4984 14.3853 14.4984 13.0046C14.4984 11.6239 13.3791 10.5046 11.9984 10.5046ZM11.9984 5.5C16.6119 5.5 20.5945 8.65001 21.6995 13.0644C21.8001 13.4662 21.5559 13.8735 21.1541 13.9741C20.7523 14.0746 20.345 13.8305 20.2444 13.4286C19.3055 9.67796 15.9198 7 11.9984 7C8.07534 7 4.68851 9.68026 3.75127 13.4332C3.6509 13.835 3.24376 14.0794 2.84189 13.9791C2.44002 13.8787 2.1956 13.4716 2.29596 13.0697C3.39905 8.65272 7.38289 5.5 11.9984 5.5Z" fill="#212121"/>
</svg></span>
                </div>
            </div>

            <!-- Поле ФИО (одно поле, сохраняется в три свойства) -->
            <div class="input-field">
                <div class="input-wrapper <?= !empty($arResult['ERRORS']['NAME']) || !empty($arResult['ERRORS']['LAST_NAME']) ? 'error' : '' ?>">
                    <input type="text"
                           name="REGISTER[FULL_NAME]"
                           id="fullName"
                           value="<?= htmlspecialcharsbx($fullNameValue) ?>"
                           placeholder="ФИО*"
                           required>
                    <?php if (!empty($arResult['ERRORS']['NAME']) || !empty($arResult['ERRORS']['LAST_NAME'])): ?>
                        <div class="input-icon error-icon show"></div>
                    <?php endif; ?>
                </div>
                <?php if (!empty($arResult['ERRORS']['NAME'])): ?>
                    <div class="error-text show"><?= $arResult['ERRORS']['NAME'] ?></div>
                <?php elseif (!empty($arResult['ERRORS']['LAST_NAME'])): ?>
                    <div class="error-text show"><?= $arResult['ERRORS']['LAST_NAME'] ?></div>
                <?php else: ?>
                    <div class="error-text">Пожалуйста, введите ваше ФИО полностью</div>
                <?php endif; ?>
            </div>

            <!-- Поле для телефона -->
            <div class="input-field">
                <div class="input-wrapper <?= !empty($arResult['ERRORS']['PERSONAL_PHONE']) ? 'error' : '' ?>">
                    <input type="tel"
                           name="REGISTER[PERSONAL_PHONE]"
                           value="<?= htmlspecialcharsbx($phoneValue) ?>"
                           placeholder="Телефон"
                           autocomplete="tel">
                    <?php if (!empty($arResult['ERRORS']['PERSONAL_PHONE'])): ?>
                        <div class="input-icon error-icon show"></div>
                    <?php endif; ?>
                </div>
                <?php if (!empty($arResult['ERRORS']['PERSONAL_PHONE'])): ?>
                    <div class="error-text show"><?= $arResult['ERRORS']['PERSONAL_PHONE'] ?></div>
                <?php else: ?>
                    <div class="error-text">Необязательное поле</div>
                <?php endif; ?>
            </div>

            <!-- Поле для города -->
            <div class="input-field">
                <div class="input-wrapper <?= !empty($arResult['ERRORS']['PERSONAL_CITY']) ? 'error' : '' ?>">
                    <input type="text"
                           name="REGISTER[PERSONAL_CITY]"
                           value="<?= htmlspecialcharsbx($cityValue) ?>"
                           placeholder="Город"
                           autocomplete="address-level2">
                    <?php if (!empty($arResult['ERRORS']['PERSONAL_CITY'])): ?>
                        <div class="input-icon error-icon show"></div>
                    <?php endif; ?>
                </div>
                <?php if (!empty($arResult['ERRORS']['PERSONAL_CITY'])): ?>
                    <div class="error-text show"><?= $arResult['ERRORS']['PERSONAL_CITY'] ?></div>
                <?php else: ?>
                    <div class="error-text">Необязательное поле</div>
                <?php endif; ?>
            </div>

            <!-- CAPTCHA (если включена) -->
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
                </div>
            <?php endif; ?>

            <!-- Чекбоксы согласия -->
            <div class="checkboxes-container">
                <div class="checkbox-group">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="policyCheckbox" name="policyCheckbox" required>

                    </div>
                    <label for="policyCheckbox" class="checkbox-label">
                        Ознакомлен с <a href="/privacy-policy/" target="_blank">Политикой обработки персональных данных</a>
                    </label>
                </div>

                <div class="checkbox-group">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="termsCheckbox" name="termsCheckbox" required>

                    </div>
                    <label for="termsCheckbox" class="checkbox-label">
                        Соглашаюсь с <a href="/terms-of-use/" target="_blank">Условиями обработки персональных данных</a>
                    </label>
                </div>
            </div>

            <!-- Кнопка отправки -->
            <div class="submit-section">
                <button type="submit" class="submit-button" name="register_submit_button" value="<?= GetMessage("AUTH_REGISTER") ?>">
                    Зарегистрироваться
                </button>
            </div>

            <!-- Ссылка на вход -->
            <div class="login-link">
                Уже есть аккаунт? <a href="<?= $arResult['AUTH_AUTH_URL'] ?? '/auth/' ?>">Войти</a>
            </div>
        </form>
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

        // Функция для разбиения ФИО на части
        function splitFIO(fullName) {
            const parts = fullName.trim().split(/\s+/);
            return {
                lastName: parts[0] || '',      // Фамилия
                name: parts[1] || '',          // Имя
                secondName: parts[2] || ''     // Отчество
            };
        }
        if (fullNameInput) {
            fullNameInput.addEventListener('input', function() {
                const fioParts = splitFIO(this.value);
                hiddenLastName.value = fioParts.lastName;
                hiddenName.value = fioParts.name;
                hiddenSecondName.value = fioParts.secondName;
            });

            // Инициализация при загрузке
            const fioParts = splitFIO(fullNameInput.value);
            hiddenLastName.value = fioParts.lastName;
            hiddenName.value = fioParts.name;
            hiddenSecondName.value = fioParts.secondName;
        }

        // Обновление логина при вводе email
        if (emailInput && hiddenLogin) {
            emailInput.addEventListener('input', function() {
                hiddenLogin.value = this.value;
            });
            // Инициализация
            hiddenLogin.value = emailInput.value;
        }

        // ОБЯЗАТЕЛЬНО: перед отправкой формы убедимся, что все поля заполнены
        if (form) {
            form.addEventListener('submit', function(e) {
                console.log('Отправка формы...');

                // Заполняем скрытые поля из ФИО
                if (fullNameInput && fullNameInput.value.trim()) {
                    const fioParts = splitFIO(fullNameInput.value);

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

                // Заполняем логин из email
                if (emailInput && hiddenLogin && !hiddenLogin.value && emailInput.value) {
                    hiddenLogin.value = emailInput.value;
                }

                // ДЕБАГ: покажем что отправляется
                console.log('Отправляются данные:');
                const formData = new FormData(form);
                for (let [key, value] of formData.entries()) {
                    console.log(key + ': ' + value);
                }

                const policyCheckbox = document.getElementById('policyCheckbox');
                const termsCheckbox = document.getElementById('termsCheckbox');

                // Проверка чекбоксов согласия
                if (!policyCheckbox.checked || !termsCheckbox.checked) {
                    e.preventDefault();
                    alert('Пожалуйста, примите условия обработки персональных данных');
                    return false;
                }

                // Валидация email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailInput && !emailRegex.test(emailInput.value)) {
                    e.preventDefault();
                    alert('Пожалуйста, введите корректный email');
                    emailInput.focus();
                    return false;
                }

                // Валидация пароля
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

                // Валидация ФИО
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

                // Если форма валидна, добавляем события для аналитики
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

                // Инициализация маски при загрузке, если есть значение
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
