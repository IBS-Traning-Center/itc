<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Loader;

Loader::includeModule('sale');

function calculateCurrentBalance($userId)
{
    $currentBalance = 0;

    if ($userId) {
        $dbUserAccount = CSaleUserAccount::GetList(
            array(),
            array('USER_ID' => $userId, 'CURRENCY' => 'RUB')
        );

        if ($arUserAccount = $dbUserAccount->Fetch()) {
            $currentBalance = $arUserAccount['CURRENT_BUDGET'];
        }
        if ($currentBalance == 0) {
            $dbTransact = CSaleUserTransact::GetList(
                array(),
                array('USER_ID' => $userId),
                false,
                false,
                array('AMOUNT', 'DEBIT')
            );

            $manualBalance = 0;
            while ($arTransact = $dbTransact->Fetch()) {
                $amount = floatval($arTransact['AMOUNT']);
                if ($arTransact['DEBIT'] == 'Y') {
                    $manualBalance += $amount;
                } else {
                    $manualBalance -= $amount;
                }
            }
            $currentBalance = $manualBalance;
        }
    }

    return $currentBalance;
}

global $USER;
$userId = $USER->GetID();
$arParams['USER_BALANCE'] = (int)calculateCurrentBalance($userId);
?>