<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!isset($arParams["CACHE_TIME"])) {
	$arParams["CACHE_TIME"] = 3600;
}

CPageOption::SetOptionString("main", "nav_page_in_session", "N");

if($arParams["IBLOCK_ID"] < 1) {
	//ShowError("IBLOCK_ID IS NOT DEFINED");
	//return false;
}

if(!isset($arParams["ITEMS_LIMIT"])) {
	$arParams["ITEMS_LIMIT"] = 10;
}
global $USER;
if ($USER->IsAuthorized()) {
	$arResult["IS_AUTHORIZED"] = "Y";
	$arResult["USER_ID"] = CUser::GetID();	
}


$arNavParams = array();
if ($arParams["ITEMS_LIMIT"] > 0) {
	$arNavParams = array(
		"nPageSize" => $arParams["ITEMS_LIMIT"],
	);
}
if($this->StartResultCache(false, array($arNavigation)))
{

	if(!CModule::IncludeModule("iblock")) {
		$this->AbortResultCache();
		ShowError("IBLOCK_MODULE_NOT_INSTALLED");
		return false;
	}	

	/*
		get all  active elements in our basket
		and put it into  $arResult['BASKETITEMS']
	*/
	$arBasketItems = array();
	$dbBasketItems = CSaleBasket::GetList(
			array(
					"NAME" => "ASC",
					"ID" => "ASC"
				),
			array(
					"FUSER_ID" => CSaleBasket::GetBasketUserID(),
					"LID" => SITE_ID,
					"ORDER_ID" => "NULL"
				),
			false,
			false,
			array("ID", "PRODUCT_ID" )
		);
	while ($arItems = $dbBasketItems->Fetch())
	{
		$arResult['PRODUCT_ID_IN_BASKET'][] = $arItems["PRODUCT_ID"];
	}
	$arResult['BASKETITEMS'] = $arResult['PRODUCT_ID_IN_BASKET'];
	
	
	
	/*
		get all  needed info by default
		and put it into  $arResult['EMAIL']
	*/	
	
	global $USER;
	$arResult['SEND_EMAIL'] = "N";
	$arResult['SHOW_INFO'] = "N";
	$arResult['EMAIL']['USER_EMAIL'] = $USER->GetEmail();
	$arResult['EMAIL']['USER_ID'] = $arResult["USER_ID"];
	$arResult['EMAIL']['LIST_COURSES_SM'] = "<ul style='padding-left: 0px; margin-left: 19px;' >";
	$arResult['EMAIL']['LIST_COURSES_B'] = "";
	$arResult['EMAIL']['LIST_COURSES_PARTNER_SM'] = "";
	$arResult['EMAIL']['LIST_COURSES_PARTNER_B'] = "";
	$arResult['EMAIL']['POLOSKA_SM'] = "";
	$arResult['EMAIL']['POLOSKA_B'] = "";
	$arResult['EMAIL']['LIST_SEMINARS_SM'] = "<ul style='padding-left: 0px; margin-left: 19px;'>";
	$arResult['EMAIL']['LIST_SEMINARS_B'] = "";
	$arResult['EMAIL']['NADPIS_SEMINAR'] = "";
	//iwrite($arResult['EMAIL']);

if ( in_array(61, $USER->GetUserGroupArray())){
	$arResult['SHOW_INFO'] = "Y";
}; 

	if ((count($arResult['BASKETITEMS'])>0) and ($_REQUEST['SEND_EMAIL'] === "Y") and (in_array(61, $USER->GetUserGroupArray()))){
//echo "PRIVED";
		$index = 0;
		$arResult['BASKETITEMS'] = GetListCoursesOfArrayByDateASC($arResult['BASKETITEMS']);
		foreach ($arResult['BASKETITEMS'] as $vIDTimetable){
			$index = $index + 1;
			$arInfo = GetFullInfoAboutCourse($vIDTimetable);
			$arPossibleCities[] = $arInfo['ID_CITY']; /*array to get active cities to show free events by these cities*/			
			if (strlen($arInfo["ENDDATE"])>0){
				$arInfo["STARTDATE"] .= " - ".$arInfo["ENDDATE"];
			}
			

				
				

					
			$arFilter = array("IBLOCK_ID"=>D_COURSE_ID_IBLOCK, "ACTIVE"=>"Y" , "ID"=>$arInfo['ID_COURSE']);
			$arSelectFields = array(
				"ID",
				"NAME",
				"PROPERTY_COURSE_CODE",
				"PROPERTY_COURSE_FORMAT",
				"PROPERTY_COURSE_DURATION",
				"PROPERTY_COURSE_AUDIENCE",
				"PROPERTY_COURSE_DESC_NEW",
				"PROPERTY_COURSE_PUPROSES",
				"PROPERTY_ID_COURSE_OWNER"
			);
			$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelectFields);

			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();
				$arInfo['COURSE_ID'] = $arFields['ID'];
				$arInfo['COURSE_NAME'] = $arFields['NAME'];
				$arInfo['COURSE_CODE'] = $arFields['PROPERTY_COURSE_CODE_VALUE'];
				$arInfo['COURSE_DURATION'] = $arFields['PROPERTY_COURSE_DURATION_VALUE'];
				$arInfo['COURSE_FORMAT_ID'] = $arFields['PROPERTY_COURSE_FORMAT_VALUE'];
				$arInfo['COURSE_DESC_NEW'] = $arFields['PROPERTY_COURSE_DESC_NEW_VALUE'];
					if ($arFields['PROPERTY_COURSE_DESC_NEW_VALUE']['TYPE']  === "text"){
						$arInfo['COURSE_DESC_NEW_VALUE'] = nl2br($arFields['~PROPERTY_COURSE_DESC_NEW_VALUE']['TEXT']);
					}
					if ($arFields['PROPERTY_COURSE_DESC_NEW_VALUE']['TYPE']  === "html"){
						$arInfo['COURSE_DESC_NEW_VALUE'] = $arFields['~PROPERTY_COURSE_DESC_NEW_VALUE']['TEXT'];
					}
					$arInfo['COURSE_DESC_NEW_VALUE'] = str_replace("<ul>","<ul style='margin:0px 0px 15px 25px; padding:0px 0px 0px 0px;'>",$arInfo['COURSE_DESC_NEW_VALUE']);
					$arInfo['COURSE_DESC_NEW_VALUE'] = str_replace("<blockquote>","<blockquote style='margin:0px; padding:0px;'>",$arInfo['COURSE_DESC_NEW_VALUE']);
				
					$arInfo['COURSE_PUPROSES'] = $arFields['~PROPERTY_COURSE_PUPROSES_VALUE']; 
					$arInfo['COURSE_PUPROSES'] = str_replace("<ul>","<ul style='margin:0px 0px 15px 25px; padding:0px 0px 0px 0px;'>",$arInfo['COURSE_PUPROSES']);
					$arInfo['COURSE_PUPROSES'] = str_replace("<blockquote>","<blockquote style='margin:0px; padding:0px;'>",$arInfo['COURSE_PUPROSES']);				
					if (strpos($arInfo['COURSE_PUPROSES'], "ul") === false) {
						$arInfo['COURSE_PUPROSES'] = nl2br($arInfo['COURSE_PUPROSES']);
					}
					$arInfo['COURSE_AUDIENCE'] = $arFields['~PROPERTY_COURSE_AUDIENCE_VALUE']; 
					$arInfo['COURSE_AUDIENCE'] = str_replace("<ul>","<ul style='margin:0px 0px 15px 25px; padding:0px 0px 0px 0px;'>",$arInfo['COURSE_AUDIENCE']);
					$arInfo['COURSE_AUDIENCE'] = str_replace("<blockquote>","<blockquote style='margin:0px; padding:0px;'>",$arInfo['COURSE_AUDIENCE']);				
					if (strpos($arInfo['COURSE_AUDIENCE'], "ul") === false) {
						$arInfo['COURSE_AUDIENCE'] = nl2br($arInfo['COURSE_AUDIENCE']);
					}
					$arInfo["ID_COURSE_OWNER"] = $arFields["PROPERTY_ID_COURSE_OWNER_ENUM_ID"];
			}
			if (strlen($arInfo['ID_TEACHER'])>0){	
				$arExpert = GetInfoAboutExpertByID($arInfo['ID_TEACHER']);
				$arInfo['PREPOD_TEXT'] = strlen($arInfo['ID_TEACHER']) > 0 ? "Преподаватель: <a target='_blank' style='color:#004080;text-decoration:underline;font-weight:bold;' href='http://ibs-training.ru/about/experts/".$arExpert["EXPERT_CODE"].".html'>".$arExpert['EXPERT_NAME']." ".$arExpert['EXPERT_NAME_FULL']."</a> &ndash; ".$arExpert['EXPERT_SHORT']." <br />" : "";
			} else {
				$arInfo['PREPOD_TEXT'] = "";
			}
			
			
			$vCurrentTemp_SM = "LIST_COURSES_SM"; /* by default */
			$vCurrentTemp_B = "LIST_COURSES_B";
			if (
				($arInfo["ID_COURSE_OWNER"] == 120) or 
				($arInfo["ID_COURSE_OWNER"] == 121) or 
				($arInfo["ID_COURSE_OWNER"] == 123)
				){
					$vCurrentTemp_SM = "LIST_COURSES_SM";
					$vCurrentTemp_B = "LIST_COURSES_B";
			}
			//iwrite($arInfo);
			if ($arInfo["ID_COURSE_OWNER"] == 122){
					$vCurrentTemp_SM = "LIST_COURSES_PARTNER_SM";
					$vCurrentTemp_B = "LIST_COURSES_PARTNER_B";
			}			
			
			
			
			

			
			
			$arResult['EMAIL'][$vCurrentTemp_SM] .= "
									<li style='padding: 0; margin:0px 0px 4px 0px;font-style:normal;display:block;font-size:14px; font-family:Arial,Helvetica,sans-serif;font-weight:bold;'>
										<a target='_blank' style='color:#004080;' href='#c_".$arInfo['ID_TIME']."'>".trim($arInfo['COURSE_NAME']).", ".$arInfo["STARTDATE"]."</a>
									</li>";			
			$arResult['EMAIL'][$vCurrentTemp_B] .= "
								<div class='l_course' style='margin:20px 0px 10px 0px;'>
									<div style='text-align:left;margin:10px 15px 10px 15px; padding:0px; font-size:14px; font-family:Arial,Helvetica,sans-serif;font-weight:bold;'><a name='c_".$arInfo['ID_TIME']."'></a>
										<a target='_blank' style='color:#004080;font-size:14px; text-decoration:underline;font-weight:bold;' href='http://ibs-training.ru/internal/catalog/".$arInfo['COURSE_CODE']."/'>".trim($arInfo['COURSE_NAME'])."</a>
									</div>
									<div style='text-align:left;margin:10px 15px 10px 15px; padding:0px; font-size:14px; font-family:Arial,Helvetica,sans-serif;color:#454545;'>
									
									Код курса: ".$arInfo['COURSE_CODE']."<br />
									Дата: <span style='color:#ff6600;font-weight:bold;'>".$arInfo['STARTDATE'] .", ".$arInfo['CITY_NAME'] ."</span><br />
									Время: <span style='color:#ff6600;font-weight:bold;'>".$arInfo["SCHEDULE_TIME"]."</span><br />
									Длительность: ".$arInfo['COURSE_DURATION']." час.<br />
									
									".$arInfo['PREPOD_TEXT']."
									
									
									<br />
									<div class='l_template'>
									<span style='color:#000000;font-weight:bold;'>Описание:</span><br />
									".$arInfo['COURSE_DESC_NEW_VALUE']."
									</div>
									<br /><br />
									<div class='l_template'>
									<span style='color:#000000;font-weight:bold;'>Цели:</span><br />
									".$arInfo['COURSE_PUPROSES']."
									</div>
									<br />
									<div class='l_template'>
									<span style='color:#000000;font-weight:bold;'>Целевая аудитория:</span><br />
									".$arInfo['COURSE_AUDIENCE']."
									</div>
									<br />
									<!--<a target='_blank' style='color:#004080;text-decoration:underline;font-weight:bold;font-size:14px;' href='http://ibs-training.ru/training/catalog/course.html?ID=".$arInfo['COURSE_ID']."'>Подробнее о курсе</a><br />-->
									
									<a target='_blank' style='color:#004080;text-decoration:underline;font-weight:bold;font-size:14px;' href='http://ibs-training.ru/internal/catalog/".$arInfo['COURSE_CODE']."/'>Подробнее о курсе</a><br />
									<a target='_blank' style='color:#004080;text-decoration:underline;font-weight:bold;font-size:14px;' href='https://inthr.luxoft.com/IntHRWebApp/aspx_PTC/CreateRequestInternal.aspx?Course=".$arInfo['COURSE_CODE']."'>Записаться на курс</a>
									
									</div>
								</div>								
			";
			
			if ($index !== count($arResult['BASKETITEMS'])){
				$arResult['EMAIL']['LIST_COURSES_B'] .= "
					<table style='border-collapse:collapse; border:none; margin:0px;padding:0px;' width='700' cellspacing='0' cellpadding='0'>
						<tr>
							<td valign='top' width='15' height='2' class='pad_null' style='background-color:#ffffff;'>
								<img src='http://ibs-training.ru/images/email/spacer.gif' width='15' height='2' alt='' border='0'/>
							</td>
							<td width='500' height='2' class='pad_null' style='background-color:#FF6600;'>
								<img src='http://ibs-training.ru/images/email/spacer.gif' width='500' height='2' alt='' border='0'/>
							</td>
							<td width='185' height='2' class='pad_null' style='background-color:#ffffff;'>
								<img src='http://ibs-training.ru/images/email/spacer.gif' width='185' height='2' alt='' border='0'/>
							</td>
						</tr>
					</table>				
				";
			}
			
		}
		$arResult['EMAIL']["LIST_COURSES_SM"].="</ul>";
		if (strlen($arResult['EMAIL']['LIST_COURSES_PARTNER_SM'])>0){
			$arResult['EMAIL']['POLOSKA_SM'] = "
								<div style='text-align:left;margin:0px 15px 0px 25px; padding:0px; font-family:Arial,Helvetica,sans-serif;color:#FF6600;'>
									<table style='border-collapse:collapse; border:none; margin:0px;padding:0px;' width='70%' cellspacing='0' cellpadding='0'>
										<tr>
											<td width='70%' height='2' class='pad_null' style='background-color:#FF6600;'>
												<img src='http://ibs-training.ru/images/email/spacer.gif' width='70%' height='2' alt='' border='0' />
											</td>
										</tr>
									</table>
								</div>
								<div style='text-align:left;margin:2px 15px 10px 25px; padding:0px; font-size:14px; font-family:Arial,Helvetica,sans-serif;color:#ff6600;font-weight:bold;'>
									Платные курсы (курсы партнеров Luxoft Training)
								</div>
			";
			$arResult['EMAIL']['POLOSKA_B'] .= "
							<table style='border-collapse:collapse; border:none; margin:0px;padding:0px;' width='700' cellspacing='0' cellpadding='0'>
								<tr>
									<td valign='top' width='15' height='5' class='pad_null' style='background-color:#ffffff;'>
										<img src='http://ibs-training.ru/images/email/spacer.gif' width='15' height='5' alt='' border='0'/>
									</td>
									<td width='500' height='5' class='pad_null' style='background-color:#FF6600;'>
										<img src='http://ibs-training.ru/images/email/spacer.gif' width='500' height='5' alt='' border='0'/>
									</td>
									<td width='185' height='5' class='pad_null' style='background-color:#ffffff;'>
										<img src='http://ibs-training.ru/images/email/spacer.gif' width='185' height='5' alt='' border='0'/>
									</td>
								</tr>
							</table>
							<div style='text-align:left;margin:10px 15px 10px 15px; padding:0px; font-size:14px; font-family:Arial,Helvetica,sans-serif;color:#ff6600;'>
								Платные курсы (курсы партнеров Luxoft Training)<br />
								Специально для сотрудников Luxoft цены на курсы снижены до себестоимости

							</div>
			";
		}
		//iwrite($arPossibleCities);
		$arPossibleCities = array_unique($arPossibleCities);
		$arPossibleCities[] = CITY_ID_ONLINE;
		$arPossibleCities = array_diff($arPossibleCities, array(''));
		//iwrite($arPossibleCities);
		
		
		/*
			get info about free events by ID Array of cities
		*/
		$arFilter = array("IBLOCK_ID"=>D_SEMINARS_IBLOCK, "ACTIVE"=>"Y", "PROPERTY_CITY"=>$arPossibleCities, ">=PROPERTY_STARTDATE" => date("Y-m-d"));
		$arSelectFields = array(
			"ID",
			"NAME",
			"PROPERTY_TYPE_EVENT",
			"PROPERTY_DESCRIPTION",
			"PROPERTY_TIME",
			"PROPERTY_STARTDATE",
			"PROPERTY_CITY.NAME",
			"PROPERTY_TRENER",
			"PROPERTY_LOCATION"
		);
		$res = CIBlockElement::GetList(array("PROPERTY_STARTDATE" =>"ASC"), $arFilter, false, false, $arSelectFields);

		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			$arInfoSem['ID'] = $arFields['ID'];
			$arInfoSem['NAME'] = $arFields['NAME'];
			$arInfoSem['TYPE_EVENT'] = $arFields['PROPERTY_TYPE_EVENT_VALUE'];
			$arInfoSem['DESCRIPTION'] = $arFields['PROPERTY_DESCRIPTION_VALUE'];
			$arInfoSem['TIME'] = $arFields['PROPERTY_TIME_VALUE'];				
			$arInfoSem['STARTDATE'] = $arFields['PROPERTY_STARTDATE_VALUE'];
			$arInfoSem['CITY'] = $arFields['PROPERTY_CITY_NAME'];
			$arInfoSem['TRENER_ID'] = $arFields['PROPERTY_TRENER_VALUE'];
			$arInfoSem['LOCATION'] = $arFields['PROPERTY_LOCATION_VALUE'];			
			$arSeminars[] = $arInfoSem;
		}
		//iwrite($arSeminars);
		if (count($arSeminars)>0){
			$arResult['EMAIL']['NADPIS_SEMINAR'] = "Семинары и Вебинары:";
		}
		/*
			seminars block http://ibs-training.ru/events/seminar/26271/
		*/
		$index = 0;
		foreach ($arSeminars as $arSeminar){
			$index = $index + 1;
			//$arInfo = "";
			//$arExpert= "";
			if (strlen($arSeminar['TRENER_ID'])>0){
				$arExpert = GetInfoAboutExpertByID($arSeminar['TRENER_ID']);
				$arInfo['PREPOD_TEXT'] = strlen($arSeminar['TRENER_ID']) > 0 ? "Преподаватель: <a target='_blank' style='color:#004080;text-decoration:underline;font-weight:bold;' href='http://ibs-training.ru/about/experts/".$arExpert["EXPERT_CODE"].".html'>".$arExpert['EXPERT_NAME']." ".$arExpert['EXPERT_NAME_FULL']."</a> &ndash; ".$arExpert['EXPERT_SHORT']." <br />" : "";
			} else {
				$arInfo['PREPOD_TEXT'] = "";
			}
			//iwrite($arSeminar);
			//iwrite($arInfo);
			//iwrite($arExpert);
			$arResult['EMAIL']['LIST_SEMINARS_SM'] .= "
									<li style='padding: 0; margin:0px 0px 4px 0px;font-style:normal;display:block;font-size:14px; font-family:Arial,Helvetica,sans-serif;font-weight:bold;'>
										 <span style='color:#ff6600;'>".$arSeminar['TYPE_EVENT']."</span>  <a target='_blank' style='color:#004080;' href='#s_".$arSeminar['ID']."'>".trim($arSeminar['NAME']).", ".$arSeminar["STARTDATE"]."</a>
									</li>";
			$arResult['EMAIL']['LIST_SEMINARS_B'] .= "
								<div class='l_course' style='margin:20px 0px 10px 0px;'>
									<div style='text-align:left;margin:10px 15px 10px 15px; padding:0px; font-size:14px; font-family:Arial,Helvetica,sans-serif;font-weight:bold;'><a name='s_".$arSeminar['ID']."'></a>
										<a target='_blank' style='color:#004080;font-size:14px; text-decoration:underline;font-weight:bold;' href='http://ibs-training.ru/events/seminar/".$arSeminar['ID']."/'>".trim($arSeminar['NAME'])."</a>
									</div>
									<div style='text-align:left;margin:10px 15px 10px 15px; padding:0px; font-size:14px; font-family:Arial,Helvetica,sans-serif;color:#454545;'>
									
									Место проведения: ".$arSeminar['LOCATION']."<br />
									Дата: <span style='color:#ff6600;font-weight:bold;'>".$arSeminar['STARTDATE'] .", ".$arSeminar['TYPE_EVENT'] ."</span><br />
									Время: ".$arSeminar['TIME']." час.<br />
								
									".$arInfo['PREPOD_TEXT']."
									
									<br />
									<div class='l_template'>
									<span style='color:#000000;font-weight:bold;'>Описание:</span><br />
									".$arSeminar['DESCRIPTION']."
									</div>
									<br />
									
									<a target='_blank' style='color:#004080;text-decoration:underline;font-weight:bold;font-size:14px;' href='http://ibs-training.ru/events/seminar/".$arSeminar['ID']."/'>Подробнее о мероприятии</a><br />
									<a target='_blank' style='color:#004080;text-decoration:underline;font-weight:bold;font-size:14px;' href='http://ibs-training.ru/events/seminar/".$arSeminar['ID']."/#form_b'>Записаться на мероприятие</a>
									
									</div>
								</div>								
			";
			
			if ($index !== count($arSeminars)){
				$arResult['EMAIL']['LIST_SEMINARS_B'] .= "
					<table style='border-collapse:collapse; border:none; margin:0px;padding:0px;' width='700' cellspacing='0' cellpadding='0'>
						<tr>
							<td valign='top' width='15' height='2' class='pad_null' style='background-color:#ffffff;'>
								<img src='http://ibs-training.ru/images/email/spacer.gif' width='15' height='2' alt='' border='0'/>
							</td>
							<td width='500' height='2' class='pad_null' style='background-color:#FF6600;'>
								<img src='http://ibs-training.ru/images/email/spacer.gif' width='500' height='2' alt='' border='0'/>
							</td>
							<td width='185' height='2' class='pad_null' style='background-color:#ffffff;'>
								<img src='http://ibs-training.ru/images/email/spacer.gif' width='185' height='2' alt='' border='0'/>
							</td>
						</tr>
					</table>				
				";
			}									
		}									
		$arResult['EMAIL']['LIST_SEMINARS_SM'].="</ul>";
		
	}




	$arSendEvent =  $arResult['EMAIL'];	
	if (isset($_REQUEST['SEND_EMAIL']) and ($_REQUEST['SEND_EMAIL'] === "Y")){
		//CEvent::Send('ELEMENTS_BASKET_SEND',SITE_ID, $arSendEvent, "N", 101);
		$arQuest=getRandmonFAQ();
		$arSendEvent["QUESTION"]=$arQuest["QUESTION"];
		$answer=preg_replace('#(<div)(.+)(hidden\"><p>)(.+)#', '$1$2$3<b>Ответ: </b>$4', $arQuest["ANSWER"]);
		$arSendEvent["ANSWER"]=$answer;
		$arNews=LuxNews();
		$arSendEvent["HEADER_NEWS"]="<a style='color: #004280;' href='".$arNews["URL"]."'>".$arNews["TITLE"]."</a>";
		$arSendEvent["CONTENT_NEWS"]=$arNews["TEXT"];
		CEvent::Send('ELEMENTS_BASKET_SEND',SITE_ID, $arSendEvent, "N", 137);
		$arResult['SEND_EMAIL'] = "Y";
		
	}





