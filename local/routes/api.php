<?php
declare(strict_types=1);
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin, Authorization');

define('NO_KEEP_STATISTIC', true);
define('PUBLIC_AJAX_MODE', true);
define('STOP_STATISTICS', true);
define('NO_AGENT_STATISTIC', true);
define('NO_AGENT_CHECK', true);

use Bitrix\Main\Application;
use Bitrix\Main\Routing\RoutingConfigurator;
use Luxoft\Dev\Controller\CertificationController;
use Luxoft\Dev\Service\ErrorsService;
use Luxoft\Dev\Enum\ErrorsEnum;

use Luxoft\Dev\Controller\ToolsController;
use Luxoft\Dev\Controller\FormController;
use Luxoft\Dev\Service\PageHomeService;

return function (RoutingConfigurator $routes) {
    $routes->prefix('api')->group(function (RoutingConfigurator $routes) {
        $routes->any('errors/add/', function () {
            $postData = file_get_contents('php://input');
            $data = json_decode($postData, true);
            $errorsService = new ErrorsService();
            $errorsService->add(
                ErrorsEnum::ERROR_JS,
                $data['url'],
                [
                    'line' =>   $data['line'],
                    'col' =>    $data['col'],
                    'msg' =>    $data['msg'],
                ]
            );
        });
        $routes->prefix('form')->group(function (RoutingConfigurator $routes) {
            $routes->prefix('certification')->group(function (RoutingConfigurator $routes) {
                $routes->prefix('java')->group(function (RoutingConfigurator $routes) {
                    $routes->any('request/', [FormController::class, 'addCertificationJavaRequestAction']);
                    $routes->any('subscribe/', [FormController::class, 'addCertificationJavaSubscribeAction']);
                });
            });
        });
        $routes->any('frdo/', function () {});
        $routes->any('session/', function () {});
        $routes->any('subscribe/', function () {});
        $routes->any('school/', function () {});
        $routes->any('userOrder/', function () {});
        $routes->any('downloadsContactsByCategory/', [ToolsController::class, 'downloadsContactsByCategory']);
        $routes->any('downloadsCatalogPdf/', [ToolsController::class, 'getCatalogPdf']);

        $routes->prefix('home')->group(function (RoutingConfigurator $routes) {
            $routes->any('getSlides/', function () {
                $pageHomeService = new PageHomeService();
                $result = $pageHomeService->getSlides();
                if (!$result->isSuccess()) {
                    return [];
                }
                return $result->getData();
            });
            $routes->any('getServices/', function () {
                $pageHomeService = new PageHomeService();
                $result = $pageHomeService->getServices();
                if (!$result->isSuccess()) {
                    return [];
                }
                return $result->getData();
            });
            $routes->any('getCourses/', function () {
                $pageHomeService = new PageHomeService();
                $result = $pageHomeService->getCourses();
                if (!$result->isSuccess()) {
                    return [];
                }
                return $result->getData();
            });
            $routes->any('getDirections/', function () {
                $pageHomeService = new PageHomeService();
                $result = $pageHomeService->getDirections();
                if (!$result->isSuccess()) {
                    return [];
                }
                return $result->getData();
            });
            $routes->any('getArticles/', function () {
                $pageHomeService = new PageHomeService();
                $result = $pageHomeService->getArticles();
                if (!$result->isSuccess()) {
                    return [];
                }
                return $result->getData();
            });
        });

        $routes->prefix('certification')->group(function (RoutingConfigurator $routes) {
            $routes->post('question/',         [CertificationController::class, 'questionAction']);
            $routes->get('list/{code}/',       [CertificationController::class, 'getListAction']);
            $routes->post('request/{code}/',   [CertificationController::class, 'addRequestAction']);
            $routes->post('subscribe/{code}/', [CertificationController::class, 'addSubscribeAction']);
        });
    });
};