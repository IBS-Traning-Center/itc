<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => "Отправка выбранных курсов на email",
	"DESCRIPTION" => "",
	"ICON" => "/images/menu_ext.gif",
	"SORT" => 10,
	//"CACHE_PATH" => "Y", // "Очиситить кеш компонента" в контекстном меню компонента в публичной части
	"PATH" => array(
		"ID" => "utility",
	),
	"COMPLEX" => "N", // Для комплексного компонента
	"CACHE_PATH" => "Y",
);

?>