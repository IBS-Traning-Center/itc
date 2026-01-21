<!--</div>-->
<!--</div>-->
</section>

</main>

<footer class="footer">

  <div id="breadcrumb_location">
    <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "main", [
      "PATH"       => "",
      "SITE_ID"    => "s1",
      "START_FROM" => "0",
    ]); ?>
  </div>

  <? $APPLICATION->IncludeComponent("addamant:iblock.element.add.form", "medsoglasie", [
    "AJAX_MODE"                     => "Y",
    "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
    "CUSTOM_TITLE_DATE_ACTIVE_TO"   => "",
    "CUSTOM_TITLE_DETAIL_PICTURE"   => "",
    "CUSTOM_TITLE_DETAIL_TEXT"      => "",
    "CUSTOM_TITLE_IBLOCK_SECTION"   => "",
    "CUSTOM_TITLE_NAME"             => "ФИО",
    "CUSTOM_TITLE_PREVIEW_PICTURE"  => "",
    "CUSTOM_TITLE_PREVIEW_TEXT"     => "",
    "CUSTOM_TITLE_TAGS"             => "",
    "DEFAULT_INPUT_SIZE"            => "30",
    "DETAIL_TEXT_USE_HTML_EDITOR"   => "N",
    "ELEMENT_ASSOC"                 => "PROPERTY_ID",
    "GROUPS"                        => [
      0 => "2",
    ],
    "IBLOCK_ID"                     => "12",
    "IBLOCK_TYPE"                   => "form",
    "LEVEL_LAST"                    => "Y",
    "LIST_URL"                      => "",
    "MAX_FILE_SIZE"                 => "0",
    "MAX_LEVELS"                    => "100000",
    "MAX_USER_ENTRIES"              => "100000",
    "PREVIEW_TEXT_USE_HTML_EDITOR"  => "N",
    "PROPERTY_CODES"                => [
      0 => "41",
      1 => "42",
      2 => "NAME",
    ],
    "PROPERTY_CODES_REQUIRED"       => [
      0 => "41",
      1 => "42",
      2 => "NAME",
    ],
    "RESIZE_IMAGES"                 => "N",
    "SEF_MODE"                      => "N",
    "STATUS"                        => "ANY",
    "STATUS_NEW"                    => "N",
    "USER_MESSAGE_ADD"              => "Ваша заявка успешно отправлена",
    "USER_MESSAGE_EDIT"             => "Ваша заявка успешно отправлена",
    "USE_CAPTCHA"                   => "Y",
    "COMPONENT_TEMPLATE"            => "medsoglasie",
    "ELEMENT_ASSOC_PROPERTY"        => "",
  ], false); ?>

  <div class="footer__inner container">
    <div class="footer__top-wrapper">
      <img alt="light logo" loading="lazy" src="<?php echo SITE_TEMPLATE_PATH ?>/images/whiteLogoSvg.b1d2cf69.svg">
    </div>
    <div class="footer__main-wrapper">
      <div class="description__section">
        <p class="description__text">Наша миссия - облегчить жизнь людей с деликатными медицинскими потребностями</p>
        <a href="#">
          <button class="btn light btn-large radius-20 metric_btn_joinProgram_start_footer" data-toggle="modal" data-target="#formJoiningTheProgram">
            Вступить в программу <span>поддержки</span></button>
        </a>
        <div class="contacts__wrapper-adaptive">
          <div class="footer__contact">8 800 700-11-26<br>8 495 662-14-60<br>бесплатно по РФ</div>
          <div class="footer__contact">uro_line@coloplast.com</div>
        </div>
      </div>
      <div class="lists__wrapper">
        <div class="catalog__section">
          <p class="list__title">Каталог</p>
          <? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "footer_sections", [
            "ADD_SECTIONS_CHAIN"    => "N",
            "CACHE_FILTER"          => "N",
            "CACHE_GROUPS"          => "Y",
            "CACHE_TIME"            => "36000000",
            "CACHE_TYPE"            => "A",
            "COUNT_ELEMENTS"        => "N",
            "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
            "FILTER_NAME"           => "sectionsFilter",
            "IBLOCK_ID"             => "1",
            "IBLOCK_TYPE"           => "catalogs",
            "SECTION_CODE"          => "",
            "SECTION_FIELDS"        => [
              0 => "",
              1 => "",
            ],
            "SECTION_ID"            => "0",
            "SECTION_URL"           => "/catalog/#SECTION_CODE#/",
            "SECTION_USER_FIELDS"   => [
              0 => "",
              1 => "",
            ],
            "SHOW_PARENT_NAME"      => "Y",
            "TOP_DEPTH"             => "1",
            "COMPONENT_TEMPLATE"    => "footer_sections",
          ], false); ?>
        </div>
        <div class="consulting__section">
          <p class="list__title">Полезные материалы</p>
          <? $APPLICATION->IncludeComponent("bitrix:menu", "footer", [
            "ALLOW_MULTI_SELECT"    => "N",    // Разрешить несколько активных пунктов одновременно
            "CHILD_MENU_TYPE"       => "",    // Тип меню для остальных уровней
            "DELAY"                 => "N",    // Откладывать выполнение шаблона меню
            "MAX_LEVEL"             => "1",    // Уровень вложенности меню
            "MENU_CACHE_GET_VARS"   => [    // Значимые переменные запроса
              0 => "",
            ],
            "MENU_CACHE_TIME"       => "3600",    // Время кеширования (сек.)
            "MENU_CACHE_TYPE"       => "N",    // Тип кеширования
            "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
            "ROOT_MENU_TYPE"        => "footer",    // Тип меню для первого уровня
            "USE_EXT"               => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
          ], false); ?>
        </div>
        <div class="company__section">
          <p class="list__title">Компания</p>
          <? $APPLICATION->IncludeComponent("bitrix:menu", "company", [
            "ALLOW_MULTI_SELECT"    => "N",
            "CHILD_MENU_TYPE"       => "",
            "DELAY"                 => "N",
            "MAX_LEVEL"             => "1",
            "MENU_CACHE_GET_VARS"   => [],
            "MENU_CACHE_TIME"       => "3600",
            "MENU_CACHE_TYPE"       => "N",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "ROOT_MENU_TYPE"        => "company",
            "USE_EXT"               => "N",
            "COMPONENT_TEMPLATE"    => "company",
          ], false); ?>
        </div>
      </div>
      <div class="footer__bottom-wrapper">
        <div class="footer__rules-texts">
          <a href="/upload/files/privacy_notice.pdf" target="_blank">Уведомление о конфиденциальности</a>
          <a href="/upload/files/policy.pdf" target="_blank">Политика по обработке персональных данных</a>
          <a href="/upload/files/rules.pdf" target="_blank">Правила пользования сайтом</a>
          <!--                  <div class="footer__bottom-text">Обработка данных</div>-->
          <a href="/upload/files/cookie.pdf" target="_blank">Политика Cookies</a>
          <a href="/upload/files/Правила Колопласт - забота о вас_IC.pdf" target="_blank">Правила участия в программе Колопласт – забота о вас</a>
          <!--                  <div class="footer__bottom-text">Конфиденциальность</div>-->
        </div>
        <div class="footer__last-line">
          <!--          <a href="https://www.m-a-x.design/"><div class="footer__design-text">Дизайн — MAX</div></a>-->
          <a href="https://www.m-a-x.design/" class="footer__design-text" target="_blank">Дизайн — MAX</a>
          <div class="footer__bottom-text">
            <a href="https://addamant.ru/" class="adm-link">
              created with 
              <svg class="ico-red-heart" width="18" height="18" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <rect width="72" height="72" fill="url(#pattern0)"></rect>
                  <defs>
                  <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                  <use xlink:href="#image0_15_134" transform="scale(0.0138889)"></use>
                  </pattern>
                  <image id="image0_15_134" width="72" height="72" xlink:href="data:image/png;base64,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"></image>
                  </defs>
              </svg>
              at adm                                        
              <svg class="arrow-line-up-right" width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5.25 12.9043L12.75 5.4043" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path d="M5.25 5.4043H12.75V12.9043" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </a>
            <span>&copy; <?=date('Y')?>, Coloplast</span>
          </div>
        </div>
      </div>
    </div>

    <!--        <div class="footer_bottom-part">-->
    <!--        	<a href="/upload/files/rules.pdf" target="_blank">Правила пользования сайтом</a>-->
    <!--        	<a href="/upload/files/policy.pdf" target="_blank">Политика по обработке персональных данных</a>-->
    <!--        	<a href="/upload/files/cookie.pdf" target="_blank">Политика Cookies</a>-->
    <!--        	<a href="/upload/files/privacy_notice.pdf" target="_blank">Уведомление о конфиденциальности</a>-->
    <!--        </div>-->
  </div>
  <?/*div class="ozon-link">
    <a target="_blank" href="https://ozon.ru/t/AG97rnQ">
      <img src="/include/ozon.png">
    </a>
  </div*/?>
