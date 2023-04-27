<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    session_start();
    switch ($_POST['action']) {
        case 'notice':
            $_SESSION["SHOWN_NOTICE"] = htmlspecialchars($_POST['value']);
            break;
    }
}
