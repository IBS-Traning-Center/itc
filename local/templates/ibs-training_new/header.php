<?php

use Bitrix\Main\Application;
use Bitrix\Main\Page\Asset;
use Luxoft\Dev\Service\ErrorsService;
use Local\Util\Functions;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $USER;

Asset::getInstance()->addCss('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap');
Asset::getInstance()->addCss('/local/assets/css/base.css');
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
Asset::getInstance()->addCss('/local/assets/css/new_style.css');

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
?>
<!DOCTYPE html>
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
    $APPLICATION->ShowHead();

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
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-N8N8SHJ');</script>
    <!-- End Google Tag Manager -->

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
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N8N8SHJ" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
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
    <div class="header-container">
        <a href="/" class="logo-block">
            <?= Functions::buildSVG('main_logo', SITE_TEMPLATE_PATH. '/assets/images') ?>
        </a>
        <div class="search-header-block">
            <form action="/search/">
                <button type="submit">
                    <?= Functions::buildSVG('search_button', SITE_TEMPLATE_PATH. '/assets/images') ?>
                </button>
                <input autocomplete="off" type="text" id="search-text" name="q" placeholder="Искать курсы" class="search-main">
            </form>
            <div id="search-dropdown">
                <?php $APPLICATION->IncludeComponent("luxoft:search.title", "search-right-form", array(
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
        <?php $APPLICATION->IncludeComponent(
            'bitrix:menu',
            'main.top.menu',
            [
                'ROOT_MENU_TYPE' => 'top',
                'MAX_LEVEL' => '1',
                'CHILD_MENU_TYPE' => 'top',
                'USE_EXT' => 'Y'
            ]
        ); ?>
    </div>
</header>

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
