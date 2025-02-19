<?php

use Bitrix\Main\Application;
use Bitrix\Main\Page\Asset;
use Luxoft\Dev\Service\ErrorsService;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $USER;

Asset::getInstance()->addCss('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap');
Asset::getInstance()->addCss('/local/assets/css/styles.css');
Asset::getInstance()->addCss('/local/assets/css/font-awesome.min.css');
Asset::getInstance()->addCss('/local/assets/libs/jquery-ui/jquery-ui.min.css');
Asset::getInstance()->addCss('/local/assets/css/summer_discount.css');
Asset::getInstance()->addCss('/local/assets/css/jquery.formstyler.css');
Asset::getInstance()->addCss('/local/assets/libs/slick/slick.css');
Asset::getInstance()->addCss('/local/assets/libs/slick/slick-theme.css');
Asset::getInstance()->addCss('/local/assets/libs/fancybox/jquery.fancybox.min.css');
Asset::getInstance()->addCss('/local/assets/libs/highlight.js/efault.min.css');
Asset::getInstance()->addCss('/local/assets/css/2020_style.css');

Asset::getInstance()->addJs('/local/assets/js/targetEvents.js');

Asset::getInstance()->addJs('/local/assets/libs/jquery-ui/jquery-ui.min.js');
Asset::getInstance()->addJs('/local/assets/libs/jquery.formstyler.min.js');
Asset::getInstance()->addJs('/local/assets/libs/jquery.masonry.min.js');
Asset::getInstance()->addJs('/local/assets/libs/fancybox/jquery.fancybox.min.js');
Asset::getInstance()->addJs('/local/assets/libs/jquery.validate/jquery.validate.min.js');
Asset::getInstance()->addJs('/local/assets/libs/jquery.validate/additional-methods.min.js');
Asset::getInstance()->addJs('/local/assets/libs/stickyjs.js');
Asset::getInstance()->addJs('/local/assets/libs/slick/slick.min.js');
Asset::getInstance()->addJs('/local/assets/libs/highlight.js/highlight.min.js');
Asset::getInstance()->addJs('/local/assets/libs/inputmask/jquery.inputmask.js');
Asset::getInstance()->addJs('/local/assets/js/all.js');
Asset::getInstance()->addJs('/local/assets/js/reg_form_fix.js');
Asset::getInstance()->addJs('/local/assets/js/2020_script.js');
Asset::getInstance()->addJs('/local/assets/js/form.js');

Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/script.js');
Asset::getInstance()->addJs( '/local/runtime/script.js');
Asset::getInstance()->addJs( '/local/vendors/script.js');

$application = Application::getInstance();
$request = $application->getContext()->getRequest();
?><!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="yandex-verification" content="a63abf59d6bf064e"/>
    <meta name="yandex-verification" content="8f50c1eeeb059b18"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <meta name=viewport content="width=device-width">
    <link rel="canonical" href="https://ibs-training.ru<?=$APPLICATION->GetCurPage();?>">
    <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#003979">
    <meta name="theme-color" content="#ffffff">
    <title>
        <? ShowCustomTitle('title');
        $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumb_for_header", array(
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => "en"
        ),
            $component,
            array("HIDE_ICONS" => "Y")
        ); ?></title>
    <?php
    $APPLICATION->ShowMeta("robots");
    $APPLICATION->ShowMeta("keywords");
    $APPLICATION->ShowMeta("description");
    $APPLICATION->ShowCSS();
    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();

    $errorsService = new ErrorsService();
    if (!$errorsService->botDetected()) {?>
        <script data-skip-moving="true">
            "use strict";
            //Сохранение ошибок JavaScript
            window.onerror = function (msg, url, line, col, exception) {
                var request = new XMLHttpRequest();
                //request.open('Post', '/api/errors/add/');
                request.open('Post', '/ajax/error-js-log.php');
                request.setRequestHeader( 'Content-Type', 'application/json' );
                request.send(JSON.stringify({
                    msg: msg,
                    exception: exception,
                    url: url,
                    line: line,
                    col: col
                }));
            }
        </script>
    <?php }?>
    <script data-skip-moving="true" src="/static/libs/modernizr.js"></script>
    <script data-skip-moving="true" src="/static/libs/jquery.js"></script>
    <meta name="yandex-verification" content="5d503f9f5bb0b3f6" />

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
        ga('require', 'displayfeatures');
        ga('send', 'pageview');
    </script>
    <!--  nootisend  -->
    <script charset='utf-8' src='https://cdn.pushdealer.com/5bd629bc/script_0.js' async></script>
