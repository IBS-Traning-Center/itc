<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $formAnswer;
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

                        $sql = "SELECT ID FROM b_user WHERE (EMAIL = '" . $mail . "') OR (NAME = '" . $name . "' AND LAST_NAME = '" . $surname . "' AND SECOND_NAME = '" . $patronymic . "')";
                        $recordset = $connection->query($sql);
                        if ($record = $recordset->fetch()) {
                            $user_id = $sqlHelper->forSql($record['ID']);
                        }

                        $sql = "INSERT certificates (surname, name, patronymic, mail, certificate_number, certificate_type, certification_level, date_from, date_to, link, user_id) 
                        VALUES ('" . $surname . "', '" . $name . "', '" . $patronymic . "', '" . $mail . "', '" . $certificate_number . "', '" . $certificate_type . "', '" . $certification_level . "', '" . $date_from . "', '" . $date_to . "', '" . $link . "', '" . $user_id . "')";
                        $recordset = $connection->query($sql);
                        if ($record = $recordset->fetch()) {
                            $message[] = 'Сертификат ' . $certificate_number . ' успешно сохранен';
                        } else {
                            $message[] = 'Ошибка при добавлении сертификата ' . $certificate_number . ' в таблицу';
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