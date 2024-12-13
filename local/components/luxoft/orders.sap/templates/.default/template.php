<?php

/**
 * @var array $arParams
 * @var array $arResult
 */

global $APPLICATION;

Bitrix\Main\Page\Asset::getInstance()->addCss('/bitrix/css/main/grid/webform-button.css');

// Выводим 2 поля и кнопку скачать и добавляем лоудер

?>
<form method="get" action="<?= $APPLICATION->GetCurPage() ?>">
    <input class="field" type="date" name="search_date_from" value="<?= $arResult['SEARCH_DATE_FROM'] ?>" placeholder="Дата от">
    <input class="field" type="date" name="search_date_to" value="<?= $arResult['SEARCH_DATE_TO'] ?>" placeholder="Дата до">
    <button type="submit">Посмотреть</button>
    <button type="submit" name="mode" value="excel">Скачать</button>
</form>
<br>

<?php
$APPLICATION->IncludeComponent(
    'bitrix:main.ui.grid',
    '',
    [
        'GRID_ID' => 'orders-sap',
        'HEADERS' => $arResult['HEADERS'],
        'ROWS' => $arResult['ROWS'],
        'PAGE_SIZES' => [
            ['NAME' => "5", 'VALUE' => '5'],
            ['NAME' => '10', 'VALUE' => '10'],
            ['NAME' => '20', 'VALUE' => '20'],
            ['NAME' => '50', 'VALUE' => '50'],
            ['NAME' => '100', 'VALUE' => '100']
        ],
        'ALLOW_PIN_HEADER' => true,
        'ALLOW_COLUMN_RESIZE' => true,
        'ALLOW_COLUMNS_SORT' => false,
        'SHOW_ROW_CHECKBOXES' => false,
        'SHOW_CHECK_ALL_CHECKBOXES' => false,
        'SHOW_ACTION_PANEL' => false,
        'SHOW_PAGINATION' => true,
        'SHOW_NAVIGATION_PANEL' => false,
        'SHOW_GRID_SETTINGS_MENU' => true,
    ]
);
?>