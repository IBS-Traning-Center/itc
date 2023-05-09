<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER; global $formAnswer;
$formAnswer = ['type' => 'error', 'message' => ''];

if (
    isset($_SERVER['HTTP_X_REQUESTED_WITH'])
    && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
) {
    if ($_POST['addField'] !== ''
        && check_bitrix_sessid()
        && CModule::IncludeModule("iblock")
    ) {
        $formAnswer = [
            'type' => 'error_1',
            'message' => 'addField'
        ];
    } else {
        $element = new CIBlockElement;
        $FIELDS = []; $PROPS = [];
        foreach ($_POST as $keyValue => $value) {
            $value = htmlspecialchars($value);
            if(strpos($keyValue, 'PROPERTY_') === false) {
                $FIELDS[$keyValue] = $value;
            } else {
                $CODE = str_replace('PROPERTY_','', $keyValue);
                $PROPS[$CODE] = $value;
            }
        }

        if($PROPS['fullname']) {
            $FULL_NAME = explode(' ', $PROPS['fullname']);
            if(empty($PROPS['lastname'])) {
                $PROPS['lastname'] = $FULL_NAME[0];
            }
            if(empty($PROPS['firstname'])) {
                $PROPS['firstname'] = $FULL_NAME[1];
            }
            if(empty($PROPS['middlename'])) {
                $PROPS['middlename'] = $FULL_NAME[2];
            }
        }

        $FIELDS['PROPERTY_VALUES'] = $PROPS;

        if ($elementID = $element->Add($FIELDS)) {
            $formAnswer['type'] = 'ok';
            $formAnswer['message'] = 'Element ID: '.$elementID;
            $formAnswer['FIELDS'] = $FIELDS;

            if(
                strpos('luxoft', strtolower($PROPS['email'])) !== false
                || strpos('luxoft', strtolower($PROPS['company'])) !== false
            ) {
                 CEvent::Send("DIFF_EVENTS_SEND", SITE_ID,
                              [
                                  'ID_RECORD' => $elementID,
                                  'EDU_EVENT_NAME' => $FIELDS['NAME'],
                                  'EDU_EVENT_USER_EMAIL' =>  $PROPS['email'],
                                  'EDU_EVENT_FIO' =>  $PROPS['fullname'],
                              ],
                              'Y',
                              211
                 );
            } else {
                CEvent::Send("DIFF_EVENTS_SEND", SITE_ID,
                     [
                         'USER_EMAIL' => $PROPS['email'],
                         'ID_RECORD' => $elementID,
                         'EDU_EVENT_NAME' => $FIELDS['NAME'],
                         'NAME' => $PROPS['fullname'],
                         'SCHOOL_NAME' => $PROPS['SCHOOL_NAME'],
                         'SCHOOL_DATE' => $PROPS['DATES'],
                         'SCHOOL_TIME' => $PROPS['SCHOOL_TIME'],
                         'SCHOOL_DURATION' => $PROPS['DURATION'],
                         'SCHOOL_COST' => $PROPS['COST'],
                         'SCHOOL_COST_UA' => $PROPS['COST_UA'],
                     ],
                     'Y',
                     $FIELDS['MESSAGE_ID']
                );
            }
            CEvent::Send(
            "DIFF_EVENTS_SEND",
            SITE_ID,
            [
                'TEXT' =>
                    '<b>запись на событие: </b>'.$FIELDS['NAME'].
                    '<br/> <b>тип: </b>'.'школа'.
                    '<br/> <b>дата: </b>'. $PROPS['DATES'].
                    '<br/> <b>длительность: </b>'. $PROPS['DURATION']. ' ч.'.
                    '<br/> <b>цена: </b>'. $PROPS['COST'] .'руб. ('.$PROPS['COST_UA'].' грн.)'.
                    '<br/> <b>фио: </b>'.$PROPS['fullname'].
                    '<br/> <b>телефон: </b>'.$PROPS['telephone'].
                    '<br/> <b>E-mail: </b>'. $PROPS['email'].
                    '<br/> <b>компания: </b>'. $PROPS['company'].
                    '<br/> <b>Комментарий к заявке: </b>'. $PROPS['COMMENT'],
                'ID_RECORD'=> $elementID,
                'EDU_MAIL'=> $PROPS['email'],
                'EDU_TYPE'=> 'школа',
                'EDU_EVENT_NAME'=> $FIELDS['NAME'],
                'EDU_EVENT_CITY'=> $PROPS['city'],
                'EDU_EVENT_COMMENT'=> $FIELDS['COMMENT'],
            ],
            'Y',
            206
            );
        } else {
            $formAnswer['message'] = $element->LAST_ERROR;
            $formAnswer['FIELDS'] = $FIELDS;
        };
        $userOrder = [

            'TYPE' => htmlspecialchars($_POST['TYPE']),
            'NAME' => htmlspecialchars($_POST['orderName']),
            'DURATION' => htmlspecialchars($_POST['orderDuration']),
            'DATES' => htmlspecialchars($_POST['orderDates']),
            'TIMES' => htmlspecialchars($_POST['orderTimes']),
            'COST' => htmlspecialchars($_POST['orderCost']),
            'SALE' => htmlspecialchars($_POST['orderCost']),

            'COURSE_ID' => htmlspecialchars($_POST['orderCourseID']),
            'SCHEDULE_ID' => htmlspecialchars($_POST['orderScheduleID']),

            'USER_ID' => htmlspecialchars($_POST['orderUserID']),
            'USER_NAME' => htmlspecialchars($_POST['orderUserID']),
            'USER_EMAIL' => htmlspecialchars($_POST['orderUserID']),
            'USER_PHONE' => htmlspecialchars($_POST['orderUserID']),
            'USER_COMPANY' => htmlspecialchars($_POST['orderUserID']),

        ];

        //message
        $arSend = [
            'NAME' => htmlspecialchars($_POST['NAME']),
            'SCHOOL_NAME' => htmlspecialchars($_POST['SCHOOL_NAME']),
            'SCHOOL_DATE' => htmlspecialchars($_POST['SCHOOL_DATE']),
            'SCHOOL_TIME' => htmlspecialchars($_POST['SCHOOL_TIME']),
            'SCHOOL_DURATION' => htmlspecialchars($_POST['SCHOOL_DURATION']),
            'SCHOOL_COST' => htmlspecialchars($_POST['SCHOOL_COST']),
        ];

    }
}

echo \Bitrix\Main\Web\Json::encode($formAnswer);


