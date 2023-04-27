<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentDescription = array(
	"NAME" => GetMessage("FORGOTPASSWORD_COMPONENT"),
	"ICON" => "/images/icon.gif",
  "CACHE_PATH" => "Y",
  "SORT" => 220,
	"PATH" => array(
		"ID" => "bxmod",
		"NAME" => GetMessage("BXMOD_CAT"),
		"CHILD" => array(
			"ID" => "user",
			"NAME" => GetMessage("USER_SECTION")
		),
    "SORT" => 999
	),
);
?>