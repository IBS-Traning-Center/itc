document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.open-auth-modal').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var modalId = this.getAttribute('data-modal-id');
            var modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
                switchAuthTab('login');
                setTimeout(function() {
                    var loginField = modal.querySelector('#tab-login input[name="USER_LOGIN"]');
                    if (loginField) {
                        loginField.focus();
                    }
                }, 100);
            }
        });
    });
    document.querySelectorAll('.auth-modal-close-btn').forEach(function(closeBtn) {
        closeBtn.addEventListener('click', function() {
            var modal = this.closest('.auth-modal-wrapper');
            if (modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    });
    document.querySelectorAll('.auth-modal-wrapper').forEach(function(modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.auth-modal-wrapper').forEach(function(modal) {
                if (modal.style.display === 'flex') {
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });
        }
    });
    initAuthModalHandlers();
});
function switchAuthTab(tabName) {
    document.querySelectorAll('.auth-tab').forEach(function(tab) {
        tab.classList.remove('active');
    });

    document.querySelectorAll('.tab-content').forEach(function(content) {
        content.classList.remove('active');
    });

    if (tabName === 'login') {
        document.querySelector('.auth-tab--login').classList.add('active');
        document.querySelector('#tab-login').classList.add('active');
        setTimeout(function() {
            var loginField = document.querySelector('#tab-login input[name="USER_LOGIN"]');
            if (loginField) {
                loginField.focus();
            }
        }, 50);
    } else {
        document.querySelector('.auth-tab--register').classList.add('active');
        document.querySelector('#tab-register').classList.add('active');
        setTimeout(function() {
            var regField = document.querySelector('#tab-register input[type="text"], #tab-register input[type="email"]');
            if (regField) {
                regField.focus();
            }
        }, 50);
    }
}

function initAuthModalHandlers() {
    document.addEventListener('authSuccess', function() {
        document.querySelectorAll('.auth-modal-wrapper').forEach(function(modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });

        setTimeout(function() {
            window.location.reload();
        }, 500);
    });
    document.addEventListener('registerSuccess', function() {
        switchAuthTab('login');

        setTimeout(function() {
            alert('Регистрация прошла успешно! Теперь вы можете войти в систему.');
        }, 100);
    });
}