<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

//require_once($_SERVER['DOCUMENT_ROOT']. "/local/lib/bitrix24.rest/CRest.php");


$arOrder = array();
$arFilter = array("IBLOCK_ID" => 64, "ID" => 140058);
$arGroupBy = false;
$arNavStartParams = false;
$arSelectFields = array(
    "NAME", "PROPERTY_FULLNAME", "PROPERTY_EMAIL", "PROPERTY_TYPE", "PROPERTY_DATE", "PROPERTY_COMPANY",
    "PROPERTY_TELEPHONE", "PROPERTY_CAT_COURSE", "PROPERTY_CITY", "PROPERTY_DOLGNOST", "PROPERTY_DOLGNOST", "PROPERTY_EVENT_CITY", "PROPERTY_EVENT_ID",
    "PROPERTY_TIMETABLE_ID", "PROPERTY_COMMENT", "PROPERTY_ID_CITY_ORDER", "PROPERTY_LINK_DISCOUNT", "PROPERTY_lastname", "PROPERTY_firstname", "PROPERTY_middlename");
$res2 = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);


while ($ob = $res2->GetNextElement()) {
    $arFields3 = $ob->GetFields();

    $orderer_courseID = $arFields3["PROPERTY_CAT_COURSE_VALUE"];

    $courseEducationFormat = false;
    if($orderer_courseID > 0 && $orderer_courseID != NULL) {
        $courseTypeData = CIBlockElement::GetList([], ["IBLOCK_ID" => 6, "ID" => $orderer_courseID], false, false, ["PROPERTY_EDUCATION_FORMAT"])->fetch();
        if ($courseTypeData['PROPERTY_EDUCATION_FORMAT_VALUE']) {
            $courseEducationFormat = $courseTypeData['PROPERTY_EDUCATION_FORMAT_VALUE'];
        }
    }

//    \Bitrix\Main\Diag\Debug::dump(var_export($orderer_courseID));
//    \Bitrix\Main\Diag\Debug::dump(var_export($courseEducationFormat));

}

$bxLidNameEducation = $courseEducationFormat ?? "Курс";
\Bitrix\Main\Diag\Debug::dump($bxLidNameEducation);


?>

    <?
/*
    \CRest::call(
        'crm.lead.add',
        [
            'fields' => [
                'TITLE' => 'Подписка: ',
                'UF_ITC_SOURSE' => '26',
                'NAME' => '$name',
                'EMAIL' => [
                    ["VALUE" => 'email@mail.ru', "VALUE_TYPE" => "WORK"],
                ],
                'COMMENTS' => "Уровень: ",
                'ASSIGNED_BY_ID' => '29',
                'CREATED_BY_ID' => '29',
            ]
        ]
    );
*/
?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>