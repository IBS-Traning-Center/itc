<?php
#components/bitrix/example/class.php

use Bitrix\Main\Error;
use Bitrix\Main\ErrorCollection;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

class ExampleComponent extends \CBitrixComponent implements \Bitrix\Main\Engine\Contract\Controllerable, \Bitrix\Main\Errorable
{
    /** @var ErrorCollection */
    protected $errorCollection;

    public function configureActions()
    {
        //если действия не нужно конфигурировать, то пишем просто так. И будет конфиг по умолчанию
        return [];
    }

    public function onPrepareComponentParams($arParams)
    {
        $this->errorCollection = new ErrorCollection();

        //подготовка параметров
        //Этот код **будет** выполняться при запуске аяксовых-действий
    }

    public function executeComponent()
    {
        //Внимание! Этот код **не будет** выполняться при запуске аяксовых-действий
    }

    //в параметр $person будут автоматически подставлены данные из REQUEST
    public function greetAction($person = 'guest')
    {
        return "Hi {$person}!";
    }

    //пример обработки ошибок
    public function showMeYourErrorAction():? string
    {
        if (rand(3, 43) === 42)
        {
            $this->errorCollection[] = new Error('You are so beautiful or so handsome');
            //теперь в ответе будут ошибки и будет автоматически выставлен статус ответа 'error'.

            return  null;
        }

        return "Ok";
    }

    /**
     * Getting array of errors.
     * @return Error[]
     */
    public function getErrors()
    {
        return $this->errorCollection->toArray();
    }

    /**
     * Getting once error with the necessary code.
     * @param string $code Code of error.
     * @return Error
     */
    public function getErrorByCode($code)
    {
        return $this->errorCollection->getErrorByCode($code);
    }
}