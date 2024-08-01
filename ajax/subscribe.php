<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
GLOBAL $APPLICATION;
$APPLICATION->RestartBuffer();
CModule::IncludeModule("subscribe");
if($_REQUEST["sf_EMAIL"]) {
    $EMAIL = $_REQUEST["sf_EMAIL"];
    if ($USER->IsAuthorized()){
        global $USER;
       $USER = $USER->GetID() ;
    }
    else {
       $USER = NULL ;
    }
	if (intval($_POST['RUB_ID'])>0) {
		$RUB_ID = array($_POST['RUB_ID']);
    } else {
		 $RUB_ID = array("3", "31");
	}
   
    $subscr = new CSubscription;
    $arFields = Array(
        "USER_ID" => $USER,
        "FORMAT" => "html/text",
        "EMAIL" => $EMAIL,
        "ACTIVE" => "Y",
		"CONFIRMED" => "Y",
        "RUB_ID" => $RUB_ID,
        "SEND_CONFIRM" => "N"
    );
    $idsubrscr = $subscr->Add($arFields);

    if($idsubrscr) {
      $popuptitle = array("success"=>'Y');
	  $arSend["EMAIL"]=$EMAIL;
	  $arSend["MAIL_ID"] = $idsubrscr;
	  $arSend["MAIL_MD5"] = MyClass::GetMailHash($EMAIL);
	  CEvent::Send('MAIN_SUBSCRIBE', SITE_ID, $arSend, 'N', 142);
    } else {
      $popuptitle = array("success"=>'N');
    }
	echo json_encode($popuptitle);
	
    /* если ajax не подключен */
    /*if ($_POST["action"] != "ajax") {
       header('Location: '.$_SERVER['HTTP_REFERER']);
    }*/
}