if ($arParams["ITEMS_LIMIT"] > 0) {
	$arNavParams = array(
		"nPageSize" => $arParams["ITEMS_LIMIT"],
	);
}

	if(!CModule::IncludeModule("iblock")) {
		$this->AbortResultCache();
		ShowError("IBLOCK_MODULE_NOT_INSTALLED");
		return false;
	}	

	/*
		get all  active elements in our basket
		and put it into  $arResult['BASKETITEMS']
	*/
	$arBasketItems = array();
	$dbBasketItems = CSaleBasket::GetList(
			array(
					"NAME" => "ASC",
					"ID" => "ASC"
				),
			array(
					"FUSER_ID" => CSaleBasket::GetBasketUserID(),
					"LID" => SITE_ID,
					"ORDER_ID" => "NULL"
				),
			false,
			false,
			array("ID", "PRODUCT_ID" )
		);
	while ($arItems = $dbBasketItems->Fetch())
	{
		$arResult['PRODUCT_ID_IN_BASKET'][] = $arItems["PRODUCT_ID"];
	}
	$arResult['BASKETITEMS'] = $arResult['PRODUCT_ID_IN_BASKET'];
	
	
	
	/*
		get all  needed info by default
		and put it into  $arResult['EMAIL']
	*/	
	
	global $USER;
	$arResult['SEND_EMAIL'] = "N";
	$arResult['SHOW_INFO'] = "N";
	$arResult['EMAIL']['USER_EMAIL'] = $USER->GetEmail();
	$arResult['EMAIL']['USER_ID'] = $arResult["USER_ID"];
	$arResult['EMAIL']['LIST_COURSES_SM'] = "<table style='width: 100%' cellpadding=0 cellspacin=0 border=0><tr><td style='padding-left: 20px;'><ul style='padding-left: 0px; margin-left: 19px;'>";
	$arResult['EMAIL']['LIST_COURSES_B'] = "";
	$arResult['EMAIL']['LIST_COURSES_PARTNER_SM'] = "";
	$arResult['EMAIL']['LIST_COURSES_PARTNER_B'] = "";
	$arResult['EMAIL']['POLOSKA_SM'] = "";
	$arResult['EMAIL']['POLOSKA_B'] = "";
	$arResult['EMAIL']['LIST_SEMINARS_SM'] = "<table style='width: 100%' cellpadding=0 cellspacin=0 border=0><tr><td style='padding-left: 20px;'><ul style='padding-left: 0px; margin-left: 19px;'>";
	$arResult['EMAIL']['LIST_SEMINARS_B'] = "";
	$arResult['EMAIL']['NADPIS_SEMINAR'] = "";
	//iwrite($arResult['EMAIL']);

