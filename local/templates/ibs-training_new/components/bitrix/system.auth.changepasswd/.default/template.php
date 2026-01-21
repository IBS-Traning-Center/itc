<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="password-wrapper">
    <?php
    ShowMessage($arResult['ERROR_MESSAGE']);
    ShowMessage($arParams["~AUTH_RESULT"]);
    ?>

    <?if ($arResult["SHOW_FORM"] !== "N"):?>
        <form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform" class="form-content">
            <input type="hidden" name="AUTH_FORM" value="Y">
            <input type="hidden" name="TYPE" value="CHANGE_PWD">
            <?if ($arResult["BACKURL"] <> ''):?>
                <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
            <?endif?>

            <?if(!$arResult["PHONE_REGISTRATION"]):?>
                <?if(!empty($arResult["USER_LOGIN"])):?>
                    <input type="hidden" name="USER_LOGIN" value="<?=htmlspecialcharsbx($arResult["USER_LOGIN"])?>" />
                <?else:?>
                    <div class="password-field">
                        <div class="input-wrapper">
                            <div class="label-text">Логин / E-mail</div>
                            <div class="input-field">
                                <input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" required />
                            </div>
                        </div>
                    </div>
                <?endif?>

                <?if($arResult["USE_PASSWORD"]):?>
                    <div class="password-field">
                        <div class="input-wrapper">
                            <div class="label-text">Текущий пароль</div>
                            <div class="input-field">
                                <input type="password" name="USER_CURRENT_PASSWORD" maxlength="255" value="" autocomplete="new-password" />
                            </div>
                        </div>
                    </div>
                <?else:?>
                    <div class="password-field">
                        <div class="input-wrapper">
                            <div class="label-text">Контрольная строка</div>
                            <div class="input-field">
                                <input type="text" name="USER_CHECKWORD" maxlength="50" value="<?=htmlspecialcharsbx($arResult["USER_CHECKWORD"])?>" required autocomplete="off" />
                            </div>
                        </div>
                    </div>
                <?endif?>
            <?else:?>
                <div class="password-field">
                    <div class="input-wrapper">
                        <div class="label-text">Номер телефона</div>
                        <div class="input-field">
                            <input type="text" value="<?=htmlspecialcharsbx($arResult["USER_PHONE_NUMBER"])?>" disabled />
                            <input type="hidden" name="USER_PHONE_NUMBER" value="<?=htmlspecialcharsbx($arResult["USER_PHONE_NUMBER"])?>" />
                        </div>
                    </div>
                </div>

                <div class="password-field">
                    <div class="input-wrapper">
                        <div class="label-text">Код из SMS</div>
                        <div class="input-field">
                            <input type="text" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" required autocomplete="off" />
                        </div>
                    </div>
                </div>
            <?endif?>

            <div class="password-field">
                <div class="input-wrapper">
                    <div class="label-text">Новый пароль</div>
                    <div class="input-field">
                        <input type="password" name="USER_PASSWORD" maxlength="255" value="" autocomplete="new-password" required />
                        <div class="eye-icon" onclick="togglePassword(this)">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.9984 9.00462C14.2075 9.00462 15.9984 10.7955 15.9984 13.0046C15.9984 15.2138 14.2075 17.0046 11.9984 17.0046C9.78927 17.0046 7.99841 15.2138 7.99841 13.0046C7.99841 10.7955 9.78927 9.00462 11.9984 9.00462ZM11.9984 10.5046C10.6177 10.5046 9.49841 11.6239 9.49841 13.0046C9.49841 14.3853 10.6177 15.5046 11.9984 15.5046C13.3791 15.5046 14.4984 14.3853 14.4984 13.0046C14.4984 11.6239 13.3791 10.5046 11.9984 10.5046ZM11.9984 5.5C16.6119 5.5 20.5945 8.65001 21.6995 13.0644C21.8001 13.4662 21.5559 13.8735 21.1541 13.9741C20.7523 14.0746 20.345 13.8305 20.2444 13.4286C19.3055 9.67796 15.9198 7 11.9984 7C8.07534 7 4.68851 9.68026 3.75127 13.4332C3.6509 13.835 3.24376 14.0794 2.84189 13.9791C2.44002 13.8787 2.1956 13.4716 2.29596 13.0697C3.39905 8.65272 7.38289 5.5 11.9984 5.5Z" fill="#212121"/>
                                <line x1="20.9761" y1="17.277" x2="2.68129" y2="6.77318" stroke="black" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="requirements-text">
                    <?=htmlspecialcharsbx($arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"] ?: 'Мин 6 символов, включая спецсимволы, цифры и разные регистры')?>
                </div>
            </div>

            <div class="password-field">
                <div class="input-wrapper">
                    <div class="label-text">Подтверждение пароля</div>
                    <div class="input-field">
                        <input type="password" name="USER_CONFIRM_PASSWORD" maxlength="255" value="" autocomplete="new-password" required />
                        <div class="eye-icon" onclick="togglePassword(this)">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.9984 9.00462C14.2075 9.00462 15.9984 10.7955 15.9984 13.0046C15.9984 15.2138 14.2075 17.0046 11.9984 17.0046C9.78927 17.0046 7.99841 15.2138 7.99841 13.0046C7.99841 10.7955 9.78927 9.00462 11.9984 9.00462ZM11.9984 10.5046C10.6177 10.5046 9.49841 11.6239 9.49841 13.0046C9.49841 14.3853 10.6177 15.5046 11.9984 15.5046C13.3791 15.5046 14.4984 14.3853 14.4984 13.0046C14.4984 11.6239 13.3791 10.5046 11.9984 10.5046ZM11.9984 5.5C16.6119 5.5 20.5945 8.65001 21.6995 13.0644C21.8001 13.4662 21.5559 13.8735 21.1541 13.9741C20.7523 14.0746 20.345 13.8305 20.2444 13.4286C19.3055 9.67796 15.9198 7 11.9984 7C8.07534 7 4.68851 9.68026 3.75127 13.4332C3.6509 13.835 3.24376 14.0794 2.84189 13.9791C2.44002 13.8787 2.1956 13.4716 2.29596 13.0697C3.39905 8.65272 7.38289 5.5 11.9984 5.5Z" fill="#212121"/>
                                <line x1="20.9761" y1="17.277" x2="2.68129" y2="6.77318" stroke="black" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <?if($arResult["USE_CAPTCHA"]):?>
                <div class="password-field captcha-block">
                    <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                    <div class="input-wrapper">
                        <div class="label-text">Код с картинки *</div>
                        <input type="text" name="captcha_word" maxlength="50" value="" required autocomplete="off" />
                    </div>
                </div>
            <?endif?>

            <div class="buttons-row">
                <button type="button" class="btn-cancel" onclick="history.back()">Отменить</button>
                <button type="submit" name="change_pwd" value="Y" class="btn-save">Сохранить</button>
            </div>
        </form>

    <?endif?>
    <?if($arResult["PHONE_REGISTRATION"]):?>
        <div id="bx_chpass_error" style="display:none"></div>
        <div id="bx_chpass_resend"></div>

        <script>
            new BX.PhoneAuth({
                containerId: 'bx_chpass_resend',
                errorContainerId: 'bx_chpass_error',
                interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
                data: <?= \Bitrix\Main\Web\Json::encode(['signedData' => $arResult["SIGNED_DATA"]]) ?>,
                onError: function(response) {
                    var errorDiv = BX('bx_chpass_error');
                    var errorNode = BX.findChildByClassName(errorDiv, 'errortext') || errorDiv;
                    errorNode.innerHTML = '';
                    for(var i = 0; i < response.errors.length; i++) {
                        errorNode.innerHTML += BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
                    }
                    errorDiv.style.display = '';
                }
            });
        </script>
    <?endif?>

</div>

<script>
    function togglePassword(icon) {
        const input = icon.previousElementSibling;
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>