function togglePassword(icon) {
    const input = icon.parentElement.querySelector('input');
    if (input) {
        input.type = input.type === 'password' ? 'text' : 'password';
    }
}

// Функция валидации пароля
function validatePassword(password) {
    const errors = [];

    if (password.length < 6) {
        errors.push('Пароль должен быть не менее 6 символов длиной');
    }

    if (!/[A-Z]/.test(password)) {
        errors.push('Пароль должен содержать латинские символы верхнего регистра (A-Z)');
    }

    if (!/[a-z]/.test(password)) {
        errors.push('Пароль должен содержать латинские символы нижнего регистра (a-z)');
    }

    return errors;
}

// Функция для отображения ошибок под полем (красный текст друг под другом)
function showFieldError(fieldName, message) {
    const inputField = document.querySelector(`input[name="${fieldName}"]`);
    if (!inputField) return;

    const wrapper = inputField.closest('.input-wrapper');
    const errorText = wrapper?.nextElementSibling;



    if (errorText) {
        // Если сообщение содержит несколько ошибок, разбиваем их на строки
        const messages = message.split('. ').filter(msg => msg.trim() !== '');

        // Форматируем ошибки: каждая с новой строки, красный цвет
        const formattedMessage = messages
            .map(msg => `<span style="color: #ff0000; display: block;">${msg}</span>`)
            .join('');

        errorText.innerHTML = formattedMessage;
        errorText.classList.add('show');
    }
}

// Функция для очистки ошибок поля
function clearFieldError(fieldName) {
    const inputField = document.querySelector(`input[name="${fieldName}"]`);
    if (!inputField) return;

    const wrapper = inputField.closest('.input-wrapper');
    const errorText = wrapper?.nextElementSibling;

    if (wrapper) {
        wrapper.classList.remove('error');

        // Удаляем иконку ошибки
        const errorIcon = wrapper.querySelector('.error-icon');
        if (errorIcon) {
            errorIcon.remove();
        }
    }

    if (errorText) {
        errorText.innerHTML = ''; // Очищаем содержимое
        errorText.classList.remove('show');
    }
}

// Функция для разбиения ФИО на части
function splitFIO(fullName) {
    const parts = fullName.trim().split(/\s+/);
    return {
        lastName: parts[0] || '',      // Фамилия
        name: parts[1] || '',          // Имя
        secondName: parts[2] || ''     // Отчество
    };
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form.inputs-container');
    const fullNameInput = document.getElementById('fullName');
    const hiddenName = document.getElementById('hiddenName');
    const hiddenLastName = document.getElementById('hiddenLastName');
    const hiddenSecondName = document.getElementById('hiddenSecondName');
    const hiddenLogin = document.getElementById('hiddenLogin');
    const emailInput = form.querySelector('input[name="REGISTER[EMAIL]"]');
    const passwordInput = form.querySelector('input[name="REGISTER[PASSWORD]"]');
    const confirmPasswordInput = form.querySelector('input[name="REGISTER[CONFIRM_PASSWORD]"]');

    // Обновление логина при вводе email
    if (emailInput && hiddenLogin) {
        emailInput.addEventListener('input', function() {
            hiddenLogin.value = this.value;
        });
        // Инициализация
        hiddenLogin.value = emailInput.value;
    }

    // Обновление ФИО
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

    // Валидация пароля при вводе
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const errors = validatePassword(password);

            if (errors.length > 0) {
                showFieldError('REGISTER[PASSWORD]', errors.join('. '));
            } else {
                clearFieldError('REGISTER[PASSWORD]');
            }

            // Также проверяем подтверждение пароля
            if (confirmPasswordInput && confirmPasswordInput.value) {
                if (password !== confirmPasswordInput.value) {
                    showFieldError('REGISTER[CONFIRM_PASSWORD]', 'Пароли не совпадают');
                } else {
                    clearFieldError('REGISTER[CONFIRM_PASSWORD]');
                }
            }
        });
    }

    // Валидация подтверждения пароля при вводе
    if (confirmPasswordInput) {
        confirmPasswordInput.addEventListener('input', function() {
            const password = passwordInput ? passwordInput.value : '';
            const confirmPassword = this.value;

            if (confirmPassword && password !== confirmPassword) {
                showFieldError('REGISTER[CONFIRM_PASSWORD]', 'Пароли не совпадают');
            } else {
                clearFieldError('REGISTER[CONFIRM_PASSWORD]');
            }
        });
    }

    // Валидация при отправке формы
    if (form) {
        form.addEventListener('submit', function(e) {
            console.log('Отправка формы...');

            let hasErrors = false;

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
                showFieldError('REGISTER[EMAIL]', 'Пожалуйста, введите корректный email');
                emailInput.focus();
                return false;
            }

            // Валидация пароля
            if (passwordInput) {
                const password = passwordInput.value;
                const errors = validatePassword(password);

                if (errors.length > 0) {
                    e.preventDefault();
                    showFieldError('REGISTER[PASSWORD]', errors.join('. '));
                    hasErrors = true;
                    passwordInput.focus();
                }
            }

            // Проверка совпадения паролей
            if (passwordInput && confirmPasswordInput) {
                if (passwordInput.value !== confirmPasswordInput.value) {
                    e.preventDefault();
                    showFieldError('REGISTER[CONFIRM_PASSWORD]', 'Пароли не совпадают');
                    hasErrors = true;
                    if (!hasErrors) confirmPasswordInput.focus();
                }
            }

            // Валидация ФИО
            if (fullNameInput) {
                const fioValue = fullNameInput.value.trim();
                const nameParts = fioValue.split(/\s+/);

                if (fioValue.length === 0) {
                    e.preventDefault();
                    showFieldError('REGISTER[FULL_NAME]', 'Пожалуйста, введите ФИО');
                    fullNameInput.focus();
                    return false;
                }

                if (nameParts.length < 2) {
                    e.preventDefault();
                    showFieldError('REGISTER[FULL_NAME]', 'Пожалуйста, введите и Фамилию, и Имя через пробел');
                    fullNameInput.focus();
                    return false;
                }
            }


            return !hasErrors;
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
                    // Очищаем только если это не обязательное поле с текстом-подсказкой
                    const isOptionalHint = errorText.textContent.includes('Необязательное поле') ||
                        errorText.textContent.includes('Пожалуйста, введите');

                    if (!isOptionalHint) {
                        errorText.innerHTML = '';
                        errorText.classList.remove('show');
                    }
                }

                // Удаляем иконку ошибки при вводе
                const errorIcon = wrapper?.querySelector('.error-icon');
                if (errorIcon) {
                    errorIcon.remove();
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


});