if ( in_array(61, $USER->GetUserGroupArray())){
	$arResult['SHOW_INFO'] = "Y";
}; 

	if ((count($arResult['BASKETITEMS'])>0) and ($_REQUEST['SEND_EMAIL'] === "Y") and (in_array(61, $USER->GetUserGroupArray()))){
//echo "PRIVED";
		$index = 0;
		$arResult['BASKETITEMS'] = GetListCoursesOfArrayByDateASC($arResult['BASKETITEMS']);
		foreach ($arResult['BASKETITEMS'] as $vIDTimetable){
			$index = $index + 1;
			$arInfo = GetFullInfoAboutCourse($vIDTimetable);
			$arPossibleCities[] = $arInfo['ID_CITY']; /*array to get active cities to show free events by these cities*/			
			if (strlen($arInfo["ENDDATE"])>0){
				$arInfo["STARTDATE"] .= " - ".$arInfo["ENDDATE"];
			}
			

				
				

					
			$arFilter = array("IBLOCK_ID"=>D_COURSE_ID_IBLOCK, "ACTIVE"=>"Y" , "ID"=>$arInfo['ID_COURSE']);
			$arSelectFields = array(
				"ID",
				"NAME",
				"PROPERTY_COURSE_CODE",
				"PROPERTY_COURSE_FORMAT",
				"PROPERTY_COURSE_DURATION",
				"PROPERTY_COURSE_AUDIENCE",
				"PROPERTY_COURSE_DESC_NEW",
				"PROPERTY_COURSE_PUPROSES",
				"PROPERTY_ID_COURSE_OWNER"
			);
			$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelectFields);

			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();
				$arInfo['COURSE_ID'] = $arFields['ID'];
				$arInfo['COURSE_NAME'] = $arFields['NAME'];
				$arInfo['COURSE_CODE'] = $arFields['PROPERTY_COURSE_CODE_VALUE'];
				$arInfo['COURSE_DURATION'] = $arFields['PROPERTY_COURSE_DURATION_VALUE'];
				$arInfo['COURSE_FORMAT_ID'] = $arFields['PROPERTY_COURSE_FORMAT_VALUE'];
				$arInfo['COURSE_DESC_NEW'] = $arFields['PROPERTY_COURSE_DESC_NEW_VALUE'];
					if ($arFields['PROPERTY_COURSE_DESC_NEW_VALUE']['TYPE']  === "text"){
						$arInfo['COURSE_DESC_NEW_VALUE'] = nl2br($arFields['~PROPERTY_COURSE_DESC_NEW_VALUE']['TEXT']);
					}
					if ($arFields['PROPERTY_COURSE_DESC_NEW_VALUE']['TYPE']  === "html"){
						$arInfo['COURSE_DESC_NEW_VALUE'] = $arFields['~PROPERTY_COURSE_DESC_NEW_VALUE']['TEXT'];
					}
					$arInfo['COURSE_DESC_NEW_VALUE'] = str_replace("<ul>","<ul style='margin:0px 0px 15px 25px; padding:0px 0px 0px 0px;'>",$arInfo['COURSE_DESC_NEW_VALUE']);
					$arInfo['COURSE_DESC_NEW_VALUE'] = str_replace("<blockquote>","<blockquote style='margin:0px; padding:0px;'>",$arInfo['COURSE_DESC_NEW_VALUE']);
				
					$arInfo['COURSE_PUPROSES'] = $arFields['~PROPERTY_COURSE_PUPROSES_VALUE']; 
					$arInfo['COURSE_PUPROSES'] = str_replace("<ul>","<ul style='margin:0px 0px 15px 25px; padding:0px 0px 0px 0px;'>",$arInfo['COURSE_PUPROSES']);
					$arInfo['COURSE_PUPROSES'] = str_replace("<blockquote>","<blockquote style='margin:0px; padding:0px;'>",$arInfo['COURSE_PUPROSES']);				
					if (strpos($arInfo['COURSE_PUPROSES'], "ul") === false) {
						$arInfo['COURSE_PUPROSES'] = nl2br($arInfo['COURSE_PUPROSES']);
					}
					$arInfo['COURSE_AUDIENCE'] = $arFields['~PROPERTY_COURSE_AUDIENCE_VALUE']; 
					$arInfo['COURSE_AUDIENCE'] = str_replace("<ul>","<ul style='margin:0px 0px 15px 25px; padding:0px 0px 0px 0px;'>",$arInfo['COURSE_AUDIENCE']);
					$arInfo['COURSE_AUDIENCE'] = str_replace("<blockquote>","<blockquote style='margin:0px; padding:0px;'>",$arInfo['COURSE_AUDIENCE']);				
					if (strpos($arInfo['COURSE_AUDIENCE'], "ul") === false) {
						$arInfo['COURSE_AUDIENCE'] = nl2br($arInfo['COURSE_AUDIENCE']);
					}
					$arInfo["ID_COURSE_OWNER"] = $arFields["PROPERTY_ID_COURSE_OWNER_ENUM_ID"];
			}
			if (strlen($arInfo['ID_TEACHER'])>0){	
				$arExpert = GetInfoAboutExpertByID($arInfo['ID_TEACHER']);
				$arInfo['PREPOD_TEXT'] = strlen($arInfo['ID_TEACHER']) > 0 ? "Преподаватель: <a target='_blank' style='color:#004080;text-decoration:underline;font-weight:bold;' href='http://ibs-training.ru/about/experts/".$arExpert["EXPERT_CODE"].".html'>".$arExpert['EXPERT_NAME']." ".$arExpert['EXPERT_NAME_FULL']."</a> &ndash; ".$arExpert['EXPERT_SHORT']." <br />" : "";
			} else {
				$arInfo['PREPOD_TEXT'] = "";
			}
			
			
			$vCurrentTemp_SM = "LIST_COURSES_SM"; /* by default */
			$vCurrentTemp_B = "LIST_COURSES_B";
			if (
				($arInfo["ID_COURSE_OWNER"] == 120) or 
				($arInfo["ID_COURSE_OWNER"] == 121) or 
				($arInfo["ID_COURSE_OWNER"] == 123)
				){
					$vCurrentTemp_SM = "LIST_COURSES_SM";
					$vCurrentTemp_B = "LIST_COURSES_B";
			}
			//iwrite($arInfo);
			if ($arInfo["ID_COURSE_OWNER"] == 122){
					$vCurrentTemp_SM = "LIST_COURSES_PARTNER_SM";
					$vCurrentTemp_B = "LIST_COURSES_PARTNER_B";
			}			
			
			
			
			

			
			
			$arResult['EMAIL'][$vCurrentTemp_SM] .= "
									<li style='padding: 0; padding: 20px 0; margin:0px 0px 4px 0px; color: #00407f;font-style:normal;display:block;font-size:14px; font-family:Arial,Helvetica,sans-serif;font-weight:bold;'>
										<a target='_blank' style='color:#00407f;' href='#c_".$arInfo['ID_TIME']."'>".trim($arInfo['COURSE_NAME']).", ".$arInfo["STARTDATE"]."</a>
									</li>";			
			$arResult['EMAIL'][$vCurrentTemp_B] .= "
								<div class='l_course' style=''>
									<div style='text-align:center; padding:0px; margin-bottom: 22px; font-size:14px; font-family:Arial,Helvetica,sans-serif;font-weight:bold;'><a name='c_".$arInfo['ID_TIME']."'></a>
										<a target='_blank' style='color:#fff; font-size:16px; display: inline-block; padding: 4px 20px; background: #f26e24; text-transform: uppercase; text-decoration:none;' href='http://ibs-training.ru/internal/catalog/".$arInfo['COURSE_CODE']."/'>&nbsp;&nbsp;&nbsp;".trim(strtoupper($arInfo['COURSE_NAME']))."&nbsp;&nbsp;&nbsp;</a>
									</div>
									<div style='text-align:left;padding:0px; font-size:14px; font-family:Arial,Helvetica,sans-serif;color:#00407f;'>
									
									Код курса: ".$arInfo['COURSE_CODE']."<br />
									Дата: <span style='color:#f26e24;font-weight:bold;'>".$arInfo['STARTDATE'] .", ".$arInfo['CITY_NAME'] ."</span><br />
									Время: <span style='color:#f26e24;font-weight:bold;'>".$arInfo["SCHEDULE_TIME"]."</span><br />
									Длительность: ".$arInfo['COURSE_DURATION']." час.<br />
									
									".$arInfo['PREPOD_TEXT']."
									
									
									<br />
									<div class='l_template'>
									<span style='color:#f26e24;font-weight:bold;'>Описание:</span><br />
									".$arInfo['COURSE_DESC_NEW_VALUE']."
									</div>
									<br /><br />
									<div class='l_template'>
									<span style='color:#f26e24;font-weight:bold;'>Цели:</span><br />
									".$arInfo['COURSE_PUPROSES']."
									</div>
									<br />
									<div class='l_template'>
									<span style='color:#f26e24;font-weight:bold;'>Целевая аудитория:</span><br />
									".$arInfo['COURSE_AUDIENCE']."
									</div>
									<br />
									<table border=0 cellpading=0 cellspacing=0 style='width: 100%;'>
										<tr>
											<td class='pad_null' width='88' style='padding: 0; width: 88px;'><img src='http://ibs-training.ru/images/email/spacer.gif' height='32' width='88' alt='' border='0'/></td>
											<td class='pad_null' style='height: 32px;  padding: 0; background: #22427c; text-align: center;'><a target='_blank' style='color:#fff;text-decoration:none; font-weight:bold;font-size:14px; font-family: Arial;' href='http://ibs-training.ru/internal/catalog/".$arInfo['COURSE_CODE']."/'>ПОДРОБНЕЕ</a></td>
											<td class='pad_null' style='padding: 0; width: 65px;'><img src='http://ibs-training.ru/images/email/spacer.gif' width='65' height='32' alt='' border='0'/></td>
											<td class='pad_null'  style='height: 32px; background: #f26e24; text-align: center;  padding: 0;'>
												<a target='_blank' style='color:#fff;text-decoration:none;font-weight:bold;font-size:14px; font-family: Arial;' href='https://inthr.luxoft.com/IntHRWebApp/aspx_PTC/CreateRequestInternal.aspx?Course=".$arInfo['COURSE_CODE']."'>ЗАПИСАТЬСЯ</a>
											</td>
											<td class='pad_null' style='padding: 0; width: 88px;'><img src='http://ibs-training.ru/images/email/spacer.gif' width='88' height='32' alt='' border='0'/></td>
										</tr>
									</table>
									</div>
								</div>								
			";
			
			if ($index !== count($arResult['BASKETITEMS'])){
				$arResult['EMAIL']['LIST_COURSES_B'] .= "
					<table style='border-collapse:collapse; border:none; margin:0px;padding:0px;' width='560' cellspacing='0' cellpadding='0'>
						<tr>
							
							<td width='560' height='10' class='pad_null' style=''>
								<img src='http://ibs-training.ru/images/email/spacer.gif' width='560' height='50' alt='' border='0'/>
							</td>
							
						</tr>
					</table>				
				";
			}
			
		}
		$arResult['EMAIL']["LIST_COURSES_SM"].="</ul></td></tr></table>";
		if (strlen($arResult['EMAIL']['LIST_COURSES_PARTNER_SM'])>0){
			$arResult['EMAIL']['POLOSKA_SM'] = "
								<div style='text-align:left;margin:0px 15px 0px 25px; padding:0px; font-family:Arial,Helvetica,sans-serif;color:#FF6600;'>
									<table style='border-collapse:collapse; border:none; margin:0px;padding:0px;' width='70%' cellspacing='0' cellpadding='0'>
										<tr>
											<td width='70%' height='2' class='pad_null' style='background-color:#FF6600;'>
												<img src='http://ibs-training.ru/images/email/spacer.gif' width='70%' height='2' alt='' border='0' />
											</td>
										</tr>
									</table>
								</div>
								<div style='text-align:left;margin:2px 15px 10px 25px; padding:0px; font-size:14px; font-family:Arial,Helvetica,sans-serif;color:#ff6600;font-weight:bold;'>
									Платные курсы (курсы партнеров Luxoft Training)
								</div>
			";
			$arResult['EMAIL']['POLOSKA_B'] .= "
							<table style='border-collapse:collapse; border:none; margin:0px;padding:0px;' width='560' cellspacing='0' cellpadding='0'>
								<tr>
									<td valign='top' width='15' height='5' class='pad_null' style='background-color:#ffffff;'>
										<img src='http://ibs-training.ru/images/email/spacer.gif' width='15' height='5' alt='' border='0'/>
									</td>
									<td width='560' height='5' class='pad_null' style='background-color:#FF6600;'>
										<img src='http://ibs-training.ru/images/email/spacer.gif' width='560' height='5' alt='' border='0'/>
									</td>
									<td width='185' height='5' class='pad_null' style='background-color:#ffffff;'>
										<img src='http://ibs-training.ru/images/email/spacer.gif' width='85' height='5' alt='' border='0'/>
									</td>
								</tr>
							</table>
							<div style='text-align:left;margin:10px 15px 10px 15px; padding:0px; font-size:14px; font-family:Arial,Helvetica,sans-serif;color:#ff6600;'>
								Платные курсы (курсы партнеров Luxoft Training)<br />
								Специально для сотрудников Luxoft цены на курсы снижены до себестоимости

							</div>
			";
		}
		//iwrite($arPossibleCities);
		$arPossibleCities = array_unique($arPossibleCities);
		$arPossibleCities[] = CITY_ID_ONLINE;
		$arPossibleCities = array_diff($arPossibleCities, array(''));
		//iwrite($arPossibleCities);
		
		
		/*
			get info about free events by ID Array of cities
		*/
		$arFilter = array("IBLOCK_ID"=>D_SEMINARS_IBLOCK, "ACTIVE"=>"Y", "PROPERTY_CITY"=>$arPossibleCities, ">=PROPERTY_STARTDATE" => date("Y-m-d"));
		$arSelectFields = array(
			"ID",
			"NAME",
			"PROPERTY_TYPE_EVENT",
			"PROPERTY_DESCRIPTION",
			"PROPERTY_TIME",
			"PROPERTY_STARTDATE",
			"PROPERTY_CITY.NAME",
			"PROPERTY_TRENER",
			"PROPERTY_LOCATION"
		);
		$res = CIBlockElement::GetList(array("PROPERTY_STARTDATE" =>"ASC"), $arFilter, false, false, $arSelectFields);

		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			$arInfoSem['ID'] = $arFields['ID'];
			$arInfoSem['NAME'] = $arFields['NAME'];
			$arInfoSem['TYPE_EVENT'] = $arFields['PROPERTY_TYPE_EVENT_VALUE'];
			$arInfoSem['DESCRIPTION'] = $arFields['PROPERTY_DESCRIPTION_VALUE'];
			$arInfoSem['TIME'] = $arFields['PROPERTY_TIME_VALUE'];				
			$arInfoSem['STARTDATE'] = $arFields['PROPERTY_STARTDATE_VALUE'];
			$arInfoSem['CITY'] = $arFields['PROPERTY_CITY_NAME'];
			$arInfoSem['TRENER_ID'] = $arFields['PROPERTY_TRENER_VALUE'];
			$arInfoSem['LOCATION'] = $arFields['PROPERTY_LOCATION_VALUE'];			
			$arSeminars[] = $arInfoSem;
		}
		//iwrite($arSeminars);
		if (count($arSeminars)>0){
			$arResult['EMAIL']['NADPIS_SEMINAR'] = "Семинары и Вебинары:";
		}
		/*
			seminars block http://ibs-training.ru/events/seminar/26271/
		*/
		$index = 0;
		foreach ($arSeminars as $arSeminar){
			$index = $index + 1;
			//$arInfo = "";
			//$arExpert= "";
			if (strlen($arSeminar['TRENER_ID'])>0){
				$arExpert = GetInfoAboutExpertByID($arSeminar['TRENER_ID']);
				$arInfo['PREPOD_TEXT'] = strlen($arSeminar['TRENER_ID']) > 0 ? "Преподаватель: <a target='_blank' style='color:#004080;text-decoration:underline;font-weight:bold;' href='http://ibs-training.ru/about/experts/".$arExpert["EXPERT_CODE"].".html'>".$arExpert['EXPERT_NAME']." ".$arExpert['EXPERT_NAME_FULL']."</a> &ndash; ".$arExpert['EXPERT_SHORT']." <br />" : "";
			} else {
				$arInfo['PREPOD_TEXT'] = "";
			}
			//iwrite($arSeminar);
			//iwrite($arInfo);
			//iwrite($arExpert);
			$arResult['EMAIL']['LIST_SEMINARS_SM'] .= "
									<li style='padding: 0; margin:0px 0px 4px 0px;font-style:normal;display:block;font-size:14px; font-family:Arial,Helvetica,sans-serif;font-weight:bold;'>
										 <span style='color:#ff6600;'>".$arSeminar['TYPE_EVENT']."</span>  <a target='_blank' style='color:#004080;' href='#s_".$arSeminar['ID']."'>".trim($arSeminar['NAME']).", ".$arSeminar["STARTDATE"]."</a>
									</li>";
			$arResult['EMAIL']['LIST_SEMINARS_B'] .= "
								<div class='l_course' style='margin:20px 0px 10px 0px;'>
									<div style='text-align:left; padding:0px; font-size:14px; font-family:Arial,Helvetica,sans-serif;font-weight:bold;'><a name='s_".$arSeminar['ID']."'></a>
										<a target='_blank' style='color:#004080;font-size:14px; text-decoration:underline;font-weight:bold;' href='http://ibs-training.ru/events/seminar/".$arSeminar['ID']."/'>".trim($arSeminar['NAME'])."</a>
									</div>
									<div style='text-align:left; padding:0px; font-size:14px; font-family:Arial,Helvetica,sans-serif;color:#454545;'>
									
									Место проведения: ".$arSeminar['LOCATION']."<br />
									Дата: <span style='color:#ff6600;font-weight:bold;'>".$arSeminar['STARTDATE'] .", ".$arSeminar['TYPE_EVENT'] ."</span><br />
									Время: ".$arSeminar['TIME']." час.<br />
								
									".$arInfo['PREPOD_TEXT']."
									
									<br />
									<div class='l_template'>
									<span style='color:#000000;font-weight:bold;'>Описание:</span><br />
									".$arSeminar['DESCRIPTION']."
									</div>
									<br />
									
									<a target='_blank' style='color:#004080;text-decoration:underline;font-weight:bold;font-size:14px;' href='http://ibs-training.ru/events/seminar/".$arSeminar['ID']."/'>Подробнее о мероприятии</a><br />
									<a target='_blank' style='color:#004080;text-decoration:underline;font-weight:bold;font-size:14px;' href='http://ibs-training.ru/events/seminar/".$arSeminar['ID']."/#form_b'>Записаться на мероприятие</a>
									
									</div>
								</div>								
			";
			
			if ($index !== count($arSeminars)){
				/*$arResult['EMAIL']['LIST_SEMINARS_B'] .= "
					<table style='border-collapse:collapse; border:none; margin:0px;padding:0px;' width='600' cellspacing='0' cellpadding='0'>
						<tr>
							<td valign='top' width='15' height='2' class='pad_null' style='background-color:#ffffff;'>
								<img src='http://ibs-training.ru/images/email/spacer.gif' width='15' height='2' alt='' border='0'/>
							</td>
							<td width='500' height='2' class='pad_null' style='background-color:#FF6600;'>
								<img src='http://ibs-training.ru/images/email/spacer.gif' width='500' height='2' alt='' border='0'/>
							</td>
							<td width='185' height='2' class='pad_null' style='background-color:#ffffff;'>
								<img src='http://ibs-training.ru/images/email/spacer.gif' width='85' height='2' alt='' border='0'/>
							</td>
						</tr>
					</table>				
				";*/
			}									
		}									
		$arResult['EMAIL']['LIST_SEMINARS_SM'].="</ul></tr></td></table>";
		
	}




	$arSendEvent =  $arResult['EMAIL'];	
	if (isset($_REQUEST['SEND_EMAIL']) and ($_REQUEST['SEND_EMAIL'] === "Y")){
		//CEvent::Send('ELEMENTS_BASKET_SEND',SITE_ID, $arSendEvent, "N", 101);
		$arQuest=getRandmonFAQ();
		$arSendEvent["QUESTION"]=$arQuest["QUESTION"];
		$answer=preg_replace('#(<div)(.+)(hidden\"><p>)(.+)#', '$1$2$3<b>Ответ: </b>$4', $arQuest["ANSWER"]);
		$arSendEvent["ANSWER"]=$answer;
		$arNews=LuxNews();
		$arSendEvent["HEADER_NEWS"]="<a style='color: #004280;' href='".$arNews["URL"]."'>".$arNews["TITLE"]."</a>";
		$arSendEvent["CONTENT_NEWS"]=$arNews["TEXT"];
		CEvent::Send('ELEMENTS_BASKET_SEND',SITE_ID, $arSendEvent, "N", 150);
		$arResult['SEND_EMAIL'] = "Y";
		
	}
	
	$this->SetResultCacheKeys(array(
		"IS_AUTHORIZED",
		"USER_ID",
		"EMAIL",
		"BASKETITEMS",
		"SEND_EMAIL"
	));

	if(!isset($arParams["ITEMS_LIMIT"])) {
	$arParams["ITEMS_LIMIT"] = 10;
}
global $USER;
if ($USER->IsAuthorized()) {
	$arResult["IS_AUTHORIZED"] = "Y";
	$arResult["USER_ID"] = CUser::GetID();	
}


