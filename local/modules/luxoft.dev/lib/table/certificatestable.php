<?php
namespace Luxoft\Dev\Table;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\DateField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;

/**
 * Class CertificatesTable
 * 
 * Fields:
 * <ul>
 * <li> id int mandatory
 * <li> surname string(255) mandatory
 * <li> name string(255) mandatory
 * <li> patronymic string(255) optional
 * <li> certificate_number string(10) mandatory
 * <li> certificate_type string(30) mandatory
 * <li> certification_level string(30) mandatory
 * <li> date_from date mandatory
 * <li> link string(255) optional
 * <li> mail string(50) mandatory
 * <li> user_id string(50) optional
 * <li> date_to date optional
 * <li> snils string(14) optional
 * <li> sent_to_hh int optional default 0
 * <li> program_verified int optional default 0
 * </ul>
 *
 * @package Bitrix\
 **/

class CertificatesTable extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'certificates';
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
				))->configureTitle(Loc::getMessage('_ENTITY_ID_FIELD'))
						->configurePrimary(true)
						->configureAutocomplete(true)
			,
			'surname' => (new StringField('surname',
					[
						'validation' => function()
						{
							return[
								new LengthValidator(null, 255),
							];
						},
					]
				))->configureTitle(Loc::getMessage('_ENTITY_SURNAME_FIELD'))
						->configureRequired(true)
			,
			'name' => (new StringField('name',
					[
						'validation' => function()
						{
							return[
								new LengthValidator(null, 255),
							];
						},
					]
				))->configureTitle(Loc::getMessage('_ENTITY_NAME_FIELD'))
						->configureRequired(true)
			,
			'patronymic' => (new StringField('patronymic',
					[
						'validation' => function()
						{
							return[
								new LengthValidator(null, 255),
							];
						},
					]
				))->configureTitle(Loc::getMessage('_ENTITY_PATRONYMIC_FIELD'))
			,
			'certificate_number' => (new StringField('certificate_number',
					[
						'validation' => function()
						{
							return[
								new LengthValidator(null, 10),
							];
						},
					]
				))->configureTitle(Loc::getMessage('_ENTITY_CERTIFICATE_NUMBER_FIELD'))
						->configurePrimary(true)
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
				))->configureTitle(Loc::getMessage('_ENTITY_CERTIFICATE_TYPE_FIELD'))
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
				))->configureTitle(Loc::getMessage('_ENTITY_CERTIFICATION_LEVEL_FIELD'))
						->configureRequired(true)
			,
			'date_from' => (new DateField('date_from',
					[]
				))->configureTitle(Loc::getMessage('_ENTITY_DATE_FROM_FIELD'))
						->configureRequired(true)
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
				))->configureTitle(Loc::getMessage('_ENTITY_LINK_FIELD'))
			,
			'mail' => (new StringField('mail',
					[
						'validation' => function()
						{
							return[
								new LengthValidator(null, 50),
							];
						},
					]
				))->configureTitle(Loc::getMessage('_ENTITY_MAIL_FIELD'))
						->configureRequired(true)
			,
			'user_id' => (new StringField('user_id',
					[
						'validation' => function()
						{
							return[
								new LengthValidator(null, 50),
							];
						},
					]
				))->configureTitle(Loc::getMessage('_ENTITY_USER_ID_FIELD'))
			,
			'date_to' => (new DateField('date_to',
					[]
				))->configureTitle(Loc::getMessage('_ENTITY_DATE_TO_FIELD'))
			,
			'snils' => (new StringField('snils',
					[
						'validation' => function()
						{
							return[
								new LengthValidator(null, 14),
							];
						},
					]
				))->configureTitle(Loc::getMessage('_ENTITY_SNILS_FIELD'))
			,
			'sent_to_hh' => (new IntegerField('sent_to_hh',
					[]
				))->configureTitle(Loc::getMessage('_ENTITY_SENT_TO_HH_FIELD'))
						->configureDefaultValue(0)
						->configureSize(1)
			,
			'program_verified' => (new IntegerField('program_verified',
					[]
				))->configureTitle(Loc::getMessage('_ENTITY_PROGRAM_VERIFIED_FIELD'))
						->configureDefaultValue(0)
						->configureSize(1)
			,
		];
	}
}