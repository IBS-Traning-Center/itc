<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Luxoft\Dev\Table\CertificatesTable;

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
