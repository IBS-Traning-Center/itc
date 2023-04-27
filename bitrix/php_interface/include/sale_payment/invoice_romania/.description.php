<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?><?
include(GetLangFileName(dirname(__FILE__)."/", "/bill.php"));

$psTitle = GetMessage("SBLP_DTITLE");
$psDescription = GetMessage("SBLP_DDESCR");

$arPSCorrespondence = array(
		"DATE_INSERT" => array(
				"NAME" => "Date",
				"DESCR" => "Date",
				"VALUE" => "DATE_INSERT",
				"TYPE" => "ORDER"
			),
		"BUYER_NAME" => array(
				"NAME" => "Название компании-заказчика",
				"DESCR" => "Название компании-заказчика (покупателя)",
				"VALUE" => "COMPANY_NAME",
				"TYPE" => "PROPERTY"
			),
		"BUYER_INN" => array(
				"NAME" => "ИНН компании-заказчика",
				"DESCR" => "ИНН компании-заказчика (покупателя)",
				"VALUE" => "INN",
				"TYPE" => "PROPERTY"
			),
		"BUYER_ADDRESS" => array(
				"NAME" => "Адрес компании-заказчика",
				"DESCR" => "Адрес компании-заказчика (покупателя)",
				"VALUE" => "ADDRESS",
				"TYPE" => "PROPERTY"
			),
		"BUYER_PHONE" => array(
				"NAME" => "Телефон компании-заказчика",
				"DESCR" => "Телефон компании-заказчика (покупателя)",
				"VALUE" => "PHONE",
				"TYPE" => "PROPERTY"
			),
		"BUYER_FAX" => array(
				"NAME" => "Факс компании-заказчика",
				"DESCR" => "Факс компании-заказчика (покупателя)",
				"VALUE" => "FAX",
				"TYPE" => "PROPERTY"
			),
		"BUYER_PAYER_NAME" => array(
				"NAME" => "Контактное лицо компании-заказчика",
				"DESCR" => "Контактное лицо компании-заказчика (покупателя)",
				"VALUE" => "PAYER_NAME",
				"TYPE" => "PROPERTY"
			),

		"PATH_TO_STAMP" => array(
				"NAME" => "Печать",
				"DESCR" => "Путь к изображению печати поставщика на сайте",
				"VALUE" => "",
				"TYPE" => ""
			)
	);
?>