<?php

namespace Luxoft\Dev\Tools;

use Bitrix\Main\Error;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\ErrorableImplementation;

class Mail implements Errorable
{
    use ErrorableImplementation;

    /** @var ErrorCollection */
    protected $errorCollection;

    private function __construct()
    {
        $this->errorCollection = new ErrorCollection();
    }

    /**
     * Getting array of errors.
     * @return Error[]
     */
    public function getErrors(): array
    {
        return $this->errorCollection->toArray();
    }

    /**
     * Getting once error with the necessary code.
     * @param string $code Code of error.
     * @return Error|null
     */
    public function getErrorByCode($code): ?Error
    {
        return $this->errorCollection->getErrorByCode($code);
    }

    public static function sendMailEventRegistration($fields): void
    {
        $sendFields = [
            'USER_IP' => $_SERVER['REMOTE_ADDR'],
            'CONTACT_RECEIVERS' => '', // почты менеджеров
            //'WEB_FORM_ID',
            //'ID_FORM_RECORD',
            'RESULT_ID' => $fields['ID'],

            'EMAIL_TO_SEND' => $fields['PROPERTY_VALUES']['email'],

            'F_NAME' => $fields['PROPERTY_VALUES']['firstname'],
            'F_LAST_NAME' => $fields['PROPERTY_VALUES']['lastname'],
            'F_EMAIL' => $fields['PROPERTY_VALUES']['email'],
            'F_TEL' => $fields['PROPERTY_VALUES']['telephone'],
            'F_COMPANY' => $fields['PROPERTY_VALUES']['company'],
            'F_COMMENT' => $fields['PROPERTY_VALUES']['comment'],
            'F_LOCATION' => $fields['PROPERTY_VALUES']['city'],
            'F_DATES' => '',

            'F_SCHEDULE_ID' => $fields["PROPERTY_VALUES"]["timetable_id"] ?? '',
            'DATE_EVENT_START' => $fields["PROPERTY_VALUES"]["date_event"] ? $fields["PROPERTY_VALUES"]["date_event"]->format('m-d-Y') : '',
            'TIME_EVENT_START' => $fields["PROPERTY_VALUES"]["eventTime"],
            'LOCATION_SCHEDULE' => $fields["PROPERTY_VALUES"]["eventLocation"],

            'ID_ELEMENT' => $fields['PROPERTY_VALUES']['cat_course'],
            'ELEMENT_CODE' => $fields['PROPERTY_VALUES']['courseCode'],
            'ELEMENT_NAME' => $fields['PROPERTY_VALUES']['courseName'],
            'DETAIL_PAGE_URL' => $fields['PROPERTY_VALUES']['detailUrl'], // ссылка на курс

            'RELATED_COURSES' => ''
        ];

        $sendFields['RELATED_COURSES'] .= '<ul>';
        foreach ($fields['PROPERTY_VALUES']['recommendations'] as $recommendation) {
            $sendFields['RELATED_COURSES'] .= "<li><a href=\"https://www.luxoft-training.com{$recommendation['link']}\">{$recommendation['code']} {$recommendation['name']}</a></li>";
        }
        $sendFields['RELATED_COURSES'] .= '</ul>';

        /*
         * определяем сотрудников Luxoft
         */
        $checkFields = ['EMAIL_TO_SEND','F_COMPANY', 'F_EMAIL'];
        $isLuxofEmployee = \Luxoft\Dev\Tools::searchLuxoftName($sendFields, $checkFields);
        $isSchedule = !empty($sendFields['F_SCHEDULE_ID']);

        $mailTemplates = [
            'sl' => $isSchedule ? 165 : 166,
            'pl' => $isSchedule ? 168 : 167,
            'en' => $isSchedule ? 133 : 132
        ];
        if($isLuxofEmployee) {
            \CEvent::Send('EN_NOTIFICATION_FORM', SITE_ID, $sendFields, 'N', 147);
        } else {
            \CEvent::Send('EN_NOTIFICATION_FORM', SITE_ID, $sendFields, 'N', $mailTemplates[SITE_ID]);
        }

        /*
        * Отправляем уведомления менеджерам
        */
        $sendFields['EMAIL_TO_SEND'] = '';
        $notificationUsers = \CGroup::GetGroupUser(EN_GROUP_NOTIFICATIONS_ABOUT_APPLICATIONS);
        $managersEmails = [];
        foreach ($notificationUsers as $userID){
            $rsUser = \CUser::GetByID($userID);
            $arUser = $rsUser->Fetch();
            $managersEmails[] = $arUser["EMAIL"];
        }
        $sendFields['EMAIL_TO_SEND'] = implode(';',$managersEmails);
        //TODO переместить в проверку всех писем
        if($isSchedule) {
            \CEvent::Send('EN_NOTIFICATION_FORM', SITE_ID, $sendFields, 'N', T_EN_NOTICATION_ABOUT_EVENT_SPECIFIC_DATE);
        } else {
            \CEvent::Send('EN_NOTIFICATION_FORM', SITE_ID, $sendFields, 'N', T_EN_SIMPLE_NOTICATION_ABOUT_EVENT_APPLICATIONS);
        }
    }
}