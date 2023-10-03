<?php
declare(strict_types=1);

namespace Luxoft\Dev\Controller;

use Bitrix\Main\Engine\JsonController;
use Bitrix\Main\Loader;
use Bitrix\Main\Error;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\ActionFilter\Authentication;
use Bitrix\Main\Engine\ActionFilter\Cors;
use Bitrix\Iblock\Elements\ElementCertificationLastTable;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\Engine\ActionFilter\ContentType;
use Luxoft\Dev\Service\UnisenderService;

use Luxoft\Dev\Table\LocationTable;
use Luxoft\Dev\Table\CertificationTypeTable;
use Luxoft\Dev\Table\CertificationLevelTable;

use Bitrix\Catalog\PriceTable;
use Bitrix\Iblock\Elements\ElementCertificationTable;
use Bitrix\Iblock\Elements\ElementScheduleCertificationTable;
require_once($_SERVER['DOCUMENT_ROOT']. "/local/lib/bitrix24.rest/CRest.php");
require_once($_SERVER['DOCUMENT_ROOT']. "/local/lib/noti/ApiClient.php");




class CertificationController extends JsonController
{
    public function configureActions(): array
    {
        return [
            'question' => [
                '-prefilters' => [
                    Csrf::class,
                    Authentication::class,
                ]
            ],
            'getList' => [
                '-prefilters' => [
                    Csrf::class,
                    Authentication::class,
                ]
            ],
            'addRequest' => [
                '-prefilters' => [
                    Csrf::class,
                    Authentication::class,
                ]
            ],
            'addSubscribe' => [
                '-prefilters' => [
                    Csrf::class,
                    Authentication::class,
                ]
            ]
        ];
    }

    public function questionAction($name = '', $email = '', $company = '', $type = '', $text = ''): array
    {
        $eventResult = \CEvent::Send(
            'ITC_CERTIFICATION_QUESTION',
            SITE_ID,
            [
                'FIO' => $name,
                'EMAIL' => $email,
                'TYPE' => Loc::getMessage("TYPE_$type"),
                'COMPANY' => $company,
                'TEXT' => $text
            ],
            'N',
        );


        if (!$eventResult || !class_exists('CRest')) {
            return [];
        }

        \CRest::call(
            'crm.lead.add',
            [
                'fields' => [
                    'TITLE' => 'Вопрос по сертификации направление: ' . Loc::getMessage("TYPE_$type") ,
                    'NAME' => $name,
                    'UF_ITC_SOURSE' => '26',
                    'COMPANY_TITLE' => $company,
                    'EMAIL' => [
                        ["VALUE" => $email, "VALUE_TYPE" => "WORK"],
                    ],
                    'COMMENTS' => $text,
                    'ASSIGNED_BY_ID' => '29',
                    'CREATED_BY_ID' => '29',
                ]
            ]
        );

        return [];
    }

