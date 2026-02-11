function togglePasswordModal(icon) {
    const input = icon.parentElement.querySelector('input');
    if (input) {
        input.type = input.type === 'password' ? 'text' : 'password';
    }
}

function splitFIOModal(fullName) {
    const parts = fullName.trim().split(/\s+/);
    return {
        lastName: parts[0] || '',
        name: parts[1] || '',
        secondName: parts[2] || ''
    };
}

function validatePasswordModal(password) {
    const errors = [];

    if (password.length < 8) {
        errors.push('Пароль должен быть не менее 6 символов длиной');
    }

    if (!/\d/.test(password)) {
        errors.push('Пароль должен содержать цифры');
    }

    if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
        errors.push('Пароль должен содержать спецсимволы');
    }

    return errors;
}

function showFieldErrorModal(fieldId, errorMessage) {
    const field = document.getElementById(fieldId);
    if (!field) return;

    const fieldContainer = field.closest('.modal-input-field');
    if (!fieldContainer) return;

    let errorElement = fieldContainer.querySelector('.modal-error-text');
    if (!errorElement) {
        errorElement = document.createElement('div');
        errorElement.className = 'modal-error-text';
        fieldContainer.appendChild(errorElement);
    }

    errorElement.textContent = errorMessage;
    errorElement.classList.add('modal-show');

    const wrapper = fieldContainer.querySelector('.modal-input-wrapper');
    if (wrapper) {
        wrapper.classList.add('modal-error');
    }
}

function hideFieldErrorModal(fieldId) {
    const field = document.getElementById(fieldId);
    if (!field) return;

    const fieldContainer = field.closest('.modal-input-field');
    if (!fieldContainer) return;

    const errorElement = fieldContainer.querySelector('.modal-error-text');
    if (errorElement) {
        errorElement.classList.remove('modal-show');
        // Если это не статическое сообщение (подсказка), скрываем его
        const isHint = errorElement.textContent.includes('Пожалуйста, введите') ||
            errorElement.textContent.includes('Необязательное поле');
        if (!isHint) {
            errorElement.textContent = '';
        }
    }

    const wrapper = fieldContainer.querySelector('.modal-input-wrapper');
    if (wrapper) {
        wrapper.classList.remove('modal-error');
    }
}

function showCheckboxErrorModal(checkboxId, errorMessage) {
    const checkbox = document.getElementById(checkboxId);
    if (!checkbox) return;

    const checkboxGroup = checkbox.closest('.modal-checkbox-group');
    if (!checkboxGroup) return;

    let errorElement = checkboxGroup.querySelector('.modal-checkbox-error');
    if (!errorElement) {
        errorElement = document.createElement('div');
        errorElement.className = 'modal-checkbox-error modal-error-text modal-show';
        errorElement.style.marginTop = '4px';
        errorElement.style.color = '#ff0000';
        checkboxGroup.appendChild(errorElement);
    }

    errorElement.textContent = errorMessage;
}

function hideCheckboxErrorModal(checkboxId) {
    const checkbox = document.getElementById(checkboxId);
    if (!checkbox) return;

    const checkboxGroup = checkbox.closest('.modal-checkbox-group');
    if (!checkboxGroup) return;

    const errorElement = checkboxGroup.querySelector('.modal-checkbox-error');
    if (errorElement) {
        errorElement.remove();
    }
}