</head>
<body>
<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(23056159, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, ecommerce:"dataLayer" }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/23056159" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
<?php
if ($USER->IsAdmin()) {
    $APPLICATION->ShowPanel();
}?>
<? CModule::IncludeModule("sale");
$cntBasketItems = CSaleBasket::GetList(
    array(),
    array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => SITE_ID,
        "ORDER_ID" => "NULL",
        "CAN_BUY" => "Y"
    ),
    array()
); ?>
<header id="header" class="header">
    <div class="header__box _main">
        <a href="/" class="header__logo">
            <img class="header__logo-image" src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo_gradient.svg" alt="IBS Training Logo">
        </a>
        <div class="header__main">
            <div class="header__navigation">
                <?php
                //TODO вынести в компонент меню
                ?>
                <nav class="navigation">
                    <ul class="navigation__list">
                        <li class="navigation__item">
                            <a href="/training/katalog_kursov/" class="navigation__link">Каталог</a>
                        </li>
                        <li class="navigation__item">
                            <a href="/timetable/" class="navigation__link">Расписание</a>
                        </li>
                        <li class="navigation__item">
                            <a href="/corporate/" class="navigation__link">Корпоративное обучение</a>
                        </li>
                        <li class="navigation__item">
                            <a href="/testing/" class="navigation__link">Оценка персонала</a>
                        </li>
                        <li class="navigation__item">
                            <a href="/certification/" class="navigation__link">Сертификация</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="header__controls">
                <div class="header__control _search"></div>
                <a href="/contacts/" class="header__control _callback">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <path fill="#56a6fd" d="M485.743,85.333H26.257C11.815,85.333,0,97.148,0,111.589V400.41c0,14.44,11.815,26.257,26.257,26.257h459.487
                                c14.44,0,26.257-11.815,26.257-26.257V111.589C512,97.148,500.185,85.333,485.743,85.333z M475.89,105.024L271.104,258.626
                                c-3.682,2.802-9.334,4.555-15.105,4.529c-5.77,0.026-11.421-1.727-15.104-4.529L36.109,105.024H475.89z M366.5,268.761
                                l111.59,137.847c0.112,0.138,0.249,0.243,0.368,0.368H33.542c0.118-0.131,0.256-0.23,0.368-0.368L145.5,268.761
                                c3.419-4.227,2.771-10.424-1.464-13.851c-4.227-3.419-10.424-2.771-13.844,1.457l-110.5,136.501V117.332l209.394,157.046
                                c7.871,5.862,17.447,8.442,26.912,8.468c9.452-0.02,19.036-2.6,26.912-8.468l209.394-157.046v275.534L381.807,256.367
                                c-3.42-4.227-9.623-4.877-13.844-1.457C363.729,258.329,363.079,264.534,366.5,268.761z"/>
                    </svg>
                </a>
                <div class="header__control _nav">
                    <svg preserveAspectRatio="xMinYMin slice" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 612 612"
                         style="enable-background:new 0 0 612 612;" xml:space="preserve">
                            <path fill="#1D427D" class="st0" d="M604.3,194.7c4.3,0,7.7-3.6,7.7-7.7v-40.2c0-4.3-3.3-7.7-7.7-7.7H7.7c-4.3,0-7.7,3.6-7.7,7.7V187
                                c0,4.3,3.3,7.7,7.7,7.7L604.3,194.7L604.3,194.7z"></path>
                        <path fill="#1D427D" class="st0" d="M0,326.1c0,4.3,3.3,7.7,7.7,7.7h596.5c4.3,0,7.7-3.6,7.7-7.7v-40.2c0-4.3-3.3-7.7-7.7-7.7H7.7
                                c-4.3,0-7.7,3.6-7.7,7.7V326.1z"></path>
                        <path fill="#1D427D" class="st0" d="M0,465.2c0,4.3,3.3,7.7,7.7,7.7h596.5c4.3,0,7.7-3.6,7.7-7.7V425c0-4.3-3.3-7.7-7.7-7.7H7.7
                                c-4.3,0-7.7,3.6-7.7,7.7V465.2z"></path>
                        </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="header__box _search" style="display: none">
        <div class="search container">
            <div class="search__form search-more-wrap search-wrapper">
                <form action="/search/">
                    <input autocomplete="off" type="text" id="search-text" name="q"
                           placeholder="Какое обучение вы ищете?" class="search-main">
                    <input type="submit" value="" name="submit">
                </form>
                <div id="search-dropdown">
                    <? $APPLICATION->IncludeComponent("luxoft:search.title", "search-right-form", array(
                        "NUM_CATEGORIES" => "3",
                        "TOP_COUNT" => "5",
                        "ORDER" => "rank",
                        "USE_LANGUAGE_GUESS" => "N",
                        "CHECK_DATES" => "N",
                        "SHOW_OTHERS" => "N",
                        "PAGE" => "/search/",
                        "CATEGORY_0_TITLE" => "Курсы",
                        "CATEGORY_0" => array(
                            0 => "iblock_edu",
                        ),
                        "CATEGORY_0_iblock_edu" => array(
                            0 => "6",
                        ),
                        "CATEGORY_1_TITLE" => "Тренеры",
                        "CATEGORY_1" => array(
                            0 => "iblock_edu",
                        ),
                        "CATEGORY_1_iblock_edu" => array(
                            0 => "56",
                        ),
                        "CATEGORY_2_TITLE" => "Блоги",
                        "CATEGORY_2" => array(
                            0 => "iblock_edu",
                        ),
                        "CATEGORY_2_iblock_edu" => array(
                            0 => "23",
                        ),
                        "SHOW_INPUT" => "N",
                        "INPUT_ID" => "search-text",
                        "CONTAINER_ID" => "search-dropdown"
                    ),
                        false
                    ); ?>
                </div>
            </div>
            <div class="search-phrase">
                <?php
                if (false) { ?>
                    <div class="search-phrase__label">Популярные запросы</div>
                <?php } ?>
                <ul class="search-phrase__list">
                    <li class="search-phrase__item">
                        <a href="/timetable/?type=events" class="search-phrase__link">Бесплатные семинары</a>
                    </li>
                    <li class="search-phrase__item">
                        <a href="/training/katalog_kursov/arkhitektura-po/" class="search-phrase__link">Архитектура ПО</a>
                    </li>
                    <li class="search-phrase__item">
                        <a href="/training/katalog_kursov/razrabotka_po_java/" class="search-phrase__link">Java</a>
                    </li>
                    <li class="search-phrase__item">
                        <a href="/training/katalog_kursov/razrabotka_po_web/" class="search-phrase__link">Web</a>
                    </li>
                    <li class="search-phrase__item">
                        <a href="/training/katalog_kursov/razrabotka_po_net/" class="search-phrase__link">.Net</a>
                    </li>
                    <li class="search-phrase__item">
                        <a href="/training/katalog_kursov/avtomatizirovannoe-i-nagruzochnoe-testirovanie/"
                           class="search-phrase__link">QA Automation</a>
                    </li>
                    <li class="search-phrase__item">
                        <a href="/training/katalog_kursov/sovremennye-metody-upravleniya-dannymi-bigdata-ml/"
                           class="search-phrase__link">Big Data</a>
                    </li>
                    <li class="search-phrase__item">
                        <a href="/training/katalog_kursov/biznes-analiz/" class="search-phrase__link">Бизнес-анализ</a>
                    </li>
                    <li class="search-phrase__item">
                        <a href="/training/katalog_kursov/sistemnyy-analiz/" class="search-phrase__link">Системный
                            анализ</a>
                    </li>
                    <li class="search-phrase__item">
                        <a href="/search/?q=UML" class="search-phrase__link">UML</a>
                    </li>
                    <li class="search-phrase__item">
                        <a href="/search/?q=BPMN" class="search-phrase__link">BPMN</a>
                    </li>
                    <li class="search-phrase__item">
                        <a href="/training/katalog_kursov/devops-i-administrirovanie/" class="search-phrase__link">DevOps</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
