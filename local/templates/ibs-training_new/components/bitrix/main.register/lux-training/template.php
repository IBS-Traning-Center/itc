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

        <form class="inputs-container" method="post" action="<?= POST_FORM_ACTION_URI ?>" name="regform">
            <?php if (strlen($arResult["BACKURL"]) > 0): ?>
                <input type="hidden" name="backurl" value="<?= $arResult['BACKURL'] ?>" />
            <?php endif; ?>

            <input type="hidden" name="REGISTER[NAME]" id="hiddenName" value="<?= htmlspecialcharsbx($nameValue) ?>">
            <input type="hidden" name="REGISTER[LAST_NAME]" id="hiddenLastName" value="<?= htmlspecialcharsbx($lastNameValue) ?>">
            <input type="hidden" name="REGISTER[SECOND_NAME]" id="hiddenSecondName" value="<?= htmlspecialcharsbx($secondNameValue) ?>">

            <input type="hidden" name="REGISTER[LOGIN]" id="hiddenLogin" value="<?= htmlspecialcharsbx($emailValue) ?>">

            <div class="input-field">
                <div class="input-wrapper <?= !empty($arResult['ERRORS']['EMAIL']) ? 'error' : '' ?>">
                    <input type="email"
                           name="REGISTER[EMAIL]"
                           value="<?= htmlspecialcharsbx($emailValue) ?>"
                           placeholder="Email *"
                           required
                           autocomplete="email">

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
            <div class="input-field">
                <div class="input-wrapper <?= !empty($arResult['ERRORS']['NAME']) || !empty($arResult['ERRORS']['LAST_NAME']) ? 'error' : '' ?>">
                    <input type="text"
                           name="REGISTER[FULL_NAME]"
                           id="fullName"
                           value="<?= htmlspecialcharsbx($fullNameValue) ?>"
                           placeholder="ФИО*"
                           required>

                </div>
                <?php if (!empty($arResult['ERRORS']['NAME'])): ?>
                    <div class="error-text show"><?= $arResult['ERRORS']['NAME'] ?></div>
                <?php elseif (!empty($arResult['ERRORS']['LAST_NAME'])): ?>
                    <div class="error-text show"><?= $arResult['ERRORS']['LAST_NAME'] ?></div>
                <?php else: ?>
                    <div class="error-text">Пожалуйста, введите ваше ФИО полностью</div>
                <?php endif; ?>
            </div>

            <div class="input-field">
                <div class="input-wrapper <?= !empty($arResult['ERRORS']['PERSONAL_PHONE']) ? 'error' : '' ?>">
                    <input type="tel"
                           name="REGISTER[PERSONAL_PHONE]"
                           value="<?= htmlspecialcharsbx($phoneValue) ?>"
                           placeholder="Телефон"
                           autocomplete="tel">

                </div>
                <?php if (!empty($arResult['ERRORS']['PERSONAL_PHONE'])): ?>
                    <div class="error-text show"><?= $arResult['ERRORS']['PERSONAL_PHONE'] ?></div>
                <?php else: ?>
                    <div class="error-text">Необязательное поле</div>
                <?php endif; ?>
            </div>

            <div class="input-field">
                <div class="input-wrapper <?= !empty($arResult['ERRORS']['PERSONAL_CITY']) ? 'error' : '' ?>">
                    <input type="text"
                           name="REGISTER[PERSONAL_CITY]"
                           value="<?= htmlspecialcharsbx($cityValue) ?>"
                           placeholder="Город"
                           autocomplete="address-level2">

                </div>
                <?php if (!empty($arResult['ERRORS']['PERSONAL_CITY'])): ?>
                    <div class="error-text show"><?= $arResult['ERRORS']['PERSONAL_CITY'] ?></div>
                <?php else: ?>
                    <div class="error-text">Необязательное поле</div>
                <?php endif; ?>
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
                </div>
            <?php endif; ?>

            <div class="checkboxes-container">
                <div class="checkbox-group">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="policyCheckbox" name="policyCheckbox" required>

                    </div>
                    <label for="policyCheckbox" class="checkbox-label">
                        Ознакомлен с <a href="/privacy-policy" target="_blank">Политикой обработки персональных данных</a>
                    </label>
                </div>

                <div class="checkbox-group">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="termsCheckbox" name="termsCheckbox" required>

                    </div>
                    <label for="termsCheckbox" class="checkbox-label">
                        Соглашаюсь с <a href="/terms-of-use" target="_blank">Условиями обработки персональных данных</a>
                    </label>
                </div>
            </div>

            <div class="submit-section">
                <button type="submit" class="submit-button" name="register_submit_button" value="<?= GetMessage("AUTH_REGISTER") ?>">
                    Зарегистрироваться
                </button>
            </div>

            <div class="login-link">
                Уже есть аккаунт? <a href="<?= $arResult['AUTH_AUTH_URL'] ?? '/auth/' ?>">Войти</a>
            </div>
        </form>
    </div>
</div>

