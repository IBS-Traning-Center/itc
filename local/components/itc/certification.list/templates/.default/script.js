document.addEventListener('DOMContentLoaded', function () {
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            const courseId       = this.dataset.courseId;
            const scheduleId     = this.dataset.scheduleId     || '';
            const scheduleDate   = this.dataset.scheduleDate   || '';
            const scheduleTime   = this.dataset.scheduleTime   || '';
            const scheduleLocation = this.dataset.scheduleLocation || '';
            const courseName     = this.dataset.courseName     || '';

            // защита от пустого товара
            if (!courseId) {
                console.error('Нет course-id у кнопки');
                return;
            }

            const originalText = button.innerHTML;
            button.disabled = true;
            button.innerHTML = '<span class="loading-text">Добавляем...</span>';

            const formData = new URLSearchParams();
            formData.append('sessid', BX.bitrix_sessid());
            formData.append('PRODUCT_ID', courseId);
            formData.append('QUANTITY', '1');

            // свойства — отправляем ВСЕ, даже если пустые — пусть PHP решает
            const props = [
                { NAME: 'SCHEDULE_ID',   CODE: 'SCHEDULE_ID',   VALUE: scheduleId },
                { NAME: 'COURSE_NAME',   CODE: 'COURSE_NAME',   VALUE: courseName },
                { NAME: 'SCHEDULE_DATE', CODE: 'SCHEDULE_DATE', VALUE: scheduleDate },
                { NAME: 'SCHEDULE_TIME', CODE: 'SCHEDULE_TIME', VALUE: scheduleTime },
                { NAME: 'LOCATION',      CODE: 'LOCATION',      VALUE: scheduleLocation }
            ];

            props.forEach((prop, index) => {
                // отправляем даже пустые — PHP сам отфильтрует
                formData.append(`PROPS[${index}][NAME]`,  prop.NAME);
                formData.append(`PROPS[${index}][CODE]`,  prop.CODE);
                formData.append(`PROPS[${index}][VALUE]`, prop.VALUE || '');
            });

            // ────────────────────────────────────────────────
            // Для отладки — можно временно включить
            // console.log('Отправляемые данные:');
            // for (let [key, value] of formData.entries()) {
            //     console.log(key + ' = ' + value);
            // }
            // ────────────────────────────────────────────────

            fetch('/ajax/add_to_certification.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: formData,
                credentials: 'same-origin'
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'success') {
                        button.innerHTML = '<span class="success-text">Добавлено</span>';
                        button.classList.add('added');

                        if (typeof updateBasketCounter === 'function') {
                            updateBasketCounter(data);
                        }

                        setTimeout(() => {
                            button.disabled = false;
                            button.innerHTML = originalText;
                            button.classList.remove('added');
                        }, 1800);
                    } else {
                        alert(data.message || 'Не удалось добавить в корзину');
                        button.innerHTML = originalText;
                        button.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Ошибка добавления в корзину:', error);
                    button.innerHTML = 'Ошибка';
                    button.disabled = false;
                    setTimeout(() => {
                        button.innerHTML = originalText;
                    }, 2000);
                });
        });
    });

    function updateBasketCounter(data) {
        if (typeof BX !== 'undefined' && typeof BX.onCustomEvent === 'function') {
            BX.onCustomEvent('OnBasketChange');
        }
        const headerCounter = document.querySelector('.cart-icon-right');
        if (headerCounter && data.count !== undefined) {
            headerCounter.classList.add('in-cart');
        }
        const counter = document.querySelector('.basket-count, .cart-count, .header-basket-counter');
        if (counter && data.count !== undefined) {
            counter.textContent = data.count;
            counter.style.display = data.count > 0 ? 'inline-block' : 'none';
        }

        const sumEl = document.querySelector('.basket-sum, .cart-sum');
        if (sumEl && data.formatted_sum) {
            sumEl.textContent = data.formatted_sum;
        }
    }
});