<div class="hidden-menu" style="display: none">
    <div class="hidden-menu-header">
        <?php
        $arGroups = CUser::GetUserGroup($USER->GetID());
        if (!$USER->IsAuthorized()) { ?>
            <a href="/personal_test/" class="two-links">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512.2 480">
                    <path fill="#fff" class="cls-1"
                          d="M64.2,30v98h32V51c0-11.3,5.9-19,17-19h350c10.7,0,17,7.7,17,19V429c0,12.3-6.7,19-19,19h-346c-12.3,0-19-6.7-19-19V352h-32v98c0,16,15.8,30,29,30h390c13.2,0,29-13.9,29-30V30c0-15.8-15.8-30-28-30H94.2C78.7,0,64.2,14.6,64.2,30Z"></path>
                    <path fill="#fff" class="cls-1"
                          d="M288.1,111c0,10,3.5,11,10.7,18.2l13.5,13.5c10.4,10.4,77.4,76.2,80.7,81.2l-380.8.2C4.4,225.4.3,231.9,0,238.8v1.8c.3,6.6,4.1,13,11.4,14.9,5.3,1.4,372.8.4,381.5.4-3.4,5-81,81.5-93.7,94.2-7.4,7.4-11.2,8.6-11.2,18.7,0,9,6.5,15,16,15,9.7,0,15.9-9.4,21.2-14.7l108-108c6.4-6.4,14.7-11.2,14.7-22.2,0-8.8-25.9-31.4-32.7-38.2l-35.5-35.5-53.5-53.5C317.7,103.2,314.1,96,303,96A14.71,14.71,0,0,0,288.1,111Z"></path>
                </svg>
            </a>
        <?php } elseif (in_array(1, $arGroups) || in_array(34, $arGroups)) { ?>
            <div class="two-links">
                <a href="/personal/cart/">Корзина <span class="basket-count"><?= $cntBasketItems ?></span></a>
                <br>
                <a class="bonuses" href="/personal_test/bonuses/">Бонусы</a>
            </div>
        <?php } else { ?>
            <div class="two-links">
                <a href="/personal_test/"><?= $USER->GetFullName() ?></a>
            </div>
        <?php } ?>
        <a href="javascript:void(0)" class="close-menu">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                 y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
                <path fill="#ffffff"
                      d="M538.7,500L981.9,56.8c10.8-10.8,10.8-27.9,0-38.7c-10.8-10.8-27.9-10.8-38.7,0L500,461.3L56.8,18.1C46,7.3,28.9,7.3,18.1,18.1S7.3,46,18.1,56.8L461.3,500L18.1,943.2c-10.8,10.8-10.8,27.9,0,38.7c10.8,10.8,27.9,10.8,38.7,0L500,538.7l443.2,443.2c10.8,10.8,27.9,10.8,38.7,0c10.8-10.8,10.8-27.9,0-38.7L538.7,500z"/>
            </svg>
        </a>
    </div>
    <?php
    //TODO вынести в компонент меню
    ?>
    <div class="menu-addit-main">
        <ul class="first-menu-addit">
            <li><a href="/training/katalog_kursov/">Каталог</a></li>
            <li><a href="/timetable/">Расписание</a></li>
            <li><a href="/corporate/">Корпоративное обучение</a></li>
            <li><a href="/testing/">Оценка персонала</a></li>
            <li><a href="/timetable/?type=events">Бесплатные семинары</a></li>
            <li><a href="/certification/">Сертификация</a></li>
        </ul>
    </div>
    <div class="menu-addit-second">
        <ul class="first-menu-addit">
            <li><a href="/educational-information/">Сведения об образовательной организации</a></li>
            <li><a href="/about/news/">Блог </a></li>
            <li><a href="/talent-search/">Стань тренером</a></li>
            <li><a href="/contacts/">Контакты</a></li>
        </ul>
    </div>
