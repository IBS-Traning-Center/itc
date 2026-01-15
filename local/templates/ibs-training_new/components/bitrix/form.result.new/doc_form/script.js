function openDocRequestForm() {
    document.getElementById('formDocModal').style.display = 'grid';
    document.body.style.overflow = 'hidden';
}
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form[name^="form_"]');
    if (!form) return;

    // Функция обновления состояния одного поля
    function updateFieldState(input) {
        const group = input.closest('.form-group');
        if (!group) return;

        if (input.value.trim() !== '') {
            group.classList.remove('is-empty');
        } else {
            group.classList.add('is-empty');
        }
    }

    // Обработчики для всех полей ввода
    const inputs = form.querySelectorAll('.form-control, textarea, select');

    inputs.forEach(input => {
        // Проверяем сразу при загрузке (важно для автозаполнения)
        updateFieldState(input);

        // Реакция на ввод
        input.addEventListener('input', () => updateFieldState(input));

        // На всякий случай (иногда браузер заполняет позже)
        input.addEventListener('change', () => updateFieldState(input));
    });

    // Дополнительная защита от автозаполнения браузером
    setTimeout(() => {
        inputs.forEach(updateFieldState);
    }, 300);

    setTimeout(() => {
        inputs.forEach(updateFieldState);
    }, 1200);

    // Валидация при отправке (если нужно)
    form.addEventListener('submit', function (e) {
        let hasError = false;

        inputs.forEach(input => {
            if (input.hasAttribute('required') && input.value.trim() === '') {
                const group = input.closest('.form-group');
                group.classList.add('is-empty');
                group.classList.add('error'); // если хочешь показывать ошибку
                hasError = true;
            }
        });

        if (hasError) {
            e.preventDefault();
        }
    });
});