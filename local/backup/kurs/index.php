<?
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("");
$APPLICATION->SetPageProperty("DONT_SHOW_PAGE_TOP", "Y");
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_after.php");
?>
<?$APPLICATION->IncludeComponent(
			"luxoft:sef.comp",
			"",
			Array(
			),
			false
			);?>
<?GLOBAL $COURSE_ID;?>
<?global $arCourseInfoID;?>
<?$arCourseInfoID = $APPLICATION->IncludeComponent(
    "artions:course.info",
    ".default",
    Array(
        "IBLOCK_TYPE" => "edu",
        "IBLOCK_ID" => "6",
        "ELEMENT_ID" => $COURSE_ID,
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_NOTES" => ""
    ),
    false
);?>

<div class="bg-main-wrap" style="background: url('/static/images/course-bg.jpg') center;     background-size: cover;">
		<div class="frame">

			<?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"bread",
	array(
		"START_FROM" => "1",
		"PATH" => "",
		"SITE_ID" => "-",
		"COMPONENT_TEMPLATE" => "bread"
	),
	false
);?>


			<?$arSelect = Array("ID", "NAME", "PROPERTY_short_descr", "CODE");
			$arFilter = Array("ID"=>$COURSE_ID);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();
				$arInfo=$arFields;

			}?>
			<div class="clearfix heading-white">
				<h1><?=$arInfo["NAME"]?></h1>
			</div>
			<?/*if ($USER->IsAdmin()) {?>
				<?print_r($arInfo);?>
			<?}*/?>
			<?if (stristr($arInfo["CODE"], "ATLA")) {?>
			<div class="attlassian-frame clearfix">
			<?}?>
			<div class="course-info">
				<?=$arInfo["PROPERTY_SHORT_DESCR_VALUE"]?>
			</div>
			<?if (stristr($arInfo["CODE"], "ATLA")) {?>
			<a class="attlassian" target="_blank" href="/images/Atlassian-horizontal-white@2x-rgb.png"><img src="/images/atlassian-horizontal.png"></a></div>
			<?}?>
			<a class="sign-in scroll" href="#register">Записаться на курс</a>
		</div>
</div>
<section id="banner" class="banner-main-page"><?$APPLICATION->IncludeComponent(
    "bitrix:advertising.banner",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "TYPE" => "COURSE",
        "NOINDEX" => "Y",
        "QUANTITY" => "1",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "0"
    ),
    false
    );?></section>
<div class="not-main-page height-inner">
			<div class="scroll-menu-shadow sticky-nav">
				<div class="frame scroll-menu no-top-padding clearfix">
					<ul class="menu-third mobile-hidden">
						<li><a class="scroll" href="#description">Описание</a></li>
						<li><a class="scroll" href="#goals">Цели</a></li>
						<li><a class="scroll" href="#themes">Разбираемые темы</a></li>
						<li><a class="scroll" href="#auditory">Целевая аудитория</a></li>
						<li><a class="scroll" href="#trainer">Тренер</a></li>
						<li><a class="scroll" href="#timetable-inn">Расписание и цены</a></li>
						<?if  ($arCourseInfoID['COUNT_FEEDBACK']>0){?>
							<li><a class="scroll" href="#testimonials">Отзывы</a></li>
						<?}?>
					</ul>
					<div class="dropdown-flex">
						<div class="simple-select"><a class="title dropdown-link" href="#">Описание <i class="fa fa-caret-down" aria-hidden="true"></i></a><ul class="dropdown"><li><a href="#description">Описание</a></li><li><a href="#goals">Цели</a></li><li><a href="#trainer">Тренер</a></li><li><a href="#timetable-inn">Расписание</a></li><li><a href="#testimonials">Отзывы</a></li></ul></div>
					</div>
					<div class="sign-up-wrapper">
						<a class="sign-in small scroll" href="#register">Записаться на курс</a>
					</div>
				</div>
			</div>
	</div>
