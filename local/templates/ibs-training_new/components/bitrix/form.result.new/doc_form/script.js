class BitrixAjaxForm {
    constructor(options = {}) {
        this.formSelector = options.formSelector || '.contact form';
        this.popupId = options.popupId || 'customSuccessPopup';

        this.form = null;
        this.emailFields = [];
        this.telFields = [];

        this.init();
    }

    init() {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.onReady());
        } else {
            this.onReady();
        }
    }

    onReady() {
        this.form = document.querySelector(this.formSelector);
        if (!this.form) return;

        this.emailFields = this.form.querySelectorAll('input[type="email"]');
        this.telFields   = this.form.querySelectorAll('input[type="tel"]');

        this.bindValidation();
        this.bindSubmit();
        this.checkUrlPopup();
    }
    validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    validatePhone(phone) {
        const digits = phone.replace(/\D/g, '');
        return digits.length === 10 || digits.length === 11;
    }

    bindValidation() {
        this.emailFields.forEach(field => {
            field.addEventListener('blur', () => {
                field.setCustomValidity(
                    field.value && !this.validateEmail(field.value)
                        ? 'Введите корректный email'
                        : ''
                );
            });
        });

        this.telFields.forEach(field => {
            field.addEventListener('input', () => this.phoneMask(field));
            field.addEventListener('blur', () => {
                field.setCustomValidity(
                    field.value && !this.validatePhone(field.value)
                        ? 'Введите корректный номер телефона'
                        : ''
                );
            });
        });
    }

    phoneMask(field) {
        let v = field.value.replace(/\D/g, '');
        if (v.startsWith('7') || v.startsWith('8')) v = v.slice(1);
        v = v.slice(0, 10);

        let res = '+7';
        if (v.length) res += ' (' + v.slice(0, 3);
        if (v.length > 3) res += ') ' + v.slice(3, 6);
        if (v.length > 6) res += '-' + v.slice(6, 8);
        if (v.length > 8) res += '-' + v.slice(8, 10);

        field.value = res;
    }

    bindSubmit() {
        this.form.addEventListener('submit', e => {
            e.preventDefault();
            this.submit();
        });
    }

    submit() {
        const errors = [];

        this.form.querySelectorAll('[required]').forEach(field => {
            if (field.type === 'checkbox' && !field.checked) {
                errors.push('Необходимо согласие');
            } else if (field.type !== 'checkbox' && !field.value.trim()) {
                errors.push(`Поле "${field.placeholder || field.name}" обязательно`);
            }
        });

        this.emailFields.forEach(f => {
            if (f.value && !this.validateEmail(f.value)) {
                errors.push('Некорректный email');
            }
        });

        this.telFields.forEach(f => {
            if (f.value && !this.validatePhone(f.value)) {
                errors.push('Некорректный телефон');
            }
        });

        if (errors.length) {
            this.showErrors(errors);
            return;
        }

        this.sendAjax();
    }

    sendAjax() {
        const submitBtn = this.form.querySelector('[type="submit"]');
        const btnText = submitBtn.value;

        submitBtn.disabled = true;
        submitBtn.value = 'Отправка...';

        const formData = new FormData(this.form);


        formData.append('web_form_submit', 'Y');
        if (window.BX && BX.bitrix_sessid) {
            formData.append('sessid', BX.bitrix_sessid());
        }

        fetch(this.form.action || location.href, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(r => r.text())
            .then(html => {
                // Bitrix при успехе обычно добавляет в URL ?formresult=addok и может возвращать это в HTML или редирект
                // Ваш текущий чек html.includes('formresult') может сработать, если в ответе есть такой текст
                if (html.includes('formresult') || html.includes('Успешно') || html.toLowerCase().includes('addok')) {
                    this.form.reset();
                    this.showPopup();
                } else {
                    throw new Error();
                }
            })
            .catch(() => {
                this.showErrors(['Ошибка отправки формы. Попробуйте позже.']);
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.value = btnText;
            });
    }

    showErrors(messages) {
        this.form.querySelectorAll('.form-error-message').forEach(e => e.remove());

        const div = document.createElement('div');
        div.className = 'form-error-message';
        div.style.cssText =
            'color:#FF6B6B;font-size:14px;margin-bottom:15px;padding:10px;' +
            'background:rgba(255,107,107,0.1);border-radius:4px';
        if (html.includes('formresult')) {
            // успех
        } else {
            throw new Error();
        }
        div.innerHTML =
            '<strong>Исправьте ошибки:</strong><ul>' +
            messages.map(m => `<li>${m}</li>`).join('') +
            '</ul>';

        this.form.prepend(div);
        div.scrollIntoView({ behavior: 'smooth' });
    }

    showPopup() {
        const popup = document.getElementById(this.popupId);
        if (!popup) return;

        popup.classList.add('active');
        document.body.style.overflow = 'hidden';

        history.replaceState({}, document.title, location.pathname);
    }

    closePopup() {
        const popup = document.getElementById(this.popupId);
        if (!popup) return;

        popup.classList.remove('active');
        document.body.style.overflow = '';
        location.href = '/personal/docs/';
    }

    checkUrlPopup() {
        if (location.search.includes('formresult')) {
            setTimeout(() => this.showPopup(), 300);
        }
    }
}

const contactForm = new BitrixAjaxForm({
    formSelector: '.contact form',
    popupId: 'customSuccessPopup'
});

document.addEventListener('click', e => {
    if (e.target?.id === 'customSuccessPopup') {
        contactForm.closePopup();
    }
});

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        contactForm.closePopup();
    }
});
