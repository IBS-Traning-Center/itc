<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("blue_title", "Мастер-классы IT-гуру");
$APPLICATION->SetPageProperty("title", "Мастер-классы IT-гуру");
$APPLICATION->SetPageProperty("keywords", "эксперт по тестированию, аналитик эксперт, консультант по разработке");
$APPLICATION->SetPageProperty("description", "Опыт и практика лучших  тренеров по программированию, тестированию, анализу требований и управлению проектами.");
$APPLICATION->SetTitle("Мастер-классы IT-гуру");
?><section class="bg-main-wrap" style="background: url('/static/images/mc.jpg') center 0; background-size: cover;">
		<div class="frame">
			<div class="breadcrumbs clearfix">
				<a class="breadcrumb-item" href="/">Главная</a> 
				<a class="breadcrumb-item" href="#">Мастер-классы IT-гуру</a>
			</div>
			<div class="clearfix heading-white">
				<h1>Мастер-классы IT-гуру</h1>
			</div>
			<div class="heading-text">
				Уже несколько лет IBS Training Center организовывает мастер-классы с экспертами мирового уровня – звёздами IT-сферы. Именно они определяют, каким будет то или иное направление в сфере разработки ПО завтра. Мы проводим тренинги не просто продвинутого, а по-настоящему экспертного уровня: тренды, фишки, новинки и все самое интересное из сферы IT.
			</div>
		</div>
		<?/*
		<div class="bg-addittion">
			<div class="frame">
				<div class="mc-date">19 ноября, Москва</div>
				<div class="mc-name">ПРАКТИЧЕСКИЙ СЕМИНАР ПО СОЗДАНИЮ ЭВОЛЮЦИОННОЙ АРХИТЕКТУРЫ ПО</div>
				<div class="mc-trainer">НИЛ ФОРД</div>
				<a class="sign-in" href="/master-class/ford/">Подробнее</a>
			</div>
		</div>
		*/?>
</section>
<section class="not-main-page white overflow-hidden" id="middle-content">
		<div class="frame">
			<div class="guru-heading">Прошедшие мероприятия</div>
	<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"guru.list",
	array(
		"IBLOCK_TYPE" => "edu",
		"IBLOCK_ID" => "121",
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "PROPERTY_DATE_LAST_EVENT",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrFilter",
		"FIELD_CODE" => array(
			0 => "DETAIL_PICTURE",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "expert_name",
			1 => "expert_short",
			2 => "expert_title",
			3 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "/about/experts/#CODE#.html",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
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
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Экперты и тренеры",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "guru.list",
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
<div class="exp-heading">
				Фото с мероприятий:
			</div>	

</div>


<?$APPLICATION->IncludeComponent("bitrix:news.detail", "master-class-galery", Array(
	"DISPLAY_DATE" => "Y",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить детальное изображение
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
		"USE_SHARE" => "Y",	// Отображать панель соц. закладок
		"SHARE_HIDE" => "N",	// Не раскрывать панель соц. закладок по умолчанию
		"SHARE_TEMPLATE" => "",	// Шаблон компонента панели соц. закладок
		"SHARE_HANDLERS" => array(	// Используемые соц. закладки и сети
			0 => "delicious",
		),
		"SHARE_SHORTEN_URL_LOGIN" => "",	// Логин для bit.ly
		"SHARE_SHORTEN_URL_KEY" => "",	// Ключ для для bit.ly
		"AJAX_MODE" => "Y",	// Включить режим AJAX
		"IBLOCK_TYPE" => "edu_const",	// Тип информационного блока (используется только для проверки)
		"IBLOCK_ID" => "153",	// Код информационного блока
		"ELEMENT_ID" => "75832",	// ID новости
		"ELEMENT_CODE" => "",	// Код новости
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"FIELD_CODE" => array(	// Поля
			0 => "ID",
		),
		"PROPERTY_CODE" => array(	// Свойства
			0 => "DESCRIPTION",
		),
		"IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",	// URL страницы просмотра списка элементов (по умолчанию - из настроек инфоблока)
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"SET_CANONICAL_URL" => "Y",	// Устанавливать канонический URL
		"SET_BROWSER_TITLE" => "Y",	// Устанавливать заголовок окна браузера
		"BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
		"SET_META_KEYWORDS" => "Y",	// Устанавливать ключевые слова страницы
		"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
		"SET_META_DESCRIPTION" => "Y",	// Устанавливать описание страницы
		"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
		"SET_STATUS_404" => "Y",	// Устанавливать статус 404
		"SET_LAST_MODIFIED" => "Y",	// Устанавливать в заголовках ответа время модификации страницы
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",	// Включать инфоблок в цепочку навигации
		"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
		"ADD_ELEMENT_CHAIN" => "N",	// Включать название элемента в цепочку навигации
		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"USE_PERMISSIONS" => "Y",	// Использовать дополнительное ограничение доступа
		"GROUP_PERMISSIONS" => array(	// Группы пользователей, имеющие доступ к детальной информации
			0 => "1",
			1 => "2",
		),
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"DISPLAY_TOP_PAGER" => "Y",	// Выводить над списком
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"PAGER_TITLE" => "Страница",	// Название категорий
		"PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
		"PAGER_SHOW_ALL" => "Y",	// Показывать ссылку "Все"
		"PAGER_BASE_LINK_ENABLE" => "Y",	// Включить обработку ссылок
		"SHOW_404" => "Y",	// Показ специальной страницы
		"MESSAGE_404" => "",
		"STRICT_SECTION_CHECK" => "Y",
		"PAGER_BASE_LINK" => "",	// Url для построения ссылок (по умолчанию - автоматически)
		"PAGER_PARAMS_NAME" => "arrPager",	// Имя массива с переменными для построения ссылок
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	),
	false
);?>

<?/*
<div class="links"><a class="" href="/about/treners/">Другие преподаватели</a></div>
*/?>
 <?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>