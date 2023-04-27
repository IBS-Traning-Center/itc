<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?> <?$APPLICATION->IncludeComponent("bitrix:news.detail", "edu_ru_onewebinar", Array(
	"IBLOCK_TYPE" => "edu",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "68",	// Код информационного блока
	"ELEMENT_ID" => $_REQUEST["ID"],	// ID новости
	"ELEMENT_CODE" => "",	// Код новости
	"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
	"FIELD_CODE" => array(	// Поля
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(	// Свойства
		0 => "location",
		1 => "lecturer",
		2 => "startdate",
		3 => "enddate",
		4 => "time",
		5 => "description",
		6 => "content",
		7 => "titlefile",
		8 => "file_old",
		9 => "",
	),
	"IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#",	// URL страницы просмотра списка элементов (по умолчанию - из настроек инфоблока)
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"AJAX_OPTION_SHADOW" => "Y",	// Включить затенение
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"META_KEYWORDS" => "description",	// Установить ключевые слова страницы из свойства
	"META_DESCRIPTION" => "content",	// Установить описание страницы из свойства
	"DISPLAY_PANEL" => "N",	// Добавлять в админ. панель кнопки для данного компонента
	"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
	"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
	"USE_PERMISSIONS" => "N",	// Использовать дополнительное ограничение доступа
	"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
	"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
	"PAGER_TITLE" => "Страница",	// Название категорий
	"PAGER_TEMPLATE" => "",	// Название шаблона
	"DISPLAY_DATE" => "N",	// Выводить дату элемента
	"DISPLAY_NAME" => "Y",	// Выводить название элемента
	"DISPLAY_PICTURE" => "N",	// Выводить детальное изображение
	"DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
	"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	),
	false
);?>

<?$APPLICATION->IncludeComponent("bitrix:form.result.new", "webinar", array(
	"WEB_FORM_ID" => "8",
	"IGNORE_CUSTOM_TEMPLATE" => "N",
	"USE_EXTENDED_ERRORS" => "Y",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/mail/",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"LIST_URL" => "",
	"EDIT_URL" => "",
	"SUCCESS_URL" => "",
	"CHAIN_ITEM_TEXT" => "",
	"CHAIN_ITEM_LINK" => "",
	"VARIABLE_ALIASES" => array(
		"WEB_FORM_ID" => "WEB_FORM_ID",
		"RESULT_ID" => "RESULT_ID",
	)
	),
	false
);?>
<a name="fill_form"></a>





 <?/*$APPLICATION->IncludeComponent("edu:iblock.element.add", ".default", Array(
	"NAV_ON_PAGE"	=>	"10",
	"USE_CAPTCHA"	=>	"N",
	"USER_MESSAGE_ADD"	=>	"Спасибо. Ваша заявка была успешно добавлена",
	"USER_MESSAGE_EDIT"	=>	"",
	"DEFAULT_INPUT_SIZE"	=>	"60",
	"IBLOCK_TYPE"	=>	"edu",
	"IBLOCK_ID"	=>	"64",
	"PROPERTY_CODES"	=>	array(
		0	=>	"NAME",
		1	=>	"248",
		2	=>	"244",
		3	=>	"243",
		4	=>	"245",
		5	=>	"246",
		6	=>	"247",
		7	=>	"249",
		8	=>	"",
	),
	"PROPERTY_CODES_REQUIRED"	=>	array(
		0	=>	"246",
		1	=>	"",
	),
	"PROPERTY_CODES_HIDDEN"	=>	array(
		0	=>	"248",
		1	=>	"243",
		2	=>	"",
	),
	"PROPERTY_TYPE_EVENT"	=>	"80",
	"PROPERTY_TEXT_TO_DO"	=>	"Регистрация на данный семинар",
	"GROUPS"	=>	array(
		0	=>	"2",
	),
	"STATUS"	=>	"ANY",
	"STATUS_NEW"	=>	"N",
	"ALLOW_EDIT"	=>	"N",
	"ALLOW_DELETE"	=>	"N",
	"ELEMENT_ASSOC"	=>	"CREATED_BY",
	"MAX_USER_ENTRIES"	=>	"100000",
	"MAX_LEVELS"	=>	"100000",
	"LEVEL_LAST"	=>	"Y",
	"MAX_FILE_SIZE"	=>	"0",
	"SEF_MODE"	=>	"N",
	"SEF_FOLDER"	=>	"/events/seminar/",
	"AJAX_MODE"	=>	"Y",
	"AJAX_OPTION_SHADOW"	=>	"Y",
	"AJAX_OPTION_JUMP"	=>	"Y",
	"AJAX_OPTION_STYLE"	=>	"Y",
	"AJAX_OPTION_HISTORY"	=>	"N",
	"CUSTOM_TITLE_NAME"	=>	"Название семинара",
	"CUSTOM_TITLE_TAGS"	=>	"",
	"CUSTOM_TITLE_DATE_ACTIVE_FROM"	=>	"",
	"CUSTOM_TITLE_DATE_ACTIVE_TO"	=>	"",
	"CUSTOM_TITLE_IBLOCK_SECTION"	=>	"",
	"CUSTOM_TITLE_PREVIEW_TEXT"	=>	"",
	"CUSTOM_TITLE_PREVIEW_PICTURE"	=>	"",
	"CUSTOM_TITLE_DETAIL_TEXT"	=>	"",
	"CUSTOM_TITLE_DETAIL_PICTURE"	=>	""
	)
);*/?>
<div class="learn_more">
  <h3>Хотите узнать больше?</h3>

  <p>По всем вопросам отправьте письмо по адресу <a href="mailto:<?=EMAIL_ADDRESS?>" ><?=EMAIL_ADDRESS?></a></p>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
