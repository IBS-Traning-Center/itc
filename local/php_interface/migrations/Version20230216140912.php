<?php
declare(strict_types=1);

namespace Sprint\Migration;

use Bitrix\Main\Error;
use Bitrix\Main\Loader;
use Bitrix24\Rest\CRest;
use Bitrix\Main\Web\Json;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\ORM\Data\Result;
use Bitrix\Main\ORM\Data\AddResult;
use Bitrix\Iblock\Elements\EO_ElementCourses;
use Bitrix\Iblock\Elements\ElementCoursesTable;
use Bitrix\Iblock\Elements\ElementScheduleTable;

class Version20230216140912 extends Version
{
    protected $description = "Тестовая версия миграции по перносу курсов";

    protected $moduleVersion = "4.2.4";

    public function up()
    {
        if (!Loader::includeModule('iblock')) {
            return false;
        }

        if (!isset($this->params['count'])) {
            $this->params['count'] = 0;
        }

        $courseList = ElementCoursesTable::getList([
            'select' => [
                '*',
                'id',
                'active',
                'sort',
                'name',
                'code',
                'xml_id',
                'date_create',
                'active_from',
                'active_to',
                'preview_text',
                'detail_text',
                'course_price',
                'short_descr',
                'course_desc_new',
                'ROADMAP_DESCRIPTION',
                'course_top_html',
                'course_duration',
                'ID_COURSE_OWNER',
                'course_audience',
                'course_puproses',
            ],
            'filter' => ['active' => true, 'id' => '68246'],
            'limit' => 1,
            'offset' => $this->params['count'],
            'count_total' => true,
        ]);

        $totalCount = $courseList->getCount();
        $course = $courseList->fetchObject();
        if (!$totalCount || !$course) {
            return false;
        }

        $productResult = $this->addProduct($course);
        if (!$productResult->isSuccess()) {
            $errors = $productResult->getErrorCollection();
            foreach ($errors as $error) {
                $this->outError($error->getMessage());
            }
            return false;
        }

        $productId = $productResult->getId();
        $catalogResult = $this->addProductToCatalog($productId, $course);
        if (!$catalogResult->isSuccess()) {
            $errors = $productResult->getErrorCollection();
            foreach ($errors as $error) {
                $this->outError($error->getMessage());
            }
            return false;
        }

        if (false) {
            $timetableResult = $this->addTimeTable($productId, $course);
            if (!$timetableResult->isSuccess()) {
                $errors = $timetableResult->getErrorCollection();
                foreach ($errors as $error) {
                    $this->outError($error->getMessage());
                }
                return false;
            }
        }

        $this->params['count'] += 1;

        $this->outProgress('Выгружено элементов: ', $this->params['count'], $totalCount);

        if ($this->params['count'] == $totalCount) {
            return true;
        }

        $this->restart();
    }

