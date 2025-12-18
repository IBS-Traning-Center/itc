<?php

use Bitrix\Main\Application;
use Bitrix\Main\Page\Asset;
use Luxoft\Dev\Service\ErrorsService;
use Local\Util\Functions;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $USER;

// Подключение шрифта Noto Sans
Asset::getInstance()->addString('<link rel="preconnect" href="https://fonts.googleapis.com">');
Asset::getInstance()->addString('<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>');
Asset::getInstance()->addString('<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">');

Asset::getInstance()->addCss('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap');
Asset::getInstance()->addCss('https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap');
Asset::getInstance()->addCss('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
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
<!-- Marquiz script start -->
<script>
(function(w, d, s, o){
  var j = d.createElement(s); j.async = true; j.src = '//script.marquiz.ru/v2.js';j.onload = function() {
    if (document.readyState !== 'loading') Marquiz.init(o);
    else document.addEventListener("DOMContentLoaded", function() {
      Marquiz.init(o);
    });
  };
  d.head.insertBefore(j, d.head.firstElementChild);
})(window, document, 'script', {
    host: '//quiz.marquiz.ru',
    region: 'ru',
    id: '6862451bdb66eb00185dbcc2',
    autoOpen: false,
    autoOpenFreq: 'once',
    openOnExit: false,
    disableOnMobile: false
  }
);
</script>
<!-- Marquiz script end -->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="yandex-verification" content="e0363bd7fb634c51"/>
    <meta name="skill2go-school-confirmation-token" content="UIj8-QgobjZZfMTIvkuP_hvLDmJDs7Ta"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <meta name=viewport content="width=device-width">
    <link rel="canonical" href="https://ibs-training.ru<?=$APPLICATION->GetCurPage();?>">
    <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon16.png">
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

    <!--  nootisend  -->
    <script charset='utf-8' src='https://cdn.pushdealer.msndr.net/5bd629bc/script_0.js' async></script>
    <script>
        if (window.innerWidth > 1180) {
            document.querySelector("meta[name=viewport]").setAttribute('content', 'width=device-width, initial-scale='+(1/window.devicePixelRatio));
        }
    </script>
</head>
<body>
<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(23056159, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, ecommerce:"dataLayer" }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/23056159" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
<?php  $APPLICATION->ShowPanel();?>
<?php CModule::IncludeModule("sale");
$cntBasketItems = CSaleBasket::GetList(
    [],
    [
        'FUSER_ID' => CSaleBasket::GetBasketUserID(),
        'LID' => SITE_ID,
        'ORDER_ID' => 'NULL',
        'CAN_BUY' => 'Y'
    ],
    []
); ?>
<header id="header" class="header">
    <div class="header-container">
        <a href="/" class="logo-block">
            <?= Functions::buildSVG('main_logo', SITE_TEMPLATE_PATH. '/assets/images') ?>
        </a>
        <div class="search-header-block">
            <form action="/search/" class="search-header-form">
                <button type="submit" class="search-header-button">
                    <?= Functions::buildSVG('search_button', SITE_TEMPLATE_PATH . '/assets/images') ?>
                </button>
                <input
                        id="search-text-header"
                        class="search-main"
                        type="text"
                        placeholder="Найти курсы"
                >
            </form>
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
    <div class="search-hidden-block">
        <div class="search-block">
            <form action="/search/">
                <button type="submit">
                    <?= Functions::buildSVG('search_button', SITE_TEMPLATE_PATH. '/assets/images') ?>
                </button>
                <input autocomplete="off" type="text" id="search-text" name="q" placeholder="Найти" class="search-main">
                <button type="reset" id="search-reset">
                    <?= Functions::buildSVG('clear-search-input', SITE_TEMPLATE_PATH. '/assets/images') ?>
                </button>
            </form>
            <button class="close-search-block">
                <span class="f-16">Закрыть</span>
            </button>
        </div>
        <div id="search-dropdown">
            <?php $APPLICATION->IncludeComponent(
                'luxoft:search.title',
                'search-right-form',
                [
                    'NUM_CATEGORIES' => '3',
                    'TOP_COUNT' => '5',
                    'ORDER' => 'rank',
                    'USE_LANGUAGE_GUESS' => 'N',
                    'CHECK_DATES' => 'N',
                    'SHOW_OTHERS' => 'N',
                    'PAGE' => '/search/',
                    'CATEGORY_0_TITLE' => 'Курсы',
                    'CATEGORY_0' => [
                        0 => 'iblock_edu',
                    ],
                    'CATEGORY_0_iblock_edu' => [
                        0 => '6',
                    ],
                    'CATEGORY_1_TITLE' => 'Тренеры',
                    'CATEGORY_1' => [
                        0 => 'iblock_edu',
                    ],
                    'CATEGORY_1_iblock_edu' => [
                        0 => '56',
                    ],
                    'CATEGORY_2_TITLE' => 'Блоги',
                    'CATEGORY_2' => [
                        0 => 'iblock_edu',
                    ],
                    'CATEGORY_2_iblock_edu' => [
                        0 => '23',
                    ],
                    'SHOW_INPUT' => 'N',
                    'INPUT_ID' => 'search-text',
                    'CONTAINER_ID' => 'search-dropdown'
                ],
                false
            ); ?>
        </div>
    </div>
</header>

<main class="page _content">
