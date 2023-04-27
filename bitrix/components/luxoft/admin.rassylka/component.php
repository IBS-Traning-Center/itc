<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?include_once($_SERVER["DOCUMENT_ROOT"]."/test/cert.php");?>
<?if (strlen($_REQUEST["send"])>0) {?>
	<?$arEmail=preg_split("#,#", $_REQUEST["email"]);?>
	<?foreach ($arEmail as $key=>$mail) {?>
		<?$rsUsers = CUser::GetList(($by="ID"), ($order="desc"), array("EMAIL"=>trim($mail)));?>
		<?if($arUser=$rsUsers->GetNext()) {
			$arCreated[]=$arUser["ID"];
		} else {?>
			<?$arNotCreated[]=trim($mail);?>
		<?}?>
	<?}?>
	<?foreach ($arNotCreated as $newMail) {?>
		<?$NEW_LOGIN = $newMail;
        $NEW_EMAIL = $newMail;
		$def_group = COption::GetOptionString("main", "new_user_registration_def_group", "");
		if($def_group!="")
        {
			$GROUP_ID = explode(",", $def_group);
			$arPolicy = $USER->GetGroupPolicy($GROUP_ID);
        } else {
            $arPolicy = $USER->GetGroupPolicy(array());
        }
        $password_min_length = intval($arPolicy["PASSWORD_LENGTH"]);
        if($password_min_length <= 0)
        $password_min_length = 6;
        $password_chars = array(
            "abcdefghijklnmopqrstuvwxyz",
            "ABCDEFGHIJKLNMOPQRSTUVWXYZ",
            "0123456789",
        );
        if($arPolicy["PASSWORD_PUNCTUATION"] === "Y")
        $password_chars[] = ",.<>/?;:'\"[]{}\|`~!@#\$%^&*()-_+=";
        $NEW_PASSWORD = $NEW_PASSWORD_CONFIRM = randString($password_min_length+2, $password_chars);
        $user = new CUser;
        $arAuthResult = $user->Add(Array(
            "LOGIN" => strtolower($NEW_EMAIL),
            "PASSWORD" => $NEW_PASSWORD,
            "PASSWORD_CONFIRM" => $NEW_PASSWORD_CONFIRM,
            "EMAIL" => strtolower($NEW_EMAIL),
            "GROUP_ID" => $GROUP_ID,
            "ACTIVE" => "Y",
            "LID" => SITE_ID,
             )
        );
		if (IntVal($arAuthResult) <= 0)
        {
            $arResult["FORM_ERRORS"] = $arResult["FORM_ERRORS"]."\n\r".$user->LAST_ERROR;
        } else {
			$arCreated[]=IntVal($arAuthResult);
			$arEventFields = array(
				"EMAIL"=> strtolower($NEW_EMAIL),
				"PASSWORD" => $NEW_PASSWORD,
				"NAME"=>"",
				"LAST_NAME"=>"",
				);
			CEvent::Send("NEW_USER_LK", SITE_ID, $arEventFields, "Y", "135");
		}
	?>
	<?}?>
	<?$nes = CIBlockElement::GetByID(intval($_REQUEST["couseid"]));
		if($ar_res = $nes->GetNextElement()) {
			$arCourseFil=$ar_res->GetFields();
			$COURSENAME=$arCourseFil['NAME'];
			if ($_REQUEST["type"]!="k") {
				$arPropFil=$ar_res->GetProperties();
				$SCH_ID=$arCourseFil["ID"];
				$DURATION=$arPropFil["schedule_duration"]["VALUE"]." ч";
				$STARTDATE=$arPropFil["startdate"]["VALUE"];
				if (strlen($arPropFil["enddate"]["VALUE"])>0) {
					$STARTDATE.=" - ".$arPropFil["enddate"]["VALUE"];
				}
				$TIME=$arPropFil["schedule_time"]["VALUE"];
				$PRICE=$arPropFil["schedule_price"]["VALUE"];
				$schedule_teacher_id=$arPropFil["teacher"]["VALUE"];
				$scheduled_city=$arPropFil["city"]["VALUE"];
				//$trener=$arPropFil["teacher"]["VALUE"];
				$schedule_teacher_string = $arItem['PROPERTIES']['string_teacher']['VALUE'];
				if  ($schedule_teacher_id > 0) {
				//теперь  получим имя преподавателя
				$arSelect = Array("NAME", "PROPERTY_expert_name", "DETAIL_PAGE_URL", "CODE", "ACTIVE");
				$arFilter = Array("IBLOCK_ID"=>56,"ID"=>$schedule_teacher_id);
				$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
				while($ar_fields = $res->GetNext())
				{	
					$PREPODNAME = $ar_fields["NAME"]." ".$ar_fields["PROPERTY_EXPERT_NAME_VALUE"];
					$PREPODNAME_WITH_LINK = "<a style='color: #039be5' href='".$ar_fields["DETAIL_PAGE_URL"]."' >".$ar_fields["NAME"]." ".$ar_fields["PROPERTY_EXPERT_NAME_VALUE"]."</a>";
				}
				
				} else {
						$PREPODNAME = $schedule_teacher_string;
						$PREPODNAME_WITH_LINK = $schedule_teacher_string;
					}
				$id_city=$scheduled_city;
				$CONTACTS="";
				if ($id_city==CITY_ID_OMSK) {
					$CONTACTS="<p>Адрес нашего офиса и схема проезда <a style='color: #039be5' href='http://ibs-training.ru/contacts/omsk.html'>http://ibs-training.ru/contacts/omsk.html</a></p>";
				} elseif ($id_city==CITY_ID_MOSCOW) {
					$CONTACTS="<p>Адрес нашего офиса и схема проезда <a style='color: #039be5' href='http://ibs-training.ru/contacts/moscow.html'>http://ibs-training.ru/contacts/moscow.html</a></p>";
				} elseif ($id_city==CITY_ID_KIEV) {
					$CONTACTS="<p>Адрес нашего офиса и схема проезда <a style='color: #039be5' href='http://ibs-training.ru/contacts/kiev.html'>http://ibs-training.ru/contacts/kiev.html</a></p>";
				} elseif ($id_city==CITY_ID_SPB) {
					$CONTACTS="<p>Адрес нашего офиса и схема проезда <a style='color: #039be5' href='http://ibs-training.ru/contacts/spb.html'>http://ibs-training.ru/contacts/spb.html</a></p>";
				} elseif ($id_city==CITY_ID_DNEPR) {
					$CONTACTS="<p>Адрес нашего офиса и схема проезда <a style='color: #039be5' href='http://ibs-training.ru/contacts/dnepr.html'>http://ibs-training.ru/contacts/dnepr.html</a></p>";
				} elseif ($id_city==CITY_ID_ODESSA) {
					$CONTACTS="<p>Адрес нашего офиса и схема проезда <a style='color: #039be5' href='http://ibs-training.ru/contacts/odessa.html'>http://ibs-training.ru/contacts/odessa.html</a></p>";
				}
				
				$arSelect = Array("PROPERTY_edu_type_money", "NAME");
				$arFilter = Array("IBLOCK_ID"=>51,"ID"=>$id_city);
				$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
				while($ar_pields = $res->GetNext()) {
					$valuta= $ar_pields["PROPERTY_EDU_TYPE_MONEY_VALUE"];
					$valuta_ENUM_ID = $ar_pields["PROPERTY_EDU_TYPE_MONEY_ENUM_ID"];
					$CITYNAME = $ar_pields["NAME"];
				}
				if ($valuta=="Рубли") {$PRICE.=" р.";} else { $PRICE.=" $";} 
			}
			
			
		}
	foreach ($arCreated as $userID) {
		$dontsend=false;
		$rsUser = CUser::GetByID($userID);
		$arUser = $rsUser->Fetch();
		$arSelect = Array("ID", "NAME", "PREVIEW_TEXT");
		$arFilter = Array("IBLOCK_ID"=>108, "PROPERTY_USER"=> $userID, "ACTIVE_DATE"=>"Y",  "ACTIVE"=>"Y");
		if ($_REQUEST["type"]=="k") {
			$arFilter["PROPERTY_COURSE"]=intval($_REQUEST["couseid"]);
		
		} else {
			$arFilter["PROPERTY_SCH_COURSE"]=intval($_REQUEST["couseid"]);
		}
		
	
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		if ($res->SelectedRowsCount()==0) {
			$el = new CIBlockElement;
			$PROP = array();
			$PROP["USER"] = intval($userID); 
			if ($_REQUEST["type"]=="k") {
				$PROP["COURSE"] = intval($_REQUEST["couseid"]);  
			} else {
				$PROP["SCH_COURSE"] = intval($_REQUEST["couseid"]);
			}

			$arLoadProductArray = Array(
			  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
			  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
			  "IBLOCK_ID"      => 108,
			  "PROPERTY_VALUES"=> $PROP,
			  "NAME"           => $PROP["USER"]."_".intval($_REQUEST["couseid"])."_".date("Y_m_d"),
			  "ACTIVE"         => "Y",            // активен
			);
			if($PRODUCT_ID = $el->Add($arLoadProductArray))
			  $PRODUCT_ID;
			else
			  echo "Error: ".$el->LAST_ERROR;
		} else {
			$arField=$res->GetNext();
			$PRODUCT_ID=$arField["ID"];
		}
		
		if ($_REQUEST["type"]=="45378") {
			CModule::IncludeModule("sale");
			CModule::IncludeModule("catalog");

			$ar_res = CPrice::GetBasePrice($_REQUEST["couseid"]);
			if ($ar_res["CURRENCY"]=="RUB") {
				$dis=$ar_res["PRICE"]*0.9*0.05;
			} elseif ($ar_res["CURRENCY"]=="GRN") {
				$dis=$ar_res["PRICE"]*0.9*3*0.05;
			} elseif ($ar_res["CURRENCY"]=="USD") {
				$dis=$ar_res["PRICE"]*0.9*35*0.05;
			}

			if (intval($dis)>0 && intval($arUser['ID'])>0) {
				CSaleUserAccount::UpdateAccount(
					$arUser['ID'],
					"+".round($dis),
					"RUB",
					"MANUAL"
				);

			}

			if ($ar = CSaleUserAccount::GetByUserID($arUser['ID'], "RUB")) {
				$bonus_string = intval($ar["CURRENT_BUDGET"])." бонусных ".getCountVal(intval($ar["CURRENT_BUDGET"]), array("балл", "балл", "балл"));
			}

			CIBlockElement::SetPropertyValuesEx($PRODUCT_ID, false, array("STATUS" => 189));

			//$filename=GenarateCert($userID, intval($_REQUEST["couseid"]));
			if (!empty($filename)) {
				CIBlockElement::SetPropertyValuesEx($PRODUCT_ID, false, array("CERT" => $filename));
			}
		} elseif ($_REQUEST["type"]=="45466") {
			CIBlockElement::SetPropertyValuesEx($PRODUCT_ID, false, array("STATUS" => 246));
		}
		
		if ($dontsend!=true) {
			$MAIL_CONTENT=$_REQUEST["mailbody"];
			$forms=array("#COURSE_NAME#", '#FIO#', "#CERT_LINK#", "#SCH_STARTDATE#", "#SCH_TIME#", "#SCH_DURATION#", "#SCH_CITY#", "#SCH_PRICE#", "#TIMETABLE_ID#", '#CONTACTS#', "#TRENER#", "#BONUS_STRING#", "#TRENER_LINK#");
			$values=array($COURSENAME, $arUser["NAME"], "http://ibs-training.ru/cert/".$filename, $STARTDATE, $TIME, $DURATION, $CITYNAME, $PRICE, $SCH_ID, $CONTACTS, $PREPODNAME, $bonus_string, $PREPODNAME_WITH_LINK);
			$MAIL_CONTENT=str_replace($forms, $values, $MAIL_CONTENT);
			$SUBJECT=str_replace($forms, $values, $_REQUEST["subject"]);
			$arEventFields = array(
				"EMAIL"=> $arUser["EMAIL"],
				"BODY" => $MAIL_CONTENT,
				"SUBJECT"=> $SUBJECT,
				);
			CEvent::Send("ADMIN_LETTER", "ru", $arEventFields);
		}
		unset($userID);
	}
	$arSelect = Array("ID", "NAME");
	$arFilter = Array("IBLOCK_ID"=>111, "PROPERTY_SCH_COURSE"=>intval($_REQUEST["couseid"]));
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	if ($ar_sields = $res->GetNext()) {
		$ELEMENT_ID=$ar_sields["ID"];
	} else {
		$PROP=array("SCH_COURSE"=>intval($_REQUEST["couseid"]));
		$pl=new CIBlockElement;
		$arLoadProductArray = Array(
			  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
			  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
			  "IBLOCK_ID"      => 111,
			  "PROPERTY_VALUES"=> $PROP,
			  "NAME"           => intval($_REQUEST["couseid"])."_".date("Y_m_d"),
			  "ACTIVE"         => "Y",            // активен
			);
			if($ELEMENT_ID = $pl->Add($arLoadProductArray)) {
			 $ELEMENT_ID;
			 } 
	}
	$prop["EMAIL_LIST"] = array('VALUE'=>array('TYPE'=>'HTML', 'TEXT'=>$_REQUEST["email"]));
	CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, 111, $prop);
	
	?>
	<?LocalRedirect($APPLICATION->GetCurDir()."?success=Y");?>
<?}?>
<?
$arSelect = Array("ID", "NAME", "PREVIEW_TEXT");
$arFilter = Array("IBLOCK_ID"=>109, "ACTIVE_DATE"=>"Y",  "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
	$arFields = $ob->GetFields();
	$arResult["rass"][$arFields["ID"]]=$arFields["NAME"];
}?>

<?
	$this->IncludeComponentTemplate();

?>