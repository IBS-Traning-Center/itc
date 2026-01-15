document.addEventListener('DOMContentLoaded', function () {
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
	const successMessage = document.getElementById('successMessage');
	const resultBoxAuth = document.getElementById('forgotAuthResult');
	const submitForgotForm = document.getElementById('submitForgotForm');

	// Открытие первой модалки
	if(forgotBtn){
		forgotBtn.addEventListener('click', function(e){
			e.preventDefault();
			authModalOverlay.style.display = 'flex';
			document.body.style.overflow = 'hidden';
		});
	}

	// Закрытие первой модалки
	function closeAuthModal() {
		authModalOverlay.style.display = 'none';
		document.body.style.overflow = '';
		resultBoxAuth.style.display = 'none';
		resultBoxAuth.innerHTML = '';
		formAuth.reset();
	}

	if(closeForgotAuth){
		closeForgotAuth.addEventListener('click', closeAuthModal);
		backBtnAuth.addEventListener('click', closeAuthModal);}
	

	// Открытие второй модалки
	function openSuccessModal(email) {
		// Вставляем email в сообщение
		successEmail.textContent = email;
		authModalOverlay.style.display = 'none';
		successModalOverlay.style.display = 'flex';
	}

	// Закрытие второй модалки
	function closeSuccessModal() {
		successModalOverlay.style.display = 'none';
		document.body.style.overflow = '';
		formAuth.reset();
	}
	if(closeSuccessAuth){
		closeSuccessAuth.addEventListener('click', closeSuccessModal);
	}

	// Кнопка "Вернуться на вход" - редирект на /auth/
	if(backToAuthBtn){
		backToAuthBtn.addEventListener('click', function() {
			window.location.href = '/auth/';
		});
	}

	// Закрытие по клику на оверлей
	if(authModalOverlay){
		authModalOverlay.addEventListener('click', function(e) {
			if (e.target === authModalOverlay) {
				closeAuthModal();
			}
		});
	}

	if(successModalOverlay){
		successModalOverlay.addEventListener('click', function(e) {
			if (e.target === successModalOverlay) {
				closeSuccessModal();
			}
		});
	}

	// Закрытие по ESC
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

	// Отправка формы восстановления пароля
	if(formAuth){
		formAuth.addEventListener('submit', function(e){
			e.preventDefault();
	
			const email = forgotEmailInput.value.trim();
			if (!email) {
				resultBoxAuth.style.display = 'block';
				resultBoxAuth.textContent = 'Пожалуйста, введите email';
				resultBoxAuth.className = 'auth-modal__result auth-modal__result--error';
				return;
			}
	
			// Показываем индикатор загрузки
			const originalText = submitForgotForm.textContent;
			submitForgotForm.textContent = 'Отправка...';
			submitForgotForm.disabled = true;
	
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
						// Показываем вторую модалку с email пользователя
						openSuccessModal(email);
					} else {
						throw new Error('Ошибка сервера');
					}
				})
				.catch(() => {
					resultBoxAuth.style.display = 'block';
					resultBoxAuth.textContent = 'Ошибка отправки. Попробуйте позже.';
					resultBoxAuth.className = 'auth-modal__result auth-modal__result--error';
				})
				.finally(() => {
					// Восстанавливаем кнопку
					submitForgotForm.textContent = originalText;
					submitForgotForm.disabled = false;
				});
		});
	}
});

// Функция показа/скрытия пароля
function togglePassword(icon) {
	const input = icon.previousElementSibling;
	if (input.type === 'password') {
		input.type = 'text';
	} else {
		input.type = 'password';
	}
}