    public function getListAction($code): array
    {
        try {
            Loader::includeModule('iblock');
            Loader::includeModule('catalog');

            $locations = LocationTable::getList(['select' => ['*']])->fetchAll();
            $levels = CertificationLevelTable::getList(['select' => ['*']])->fetchAll();

            $certificationCollection = ElementCertificationTable::getList([
                'select' => ['id', 'active', 'name', 'preview_picture', 'type', 'level', 'duration'],
                'filter' => ['type.value' => $code],
            ])->fetchCollection();

            $certifications = array_reduce(
                $certificationCollection->getAll(),
                function ($result, $item) {
                    $previewPictureId = $item->getPreviewPicture() ?? '';
                    $previewPicture = $previewPictureId ? \CFile::GetPath($previewPictureId) : '';

                    $certificationItem = [
                        'id' => $item->getId(),
                        'logo' => $previewPicture,
                        'name' => $item->getName(),
                        'level' => $item->getLevel()
                            ? $item->getLevel()->getValue() : '',
                        'duration' => $item->getDuration()
                            ? $item->getDuration()->getValue() : '',
                    ];

                    $result[$item->getId()] = $certificationItem;
                    return $result;
            }, []);

            $priceCollection = PriceTable::getList([
                'select' => ['PRODUCT_ID', 'PRICE', 'CURRENCY'],
                'filter' => ['=PRODUCT_ID' => array_column($certifications, 'id')],
            ])->fetchCollection();
            $prices = array_reduce(
                $priceCollection->getAll(),
                function ($result, $item) {
                    $result[$item->getProductId()] = [
                        'price' => $item->getPrice(),
                        'currency' => $item->getCurrency(),
                        'priceFormatted' => \CurrencyFormat(
                            $item->getPrice(),
                            $item->getCurrency()
                        ),
                    ];
                    return $result;
                },
                []
            );
            $certifications = array_reduce($certifications, function ($result, $item) use ($prices) {
                if ($price = $prices[$item['id']]) {
                    $item = array_merge($item, $price);
                }

                $result[$item['id']] = $item;
                return $result;
            }, []);

            $currentLevels = array_column($certifications, 'level');
            $certificationPrices = array_column($certifications, 'priceFormatted','level');
            $levels = array_reduce($levels, function ($result, $item) use ($currentLevels, $certificationPrices) {
                if (!in_array($item['code'], $currentLevels)) {
                    return $result;
                }
                $item['price'] = $certificationPrices[$item['code']];
                $result[] = $item;
                return $result;
            }, []);

            $currentDay = new DateTime();
            $scheduleCollection = ElementScheduleCertificationTable::getList([
                'order'  => ['date.value' => 'asc', 'id' => 'asc'],
                'select' => ['id', 'active', 'certification', 'location', 'date'],
                'filter' => [
                    'certification.value' => array_column($certifications, 'id'),
                    '>=date.value' => $currentDay->format('Y-m-d H:i:s'),
                    'active' => true
                ]
            ])->fetchCollection();

            $schedule = array_reduce($scheduleCollection->getAll(), function ($result, $item) use ($certifications, $locations) {
                $currentLocations = array_map(function ($item) use($locations) {
                    return $item ? $item->getValue() : '';
                }, $item->getLocation()->getAll());

                $date = $item->getDate() ? $item->getDate()->getValue() : '';
                if ($date) {
                    $date = (new DateTime($date, 'Y-m-d H:i:s'))->format('d.m.Y');
                }

                $scheduleItem = [
                    'id' => $item->getId(),
                    'date' => $date,
                    'locations' => $currentLocations,
                    'certificationId' => $item->getCertification()
                        ? $item->getCertification()->getValue() : '',
                ];

                if ($certification = $certifications[$scheduleItem['certificationId']]) {
                    $scheduleItem = array_merge($scheduleItem, $certification);
                }

                $result[] = $scheduleItem;
                return $result;
            }, []);

            return [
                'levels' => $levels,
                'locations' => $locations,
                'schedule' => $schedule,
            ];
        } catch (\Throwable $exception) {
            $this->addError(new Error('Возникла ошибка, попробуйте отправить заявку позже.'));
            return [];
        }
    }

