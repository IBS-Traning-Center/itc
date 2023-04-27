<?
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

exportUsers();
/*try {
    $result = $client->SaveUser(array("email"=> "testtest@test.ru", "firstName"=> "TestFirstName", "lastName"=> "TestLastName", "companyName"=> "TestCompanyName"));
    var_dump($result);
 }catch (SOAPFault $f) {
        echo $f->getMessage();
 }*/
 /*CModule::IncludeModule("iblock");
	//$client = new SoapClient("https://sfintegration.luxoft.com/LuxTrainingUserReceive/Service.svc?wsdl", array('login'          => "webuser",
    //                                        'password'       => "Xd@ibz1oVO", 'trace' => 1, 'exceptions'  => 1));
	$filter = Array("DATE_REGISTER_1" => date("d.m.Y", strtotime("-1 day"))." 00:00:00", "DATE_REGISTER_2" => date("d.m.Y", strtotime("-1 day"))." 23:59:59"); 
	$rsUsers = CUser::GetList(($by="LAST_NAME"), ($order="asc"), $filter); 
	$arSend=array();
	while($arUser=$rsUsers->Fetch())  {
		//print_r($arUser);
		
		if (strlen($arUser["NAME"])>0 &&  strlen($arUser["LAST_NAME"])>0 && strlen($arUser["EMAIL"])>0 && strlen($arUser["WORK_COMPANY"])>0) {
			$arSend[]=array("email"=> htmlspecialchars_decode($arUser["EMAIL"]), "firstName"=> iconv("cp1251", "UTF-8", htmlspecialchars_decode($arUser["NAME"])), "lastName"=> iconv("cp1251", "UTF-8", htmlspecialchars_decode($arUser["LAST_NAME"])), "companyName"=> iconv("cp1251", "UTF-8", htmlspecialchars_decode($arUser["WORK_COMPANY"])));
			$arSendEmail[]=array("email"=> htmlspecialchars_decode($arUser["EMAIL"]), "firstName"=> htmlspecialchars_decode($arUser["NAME"]), "lastName"=> htmlspecialchars_decode($arUser["LAST_NAME"]), "companyName"=> htmlspecialchars_decode($arUser["WORK_COMPANY"]));
		}
	}
	
	foreach ($arSend as $send) {
		//$result = $client->SaveUser($send);
	}

	$string_send="<table cellpadding='5' style='border: 1px solid #ccc; border-collapse: collapse;'>";
		foreach ($arSendEmail as $send) {
			$string_send.="<tr><td style='border: 1px solid #ccc;'>{$send['email']}</td><td style='border: 1px solid #ccc'>{$send['lastName']} {$send['firstName']}</td><td style='border: 1px solid #ccc'>{$send['companyName']}</td></tr>";
		}
	$string_send.="</table>";
	print_r($arSendEmail);
	$arEventFields=array("TABLE"=> $string_send);
	CEvent::Send("ADDED_TO_LMS", SITE_ID, $arEventFields);
*/
//print_r($client->SaveUser($user1));



										?>