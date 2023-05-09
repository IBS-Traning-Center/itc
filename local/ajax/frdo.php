<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER; global $formAnswer;
$formAnswer = ['type' => 'error', 'message' => ''];

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if($_POST['addField'] !== '' && check_bitrix_sessid()) {
        $formAnswer = [
            'type' => 'error_1',
            'message' => 'addField'
        ];
    } else {
        foreach ($_POST as &$postValue)  {
            $postValue = htmlspecialchars($postValue);
        }
        if(\Bitrix\Main\Loader::includeModule('iblock'))
        {
            if($_POST['COURSE']) {
                $rsSchedule = CIBlockElement::GetList(
                    [],
                    ['IBLOCK_ID' => '9', 'ID' => $_POST['COURSE']],
                    false,
                    false,
                    [
                        'ID',
                        'NAME',
                        'CODE',
                        'PROPERTY_course_code',
                        'PROPERTY_startdate',
                        'PROPERTY_enddate'
                    ]
                );
                if ($arResult = $rsSchedule->GetNext()) {
                    $el = new CIBlockElement;
                    $result = $el->Add(
                        [
                            'IBLOCK_ID' => 179,
                            'NAME' => date('h:i:s d-m-Y'),
                            'PROPERTY_VALUES' => [
                                'FIO' => $_POST['FIO'],
                                'PHONE' => $_POST['PHONE'],
                                'EMAIL' => $_POST['EMAIL'],
                                'BIRTHDAY' => $_POST['BIRTHDAY'],
                                'SNILS' => $_POST['SNILS'],
                                'ADDRESS' => $_POST['ADDRESS'],
                                'POSITION' => ($_POST['POSITION'] !== 'other') ? $_POST['POSITION'] : $_POST['POSITION_CUSTOM'],
                                'COMPANY' =>    $_POST['COMPANY'],
                                'COURSE_ID' => $arResult['ID'],
                                'COURSE_CODE' => $arResult['PROPERTY_COURSE_CODE_VALUE'],
                                'COURSE_NAME' => $arResult['NAME'],
                                'COURSE_DATE' => $arResult['PROPERTY_ENDDATE_VALUE'] ? $arResult['PROPERTY_STARTDATE_VALUE'] . ' - ' . $arResult['PROPERTY_ENDDATE_VALUE'] : $arResult['PROPERTY_STARTDATE_VALUE'],
                            ]
                        ]
                    );
                    $formAnswer['message'] = $arResult;
                    if ($result) {
                        $formAnswer['type'] = 'ok';
                    }
                }
            } else {
                $el = new CIBlockElement;
                $result = $el->Add(
                    [
                        'IBLOCK_ID' => 179,
                        'NAME' => date('h:i:s d-m-Y'),
                        'PROPERTY_VALUES' => [
                            'FIO' => $_POST['FIO'],
                            'PHONE' => $_POST['PHONE'],
                            'EMAIL' => $_POST['EMAIL'],
                            'BIRTHDAY' => $_POST['BIRTHDAY'],
                            'SNILS' => $_POST['SNILS'],
                            'ADDRESS' => $_POST['ADDRESS'],
                            'POSITION' => ($_POST['POSITION'] !== 'other') ? $_POST['POSITION'] : $_POST['POSITION_CUSTOM'],
                            'COMPANY' => $_POST['COMPANY'],
                            'COURSE_CODE' => $_POST['COURSE-CODE'],
                            'COURSE_NAME' => $_POST['COURSE-NAME'],
                            'COURSE_DATE' => $_POST['COURSE-DATE'],
                        ]
                    ]
                );
                $formAnswer['message'] = $arResult;
                if ($result) {
                    $formAnswer['type'] = 'ok';
                }
            }
        }
    }
}

echo \Bitrix\Main\Web\Json::encode($formAnswer);
