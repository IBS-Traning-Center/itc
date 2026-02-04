<?php
declare(strict_types=1);

namespace Luxoft\Dev\Table;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Event;
use Bitrix\Main\ORM\Fields\DateField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;
use Bitrix\Main\Type\DateTime;
use Luxoft\Dev\Table\CertificatesTable;
use Luxoft\Dev\Table\HhUsersTable;

define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/local/logs/hh_integration/program.txt");

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

	public static function onAfterAdd(Event $event)
	{
		$fields = $event->getParameter("fields");
		$program_id = $fields["program_id"];
		$type = $fields["certificate_type"];
		$level = $fields["certification_level"];

		$certificates = CertificatesTable::getList([
			'filter' => [
				'certificate_type' => $type,
				'certification_level' => $level,
				'sent_to_hh' => FALSE,
				'program_verified' => FALSE
			],
			'select' => [
				'id',
				'date_from',
				'date_to',
				'certificate_number',
				'link',
				'user_id'
			]
    		])->fetchAll();

		if ($certificates) {
			$provider_id = '10057ab8-3eb2-4a75-a1a4-7a01e2e9cc3e';
			$client_id = 'VLEAK7BKIEFJ9FAEU9M3QQ5BTN2JUH4PT3CQM86VU2NOIHDHH5LAQ6UNJKI375IM';

			$httpClient = new \Bitrix\Main\Web\HttpClient();

			$name = 'Authorization';
			$access_token_app = 'APPLNI9MJ65CPPA0NTI4F0PLGJQ9A13C38FOVPEGQD91UOSQ99RE0JCKNT6UMK36';
			$value = 'Bearer ' . $access_token_app;
			$httpClient->setHeader($name, $value, true);

			$name = 'HH-User-Agent';
			$value = 'ExternalCertificates/1.0 (education@ibs.ru)';
			$httpClient->setHeader($name, $value, true);

			$name = 'Content-type';
			$value = 'application/x-www-form-urlencoded';
			$httpClient->setHeader($name, $value, true);
		
			foreach ($certificates as $certificate) {
				if ($certificate['user_id']) {
					$user = HhUsersTable::getList([
						'select' => [
							'user_id',
							'hh_user_id'
						],
						'filter' => [
							'user_id' => $certificate['user_id']
						],
					])->fetch();

					if ($user) {
						AddMessage2Log($user, "program - user");
						$link = "https://ibs-training.ru/cert/" . $certificate['link'];
						$date_from = new DateTime($certificate['date_from'], 'd.m.Y');

						$postData = [
							'client_id' => $client_id,
							'user_id' => $user['hh_user_id'],
							'provider_id' => $provider_id,
							'program_id' => $program_id,
							'certificate_id' => $certificate['certificate_number'],
							'certificate_link' => $link,
							'issued_at' => $date_from->format('Y-m-d\TH:i:sP')
						];

						if ('' != $certificate['date_to']) {
							$date_to = new DateTime($certificate['date_to'], 'd.m.Y');
							$postData['expires_at'] = $date_to->format('Y-m-d\TH:i:sP');
						}

						$data = json_encode($postData);

						$url = 'https://api.hh.ru/external_certificates';
						$response = $httpClient->post($url, $data);
						if ($response) {
							$id = ['id' => $certificate['id'], 'certificate_number' => $certificate['certificate_number']];
							$result = CertificatesTable::update($id, array(
								'sent_to_hh' => TRUE,
								'program_verified' => TRUE
							));

							if (!$result->isSuccess())
							{
								AddMessage2Log($result->getErrorMessages(), "program - cert update");
							}
						}
					}
				} else {
					$id = ['id' => $certificate['id'], 'certificate_number' => $certificate['certificate_number']];
					$result = CertificatesTable::update($id, array(
						'program_verified' => TRUE
					));

					if (!$result->isSuccess())
					{
						AddMessage2Log($result->getErrorMessages(), "program - cert update");
					}
				}
			}
		}
	}
}