</footer>

<? $APPLICATION->IncludeComponent("bitrix:main.include", "", [
  "AREA_FILE_SHOW"   => "file",
  "AREA_FILE_SUFFIX" => "inc",
  "EDIT_TEMPLATE"    => "",
  "PATH"             => "/include/notifications.php",
]); ?>


<?
$APPLICATION->IncludeComponent(
  "addamant:iblock.element.add.form",
  "main",
  array(
    "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
    "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
    "CUSTOM_TITLE_DETAIL_PICTURE" => "",
    "CUSTOM_TITLE_DETAIL_TEXT" => "",
    "CUSTOM_TITLE_IBLOCK_SECTION" => "",
    "CUSTOM_TITLE_NAME" => "Ваше имя",
    "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
    "CUSTOM_TITLE_PREVIEW_TEXT" => "",
    "CUSTOM_TITLE_TAGS" => "",
    "DEFAULT_INPUT_SIZE" => "30",
    "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
    "ELEMENT_ASSOC" => "PROPERTY_ID",
    "GROUPS" => array(
      0 => "2",
    ),
    "IBLOCK_ID" => "16",
    "IBLOCK_TYPE" => "form",
    "LEVEL_LAST" => "N",
    "LIST_URL" => "",
    "MAX_FILE_SIZE" => "0",
    "MAX_LEVELS" => "1000",
    "MAX_USER_ENTRIES" => "1000",
    "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
    "PROPERTY_CODES" => array(
      0 => "68",
      1 => "69",
      2 => "70",
      3 => "71",
      4 => "72",
      5 => "NAME",
    ),
    "PROPERTY_CODES_REQUIRED" => array(
      0 => "68",
      1 => "69",
      2 => "70",
      3 => "72",
      4 => "NAME",
    ),
    "RESIZE_IMAGES" => "N",
    "SEF_MODE" => "N",
    "STATUS" => "ANY",
    "STATUS_NEW" => "N",
    "USER_MESSAGE_ADD" => "Добавлено успешно",
    "USER_MESSAGE_EDIT" => "Сохранено успешно",
    "USE_CAPTCHA" => "Y",
    "COMPONENT_TEMPLATE" => "main",
    "ELEMENT_ASSOC_PROPERTY" => ""
  ),
  false
);

