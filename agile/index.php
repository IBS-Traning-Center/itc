<?php
declare(strict_types=1);
include($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Тренинги Luxoft Agile Practice в Украине"); ?>
<?php
$requestCode = $_REQUEST["CODE"] ?? '';
if (strlen($requestCode) > 0 && $requestCode != "ua") { ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta property="og:url" content="<?= $APPLICATION->GetCurDir() ?>"/>
        <meta property="og:type" content="article"/>
        <meta property="og:title" content="<? $APPLICATION->ShowTitle() ?>"/>
        <meta property="og:image" content="https://ibs-training.ru/agile/images/agile-nice-photo.jpg"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="windows-1251">
        <? $APPLICATION->ShowHeadStrings() ?>
        <? $APPLICATION->ShowHeadScripts() ?>
        <title><? $APPLICATION->ShowTitle() ?></title>
        <link href="/agile/css/all.css?check=45" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="/agile/js/scrollTo.js"></script>
        <script src="/agile/js/jquery.nav.js"></script>
        <script src="/agile/js/parallax.min.js"></script>
        <script src="/agile/js/bPopup.js"></script>
        <script src="/agile/js/main.js?rest=1114"></script>
        <script type="text/javascript">
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-9384348-1', 'auto');
            ga('send', 'pageview');

            /*var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-9384348-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                //ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();*/

        </script>
    </head>
    <body>
    <?php
    $APPLICATION->RestartWorkarea(true);
    $elementID = $APPLICATION->IncludeComponent("bitrix:news.detail", "landing-agile", array(
        "IBLOCK_TYPE" => "ag_land",
        "IBLOCK_ID" => "140",
        "ELEMENT_ID" => "",
        "ELEMENT_CODE" => $_REQUEST["CODE"],
        "CHECK_DATES" => "Y",
        "FIELD_CODE" => array(
            0 => "PREVIEW_PICTURE",
            1 => "DETAIL_TEXT",
            2 => "DETAIL_PICTURE",
            3 => "",
        ),
        "PROPERTY_CODE" => array(
            0 => "",
            1 => "DESCRIPTION",
            2 => "",
        ),
        "IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "N",
        "CACHE_TIME" => "3600",
        "CACHE_GROUPS" => "Y",
        "META_KEYWORDS" => "-",
        "META_DESCRIPTION" => "-",
        "BROWSER_TITLE" => "-",
        "SET_TITLE" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "USE_PERMISSIONS" => "Y",
        "GROUP_PERMISSIONS" => array(
            0 => "1",
            1 => "2",
        ),
        "DISPLAY_TOP_PAGER" => "Y",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "",
        "PAGER_TEMPLATE" => "",
        "PAGER_SHOW_ALL" => "Y",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "USE_SHARE" => "Y",
        "SHARE_HIDE" => "N",
        "SHARE_TEMPLATE" => "",
        "SHARE_HANDLERS" => array(),
        "SHARE_SHORTEN_URL_LOGIN" => "",
        "SHARE_SHORTEN_URL_KEY" => "",
        "AJAX_OPTION_ADDITIONAL" => "",

        "SET_STATUS_404" => "Y",
        "SHOW_404" => "Y",
    ),
        false
    ); ?>
    <?php
    if (intval($_REQUEST["FORM_RESULT_ID"]) > 0) { ?>
        <div class="popup" id="success">
            <div class="popup-t">
                <a href="#" class="close">X</a>
                <h3>Вы успешно зарегистрированы!</h3>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#success').bPopup({
                    modalColor: '#14202b',
                    closeClass: 'close'
                });
                ga('send', 'event', 'register', 'agile-courses', 'succes');
            })
        </script>
    <?php
    } ?>
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function () {
                try {
                    w.yaCounter23056159 = new Ya.Metrika({
                        id: 23056159,
                        webvisor: true,
                        clickmap: true,
                        trackLinks: true,
                        accurateTrackBounce: true
                    });
                } catch (e) {
                }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () {
                    n.parentNode.insertBefore(s, n);
                };
            s.type = "text/javascript";
            s.async = true;
            s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else {
                f();
            }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="//mc.yandex.ru/watch/23056159" style="position:absolute; left:-9999px;" alt=""/></div></noscript>
    </body>
    </html>
<? } else { ?>
    <!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <?php if ($_REQUEST["CODE"] == "ua") { ?>
            <title>Тренинги Luxoft Agile Practice в Украине</title>
        <?php } else { ?>
            <title>Тренинги Luxoft Agile Practice в России</title>
        <?php } ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:url" content="<?= $APPLICATION->GetCurDir() ?>"/>
        <meta property="og:type" content="article"/>
        <?php if ($_REQUEST["CODE"] == "ua") { ?>
            <meta property="og:title" content="Тренинги Luxoft Agile Practice в Украине"/>
        <?php } else { ?>
            <meta property="og:title" content="Тренинги Luxoft Agile Practice в России"/>
        <?php } ?>
        <meta property="og:description"
              content="Тренинги проводятся сертифицированными инструкторами и, помимо теоретического материала, включают большое количество практических упражнений, закрепляющих полученные знания. По результатам прохождения сертифицированных тренингов ICAgile и Scrum.org участники получают сертификаты международного образца."/>
        <meta property="og:image" content="https://ibs-training.ru/agile/images/agile-nice-photo.jpg"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,500&subset=cyrillic,latin">
        <link rel="stylesheet" href="/agile/css/main.css">
    </head>
    <body>
    <div class="wrapper">
        <header class="header clearfix">
            <h1 class="header-logo"><a href="http://ibs-training.ru/"><img src="/local/templates/ibs-training/assets/images/logo_gradient.svg" width="228" alt="Luxof Training"></a></h1>
            <nav class="header-nav">
                <ul>
                    <li><a href="#agile">Agile-практика</a></li>
                    <li><a href="#video">Видео</a></li>
                    <li><a href="#training">Ближайшие тренинги</a></li>
                    <li><a href="#reviews">Отзывы слушателей</a></li>
                </ul>
            </nav>
        </header>
        <main class="content">
            <section id="agile" class="section-agile">
                <h2 class="title">Luxoft Agile Practice: о нас</h2>
                <div class="container">
                    <div class="left-col">
                        <img src="/agile/images/content/img-1.jpg" alt="Luxoft Agile Practice"/>
                        <div class="gallery-row">
                            <img src="/agile/images/content/img-2.jpg" alt="Luxoft Agile Practice"/>
                            <img src="/agile/images/content/img-3.jpg" alt="Luxoft Agile Practice"/>
                        </div>
                        <p>Тренинги проводятся сертифицированными инструкторами и, помимо теоретического материала,
                            включают большое количество практических упражнений, закрепляющих полученные знания. По
                            результатам прохождения сертифицированных тренингов ICAgile и Scrum.org участники получают
                            сертификаты международного образца.</p>
                    </div>
                    <div class="right-col">
                        <p>Обширный международный опыт в разработке программного обеспечения и глубокое знание лучших
                            мировых практик и методологий помогли Luxoft стать одним из лидеров в предоставлении
                            образовательных услуг в области Agile. В нашем портфеле — одобренные международными
                            сообществами профессионалов программы ICAgile и Scrum.org, а также актуальные для наших
                            заказчиков и партнеров тренинги, позволяющие лучше ориентироваться в отдельных аспектах
                            разработки ПО.</p>
                        <div class="gallery-row">
                            <img src="/agile/images/content/img-4.jpg" alt="Luxoft Agile Practice">
                            <img src="/agile/images/content/img-5.jpg" alt="Luxoft Agile Practice">
                        </div>
                        <img src="/agile/images/content/img-6.jpg" alt="Luxoft Agile Practice">
                    </div>
                </div>
                <div class="more-info">Больше информации вы найдете в <a
                            href="https://www.youtube.com/channel/UCza7aSrc2ZJbHTowBPczR2g" class="youtube-icon"><img
                                src="/agile/images/youtube-icon.png" alt="YouTube"></a></div>
            </section>
            <section id="video">
                <div class="video-container">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/dXOPgZq_pEc" frameborder="0"
                            allowfullscreen></iframe>
                </div>
            </section>
            <section id="training" class="training-section">
                <h2 class="title">Ближайшие сертификационные тренинги</h2>
                <?php
                if ($_REQUEST["CODE"] == "ua") {
                    $ar_city = [CITY_ID_KIEV, CITY_ID_DNEPR, CITY_ID_ODESSA];
                } else {
                    $ar_city = [CITY_ID_MOSCOW, CITY_ID_SPB];
                }
                $data = date("Y-m-d H:i:s");
                $GLOBALS["arrFilter"] = [
                    "PROPERTY_city" => $ar_city,
                    "!ID" => $arResult["PROPERTIES"]["TIME_COURSE"]["VALUE"],
                    "ACTIVE" => "Y",
                    ">PROPERTY_startdate" => $data,
                    "PROPERTY_course_code" => [
                        "SDP-031",
                        "SDP-032",
                        "SDP-033",
                        "SDP-034",
                        "SDP-035",
                        "SDP-039",
                        "SDP-042",
                        "SDP-045",
                        "SPD-043",
                        "SDP-044"
                    ]
                ]; ?>
                <?php
                $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "edu_ru_all_city_agile_main",
                    [
                        "IBLOCK_TYPE" => "edu",    // Тип информационного блока (используется только для проверки)
                        "IBLOCK_ID" => "9",    // Код информационного блока
                        "NEWS_COUNT" => "100",    // Количество новостей на странице
                        "SORT_BY1" => "PROPERTY_startdate",    // Поле для первой сортировки новостей
                        "SORT_ORDER1" => "ASC",    // Направление для первой сортировки новостей
                        "SORT_BY2" => $_REQUEST["sort"],    // Поле для второй сортировки новостей
                        "SORT_ORDER2" => "ASC",    // Направление для второй сортировки новостей
                        "FILTER_NAME" => "arrFilter",    // Фильтр
                        "FIELD_CODE" => [
                            0 => "",
                            1 => "",
                        ],
                        "SHOW_PRICE" => $_SESSION['SHOW_PRICE'],
                        "PROPERTY_CODE" => [
                            0 => "course_сode",
                            1 => "startdate",
                            2 => "enddate",
                            3 => "schedule_time",
                            4 => "schedule_description",
                            5 => "schedule_price",
                            6 => "schedule_duration",
                            7 => "hot_checkbox",
                            8 => "prschedule_startdate",
                            9 => "prschedule_enddate",
                            10 => "prschedule_time",
                            11 => "prschedule_desc",
                            12 => "",
                        ],
                        "CHECK_DATES" => "N",    // Показывать только активные на данный момент элементы
                        "DETAIL_URL" => "/edu/catalog/course.html?ID=#ELEMENT_ID#",    // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
                        "AJAX_MODE" => "N",    // Включить режим AJAX
                        "AJAX_OPTION_SHADOW" => "Y",    // Включить затенение
                        "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
                        "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
                        "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
                        "CACHE_TYPE" => "Y",    // Тип кеширования
                        "CACHE_TIME" => "3600",    // Время кеширования (сек.)
                        "CACHE_FILTER" => "Y",    // Кэшировать при установленном фильтре
                        "PREVIEW_TRUNCATE_LEN" => "",    // Максимальная длина анонса для вывода (только для типа текст)
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",    // Формат показа даты
                        "DISPLAY_PANEL" => "N",    // Добавлять в админ. панель кнопки для данного компонента
                        "SET_TITLE" => "N",    // Устанавливать заголовок страницы
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",    // Включать инфоблок в цепочку навигации
                        "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",    // Скрывать ссылку, если нет детального описания
                        "PARENT_SECTION" => "",    // ID раздела
                        "PARENT_SECTION_CODE" => "",    // Код раздела
                        "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
                        "DISPLAY_BOTTOM_PAGER" => "N",    // Выводить под списком
                        "PAGER_TITLE" => "",    // Название категорий
                        "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
                        "PAGER_TEMPLATE" => "",    // Название шаблона
                        "PAGER_DESC_NUMBERING" => "N",    // Использовать обратную навигацию
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "N",
                        "DISPLAY_PREVIEW_TEXT" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
                    ],
                );?>
                <div class="btn-set">
                    <button class="btn-load-more" type="button"></button>
                </div>
            </section>
            <section id="reviews" class="review-section">
                <h2 class="title">Отзывы участников</h2>
                <?php
                $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "reviews",
                    [
                        "DISPLAY_DATE" => "N",    // Выводить дату элемента
                        "DISPLAY_NAME" => "Y",    // Выводить название элемента
                        "DISPLAY_PICTURE" => "N",    // Выводить изображение для анонса
                        "DISPLAY_PREVIEW_TEXT" => "Y",    // Выводить текст анонса
                        "AJAX_MODE" => "Y",    // Включить режим AJAX
                        "IBLOCK_TYPE" => "ag_land",    // Тип информационного блока (используется только для проверки)
                        "IBLOCK_ID" => "146",    // Код информационного блока
                        "NEWS_COUNT" => "20",    // Количество новостей на странице
                        "SORT_BY1" => "ACTIVE_FROM",    // Поле для первой сортировки новостей
                        "SORT_ORDER1" => "DESC",    // Направление для первой сортировки новостей
                        "SORT_BY2" => "SORT",    // Поле для второй сортировки новостей
                        "SORT_ORDER2" => "ASC",    // Направление для второй сортировки новостей
                        "FILTER_NAME" => "",    // Фильтр
                        "FIELD_CODE" => [    // Поля
                            0 => "ID",
                            1 => "",
                        ],
                        "PROPERTY_CODE" => [    // Свойства
                            0 => "COURSE_NAME",
                            1 => "DESCRIPTION",
                            2 => "",
                        ],
                        "CHECK_DATES" => "Y",    // Показывать только активные на данный момент элементы
                        "DETAIL_URL" => "",    // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
                        "PREVIEW_TRUNCATE_LEN" => "",    // Максимальная длина анонса для вывода (только для типа текст)
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",    // Формат показа даты
                        "SET_TITLE" => "N",    // Устанавливать заголовок страницы
                        "SET_BROWSER_TITLE" => "N",    // Устанавливать заголовок окна браузера
                        "SET_META_KEYWORDS" => "N",    // Устанавливать ключевые слова страницы
                        "SET_META_DESCRIPTION" => "N",    // Устанавливать описание страницы
                        "SET_LAST_MODIFIED" => "N",    // Устанавливать в заголовках ответа время модификации страницы
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",    // Включать инфоблок в цепочку навигации
                        "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",    // Скрывать ссылку, если нет детального описания
                        "PARENT_SECTION" => "",    // ID раздела
                        "PARENT_SECTION_CODE" => "",    // Код раздела
                        "INCLUDE_SUBSECTIONS" => "N",    // Показывать элементы подразделов раздела
                        "CACHE_TYPE" => "A",    // Тип кеширования
                        "CACHE_TIME" => "3600",    // Время кеширования (сек.)
                        "CACHE_FILTER" => "Y",    // Кешировать при установленном фильтре
                        "CACHE_GROUPS" => "Y",    // Учитывать права доступа
                        "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
                        "DISPLAY_BOTTOM_PAGER" => "N",    // Выводить под списком
                        "PAGER_TITLE" => "Новости",    // Название категорий
                        "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
                        "PAGER_TEMPLATE" => "",    // Шаблон постраничной навигации
                        "PAGER_DESC_NUMBERING" => "N",    // Использовать обратную навигацию
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
                        "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
                        "PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
                        "SET_STATUS_404" => "N",    // Устанавливать статус 404
                        "SHOW_404" => "N",    // Показ специальной страницы
                        "MESSAGE_404" => "",    // Сообщение для показа (по умолчанию из компонента)
                        "PAGER_BASE_LINK" => "",
                        "PAGER_PARAMS_NAME" => "arrPager",
                        "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
                        "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
                        "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
                        "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
                        "COMPONENT_TEMPLATE" => ".default"
                    ],
                    false
                ); ?>
            </section>
        </main>
        <footer class="footer">© <?=date('Y')?> IBS Training Center</footer>
    </div>
    <ul class="social-links">
        <li><a class="vk" target="_blank"
               href="http://vkontakte.ru/share.php?&description=<?= rawurlencode(iconv("windows-1251", "UTF-8", "Luxoft Training: Курсы и тренинги для программистов, аналитиков, менеджеров проектов, тестировщиков.")) ?>&title=<?= rawurlencode(iconv("windows-1251", "UTF-8", $share_title)) ?>&url=<?= urlencode("http://ibs-training.ru" . $APPLICATION->GetCurDir()) ?>&noparse=false">vk</a>
        </li>
        <li><a class="twitter" target="_blank"
               href="https://twitter.com/share?&text=<?= rawurlencode(iconv("windows-1251", "UTF-8", $share_title)) ?>&url=<?= urlencode("http://ibs-training.ru" . $APPLICATION->GetCurDir()) ?>&redirect_uri=<?= urlencode("http://ibs-training.ru" . $APPLICATION->GetCurDir()) ?>">twitter</a>
        </li>
        <li><a class="linkedin" target="_blank"
               href="http://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode("http://ibs-training.ru" . $APPLICATION->GetCurDir()) ?>&title=<?= rawurlencode(iconv("windows-1251", "UTF-8", $share_title)) ?>&summary=<?= rawurlencode(iconv("windows-1251", "UTF-8", 'Luxoft Training: Курсы и тренинги для программистов, аналитиков, менеджеров проектов, тестировщиков.')) ?>">linkedin</a>
        </li>
    </ul>
    <span class="scroll-top"></span>
    <script src="/agile/js/vendor/jquery-1.11.2.min.js"></script>
    <script src="/agile/js/jquery.singlePageNav.min.js"></script>
    <script src="/agile/js/all.js"></script>
    </body>
    </html>
<? } ?>