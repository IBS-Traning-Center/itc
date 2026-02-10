function togglePassword(icon) {
    const input = icon.parentElement.querySelector('input');
    if (input) {
        input.type = input.type === 'password' ? 'text' : 'password';
    }
}

function splitFIO(fullName) {
    const parts = fullName.trim().split(/\s+/);
    return {
        lastName: parts[0] || '',
        name: parts[1] || '',
        secondName: parts[2] || ''
    };
}

function validatePassword(password) {
    const errors = [];

    if (password.length < 8) {
        errors.push('Пароль должен быть не менее 8 символов длиной');
    }

    if (!/\d/.test(password)) {
        errors.push('Пароль должен содержать цифры');
    }

    if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
        errors.push('Пароль должен содержать спецсимволы');
    }

    return errors;
}

function showFieldError(fieldId, errorMessage) {
    const field = document.getElementById(fieldId);
    if (!field) return;

    const fieldContainer = field.closest('.input-field');
    if (!fieldContainer) return;

    let errorElement = fieldContainer.querySelector('.error-text');
    if (!errorElement) {
        errorElement = document.createElement('div');
        errorElement.className = 'error-text';
        fieldContainer.appendChild(errorElement);
    }

    errorElement.textContent = errorMessage;
    errorElement.classList.add('show');

    const wrapper = fieldContainer.querySelector('.input-wrapper');
    if (wrapper) {
        wrapper.classList.add('error');
    }
}

function hideFieldError(fieldId) {
    const field = document.getElementById(fieldId);
    if (!field) return;

    const fieldContainer = field.closest('.input-field');
    if (!fieldContainer) return;

    const errorElement = fieldContainer.querySelector('.error-text');
    if (errorElement) {
        errorElement.classList.remove('show');
        const isHint = errorElement.textContent.includes('Пожалуйста, введите') ||
            errorElement.textContent.includes('Необязательное поле');
        if (!isHint) {
            errorElement.textContent = '';
        }
    }

    const wrapper = fieldContainer.querySelector('.input-wrapper');
    if (wrapper) {
        wrapper.classList.remove('error');
    }
}

function showCheckboxError(checkboxId, errorMessage) {
    const checkbox = document.getElementById(checkboxId);
    if (!checkbox) return;

    const checkboxGroup = checkbox.closest('.checkbox-group');
    if (!checkboxGroup) return;

    let errorElement = checkboxGroup.querySelector('.checkbox-error');
    if (!errorElement) {
        errorElement = document.createElement('div');
        errorElement.className = 'checkbox-error error-text show';
        errorElement.style.marginTop = '4px';
        errorElement.style.color = '#ff0000';
        checkboxGroup.appendChild(errorElement);
    }

    errorElement.textContent = errorMessage;
}

