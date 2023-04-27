<?php

namespace Luxoft\Dev;

use Bitrix\Main\Error;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\ErrorableImplementation;


use Bitrix\Main\EventManager,
    Bitrix\Main\SystemException,
    Bitrix\Main\ObjectPropertyException;

class Core implements Errorable
{
    use ErrorableImplementation;

    /** @var ErrorCollection */
    protected $errorCollection;

    private static array $instances = [];
    public bool $isSuccess;
    public bool $isInit;

    private function __construct()
    {
        $this->errorCollection = new ErrorCollection();

        $this->isInit = false;
        $this->isInit = $this->init();
    }

    public static function getInstance(): Core
    {
        $subclass = static::class;
        if (!isset(self::$instances[$subclass])) {
            self::$instances[$subclass] = new static();
        }
        return self::$instances[$subclass];
    }

    private function checkInit(): bool
    {
        $result = true;

        return $result;
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
     * @return Error
     */
    public function getErrorByCode($code): string
    {
        return $this->errorCollection->getErrorByCode($code);
    }

    protected function initHandlers(): void
    {
        //IBlockSection
        // Добавление раздела
        //EventManager::getInstance()->addEventHandler('iblock', 'OnBeforeIBlockSectionAdd',      ['\Luxoft\Dev\Events\IBlockSection', 'OnBeforeIBlockElementAdd']);
        //EventManager::getInstance()->addEventHandler('iblock', 'OnAfterIBlockSectionAdd',       ['\Luxoft\Dev\Events\IBlockSection', 'OnAfterIBlockSectionAdd']);
        // Изменение раздела
        //EventManager::getInstance()->addEventHandler('iblock', 'OnBeforeIBlockSectionUpdate',   ['\Luxoft\Dev\Events\IBlockSection', 'OnBeforeIBlockSectionUpdate']);
        //EventManager::getInstance()->addEventHandler('iblock', 'OnAfterIBlockSectionUpdate',    ['\Luxoft\Dev\Events\IBlockSection', 'OnAfterIBlockSectionUpdate']);
        // Удаление раздела
        //EventManager::getInstance()->addEventHandler('iblock', 'OnBeforeIBlockSectionDelete',   ['\Luxoft\Dev\Events\IBlockSection', 'OnBeforeIBlockSectionDelete']);
        //EventManager::getInstance()->addEventHandler('iblock', 'OnAfterIBlockSectionDelete',    ['\Luxoft\Dev\Events\IBlockSection', 'OnAfterIBlockSectionDelete']);

        //IBlockElement
        // Добавление элементов
        //EventManager::getInstance()->addEventHandler('iblock', 'OnBeforeIBlockElementAdd',      ['\Luxoft\Dev\Events\IBlockElement', 'OnBeforeIBlockElementAdd']);
        EventManager::getInstance()->addEventHandler('iblock', 'OnAfterIBlockElementAdd',         ['\Luxoft\Dev\Events\IBlockElement', 'OnAfterIBlockElementAdd']);
        // Изменение элементов
        //EventManager::getInstance()->addEventHandler('iblock', 'OnBeforeIBlockElementUpdate',   ['\Luxoft\Dev\Events\IBlockElement', 'OnBeforeIBlockElementUpdate']);
        //EventManager::getInstance()->addEventHandler('iblock', 'OnAfterIBlockElementUpdate',    ['\Luxoft\Dev\Events\IBlockElement', 'OnAfterIBlockElementUpdate']);
        // Удаление элементов
        //EventManager::getInstance()->addEventHandler('iblock', 'OnBeforeIBlockElementDelete',   ['\Luxoft\Dev\Events\IBlockElement', 'OnBeforeIBlockElementDelete']);
        //EventManager::getInstance()->addEventHandler('iblock', 'OnBeforeIBlockElementDelete',   ['\Luxoft\Dev\Events\IBlockElement', 'OnAfterIBlockElementDelete']);


        //Search
        //EventManager::getInstance()->addEventHandler('search', 'BeforeIndex',                   ['\Luxoft\Dev\Events\Search', 'BeforeIndex']);


        //User
        //EventManager::getInstance()->addEventHandler('main', 'OnBeforeUserUpdate',              ['\Luxoft\Dev\Events\User', 'OnBeforeUserUpdate']);
        //EventManager::getInstance()->addEventHandler('main', 'OnBeforeUserRegister',            ['\Luxoft\Dev\Events\User', 'OnBeforeUserRegister']);

        //EventManager::getInstance()->addEventHandler('main', 'OnAfterUserAdd',                  ['\Luxoft\Dev\Events\User', 'OnAfterUserAddRegister']);
        //EventManager::getInstance()->addEventHandler('main', 'OnAfterUserRegister',             ['\Luxoft\Dev\Events\User', 'OnAfterUserAddRegister']);


        //Order
        //EventManager::getInstance()->addEventHandler('sale', 'OnSaleOrderSaved',                ['\Luxoft\Dev\Events\Sale', 'saleOrderSaved']);
        //EventManager::getInstance()->addEventHandler('sale', 'OnBasketUpdate',                  ['\Luxoft\Dev\Events\Sale', 'OnBasketUpdate']);
        //EventManager::getInstance()->addEventHandler('sale', 'OnSalePayOrder',                  ['\Luxoft\Dev\Events\Sale', 'OnSalePayOrder']);
        //EventManager::getInstance()->addEventHandler('sale', 'onSaleBasketItemEntitySaved',     ['\Luxoft\Dev\Events\Sale', 'onSaleBasketItemEntitySaved']);


        //EMail
        //EventManager::getInstance()->addEventHandler('main', 'OnBeforeEventSend',               ['\Luxoft\Dev\Events\Email', 'OnBeforeEventSend']);
        //EventManager::getInstance()->addEventHandler('sale', 'OnOrderPaySendEmail',             ['\Luxoft\Dev\Events\Email', 'OnOrderPaySendEmail']);

        //Subscribe
        //EventManager::getInstance()->addEventHandler('subscribe', 'BeforePostingSendMail',      ['\Luxoft\Dev\Events\Email', 'BeforePostingSendMail']);

        //Sender
        //EventManager::getInstance()->addEventHandler('sender', 'OnTriggerList',                 ['\Luxoft\Dev\Events\Email', 'OnTriggerList']);

        //Form
        //EventManager::getInstance()->addEventHandler('form', 'onAfterResultAdd',                ['\Luxoft\Dev\Events\Form', 'onAfterResultAdd']);


        //Catalog
        //EventManager::getInstance()->addEventHandler('catalog', 'OnBeforePriceAdd',             ['\Luxoft\Dev\Events\Catalog', 'OnBeforePriceAdd']);
        //EventManager::getInstance()->addEventHandler('catalog', 'OnBeforePriceUpdate',          ['\Luxoft\Dev\Events\Catalog', 'OnBeforePriceUpdate']);

        //Main
        //EventManager::getInstance()->addEventHandler('main', 'OnBeforeProlog',                  ['\Luxoft\Dev\Events\Catalog', 'OnBeforeProlog']);
    }

    protected function init(): bool
    {
        if (!$this->checkInit()) {
            return false;
        }

        $this->initHandlers();
        return true;
    }
}