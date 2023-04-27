<?$APPLICATION->SetPageProperty("title", $arResult["TEST"]["NAME"]);?>
<?if ($arResult["NON_AUTHORIZED"]=="Y") {?>
	<div class="test-align">
	<?$APPLICATION->IncludeComponent("bitrix:system.auth.form","test-auth",Array(
     "REGISTER_URL" => "register.php",
     "FORGOT_PASSWORD_URL" => "",
     "PROFILE_URL" => "profile.php",
     "SHOW_ERRORS" => "Y" 
     )
	);?>
	</div>
<?}?>