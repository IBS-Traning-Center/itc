<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Документы");
?>
    <div class="open-wrap"><h2>Реквизиты</h2></div>
    <p id="dat1">
        АНО ДПО "УЦ ИБС":<br>
        Адрес юридический:<br>
        127434, г. Москва, Дмитровское шоссе, д. 9Б, этаж 5, помещение XIII, комната 31<br>
        Адрес почтовый:<br>
        127018, Москва, ул. Складочная, д. 3, стр. 1<br>
        ИНН 7713388004<br>
        КПП 771301001<br>
        ОГРН 1107799030470<br>
        ОКПО 68907823<br>
        р/с 40703810301400000206 в АО «АЛЬФА-БАНК»<br>
        к/с 30101810200000000593<br>
        БИК 044525593<br>
    </p>
    <h2>Документы</h2>
    <p id="dat2"></p>
<?php
$APPLICATION->IncludeComponent(
    'bitrix:news.list',
    'documents',
    [
        "IBLOCK_TYPE" => "edu_const",
        "IBLOCK_ID" => "181",
        "NEWS_COUNT" => "999",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "ID",
        "SORT_ORDER2" => "DESC",
        'FIELDS' => ['NAME'],
        "PROPERTY_CODE" => ['FILE', 'LONG_NAME'],
        "SET_TITLE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_LAST_MODIFIED" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
    ]
)
?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");