</div>
<main class="page _content">
    <? if (
    $APPLICATION->GetCurDir() != "/frdo-form/"
    && $_SERVER['REAL_FILE_PATH'] !== '/frdo-form/detail.php'
    && $APPLICATION->GetCurDir() != "/talent-search/"
    && $APPLICATION->GetCurDir() != "/"
    && $APPLICATION->GetProperty("DONT_SHOW_PAGE_TOP") != "Y"
    && "ERROR_404" != "Y"
    ) { ?>
    <section class="bg-main-wrap"
             style="background: url('/local/assets/images/bg-b_dark.png') bottom;     background-color: #083056; background-size: cover;">
        <div class="frame">
            <? $APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "bread",
                array(
                    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                ),
                false
            ); ?>
            <div class="clearfix heading-white">
                <? @$blue_title = $APPLICATION->GetPageProperty("blue_title"); ?>
                <h1><? ShowCustomTitle('blue_title'); ?></h1>
            </div>
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                ".default",
                array(
                    "AREA_FILE_SHOW" => "page",
                    "AREA_FILE_SUFFIX" => "highlightnew_2017",
                    "EDIT_TEMPLATE" => "page_hightlight_new_2017.php"
                ),
                false
            ); ?>
        </div>
    </section>
    <section class="not-main-page" id="middle-content">
        <div class="frame overflow-hidden no-top-padding clearfix">
            <? if ($APPLICATION->GetProperty("SHOW_FULL_PAGE") != "Y") { ?>
                <div class="menu-small-wrap">
                    <a class="menu-switcher" href="#"></a>
                    <? $APPLICATION->IncludeComponent("bitrix:menu", "right-menu", array(
                            "ROOT_MENU_TYPE" => "left",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "left",
                            "USE_EXT" => "Y"
                        )
                    ); ?>
                </div>
            <? } ?>
            <div class="one-big-wrap <? if ($APPLICATION->GetProperty("SHOW_FULL_PAGE") == "Y") { ?>no-margin<? } ?>">
                <? } ?>