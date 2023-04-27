<?
$aResult = array();
if( !isset($aResult['error']) ) {

    switch($_POST['functionname']) {
        case 'sendMail':
            $aResult['result'] = sendMail();
            break;

        default:
            $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
            break;
    }

}

echo json_encode($aResult);

function sendMail(){
    return true;
}
?>