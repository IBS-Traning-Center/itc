<?php
declare(strict_types=1);

namespace Luxoft\Dev\Controller;

use Bitrix\Main\Engine\Response\Json;
use Bitrix\Main\Error;
use Bitrix\Main\Engine\JsonController;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\ActionFilter\Authentication;
use Luxoft\Dev\Engine\Controller;
use Luxoft\Dev\Service\UnisenderService;

class FormController extends JsonController
{
    public function configureActions(): array
    {
        return [
            'sendSeminar' => [
                'prefilters' => []
            ],
            'addCertificationJavaRequest' => [
                '-prefilters' => [
                    Csrf::class,
                    Authentication::class,
                ]
            ],
            'addCertificationJavaSubscribe' => [
                '-prefilters' => [
                    Csrf::class,
                    Authentication::class,
                ]
            ],
        ];
    }

    public function addCertificationJavaRequestAction(
        $name,
        $phone,
        $email,
        $company = '',
        $level = '',
        $subscribe = false
    ) {
        $unisenderService = new UnisenderService();
        $resultId = $unisenderService->requestCertification($name, $email, $phone, $company, $level);

        switch ($level) {
            case 'advanced':
                $levelTranslate = 'Продвинутый';
                $clintSendEvent = 'IBS_CERTIFICATION_JAVA_REQUEST_ANSWER_PRO';
                break;
            case 'base':
            case 'default':
                $levelTranslate = 'Специалист';
                $clintSendEvent = 'IBS_CERTIFICATION_JAVA_REQUEST_ANSWER_BASE';
                break;
        }

        \CEvent::Send(
            $clintSendEvent,
            SITE_ID,
            [
                'FIO' => $name,
                'EMAIL' => $email,
            ],
            'N',
        );

        \CEvent::Send(
            'IBS_CERTIFICATION_REQUEST',
            SITE_ID,
            [
                'FIO' => $name,
                'PHONE' => $phone,
                'EMAIL' => $email,
                'COMPANY' => $company,
                'LEVEL' => $levelTranslate,
                'UNISENDER_ID' => $resultId,
            ],
            'N',
        );

        if ($subscribe) {
            $unisenderSubscribeService = new UnisenderService();
            $subscribeId = $unisenderSubscribeService->subscribeCertification($name, $email, $level);

            \CEvent::Send(
                'IBS_CERTIFICATION_SUBSCRIBE',
                SITE_ID,
                [
                    'FIO' => $name,
                    'EMAIL' => $email,
                    'LEVEL' => $levelTranslate,
                    'UNISENDER_ID' => $subscribeId,
                ],
                'N',
            );
        }
    }
    public function addCertificationJavaSubscribeAction($name, $email, $level)
    {
        $unisenderService = new UnisenderService();
        $resultId = $unisenderService->subscribeCertification($name, $email, $level);

        if (!$resultId) {
            $this->addError(new Error('Не удалось подписать на рассылку'));
            return null;
        }

        switch ($level) {
            case 'advanced':
                $levelTranslate = 'Продвинутый';
                break;
            case 'base':
            case 'default':
                $levelTranslate = 'Специалист';
                break;
        }

        \CEvent::Send(
            'IBS_CERTIFICATION_SUBSCRIBE',
            SITE_ID,
            [
                'FIO' => $name,
                'EMAIL' => $email,
                'LEVEL' => $levelTranslate,
                'UNISENDER_ID' => $resultId,
            ],
            'N',
        );
    }
}