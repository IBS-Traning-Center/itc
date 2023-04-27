<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина выбранных услуг");
?> 

<?$APPLICATION->IncludeComponent("kodix:sale.basket.basket.small", ".default", array(
	"PATH_TO_BASKET" => "/personal/cart/",
	"PATH_TO_PERSONAL" => "/personal/",
	"SHOW_PERSONAL_LINK" => "N",
	"PATH_TO_ORDER"	=>	"/personal/order/",
	),
	false
);?>

<p> Вы данной странице вы можете &quot;Оформить заказ&quot;, просмотреть корзину выбранных услуг и отредактировать ее содержимое. &quot;Оформление заказа&quot; подразумевает под собой бронирование мест на тренингах и классах в школах. </p>
<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small", ".default", array(
	"PATH_TO_BASKET" => "/personal/cart/",
	"PATH_TO_PERSONAL" => "/personal/",
	"SHOW_PERSONAL_LINK" => "N",
	"PATH_TO_ORDER"	=>	"/personal/order/",
	),
	false
);?>
<p> Вы данной странице вы можете &quot;Оформить заказ&quot;, просмотреть корзину выбранных услуг и отредактировать ее содержимое. &quot;Оформление заказа&quot; подразумевает под собой бронирование мест на тренингах и классах в школах. 
  <br />
 Для онлайн оплаты вам будет необходимо принять условия договора оферты на оказание услуг. </p>
 <?$APPLICATION->IncludeComponent(
	"bitrix:store.sale.basket.basket",
	".default",
	Array(
		"PATH_TO_ORDER" => "/personal/order/make/",
		"HIDE_COUPON" => "N",
		"COLUMNS_LIST" => array("NAME","PROPS","PRICE","TYPE","QUANTITY","DELETE","DELAY","DISCOUNT"),
		"QUANTITY_FLOAT" => "N",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "Y",
		"SET_TITLE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?>
<br />

<br />

<br />
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.small",
	"",
	Array(
		"PATH_TO_BASKET" => "/personal/basket.php",
		"PATH_TO_ORDER" => "/personal/order.php"
	),
false
);?>
<br />
nm
<br />

<br />
<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket", ".default", array(
	"COUNT_DISCOUNT_4_ALL_QUANTITY" => "Y",
	"COLUMNS_LIST" => array(
		0 => "NAME",
		1 => "PROPS",
		2 => "PRICE",
		3 => "TYPE",
		4 => "QUANTITY",
		5 => "DELETE",
		6 => "DELAY",
		7 => "WEIGHT",
		8 => "DISCOUNT",
	),
	"PATH_TO_ORDER" => "/personal/order.php",
	"HIDE_COUPON" => "N",
	"QUANTITY_FLOAT" => "N",
	"PRICE_VAT_SHOW_VALUE" => "N",
	"SET_TITLE" => "Y"
	),
	false
);?>
<br />
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>