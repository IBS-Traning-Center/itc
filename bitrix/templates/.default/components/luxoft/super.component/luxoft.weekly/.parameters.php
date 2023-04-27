<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(

		
		// some parameter
		"INCLUDE_CLASSES" => array(
			"NAME" => "Включать Классы",
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"COUNT_DAYS_CLASS" => array(
			"NAME" => "Количество дней выборки для классов",
			"TYPE" => "STRING",
			"DEFAULT" => "60",
		),
		"INCLUDE_COURSES" => array(
			"NAME" => "Включать курсы",
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"COUNT_DAYS_COURSE" => array(
			"NAME" => "Количество дней начиная с котрого курсы нужно показывать",
			"TYPE" => "STRING",
			"DEFAULT" => "0",
		),
		"COUNT_DAYS_COURSE" => array(
			"NAME" => "Количество дней выборки для курсов",
			"TYPE" => "STRING",
			"DEFAULT" => "21",
		),		
		"INCLUDE_EVENTS" => array(
			"NAME" => "Включать Мероприятия",
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"COUNT_DAYS_EVENT" => array(
			"NAME" => "Количество дней выборки для семинаров",
			"TYPE" => "STRING",
			"DEFAULT" => "21",
		),		
);
?>