$APPLICATION->IncludeComponent("addamant:iblock.element.add.form", "modal_download_file", [
  "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
  "CUSTOM_TITLE_DATE_ACTIVE_TO"   => "",
  "CUSTOM_TITLE_DETAIL_PICTURE"   => "",
  "CUSTOM_TITLE_DETAIL_TEXT"      => "",
  "CUSTOM_TITLE_IBLOCK_SECTION"   => "",
  "CUSTOM_TITLE_NAME"             => "Имя",
  "CUSTOM_TITLE_PREVIEW_PICTURE"  => "",
  "CUSTOM_TITLE_PREVIEW_TEXT"     => "",
  "CUSTOM_TITLE_TAGS"             => "",
  "DEFAULT_INPUT_SIZE"            => "30",
  "DETAIL_TEXT_USE_HTML_EDITOR"   => "N",
  "ELEMENT_ASSOC"                 => "CREATED_BY",
  "GROUPS"                        => [
    0 => "2",
  ],
  "IBLOCK_ID"                     => "17",
  "IBLOCK_TYPE"                   => "form",
  "LEVEL_LAST"                    => "N",
  "LIST_URL"                      => "",
  "MAX_FILE_SIZE"                 => "0",
  "MAX_LEVELS"                    => "1000",
  "MAX_USER_ENTRIES"              => "1000",
  "PREVIEW_TEXT_USE_HTML_EDITOR"  => "N",
  "PROPERTY_CODES"                => [
    0 => "73",
    1 => "74",
    2 => "91",
    3 => "92",
    4 => "93",
    5 => "NAME",
  ],
  "PROPERTY_CODES_REQUIRED"       => [
    0 => "73",
    1 => "93",
    2 => "NAME",
  ],
  "RESIZE_IMAGES"                 => "N",
  "SEF_MODE"                      => "N",
  "STATUS"                        => "ANY",
  "STATUS_NEW"                    => "N",
  "USER_MESSAGE_ADD"              => "Документ отправлен успешно",
  "USER_MESSAGE_EDIT"             => "Документ отправлен",
  "USE_CAPTCHA"                   => "Y",
  "COMPONENT_TEMPLATE"            => "modal_download_file",
], false);
?>

