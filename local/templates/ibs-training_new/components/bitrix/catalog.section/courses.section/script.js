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

            if (parseInt(scheduleId) === 0) {
                alert('Не удалось добавить курс. Расписание не найдено.');
                return;
            }

            button.disabled = true;
            button.innerHTML = '<span class="loading-text">Добавляем...</span>';


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
                        button.classList.add('added');

                        updateBasketCounter(data);

                        setTimeout(() => {
                            button.disabled = false;
                            button.innerHTML = originalText;
                            button.classList.remove('added');
                        }, 2000);

                    } else {
                        throw new Error(data.error || 'Ошибка добавления');
                    }
                })
                .catch(error => {
                    console.error('Ошибка:', error);

                    button.disabled = false;
                    button.innerHTML = originalText;
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

        const headerCounter = document.querySelector('.cart-icon-right');
        if (headerCounter && data.count !== undefined) {
            headerCounter.classList.add('in-cart');
        }

        const basketSum = document.querySelector('.basket-sum, .cart-sum');
        if (basketSum && data.formatted_sum) {
            basketSum.textContent = data.formatted_sum;
        }
    }
    const style = document.createElement('style');
    style.textContent = `
        .btn-add-to-cart {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-add-to-cart.added {
            background-color: #2B418B;
            color: white;
        }

        .btn-add-to-cart:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .loading-text {
            display: inline-block;
            animation: pulse 1.5s infinite;
        }

        .success-text {
            color: #4CAF50;
            font-weight: bold;
        }

        @keyframes pulse {
            0% { opacity: 0.6; }
            50% { opacity: 1; }
            100% { opacity: 0.6; }
        }
    `;
    document.head.appendChild(style);
});