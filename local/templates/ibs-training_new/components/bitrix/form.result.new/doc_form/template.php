<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
    die();
}

/**
 * @var array $arResult
 */
?>
<style>
    * {
        box-sizing: border-box;
        font-family: 'Noto Sans', Arial, sans-serif;
    }

    body {
        margin: 0;
    }

    .contact {
        min-height: 100vh;
        background: linear-gradient(90deg, #2F6298 0%, #438DB0 100%);
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 80px 40px 120px;
        gap: 48px;
    }

    .contact__content {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        padding: 0px;
        gap: 48px;
        width: 100%;
        max-width: 1400px;
        color: #fff;
        margin: 0 auto;
    }

    .contact__text {
        width: 50%;
        flex: 1;
        min-width: 600px;
    }

    .contact__text h2 {
        font-family: 'Noto Sans';
        font-style: normal;
        font-weight: 400;
        font-size: 56px;
        line-height: 72px;
        color: #FFFFFF;
        margin: 0 0 20px 0;
    }

    .contact__text p {
        font-family: 'Noto Sans';
        font-size: 24px;
        line-height: 33px;
        color: #FFFFFF;
    }

    .contact__form {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 0px;
        width: 50%;
        flex: 1;
        min-width: 600px;
    }

    /* Контейнер для поля с подписью */
    .form-field {
        width: 100%;
        margin-bottom: 24px;
    }

    /* Подписи полей */
    .field-label {
        font-family: 'Stag Sans' !important;
        font-size: 14px !important;
        margin-bottom: 8px !important;
        color: #FFFFFF !important;
        display: block !important;
        font-weight: 300;
    }

    /* Стили для всех полей ввода */
    .contact__form input[type="text"],
    .contact__form input[type="email"],
    .contact__form input[type="tel"],
    .contact__form input[type="password"],
    .contact__form textarea,
    .contact__form select {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        padding: 24px !important;
        width: 100% !important;
        height: 81px !important;
        background: #F0F0F0 !important;
        border: none !important;
        border-radius: 0 !important;
        font-family: 'Noto Sans' !important;
        font-style: normal !important;
        font-weight: 400 !important;
        font-size: 24px !important;
        line-height: 33px !important;
        color: #000000 !important;
        box-sizing: border-box !important;
        outline: none !important;
    }

    /* Специальный стиль для поля с длинным плейсхолдером */
    .contact__form input[type="text"][placeholder*="Укажите название или код"] {
        height: 120px !important; /* Увеличиваем высоту для длинного текста */
    }

    .contact__form textarea {
        height: 150px !important;
        resize: none !important;
    }

    .contact__form input::placeholder,
    .contact__form textarea::placeholder {
        color: #000000 !important;
        opacity: 0.7 !important;
    }

    /* Для длинного плейсхолдера - уменьшаем шрифт чтобы поместился */
    .contact__form input[type="text"][placeholder*="Укажите название или код"]::placeholder {
        font-size: 20px !important;
        line-height: 28px !important;
    }

    /* Валидация полей - ОСТАВЛЯЕМ ТОЛЬКО ДЛЯ ОШИБОК */
    .contact__form input:invalid,
    .contact__form textarea:invalid {
        outline: 2px solid #ff6b6b !important;
    }

    /* Специальные стили для email и телефона при ошибках */
    .contact__form input[type="email"]:invalid {
        outline: 2px solid #ff6b6b !important;
    }

    .contact__form input[type="tel"]:invalid {
        outline: 2px solid #ff6b6b !important;
    }

    /* Фокус стили */
    .contact__form input[type="text"]:focus,
    .contact__form input[type="email"]:focus,
    .contact__form input[type="tel"]:focus,
    .contact__form textarea:focus,
    .contact__form select:focus {
        outline: 2px solid #2B418B !important;
    }

    /* Чекбоксы */
    .checkbox {
        display: flex !important;
        flex-direction: row !important;
        align-items: flex-start !important;
        padding: 0px !important;
        gap: 16px !important;
        width: 100% !important;
        font-family: 'Stag Sans' !important;
        font-style: normal !important;
        font-weight: 300 !important;
        font-size: 16px !important;
        line-height: 24px !important;
        color: #FFFFFF !important;
        margin-bottom: 24px;
    }

    .checkbox input[type="checkbox"] {
        width: 24px !important;
        height: 24px !important;
        background: #FFFFFF !important;
        border: none !important;
        margin-top: 0 !important;
    }

    /* Кнопки отправки */
    .contact__form input[type="submit"] {
        display: flex !important;
        flex-direction: row !important;
        justify-content: center !important;
        align-items: center !important;
        padding: 32px 40px !important;
        gap: 10px !important;
        width: 100% !important;
        height: 97px !important;
        background: #FFFFFF !important;
        border: none !important;
        border-radius: 0 !important;
        font-family: 'Noto Sans' !important;
        font-style: normal !important;
        font-weight: 400 !important;
        font-size: 24px !important;
        line-height: 33px !important;
        color: #2B418B !important;
        cursor: pointer !important;
        margin-top: 0 !important;
        outline: none !important;
    }

    input[name="web_form_apply"] {
        background: #e6f0f8 !important;
    }

    .contact__form input[type="submit"]:hover {
        background: #F5F5F5 !important;
    }

    .contact__form input[type="submit"]:focus {
        outline: 2px solid #2B418B !important;
    }

    .contact__form input[type="submit"]:disabled {
        opacity: 0.6 !important;
        cursor: not-allowed !important;
    }

    /* Блок с кнопками */
    .contact__form > div[style*="display: flex"] {
        width: 100% !important;
        gap: 24px !important;
        flex-direction: column !important;
        margin-top: 20px;
    }

    /* Captcha */
    .captcha-container {
        width: 100%;
        margin-bottom: 24px;
    }

    .captcha-container img {
        margin-bottom: 15px;
    }

    .captcha-container input[type="text"] {
        margin-top: 10px !important;
    }

    .required {
        color: #FF6B6B !important;
        margin-left: 2px !important;
    }

    .form-error {
        color: #FF6B6B !important;
        font-family: 'Stag Sans' !important;
        font-size: 14px !important;
        margin-top: 5px !important;
        display: block !important;
    }

    /* Сообщение об успешной отправке */
    .form-success {
        background: rgba(255, 255, 255, 0.95) !important;
        padding: 40px !important;
        color: #2B418B !important;
        text-align: center !important;
        font-family: 'Noto Sans' !important;
        font-size: 24px !important;
        line-height: 33px !important;
        width: 100% !important;
    }

    /* СТИЛИ ДЛЯ КАСТОМНОГО ПОПАПА ИЗ FIGMA */
    .custom-popup-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .custom-popup-overlay.active {
        display: flex;
    }

    .custom-popup {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 64px;
        gap: 10px;
        isolation: isolate;

        position: relative;
        width: 1024px;
        max-width: 90%;
        height: auto;
        min-height: 481px;

        background: #FFFFFF;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }

    .custom-popup__close {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        padding: 24px;
        gap: 10px;

        width: 96px;
        height: 96px;
        background: #FFFFFF;
        border: none;
        cursor: pointer;
        position: absolute;
        right: 0;
        top: 0;
        z-index: 2;
    }

    .custom-popup__close-icon {
        position: relative;
        width: 48px;
        height: 48px;
    }

    .custom-popup__close-icon::before,
    .custom-popup__close-icon::after {
        content: '';
        position: absolute;
        left: 50%;
        top: 50%;
        width: 30px;
        height: 2px;
        background: #000000;
        transform-origin: center;
    }

    .custom-popup__close-icon::before {
        transform: translate(-50%, -50%) rotate(45deg);
    }

    .custom-popup__close-icon::after {
        transform: translate(-50%, -50%) rotate(-45deg);
    }

    .custom-popup__content {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 0px;
        gap: 32px;
        width: 100%;
        height: auto;
    }

    .custom-popup__title {
        width: 100%;
        height: auto;
        font-family: 'Noto Sans';
        font-style: normal;
        font-weight: 400;
        font-size: 56px;
        line-height: 72px;
        color: #000000;
        margin: 0;
    }

    .custom-popup__message {
        width: 100%;
        height: auto;
        font-family: 'Stag Sans';
        font-style: normal;
        font-weight: 300;
        font-size: 32px;
        line-height: 44px;
        color: #000000;
        margin: 0;
    }

    .custom-popup__button-container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 32px 0px 0px;
        gap: 10px;
        width: 100%;
        height: auto;
    }

    .custom-popup__button {
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
        font-family: 'Noto Sans';
        font-style: normal;
        font-weight: 400;
        font-size: 24px;
        line-height: 33px;
        color: #FFFFFF;
        text-decoration: none;
        text-align: center;
    }

    .custom-popup__button:hover {
        background: #1a2d6b;
    }

    /* Текст обязательных полей */
    .contact__form p[style*="font-size: 12px"] {
        font-family: 'Stag Sans' !important;
        font-size: 14px !important;
        margin-top: 16px !important;
        color: #FFFFFF !important;
    }

    /* Адаптивность */
    @media (max-width: 1440px) {
        .contact {
            padding: 80px 40px 100px;
        }

        .contact__content {
            max-width: 1200px;
        }

        .contact__text,
        .contact__form {
            min-width: 500px;
        }

        .custom-popup {
            padding: 48px;
            width: 900px;
        }

        .custom-popup__title {
            font-size: 48px;
            line-height: 60px;
        }

        .custom-popup__message {
            font-size: 28px;
            line-height: 38px;
        }
    }

    @media (max-width: 1200px) {
        .contact__text h2 {
            font-size: 48px;
            line-height: 60px;
        }

        .contact__text,
        .contact__form {
            min-width: 450px;
        }

        .custom-popup {
            padding: 40px;
            width: 800px;
        }

        .custom-popup__title {
            font-size: 40px;
            line-height: 52px;
        }

        .custom-popup__message {
            font-size: 24px;
            line-height: 34px;
        }
    }

    @media (max-width: 1024px) {
        .contact__content {
            flex-direction: column;
            gap: 40px;
        }

        .contact__text {
            width: 100%;
            min-width: auto;
        }

        .contact__text h2 {
            font-size: 40px;
            line-height: 52px;
        }

        .contact__form {
            width: 100%;
            min-width: auto;
        }

        .custom-popup {
            width: 90%;
            padding: 32px;
        }

        .custom-popup__title {
            font-size: 36px;
            line-height: 46px;
        }

        .custom-popup__message {
            font-size: 22px;
            line-height: 32px;
        }

        .custom-popup__close {
            width: 80px;
            height: 80px;
            padding: 20px;
        }

        .custom-popup__close-icon {
            width: 40px;
            height: 40px;
        }
    }

    @media (max-width: 768px) {
        .contact {
            padding: 60px 20px 80px;
            gap: 32px;
        }

        .contact__text h2 {
            font-size: 32px;
            line-height: 42px;
        }

        .contact__form input[type="text"],
        .contact__form input[type="email"],
        .contact__form input[type="tel"],
        .contact__form textarea,
        .contact__form select {
            padding: 20px !important;
            font-size: 20px !important;
            height: 70px !important;
        }

        .contact__form input[type="text"][placeholder*="Укажите название или код"] {
            height: 100px !important;
        }

        .contact__form input[type="text"][placeholder*="Укажите название или код"]::placeholder {
            font-size: 18px !important;
            line-height: 24px !important;
        }

        .contact__form input[type="submit"] {
            padding: 24px 32px !important;
            height: 80px !important;
            font-size: 20px !important;
        }

        .custom-popup {
            padding: 24px;
            width: 95%;
        }

        .custom-popup__title {
            font-size: 32px;
            line-height: 42px;
        }

        .custom-popup__message {
            font-size: 20px;
            line-height: 30px;
        }

        .custom-popup__button {
            padding: 24px 32px;
            height: 80px;
            font-size: 20px;
        }

        .custom-popup__close {
            width: 64px;
            height: 64px;
            padding: 16px;
        }

        .custom-popup__close-icon {
            width: 32px;
            height: 32px;
        }
    }

    @media (max-width: 480px) {
        .contact {
            padding: 40px 16px 60px;
        }

        .contact__text h2 {
            font-size: 28px;
            line-height: 36px;
        }

        .contact__form input[type="text"],
        .contact__form input[type="email"],
        .contact__form input[type="tel"],
        .contact__form textarea,
        .contact__form select {
            padding: 16px !important;
            font-size: 18px !important;
            height: 60px !important;
        }

        .contact__form input[type="text"][placeholder*="Укажите название или код"] {
            height: 80px !important;
        }

        .contact__form input[type="text"][placeholder*="Укажите название или код"]::placeholder {
            font-size: 16px !important;
            line-height: 22px !important;
        }

        .checkbox {
            font-size: 14px !important;
            line-height: 20px !important;
        }

        .custom-popup {
            padding: 20px;
        }

        .custom-popup__title {
            font-size: 28px;
            line-height: 36px;
        }

        .custom-popup__message {
            font-size: 18px;
            line-height: 26px;
        }

        .custom-popup__button {
            padding: 20px 24px;
            height: 70px;
            font-size: 18px;
        }

        .custom-popup__close {
            width: 48px;
            height: 48px;
            padding: 12px;
        }

        .custom-popup__close-icon {
            width: 24px;
            height: 24px;
        }

        .custom-popup__close-icon::before,
        .custom-popup__close-icon::after {
            width: 20px;
        }
    }
</style>

<!-- КАСТОМНЫЙ ПОПАП (скрыт по умолчанию) -->
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
        // Функция для проверки email
        function validateEmail(email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

        // Функция для проверки телефона (российский формат)
        function validatePhone(phone) {
            const re = /^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/;
            return re.test(String(phone).replace(/\s+/g, ''));
        }

        // Находим все поля email и добавляем проверку
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

        // Находим все поля телефона и добавляем проверку
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

        // AJAX отправка формы для показа своего попапа
        const form = document.querySelector('.contact__form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                let isValid = true;

                // Проверяем email поля
                emailFields.forEach(function(field) {
                    if (field.value && !validateEmail(field.value)) {
                        isValid = false;
                        field.setCustomValidity('Введите корректный email адрес');
                        field.style.outline = '2px solid #ff6b6b';
                    }
                });

                // Проверяем телефонные поля
                telFields.forEach(function(field) {
                    if (field.value && !validatePhone(field.value)) {
                        isValid = false;
                        field.setCustomValidity('Введите корректный номер телефона');
                        field.style.outline = '2px solid #ff6b6b';
                    }
                });

                if (!isValid) {
                    // Показываем ошибку в форме
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'form-error-message';
                    errorDiv.style.cssText = 'color: #FF6B6B; font-family: Stag Sans; font-size: 14px; margin-bottom: 15px; padding: 10px; background: rgba(255,107,107,0.1);';
                    errorDiv.innerHTML = 'Пожалуйста, проверьте корректность заполнения полей Email и Телефона';

                    // Удаляем предыдущие сообщения об ошибках
                    const oldErrors = form.querySelectorAll('.form-error-message');
                    oldErrors.forEach(error => error.remove());

                    // Добавляем новое сообщение
                    form.insertBefore(errorDiv, form.firstChild);
                    return;
                }

                // Блокируем кнопку отправки
                const submitBtn = form.querySelector('input[type="submit"]');
                const originalText = submitBtn.value;
                submitBtn.value = 'Отправка...';
                submitBtn.disabled = true;

                // Отправляем форму через AJAX
                const formData = new FormData(form);

                // Добавляем CSRF токен Bitrix
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
                        // Показываем кастомный попап
                        showCustomPopup();

                        // Очищаем форму
                        form.reset();

                        // Убираем ошибки валидации
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
                        // Разблокируем кнопку
                        submitBtn.value = originalText;
                        submitBtn.disabled = false;
                    });
            });
        }

        // Если форма была отправлена ранее и есть параметры в URL, показываем попап
        if (window.location.search.indexOf('formresult=addok') !== -1) {
            setTimeout(showCustomPopup, 500);
        }
    });

    // Функции для управления попапом
    function showCustomPopup() {
        const popup = document.getElementById('customSuccessPopup');
        if (popup) {
            popup.classList.add('active');
            document.body.style.overflow = 'hidden';

            // Убираем параметры из URL без перезагрузки
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

            // Редирект на чистую страницу
            window.location.href = '/personal/docs/';
        }
    }

    // Закрытие попапа по клику на оверлей
    document.addEventListener('click', function(e) {
        const popup = document.getElementById('customSuccessPopup');
        if (popup && popup.classList.contains('active') && e.target === popup) {
            closeCustomPopup();
        }
    });

    // Закрытие попапа по ESC
    document.addEventListener('keydown', function(e) {
        const popup = document.getElementById('customSuccessPopup');
        if (popup && popup.classList.contains('active') && e.key === 'Escape') {
            closeCustomPopup();
        }
    });