    protected function addProduct(EO_ElementCourses $course): AddResult
    {
        $result = new AddResult();

        $propertyMap = [
            'course_code' => '106',
            'base_price' => '86',
            'number_of_participants' => '98',
            'duration' => '82',
            'course_level' => '90',
            'category' => '89',
            'format' => '85',
            'language' => '84',
            'owner' => '83',
            'status' => '87',
            'accessibility' => '88',
            'is_certification' => '91',
            'entry_quiz' => '95',
            'exit_quiz' => '96',
            'related_courses' => '99',
            'target_audience' => '92',
            'course_goals' => '93',
            'content' => '94',
            'options' => '97',
            'marketing_info' => '100',
            'learner_materials' => '101',
            'required_software_and_settings' => '102',
            'miscellaneous' => '103',
            'software_instructions' => '104',
        ];
        $ownerMap = [
            'regular'   => '120',
            'custom'    => '121',
            'partner'   => '122',
            'author'    => '123',
        ];

        $defaultFields = [
            'iblockId' => '14',
            'active' => 'Y',
            //'bundle' => '',
            'canBuyZero' => 'Y',
            'createdBy' => '1',

            'measure' => '1',
            'purchasingCurrency' => 'RUB',
            'quantity' => '1',
            'quantityReserved' => 'N',
            'quantityTrace' => 'N',
            'subscribe' => 'Y',
            'vatId' => null,
            'vatIncluded' => 'N',

            'previewTextType' => 'html',
            'detailTextType' => 'html',
        ];

        $detailText = $course->get('course_desc_new')?->getValue();

        $allTitles = $course->get('ROADMAP_TITLE')?->getAll();
        $allDescription = $course->get('ROADMAP_DESCRIPTION')?->getAll();

        $content = $course->get('course_top_html')?->getValue();

        $fields = [
            'sort' => $course->getSort(),
            'name' => $course->getName(),
            'code' => $course->getCode(),
            'xmlId' => $course->getId(),
            'previewText' => $course->get('short_descr')?->getValue(),
            'detailText' => $this->checkContentFields($detailText),
            'purchasingPrice' => $course->getCoursePrice()?->getValue(),

            //"property${$propertyMap['course_code']}"                    => ['value' => $course->getCode()],
            //"property${$propertyMap['base_price']}"                     => ['value' => $course->getCoursePrice()?->getValue()],
            //"property${$propertyMap['number_of_participants']}"         => ['value' => ''],
            //"property${$propertyMap['duration']}"                       => ['value' => $course->get('course_duration')?->getValue()],
            //"property${$propertyMap['course_level']}"                   => ['value' => ''],
            //"property${$propertyMap['category']}"                       => ['value' => ''],
            //"property${$propertyMap['format']}"                         => ['value' => 'online'],
            //"property${$propertyMap['language']}"                       => ['value' => 'ru'],
            //"property${$propertyMap['owner']}"                          => ['value' => $ownerMap[$course->get('ID_COURSE_OWNER')?->getValue()]],
            //"property${$propertyMap['status']}"                         => ['value' => 'catalogue'],
            //"property${$propertyMap['accessibility']}"                  => ['value' => 'external'],
            //"property${$propertyMap['is_certification']}"             => ['value' => 'N'],
            //"property${$propertyMap['related_courses']}"                => ['value' => ''],
            //"property${$propertyMap['target_audience']}"                => ['value' => $course->get('course_audience')?->getValue()],
            //"property${$propertyMap['course_goals']}"                   => ['value' => $course->get('course_puproses')?->getValue()],
            //"property${$propertyMap['content']}"                        => ['value' => $this->checkContentFields($content)],

            //"property${$propertyMap['options']}"                        => ['value' => ''],
            //"property${$propertyMap['marketing_info']}"                 => ['value' => ''],
            //"property${$propertyMap['learner_materials']}"              => ['value' => ''],
            //"property${$propertyMap['required_software_and_settings']}" => ['value' => ''],
            //"property${$propertyMap['miscellaneous']}"                  => ['value' => ''],
            //"property${$propertyMap['software_instructions']}"          => ['value' => ''],

        ];
        $resultFields = array_merge($defaultFields, $fields);

        $answer = CRest::call(
            'catalog.product.sku.add',
            ['fields' => $resultFields]
        );

        [
            'result' => $resultData,
            'error' => $error,
            'error_description' => $errorDescription
        ] = $answer;

        if ($error || $errorDescription) {
            $result->addError(new Error($errorDescription));
            return $result;
        }

        if (!$resultData['sku'] || !$resultData['sku']['id']) {
            $result->addError(new Error('Ошибка при добавление элемента'));
            return $result;
        }

        $result->setData($resultData['sku']);
        $result->setId($resultData['sku']['id']);
        return $result;
    }

    protected function addProductToCatalog($productId, EO_ElementCourses $course): Result
    {
        $result = new Result();

        if (!$price = $course->getCoursePrice()?->getValue()) {
            $result->addError(new Error('не определена цена'));
            return $result;
        }

        $answer = CRest::call(
            'catalog.price.add',
            ['fields' => [
                'productId' => $productId,
                'catalogGroupId' => 1,
                'currency' => 'RUB',
                'price' => $price,
            ]]
        );

        [
            'result' => $resultData,
            'error' => $error,
            'error_description' => $errorDescription
        ] = $answer;

        if ($error || $errorDescription) {
            $result->addError(new Error($errorDescription));
            return $result;
        }

        $result->setData($resultData['price']);
        return $result;
    }

    protected function addTimeTable($productId, $course): Result
    {
        $result = new Result();

        $timetableCollection = ElementScheduleTable::getList([
            'select' => ['id', 'code', 'name', 'schedule_course', 'startdate', 'enddate'],
            'filter' => [
                'active' => true,
                //'>=startdate.value' => new DateTime(),
                'schedule_course.value' => $course->getId(),
            ],
            'limit' => 2,
        ])->fetchCollection();

        foreach ($timetableCollection as $timetableItem) {

            $startDate = $timetableItem->get('startdate')?->getValue();
            $startDate = new DateTime($startDate, 'd.m.Y');

            if (!$endDate = $timetableItem->get('startdate')?->getValue()) {
                $endDate = $startDate;
            }
            $endDate = new DateTime($endDate, 'd.m.Y');

            $name = $course->getCode() . ': ' . $startDate . ' - ' . $endDate;

            $fields = array_merge(
                [
                    'iblockId' => '15',
                    'parentId' => $productId,

                    'xmlId' => $timetableItem->getId(),
                    'name' => $name,
                ],
                [
                    'property80' => ['value' => $startDate],
                    'property81' => ['value' => $endDate],
                ]
            );

            $answer = CRest::call(
                'catalog.product.offer.add',
                ['fields' => $fields]
            );

            [
                'result' => $resultData,
                'error' => $error,
                'error_description' => $errorDescription
            ] = $answer;

            if ($error || $errorDescription) {
                $result->addError(new Error($errorDescription));
                return $result;
            }
        }

        return $result;
    }

    protected function checkContentFields($content): string
    {
        if (unserialize($content)) {
            $content = unserialize($content);
        }
        if (is_array($content) && $content['TEXT']) {
            $content = $content['TEXT'];
        }
        return $content;
    }

    public function down()
    {
        //your code ...
    }
}
