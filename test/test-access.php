<?
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Доступ к тесту");
$APPLICATION->SetPageProperty("blue_title", "Доступ к тесту");
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_after.php");
?>
<?if ($_REQUEST["success"]=="Y") {?>
	<h2>Доступ предоставлен!</h2>
	<br/>
	<br/>
<?}?>
<form>
	<input style="width: 100%;" type="text" name="email" placeholder="Email"/><br/><br/>
	<select name="course">
		<option value="46">Анатлитик в IT</option>
		<option value="45">Java 7</option>
	</select><br/>
	<input type="submit" name="submit-form" class="sign-in" value="Отправить"/>
</form>
<br/>
<br/>
<br/>
<?if (strlen($_REQUEST["submit-form"])>0 && strlen($_REQUEST["email"])>0 ) {?>
	<?$rsUsers = CUser::GetList(($by="ID"), ($order="desc"), array("EMAIL"=>trim($_REQUEST["email"])));?>
	<?if($arUser=$rsUsers->GetNext()) {
			$USER_ID=$arUser["ID"];
			$arSendFields["NAME"]=$arUser["LOGIN"];
			$arSendFields["EMAIL"]=$arUser["EMAIL"];
		} else {
			$NEW_LOGIN = trim($_REQUEST["email"]);
			$NEW_EMAIL = trim($_REQUEST["email"]);
			$arSendFields["NAME"]=trim($_REQUEST["email"]);
			$arSendFields["EMAIL"]=trim($_REQUEST["email"]);
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
				$USER_ID = IntVal($arAuthResult);
				CEvent::Send("NEW_USER_LK", SITE_ID, $arEventFields, "Y", "135");
			}
			
		}?>
	<?print_r($USER_ID);?>
	
	<?if (CModule::IncludeModule("learning"))
        {
            $COURSE_ID = $_REQUEST["course"];
            $arGroup=GetGroupByCode("test_".$COURSE_ID);
			$GROUP_ID=$arGroup["ID"];
			print_r($GROUP_ID);
						$res = CUser::GetUserGroupList($USER_ID);
						while ($arGroup = $res->Fetch()){
							$arUserGroups[]=$arGroup["GROUP_ID"];
							//print "<pre>"; print_r($arGroup); print "</pre>";
						}
						$arUserGroups[]=$GROUP_ID;
						CUser::SetUserGroup($USER_ID, $arUserGroups);
			$res = CTest::GetList(
                Array("SORT"=>"ASC"),
                Array("ACTIVE" => "Y", "COURSE_ID" => $COURSE_ID, "CHECK_PERMISSIONS"=> "N")
            );
            if ($arTest = $res->GetNext())
                {
                            //echo "Test id: ".$arTest["ID"]."<br>";
                            $TEST_ID=$arTest["ID"];

                            $arSendFields["TEST_LINK"]='http://ibs-training.ru/training/testing/'.$COURSE_ID.'/'.$arTest["ID"].'/';
                            $arSendFields["TEST_NAME"]=$arTest["NAME"];
							print_r($arSendFields);
							CEvent::Send("TEST_SALE", SITE_ID, $arSendFields);
							LocalRedirect($APPLICATION->GetCurPage()."?success=Y");
                        }
          }?>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>