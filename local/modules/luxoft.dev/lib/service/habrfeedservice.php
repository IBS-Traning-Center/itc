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

class HabrFeedService
{
    protected $siteUrl = 'https://ibs-training.ru';
    protected array $trainingCenterInfo;
    protected string $baseSectionUrl;

    public function __construct()
    {
        Loader::includeModule('iblock');

        $this->trainingCenterInfo = [
            'name' => 'Учебный центр IBS',
            'company' => 'АНО ДПО "УЦ ИБС"',
            'url' => $this->siteUrl,
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
            !$courseObject->getHabrSpec()
            || !$courseObject->getHabrSpec()->getValue()
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
                'HABR_SPEC_' => 'HABR_SPEC',
                'HABR_MIN_KVAL_' => 'HABR_MIN_KVAL',
                'HABR_MAX_KVAL_' => 'HABR_MAX_KVAL',
                'HABR_SKILLS_' => 'HABR_SKILLS',
                'FORMAT_' => 'FORMAT'
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

            $couseName = $course->getCode() . ' ' . htmlspecialchars($course->getName());

            $arCourse = [
                'id' => $course->getId(),
                'name' => $couseName,
                'code' => $course->getCode(),
                'description' => $course->getShortDescr() ? $course->getShortDescr()->getValue() : '',
                'url' => "{$this->trainingCenterInfo['url']}/kurs/{$course->getXmlId()}.html",
                'price' => $course->getCoursePrice() ? $course->getCoursePrice()->getValue() : '',
                'duration' => $course->getCourseDuration() ? $course->getCourseDuration()->getValue() : '',
                'spec' => $course->getHabrSpec() ? $course->getHabrSpec()->getValue() : '',
                'kval_min' => $course->getHabrMinKval() ? $course->getHabrMinKval()->getValue() : '',
                'kval_max' => $course->getHabrMaxKval() ? $course->getHabrMaxKval()->getValue() : '',
                'format' => ($course->getFormat() && $course->getFormat()->getValue()) ? 'online' : 'online',
            ];

            if ($course->getHabrSkills() && $course->getHabrSkills()->getValue()) {
                $arCourse['skills'] = explode(',', $course->getHabrSkills()->getValue());
            }

            $roadmapTitles = $course->getRoadmapTitle()->getAll();
            foreach ($roadmapTitles as $key => $roadmapTitle) {
                $title = $roadmapTitle->getValue() ?: '';
                $title = $this->getText($title);
                $arCourse['roadmap'][$key]['title'] = strip_tags($title);
            }

            $roadmapDescriptions = $course->getRoadmapDescription()->getAll();
            foreach ($roadmapDescriptions as $key => $roadmapDescription) {
                $description = $roadmapDescription->getValue() ?: '';
                $arCourse['roadmap'][$key]['description'] = strip_tags($this->getText($description));
            }

            $categories = [];
            foreach ($course->getCategoryYandex()->getAll() as $category) {
                $categories[] = $category->getValue();
            }


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
                'sale' => $itemCollection->getCourseSale() ? $itemCollection->getCourseSale()->getValue() : '',
                'nextDate' => $itemCollection->getStartdate() ? $itemCollection->getStartdate()->getValue() : '',
            ];

            if ($scheduleItem['nextDate']) {
                $scheduleItem['nextDate'] = (new DateTime($scheduleItem['nextDate'], 'Y-m-d H:i:s'))->format('Y-m-d');
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
        $shop->appendChild($dom->createElement('company', $this->trainingCenterInfo['company']));
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


            $fullDescription = $course['description'];

            foreach ($course['roadmap'] as $roadmapKey => $roadmapItem) {
                $fullDescription .= $roadmapItem['description'];
            }

            $course['url'] = $course['url'] . '?utm_source=habr&utm_campaign=career_habr';

            $offerNode->setAttribute('id', $course['id']);

            $urlNode = $dom->createElement('url');
            $urlNode->textContent = $course['url'];
            $offerNode->appendChild($urlNode);

            $offerNode->appendChild($dom->createElement('name', $course['name']));

            $descriptionNode = $dom->createElement('description');
            $descriptionNode->textContent = $fullDescription;
            $offerNode->appendChild($descriptionNode);

            $offerNode->appendChild($dom->createElement('price', $course['price']));
            $offerNode->appendChild($dom->createElement('currencyId', 'RUR'));

            if ($course['spec']) {
                $offerNode->appendChild($dom->createElement('specialization', $course['spec']));
            }

            if ($course['skills']) {
                $skillsDom = $dom->createElement('skills');

                foreach ($course['skills'] as $key => $skill) {
                    $num = $key + 1;
                    $skillDom = $dom->createElement('skill', trim($skill));
                    $skillDom->setAttribute('id', $num);
                    $skillsDom->appendChild($skillDom);
                }

                $offerNode->appendChild($skillsDom);
            }

            if ($course['sale']) {
                $saleNode = $dom->createElement('param', $course['sale']);

                $offerNode->appendChild($saleNode);
            }

            $educationFormatNode = $dom->createElement('param', $course['format']);
            $educationFormatNode->setAttribute('name', 'Формат');
            $offerNode->appendChild($educationFormatNode);

            if ($course['nextDate']) {
                $nextDateNode = $dom->createElement('param', $course['nextDate']);
            } else {
                $nextDateNode = $dom->createElement('param', 'По факту набора потока');
            }
            $nextDateNode->setAttribute('name', 'Дата начала');
            $offerNode->appendChild($nextDateNode);

            if ($course['kval_min']) {
                $kvalMin = $dom->createElement('param', $course['kval_min']);
                $kvalMin ->setAttribute('name', 'Требуемая квалификация');
                $offerNode->appendChild($kvalMin);
            }

            if ($course['kval_max']) {
                $kvalMax = $dom->createElement('param', $course['kval_max']);
                $kvalMax ->setAttribute('name', 'Получаемая квалификация');
                $offerNode->appendChild($kvalMax);
            }

//            $complexity = $dom->createElement('param', $course['complexity']);
//            $complexity ->setAttribute('name', 'Для кого');
//
//            $offerNode->appendChild($complexity);

            $duration = ceil($course['duration'] / 20);
            $durationNode = $dom->createElement('duration', $duration);
            $durationNode ->setAttribute('unit', 'week');

            $offerNode->appendChild($durationNode);

            $certificateNode = $dom->createElement('param', 'Да');
            $certificateNode ->setAttribute('name', 'Выдаётся сертификат');
            $offerNode->appendChild($certificateNode);
                        

            $offersNode->appendChild($offerNode);
            unset($offer);
        }
        $shop->appendChild($offersNode);
        unset($offers);

        $ymlCatalog->appendChild($shop);
        return (string)$dom->saveXML($ymlCatalog);
    }
}