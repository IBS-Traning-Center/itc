<div class="subscription-form-container">
    <h2 class="form-title">Подписка на новости, акции, анонсы курсов и бесплатных вебинаров, полезные материалы от экспертов</h2>
    <form action='https://forms.msndr.net/subscriptions/a8cc609bf4e607d23a1d3fa7c7f8cd36/form' method='post' charset='UTF-8' id="subscriptionForm">
        <!-- Скрытые поля для защиты от ботов -->
        <div class="hidden-fields">
            <input type="text" name="recipient[name]" placeholder="Name" autocomplete="password" />
        </div>
    
        <!-- Поле для email -->
        <div class="form-group">
            <input type="email" name="recipient[email]" id="recipient_email" value="" required="required" class="form-control" placeholder="Email" />
            <div class="error-message" id="email-error">Пожалуйста, введите корректный email адрес</div>
        </div>
    
        <!-- Скрытые поля для параметров -->
        <input type="hidden" name="recipient[recipient_values_attributes][576784][recipient_parameter_id]" id="recipient_recipient_values_attributes_576784_recipient_parameter_id" value="576784" />
        <input type="hidden" name="recipient[recipient_values_attributes][576785][recipient_parameter_id]" id="recipient_recipient_values_attributes_576785_recipient_parameter_id" value="576785" />
        <button type='submit' class="submit-btn">Подписаться</button>
        <!-- Чекбоксы для согласия (заменяют селекты) -->
        <div class="checkbox-group">
            <!-- Согласие с политикой -->
            <div class="checkbox-item">
                <input type="checkbox" id="policy_checkbox" class="real-checkbox" required>
                <span class="custom-checkbox"></span>
                <label for="policy_checkbox" class="checkbox-label required">
                    Ознакомлен с <a href="#">Политикой обработки персональных данных</a>
                </label>
                <!-- Скрытый селект для отправки данных -->
                <select name="recipient[recipient_values_attributes][576784][value]" id="recipient_recipient_values_attributes_576784_value" class="hidden-select" required="required">
                    <option value="false" selected>Нет</option>
                    <option value="true">Да</option>
                </select>
                <div class="error-message" id="policy-error">Необходимо дать согласие на обработку данных</div>
            </div>

            <!-- Согласие с условиями -->
            <div class="checkbox-item">
                <input type="checkbox" id="terms_checkbox" class="real-checkbox" required>
                <span class="custom-checkbox"></span>
                <label for="terms_checkbox" class="checkbox-label required">
                    Соглашаюсь с <a href="#">Условиями обработки персональных данных</a>
                </label>
                <!-- Скрытый селект для отправки данных -->
                <select name="recipient[recipient_values_attributes][576785][value]" id="recipient_recipient_values_attributes_576785_value" class="hidden-select" required="required">
                    <option value="false" selected>Нет</option>
                    <option value="true">Да</option>
                </select>
                <div class="error-message" id="terms-error">Необходимо принять условия обработки данных</div>
            </div>
        </div>
    
        
    </form>
</div>