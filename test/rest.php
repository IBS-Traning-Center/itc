<?
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("rest");
?>
<?
	echo "<pre>";
	//trainerCOM();
	CModule::IncludeModule("iblock");
	$data  = date("d.m.Y H:", strtotime("-60 hour"))."00:00";
	/*$arSelect = Array("ID", "NAME", "DATE_CREATE", "CODE", "NAME", "ACTIVE", "PROPERTY_timetable_id", "PROPERTY_COMMENT", "PROPERTY_lastname", "PROPERTY_CAT_COURSE", "PROPERTY_firstname", "PROPERTY_middlename", "PROPERTY_email", "PROPERTY_city", "PROPERTY_telephone", "PROPERTY_company");
	$arFilter = Array("IBLOCK_ID"=> 64, ">DATE_CREATE"=> $data."00:00");
	$res = CIBlockElement::GetList(Array("DATE_CREATE"=>"DESC"), $arFilter, false, Array("nPageSize"=>100), $arSelect);
	while($ob = $res->GetNextElement())
	{
			$arFields = $ob->GetFields();
			leedsRU($arFields["ID"]);
	}*/
	CModule::IncludeModule("form");
	$arsFilter["DATE_CREATE_1"]=$data;
	$rsResults = CFormResult::GetList(11, 
    ($by="s_timestamp"), 
    ($order="desc"), 
    $arsFilter, 
    $is_filtered, 
    "N", 
		100);
	while ($arResult = $rsResults->Fetch())
	{
		
		leedsCOM($arResult["ID"]);
	}
	//leedsRU(76823);
	/*$login = 'ashkavro@luxoft.com.dev';
	$password = 'roccotrue1';
	$token = "RAJp0CBFwZumShn46UYmp2YK";
	$client->__setLocation("https://luxoft--dev.cs85.my.salesforce.com/services/Soap/c/37.0/");
	$client = new SoapClient("dev_wsdl.wsdl");
	*/
