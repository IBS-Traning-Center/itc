<?php

use Bitrix\Main\Context;
use Bitrix\Main\Error;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorableImplementation;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Sale\Basket;
use Bitrix\Sale\Fuser;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class LuxoftOrderBasketBasket
    extends CBitrixComponent
    implements Controllerable, Errorable
{
    use ErrorableImplementation;

    public function __construct($component = null)
    {
        parent::__construct($component);
        $this->errorCollection = new ErrorCollection();
    }

    public function getErrors()
    {
        return $this->errorCollection->toArray();
    }

    protected function showErrors()
    {
        foreach ($this->getErrors() as $error) {
            ShowError($error);
        }
    }

    protected function checkModules()
    {
        Loc::loadMessages(__FILE__);

        if (!Loader::includeModule('sale')) {
            $this->errorCollection[] = new Error(Loc::getMessage('SALE_MODULE_NOT_INSTALL'));
            return false;
        }

        return true;
    }

    protected function checkRequiredParameters(): bool
    {
        /*
        if (empty($this->arParams['PRODUCT_FIELDS']))
        {
            $this->errorCollection[] = new \Bitrix\Main\Error('Product fields must be specified.');

            return false;
        }
        */
        return true;
    }

    protected function basketDelete($id = null) {
        if($id) {
            $objectBasket = Basket::getList(
                ['filter' => ['ID' => $id]]
            )->fetch();
            if($objectBasket) {
                $objectBasket->delete();
                $objectBasket->save();
            }
        }
    }
    protected function basketShelve($id = null) {
        if($id) {
            $objectBasket = Basket::getList(
                ['filter' => ['ID' => $id]]
            )->fetch();
            if($objectBasket) {
                $objectBasket->setDelay('Y');
                $objectBasket->save();
            }
        }
    }
    protected function basketAdd($id = null) {
        if($id) {
            $objectBasket = Basket::getList(
                ['filter' => ['ID' => $id]]
            )->fetch();
            if($objectBasket) {
                $objectBasket->setDelay('N');
                $objectBasket->save();
            }
        }
    }

    protected function addBasketItem()
    {

    }

    protected function removeBasketItem()
    {

    }

    protected function updateBasketItem()
    {

    }

    protected function getBasketItems()
    {
        $siteId = Context::getCurrent()
            ->getSite();

        $basketItems = Basket::loadItemsForFUser(Fuser::getId(), $siteId)
            ->getOrderableItems();

        if (count($basketItems) === 0) {
            $this->errorCollection[] = new Error(Loc::getMessage('Нет курсов в корзине'));
            return false;
        } else {
            foreach ($basketItems as $basketItem) {
                $this->arResult['ITEMS'][$basketItem->getId()] = [
                    'id' => $basketItem->getId(),
                ];
            }
        }
    }

    public function executeComponent()
    {

        if ($this->checkModules()
            && $this->checkRequiredParameters()
        ) {
            if($basketId = $this->request->get('id')) {
                switch ($this->request->get('action')) {
                    case 'delete':
                        $this->basketDelete($basketId);
                        break;
                    case 'shelve':
                        $this->basketShelve($basketId);
                        break;
                    case 'add':
                        $this->basketAdd($basketId);
                        break;
                }
            } else {
                $this->getBasketItems();
            }

            $this->errorCollection->clear();
            $this->includeComponentTemplate();
        }

        if ($this->hasErrors()) {
            $this->showErrors();
        }
    }
}