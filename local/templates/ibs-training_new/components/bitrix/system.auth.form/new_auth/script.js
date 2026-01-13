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

	forgotBtn.addEventListener('click', function(e){
		e.preventDefault();
		authModalOverlay.style.display = 'flex';
		document.body.style.overflow = 'hidden';
	});

	function closeAuthModal() {
		authModalOverlay.style.display = 'none';
		document.body.style.overflow = '';
		resultBoxAuth.style.display = 'none';
		resultBoxAuth.innerHTML = '';
		formAuth.reset();
	}

	closeForgotAuth.addEventListener('click', closeAuthModal);
	backBtnAuth.addEventListener('click', closeAuthModal);

	function openSuccessModal(email) {
		// Вставляем email в сообщение
		successEmail.textContent = email;
		authModalOverlay.style.display = 'none';
		successModalOverlay.style.display = 'flex';
	}

	function closeSuccessModal() {
		successModalOverlay.style.display = 'none';
		document.body.style.overflow = '';
		formAuth.reset();
	}

	closeSuccessAuth.addEventListener('click', closeSuccessModal);

	backToAuthBtn.addEventListener('click', function() {
		window.location.href = '/';
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
					// Ошибка от сервера
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