<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мои заказы");
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
<div class="courses">
<?$APPLICATION->IncludeComponent("bitrix:sale.personal.order", "list", array(
	"PROP_1" => array(
	),
	"PROP_3" => array(
	),
	"PROP_2" => array(
	),
	"PROP_4" => array(
	),
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/personal_test/orders/",
	"ORDERS_PER_PAGE" => "10",
	"PATH_TO_PAYMENT" => "/personal_test/orders/payment/",
	"PATH_TO_BASKET" => "/cart/",
	"SET_TITLE" => "Y",
	"SAVE_IN_SESSION" => "N",
	"NAV_TEMPLATE" => "arrows"
	),
	false
);?>
</div>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>