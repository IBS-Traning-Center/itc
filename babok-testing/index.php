<?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<?$APPLICATION->ShowHeadStrings()?>
<?$APPLICATION->ShowHeadScripts()?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Тесты для подготовки к сдаче экзамена для сертификации IIBA</title>
	<meta name="viewport" content="width=1024">
	<meta name="description" content="Тест, разработанный в стиле экзаменационных вопросов IIBA. Для того чтобы максимально приблизить ситуацию к реальному процессу экзаменационного тестирования">
    <!--[if IE]>
        <script>
            document.createElement('header');
			document.createElement('footer');
        </script>
    <![endif]-->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/style.css?ceh=31233356" media="screen">
	<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
	<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script type="text/javascript" src="js/script.js?test=1133"></script>
	<script type="text/javascript">
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-9384348-1', 'auto');
	  ga('send', 'pageview');
	</script>
</head>
<body>
	<div id="top-section">
		<div class="blue-line">
		</div>
		<div class="header">
			<div class="frame clearfix">
				<div class="logo">
					<a href="/"><img src="/images/logo_152.png"/></a>
				</div>
				<ul class="nav main clearfix">
					<li><a href="#tests">Тест</a></li>
					<li><a href="#stoim">Стоимость</a></li>
					<li><a href="#comp">О проекте</a></li>
				</ul>
			</div>
		</div>
		<div class='top-content'>
			<div class="frame clearfix">
				<div class="image-penc-wrap"></div>
				<div class="top-info">
					<h1>Тест для подготовки к сдаче экзамена<br/> для сертификации IIBA</h1>
					<p>Тест, разработанный в стиле экзаменационных вопросов IIBA. Для того чтобы максимально приблизить ситуацию к реальному процессу экзаменационного тестирования, все материалы представлены на английском языке.</p>
				</div>
			</div>
		</div>
	</div>
	<?
	CModule::IncludeModule("iblock");
	$arSelect = Array("ID", "NAME", "IBLOCK_ID");
	$arFilter = Array("IBLOCK_ID"=> 138, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		$arProperties = $ob->GetProperties();

		foreach ($arProperties["ROLES"]["VALUE_ENUM_ID"] as $key=>$ROLE_ID) {
			if (!in_array($arProperties["ROLES"]["VALUE_ENUM_ID"][$key], $arResult["ROLES_ALL"])) {
				$arResult["ROLES_ALL"][]=$arProperties["ROLES"]["VALUE_ENUM_ID"][$key];
				$arResult["ROLES"][$arProperties["ROLES"]["VALUE_ENUM_ID"][$key]]=array("VALUE"=> $arProperties["ROLES"]["VALUE"][$key], "ID"=> $arProperties["ROLES"]["VALUE_ENUM_ID"][$key]);
			}
		}

		foreach ($arProperties["TECHNOLOGY"]["VALUE_ENUM_ID"] as $key=>$TECH_ID) {
			if (!in_array($arProperties["TECHNOLOGY"]["VALUE_ENUM_ID"][$key], $arResult["TECHNOLOGY_ALL"])) {
				$arResult["TECHNOLOGY_ALL"][]=$arProperties["TECHNOLOGY"]["VALUE_ENUM_ID"][$key];
				$arResult["TECHNOLOGY"][$arProperties["TECHNOLOGY"]["VALUE_ENUM_ID"][$key]]=array("VALUE"=> $arProperties["TECHNOLOGY"]["VALUE"][$key], "ID"=> $arProperties["TECHNOLOGY"]["VALUE_ENUM_ID"][$key]);
			}
		}
		/*if (!in_array($arFields["PROPERTY_TECHNOLOGY_ENUM_ID"], $arResult["TECHNLOGY_ALL"])) {
			$arResult["TECHNLOGY_ALL"][]=$arFields["PROPERTY_ROLES_ENUM_ID"];
			$arResult["TECHNLOGY"][]=array("VALUE"=> $arFields["PROPERTY_TECHNOLOGY_ENUM_ID"], "ID"=> $arFields["PROPERTY_ROLES_VALUE"]);
		}*/


	}
	/*echo "<pre>";
	print_r($arResult["TECHNOLOGY"]);
	echo "</pre>";*/
	?>
	<form>
	<div id="tests" class="role-section">
		<div class="frame">
			<ul class="nav tabs-nav center">
				<li class='active'><a href="#roles">Темы</a></li>
				<?/*<li><a href="#directions">Технологии</a></li>*/?>
			</ul>
			<input type="hidden" name="AJAX" value="Y"/>
			<div id="roles" class="type-list center">
				<?foreach ($arResult["ROLES"] as $ROLE) {?>
					<a data-check="#checkbox_<?=$ROLE["ID"]?>" id="ch_<?=$ROLE["ID"]?>" href="#"><?=$ROLE["VALUE"]?></a>
					<input id="checkbox_<?=$ROLE["ID"]?>" type="checkbox" style="display: none;" name="ROLES[]" value="<?=$ROLE["ID"]?>"/>
				<?}?>
			</div>
			<div id="directions" class="type-list center hidden">
				<?foreach ($arResult["TECHNOLOGY"] as $TECHNOLOGY) {?>
					<a data-check="#checkbox_<?=$TECHNOLOGY["ID"]?>" id="ch_<?=$TECHNOLOGY["ID"]?>" href="#"><?=$TECHNOLOGY["VALUE"]?></a>
					<input id="checkbox_<?=$TECHNOLOGY["ID"]?>" type="checkbox" style="display: none;" name="TECHNOLOGY[]" value="<?=$TECHNOLOGY["ID"]?>"/>
				<?}?>

			</div>

		</div>
	</div>
	<script>
		$(document).ready(function() {

		})
	</script>

	<div class="items-section">
		<div class="frame">
			<div class="center search-form">
				<input class="search-inp" type="text" name="text" placeholder="Поиск по названию" value=""/>
			</div>
			<div class="change-wrap">
				<?if ($_REQUEST["AJAX"]=="Y") {?>
					<?$APPLICATION->RestartBuffer();?>
				<?}?>
				<?$RUTEXT=$_REQUEST["text"];?>
				<?if (count($_REQUEST["ROLES"])>0) {?>
				<div class="selected-role center">
					Роль: <?foreach ($_REQUEST["ROLES"] as $ROLE) {?><div class="role-sel"><?=$arResult["ROLES"][$ROLE]["VALUE"]?><a data-click="#ch_<?=$ROLE?>" class="close" href="#"></a></div><?}?>
				</div>
				<?}?>

				<?if (count($_REQUEST["TECHNOLOGY"])>0) {?>
				<div class="selected-role center">
					Технологии: <?foreach ($_REQUEST["TECHNOLOGY"] as $TECHNOLOGY) {?><div class="role-sel"><?=$arResult["TECHNOLOGY"][$TECHNOLOGY]["VALUE"]?><a data-click="#ch_<?=$TECHNOLOGY?>" class="close" href="#"></a></div><?}?>
				</div>
				<?}?>
				<?GLOBAL $arrFilter?>

				<?$arrFilter[]=array("LOGIC"=> "OR", array("PROPERTY_ROLES"=>$_REQUEST["ROLES"]), array("PROPERTY_TECHNOLOGY"=>$_REQUEST["TECHNOLOGY"]))?>
				<?//$arrFilter=array()?>
				<?if (strlen($RUTEXT)>0) {?>
					<?$arrFilter["NAME"]= "%".$RUTEXT."%";?>
				<?}?>
				<?$APPLICATION->IncludeComponent("bitrix:news.list", "study-buy", Array(
						"DISPLAY_DATE" => "Y",	// Выводить дату элемента
						"DISPLAY_NAME" => "Y",	// Выводить название элемента
						"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
						"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
						"AJAX_MODE" => "Y",	// Включить режим AJAX
						"IBLOCK_TYPE" => "edu_const",	// Тип информационного блока (используется только для проверки)
						"IBLOCK_ID" => "138",	// Код информационного блока
						"NEWS_COUNT" => "20",	// Количество новостей на странице
						"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
						"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
						"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
						"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
						"FILTER_NAME" => "arrFilter",	// Фильтр
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
						"CACHE_TYPE" => "N",	// Тип кеширования
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
				);?>
				<?/*
				<div class="selected-items">
					<div class="items-line clearfix">
						<div class="test-item">
								<div class="text-name">
									Нотация UML
								</div>
								<div class="buy-wrapper clearfix">
									<a class="buy-link" href="#">Купить</a>
									<a class="buy-more-info" href="#show-1">Подробнее</a>
								</div>

						</div>
						<div class="test-item">
							<div class="text-name">
								Базовые понятия моделирования
							</div>
							<div class="buy-wrapper clearfix">
								<a class="buy-link" href="#">Купить</a>
								<a class="buy-more-info" href="#show-2">Подробнее</a>
							</div>
						</div>
						<div class="test-item">
							<div class="text-name">
								Техники моделирования
							</div>
							<div class="buy-wrapper clearfix">
								<a class="buy-link" href="#">Купить</a>
								<a class="buy-more-info" href="#show-3">Подробнее</a>
							</div>
						</div>
						<div class="test-item">
							<div class="text-name">
								Моделирование бизнес процессов
							</div>
							<div class="buy-wrapper clearfix">
								<a class="buy-link" href="#">Купить</a>
								<a class="buy-more-info" href="#show-4">Подробнее</a>
							</div>
						</div>
					</div>
					<div class="items-description hidden-wrap">
						<div class="close-wrapper">
							<a class="close-button" href="#"></a>
						</div>
						<div class="tabs" id="show-1">
							<div class="tab-content">
								<h2>Нотация UML</h2>
								<h3>Введение в тест UML</h3>
								<p>Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс</p>
								<h3>Заголовок</h3>
								<p>Текст тектс. Текст текст тетст. Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс</p>
								<h4>Cписок: </h4>
								<ul>
									<li>Повышение</li>
									<li>Сокращение</li>
									<li>Поставка</li>
								</ul>
							</div>
							<div class="additional-content">
								<img src="images/cert-icon.jpg"/>
								<p>Тест разработан на основе профессиональных <a href="#">стандартов</a> Российской Федерации</p>
								<a class="btn blue-big" href="#">Пройти тест</a>
							</div>
						</div>
						<div class="tabs" id="show-2"><div class="tab-content">
								<h2>Другой Тест</h2>
								<h3>Введение в тест UML</h3>
								<p>Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс</p>
								<h3>Заголовок</h3>
								<p>Текст тектс. Текст текст тетст. Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс</p>
								<h4>Cписок: </h4>
								<ul>
									<li>Повышение</li>
									<li>Сокращение</li>
									<li>Поставка</li>
								</ul>
							</div>
							<div class="additional-content">
								<img src="images/cert-icon.jpg"/>
								<p>Тест разработан на основе профессиональных <a href="#">стандартов</a> Российской Федерации</p>
								<a class="btn blue-big" href="#">Пройти тест</a>
							</div></div>
						<div class="tabs" id="show-3">
							<div class="tab-content">
								<h2>3-ий тест</h2>
								<h3>Введение в тест UML</h3>
								<p>Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс</p>
								<h3>Заголовок</h3>
								<p>Текст тектс. Текст текст тетст. Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс</p>
								<h4>Cписок: </h4>
								<ul>
									<li>Повышение</li>
									<li>Сокращение</li>
									<li>Поставка</li>
								</ul>
							</div>
							<div class="additional-content">
								<img src="images/cert-icon.jpg"/>
								<p>Тест разработан на основе профессиональных <a href="#">стандартов</a> Российской Федерации</p>
								<a class="btn blue-big" href="#">Пройти тест</a>
							</div>
						</div>
						<div class="tabs" id="show-4">ТЕСТ 4</div>
					</div>
					<div class="items-line clearfix">
						<div class="test-item">
							<div class="text-name">
								Нотация UML
							</div>
							<div class="buy-wrapper clearfix">
								<a class="buy-link" href="#">Купить</a>
								<a class="buy-more-info" href="#show-5">Подробнее</a>
							</div>
						</div>
						<div class="test-item">
							<div class="text-name">
								Базовые понятия моделирования
							</div>
							<div class="buy-wrapper clearfix">
								<a class="buy-link" href="#">Купить</a>
								<a class="buy-more-info" href="#show-6">Подробнее</a>
							</div>
						</div>
						<div class="test-item">
							<div class="text-name">
								Техники моделирования
							</div>
							<div class="buy-wrapper clearfix">
								<a class="buy-link" href="#">Купить</a>
								<a class="buy-more-info" href="#show-7">Подробнее</a>
							</div>
						</div>
						<div class="test-item">
							<div class="text-name">
								Моделирование бизнес процессов
							</div>
							<div class="buy-wrapper clearfix">
								<a class="buy-link" href="#">Купить</a>
								<a class="buy-more-info" href="#show-8">Подробнее</a>
							</div>
						</div>
					</div>
					<div class="items-description hidden-wrap">
						<div class="close-wrapper">
							<a class="close-button" href="#"></a>
						</div>
						<div class="tabs" id="show-5">
							<div class="tab-content">
								<h2>Нотация UML</h2>
								<h3>Введение в тест UML</h3>
								<p>Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс</p>
								<h3>Заголовок</h3>
								<p>Текст тектс. Текст текст тетст. Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс</p>
								<h4>Cписок: </h4>
								<ul>
									<li>Повышение</li>
									<li>Сокращение</li>
									<li>Поставка</li>
								</ul>
							</div>
							<div class="additional-content">
								<img src="images/cert-icon.jpg"/>
								<p>Тест разработан на основе профессиональных <a href="#">стандартов</a> Российской Федерации</p>
								<a class="btn blue-big" href="#">Пройти тест</a>
							</div>
						</div>
						<div class="tabs" id="show-6"><div class="tab-content">
								<h2>Другой Тест</h2>
								<h3>Введение в тест UML</h3>
								<p>Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс</p>
								<h3>Заголовок</h3>
								<p>Текст тектс. Текст текст тетст. Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс</p>
								<h4>Cписок: </h4>
								<ul>
									<li>Повышение</li>
									<li>Сокращение</li>
									<li>Поставка</li>
								</ul>
							</div>
							<div class="additional-content">
								<img src="images/cert-icon.jpg"/>
								<p>Тест разработан на основе профессиональных <a href="#">стандартов</a> Российской Федерации</p>
								<a class="btn blue-big" href="#">Пройти тест</a>
							</div></div>
						<div class="tabs" id="show-7">
							<div class="tab-content">
								<h2>3-ий тест</h2>
								<h3>Введение в тест UML</h3>
								<p>Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс</p>
								<h3>Заголовок</h3>
								<p>Текст тектс. Текст текст тетст. Текст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектсТекст текст тектс Текст текст тектс Текст текст тектс Текст текст тектс</p>
								<h4>Cписок: </h4>
								<ul>
									<li>Повышение</li>
									<li>Сокращение</li>
									<li>Поставка</li>
								</ul>
							</div>
							<div class="additional-content">
								<img src="images/cert-icon.jpg"/>
								<p>Тест разработан на основе профессиональных <a href="#">стандартов</a> Российской Федерации</p>
								<a class="btn blue-big" href="#">Пройти тест</a>
							</div>
						</div>
						<div class="tabs" id="show-8">ТЕСТ 4</div>
					</div>

				</div>
				<?/*
				<div class="center">
					<div class="frame">
						<a href="#" class="show-more-link">Показать больше тестов</a>
					</div>
				</div>*/?>
				<?if ($_REQUEST["AJAX"]=="Y") {?>
					<?die;?>
				<?}?>
			</div>
		</div>
	</div>
	</form>
	<div class="price-order" id='stoim'>
		<div class="frame">
			<h2 class="center">Стоимость тестирования</h2>
			<div class="three-column clearfix">
				<div class="column">
					<div class="column-content">
						<div class="column-heading">
							Купить тест
						</div>
						<div class="column-text">
							<p>Используйте калькулятор для просчета стоимости:</p>
							<div class="slider-it">
								<div class="sl-header">
									Количество тестов:
								</div>
								<div id="slider">
								</div>
							</div>
							<div class="slider-it">
								<div class="sl-header">
									Количество попыток:
								</div>
								<div id="slider_1">
								</div>
							</div>
							<div class="sl-info">
								<div class="sl-info-p">Количество тестов: <span class="slider_count"></span></div>
								<div class="sl-info-p">Количество попыток: <span class="slider_1_count"></span></div>
							</div>
							<div class="big-price">
								<span>998</span> р.
							</div>
						</div>
						<br/>
						По вопросам оплаты пишите на <a href="mailto:<?=EMAIL_ADDRESS?>"><?=EMAIL_ADDRESS?></a>
					</div>

				</div>
<?/*
				<div class="column">
					<div class="column-content">
						<div class="column-heading">
							Разработка кастомизированного <br/>теста для вашей компании
						</div>
						<div class="column-text">
							<div class="biggest-price">
								от 48000 <span>р.</span>
							</div>
							<p>Стоимость расчитывается в зависимости от сроков разработки, количества компетенций и вопросов в каждом блоке курса</p>
						</div>

						<div class="btn-link">
							<a href="#" class="btn">Оставить заявку</a>
						</div>

					</div>
				</div>
<?*/?>
				<div class="column">
					<div class="column-content">
						<div class="column-heading">
							Заказать обратный звонок
						</div>
						<div class="column-text">
						<p>Закажите обратный звонок, и наш менеджер свяжется с вами в ближайшее время</p>
						<div class="callback-form">
							<?$APPLICATION->IncludeComponent("bitrix:form.result.new", "form-lands-new", Array(
	"WEB_FORM_ID" => "7",	// ID веб-формы
		"IGNORE_CUSTOM_TEMPLATE" => "Y",	// Игнорировать свой шаблон
		"USE_EXTENDED_ERRORS" => "Y",	// Использовать расширенный вывод сообщений об ошибках
		"SEF_MODE" => "N",	// Включить поддержку ЧПУ
		"SEF_FOLDER" => "/",	// Каталог ЧПУ (относительно корня сайта)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"LIST_URL" => "result_list.php",	// Страница со списком результатов
		"EDIT_URL" => "result_edit.php",	// Страница редактирования результата
		"SUCCESS_URL" => "",	// Страница с сообщением об успешной отправке
		"CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
		"CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="comp" class="company-info">
		<div  class="frame">
			<h2 class="center">О проекте</h2>
			<img class="image-logo-info"src="/images/logo_152.png"/>
			<div class="company-info-content">
				<p></p>
				<p>Luxoft Training является первым авторизованным IIBA учебным провайдером в России. С 2014 года мы помогаем бизнес-аналитикам в России, странах СНГ и Восточной Европы накапливать часы профессионального развития для прохождения сертификаций CBAP/CBBA. Мы понимаем, как важно быть подготовленным и успешно сдать сертификационный экзамен с первого раза, поэтому мы готовы делиться с Вами нашими знаниями, опытом и профессиональными разработками.
<br/>
				<br/>Наши тренеры делятся своим опытом сдачи сертификационного экзамена:
<br/><a  href="/blog/expertse/391.html?sphrase_id=2682538">Денис Гобов</a>    <a href="/blog/expertse/528.html">Яков Ушаков</a>

				</p>

				<h3>Почему Luxoft Training</h3>
				<p>Luxoft Training - лидер в области обучения и консалтинга по важнейшим дисциплинам Software Engineering. У нас самый большой выбор курсов, самые глубокие и продвинутые знания, подтверждённые богатым опытом в разработке ПО, а главное - это самый большой пул экспертов-практиков из Luxoft, которые готовы поделиться практическим опытом.</p>
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="frame">
			<a target="_blank" href="/oferta_luxoft.doc">Публичная оферта</a>
			<a target="_blank" href="https://ibs-training.ru/about/news/78943/">Условия покупки на сайте</a>
		</div>
	</div>
	<div class="basket-line">
		<div class="fixed-basket">
			<?if ($_REQUEST["AJAX_TWO"]=="Y") {?>
				<?$APPLICATION->RestartBuffer();?>
			<?}?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:sale.basket.basket",
				"new-bask",
				Array(
					"ACTION_VARIABLE" => "action",
					"COLUMNS_LIST" => array("NAME", "QUANTITY", "SUM", "DELETE"),
					"COMPONENT_TEMPLATE" => ".default",
					"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
					"GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
					"GIFTS_CONVERT_CURRENCY" => "Y",
					"GIFTS_HIDE_BLOCK_TITLE" => "N",
					"GIFTS_HIDE_NOT_AVAILABLE" => "N",
					"GIFTS_MESS_BTN_BUY" => "Выбрать",
					"GIFTS_MESS_BTN_DETAIL" => "Подробнее",
					"GIFTS_PAGE_ELEMENT_COUNT" => "4",
					"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
					"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "",
					"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
					"GIFTS_SHOW_IMAGE" => "Y",
					"GIFTS_SHOW_NAME" => "Y",
					"GIFTS_SHOW_OLD_PRICE" => "Y",
					"GIFTS_TEXT_LABEL_GIFT" => "Подарок",
					"HIDE_COUPON" => "N",
					"OFFERS_PROPS" => array("SIZES_SHOES","SIZES_CLOTHES"),
					"PATH_TO_ORDER" => "/personal/order/make/",
					"PRICE_VAT_SHOW_VALUE" => "N",
					"QUANTITY_FLOAT" => "N",
					"SET_TITLE" => "Y",
					"TEMPLATE_THEME" => "blue",
					"USE_GIFTS" => "Y",
					"USE_PREPAYMENT" => "N"
				)
			);?>
			<?if ($_REQUEST["AJAX_TWO"]=="Y") {?>
				<?die;?>
			<?}?>
			<?/*
			<div class="frame">
				<div class="clearfix">
					<div class="basket-heading">
						Выбранные тесты (2)
					</div>
					<div class="basket-right">
						<div class="summ">Сумма:</div> <div class="summ-line">4800<span class="rub">р.</span></div>
						<a class="btn btn-buy">Купить</a>
					</div>
				</div>
				<div class="basket-grid-table">
					<div class="heading clearfix">
						<div class="action-col"></div>
						<div class="name-col">Название</div>
						<div class="quant-col">Кол-во попыток</div>
						<div class="stoim-col">Стоимость</div>
					</div>
					<div class="bask-line clearfix">
						<div class="action-col"><a class="delete-icon" href="#"></a></div>
						<div class="name-col">Техники моделирования</div>
						<div class="quant-col clearfix"><a href="#">-</a><input value="1" type="text"/><a href="#">+</a></div>
						<div class="stoim-col">1500<span>р.</span></div>
					</div>
					<div class="bask-line clearfix">
						<div class="action-col"><a class="delete-icon" href="#"></a></div>
						<div class="name-col">UML UML UML</div>
						<div class="quant-col clearfix"><a href="#">-</a><input value="1" type="text"/><a href="#">+</a></div>
						<div class="stoim-col">3300<span>р.</span></div>
					</div>
					<div class="all-sum-wrap clearfix">
						<div class="action-col"></div>
						<div class="name-col"></div>
						<div class="quant-col">
							<div class="summ">Сумма:</div>
						</div>
						<div class="stoim-col">
							<div class="summ-line">4800<span class="rub">р.</span></div>
						</div>
					</div>
				</div>
				<div class="clearfix buy-next">
					<a class="btn btn-buy">Купить</a>
					<a class="next" href="#">Продолжить покупки</a>
				</div>

			</div>
			*/?>
		</div>
	</div>
	<script type="text/javascript">
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	s1.async=true;
	s1.src='https://embed.tawk.to/56c443c6427448592519f5af/default';
	s1.charset='UTF-8';
	s1.setAttribute('crossorigin','*');
	s0.parentNode.insertBefore(s1,s0);
	})();
	</script>
	<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter23056159 = new Ya.Metrika({id:23056159,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/23056159" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
</body>
</html>
