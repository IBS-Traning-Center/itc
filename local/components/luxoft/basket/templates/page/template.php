<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * @var $arResult ;
 * @var $arParams ;
 * @var CMain $APPLICATION ;
 */

use Bitrix\Main\Localization\Loc;

$lang = [
    'columnName' => Loc::getMessage('SALE_NAME'),
    'columnPrice' => Loc::getMessage('SALE_PRICE'),
    'columnDiscount' => Loc::getMessage('SALE_DISCOUNT'),
    'columnQuantity' => Loc::getMessage('SALE_QUANTITY'),
    'columnAction' => Loc::getMessage('SALE_ACTION'),
    'discount' => Loc::getMessage('SALE_CONTENT_DISCOUNT'),
    'total' => Loc::getMessage('SALE_ITOGO'),
    'order' => Loc::getMessage('SALE_ORDER'),
];

if (strlen($arResult["ERROR_MESSAGE"]) <= 0) {
    if (count($arResult["items"]) > 0) { ?>
        <div class="basket-page" id="basketPage"></div>
        <script>
            if(typeof window.vueData === 'undefined') {
                window.vueData = {}
            }
            window.vueData['basketPage'] = <?= CUtil::PhpToJSObject($arResult) ?>;
            window.vueData['basketPage']['lang'] = <?= CUtil::PhpToJSObject($lang) ?>;
        </script>
    <?php } else {
        echo ShowNote(GetMessage("SALE_NO_ACTIVE_PRD"));
    }
} else {
    ShowNote($arResult["ERROR_MESSAGE"]);
}?>

