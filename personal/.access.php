<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

if (!$USER->IsAuthorized()) {
    LocalRedirect('/auth/');
    exit();
}
?>