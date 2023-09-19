<?php
declare(strict_types=1);

namespace Sprint\Migration;

use Bitrix\Main\Loader;
use Bitrix\Iblock\Elements\ElementCoursesTable;
use Bitrix\Main\Web\Json;
use Bitrix24\Rest\CRest;

use Bitrix\Main\Error;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\ORM\Data\Result;
use Bitrix\Main\ORM\Data\AddResult;
use Bitrix\Iblock\Elements\EO_ElementCourses;
use Bitrix\Iblock\Elements\ElementScheduleTable;

class ImportCourses20230418234925 extends Version
{
    protected $description = "Второя тестовая версия миграции по перносу курсов";

    protected $moduleVersion = "4.3.1";

    protected array $crmFieldIds;
    protected array $courseCrmStatuses;

    public function up()
    {
        if (!Loader::includeModule('iblock')) {
            return false;
        }
        // ID каталога 14 (как найти код не понятно)
        $crmCatalogId = 14;

        if (!isset($this->params['crmFieldIds'])) {
            $this->crmFieldIds = $this->getCrmFields($crmCatalogId);
            $this->params['crmFieldIds'] = Json::encode($this->crmFieldIds);
        } else {
            $jsonFields = $this->params['crmFieldIds'];
            $this->crmFieldIds = Json::decode($jsonFields);
        }

        if (!isset($this->params['courseCrmStatuses'])) {
            $this->courseCrmStatuses = $this->getCourseCrmStatuses();
            $this->params['courseCrmStatuses'] = Json::encode($this->courseCrmStatuses);
        } else {
            $jsonParams = $this->params['courseCrmStatuses'];
            $this->courseCrmStatuses = Json::decode($jsonParams);
        }

        if (!isset($this->params['lastId'])) {
            $this->params['lastId'] = [];
        }

        if (!isset($this->params['count'])) {
            $this->params['count'] = 0;
        }

        $offset = (int) $this->params['count'];
        ElementCoursesTable::getEntity()->cleanCache();
        $query = ElementCoursesTable::getList([
            'order' => ['id' => 'desc'],
            'select' => [
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
                'crm_id',
            ],
            'filter' => ['active' => true, '!id' => $this->params['lastId']],
            'limit' => 1,
            //'offset' => $offset,
        ]);

        $totalCount = 173;
        $course = $query->fetchObject();
        if (!$totalCount || !$course) {
            return false;
        }
        $this->params['lastId'][] = $course->getId();

        $productResult = $this->addProduct($course);
        if (!$productResult->isSuccess()) {
            $errors = $productResult->getErrorCollection();
            foreach ($errors as $error) {
                $this->outError($error->getMessage());
            }
            return false;
        }

        $productId = $productResult->getId();
        $course->set('CRM_ID', $productId);
        $course->save();

        $this->params['count'] += 1;

        $this->outProgress('Выгружено элементов: ', $this->params['count'], $totalCount);

        if ($this->params['count'] == $totalCount) {
            return true;
        }

        $this->restart();
    }

    public function down()
    {
        //your code ...
    }

