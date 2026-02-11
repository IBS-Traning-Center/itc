<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order", 
	"order-lk", 
	[
		"PROP_1" => [
		],
		"PROP_3" => [
		],
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/personal/order/",
		"ORDERS_PER_PAGE" => "100",
		"PATH_TO_PAYMENT" => "/personal/order/payment/",
		"PATH_TO_BASKET" => "/personal/cart/",
		"SET_TITLE" => "Y",
		"SAVE_IN_SESSION" => "N",
		"NAV_TEMPLATE" => "arrows",
		"ALLOW_DELETE" => "Y",
		"PROPERTY_LOAD_BASKET_PROPS" => "Y",
		"BASKET_PROPERTY_FIELDS" => [
			0 => "SCHEDULE_ID",
			1 => "SCHEDULE_NAME",
			2 => "SCHEDULE_START_DATE",
			3 => "SCHEDULE_START_DATE_FORMATTED",
			4 => "SCHEDULE_END_DATE",
			5 => "SCHEDULE_END_DATE_FORMATTED",
			6 => "SCHEDULE_TIME",
			7 => "SCHEDULE_PRICE_VALUE",
			8 => "COURSE_NAME",
		],
		"DELETE_STATUS_LIST" => [
			0 => "*",
		],
		"COMPONENT_TEMPLATE" => "order-lk",
		"DETAIL_HIDE_USER_INFO" => [
		],
		"PROP_9" => [
		],
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"PATH_TO_CATALOG" => "/catalog/",
		"DISALLOW_CANCEL" => "N",
		"CUSTOM_SELECT_PROPS" => [
		],
		"HISTORIC_STATUSES" => [
			0 => "F",
		],
		"RESTRICT_CHANGE_PAYSYSTEM" => [
		],
		"REFRESH_PRICES" => "N",
		"ORDER_DEFAULT_SORT" => "STATUS",
		"ALLOW_INNER" => "N",
		"ONLY_INNER_FULL" => "N",
		"STATUS_COLOR_F" => "gray",
		"STATUS_COLOR_N" => "green",
		"STATUS_COLOR_PSEUDO_CANCELLED" => "red",
		"SEF_URL_TEMPLATES" => [
			"list" => "index.php",
			"detail" => "detail/#ID#/",
			"cancel" => "cancel/#ID#/",
		]
	],
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>