<?php

use Bitrix\Main\Page\Asset;
use Bitrix\Catalog\Product\Price\Calculation;
use Bitrix\Iblock\Component\Tools;
use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Error;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorableImplementation;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Luxoft\Dev\Tools as LuxoftTools;
use \Bitrix\Iblock\Elements\ElementSettingsTable;
use \Bitrix\Iblock\Elements\ElementClientsTable;
use \Bitrix\Iblock\Elements\ElementCertificatesTable;
use Local\Util\HighloadblockManager;
use \Bitrix\Main\Web\Json;

class CourseDetailComponent extends CBitrixComponent implements Controllerable, Errorable
{
    use ErrorableImplementation;

    protected array $iblocks;
    protected array $courseConfig;
    protected array $scheduleConfig;
    protected array $trainersConfig;
    protected array $reviewsConfig;

    protected string $currency;

    protected array $course;
    protected array $courses;
    protected array $schedule;
    protected array $trainers;
    protected array $reviews;
    protected array $menu;

    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->course = [];
        $this->courses = [];
        $this->schedule = [];
        $this->trainers = [];
        $this->reviews = [];
        $this->menu = [];

        $this->errorCollection = new ErrorCollection();
    }

    protected function showErrors()
    {
        foreach ($this->getErrors() as $error) {
            ShowError($error);
        }
    }

    protected function setInitData(): void
    {
        $this->currency = 'RUB';
        Calculation::setConfig(['CURRENCY' => $this->currency]);
    }

    protected function mapping(string $object, $property)
    {
        $map = [
            'course' => [
                'iblockId' => 'IBLOCK_ID',
                'id' => 'ID',
                'code' => 'CODE',
                'name' => 'NAME',
                'xmlId' => 'XML_ID',
                'redirect' => 'REDIRECT_URL',
                'category' => 'course_idcategory',
                'price' => 'course_price',
                'duration' => 'course_duration',
                'location' => '',
                'language' => 'course_language.ITEM',
                'shortDescription' => 'short_descr',
                'description' => 'course_desc_new',
                'certificate' => 'CERTIFICATE',
                'objectives' => 'course_puproses',
                'prerequisites' => 'course_req_new',
                'audience' => 'course_audience',
                'roadmap' => 'course_top_html',
                'note' => 'course_other',
                'roadmapTitleItems' => 'ROADMAP_TITLE',
                'roadmapDescriptionItems' => 'ROADMAP_DESCRIPTION',
                'recommended' => 'RECOMMENDED',
                'recommendedHtml' => 'course_addsources',
                'similarCourses' => 'ID_LINKED_COURSES',
                'complexity' => 'COMPLEXITY.ITEM',
                'new' => 'IS_NEW.ITEM',
                'price_ur' => 'COURSE_PRICE_UR',
                'for_course' => 'FOR_COURSE',
                'skills' => 'IMPROVED_SKILLS',
                'what_learn' => 'WHAT_LEARN',

                'metaTitle' => 'meta_title',
                'metaDescription' => 'meta_desc',
                'metaKeywords' => 'meta_keywords',
                'metaImage' => 'meta_image',
            ],
            'schedule' => [
                'course' => 'schedule_course',
                'startDate' => 'startdate',
                'endDate' => 'enddate',
                'duration' => 'schedule_duration',
                'trainer' => 'teacher',
                'trainerString' => 'string_teacher',
                'timeZone' => '',
                'time' => 'schedule_time',
                'lang' => '',
                'city' => '',
                'sale' => 'course_sale',
                'price' => 'schedule_price',
                'price_ur' => 'COURSE_PRICE_UR',
            ],
            'trainer' => [
                'shortName' => 'expert_name',
                'shortDescription' => 'expert_short',
                'position' => 'EXPERT_POS',
                'profile' => 'DETAIL_TEXT',
            ],
            'review' => [
                'course' => 'COURSE',
                'name' => 'NAME',
                'surname' => 'SURNAME',
                'review' => 'REVIEW',
                'client' => 'client',
            ],
        ];

        if (is_array($property)) {
            $result = [];
            foreach ($property as $value) {
                $arValue = explode('.', $value);
                if ($map[$object][$arValue[0]]) {
                    $arValue[0] = $map[$object][$arValue[0]];
                    $result[] = implode('.', $arValue);
                } elseif(!isset($map[$object][$arValue[0]])) {
                    $result[] = implode('.', $arValue);
                }
            }
            return $result;
        } else {
            $arValue = explode('.', $property);
            if ($map[$object][$arValue[0]]) {
                $arValue[0] = $map[$object][$arValue[0]];
                $property = implode('.', $arValue);
            } elseif(!isset($map[$object][$arValue[0]])) {
                $property = implode('.', $arValue);
            }
            return $property;
        }
    }

    protected function checkModules(): bool
    {
        Loc::loadMessages(__FILE__);

        if (!Loader::includeModule('iblock')) {
            $this->errorCollection[] = new Error(Loc::getMessage('ERROR_COMPONENT_MODULE_IBLOCK'));
            return false;
        }

        if (!Loader::includeModule('sale')) {
            $this->errorCollection[] = new Error(Loc::getMessage('ERROR_COMPONENT_MODULE_SALE'));
            return false;
        }

        if (!Loader::includeModule('luxoft.dev')) {
            $this->errorCollection[] = new Error(Loc::getMessage('ERROR_COMPONENT_MODULE_LUXOFT'));
            return false;
        }

        return true;
    }

    protected function checkRequiredParameters(): bool
    {

        if (empty($this->arParams['coursesPath'])) {
            $this->errorCollection[] = new Error(Loc::getMessage('ERROR_COMPONENT_PARAMS_COURSES_PATH'));
            return false;
        }

        if (empty($this->arParams['trainersPath'])) {
            $this->errorCollection[] = new Error(Loc::getMessage('ERROR_COMPONENT_PARAMS_TRAINERS_PATH'));
            return false;
        }

        return true;
    }

    protected function checkContentFields($content): string
    {
        if (!$content) {
            return (string) $content;
        }

        if (unserialize($content)) {
            $content = unserialize($content);
        }
        if (is_array($content) && $content['TEXT']) {
            $content = $content['TEXT'];
        }
        return $content;
    }

    protected function getCategory(array $filter): array
    {
        $result = [];
        $entity = IblockTable::compileEntity('courseDirections');
        $entityClass = $entity->getDataClass();

        $defaultFilter = ['ACTIVE' => 'Y'];

        $courseList = $entityClass::getList([
            'select' => ['ID', 'SECTIONS', 'PP_COURSE'],
            'filter' => array_merge($defaultFilter, $filter),
            'cache' => ['ttl' => 3600]
        ]);

        if ($category = $courseList->fetchObject()) {
            foreach ($category->get('SECTIONS')->getAll() as $section) {
                if ($section->get('ACTIVE') ?? $section->get('PICTURE')) {
                    $result = [
                        'name' => $section->get('NAME') ?? '',
                        'code' => $section->get('CODE') ?? '',
                        'picture' => $section->get('PICTURE') ? \CFile::GetPath($section->get('PICTURE')) : '',
                    ];
                    break;
                };
            }
        }

        return $result;
    }

    protected function getCourse($config = []): array
    {
        $defaultConfig = [
            'select' => [
                $this->mapping('course', 'iblockId'),
                $this->mapping('course', 'id'),
                $this->mapping('course', 'name'),
                $this->mapping('course', 'code'),
                $this->mapping('course', 'xmlId'),
                $this->mapping('course', 'redirect'),
                $this->mapping('course', 'category.ELEMENT'),
                $this->mapping('course', 'price'),
                $this->mapping('course', 'duration'),
                $this->mapping('course', 'shortDescription'),
                $this->mapping('course', 'description'),
                $this->mapping('course', 'certificate.ITEM'),
                $this->mapping('course', 'objectives'),
                $this->mapping('course', 'prerequisites'),
                $this->mapping('course', 'audience'),
                $this->mapping('course', 'roadmap'),
                $this->mapping('course', 'roadmapTitleItems'),
                $this->mapping('course', 'roadmapDescriptionItems'),
                $this->mapping('course', 'note'),
                $this->mapping('course', 'recommended'),
                $this->mapping('course', 'recommendedHtml'),
                $this->mapping('course', 'similarCourses'),
                $this->mapping('course', 'metaTitle'),
                $this->mapping('course', 'metaDescription'),
                $this->mapping('course', 'metaKeywords'),
                $this->mapping('course', 'metaImage'),
                $this->mapping('course', 'complexity'),
                $this->mapping('course', 'new'),
                $this->mapping('course', 'price_ur'),
                $this->mapping('course', 'language'),
                $this->mapping('course', 'for_course'),
                $this->mapping('course', 'skills'),
                $this->mapping('course', 'what_learn'),
            ],
            'filter' => [
                'ACTIVE' => 'Y'
            ],
            'cache' => [
                'ttl' => 3600
            ],
        ];

        $entity = IblockTable::compileEntity('courses');
        $entityClass = $entity->getDataClass();

        $courseList = $entityClass::getList(array_merge_recursive($defaultConfig, $config));

        $courseObject = $courseList->fetchObject();

        if ($courseObject) {
            // редирект на указанную страницу в курсе
            if ($courseObject->get($this->mapping('course', 'redirect')) && $courseObject->get($this->mapping('course', 'redirect'))->getValue()) {
                LocalRedirect($courseObject->get($this->mapping('course', 'redirect'))->getValue());
            }

            // редирект на указанную страницу в курсе
            if (
                $courseObject->get($this->mapping('course', 'xmlId'))
                && $courseObject->get($this->mapping('course', 'code')) === $this->request['CODE']
                && $courseObject->get($this->mapping('course', 'code')) !== $courseObject->get($this->mapping('course', 'xmlId'))
            ) {
                LocalRedirect($this->arParams['coursesPath'] . $courseObject->get($this->mapping('course', 'xmlId')) . '/',);
            }

            $this->course['id'] = $courseObject->get($this->mapping('course', 'id'));
            $this->course['code'] = $courseObject->get($this->mapping('course', 'code'));
            $this->course['name'] = $courseObject->get($this->mapping('course', 'name'));
            $this->course['xmlId'] = $courseObject->get($this->mapping('course', 'xmlId'));
            $this->course['detailUrl'] = $this->arParams['coursesPath'] . ($this->course['xmlId'] ? $courseObject->get($this->mapping('course', 'xmlId')) : $courseObject->get($this->mapping('course', 'code'))) . '/';
            $this->course['iblockId'] = $courseObject->get($this->mapping('course', 'iblockId'));
            $this->course['complexity'] = ($courseObject->getComplexity() && $courseObject->getComplexity()->getItem() && $courseObject->getComplexity()->getItem()->getValue()) ? $courseObject->getComplexity()->getItem()->getValue() : '';
            $this->course['is_new'] = $courseObject->getIsNew() && $courseObject->getIsNew()->getItem() && $courseObject->getIsNew()->getItem()->getValue();
            $this->course['price_ur'] = ($courseObject->getCoursePriceUr() && $courseObject->getCoursePriceUr()->getValue()) ? $courseObject->getCoursePriceUr()->getValue() : '';
            $this->course['language'] = ($courseObject->getCourseLanguage() && $courseObject->getCourseLanguage()->getItem() && $courseObject->getCourseLanguage()->getItem()->getValue()) ? $courseObject->getCourseLanguage()->getItem()->getValue() : '';

            $forCourseCodes = [];
            if ($courseObject->getForCourse() && $courseObject->getForCourse()->getAll()) {
                foreach ($courseObject->getForCourse()->getAll() as $value) {
                    $forCourseCodes[] = $value->getValue();
                }

                $forCourseCodes = array_unique($forCourseCodes);
            }

            if (!empty($forCourseCodes)) {
                $hightTable = new HighloadblockManager('WhoCourse');
                $hightTable->prepareParamsQuery(['UF_NAME', 'UF_XML_ID', 'UF_PICTURE'], [], ['UF_XML_ID' => $forCourseCodes]);
                $items = $hightTable->getDataAll();

                if (!empty($items)) {
                    foreach ($items as &$item) {
                        if ($item['UF_PICTURE']) {
                            $item['UF_PICTURE'] = CFile::GetPath($item['UF_PICTURE']);
                        }
                    }

                    $this->course['for_course'] = $items;
                }
            }

            if ($courseObject->getImprovedSkills() && $courseObject->getImprovedSkills()->getAll()) {
                foreach ($courseObject->getImprovedSkills()->getAll() as $value) {
                    $this->course['skills_course'][] = $value->getValue();
                }
            }

            $whatLearn = [];
            if ($courseObject->getWhatLearn() && $courseObject->getWhatLearn()->getAll()) {
                foreach ($courseObject->getWhatLearn()->getAll() as $whatItem) {
                    $whatLearn[] = $whatItem->getValue();
                }
            }
            $this->course['what_learn'] = $whatLearn;

            $this->course['category'] = $this->getCategory(['PP_COURSE.VALUE' => $this->course['id']]);
            if (empty($this->course['category']['name'])) {
                $category = $courseObject->get($this->mapping('course', 'category'))->getElement();
                $this->course['category'] = [
                    'name' => $category->get('NAME'),
                    'code' => $category->get('CODE'),
                    'picture' => \CFile::GetPath($category->get('DETAIL_PICTURE')),
                ];
            }

            $this->course['certificate'] = 'lt';
            if ($courseObject->get($this->mapping('course', 'certificate')) && $courseObject->get($this->mapping('course', 'certificate'))->getItem()) {
                $this->course['certificate'] = $courseObject->get($this->mapping('course', 'certificate'))->getItem()->get('XML_ID');
            }

            if ($courseObject->get($this->mapping('course', 'price'))) {
                $this->course['sale'] = [
                    'price' => $courseObject->get($this->mapping('course', 'price'))->getValue(),
                    'priceFormatted' => \CCurrencyLang::CurrencyFormat(
                        $courseObject->get($this->mapping('course', 'price'))->getValue(),
                        $this->currency
                    ),
                ];
            }

            if ($courseObject->get($this->mapping('course', 'duration'))) {
                $this->course['duration'] = $courseObject->get($this->mapping('course', 'duration'))->getValue();
            }

            //TODO подтянуть локацию из инфоблока
            $this->course['city'] = 'Онлайн';

            $contentProperties = ['shortDescription', 'description', 'objectives', 'audience', 'prerequisites', 'roadmap', 'note'];
            foreach ($contentProperties as $contentProperty) {
                if (empty($this->mapping('course', $contentProperty))) continue;
                if ($courseObject->has($this->mapping('course', $contentProperty)) && $courseObject->get($this->mapping('course', $contentProperty))->getValue()) {
                    $this->course['content'][$contentProperty] = $this->checkContentFields($courseObject->get($this->mapping('course', $contentProperty))->getValue());
                }
            }

            if ($courseObject->get($this->mapping('course', 'recommendedHtml')) && $courseObject->get($this->mapping('course', 'recommendedHtml'))->getValue()) {
                $this->course['recommended'] = $this->checkContentFields($courseObject->get($this->mapping('course', 'recommendedHtml'))->getValue());
            }

            if ($courseObject->get($this->mapping('course', 'recommended'))) {
                $this->course['recommended'] = [];
                foreach ($courseObject->get($this->mapping('course', 'recommended'))->getAll() as $value) {
                    $this->course['recommended'][] = $value->getValue();
                }
            }

            $roadmapBlocks = [];

            $roadmapTitleItems = $courseObject->get($this->mapping('course', 'roadmapTitleItems'))->fill(['VALUE']);
            foreach ($roadmapTitleItems as $index => $title) {
                $roadmapBlocks[$index]['title'] = $title;
            }

            $roadmapDescriptionItems = $courseObject->get($this->mapping('course', 'roadmapDescriptionItems'))->fill(['VALUE']);
            foreach ($roadmapDescriptionItems as $index => $description) {
                $roadmapBlocks[$index]['description'] = $this->checkContentFields($description);;
            }

            $this->course['content']['roadmapBlocks'] = $roadmapBlocks;


            if ($courseObject->get($this->mapping('course', 'similarCourses'))) {
                foreach ($courseObject->get($this->mapping('course', 'similarCourses'))->getAll() as $value) {
                    $this->courses[$value->getValue()] = [];
                }
            }

            if ($courseObject->get($this->mapping('course', 'metaTitle'))) {
                $this->course['meta']['title'] = $courseObject->get($this->mapping('course', 'metaTitle'))->getValue();
            }
            if ($courseObject->get($this->mapping('course', 'metaDescription'))) {
                $this->course['meta']['description'] = $courseObject->get($this->mapping('course', 'metaDescription'))->getValue();
            }
            if ($courseObject->get($this->mapping('course', 'metaKeywords'))) {
                $this->course['meta']['keywords'] = $courseObject->get($this->mapping('course', 'metaKeywords'))->getValue();
            }
            if ($courseObject->get($this->mapping('course', 'metaImage'))) {
                $this->course['meta']['image'] = CFile::GetPath($courseObject->get($this->mapping('course', 'metaImage'))->getValue());
            }

            $this->course['isBabok'] = strpos(strtolower($this->course['name']), 'babok') !== false;
        } else {
            Tools::process404(
                Loc::getMessage('ERROR_404'),
                true,
                true,
                true,
                false
            );
        }

        return $this->course;
    }

    protected function getCourses($config = []): array
    {
        $result = [];

        $entity = IblockTable::compileEntity('courses');
        $entityClass = $entity->getDataClass();

        $defaultConfig = [
            'order' => ['CODE' => 'ASC'],
            'filter' => ['ACTIVE' => 'Y'],
            'select' => $this->mapping('course', ['ID', 'NAME', 'CODE', 'XML_ID', 'duration', 'shortDescription', 'complexity', 'price']),
            'cache' => ['ttl' => 3600],
        ];
        $courseList = $entityClass::getList(array_merge_recursive($defaultConfig, $config));

        $courseCollections = $courseList->fetchCollection();

        foreach ($courseCollections as $course) {
            $result[$course->get('ID')] = [
                'id' => $course->get('ID'),
                'name' => $course->get('NAME'),
                'code' => $course->get('CODE'),
                'duration' => $course->get($this->mapping('course', 'duration')) ? $course->get($this->mapping('course', 'duration'))->getValue() : '',
                'description' => $course->get($this->mapping('course', 'shortDescription')) ? $course->get($this->mapping('course', 'shortDescription'))->getValue() : '',
                'complexity' => ($course->getComplexity() && $course->getComplexity()->getItem() && $course->getComplexity()->getItem()->getValue()) ? $course->getComplexity()->getItem()->getValue() : '',
                'price' => ($course->getCoursePrice() && $course->getCoursePrice()->getValue()) ? $course->getCoursePrice()->getValue() : ''
            ];

            $result[$course->get('ID')]['link'] = $course->get('XML_ID')
                ? $this->arParams['coursesPath'] . $course->get('XML_ID') . '.html'
                : $this->arParams['coursesPath'] . $course->get('CODE')  . '.html';
        }

        $schedule = $this->getSchedule(['filter' => [$this->mapping('schedule', 'course.VALUE') => array_keys($result)]]);
        foreach ($schedule as $scheduleItem) {
            if ($scheduleItem['courseId'] && $result[$scheduleItem['courseId']]) {
                $course = &$result[$scheduleItem['courseId']];
                $course['schedule'][] = $scheduleItem;
            }
        }

        return $this->courses = $result;
    }

    protected function getSchedule($config = [], $isFull = false): array
    {
        //TODO сделать цену не обязательной
        global $USER;

        $result = [];

        $defaultConfig = [
            'filter' => [
                'ACTIVE' => 'Y',
                //"<{$this->mapping('schedule','startDate')}.VALUE" => date('Y-m-d'),
                ">={$this->mapping('schedule','endDate')}.VALUE" => date('Y-m-d')
            ],
            'order' => [$this->mapping('schedule', 'startDate.VALUE') => 'ASC', $this->mapping('schedule', 'endDate.VALUE') => 'ASC'],
            'select' => $this->mapping('schedule', [
                '*',
                'CODE',
                'course',
                'duration',
                'startDate',
                'endDate',
                'trainer',
                'trainerString',
                'timeZone',
                'time',
                'lang.ELEMENT',
                'city.ELEMENT',
                'sale',
                'price_ur'
            ]),
            'cache' => ['ttl' => 3600],
        ];

        $resultConfig = array_merge_recursive($defaultConfig, $config);

        $entity = IblockTable::compileEntity('schedule');
        $entityClass = $entity->getDataClass();

        $list = $entityClass::getList($resultConfig);

        $collection = $list->fetchCollection();
        foreach ($collection as $collectionItem) {

            $currentItem = [
                'id' => $collectionItem->get('ID'),
                'name' => $collectionItem->get('NAME'),
                'code' => $collectionItem->get('CODE'),
                'courseId' => $collectionItem->get($this->mapping('schedule', 'course')) ? $collectionItem->get($this->mapping('schedule', 'course'))->getValue() : '',

                'time' => ($collectionItem->has($this->mapping('schedule', 'time')) && $collectionItem->get($this->mapping('schedule', 'time'))->getValue()) ? $collectionItem->get($this->mapping('schedule', 'time'))->getValue() : '',
                //TODO подтянуть локацию из инфоблока
                //'location' => ($collectionItem->has($this->mapping('schedule','city')) && $collectionItem->get($this->mapping('schedule','city'))->getElement()) ? $collectionItem->get($this->mapping('schedule','cityId'))->getElement()->getName() : '',
                'city' => 'Онлайн',
                //TODO подтянуть язык из инфоблока
                'lang' => '',
                'duration' => ($collectionItem->has($this->mapping('schedule', 'duration')) && $collectionItem->get($this->mapping('schedule', 'duration'))->getValue()) ? $collectionItem->get($this->mapping('schedule', 'duration'))->getValue() : '',
                'date' => [
                    'start' => ($collectionItem->get($this->mapping('schedule', 'startDate')) && $collectionItem->get($this->mapping('schedule', 'startDate'))->getValue())
                        ? $collectionItem->get($this->mapping('schedule', 'startDate'))->getValue()
                        : '',
                    'end' => ($collectionItem->has($this->mapping('schedule', 'endDate')) && $collectionItem->get($this->mapping('schedule', 'endDate'))->getValue())
                        ? $collectionItem->get($this->mapping('schedule', 'endDate'))->getValue()
                        : '',
                ],
            ];

            $currentItem['formLabel'] = $currentItem['date']['start']
                ? date('d.m.Y', strtotime($currentItem['date']['start'])) . ', ' . $currentItem['city']
                : '';

            if ($currentItem['date']['start']) {
                $currentItem['date']['start'] = date('d.m.Y', strtotime($currentItem['date']['start']));
            }

            if ($currentItem['date']['end']) {
                $currentItem['date']['end'] = date('d.m.Y', strtotime($currentItem['date']['end']));
            }

            if ($isFull) {
                // Получаем цены на курс
                $currentPrice = \Bitrix\Catalog\PriceTable::getList([
                    'filter' => ['PRODUCT_ID' => $currentItem['id'], 'CATALOG_GROUP_ID' => '1'],
                    'select' => ['ID', 'PRODUCT_ID', 'CATALOG_GROUP_ID', 'PRICE', 'CURRENCY'],
                    'cache' => ['ttl' => 3600],
                ])->fetchObject();

                if ($currentPrice) {
                    Calculation::setConfig(['CURRENCY' => $this->currency]);
                    $arPrice = \CCatalogProduct::GetOptimalPrice($currentItem['id'], 1, $USER->GetUserGroupArray(), 'N', [[
                        'ID' => $currentPrice->get('ID'),
                        'PRICE' => $currentPrice->get('PRICE'),
                        'CURRENCY' => $currentPrice->get('CURRENCY'),
                        'CATALOG_GROUP_ID' => $currentPrice->get('CATALOG_GROUP_ID'),
                    ]]);
                }

                if (!empty($arPrice['RESULT_PRICE'])) {
                    $currentItem['sale'] = [
                        'price' => $arPrice['RESULT_PRICE']['BASE_PRICE'],
                        'discountPrice' => $arPrice['RESULT_PRICE']['DISCOUNT_PRICE'],
                        'discount' => $arPrice['RESULT_PRICE']['DISCOUNT'],
                        'percent' => $arPrice['RESULT_PRICE']['PERCENT'],
                        'currency' => $arPrice['RESULT_PRICE']['CURRENCY']
                    ];
                    unset($arPrice);
                } elseif ($collectionItem->has($this->mapping('schedule', 'price'))
                    && $collectionItem->get($this->mapping('schedule', 'price'))->getValue()
                ) {
                    $currentItem['sale'] = [
                        'price' => $collectionItem->get($this->mapping('schedule', 'price'))->getValue(),
                        'discountPrice' => $collectionItem->get($this->mapping('schedule', 'price'))->getValue(),
                        'currency' => $this->currency,
                    ];
                } else {
                    $currentItem['sale'] = [
                        'price' => $this->course['sale']['price'],
                        'discountPrice' => $this->course['sale']['price'],
                        'currency' => $this->currency,
                    ];
                }

                if ($collectionItem->getCoursePriceUr() && $collectionItem->getCoursePriceUr()->getValue()) {
                    $currentItem['sale']['price_ur'] = $collectionItem->getCoursePriceUr()->getValue();
                }

                if (
                    (empty($currentItem['sale']['discountPrice']) || $currentItem['sale']['discountPrice'] === $currentItem['sale']['price'])
                    && $collectionItem->get($this->mapping('schedule', 'sale'))
                    && $collectionItem->get($this->mapping('schedule', 'sale'))->getValue()
                ) {
                    $discount = $collectionItem->get($this->mapping('schedule', 'sale'))->getValue();
                    $currentItem['sale']['discountPrice'] = $currentItem['sale']['price'] - ($currentItem['sale']['price'] * $discount / 100);
                    $currentItem['sale']['discount'] = $currentItem['sale']['price'] * $discount / 100;
                    $currentItem['sale']['percent'] = $discount;
                }

                if ($currentItem['sale']['price'] && $currentItem['sale']['currency']) {
                    $currentItem['sale']['priceFormatted'] = \CCurrencyLang::CurrencyFormat(
                        $currentItem['sale']['price'],
                        $currentItem['sale']['currency']
                    );
                }

                if ($currentItem['sale']['discountPrice'] && $currentItem['sale']['currency']) {
                    $currentItem['sale']['discountPriceFormatted'] = \CCurrencyLang::CurrencyFormat(
                        $currentItem['sale']['discountPrice'],
                        $currentItem['sale']['currency']
                    );
                }

                if ($currentItem['sale']['discount'] && $currentItem['sale']['currency']) {
                    $currentItem['sale']['discountFormatted'] = \CCurrencyLang::CurrencyFormat(
                        $currentItem['sale']['discount'],
                        $currentItem['sale']['currency']
                    );
                }

                if ($collectionItem->get($this->mapping('schedule', 'trainer')) && $collectionItem->get($this->mapping('schedule', 'trainer'))->getValue()) {
                    $trainerId = $collectionItem->get($this->mapping('schedule', 'trainer'))->getValue();
                    $trainer = $this->getTrainer($trainerId);

                    $currentItem['trainer'] = $trainer;
                } elseif (
                    $collectionItem->get($this->mapping('schedule', 'trainerString'))
                    && $collectionItem->get($this->mapping('schedule', 'trainerString'))->getValue()
                ) {
                    $currentItem['trainerString'] = $collectionItem->get($this->mapping('schedule', 'trainerString'))->getValue();
                }
            }

            $result[] = $currentItem;
        }

        return $result;
    }

    protected function getTrainer(int $trainerId = null, array $config = []): array
    {
        if (!$trainerId) {
            return [];
        }

        $defaultConfig = [
            'filter' => [
                'ID' => $trainerId
            ],
            'select' => [
                'NAME',
                'expert_name',
                'expert_title',
                'KNOW_LEVEL',
                'DETAIL_PICTURE',
                'HTML_EXPERIENCE',
                'ABOUT_PROJECTS',
                'WORKED_PROJECTS',
                'ORGANIZATIONS_TRAINER'
            ],
            'cache' => ['ttl' => 3600],
        ];

        $entity = IblockTable::compileEntity('trainers');
        $entityClass = $entity->getDataClass();

        $resultConfig = array_merge_recursive($defaultConfig, $config);
        $element = $entityClass::getList($resultConfig);

        $trainer = $element->fetchObject();
        $trainerInfo = [];

        if ($trainer->getId()) {
            $trainerInfo['ID'] = $trainer->getId();
        }

        if ($trainer->getName()) {
            $trainerInfo['SURNAME'] = $trainer->getName();
        }

        if ($trainer->getExpertName() && $trainer->getExpertName()->getValue()) {
            $trainerInfo['NAME'] = $trainer->getExpertName()->getValue();
        }

        if ($trainer->getExpertTitle() && $trainer->getExpertTitle()->getValue()) {
            $trainerInfo['SHORT_DESCRIPTION'] = $trainer->getExpertTitle()->getValue();
        }

        if ($trainer->getKnowLevel() && $trainer->getKnowLevel()->getValue()) {
            $trainerInfo['LEVEL'] = $trainer->getKnowLevel()->getValue();
        }

        if ($trainer->getDetailPicture()) {
            $trainerInfo['PICTURE'] = CFile::GetPath($trainer->getDetailPicture());
        }

        if ($trainer->getHtmlExperience() && $trainer->getHtmlExperience()->getAll()) {
            $experience = [];
            foreach ($trainer->getHtmlExperience()->getAll() as $value) {
                $experience[] = unserialize($value->getValue());
            }

            $trainerInfo['EXPERIENCE'] = $experience;
        }

        if ($trainer->getAboutProjects() && $trainer->getAboutProjects()->getValue()) {
            $trainerInfo['ABOUT_PROJECTS'] = unserialize($trainer->getAboutProjects()->getValue());
        }

        if ($trainer->getWorkedProjects() && $trainer->getWorkedProjects()->getAll()) {
            $workedProjectsIds = [];
            foreach ($trainer->getWorkedProjects()->getAll() as $value) {
                $workedProjectsIds[] = $value->getValue();
            }

            $workedProjectsIds = array_unique($workedProjectsIds);

            if (!empty($workedProjectsIds)) {
                $clients = ElementClientsTable::getList([
                    'select' => [
                        'ID',
                        'NAME',
                        'PREVIEW_PICTURE'
                    ],
                    'filter' => [
                        'ID' => $workedProjectsIds,
                        'ACTIVE' => 'Y'
                    ]
                ])->fetchCollection();

                if ($clients) {
                    $clientsInfo = [];
                    foreach ($clients as $client) {
                        if ($client->getId()) {
                            if ($client->getName()) {
                                $clientsInfo[$client->getId()]['NAME'] = $client->getName();
                            }

                            if ($client->getPreviewPicture()) {
                                $clientsInfo[$client->getId()]['PICTURE'] = CFile::GetPath($client->getPreviewPicture());
                            }
                        }
                    }

                    $trainerInfo['CLIENTS'] = $clientsInfo;
                }
            }
        }

        $certificates = ElementCertificatesTable::getList([
            'select' => [
                'PREVIEW_PICTURE',
                'PREVIEW_TEXT'
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                'EXPERT.VALUE' => $trainer->getId()
            ]
        ])->fetchCollection();

        if ($certificates) {
            $trainerCertifications = [];
            foreach ($certificates as $certificate) {
                $cert = [];

                if ($certificate->getPreviewPicture()) {
                    $cert['PICTURE'] = CFile::GetPath($certificate->getPreviewPicture());
                }

                if ($certificate->getPreviewText()) {
                    $cert['TEXT'] = $certificate->getPreviewText();
                }

                $trainerCertifications[] = $cert;
            }

            $trainerInfo['CERTIFICATES'] = $trainerCertifications;
        }

        if ($trainer->getOrganizationsTrainer() && $trainer->getOrganizationsTrainer()->getAll()) {
            $trainerOrg = [];
            foreach ($trainer->getOrganizationsTrainer()->getAll() as $value) {
                $trainerOrg[] = $value->getValue();
            }

            $trainerInfo['TRAINER_ORG'] = $trainerOrg;
        }

        return $trainerInfo;
    }

    protected function getReviews($config = []): array
    {
        $defaultConfig = [
            'filter' => [],
            'select' => $this->mapping('review', ['*', 'course', 'USER_NAME', 'USER_SURNAME', 'USER_REVIEW', 'client.ELEMENT']),
            //'limit'     => 3,
            'count_total' => true,
            'cache' => ['ttl' => 3600],
        ];
        $resultConfig = array_merge_recursive($defaultConfig, $config);

        $entity = IblockTable::compileEntity('reviews');
        $entityClass = $entity->getDataClass();

        $list = $entityClass::getList($resultConfig);
        $this->arResult['countReviews'] = $list->getCount();

        $collection = $list->fetchCollection();
        foreach ($collection as $collectionItem) {
            $currentItem = [
                'id' => $collectionItem->get('ID'),
                'code' => $collectionItem->get('CODE'),
            ];

            $currentItem['text'] = $collectionItem->get('USER_REVIEW')->getValue();

            if ($collectionItem->get('CLIENT') && $collectionItem->get('client')->getElement()) {
                $currentItem['name'] = 'Компания ' . $collectionItem->get('client')->getElement()->getName();
                //TODO добавить город
                if (false && $collectionItem->get('client')->getElement()->getCity()) {
                    $currentItem['name'] .= ' (' . $collectionItem->get('client')->getElement()->getCity() . ')';
                }
            } else {
                if ($collectionItem->get('USER_SURNAME') && $collectionItem->get('USER_SURNAME')->getValue()) {
                    $currentItem['name'] = $collectionItem->get('USER_SURNAME')->getValue();
                }

                //TODO конвертировать свойства как на английской версии
                if (false && $collectionItem->get('USER_NAME') && $collectionItem->get('USER_NAME')->getValue()) {
                    $currentItem['name'] .= ' ' . $collectionItem->get('USER_NAME')->getValue();
                }

                if (empty($currentItem['name'])) {
                    $currentItem['name'] = 'Участник тренинга';
                }
            }

            $this->reviews[] = $currentItem;
        }

        return $this->reviews;
    }

    protected function getUserPositions(): array
    {
        return [
            'Системный аналитик',
            'Дизайнер интерфейсов UI/UX',
            'Инженер больших данных',
            'Аналитик данных',
            'Архитектор ПО',
            'Архитектор ИТ решений',
            'Java разработчик',
            '.NET разработчик',
            'Web разработчик',
            'Разработчик мобильных приложений',
            'Python разработчик',
            'Менеджер проектов',
            'Тимлид',
            'Инженер по автоматизации тестирования',
            'Тестировщик ПО',
            'Инженер DevOps',
            'Инженер по безопасности ПО',
            'Руководитель ИТ отдела/департамента',
        ];
    }

    protected function getMenu(): array
    {
        $this->menu = [];

        if ($this->course['content']['description']) {
            $this->menu[] = ['text' => Loc::getMessage('MENU_DESCRIPTION'), 'link' => '#description'];
        }

        if ($this->course['content']['objectives']) {
            $this->menu[] = ['text' => Loc::getMessage('MENU_OBJECTIVES'), 'link' => '#objectives'];
        }

        if ($this->course['content']['audience']) {
            $this->menu[] = ['text' => Loc::getMessage('MENU_AUDIENCE'), 'link' => '#audience'];
        }

        if (false && $this->course['content']['prerequisites']) {
            $this->menu[] = ['text' => Loc::getMessage('MENU_PREREQUISITES'), 'link' => '#prerequisites'];
        }

        if ($this->course['content']['roadmap'] || $this->course['content']['roadmapBlocks']) {
            $this->menu[] = ['text' => Loc::getMessage('MENU_ROADMAP'), 'link' => '#roadmap'];
        }

        if (count($this->trainers)) {
            $this->menu[] = ['text' => Loc::getMessage('MENU_TRAINERS'), 'link' => '#trainers'];
        }

        $this->menu[] = ['text' => Loc::getMessage('MENU_SCHEDULE'), 'link' => '#schedule'];

        if (count($this->reviews)) {
            $this->menu[] = ['text' => Loc::getMessage('MENU_REVIEWS'), 'link' => '#reviews'];
        }

        return $this->menu;
    }

    protected function parseName(string $fullName): array
    {
        $result = [];
        $nameKeys = [0 => 'last', 1 => 'first', 2 => 'second'];

        foreach (explode(' ', $fullName) as $index => $partName) {
            $result[$nameKeys[$index]] = $partName;
        }

        $result['full'] = $fullName;

        return $result;
    }

    protected function setSeoParams(): void
    {
        global $APPLICATION;
        $APPLICATION->SetTitle(trim($this->course['name'] . ' | ' . Loc::getMessage('TITLE_SEPARATOR') . ' | ' . $this->course['category']['name']));

        $meta = [
            'title' => $this->course['meta']['name'] ?? $this->course['name'],
            'description' => $this->course['meta']['description'] ?: $this->course['content']['shortDescription'] ?: $this->course['content']['description'],
            'image' => $this->course['meta']['image'] ?? $this->course['category']['picture'],
            'url' => $APPLICATION->GetCurUri(),
        ];

        Asset::getInstance()->addString("<meta name='description' content='{$meta['description']}'/>", true);
        Asset::getInstance()->addString('<meta property="og:type" content="website"/>', true);
        Asset::getInstance()->addString("<meta property='og:title' content='{$meta['title']}'/>", true);
        Asset::getInstance()->addString("<meta property='og:description' content='{$meta['description']}'/>", true);
        Asset::getInstance()->addString("<meta property='og:url' content='{$meta['url']}'/>", true);
        Asset::getInstance()->addString("<meta property='og:image' content='{$meta['image']}'/>", true);
    }

    public function executeComponent()
    {
        //TODO кеширование
        if ($this->checkModules()
            && $this->checkRequiredParameters()
        ) {
            $this->setInitData();
            if (!$this->request['CODE']) {
                $this->request = $_REQUEST;
            }

            if ($this->request['CODE']) {
                $this->arResult = $this->getCourse([
                    'filter' => [
                        [
                            'LOGIC' => 'OR',
                            ['CODE' => $this->request['CODE']],
                            ['XML_ID' => $this->request['CODE']]
                        ]
                    ]
                ]);

                $this->arResult['courses'] = $this->getCourses(['filter' => ['ID' => array_keys($this->courses)]]);

                $this->arResult['schedule'] = $this->getSchedule(['filter' => [$this->mapping('schedule', 'course.VALUE') => $this->course['id']]], true);

                $this->arResult['reviews'] = $this->getReviews(['filter' => ['COURSE.VALUE' => $this->course['id']]]);

                $this->arResult['menu'] = $this->getMenu();

                $this->arResult['positions'] = $this->getUserPositions();
                $this->arResult['links'] = [
                    'schedule' => '/timetable/',
                    'catalog' => '/training/katalog_kursov/',
                ];

                //TODO переписать кусок
                foreach ($this->arResult['schedule'] as $scheduleItem) {
                    $this->arResult['scheduleId'] = (string)$scheduleItem['id'];
                    if (!empty($ID_TIME = $this->request['ID_TIME'])) {
                        if ($scheduleItem['id'] == $ID_TIME) {
                            break;
                        }
                    } else {
                        $this->arResult['scheduleId'] = (string)$scheduleItem['id'];
                        break;
                    }
                }
                if (empty($this->arResult['scheduleId'])) {
                    $this->arResult['scheduleId'] = 'openDate';
                }

                $this->setSeoParams();

            } else {
                Tools::process404(
                    Loc::getMessage('ERROR_404'),
                    true,
                    true,
                    true,
                    false
                );
            }

            $this->errorCollection->clear();
            $this->includeComponentTemplate();
        }

        if ($this->hasErrors()) {
            $this->showErrors();
        }
    }

    public function configureActions(): array
    {
        return [
            'formSave' => [
                'prefilters' => [],
            ],
        ];
    }

    public function formSaveAction(
        $courseId,
        $courseCode,
        $courseName,
        $courseDetailUrl,
        $scheduleId,
        $scheduleTime,
        $scheduleDuration,
        $scheduleLocation,
        $name,
        $company,
        $email,
        $phone,
        $comment = '',
        $city = '',
        $position = '',
        $scheduleDateStart = '',
        $scheduleDateEnd = '',
        $recommendations = []
    ): array
    {
        $application = \Bitrix\Main\Application::getInstance();
        $request = $application->getContext()->getRequest();

        Loader::includeModule('iblock');

        //TODO переписать добавление элемента на ORM
        $el = new \CIBlockElement;

        $arEvent = [
            'NAME' => $courseCode . ' ' . $courseName,
        ];

        $props = [
            'fullname' => $name,
            'email' => $email,
            'telephone' => $phone,
            'company' => $company,
            'dolgnost' => $position,
            'COMMENT' => $comment,
            'city' => $city,

            'timetable_id' => $scheduleId,
            'date_event' => new \Bitrix\Main\Type\DateTime($scheduleDateStart, 'd.m.Y'),
            'eventTime' => $scheduleTime,
            'eventLocation' => $scheduleLocation,

            'event_id' => $courseId,
            'CAT_COURSE' => $courseId,
            'courseCode' => $courseCode,
            'courseName' => $courseName,
            'courseDetailUrl' => $courseDetailUrl,
            'recommendations' => $recommendations,
            'CLIENT_ID_YANDEX' => $request->getCookieRaw('_ym_uid'),
            'CLIENT_ID_GOOGLE' => $request->getCookieRaw('_ga'),
        ];

        if ($parseName = $this->parseName($name)) {
            if ($parseName['first']) {
                $props['firstname'] = $parseName['first'];
            }
            if ($parseName['last']) {
                $props['lastname'] = $parseName['last'];
            }
            if ($parseName['second']) {
                $props['middlename'] = $parseName['second'];
            }
        }

        $props['type'] = 78;
        $arEvent['IBLOCK_ID'] = 64;

        $arEvent['PROPERTY_VALUES'] = &$props;

        if ($resultId = $el->Add($arEvent)) {
            return ['resultId' => $resultId, 'message' => Loc::getMessage('SUCCESS_FORM_MESSAGE')];
        } else {
            $this->errorCollection = new Error($el->LAST_ERROR);
            return $this->getErrors();
        }
    }
}