    protected function addProduct(EO_ElementCourses $course): AddResult
    {
        $result = new AddResult();

        $fields = $this->getCrmFieldsFromCourse($course);

        $answer = CRest::call(
            'catalog.product.sku.add',
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

    protected function getCrmFields($iblockId): array
    {
        $answer = CRest::call(
            'catalog.productProperty.list',
            [
                'order' => ['sort' => 'asc'],
                'select' => ['id', 'code'],
                'filter' => ['iblockId' => $iblockId]
            ]
        );

        if (!$answer['result'] || !$answer['result']['productProperties']) {
            //todo Сделать норм Exception
            throw new \Exception('Что-то сломалось!');
        }

        return array_column($answer['result']['productProperties'], 'id', 'code');
    }

    protected function getCrmCourseIds($courseIds): array
    {
        $answer = CRest::call(
            'catalog.product.list',
            [
                'select' => ['id'],
                'filter' => ['id' => ['value' => $courseIds]]
            ]
        );

        if (!$answer['result']) {
            return [];
            //todo Сделать норм Exception
            throw new \Exception('Что-то сломалось!');
        }

        return $answer['result'];
    }

    protected function getCourseCrmStatuses(): array
    {
        $courses = ElementCoursesTable::getList([
            'select' => ['id', 'crm_id_value' => 'crm_id.value', 'active'],
            'filter' => ['active' => true],
        ])->fetchAll();
        $crmCourseIds = array_column($courses, 'crm_id_value');
        $crmCourseIds = array_filter($crmCourseIds, function ($item) {
            return (bool) $item;
        });
        $currentCrmCourseIds = ($crmCourseIds) ? $this->getCrmCourseIds($crmCourseIds) : [];

        $courses = array_map(function ($item) use ($currentCrmCourseIds) {
            $item['IS_CRM_NEW'] = !$item['crm_id_value'] || !in_array($item['crm_id_value'], $currentCrmCourseIds);
            return $item;
        }, $courses);

        return array_column($courses, 'IS_CRM_NEW', 'ID');
    }

    protected function getCrmFieldsFromCourse($course): array
    {
        $courseId = $course->getId();
        $isCrmNew = (bool) $this->courseCrmStatuses[$courseId];

        $ownerMap = [
            'regular'   => '120',
            'custom'    => '121',
            'partner'   => '122',
            'author'    => '123',
        ];

        if ($isCrmNew) {
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
        } else {
            $defaultFields = [];
        }


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
            "property${$this->crmFieldIds['site_id']}" => $course->getId(),

            'property'.$this->crmFieldIds['course_code']                   => ['value' => $course->getCode()],
            //'property'.$this->crmFieldIds['base_price']                     => ['value' => $course->getCoursePrice()?->getValue()],
            //'property'.$this->crmFieldIds['number_of_participants']         => ['value' => ''],
            'property'.$this->crmFieldIds['duration']                       => ['value' => $course->get('course_duration')?->getValue()],
            //'property'.$this->crmFieldIds['course_level']                   => ['value' => ''],
            //'property'.$this->crmFieldIds['category']                       => ['value' => ''],
            //'property'.$this->crmFieldIds['format']                             => ['value' => 'online'],
            //'property'.$this->crmFieldIds['language']                           => ['value' => 'ru'],
            //"property${$this->crmFieldIds['owner']}"                          => ['value' => $ownerMap[$course->get('ID_COURSE_OWNER')?->getValue()]],
            //"property${$this->crmFieldIds['status']}"                         => ['value' => 'catalogue'],
            //"property${$this->crmFieldIds['accessibility']}"                  => ['value' => 'external'],
            //"property${$this->crmFieldIds['is_certification']}"             => ['value' => 'N'],
            //"property${$this->crmFieldIds['related_courses']}"                => ['value' => ''],
            //"property${$this->crmFieldIds['target_audience']}"                => ['value' => $course->get('course_audience')?->getValue()],
            //"property${$this->crmFieldIds['course_goals']}"                   => ['value' => $course->get('course_puproses')?->getValue()],
            //"property${$this->crmFieldIds['content']}"                        => ['value' => $this->checkContentFields($content)],

            //"property${$this->crmFieldIds['options']}"                        => ['value' => ''],
            //"property${$this->crmFieldIds['marketing_info']}"                 => ['value' => ''],
            //"property${$this->crmFieldIds['learner_materials']}"              => ['value' => ''],
            //"property${$this->crmFieldIds['required_software_and_settings']}" => ['value' => ''],
            //"property${$this->crmFieldIds['miscellaneous']}"                  => ['value' => ''],
            //"property${$this->crmFieldIds['software_instructions']}"          => ['value' => ''],
        ];
        $resultFields = array_merge($defaultFields, $fields);

        return $resultFields;
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
}
