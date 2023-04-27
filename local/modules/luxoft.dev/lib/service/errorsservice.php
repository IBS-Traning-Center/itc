<?php
declare(strict_types=1);

namespace Luxoft\Dev\Service;

use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\Application;

class ErrorsService
{
    protected $request;
    protected $server;

    public function __construct()
    {
        Loader::includeModule('highloadblock');
        $application = Application::getInstance();
        $this->request = $application->getContext()->getRequest();
        $this->server = $application->getContext()->getServer();
    }

    public function botDetected()
    {
        return (
            $this->server->get('HTTP_USER_AGENT')
            && preg_match('/bot|crawl|slurp|spider|mediapartners/i', $this->server->get('HTTP_USER_AGENT'))
        );
    }

    public function add($type, $path, $context = [])
    {
        global $USER;
        if ($isRobot = $this->botDetected()) {
            return 0;
        }

        \CStatistic::Set_Event('error', $type, '', $path);

        $entity = HighloadBlockTable::compileEntity('errors');
        $errorClass = $entity->getDataClass();
        $errorId = $errorClass::add([
            'UF_IS_ROBOT' => $isRobot,
            'UF_USER_ID' => $USER->GetID(),
            'UF_CLIENT_ID_YANDEX' => $this->request->getCookieRaw('_ym_uid'),
            'UF_CLIENT_ID_GOOGLE' => $this->request->getCookieRaw('_ga'),
            'UF_DATE' => new DateTime(),
            'UF_TYPE' => $type,
            'UF_PATH' => $path,
            'UF_DESCRIPTION' => var_export($context, true)
        ]);

        return $errorId;
    }
}