<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

global $APPLICATION;

$APPLICATION->SetPageProperty('BANNER_TITLE', 'Проверка сертификата');
$APPLICATION->SetPageProperty('BACKGROUND_COLOR_BANNER', '#F8F7F7');
$APPLICATION->SetPageProperty('keywords', 'УЦ IBS, Учебный центр IBS, IBS Training, учебный центр ibs, сертификат УЦ IBS, сертификат Учебный центр IBS, сертификат IBS Training, проверка сертификата Учебный центр IBS, проверка сертификата УЦ IBS, проверка сертификата IBS Training');
$APPLICATION->SetPageProperty('description', 'Проверка сертификата УЦ IBS');
$APPLICATION->SetTitle('Проверка сертификата');
?>

<div class="top-page-banner" style="background-color: <?= $APPLICATION->GetPageProperty('BACKGROUND_COLOR_BANNER') ?>">
    <div class="container">
        <div class="banner-content">
            <?php $APPLICATION->IncludeComponent(
                    'bitrix:breadcrumb',
                    'bread',
                    [
                        'START_FROM' => '0',
                        'PATH' => '',
                        'SITE_ID' => 's1',
                    ],
                    false
            ); ?>
            <h1><?= $APPLICATION->GetPageProperty('BANNER_TITLE') ?></h1>
        </div>
    </div>
</div>

<div class="section-box" style="background-color: #f2f2f2">
    <div class="section-box__container container">
        <div class="section-box__content">
            <form class="form callback-mini" name="cert" data-form-type="webform">
                <div class="form__active">
                    <div class="form__active-message" style="padding: 15px"><b>Сертификат действителен</b></div>
                </div>
                <div class="form__unidentified">
                    <div class="form__unidentified-message" style="padding: 15px"><b>Сертификат не найден</b></div>
                </div>
                <div class="form__inactive">
                    <div class="form__inactive-message" style="padding: 15px"><b>Сертификат не действителен</b></div>
                </div>
                <div class="form__content">
                    <div class="fields">
                        <?=bitrix_sessid_post()?>
                        <input type="hidden" name="addField" value="">
                        <label class="field-box">
                            <input type="text" name="SURNAME" data-inputmask-regex="[а-яА-Я\s]*" placeholder="Фамилия" value="" required/>
                        </label>
                        <label class="field-box">
                            <input type="text" name="NAME" data-inputmask-regex="[а-яА-Я\s]*" placeholder="Имя" value="" required/>
                        </label>
                        <label class="field-box">
                            <input type="text" name="PATRONYMIC" data-inputmask-regex="[а-яА-Я\s]*" placeholder="Отчество (если есть)" value=""/>
                        </label>
                        <label class="field-box">
                            <input type="text" name="SNILS" placeholder="СНИЛС" value="" required/>
                        </label>
                        <label class="field-box">
                            <input type="text" maxlength="10" name="NUMBER" pattern="[A-Z]{2}[0-9]{2}-[0-9]{5}" placeholder="Номер сертификата" value="" required/>
                        </label>
                        <label class="agree-text" style="color: #003979;line-height: 1.4">
                            <input name="agree" value="Y" type="checkbox">Настоящим  я подтверждаю, что уведомлен и согласен на передачу моих <a style="text-decoration: underline;" target="_blank" href="/privacy-policy/">Персональных данных</a></label>
                        <label class="agree-text" style="color: #003979;line-height: 1.4">
                            <input id="form-reg-two" name="agree-2" value="Y" type="checkbox">Настоящим  я подтверждаю, что уведомлен и согласен с <a style="text-decoration: underline;" target="_blank" href="/agree_of_subject/">условиями обработки персональных данных</a></label>
                    </div>
                    <button type="submit" class="button _submit _w-full _size-l"><span>Проверить</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .jq-selectbox.error {
        border: 1px solid #cd0505;
    }
    .form__content .jq-selectbox__select {
        background: #fff;
        height: 58px;
        border-radius: 4px;
        border-bottom: none;
    }
    .form__content .jq-selectbox__select-text {
        line-height: 58px;
        padding-top: 0;
    }
    .form__content .jq-selectbox__trigger-arrow {
        top: 50%;
        margin-top: -2px;
    }
    .form__content .jq-selectbox__dropdown {
        top: 100% !important;
        margin: 0;
        box-shadow: none;
    }
    .jq-selectbox__dropdown ul {
         background: #ffffff;
    }
</style>
<script>
    $(function() {
        $('select').styler();
        $('[name="SURNAME"]').inputmask()
        $('[name="NAME"]').inputmask()
        $('[name="PATRONYMIC"]').inputmask()
        $('[name="NUMBER"]').inputmask("AA99-99999",{ "placeholder": "FF00-00000" })
        $('[name="SNILS"]').inputmask("999-999-999 99",{ "placeholder": "XXX-XXX-XXX YY" })
    })
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>