document.addEventListener('DOMContentLoaded', function() {

    const modalForm = document.getElementById('registerFormModal');
    if (!modalForm) {
        console.log('Модальная форма не найдена, пропускаем инициализацию');
        return;
    }

    console.log('Инициализация модальной формы регистрации');

    const emailInput = document.getElementById('USER_EMAIL_MODAL');
    const fullNameInput = document.getElementById('FULL_NAME_INPUT_MODAL');
    const passwordInput = document.getElementById('REGISTER_PASSWORD_MODAL');
    const confirmPasswordInput = document.getElementById('REGISTER_CONFIRM_PASSWORD_MODAL');
    const policyCheckbox = document.getElementById('policyCheckboxModal');
    const termsCheckbox = document.getElementById('termsCheckboxModal');

    const regLastName = document.getElementById('REGISTER_LAST_NAME_MODAL');
    const regName = document.getElementById('REGISTER_NAME_MODAL');
    const regSecondName = document.getElementById('REGISTER_SECOND_NAME_MODAL');
    const regLogin = document.getElementById('REGISTER_LOGIN_MODAL');
    const regEmail = document.getElementById('REGISTER_EMAIL_MODAL');
    const regFullName = document.getElementById('REGISTER_FULL_NAME_MODAL');

    function isCheckboxCheckedModal(checkbox) {
        if (!checkbox) return false;
        return checkbox.checked ||
            checkbox.getAttribute('checked') === 'checked' ||
            checkbox.value === 'on';
    }

    // Функция обновления всех скрытых полей
    function updateHiddenFieldsModal() {
        console.log('=== ОБНОВЛЕНИЕ СКРЫТЫХ ПОЛЕЙ МОДАЛКИ ===');
        if (emailInput && emailInput.value) {
            const email = emailInput.value.trim();
            console.log('Email модалки:', email);

            if (regLogin) {
                regLogin.value = email;
                console.log('REGISTER[LOGIN] модалки установлен:', regLogin.value);
            }

            if (regEmail) {
                regEmail.value = email;
                console.log('REGISTER[EMAIL] модалки установлен:', regEmail.value);
            }
        }
        if (fullNameInput && fullNameInput.value) {
            const fullName = fullNameInput.value.trim();
            console.log('ФИО модалки:', fullName);

            if (regFullName) {
                regFullName.value = fullName;
                console.log('REGISTER[FULL_NAME] модалки установлен:', regFullName.value);
            }

            const fioParts = splitFIOModal(fullName);
            console.log('ФИО модалки разбито:', fioParts);

            if (regLastName) {
                regLastName.value = fioParts.lastName || 'Фамилия';
                console.log('REGISTER[LAST_NAME] модалки установлен:', regLastName.value);
            }

            if (regName) {
                regName.value = fioParts.name || 'Имя';
                console.log('REGISTER[NAME] модалки установлен:', regName.value);
            }

            if (regSecondName) {
                regSecondName.value = fioParts.secondName || '';
                console.log('REGISTER[SECOND_NAME] модалки установлен:', regSecondName.value);
            }
        }
    }
    function clearAllErrorsModal() {
        // Очищаем ошибки полей
        hideFieldErrorModal('USER_EMAIL_MODAL');
        hideFieldErrorModal('FULL_NAME_INPUT_MODAL');
        hideFieldErrorModal('REGISTER_PASSWORD_MODAL');
        hideFieldErrorModal('REGISTER_CONFIRM_PASSWORD_MODAL');

        // Очищаем ошибки чекбоксов
        hideCheckboxErrorModal('policyCheckboxModal');
        hideCheckboxErrorModal('termsCheckboxModal');
    }

    // Обработчики для скрытия ошибок при вводе
    if (emailInput) {
        emailInput.addEventListener('input', function() {
            updateHiddenFieldsModal();
            hideFieldErrorModal('USER_EMAIL_MODAL');
        });
    }

    if (fullNameInput) {
        fullNameInput.addEventListener('input', function() {
            updateHiddenFieldsModal();
            hideFieldErrorModal('FULL_NAME_INPUT_MODAL');
        });
    }

    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            hideFieldErrorModal('REGISTER_PASSWORD_MODAL');
        });
    }

    if (confirmPasswordInput) {
        confirmPasswordInput.addEventListener('input', function() {
            hideFieldErrorModal('REGISTER_CONFIRM_PASSWORD_MODAL');
        });
    }

    if (policyCheckbox) {
        policyCheckbox.addEventListener('change', function() {
            hideCheckboxErrorModal('policyCheckboxModal');
        });
    }

    if (termsCheckbox) {
        termsCheckbox.addEventListener('change', function() {
            hideCheckboxErrorModal('termsCheckboxModal');
        });
    }

    setTimeout(updateHiddenFieldsModal, 100);

    modalForm.addEventListener('submit', function(e) {
        console.log('=== ОБРАБОТКА ОТПРАВКИ ФОРМЫ МОДАЛКИ ===');
        clearAllErrorsModal();

        let hasErrors = false;

        updateHiddenFieldsModal();

        if (!emailInput || !emailInput.value.trim()) {
            showFieldErrorModal('USER_EMAIL_MODAL', 'Пожалуйста, введите email');
            hasErrors = true;
        } else {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value.trim())) {
                showFieldErrorModal('USER_EMAIL_MODAL', 'Пожалуйста, введите корректный email');
                hasErrors = true;
            }
        }
        if (!fullNameInput || !fullNameInput.value.trim()) {
            showFieldErrorModal('FULL_NAME_INPUT_MODAL', 'Пожалуйста, введите ФИО');
            hasErrors = true;
        } else {
            const fioParts = splitFIOModal(fullNameInput.value.trim());
            if (!fioParts.lastName || !fioParts.name) {
                showFieldErrorModal('FULL_NAME_INPUT_MODAL', 'Пожалуйста, введите и Фамилию, и Имя через пробел');
                hasErrors = true;
            }
        }

        if (!passwordInput || !passwordInput.value.trim()) {
            showFieldErrorModal('REGISTER_PASSWORD_MODAL', 'Пожалуйста, введите пароль');
            hasErrors = true;
        } else {
            const passwordErrors = validatePasswordModal(passwordInput.value);
            if (passwordErrors.length > 0) {
                showFieldErrorModal('REGISTER_PASSWORD_MODAL', passwordErrors[0]);
                hasErrors = true;
            }
        }
        if (!confirmPasswordInput || !confirmPasswordInput.value.trim()) {
            showFieldErrorModal('REGISTER_CONFIRM_PASSWORD_MODAL', 'Пожалуйста, подтвердите пароль');
            hasErrors = true;
        } else if (passwordInput && passwordInput.value !== confirmPasswordInput.value) {
            showFieldErrorModal('REGISTER_CONFIRM_PASSWORD_MODAL', 'Пароли не совпадают');
            hasErrors = true;
        }
        const isPolicyChecked = isCheckboxCheckedModal(policyCheckbox);
        const isTermsChecked = isCheckboxCheckedModal(termsCheckbox);

        if (!isPolicyChecked) {
            showCheckboxErrorModal('policyCheckboxModal', 'Пожалуйста, ознакомьтесь с Политикой обработки персональных данных');
            hasErrors = true;
        }

        if (!isTermsChecked) {
            showCheckboxErrorModal('termsCheckboxModal', 'Пожалуйста, согласитесь с Условиями обработки персональных данных');
            hasErrors = true;
        }
        if (hasErrors) {
            e.preventDefault();
            console.log('Есть ошибки валидации модалки');
            const firstErrorField = modalForm.querySelector('.modal-show');
            if (firstErrorField) {
                firstErrorField.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                if (emailInput && emailInput.closest('.modal-input-field').querySelector('.modal-show')) {
                    emailInput.focus();
                } else if (fullNameInput && fullNameInput.closest('.modal-input-field').querySelector('.modal-show')) {
                    fullNameInput.focus();
                } else if (passwordInput && passwordInput.closest('.modal-input-field').querySelector('.modal-show')) {
                    passwordInput.focus();
                } else if (confirmPasswordInput && confirmPasswordInput.closest('.modal-input-field').querySelector('.modal-show')) {
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
            console.error('ОШИБКА МОДАЛКИ: REGISTER[LOGIN] пустой!');
            regLogin.value = emailInput.value;
        }

        if (regLastName && !regLastName.value) {
            console.error('ОШИБКА МОДАЛКИ: REGISTER[LAST_NAME] пустой!');
            const fioParts = splitFIOModal(fullNameInput.value);
            regLastName.value = fioParts.lastName || 'Фамилия';
        }

        if (regName && !regName.value) {
            console.error('ОШИБКА МОДАЛКИ: REGISTER[NAME] пустой!');
            const fioParts = splitFIOModal(fullNameInput.value);
            regName.value = fioParts.name || 'Имя';
        }
        console.log('=== ДАННЫЕ ДЛЯ ОТПРАВКИ МОДАЛКИ ===');
        const formData = new FormData(modalForm);
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        console.log('=== ОТПРАВКА ФОРМЫ МОДАЛКИ ===');
        return true;
    });

    const phoneInput = document.getElementById('REGISTER_PERSONAL_PHONE_MODAL');
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

    console.log('Модальная форма регистрации инициализирована');
});