document.addEventListener('DOMContentLoaded', function () {
	const authFormMain = document.getElementById('authFormMain');
	const authEmailInput = document.getElementById('authEmailInput');
	const authPasswordInput = document.getElementById('authPasswordInput');
	const authSubmitBtn = document.getElementById('authSubmitBtn');
	const authResult = document.getElementById('authResult');
	const authEmailError = document.getElementById('authEmailError');
	const authPasswordError = document.getElementById('authPasswordError');
	const captchaInput = document.getElementById('captchaInput');
	const captchaError = document.getElementById('captchaError');
	const captchaImg = document.getElementById('captchaImg');

	const resetPasswordBtn = document.getElementById('resetPasswordBtn');
	const authOverlay = document.getElementById('authOverlay');
	const successOverlay = document.getElementById('successOverlay');
	const resetPasswordModal = document.getElementById('resetPasswordModal');
	const successPasswordModal = document.getElementById('successPasswordModal');
	const closeResetModal = document.getElementById('closeResetModal');
	const closeSuccessModal = document.getElementById('closeSuccessModal');
	const backToAuthBtn = document.getElementById('backToAuthBtn');
	const returnToAuthBtn = document.getElementById('returnToAuthBtn');
	const resetPasswordForm = document.getElementById('resetPasswordForm');
	const resetEmailInput = document.getElementById('resetEmailInput');
	const successEmailText = document.getElementById('successEmailText');
	const resetResultMessage = document.getElementById('resetResultMessage');
	const submitResetForm = document.getElementById('submitResetForm');

	function clearAuthErrors() {
		authResult.className = '';
		authResult.innerHTML = '';
		authResult.style.display = 'none';
		clearFieldError(authEmailInput, authEmailError);
		clearFieldError(authPasswordInput, authPasswordError);
		if (captchaError) clearFieldError(captchaInput, captchaError);

		// Удаляем классы ошибки
		authEmailInput.classList.remove('error');
		authPasswordInput.classList.remove('error');
		if (captchaInput) captchaInput.classList.remove('error');
	}

	function clearFieldError(input, errorEl) {
		if (errorEl) {
			errorEl.textContent = '';
			input.classList.remove('error');
		}
	}

	function showFieldError(input, errorEl, message) {
		if (errorEl) {
			errorEl.textContent = message;
			input.classList.add('error');
		}
	}

	function showAuthResult(message, type) {
		authResult.style.display = 'block';
		authResult.textContent = message;
		authResult.className = 'auth-result auth-result--' + type;
	}
	if (authFormMain) {
		authFormMain.addEventListener('submit', function (e) {
			clearAuthErrors();

			const email = authEmailInput.value.trim();
			const password = authPasswordInput.value;

			let hasErrors = false;

			if (!email) {
				showFieldError(authEmailInput, authEmailError, 'Введите email');
				hasErrors = true;
			}

			if (!password) {
				showFieldError(authPasswordInput, authPasswordError, 'Введите пароль');
				hasErrors = true;
			}

			if (captchaInput && !captchaInput.value.trim()) {
				showFieldError(captchaInput, captchaError, 'Введите код с картинки');
				hasErrors = true;
			}

			if (hasErrors) {
				e.preventDefault();
				return;
			}

			// Добавляем backurl в форму если его нет
			if (!document.querySelector('input[name="backurl"]')) {
				const backurlInput = document.createElement('input');
				backurlInput.type = 'hidden';
				backurlInput.name = 'backurl';
				backurlInput.value = '/personal/';
				this.appendChild(backurlInput);
			}

			// Форма отправляется обычным способом
			// Битрикс сам сделает редирект
		});
	}
	if (resetPasswordBtn) {
		resetPasswordBtn.addEventListener('click', function (e) {
			e.preventDefault();
			authOverlay.style.display = 'flex';
			document.body.style.overflow = 'hidden';
		});
	}

	function closeResetModalFunc() {
		authOverlay.style.display = 'none';
		document.body.style.overflow = '';
		resetResultMessage.style.display = 'none';
		resetResultMessage.innerHTML = '';
		resetResultMessage.className = 'auth-modal__result';
		resetPasswordForm.reset();
		clearAuthErrors();
	}

	if (closeResetModal) {
		closeResetModal.addEventListener('click', closeResetModalFunc);
	}

	if (backToAuthBtn) {
		backToAuthBtn.addEventListener('click', closeResetModalFunc);
	}

	function openSuccessModal(email) {
		successEmailText.textContent = email;
		authOverlay.style.display = 'none';
		successOverlay.style.display = 'flex';
	}

	function closeSuccessModalFunc() {
		successOverlay.style.display = 'none';
		document.body.style.overflow = '';
		resetPasswordForm.reset();
	}

	if (closeSuccessModal) {
		closeSuccessModal.addEventListener('click', closeSuccessModalFunc);
	}

	if (returnToAuthBtn) {
		returnToAuthBtn.addEventListener('click', function () {
			closeSuccessModalFunc();
			closeResetModalFunc();
		});
	}

	if (authOverlay) {
		authOverlay.addEventListener('click', function (e) {
			if (e.target === authOverlay) {
				closeResetModalFunc();
			}
		});
	}

	if (successOverlay) {
		successOverlay.addEventListener('click', function (e) {
			if (e.target === successOverlay) {
				closeSuccessModalFunc();
			}
		});
	}

	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape') {
			if (authOverlay.style.display === 'flex') {
				closeResetModalFunc();
			}
			if (successOverlay.style.display === 'flex') {
				closeSuccessModalFunc();
			}
		}
	});
	if (resetPasswordForm) {
		resetPasswordForm.addEventListener('submit', function (e) {
			e.preventDefault();

			const email = resetEmailInput.value.trim();
			if (!email) {
				resetResultMessage.style.display = 'block';
				resetResultMessage.textContent = 'Пожалуйста, введите email';
				resetResultMessage.className = 'auth-modal__result auth-modal__result--error';
				return;
			}
			const originalText = submitResetForm.textContent;
			submitResetForm.textContent = 'Отправка...';
			submitResetForm.disabled = true;

			const formData = new FormData();
			formData.append('AUTH_FORM', 'Y');
			formData.append('TYPE', 'SEND_PWD');
			formData.append('USER_LOGIN', email);

			fetch(location.href, {
				method: 'POST',
				body: formData
			})
				.then(res => {
					if (res.ok) {
						openSuccessModal(email);
					} else {
						throw new Error('Ошибка сервера');
					}
				})
				.catch(() => {
					resetResultMessage.style.display = 'block';
					resetResultMessage.textContent = 'Ошибка отправки. Попробуйте позже.';
					resetResultMessage.className = 'auth-modal__result auth-modal__result--error';
				})
				.finally(() => {
					submitResetForm.textContent = originalText;
					submitResetForm.disabled = false;
				});
		});
	}

});

function togglePassword(icon) {
	const input = icon.previousElementSibling;
	if (input.type === 'password') {
		input.type = 'text';
	} else {
		input.type = 'password';
	}
}