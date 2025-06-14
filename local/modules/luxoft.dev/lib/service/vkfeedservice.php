<?php

namespace Luxoft\Dev\Service;

use DOMDocument;
use Bitrix\Main\Error;
use Bitrix\Main\Loader;
use Bitrix\Main\Web\Json;
use Bitrix\Main\ORM\Entity;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\ORM\Data\Result;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Iblock\Elements\ElementScheduleTable;
use Bitrix\Iblock\Elements\ElementCoursesTable;
use Bitrix\Iblock\Elements\ElementCourseDirectionsTable;

class VkFeedService
{
    protected $siteUrl = 'https://ibs-training.ru';
    protected array $trainingCenterInfo;
    protected string $baseSectionUrl;

    public function __construct()
    {
        Loader::includeModule('iblock');

        $this->trainingCenterInfo = [
            'title' => 'ibs-training.ru Feed',
            'name' => 'Учебный центр IBS',
            'company' => 'АНО ДПО "УЦ ИБС"',
            'url' => $this->siteUrl,
            'email' => 'education@ibs.ru',
            'picture' => '{$this->siteUrl}/local/templates/ibs-training_new/assets/images/IBS_logo_gradient.svg',
            'description' => 'Обучение для программистов, аналитиков, менеджеров проектов: тренинги, курсы, ' .
                'бесплатные семинары и вебинары, конференции',
            'currencies' => [
                'RUR' => '1',
            ]
        ];
        $this->baseSectionUrl = "{$this->siteUrl}/training/katalog_kursov/";
    }

    protected function getCategories(): Result
    {
        $result = new Result();

        $sections = [];
        $allSectionsId = [];
        $sectionsResult = \CIBlockSection::GetList(
            ['LEFT_MARGIN' => 'ASC'],
            [
                'IBLOCK_ID' => ElementCourseDirectionsTable::getEntity()->getIblock()->getId(),
                'ACTIVE' => 'Y',
            ],
            false,
            ['ID', 'NAME', 'CODE', 'SORT', 'DEPTH_LEVEL']
        );

        $currentSection = [];
        while ($sectionResult = $sectionsResult->Fetch()) {
            $allSectionsId[] = $sectionResult['ID'];

            if ($sectionResult['DEPTH_LEVEL'] == '1') {
                if ($currentSection) {
                    $sections[] = $currentSection;
                    $currentSection = [];
                }
                $currentSection = [
                    'id' => $sectionResult['ID'],
                    'sort' => $sectionResult['SORT'],
                    'name' => $sectionResult['NAME'],
                    'code' => $sectionResult['CODE'],
                    'url' => $this->baseSectionUrl . $sectionResult['CODE'] . '/',
                    'includeSectionsId' => [$sectionResult['ID']],
                    'includeElementsId' => [],
                ];
            } else {
                $currentSection['includeSectionsId'][] = $sectionResult['ID'];
            }
        }
        if ($currentSection) {
            $sections[] = $currentSection;
            unset($currentSection);
        }

        $elementsResult = \CIBlockElement::GetList(
            [],
            [
                'IBLOCK_ID' => ElementCourseDirectionsTable::getEntity()
                    ->getIblock()
                    ->getId(),
                'IBLOCK_SECTION_ID' => $allSectionsId,
            ],
            false,
            false,
            ['ID', 'IBLOCK_SECTION_ID', 'PROPERTY_PP_COURSE']
        );
        while ($elementResult = $elementsResult->Fetch()) {
            foreach ($sections as &$section) {
                if (in_array($elementResult['IBLOCK_SECTION_ID'], $section['includeSectionsId'])) {
                    $section['includeElementsId'][] = $elementResult['PROPERTY_PP_COURSE_VALUE'];
                }
            }
        }
        array_multisort(array_column($sections, 'sort'), SORT_ASC, $sections);

        $result->setData($sections);
        return $result;
    }

    protected function checkCourseObject($courseObject): bool
    {
        if (
            !$courseObject->getCategoryYandex()
            || !$courseObject->getCategoryYandex()->getAll()
        ) {
            return false;
        }

        if (
            !$courseObject->getRoadmapTitle()
            || !$courseObject->getRoadmapTitle()->getAll()
        ) {
            return false;
        }

        if (
            !$courseObject->getRoadmapTitle()
            || !$courseObject->getRoadmapDescription()
        ) {
            return false;
        }

        $roadmap = [];
        $roadmapTitles = $courseObject->getRoadmapTitle()->getAll();
        foreach ($roadmapTitles as $key => $roadmapTitle) {
            $title = $roadmapTitle->getValue() ?: '';
            $title = $this->getText($title);
            $roadmap[$key]['title'] = strip_tags($title);
        }

        $roadmapDescriptions = $courseObject->getRoadmapDescription()->getAll();
        foreach ($roadmapDescriptions as $key => $roadmapDescription) {
            $description = $roadmapDescription->getValue() ?: '';
            $roadmap[$key]['description'] = $this->getText($description);
        }

        $roadmap = array_filter($roadmap, function ($item) {
            return !empty(trim(strip_tags($item['title'])))
                && !empty(trim(strip_tags($item['description'])));
        });

        if (count($roadmap) < 3) {
            return false;
        }

        return true;
    }

