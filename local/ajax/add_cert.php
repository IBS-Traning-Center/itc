<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $formAnswer;

use Bitrix\Main\Type\DateTime;
use Luxoft\Dev\Table\CertificatesTable;
use Luxoft\Dev\Table\HhUsersTable;
use Luxoft\Dev\Table\VerifiedProgramsTable;

define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/local/logs/hh_integration/add_cert.txt");

$formAnswer = ['message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST as &$postValue)  {
        $postValue = htmlspecialchars($postValue);
    }

    $key = $_POST['KEY'] ?? NULL;
    if ($key) {
        $connection = Bitrix\Main\Application::getConnection();
        $sqlHelper = $connection->getSqlHelper();
        $key = $sqlHelper->forSql($key);

        $sql = "SELECT `permission` FROM `keys` WHERE `key` = '" . $key . "'";
        $recordset = $connection->query($sql);
        if ($record = $recordset->fetch()) {
            $permission = 'Запись';
            if ($permission === $record['permission']) {
                $message = [];
                if (isset($_FILES)) {
                    foreach ($_FILES as $item) {
                        if ($item["error"] == UPLOAD_ERR_OK) {
                            if (!empty($item["name"]) && $item["name"] != '') {
                                if ($item["type"] == "application/pdf") {
                                    $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . "/cert";
                                    $tmp_name = $item["tmp_name"];
                                    $name = basename($item["name"]);
                                    $success = move_uploaded_file($tmp_name, "$uploads_dir/$name");
                                    if ($success) {
                                        $message[] = "Файл " . $item["name"] . " успешно загружен";
                                    } else {
                                        $message[] = "Ошибка при перемещении файла " . $item["name"] . " в каталог загрузки";
                                    }
                                } else {
                                    $message[] = "Ошибка! Файл " . $item["name"] . " имеет не верный формат";
                                }
                            } else {
                                $message[] = "Ошибка! Файл " . $item["name"] . " имеет не верное название";
                            }
                        } else {
                            $message[] = "Ошибка! Файл " . $item["name"] . " не загружен. " . $item["error"];
                        }
                    }
                } 
                if (isset($_POST)) {
                    $surname = $_POST['SURNAME'] ?? NULL;
                    $name = $_POST['NAME'] ?? NULL;
                    $patronymic = $_POST['PATRONYMIC'] ?? NULL;
                    $mail = $_POST['MAIL'] ?? NULL;
                    $certificate_number = $_POST['NUMBER'] ?? NULL;
                    $certificate_type = $_POST['TYPE'] ?? NULL;
                    $certification_level = $_POST['LEVEL'] ?? NULL;
                    $date_from = $_POST['DATE_FROM'] ?? NULL;
                    $date_to = $_POST['DATE_TO'] ?? NULL;
                    $link = $_POST['LINK'] ?? NULL;
                    $user_id = NULL;

                    if ($surname && $name && $mail && $certificate_number && $certificate_type && $certification_level && $date_from) {
                        $surname = $sqlHelper->forSql($surname);
                        $name = $sqlHelper->forSql($name);
                        $patronymic = $sqlHelper->forSql($patronymic);
                        $mail = $sqlHelper->forSql($mail);
                        $certificate_number = $sqlHelper->forSql($certificate_number);
                        $certificate_type = $sqlHelper->forSql($certificate_type);
                        $certification_level = $sqlHelper->forSql($certification_level);
                        $date_from = $sqlHelper->forSql($date_from);
                        $date_to = $sqlHelper->forSql($date_to);
                        $link = $sqlHelper->forSql($link);

                        $hh_user_id = NULL;

                        if ('' != $date_from) {
                            $date_from = new DateTime($date_from, 'd.m.Y');
                        }
                        if ('' != $date_to) {
                            $date_to = new DateTime($date_to, 'd.m.Y');
                        }

                        $sql = "SELECT ID FROM b_user WHERE (EMAIL = '" . $mail . "') OR (NAME = '" . $name . "' AND LAST_NAME = '" . $surname . "' AND SECOND_NAME = '" . $patronymic . "')";
                        $recordset = $connection->query($sql);
                        if ($record = $recordset->fetch()) {
                            $user_id = $sqlHelper->forSql($record['ID']);

                            $user = HhUsersTable::getList([
                                'select' => [
                                    'user_id',
                                    'hh_user_id'
                                ],
                                'filter' => [
                                    'user_id' => $user_id
                                ],
                            ])->fetch();

                            if ($user) {
                                $hh_user_id = $user['hh_user_id'];
                            }
                        }

                        $result = CertificatesTable::add(
                            array(
                                'surname' => $surname,
                                'name' => $name,
                                'patronymic' => $patronymic,
                                'mail' => $mail,
                                'certificate_number' => $certificate_number,
                                'certificate_type' => $certificate_type,
                                'certification_level' => $certification_level,
                                'date_from' => $date_from,
                                'date_to' => $date_to,
                                'link' => $link,
                                'user_id' => $user_id,
                            )
                        );
			if (!$result->isSuccess())
			{
                            AddMessage2Log($result->getErrorMessages(), "add cert");
                            $message[] = 'Ошибка при добавлении сертификата ' . $certificate_number . ' в таблицу';
			} else {
                            $message[] = 'Сертификат ' . $certificate_number . ' успешно сохранен';
                            $certificate_id = $result->getId();
                            if ($hh_user_id) {
                                $program = VerifiedProgramsTable::getList([
                                    'filter' => [
                                        'certificate_type' => $certificate_type,
                                        'certification_level' => $certification_level
                                    ],
                                    'select' => [
                                        'program_id'
                                    ]
                                ])->fetch();
                                if ($program) {
                                    $program_id = $program['program_id'];
                                    $provider_id = '10057ab8-3eb2-4a75-a1a4-7a01e2e9cc3e';
                                    $link = "https://ibs-training.ru/cert/" . $link;
                                    $date_from = new DateTime($date_from, 'd.m.Y');

                                    $access_token_app = 'APPLNI9MJ65CPPA0NTI4F0PLGJQ9A13C38FOVPEGQD91UOSQ99RE0JCKNT6UMK36';
                                    $name = 'Authorization';
                                    $value = 'Bearer ' . $access_token_app;
                                    $httpClient->setHeader($name, $value, true);

                                    $postData = [
                                        'certification_provider_id' => $provider_id,
                                        'ceritification_program_id' => $program_id,
                                        'ceritificate_link' => $link,
                                        'certificate_id' => $certificate_number,
                                        'issued_at' => $date_from->format('Y-m-d\TH:i:sP'),
                                        'user_id' => $hh_user_id,
                                    ];

                                    if ('' != $date_to) {
                                        $date_to = new DateTime($date_to, 'd.m.Y');
                                        $postData['expires_at'] = $date_to->format('Y-m-d\TH:i:sP');
                                    }

                                    $url = 'https://api.hh.ru/external_certificates';
                                    $result = $httpClient->post($url, $postData);
                                    if ($result) {
                                        AddMessage2Log($result, "add cert - result");
                                        $id = ['id' => $certificate_id, 'certificate_number' => $certificate_number];
                                        $result = CertificatesTable::update($id, array(
                                            'sent_to_hh' => TRUE
                                        ));
                                    }
                                }
                            }
			}
                    } else {
                        $message[] = 'Ошибка! Сертификат ' . $certificate_number . ' имеет неверные данные';
                    }
                }
                $formAnswer['message'] = $message;
            } else {
                $formAnswer['type'] = 'error';
                $formAnswer['message'] = 'Недостаточно прав';
            }
        } else {
            $formAnswer['type'] = 'error';
            $formAnswer['message'] = 'Неверный ключ';
        }
    } else {
        $formAnswer['type'] = 'error';
        $formAnswer['message'] = 'Неверный ключ';
    }
}
echo \Bitrix\Main\Web\Json::encode($formAnswer);