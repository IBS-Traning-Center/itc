<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arResult['EVENT'] = [
    'NAME' => $arResult["NAME"],
    'TYPE' => ($arResult["PROPERTIES"]["type_event"]["VALUE_ENUM_ID"] == 92) ? 'Вебинар' : 'Семинар',
    'SEMINAR_ID' => $arResult["ID"],
    'TIME' => $arResult['PROPERTIES']['time']['VALUE'],
    'DATE' => date('d.m.Y', strtotime($arResult['PROPERTIES']['startdate']['VALUE'])),
    'PLACE' => $arResult['PROPERTIES']['location']['VALUE'],
    'LECTURE' => $arResult['PROPERTIES']['lecturer']['VALUE'],

    'DESCRIPTION' => nl2br(strip_tags($arResult['PROPERTIES']['description']['~VALUE'], '<a>')),
    'SHORT_DESCRIPTION' => trim($arResult['PROPERTIES']['ADDITIONAL_DESC']['~VALUE']['TEXT']),
    'CONTENT' => nl2br($arResult['PROPERTIES']['content']['VALUE']),
    'PEOPLE' => nl2br($arResult['PROPERTIES']['people']['VALUE']),

    'TITLE' => $arResult['PROPERTIES']['titlefile']['VALUE'],
    'BANNER' => CFile::GetPath($arResult['PROPERTIES']['BANNER']['VALUE'])
];

$arResult['EVENT']['TIME-DATE-PLACE'] = (!empty($arResult['EVENT']['TIME']) || !empty($arResult['EVENT']['DATE']) || !empty($arResult['EVENT']['PLACE'])) ? 'Y' : 'N';

$arResult['COURSE'] = [
    'ADD_SOURCES' => checkHtmlN($arResult['PROPERTIES']['course_addsources']['~VALUE']),
    'OTHER' => checkHtmlN($arResult['PROPERTIES']['course_other']['~VALUE'])
];

if (CModule::IncludeModule("iblock")) {
    if (!empty($arResult['PROPERTIES']['trener']['VALUE'])) {
        $arFilter = array("IBLOCK_ID" => 56, "ID" => $arResult['PROPERTIES']['trener']['VALUE']);
        $arSelect = array("ID", "NAME", "CODE", "DETAIL_TEXT", "DETAIL_PICTURE", "PROPERTY_EXPERT_SHORT", "PROPERTY_EXPERT_NAME");
        $db_trainer = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        if ($arTrainer = $db_trainer->GetNext()) {
            $arResult['EVENT']['TRAINER'] = [
                'ID' => $arTrainer["ID"],
                'CODE' => $arTrainer["CODE"],
                'NAME' => $arTrainer["NAME"] . " " . $arTrainer["PROPERTY_EXPERT_NAME_VALUE"],
                'SHORT' => $arTrainer["PROPERTY_EXPERT_SHORT_VALUE"],
                "DESCRIPTION" => $arTrainer["DETAIL_TEXT"],
                "PHOTO" => CFile::GetPAth($arTrainer["DETAIL_PICTURE"])
            ];
        }
        unset($arFilter, $arSelect, $db_trainer, $arTrainer);
    }

    $arFilter = array("IBLOCK_ID" => "51", "ID" => $arResult['PROPERTIES']['city']['VALUE']);
    $db_city = CIBlockElement::GetList(array(), $arFilter, false, false, array('ID', 'NAME'));
    if ($arCity = $db_city->GetNext()) {
        $arResult['EVENT']['CITY'] = $arCity["NAME"];
    }
    unset($arFilter, $db_city, $arCity);

    /*
        get array of courses before
    */
    if (!empty($arResult["PROPERTIES"]["ID_PREDV_COURSES"]["VALUE"])) {
        $arResult['ADDITONAL']['PREDVARIT'] = GetAllTimetableCoursesArray($arResult["PROPERTIES"]["ID_PREDV_COURSES"]["VALUE"]);

    }

    /*
        get array of courses linked
    */
    if (!empty($arResult["PROPERTIES"]["ID_LINKED_COURSES"]["VALUE"])) {
        $arResult['ADDITONAL']['LINKED'] = GetAllTimetableCoursesArray($arResult["PROPERTIES"]["ID_LINKED_COURSES"]["VALUE"]);
    }
}



$cp = $this->__component;
if (is_object($cp))
{
    $cp->arResult['START_DATE'] = $arResult['PROPERTIES']['startdate']['VALUE'];
    $cp->arResult['FLAG_CLOSE_REG'] = $arResult["PROPERTIES"]["FLAG_CLOSE_REG"]["VALUE_ENUM_ID"];
    $cp->arResult['TYPE_EVENT'] = $arResult["PROPERTIES"]["type_event"]["VALUE_ENUM_ID"];
    $cp->arResult['DATE_EVENT'] = $arResult['EVENT']['DATE'];
    $cp->arResult['CITY_EVENT'] = $arResult['EVENT']['DATE'];
    $cp->SetResultCacheKeys(array('START_DATE','FLAG_CLOSE_REG','TYPE_EVENT','DATE_EVENT','CITY_EVENT'));
}