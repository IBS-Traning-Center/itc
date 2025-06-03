<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Vacancies");
$APPLICATION->SetPageProperty("DONT_SHOW_PAGE_TOP", "Y");
?>
<div class="bg-main-wrap" style="background: url('/static_com/images/testing-big.jpg') center; background-size: cover;">
	<div class="frame">
		<div class="padding-bottom">
				<div id="register-test" class="form-reg vacancy">
					<h1>IT&C Trainers wanted</h1>
					<div class="label-gray-12">
						We are always looking for <b>awesome IT&C trainers</b> to join our team. If you like to combine <b>programming, software testing, agile, BA or project management with teaching</b> why not get in touch with us.<br/><br/>
					<a target="_blank" href="/catalogue/"><b>You can find a list of the training courses we offer here</b></a>.
					</div>
					<h4>Looking for trainers on: </h4>
					<div class="row">
						<div class="small-2">
							<div class="vac-search-item vac-1">C# / .NET</div>
							<div class="vac-search-item vac-2">Python</div>
						</div>
						<div class="small-2">
							<div class="vac-search-item vac-3">Software Architecture</div>
							<div class="vac-search-item vac-4">Business Analysis</div>
						</div>
					</div>
					 <?$APPLICATION->IncludeComponent("luxoft:form.result.new.nospam", "resume", Array(
	"WEB_FORM_ID" => "22",	// ID веб-формы
		"IGNORE_CUSTOM_TEMPLATE" => "Y",	// Игнорировать свой шаблон
		"USE_EXTENDED_ERRORS" => "Y",	// Использовать расширенный вывод сообщений об ошибках
		"SEF_MODE" => "N",	// Включить поддержку ЧПУ
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"LIST_URL" => "",	// Страница со списком результатов
		"EDIT_URL" => "",	// Страница редактирования результата
		"SUCCESS_URL" => "",	// Страница с сообщением об успешной отправке
		"CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
		"CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
		"COMPONENT_TEMPLATE" => ".default",
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
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>