<?$ElementID = $APPLICATION->IncludeComponent(
				"bitrix:news.detail",
				"course.new.v3",
				array(
					"IBLOCK_TYPE" => "edu",
					"IBLOCK_ID" => "6",
					"ELEMENT_ID" => $COURSE_ID,
					"ELEMENT_CODE" => "",
					"CHECK_DATES" => "N",
					"FIELD_CODE" => array(
						0 => "PREVIEW_PICTURE",
						1 => "",
					),
					"PROPERTY_CODE" => array(
						0 => "course_code",
						1 => "course_price",
						2 => "course_language",
						3 => "course_duration",
						4 => "course_type",
						5 => "course_puproses",
						6 => "course_audience",
						7 => "course_trainers",
						8 => "course_owner",
						9 => "course_addsources",
						10 => "course_requirements",
						11 => "course_other",
						12 => "course_filename",
						13 => "course_top",
						14 => "course_topics",
						15 => "course_description",
						16 => "course_required",
						17 => "course_linkedcourses",
						18 => "REDIRECT_URL",
					),
					"IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"CACHE_TYPE" => "N",
					"CACHE_TIME" => "3600",
					"CACHE_GROUPS" => "Y",
					"META_KEYWORDS" => "-",
					"META_DESCRIPTION" => "-",
					"BROWSER_TITLE" => "-",
					"SET_TITLE" => "N",
					"SET_STATUS_404" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"ADD_SECTIONS_CHAIN" => "N",
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"USE_PERMISSIONS" => "N",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"PAGER_TITLE" => "Страница",
					"PAGER_TEMPLATE" => "",
					"PAGER_SHOW_ALL" => "Y",
					"DISPLAY_DATE" => "N",
					"DISPLAY_NAME" => "Y",
					"DISPLAY_PICTURE" => "N",
					"DISPLAY_PREVIEW_TEXT" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"COMPONENT_TEMPLATE" => "course.new.v3",
					"DETAIL_URL" => "",
					"SET_CANONICAL_URL" => "N",
					"SET_BROWSER_TITLE" => "Y",
					"SET_META_KEYWORDS" => "Y",
					"SET_META_DESCRIPTION" => "Y",
					"SET_LAST_MODIFIED" => "N",
					"ADD_ELEMENT_CHAIN" => "N",
					"PAGER_BASE_LINK_ENABLE" => "N",
					"SHOW_404" => "N",
					"MESSAGE_404" => ""
				),
				false
			);?>
<?if(!$ElementID) LocalRedirect("/training/katalog_kursov/", false, "301 Moved permanently");?>
<?$APPLICATION->IncludeComponent(
    "luxoft:sef.comp",
    "",
    Array(
    ),
    false
);?>

<?$data  = date("Y-m-d H:i:s");?>
<?$GLOBALS["arrFilter"] =array("ACTIVE" => "Y" ,">=PROPERTY_startdate" => $data, "=PROPERTY_schedule_course" => $COURSE_ID,  "!=PROPERTY_IS_CLOSE" => 136);?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"list.courses.timetable.byid_dis1",
	array(
		"IBLOCK_TYPE" => "edu",
		"IBLOCK_ID" => "9",
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "PROPERTY_city",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "PROPERTY_startdate",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrFilter",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "prschedule_startdate",
			2 => "prschedule_enddate",
			3 => "prschedule_time",
			4 => "prschedule_desc",
			5 => "",
		),
		"CHECK_DATES" => "N",
		"DETAIL_URL" => "/edu/catalog/course.html?ID=#ELEMENT_ID#",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "360000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "list.courses.timetable.byid_dis1",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>









