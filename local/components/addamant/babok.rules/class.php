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
use Bitrix\Iblock\Elements\ElementBabokTable;

Loc::loadMessages(__FILE__);

class BabokRulesComponent extends CBitrixComponent
{

    /* Массив результата запроса в ИБ */
    private $rulesIBResult;

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
    public function getRulesBabok()
    {
        return $this->rulesIBResult = ElementBabokTable::getList([
            'select' => [
                'RULES_HEADING',
                'RULES_TEXT'
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
        if (!$this->rulesIBResult) {
            return false;
        }

        $item = [];
        $result = $this->rulesIBResult;

        if ($result->getRulesHeading() && $result->getRulesHeading()->getAll()) {
            foreach ($result->getRulesHeading()->getAll() as $key => $rulesHeading) {
                $item[$key]['HEADING'] = $rulesHeading->getValue() ?: '';
            }
        }

        if ($result->getRulesText() && $result->getRulesText()->getAll()) {
            foreach ($result->getRulesText()->getAll() as $key => $rulesText) {
                $item[$key]['TEXT'] = $rulesText->getValue() ?: '';
            }
        }

        $this->rulesIBResult = $item;
    }

    /* Записываем результат в переменную */
    public function makeRulesBabokResult()
    {
        $this->arResult = $this->rulesIBResult;
    }

    public function executeComponent(): void
    {
        $this->checkModules();

        $this->getRulesBabok();
        $this->objectToArray();
        $this->makeRulesBabokResult();

        $this->includeComponentTemplate();
    }
}
