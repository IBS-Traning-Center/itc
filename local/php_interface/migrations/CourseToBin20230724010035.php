<?php

namespace Sprint\Migration;


use Bitrix\Main\Loader;
use Bitrix\Iblock\Elements\ElementCoursesTable;

class CourseToBin20230724010035 extends Version
{
    protected $description = "Миграция по импорту курсов в файл";

    protected $moduleVersion = "4.3.1";

    public function up()
    {
        if(!Loader::includeModule('iblock')) {
            return false;
        }

        $courseResult = ElementCoursesTable::getList([
            'order' => ['ID' => 'ASC'],
            'select' => [
                '*',
                'ROADMAP_TITLE',
                'ROADMAP_DESCRIPTION',
                'category',
                'course_price',
                'course_duration',
                'COMPLEXITY.ITEM',
                'ID_COURSE_OWNER.ITEM',
                'course_language',
                'course_format.ITEM',
                'is_certification',
                'ID_LINKED_COURSES',
                'course_linked_new',
                'course_test_link',
                'ID_PREDV_COURSES',
                'course_req_new',
                'course_desc_new',
                'short_descr',
                'course_other',
                'course_addsources',
                'course_audience',
                'course_puproses',
                'course_top_html'
            ],
            //'filter' => ['id' => 129308],
        ]);

        $courseCollection = $courseResult->fetchCollection();

        $data = [];
        foreach ($courseCollection as $course) {
            $data[] = $this->getData($course);
        }

        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/local/courses.bin';
        $packedData = msgpack_pack($data);
        file_put_contents($filePath, $packedData);

        return true;
    }

    public function getData($course)
    {

        $language = $course->get('course_language')?->getValue();
        $language = (mb_strtolower($language) === 'английский') ? 'en' : 'ru';

        $roadMapText = '';

        $roadMap = [
            'title' => $course->get('ROADMAP_TITLE')?->fill(['VALUE']),
            'description' => $course->get('ROADMAP_DESCRIPTION')?->fill('VALUE'),
        ];

        foreach ($roadMap['title'] as $index => $title) {
            $description = $roadMap['description'][$index];
            $description = $this->convertTextValueToString($description);

            $roadMapText .= "<b>$title</b><br>";
            $roadMapText .= "$description <br>";
        }

        if (!$roadMapText) {
            $roadMapText = $course->get('course_top_html')?->getValue();
            $roadMapText = $this->convertTextValueToString($roadMapText);
        }

        $relatedCoursesText = $course->get('course_linked_new')?->getValue();
        if ($relatedCoursesText) {
            $relatedCoursesText = $this->convertTextValueToString($relatedCoursesText);
        }

        $preparationText = $course->get('course_req_new')?->getValue();
        if ($preparationText) {
            $preparationText = $this->convertTextValueToString($preparationText);
        }

        $textDetail = $course->get('course_desc_new')?->getValue();
        if ($textDetail) {
            $textDetail = $this->convertTextValueToString($textDetail);
        }

        $textPreview = $course->get('short_descr')?->getValue();
        if ($textPreview) {
            $textPreview = $this->convertTextValueToString($textPreview);
        }

        $targetAudience = $course->get('course_audience')?->getValue();
        if ($targetAudience) {
            $targetAudience = $this->convertTextValueToString($targetAudience);
        }

        $courseGoals = $course->get('course_puproses')?->getValue();
        if ($courseGoals) {
            $courseGoals = $this->convertTextValueToString($courseGoals);
        }

        $note = $course->get('course_other')?->getValue();
        if ($note) {
            $note = $this->convertTextValueToString($note);
        }

        $additional = $course->get('course_addsources')?->getValue();
        if ($additional) {
            $additional = $this->convertTextValueToString($additional);
        }

        $date_create = $course->getDateCreate();
        $date_change = $course->getTimestampX();

        return [
            'id' => $course->get('id'),
            'active' => $course->get('active'),
            'sort' => $course->get('sort'),
            'date_create' => $date_create,
            'date_change' => $date_change,
            'name' => $course->get('name'),
            'code' => $course->get('code'),
            'direction' => $course->get('category')?->getValue(), // категория
            'price' =>  $course->get('course_price')?->getValue(),
            'duration' => $course->get('course_duration')?->getValue(),
            'level' => array_map(function ($level) {
                return $level?->getItem()?->get('XML_ID');
            }, $course->get('COMPLEXITY')?->getAll()),
            'owner' => $course->get('ID_COURSE_OWNER')?->getItem()?->getXmlId(),
            'language' => $language,
            'format' => $course->get('course_format')?->getItem()?->getXmlId(),
            'is_certification' => !!$course->get('is_certification')->getValue(),
            'related_courses' => $course->get('ID_LINKED_COURSES')?->fill(['VALUE']),
            'preparation' => $course->get('ID_PREDV_COURSES')?->fill(['VALUE']),
            'preparation_text' => $preparationText,
            'course_test_link' => $course->get('course_test_link')?->getValue(),
            'related_courses_text' => $relatedCoursesText,
            'text_detail' => $textDetail,
            'text_preview' => $textPreview,
            'target_audience' => $targetAudience,
            'course_goals' => $courseGoals,
            'note' => $note,
            'additional' => $additional,
            'content' => $roadMapText,
        ];
    }

    public function convertTextValueToString($content): ?string
    {
        if (empty($content)) {
            return $content === null ? null : '';
        }

        if (!$unserialize = unserialize($content)) {
           return $content;
        }

        if (is_array($unserialize) && $unserialize['TEXT']) {
            $content = $unserialize['TEXT'];

            preg_match('/a:2:\{s:4:"(TEXT|HTML)";s:\d+:"(.*?)";s:4:"TYPE";s:4:"TEXT";\}/si', $content, $matches);
            if ($matches[2]) {
                $content = $matches[2];
            }
        }

        return $content;
    }

    public function down()
    {
        //your code ...
    }
}
