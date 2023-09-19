<?php
declare(strict_types=1);

use Bitrix\Main\Routing\RoutingConfigurator;
use Bitrix\Main\Routing\Controllers\PublicPageController;
use Luxoft\Dev\Service\YandexFeedService;
use Luxoft\Dev\Service\HabrFeedService;
use Bitrix\Main\Grid\Options as GridOptions;

return function (RoutingConfigurator $routes) {
    //$routes->get('/kurs/', new PublicPageController('/local/pages/kurs.php'));

    $routes->prefix('feed')->group(function (RoutingConfigurator $routes) {
        $routes->get('yandex_v1-2/', function () {
            define('BX_SESSION_ID_CHANGE', false);
            define('BX_SKIP_POST_UNQUOTE', true);
            define('NO_AGENT_CHECK', true);
            define("STATISTIC_SKIP_ACTIVITY_CHECK", true);
            define("BX_FORCE_DISABLE_SEPARATED_SESSION_MODE", true);
            header("Content-Type: application/xml; charset=utf-8");

            $yandexFeedService = new YandexFeedService();
            $xmlString = $yandexFeedService->getXml();
            return $xmlString;
        });
    });

    $routes->prefix('feed')->group(function (RoutingConfigurator $routes) {
        $routes->get('habr_v1-1/', function () {
            define('BX_SESSION_ID_CHANGE', false);
            define('BX_SKIP_POST_UNQUOTE', true);
            define('NO_AGENT_CHECK', true);
            define("STATISTIC_SKIP_ACTIVITY_CHECK", true);
            define("BX_FORCE_DISABLE_SEPARATED_SESSION_MODE", true);
            header("Content-Type: application/xml; charset=utf-8");

            $habrFeedService = new HabrFeedService();
            $xmlString = $habrFeedService->getXml();
            return $xmlString;
        });
    });

    $routes->prefix('tests')->group(function (RoutingConfigurator $routes) {
        $routes->get('test1/', function () {
            $gridOptions = new GridOptions('test1');
            return $gridOptions->getUsedColumns();
        });
    });

    $routes->get('/orders-sap/', function () {
        global $APPLICATION;
        $APPLICATION->setTitle('Заказы SAP');
        $APPLICATION->SetPageProperty("SHOW_FULL_PAGE", "Y");
        //$APPLICATION->SetPageProperty("DONT_SHOW_PAGE_TOP", "Y");
        require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
        $APPLICATION->IncludeComponent(
            'luxoft:orders.sap',
            ''
        );
        require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
    });

    $routes->get('/email-timetable/', function () {
        global $APPLICATION;
        $APPLICATION->setTitle('Расписание курсов');
        require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
        $APPLICATION->IncludeComponent('luxoft:email.timetable', '');
        require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
    });
};



