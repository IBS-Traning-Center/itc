<?php

declare(strict_types=1);

namespace Itc\Catalog\Controller;

use Bitrix\Main\Engine\ActionFilter\Authentication;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\Controller;

use Bitrix\Main\Loader;
use Itc\Catalog\Entity\TeacherTable;
use Itc\Catalog\Entity\TeacherObject;

class TeacherController extends Controller
{
    public function configureActions()
    {
        return [
            'getAllId' => [
                '-prefilters' => [
                    Csrf::class,
                    Authentication::class,
                ]
            ],
            'getById' => [
                '-prefilters' => [
                    Csrf::class,
                    Authentication::class,
                ]
            ],
            'updateById' => [
                '-prefilters' => [
                    Csrf::class,
                    Authentication::class,
                ]
            ],
            'deleteById' => [
                '-prefilters' => [
                    Csrf::class,
                    Authentication::class,
                ]
            ],
        ];
    }

    public function getAllIdAction()
    {
        Loader::includeModule('iblock');

        $teachers = TeacherTable::getList([
            'select' => ['ID'],
            'filter' => [],
        ])->fetchAll();

        return [
            'teacherIds' => array_column($teachers, 'ID')
        ];
    }

    public function getByIdAction($id)
    {
        $teacher = TeacherObject::waukUp(['ID' => $id]);
        return [];
    }

    public function updateByIdAction($id, $fields)
    {
        $teacher = TeacherObject::waukUp(['ID' => $id]);
        return [];
    }

    public function deleteByIdAction($id)
    {
        $teacher = TeacherObject::waukUp(['ID' => $id]);
        return [];
    }
}