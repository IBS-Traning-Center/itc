<?php

namespace Sprint\Migration;

use Bitrix\Main\SystemException;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;


use Itc\Catalog\Adapter\CourseToCrmCourseAdapter;
use Itc\Catalog\Entity\Course;
use Itc\Catalog\Entity\CourseTable;
use Itc\Catalog\Service\ExchangeCatalogCourse;
use Sprint\Migration\Exceptions\RestartException;

class ImportCoursesNew20230423171956 extends Version
{
    protected $description = "Третья тестовая версия миграции по перносу курсов";

    protected $moduleVersion = "4.3.1";

    /**
     * @throws LoaderException
     * @throws RestartException
     */
    public function up(): bool
    {
        $this->params['totalCount'] = 1;

        if (!Loader::includeModule('iblock')) {
            return false;
        }
        $migrationFilter = ['active' => true, 'id' => 5999];

        if (!isset($this->params['offset'])) {
            $this->params['offset'] = 0;
        }

        try {
            if (!isset($this->params['totalCount'])) {
                $this->params['totalCount'] = CourseTable::getList([
                    'order' => ['id' => 'desc'],
                    'select' => ['id', 'active'],
                    'filter' => $migrationFilter,
                    'count_total' => true
                ])->getCount();
            }

            $offset = (int) $this->params['offset'];
            $course = CourseTable::getList([
                'order' => ['id' => 'desc'],
                'select' => ['id', 'active'],
                'filter' => $migrationFilter,
                'offset' => $offset,
                'limit' => 1
            ])->fetchObject();

            if (!$course) {
                throw new \Exception('Курс №'.($offset + 1).' не найден!');
            }

            $crmCourse = new CourseToCrmCourseAdapter($course);
            $result = (new ExchangeCatalogCourse())->saveCrmCourse($crmCourse);
        } catch (\Throwable $exception) {
            $this->outError($exception->getMessage());
        }

        $this->params['offset'] = $offset + 1;
        $this->outProgress(
            'Выгружено элементов: ' . $this->params['offset'] . ' из ' . $this->params['totalCount'],
            $this->params['offset'], $this->params['totalCount']
        );
        if ($this->params['offset'] >= $this->params['totalCount']) {
            return true;
        }

        $this->restart();
    }

    public function down()
    {
        //your code ...
    }
}
