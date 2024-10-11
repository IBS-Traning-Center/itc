<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @global CMain $APPLICATION
 */

use Bitrix\Main\Localization\Loc;
use CBitrixComponent;

Loc::loadMessages(__FILE__);

class MainPageSubscribeComponent extends CBitrixComponent
{

    private $title;
    private $link;

    /* получаем из параметров компонента инфу */
    private function getComponentParams()
    {
        if ($this->arParams['SUBSCRIBE_TITLE']) {
            $this->title = $this->arParams['SUBSCRIBE_TITLE'];
        }

        if ($this->arParams['SUBSCRIBE_LINK']) {
            $this->link = $this->arParams['SUBSCRIBE_LINK'];
        }
    }

    /* Записываем результат в переменную */
    public function makeItemsResult()
    {
        $this->arResult['TITLE'] = $this->title;
        $this->arResult['LINK'] = $this->link;
    }

    public function executeComponent(): void
    {
        $this->getComponentParams();
        $this->makeItemsResult();

        $this->includeComponentTemplate();
    }
}
