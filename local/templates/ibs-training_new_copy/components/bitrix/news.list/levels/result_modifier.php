<?

foreach ($arResult["ITEMS"] as $keyItem => &$arItem):
    $arItem['PROPS_LIST'] = [];
    $arFilter = array(
        "IBLOCK_ID" => intval($arItem['PROPERTIES']['PROPS']['LINK_IBLOCK_ID']),
        "ID" => $arItem['PROPERTIES']['PROPS']['VALUE']
    );

    $arSelect = array("ID", "NAME", "PROPERTY_ICON", "PROPERTY_VAL");
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $prop = $ob->GetFields();
        $arItem['PROPS_LIST'][$prop['ID']]['PROPERTY_ICON_VALUE'] = CFile::GetPath($prop['PROPERTY_ICON_VALUE']);
        $arItem['PROPS_LIST'][$prop['ID']]['NAME'] = $prop['NAME'];
        $arItem['PROPS_LIST'][$prop['ID']]['PROPERTY_VAL_VALUE'] = $prop['PROPERTY_VAL_VALUE'];
    }
endforeach;
