<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php
if ($_POST['AUTH_FORM'] === 'Y' && $_POST['TYPE'] === 'SEND_PWD' && $_REQUEST['ajax'] === 'Y')
{
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    $APPLICATION->RestartBuffer();

    $email = trim($_POST['USER_LOGIN']);
    $result = array('STATUS' => 'ERROR', 'MESSAGE' => 'Неизвестная ошибка');

    if (check_email($email))
    {
        $arResult = CUser::SendPassword($email, $email, SITE_ID);

        if ($arResult["TYPE"] === "OK")
        {
            $result = array('STATUS' => 'OK', 'MESSAGE' => 'Письмо отправлено');
        }
        else
        {
            $result['MESSAGE'] = $arResult["MESSAGE"];
        }
    }
    else
    {
        $result['MESSAGE'] = 'Некорректный email';
    }

    header('Content-Type: application/json');
    echo \Bitrix\Main\Web\Json::encode($result);
    die();
}
?>
<?if ($arResult["FORM_TYPE"] == "login"):?>
    <?
    if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
    {
        ShowMessage($arResult['ERROR_MESSAGE']);
    }
    ?>

    <? if($arResult['NEW_USER_REGISTRATION'] == 'Y' && ($arResult['USE_OPENID'] == 'Y' || $arResult['USE_LIVEID'] == 'Y')){?>
        <script type="text/javascript">
            function SAFChangeAuthForm(v)
            {
                document.getElementById('at_frm_bitrix').style.display = (v == 'bitrix') ? 'block' : 'none';
                <? if ($arResult['USE_OPENID'] == 'Y') { ?>document.getElementById('at_frm_openid').style.display = (v == 'openid') ? 'block' : 'none';<?}?>
                <? if ($arResult['USE_LIVEID'] == 'Y') { ?>document.getElementById('at_frm_liveid').style.display = (v == 'liveid') ? 'block' : 'none';<?}?>
            }
        </script>
    <?}?>

<div class="bx-custom-auth">
    <div class="auth-container">
        <div id="at_frm_bitrix">
            <form class="auth-form" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
                <? if (strlen($arResult["BACKURL"]) > 0): ?>
                    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                <? endif; ?>

                <? foreach ($arResult["POST"] as $key => $value): ?>
                    <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                <? endforeach; ?>

                <input type="hidden" name="AUTH_FORM" value="Y" />
                <input type="hidden" name="TYPE" value="AUTH" />

                <div class="field">
                    <input type="email" name="USER_LOGIN" placeholder="Эл. почта"
                           maxlength="80" value="<?=htmlspecialcharsbx($arResult["USER_LOGIN"])?>" required />
                </div>

                <div class="field field--password">
                    <input type="password" name="USER_PASSWORD" placeholder="Пароль" maxlength="50" required />
                    <span class="field__icon" onclick="togglePassword(this)"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.9984 9.00462C14.2075 9.00462 15.9984 10.7955 15.9984 13.0046C15.9984 15.2138 14.2075 17.0046 11.9984 17.0046C9.78927 17.0046 7.99841 15.2138 7.99841 13.0046C7.99841 10.7955 9.78927 9.00462 11.9984 9.00462ZM11.9984 10.5046C10.6177 10.5046 9.49841 11.6239 9.49841 13.0046C9.49841 14.3853 10.6177 15.5046 11.9984 15.5046C13.3791 15.5046 14.4984 14.3853 14.4984 13.0046C14.4984 11.6239 13.3791 10.5046 11.9984 10.5046ZM11.9984 5.5C16.6119 5.5 20.5945 8.65001 21.6995 13.0644C21.8001 13.4662 21.5559 13.8735 21.1541 13.9741C20.7523 14.0746 20.345 13.8305 20.2444 13.4286C19.3055 9.67796 15.9198 7 11.9984 7C8.07534 7 4.68851 9.68026 3.75127 13.4332C3.6509 13.835 3.24376 14.0794 2.84189 13.9791C2.44002 13.8787 2.1956 13.4716 2.29596 13.0697C3.39905 8.65272 7.38289 5.5 11.9984 5.5Z" fill="#212121"/>