<?/*<script>
  $('footer').append('<a href="https://wa.me/79175100242" class="f5-button__link" target="_blank"><div class="f5-wa-button-holder" style="position: fixed; z-index: 2001; right: 43px; bottom: 115px;" ><div style="background-color:#57d163; border-radius:30px; width:50px; height:50px; z-index: 2001; cursor: pointer;" class="f5-button js-f5-control f5-button--whatsapp"><svg style="margin-top: 5px; margin-left: 5px;" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none"><path d="M34 19.6394C34 27.1724 27.8465 33.2788 20.2545 33.2788C17.8443 33.2788 15.58 32.6628 13.6101 31.5817L6 34L8.48111 26.682C7.22951 24.6268 6.50867 22.2164 6.50867 19.6394C6.50867 12.1065 12.6628 6 20.2545 6C27.8472 6 34 12.1065 34 19.6394ZM20.2545 8.17218C13.8817 8.17218 8.69796 13.3164 8.69796 19.6394C8.69796 22.1485 9.51587 24.4722 10.8994 26.3625L9.45551 30.6213L13.8966 29.2098C15.7213 30.4079 17.9072 31.1067 20.2548 31.1067C26.6267 31.1067 31.8113 25.9631 31.8113 19.64C31.8113 13.317 26.627 8.17218 20.2545 8.17218ZM27.1957 22.7807C27.1108 22.6416 26.8864 22.5576 26.5498 22.3906C26.2126 22.2235 24.5556 21.4143 24.2476 21.3032C23.9387 21.1919 23.7134 21.1359 23.4891 21.4703C23.2648 21.8051 22.6189 22.5576 22.422 22.7807C22.2254 23.0044 22.0291 23.0324 21.6918 22.865C21.3552 22.698 20.2697 22.3445 18.9827 21.2059C17.9812 20.3198 17.3048 19.226 17.1082 18.8909C16.9119 18.5564 17.0877 18.3757 17.256 18.2092C17.4078 18.0593 17.5932 17.8188 17.7616 17.6237C17.9305 17.4284 17.9865 17.2893 18.0982 17.0659C18.2111 16.8428 18.1548 16.6478 18.0702 16.4801C17.9862 16.313 17.3117 14.6679 17.0311 13.9984C16.7504 13.3295 16.4701 13.4408 16.2732 13.4408C16.0769 13.4408 15.852 13.4128 15.6273 13.4128C15.4027 13.4128 15.0375 13.4965 14.7285 13.831C14.4199 14.1657 13.5497 14.9746 13.5497 16.6195C13.5497 18.2646 14.7565 19.8541 14.9255 20.0768C15.0938 20.2996 17.2557 23.7853 20.681 25.124C24.1067 26.4621 24.1067 26.0156 24.7245 25.9596C25.3418 25.904 26.7175 25.1511 26.9994 24.3708C27.2794 23.5893 27.2794 22.9201 27.1957 22.7807Z" fill="white"></path><deepl-alert xmlns=""></deepl-alert><deepl-alert xmlns=""></deepl-alert><deepl-alert xmlns=""></deepl-alert></svg></div></div></a>');
</script>*/ ?>
<!-- Roistat Counter Start -->
<script>
  (function(w, d, s, h, id) {
    w.roistatProjectId = id;
    w.roistatHost = h;
    var p = d.location.protocol == "https:" ? "https://" : "http://";
    var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/" + id + "/init?referrer=" + encodeURIComponent(d.location.href);
    var js = d.createElement(s);
    js.charset = "UTF-8";
    js.async = 1;
    js.src = p + h + u;
    var js2 = d.getElementsByTagName(s)[0];
    js2.parentNode.insertBefore(js, js2);
  })(window, document, 'script', 'cloud.roistat.com', '7a9871db02b74025fc6630b070ddafd5');