</script>

<?php
// УБИРАЕМ ВСЕ СТАНДАРТНЫЕ ВЫВОДЫ BITRIX
// Оставляем только форму, без сообщений об успехе/ошибках
?>

<section class="contact">
    <div class="contact__content">
        <?php
        // ВЫВОДИМ ТОЛЬКО ФОРМУ, БЕЗ УСПЕШНЫХ СООБЩЕНИЙ
        // Все сообщения теперь в кастомном попапе
        ?>

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
            // Обрабатываем скрытые поля отдельно
            foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):
                if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden'):
                    echo $arQuestion["HTML_CODE"];
                endif;
            endforeach;
            ?>

            <?php
            // Выводим видимые поля
            foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):
                if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] != 'hidden'):
                    $fieldType = $arQuestion['STRUCTURE'][0]['FIELD_TYPE'];
                    $isError = isset($arResult["FORM_ERRORS"][$FIELD_SID]);
                    $fieldClass = $isError ? 'error' : '';
                    $placeholder = htmlspecialcharsbx($arQuestion["CAPTION"]);

                    // Определяем тип поля по его названию или структуре
                    $fieldName = strtolower($arQuestion["CAPTION"]);

                    // Определяем input type для email и телефона
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

                            // Меняем type у input если нужно
                            if ($inputType !== 'text') {
                                $fieldHtml = preg_replace('/type="text"/', 'type="' . $inputType . '"', $fieldHtml);
                            }

                            // Добавляем класс error если есть ошибка
                            if ($isError) {
                                $fieldHtml = preg_replace('/class="([^"]*)"/', 'class="$1 ' . $fieldClass . '"', $fieldHtml);
                                if (strpos($fieldHtml, 'class="') === false) {
                                    $fieldHtml = str_replace('<input ', '<input class="' . $fieldClass . '" ', $fieldHtml);
                                }
                            }

                            // Добавляем placeholder если его нет
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