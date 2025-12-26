document.addEventListener('DOMContentLoaded', function() {
    function validateEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    function validatePhone(phone) {
        const re = /^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/;
        return re.test(String(phone).replace(/\s+/g, ''));
    }

    function getRequiredFields() {
        const requiredFields = [];

        document.querySelectorAll('[required]').forEach(field => {
            requiredFields.push(field);
        });

        document.querySelectorAll('.required').forEach(requiredSpan => {
            const field = requiredSpan.closest('label')?.querySelector('input, textarea, select') ||
                requiredSpan.parentElement?.previousElementSibling ||
                requiredSpan.parentElement?.parentElement?.querySelector('input, textarea, select');
            if (field && !field.hasAttribute('required')) {
                field.setAttribute('data-required-by-asterisk', 'true');
                requiredFields.push(field);
            }
        });

        return requiredFields;
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
            const errorMessages = [];

            const requiredFields = getRequiredFields();
            requiredFields.forEach(function(field) {
                let fieldValue = field.value;

                if (field.type === 'checkbox') {
                    if (!field.checked) {
                        isValid = false;

                        const label = field.closest('label');
                        if (label) {
                            const spanText = label.querySelector('span:not(.required)');
                            const fieldName = spanText ? spanText.textContent.replace('*', '').trim() : 'Это поле';
                            errorMessages.push(`Поле "${fieldName}" обязательно для заполнения`);
                        }
                    }
                }
                else {
                    fieldValue = fieldValue ? fieldValue.trim() : '';

                    if (!fieldValue) {
                        isValid = false;

                        const placeholder = field.getAttribute('placeholder') ||
                            field.getAttribute('name') ||
                            field.previousElementSibling?.textContent ||
                            'Это поле';
                        const fieldName = placeholder.replace('*', '').trim();
                        errorMessages.push(`Поле "${fieldName}" обязательно для заполнения`);
                    }
                }
            });

            emailFields.forEach(function(field) {
                if (field.value && !validateEmail(field.value)) {
                    isValid = false;
                    errorMessages.push('Введите корректный email адрес');
                }
            });

            telFields.forEach(function(field) {
                if (field.value && !validatePhone(field.value)) {
                    isValid = false;
                    errorMessages.push('Введите корректный номер телефона');
                }
            });

            const captchaField = form.querySelector('input[name="captcha_word"]');
            if (captchaField && captchaField.hasAttribute('required')) {
                if (!captchaField.value.trim()) {
                    isValid = false;
                    errorMessages.push('Пожалуйста, введите код с картинки');
                }
            }

            if (!isValid) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'form-error-message';
                errorDiv.style.cssText = 'color: #FF6B6B; font-family: Stag Sans; font-size: 14px; margin-bottom: 15px; padding: 10px; background: rgba(255,107,107,0.1); border-radius: 4px;';

                let errorHtml = '<strong>Пожалуйста, исправьте следующие ошибки:</strong><ul style="margin: 10px 0 0 0; padding-left: 20px;">';
                errorMessages.forEach(msg => {
                    errorHtml += `<li>${msg}</li>`;
                });
                errorHtml += '</ul>';

                errorDiv.innerHTML = errorHtml;

                const oldErrors = form.querySelectorAll('.form-error-message');
                oldErrors.forEach(error => error.remove());

                form.insertBefore(errorDiv, form.firstChild);

                // Прокрутка к ошибке
                errorDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
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

                    const oldErrors = form.querySelectorAll('.form-error-message');
                    oldErrors.forEach(error => error.remove());
                })
                .catch(error => {
                    console.error('Ошибка отправки формы:', error);

                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'form-error-message';
                    errorDiv.style.cssText = 'color: #FF6B6B; font-family: Stag Sans; font-size: 14px; margin-bottom: 15px; padding: 10px; background: rgba(255,107,107,0.1); border-radius: 4px;';
                    errorDiv.innerHTML = 'Произошла ошибка при отправке формы. Попробуйте еще раз.';

                    const oldErrors = form.querySelectorAll('.form-error-message');
                    oldErrors.forEach(error => error.remove());

                    form.insertBefore(errorDiv, form.firstChild);
                })
                .finally(() => {
                    submitBtn.value = originalText;
                    submitBtn.disabled = false;
                });
        });
    }
    setTimeout(() => {
        const requiredFields = getRequiredFields();
        requiredFields.forEach(field => {
            if (field.type !== 'hidden' && field.type !== 'checkbox') {
                const placeholder = field.getAttribute('placeholder');
                if (placeholder && !placeholder.includes('*')) {
                    field.setAttribute('placeholder', placeholder + ' *');
                }
            }
        });
    }, 100);

    if (window.location.search.indexOf('formresult=adddoc') !== -1) {
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