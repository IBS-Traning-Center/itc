<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?php global $APPLICATION; ?>
<?php $APPLICATION->IncludeComponent(
    "bitrix:form.result.new",
    "main.feedback",
    Array(
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "CHAIN_ITEM_LINK" => "",
        "CHAIN_ITEM_TEXT" => "",
        "EDIT_URL" => "",
        "IGNORE_CUSTOM_TEMPLATE" => "N",
        "LIST_URL" => "",
        "SEF_MODE" => "N",
        "SUCCESS_URL" => "",
        "AJAX_MODE" => "Y",
        "USE_EXTENDED_ERRORS" => "N",
        "VARIABLE_ALIASES" => Array("RESULT_ID"=>"RESULT_ID","WEB_FORM_ID"=>"WEB_FORM_ID"),
        "WEB_FORM_ID" => "39"
    )
);?>
<footer class="footer">
    <div class="container">
        <div class="top-menu-block-footer">
            <?php $APPLICATION->IncludeComponent(
                'bitrix:menu',
                'main.footer',
                [
                    'ROOT_MENU_TYPE' => 'footer',
                    'MAX_LEVEL' => '1',
                    'CHILD_MENU_TYPE' => 'footer',
                    'USE_EXT' => 'Y'
                ]
            ); ?>
            <?php $APPLICATION->IncludeComponent(
                'bitrix:menu',
                'social.footer',
                [
                    'ROOT_MENU_TYPE' => 'social_footer',
                    'MAX_LEVEL' => '1',
                    'CHILD_MENU_TYPE' => 'social_footer',
                    'USE_EXT' => 'Y'
                ]
            ); ?>
        </div>
        <?php $APPLICATION->IncludeComponent(
            'bitrix:menu',
            'main.bottom.footer',
            [
                'ROOT_MENU_TYPE' => 'bottom_footer',
                'MAX_LEVEL' => '1',
                'CHILD_MENU_TYPE' => 'bottom_footer',
                'USE_EXT' => 'Y'
            ]
        ); ?>
    </div>
</footer>
<?php $APPLICATION->IncludeComponent(
    'bitrix:menu',
    'bottom.mobile',
    [
        'ROOT_MENU_TYPE' => 'bottom_mobile',
        'MAX_LEVEL' => '1',
        'CHILD_MENU_TYPE' => 'bottom_mobile',
        'USE_EXT' => 'Y'
    ]
); ?>
<?php $APPLICATION->IncludeComponent(
    'bitrix:menu',
    'hidden.bottom.mobile',
    [
        'ROOT_MENU_TYPE' => 'hidden_bottom_mobile',
        'MAX_LEVEL' => '1',
        'CHILD_MENU_TYPE' => 'hidden_bottom_mobile',
        'USE_EXT' => 'Y'
    ]
); ?>
<div class="message-with-new-req">Пользователь только что записался на курс "<span class="course-name-req-modal"></span>"
</div>
<!-- Summer discount -->
<?php $APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => SITE_TEMPLATE_PATH . "/include_areas/bottom_banner.php"
    )
); ?>
<div class="cookie-notice">
    <p>Сайт IBS Training Center использует cookie. Это дает нам возможность следить за корректной работой сайта, а также
        анализировать данные, чтобы развивать наши продукты и сервисы. Посещая сайт, вы соглашаетесь с обработкой ваших
        персональных данных. В случае несогласия вам следует покинуть его</p>
    <br>
    <div class="text-center"><a href="javascript:void(0)" style="margin-bottom: 0;"
                                class="sign-in close-notice btn-primary">Принимаю условия</a></div>
</div>
<script>
    $(document).ready(function () {
        function getCookie(name) {
            let matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }

        if (getCookie('notice') !== 'Y') {
            $('.cookie-notice').addClass('show');
            $('.close-notice').click(function () {
                document.cookie = 'notice=Y'
                $('.cookie-notice').removeClass('show');
            });
        }
    });
</script>
<div <?php if ($_REQUEST["formresult"] == "addok") { ?>style="display: block;"<?php } ?> class="mask">
    <div class="success-message">
        <a href="#" class="close"><i class="fa fa-times" aria-hidden="true"></i></a>
        Спасибо! <br/>Форма отправлена успешно.
    </div>
