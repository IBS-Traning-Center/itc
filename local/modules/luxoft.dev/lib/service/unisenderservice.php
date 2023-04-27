<?php
declare(strict_types=1);

namespace Luxoft\Dev\Service;

require_once $_SERVER['DOCUMENT_ROOT'] . '/local/modules/luxoft.dev/lib/tools/UnisenderApi.php';

use Bitrix\Main\PhoneNumber\Format;
use Bitrix\Main\PhoneNumber\Parser;
use Unisender\ApiWrapper\UnisenderApi;

class UnisenderService
{
    private string $platform = 'Site ibs-training.ru';
    private string $apiKey = '6rb1pm5pu9cmpzzkyg5h8k7fao666qno3mjtdbae';
    private UnisenderApi $api;
    private array $lists = [
        'java' => [
            'base' => [
                'subscribe' => '281',
                'request' => '282',
            ],
            'specialist' => [
                'subscribe' => '201',
                'request' => '204',
            ],
            'advanced' => [
                'subscribe' => '207',
                'request' => '206',
            ],
        ],
        'analyst' => [
            'base' => [
                'subscribe' => '283',
                'request' => '284',
            ],
            'specialist' => [
                'subscribe' => '285',
                'request' => '286',
            ],
            'advanced' => [
                'subscribe' => '287',
                'request' => '288',
            ],
        ],
        'test-it' => [
            'subscribe' => '289',
            'request' => '290',
        ],
    ];

    public function __construct()
    {
        $this->api = new UnisenderApi($this->apiKey, 'UTF-8', 4, null, false, $this->platform);
    }

    public function requestCertification(
        string $type = '',
        string $level = '',
        string $name = '',
        string $email = '',
        string $phone = '',
        string $company = ''
    )
    {
        if (!is_email($email)) {
            return 0;
        }

        $parsedPhone = Parser::getInstance()->parse($phone);
        $formattedPhone = $parsedPhone->format(Format::E164);

        $tags = [];
        if ($company) {
            $tags[] = 'company';
            $tags[] = $company;
        } else {
            $tags[] = 'person';
        }
        $tags[] = $type;
        if ($level) {
            $tags[] = $level;
        }

        $listId = $this->getListId('request', $type, $level);
        if (!$listId) {
            return 0;
        }

        $tags = array_unique($tags);
        $params = [
            'list_ids' => $listId,
            'fields' => [
                'name' => $name,
                'email' => $email,
                'phone' => $formattedPhone,
                'level' => $level,
            ],
            'tags' => implode(',', $tags),
            'double_optin' => 4,
            'overwrite' => 0,
        ];

        $resultJson = $this->api->subscribe($params);
        ['result' => $result] = json_decode($resultJson, true);

        return (int) $result['person_id'];
    }

    public function subscribeCertification(
        string $type,
        string $level = null,
        string $name = '',
        string $email = ''
    ): int
    {
        if (!is_email($email)) {
            return 0;
        }

        $tags = [];
        $tags[] = $type;
        if ($level) {
            $tags[] = $level;
        }

        $listId = $this->getListId('subscribe', $type, $level);
        if (!$listId) {
            return 0;
        }

        $tags = array_unique($tags);
        $params = [
            'list_ids' => $listId,
            'fields' => [
                'name' => $name,
                'email' => $email,
            ],
            'tags' => implode(',', $tags),
            'double_optin' => 4,
            'overwrite' => 0,
        ];

        $resultJson = $this->api->subscribe($params);
        ['result' => $result] = json_decode($resultJson, true);

        return (int)$result['person_id'];
    }

    protected function getListId(string $action, string $type, $level = null): string
    {
        if (!$level) {
            return $this->lists[$type][$action];
        }

        return $this->lists[$type][$level][$action];
    }
}