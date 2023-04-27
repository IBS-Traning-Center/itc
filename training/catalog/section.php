<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталог курсов");
?><?$APPLICATION->IncludeComponent(
	"luxoft:super.component",
	"newcatalog.courses.bysection",
	Array(
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600",
		"SECTION_ID" => "{$_REQUEST['SECTION_ID']}",
		"SECTION_CODE" => "{$_REQUEST['SECTION_CODE']}"
		)
);?>

<? if (isset($_REQUEST["IN_CITY"])){?>
<br />
<a name="reg"></a>

<?$APPLICATION->IncludeComponent("edu:iblock.element.add.form", "edu_training.classes", Array(
	"IBLOCK_TYPE" => "edu",	// Тип инфо-блока
	"IBLOCK_ID" => "64",	// Инфо-блок
	"STATUS_NEW" => "N",	// Деактивировать элемент
	"LIST_URL" => "",	// Страница со списком своих элементов
	"USE_CAPTCHA" => "N",	// Использовать CAPTCHA
	"USER_MESSAGE_EDIT" => "",	// Сообщение об успешном сохранении
	"USER_MESSAGE_ADD" => "Спасибо. Ваша заявка на класс была успешно добавлена",	// Сообщение об успешном добавлении
	"DEFAULT_INPUT_SIZE" => "60",	// Размер полей ввода
	"PROPERTY_CODES" => array(	// Свойства, выводимые на редактирование
		0 => "NAME",
		1 => "248",
		2 => "244",
		3 => "246",
		4 => "243",
		5 => "245",
		6 => "247",
		7 => "249",
		8 => "271",
		9 => "313",
		10 => "345",
		11 => "407",
	),
	"PROPERTY_CODES_REQUIRED" => array(	// Свойства, обязательные для заполнения
		0 => "244",
		1 => "246",
		2 => "245",
		3 => "247",
		4 => "249",
	),
	"PROPERTY_CODES_HIDDEN" => array(	// Поля, которые недоступны для заполнения пользователю:
		0 => "248",
		1 => "243",
		2 => "271",
		3 => "313",
		4 => "407",
	),
	"PROPERTY_TYPE_EVENT" => "79",	// Тип события
	"PROPERTY_TEXT_TO_DO" => "Записаться в класс",	// Надпись
	"PROPERTY_EVENT_NAME" => "",	// Название мероприятия (если точно известно)
	"PROPERTY_EVENT_CITY_IN" => "",	// Город ивента (если точно известен)
	"PROPERTY_EVENT_DATE_IN" => "",	// Дата (если точна известна)
	"GROUPS" => array(	// Группы пользователей, имеющие право на добавление/редактирование
		0 => "2",
	),
	"STATUS" => "ANY",	// Редактирование возможно
	"ELEMENT_ASSOC" => "CREATED_BY",	// Привязка к пользователю
	"MAX_USER_ENTRIES" => "100000",	// Ограничить кол-во элементов для одного пользователя
	"MAX_LEVELS" => "100000",	// Ограничить кол-во рубрик, в которые можно добавлять элемент
	"LEVEL_LAST" => "Y",	// Разрешить добавление только на последний уровень рубрикатора
	"MAX_FILE_SIZE" => "0",	// Максимальный размер загружаемых файлов, байт (0 - не ограничивать)
	"SEF_MODE" => "N",	// Включить поддержку ЧПУ
	"SEF_FOLDER" => "/training/catalog/",	// Каталог ЧПУ (относительно корня сайта)
	"CUSTOM_TITLE_NAME" => "Название класса",	// * наименование *
	"CUSTOM_TITLE_TAGS" => "",	// * теги *
	"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",	// * дата начала *
	"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",	// * дата завершения *
	"CUSTOM_TITLE_IBLOCK_SECTION" => "",	// * раздел инфоблока *
	"CUSTOM_TITLE_PREVIEW_TEXT" => "",	// * текст анонса *
	"CUSTOM_TITLE_PREVIEW_PICTURE" => "",	// * картинка анонса *
	"CUSTOM_TITLE_DETAIL_TEXT" => "",	// * подробный текст *
	"CUSTOM_TITLE_DETAIL_PICTURE" => "",	// * подробная картинка *
	),
	false
);?>
<? } ?>


<div class="learn_more">
  <h3>Хотите узнать больше?</h3>
 	По всем вопросам отправьте письмо по адресу <a href="mailto:<?=EMAIL_ADDRESS?>"><?=EMAIL_ADDRESS?></a> </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
