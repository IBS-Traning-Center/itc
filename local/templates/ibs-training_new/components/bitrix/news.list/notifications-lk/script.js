document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.lk-tab');
    const allCards = document.querySelectorAll('.notification-card');
    function showCards(filter) {
        allCards.forEach(card => {
            const isRead = card.classList.contains('read') ||
                card.getAttribute('data-read') === 'true';

            if (filter === 'all') {
                card.style.display = 'flex';
            }
            else if (filter === 'unread') {
                card.style.display = isRead ? 'none' : 'flex';
            }
            else if (filter === 'read') {
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
});