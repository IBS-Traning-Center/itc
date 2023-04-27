<?php
declare(strict_types=1);

use Bitrix\Iblock\Elements\ElementScheduleTable;

class EmailTimetable extends CBitrixComponent
{
    protected function getItemList(array $filter = []): array
    {
        //  Найти курсы в расписании по id курса
        //  найти тренера по id тренера

        $schedule = ElementScheduleTable::getList([
            'select' => [
                'ID',
                'CODE',
                'XML_ID',
                'NAME',
                'course_code',
                'schedule_course.ELEMENT',
                'schedule_course_type.ELEMENT',
                'schedule_price',
                'schedule_duration',
                'teacher.ELEMENT',
                'string_teacher',
                'startdate',
                'enddate',
                'schedule_time'
            ],
            'filter' => $filter,
        ])->fetchCollection();

        $items = array_map(function ($item) {
            $item = [
                'icon' => $this->getIconByScheduleItem($item),
                'code' => $item->get('course_code') ? $item->get('course_code')->getValue() : '',
                'category' => $item->get('schedule_course_type') ? $item->get('schedule_course_type')->getElement()->getName() : '',
                'price' => $item->get('schedule_price') ? $item->get('schedule_price')->getValue() : '',
                'duration' => $item->get('schedule_duration') ? $item->get('schedule_duration')->getValue() : '',
                'course' => [
                    'name' => $item->getName(),
                    'link' => $this->getLinkByScheduleItem($item),
                ],
                'tags' => $this->getTagsByScheduleItem($item),
                'trainer' => $this->getTrainerByScheduleItem($item),
                'date' => [
                    'start' => $item->get('startdate') ? $item->get('startdate')->getValue() : '',
                    'end' => $item->get('enddate') ? $item->get('enddate')->getValue() : '',
                ],
                'time' => $this->getTimeByScheduleItem($item),
            ];

            $item['price'] = CurrencyFormat($item['price'], 'RUB');
            if ($item['date']['start']) {
                $item['date']['start'] = (new DateTime($item['date']['start']))->format('d.m.Y');
            }
            if ($item['date']['end']) {
                $item['date']['end'] = (new DateTime($item['date']['end']))->format('d.m.Y');
            }

            return $item;
        }, $schedule->getAll());

        return $items;
    }

    protected function prepareResult(): void
    {
        $this->arResult['items'] = $this->getItemList(['ID' => $this->arParams['TIMETABLE_IDS']]);
    }

    public function executeComponent()
    {
        $this->prepareResult();
        $this->includeComponentTemplate();
    }

    private function getLinkByScheduleItem($item): string
    {
        $scheduleId = $item->getId();

        if (
            $item->get('schedule_course')
            && $item->get('schedule_course')->getElement()
            && $item->get('schedule_course')->getElement()->get('XML_ID')
        ) {
            $courseCode = $item->get('schedule_course')->getElement()->get('XML_ID');
            return "https://ibs-training.ru/kurs/{$courseCode}.html?ID_TIME={$scheduleId}#register";
        }

        return '';
    }

    private function getTimeByScheduleItem($item): array
    {
        $time = $item->get('schedule_time') ? $item->get('schedule_time')->getValue() : '';
        $timeData = explode('-', $time);
        return [
            'start' => trim($timeData[0]) ?? '',
            'end' => trim($timeData[1]) ?? '',
        ];
    }

    private function getTrainerByScheduleItem($item): array
    {
        if (
            $item->get('teacher')
            && $item->get('teacher')->getElement()
        ) {

            $trainerName = $item->get('teacher')->getElement()->get('NAME');
            $trainerCode = $item->get('teacher')->getElement()->get('CODE');
            return [
                'name' => $trainerName,
                'link' => "https://ibs-training.ru/about/experts/{$trainerCode}.html",
            ];

        } else {

            if (
                $item->get('string_teacher')
                && $item->get('string_teacher')->getValue()
            ) {
                $trainerName = $item->get('string_teacher')->getValue();
                return [
                    'name' => $trainerName,
                ];
            }

            return [];
        }
    }

    private function getIconByScheduleItem($item): string
    {
        $categoryId = $item->get('schedule_course_type') ? $item->get('schedule_course_type')->getElement()->getId() : '';

        switch ((string) $categoryId) {
            case "5735":
            case "53918":
            case "84094":
                $icon = "buisness";
                break;
            case "5725":
                $icon = "analyst";
                break;
            case "84093":
            case "5730":
            case "84095":
                $icon = "developer";
                break;
            case "83007":
            case "5728":
                $icon = "arch";
                break;
            case "5729":
                $icon = "test";
                break;
            case "83005":
            case "5723":
                $icon = "management";
                break;
            default:
                $icon = "analyst";
        }

        $icons = [
            'developer' => 'https://ibs-training.ru/local/assets/images/developer.png',
            'test'      => 'https://ibs-training.ru/local/assets/images/test.png',
            'analyst'    => 'https://ibs-training.ru/local/assets/images/analyst.png',
            'buisness'  => 'https://ibs-training.ru/local/assets/images/buisness.png',
            'management'=> 'https://ibs-training.ru/local/assets/images/management.png',
            'arch'      => 'https://ibs-training.ru/local/assets/images/arch.png',
        ];

        return $icons[$icon] ?? '';
    }

    private function getTagsByScheduleItem($item): array
    {
        $tags = [
            'new' => ['name' => 'Онлайн', 'color' => '#37E7BD'],
            'popular' => ['name' => 'Онлайн', 'color' => '#37E7BD'],
            'online' => ['name' => 'Онлайн', 'color' => '#37E7BD'],
            'certified' => ['name' => 'Certified', 'color' => '#C5C5C5'],

            'certified' => ['name' => 'Certified', 'color' => '#C5C5C5'],
            'certified' => ['name' => 'Certified', 'color' => '#C5C5C5'],
            'certified' => ['name' => 'Certified', 'color' => '#C5C5C5'],
        ];

        return [
            ['name' => 'Онлайн', 'color' => '#37E7BD']
        ];
    }
}