    protected function getCourses(): Result
    {
        $result = new Result();

        /** @var Entity $entity */
        $entity = ElementCoursesTable::getEntity();
        /** @var DataManager $class */
        $class = $entity->getDataClass();
        $query = $class::query()
            ->setOrder(['CODE' => 'ASC'])
            ->setSelect([
                'ID',
                'CODE',
                'NAME',
                'XML_ID',
                'short_descr_' => 'short_descr',
                'CATEGORY_YANDEX_' => 'CATEGORY_YANDEX',
                'course_duration_' => 'course_duration',
                'course_price_' => 'course_price',
                'ROADMAP_TITLE_' => 'ROADMAP_TITLE',
                'ROADMAP_DESCRIPTION_' => 'ROADMAP_DESCRIPTION',
                'COMPLEXITY.ITEM',
                'course_format_' => 'course_format'
            ])
            ->where('ACTIVE', 'Y')
            ->countTotal(true)
            ->setCacheTtl(3600)
            ->exec();

        if (!$query->getCount()) {
            $result->addError(new \Bitrix\Main\Error('Курсы не найдены'));
            return $result;
        }

        $courses = [];
        foreach ($query->fetchCollection() as $course) {
            if (!$this->checkCourseObject($course)) {
                continue;
            }

            $arCourse = [
                'id' => $course->getId(),
                'name' => htmlspecialchars($course->getName()),
                'code' => $course->getCode(),
                'description' => $course->getShortDescr() ? $course->getShortDescr()->getValue() : '',
                'url' => "{$this->trainingCenterInfo['url']}/kurs/{$course->getXmlId()}.html",
                'price' => $course->getCoursePrice() ? $course->getCoursePrice()->getValue() : '',
                'duration' => $course->getCourseDuration() ? $course->getCourseDuration()->getValue() : '',
                'format' => ($course->getCourseFormat() && $course->getCourseFormat()->getValue()) ? $course->getCourseFormat()->getValue() : 'online',
            ];

            $roadmapTitles = $course->getRoadmapTitle()->getAll();
            foreach ($roadmapTitles as $key => $roadmapTitle) {
                $title = $roadmapTitle->getValue() ?: '';
                $title = $this->getText($title);
                $arCourse['roadmap'][$key]['title'] = strip_tags($title);
            }

            $roadmapDescriptions = $course->getRoadmapDescription()->getAll();
            foreach ($roadmapDescriptions as $key => $roadmapDescription) {
                $description = $roadmapDescription->getValue() ?: '';
                $arCourse['roadmap'][$key]['description'] = $this->getText($description);
            }

            $categories = [];
            foreach ($course->getCategoryYandex()->getAll() as $category) {
                $categories[] = $category->getValue();
            }
            $arCourse['categoryId'] = (string)$categories[0];
            $arCourse['categoryIdAdd'] = (string)$categories[1];

            $arCourse['complexity'] = [];
            if (
                $course->getComplexity() && $course->getComplexity()->getItem() && $course->getComplexity()->getItem()->getValue()
            ) {
                $arCourse['complexity'] = $course->getComplexity()->getItem()->getValue();
            }

            $courses[$arCourse['id']] = $arCourse;
        }

        $result->setData($courses);
        unset($courses);

        return $result;
    }

    protected function getSchedule(): Result
    {
        $result = new Result();

        /** @var Entity $entity */
        $entity = ElementScheduleTable::getEntity();
        /** @var DataManager $class */
        $class = $entity->getDataClass();
        $query = $class::query()
            ->setOrder([
                'startdate.VALUE' => 'ASC',
                'CODE' => 'ASC'
            ])
            ->setSelect([
                'ID',
                'CODE',
                'schedule_course_' => 'schedule_course',
                'schedule_price_' => 'schedule_price',
                'course_sale_' => 'course_sale',
                'startdate_' => 'startdate',
            ])
            ->where('ACTIVE', 'Y')
            ->where('startdate.VALUE', '>', (new DateTime())->format('Y-m-d H:i:s'))
            ->countTotal(true)
            ->setCacheTtl(3600)
            ->exec();

        if (!$query->getCount()) {
            $result->addError(new \Bitrix\Main\Error('Расписание не найдено'));
            return $result;
        }

        $schedule = [];
        foreach ($query->fetchCollection() as $itemCollection) {
            $scheduleItem = [
                'id' => $itemCollection->getId(),
                'code' => $itemCollection->getCode(),
                'courseId' => $itemCollection->getScheduleCourse() ? $itemCollection->getScheduleCourse()->getValue() : '',
                'price' => $itemCollection->getSchedulePrice() ? $itemCollection->getSchedulePrice()->getValue() : '',
                'sale' => $itemCollection->getCourseSale() ? $itemCollection->getCourseSale()->getValue() : '',
                'nextDate' => $itemCollection->getStartdate() ? $itemCollection->getStartdate()->getValue() : '',
            ];

            if ($scheduleItem['nextDate']) {
                //$scheduleItem['nextDate'] = ($scheduleItem['nextDate'])->format('Y-m-d H:i:s');
            }
            // todo: переделать
            if (empty($schedule[$scheduleItem['courseId']])) {
                $schedule[$scheduleItem['courseId']] = $scheduleItem;
            }
        }

        $result->setData($schedule);
        return $result;
    }

