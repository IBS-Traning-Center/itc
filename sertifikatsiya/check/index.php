<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty('keywords', 'УЦ IBS, Учебный центр IBS, IBS Training, учебный центр ibs, сертификат УЦ IBS, сертификат Учебный центр IBS, сертификат IBS Training, проверка сертификата Учебный центр IBS, проверка сертификата УЦ IBS, проверка сертификата IBS Training');
$APPLICATION->SetPageProperty('description', 'Проверка сертификата УЦ IBS');
$APPLICATION->SetTitle('Проверка сертификата');
?>

<section class="start bg--green mb-0">
	<div class="container">
		<?$APPLICATION->IncludeComponent(
			'bitrix:breadcrumb',
			'bread',
			[
				'START_FROM' => '0',
				'PATH' => '',
				'SITE_ID' => 's1',
			],
			false
		);
        $APPLICATION->AddChainItem($APPLICATION->GetTitle(), $APPLICATION->GetCurPage());?>
		<h1 class="title--h1">Проверка сертификата</h1>
		<p>Здесь можно проверить сертификат ИТ-специалиста Центра сертификации IBS</p>
    </div>
</section>

<div class="section-box" style="background-color: #f2f2f2">
    <div class="section-box__container container">
        <div class="section-box__header">
            <div class="section-box__subtitle">Укажите фамилию и номер сертификата</div>
        </div>
        <div class="section-box__content">
            <form class="form callback-mini" name="cert" data-form-type="webform">
                <div class="form__active">
                    <div class="form__active-message" style="padding: 15px"><b>Сертификат действителен</b></div>
                </div>
                <div class="form__unidentified">
                    <div class="form__unidentified-message" style="padding: 15px"><b>Сертификат не найден!</b> Проверьте, что в фамилии и номере нет ошибок и опечаток.</div>
                </div>
                <div class="form__inactive">
                    <div class="form__inactive-message" style="padding: 15px"><b>Сертификат не действителен</b></div>
                </div>
                <div class="form__content">
                    <div class="fields">
                        <?=bitrix_sessid_post()?>
                        <input type="hidden" name="addField" value="">
                        <label class="field-box">
                            <input type="text" name="SURNAME" pattern="[а-яА-Я\s]*" placeholder="Фамилия" value="" required/>
                        </label>
                        <label class="field-box">
                            <input type="text" maxlength="10" name="NUMBER" pattern="[A-Z]{2}[0-9]{2}-[0-9]{5}" placeholder="Номер сертификата" value="" required/>
                        </label>
                        <label class="agree-text" style="color: #003979;line-height: 1.4">
                            <input name="agree" value="Y" type="checkbox">Настоящим  я подтверждаю, что уведомлен и согласен на передачу моих <a style="text-decoration: underline;" target="_blank" href="/privacy-policy/">Персональных данных</a></label>
                        <label class="agree-text" style="color: #003979;line-height: 1.4">
                            <input id="form-reg-two" name="agree-2" value="Y" type="checkbox">Настоящим  я подтверждаю, что уведомлен и согласен с <a style="text-decoration: underline;" target="_blank" href="/agree_of_subject/">условиями обработки персональных данных</a></label>
                    </div>
                    <button type="submit" class="button _submit _w-full _size-l" style="background: #2A418B;"><span>Проверить</span></button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .start .title--h1 + p {
        margin-bottom: 0px;
    }
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
    .callback-mini a {
         color: #003979;
    }
    .button._submit,
    .button._submit:after {
         background: #2A418B;
         border-color: #2A418B;
    }
    .jq-selectbox__dropdown ul {
         background: #ffffff;
    }
    input[type="text"] {
         border-radius: 0px;
    }
</style>

<script>
    $(function() {
        $('select').styler();
        $('[name="SURNAME"]').inputmask()
        $('[name="NUMBER"]').inputmask("AA99-99999",{ "placeholder": "FF00-00000" })
    })
</script>

<?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	"main.feedback",
	Array(
		"AJAX_MODE" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"CUSTOM_CLASSES" => "bg--green",
		"EDIT_URL" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"LIST_URL" => "",
		"SEF_MODE" => "N",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "N",
		"VARIABLE_ALIASES" => array("RESULT_ID"=>"RESULT_ID","WEB_FORM_ID"=>"WEB_FORM_ID"),
		"WEB_FORM_ID" => "47"
	)
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>