<form class="form callback-mini" name="callback-contacts" data-form-type="webform" data-form-id="27">
    <div class="form__success">
        <div class="form__success-message"><b>Спасибо.</b><br> Ваш запрос был получен.</div>
    </div>
    <div class="form__content">
        <div class="fields">
            <?=bitrix_sessid_post()?>
            <input type="hidden" name="addField" value="">

            <div class="form-row">
                <label class="field-box">
                    <input class="field" type="text" name="name" placeholder="Имя" value="">
                </label>
                <label class="field-box">
                    <input class="field" type="text" name="company" placeholder="Компания" value="">
                </label>
            </div>
            <div class="form-row">
                <label class="field-box">
                    <input class="field" type="text" name="email" placeholder="E-mail" value="">
                </label>
                <label class="field-box">
                    <input class="field" type="text" name="phone" placeholder="Телефон" value="">
                </label>
            </div>
            <div class="form-row">
                <label class="field-box _wide">
                    <textarea class="field" name="message" placeholder="Сообщение"></textarea>
                </label>
            </div>
            <br>
            <label class="agree-text" style="color: #003979"><input checked="checked" name="agree" value="Y" type="checkbox">Настоящим я подтверждаю, что я ознакомлен с <a style="text-decoration: underline;" target="_blank" href="/terms-of-use/">Условиями использования</a>, условия мне понятны и я согласен соблюдать их.</label>
            <label class="agree-text" style="color: #003979"><input checked="checked" name="agree-2" value="Y" type="checkbox">Я ознакомлен с порядком обработки моих персональных данных согласно <a style="text-decoration: underline; color: #fb9024" target="_blank" href="/privacy-policy/">Политике в сфере персональных данных</a>.</label>
        </div>
        <button type="submit" class="button _submit _w-full _size-l"><span>Отправить</span></button>
    </div>
</form>
