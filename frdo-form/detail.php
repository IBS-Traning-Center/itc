<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>
<?
$LINK_ID = '';
$CODE_ID = '';
$LINK = $_REQUEST['CODE'] . '/' . $_REQUEST['DATE'];
$rs = CIBlockElement::GetList(
    ['ID' => 'ASC'],
    ['IBLOCK_ID' => 180,
        [
            'LOGIC' => 'OR',
            ['PROPERTY_LINK' => '%' . $LINK . '%'],
            ['CODE' => $_REQUEST['CODE']],
        ]
    ],
    false,
    false,
    ['IBLOCK_ID', 'ID', 'CODE', 'PROPERTY_LINK']
);
while ($arRes = $rs->GetNext()) {
    if(strpos($arRes['PROPERTY_LINK_VALUE'], $LINK) !== false) {
        $LINK_ID = $arRes['ID'];
    }
    if($arRes['CODE'] === $_REQUEST['CODE']) {
        $CODE_ID = $arRes['ID'];
    }
}
if(!empty($LINK_ID) || !empty($CODE_ID)) {
    $APPLICATION->IncludeComponent(
        "bitrix:news.detail",
        "frdo-form",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "IBLOCK_TYPE" => "polls",
            "IBLOCK_ID" => "180",
            "ELEMENT_ID" => ($LINK_ID) ? $LINK_ID : $CODE_ID,
            "ELEMENT_CODE" => "",
            "CHECK_DATES" => "Y",
            "FIELD_CODE" => ["*"],
            "PROPERTY_CODE" => ["*"],
            "IBLOCK_URL" => "",
            "DETAIL_URL" => "",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_GROUPS" => "Y",
            "SET_TITLE" => "Y",
            "SET_CANONICAL_URL" => "N",
            "SET_BROWSER_TITLE" => "Y",
            "BROWSER_TITLE" => "-",
            "SET_META_KEYWORDS" => "Y",
            "META_KEYWORDS" => "-",
            "SET_META_DESCRIPTION" => "Y",
            "META_DESCRIPTION" => "-",
            "SET_LAST_MODIFIED" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
            "ADD_SECTIONS_CHAIN" => "Y",
            "ADD_ELEMENT_CHAIN" => "N",
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "USE_PERMISSIONS" => "N",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "USE_SHARE" => "N",
            "PAGER_TEMPLATE" => ".default",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "Страница",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "SET_STATUS_404" => "Y",
            "SHOW_404" => "Y",
            "MESSAGE_404" => "",
            "FILE_404" => ""
        )
    );
} else {
    LocalRedirect('/frdo-form/');
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