$arNavParams = array();
if ($arParams["ITEMS_LIMIT"] > 0) {
	$arNavParams = array(
		"nPageSize" => $arParams["ITEMS_LIMIT"],
	);
}

	if(!CModule::IncludeModule("iblock")) {
		$this->AbortResultCache();
		ShowError("IBLOCK_MODULE_NOT_INSTALLED");
		return false;
	}	

	/*
		get all  active elements in our basket
		and put it into  $arResult['BASKETITEMS']
	*/
	$arBasketItems = array();
	$dbBasketItems = CSaleBasket::GetList(
			array(
					"NAME" => "ASC",
					"ID" => "ASC"
				),
			array(
					"FUSER_ID" => CSaleBasket::GetBasketUserID(),
					"LID" => SITE_ID,
					"ORDER_ID" => "NULL"
				),
			false,
			false,
			array("ID", "PRODUCT_ID" )
		);
	while ($arItems = $dbBasketItems->Fetch())
	{
		$arResult['PRODUCT_ID_IN_BASKET'][] = $arItems["PRODUCT_ID"];
	}
	$arResult['BASKETITEMS'] = $arResult['PRODUCT_ID_IN_BASKET'];
	
	
	
	/*
		get all  needed info by default
		and put it into  $arResult['EMAIL']
	*/	
	
	global $USER;
	$arResult['SEND_EMAIL'] = "N";
	$arResult['SHOW_INFO'] = "N";
	$arResult['EMAIL']['USER_EMAIL'] = $USER->GetEmail();
	$arResult['EMAIL']['USER_ID'] = $arResult["USER_ID"];
	$arResult['EMAIL']['LIST_COURSES_SM'] = "<table style='width: 100%' cellpadding=0 cellspacin=0 border=0><tr><td style='padding-left: 20px;'><ul style='padding-left: 0px; margin-left: 19px;'>";
	$arResult['EMAIL']['LIST_COURSES_B'] = "";
	$arResult['EMAIL']['LIST_COURSES_PARTNER_SM'] = "";
	$arResult['EMAIL']['LIST_COURSES_PARTNER_B'] = "";
	$arResult['EMAIL']['POLOSKA_SM'] = "";
	$arResult['EMAIL']['POLOSKA_B'] = "";
	$arResult['EMAIL']['LIST_SEMINARS_SM'] = "<table style='width: 100%' cellpadding=0 cellspacin=0 border=0><tr><td style='padding-left: 20px;'><ul style='padding-left: 0px; margin-left: 19px;'>";
	$arResult['EMAIL']['LIST_SEMINARS_B'] = "";
	$arResult['EMAIL']['NADPIS_SEMINAR'] = "";
	//iwrite($arResult['EMAIL']);