</script>
<!-- Roistat Counter End -->

<!-- закомментировано на время тестирования модуля ускорения -->
<!-- Yandex.Metrika counter -->
<?/*<script type="text/javascript">
    (function (m, e, t, r, i, k, a) {
      m[i] = m[i] || function () {
        (m[i].a = m[i].a || []).push(arguments)
      };
      m[i].l = 1 * new Date();
      for (var j = 0; j < document.scripts.length; j++) {
        if (document.scripts[j].src === r) {
          return;
        }
      }
      k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
    })
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(70038664, "init", {
      clickmap: true,
      trackLinks: true,
      accurateTrackBounce: true,
      webvisor: true
    });
  </script>
  <noscript>
    <div><img src="https://mc.yandex.ru/watch/70038664" style="position:absolute; left:-9999px;" alt=""/></div>
  </noscript>*/ ?>
<!-- /Yandex.Metrika counter -->
<? /*<script>(function(a,m,o,c,r,m){a[m]={id:"385737",hash:"05f7dc5d4864887f33245f0e18554b176ac2f64c4724bfeb471c10ca6fc566cf",locale:"ru",inline:false,setMeta:function(p){this.params=(this.params||[]).concat([p])}};a[o]=a[o]||function(){(a[o].q=a[o].q||[]).push(arguments)};var d=a.document,s=d.createElement('script');s.async=true;s.id=m+'_script';s.src='https://gso.amocrm.ru/js/button.js?1683211293';d.head&&d.head.appendChild(s)}(window,0,'amoSocialButton',0,0,'amo_social_button'));</script>*/ ?>
<!-- BEGIN WHATSAPP INTEGRATION WITH ROISTAT -->
<?/*script class="js-whatsapp-message-container">Обязательно отправьте это сообщение и дождитесь ответа. Ваш номер: {roistat_visit}</script */?>
<script>
   /* (function() {
        if (window.roistat !== undefined) {
            handler();
        } else {
            var pastCallback = typeof window.onRoistatAllModulesLoaded === "function" ? window.onRoistatAllModulesLoaded : null;
            window.onRoistatAllModulesLoaded = function () {
                if (pastCallback !== null) {
                    pastCallback();
                }
                handler();
            };
        }

        function handler() {
            function init() {
                appendMessageToLinks();

                var delays = [1000, 5000, 15000];
                setTimeout(function func(i) {
                    if (i === undefined) {
                        i = 0;
                    }
                    appendMessageToLinks();
                    i++;
                    if (typeof delays[i] !== 'undefined') {
                        setTimeout(func, delays[i], i);
                    }
                }, delays[0]);
            }

            function replaceQueryParam(url, param, value) {
                var explodedUrl = url.split('?');
                var baseUrl = explodedUrl[0] || '';
                var query = '?' + (explodedUrl[1] || '');
                var regex = new RegExp("([?;&])" + param + "[^&;]*[;&]?");
                var queryWithoutParameter = query.replace(regex, "$1").replace(/&$/, '');
                return baseUrl + (queryWithoutParameter.length > 2 ? queryWithoutParameter  + '&' : '?') + (value ? param + "=" + value : '');
            }

            function appendMessageToLinks() {
                var message = document.querySelector('.js-whatsapp-message-container').text;
                var text = message.replace(/{roistat_visit}/g, window.roistatGetCookie('roistat_visit'));
                text = encodeURI(text);
                var linkElements = document.querySelectorAll('[href*="//wa.me"], [href*="//api.whatsapp.com/send"], [href*="//web.whatsapp.com/send"], [href^="whatsapp://send"]');
                for (var elementKey in linkElements) {
                    if (linkElements.hasOwnProperty(elementKey)) {
                        var element = linkElements[elementKey];
                        element.href = replaceQueryParam(element.href, 'text', text);
                    }
                }
            }
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', init);
            } else {
                init();
            }
        };
    })();*/
</script>
<!-- END WHATSAPP INTEGRATION WITH ROISTAT -->
<script src='https://coloplast-bot.pairmax.digital/uroline-chat-widget.js' defer></script>
</body>

</html>