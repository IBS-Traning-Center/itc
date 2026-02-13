document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.lk-tab');
    const allCards = document.querySelectorAll('.notification-card');

    function showCards(filter) {
        allCards.forEach(card => {
            const isRead = card.classList.contains('read') ||
                card.getAttribute('data-read') === 'true';

            if (filter === 'all') {
                card.style.display = 'flex';
            } else if (filter === 'unread') {
                card.style.display = isRead ? 'none' : 'flex';
            } else if (filter === 'read') {
                card.style.display = isRead ? 'flex' : 'none';
            }
        });
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('is-active'));
            tab.classList.add('is-active');

            const text = tab.textContent.trim().toLowerCase();

            if (text.includes('все')) {
                showCards('all');
            } else if (text.includes('не прочитан') || text.includes('непрочитан')) {
                showCards('unread');
            } else if (text.includes('прочитан')) {
                showCards('read');
            }
        });
    });

    function markAsRead(card) {
        const notificationId = card.dataset.id;
        const dot = card.querySelector('.dot');
        const titleWrapper = card.querySelector('.notification-title-wrapper');

        fetch('/ajax/notifications_read.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'id=' + notificationId + '&action=markAsRead'
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    card.classList.add('read');
                    card.dataset.read = 'true';
                    if (dot) {
                        dot.remove();
                    }
                    updateCounters();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                card.classList.add('read');
                card.dataset.read = 'true';
                if (dot) dot.remove();
            });
    }

    document.querySelectorAll('.notification-card').forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.tagName === 'A' || e.target.tagName === 'BUTTON' ||
                e.target.closest('a') || e.target.closest('button')) {
                return;
            }

            const isRead = this.classList.contains('read') ||
                this.dataset.read === 'true';

            if (!isRead) {
                markAsRead(this);
            }
        });

        const btn = card.querySelector('a.btn, button.btn');
        if (btn) {
            btn.addEventListener('click', function(e) {
                const parentCard = this.closest('.notification-card');
                const isRead = parentCard.classList.contains('read') ||
                    parentCard.dataset.read === 'true';

                if (!isRead) {
                    markAsRead(parentCard);
                }
            });
        }
    });

    function updateCounters() {
        const allCards = document.querySelectorAll('.notification-card');
        const unreadCount = Array.from(allCards).filter(
            card => !card.classList.contains('read') && card.dataset.read === 'false'
        ).length;

        const unreadTab = Array.from(tabs).find(
            tab => tab.textContent.trim().toLowerCase().includes('не прочитан')
        );

        if (unreadTab) {
            let text = 'Не прочитанные';
            if (unreadCount > 0) {
                text += ' (' + unreadCount + ')';
            }
            unreadTab.textContent = text;
        }
    }
    updateCounters();
});