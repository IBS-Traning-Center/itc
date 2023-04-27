<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?><?$APPLICATION->IncludeComponent("bitrix:support.ticket", ".default", array(
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/support/",
	"TICKETS_PER_PAGE" => "20",
	"MESSAGES_PER_PAGE" => "10",
	"SET_PAGE_TITLE" => "Y",
	"SHOW_COUPON_FIELD" => "N",
	"SEF_URL_TEMPLATES" => array(
		"ticket_list" => "index.php",
		"ticket_edit" => "#ID#.php",
	)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>