<?php
declare(strict_types=1);

namespace Luxoft\Dev\Agents;

use Bitrix\Iblock\IblockTable;

class SalesforceAgent
{
    public static function init():string
    {
        self::sendLeads('RU');
        self::sendLeads('RO/PL/COM');

        return '\Luxoft\Dev\Agents\SalesforceAgent::init();';
    }

    /**
     * @param string $location
     * @throws \Bitrix\Main\LoaderException
     */

    private static function sendLeads(string $location): void
    {
        if(\Bitrix\Main\Loader::includeModule('iblock')) {
            $client = \Luxoft\Dev\Tools\Salesforce::getInstance();

            $tableCode = ($location === 'RU') ? 'Registrations' : 'RegistrationsEn';

            $entity = IblockTable::compileEntity($tableCode);
            $entityClass = $entity->getDataClass();

            $resultQuery = $entityClass::getList([
                'order' => ['id' => 'desc'],
                'select' => [
                    'id',
                    'type.item',
                    'fullname',
                    'firstname',
                    'lastname',
                    'email',
                    'telephone',
                    'company',
                    'city',
                    'comment',
                    'event_id',
                    'cat_course',
                    'timetable_id',
                    'is_send_salesforce',
                ],
                'filter' => [
                    '!is_send_salesforce.value' => 'Y',
                    '!type.value' => [80, 338]
                ],
                'cache' => ['ttl' => 3600]
            ]);

            $collection = $resultQuery->fetchCollection();

            if(count($collection)) {
                foreach ($collection as $itemCollection)
                {
                    $lead = [
                        'location'      => $location,
                        'leadId'        => $itemCollection->get('id'),
                        'type'          => $itemCollection->get('type') && $itemCollection->get('type')->getItem() ? $itemCollection->get('type')->getItem()->get('XML_ID') : '',
                        'fullName'      => $itemCollection->get('fullname') ? trim($itemCollection->get('fullname')->getValue()) : '',
                        'firstName'     => $itemCollection->get('firstname') ? trim($itemCollection->get('firstname')->getValue()) : '',
                        'lastName'      => $itemCollection->get('lastname') ? trim($itemCollection->get('lastname')->getValue()) : '',
                        'company'       => $itemCollection->get('company') ? trim($itemCollection->get('company')->getValue()) : '',
                        'email'         => $itemCollection->get('email') ? trim($itemCollection->get('email')->getValue()) : '',
                        'phone'         => $itemCollection->get('telephone') ? trim($itemCollection->get('telephone')->getValue()) : '',
                        'city'          => $itemCollection->get('city') ? trim($itemCollection->get('city')->getValue()) : '',
                        'comment'       => $itemCollection->get('comment') ? trim($itemCollection->get('comment')->getValue()) : '',
                        'scheduleId'    => $itemCollection->get('timetable_id') ? $itemCollection->get('timetable_id')->getValue() : 0,
                        'event_id'      => $itemCollection->get('event_id') ? $itemCollection->get('event_id')->getValue() : 0,
                        'courseId'      => $itemCollection->get('cat_course') ? $itemCollection->get('cat_course')->getValue() : 0
                    ];

                    if(!empty($lead['fullName']) && (empty($lead['firstName']) || empty($lead['lastName']))) {
                        $result = [];
                        $nameKeys = [0 => 'last', 1 => 'first', 2 => 'second'];

                        foreach(explode(' ', $lead['fullName']) as $index => $partName) {
                            $result[$nameKeys[$index]] = $partName;
                        }

                        $lead['firstName']  = !empty($lead['firstName']) ? $lead['firstName'] : $result['first'];
                        $lead['lastName']   = !empty($lead['lastName']) ? $lead['lastName'] : $result['last'];
                    }

                    if(!$lead['courseId'] && $lead['type'] === 'courses' && $lead['event_id']) {
                        $lead['courseId'] = $lead['event_id'];
                    }

                    if($client->sendLead($lead)) {
                        $itemCollection->get('is_send_salesforce')->setValue('Y');
                        $itemCollection->save();
                    }
                }
                $collection->save();
            }
        }
    }

    private static function sendLeadsEn(): void
    {

    }
}