<?//echo "<!--".print_r($arCourseInfoID["SHOW_ONE_PRICE"])."-->"?>
<?//print_r($arCourseInfoID['COUNT_FEEDBACK'])?>
<?if  ($arCourseInfoID['COUNT_FEEDBACK']>0){?>

 <? $GLOBALS["arrFilter"] =array("ACTIVE" => "Y","=PROPERTY_course" => $COURSE_ID); ?>
 <?$APPLICATION->IncludeComponent("bitrix:news.list", "course.feedback", Array(
	"IBLOCK_TYPE" => "edu",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "61",	// Код информационного блока
	"NEWS_COUNT" => "8",	// Количество новостей на странице
	"SORT_BY1" => "RAND",	// Поле для первой сортировки новостей
	"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
	"SORT_BY2" => "ACTIVE_FROM",	// Поле для второй сортировки новостей
	"SORT_ORDER2" => "DESC",	// Направление для второй сортировки новостей
	"FILTER_NAME" => "arrFilter",	// Фильтр
	"FIELD_CODE" => array(	// Поля
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(	// Свойства
		0 => "",
		1 => "name",
		2 => "surname",
		3 => "review",
		4 => "cource_code",
		5 => "featured",
		6 => "",
	),
	"CHECK_DATES" => "N",	// Показывать только активные на данный момент элементы
	"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "360000",	// Время кеширования (сек.)
	"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
	"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
	"DISPLAY_PANEL" => "N",
	"SET_TITLE" => "N",	// Устанавливать заголовок страницы
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
	"PARENT_SECTION" => "",	// ID раздела
	"PARENT_SECTION_CODE" => "",	// Код раздела
	"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
	"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
	"PAGER_TITLE" => "",	// Название категорий
	"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
	"PAGER_TEMPLATE" => "",	// Название шаблона
	"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
	"DISPLAY_DATE" => "N",	// Выводить дату элемента
	"DISPLAY_NAME" => "N",	// Выводить название элемента
	"DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
	"DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
	"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	),
	false
);?>
<?} ?>
<?$ElementID=$APPLICATION->IncludeComponent("bitrix:news.detail", "course.new.rec", Array(
	"IBLOCK_TYPE" => "edu",	// Тип информационного блока (используется только для проверки)
		"IBLOCK_ID" => "6",	// Код информационного блока
		"ELEMENT_ID" => $COURSE_ID,	// ID новости
		"ELEMENT_CODE" => "",	// Код новости
		"CHECK_DATES" => "N",	// Показывать только активные на данный момент элементы
		"FIELD_CODE" => array(	// Поля
			0 => "PREVIEW_PICTURE",
			1 => "",
		),
		"PROPERTY_CODE" => array(	// Свойства
			0 => "course_code",
			1 => "course_price",
			2 => "course_language",
			3 => "course_duration",
			4 => "course_type",
			5 => "course_puproses",
			6 => "course_audience",
			7 => "course_trainers",
			8 => "course_owner",
			9 => "course_addsources",
			10 => "course_requirements",
			11 => "course_other",
			12 => "course_filename",
			13 => "course_top",
			14 => "course_topics",
			15 => "course_description",
			16 => "course_required",
			17 => "course_linkedcourses",
			18 => "",
		),
		"IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#",	// URL страницы просмотра списка элементов (по умолчанию - из настроек инфоблока)
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"CACHE_TYPE" => "N",	// Тип кеширования
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
		"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
		"BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"USE_PERMISSIONS" => "N",	// Использовать дополнительное ограничение доступа
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"PAGER_TITLE" => "Страница",	// Название категорий
		"PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
		"PAGER_SHOW_ALL" => "Y",	// Показывать ссылку "Все"
		"DISPLAY_DATE" => "N",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"COMPONENT_TEMPLATE" => "course.new.v3",
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"SET_CANONICAL_URL" => "N",	// Устанавливать канонический URL
		"SET_BROWSER_TITLE" => "Y",	// Устанавливать заголовок окна браузера
		"SET_META_KEYWORDS" => "Y",	// Устанавливать ключевые слова страницы
		"SET_META_DESCRIPTION" => "Y",	// Устанавливать описание страницы
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"ADD_ELEMENT_CHAIN" => "N",	// Включать название элемента в цепочку навигации
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"SHOW_404" => "N",	// Показ специальной страницы
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
	),
	false
);?>
<?//if  ($arCourseInfoID['COUNT_TIMETABLE_COURSE']>0){?>


	<?global  $arEventInfo;?>

    <?$APPLICATION->IncludeComponent("edu:iblock.element.add.form.course", "course.new.single", Array(
	"IBLOCK_TYPE" => "edu",	// Тип инфо-блока
	"IBLOCK_ID" => "64",	// Инфо-блок
	"STATUS_NEW" => "N",	// Деактивировать элемент
	"LIST_URL" => "",	// Страница со списком своих элементов
	"USE_CAPTCHA" => "N",	// Использовать CAPTCHA
	"USER_MESSAGE_EDIT" => "",	// Сообщение об успешном сохранении
	"USER_MESSAGE_ADD" => "Спасибо. Ваша заявка была успешно добавлена",	// Сообщение об успешном добавлении
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
		12 => "811",
		13 => "812",
		14 => "813",
	),
	"PROPERTY_CODES_REQUIRED" => array(	// Свойства, обязательные для заполнения
		1 => "246",
		2 => "245",
		3 => "247",
		4 => "249",
		12 => "811",
		13 => "812",
	),
	"PROPERTY_CODES_HIDDEN" => array(	// Поля, которые недоступны для заполнения пользователю:
		0 => "248",
		1 => "243",
		2 => "271",
		3 => "313",
		4 => "244"
	),
	"PROPERTY_TYPE_EVENT" => "78",	// Тип события
	"PROPERTY_TEXT_TO_DO" => "Регистрация на данный курс",	// Надпись
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
	"CUSTOM_TITLE_NAME" => "Название курса",	// * наименование *
	"CUSTOM_TITLE_TAGS" => "",	// * теги *
	"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",	// * дата начала *
	"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",	// * дата завершения *
	"CUSTOM_TITLE_IBLOCK_SECTION" => "",	// * раздел инфоблока *
	"CUSTOM_TITLE_PREVIEW_TEXT" => "",	// * текст анонса *
	"CUSTOM_TITLE_PREVIEW_PICTURE" => "",	// * картинка анонса *
	"CUSTOM_TITLE_DETAIL_TEXT" => "",	// * подробный текст *
	"CUSTOM_TITLE_DETAIL_PICTURE" => "",	// * подробная картинка *
	"ANCHOR_PARAMETER" => "register",
	"URL_FORM_PARAMETER" => "?SCHEDULE=Y",
	"SHOW_CITIES" => "N"
	),
	false
);?>

	<?/*if  ($arCourseInfoID['COUNT_TIMETABLE_COURSE']>0){?>
	<h2>Оплату курса Вы можете осуществить одним из двух способов:</h2>
	<blockquote>
	<ul>
	<li>Добавьте курс в корзину и оплатите его одним из предложенных вариантов, выбрав оплату от Физического лица (квитанция СБЕРБАНКА, банковская карта, WebMoney, Яндекс.Деньги, QIWI Кошелек) или от Юридического лица с выставлением счета-оферты.</li>
	<li>Либо <a style="font-size: 13px;" href="#reg" class="ajax_link">заполните форму</a>, расположенную выше на данной странице. </li>
	</ul>
	</blockquote>
	<br />
	<?}*/?>



<?//} ?>
<?/*
<[tab id="fill_form" name="Регистрация"]>

<?if  ($arCourseInfoID['COUNT_TIMETABLE_COURSE']>0){?>
	<p>Выбранный Вами курс стоит в расписании (см. вкладку «Курс в расписании»). Если Вас устраивает место и время проведения тренинга, просим зарегистрироваться в данной вкладке. </p>
	<p>Если Вас не устраивает город и дата его проведения, Вы можете оставить заявку на участие в нем в любом из городов, где представлены филиалы Luxoft Training. Для этого заполните форму ниже. После этого с Вами свяжется менеджер Luxoft Training и проинформирует об изменениях.</p>
<? } ?>
<?if  (!$arCourseInfoID['COUNT_TIMETABLE_COURSE']>0){?>
	<p>На данный момент выбранный Вами курс не стоит в расписании, но Вы можете оставить заявку на участие в нем в любом из городов, где представлены филиалы Luxoft Training. В этом случае с Вами свяжется менеджер Luxoft Training и проинформирует об изменениях.</p>
<? } ?>



 <?$APPLICATION->IncludeComponent("edu:iblock.element.add.form.course", "course.new", array(
	"IBLOCK_TYPE" => "edu",
	"IBLOCK_ID" => "64",
	"STATUS_NEW" => "N",
	"LIST_URL" => "",
	"USE_CAPTCHA" => "N",
	"USER_MESSAGE_EDIT" => "",
	"USER_MESSAGE_ADD" => "Спасибо. Ваша заявка была успешно добавлена",
	"DEFAULT_INPUT_SIZE" => "60",
	"PROPERTY_CODES" => array(
		0 => "NAME",
		1 => "248",
		2 => "244",
		3 => "246",
		4 => "245",
		5 => "247",
		6 => "249",
		7 => "345",
		8 => "407",
	),
	"PROPERTY_CODES_REQUIRED" => array(
		0 => "244",
		1 => "246",
		2 => "245",
		3 => "247",
		4 => "249",
	),
	"PROPERTY_CODES_HIDDEN" => array(
		0 => "248",
		1 => "407",
	),
	"PROPERTY_TYPE_EVENT" => "78",
	"PROPERTY_TEXT_TO_DO" => "Регистрация на данный курс",
	"PROPERTY_EVENT_NAME" => "",
	"PROPERTY_EVENT_CITY_IN" => "",
	"PROPERTY_EVENT_DATE_IN" => "",
	"GROUPS" => array(
		0 => "2",
	),
	"STATUS" => "ANY",
	"ELEMENT_ASSOC" => "CREATED_BY",
	"MAX_USER_ENTRIES" => "100000",
	"MAX_LEVELS" => "100000",
	"LEVEL_LAST" => "Y",
	"MAX_FILE_SIZE" => "0",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/training/catalog/",
	"CUSTOM_TITLE_NAME" => "Название курса",
	"CUSTOM_TITLE_TAGS" => "",
	"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
	"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
	"CUSTOM_TITLE_IBLOCK_SECTION" => "",
	"CUSTOM_TITLE_PREVIEW_TEXT" => "",
	"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
	"CUSTOM_TITLE_DETAIL_TEXT" => "",
	"CUSTOM_TITLE_DETAIL_PICTURE" => "",
	"ANCHOR_PARAMETER" => "tab-fill_form-link",
	"SHOW_CITIES" => "Y",
    "URL_FORM_PARAMETER" => "?INCITY=Y",
	),
	false
);?>

<a name="fill_form"></a>

*/?>


<?GLOBAL $arCourseInfoID?>
<?
//$APPLICATION->AddChainItem("Открытое обучение", "/training/");
$APPLICATION->AddChainItem("Каталог курсов", "/training/katalog_kursov/");
if (strlen($arCourseInfoID["SECTION_INFO"]["NAME"])>0) {
	$APPLICATION->AddChainItem($arCourseInfoID["SECTION_INFO"]["NAME"], "/training/katalog_kursov/".$arCourseInfoID["SECTION_INFO"]["CODE"]."/");
}
$APPLICATION->AddChainItem($arCourseInfoID["TIMETABLE_INFO"][0]["COURSE_NAME"], "");
?>
<script type="text/javascript">
$(document).ready(function(){
	var currentHash;
	currentHash = window.location.hash.slice(1);
	if (currentHash === 'reg') {
		$('#reg-button').trigger('click');
		console.info(currentHash);

	}

})
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