    public function addRequestAction(
        $code,
        $name,
        $email,
        $phone = '',
        $company = '',
        $position = '',
        $location = '',
        $city = '',
        $date = '',
        $desiredDate = '',
        $type = '',
        $level = '',
        $idsub = '',
        $subscribe = false
    ): array
    {
        try {
            if (!$type) {
                $type = $code;
            }

            $unisenderService = new UnisenderService();
            $resultId = $unisenderService->requestCertification($type, $level, $name, $email, $phone, $company);


            $answerType = mb_strtoupper(implode('_', [$type, $level ?? '']));
            $clintSendEvent = 'ITC_CERTIFICATION_REQUEST_ANSWER_'.$answerType;


            $eventSubscribe = \CEvent::Send(
                $clintSendEvent,
                SITE_ID,
                [
                    'FIO' => $name,
                    'EMAIL' => $email,
                ],
                'N',
            );

            if ($eventSubscribe) {
                if (class_exists('CRest')) {
                    \CRest::call(
                        'crm.lead.add',
                        [
                            'fields' => [
                                'TITLE' => 'Подписка: ' . Loc::getMessage("TYPE_$type") ,
                                'UF_ITC_SOURSE' => '26',
                                'NAME' => $name,
                                'EMAIL' => [
                                    ["VALUE" => $email, "VALUE_TYPE" => "WORK"],
                                ],
                                'ASSIGNED_BY_ID' => '29',
                                'CREATED_BY_ID' => '29',
                            ]
                        ]
                    );
                }
            }


            $eventResult = \CEvent::Send(
                'ITC_CERTIFICATION_REQUEST',
                SITE_ID,
                [
                    'FIO' => $name,
                    'PHONE' => $phone,
                    'EMAIL' => $email,
                    'COMPANY' => $company,
                    'POSITION' => $position,
                    'TYPE' => Loc::getMessage("TYPE_$type") ?? '',
                    'LEVEL' => Loc::getMessage("LEVEL_$level") ?? '',
                    'DATE' => $date,
                    'DESIRED_DATE' => $desiredDate,
                    'CITY' => Loc::getMessage("LOCATION_$location"),
                    'DESIRED_CITY' => $city,
                    'UNISENDER_ID' => $resultId,
                ],
                'N',
            );

            if ($eventResult) {
                if (class_exists('CRest')) {
                    \CRest::call(
                        'crm.lead.add',
                        [
                            'fields' => [
                                'TITLE' => 'Сертификация: ' . Loc::getMessage("TYPE_$type") ,
                                'UF_ITC_SOURSE' => '26',
                                'STATUS_ID' => 'NEW',
                                'NAME' => $name,
                                'COMPANY_TITLE' => $company,
                                'EMAIL' => [
                                    ["VALUE" => $email, "VALUE_TYPE" => "WORK"],
                                ],
                                'PHONE' => [['VALUE' => $phone, 'VALUE_TYPE' => 'WORK']],
                                'COMMENTS' => "Должность: " . $position . "<br/>" . "Уровень: " . Loc::getMessage("LEVEL_$level") . "<br/>" . "Дата: " . $date . "<br/>" . "Желаемая дата: " . $desiredDate . "<br/>" . "Город: " . Loc::getMessage("LOCATION_$location") . "<br/>" . "Желаемый город: " . $city,
                                'ASSIGNED_BY_ID' => '29',
                                'CREATED_BY_ID' => '29',
                            ]
                        ]
                    );
                }
            }

            if (!$subscribe) {
                return [];
            }

            $this->addSubscribeAction($code, $name, $email, $phone, $type, $level);

            return [];
        } catch (\Throwable $exception) {
            $this->addError(new Error('Возникла ошибка, попробуйте отправить заявку позже.'));
            return [];
        }
    }

    public function addSubscribeAction($code, $name, $email, $phone = '', $type = '', $level = '', $idsub = ''): array
    {

        $ApiClient = new \ApiClient('2a20e381fd848245984f4f7abb6d5a80');
        $emai = [
            'email' => $email,
            'unconfirmed' => false,
        ];
        $ApiClient->addEmail($idsub,$emai);

        try {
            if (!$type) {
                $type = $code;
            }

            if (!$ApiClient) {
                $this->addError(new Error('Не удалось подписать на рассылку'));
                return [];
            }

            $eventSub = \CEvent::Send(
                'ITC_CERTIFICATION_SUBSCRIBE',
                SITE_ID,
                [
                    'FIO' => $name,
                    'EMAIL' => $email,
                    'PHONE' => $phone,
                    'TYPE' => Loc::getMessage("TYPE_$type"),
                    'LEVEL' => Loc::getMessage("LEVEL_$level"),
                ],
                'N',
            );



            if (!$ApiClient || !class_exists('CRest')) {
                return [];
            }

            \CRest::call(
                'crm.lead.add',
                [
                    'fields' => [
                        'TITLE' => 'Подписка: ' . Loc::getMessage("TYPE_$type"),
                        'UF_ITC_SOURSE' => '26',
                        'NAME' => $name,
                        'EMAIL' => [
                            ["VALUE" => $email, "VALUE_TYPE" => "WORK"],
                        ],
                        'COMMENTS' => "Уровень: " . Loc::getMessage("LEVEL_$level") . "<br/>" . "Направление: " . Loc::getMessage("TYPE_$type"),
                        'ASSIGNED_BY_ID' => '29',
                        'CREATED_BY_ID' => '29',
                    ]
                ]
            );


            return [];

        } catch (\Throwable $exception) {
            $this->addError(new Error('Возникла ошибка, попробуйте отправить заявку позже.'));
            return [];
        }
    }
}