<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<form method="POST">
	<textarea name="email_array"></textarea><br/>
	<input type="submit" name="submt" value="Загрузить адреса в базу"/>
</form>
<?if (strlen($_REQUEST["submt"])>0) {?>
	<?CModule::IncludeModule("subscribe");?>
	<?$arEmail=explode("\n", $_REQUEST["email_array"]);?>
	<?//print_r($arEmail)?>
	<?foreach ($arEmail as $mail) {?>
		<?if (strlen($mail)>3) {?>
		<?$subscr = CSubscription::GetList(
			array("ID"=>"ASC"),
			array("EMAIL"=>trim($mail))
		);
		while(($subscr_arr = $subscr->Fetch())) {
			$aEmail[] = $subscr_arr["ID"];
			echo "<pre>";
			$aSubscrRub=array();
			$aSubscrRub = CSubscription::GetRubricArray($subscr_arr["ID"]);
			if (!in_array(61, $aSubscrRub)) {
				echo $mail;
				$ar=array(61);
				$arRub=array_merge($aSubscrRub, $ar);
				print_r($arRub);
				$subscrUp = new CSubscription;
				if($subscrUp->Update($subscr_arr["ID"], array("RUB_ID"=>$arRub, "ACTIVE"=>"Y"))) {
					echo "OK";
				}
			}
			
			echo "</pre>";
		}
		?>
		<?}?>
	<?}?>
<?}?>

 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>