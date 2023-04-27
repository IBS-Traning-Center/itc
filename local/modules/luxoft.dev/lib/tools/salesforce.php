<?php
declare(strict_types=1);

namespace Luxoft\Dev\Tools;

use Bitrix\Main\Loader;
use Bitrix\Main\Error;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\ErrorableImplementation;

use Bitrix\Main\EventManager,
    Bitrix\Main\SystemException,
    Bitrix\Main\ObjectPropertyException;

class Salesforce implements Errorable
{
    use ErrorableImplementation;

    /** @var ErrorCollection */
    protected $errorCollection;

    private static array $instances;
    private \SoapClient $connection;

    private array $credentials = [
        'login' => 'ashkavro@luxoft.com',
        'password' => 'roccotrue1',
        'token' => 'uvMKn9mNBZNBxonzVpICQcs8',
        'url' => 'https://luxoft.my.salesforce.com/services/Soap/c/39.0/',
        'namespace' => 'urn:enterprise.soap.sforce.com',
        'schema' => __DIR__.'/schema.wsdl',
    ];

    private function __construct()
    {
        $this->errorCollection = new ErrorCollection();
        $this->getConnection();
    }

    public static function getInstance(): Salesforce
    {
        $subclass = static::class;
        if (!isset(self::$instances[$subclass])) {
            self::$instances[$subclass] = new static();
        }
        return self::$instances[$subclass];
    }

    /**
     * Getting array of errors.
     * @return Error[]
     */
    public function getErrors(): array
    {
        return $this->errorCollection->toArray();
    }

    /**
     * Getting once error with the necessary code.
     * @param string $code Code of error.
     * @return Error|null
     */
    public function getErrorByCode($code): ?Error
    {
        return $this->errorCollection->getErrorByCode($code);
    }

    protected function getConnection(): void
    {
        $client = new \SoapClient($this->credentials['schema']);
        $client -> __setLocation($this->credentials['url']);

        $response = $client->login([
            'username' => $this->credentials['login'],
            'password' => $this->credentials['password'] . $this->credentials['token']
        ]);

        $sessionId = (string) $response->result->sessionId;
        $serverUrl = (string) $response->result->serverUrl;

        $header = new \SoapHeader(
            $this->credentials['namespace'],
            'SessionHeader',
            ['sessionId' => $sessionId]
        );

        $this->connection = new \SoapClient($this->credentials['schema']);
        $this->connection -> __setSoapHeaders($header);
        $this->connection -> __setLocation($serverUrl);
    }


    /**
     * @param array $params
     * @return bool
     */

    public function sendLead(array $params): bool
    {
        foreach ($params as & $param) {
            $param = UTF($param);
        }

        $lead = [
            'Bitrix_Source__c' => $params['location'],
            'Bitrix_Id__c' => $params['leadId'],
            'firstName' => $params['firstName'],
            'lastName' => $params['lastName'],
            'company' => $params['company'],
            'Individual_Company__c' => $params['company'],
            'email' => $params['email'],
            'phone' => $params['phone'],
            'city' => $params['city'],
            'Description' => $params['comment'],
        ];

        if (intval($params['courseId']) > 0) {
            $lead['PTC_Training__r'] = [
                'Bitrix_Id__c' => intval($params['courseId'])
            ];
        } else {
            $lead['PTC_Training__c'] = null;
        }

        if (intval($params['scheduleId']) > 0) {
            $lead['PTC_Training_Schedule__r'] = [
                'Bitrix_Id__c' => intval($params['scheduleId'])
            ];
        } else {
            $lead['PTC_Training_Schedule__c'] = null;
        }

        try {
            $response = $this->connection->upsert([
                'externalIDFieldName' => 'Bitrix_Id__c',
                'sObjects' => $this->createSoapVars([$lead], "Lead")
            ]);

            if(!$response->result->success) {
                \Bitrix\Main\Diag\Debug::dumpToFile(['lead'=> $params, 'errors' => $response->result->errors], $params['location'], 'local/logs/salesForce.log');
            }

            return $response->result->success;
        } catch (\SoapFault $e) {
            \Bitrix\Main\Diag\Debug::dumpToFile(['lead'=> $params, 'errors' => $e], $params['location'], 'local/logs/salesForce.log');
            return false;
        }
    }

    protected function createSoapVars(array $objects, $type)
    {
        $soapVars = array();

        foreach ($objects as $object) {

            $sObject = $this->createSObject($object, $type);

            $xml = '';
            if (isset($sObject->fieldsToNull)) {
                foreach ($sObject->fieldsToNull as $fieldToNull) {
                    $xml .= '<fieldsToNull>' . $fieldToNull . '</fieldsToNull>';
                }
                $fieldsToNullVar = new \SoapVar(new \SoapVar($xml, XSD_ANYXML), SOAP_ENC_ARRAY);
                $sObject->fieldsToNull = $fieldsToNullVar;
            }

            $soapVar = new \SoapVar($sObject, SOAP_ENC_OBJECT, $type, $this->credentials['namespace']);
            $soapVars[] = $soapVar;
        }

        return $soapVars;
    }

    protected function createSObject($object, $objectType)
    {
        $sObject = new \stdClass();
        foreach ($object as $field => $value) {

            if ($value === null) {
                $sObject->fieldsToNull[] = $field;
                continue;
            }
            if (is_array($value)) {
                if ($field=="Instructor__r") {
                    $value=new \SoapVar($value, SOAP_ENC_OBJECT, "Instructor__c", $this->credentials['namespace']);
                } elseif ($field=="Training__r") {
                    $value=new \SoapVar($value, SOAP_ENC_OBJECT, "Training__c", $this->credentials['namespace']);
                }  elseif ($field=="Lead__r") {
                    $value=new \SoapVar($value, SOAP_ENC_OBJECT, "Lead", $this->credentials['namespace']);
                } elseif ($field=="Schedule__r") {
                    $value=new \SoapVar($value, SOAP_ENC_OBJECT, "Schedule__c", $this->credentials['namespace']);
                }  elseif ($field=="PTC_Training_Schedule__r") {
                    $value=new \SoapVar($value, SOAP_ENC_OBJECT, "Schedule__c", $this->credentials['namespace']);
                }  elseif ($field=="PTC_Training__r") {
                    $value=new \SoapVar($value, SOAP_ENC_OBJECT, "Training__c", $this->credentials['namespace']);
                }

            }
            $sObject->$field = $value;

        }

        return $sObject;
    }
}