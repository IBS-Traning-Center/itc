 document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.hidden-bottom-mobile-menu-block .open-auth-modal').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var modalId = this.getAttribute('data-modal-id');
                var modal = document.getElementById(modalId);
                if (modal) {
                    modal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                    if (typeof initAuthModalHandlers === 'function') {
                        initAuthModalHandlers();
                    }
                    if (typeof switchAuthTab === 'function') {
                        switchAuthTab('login');
                    }
                }
            });
        });
        if (typeof closeMobileMenu === 'function') {
            document.querySelectorAll('.open-auth-modal').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    closeMobileMenu();
                });
            });
        }
    });