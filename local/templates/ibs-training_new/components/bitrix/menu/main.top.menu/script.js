document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.open-auth-modal').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var modalId = this.getAttribute('data-modal-id');
            var modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
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

    if (typeof initAuthModalHandlers === 'function') {
        initAuthModalHandlers();
    }
});

function switchAuthTab(tabName) {
    document.querySelectorAll('.auth-tab').forEach(function(tab) {
        tab.classList.remove('active');
    });

    document.querySelectorAll('.tab-content').forEach(function(content) {
        content.classList.remove('active');
    });

    const modalContent = document.querySelector('.auth-modal-content');
    
    if (tabName === 'login') {
        const loginTab = document.querySelector('.auth-tab--login');
        const loginContent = document.querySelector('#tab-login');
        
        if (loginTab) loginTab.classList.add('active');
        if (loginContent) loginContent.classList.add('active');

        if (modalContent && window.innerWidth <= 1100) {
            modalContent.style.maxHeight = '478px';
        }

        setTimeout(function() {
            var loginField = document.querySelector('#tab-login input[name="USER_LOGIN"]');
            if (loginField) {
                loginField.focus();
            }
        }, 50);
    } else {
        const registerTab = document.querySelector('.auth-tab--register');
        const registerContent = document.querySelector('#tab-register');
        
        if (registerTab) registerTab.classList.add('active');
        if (registerContent) registerContent.classList.add('active');

        if (modalContent && window.innerWidth <= 1100) {
            modalContent.style.maxHeight = '782px';
        }

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