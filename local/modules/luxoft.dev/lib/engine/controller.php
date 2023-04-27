<?php

namespace Luxoft\Dev\Engine;

use Bitrix\Main\Error;

use Bitrix\Main\Request;
use Bitrix\Main\Web\Json;
use Bitrix\Main\Web\PostDecodeFilter;
use Bitrix\Main\Engine\Controller as BitrixController;

class Controller extends BitrixController
{
    const STATUS_SUCCESS      = 'success';
    const STATUS_DENIED       = 'denied';
    const STATUS_ERROR        = 'error';
    const STATUS_NEED_AUTH    = 'need_auth';
    const STATUS_INVALID_SIGN = 'invalid_sign';
    const STATUS_RESTRICTION  = 'restriction';

    /** @var string */
    protected $action;
    /** @var  array */
    protected $actionDescription;
    /** @var  string */
    protected $realActionName;

    function __construct(Request $request = null)
    {
        parent::__construct($request);
    }


    /**
     * Terminates controller and application.
     * This method replaces "die()" or "exit()" and ensures life cycle of application.
     * @return void
     */
    protected function end()
    {
        /** @noinspection PhpUndefinedClassInspection */
        \CMain::finalActions();
        die;
    }

    /**
     * Sends JSON response and terminates controller.
     * @param mixed $response
     * @param null|array $params
     * @return void
     */
    protected function sendJsonResponse($response, $params = null)
    {
        if(!defined('PUBLIC_AJAX_MODE'))
        {
            define('PUBLIC_AJAX_MODE', true);
        }

        global $APPLICATION;
        $APPLICATION->restartBuffer();

        if(!empty($params['http_status']) && $params['http_status'] == 403)
        {
            header('HTTP/1.0 403 Forbidden', true, 403);
        }
        if(!empty($params['http_status']) && $params['http_status'] == 500)
        {
            header('HTTP/1.0 500 Internal Server Error', true, 500);
        }
        if(!empty($params['http_status']) && $params['http_status'] == 510)
        {
            header('HTTP/1.0 510 Not Extended', true, 510);
        }

        header('Content-Type:application/json; charset=UTF-8');
        echo Json::encode($response);

        $this->end();
    }

    /**
     * Sends JSON response with status "error" and with errors and terminates controller.
     * @return void
     */
    protected function sendJsonErrorResponse()
    {
        $errors = array();
        foreach($this->getErrors() as $error)
        {
            /** @var Error $error */
            $errors[] = array(
                'message' => $error->getMessage(),
                'code' => $error->getCode(),
            );
        }
        unset($error);
        $this->sendJsonResponse(
            ['status' => self::STATUS_ERROR, 'errors' => $errors],
            ['http_status' => 500]
        );
    }

    /**
     * Sends JSON response with status "success" and mixed data, and terminates controller.
     * @param array $response Data to response.
     * @return void
     */
    protected function sendJsonSuccessResponse(array $response = array())
    {
        $response['status'] = self::STATUS_SUCCESS;
        $this->sendJsonResponse($response);
    }
}