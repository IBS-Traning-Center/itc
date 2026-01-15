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
	const forgotBtn = document.getElementById('forgotPasswordBtn');
	const authModalOverlay = document.getElementById('authModalOverlay');
	const successModalOverlay = document.getElementById('successModalOverlay');
	const forgotAuthModal = document.getElementById('forgotAuthModal');
	const successAuthModal = document.getElementById('successAuthModal');
	const closeForgotAuth = document.getElementById('closeForgotAuth');
	const closeSuccessAuth = document.getElementById('closeSuccessAuth');
	const backBtnAuth = document.getElementById('backToLoginAuth');
	const backToAuthBtn = document.getElementById('backToAuthBtn');
	const formAuth = document.getElementById('forgotAuthForm');
	const forgotEmailInput = document.getElementById('forgotEmailInput');
	const successEmail = document.getElementById('successEmail');
	const resultBoxAuth = document.getElementById('forgotAuthResult');
	const submitForgotForm = document.getElementById('submitForgotForm');
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

	function showAuthResult(message, type = 'error') {
		authResult.innerHTML = message;
		authResult.className = `auth-result auth-result--${type}`;
		authResult.style.display = 'block';
	}
	function handleAuthSubmit(e) {
		e.preventDefault();
		clearAuthErrors();

		const email = authEmailInput.value.trim();
		const password = authPasswordInput.value;

		if (!email) {
			showFieldError(authEmailInput, authEmailError, 'Введите email');
			return;
		}

		if (!password) {
			showFieldError(authPasswordInput, authPasswordError, 'Введите пароль');
			return;
		}

		if (captchaInput && !captchaInput.value.trim()) {
			showFieldError(captchaInput, captchaError, 'Введите код с картинки');
			return;
		}

		const originalText = authSubmitBtn.textContent;
		authSubmitBtn.textContent = 'Вход...';
		authSubmitBtn.disabled = true;
		showAuthResult('Проверка данных...', 'loading');

		const formData = new FormData(authFormMain);
		formData.append('ajax', 'Y');

		fetch(location.href, {
			method: 'POST',
			body: formData
		})
			.then(res => res.json())
			.then(data => {
				if (data.STATUS === 'OK') {
					showAuthResult(data.MESSAGE, 'success');
					// Успешная авторизация - редирект через 1.5 сек
					setTimeout(() => {
						window.location.href = data.REDIRECT || '/';
					}, 1500);
				} else {
					showAuthResult(data.MESSAGE || 'Ошибка авторизации', 'error');
					if (captchaImg) {
						const imgSrc = captchaImg.src;
						const separator = imgSrc.indexOf('?') > -1 ? '&' : '?';
						captchaImg.src = imgSrc + separator + 'rand=' + Math.random();
					}
					authFormMain.reset();
					authEmailInput.value = email;
				}
			})
			.catch(error => {
				console.error('Auth error:', error);
				showAuthResult('Ошибка соединения. Попробуйте еще раз.', 'error');
			})
			.finally(() => {
				authSubmitBtn.textContent = originalText;
				authSubmitBtn.disabled = false;
			});
	}
	function closeAuthModal() {
		authModalOverlay.style.display = 'none';
		document.body.style.overflow = '';
		resultBoxAuth.style.display = 'none';
		resultBoxAuth.innerHTML = '';
		resultBoxAuth.className = 'auth-modal__result';
		formAuth.reset();
		clearAuthErrors();
	}

	function openSuccessModal(email) {
		successEmail.textContent = email;
		authModalOverlay.style.display = 'none';
		successModalOverlay.style.display = 'flex';
	}

	function closeSuccessModal() {
		successModalOverlay.style.display = 'none';
		document.body.style.overflow = '';
		formAuth.reset();
	}

	// СОБЫТИЯ
	if (authFormMain) {
		authFormMain.addEventListener('submit', handleAuthSubmit);
	}

	if (forgotBtn) {
		forgotBtn.addEventListener('click', function(e) {
			e.preventDefault();
			clearAuthErrors(); // очищаем ошибки при открытии модалки
			authModalOverlay.style.display = 'flex';
			document.body.style.overflow = 'hidden';
		});
	}

	closeForgotAuth.addEventListener('click', closeAuthModal);
	backBtnAuth.addEventListener('click', closeAuthModal);
	closeSuccessAuth.addEventListener('click', closeSuccessModal);

	backToAuthBtn.addEventListener('click', function() {
		closeSuccessModal();
		clearAuthErrors();
	});

	authModalOverlay.addEventListener('click', function(e) {
		if (e.target === authModalOverlay) {
			closeAuthModal();
		}
	});

	successModalOverlay.addEventListener('click', function(e) {
		if (e.target === successModalOverlay) {
			closeSuccessModal();
		}
	});

	document.addEventListener('keydown', function(e) {
		if (e.key === 'Escape') {
			if (authModalOverlay.style.display === 'flex') {
				closeAuthModal();
			}
			if (successModalOverlay.style.display === 'flex') {
				closeSuccessModal();
			}
		}
	});

	formAuth.addEventListener('submit', function(e) {
		e.preventDefault();
		const email = forgotEmailInput.value.trim();

		if (!email) {
			resultBoxAuth.style.display = 'block';
			resultBoxAuth.textContent = 'Пожалуйста, введите email';
			resultBoxAuth.className = 'auth-modal__result auth-modal__result--error';
			return;
		}

		const originalText = submitForgotForm.textContent;
		submitForgotForm.textContent = 'Отправка...';
		submitForgotForm.disabled = true;

		const formData = new FormData();
		formData.append('AUTH_FORM', 'Y');
		formData.append('TYPE', 'SEND_PWD');
		formData.append('USER_LOGIN', email);
		formData.append('ajax', 'Y');

		fetch(location.href, {
			method: 'POST',
			body: formData
		})
			.then(res => res.json())
			.then(data => {
				if (data.STATUS === 'OK') {
					openSuccessModal(email);
				} else {
					resultBoxAuth.style.display = 'block';
					resultBoxAuth.textContent = data.MESSAGE || 'Ошибка отправки';
					resultBoxAuth.className = 'auth-modal__result auth-modal__result--error';
				}
			})
			.catch(() => {
				resultBoxAuth.style.display = 'block';
				resultBoxAuth.textContent = 'Ошибка соединения';
				resultBoxAuth.className = 'auth-modal__result auth-modal__result--error';
			})
			.finally(() => {
				submitForgotForm.textContent = originalText;
				submitForgotForm.disabled = false;
			});
	});
});
function togglePassword(icon) {
	const input = icon.previousElementSibling;
	if (input.type === 'password') {
		input.type = 'text';
	} else {
		input.type = 'password';
	}
}