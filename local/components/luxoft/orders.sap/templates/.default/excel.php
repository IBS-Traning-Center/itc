<?php

use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
define('NO_KEEP_STATISTIC', 'Y');
define('NO_AGENT_STATISTIC', 'Y');
define('NO_AGENT_CHECK', true);
define('DisableEventsCheck', true);
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var array $templateData */
/** @var FilterAndGrid $component */

$APPLICATION->RestartBuffer();?>
<meta http-equiv="Content-type" content="text/html;charset=<?= LANG_CHARSET ?>"/>
<table border="1">
    <thead>
        <tr><?php
        foreach ($arResult['HEADERS'] as $header) {?>
            <th><?= $header['name'] ?></th><?php
        }?></tr>
    </thead>
    <tbody>
        <?php
        foreach ($arResult['ROWS'] as $row) {
            ?><tr>
            <?php foreach ($row['data'] as $field) {?>
                <td><?= $field ?></td>
            <?php }?>
            </tr><?php
        }?>
    </tbody>
</table>