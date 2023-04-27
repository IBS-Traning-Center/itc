<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Настройки");
?>
<?if (!$USER->IsAuthorized()) {?>
<?$APPLICATION->IncludeComponent("bitrix:system.auth.form","",Array(
     "REGISTER_URL" => "register.php",
     "FORGOT_PASSWORD_URL" => "",
     "PROFILE_URL" => "profile.php",
     "SHOW_ERRORS" => "Y" 
     )
);?>
<?} else {?>
<?global $USER;
$filter = Array("ID" => $USER->GetID());
$rsUsers = CUser::GetList(($by = "NAME"), ($order = "desc"), $filter, array("SELECT"=>array("UF_AGREE_1", "UF_AGREE_2", "UF_STOPPED")));
while ($arUser = $rsUsers->Fetch()) {
  $UserNext=$arUser;
}?>
<?if ($_REQUEST["submit-first"]) {?>

	<?print_r($_REQUEST);?>
	<?$user = new CUser;
	$ID=$USER->GetID();
	if ($_REQUEST["agree-1"]=="Yes") {
		$fields["UF_AGREE_1"]="Y";
	} else {
		$fields["UF_AGREE_1"]="N";
	}
	if ($_REQUEST["agree-2"]=="Yes") {
		$fields["UF_AGREE_2"]="Y";
	} else {
		CModule::IncludeModule("subscribe");
		$subscription = CSubscription::GetByEmail($UserNext["EMAIL"]);
		if($subscription->ExtractFields("str_"))
			$s_id = (integer)$str_ID;
		else
			$s_id=0;
		if ($s_id>0) {
			$subscr = new CSubscription;
			if($subscr->Update($s_id, array("ACTIVE"=>"N"))) {
				
			}
		}

		$fields["UF_AGREE_2"]="N";
	}
	$user->Update($ID, $fields);
	LocalRedirect($APPLICATION->GetCurDir());?>
<?}?>
<?if ($_REQUEST["return-first"]) {?>
	<?$user = new CUser;?>
	<?$ID=$USER->GetID();?>
	<?$fields["UF_STOPPED"]="N";?>
	<?$user->Update($ID, $fields);
	LocalRedirect($APPLICATION->GetCurDir());?>
<?}?>
<?if ($_REQUEST["save-30"]) {?>
	<?$user = new CUser;?>
	<?$ID=$USER->GetID();?>
	<?$fields["UF_STOPPED"]="Y";?>
	<?$user->Update($ID, $fields);
	LocalRedirect($APPLICATION->GetCurDir());?>
<?}?>
<?if ($_REQUEST["delete-true"]) {?>
	<?$user = new CUser;?>
	<?$ID=$USER->GetID();?>
	<?$fields["ACTIVE"]="N";?>
	<?$user->Update($ID, $fields);
	$USER->Logout();
	LocalRedirect($APPLICATION->GetCurDir());?>
<?}?>

<div class="courses">
<div class="heading">
	<h2>Настройки пользователя</h2>
</div>
<?if ($UserNext["UF_STOPPED"]!="Y") {?>
<h3 style="font-size: 16px; font-weight: bold; margin-bottom: 10px;">Согласие на обработку персональных данных<h3>
<object data="/upload/personal_data.pdf" type="application/pdf" width="100%" height="400px;" >
   <p>Скачать <a href="/upload/personal_data.pdf">"Положение по обработке персональных данных"</a>.</p>
</object>
<?}?>
<form>
	<br/>
	<?if ($UserNext["UF_STOPPED"]!="Y") {?>
	<label><input type="checkbox" name="agree-1" <?if ($UserNext["UF_AGREE_1"]!="N") {?>checked<?}?> value="Yes"/>&nbsp;Я даю свою согласие на обработку персональных данных в целях организации и посещения тренинга.</label><br/><br/>
	<label><input type="checkbox" name="agree-2" <?if ($UserNext["UF_AGREE_2"]!="N") {?>checked<?}?> value="Yes"/>&nbsp;Я даю свое согласие на обработку персональных данных в маркетинговых целях.</label><br/><br/>
	<button type="submit" name="submit-first" value="save">Сохранить</button><br/><br/><br/><br/><br/><br/>

	<?} else {?>
	<button type="submit" name="return-first" value="save">Восстановить обработку персональных данных</button>
	<?}?>
	<button onclick="ShowDelete();return false;" name="delete-akk" value="delete">Удалить личный кабинет</button><br/>
</form>
</div>
<div class="newpopup form-first">
	<form>
	<h3>Вы уверены, что хотите приостановить обработку персональных данных?</h3>
	<p>Обратите внимание, что мы не сможем свзаться с вами и выслать приглашение и/или материалы тренинга. По истечении 30 дней личный кабинет пользователя будет удалён.<p>
	<div class="bottom-buttons">
					<button name="save-30" value="ok">Да</button>
					<a href="#" class="close">Отмена</a>
	</div>
	</form>
</div>
<div class="newpopup form-two">
	<form>
	<h3>Вы уверены, что хотите удалить личный кабинет?</h3>
	<p>Бонусные баллы, результаты тестирования и рекомендации будут утеряны.<p>
	<div class="bottom-buttons">
					<button name="delete-true" value="ok">Да</button>
					<a href="#" class="close">Отмена</a>
	</div>
	</form>
</div>

<script>
	function ShowStop() {
		$('.form-first').bPopup({
			closeClass:'close',
			positionStyle: 'absolute',
			follow: false, 
		});
		return false;
	}
	function ShowDelete() {
		$('.form-two').bPopup({
			closeClass:'close',
			positionStyle: 'absolute',
			follow: false, 
		});
	}
</script>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>