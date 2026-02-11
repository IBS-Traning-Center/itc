<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?php

if ($arResult['DATA_SAVED'] == 'Y') {
    echo ShowNote(GetMessage('PROFILE_DATA_SAVED'));
}
?>
<div class="password-wrapper">
    <div class="tabs">
        <a class="tab" href="/personal/profile/">Профиль</a>
        <a class="tab" href="/personal/profile/subscription/">Подписка</a>
        <a class="tab active">Пароль</a>
    </div>

    <form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>?" enctype="multipart/form-data" class="form-content">
        <?=$arResult["BX_SESSION_CHECK"]?>
        <input type="hidden" name="lang" value="<?=LANG?>" />
        <input type="hidden" name="ID" value="<?=$arResult["ID"]?>" />
        <input type="hidden" name="LOGIN" value="<?=$arResult["arUser"]["LOGIN"]?>" />
        <input type="hidden" name="EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>" />

        <div class="password-field">
            <div class="input-wrapper">
                <div class="label-text">Пароль</div>
                <div class="input-field">
                    <input type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" />
                    <div class="eye-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.9984 9.00462C14.2075 9.00462 15.9984 10.7955 15.9984 13.0046C15.9984 15.2138 14.2075 17.0046 11.9984 17.0046C9.78927 17.0046 7.99841 15.2138 7.99841 13.0046C7.99841 10.7955 9.78927 9.00462 11.9984 9.00462ZM11.9984 10.5046C10.6177 10.5046 9.49841 11.6239 9.49841 13.0046C9.49841 14.3853 10.6177 15.5046 11.9984 15.5046C13.3791 15.5046 14.4984 14.3853 14.4984 13.0046C14.4984 11.6239 13.3791 10.5046 11.9984 10.5046ZM11.9984 5.5C16.6119 5.5 20.5945 8.65001 21.6995 13.0644C21.8001 13.4662 21.5559 13.8735 21.1541 13.9741C20.7523 14.0746 20.345 13.8305 20.2444 13.4286C19.3055 9.67796 15.9198 7 11.9984 7C8.07534 7 4.68851 9.68026 3.75127 13.4332C3.6509 13.835 3.24376 14.0794 2.84189 13.9791C2.44002 13.8787 2.1956 13.4716 2.29596 13.0697C3.39905 8.65272 7.38289 5.5 11.9984 5.5Z" fill="#212121"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="requirements-text">Мин 6 символов, включая спецсимволы, цифры и разные регистры</div>
        </div>

        <div class="password-field">
            <div class="input-wrapper">
                <div class="label-text">Подтверждение пароля</div>
                <div class="input-field">
                    <input type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" />
                    <div class="eye-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.9984 9.00462C14.2075 9.00462 15.9984 10.7955 15.9984 13.0046C15.9984 15.2138 14.2075 17.0046 11.9984 17.0046C9.78927 17.0046 7.99841 15.2138 7.99841 13.0046C7.99841 10.7955 9.78927 9.00462 11.9984 9.00462ZM11.9984 10.5046C10.6177 10.5046 9.49841 11.6239 9.49841 13.0046C9.49841 14.3853 10.6177 15.5046 11.9984 15.5046C13.3791 15.5046 14.4984 14.3853 14.4984 13.0046C14.4984 11.6239 13.3791 10.5046 11.9984 10.5046ZM11.9984 5.5C16.6119 5.5 20.5945 8.65001 21.6995 13.0644C21.8001 13.4662 21.5559 13.8735 21.1541 13.9741C20.7523 14.0746 20.345 13.8305 20.2444 13.4286C19.3055 9.67796 15.9198 7 11.9984 7C8.07534 7 4.68851 9.68026 3.75127 13.4332C3.6509 13.835 3.24376 14.0794 2.84189 13.9791C2.44002 13.8787 2.1956 13.4716 2.29596 13.0697C3.39905 8.65272 7.38289 5.5 11.9984 5.5Z" fill="#212121"/>
                        </svg>
                    </div>
                </div>

            </div>
            <?php echo ShowError($arResult["strProfileError"]);?>
        </div>

        <div class="buttons-row">
            <button type="button" class="btn-cancel" onclick="history.back()">Отменить</button>
            <button type="submit" name="save" value="Y" class="btn-save">Сохранить</button>
        </div>
    </form>
</div>
<script>
    function togglePassword(icon) {

        const container = icon.closest('.input-field');

        const input = container.querySelector('input[type="password"], input[type="text"]');

        const isHidden = input.type === 'password';

        input.type = isHidden ? 'text' : 'password';

        let newSVG;

        if (isHidden) {
            newSVG = `
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M11.9984 9.00462C14.2075 9.00462 15.9984 10.7955 15.9984 13.0046C15.9984 15.2138 14.2075 17.0046 11.9984 17.0046C9.78927 17.0046 7.99841 15.2138 7.99841 13.0046C7.99841 10.7955 9.78927 9.00462 11.9984 9.00462ZM11.9984 10.5046C10.6177 10.5046 9.49841 11.6239 9.49841 13.0046C9.49841 14.3853 10.6177 15.5046 11.9984 15.5046C13.3791 15.5046 14.4984 14.3853 14.4984 13.0046C14.4984 11.6239 13.3791 10.5046 11.9984 10.5046ZM11.9984 5.5C16.6119 5.5 20.5945 8.65001 21.6995 13.0644C21.8001 13.4662 21.5559 13.8735 21.1541 13.9741C20.7523 14.0746 20.345 13.8305 20.2444 13.4286C19.3055 9.67796 15.9198 7 11.9984 7C8.07534 7 4.68851 9.68026 3.75127 13.4332C3.6509 13.835 3.24376 14.0794 2.84189 13.9791C2.44002 13.8787 2.1956 13.4716 2.29596 13.0697C3.39905 8.65272 7.38289 5.5 11.9984 5.5Z" fill="#212121"/>
    <line x1="20.9761" y1="17.277" x2="2.68129" y2="6.77318" stroke="black" stroke-width="1.5" stroke-linecap="round"/>
</svg>`;
        } else {
            newSVG = `
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M11.9984 9.00462C14.2075 9.00462 15.9984 10.7955 15.9984 13.0046C15.9984 15.2138 14.2075 17.0046 11.9984 17.0046C9.78927 17.0046 7.99841 15.2138 7.99841 13.0046C7.99841 10.7955 9.78927 9.00462 11.9984 9.00462ZM11.9984 10.5046C10.6177 10.5046 9.49841 11.6239 9.49841 13.0046C9.49841 14.3853 10.6177 15.5046 11.9984 15.5046C13.3791 15.5046 14.4984 14.3853 14.4984 13.0046C14.4984 11.6239 13.3791 10.5046 11.9984 10.5046ZM11.9984 5.5C16.6119 5.5 20.5945 8.65001 21.6995 13.0644C21.8001 13.4662 21.5559 13.8735 21.1541 13.9741C20.7523 14.0746 20.345 13.8305 20.2444 13.4286C19.3055 9.67796 15.9198 7 11.9984 7C8.07534 7 4.68851 9.68026 3.75127 13.4332C3.6509 13.835 3.24376 14.0794 2.84189 13.9791C2.44002 13.8787 2.1956 13.4716 2.29596 13.0697C3.39905 8.65272 7.38289 5.5 11.9984 5.5Z" fill="#212121"/>
</svg>`;
        }
        icon.innerHTML = newSVG.trim();

    }
    </script>