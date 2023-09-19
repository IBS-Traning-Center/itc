<?php

declare(strict_types=1);

namespace Itc\Catalog\Entity;

use Bitrix\Iblock\Elements\ElementTrainersTable;
use Itc\Catalog\Entity\TeacherObject;

class TeacherTable extends ElementTrainersTable
{
    public static function getObjectClass(): string
    {
        return TeacherObject::class;
    }
}