<?php
declare(strict_types=1);

namespace Luxoft\Dev\Table;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;

class CertificationTypeTable
    extends DataManager
{
    public static function getTableName(): string
    {
        return 'itc_certification_type';
    }

    public static function getMap(): array
    {
        return [
            (new IntegerField('id'))
                ->configureColumnName('ID')
                ->configureAutocomplete(true),

            (new StringField('code'))
                ->configureColumnName('UF_XML_ID')
                ->configurePrimary(true)
                ->configureRequired(true),

            (new StringField('name'))
                ->configureColumnName('UF_NAME')
                ->configureRequired(true),
        ];
    }
}