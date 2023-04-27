<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
const SOAP_NAMESPACE = 'urn:enterprise.soap.sforce.com';
function sendLeed() {
    CModule::IncludeModule("iblock");
    $login = 'ashkavro@luxoft.com';
    $password = 'roccotrue1';
    $token = "uvMKn9mNBZNBxonzVpICQcs8";
    $client = new SoapClient($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/prod.wsdl");
    $client->__setLocation("https://luxoft.my.salesforce.com/services/Soap/c/39.0/");
    $result=$client->login(array("username"=>$login, "password"=>$password.$token));
    $sessionId=(string)$result->result->sessionId;
    $serverUrl=(string)$result->result->serverUrl;
    $client2= new SoapClient($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/prod.wsdl");
    $header=new \SoapHeader(
        SOAP_NAMESPACE,
        'SessionHeader',
        array(
            'sessionId' => $sessionId
        )
    );
    $client2->__setSoapHeaders($header);
    $client2->__setLocation($serverUrl);

    $Object = createSoapVars(
        [
            [
                'Bitrix_Id__c' => '12345',
                'firstName' => UTF('Тестовое имя 3'),
                'lastName' => UTF('Тестовая фамилия 3'),
                'company' => UTF(htmlspecialchars_decode('Тестовая <br> компания 1')),
                'Individual_Company__c' => UTF('Тестовая <br> компания 2'),
                'email' => UTF('test3@test.ru'),
                'phone' => UTF('8 (952) 765 80 40'),
                'city' => UTF('test'),
                'Description' => UTF('Тестовое описание'),
                //'PTC_Training__r' => ["Bitrix_Id__c" => '103315'], // ID курса
                //'PTC_Training_Schedule__r' => ["Bitrix_Id__c" => '109061'], // ID курса в расписании
                'Bitrix_Source__c' => 'RU'
            ]
        ],
        "Lead"
    );
    return $client2->upsert(array("externalIDFieldName"=> "Bitrix_Id__c", 'sObjects'=> $Object));
}
echo var_export(sendLeed());