/*
const SOAP_NAMESPACE = 'urn:enterprise.soap.sforce.com';
function coursesCOM($ID) {
	CModule::IncludeModule("iblock");
	$login = 'ashkavro@luxoft.com.preprod';
	$password = 'roccotrue1';
	$token = "IgJsJTjKjHTVm6dWBfpNjtYae";
	$client = new SoapClient("preprod_wsdl_1.wsdl");
	$client->__setLocation("https://luxoft--preprod.cs86.my.salesforce.com/services/Soap/c/37.0/");
	$result=$client->login(array("username"=>$login, "password"=>$password.$token));
	$sessionId=(string)$result->result->sessionId;
	$serverUrl=(string)$result->result->serverUrl;
	$client2= new SoapClient("preprod_wsdl_1.wsdl");
	$header=new \SoapHeader(
				SOAP_NAMESPACE,
				'SessionHeader',
				array(
					'sessionId' => $sessionId
				)
			);
	$client2->__setSoapHeaders($header); 
	$client2->__setLocation($serverUrl);
	$arSelect = Array("ID", "NAME", "CODE", "NAME", "ACTIVE", "PROPERTY_COURSE_DURATION", "PROPERTY_META_DESCR", "PROPERTY_CRM_CATEGORY");
	$arFilter = Array("IBLOCK_ID"=> 97);
	if (intval($ID)>0) {
		$arFilter["ID"]=$ID;
	}
	$res = CIBlockElement::GetList(Array("DATE_CREATE"=>"DESC"), $arFilter, false, Array("nPageSize"=>200), $arSelect);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		$arCourse=array();
		$arCourse["Bitrix_Id__c"]=$arFields["ID"];
		$arCourse["Name"]=UTF($arFields["CODE"]);
		$arCourse["Name__c"]=UTF(htmlspecialchars_decode($arFields["NAME"]));
		$arCourse["Specialization__c"]=UTF($arFields["PROPERTY_CRM_CATEGORY_VALUE"]);
		if ($arFields["ACTIVE"]=="Y") {
			$arCourse["Active__c"]="true";
		} else {
			$arCourse["Active__c"]="false";
		}
		$arCourse["Duration__c"]=$arFields["PROPERTY_COURSE_DURATION_VALUE"];
		$arCourse["Description__c"]=UTF(htmlspecialchars_decode($arFields["PROPERTY_META_DESCR_VALUE"]));
		$arCourse["Bitrix_Source__c"]="RO/PL/COM";
		
		$arRequest[]=$arCourse;
	}
	$Object=createSoapVars($arRequest, "Training__c");
	$result=$client2->upsert(array("externalIDFieldName"=> "Bitrix_Id__c", 'sObjects'=> $Object));
}
function trainerCOM($ID) {
	CModule::IncludeModule("iblock");
	$login = 'ashkavro@luxoft.com.preprod';
	$password = 'roccotrue1';
	$token = "IgJsJTjKjHTVm6dWBfpNjtYae";
	$client = new SoapClient("preprod_wsdl_1.wsdl");
	$client->__setLocation("https://luxoft--preprod.cs86.my.salesforce.com/services/Soap/c/37.0/");
	$result=$client->login(array("username"=>$login, "password"=>$password.$token));
	$sessionId=(string)$result->result->sessionId;
	$serverUrl=(string)$result->result->serverUrl;
	$client2= new SoapClient("preprod_wsdl_1.wsdl");
	$header=new \SoapHeader(
				SOAP_NAMESPACE,
				'SessionHeader',
				array(
					'sessionId' => $sessionId
				)
			);
	$client2->__setSoapHeaders($header); 
	$client2->__setLocation($serverUrl);
	$arSelect = Array("ID", "NAME", "CODE", "NAME", "ACTIVE", "PROPERTY_SHORT_NAME", "PROPERTY_SHORT_DESC");
	$arFilter = Array("IBLOCK_ID"=> 98);
	if (intval($ID)>0) {
		$arFilter["ID"]=$ID;
	}
	$res = CIBlockElement::GetList(Array("DATE_CREATE"=>"DESC"), $arFilter, false, Array("nPageSize"=>200, "iNumPage"=> 1), $arSelect);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		$arCourse=array();
		$arCourse["Bitrix_Id__c"]=$arFields["ID"];
		$arCourse["First_Name__c"]=UTF($arFields["NAME"]);
		$arCourse["Last_Name__c"]=UTF($arFields["PROPERTY_SHORT_NAME_VALUE"]);
		$arCourse["Description__c"]=UTF($arFields["PROPERTY_SHORT_DESC_VALUE"]);
		if ($arFields["ACTIVE"]=="Y") {
			$arCourse["Active__c"]="true";
		} else {
			$arCourse["Active__c"]="false";
		}
		$arCourse["Bitrix_Source__c"]="RO/PL/COM";
		
		$arRequest[]=$arCourse;
	}
	
	$Object=createSoapVars($arRequest, "Instructor__c");
	$result=$client2->upsert(array("externalIDFieldName"=> "Bitrix_Id__c", 'sObjects'=> $Object));
}
function scheduleCOM($ID) {
	CModule::IncludeModule("iblock");
	$login = 'ashkavro@luxoft.com.preprod';
	$password = 'roccotrue1';
	$token = "IgJsJTjKjHTVm6dWBfpNjtYae";
	$client = new SoapClient("preprod_wsdl_1.wsdl");
	$client->__setLocation("https://luxoft--preprod.cs86.my.salesforce.com/services/Soap/c/37.0/");
	$result=$client->login(array("username"=>$login, "password"=>$password.$token));
	$sessionId=(string)$result->result->sessionId;
	$serverUrl=(string)$result->result->serverUrl;
	$client2= new SoapClient("preprod_wsdl_1.wsdl");
	$header=new \SoapHeader(
				SOAP_NAMESPACE,
				'SessionHeader',
				array(
					'sessionId' => $sessionId
				)
			);
	$client2->__setSoapHeaders($header); 
	$client2->__setLocation($serverUrl);
	$data  = date("Y-m-d");
	$arSelect = Array("ID", "NAME", "CODE", "NAME", "ACTIVE", "PROPERTY_CITY_ID.NAME", "PROPERTY_STARTDATE", "PROPERTY_ENDDATE", "PROPERTY_TRAINER_ID", "PROPERTY_TRAINER_SIMPLE", "PROPERTY_TIME", "PROPERTY_COURSE_ID");
	$arFilter = Array("IBLOCK_ID"=> 99, ">=PROPERTY_STARTDATE" => $data);
	if (intval($ID)>0) {
		$arFilter["ID"]=$ID;
	}
	$res = CIBlockElement::GetList(Array("DATE_CREATE"=>"DESC"), $arFilter, false, Array("nPageSize"=>200, "iNumPage"=> 1), $arSelect);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		
		$arCourse=array();
		$arCourse["Bitrix_Id__c"]=$arFields["ID"];
		$arCourse["Training__r"]=array("Bitrix_Id__c"=>$arFields["PROPERTY_COURSE_ID_VALUE"]);
		if (intval($arFields["PROPERTY_TRAINER_ID_VALUE"])) {
			$arCourse["Instructor__r"]=array("Bitrix_Id__c"=>$arFields["PROPERTY_TRAINER_ID_VALUE"]);
		} else {
			$arCourse["Instructor__c"]=null;
		}
		if (strlen($arFields["PROPERTY_TRAINER_SIMPLE_VALUE"])>0) {
			$arCourse["Instructor_Name_free__c"]=UTF($arFields["PROPERTY_TRAINER_SIMPLE_VALUE"]);
		} else {
			$arCourse["Instructor_Name_free__c"]=null;
		}
		$arCourse["Location__c"]=UTF($arFields["PROPERTY_CITY_ID_NAME"]);
		$arCourse["Start_Date__c"]=date("Y-m-d", strtotime($arFields["PROPERTY_STARTDATE_VALUE"]));
		if (strlen($arFields["PROPERTY_ENDDATE_VALUE"])>0) {
			$arCourse["End_Date__c"]=date("Y-m-d", strtotime($arFields["PROPERTY_ENDDATE_VALUE"]));
		} else {
			$arCourse["End_Date__c"]=null;
		}
		$arCourse["Time__c"]=UTF($arFields["PROPERTY_TIME_VALUE"]);
		if ($arFields["ACTIVE"]=="Y") {
			$arCourse["Active__c"]="true";
		} else {
			$arCourse["Active__c"]="false";
		}
		$arCourse["Bitrix_Source__c"]="RO/PL/COM";
		
		$arRequest[]=$arCourse;
	}
	$Object=createSoapVars($arRequest, "Schedule__c");
	$result=$client2->upsert(array("externalIDFieldName"=> "Bitrix_Id__c", 'sObjects'=> $Object));
}
function leedsCOM($ID) {
	CModule::IncludeModule("iblock");	
	$login = 'ashkavro@luxoft.com.preprod';
	$password = 'roccotrue1';
	$token = "IgJsJTjKjHTVm6dWBfpNjtYae";
	$client = new SoapClient("preprod_wsdl_1.wsdl");
	$client->__setLocation("https://luxoft--preprod.cs86.my.salesforce.com/services/Soap/c/37.0/");
	$result=$client->login(array("username"=>$login, "password"=>$password.$token));
	$sessionId=(string)$result->result->sessionId;
	$serverUrl=(string)$result->result->serverUrl;
	$client2= new SoapClient("preprod_wsdl_1.wsdl");
	$header=new \SoapHeader(
				SOAP_NAMESPACE,
				'SessionHeader',
				array(
					'sessionId' => $sessionId
				)
			);
	$client2->__setSoapHeaders($header); 
	$client2->__setLocation($serverUrl);
	if (intval($ID)==0) {
		$ID=2061;
	}
	if(CModule::IncludeModule("form")) {
	$arAnswer = CFormResult::GetDataByID(
                $ID,
                array(),
                $arResult,
                $arAnswer2);
    }
	
	$arCourse=array();
	$arTraining=array();
	$arTraining["Bitrix_Id__c"]=$ID;
	$arTraining["Lead__r"]=array("Bitrix_Id__c"=>$ID);
	$arTraining["Training__r"]=array("Bitrix_Id__c"=>$arAnswer["ID_ELEMENT"][0]["USER_TEXT"]);
	if (intval($arAnswer["F_SCHEDULE_ID"][0]["USER_TEXT"])>0) {
		$arTraining["Schedule__r"]=array("Bitrix_Id__c"=>$arAnswer["F_SCHEDULE_ID"][0]["USER_TEXT"]);
	} else {
		$arTraining["Schedule__c"]=null;
	}
	$arCourse["Bitrix_Id__c"]=$ID;
	$arCourse["firstName"]=entitytoUTF(($arAnswer["F_NAME"][0]["USER_TEXT"]));
	$arCourse["lastName"]=entitytoUTF($arAnswer["F_LAST_NAME"][0]["USER_TEXT"]);
	$arCourse["company"]=entitytoUTF($arAnswer["F_COMPANY"][0]["USER_TEXT"]);
	$arCourse["email"]=entitytoUTF($arAnswer["F_EMAIL"][0]["USER_TEXT"]);
	$arCourse["phone"]=entitytoUTF($arAnswer["F_TEL"][0]["USER_TEXT"]);
	$arCourse["city"]=entitytoUTF($arAnswer["F_LOCATION"][0]["ANSWER_TEXT"]);
	$arTraining["comment__c"]=entitytoUTF($arAnswer["F_COMMENT"][0]["ANSWER_TEXT"]);
	$arRequest[]=$arCourse;
	$arRequest2[]=$arTraining;
	$Object=createSoapVars($arRequest, "Lead");
	$Object1=createSoapVars($arRequest2, "TrainingItem__c");
	$result=$client2->upsert(array("externalIDFieldName"=> "Bitrix_Id__c", 'sObjects'=> $Object));
	$result=$client2->upsert(array("externalIDFieldName"=> "Bitrix_Id__c", 'sObjects'=> $Object1));
}

function coursesRU($ID) {
	CModule::IncludeModule("iblock");
	$login = 'ashkavro@luxoft.com.preprod';
	$password = 'roccotrue1';
	$token = "IgJsJTjKjHTVm6dWBfpNjtYae";
	$client = new SoapClient("preprod_wsdl_1.wsdl");
	$client->__setLocation("https://luxoft--preprod.cs86.my.salesforce.com/services/Soap/c/37.0/");
	$result=$client->login(array("username"=>$login, "password"=>$password.$token));
	$sessionId=(string)$result->result->sessionId;
	$serverUrl=(string)$result->result->serverUrl;
	$client2= new SoapClient("preprod_wsdl_1.wsdl");
	$header=new \SoapHeader(
				SOAP_NAMESPACE,
				'SessionHeader',
				array(
					'sessionId' => $sessionId
				)
			);
	$client2->__setSoapHeaders($header); 
	$client2->__setLocation($serverUrl);
	$arSelect = Array("ID", "NAME", "CODE", "NAME", "ACTIVE", "PROPERTY_course_duration", "PROPERTY_short_descr", "PROPERTY_CRM_CATEGORY");
	$arFilter = Array("IBLOCK_ID"=> 6);
	if (intval($ID)>0) {
		$arFilter["ID"]=$ID;
	}
	$res = CIBlockElement::GetList(Array("DATE_CREATE"=>"DESC"), $arFilter, false, Array("nPageSize"=>200, "iNumPage"=> 4), $arSelect);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		
		$arCourse=array();
		$arCourse["Bitrix_Id__c"]=$arFields["ID"];
		$arCourse["Name"]=UTF($arFields["CODE"]);
		$arCourse["Name__c"]=UTF($arFields["NAME"]);
		$arCourse["Specialization__c"]=UTF($arFields["PROPERTY_CRM_CATEGORY_VALUE"]);
		if ($arFields["ACTIVE"]=="Y") {
			$arCourse["Active__c"]="true";
		} else {
			$arCourse["Active__c"]="false";
		}
		$arCourse["Duration__c"]=$arFields["PROPERTY_COURSE_DURATION_VALUE"];
		$arCourse["Description__c"]=UTF($arFields["PROPERTY_SHORT_DESCR_VALUE"]);
		$arCourse["Bitrix_Source__c"]="RU";
		
		$arRequest[]=$arCourse;
	}
	$Object=createSoapVars($arRequest, "Training__c");
	$result=$client2->upsert(array("externalIDFieldName"=> "Bitrix_Id__c", 'sObjects'=> $Object));
}

function trainerRU($ID) {
	CModule::IncludeModule("iblock");
	$login = 'ashkavro@luxoft.com.preprod';
	$password = 'roccotrue1';
	$token = "IgJsJTjKjHTVm6dWBfpNjtYae";
	$client = new SoapClient("preprod_wsdl_1.wsdl");
	$client->__setLocation("https://luxoft--preprod.cs86.my.salesforce.com/services/Soap/c/37.0/");
	$result=$client->login(array("username"=>$login, "password"=>$password.$token));
	$sessionId=(string)$result->result->sessionId;
	$serverUrl=(string)$result->result->serverUrl;
	$client2= new SoapClient("preprod_wsdl_1.wsdl");
	$header=new \SoapHeader(
				SOAP_NAMESPACE,
				'SessionHeader',
				array(
					'sessionId' => $sessionId
				)
			);
	$client2->__setSoapHeaders($header); 
	$client2->__setLocation($serverUrl);
	$arSelect = Array("ID", "NAME", "CODE", "NAME", "ACTIVE", "PROPERTY_expert_name", "PROPERTY_expert_short");
	$arFilter = Array("IBLOCK_ID"=> 56);
	if (intval($ID)>0) {
		$arFilter["ID"]=$ID;
	}
	$res = CIBlockElement::GetList(Array("DATE_CREATE"=>"DESC"), $arFilter, false, Array("nPageSize"=>200, "iNumPage"=> 2), $arSelect);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		$arCourse=array();
		$arCourse["Bitrix_Id__c"]=$arFields["ID"];
		$arCourse["First_Name__c"]=UTF($arFields["NAME"]);
		$arCourse["Last_Name__c"]=UTF($arFields["PROPERTY_EXPERT_NAME_VALUE"]);
		$arCourse["Description__c"]=UTF($arFields["PROPERTY_EXPERT_SHORT_VALUE"]);
		if ($arFields["ACTIVE"]=="Y") {
			$arCourse["Active__c"]="true";
		} else {
			$arCourse["Active__c"]="false";
		}
		$arCourse["Bitrix_Source__c"]="RU";
		
		$arRequest[]=$arCourse;
	}
	$Object=createSoapVars($arRequest, "Instructor__c");
	$result=$client2->upsert(array("externalIDFieldName"=> "Bitrix_Id__c", 'sObjects'=> $Object));
}
function scheduleRU($ID) {
	CModule::IncludeModule("iblock");
	$login = 'ashkavro@luxoft.com.preprod';
	$password = 'roccotrue1';
	$token = "IgJsJTjKjHTVm6dWBfpNjtYae";
	$client = new SoapClient("preprod_wsdl_1.wsdl");
	$client->__setLocation("https://luxoft--preprod.cs86.my.salesforce.com/services/Soap/c/37.0/");
	$result=$client->login(array("username"=>$login, "password"=>$password.$token));
	$sessionId=(string)$result->result->sessionId;
	$serverUrl=(string)$result->result->serverUrl;
	$client2= new SoapClient("preprod_wsdl_1.wsdl");
	$header=new \SoapHeader(
				SOAP_NAMESPACE,
				'SessionHeader',
				array(
					'sessionId' => $sessionId
				)
			);
	$client2->__setSoapHeaders($header); 
	$client2->__setLocation($serverUrl);
	$data  = date("Y-m-d");
	$arSelect = Array("ID", "NAME", "CODE", "NAME", "ACTIVE", "PROPERTY_city.NAME", "PROPERTY_startdate", "PROPERTY_enddate", "PROPERTY_teacher", "PROPERTY_string_teacher", "PROPERTY_schedule_time", "PROPERTY_schedule_course");
	$arFilter = Array("IBLOCK_ID"=> 9, ">=PROPERTY_STARTDATE" => $data);
	if (intval($ID)>0) {
		$arFilter["ID"]=$ID;
	}
	$res = CIBlockElement::GetList(Array("DATE_CREATE"=>"DESC"), $arFilter, false, Array("nPageSize"=>200, "iNumPage"=> 1), $arSelect);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		
		$arCourse=array();
		$arCourse["Bitrix_Id__c"]=$arFields["ID"];
		$arCourse["Training__r"]=array("Bitrix_Id__c"=>$arFields["PROPERTY_SCHEDULE_COURSE_VALUE"]);
		if (intval($arFields["PROPERTY_TEACHER_VALUE"])) {
			$arCourse["Instructor__r"]=array("Bitrix_Id__c"=>$arFields["PROPERTY_TEACHER_VALUE"]);
		} else {
			$arCourse["Instructor__c"]=null;
		}
		if (strlen($arFields["PROPERTY_STRING_TEACHER_VALUE"])>0) {
			$arCourse["Instructor_Name_free__c"]=UTF($arFields["PROPERTY_STRING_TEACHER_VALUE"]);
		} else {
			$arCourse["Instructor_Name_free__c"]=null;
		}
		$arCourse["Location__c"]=UTF($arFields["PROPERTY_CITY_NAME"]);
		$arCourse["Start_Date__c"]=date("Y-m-d", strtotime($arFields["PROPERTY_STARTDATE_VALUE"]));
		if (strlen($arFields["PROPERTY_ENDDATE_VALUE"])>0) {
			$arCourse["End_Date__c"]=date("Y-m-d", strtotime($arFields["PROPERTY_ENDDATE_VALUE"]));
		} else {
			$arCourse["End_Date__c"]=null;
		}
		$arCourse["Time__c"]=UTF($arFields["PROPERTY_SCHEDULE_TIME_VALUE"]);
		if ($arFields["ACTIVE"]=="Y") {
			$arCourse["Active__c"]="true";
		} else {
			$arCourse["Active__c"]="false";
		}
		$arCourse["Bitrix_Source__c"]="RU";
		
		$arRequest[]=$arCourse;
	}
	$Object=createSoapVars($arRequest, "Schedule__c");
	$result=$client2->upsert(array("externalIDFieldName"=> "Bitrix_Id__c", 'sObjects'=> $Object));
}
function leedsRU($ID) {
	CModule::IncludeModule("iblock");
	$login = 'ashkavro@luxoft.com.preprod';
	$password = 'roccotrue1';
	$token = "IgJsJTjKjHTVm6dWBfpNjtYae";
	$client = new SoapClient("preprod_wsdl_1.wsdl");
	$client->__setLocation("https://luxoft--preprod.cs86.my.salesforce.com/services/Soap/c/37.0/");
	$result=$client->login(array("username"=>$login, "password"=>$password.$token));
	$sessionId=(string)$result->result->sessionId;
	$serverUrl=(string)$result->result->serverUrl;
	$client2= new SoapClient("preprod_wsdl_1.wsdl");
	$header=new \SoapHeader(
				SOAP_NAMESPACE,
				'SessionHeader',
				array(
					'sessionId' => $sessionId
				)
			);
	$client2->__setSoapHeaders($header); 
	$client2->__setLocation($serverUrl);
	$arSelect = Array("ID", "NAME", "CODE", "NAME", "ACTIVE", "PROPERTY_timetable_id", "PROPERTY_COMMENT", "PROPERTY_lastname", "PROPERTY_CAT_COURSE", "PROPERTY_firstname", "PROPERTY_middlename", "PROPERTY_email", "PROPERTY_city", "PROPERTY_telephone", "PROPERTY_company");
	$arFilter = Array("IBLOCK_ID"=> 64);
	if (intval($ID)>0) {
		$arFilter["ID"]=$ID;
	}
	
	$res = CIBlockElement::GetList(Array("DATE_CREATE"=>"DESC"), $arFilter, false, Array("nPageSize"=>6, "iNumPage"=> 1), $arSelect);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		
		$arCourse=array();
		$arTraining=array();
		$arTraining["Bitrix_Id__c"]=$arFields["ID"];
		$arTraining["Lead__r"]=array("Bitrix_Id__c"=>$arFields["ID"]);
		$arTraining["Training__r"]=array("Bitrix_Id__c"=>$arFields["PROPERTY_CAT_COURSE_VALUE"]);
		if (intval($arFields["PROPERTY_TIMETABLE_ID_VALUE"])>0) {
			$arTraining["Schedule__r"]=array("Bitrix_Id__c"=>$arFields["PROPERTY_TIMETABLE_ID_VALUE"]);
		} else {
			$arTraining["Schedule__c"]=null;
		}
		$arCourse["Bitrix_Id__c"]=$arFields["ID"];
		$arCourse["firstName"]=UTF($arFields["PROPERTY_FIRSTNAME_VALUE"]);
		$arCourse["lastName"]=UTF($arFields["PROPERTY_FIRSTNAME_VALUE"]);
		$arCourse["company"]=UTF($arFields["PROPERTY_COMPANY_VALUE"]);
		$arCourse["email"]=UTF($arFields["PROPERTY_EMAIL_VALUE"]);
		$arCourse["phone"]=UTF($arFields["PROPERTY_TELEPHONE_VALUE"]);
		$arCourse["city"]=UTF($arFields["PROPERTY_CITY_VALUE"]);
		$arTraining["comment__c"]=UTF($arFields["PROPERTY_COMMENT_VALUE"]);
		$arCourse["Bitrix_Source__c"]="RU";
		
		$arRequest[]=$arCourse;
		$arRequest2[]=$arTraining;
	}
	$Object=createSoapVars($arRequest, "Lead");
	$Object1=createSoapVars($arRequest2, "TrainingItem__c");
	$result=$client2->upsert(array("externalIDFieldName"=> "Bitrix_Id__c", 'sObjects'=> $Object));
	$result=$client2->upsert(array("externalIDFieldName"=> "Bitrix_Id__c", 'sObjects'=> $Object1));
}
function createSoapVars(array $objects, $type)
{
        $soapVars = array();

        foreach ($objects as $object) {
			
            $sObject = createSObject($object, $type);
			
            $xml = '';
            if (isset($sObject->fieldsToNull)) {
                foreach ($sObject->fieldsToNull as $fieldToNull) {
                    $xml .= '<fieldsToNull>' . $fieldToNull . '</fieldsToNull>';
                }
                $fieldsToNullVar = new \SoapVar(new \SoapVar($xml, XSD_ANYXML), SOAP_ENC_ARRAY);
                $sObject->fieldsToNull = $fieldsToNullVar;
            }

            $soapVar = new \SoapVar($sObject, SOAP_ENC_OBJECT, $type, SOAP_NAMESPACE);
            $soapVars[] = $soapVar;
        }

        return $soapVars;
}

function createSObject($object, $objectType)
{
        $sObject = new \stdClass();
        foreach ($object as $field => $value) {

            if ($value === null) {
                $sObject->fieldsToNull[] = $field;
                continue;
            }
			if (is_array($value)) {
				if ($field=="Instructor__r") {
					$value=new \SoapVar($value, SOAP_ENC_OBJECT, "Instructor__c", SOAP_NAMESPACE);
				} elseif ($field=="Training__r") {
					$value=new \SoapVar($value, SOAP_ENC_OBJECT, "Training__c", SOAP_NAMESPACE);
				}  elseif ($field=="Lead__r") {
					$value=new \SoapVar($value, SOAP_ENC_OBJECT, "Lead", SOAP_NAMESPACE);
				} elseif ($field=="Schedule__r") {
					$value=new \SoapVar($value, SOAP_ENC_OBJECT, "Schedule__c", SOAP_NAMESPACE);
				}
			
			}
            $sObject->$field = $value;
			
        }

        return $sObject;
}*/

?> 