if ( in_array(61, $USER->GetUserGroupArray())){
	$arResult['SHOW_INFO'] = "Y";
}; 

	if ((count($arResult['BASKETITEMS'])>0) and ($_REQUEST['SEND_EMAIL'] === "Y") and (in_array(61, $USER->GetUserGroupArray()))){
//echo "PRIVED";
		$index = 0;
		$arResult['BASKETITEMS'] = GetListCoursesOfArrayByDateASC($arResult['BASKETITEMS']);
		foreach ($arResult['BASKETITEMS'] as $vIDTimetable){
			$index = $index + 1;
			$arInfo = GetFullInfoAboutCourse($vIDTimetable);
			$arPossibleCities[] = $arInfo['ID_CITY']; /*array to get active cities to show free events by these cities*/			
			if (strlen($arInfo["ENDDATE"])>0){
				$arInfo["STARTDATE"] .= " - ".$arInfo["ENDDATE"];
			}
			

				
				

					
			$arFilter = array("IBLOCK_ID"=>D_COURSE_ID_IBLOCK, "ACTIVE"=>"Y" , "ID"=>$arInfo['ID_COURSE']);
			$arSelectFields = array(
				"ID",
				"NAME",
				"PROPERTY_COURSE_CODE",
				"PROPERTY_COURSE_FORMAT",
				"PROPERTY_COURSE_DURATION",
				"PROPERTY_COURSE_AUDIENCE",
				"PROPERTY_COURSE_DESC_NEW",
				"PROPERTY_COURSE_PUPROSES",
				"PROPERTY_ID_COURSE_OWNER"
			);
			$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelectFields);

			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();
				$arInfo['COURSE_ID'] = $arFields['ID'];
				$arInfo['COURSE_NAME'] = $arFields['NAME'];
				$arInfo['COURSE_CODE'] = $arFields['PROPERTY_COURSE_CODE_VALUE'];
				$arInfo['COURSE_DURATION'] = $arFields['PROPERTY_COURSE_DURATION_VALUE'];
				$arInfo['COURSE_FORMAT_ID'] = $arFields['PROPERTY_COURSE_FORMAT_VALUE'];
				$arInfo['COURSE_DESC_NEW'] = $arFields['PROPERTY_COURSE_DESC_NEW_VALUE'];
					if ($arFields['PROPERTY_COURSE_DESC_NEW_VALUE']['TYPE']  === "text"){
						$arInfo['COURSE_DESC_NEW_VALUE'] = nl2br($arFields['~PROPERTY_COURSE_DESC_NEW_VALUE']['TEXT']);
					}
					if ($arFields['PROPERTY_COURSE_DESC_NEW_VALUE']['TYPE']  === "html"){
						$arInfo['COURSE_DESC_NEW_VALUE'] = $arFields['~PROPERTY_COURSE_DESC_NEW_VALUE']['TEXT'];
					}
					$arInfo['COURSE_DESC_NEW_VALUE'] = str_replace("<ul>","<ul style='margin:0px 0px 15px 25px; padding:0px 0px 0px 0px;'>",$arInfo['COURSE_DESC_NEW_VALUE']);
					$arInfo['COURSE_DESC_NEW_VALUE'] = str_replace("<blockquote>","<blockquote style='margin:0px; padding:0px;'>",$arInfo['COURSE_DESC_NEW_VALUE']);
				
					$arInfo['COURSE_PUPROSES'] = $arFields['~PROPERTY_COURSE_PUPROSES_VALUE']; 
					$arInfo['COURSE_PUPROSES'] = str_replace("<ul>","<ul style='margin:0px 0px 15px 25px; padding:0px 0px 0px 0px;'>",$arInfo['COURSE_PUPROSES']);
					$arInfo['COURSE_PUPROSES'] = str_replace("<blockquote>","<blockquote style='margin:0px; padding:0px;'>",$arInfo['COURSE_PUPROSES']);				
					if (strpos($arInfo['COURSE_PUPROSES'], "ul") === false) {
						$arInfo['COURSE_PUPROSES'] = nl2br($arInfo['COURSE_PUPROSES']);
					}
					$arInfo['COURSE_AUDIENCE'] = $arFields['~PROPERTY_COURSE_AUDIENCE_VALUE']; 
					$arInfo['COURSE_AUDIENCE'] = str_replace("<ul>","<ul style='margin:0px 0px 15px 25px; padding:0px 0px 0px 0px;'>",$arInfo['COURSE_AUDIENCE']);
					$arInfo['COURSE_AUDIENCE'] = str_replace("<blockquote>","<blockquote style='margin:0px; padding:0px;'>",$arInfo['COURSE_AUDIENCE']);				
					if (strpos($arInfo['COURSE_AUDIENCE'], "ul") === false) {
						$arInfo['COURSE_AUDIENCE'] = nl2br($arInfo['COURSE_AUDIENCE']);
					}
					$arInfo["ID_COURSE_OWNER"] = $arFields["PROPERTY_ID_COURSE_OWNER_ENUM_ID"];
			}
			if (strlen($arInfo['ID_TEACHER'])>0){	
				$arExpert = GetInfoAboutExpertByID($arInfo['ID_TEACHER']);
				$arInfo['PREPOD_TEXT'] = strlen($arInfo['ID_TEACHER']) > 0 ? "Преподаватель: <a target='_blank' style='color:#004080;text-decoration:underline;font-weight:bold;' href='http://ibs-training.ru/about/experts/".$arExpert["EXPERT_CODE"].".html'>".$arExpert['EXPERT_NAME']." ".$arExpert['EXPERT_NAME_FULL']."</a> &ndash; ".$arExpert['EXPERT_SHORT']." <br />" : "";
			} else {
				$arInfo['PREPOD_TEXT'] = "";
			}
			
			
			$vCurrentTemp_SM = "LIST_COURSES_SM"; /* by default */
			$vCurrentTemp_B = "LIST_COURSES_B";
			if (
				($arInfo["ID_COURSE_OWNER"] == 120) or 
				($arInfo["ID_COURSE_OWNER"] == 121) or 
				($arInfo["ID_COURSE_OWNER"] == 123)
				){
					$vCurrentTemp_SM = "LIST_COURSES_SM";
					$vCurrentTemp_B = "LIST_COURSES_B";
			}
			//iwrite($arInfo);
			if ($arInfo["ID_COURSE_OWNER"] == 122){
					$vCurrentTemp_SM = "LIST_COURSES_PARTNER_SM";
					$vCurrentTemp_B = "LIST_COURSES_PARTNER_B";
			}			
			
			
			
			

			
			
			$arResult['EMAIL'][$vCurrentTemp_SM] .= "
									<li style='padding: 0; padding: 20px 0; margin:0px 0px 4px 0px; color: #00407f;font-style:normal;display:block;font-size:14px; font-family:Arial,Helvetica,sans-serif;font-weight:bold;'>
										<a target='_blank' style='color:#00407f;' href='#c_".$arInfo['ID_TIME']."'>".trim($arInfo['COURSE_NAME']).", ".$arInfo["STARTDATE"]."</a>
									</li>";			
			$arResult['EMAIL'][$vCurrentTemp_B] .= "
								<div class='l_course' style=''>
									<div style='text-align:center; padding:0px; margin-bottom: 22px; font-size:14px; font-family:Arial,Helvetica,sans-serif;font-weight:bold;'><a name='c_".$arInfo['ID_TIME']."'></a>
										<a target='_blank' style='color:#fff; font-size:16px; display: inline-block; padding: 4px 20px; background: #f26e24; text-transform: uppercase; text-decoration:none;' href='http://ibs-training.ru/internal/catalog/".$arInfo['COURSE_CODE']."/'>&nbsp;&nbsp;&nbsp;".trim(strtoupper($arInfo['COURSE_NAME']))."&nbsp;&nbsp;&nbsp;</a>
									</div>
									<div style='text-align:left;padding:0px; font-size:14px; font-family:Arial,Helvetica,sans-serif;color:#00407f;'>
									
									Код курса: ".$arInfo['COURSE_CODE']."<br />
									Дата: <span style='color:#f26e24;font-weight:bold;'>".$arInfo['STARTDATE'] .", ".$arInfo['CITY_NAME'] ."</span><br />
									Время: <span style='color:#f26e24;font-weight:bold;'>".$arInfo["SCHEDULE_TIME"]."</span><br />
									Длительность: ".$arInfo['COURSE_DURATION']." час.<br />
									
									".$arInfo['PREPOD_TEXT']."
									
									
									<br />
									<div class='l_template'>
									<span style='color:#f26e24;font-weight:bold;'>Описание:</span><br />
									".$arInfo['COURSE_DESC_NEW_VALUE']."
									</div>
									<br /><br />
									<div class='l_template'>
									<span style='color:#f26e24;font-weight:bold;'>Цели:</span><br />
									".$arInfo['COURSE_PUPROSES']."
									</div>
									<br />
									<div class='l_template'>
									<span style='color:#f26e24;font-weight:bold;'>Целевая аудитория:</span><br />
									".$arInfo['COURSE_AUDIENCE']."
									</div>
									<br />
									<table border=0 cellpading=0 cellspacing=0 style='width: 100%;'>
										<tr>
											<td class='pad_null' width='88' style='padding: 0; width: 88px;'><img src='http://ibs-training.ru/images/email/spacer.gif' height='32' width='88' alt='' border='0'/></td>
											<td class='pad_null' style='height: 32px;  padding: 0; background: #22427c; text-align: center;'><a target='_blank' style='color:#fff;text-decoration:none; font-weight:bold;font-size:14px; font-family: Arial;' href='http://ibs-training.ru/internal/catalog/".$arInfo['COURSE_CODE']."/'>ПОДРОБНЕЕ</a></td>
											<td class='pad_null' style='padding: 0; width: 65px;'><img src='http://ibs-training.ru/images/email/spacer.gif' width='65' height='32' alt='' border='0'/></td>
											<td class='pad_null'  style='height: 32px; background: #f26e24; text-align: center;  padding: 0;'>
												<a target='_blank' style='color:#fff;text-decoration:none;font-weight:bold;font-size:14px; font-family: Arial;' href='https://inthr.luxoft.com/IntHRWebApp/aspx_PTC/CreateRequestInternal.aspx?Course=".$arInfo['COURSE_CODE']."'>ЗАПИСАТЬСЯ</a>
											</td>
											<td class='pad_null' style='padding: 0; width: 88px;'><img src='http://ibs-training.ru/images/email/spacer.gif' width='88' height='32' alt='' border='0'/></td>
										</tr>
									</table>
									</div>
								</div>								
			";
			
			if ($index !== count($arResult['BASKETITEMS'])){
				$arResult['EMAIL']['LIST_COURSES_B'] .= "
					<table style='border-collapse:collapse; border:none; margin:0px;padding:0px;' width='560' cellspacing='0' cellpadding='0'>
						<tr>
							
							<td width='560' height='10' class='pad_null' style=''>
								<img src='http://ibs-training.ru/images/email/spacer.gif' width='560' height='50' alt='' border='0'/>
							</td>
							
						</tr>
					</table>				
				";
			}
			
		}
		$arResult['EMAIL']["LIST_COURSES_SM"].="</ul></td></tr></table>";
		if (strlen($arResult['EMAIL']['LIST_COURSES_PARTNER_SM'])>0){
			$arResult['EMAIL']['POLOSKA_SM'] = "
								<div style='text-align:left;margin:0px 15px 0px 25px; padding:0px; font-family:Arial,Helvetica,sans-serif;color:#FF6600;'>
									<table style='border-collapse:collapse; border:none; margin:0px;padding:0px;' width='70%' cellspacing='0' cellpadding='0'>
										<tr>
											<td width='70%' height='2' class='pad_null' style='background-color:#FF6600;'>
												<img src='http://ibs-training.ru/images/email/spacer.gif' width='70%' height='2' alt='' border='0' />
											</td>
										</tr>
									</table>
								</div>
								<div style='text-align:left;margin:2px 15px 10px 25px; padding:0px; font-size:14px; font-family:Arial,Helvetica,sans-serif;color:#ff6600;font-weight:bold;'>
									Платные курсы (курсы партнеров Luxoft Training)
								</div>
			";
			$arResult['EMAIL']['POLOSKA_B'] .= "
							<table style='border-collapse:collapse; border:none; margin:0px;padding:0px;' width='560' cellspacing='0' cellpadding='0'>
								<tr>
									<td valign='top' width='15' height='5' class='pad_null' style='background-color:#ffffff;'>
										<img src='http://ibs-training.ru/images/email/spacer.gif' width='15' height='5' alt='' border='0'/>
									</td>
									<td width='560' height='5' class='pad_null' style='background-color:#FF6600;'>
										<img src='http://ibs-training.ru/images/email/spacer.gif' width='560' height='5' alt='' border='0'/>
									</td>
									<td width='185' height='5' class='pad_null' style='background-color:#ffffff;'>
										<img src='http://ibs-training.ru/images/email/spacer.gif' width='85' height='5' alt='' border='0'/>
									</td>
								</tr>
							</table>
							<div style='text-align:left;margin:10px 15px 10px 15px; padding:0px; font-size:14px; font-family:Arial,Helvetica,sans-serif;color:#ff6600;'>
								Платные курсы (курсы партнеров Luxoft Training)<br />
								Специально для сотрудников Luxoft цены на курсы снижены до себестоимости

							</div>
			";
		}
		//iwrite($arPossibleCities);
		$arPossibleCities = array_unique($arPossibleCities);
		$arPossibleCities[] = CITY_ID_ONLINE;
		$arPossibleCities = array_diff($arPossibleCities, array(''));
		//iwrite($arPossibleCities);
		
		
		/*
			get info about free events by ID Array of cities
		*/
		$arFilter = array("IBLOCK_ID"=>D_SEMINARS_IBLOCK, "ACTIVE"=>"Y", "PROPERTY_CITY"=>$arPossibleCities, ">=PROPERTY_STARTDATE" => date("Y-m-d"));
		$arSelectFields = array(
			"ID",
			"NAME",
			"PROPERTY_TYPE_EVENT",
			"PROPERTY_DESCRIPTION",
			"PROPERTY_TIME",
			"PROPERTY_STARTDATE",
			"PROPERTY_CITY.NAME",
			"PROPERTY_TRENER",
			"PROPERTY_LOCATION"
		);
		$res = CIBlockElement::GetList(array("PROPERTY_STARTDATE" =>"ASC"), $arFilter, false, false, $arSelectFields);

		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			$arInfoSem['ID'] = $arFields['ID'];
			$arInfoSem['NAME'] = $arFields['NAME'];
			$arInfoSem['TYPE_EVENT'] = $arFields['PROPERTY_TYPE_EVENT_VALUE'];
			$arInfoSem['DESCRIPTION'] = $arFields['PROPERTY_DESCRIPTION_VALUE'];
			$arInfoSem['TIME'] = $arFields['PROPERTY_TIME_VALUE'];				
			$arInfoSem['STARTDATE'] = $arFields['PROPERTY_STARTDATE_VALUE'];
			$arInfoSem['CITY'] = $arFields['PROPERTY_CITY_NAME'];
			$arInfoSem['TRENER_ID'] = $arFields['PROPERTY_TRENER_VALUE'];
			$arInfoSem['LOCATION'] = $arFields['PROPERTY_LOCATION_VALUE'];			
			$arSeminars[] = $arInfoSem;
		}
		//iwrite($arSeminars);
		if (count($arSeminars)>0){
			$arResult['EMAIL']['NADPIS_SEMINAR'] = "Семинары и Вебинары:";
		}
		/*
			seminars block http://ibs-training.ru/events/seminar/26271/
		*/
		$index = 0;
		foreach ($arSeminars as $arSeminar){
			$index = $index + 1;
			//$arInfo = "";
			//$arExpert= "";
			if (strlen($arSeminar['TRENER_ID'])>0){
				$arExpert = GetInfoAboutExpertByID($arSeminar['TRENER_ID']);
				$arInfo['PREPOD_TEXT'] = strlen($arSeminar['TRENER_ID']) > 0 ? "Преподаватель: <a target='_blank' style='color:#004080;text-decoration:underline;font-weight:bold;' href='http://ibs-training.ru/about/experts/".$arExpert["EXPERT_CODE"].".html'>".$arExpert['EXPERT_NAME']." ".$arExpert['EXPERT_NAME_FULL']."</a> &ndash; ".$arExpert['EXPERT_SHORT']." <br />" : "";
			} else {
				$arInfo['PREPOD_TEXT'] = "";
			}
			//iwrite($arSeminar);
			//iwrite($arInfo);
			//iwrite($arExpert);
			$arResult['EMAIL']['LIST_SEMINARS_SM'] .= "
									<li style='padding: 0; margin:0px 0px 4px 0px;font-style:normal;display:block;font-size:14px; font-family:Arial,Helvetica,sans-serif;font-weight:bold;'>
										 <span style='color:#ff6600;'>".$arSeminar['TYPE_EVENT']."</span>  <a target='_blank' style='color:#004080;' href='#s_".$arSeminar['ID']."'>".trim($arSeminar['NAME']).", ".$arSeminar["STARTDATE"]."</a>
									</li>";
			$arResult['EMAIL']['LIST_SEMINARS_B'] .= "
								<div class='l_course' style='margin:20px 0px 10px 0px;'>
									<div style='text-align:left; padding:0px; font-size:14px; font-family:Arial,Helvetica,sans-serif;font-weight:bold;'><a name='s_".$arSeminar['ID']."'></a>
										<a target='_blank' style='color:#004080;font-size:14px; text-decoration:underline;font-weight:bold;' href='http://ibs-training.ru/events/seminar/".$arSeminar['ID']."/'>".trim($arSeminar['NAME'])."</a>
									</div>
									<div style='text-align:left; padding:0px; font-size:14px; font-family:Arial,Helvetica,sans-serif;color:#454545;'>
									
									Место проведения: ".$arSeminar['LOCATION']."<br />
									Дата: <span style='color:#ff6600;font-weight:bold;'>".$arSeminar['STARTDATE'] .", ".$arSeminar['TYPE_EVENT'] ."</span><br />
									Время: ".$arSeminar['TIME']." час.<br />
								
									".$arInfo['PREPOD_TEXT']."
									
									<br />
									<div class='l_template'>
									<span style='color:#000000;font-weight:bold;'>Описание:</span><br />
									".$arSeminar['DESCRIPTION']."
									</div>
									<br />
									
									<a target='_blank' style='color:#004080;text-decoration:underline;font-weight:bold;font-size:14px;' href='http://ibs-training.ru/events/seminar/".$arSeminar['ID']."/'>Подробнее о мероприятии</a><br />
									<a target='_blank' style='color:#004080;text-decoration:underline;font-weight:bold;font-size:14px;' href='http://ibs-training.ru/events/seminar/".$arSeminar['ID']."/#form_b'>Записаться на мероприятие</a>
									
									</div>
								</div>								
			";
			
			if ($index !== count($arSeminars)){
				/*$arResult['EMAIL']['LIST_SEMINARS_B'] .= "
					<table style='border-collapse:collapse; border:none; margin:0px;padding:0px;' width='600' cellspacing='0' cellpadding='0'>
						<tr>
							<td valign='top' width='15' height='2' class='pad_null' style='background-color:#ffffff;'>
								<img src='http://ibs-training.ru/images/email/spacer.gif' width='15' height='2' alt='' border='0'/>
							</td>
							<td width='500' height='2' class='pad_null' style='background-color:#FF6600;'>
								<img src='http://ibs-training.ru/images/email/spacer.gif' width='500' height='2' alt='' border='0'/>
							</td>
							<td width='185' height='2' class='pad_null' style='background-color:#ffffff;'>
								<img src='http://ibs-training.ru/images/email/spacer.gif' width='85' height='2' alt='' border='0'/>
							</td>
						</tr>
					</table>				
				";*/
			}									
		}									
		$arResult['EMAIL']['LIST_SEMINARS_SM'].="</ul></tr></td></table>";
		
	}




	$arSendEvent =  $arResult['EMAIL'];	
	if (isset($_REQUEST['SEND_EMAIL']) and ($_REQUEST['SEND_EMAIL'] === "Y")){
		//CEvent::Send('ELEMENTS_BASKET_SEND',SITE_ID, $arSendEvent, "N", 101);
		$arQuest=getRandmonFAQ();
		$arSendEvent["QUESTION"]=$arQuest["QUESTION"];
		$answer=preg_replace('#(<div)(.+)(hidden\"><p>)(.+)#', '$1$2$3<b>Ответ: </b>$4', $arQuest["ANSWER"]);
		$arSendEvent["ANSWER"]=$answer;
		$arNews=LuxNews();
		$arSendEvent["HEADER_NEWS"]="<a style='color: #004280;' href='".$arNews["URL"]."'>".$arNews["TITLE"]."</a>";
		$arSendEvent["CONTENT_NEWS"]=$arNews["TEXT"];
		CEvent::Send('ELEMENTS_BASKET_SEND',SITE_ID, $arSendEvent, "N", 150);
		$arResult['SEND_EMAIL'] = "Y";
		
	}
	

	
	// Подключаем шаблон
	$this->IncludeComponentTemplate();

}

?>