function hideCheckboxError(checkboxId) {
    const checkbox = document.getElementById(checkboxId);
    if (!checkbox) return;

    const checkboxGroup = checkbox.closest('.checkbox-group');
    if (!checkboxGroup) return;

    const errorElement = checkboxGroup.querySelector('.checkbox-error');
    if (errorElement) {
        errorElement.remove();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM загружен, инициализация формы регистрации');

    const form = document.getElementById('registerForm');
    if (!form) {
        console.error('Форма не найдена!');
        return;
    }

    const emailInput = document.getElementById('USER_EMAIL');
    const fullNameInput = document.getElementById('FULL_NAME_INPUT');
    const passwordInput = document.getElementById('REGISTER_PASSWORD');
    const confirmPasswordInput = document.getElementById('REGISTER_CONFIRM_PASSWORD');
    const policyCheckbox = document.getElementById('policyCheckbox');
    const termsCheckbox = document.getElementById('termsCheckbox');

    const regLastName = document.getElementById('REGISTER_LAST_NAME');
    const regName = document.getElementById('REGISTER_NAME');
    const regSecondName = document.getElementById('REGISTER_SECOND_NAME');
    const regLogin = document.getElementById('REGISTER_LOGIN');
    const regEmail = document.getElementById('REGISTER_EMAIL');
    const regFullName = document.getElementById('REGISTER_FULL_NAME');

    console.log('Найденные поля:', {
        emailInput: !!emailInput,
        fullNameInput: !!fullNameInput,
        passwordInput: !!passwordInput,
        confirmPasswordInput: !!confirmPasswordInput,
        policyCheckbox: !!policyCheckbox,
        termsCheckbox: !!termsCheckbox,
        regLastName: !!regLastName,
        regName: !!regName,
        regSecondName: !!regSecondName,
        regLogin: !!regLogin,
        regEmail: !!regEmail,
        regFullName: !!regFullName
    });

    function isCheckboxChecked(checkbox) {
        if (!checkbox) return false;
        return checkbox.checked ||
            checkbox.getAttribute('checked') === 'checked' ||
            checkbox.value === 'on';
    }

    function updateHiddenFields() {
        console.log('=== ОБНОВЛЕНИЕ СКРЫТЫХ ПОЛЕЙ ===');

        // 1. Обновляем email поля
        if (emailInput && emailInput.value) {
            const email = emailInput.value.trim();
            console.log('Email:', email);

            if (regLogin) {
                regLogin.value = email;
                console.log('REGISTER[LOGIN] установлен:', regLogin.value);
            }

            if (regEmail) {
                regEmail.value = email;
                console.log('REGISTER[EMAIL] установлен:', regEmail.value);
            }
        }

        if (fullNameInput && fullNameInput.value) {
            const fullName = fullNameInput.value.trim();
            console.log('ФИО:', fullName);

            if (regFullName) {
                regFullName.value = fullName;
                console.log('REGISTER[FULL_NAME] установлен:', regFullName.value);
            }

            const fioParts = splitFIO(fullName);
            console.log('ФИО разбито:', fioParts);

            if (regLastName) {
                regLastName.value = fioParts.lastName || 'Фамилия';
                console.log('REGISTER[LAST_NAME] установлен:', regLastName.value);
            }

            if (regName) {
                regName.value = fioParts.name || 'Имя';
                console.log('REGISTER[NAME] установлен:', regName.value);
            }

            if (regSecondName) {
                regSecondName.value = fioParts.secondName || '';
                console.log('REGISTER[SECOND_NAME] установлен:', regSecondName.value);
            }
        }
    }

    function clearAllErrors() {

        hideFieldError('USER_EMAIL');
        hideFieldError('FULL_NAME_INPUT');
        hideFieldError('REGISTER_PASSWORD');
        hideFieldError('REGISTER_CONFIRM_PASSWORD');

        hideCheckboxError('policyCheckbox');
        hideCheckboxError('termsCheckbox');
    }

    if (emailInput) {
        emailInput.addEventListener('input', function() {
            updateHiddenFields();
            hideFieldError('USER_EMAIL');
        });
    }

    if (fullNameInput) {
        fullNameInput.addEventListener('input', function() {
            updateHiddenFields();
            hideFieldError('FULL_NAME_INPUT');
        });
    }

    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            hideFieldError('REGISTER_PASSWORD');
        });
    }

    if (confirmPasswordInput) {
        confirmPasswordInput.addEventListener('input', function() {
            hideFieldError('REGISTER_CONFIRM_PASSWORD');
        });
    }

    if (policyCheckbox) {
        policyCheckbox.addEventListener('change', function() {
            hideCheckboxError('policyCheckbox');
        });
    }

    if (termsCheckbox) {
        termsCheckbox.addEventListener('change', function() {
            hideCheckboxError('termsCheckbox');
        });
    }

    setTimeout(updateHiddenFields, 100);

    form.addEventListener('submit', function(e) {
        console.log('=== ОБРАБОТКА ОТПРАВКИ ФОРМЫ ===');

        clearAllErrors();

        let hasErrors = false;

        updateHiddenFields();

        if (!emailInput || !emailInput.value.trim()) {
            showFieldError('USER_EMAIL', 'Пожалуйста, введите email');
            hasErrors = true;
        } else {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value.trim())) {
                showFieldError('USER_EMAIL', 'Пожалуйста, введите корректный email');
                hasErrors = true;
            }
        }

        if (!fullNameInput || !fullNameInput.value.trim()) {
            showFieldError('FULL_NAME_INPUT', 'Пожалуйста, введите ФИО');
            hasErrors = true;
        } else {
            const fioParts = splitFIO(fullNameInput.value.trim());
            if (!fioParts.lastName || !fioParts.name) {
                showFieldError('FULL_NAME_INPUT', 'Пожалуйста, введите и Фамилию, и Имя через пробел');
                hasErrors = true;
            }
        }

        if (!passwordInput || !passwordInput.value.trim()) {
            showFieldError('REGISTER_PASSWORD', 'Пожалуйста, введите пароль');
            hasErrors = true;
        } else {
            const passwordErrors = validatePassword(passwordInput.value);
            if (passwordErrors.length > 0) {
                showFieldError('REGISTER_PASSWORD', passwordErrors[0]);
                hasErrors = true;
            }
        }

        if (!confirmPasswordInput || !confirmPasswordInput.value.trim()) {
            showFieldError('REGISTER_CONFIRM_PASSWORD', 'Пожалуйста, подтвердите пароль');
            hasErrors = true;
        } else if (passwordInput && passwordInput.value !== confirmPasswordInput.value) {
            showFieldError('REGISTER_CONFIRM_PASSWORD', 'Пароли не совпадают');
            hasErrors = true;
        }

        const isPolicyChecked = isCheckboxChecked(policyCheckbox);
        const isTermsChecked = isCheckboxChecked(termsCheckbox);

        console.log('Состояние чекбоксов:', {
            policyCheckbox: isPolicyChecked,
            termsCheckbox: isTermsChecked,
            policyDOM: policyCheckbox ? policyCheckbox.checked : 'не найден',
            termsDOM: termsCheckbox ? termsCheckbox.checked : 'не найден'
        });

        if (!isPolicyChecked) {
            showCheckboxError('policyCheckbox', 'Пожалуйста, ознакомьтесь с Политикой обработки персональных данных');
            hasErrors = true;
        }

        if (!isTermsChecked) {
            showCheckboxError('termsCheckbox', 'Пожалуйста, согласитесь с Условиями обработки персональных данных');
            hasErrors = true;
        }

        if (hasErrors) {
            e.preventDefault();
            console.log('Есть ошибки валидации');

            const firstErrorField = form.querySelector('.show');
            if (firstErrorField) {
                firstErrorField.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                if (emailInput && emailInput.closest('.input-field').querySelector('.show')) {
                    emailInput.focus();
                } else if (fullNameInput && fullNameInput.closest('.input-field').querySelector('.show')) {
                    fullNameInput.focus();
                } else if (passwordInput && passwordInput.closest('.input-field').querySelector('.show')) {
                    passwordInput.focus();
                } else if (confirmPasswordInput && confirmPasswordInput.closest('.input-field').querySelector('.show')) {
                    confirmPasswordInput.focus();
                } else if (policyCheckbox && !isPolicyChecked) {
                    policyCheckbox.focus();
                } else if (termsCheckbox && !isTermsChecked) {
                    termsCheckbox.focus();
                }
            }

            return false;
        }
        if (regLogin && !regLogin.value) {
            console.error('ОШИБКА: REGISTER[LOGIN] пустой!');
            regLogin.value = emailInput.value;
        }

        if (regLastName && !regLastName.value) {
            console.error('ОШИБКА: REGISTER[LAST_NAME] пустой!');
            const fioParts = splitFIO(fullNameInput.value);
            regLastName.value = fioParts.lastName || 'Фамилия';
        }

        if (regName && !regName.value) {
            console.error('ОШИБКА: REGISTER[NAME] пустой!');
            const fioParts = splitFIO(fullNameInput.value);
            regName.value = fioParts.name || 'Имя';
        }
        console.log('=== ДАННЫЕ ДЛЯ ОТПРАВКИ ===');
        const formData = new FormData(form);
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        console.log('Проверка критических полей:');
        console.log('REGISTER[LOGIN]:', regLogin?.value || 'не найден');
        console.log('REGISTER[LAST_NAME]:', regLastName?.value || 'не найден');
        console.log('REGISTER[NAME]:', regName?.value || 'не найден');
        console.log('REGISTER[EMAIL]:', regEmail?.value || 'не найден');
        console.log('REGISTER[FULL_NAME]:', regFullName?.value || 'не найден');
        console.log('policyCheckbox checked:', policyCheckbox?.checked);
        console.log('termsCheckbox checked:', termsCheckbox?.checked);

        console.log('=== ОТПРАВКА ФОРМЫ ===');
        return true;
    });
    const phoneInput = document.getElementById('REGISTER_PERSONAL_PHONE');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, '');
            if (value.length > 0) {
                let formatted = '+7';
                if (value.length > 1) formatted += ' (' + value.substring(1, 4);
                if (value.length >= 4) formatted += ') ' + value.substring(4, 7);
                if (value.length >= 7) formatted += '-' + value.substring(7, 9);
                if (value.length >= 9) formatted += '-' + value.substring(9, 11);
                this.value = formatted;
            }
        });

        if (phoneInput.value && phoneInput.value.replace(/\D/g, '').length > 1) {
            phoneInput.dispatchEvent(new Event('input'));
        }
    }

    console.log('Форма регистрации инициализирована');
});