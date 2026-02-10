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
