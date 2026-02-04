<?php
namespace Luxoft\Dev\Table;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Event;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;
use Bitrix\Main\Type\DateTime;
use Luxoft\Dev\Table\CertificatesTable;
use Luxoft\Dev\Table\VerifiedProgramTable;

define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/local/logs/hh_integration/users.txt");

/**
 * Class UsersTable
 * 
 * Fields:
 * <ul>
 * <li> id int mandatory
 * <li> user_id int mandatory
 * <li> hh_user_id string(255) mandatory
 * </ul>
 *
 * @package Bitrix\Users
 **/

class HhUsersTable extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'hh_users';
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
				))->configureTitle(Loc::getMessage('USERS_ENTITY_ID_FIELD'))
						->configurePrimary(true)
						->configureAutocomplete(true)
			,
			'user_id' => (new IntegerField('user_id',
					[]
				))->configureTitle(Loc::getMessage('USERS_ENTITY_USER_ID_FIELD'))
						->configurePrimary(true)
			,
			'hh_user_id' => (new StringField('hh_user_id',
					[
						'validation' => function()
						{
							return[
								new LengthValidator(null, 255),
							];
						},
					]
				))->configureTitle(Loc::getMessage('USERS_ENTITY_HH_USER_ID_FIELD'))
						->configurePrimary(true)
			,
		];
	}

	public static function onAfterAdd(Event $event)
	{
		$fields = $event->getParameter("fields");
		$user_id = $fields["user_id"];
		$hh_user_id = $fields["hh_user_id"];

		$certificates = CertificatesTable::getList([
			'filter' => [
                'user_id' => $user_id,
				'program_verified' => TRUE
        	],
        	'select' => [
                'id',
        		'date_from',
				'date_to',
            	'certificate_number',
				'certificate_type',
				'certification_level',
                'link',
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
				$program = VerifiedProgramTable::getList([
                    'filter' => [
                        'certificate_type' => $certificate['certificate_type'],
                        'certification_level' => $certificate['certification_level']
                    ],
                    'select' => [
                        'program_id'
                    ]
                ])->fetch();

				if ($program) {
					$program_id = $program['program_id'];
					$link = "https://ibs-training.ru/cert/" . $certificate['link'];
					$date_from = new DateTime($certificate['date_from'], 'd.m.Y');

					$postData = [
						'client_id' => $client_id,
						'user_id' => $hh_user_id,
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
							'sent_to_hh' => TRUE
						));

						if (!$result->isSuccess())
						{
							AddMessage2Log($result->getErrorMessages(), "user - cert update");
						}
					}
				}
			}
		}
	}
}