    protected function getCourseCategories($courseId, $categories): string
    {
        $result = array_reduce($categories, function ($carry, $item) use ($courseId) {
            if (in_array($courseId, $item['includeElementsId'])) {
                $carry[] = $item['id'];
            }
            return $carry;
        }, []);

        return implode(', ', $result);
    }

    protected function getText($text): string
    {
        if (unserialize($text)['TEXT']) {
            return unserialize($text)['TEXT'];
        }
        return $text;
    }

    public function getXml(): string
    {
        $categoriesResult = $this->getCategories();
        if (!$categoriesResult->isSuccess()) {
            //todo вывод ошибки
        }
        $categories = $categoriesResult->getData();

        $courseResult = $this->getCourses();
        if (!$courseResult->isSuccess()) {
            // todo: обработка ошибок
        }
        $courses = $courseResult->getData();

        $scheduleResult = $this->getSchedule();
        if (!$scheduleResult->isSuccess()) {
            // todo: обработка ошибок
        }
        $schedule = $scheduleResult->getData();

        $allCoursesId = array_keys($courses);
        $categories = array_filter($categories, function ($category) use ($allCoursesId) {
            return (bool)array_intersect($category['includeElementsId'], $allCoursesId);
        });

        /*$courses = array_map(function ($course) {
            $course['complexity'] = array_intersect(['junior'], $course['complexity'])
                ? 'Для новичков'
                : 'Для опытных';
            return $course;
        }, $courses);*/

        $dom = new DOMDocument('1.0', 'utf-8');
        $dom->formatOutput = true;
        $ymlCatalog = $dom->createElement('yml_catalog');
        $ymlCatalog->setAttribute('date', date('y-m-d h:j'));

        $shop = $dom->createElement('shop');

        $shop->appendChild($dom->createElement('name', $this->trainingCenterInfo['name']));
        $shop->appendChild($dom->createElement('company', $this->trainingCenterInfo['name']));
        $shop->appendChild($dom->createElement('url', $this->trainingCenterInfo['url']));

        $currencies = $dom->createElement('currencies');
        foreach ($this->trainingCenterInfo['currencies'] as $currency => $rate) {
            $currencyNode = $dom->createElement('currency');
            $currencyNode->setAttribute('id', $currency);
            $currencyNode->setAttribute('rate', $rate);
            $currencies->appendChild($currencyNode);
            unset($currencyNode);
        }
        $shop->appendChild($currencies);
        unset($currencies);

        $offersNode = $dom->createElement('offers');
        foreach ($courses as $course) {
            if ($schedule[$course['id']]) {
                if ($schedule[$course['id']]['price']) {
                    $course['price'] = $schedule[$course['id']]['price'];
                }
                if ($schedule[$course['id']]['sale']) {
                    $price = $course['price'];
                    $sale = $schedule[$course['id']]['sale'];
                    $course['sale'] = $price - ($price * $sale / 100);
                }
                if ($schedule[$course['id']]['nextDate']) {
                    $course['nextDate'] = $schedule[$course['id']]['nextDate'];
                }
            }

            $offerNode = $dom->createElement('offer');
            $offerNode->setAttribute('id', $course['code']);
            $offerNode->setAttribute('available', 'true');

            $offerNode->appendChild($dom->createElement('name', $course['name']));
            $offerNode->appendChild($dom->createElement('description', $course['description']));

            $offerNode->appendChild($dom->createElement('price', $course['price']));
            $offerNode->appendChild($dom->createElement('currencyId', 'RUB'));
            $offerNode->appendChild($dom->createElement('picture', 'https://ibs-training.ru/upload/logo.png'));

            if ($course['sale']) {
                $offerNode->appendChild($dom->createElement('sale_price', $course['sale'] . ' RUB'));
            }

            $offersNode->appendChild($offerNode);

            unset($itemNode);
            unset($offer);
        }

        $shop->appendChild($offersNode);
        unset($offers);

        $ymlCatalog->appendChild($shop);
        return (string)$dom->saveXML($ymlCatalog);
    }
}