<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Loader;

Loader::includeModule('sale');

function calculateBurnDate($userId)
{
	$dbTransact = CSaleUserTransact::GetList(
		array('TRANSACT_DATE' => 'ASC'),
		array('USER_ID' => $userId),
		false,
		false,
		array('*')
	);

	$balances = array();
	$transactions = array();

	while ($arTransact = $dbTransact->Fetch()) {
		$transactions[] = $arTransact;
	}

	foreach ($transactions as $trans) {
		$id = $trans['ID'];
		$isDebit = $trans['DEBIT'] == 'Y';
		$amount = floatval($trans['AMOUNT']);

		if ($isDebit) {
			$balances[] = array(
				'id' => $id,
				'date' => $trans['TRANSACT_DATE'],
				'amount' => $amount,
				'remaining' => $amount,
				'description' => $trans['DESCRIPTION']
			);
		} else {
			$amountToDeduct = $amount;
			foreach ($balances as &$balance) {
				if ($balance['remaining'] > 0 && $amountToDeduct > 0) {
					$deduct = min($balance['remaining'], $amountToDeduct);
					$balance['remaining'] -= $deduct;
					$amountToDeduct -= $deduct;
				}
			}
		}
	}

	$oldestActiveBalance = null;
	foreach ($balances as $balance) {
		if ($balance['remaining'] > 0) {
			$dateTime = DateTime::createFromFormat('d.m.Y H:i:s', $balance['date']);
			$balanceTimestamp = $dateTime ? $dateTime->getTimestamp() : 0;

			if ($oldestActiveBalance === null || $balanceTimestamp < $oldestActiveBalance['timestamp']) {
				$oldestActiveBalance = array(
					'id' => $balance['id'],
					'date' => $balance['date'],
					'amount' => $balance['amount'],
					'remaining' => $balance['remaining'],
					'timestamp' => $balanceTimestamp
				);
			}
		}
	}

	if ($oldestActiveBalance && $oldestActiveBalance['timestamp'] > 0) {

		$burnDate = DateTime::createFromFormat('d.m.Y H:i:s', $oldestActiveBalance['date']);
		$burnDate->add(new DateInterval('P2M'));

		$burnTimestamp = $burnDate->getTimestamp();

		return array(
			'date' => $burnDate->format('d.m.Y H:i'),
			'timestamp' => $burnTimestamp,
			'amount' => $oldestActiveBalance['remaining'],
			'original_date' => $oldestActiveBalance['date']
		);
	}

	return null;
}

function getBonusHistory($userId, $limit = 20)
{
	$history = array();

	$dbTransact = CSaleUserTransact::GetList(
		array('DATE_CREATE' => 'DESC'),
		array('USER_ID' => $userId),
		false,
		array('nPageSize' => $limit),
		array('*')
	);

	while ($arTransact = $dbTransact->Fetch()) {
		$history[] = $arTransact;
	}

	return $history;
}
function getOrderProductInfo($orderId)
{
	$productInfo = array(
		'name' => '',
		'link' => '',
		'description' => ''
	);

	if ($orderId > 0) {
		$dbOrder = CSaleOrder::GetList(
			array(),
			array('ID' => $orderId),
			false,
			false,
			array('ID', 'PAYED', 'CANCELED')
		);

		if ($arOrder = $dbOrder->Fetch()) {
			$dbBasket = CSaleBasket::GetList(
				array(),
				array('ORDER_ID' => $orderId),
				false,
				false,
				array('PRODUCT_ID', 'NAME', 'DETAIL_PAGE_URL')
			);

			if ($arBasket = $dbBasket->Fetch()) {
				$productInfo['name'] = $arBasket['NAME'];

				if ($arBasket['DETAIL_PAGE_URL']) {
					$productInfo['link'] = $arBasket['DETAIL_PAGE_URL'];
				} else {
					$dbProduct = CIBlockElement::GetByID($arBasket['PRODUCT_ID']);
					if ($arProduct = $dbProduct->Fetch()) {
						$productInfo['name'] = $arProduct['NAME'];
						$productInfo['link'] = CIBlock::ReplaceDetailUrl($arProduct['DETAIL_PAGE_URL'], $arProduct, false, 'E');
					}
				}
			}

			if ($arOrder['PAYED'] == 'Y') {
				$productInfo['description'] = 'за покупку курса';
			} elseif ($arOrder['CANCELED'] == 'Y') {
				$productInfo['description'] = 'за отмененный заказ';
			}
		}
	}

	return $productInfo;
}
function formatOperationDescription($description, $isDebit)
{
	$operationText = '';

	if ($description == 'MANUAL') {
		$operationText = 'Ручное начисление администратором';
	} elseif ($description == 'ORDER_PAY' && $isDebit) {
		$operationText = 'Начислено за оплату заказа';
	} elseif ($description == 'ORDER_PAY' && !$isDebit) {
		$operationText = 'Списано на оплату заказа';
	} elseif (strpos($description, 'BONUS_') !== false) {
		$operationText = 'Бонусная операция';
	} else {
		$operationText = htmlspecialcharsbx($description);
	}

	return $operationText;
}

global $USER;
$userId = $USER->GetID();

$arResult['CURRENT_BALANCE'] = calculateCurrentBalance($userId);


$arResult['BURN_INFO'] = calculateBurnDate($userId);


$arResult['HISTORY'] = getBonusHistory($userId);


$arResult['USER_ID'] = $userId;


?>