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

class SchemeTestingComponent extends CBitrixComponent
{

    /* Массив результата запроса в ИБ */
    private $schemeIBResult;

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
    public function getSchemeTest()
    {
        return $this->schemeIBResult = ElementTestingTable::getList([
            'select' => [
                'PROCESS_TEST'
            ],
            'filter' => [
                'ACTIVE' => 'Y'
            ],
            'cache' => [
                'ttl' => 3600
            ]
        ])->fetchObject();
    }

    public function objectToArray()
    {
        if (!$this->schemeIBResult) {
            return false;
        }

        $item = [];
        $result = $this->schemeIBResult;

        if ($result->getProcessTest() && $result->getProcessTest()->getAll()) {
            foreach ($result->getProcessTest()->getAll() as $process) {
                $item[] = [
                    'VALUE' => $process->getValue() ?: '',
                    'DESCRIPTION' => $process->getDescription() ?: ''
                ];
            }
        }

        $this->schemeIBResult = $item;
    }

    /* Записываем результат в переменную */
    public function makeSchemeTestResult()
    {
        $this->arResult = $this->schemeIBResult;
    }

    public function executeComponent(): void
    {
        $this->checkModules();

        $this->getSchemeTest();
        $this->objectToArray();
        $this->makeSchemeTestResult();

        $this->includeComponentTemplate();
    }
}
