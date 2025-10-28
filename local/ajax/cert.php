<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER; global $formAnswer;
$formAnswer = ['type' => 'error', 'message' => ''];

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if($_POST['addField'] !== '' && check_bitrix_sessid()) {
        $formAnswer = [
            'type' => 'error_1',
            'message' => 'addField'
        ];
    } else {
        foreach ($_POST as &$postValue)  {
            $postValue = htmlspecialchars($postValue);
        }

        $surname = $_POST['SURNAME'] ?? NULL;
        $number = $_POST['NUMBER'] ?? NULL;

        if ($surname && $number) {
            $connection = Bitrix\Main\Application::getConnection();
            $sqlHelper = $connection->getSqlHelper();

            $surname = $sqlHelper->forSql($surname);
            $number = $sqlHelper->forSql($number);

            $today = date('d.m.Y');
            $sql = "SELECT date_to FROM certificates WHERE certificate_number = '" . $number . "' AND surname = '" . $surname . "'";
            $recordset = $connection->query($sql);
            if ($record = $recordset->fetch())
            {
                if ((strtotime($today) <= strtotime($record['date_to'])) || ('' == $record['date_to'])) {
                    $formAnswer['type'] = 'active'; //Сертификат действителен
                } else {
                    $formAnswer['type'] = 'inactive'; //Сертификат не действителен
                }
            } else {
                $formAnswer['type'] = 'unidentified'; //Сертификат не найден
            }
        }
    }
}

echo \Bitrix\Main\Web\Json::encode($formAnswer);
