<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @global CUser $USER
 * @global CMain $APPLICATION
 */

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Iblock\Elements\ElementTestingTable;

Loc::loadMessages(__FILE__);

class VideoTestingComponent extends CBitrixComponent
{

    /* Массив результата запроса в ИБ */
    private $videoIBResult;

    /* Проверка подключения компонента */
    private function checkModules()
    {

        if (!Loader::includeModule('iblock')) {
            throw new SystemException(
                Loc::getMessage('IBLOCK_IS_NOT_INITIALIZED')
            );
        }

        return true;
    }

    /* Получаем элементы из раздела инфоблока */
    public function getVideoTest()
    {
        return $this->videoIBResult = ElementTestingTable::getList([
            'select' => [
                'VIDEO'
            ],
            'filter' => [
                'ACTIVE' => 'Y'
            ],
            'cache' => [
                'ttl' => 3600
            ]
        ])->fetch();
    }

    /* Записываем результат в переменную */
    public function makeVideoTestResult()
    {
        $this->arResult = $this->videoIBResult;
    }

    public function executeComponent(): void
    {
        $this->checkModules();

        $this->getVideoTest();
        $this->makeVideoTestResult();

        $this->includeComponentTemplate();
    }
}
