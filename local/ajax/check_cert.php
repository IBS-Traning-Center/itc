<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Luxoft\Dev\Table\CertificatesTable;

global $formAnswer;
$formAnswer = ['type' => 'error', 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST as &$postValue)  {
        $postValue = htmlspecialchars($postValue);
    }

    $key = $_POST['KEY'] ?? NULL;
    if ($key) {
        $connection = Bitrix\Main\Application::getConnection();
        $sqlHelper = $connection->getSqlHelper();
        $key = $sqlHelper->forSql($key);

        $sql = "SELECT `id` FROM `keys` WHERE `key` = '" . $key . "'";
        $recordset = $connection->query($sql);
        if ($record = $recordset->fetch()) {
            $surname = $_POST['SURNAME'] ?? NULL;
            $number = $_POST['NUMBER'] ?? NULL;

            if ($surname && $number) {
                $certificate = CertificatesTable::getList([
                    'filter' => [
                        'certificate_number' => $number,
                        'surname' => $surname
                    ],
                    'select' => [
                        'date_to'
                    ]
                ])->fetch();

                if ($certificate) {
                    $today = date('d.m.Y');
                    if ((strtotime($today) <= strtotime($certificate['date_to'])) || ('' == $certificate['date_to'])) {
                        $formAnswer['type'] = 'ok';
                        $formAnswer['message'] = 'Сертификат ' . $number . ' действителен';
                    } else {
                        $formAnswer['type'] = 'ok';
                        $formAnswer['message'] = 'Сертификат ' . $number . ' не действителен';
                    }
                } else {
                    $formAnswer['type'] = 'error';
                    $formAnswer['message'] = 'Сертификат ' . $number . ' не найден'; //Сертификат не найден
                }
            } else {
                $formAnswer['type'] = 'error';
                $formAnswer['message'] = 'Неверные данные 1';
            }
        } else {
            $formAnswer['type'] = 'error';
            $formAnswer['message'] = 'Неверные данные';
        }
    } else {
        $formAnswer['type'] = 'error';
        $formAnswer['message'] = 'Неверный ключ';
    }
} else {
        $formAnswer['type'] = 'error';
        $formAnswer['message'] = 'Неверный запрос';
}
echo \Bitrix\Main\Web\Json::encode($formAnswer);