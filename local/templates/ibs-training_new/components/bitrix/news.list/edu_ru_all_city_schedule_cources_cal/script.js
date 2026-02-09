class FilterSection{

    constructor() {
        this.filterItemsWrap = document.querySelector('.timetable-filter-wrap ul')
        this.typeTimetableSelect = document.querySelector('.timetable-menu .simple-select span')
        this.ChangeTypeTimetable = document.querySelectorAll('.timetable-menu-ul li')

        this.initFilters();
        this.initSelect();    
    }

    initSelect(){
        this.ChangeTypeTimetable.forEach(elem => {
            let typeTimetableSelect = this.typeTimetableSelect;

            if(elem.classList.contains('active')){
                typeTimetableSelect.innerText = elem.querySelector('a').innerText;
            }
            elem.addEventListener('click', function() {
                typeTimetableSelect.innerText = elem.querySelector('a').innerText;
            });
            
        });
    }

    initFilters(){
        let filterItem = this.filterItemsWrap.querySelectorAll('li'),
            moreItemBtn = document.querySelector('.more-item')

        if(this.filterItemsWrap !== null){
            let countItemHide = filterItem.length - 7;
            if(countItemHide > 0){
                moreItemBtn.style.display = 'flex';
                moreItemBtn.querySelector('span').innerHTML = moreItemBtn.querySelector('span').innerHTML + ' ' + countItemHide;
            }
            filterItem.forEach((tag, index) => {
                if(index < 8){
                    tag.style.display = 'block';
                }
            });
        }

        if(moreItemBtn !== null){
            moreItemBtn.addEventListener('click', function() {
                moreItemBtn.style.display = 'none';
                filterItem.forEach((tag, index) => {
                    tag.style.display = 'block';
                });
            });
        }
    }
}

document.addEventListener("DOMContentLoaded", (e) => {
    new FilterSection;
});
document.addEventListener('DOMContentLoaded', function() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const courseId = this.dataset.courseId;
            const scheduleId = this.dataset.scheduleId;

            const button = this;
            const originalText = button.innerHTML;

            if (!scheduleId || parseInt(scheduleId) === 0) {
                alert('Не удалось добавить курс. Расписание не найдено.');
                return;
            }


            button.disabled = true;
            button.innerHTML = '<span class="loading-text">Добавляем...</span>';


            const formData = new URLSearchParams();
            formData.append('sessid', BX.bitrix_sessid());
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
                    alert('Ошибка: ' + error.message);
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
        const basketSum = document.querySelector('.basket-sum, .cart-sum');
        if (basketSum && data.formatted_sum) {
            basketSum.textContent = data.formatted_sum;
        }
    }
});