<?php

namespace Sprint\Migration;

use Bitrix\Main\Loader;
use Bitrix\Main\PhoneNumber\Format;
use Bitrix\Main\PhoneNumber\Parser;
use Bitrix\Iblock\Elements\ElementTrainersTable;

class TeacherToBin20230730203945 extends Version
{
    protected $description = "";

    protected $moduleVersion = "4.3.1";

    public function up()
    {
        if(!Loader::includeModule('iblock')) {
            return false;
        }

        $teacherResult = ElementTrainersTable::getList([
            'order' => ['ID' => 'ASC'],
            'select' => [
                '*',
                'expert_name',
                'EXPERT_EMAIL1',
                'EXPERT_EMAIL2',
                'EXPERT_TEL',
                'EXPERT_TELSOT',
                'EXPERT_SKYPE',
                'EXPERT_COUNTRY',
                'EXPERT_CITY',
                'EXPERT_COMPANY',
            ],
        ]);
        $teacherCollection = $teacherResult->fetchCollection();

        $data = [];
        foreach ($teacherCollection as $teacher) {
            $data[] = $this->getData($teacher);
        }

        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/local/teachers.bin';
        $packedData = msgpack_pack($data);
        file_put_contents($filePath, $packedData);

        return true;
    }

    public function down()
    {
        //your code ...
    }

    public function getData($teacher)
    {
        $phoneParser = Parser::getInstance();

        $name = $teacher->getName() . ' ' . $teacher->get('expert_name')?->getValue();
        $nameData = explode(' ', $name);
        $nameData = array_map(function ($namePart) {
            $namePart = mb_convert_case($namePart, MB_CASE_TITLE);
            return trim($namePart);
        }, $nameData);
        [$lastName, $firstName, $middleName] = $nameData;
        $fullName = implode(' ', [$lastName, $firstName, $middleName]);

        $date_create = $teacher->getDateCreate();
        $date_change = $teacher->getTimestampX();

        $result = [
            'id' => $teacher->getId(),
            'active' => $teacher->getActive(),
            'sort' => $teacher->getSort(),
            'name' => $fullName,
            'date_create' => $date_create,
            'date_change' => $date_change,
            'last_name' => $lastName,
            'first_name' => $firstName,
            'second_name' => $middleName,
            'email_1' => $teacher->get('EXPERT_EMAIL1')?->getValue(),
            'email_2' => $teacher->get('EXPERT_EMAIL2')?->getValue(),
            'phone' => $teacher->get('EXPERT_TEL')?->getValue(),
            'phone_mobile' => $teacher->get('EXPERT_TELSOT')?->getValue(),
            'skype' => $teacher->get('EXPERT_SKYPE')?->getValue(),
            'country' => $teacher->get('EXPERT_COUNTRY')?->getValue(),
            'city' => $teacher->get('EXPERT_CITY')?->getValue(),
            'company' => $teacher->get('EXPERT_COMPANY')?->getValue(),
        ];

        $result = array_map('trim', $result);

        $comment = 'Email 1: ' . $result['email_1'] . '<br>';
        $comment .= 'Email 2: ' . $result['email_2'] . '<br>';
        $comment .= 'Телефон: ' . $result['phone'] . '<br>';
        $comment .= 'Телефон(мобильный): ' . $result['phone_mobile'] . '<br>';
        $comment .= 'Skype: ' . $result['skype'] . '<br>';
        $comment .= 'Страна: ' . $result['country'] . '<br>';
        $comment .= 'Город: ' . $result['city'] . '<br>';
        $comment .= 'Компания: ' . $result['company'] . '<br>';
        $result['comment'] = $comment;

        if ($result['phone']) {
            $parsedPhone = $phoneParser->parse($result['phone'], 'RU');
            if ($parsedPhone->isValid()) {
                $result['phone'] = $parsedPhone->format(Format::E164);
            }
            unset($parsedPhone);
        }

        if ($result['phone_mobile']) {
            $parsedPhone = $phoneParser->parse($result['phone_mobile'], 'RU');
            if ($parsedPhone->isValid()) {
                $result['phone_mobile'] = $parsedPhone->format(Format::E164);
            }
            unset($parsedPhone);
        }

        $result['email_1'] = check_email($result['email_1'])
            ? $result['email_1']
            : '';
        $result['email_2'] = check_email($result['email_2'])
            ? $result['email_2']
            : '';

        return $result;
    }
}