</svg>
</span>
                </div>

                <? if ($arResult["CAPTCHA_CODE"]): ?>
                    <div class="field">
                        <div style="margin-bottom: 16px;">
                            <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>"
                                 width="180" height="40" alt="CAPTCHA" />
                            <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                        </div>
                        <input type="text" name="captcha_word" placeholder="<?=GetMessage("AUTH_CAPTCHA_PROMT")?>"
                               maxlength="50" value="" required />
                    </div>
                <? endif; ?>

                <a href="#"
                   class="auth-form__link forgot-password-trigger"
                   data-url="/auth/change-password.php"
                   id="forgotPasswordBtn"
                >
                    Забыли пароль?
                </a>

                <? if ($arResult["STORE_PASSWORD"] == "Y"): ?>
                    <label class="checkbox">
                        <input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" />
                        <span class="checkbox__label">Запомнить меня</span>
                    </label>
                <? endif; ?>

                <button type="submit" name="Login" class="auth-form__submit">
                    <?=GetMessage("AUTH_LOGIN_BUTTON")?>
                </button>
            </form>

            <? if(!empty($arResult["AUTH_SERVICES"])): ?>
                <div class="social-auth" style="margin-top: 32px; padding-top: 32px; border-top: 1px solid #eee;">
                    <div style="text-align: center; margin-bottom: 16px; color: #666;">
                        <?=GetMessage("AUTH_SOCSERV")?>
                    </div>
                    <?$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
                        array(
                            "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                            "SUFFIX" => "form",
                            "POPUP" => "N"
                        ),
                        $component,
                        array("HIDE_ICONS" => "N")
                    );?>
                </div>
            <? endif; ?>
        </div>

        <? if($arResult['NEW_USER_REGISTRATION'] == 'Y' && $arResult['USE_OPENID'] == 'Y'): ?>
            <div id="at_frm_openid" style="display: none">
                <form method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
                    <div class="field">
                        <input type="text" name="OPENID_IDENTITY" placeholder="<?=GetMessage("AUTH_OPENID")?>"
                               maxlength="50" value="<?=htmlspecialcharsbx($arResult["USER_LOGIN"])?>" />
                    </div>
                    <button type="submit" name="Login" class="auth-form__submit">
                        <?=GetMessage("AUTH_LOGIN_BUTTON")?>
                    </button>
                </form>
            </div>
        <? endif; ?>

        <? if($arResult['NEW_USER_REGISTRATION'] == 'Y' && $arResult['USE_LIVEID'] == 'Y'): ?>
            <div id="at_frm_liveid" style="display: none">
                <a href="<?=$arResult['LIVEID_LOGIN_LINK']?>" class="auth-form__submit" style="display: block; text-align: center;">
                    <?=GetMessage('AUTH_LIVEID_LOGIN')?>
                </a>
            </div>
        <? endif; ?>
    </div>

    <div class="auth-modal-overlay" id="authModalOverlay" style="display:none;">
        <div class="auth-modal auth-modal--forgot" id="forgotAuthModal">
            <button class="auth-modal__close" id="closeForgotAuth"></button>

            <div class="auth-modal__content">
                <h2 class="auth-modal__title">Запрос нового пароля</h2>

                <form id="forgotAuthForm">
                    <div class="field field--auth-modal">
                        <div class="field__input-wrapper">
                            <input type="email"
                                   name="USER_LOGIN"
                                   placeholder="Эл. почта"
                                   required
                                   class="field__input"
                                   id="forgotEmailInput">
                        </div>
                    </div>

                    <div class="auth-modal__buttons">
                        <button type="button" class="auth-modal__button auth-modal__button--outline" id="backToLoginAuth">
                            Назад
                        </button>

                        <button type="submit" class="auth-modal__button auth-modal__button--submit" id="submitForgotForm">
                            Отправить
                        </button>
                    </div>

                    <div id="forgotAuthResult" class="auth-modal__result"></div>
                </form>
            </div>
        </div>
    </div>
    <div class="auth-modal-overlay" id="successModalOverlay" style="display:none;">
        <div class="auth-modal auth-modal--success" id="successAuthModal">
            <button class="auth-modal__close" id="closeSuccessAuth"></button>

            <div class="auth-modal__content">
                <h2 class="auth-modal__title">Новый пароль отправлен</h2>

                <div class="auth-modal__message" id="successMessage">
                    На почту <span class="auth-modal__email" id="successEmail"></span> выслан новый пароль<br>
                    Если письма нет — проверьте папку Спам
                </div>

                <div class="auth-modal__buttons auth-modal__buttons--single">
                    <button type="button" class="auth-modal__button auth-modal__button--full" id="backToAuthBtn">
                        Вернуться на вход
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>

        <? if($arResult['NEW_USER_REGISTRATION'] == 'Y' && ($arResult['USE_OPENID'] == 'Y' || $arResult['USE_LIVEID'] == 'Y')): ?>
        document.addEventListener('DOMContentLoaded', function() {
            const methodRadios = document.querySelectorAll('input[name="BX_AUTH_TYPE"]');
            if (methodRadios.length > 0) {
                methodRadios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        SAFChangeAuthForm(this.value);
                    });
                });
            }
        });
        <? endif; ?>
    </script>

<?else:?>

    <div class="auth-container">
        <div style="text-align: center; padding: 40px 0;">
            <p style="margin-bottom: 24px; font-size: 18px;">Вы зарегистрированы и успешно авторизовались.</p>
            <a href="/" class="auth-form__submit" style="display: inline-block; width: auto; padding: 16px 32px;">
                Вернуться на главную страницу
            </a>
        </div>
    </div>
<?endif;?>

