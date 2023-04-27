<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?>
<?/*$APPLICATION->IncludeComponent("bitrix:sale.basket.basket", "new-bask", Array(
	"ACTION_VARIABLE" => "action",	// Название переменной действия
		"COLUMNS_LIST" => array(	// Выводимые колонки
			0 => "NAME",
			1 => "QUANTITY",
		),
		"COMPONENT_TEMPLATE" => ".default",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",	// Рассчитывать скидку для каждой позиции (на все количество товара)
		"GIFTS_BLOCK_TITLE" => "",
		"GIFTS_CONVERT_CURRENCY" => "Y",
		"GIFTS_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_HIDE_NOT_AVAILABLE" => "N",
		"GIFTS_MESS_BTN_BUY" => "",
		"GIFTS_MESS_BTN_DETAIL" => "",
		"GIFTS_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
		"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "Y",
		"GIFTS_TEXT_LABEL_GIFT" => "",
		"HIDE_COUPON" => "N",	// Спрятать поле ввода купона
		"OFFERS_PROPS" => array(
			0 => "SIZES_SHOES",
			1 => "SIZES_CLOTHES",
		),
		"PATH_TO_ORDER" => "/personal/order.php",	// Страница оформления заказа
		"PRICE_VAT_SHOW_VALUE" => "N",	// Отображать значение НДС
		"QUANTITY_FLOAT" => "N",	// Использовать дробное значение количества
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"TEMPLATE_THEME" => "blue",
		"USE_GIFTS" => "Y",
		"USE_PREPAYMENT" => "N",	// Использовать предавторизацию для оформления заказа (PayPal Express Checkout)
	),
	false
);?>
<?$APPLICATION->IncludeComponent("bitrix:news.list", "study-buy", Array(
	"DISPLAY_DATE" => "Y",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
		"AJAX_MODE" => "Y",	// Включить режим AJAX
		"IBLOCK_TYPE" => "edu_const",	// Тип информационного блока (используется только для проверки)
		"IBLOCK_ID" => "136",	// Код информационного блока
		"NEWS_COUNT" => "20",	// Количество новостей на странице
		"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"FILTER_NAME" => "",	// Фильтр
		"FIELD_CODE" => array(	// Поля
			0 => "ID",
			1 => "",
		),
		"PROPERTY_CODE" => array(	// Свойства
			0 => "",
			1 => "DESCRIPTION",
			2 => "",
		),
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"SET_BROWSER_TITLE" => "Y",	// Устанавливать заголовок окна браузера
		"SET_META_KEYWORDS" => "Y",	// Устанавливать ключевые слова страницы
		"SET_META_DESCRIPTION" => "Y",	// Устанавливать описание страницы
		"SET_LAST_MODIFIED" => "Y",	// Устанавливать в заголовках ответа время модификации страницы
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",	// Включать инфоблок в цепочку навигации
		"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",	// Скрывать ссылку, если нет детального описания
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"DISPLAY_TOP_PAGER" => "Y",	// Выводить над списком
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"PAGER_TITLE" => "",	// Название категорий
		"PAGER_SHOW_ALWAYS" => "Y",	// Выводить всегда
		"PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
		"PAGER_DESC_NUMBERING" => "Y",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "Y",	// Показывать ссылку "Все"
		"PAGER_BASE_LINK_ENABLE" => "Y",	// Включить обработку ссылок
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SHOW_404" => "Y",	// Показ специальной страницы
		"MESSAGE_404" => "",
		"PAGER_BASE_LINK" => "",	// Url для построения ссылок (по умолчанию - автоматически)
		"PAGER_PARAMS_NAME" => "arrPager",	// Имя массива с переменными для построения ссылок
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"COMPONENT_TEMPLATE" => ".default",
		"FILE_404" => "",	// Страница для показа (по умолчанию /404.php)
	),
	false
);*/?>
<?$textSting="Ut eget tempus tortor. In a varius nunc. Aenean viverra nisi eu magna lobortis, at pellentesque neque maximus. Ut eget erat lacinia, sodales orci ut, dapibus risus. Nulla ultrices lorem dui, in congue arcu consectetur id. Suspendisse pellentesque pretium massa. Nulla accumsan quam arcu, nec hendrerit orci efficitur sit amet. Vestibulum ac elit accumsan, maximus turpis sit amet, aliquam mi. Vivamus quis aliquet erat. Nullam ornare purus ut risus facilisis, ac hendrerit nibh ullamcorper. Mauris nec pharetra sem. Vivamus ornare, dui vitae rhoncus congue, massa augue pharetra diam, et aliquet lacus turpis ac nibh."?>
<?if (strlen($_POST["submit"])>0) {?>
	<?preg_match_all('/"(.*?)"/', $_POST["q"], $matches);?> 
	<?$searchArray = $matches[1];?>
	<?$deleteArray = $matches[0]?>
	<?$clearedString = str_replace($deleteArray, "", $_POST["q"])?>
	<?$clearedString = preg_replace("/  +/"," ",$clearedString);?> 
	<?if (strlen($clearedString)>0) {?>
		<?$searchArray=array_merge($searchArray, explode(" ", trim($clearedString)))?>
	<?}?>
	<?foreach ($searchArray as $key=>$searchItem) {?>
		<?$searchArray[$key]="#(".$searchItem.")#"?>
	<?}?>
	<?$textSting=preg_replace($searchArray, "<font color='red'>$1</font>", $textSting);?>
<?}?>
<form method="POST">
	<input type="text" style="width: 100%;" name="q" value="<?=htmlspecialchars($_POST["q"])?>"/><br/>
	<br/>
	<input type="submit" name="submit" value="Submit"/>
</form>

<hr/>
<div class="text">
	<?=$textSting?>
</div>