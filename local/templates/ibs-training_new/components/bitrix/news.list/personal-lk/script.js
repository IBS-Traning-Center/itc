(function () {
    'use strict';
    const blockJqSelectbox = () => {
        if (window.jQuery && jQuery.fn.selectbox) {
            const originalSelectbox = jQuery.fn.selectbox;

            jQuery.fn.selectbox = function (options) {
                return this.filter(function () {
                    const element = this;
                    const $element = jQuery(this);

                    if ($element.is('#specialty-custom') ||
                        $element.is('[data-no-jqselect="true"]') ||
                        $element.closest('#recommendationModal-custom').length > 0) {
                        return false;
                    }

                    let parent = element.parentNode;
                    while (parent) {
                        if (parent.id === 'recommendationModal-custom' ||
                            parent.hasAttribute && parent.hasAttribute('data-no-jqselect')) {
                            return false;
                        }
                        parent = parent.parentNode;
                    }

                    return true;
                }).pipe(function () {
                    return originalSelectbox.apply(this, arguments);
                });
            };
        }
    };

    const cleanJqSelectbox = () => {
        const modal = document.getElementById('recommendationModal-custom');
        if (!modal) return;

        const jqWrappers = modal.querySelectorAll('.jq-selectbox');
        jqWrappers.forEach(wrapper => {
            const originalSelect = wrapper.querySelector('select');
            if (originalSelect && wrapper.parentNode) {
                wrapper.parentNode.insertBefore(originalSelect, wrapper);
                wrapper.remove();
                originalSelect.classList.add('recommendation-form-input', 'recommendation-select');
                originalSelect.style.cssText = '';
            }
        });
    };

    function showDebugInfo(categories) {
        console.log('=== FILTER DEBUG INFO ===');
        console.log('Categories loaded from PHP:', categories);
        console.log('Select element:', document.getElementById('specialty-custom'));
        console.log('Options count:', document.getElementById('specialty-custom').options.length);
    }

    document.addEventListener('DOMContentLoaded', function () {

        blockJqSelectbox();

        setTimeout(cleanJqSelectbox, 50);

        const modal = document.getElementById('recommendationModal-custom');
        const openBtn = document.querySelector('.adjust-recommendations .link');
        const closeBtn = document.querySelector('.recommendation-modal-close-btn');
        const form = document.getElementById('recommendationForm-custom');

        const categorySelect = document.getElementById('specialty-custom');
        const categories = {};
        if (categorySelect) {
            for (let i = 0; i < categorySelect.options.length; i++) {
                const option = categorySelect.options[i];
                categories[option.value] = option.text;
            }
        }
        showDebugInfo(categories);

        const savedFilters = JSON.parse(localStorage.getItem('courseFilters') || '{}');

        if (savedFilters.specialty) {
            document.getElementById('specialty-custom').value = savedFilters.specialty;
        }
        if (savedFilters.price_from) {
            document.getElementById('price_from-custom').value = savedFilters.price_from;
        }
        if (savedFilters.price_to) {
            document.getElementById('price_to-custom').value = savedFilters.price_to;
        }

        if (openBtn) {
            openBtn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                cleanJqSelectbox();
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
                setTimeout(cleanJqSelectbox, 100);
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            });
        }

        if (modal) {
            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && modal.style.display === 'flex') {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                e.stopPropagation();

                const filters = {
                    specialty: document.getElementById('specialty-custom').value,
                    price_from: document.getElementById('price_from-custom').value,
                    price_to: document.getElementById('price_to-custom').value
                };

                // Валидация
                if (filters.price_from && filters.price_to) {
                    const priceFrom = parseInt(filters.price_from);
                    const priceTo = parseInt(filters.price_to);
                    if (priceTo < priceFrom) {
                        alert('Цена "до" должна быть больше или равна цене "от"');
                        return;
                    }
                }

                localStorage.setItem('courseFilters', JSON.stringify(filters));

                modal.style.display = 'none';
                document.body.style.overflow = 'auto';

                applyFilters(filters);
            });
        }

        if (modal) {
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.type === 'childList') {
                        cleanJqSelectbox();
                    }
                });
            });

            observer.observe(modal, {
                childList: true,
                subtree: true
            });
        }

        function applyFilters(filters) {
            const url = new URL(window.location.href);

            url.searchParams.delete('specialty');
            url.searchParams.delete('price_from');
            url.searchParams.delete('price_to');
            url.searchParams.delete('set_filter');

            // Добавляем новые параметры
            if (filters.specialty) {
                url.searchParams.set('specialty', filters.specialty);
            }
            if (filters.price_from) {
                url.searchParams.set('price_from', filters.price_from);
            }
            if (filters.price_to) {
                url.searchParams.set('price_to', filters.price_to);
            }
            url.searchParams.set('set_filter', 'Y');

            window.location.href = url.toString();
        }

        const urlParams = new URLSearchParams(window.location.search);
        const hasUrlFilters = urlParams.has('specialty') || urlParams.has('price_from') || urlParams.has('price_to');

        if (hasUrlFilters) {
            const urlFilters = {
                specialty: urlParams.get('specialty') || '',
                price_from: urlParams.get('price_from') || '',
                price_to: urlParams.get('price_to') || ''
            };

            localStorage.setItem('courseFilters', JSON.stringify(urlFilters));
        }
    });

    window.RecommendationModal = {
        clearFilters: function () {
            localStorage.removeItem('courseFilters');
            const url = new URL(window.location.href);

            url.searchParams.delete('specialty');
            url.searchParams.delete('price_from');
            url.searchParams.delete('price_to');
            url.searchParams.delete('set_filter');

            window.location.href = url.toString();
        },
        debugInfo: function () {
            const select = document.getElementById('specialty-custom');
            const categories = {};

            if (select) {
                for (let i = 0; i < select.options.length; i++) {
                    categories[select.options[i].value] = select.options[i].text;
                }
            }

            return {
                categories: categories,
                savedFilters: JSON.parse(localStorage.getItem('courseFilters') || '{}'),
                selectElement: select
            };
        }
    };
})();

    document.addEventListener('DOMContentLoaded', function() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

    addToCartButtons.forEach(button => {
    button.addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();

    const courseId = this.dataset.courseId;
    const scheduleId = this.dataset.scheduleId || 0;

    const button = this;
    const originalText = button.innerHTML;
    const originalClasses = button.className;

    if (parseInt(scheduleId) === 0) {
    alert('Не удалось добавить курс. Расписание не найдено.');
    return;
}

    button.disabled = true;
    button.innerHTML = '<span class="loading-text">Добавляем...</span>';
    button.className = originalClasses + ' disabled';

    const formData = new URLSearchParams();
    formData.append('sessid', BX.bitrix_sessid());
    formData.append('action', 'ADD2BASKET');
    formData.append('id', courseId);
    formData.append('schedule_id', scheduleId);
    formData.append('quantity', 1);
    fetch('/ajax/add_course_to_basket.php', {
    method: 'POST',
    headers: {
    'Content-Type': 'application/x-www-form-urlencoded',
},
    body: formData,
    credentials: 'same-origin'
})
    .then(response => {
    if (!response.ok) {
    throw new Error('Ошибка сети');
}
    return response.json();
})
    .then(data => {
    if (data.success) {
    button.innerHTML = '<span class="success-text">Добавлено</span>';
    button.className = originalClasses.replace('btn-dark', 'btn-success') + ' added';

    updateBasketCounter(data);

    setTimeout(() => {
    button.disabled = false;
    button.innerHTML = originalText;
    button.className = originalClasses;
    button.classList.remove('added');
}, 2000);

} else {
    throw new Error(data.error || 'Ошибка добавления');
}
})
    .catch(error => {
    console.error('Ошибка:', error);
    alert('Ошибка: ' + error.message);
    button.disabled = false;
    button.innerHTML = originalText;
    button.className = originalClasses;
});
});
});

    function updateBasketCounter(data) {
    if (typeof BX.onCustomEvent === 'function') {
    BX.onCustomEvent('OnBasketChange');
}

    const basketCounter = document.querySelector('.basket-count, .cart-count, .header-basket-counter');
    if (basketCounter && data.count !== undefined) {
    basketCounter.textContent = data.count;
    basketCounter.style.display = data.count > 0 ? 'inline-block' : 'none';
}
    const basketSum = document.querySelector('.basket-sum, .cart-sum');
    if (basketSum && data.formatted_sum) {
    basketSum.textContent = data.formatted_sum;
}
}

    const style = document.createElement('style');
    style.textContent = `
        .add-to-cart-btn.disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .add-to-cart-btn.added {
            cursor: default;
        }

        .loading-text {
            display: inline-block;
            animation: pulse 1.5s infinite;
        }

        .success-text {
            color: white;
            font-weight: bold;
        }

        @keyframes pulse {
            0% { opacity: 0.6; }
            50% { opacity: 1; }
            100% { opacity: 0.6; }
        }

        /* Если нужно переопределить стандартные стили Bootstrap для этого случая */
        .btn-dark.added {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
        }
    `;
    document.head.appendChild(style);
});
