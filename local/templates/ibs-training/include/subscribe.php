<form class="form" name="subscribe" data-form-type="webform" data-form-id="27">
    <div class="form__success">
        <div class="form__success-message"><b>Спасибо.</b><br><span>Вы подписаны на ежемесячный дайджест.</span></div>
    </div>
    <div class="form__content">
        <div class="fields">
            <?=bitrix_sessid_post()?>
            <input type="hidden" name="addField" value="">

            <div class="form-row _center">
                <label class="field-box">
                    <input class="field" type="text" name="email" placeholder="E-mail" value="">
                </label>
                <button type="submit" class="button _submit _size-l"><span>Подписаться</span></button>
            </div>
        </div>
    </div>
</form>