</div>
<div id="talent-search" class="modals" style="display: none">
    <div class="modals__wrapper"></div>
    <div class="modal">
        <div class="modal__box">
            <div class="modal__close">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                     y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
                        <path fill="#ffffff"
                              d="M538.7,500L981.9,56.8c10.8-10.8,10.8-27.9,0-38.7c-10.8-10.8-27.9-10.8-38.7,0L500,461.3L56.8,18.1C46,7.3,28.9,7.3,18.1,18.1S7.3,46,18.1,56.8L461.3,500L18.1,943.2c-10.8,10.8-10.8,27.9,0,38.7c10.8,10.8,27.9,10.8,38.7,0L500,538.7l443.2,443.2c10.8,10.8,27.9,10.8,38.7,0c10.8-10.8,10.8-27.9,0-38.7L538.7,500z"/>
                    </svg>
            </div>
            <div class="modal__header">
                <div class="modal__title section-box__title"><b>Стать тренером</b></div>
            </div>
            <div class="modal__main">
                <form class="callback-mini form" name="talent-search" data-form-type="webform" data-form-id="20"
                      enctype="multipart/form-data">
                    <div class="form__content">
                        <div class="fields">
                            <?= bitrix_sessid_post() ?>
                            <input type="hidden" name="WEB_FORM_ID" value="20">
                            <input type="hidden" name="addField" value="">
                            <label class="field-box">
                                <input type="text" class="field" name="name" placeholder="Имя" value="">
                            </label>
                            <label class="field-box">
                                <input type="text" class="field" name="last_name" placeholder="Фамилия" value="">
                            </label>
                            <label class="field-box">
                                <input type="text" class="field" name="Email" placeholder="E-mail" value="">
                            </label>
                            <label class="field-box">
                                <input type="text" class="field" name="phone" placeholder="Контактный телефон" value="">
                            </label>
                            <label class="field-box">
                                <input type="text" class="field" name="specialisation"
                                       placeholder="Специализация и ключевые области знаний" value="">
                            </label>
                            <label class="field-box">
                                <input type="text" class="field" name="prof"
                                       placeholder="Страница в соц.сетях (LinkedIn, Хабр)" value="">
                            </label>
                            <div class="form-section file-box">
                                <div class="click-wrap">
                                    <i class="fa fa-paperclip" aria-hidden="true"></i>
                                    <input type="file" data-maxsize="200" name="visualFile" data-name="resume_file[]">
                                    <span class="click-wrap__title">Прикрепить резюме</span>
                                </div>
                                <ul class="file-list"></ul>
                                <br>
                            </div>
                            <div class="form-row">
                                <label class="field-box _wide">
                                    <textarea class="field" name="message"
                                              placeholder="Дополнительная информация"></textarea>
                                </label>
                            </div>
                            <br>
                            <label class="agree-text" style="color: #10739d">
                                <input checked="checked" name="agree" value="Y" type="checkbox">Настоящим я подтверждаю,
                                что я ознакомлен с <a style="text-decoration: underline;" target="_blank" href="/terms-of-use/">Условиями использования</a>,
                                условия мне понятны и я согласен соблюдать их.
                            </label>
                            <label class="agree-text" style="color: #10739d">
                                <input checked="checked" name="agree-2" value="Y" type="checkbox">Я ознакомлен с
                                порядком обработки моих персональных данных согласно
                                <a style="text-decoration: underline;" target="_blank" href="/privacy-policy/">Политике в сфере персональных данных</a>.
                            </label>
                        </div>
                        <button type="submit" class="button _w-full _size-l _submit"><span><b>Отправить</b></span>
                        </button>
                    </div>
                    <div class="form__success">
                        <div class="form__success-message"><b>Спасибо.</b><br> Ваш запрос был получен.</div>
                    </div>
                </form>
            </div>
            <div class="modal__footer"></div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/56c443c6427448592519f5af/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>

<!--End of Tawk.to Script-->

<!-- Код тега ремаркетинга Google -->
<!--------------------------------------------------
С помощью тега ремаркетинга запрещается собирать информацию, по которой можно идентифицировать личность пользователя. Также запрещается размещать тег на страницах с контентом деликатного характера. Подробнее об этих требованиях и о настройке тега читайте на странице http://google.com/ads/remarketingsetup.
--------------------------------------------------->
<script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 986037442;
    var google_custom_params = window.google_tag_params;
    var google_remarketing_only = true;
    /* ]]> */
</script>
<!-- Google Code for tawk.to Chat Conversion -->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {};
    Tawk_API.onChatStarted = function () {
        window.targetEvents.tawk();
    };
</script>
<?php $APPLICATION->IncludeComponent('luxoft:vue.eventbus', ''); ?>
</body>
</html>
