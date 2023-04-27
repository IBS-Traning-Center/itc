<?php

use Bitrix\Main\Context;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\ORM\Query\QueryHelper;
use Bitrix\Sale\Internals\BasketPropertyTable;
use Bitrix\Sale\Internals\OrderPropsValue;
use Bitrix\IBlock\Elements\ElementScheduleTable;
use Bitrix\Sale\Internals\OrderPropsValueTable;

class OrdersSapComponent extends CBitrixComponent
{
    protected function getOrders($dateFrom = null, $dateTo = null, $filter = [])
    {
        $query = \Bitrix\Sale\Internals\OrderTable::query()
            ->setOrder(['ID' => 'DESC'])
            ->addSelect('ID')
            ->addSelect('BASKET.ID')
            ->addSelect('BASKET.NAME')
            ->addSelect('PERSON_TYPE_ID')
            ->addSelect('DATE_INSERT')
            ->addSelect('PRICE')
            ->whereIn('PERSON_TYPE_ID', [1, 3]);
        if ($dateFrom) {
            $query->where('DATE_INSERT', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->where('DATE_INSERT', '<=', $dateTo);
        }

        $orderCollection = QueryHelper::decompose($query);
        $orderCollection->fillProperty();

        $orders = [];
        foreach ($orderCollection as $orderObject) {
            $order = [
                'ID' => $orderObject->getId(),
                'NAME' => $orderObject->get('BASKET')->getName(),
                'BASKET_ID' => $orderObject->get('BASKET')->getId(),
                'DATE_INSERT' => $orderObject->get('DATE_INSERT')->format('d.m.Y H:i:s'),
                'PERSON_TYPE_ID' => $orderObject->get('PERSON_TYPE_ID'),
                'TYPE' => $orderObject->get('PERSON_TYPE_ID') == 1
                    ? '[1] Физическое лицо'
                    : '[3] Юридическое лицо',
                'ORDER_PRICE' => $orderObject->get('PRICE'),
            ];
            $orders[$order['ID']] = $order;
        }

        $orderProps = OrderPropsValueTable::getList([
            'order' => ['ID' => 'DESC'],
            'select' => [
                'ID',
                'ORDER_ID',
                'CODE',
                'VALUE',
            ],
            'filter' => [
                'ORDER_ID' => array_column($orders, 'ID'),
                'CODE' => [
                    'offerta',
                    'INN', //ИНН
                    'KPP', //КПП
                    'COMPANY', //Нименование ЮЛ
                    'COMPANY_ADR', //Юридический адрес
                    'COMPANY_DOCADDRESS', //Адрес для отправки документов
                    'R/S', //Расчётный счёт
                    'kr', //Корреспондентский счёт
                    'Bank', //Банк
                    'BIK', //БИК
                    'FIO', //Фамилия
                    'F_NAME', //Имя
                    'F_S_NAME', //Отчество
                    'PERSON_SNILS', //СНИЛС
                    'PHONE', //Телефон
                    'ZIP', //Индекс
                    'ADDRESS', //Город ФЛ, Улица, дом, квартира ФЛ
                    'CLIENT_INFO', //Информация об обучающихся
                ]
            ],
            'cache' => [
                'ttl' => 3600,
            ],
        ])->fetchAll();
        foreach ($orderProps as $orderProp) {
            $orders[$orderProp['ORDER_ID']][$orderProp['CODE']] = $orderProp['VALUE'];
        }

        foreach ($orders as &$order) {
            foreach ($order as &$value) {
                if (is_string($value)) {
                    $value = trim($value);
                }
            }
        }

        $orders = array_filter($orders, function ($order) {
            if (
                $order['PERSON_TYPE_ID'] == 3
            ) {
                if (empty($order['CLIENT_INFO'])) {
                    return false;
                }

                $clients = $this->parseClientInfo($order['CLIENT_INFO']);
                $clients = array_filter($clients, function ($client) {
                    return $this->checkPersonData($client);
                });

                if (!count($clients)) {
                    return false;
                }
            }
            return true;
        });

        $orders = array_combine(array_column($orders, 'BASKET_ID'), $orders);
        $basketProps = BasketPropertyTable::getList([
            'order' => ['ID' => 'DESC'],
            'select' => [
                'ID',
                'BASKET_ID',
                'CODE',
                'VALUE',
            ],
            'filter' => [
                'BASKET_ID' => array_column($orders, 'BASKET_ID'),
                'CODE' => ['STARTDATE', 'ENDDATE']
            ],
            'cache' => [
                'ttl' => 3600,
            ],
        ])->fetchAll();
        foreach ($basketProps as $basketProp) {
            $orders[$basketProp['BASKET_ID']][$basketProp['CODE']] = $basketProp['VALUE'];
        }

        $orders = array_values($orders);
        array_multisort(array_column($orders, 'DATE_INSERT', 'ID'), SORT_DESC, $orders);

        return $orders;
    }

    protected function parseClientInfo($clientInfo): array
    {
        $clients = str_getcsv($clientInfo, "\r\n");
        return array_map(function ($client) {
            $client = str_getcsv($client, ';');
            $result = [
                'FIO' => $client[0],
                'DATE_BIRTH' => $client[1],
                'SNILS' => $client[2],
                'PHONE' => $client[3],
                'ADDRESS' => $client[4],
            ];

            foreach ($result as &$value) {
                $value = trim($value);
            }

            return $result;
        }, $clients);
    }

    protected function checkPersonData($personData): bool
    {
        if (strlen($personData['FIO']) < 3) {
            return false;
        }

        return true;
    }

    protected function getHeaderRows() {
        $result = [
            ['sort' => '10',  'id' => 'TYPE',                 'name' => 'Тип плательщика',               'default' => true],
            ['sort' => '20',  'id' => 'INN',                  'name' => 'ИНН',                           'default' => true],
            ['sort' => '30',  'id' => 'KPP',                  'name' => 'КПП',                           'default' => true],
            ['sort' => '40',  'id' => 'COMPANY_NAME',         'name' => 'Нименование ЮЛ',                'default' => true],
            ['sort' => '50',  'id' => 'COMPANY_ADDRESS',      'name' => 'Юридический адрес',             'default' => true],
            ['sort' => '60',  'id' => 'COMPANY_ADDRESS_SEND', 'name' => 'Адрес для отправки документов', 'default' => true],
            ['sort' => '70',  'id' => 'COMPANY_BILL',         'name' => 'Расчётный счёт',                'default' => true],
            ['sort' => '80',  'id' => 'COMPANY_CORR',         'name' => 'Корреспондентский счёт',        'default' => true],
            ['sort' => '90',  'id' => 'COMPANY_BANK',         'name' => 'Банк',                          'default' => true],
            ['sort' => '100', 'id' => 'COMPANY_BIK',          'name' => 'БИК',                           'default' => true],
            ['sort' => '110', 'id' => 'LAST_NAME',            'name' => 'Фамилия',                       'default' => true],
            ['sort' => '120', 'id' => 'NAME',                 'name' => 'Имя',                           'default' => true],
            ['sort' => '130', 'id' => 'SECOND_NAME',          'name' => 'Отчество',                      'default' => true],
            ['sort' => '140', 'id' => 'SNILS',                'name' => 'СНИЛС',                         'default' => true],
            ['sort' => '150', 'id' => 'PHONE',                'name' => 'Телефон',                       'default' => true],
            ['sort' => '160', 'id' => 'INDEX',                'name' => 'Индекс',                        'default' => true],
            ['sort' => '170', 'id' => 'CITY',                 'name' => 'Город ФЛ',                      'default' => true],
            ['sort' => '180', 'id' => 'ADDRESS',              'name' => 'Улица, дом, квартира ФЛ',       'default' => true],
            ['sort' => '190', 'id' => 'ORDER_NAME',           'name' => 'Имя',                           'default' => true],
            ['sort' => '200', 'id' => 'ORDER_PRICE',          'name' => 'Сумма',                         'default' => true],
            ['sort' => '220', 'id' => 'OFFERTA',              'name' => 'Номер в офферту',               'default' => true],
            ['sort' => '230', 'id' => 'DATE_INSERT',          'name' => 'Дата создания',                 'default' => true],
            ['sort' => '240', 'id' => 'W_FACT',          'name' => 'W (факт оплаты)',                 'default' => true],
        ];
        usort($result, function($a, $b) {
            return $a['sort'] <=> $b['sort'];
        });
        return $result;
    }

    protected function getNameGridRow($order)
    {
        $orderNameTemplate = "Услуги заказчика по программе: {$order['NAME']} по Счет-оферте №PTC.OF. {$order['offerta']} от {$order['DATE_INSERT']}. Срок оказания услуг: {$order['STARTDATE']}-{$order['ENDDATE']}. г.";
        $orderNameCompanyTemplate = "Услуги по обучению сотрудников заказчика по программе: {$order['NAME']} по Счет-оферте №PTC.OF. {$order['offerta']} от {$order['DATE_INSERT']}. Срок оказания услуг: {$order['STARTDATE']}-{$order['ENDDATE']}. г.";

        return $order['PERSON_TYPE_ID'] == 1 ? $orderNameTemplate : $orderNameCompanyTemplate;
    }

    protected function getGridRow($order)
    {
        $arAddress = explode(',', $order['ADDRESS']);
        $city = $arAddress[0];
        $address = implode(',', array_slice($arAddress, 1));

        if (!$order['ENDDATE'] && $order['STARTDATE']) {
            $order['ENDDATE'] = $order['STARTDATE'];
        }
        if (!$order['STARTDATE'] && $order['ENDDATE']) {
            $order['STARTDATE'] = $order['ENDDATE'];
        }

        $result = [
            'TYPE' => $order['TYPE'],
            'INN' => $order['INN'],
            'KPP' => $order['KPP'],
            'COMPANY_NAME' => $order['COMPANY'],
            'COMPANY_ADDRESS' => $order['COMPANY_ADR'],
            'COMPANY_ADDRESS_SEND' => $order['COMPANY_DOCADDRESS'],
            'COMPANY_BILL' => $order['R/S'],
            'COMPANY_CORR' => $order['kr'],
            'COMPANY_BANK' => $order['Bank'],
            'COMPANY_BIK' => $order['BIK'],
            'LAST_NAME' => $order['FIO'],
            'NAME' => $order['F_NAME'],
            'SECOND_NAME' => $order['F_S_NAME'],
            'SNILS' => $order['PERSON_SNILS'],
            'PHONE' => $order['PHONE'],
            'INDEX' => $order['ZIP'],
            'CITY' => $city,
            'ADDRESS' => $address,
            'ORDER_NAME' => $this->getNameGridRow($order),
            'ORDER_PRICE' => $order['ORDER_PRICE'],
            'OFFERTA' => $order['offerta'],
            'DATE_INSERT' => $order['DATE_INSERT'],
            'W_FACT' => '',
        ];

        return $result;
    }

    protected function getGridRows($orders) {
        return array_map(function($order) {
            return [
                'data' => $this->getGridRow($order)
            ];
        }, $orders);
    }

    protected function getDates()
    {
        $request = Context::getCurrent()->getRequest();

        $defaultDateFrom = (new DateTime())
            ->add('-7 days')
            ->setTime(0, 0, 0);
        $defaultDateTo = (new DateTime())->setTime(23, 59, 59);

        if ($searchDateFrom = $request->get('search_date_from')) {
            $dateFrom = new DateTime($searchDateFrom, 'Y-m-d');
            $dateFrom->setTime(0, 0, 0);
            $dateFrom = $dateFrom->getTimestamp() > $defaultDateTo->getTimestamp()
                ? $defaultDateFrom
                : $dateFrom;
        } else {
            $dateFrom = $defaultDateFrom;
        }
        if ($searchDateTo = $request->get('search_date_to')) {
            $dateTo = new DateTime($searchDateTo, 'Y-m-d');
            $dateTo->setTime(23, 59, 59);
            $dateTo = $dateTo->getTimestamp() > $defaultDateTo->getTimestamp()
                ? $defaultDateTo
                : $dateTo;
        } else {
            $dateTo = $defaultDateTo;
        }

        return [
            'from' => $dateFrom,
            'to' => $dateTo,
        ];
    }

    public function executeComponent()
    {
        global $APPLICATION;

        ['from' => $dateFrom, 'to' => $dateTo] = $this->getDates();
        $this->arResult['SEARCH_DATE_FROM'] = $dateFrom->format('Y-m-d');
        $this->arResult['SEARCH_DATE_TO'] = $dateTo->format('Y-m-d');

        $this->arResult['HEADERS'] = $this->getHeaderRows();

        $orders = $this->getOrders($dateFrom, $dateTo);
        $rows = $this->getGridRows($orders);
        $this->arResult['ROWS'] = $rows;

        $mode = $this->request->get('mode') ?: '';
        if ($mode === 'excel') {
            $APPLICATION->RestartBuffer();
            Header('Content-Transfer-Encoding: binary');
            Header('Content-Type: application/octet-stream');
            Header('Content-Type: application/vnd.ms-excel');
            Header('Content-Disposition: attachment;filename=orders-sap.xls');
            $this->includeComponentTemplate('excel');
            die();
        }

        $this->includeComponentTemplate();
    }
}