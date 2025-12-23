<?php
declare(strict_types=1);

namespace Luxoft\Dev\Table;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\DateField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;

define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/log.txt");

/**
 * Class VerifiedProgramsTable
 * 
 * Fields:
 * <ul>
 * <li> id int mandatory
 * <li> program_name string(255) mandatory
 * <li> program_short_description string(255) mandatory
 * <li> program_id string(50) mandatory
 * <li> link string(255) mandatory
 * <li> certificate_type string(30) mandatory
 * <li> certification_level string(30) mandatory
 * <li> date_start date mandatory
 * <li> date_revision date mandatory
 * <li> skills_list string(255) optional
 * </ul>
 *
 **/

class VerifiedProgramsTable extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'verified_programs';
	}

	/**
	 * Returns entity map definition.
	 *
	 * @return array
	 */
	public static function getMap()
	{
		return [
			'id' => (new IntegerField('id',
					[]
				))->configureTitle(Loc::getMessage('PROGRAMS_ENTITY_ID_FIELD'))
						->configurePrimary(true)
						->configureAutocomplete(true)
			,
			'program_name' => (new StringField('program_name',
					[
						'validation' => function()
						{
							return[
								new LengthValidator(null, 255),
							];
						},
					]
				))->configureTitle(Loc::getMessage('PROGRAMS_ENTITY_PROGRAM_NAME_FIELD'))
						->configureRequired(true)
			,
			'program_short_description' => (new StringField('program_short_description',
					[
						'validation' => function()
						{
							return[
								new LengthValidator(null, 255),
							];
						},
					]
				))->configureTitle(Loc::getMessage('PROGRAMS_ENTITY_PROGRAM_SHORT_DESCRIPTION_FIELD'))
						->configureRequired(true)
			,
			'program_id' => (new StringField('program_id',
					[
						'validation' => function()
						{
							return[
								new LengthValidator(null, 50),
							];
						},
					]
				))->configureTitle(Loc::getMessage('PROGRAMS_ENTITY_PROGRAM_ID_FIELD'))
						->configurePrimary(true)
			,
			'link' => (new StringField('link',
					[
						'validation' => function()
						{
							return[
								new LengthValidator(null, 255),
							];
						},
					]
				))->configureTitle(Loc::getMessage('PROGRAMS_ENTITY_LINK_FIELD'))
						->configureRequired(true)
			,
			'certificate_type' => (new StringField('certificate_type',
					[
						'validation' => function()
						{
							return[
								new LengthValidator(null, 30),
							];
						},
					]
				))->configureTitle(Loc::getMessage('PROGRAMS_ENTITY_CERTIFICATE_TYPE_FIELD'))
						->configureRequired(true)
			,
			'certification_level' => (new StringField('certification_level',
					[
						'validation' => function()
						{
							return[
								new LengthValidator(null, 30),
							];
						},
					]
				))->configureTitle(Loc::getMessage('PROGRAMS_ENTITY_CERTIFICATION_LEVEL_FIELD'))
						->configureRequired(true)
			,
			'date_start' => (new DateField('date_start',
					[]
				))->configureTitle(Loc::getMessage('PROGRAMS_ENTITY_DATE_START_FIELD'))
						->configureRequired(true)
			,
			'date_revision' => (new DateField('date_revision',
					[]
				))->configureTitle(Loc::getMessage('PROGRAMS_ENTITY_DATE_REVISION_FIELD'))
						->configureRequired(true)
			,
			'skills_list' => (new StringField('skills_list',
					[
						'validation' => function()
						{
							return[
								new LengthValidator(null, 255),
							];
						},
					]
				))->configureTitle(Loc::getMessage('PROGRAMS_ENTITY_SKILLS_LIST_FIELD'))
			,
		];
	}
}