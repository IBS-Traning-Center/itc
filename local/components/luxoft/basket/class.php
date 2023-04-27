<?php

use Bitrix\Main\Context;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Error;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorableImplementation;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Sale\Basket;
use Bitrix\Sale\Fuser;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class LuxoftBasket
    extends CBitrixComponent
    implements Controllerable, Errorable
{
    use ErrorableImplementation;

    private $basket;
    private $basketItems;
    private $postData;
    private $queryData;

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

    private function getRequestData($property = null)
    {
        try {
            $this->postData = \Bitrix\Main\Web\Json::decode($this->request->getInput());
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }

        try {
            $this->queryData = $this->request->getQueryList()->getValues();;
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }

        $allData = array_merge($this->queryData, $this->postData);
        return ($property) ? $allData[$property] : $allData;
    }

    private function showJsonResponse($data)
    {
        global $APPLICATION;
        header('Content-Type: application/json');
        $APPLICATION->RestartBuffer();
        echo \Bitrix\Main\Web\Json::encode($data);
        die();
    }

    protected function getBasket()
    {

        $siteId = Context::getCurrent()
            ->getSite();
        $this->basket = Basket::loadItemsForFUser(Fuser::getId(), $siteId);

        return $this->basket;
    }

    protected function getBasketItems()
    {
        $basket = $this->getBasket();
        $this->basketItems = $basket->getOrderableItems();

        if (count($this->basketItems) === 0) {
            $this->errorCollection[] = new Error(Loc::getMessage('Нет курсов в корзине'));
            return false;
        } else {
            foreach ($this->basketItems as $basketItem) {
                $currentBasketItem = [
                    'id' => $basketItem->getField('ID'),
                    'name' => $basketItem->getField('NAME'),
                    'basePrice' => $this->priceFormat($basketItem->getField('BASE_PRICE')),
                    'price' => $this->priceFormat($basketItem->getField('PRICE')),
                    'quantity' => round($basketItem->getField('QUANTITY')),
                    'url' => $basketItem->getField('DETAIL_PAGE_URL'),
                ];

                if ($currentBasketItem['basePrice'] && $currentBasketItem['price']) {
                    $currentBasketItem['discount'] = $this->priceFormat($currentBasketItem['price'] - $currentBasketItem['basePrice']);
                }

                foreach ($basketItem->getPropertyCollection() as $basketProperty) {
                    switch ($basketProperty->getField('CODE')) {
                        case 'COURSE_CODE':
                            $currentBasketItem['code'] = $basketProperty->getField('VALUE');
                            break;
                        case 'CITY_NAME':
                            $currentBasketItem['city'] = $basketProperty->getField('VALUE');
                            break;
                        case 'STARTDATE':
                            $currentBasketItem['date'] = $basketProperty->getField('VALUE');
                            break;
                        case 'SCHEDULE_TIME':
                            $currentBasketItem['time'] = $basketProperty->getField('VALUE');
                            break;
                    }
                }

                $this->arResult['items'][$basketItem->getId()] = $currentBasketItem;
            }

            $this->arResult['total'] = [
                'cost' => $this->priceFormat($basket->getPrice()),
                'fullCost' => $this->priceFormat($basket->getBasePrice()),
            ];
        }
    }

    protected function removeItem($item)
    {
        $basket = $this->getBasket();
        if ($item = $basket->getItemById($item['id'])) {
            $item->delete();
            $basket->save();
        }
    }

    protected function updateItem($item)
    {
        $basket = $this->getBasket();
        if ($itemObject = $basket->getItemById($item['id'])) {
            $itemObject->setField('QUANTITY', (int) $item['quantity']);
            $itemObject->save();
            $basket->save();
        }
    }

    protected function priceFormat($price)
    {
        return number_format($price, 0, '', ' ');
    }


    public function configureActions()
    {
        // TODO: Implement configureActions() method.
    }

    public function executeComponent()
    {

        if ($this->checkModules()
            && $this->checkRequiredParameters()
        ) {
            switch ($this->request->get('action')) {
                case 'removeItem':
                    if ($item = $this->getRequestData('item')) {
                        $this->removeItem($item);
                    }
                    $this->getBasketItems();
                    $this->showJsonResponse(['success' => true, 'result' => $this->arResult]);
                    break;
                case 'updateItem':
                    if ($item = $this->getRequestData('item')) {
                        $this->updateItem($item);
                    }

                    $this->getBasketItems();
                    $this->showJsonResponse(['success' => true, 'result' => $this->arResult]);
                    break;
                default:
                    $this->getBasketItems();
                    break;
            }

            $this->errorCollection->clear();
            $this->includeComponentTemplate();
        }

        if ($this->hasErrors()) {
            $this->showErrors();
        }
    }
}