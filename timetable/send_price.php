<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$aResult = array();

if( !isset($aResult['error']) ) {
    print_r($_POST);
    switch($_POST['functionname']) {
        case 'sendMail':
            $aResult['result'] = sendMail($_POST['arguments'][0], $_POST['arguments'][1], $_POST['arguments'][2]);
            break;

        default:
            $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
            break;
    }

}

echo json_encode($aResult);

function sendMail($urlPart, $name, $email) {
    $fileName = explode("?", $urlPart);
    try {
        $arEventFields = array(
            "EMAIL_TO"     => $email,
            "NAME"         => $name,
            "FILE_NAME"    => $fileName[0],
        );
        $files =  array("https://www.luxoft-training.ru/files/$fileName[0]");
        print_r($arEventFields);
        //CEvent::Send("SEND_PRICE", SITE_ID, $arEventFields, "Y", 207, $files);
        return true;
    }
    catch (\Exception $e) {
        return $e->getMessage();
    }
}

?>