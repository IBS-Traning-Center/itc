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

class RolesTestingComponent extends CBitrixComponent
{

    /* Массив результата запроса в ИБ */
    private $rolesIBResult;

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
    public function getRolesTest()
    {
        return $this->rolesIBResult = ElementTestingTable::getList([
            'select' => [
                'PICTURES',
                'ROLES_TESTS_FIRST',
                'ROLES_TESTS_SECOND'
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
        if (!$this->rolesIBResult) {
            return false;
        }

        $item = [];
        $result = $this->rolesIBResult;

        if ($result->getPictures() && $result->getPictures()->getAll()) {
            foreach ($result->getPictures()->getAll() as $picture) {
                $item['PICTURES'][] = CFile::GetPath($picture->getValue());
            }
        }

        if ($result->getRolesTestsFirst() && $result->getRolesTestsFirst()->getAll()) {
            foreach ($result->getRolesTestsFirst()->getAll() as $role) {
                $item['ROLES_FIRST'][] = $role->getValue();
            }
        }

        if ($result->getRolesTestsSecond() && $result->getRolesTestsSecond()->getAll()) {
            foreach ($result->getRolesTestsSecond()->getAll() as $role) {
                $item['ROLES_SECOND'][] = $role->getValue();
            }
        }

        $this->rolesIBResult = $item;
    }

    /* Записываем результат в переменную */
    public function makeRolesTestResult()
    {
        $this->arResult = $this->rolesIBResult;
    }

    public function executeComponent(): void
    {
        $this->checkModules();

        $this->getRolesTest();
        $this->objectToArray();
        $this->makeRolesTestResult();

        $this->includeComponentTemplate();
    }
}
