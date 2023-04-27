<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталог услуг");
?>   
<br />
 
<br />
 
<br />
   
<br />
 <?$APPLICATION->IncludeComponent("bitrix:catalog.element", "template1", Array(
	"IBLOCK_TYPE" => "edu",	// Тип инфо-блока
	"IBLOCK_ID" => "9",	// Инфо-блок
	"ELEMENT_ID" => $_REQUEST["ID"],	// ID элемента
	"ELEMENT_CODE" => "",	// Код элемента
	"SECTION_ID" => "0",	// ID раздела
	"SECTION_CODE" => "",	// Код раздела
	"PROPERTY_CODE" => array(	// Свойства
		0 => "course_code",
		1 => "startdate",
		2 => "",
	),
	"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
	"DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
	"BASKET_URL" => "/payment/basket.html",	// URL, ведущий на страницу с корзиной покупателя
	"ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
	"PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
	"SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
	"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
	"DISPLAY_PANEL" => "N",	// Добавлять в админ. панель кнопки для данного компонента
	"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
	"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
	"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
	"PRICE_CODE" => array(	// Тип цены
		0 => "BASE",
	),
	"USE_PRICE_COUNT" => "Y",	// Использовать вывод цен с диапазонами
	"SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
	"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
	"PRICE_VAT_SHOW_VALUE" => "N",	// Отображать значение НДС
	"LINK_IBLOCK_TYPE" => "",	// Тип инфо-блока, элементы которого связаны с текущим элементом
	"LINK_IBLOCK_ID" => "",	// ID инфо-блока, элементы которого связаны с текущим элементом
	"LINK_PROPERTY_SID" => "",	// Свойство в котором хранится связь
	"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",	// URL на страницу где будет показан список связанных элементов
	),
	false
);?> 
<br />
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>