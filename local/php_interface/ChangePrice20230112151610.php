<?php

namespace Sprint\Migration;

use Bitrix\Main\Loader;
use Bitrix\Catalog\PriceTable;
use Bitrix\Iblock\Elements\ElementCoursesTable;
use Bitrix\Iblock\Elements\ElementScheduleTable;

class ChangePrice20230112151610 extends Version
{
    protected $description = "";

    protected $moduleVersion = "4.2.2";

    public function up()
    {
        Loader::includeModule('iblock');
        Loader::includeModule('catalog');

        if (!isset($this->params['count'])) {
            $this->params['count'] = 0;
        }
        if (!isset($this->params['result'])) {
            $this->params['result'] = [];
        }

        $chunkSize = 5;

        $AllCoursePrices = [
            'ADM-007' => 14900,
            'ADM-019' => 27500,
            'ADM-021' => 43500,
            'ADM-025' => 21900,
            'ARC-001' => 57500,
            'ARC-003' => 45000,
            'ARC-004' => 45000,
            'ARC-005' => 45000,
            'ARC-008' => 46900,
            'ARC-013' => 46900,
            'ARC-014' => 32900,
            'ARC-015' => 46900,
            'ARC-016' => 44900,
            'ATL-014' => 14900,
            'ATL-016' => 14900,
            'ATL-017' => 22500,
            'ATL-018' => 15900,
            'ATL-019' => 15900,
            'BAN-001' => 10900,
            'BI-001' => 11900,
            'BI-002' => 25000,
            'BI-003' => 27500,
            'C-003' => 40900,
            'C-005' => 28500,
            'C-007' => 36900,
            'DB-021' => 41500,
            'DB-025' => 14900,
            'DB-026' => 20500,
            'DB-027' => 14900,
            'DB-028' => 31500,
            'DB-029' => 20900,
            'DEV-001_C++' => 28500,
            'DEV-001_JVA' => 28900,
            'DEV-001_NET' => 30900,
            'DEV-005' => 12500,
            'DEV-006_C++' => 28500,
            'DEV-006_JVA' => 28900,
            'DEV-006_NET' => 34500,
            'DEV-007' => 19900,
            'DEV-009_C++' => 19500,
            'DEV-009_JVA' => 19900,
            'DEV-009_NET' => 19900,
            'DEV-010' => 19500,
            'DEV-017' => 21900,
            'DEV-032' => 11900,
            'EAS-004' => 44500,
            'EAS-011' => 27900,
            'EAS-014' => 51500,
            'EAS-015' => 41500,
            'EAS-017' => 45000,
            'EAS-018' => 41500,
            'EAS-020' => 41500,
            'EAS-022' => 27500,
            'EAS-024' => 41500,
            'EAS-025' => 41500,
            'EAS-026' => 42000,
            'EAS-027' => 43900,
            'JVA-001' => 22900,
            'JVA-002' => 28500,
            'JVA-007' => 41500,
            'JVA-008' => 41500,
            'JVA-009' => 41500,
            'JVA-010' => 44900,
            'JVA-013' => 26500,
            'JVA-014' => 31500,
            'JVA-016' => 8900,
            'JVA-017' => 36500,
            'JVA-031' => 44900,
            'JVA-035' => 10900,
            'JVA-037' => 22900,
            'JVA-043' => 35900,
            'JVA-059' => 17500,
            'JVA-060' => 9900,
            'JVA-067' => 15900,
            'JVA-073' => 25500,
            'JVA-074' => 61500,
            'JVA-075' => 67500,
            'JVA-076' => 67500,
            'NET-001' => 46900,
            'NET-003' => 13500,
            'NET-010' => 8500,
            'NET-011' => 11500,
            'OFFICE-003' => 11900,
            'OFFICE-004' => 11900,
            'PM-001' => 29900,
            'PM-002' => 17500,
            'PM-003' => 34500,
            'PM-004' => 21900,
            'PM-007' => 21900,
            'PM-008' => 17500,
            'PM-032' => 24900,
            'REQ-001' => 22900,
            'REQ-002' => 22900,
            'REQ-003' => 28500,
            'REQ-004' => 22900,
            'REQ-006' => 11500,
            'REQ-010' => 13900,
            'REQ-028' => 22900,
            'REQ-031' => 23900,
            'REQ-037' => 28900,
            'REQ-038' => 22900,
            'REQ-039' => 25500,
            'REQ-045' => 25500,
            'REQ-046' => 25500,
            'REQ-050' => 15900,
            'REQ-051' => 23900,
            'REQ-052' => 31900,
            'REQ-053' => 15900,
            'REQ-054' => 31900,
            'REQ-055' => 31900,
            'REQ-056' => 15900,
            'REQ-057' => 15900,
            'REQ-059' => 27500,
            'REQ-060' => 27500,
            'REQ-061' => 25500,
            'REQ-062' => 27000,
            'REQ-065' => 24900,
            'REQ-066' => 29500,
            'REQ-067' => 25500,
            'REQ-068' => 25500,
            'REQ-069' => 25500,
            'REQ-070' => 37500,
            'SCRIPT-002' => 23500,
            'SCRIPT-003' => 26500,
            'SCRIPT-007' => 35500,
            'SCRIPT-008' => 29500,
            'SDP-004' => 29500,
            'SDP-030_PRG' => 31500,
            'SECR-009' => 41500,
            'SECR-010' => 34900,
            'SECR-011' => 19900,
            'SQA-002' => 16000,
            'SQA-003' => 9500,
            'SQA-024' => 9500,
            'SQA-026' => 15900,
            'SQA-028' => 15900,
            'SQA-029' => 15900,
            'SQA-030' => 10900,
            'SQA-033' => 6500,
            'SQA-036' => 9500,
            'SQA-043' => 24000,
            'SQA-044' => 10500,
            'SQA-049' => 34900,
            'SQA-050' => 22900,
            'SQA-051' => 20900,
            'SQA-052' => 15900,
            'SS-001' => 26900,
            'SS-002' => 10900,
            'SS-004' => 13900,
            'SS-005' => 13900,
            'SS-006' => 13900,
            'SS-007' => 9900,
            'SS-008' => 9900,
            'SS-011' => 13900,
            'WEB-002' => 9900,
            'WEB-003' => 12900,
            'WEB-004' => 9900,
            'WEB-007' => 39500,
            'WEB-012' => 35900,
            'WEB-015' => 12500,
            'WEB-017' => 12500,
            'WEB-021' => 35900,
            'WEB-022' => 41900,
            'WEB-023' => 48900,
        ];
        $coursePricesChunk = array_chunk($AllCoursePrices, $chunkSize, true);
        $chunk = ceil($this->params['count'] / $chunkSize);

        $coursePrices = $coursePricesChunk[$chunk];

        $elements = ElementCoursesTable::getList([
            'filter' => ['ACTIVE' => 'Y', 'CODE' => array_keys($coursePrices)],
            'select' => ['id', 'code', 'course_price'],
        ])->fetchCollection();

        $courseIds = [];
        foreach ($elements as $element) {
            $courseIds[$element->getId()] = $element->getCode();
            $element->get('course_price')->setValue($coursePrices[$element->getCode()]);
            $element->save();
        }
        $elements->save();

        $scheduleElements = ElementScheduleTable::getList([
            'filter' => ['ACTIVE' => 'Y', 'schedule_course.VALUE' => array_keys($courseIds)],
            'select' => ['id', 'code', 'schedule_price', 'schedule_course'],
        ])->fetchCollection();

        $scheduleIds = [];
        foreach ($scheduleElements as $element) {
            $courseId = $element->get('schedule_course')
                ? $element->get('schedule_course')->getValue()
                : null;
            $courseCode = $courseIds[$courseId];

            $scheduleIds[$element->getId()] = $courseCode;
            $element->get('schedule_price')->setValue($coursePrices[$courseCode]);

            $element->save();
        }
        $scheduleElements->save();

        $priceElements = PriceTable::getList([
            'filter' => ['PRODUCT_ID' => array_keys($scheduleIds), 'CURRENCY' => 'RUB'],
            'select' => ['ID', 'PRODUCT_ID', 'PRICE', 'CURRENCY'],
        ])->fetchCollection();

        $priceIds = [];
        foreach ($priceElements as $element) {
            $priceIds[$element->getId()] = $scheduleIds[$element->getProductId()];
            $productId = $element->get('PRODUCT_ID');
            $courseCode = $scheduleIds[$productId];

            /*Price::update($element->getId(), [
                'PRICE' => $coursePrices[$courseCode],
                'CURRENCY' => 'RUB',
            ]);*/
        }

        foreach ($coursePrices as $courseCode => $coursePrice) {
            try {
                if(!in_array($courseCode, $courseIds)) {
                    throw new \Exception('Курс не найден');
                }
                if(!in_array($courseCode, $scheduleIds)) {
                    throw new \Exception('Курс в расписание не найден');
                }
                if(!in_array($courseCode, $priceIds)) {
                    throw new \Exception('Цена не найдена');
                }

                $this->params['result'][$courseCode] = [
                    'status' => 'success',
                    'message' => 'Цена обновлена',
                ];
            } catch (\Exception $e) {
                $this->params['result'][$courseCode] = [
                    'status' => 'error',
                    'message' => $e->getMessage()
                ];
            }
        }

        $this->params['count'] += $chunkSize;
        $this->outProgress('Обновление цен: ', $this->params['count'], count($AllCoursePrices));

        if ($this->params['count'] < count($AllCoursePrices)) {
            $this->restart();
        }

        foreach ($this->params['result'] as $code => $result) {
            if ($result['status'] == 'error') {
                $this->outError($code . ' - ' . $result['message']);
            } else {
                $this->out(code . ' - ' . $result['message']);
            }
        }
    }

    public function down()
    {
        //your code ...
    }
}
