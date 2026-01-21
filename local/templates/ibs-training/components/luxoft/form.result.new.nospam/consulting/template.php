<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<? if ($arResult["isFormErrors"] == "Y"): ?><?= $arResult["FORM_ERRORS_TEXT"]; ?><? endif; ?>

<?= $arResult["FORM_NOTE"] ?>

<? if ($arResult["isFormNote"] != "Y") {
    ?>
    <?= $arResult["FORM_HEADER"] ?>
    <div class="form--consulting">
        <div class="form-section">
            <input type="text" placeholder="Фамилия, имя, отчество" name="form_text_768" value="">
        </div>
        <div class="form-section">
            <input placeholder="Контактный телефон" type="text" name="form_text_773" value="">
        </div>
        <div class="form-section">
            <input type="text" placeholder="Контактный e-mail" name="form_email_772" value="">
        </div>
        <div class="form-section">
            <input type="text" placeholder="Компания" name="form_text_770" value="">
        </div>
        <div class="form-section">
            <textarea placeholder="Сообщение" name="form_textarea_774"></textarea>
        </div>

        <input type="hidden" name="form_hidden_948" id="clientID" value="">
        <input type="hidden" name="form_hidden_775" value="http://ibs-training.ru<?= $APPLICATION->GetCurPage(); ?>">
        <label class="agree-text">
            <input class="form-reg-agree" checked="checked" name="agree" value="Y" type="checkbox"
            />Настоящим я подтверждаю, что я ознакомлен с <a style="color: #fff; text-decoration: underline;" target="_blank" href="/terms-of-use/">Условиями использования</a>, условия мне понятны и я согласен соблюдать их.
        </label>
        <label class="agree-text">
            <input class="form-reg-two" checked="checked" name="agree-2" value="Y" type="checkbox"
            />Я ознакомлен с порядком обработки моих персональных данных согласно <a style="color: #fff; text-decoration: underline;" target="_blank" href="/privacy-policy/">Политике в сфере персональных данных</a>.
        </label>
        <input class="orange rfloat main-korp-reg sign-in" type="submit" name="web_form_apply" value="Отправить заявку">
        <input class="checkspam" type="hidden" name="checkcap" value=""/>
    </div>
    <?= $arResult["FORM_FOOTER"] ?>
<?} //endif (isFormNote)?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.checkspam').val('iamnotbot');

        $('form input.form-reg-agree').change(function () {
            if ($(this).prop('checked') == true) {
                //console.info($(this).parents("form").find('input.form-reg-two').prop('checked'));
                if ($(this).parents('form').find('input.form-reg-two').prop('checked') == true) {
                    //console.info($(this).parent().parent().parent().find('.main-korp-reg'));
                    $(this).parents('form').find('.main-korp-reg').prop('disabled', false);
                }
            } else {
                //console.info('false');
                $(this).parents('form').find('.main-korp-reg').prop('disabled', true);
            }
        });
        $('form input.form-reg-two').change(function () {
            if ($(this).prop('checked') == true) {
                if ($(this).parents('form').find('input.form-reg-agree').prop('checked') == true) {
                    $(this).parents('form').find('input.main-korp-reg').removeAttr('disabled');
                }
            } else {
                $(this).parents('form').find('.main-korp-reg').prop('disabled', 'disabled');
            }
        });

        ym(23056159, 'getClientID', function(clientID) {
            document.getElementById('clientID').value = clientID;
        });
    })
</script>