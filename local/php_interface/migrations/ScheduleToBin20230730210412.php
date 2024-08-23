<?php

namespace Sprint\Migration;


use Bitrix\Catalog\PriceTable;
use Bitrix\Iblock\Elements\ElementScheduleTable;
use Bitrix\Iblock\Elements\ElementTeacherTable;
use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Bitrix\Main\Type\DateTime;

class ScheduleToBin20230730210412 extends Version
{
    protected $description = "";

    protected $moduleVersion = "4.3.1";

    public function up()
    {
        if(!Loader::includeModule('iblock')) {
            return false;
        }
        if(!Loader::includeModule('catalog')) {
            return false;
        }

        $scheduleResult = ElementScheduleTable::getList([
            'order' => ['ID' => 'ASC'],
            'select' => [
                '*',
                'schedule_price',
                'schedule_course',
                'course_code',
                'teacher',
                'string_teacher',
                'startdate',
                'enddate',
                'schedule_time',
                'TIME_INTERVAL',
                'schedule_duration',
            ],
        ]);
        $scheduleCollection = $scheduleResult->fetchCollection();

        $data = [];
        $ids = $scheduleCollection->getIdList();
        $prices = PriceTable::getList([
            'filter' => ['PRODUCT_ID' => $ids],
            'select' => ['PRODUCT_ID', 'PRICE'],
        ])->fetchAll();
        $prices = array_column($prices, 'PRICE', 'PRODUCT_ID');

        foreach ($scheduleCollection as $schedule) {
            $price = $prices[$schedule->getId()] ?? null;
            $data[] = $this->getData($schedule, $price);
        }

        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/local/schedule.bin';
        $packedData = msgpack_pack($data);
        file_put_contents($filePath, $packedData);

        return true;
    }

    public function down()
    {}

    public function getData($schedule, $price = null)
    {
        $dateTimeFormat = 'Y-m-d H:i:s';

        if (!$price) {
            $price = $schedule->get('schedule_price')?->getValue();
        }

        $course_id = $schedule->get('schedule_course')?->getValue();
        $course_code = $schedule->get('course_code')?->getValue();

        $teacher_id = $schedule->get('teacher')?->getValue();
        $teacher_string = $schedule->get('string_teacher')?->getValue();

        $date_create = $schedule->getDateCreate();
        $date_change = $schedule->getTimestampX();

        $dateBegin = $schedule->get('startdate')?->getValue();
        if ($dateBegin) {
            $dateBegin = new DateTime($dateBegin, $dateTimeFormat);
        }

        $dateEnd = $schedule->get('enddate')?->getValue();
        if ($dateEnd) {
            $dateEnd = new DateTime($dateEnd, $dateTimeFormat);
        }

        $time = $schedule->get('schedule_time')?->getValue();
        $time_full = $schedule->get('TIME_INTERVAL')?->getValue();
        $duration = $schedule->get('schedule_duration')?->getValue();

        $result = [
            'id' => $schedule->getId(),
            'active' => $schedule->getActive(),
            'name' => $schedule->getName(),
            'sort' => $schedule->getSort(),
            'code' => $schedule->getCode(),
            'xml_id' => $schedule->getXmlId(),
            'date_create' => $date_create,
            'date_change' => $date_change,

            'price' => $price,
            'course_id' => $course_id,
            'course_code' => $course_code,

            'teacher_id' => $teacher_id,
            'teacher_string' => $teacher_string,

            'date_begin' => $dateBegin,
            'date_end' => $dateEnd,

            'time' => $time,
            'time_full' => $time_full,
            'duration' => $duration,
        ];

        return $result;
    }
}
