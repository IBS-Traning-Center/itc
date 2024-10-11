<form class="form callback-mini" name="callback-mini" data-form-type="webform" data-form-id="28">
    <div class="form__success">
        <div class="form__success">
            <div class="form__success-message"><b>Спасибо.</b><br> Ваш запрос был получен.</div>
        </div>
    </div>
    <div class="form__content">
        <div class="fields _hidden" style="display: none">
            <?=bitrix_sessid_post()?>
            <input type="hidden" name="addField" value="">
            <label class="field-box">
                <input class="field" type="text" name="name" placeholder="Имя" value="">
            </label>
            <label class="field-box">
                <input class="field" type="text" name="email" placeholder="E-mail" value="">
            </label>
            <label class="field-box">
                <input class="field" type="text" name="phone" placeholder="Телефон" value="">
            </label>
            <label class="field-box" style="display: none">
                <input class="field" type="text" name="message" placeholder="Сообщение" value="">
            </label>
            <label class="agree-text"><input checked="checked" name="agree" value="Y" type="checkbox">Настоящим я подтверждаю, что я ознакомлен с <a style="text-decoration: underline;" target="_blank" href="/terms-of-use/">Условиями использования</a>, условия мне понятны и я согласен соблюдать их.</label>
            <label class="agree-text"><input checked="checked" name="agree-2" value="Y" type="checkbox">Я ознакомлен с порядком обработки моих персональных данных согласно <a style="text-decoration: underline;" target="_blank" href="/privacy-policy/">Политике в сфере персональных данных</a>.</label>
        </div>
        <button type="submit" class="button js-form-show _b-white _w-full _size-l"><span>Напишите нам</span></button>
    </div>
</form>
