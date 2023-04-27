<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?><?
include(GetLangFileName(dirname(__FILE__)."/", "/payment.php"));

$psTitle = GetMessage("SPCP_DTITLE");
$psDescription = GetMessage("SPCP_DDESCR");

$arPSCorrespondence = array(
		"type" => array(
			"NAME" => "Type of person",
				"DESCR" => '', 
				"TYPE" => "SELECT",
				"VALUE" => array (
					"person" => array(
						"NAME" => "Person",
					),
					"company" => array(
						"NAME" => "Company",
					),
				
				)
		),
		"signature" => array(
				"NAME" => "Signature",
				"DESCR" => "",
				"VALUE" => "",
				"TYPE" => ""
			),
		"certPath" => array(
				"NAME" => "Path to public certificate",
				"DESCR" => "",
				"VALUE" => "",
				"TYPE" => ""
			),
		"firstName" => array(
				"NAME" => "First Name",
				"DESCR" => '',
				"VALUE" => "",
				"TYPE" => ""
			),
		"lastName" => array(
				"NAME" => "Last name",
				"DESCR" => '',
				"VALUE" => "",
				"TYPE" => ""
			),
		"fiscalNumber" => array(
				"NAME" => "Fiscal number",
				"DESCR" => '',
				"VALUE" => "",
				"TYPE" => ""
		),
		"identityNumber" => array(
				"NAME" => "Identity Number",
				"DESCR" => '',
				"VALUE" => "",
				"TYPE" => ""
		),
		"country" => array(
				"NAME" => "Country",
				"DESCR" => '',
				"VALUE" => "",
				"TYPE" => ""
		),
		"county" => array(
				"NAME" => "County",
				"DESCR" => '',
				"VALUE" => "",
				"TYPE" => ""
		),
		"city" => array(
				"NAME" => "City",
				"DESCR" => '',
				"VALUE" => "",
				"TYPE" => ""
		),
		"zip_code" => array(
				"NAME" => "Zip code",
				"DESCR" => '',
				"VALUE" => "",
				"TYPE" => ""
		),
		"address" => array(
				"NAME" => "Address",
				"DESCR" => '',
				"VALUE" => "",
				"TYPE" => ""
		),
		"email" => array(
				"NAME" => "E-mail",
				"DESCR" => '',
				"VALUE" => "EMAIL",
				"TYPE" => "PROPERTY"
		),
		"mobilePhone" => array(
				"NAME" => "Mobile Phone",
				"DESCR" => '',
				"VALUE" => "",
				"TYPE" => ""
		),
		"bank" => array(
				"NAME" => "Bank",
				"DESCR" => '',
				"VALUE" => "",
				"TYPE" => "PROPERTY"
		),
		"iban" => array (
			"NAME" => "Iban",
			"DESCR" => '',
			"VALUE" => "",
			"TYPE" => "PROPERTY"
		
		),
		"SHOULD_PAY" => array(
				"NAME" => "Summ to pay",
				"DESCR" => '',
				"VALUE" => "",
				"TYPE" => ""
			),
		"DATE_INSERT" => array(
				"NAME" => GetMessage("DATE_INSERT"),
				"DESCR" => GetMessage("DATE_INSERT_DESCR"),
				"VALUE" => "",
				"TYPE" => ""
			),
		
		
		
		"CHANGE_STATUS_PAY" => array(
				"NAME" => GetMessage("PYM_CHANGE_STATUS_PAY"),
				"DESCR" => GetMessage("PYM_CHANGE_STATUS_PAY_DESC"),
				"VALUE" => "Y",
				"TYPE" => ""
			),
		"IS_TEST" => array(
				"NAME" => GetMessage("PYM_TEST"),
				"DESCR" => GetMessage("PYM_TEST_DESC"),
				"VALUE" => "Y",
				"TYPE" => ""
			),
	);
?>
